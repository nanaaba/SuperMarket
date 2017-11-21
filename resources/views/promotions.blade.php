@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Promotions</a></li>

        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Left Part Start -->
            <aside id="column-left" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Categories</h3>
                <div class="box-category">
                    <ul id="cat_accordion">

                        <?php
                        $setupObj = session('setupdata');
                        $categories = $setupObj['categories'];

                        foreach ($categories as $value) {
                            echo '  <li><a href="' . $value['categoryID'] . '">' . $value['name'] . '</a> </li>';
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
                        <div class="image"><a href="../product/' . $value['itemID'] . '">           <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="../product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
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
                        echo '<div class="item"> <a href="../promotion/' . $value['promotionID'] . '"><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
                    }
                    ?>

                </div>

            </aside>
            <!--Left Part End -->
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                 <h1> All Promotions</h1>

                <div class="marketshop-banner">
                    <div class="row">
                        <?php
                        //print_r(sizeof($promotions));
                        foreach ($promotions as $value) {
                            echo ' <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <a href="promotion/'.$value['promotionID'] .'">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '"></a></div>
             ';
                        }
                        ?>


                    </div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->

@endsection
