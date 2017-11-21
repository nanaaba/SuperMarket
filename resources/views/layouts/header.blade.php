<div id="header">
    <!-- Top Bar Start-->

    <nav id="top" class="htop">


        <div class="container">
            <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
                <div class="pull-left flip left-top">
                    <div class="links">
                        <ul>
                            <li class="mobile"><i class="fa fa-phone"></i>+233 20399292982</li>
                            <li class="email"><a href="mailto:info@marketshop.com"><i class="fa fa-envelope"></i>info@marketshop.com</a></li>


                        </ul>
                    </div>

                </div>
                <div id="top-links" class="nav pull-right flip">

                    <?php
                    if (empty(session('koalauser'))) {
                        ?>
                        <ul>
                            <li><a href="{{url('login')}}">Login</a></li>
                            <li><a href='{{url('register')}}'>Register</a></li>
                        </ul>
                        <?php
                    }

                    if (!empty(session('koalauser'))) {
                        ?>
                        <ul>
                            <li><a href="#">Welcome,{{session('fullname')}}</a></li>
                            <li class="dropdown" id="my_account"><a href="#">My Account <i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu dropdown-menu-right" style="display: none;">
                                    <li><a href="{{url('myaccount')}}">My Account</a></li>
                                    <li><a href="{{url('myorders')}}">My Orders</a></li>
                                    <li><a href="{{url('addressbooks')}}">Address Books</a></li>
                                    <li><a href="{{url('wishlist')}}">My Wishlist</a></li>
                                    <li><a href="{{url('changepassword')}}">Change Password</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('logout')}}">Logout</a></li>
                        </ul>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>
    <!-- Top Bar End-->
    <!-- Header Start-->


    <header class="header-row">
        <div class="container">
            <div class="table-container">
                <!-- Logo Start -->
                <div class="col-table-cell col-lg-4 col-md-4 col-sm-12 col-xs-12 inner">
                    <div id="logo">

                        <!--                <a href="index.html">
                                            <img class="img-responsive" src="image/logo.png" title="MarketShop" alt="MarketShop" />
                                        </a>-->
                    </div>

                </div>
                <!-- Logo End -->
                <!-- Search Start-->
                <div class="col-table-cell col-lg-5 col-md-5 col-md-push-0 col-sm-6 col-sm-push-6 col-xs-12">
                    <div id="search" class="input-group">
                        <form method="get" action="searchquery">
                        <input id="filter_name" type="text" name="search" value="" placeholder="Search" class="form-control input-lg" />
                        <button type="submit" class="button-search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <!-- Search End-->
                <!-- Mini Cart Start-->
                <?php
                $items = session('cartitems');
                $totalitems = $items['totalitems'];
                $totalprice = $items['totalprice'];
                $allitems = $items['items'];
                $response = json_decode($allitems, true);
                ?>
                <div class="col-table-cell col-lg-3 col-md-3 col-md-pull-0 col-sm-6 col-sm-pull-6 col-xs-12 inner">
                    <div id="cart">
                        <button type="button" data-toggle="dropdown" data-loading-text="Loading..." class="heading dropdown-toggle">
                            <span class="cart-icon pull-left flip"></span> 


                            <span id="cart-total">
                                <?php
                                echo $totalitems . ' item(s) - GHS ' . $totalprice;
                                ?>


                            </span>
                        </button>
                        <ul class="dropdown-menu">

                            <?php
                            if ($totalitems == 0) {
                                echo '  <p><center>Your cart is empty!</center>
                              <br/>
                        <center>Browse the store - find your favourite phones and more.</center>

                           </p>';
                            } else {

                                echo'
                                <table class="table">
                                    <tbody>';
                                foreach ($response as $value) {

                                    $total = $value['quantity'] * $value['price'];

                                    echo ' <tr>
                                            <td class="text-center"><a href="#">
                                            <img class="img-thumbnail" style="height:50px;width:50px;"  
                                            src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['url'] . '" ></a></td>
                                            <td class="text-left"><a href="#">' . $value['name'] . '</a></td>
                                            <td class="text-right"> ' . $value['quantity'] . '</td>
                                          
                                            <td class="text-right"> x ' . $value['price'] . '</td>
                                            <td class="text-right">GHS &nbsp;' . $total . '</td>
                                           
                                        </tr>';
                                }
                                echo ' </tbody>
                                </table>
                            </li>  <li>
                                <div>
                                    <table class="table table-bordered">
                                        <tbody>
                                            
                                            <tr>
                                                <td class="text-right"><strong>Total</strong></td>
                                                <td class="text-right">GHS &nbsp;' . $totalprice . '</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    ';
                                ?>
                                <p class="checkout"><a href="{{url('cart')}}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> View Cart</a>
                                    &nbsp;&nbsp;&nbsp;<a href= "{{url('checkout')}}"  class="btn btn-primary"><i class="fa fa-share"></i> Checkout</a></p>
<!--                                onclick="checkOut({{session('koalauser')}})"-->
                                        <?php
                                '</div>
                            </li>';
                                echo '</form>';
                            }
                            ?>
                        </ul>


                    </div>
                </div>
                <!-- Mini Cart End-->
            </div>
        </div>
    </header>
    <!-- Header End-->
    <!-- Main Menu Start-->
    <nav id="menu" class="navbar">
        <div class="container">
            <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a class="home_link" title="Home" href="{{ url('/') }}"><span>Home</span></a></li>

                    <li class="menu_brands dropdown"><a href="#">Categories</a>
                        <div class="dropdown-menu" >

                            <form method="POST" id="shoppingForm">
                                <div id="categorydiv">

                                    <?php
                                    $setupObj = session('setupdata');

                                    $categories = $setupObj['categories'];

                                    foreach ($categories as $value) {
                                        echo '<div class = "col-lg-1 col-md-2 col-sm-3 col-xs-6">' .
                                        '<a href = "#">' .
                                        '<input type = "checkbox" value = "' . $value['categoryID'] . '" name = "catids[]" id = "myCheckbox' . $value['categoryID'] . '" />' .
                                        '<label for = "myCheckbox' . $value['categoryID'] . '">' .
                                        ' <img src = "http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" height = "40" width = "40" title = "' . $value['name'] . '"/>' .
                                        '</label></a>' .
                                        '<a href = "#">' . $value['name'] . '</a>' .
                                        ' </div>';
                                    }
                                    ?>

                                </div>


                                {{ csrf_field() }}

                                <div class="row" id="creatediv" >
                                    <div class="col-lg-12">
                                        <div class="">

                                            <input type="submit"  class="btn btn-primary  btn-block" value="Go Shopping"/>

                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </li>
                    <li class="contact-link"><a href="{{ url('aboutus') }}">About Us</a></li>
                    <li class="contact-link "><a href="{{ url('contact') }}">Contact Us</a></li>
                    <li class="custom-link-right"><a href="{{ url('promotions') }}" target="_blank">Promotions</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <?php

   

    ?>
    <!-- Main Menu End-->
</div>