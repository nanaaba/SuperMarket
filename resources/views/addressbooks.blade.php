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
                    <?php
                    $addressArr = $addresses['addresses'];
                    $addressArrsize = sizeof($addressArr);

                    if ($addressArrsize > 0) {
                        $count = 1;
                        foreach ($addressArr as $value) {


                            echo '  
                    
                        <div class="col-md-4">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-truck"></i> Address ' . $count . '</h4>
                                </div>
                                <div class="panel-body">
                                    ' . $value['location'] . '<br>' . $value['description'] . '<br>' . $value['digitalCode'] . '<br>                                                    </div>
                         <div class="buttons">
                                <div class="pull-right">
                               
<button class="btn btn-primary waves-effect waves-light" title="" data-toggle="tooltip" type="submit" data-original-title="Add to Cart"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger waves-effect waves-light" onclick="removeItemWishlist(5,4004)" data-toggle="tooltip" type="button" data-original-title="Remove"><i class="fa fa-times"></i></button>
</div>
                            </div>                            
                                    </div> 
                            
                        </div>

                    ';
                            $count++;
                        }
                    }
                    ?>



                </div>



                <form>
                    <div class="row">

                        <fieldset id="personal-details">
                            <legend>New Address</legend>
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="input-firstname" class="control-label"> Name</label>
                                    <span>NB.Name can be ur work place or house</span>
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="input-telephone" class="control-label">Location</label>
                                    <input type="tel" class="form-control"  name="telephone">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="input-telephone" class="control-label">Street Name</label>
                                    <input type="tel" class="form-control" name="telephone">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group required">
                                    <label for="input-telephone" class="control-label">LandMark</label>
                                    <input type="tel" class="form-control" name="telephone">
                                </div>
                            </div>
                            <div class="col-sm-6">


                                <div class="form-group required">
                                    <label for="input-email" class="control-label">Digital Code</label>
                                    <input type="email" class="form-control"  name="email">
                                </div>



                            </div>

                            <div class="col-sm-6">


                                <div class="form-group required">
                                    <label for="input-email" class="control-label">House Address</label>
                                    <textarea rows="6" class="form-control"  name="email">
                                    </textarea>
                                </div>



                            </div>


                            <div class="col-sm-6">


                                <div class="form-group required">
                                    <label for="input-email" class="control-label">Region</label>
                                    <select class="form-control" id="region" name="region">
                                        <option value="">Choose region..</option>
                                        <option value="Greater Accra">Greater Accra</option>

                                        <option value="Western Region">Western Region</option>
                                        <option value="Central Region">Central Region</option>
                                        <option value="Eastern Region">Eastern Region</option>
                                        <option value="Ashanti Region">Ashanti Region</option>
                                        <option value="Northern Region">Northern Region</option>
                                        <option value="Brong Ahafo Region">Brong Ahafo Region</option>
                                        <option value="Upper East Region">Upper East Region</option>
                                        <option value="Upper West Region">Upper West Region</option>
                                        <option value="Volta Region">Volta Region</option>

                                    </select>
                                </div>



                            </div>

                        </fieldset>

                    </div>

                    <div class="buttons">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-lg btn-primary" value="Save">
                        </div>
                    </div>
                </form>
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
