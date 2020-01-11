@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Electronics</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Left Part Start -->
            <aside id="column-left" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Categories</h3>
                <div class="box-category">
                    <ul id="cat_accordion">

                        <?php
                       echo 'uuuuuuuuuuuuu'.  $url = config('constants.TEST_URL');

     //   $baseurl = $url . '/categories/' . $catid . '/items';

                        $setupObj = session('setupdata');
                        $categories = $setupObj['categories'];

                        foreach ($categories as $value) {
                            echo '  <li><a href="../category/' . $value['categoryID'] . '">' . $value['name'] . '</a> </li>';
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
                        <div class="image"><a href="product/' . $value['itemID'] . '">           <img src="http://18.217.149.24/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
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
                        echo '<div class="item"> <a href="' . $value['promotionID'] . '"><img src="http://18.217.149.24/ecommerce/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
                    }
                    ?>

                </div>

            </aside>
            <div id="content" class="col-sm-9">
                <?php
                if (sizeof($promodata) > 0) {


                    $categories = $promodata[0]['categories'];
                    $categoriessize = sizeof($categories);

                    $items = $promodata[0]['items'];
                    $itemssize = sizeof($items);
                    ?>
                    <!--Left Part End -->
                    <!--Middle Part Start-->

                    <h1> {{$promodata[0]['name']}} </h1>

                    <h5 >Promotion runs from <strong> {{$promodata[0]['startDate']}}  to {{$promodata[0]['expiryDate']}} </strong> </h5>

                    <?php
                    if ($promodata[0]['bannerUrl'] != null) {
                        echo '   <div class="item"> <a href="#"><img class="img-responsive" src="http://18.217.149.24/ecommerce/images/' . $value['bannerUrl'] . '" alt="banner 1" style="width:100%" height="170" /></a></div>
                        ';
                    }
                    ?>
                    <br><br>
                    <?php
                    if ($categoriessize > 0) {
                        echo '<h3 class="subtitle">Categories On Promo</h3>
                      
                        
                        <div class="owl-carousel product_carousel">';
                        foreach ($categories as $value) {

                            echo '<div class="product-thumb clearfix">
                              <div class="image"><a href="../category/' . $value['categoryID'] . '">
                            <img src="http://18.217.149.24/ecommerce/images/' . $value['iconUrl'] . '" height="100" width="100" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="../category/' . $value['categoryID'] . '">' . $value['name'] . '</a></h4>
                           </div>
                        
                    </div>';
                        }
                        echo '</div>';
                    }
                    ?>
                    <br>
                    <br>
                    <?php
                    if ($itemssize > 0) {
                        echo '<h3 class="subtitle">Items on Promo</h3>'
                        . '<div class="owl-carousel product_carousel">';
                        foreach ($items as $value) {

                            echo '<div class="product-thumb clearfix">
                            <form class="addproduct">
                              
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                <input type="hidden" name="price" value="' . $value['promoPrice'] . '"/>
                                    <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>
                                    <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                        <input type="hidden" name="quantity" value="1"/>
                        <div class="image"><a href="product/' . $value['itemID'] . '">
                            <img src="http://18.217.149.24/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"><span class="price-new"> GHS ' . $value['price'] . '</span></p>
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
                        echo '</div>';
                    } else {
                        echo '<div class="alert alert-info"><i class="fa fa-check-circle"></i>No items found in this promotion</div>';
                    }
                    ?>





                </div>
                <!-- Bestsellers Product Start-->
                <?php
            } else {
                echo '<div class="alert alert-info"><i class="fa fa-check-circle"></i>No items found in this promotion</div>';
            }
            ?>
        </div>

        <!--Middle Part End -->
    </div>
</div>
</div>
<!--Footer Start-->

@endsection
