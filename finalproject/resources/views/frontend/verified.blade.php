@extends('layouts.frontend.app')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <span>Verifikasi</span>
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
                <h4>Akun anda telah berhasil diverifikasi</h4>
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
