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
                            <legend>Personal Details</legend>
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="input-firstname" class="control-label">Full Name</label>
                                    <input type="text" class="form-control" value="{{session('fullname')}}" name="name">
                                </div>
                                <div class="form-group required">
                                    <label for="input-telephone" class="control-label">Telephone</label>
                                    <input type="tel" class="form-control" value="{{session('phone')}}" name="telephone">
                                </div>
                            </div>
                            <div class="col-sm-6">


                                <div class="form-group required">
                                    <label for="input-email" class="control-label">E-Mail</label>
                                    <input type="email" class="form-control" value="{{session('email')}}" name="email">
                                </div>



                            </div>

                        </fieldset>

                    </div>

                    <div class="buttons">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-lg btn-primary" value="Save Changes">
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
                        <li><a href="#">Newsletter</a></li>

                    </ul>
                </div>
            </aside>
            <!--Right Part End -->
        </div>
    </div>
</div>

@endsection
