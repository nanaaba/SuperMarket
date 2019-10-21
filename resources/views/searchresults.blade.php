@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Search Results</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">Search Results for ({{$searchparam}})</h1>
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

                                <option value="">Price (Low &gt; High)</option>
                                <option value="">Price (High &gt; Low)</option>

                            </select>
                        </div>
                       
                    </div>
                </div>
                <br/>

                 <div class="row products-category">

                    <?php
                    $itemssize = sizeof($results);
                    if ($itemssize > 0) {

                        $cartitems = session('cartitems');

                        $allitems = $cartitems['items'];
                        $response = json_decode($allitems, true);
                        $ids = array_column($response, 'id');

                        foreach ($results as $value) {
                            $price = $value['price'];
                            $promoprice = $value['promoPrice'];
                            $diff = $price - $promoprice;
                            $itemexist = in_array($value['itemID'], $ids);


                            echo '  <div class="product-layout product-list col-xs-12">
                            <div class="product-thumb ">
                            <form class="addproduct">
                              
                                <input type="hidden" name="_token" value="' . csrf_token() . '"/>
                                    <input type="hidden" name="instock" id="instock" value="' . $value['inStock'] . '"/>
                            <input type="hidden" name="productid" value="' . $value['itemID'] . '"/>
                                <input type="hidden" name="price" value="' . $value['promoPrice'] . '"/>
                                    <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>
                                    <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                        <input type="hidden" name="quantity" value="1"/>
                        <div class="image"><a href="../product/' . $value['itemID'] . '">
                            <img src="http://18.217.149.24/ecommerce/images/' . $value['iconUrl'] . '" height="200" width="200" alt="' . $value['name'] . '" title="' . $value['name'] . '" class="img-responsive" /></a></div>
                        <div class="caption">
                            <h4><a href="../product/' . $value['itemID'] . '">' . $value['name'] . '</a></h4>
                            <p class="price"><span class="price-new"> GHS ' . $value['promoPrice'] . '</span>';
                            if ($diff > 0) {
                                $percentage = ($diff / $price) * 100;
                                echo '<span class="saving">-' . round($percentage, 2) . '%</span>';
                            }

                            echo ' </p>
                        </div>
                        <div class="button-group">';
                        if($itemexist ==1){
                            echo' <button class="btn-primary " type="button" onclick="removeItem('.$value['itemID'].',\''. $value['name'].'\')" ><span>Remove From Cart</span></button>';
                          
                        }else{
                            echo' <button class="btn-primary" type="submit" ><span>Add to Cart</span></button>';
                          
                        }
                        echo'
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
                    } else {
                        echo '<div class="alert alert-info"><i class="fa fa-check-circle"></i>No items found in this category</div>';
                    }
                    ?>

                </div>
                <div class="row">
                    <div class="col-sm-6 text-left">
                        <ul class="pagination">
                            {!! $results->render() !!}
<!--                            <li class="active"><span>1</span></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">&gt;</a></li>
                            <li><a href="#">&gt;|</a></li>-->
                        </ul>
                    </div>
                    
                </div>
            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
@endsection
