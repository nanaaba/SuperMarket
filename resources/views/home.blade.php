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
                            echo '  <li><a href="category/' . $value['categoryID'] . '">' . $value['name'] . '</a> </li>';
                        }
                        ?>

                    </ul>
                </div>

                <h3 class="subtitle">Specials</h3>
                <div class="side-item">


                    <?php
                    $specials = $setupObj['discounted'];

                    foreach ($specials as $value) {
                        $price_diff = $value['price'] - $value['promoPrice'];
                        $savings = ($price_diff / $value['price']) * 100;
                        echo '  <div class="product-thumb clearfix">
                        <div class="image"><a href="product/' . $value['itemID'] . '">           <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"> <span class="price-new">GHS ' . $value['promoPrice'] . '</span> <span class="price-old">GHS ' . $value['price'] . '</span> <span class="saving">-' . round($savings, 2) . '%</span> </p>
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
                        echo '<div class="item"> <a href="promotion/' . $value['promotionID'] . '"><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
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
                         $price = $value['price'];
                        $promoprice = $value['promoPrice'];
                        $diff = $price - $promoprice;


                        echo '<div class="product-thumb clearfix">
                            <form class="addproduct">
                              
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                <input type="hidden" name="price" value="' . $value['promoPrice'] . '"/>
                                    <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>
                                    <input type="hidden" name="instock" id="instock" value="' . $value['inStock'] . '"/>
                                   
<input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                        <input type="hidden" name="quantity" value="1"/>
                        <div class="image"><a href="product/' . $value['itemID'] . '">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"><span class="price-new"> GHS ' . $value['price'] . '</span>';
                         if ($diff > 0) {
                                $percentage = ($diff / $price) * 100;
                                echo '<span class="saving">-' . round($percentage, 2)  . '%</span>';
                                
                            }
                        echo'    </p>
                        </div>
                        <div class="button-group">
                            <button class="btn-primary" type="submit" ><span>Add to Cart</span></button>
                           
                            </div>
                             </form>
                            <div class="button-group">
                              <div class="add-to-links">
                               <form class="addwishlist">
                                    <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                    <input type="hidden" name="productname" value="' . $value['name'] . '"/>
  <input type="hidden" name="userid" value="' . session('koalauser') . '"/>

                                <button type="submit" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                            </form>                              
        <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                            </div>
                        </div>
                       
                    </div>';
                    }
                    ?>



                </div>
                <!-- Bestsellers Product Start-->

                <h3 class="subtitle">Favourites</h3>

                <?php
                $userid = session('koalauser');
                $usercategories = session('usercategories');
                $usercategories_size = sizeof($usercategories);
                ?>
                <div class="owl-carousel product_carousel">

                    <?php
                    if (empty($userid) || $usercategories_size == 0) {
                        $favourites = $setupObj['categories'];

                        foreach ($favourites as $value) {

                            echo '<div class="product-thumb clearfix">
                              <div class="image"><a href="category/' . $value['categoryID'] . '">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" height="100" width="100" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="category/' . $value['categoryID'] . '">' . $value['name'] . '</a></h4>
                           </div>
                        
                    </div>';
                        }
                    }

                    if ($usercategories_size > 0) {
                        foreach ($usercategories as $value) {

                            echo '<div class="product-thumb clearfix">
                              <div class="image"><a href="category/' . $value['categoryID'] . '">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" height="100" width="100" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="category/' . $value['categoryID'] . '">' . $value['name'] . '</a></h4>
                           </div>
                        
                    </div>';
                        }
                    }
                    ?>


                </div>





                <!-- Featured Product End-->
                <!-- Banner Start-->

                <!-- Banner End-->

                <!-- Categories Product Slider Start -->

                <!-- Categories Product Slider End -->
                <!-- Banner Start -->
                <!--                <div class="marketshop-banner">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <a href="#"><img title="1 Block Banner" alt="1 Block Banner" src="image/banner/1blockbanner-1140x75.jpg"></a></div>
                                    </div>
                                </div>-->
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
