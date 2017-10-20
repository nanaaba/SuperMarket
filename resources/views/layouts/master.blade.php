<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">


        <meta name="_token" content="{{ csrf_token() }}">

        <title>SuperMarket</title>


        <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap/css/bootstrap.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/css/font-awesome.min.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsive.css')}}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet-skin3.css')}}" />
                <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.css')}}" />

        <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
        
        <!-- CSS Part End-->
    

    </head>
    <div class="wrapper-wide">

        @include('layouts.header')

        <div class="be-loading loader ">
                @yield('content')



                <!-- Here goes your content -->

                <div class="be-spinner ">
                    <svg width="40px" height="40px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle fill="none" stroke-width="4" stroke-linecap="round" cx="33" cy="33" r="30" class="circle"></circle>
                    </svg>
                </div>
           
            </div>

        @include('layouts.footer')


    </div>
    
    
    
</html>