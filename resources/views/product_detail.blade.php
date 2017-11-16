@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.html" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="category.html" itemprop="url"><span itemprop="title">Electronics</span></a></li>
            <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="product.html" itemprop="url"><span itemprop="title">Laptop Silver black</span></a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Right Part Start -->
            <aside id="column-left" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Featured</h3>
                <div class="side-item">


                    <?php
                    $setupObj = session('setupdata');
                    $featured = $setupObj['featured'];

                    foreach ($featured as $value) {
                        ?>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="<?php echo $value['itemID'] ?>"><img src="http://tfs.knust.edu.gh/ecommerce/images/<?php echo $value['iconUrl'] ?>" alt=" <?php echo $value['name'] ?> " title=" <?php echo $value['name'] ?>" height="50" width="50" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="<?php echo $value['itemID'] ?>"><?php echo $value['name'] ?></a></h4>
                                <p class="price"> <span class="price-new">GHS <?php echo $value['promoPrice'] ?></span> 
                                </p>
                            </div>
                        </div>
                        <?php
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

                <h3 class="subtitle">Specials</h3>
                <div class="side-item">
                    <?php
                    $specials = $setupObj['discounted'];

                    foreach ($specials as $value) {
                        $price_diff = $value['price'] - $value['promoPrice'];
                        $savings = ($price_diff / $value['price']) * 100;
                        echo '  <div class="product-thumb clearfix">
                        <div class="image"><a href="' . $value['itemID'] . '">           <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"> <span class="price-new">GHS ' . $value['promoPrice'] . '</span> <span class="price-old">GHS ' . $value['price'] . '</span> <span class="saving">-' . round($savings, 2) . '%</span> </p>
                        </div>
                    </div>';
                    }
                    ?>
                </div>




            </aside>
            <!--Right Part End -->
            <!--Middle Part Start-->

            <div id="content" class="col-sm-9">
                <div itemscope itemtype="http://schema.org/Product">
                    <h1 class="title" itemprop="name">
                        {{$productinfo['name']}}
                    </h1>
                    <div class="row product-info">
                        <div class="col-sm-6">
                            <div class="image">
                                <img class="img-responsive" itemprop="image" id="zoom_01" 
                                     src="http://tfs.knust.edu.gh/ecommerce/images/{{$productinfo['iconUrl']}}"
                                     title="{{$productinfo['name']}}" alt="{{$productinfo['name']}}" 
                                     data-zoom-image="http://tfs.knust.edu.gh/ecommerce/images/{{$productinfo['iconUrl']}}" />

                            </div>

                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled description">
                                <li><b>Category:</b> <a href="#"><span itemprop="brand"> {{$productinfo['category']}}</span></a></li>
                                <li><b>Bar Code:</b> <span itemprop="mpn">{{$productinfo['barcode']}}</span></li>
                                <li><b>Availability:</b> 
                                    <?php
                                    if ($productinfo['inStock'] == 1) {
                                        echo '<span class="instock">In Stock</span>';
                                    }
                                    if ($productinfo['inStock'] == 0) {
                                        echo '<span class="nostock">Out Of Stock</span>';
                                    }
                                    ?>

                                </li>
                            </ul>
                            <ul class="price-box">
                                <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                    <?php
                                    if ($productinfo['promoPrice'] < $productinfo['price']) {
                                        echo '<span class="price-old">GHS ' . $productinfo['price'] . '</span>
                                         <span itemprop="price">GHS ' . $productinfo['promoPrice'] . '</span>';
                                    } else {
                                        echo '  <span itemprop="price">GHS ' . $productinfo['promoPrice'] . '</span>';
                                    }
                                    ?>

<!--                                    <span itemprop="availability" content="In Stock"></span>
                                    -->
                                </li>
                                <li></li>
                            </ul>
                            <div id="product">

                                <div class="cart">
                                    <form class="addproduct">

                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                                        <input type="hidden" name="productid" value="{{$productinfo['itemID']}}"/>
                                        <input type="hidden" name="price" value="{{$productinfo['price']}}"/>
                                        <input type="hidden" name="url" value="{{$productinfo['iconUrl']}}"/>
                                        <input type="hidden" name="productname" value="{{$productinfo['name']}}"/>
                                        <input type="hidden" name="instock" id="instock" value="{{$productinfo['inStock']}}"/>

                                        <div>
                                            <div class="qty">
                                                <label class="control-label" for="input-quantity">Qty</label>
                                                <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                                                <a class="qtyBtn plus" href="javascript:void(0);">+</a><br />
                                                <a class="qtyBtn mines" href="javascript:void(0);">-</a>
                                                <div class="clear"></div>
                                            </div>
                                            <button type="submit" id="button-cart" class="btn btn-primary btn-lg">Add to Cart</button>
                                        </div>
                                    </form>
                                    <div>
                                        <form class="addwishlist">
                                            <input type="hidden" name="productid" value="{{$productinfo['itemID']}}"/>
                                            <input type="hidden" name="productname" value="{{$productinfo['name']}}"/>
                                            <input type="hidden" name="userid" value="{{ session('koalauser')}}"/>

                                            <button type="submit" class="wishlist" onClick=""><i class="fa fa-heart"></i> Add to Wish List</button>
                                        </form> 
                                        <br />
                                    </div>

                                </div>
                            </div>
                            <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <meta itemprop="ratingValue" content="0" />
                                <p>
                                    <?php
                                    if ($productinfo['reviews']['averageRating'] == 5) {
                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                    }

                                    if ($productinfo['reviews']['averageRating'] == 4) {
                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                    }

                                    if ($productinfo['reviews']['averageRating'] == 3) {
                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">  </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                       <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                    }


                                    if ($productinfo['reviews']['averageRating'] == 2) {
                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                    }

                                    if ($productinfo['reviews']['averageRating'] == 1) {
                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                    }
                                    ?>
                                    <span itemprop="reviewCount"><?php echo $productinfo['reviews']['totalReviews'] ?> reviews</span>
                                </p>
                            </div>
                            <hr>

                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                        <li><a href="#tab-specification" data-toggle="tab">Ingredients</a></li>
                        <li><a href="#tab-review" data-toggle="tab">Reviews (<?php echo $productinfo['reviews']['totalReviews'] ?>)</a></li>
                    </ul>
                    <div class="tab-content">
                        <div itemprop="description" id="tab-description" class="tab-pane active">
                            {{$productinfo['description']}}
                        </div>
                        <div id="tab-specification" class="tab-pane">
                            {{$productinfo['ingredients']}}

                        </div>
                        <div id="tab-review" class="tab-pane">

                            <div id="review">
                                <div>
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                            <?php
                                            $reviews = $productinfo['reviews']['details'];
                                            if (sizeof($reviews) > 0) {
                                                foreach ($reviews as $review) {
                                                    if (empty($review['user'])) {
                                                        $user = 'Anomynous';
                                                    } else {
                                                        $user = $review['user'];
                                                    }
                                                    echo ' <tr>
           <td style="width: 50%;"><strong><span>' . $user . '</span></strong></td>
             <td class="text-right"><span>' . $review['dateAdded'] . '</span></td>
            </tr>
              <tr>
             <td colspan="2"><p>' . $review['comment'] . '</p>
            <div class="rating">';

                                                    if ($review['rating'] == 5) {
                                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                                    }

                                                    if ($review['rating'] == 4) {
                                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                                    }

                                                    if ($review['rating'] == 3) {
                                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">  </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                       <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                      <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                                    }


                                                    if ($review['rating'] == 2) {
                                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x">

                                        </i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                                    }

                                                    if ($review['rating'] == 1) {
                                                        echo ' <span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                        
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack">
                                     
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>';
                                                    }

                                                    ' </div></td>
                                                </tr>';
                                                }
                                            }
                                            ?>


                                        </tbody>
                                    </table>

                                </div>
                                <div class="text-right"></div>
                            </div>
                            <h2>Write a review</h2>

                            <form class="form-horizontal" id="reviewForm">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{$productinfo['itemID']}}" name="itemID">
                                <input type="hidden" value="{{session('koalauser')}}" id="userid" name="userid">

                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="input-review" class="control-label">Your Review</label>
                                        <textarea class="form-control" id="input-review" rows="5" name="comments"></textarea>
                                        <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label">Rating</label>
                                        &nbsp;&nbsp;&nbsp; Bad&nbsp;
                                        <input type="radio" value="1" name="rating">
                                        &nbsp;
                                        <input type="radio" value="2" name="rating">
                                        &nbsp;
                                        <input type="radio" value="3" name="rating">
                                        &nbsp;
                                        <input type="radio" value="4" name="rating">
                                        &nbsp;
                                        <input type="radio" value="5" name="rating">
                                        &nbsp;Good</div>
                                </div>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <input type="submit" class="btn btn-primary" id="button-review" value="Continue"/>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <h3 class="subtitle">Related Products</h3>
                    <div class="owl-carousel related_pro">
                        <?php
                        $relateditems = $productinfo['relatedItems'];

                        foreach ($relateditems as $value) {
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
                                echo '<span class="saving">-' . round($percentage, 2) . '%</span>';
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
                </div>
            </div>
            <!--Middle Part End -->

        </div>
    </div>
</div>
<!--Footer Start-->
@endsection
