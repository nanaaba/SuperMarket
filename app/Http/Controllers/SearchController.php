<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class SearchController extends Controller {

    public function searchQuery(Request $request) {

        $searchparam = $request->query('search');
        $results = $this->searchResults($searchparam);
        $paginate = new PaginationController();
        $items = $paginate->paginate($results, 3);

        return view('searchresults')->with('results', $items)->with('searchparam', $searchparam);
    }

    public function searchResults($searchparam) {

        /* function to retreive all categories 
         */


        $url = config('constants.TEST_URL');

        $baseurl = $url . '/items/search?searchterm=' . $searchparam;

        $client = new Client([
            'headers' => [
                'Accept' => 'application/json'
            ]
        ]);
        try {

            $response = $client->request('GET', $baseurl);

            $body = $response->getBody();
  
            return json_decode($body,true);
        } catch (RequestException $e) {
            return 'Http Exception : ' . $e->getMessage();
        } catch (Exception $e) {
            return 'Internal Server Error:' . $e->getMessage();
        }
    }

}
