@extends('layouts.frontend.app')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <span>Kontak</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.0118517608125!2d112.7416719752892!3d-7.239485992766832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f916da0110cd%3A0xc31f1ae503f20ab0!2sJl.%20Sambongan%20IV%20No.11%2C%20RT.002%2FRW.05%2C%20Bongkaran%2C%20Kec.%20Pabean%20Cantikan%2C%20Surabaya%2C%20Jawa%20Timur%2060161!5e0!3m2!1sen!2sid!4v1684997788135!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="col-lg-4 col-md-4 col-sm-4 p-0 ">
                    <div class="categories__item">
                        <div class="categories__text">
                            <h4>Kiat Teknik Surabaya</h4>
                            <p>Jl. Sambongan IV No.11</p>
                            <p>082232769157</p>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <br/>
            <br/>
        </div>
@endsection
