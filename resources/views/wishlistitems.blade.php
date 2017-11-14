@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="#">Account</a></li>
            <li><a href="wishlist.html">My Wish List</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <?php
            $items = $bags['items'];

            $itemssize = sizeof($items);
            ?>
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <h1 class="title">{{$bags['name']}} WishList</h1>
                <p class="lead">Hello, <strong>{{session('fullname')}}!</strong>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td class="text-center">Image</td>
                                <td class="text-center">Product Name</td>
                                <td class="text-center">Category</td>
                                <td class="text-center">Stock</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Action</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($itemssize > 0) {
                                foreach ($items as $value) {
                                    if ($value['inStock'] == 1) {
                                        $stock = '<span class="instock">In Stock</span>';
                                    }
                                    if ($value['inStock'] == 0) {
                                        $stock = '<span class="nostock">Out Of Stock</span>';
                                    }

                                    echo '<form class="addproduct" method="post">
                                                                    <input type="hidden" name="_token" value="' . csrf_token() . '"/>

       <tr>
                                            <td class="text-center">
                                            <a href="#"><img class="img-thumbnail" style="height:50px;width:50px;" 
                                            src="http://tfs.knust.edu.gh/ecommerce/images/' . $value['iconUrl'] . '"></a></td>
                                            <td class="text-center"><a href="#">' . $value['name'] . '</a></td>
                                              <td class="text-center">' . $value['category'] . '</td>
                                    <td class="text-center">' . $stock . '</td>
                                              <td class="text-left">
                                              <div class="input-group btn-block quantity">
                                                    <input type="text" name="quantity" value="1" size="1" class="form-control" />
                                                     <input type="hidden" name="productid" value="' . $value['itemID'] . '" />
                                          <input type="hidden" name="url" value="' . $value['iconUrl'] . '"/>

                                                         <input type="hidden" name="productname" value="' . $value['name'] . '"/>
                                                             <input type="hidden" name="price" value="' . $value['price'] . '" />
                                                           <span class="input-group-btn">
                                                         </span></div>
                                                         </td>
                                                             <td class="text-right"><div class="price"> GHS ' . $value['price'] . '</div></td>
                                <td class="text-right"><button class="btn btn-primary" title="" data-toggle="tooltip" type="submit" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                                    <button class="btn btn-danger" onclick="removeItemWishlist(' . $value['itemID'] . ',' . $bags['bagID'] . ')" data-toggle="tooltip" type="button"  data-original-title="Remove"><i class="fa fa-times"></i></button></td>
                           
                                         </tr></form>';
                                }
                            }
                            ?>



                        </tbody>
                    </table>
                </div>




            </div>

            <aside id="column-right" class="col-sm-3 hidden-xs">
                <h3 class="subtitle">Account</h3>
                <div class="list-group">
                    <ul class="list-item">
                        <li><a href="{{url('logout')}}">Logout</a></li>
                        <li><a href="{{url('changepassword')}}">Change Password</a></li>
                        <li><a href="{{url('myaccount')}}">My Account</a></li>
                        <li><a href="{{url('addressbooks')}}">Address Books</a></li>
                        <li><a href="{{url('wishlist')}}">Wish List</a></li>
                        <li><a href="{{url('myorders')}}">Order History</a></li>
                        <li><a href="{{url('newsletters')}}">Newsletter</a></li>

                    </ul>
                </div>
            </aside>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->

@endsection
