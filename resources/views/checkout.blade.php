@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="cart.html">Shopping Cart</a></li>
            <li><a href="checkout.html">Checkout</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">Checkout</h1>




                <div class="row">

                    <div class="col-sm-12">
                        <div class="row">
                            <p>Choose Address you want the order to be delievered to.Or enter new address</p>

                            <?php
                            $addressArr = $addresses['addresses'];
                            $addressArrsize = sizeof($addressArr);

                            if ($addressArrsize > 0) {
                                $count = 1;
                                foreach ($addressArr as $value) {


                                    echo '  
                    
                        <div class="col-md-3">
                             <div class="col-md-2">
                                                <input type="radio" name="addresses" id="addresses" value="' . $value['addressID'] . '">
                                            </div>
                                            <div class="col-md-10">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-truck"></i> Address ' . $count . '</h4>
                                </div>
                                <div class="panel-body">
                                    ' . $value['location'] . '<br>' . $value['description'] . '<br>' . $value['digitalCode'] . '<br>                                                    </div>
                                                 
                                    </div> 
                            </div>
                        </div>

                    ';
                                    $count++;
                                }
                            }
                            ?>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
                                    </div>
                                    <div class="panel-body">
                                        <p>Please select the preferred payment method to use on this order.</p>
                                        <?php
                                        //paymentmodes
                                        $modes = $paymentmodes['paymentModes'];
                                        foreach ($modes as $value) {
                                            echo '<div class="radio">
                                            <label>
                                                <input type="radio" value="'.$value['paymentModeID'].'" name="paymentmodes" id="paymentmodes">
                                                '.$value['name'].'</label>
                                        </div>';   
                                        }
                                        ?>
                                        
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-gift"></i> Use Gift Voucher</h4>
                                    </div>
                                    <div class="panel-body">
                                        <label for="input-voucher" class="col-sm-3 control-label">Enter gift voucher code</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="input-voucher" placeholder="Enter your gift voucher code here" value="" name="voucher">
                                            <span class="input-group-btn">
                                                <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-voucher" value="Apply Voucher">
                                            </span> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                                    </div>
                                    <div class="panel-body">


                                        <div class="table-responsive">
                                            <table class="table table-bordered">




                                                <thead>
                                                    <tr>
                                                        <td class="text-center">Image</td>
                                                        <td class="text-left">Product Name</td>
                                                        <td class="text-left">Quantity</td>
                                                        <td class="text-right">Unit Price</td>
                                                        <td class="text-right">Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
//  $data = json_decode($items,true);
//$items = $data['items'];
                                                    $itemsData = $items['items'];
                                                    foreach ($itemsData as $value) {

                                                        echo '  <tr>
                                                        <td class="text-center"><a href="#"><img style="height:50px;width:50px;"  src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-thumbnail"></a></td>
                                                        <td class="text-left"><a href="product/'.$value['itemID'].'">' . $value['name'] . '</a></td>
                                                        <td class="text-left">' . $value['quantity'] . '</td>
                                                        <td class="text-right">GHS ' . $value['price'] . '</td>
                                                        <td class="text-right">GHS ' . $value['itemTotal'] . '</td>
                                                    </tr>';
                                                    }
                                                    ?>


                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                                                        <td class="text-right">GHS {{round($items['itemTotal'],2)}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><strong>Charges:</strong></td>
                                                        <td class="text-right">GHS {{round($items['charges'],2)}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                                        <td class="text-right">GHS {{round($items['totalAmt'],2)}}</td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <input type="hidden" value="{{$items['itemTotal']}}" id="totalamount"/>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
                                    </div>
                                    <div class="panel-body">
                                        <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                                        <br>
                                        <label class="control-label" for="confirm_agree">
                                            <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
                                            <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
                                        <div class="buttons">
                                            <div class="pull-right">
                                                <input type="button"  class="btn btn-primary" id="buttonconfirm" value="Confirm Order"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->
@endsection
