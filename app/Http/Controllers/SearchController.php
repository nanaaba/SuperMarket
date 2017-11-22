<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class SearchController extends Controller {

    public function searchQuery(Request $request) {

        /* function to retreive all categories 
         */
        $key = $request->query('search');
        

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/search?searchterm='. $key;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();

            return $body;
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
