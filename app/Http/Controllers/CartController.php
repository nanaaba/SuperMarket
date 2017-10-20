<?php

namespace App\Http\Controllers;

use Anam\Phpcart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

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

        $this->retreiveCartList();
        return json_encode($dataresults);
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

        return json_encode($dataArray);
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
        $this->retreiveCartList();

        $dataresults = array(
            'message' => 'item ' . $data['productname'] . ' has been updated in your cart list',
            'status' => 0
        );

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

        $this->retreiveCartList();
        return json_encode($dataresults);
        
    }

    public function clearCart() {
        /* function to remove  product from cart  
         */
        $cart = new Cart();
        $cart->clear();
    }

}
