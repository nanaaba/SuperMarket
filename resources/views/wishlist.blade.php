@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="wishlist.html">My Wish List</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <h1 class="title">WishList</h1>
                <p class="lead">Hello, <strong>{{session('fullname')}}!</strong>
                    <?php
                   
                    ?>
                     <div class="row">
                    <div class="buttons">
                        <div class="pull-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#shoppingbagModal" data-whatever="@mdo">New Shopping Bag</button>


                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>

                                <td class="text-center">Bag Name</td>

                                <td class="text-center">Items</td>

                              
                                <td class="text-center">Date Created</td>
                                <td>Action</td>
                           
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($bags as $value) {
                                echo ' <tr>

                                <td class="text-center">'.$value['name'].'</td>
 <td class="text-center">'.$value['itemCount'].'</td>
                                <td class="text-center">'.$value['dateCreated'].'</td>
                                
                                <td class="text-center"><a class="btn btn-info" title="" data-toggle="tooltip" href="wishlist/items/'.$value['bagID'].'" data-original-title="View"><i class="fa fa-eye"></i></a>
                                      <button class="btn btn-danger" onclick="removeWishBag(' . $value['bagID'] . ')" data-toggle="tooltip" type="button"  data-original-title="Remove"><i class="fa fa-times"></i></button></td>
                           
</td>
               

                            </tr>';
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
