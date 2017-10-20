<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\CartController;

class HomeController extends Controller {

    public function index() {


        if (empty(session('setupdata'))) {
            $this->setUp();
        }

        $caritems = new CartController();
        $caritems->retreiveCartList();

        return view('home');
    }

    public function setUp() {

        /* function to retreive all categories 
         */

        $url = config('constants.TEST_URL');

        $baseurl = $url . '/setup';

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
                $setupObj = $bodyObj['data'];
                session(['setupdata' => $setupObj]);

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
