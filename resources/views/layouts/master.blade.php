<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


        <meta name="_token" content="{{ csrf_token() }}">

        <title>SuperMarket</title>


        <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet-skin3.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css')}}" />
        <!--        <link rel="stylesheet" type="text/css" href="{{ asset('css/mdb.css')}}" />-->
        <!--        <link rel="stylesheet" type="text/css" href="{{ asset('css/mdb.min.css')}}" />-->
        <!--        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}" />-->

        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>

        <!-- CSS Part End-->


    </head>
    <div class="wrapper-wide">

        @include('layouts.header')
        @yield('content')



        <!-- Here goes your content -->





        <!--        <div class="modal fade " id="wishlistModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog modal-info " role="document">-->

        <div id="wishlistModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--Header-->

                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                        <h4 class="modal-title">WishList</h4>
                    </div>

                    <form id="wishlistForm">
                        <input type="hidden" name="_token" value="{{csrf_token() }} "/>

                        <input type="hidden" name="itemid" id="itemid" class="form-control">
                        <input type="hidden" name="productname" id="productname2" class="form-control">

                        <!--Body-->
                        <div class="modal-body">
                            <div class="text-center">
                                <i class="fa fa-cart-arrow-down fa-4x mb-3 animated rotateIn"></i>
                                <p><strong>Product Name : <span id="productname"></span></strong></p>
                                <p>Shopping Bags helps users to group their wishlist items .
                                </p>
                            </div>

                            <hr>

                            <!-- Radio -->
                            <p class="text-center"><strong>Shopping Bag</strong></p>

                            <?php
                            $shoppingbags = session('shoppingBags');

                            $shoppingbagsize = sizeof($shoppingbags);
                            if ($shoppingbagsize > 0) {

                                foreach ($shoppingbags as $value) {
                                    echo '<div class="form-group">
                                <input name="shoppingbag" type="radio" required value="' . $value['bagID'] . '" >
                                <label for="radio-4">' . $value['name'] . '</label>
                            </div>';
                                }
                                ?>
                                <div class="form-group">
                                    <input name="shoppingbag" required type="radio" value="new" id="newbag">
                                    <label for="radio-4">New Shopping Bag</label>
                                </div>

                                <?php
                            }
                            ?>
                            <input type="hidden" id="shoppingbagsize" value="<?php echo $shoppingbagsize ?>" class="form-control">

                            <div class="md-form" style="display: none" id="newbagdiv">
                                <label for="form7">New Shopping Bag</label>
                                <input type="text" name="newbag" id="newbaginput" class="form-control">


                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >ADD TO WISHLIST</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        </div>
                        <!--Footer-->
                        <!--                        <div class="modal-footer ">
                                                    <input type="submit" class="btn btn-primary-modal waves-effect waves-light"/>
                        
                                                    <a type="button" class="btn btn-outline-secondary-modal waves-effect" data-dismiss="modal">Cancel</a>
                                                </div>-->
                    </form>
                </div>
            </div>
        </div>

        <div id="addressModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--Header-->

                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                        <h4 class="modal-title">New Address</h4>
                    </div>
                    <form id="addressbookForm">
                         <input type="hidden" name="_token" value="{{csrf_token() }} "/>

                        <div class="modal-body">




                            <div class="form-group required">
                                <label for="input-firstname" class="control-label"> Name</label>
                                            <span>NB.Name can be ur work place or house</span>
                                <input type="text" class="form-control" name="addressName"required >
                            </div>


                            <div class="form-group required">
                                <label for="input-telephone" class="control-label">Location</label>
                                <input type="text" class="form-control"  name="location"required >
                            </div>


                            <div class="form-group required">
                                <label for="input-telephone" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>





                            <div class="form-group ">
                                <label for="input-email" class="control-label">Digital Code</label>
                                <input type="text" class="form-control"  name="digitalCode">
                            </div>


                           
                                <div class="form-group ">
                                    <label for="input-telephone" class="control-label">X Coordinates</label>
                                    <input type="text" class="form-control" name="xcor">
                                </div>
                          
                                <div class="form-group ">
                                    <label for="input-telephone" class="control-label">Y Coordinates</label>
                                    <input type="text" class="form-control" name="ycor">
                                </div>
                        

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >SUBMIT</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

  <div id="editaddressModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--Header-->

                    <div class="modal-header modal-header-primary">
                        <button type="button" class="close" data-dismiss="modal" style="color: white">&times;</button>
                        <h4 class="modal-title">New Address</h4>
                    </div>
                    <form id="addressbookForm">
                         <input type="hidden" name="_token" value="{{csrf_token() }} "/>

                        <div class="modal-body">




                            <div class="form-group required">
                                <label for="input-firstname" class="control-label"> Name</label>
                                            <span>NB.Name can be ur work place or house</span>
                                <input type="text" class="form-control" name="addressName"required >
                            </div>


                            <div class="form-group required">
                                <label for="input-telephone" class="control-label">Location</label>
                                <input type="text" class="form-control"  name="location"required >
                            </div>


                            <div class="form-group required">
                                <label for="input-telephone" class="control-label">Description</label>
                                <input type="text" class="form-control" name="description" required>
                            </div>





                            <div class="form-group ">
                                <label for="input-email" class="control-label">Digital Code</label>
                                <input type="text" class="form-control"  name="digitalCode">
                            </div>


                           
                                <div class="form-group ">
                                    <label for="input-telephone" class="control-label">X Coordinates</label>
                                    <input type="text" class="form-control" name="xcor">
                                </div>
                          
                                <div class="form-group ">
                                    <label for="input-telephone" class="control-label">Y Coordinates</label>
                                    <input type="text" class="form-control" name="ycor">
                                </div>
                        

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" >SUBMIT</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>




        <div class="modal fade" id="loaderModal" data-keyboard="false" data-backdrop="static" role="dialog" >
            <div class="modal-dialog" role="document">


                <div  id="loader" style="margin-top:30% ;text-align: center">
<!--                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>-->

                    <img src="{{('image/load.gif')}}" />

                    <span class="loader-text" style="font-size: 20px;color: white;">Wait...</span>
                </div>


            </div>
        </div>

        @include('layouts.footer')


    </div>



</html>