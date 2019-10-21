@extends('layouts.master')

@section('content')

<div id="container">
    <div class="container">
        <!-- Breadcrumb Start-->
        <ul class="breadcrumb">
            <li><a href="{{url('/')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        <!-- Breadcrumb End-->
        <div class="row">
            <!--Middle Part Start-->
            <div id="content" class="col-sm-12">
                <h1 class="title">About Us</h1>
                <div class="row">
                    <div class="col-lg-6">
                        <img src="{{ asset('image/koala.jpg')}}" width="550" height="350"/>
                    </div>
                    <div class="col-lg-6" style="font-size: 14px;">

                        <p>
                            We are a family-oriented supermarket that brings culinary adventure and diversity into the homes of our customers. 
                        </p>
                        <p>
                            Visit us and enjoy high- quality products from all over world. We are widely recognized as the first retail store in Ghana to meet international standards with experienced professionals ready and committed to provide quality goods and services to meet the needs of Ghanaians and foreigners who come into the country. 
                        </p>
                        <p>  
                        <blockquote>
                            Our main Objective is to meet the needs of people living in Ghana by providing them with quality goods and services which are internationally accepted.
                        </blockquote>
                        </p>
                        <p>
                            0263778212 (OSU), 0261512300 (AIRPORT), 0263011784 (CANTONMENTS)
                        </p>
                    </div>
                </div>

            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
@endsection
