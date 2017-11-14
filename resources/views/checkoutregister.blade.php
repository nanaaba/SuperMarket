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

                <?php
                echo session('koalauser');
                ?>
                <div class="row">
                    <div class="col-sm-8">
                        <h2 class="subtitle">New Customer </h2>
                        <p></p>
                        <form id="checkoutregisterForm">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" value="123456" id="input-payment-firstname" name="password">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-user"></i>Please fill in your shipping information:</h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset id="account">
                                        <div class="form-group required">
                                            <label for="input-payment-firstname" class="control-label"> Name</label>
                                            <input type="text" class="form-control" id="input-payment-firstname" name="name">
                                        </div>

                                        <div class="form-group required">
                                            <label for="input-payment-email" class="control-label">E-Mail</label>
                                            <input type="text" class="form-control" id="input-payment-email"  value="" name="email">
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-telephone" class="control-label">Telephone</label>
                                            <input type="text" class="form-control" id="input-payment-telephone" name="telephone">
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-book"></i> Shipping Address</h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset id="address" class="required">
                                        <div class="form-group required ">
                                            <label for="input-firstname" class="control-label"> Name</label>
                                            <p>NB.Name can be ur work place or house</p>
                                            <input type="text" class="form-control" name="addressName" required>
                                            <input type="hidden" class="form-control" name="xcor" required>
                                            <input type="hidden" class="form-control" name="ycor" required>
                                            
                                        </div>
                                        <div class="form-group required">
                                            <label  class="control-label">Location</label>
                                            <input type="text" class="form-control"   name="location" required>
                                        </div>
                                        <div class="form-group required">
                                            <label class="control-label">Description </label>
                                            <input type="text" class="form-control"  name="description" required>
                                        </div>
                                        <div class="form-group ">
                                            <label  class="control-label">Digital Code</label>
                                            <input type="text" class="form-control"  name="digitalCode" >
                                        </div>



                                    </fieldset>

                                </div>
                            </div>
<!--                            <div class="row pull-right">-->
                                <input type="submit" value="Continue" class="btn btn-primary" />

<!--                            </div>-->
                        </form> 
                    </div>

                    <div class="col-sm-4">
                        <form id="checkoutloginForm">

                            <h2 class="subtitle">Returning Customer</h2>
                            <p><strong>I am a returning customer</strong></p>
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label class="control-label" for="input-email">E-Mail Address/Phone Number</label>
                                <input type="text" name="telephone"  id="input-email" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password">Password</label>
                                <input type="password" name="password" value="" placeholder="Password" id="input-password" class="form-control" />
                                <br />
                                <a href="#">Forgotten Password</a></div>
                            <input type="submit" value="Login" class="btn btn-primary" />
                            <span id="loader" style="display:none;"><img src="{{('image/load.gif')}}" /></span>
                    </form>
                    </div>
                    

                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->
@endsection
