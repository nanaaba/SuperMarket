@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="login.html">Account</a></li>
            <li><a href="login.html">Login</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">Account Login</h1>
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="subtitle">New Customer</h2>
                        <p><strong>Register Account</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <a href="{{url('register')}}" class="btn btn-primary">Continue</a> </div>
                   <form id="loginForm">
                    <div class="col-sm-6">
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
                    </div>
                   </form>
                </div>
            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
         
        </div>
    </div>
</div>

@endsection
