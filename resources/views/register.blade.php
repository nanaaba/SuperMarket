@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="login.html">Account</a></li>
            <li><a href="register.html">Register</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div class="col-sm-1"></div>
            <div class="col-sm-9" id="content">
                <h1 class="title">Register Account</h1>
                <p>If you already have an account with us, please login at the <a href="login.php">Login Page</a>.</p>
                <div id="output" style="display: none;">

                </div>
                <form class="form-horizontal" id="registerform" >

                    {{ csrf_field() }}
                    <fieldset id="account">
                        <legend>Your Personal Details</legend>

                        <div class="form-group required">
                            <label for="input-firstname" class="col-sm-2 control-label"> Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control"  placeholder="Name" value="" name="name" required>
                            </div>
                        </div>

                        <div class="form-group required">
                            <label for="input-email" class="col-sm-2 control-label">E-Mail</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control"  placeholder="E-Mail" value="" name="email">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-telephone" class="col-sm-2 control-label">Telephone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" placeholder="Telephone" value="" name="telephone">
                            </div>
                        </div>

                    </fieldset>

                    <fieldset>
                        <legend>Your Password</legend>
                        <div class="form-group required">
                            <label for="input-password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control"  placeholder="Password" value="" id="password" name="password">
                            </div>
                        </div>
                        <div class="form-group required">
                            <label for="input-confirm" class="col-sm-2 control-label">Password Confirm</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" placeholder="Password Confirm" value="" id="confirmpassword" name="confirm_password">
                            </div>
                        </div>


                    </fieldset>


                    <fieldset>
                        <legend>Favourites Categories</legend>
                        <p>NB. This is optional.categories selected will be your favorites categories you will most often</p>
                        <div class="form-group ">
                            <label for="input-confirm" class="col-sm-2 control-label">Categories</label>
                            <div class="col-sm-10">
                                <?php
                                $setupObj = session('setupdata');

                                $categories = $setupObj['categories'];

                                foreach ($categories as $value) {
                                    echo '<label class="checkbox-inline">
                    <input type="checkbox" value="' . $value['categoryID'] . '" name="categories[]">
                    ' . $value['name'] . ' </label>';
                                    //  echo '<input type="checkbox" class="form-control " name="categories[]" value="'.$value['categoryID'].'"/>'.$value['name'];
                                    //   echo '  <li><a href="category">' . $value['name'] . '</a> </li>';
                                }
                                ?>
                            </div>
                        </div>


                    </fieldset>

                    <div class="buttons">
                        <div class="pull-right">
                            <input type="checkbox" value="1" id="agree" name="agree">
                            &nbsp;I have read and agree to the <a class="agree" href="#"><b>Privacy Policy</b></a> &nbsp;
                            <input type="submit" class="btn btn-primary" value="Register">
                            <span id="loader" style="display:none;"><img src="{{('image/load.gif')}}" /></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-1"></div>

        </div>
    </div>
</div>
@endsection
