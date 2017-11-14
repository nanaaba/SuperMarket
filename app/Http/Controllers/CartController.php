<?php

namespace App\Http\Controllers;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Anam\Phpcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller {

    public function addProductToCart(Request $request) {

        /* function to add to add product to cart
         */
        $data = $request->all();


        $cart = new Cart();


        $cart->add([
            'id' => $data['productid'],
            'name' => $data['productname'],
            'quantity' => $data['quantity'],
            'url' => $data['url'],
            'price' => $data['price'],
        ]);
        $numof_items = $cart->count();

        $dataresults = array(
            'message' => 'item ' . $data['productname'] . ' has been added to your cart list',
            'totalitems' => $numof_items
        );

        if ($request->session()->has('koalauser')) {
            //
            $this->addItemCartServer($data['productid'], $data['quantity']);
        }
        $this->retreiveCartList();
        return json_encode($dataresults);
    }

    public function addBulkItemsToCart($itemsArray) {

        /* function to add to add product to cart
         */

        foreach ($itemsArray as $data) {

            $cart = new Cart();


            $cart->add([
                'id' => $data['itemID'],
                'name' => $data['name'],
                'quantity' => $data['quantity'],
                'url' => $data['iconUrl'],
                'price' => $data['price'],
            ]);
        }



        $this->retreiveCartList();
    }

    public function retreiveCartList() {

        /* function to retrieve all products  
         * in the cart       
         */


        $cart = new Cart();

        $items = $cart->items();
        $total_cost = $cart->getTotal();
        $total_items = $cart->count();


        $dataArray = array(
            'items' => $items,
            'totalprice' => $total_cost,
            'totalitems' => $total_items
        );

        session(['cartitems' => $dataArray]);

        return $dataArray;
    }

    public function updateCartList(Request $request) {

        /* function to update products cart

         */

        $data = $request->all();

        $cart = new Cart();

        $cart->update([
            'id' => $data['product_code'],
            'price' => $data['price'],
            'quantity' => $data['quantity']
        ]);

        $dataresults = array(
            'message' => 'item ' . $data['productname'] . ' has been updated in your cart list',
            'status' => 0
        );

        if ($request->session()->has('koalauser')) {
            //
            $this->updateItemCartServer($data['product_code'], $data['quantity']);
        }
        $this->retreiveCartList();
        return json_encode($dataresults);
    }

    public function removeProductFromCart($itemkey) {

        /* function to remove  product from cart  
         */
        $cart = new Cart();
        $cart->remove($itemkey);

        $dataresults = array(
            'message' => 'item has been removed',
            'status' => 0
        );
        if (Session::has('koalauser')) {
            //
            $this->removeCartItemServer($itemkey);
        }

        $this->retreiveCartList();
        return json_encode($dataresults);
    }

    public function clearCart() {
        /* function to remove  product from cart  
         */
        $cart = new Cart();
        $cart->clear();
        Session::forget('cartitems');
    }

    public function addItemCartServer($item, $quantity) {



        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {



            $arr = array(
                "itemId" => $item,
                "quantity" => $quantity
            );

            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            // $bodobj = json_decode($body, true);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function getUserCart() {



        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user';



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
            $bodobj = json_decode($body, true);

            return $bodobj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function updateItemCartServer($item, $quantity) {



        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {



            $arr = array(
                "itemId" => $item,
                "quantity" => $quantity
            );

            $response = $client->request('PUT', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            // $bodobj = json_decode($body, true);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function addBulkCartItemsServer($itemsArray) {

        $items = json_decode($itemsArray, true);
        $data = array();
        $results = array();
        foreach ($items as $i) {
            $data['itemId'] = $i['id'];
            $data['quantity'] = $i['quantity'];
            array_push($results, $data);
        }


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user/bulk';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {



            $response = $client->request('POST', $baseurl, ['json' => $results]);


            $body = $response->getBody();
            // $bodobj = json_decode($body, true);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function removeCartItemServer($item) {



        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user/' . $item;



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
            //   $bodobj = json_decode($body, true);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function emptyUserCart() {



        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/cart/user';



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
            //   $bodobj = json_decode($body, true);

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function checkoutitems() {


        $items =  $this->retreiveCartList();
        $items = json_decode($items['items'],true) ;


        $data = array();
        $results = array();
        foreach ($items as $i) {
            $data['itemId'] = $i['id'];
            $data['quantity'] = $i['quantity'];
            array_push($results, $data);
        }
        
        $dataArray = array(
            'items'=>$results
        );


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/orders/checkout';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {



            $response = $client->request('POST', $baseurl, ['json' => $dataArray]);


            $body = $response->getBody();
             $bodobj = json_decode($body, true);

            return $bodobj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
