@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{url('cart')}}">Shopping Cart</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">Shopping Cart</h1>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Category</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                            </tr>
                        </thead>
                        <tbody>



                            <?php
                            $items = session('cartitems');
                            $totalitems = $items['totalitems'];
                            $totalprice = $items['totalprice'];
                            $allitems = $items['items'];
                            $response = json_decode($allitems, true);




                            foreach ($response as $value) {

                                $price_total = $value['quantity'] * $value['price'];

                                echo '<form class="updatecart" method="post">
                                                                    <input type="hidden" name="_token" value="' . csrf_token() . '"/>

       <tr>
                                            <td class="text-center">
                                            <a href="product/'.$value['id'].'"><img class="img-thumbnail" style="height:50px;width:50px;" 
                                            src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['url'] . '"></a></td>
                                            <td class="text-left"><a href="product/'.$value['id'].'">' . $value['name'] . '</a></td>
                                              <td class="text-center"><a href="#"></a></td>
                                              <td class="text-left">
                                              <div class="input-group btn-block quantity">
                                                    <input type="text" name="quantity" value="' . $value['quantity'] . '" size="1" class="form-control" />
                                                     <input type="hidden" name="product_code" value="' . $value['id'] . '" />
                                                         <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                                             <input type="hidden" name="price" value="' . $value['price'] . '" />
                                                        <span class="input-group-btn">
                                                        <button type="submit" data-toggle="tooltip" name="update" title="Update" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                                                        <button type="button" onclick="removeItem('.$value['id'].',\''. $value['name'].'\')" data-toggle="tooltip" name="remove_code" title="Remove" class="btn btn-danger"><i class="fa fa-times-circle"></i></button>
                                                         </span></div>
                                                         </td>
                                            <td class="text-right">GHS &nbsp;' . $value['price'] . '</td>
                                           <td class="text-right">GHS &nbsp;' . $price_total . '</td>
                                        </tr></form>';
                            }


                            if ($totalitems == 0) {
                                echo '<tr>'
                                . '<td colspan="7">'
                                . '<div class="alert alert-info"><i class="fa fa-check-circle"></i><center>No products in your cart.Browse the store.</center></div>'
                                . '</td>'
                                . '</tr>';
                            }
                            ?>


                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <div class="col-sm-4 col-sm-offset-8">
                        <table class="table table-bordered">

                            <tr>
                                <td class="text-right"><strong>Total:</strong></td>
                                <td class="text-right">GHS&nbsp;<?php echo $totalprice; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="buttons">
                    <div class="pull-left"><a href="{{url('/')}}" class="btn btn-default">Continue Shopping</a></div>
                    <div class="pull-right"><a href="{{url('checkout')}}" class="btn btn-primary">Checkout</a></div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->


@endsection
