@extends('layouts.master')

@section('content')
<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="login.html">Account</a></li>
            <li><a href="order-history.html">Order History</a></li>
            <li><a href="order-information.html">Order Information</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <h1 class="title">Order Information</h1>
                <?php
                // print_r($orders);
                $shipping_Address = $orders['shippingAddress'];
                $items = $orders['items'];
                ?>

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td colspan="2" class="text-left">Order Details</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>

                                <td style="width: 50%;" class="text-left">       
                                <b>Order ID:</b> #{{$orders['orderID']}}<br>
                                <b>Order Status:</b> {{$orders['status']}}<br>
                                <b>Date Added:</b> {{$orders['orderDate']}}
                                </td>
                               <td style="width: 50%;" class="text-left">  
                                <b>Payment Method:</b> {{$orders['paymentMode']}}<br>
                                <b>Shipping Method:</b> Flat Shipping Rate              </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                if (!empty($shipping_Address)) {
                    ?>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td style="width: 50%; vertical-align: top;" class="text-left">Shipping Address</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-left">{{$shipping_Address['name']}}<br>{{$shipping_Address['description']}}<br>{{$shipping_Address['location']}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                }
                ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-left">Product Image</td>
                                <td class="text-left">Product Name</td>

                                <td class="text-right">Quantity</td>
                                <td class="text-right">Price</td>
                                <td class="text-right">Total</td>
                                <td style="width: 20px;"></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($items as $value) {


                                echo '<form class="addproduct" method="post">
                                                                    <input type="hidden" name="_token" value="' . csrf_token() . '"/>

       <tr>
                                            <td class="text-center">
                                            <a href="#"><img class="img-thumbnail" style="height:50px;width:50px;" 
                                            src="http://18.217.149.24/ecommerce/images/' . $value['iconUrl'] . '"></a></td>
                                            <td class="text-center"><a href="../product/' . $value['itemID'] . '">' . $value['name'] . '</a></td>
                                           
                                                  <td class="text-center">' . $value['quantity'] . '</td>
                                          
                                                  <td class="text-right"><div class="price"> GHS ' . $value['promoPrice'] . '</div></td>
                                                <td class="text-center"><div class="price"> GHS ' . $value['itemTotal'] . '</div></td>
                                                <td class="text-right">
                                                <button class="btn btn-primary" title="" data-toggle="tooltip" type="submit" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>   
                                                </td>
                                   
                                         </tr></form>';
                            }
                            ?>



                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right"><b>Sub-Total</b></td>
                                <td class="text-right">GHS {{round($orders['totalAmt'],2)}}</td>
                                <td></td>
                            </tr>

                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right"><b>Charges</b></td>
                                <td class="text-right">GHS {{round($orders['charges'],2)}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td class="text-right"><b>Total</b></td>
                                <td class="text-right">GHS {{round($orders['totalAmt'],2)}}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <h3>Order History</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <td class="text-left">Date Added</td>
                            <td class="text-left">Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left">20/06/2016</td>
                            <td class="text-left">Processing</td>
                        </tr>
                        <tr>
                            <td class="text-left">21/06/2016</td>
                            <td class="text-left">Shipped</td>
                        </tr>
                        <tr>
                            <td class="text-left">24/06/2016</td>
                            <td class="text-left">Complete</td>
                        </tr>
                    </tbody>
                </table>
<!--                <div class="buttons clearfix">
                    <div class="pull-right"><a class="btn btn-primary" href="#">Continue</a></div>
                </div>-->



            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Account</h3>
                <div class="list-group">
                    <ul class="list-item">
                        <li><a href="{{url('logout')}}">Logout</a></li>
                        <li><a href="{{url('changepassword')}}">Change Password</a></li>
                        <li><a href="{{url('myaccount')}}">My Account</a></li>
                        <li><a href="{{url('addressbooks')}}">Address Books</a></li>
                        <li><a href="{{url('wishlist')}}">Wish List</a></li>
                        <li><a href="{{url('myorders')}}">Order History</a></li>
                        <li><a href="{{url('newsletters')}}">Newsletter</a></li>

                    </ul>
                </div>
            </aside>
            <!--Right Part End -->
        </div>
    </div>
</div>

@endsection
