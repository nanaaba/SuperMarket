@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="wishlist.html">My Orders</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <h1 class="title">My Orders</h1>
                <p class="lead">Hello, <strong>{{session('fullname')}}!</strong>
                    <?php
                    $ordersize = sizeof($orders);
                    ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <td class="text-center">Order No</td>

                                <td class="text-center">Status</td>
                                <td class="text-center">Date Ordered</td>
                                <td class="text-right">Total</td>
                                <td></td>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($ordersize > 0) {
                                foreach ($orders as $value) {
                                    echo ' <tr>

                                <td class="text-center">' . $value['orderID'] . '</td>

                                <td class="text-center">' . $value['status'] . '</td>

                                <td class="text-center">' . $value['orderDate'] . '</td>
                                  <td class="text-right"> GHS ' . $value['totalAmt'] . '</td>
                               
                            
      <td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="myorders/' . $value['orderID'] . '" data-original-title="View"><i class="fa fa-eye"></i></a></td>
                          
                            </tr>';
                                }
                            }
                            ?>


                        </tbody>
                    </table>
                </div>




            </div>

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
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->

@endsection
