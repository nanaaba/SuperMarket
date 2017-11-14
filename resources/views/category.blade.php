@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="category.html">Electronics</a></li>
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
                            echo '  <li><a href="'.$value['categoryID'].'">' . $value['name'] . '</a> </li>';
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
                        echo '<div class="item"> <a href="../promotion/'.$value['promotionID'].'"><img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
                    }
                    ?>

                </div>

            </aside>
            <!--Left Part End -->
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
               
                <?php
               
               $detailsize = sizeof($details);
               $data=array();
               if($detailsize == 1){
                   $name = $details[0]['name'];
                   echo ' <h3 class="title"><strong>'.$name.'</strong><i> (items)</i></h3>';
               }
               if($detailsize > 1){
                   foreach ($details as $value) {
                      $data[]=$value['name']; 
                   }
                   
                   echo ' <h3 class="title"><strong>'.  implode($data, ',').'</strong><i> (items)</i></h3>';
               }
                ?>
                <div class="product-filter">
                    <div class="row">
                        <div class="col-md-4 col-sm-5">
                            <div class="btn-group">
                                <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                                <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                            </div>
                            </div>
                        <div class="col-sm-2 text-right">
                            <label class="control-label" for="input-sort">Sort By:</label>
                        </div>
                        <div class="col-md-3 col-sm-2 text-right">
                            <select id="input-sort" class="form-control col-sm-3">
                                <option value="" selected="selected">Default</option>
                                <option value="">Name (A - Z)</option>
                                <option value="">Name (Z - A)</option>
                                <option value="">Price (Low &gt; High)</option>
                                <option value="">Price (High &gt; Low)</option>
                                <option value="">Rating (Highest)</option>
                                <option value="">Rating (Lowest)</option>
                                <option value="">Model (A - Z)</option>
                                <option value="">Model (Z - A)</option>
                            </select>
                        </div>
                        <div class="col-sm-1 text-right">
                            <label class="control-label" for="input-limit">Show:</label>
                        </div>
                        <div class="col-sm-2 text-right">
                            <select id="input-limit" class="form-control">
                                <option value="" selected="selected">20</option>
                                <option value="">25</option>
                                <option value="">50</option>
                                <option value="">75</option>
                                <option value="">100</option>
                            </select>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row products-category">

                    <?php
                    $itemssize = sizeof($items);
                    if ($itemssize > 0) {
                        foreach ($items as $value) {

                            echo '  <div class="product-layout product-list col-xs-12">
                            <div class="product-thumb ">
                            <form class="addproduct">
                              
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                            <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                <input type="hidden" name="price" value="' . $value['promoPrice'] . '"/>
                                    <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>
                                    <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                        <input type="hidden" name="quantity" value="1"/>
                        <div class="image"><a href="../product/' . $value['itemID'] . '">
                            <img src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '" height="200" width="200" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="../product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"><span class="price-new"> GHS ' . $value['price'] . '</span>
                                 <span class="saving">-26%</span></p>
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
                       
                    </div></div>';
                        }
                    }else{
                        echo '<div class="alert alert-info"><i class="fa fa-check-circle"></i>No items found in this category</div>';
                    }
                    ?>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <ul class="pagination">
                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">&gt;</a></li>
                            <li><a href="#">&gt;|</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 text-right">Showing 1 to 12 of 15 (2 Pages)</div>
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->

@endsection
