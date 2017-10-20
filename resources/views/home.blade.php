@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <div class="row">
            <!-- Left Part Start-->
            <aside id="column-left" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Categories</h3>
                <div class="box-category">
                    <ul id="cat_accordion">

                        <?php
                        $setupObj = session('setupdata');
                        $categories = $setupObj['categories'];

                        foreach ($categories as $value) {
                            echo '  <li><a href="category">' . $value['name'] . '</a> </li>';
                        }
                        ?>

                    </ul>
                </div>

                <h3 class="subtitle">Specials</h3>
                <div class="side-item">


                    <?php
                    $specials = $setupObj['featured'];

                    foreach ($specials as $value) {

                        echo '  <div class="product-thumb clearfix">
                        <div class="image"><a href="product.html"><img src="image/product/macbook_pro_1-50x50.jpg" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">Strategies for Acquiring Your Own Laptop</a></h4>
                            <p class="price"> <span class="price-new">$1,400.00</span> <span class="price-old">$1,900.00</span> <span class="saving">-26%</span> </p>
                        </div>
                    </div>';
                    }
                    ?>


                </div>

                <h3 class="subtitle">Promotions</h3>

                <div class="banner owl-carousel">
                    <?php
                    $promotions = $setupObj['promotions'];

                    foreach ($promotions as $value) {
                        echo '<div class="item"> <a href="#"><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
                    }
                    ?>

                </div>

            </aside>
            <!-- Left Part End-->

            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <div class="row">
                    <div>
                        <!-- Slideshow Start-->
                        <div class="slideshow single-slider owl-carousel">

                            <?php
                            $banners = $setupObj['banners'];

                            foreach ($banners as $value) {
                                echo '   <div class="item"> <a href="#"><img class="img-responsive" src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '" alt="banner 1" /></a></div>
                        ';
                            }
                            ?>

                        </div>
                        <!-- Slideshow End-->
                    </div>

                </div>

                <h3 class="subtitle">Featured</h3>
                <div class="owl-carousel product_carousel">
                    <?php
                    $featureditems = $setupObj['featured'];

                    foreach ($featureditems as $value) {

                        echo '<div class="product-thumb clearfix">
                            <form class="addproduct">
                              
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                <input type="hidden" name="price" value="' . $value['price'] . '"/>
                                    <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>
                                    <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                        <input type="hidden" name="quantity" value="1"/>
                        <div class="image"><a href="product/' . $value['itemID'] . '">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product.html">' . $value['name'] . '</a></h4>
                            <p class="price"><span class="price-new"> GHS ' . $value['price'] . '</span></p>
                        </div>
                        <div class="button-group">
                            <button class="btn-primary" type="submit" ><span>Add to Cart</span></button>
                            <div class="add-to-links">
                                <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                                <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                        </form>
                    </div>';
                    }
                    ?>



                </div>
                <!-- Bestsellers Product Start-->
                
                  <h3 class="subtitle">Favourites</h3>
                <div class="owl-carousel product_carousel">
                    <?php
                       $favourites = $setupObj['categories'];

                    foreach ($favourites as $value) {

                        echo '<div class="product-thumb clearfix">
                              <div class="image"><a href="#">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" height="100" width="100" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="#">' . $value['name'] . '</a></h4>
                           </div>
                        
                    </div>';
                    }
                    ?>



                </div>
               

         


                <!-- Featured Product End-->
                <!-- Banner Start-->

                <!-- Banner End-->

                <!-- Categories Product Slider Start -->

                <!-- Categories Product Slider End -->
                <!-- Banner Start -->
                <div class="marketshop-banner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="1 Block Banner" alt="1 Block Banner" src="image/banner/1blockbanner-1140x75.jpg"></a></div>
                    </div>
                </div>
                <!-- Banner End -->

            </div>
            <!--Middle Part End-->
        </div>
    </div>
</div>
<!-- Feature Box Start-->
<div class="container">
    <div class="custom-feature-box row">
        <div class="col-sm-4 col-xs-12">
            <div class="feature-box fbox_1">
                <div class="title">Free Shipping</div>
                <p>Free shipping on order over $1000</p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="feature-box fbox_3">
                <div class="title">Gift Cards</div>
                <p>Give the special perfect gift</p>
            </div>
        </div>
        <div class="col-sm-4 col-xs-12">
            <div class="feature-box fbox_4">
                <div class="title">Reward Points</div>
                <p>Earn and spend with ease</p>
            </div>
        </div>
    </div>
</div>
<!-- Feature Box End-->



@endsection
