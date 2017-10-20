<?php

namespace App\Http\Controllers;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserAccountController extends Controller {

    public function registerUser(Request $request) {

        /* function to register user 
         * send email to user after registering
         * email contain username and password
         */

        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/api/Account/Register';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "surname" => $data['lastname'],
                "otherNames" => $data['otherNames'],
                "email" => $data['email'],
                "phoneNumber" => $data['telephone'],
                "deviceImei" => rand(0, 100).  time(),
                "key" => rand(0, 100).  time(),
                "av" => "",
                "userAgent" => "Web",
                "platform" => "Web",
                "notoficationId" => "Web",
                "Password" => $data['password'],
                "ConfirmPassword" => $data['confirm_password'],
            );
            $response = $client->request('POST', $baseurl, ['json' => $arr]);


            $body = $response->getBody();
            $bodobj = json_decode($body);

            if ($response->getStatusCode() == 201) {
//                $userid = $bodobj->data->customerId;
//
//                if (!empty($data['categories'])) {
//                    $results = $this->AddUserCategories($userid, $data['categories']);
//                }

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

    public function AddUserCategories($userid, $categories) {

        /* function to register user favourites 
         * send email to user after registering
         * email contain username and password
         */

        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/categories/user';



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

    public function sendemail($email) {

        /* function to send email to user       
         */
    }

    public function resetPassword(Request $request) {

        /* function to reset user password
         * call api to reset password 
         * send new password to user email 
         */
    }

    public function createShoppingBag(Request $request) {


        $data = $request->all();


        // $url = Config::get('constants.TEST_URL');
        $baseurl = 'tfs.knust.edu.gh/ecommerce/bag/user';



        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'userid' => session('koalauser')
            ],
            'http_errors' => false
        ]);

        try {


            $arr = array(
                "name" => $data['name'],
                "bagid" => "",
                "items" => $data['items']
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

    public function removeUserShoppingBagItem($bagid, $itemsids) {


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

}
