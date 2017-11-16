<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\PaginationController;

//use Illuminate\Support\Facades\Paginator;

class CategoryController extends Controller {

    public function showcategoryitems($categorycode) {

        $catitems = $this->retreiveCategoryItems($categorycode);
        $catdetails = $this->retreiveCategoriesDetails($categorycode);

        $paginate = new PaginationController();
        $items = $paginate->paginate($catitems,3);



        return view('category')->with('items', $items)->with('details', $catdetails);
    }

    public function getCategoriesItems(Request $request) {


        $catids = $request['catids'];

        $items = $this->retreiveCategoryProducts($catids);

        return redirect('shoppingroom')->with('items', $items);
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
            $bodyObj = json_decode($body, true);

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

    public function retreiveCategoryItems($catid) {

        /* function to retrieve all products  
         * under a category       
         */


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/' . $catid . '/items';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
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

    public function retreiveCategoriesDetails($catids) {

        /* function to retrieve all products  
         * under a category       
         */
        // $ids = implode(',', $catids);


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/categories/' . $catids;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
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

}
