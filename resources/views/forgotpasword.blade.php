@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{url('myaccount')}}">My Account</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div class="col-sm-9" id="content">
                <h1 class="title">My Account</h1>
                <p class="lead">Hello, <strong>{{session('fullname')}}!</strong> - To update your account information.</p>
                <form>
                    <div class="row">

                    <fieldset id="personal-details">
                                            <legend>Change Password</legend>
                                        <div class="col-sm-6">
                                            <div class="form-group required">
                                                <label for="input-firstname" class="control-label">New Password</label>
                                                <input type="password" class="form-control" value="" name="password">
                                            </div>
                                           
                                        </div>
                                        <div class="col-sm-6">


                                            <div class="form-group required">
                                                <label for="input-email" class="control-label">Confirm Password</label>
                                                <input type="password" class="form-control" name="confirm_password">
                                            </div>
                                           

                                        </div>

                                    </fieldset>
                    </div>

                   <div class="buttons">
                                    <div class="pull-right">
                                        <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Update">
                                    </div>
                                </div>
                </form>
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
