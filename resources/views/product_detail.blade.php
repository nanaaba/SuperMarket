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
                                <p class="price"> <span class="price-new">GHS <?php echo $value['price'] ?></span> 
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
                    foreach ($featured as $value) {
                        ?>
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="product.html"><img src="{{asset("image/product/macbook_pro_1-50x50.jpg")}}" alt=" Strategies for Acquiring Your Own Laptop " title=" Strategies for Acquiring Your Own Laptop " class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="product.html">Strategies for Acquiring Your Own Laptop</a></h4>
                                <p class="price"> <span class="price-new">$1,400.00</span> <span class="price-old">$1,900.00</span> <span class="saving">-26%</span> </p>
                            </div>
                        </div>
                        <?php
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
                                <li><b>Availability:</b> <span class="instock">In Stock</span></li>
                            </ul>
                            <ul class="price-box">
                                <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
<!--                                    <span class="price-old">$1,202.00</span>-->
                                    <span itemprop="price">GHS {{$productinfo['price']}}
                                        <span itemprop="availability" content="In Stock"></span></span></li>
                                <li></li>
                            </ul>
                            <div id="product">

                                <div class="cart">
                                    <form class="addproduct">

                                        <input type="hidden" name="_token" value="<?php echo csrf_token() ?>"/>
                                        <input type="hidden" name="productid" value="{{$productinfo['barcode']}}"/>
                                        <input type="hidden" name="price" value="{{$productinfo['price']}}"/>
                                        <input type="hidden" name="url" value="{{$productinfo['iconUrl']}}"/>
                                        <input type="hidden" name="productname" value="{{$productinfo['name']}}"/>

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
                                        <div>
                                            <button type="button" class="wishlist" onClick=""><i class="fa fa-heart"></i> Add to Wish List</button>
                                            <br />
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                <meta itemprop="ratingValue" content="0" />
                                <p><span class="fa fa-stack">
                                        <i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i>
                                    </span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x">

                                        </i><i class="fa fa-star-o fa-stack-1x"></i></span>
                                    <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i>
                                        <i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="$('a[href=../../../index.html#tab-review\']').trigger('click');
                                                return false;" href=""><span itemprop="reviewCount">1 reviews</span></a> / 
                                    <a onClick="$('a[href=../../../index.html#tab-review\']').trigger('click');
                                            return false;" href="">
                                        Write a review</a></p>
                            </div>
                            <hr>

                        </div>
                    </div>
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                        <li><a href="#tab-specification" data-toggle="tab">Ingredients</a></li>
                        <li><a href="#tab-review" data-toggle="tab">Reviews (2)</a></li>
                    </ul>
                    <div class="tab-content">
                        <div itemprop="description" id="tab-description" class="tab-pane active">
                            {{$productinfo['description']}}
                        </div>
                        <div id="tab-specification" class="tab-pane">
                            {{$productinfo['ingredients']}}

                        </div>
                        <div id="tab-review" class="tab-pane">
                            <form class="form-horizontal">
                                <div id="review">
                                    <div>
                                        <table class="table table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 50%;"><strong><span>harvey</span></strong></td>
                                                    <td class="text-right"><span>20/01/2016</span></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                                                        <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="text-right"></div>
                                </div>
                                <h2>Write a review</h2>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="input-name" class="control-label">Your Name</label>
                                        <input type="text" class="form-control" id="input-name" value="" name="name">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label for="input-review" class="control-label">Your Review</label>
                                        <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
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
                                        <button class="btn btn-primary" id="button-review" type="button">Continue</button>
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
                </div>
            </div>
            <!--Middle Part End -->

        </div>
    </div>
</div>
<!--Footer Start-->
@endsection
