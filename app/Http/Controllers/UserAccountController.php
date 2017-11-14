<?php

namespace App\Http\Controllers;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\CartController;

class UserAccountController extends Controller {

    public function showcheckout() {



        if (Session::has('koalauser')) {
            //
            $cart = new CartController();
            $items = $cart->checkoutitems();
            $address = $this->getUserAddresses();
            $paymentmodes = $this->getPaymentModes();
            return view('checkout')->with('items', $items)->with('addresses', $address)
                            ->with('paymentmodes', $paymentmodes);
        }
        return view('checkoutregister');
    }

    public function showwishlist() {

        $bags = $this->getUserShoppingBags();
        return view('wishlist')->with('bags', $bags);
    }

    public function showwishlistitems($bagid) {
        $bags = $this->getShoppingBagDetail($bagid);
        return view('wishlistitems')->with('bags', $bags);
    }

    public function showuserorders() {
        $orders = $this->getUserOrders();
        return view('myorders')->with('orders', $orders);
    }

    public function showuseraddresses() {
        $addresses = $this->getUserAddresses();
        return view('addressbooks')->with('addresses', $addresses);
    }

    public function checkoutregisterUser(Request $request) {

        $data = $request->all();
        $results = $this->registerUser($request);
        $resultsArray = json_decode($results, true);

        $status = $resultsArray['status'];
        if ($status == 0) {
            $userid = $resultsArray['data']['customer']['userID'];
            $feedback = $this->addCheckutUserAddress($data, $userid);
            $this->authenticateuser($request);
            return $feedback;
        }
        return $results;
        // return $userid;
    }

    public function registerUser(Request $request) {

        /* function to register user 
         * send email to user after registering
         * email contain username and password
         */

        $data = $request->all();


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/Account/Register';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'platform' => 'Web',
                'appVersion' => 'Beta'
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "fullname" => $data['name'],
                "email" => $data['email'],
                "phone" => $data['telephone'],
                "deviceImei" => rand(0, 100) . time(),
                "key" => rand(0, 100) . time(),
                "av" => "",
                "userAgent" => "Web",
                "platform" => "Web",
                "notoficationId" => "Web",
                "password" => $data['password']
            );

            // return json_encode($arr);
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            $bodobj = json_decode($body, true);

            $status = $bodobj['status'];

            if ($status == 0) {
                $userid = $bodobj['data']['customer']['userID'];
//            $userID = $userid['userID'];
                if (!empty($data['categories'])) {
                    $results = $this->AddUserCategories($userid, $data['categories']);
                }
            }



            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function AddUserCategories($userid, $categories) {

        /* function to register user favourites 
         * send email to user after registering
         * email contain username and password
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/user';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => $userid
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "categories" => $categories
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();

            if ($response->getStatusCode() == 200) {
                return $body;
            } else {
                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getUserCategories() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/user';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function removeUserCategories($catids) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/user/' . $catids;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('DELETE', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function addWishlistItem(Request $request) {

        $data = $request->all();

        $bagid = $data['shoppingbag'];
        $newbag = $data['newbag'];
        $itemid = $data['itemid'];
        if ($bagid == "new") {
            $response = $this->createShoppingBag($newbag);
            $responseArr = json_decode($response, true);
            $status = $responseArr['status'];
            if ($status == 1) {
                return $response;
            }

            if ($status == 0) {
                //caall user shopping bags
                $userbags = $this->getUserShoppingBags();
                Session::forget('shoppingBags');
                session(['shoppingBags' => $userbags]);

                $bagid = $responseArr['data']['bagID'];
                $items = $this->additemtoBag($bagid, $itemid);
                return $items;
            }
        }
        $items = $this->additemtoBag($bagid, $itemid);
        return $items;
    }

    public function createShoppingBag($bagname) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/user';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "name" => $bagname
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);

            $body = $response->getBody();


            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function additemtoBag($bagid, $itemid) {

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/user/items';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser'),
                'platform' => "Web"
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "bagId" => $bagid,
                "items" => array(
                    $itemid
                )
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);
            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getUserShoppingBags() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/user';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);

            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getShoppingBagDetail($bagid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/' . $bagid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);

            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function removeUserShoppingBags($bagids) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/' . $bagids;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('DELETE', $baseurl);

            $body = $response->getBody();


            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function removeShoppingBagItem($bagid, $itemid) {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/bag/' . $bagid . '/items/' . $itemid;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userID' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('DELETE', $baseurl);

            $body = $response->getBody();
            //$bodyObj = json_decode($body);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function addUserReview(Request $request) {

        $data = $request->all();

        $review = $data['comments'];
        $rating = $data['rating'];
        $itemId = $data['itemID'];

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/reviews';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "itemID" => $itemId,
                "comment" => $review,
                "rating" => $rating
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function authenticateuser(Request $request) {

        $data = $request->all();
        $url = config('constants.TEST_URL');

        $baseurl = $url . '/Account/Login';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "username" => $data['telephone'],
                "password" => $data['password'],
                "deviceImei" => rand(0, 100) . time(),
                "key" => rand(0, 100) . time(),
                "av" => "",
                "userAgent" => "Web",
                "platform" => "Web",
                "notoficationId" => "jeberish"
            );


            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            $bodobj = json_decode($body, true);

            $status = $bodobj['status'];

            if ($status == 0) {
                $userid = $bodobj['data']['customer']['userID'];

                $fullname = $bodobj['data']['customer']['fullname'];
                $email = $bodobj['data']['customer']['email'];
                $phone = $bodobj['data']['customer']['phone'];
                $userCategories = $bodobj['data']['userCategories'];
                $shoppingBags = $bodobj['data']['shoppingBags'];
                $cartitems = $bodobj['data']['userCart']['items'];
                //$userCart = $bodobj['data']['userCart'];
                $usercarttotalitems = $bodobj['data']['userCart']['itemCount'];

                session(['koalauser' => $userid]);
                session(['fullname' => $fullname]);
                session(['email' => $email]);
                session(['phone' => $phone]);
                session(['usercategories' => $userCategories]);
                session(['shoppingBags' => $shoppingBags]);
                session(['usercarttotal' => $usercarttotalitems]);



                //check if user has data in current cart
                $cart = new CartController();
                $cartdata = $cart->retreiveCartList();
                $cartitemsize = sizeof($cartdata['items']);



                if ($cartitemsize == 0 && $usercarttotalitems > 0) {

                    $cart->addBulkItemsToCart($cartitems);
                    session(['usercart' => $cartitems]);
                }


                if ($cartitemsize > 0) {
                    $cart->addBulkCartItemsServer($cartdata['items']);
                    $cart->clearCart();
                    $cartlist = $cart->getUserCart();

                    $cartitems = $cartlist['items'];
                    $cart->addBulkItemsToCart($cartitems);
                    session(['usercart' => $cartitems]);
                }
            }


            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getUserOrders() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders/user';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);


            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getUserAddresses() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/customers/address';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);


            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getPaymentModes() {


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/payments/modes';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'platform' => 'Web'
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);


            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function addCheckutUserAddress($data, $userid) {


        $digitalCode = $data['digitalCode'];
        $name = $data['addressName'];
        $location = $data['location'];
        $xcor = $data['xcor'];
        $ycor = $data['ycor'];
        $description = $data['description'];

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/customers/address';


        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => $userid
            ],
            'http_errors' => false
        ]);

        try {



            $arr = array(
                "digitalCode" => $digitalCode,
                "name" => $name,
                "location" => $location,
                "xcor" => $xcor,
                "ycor" => $ycor,
                "description" => $description
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function addUserAddress(Request $request) {

        $data = $request->all();

        $digitalCode = $data['digitalCode'];
        $name = $data['addressName'];
        $location = $data['location'];
        $xcor = $data['xcor'];
        $ycor = $data['ycor'];
        $description = $data['description'];

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/customers/address';


        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {



            $arr = array(
                "digitalCode" => $digitalCode,
                "name" => $name,
                "location" => $location,
                "xcor" => $xcor,
                "ycor" => $ycor,
                "description" => $description
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function orderItems(Request $request) {

        $data = $request->all();


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/orders/checkout/confirm';


        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser'),
                'platform' => 'Web'
            ],
            'http_errors' => false
        ]);

        try {



            $arr = array(
                "totalAmt" => $data['totalamount'],
                "addressID" => $data['addressid'],
                "paymentModeID" => $data['paymentmode']
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function logoutUser() {

        Session::forget('koalauser');
        Session::forget('fullname');
        Session::forget('email');
        Session::forget('phone');
        Session::forget('shoppingBags');
        Session::forget('usercategories');
        Session::forget('usercart');

        Session::forget('cartitemsize');


        $cart = new CartController();
        $cart->clearCart();
        //cartitemsize
        //   Session::flush();
        return redirect('/');
    }

}
