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
                    <div class="col-lg-5">
                        <img src="{{ asset('image/About-us.png')}}" width="450" height="450"/>
                    </div>
                    <div class="col-lg-7" >

                        <p>
                            We are a dynamic team driven by our love for fashion, design and marketing of
                            lifestyle products. Inherently projecting the image of Africa to a global audience.
                            Established in 2018, MAVA Industries was set-up with the aim of disrupting the
                            African garment and apparel market by providing a diverse array of quality, trendy,
                            affordable and sustainable clothing using technology as an enabler.
                        </p>
                        <p>
                            Our flagship brands MAVA, and HUNTSMAN targets the modern trendy woman and
                            man with a sense of purpose and achievement. Our primary mode of reaching our
                            target audience is online.
                        </p>
                        <p>
                            Both brands have been influenced by the backgrounds of its founders and pay
                            homage to different cultures within African continent, showcasing its diversity to a
                            global audience.</p>
                        <p>
                            MAVA, derived from the Swahili word MAVAZI, meaning ‘Pleasant’ and ‘Clothing’. The brand phonetics 
                            depicts a slang that pays homage to Mother, which forms the basis of all life forms and also translates to 
                            the representation of effortless and timeless fashion designs for women. The HUNTSMAN brand is a lifestyle 
                            representation of the modern African male infused with the alpha-male mentality of playing the domineering 
                            role in shaping his surroundings. Our enduring purpose is to inspire to dream of a better more fulfilled life.
                            The future for us is exciting!  </p>
                    </div>
                </div>

            </div>
            <!--Middle Part End -->
        </div>
    </div>
</div>
@endsection
