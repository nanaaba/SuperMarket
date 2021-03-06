@extends('layouts.master')

@section('content')


<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="fa fa-home"></i></a></li>
            <li><a href="contact-us.html">Contact Us</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-9">
                <h1 class="title">Contact Us</h1>
                <h3 class="subtitle">Our Location</h3>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="fa fa-map-marker"></i></div>
                            <div class="contact-detail">
                                <h4>Location</h4>
                                <address>
                                    Patrice Lumumba Rd, <br>
                                    Airport Residential Area<br>
                                    Accra, Ghana
                                </address>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="fa fa-phone"></i></div>
                            <div class="contact-detail">
                                <h4>Telephone</h4>
                                Call: 024 339 6666<br>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="contact-info">
                            <div class="contact-info-icon"><i class="fa fa-clock-o"></i></div>
                            <div class="contact-detail">
                                <h4>Opening Times</h4>
                                7:30AM - 9:00PM  </div>
                        </div>
                    </div>
                </div>
                <form class="form-horizontal">
                    <fieldset>
                        <h3 class="subtitle">Send us an Email</h3>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-name">Your Name</label>
                            <div class="col-md-10 col-sm-9">
                                <input type="text" name="name" value="" id="input-name" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                            <div class="col-md-10 col-sm-9">
                                <input type="text" name="email" value="" id="input-email" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-2 col-sm-3 control-label" for="input-enquiry">Enquiry</label>
                            <div class="col-md-10 col-sm-9">
                                <textarea name="enquiry" rows="10" id="input-enquiry" class="form-control"></textarea>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right">
                            <input class="btn btn-primary" type="submit" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
            <aside id="column-right" class="col-sm-3 hidden-xs">
                <div class="list-group">
                    <h2 class="subtitle">About Us </h2>
                    <p>
                       We are a dynamic team driven by our love for fashion, design and marketing of
                            lifestyle products. Inherently projecting the image of Africa to a global audience.
                            Established in 2018, MAVA Industries was set-up with the aim of disrupting the
                            African garment and apparel market by providing a diverse array of quality, trendy,
                            affordable and sustainable clothing using technology as an enabler.
                         </p>
                   
                </div>

                <h2 class="subtitle">Promotions </h2>
                <div class="banner owl-carousel">
                    <?php
                              $url = config('constants.TEST_URL');
                    $setupObj = session('setupdata');

                    $promotions = $setupObj['promotions'];

                    foreach ($promotions as $value) {
                        echo '<div class="item"> <a href="../promotion/' . $value['promotionID'] . '"><img src="'.$url.'/images/' . $value['bannerUrl'] . '"" alt="small banner1" class="img-responsive" /></a> </div>';
                    }
                    ?> </div>

            </aside>
            <!--Middle Part End -->
        </div>
    </div>
</div>
<!--Footer Start-->

@endsection
