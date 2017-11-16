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
                <h1 class="title">My Address Books</h1>
                <p class="lead">Hello, <strong>{{session('fullname')}}!</strong> - To update your account information.</p>






               
                <div class="row">
                    <div class="buttons">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addressModal" data-whatever="@mdo">New Address</button>


                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <td class="text-center">Name</td>

                                <td class="text-center">Location</td>
                                <td class="text-center">Description</td>
                                <td class="text-center">X,Y Coordinates</td>
                                <td class="text-center">Digital Code</td>
                                <td>Action</td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $addressArr = $addresses['addresses'];
                            $addressArrsize = sizeof($addressArr);

                            if ($addressArrsize > 0) {
                                $count = 1;
                                foreach ($addressArr as $value) {

                                    echo ' <tr>

                                <td class="text-center">' . $value['name'] . '</td>

                                <td class="text-center">' . $value['location'] . '</td>

                                <td class="text-center">' . $value['description'] . '</td>
                                  <td class="text-center"> ' . $value['xcor'] . ',' . $value['xcor'] . '</td>
                               
                                 <td class="text-center">' . $value['digitalCode'] . '</td>

      <td class="text-center">
      <button class="btn btn-info" title="" data-toggle="tooltip" onclick="editAddress(' . $value['addressID'] . ')" data-original-title="View"><i class="fa fa-pencil"></i></button>
    <button class="btn btn-info" title="" data-toggle="tooltip" onclick="deleteAddress(' . $value['addressID'] . ')" data-original-title="View"><i class="fa fa-trash"></i></button>  
</td>
                          
                            </tr>';

                                    $count++;
                                }
                            }
                            ?>



                        </tbody>
                    </table>
                </div>

            </div>
            <!--Middle Part End -->
            <!--Right Part Start -->
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle ">Account</h3>
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
