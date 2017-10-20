<?php

namespace App\Http\Controllers;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller {

    public function getCategoriesItems(Request $request) {


        $catids = $request['catids'];

        $items = $this->retreiveCategoryProducts($catids);

        return $items;
        // return redirect('shoppingroom')->with('items', $items);
    }

    public function retreiveCategories() {

        /* function to retreive all categories 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body,true);

            if ($response->getStatusCode() == 200) {
                $categories = $bodyObj['data'];
              
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

    public function retreiveCategoryProducts($catids) {

        /* function to retrieve all products  
         * under a category       
         */
        $ids = implode(',', $catids);


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/' . $ids . '/items';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

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

}
