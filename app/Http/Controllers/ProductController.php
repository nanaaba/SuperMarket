<?php

namespace App\Http\Controllers;

use Session;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller {

    public function showproductdetail($productcode) {

        $productinfo = $this->productDetail($productcode);

        return view('product_detail')->with('productinfo', $productinfo);
    }

    public function showpromotions() {
        $promotions  = $this->retreivePromotions();
        return view('promotions')->with('promotions',$promotions);
    }

    public function showpromotionitems($promotioncode) {

        $promodata = $this->retreivePromotionDeatil($promotioncode);

        return view('promotiondetail')->with('promodata', $promodata);
    }

    public function showbannerdetail($bannerid) {


        $info = $this->retreiveBannerDeatil($bannerid);

        if (empty($info)) {
            return redirect('/');
        }
        $type = $info['type'];
        $id = $info['identifier'];
        // echo $type;
        if ($type == "Category") {
            return redirect('category/' . $id);
        }

        if ($type == "Promotion") {
            return redirect('promotion/' . $id);
        }
        if ($type == "Item") {
            return redirect('product/' . $id);
        }
    }

    public function retreiveBannerDeatil($bannerid) {

        /* function to retreive all products 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/banners/' . $bannerid;


        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
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

    public function retreivePromotionDeatil($promotioncode) {

        /* function to retreive all products 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/promotions/' . $promotioncode;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
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

    public function retreiveProducts() {

        /* function to retreive all products 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . 'items';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
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

    public function retreiveRelatedProducts($product) {

        /* function to retrieve all products  
         * related to a product       
         */
    }

    public function retreiveFeaturedProducts() {

        /* function to retreive patronized products

         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . 'items/featured';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body);

            if ($response->getStatusCode() == 200) {

                return $body;
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function productDetail($product) {


        /* function to retrieve product information  
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/' . $product;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ],
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body, true);

            if ($response->getStatusCode() == 200) {

                return $bodyObj['data'];
            }
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

    public function retreivePromotions() {

        /* function to retreive all products 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/promotions';

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
            ],
            'http_errors' => false
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
            $bodyObj = json_decode($body,true);


            return $bodyObj['data'];
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
