@extends('layouts.frontend.app')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <a href="{{ route('category.index') }}">Kategori</a>
                        <a href="{{ route('category.show',$data['product']->Category->slug) }}">{{ $data['product']->Category->name }}</a>
                        <span>{{ $data['product']->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <a href="{{ $data['product']->thumbnails_path }}" class="image-popup">
                                    <image data-hash="product-1" class="product__big__img" src="{{ asset($data['product']->thumbnails_path) }}" alt=""></image>
                                </a>

                                <a href="{{ $data['product']->thumbnails_path2 }}" class="image-popup">
                                    <image data-hash="product-1" class="product__big__img" src="{{ asset($data['product']->thumbnails_path2) }}" alt=""></image>
                                </a>

                                <a href="{{ $data['product']->thumbnails_path3 }}" class="image-popup">
                                    <image data-hash="product-1" class="product__big__img" src="{{ asset($data['product']->thumbnails_path3) }}" alt=""></image>
                                </a>

                                <a href="{{ $data['product']->thumbnails_path4 }}" class="image-popup">
                                    <image data-hash="product-1" class="product__big__img" src="{{ asset($data['product']->thumbnails_path4) }}" alt=""></image>
                                </a>

                                <a href="{{ $data['product']->thumbnails_path5 }}" class="image-popup">
                                    <image data-hash="product-1" class="product__big__img" src="{{ asset($data['product']->thumbnails_path5) }}" alt=""></image>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3>{{ $data['product']->name }} <span>Kategori: {{ $data['product']->Category->name }}</span></h3>
                        <span>Stok: {{ $data['product']->stock }}</span>
                        <form action="{{ route('cart.store') }}" method="POST">
                        <div class="product__details__price">{{ rupiah($data['product']->price) }} <span></div>
                        @csrf
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Jumlah:</span>
                                <div class="pro-qty">
                                    <input type="number" name="cart_qty" value="1" min="1" max="{{ $data['product']->stock }}">
                                </div>
                                <input type="hidden" name="cart_product_id" value="{{ $data['product']->id }}">
                                <input type="hidden" name="cart_price" value="{{ $data['product']->price }}">
                            </div>
                            @if(empty($data['product']->stock))
                            @else
                                <button type="submit" class="cart-btn"><span class="icon_bag_alt"></span> Tambah Ke Keranjang</button>
                            @endif
                        </div>
                        <div class="product__details__widget">
                        </form>
                            <ul>
                                <li>
                                    <span>Berat : </span>
                                    <p>{{ $data['product']->weight }} Gram</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Deskripsi Produk</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Deskripsi Produk</h6>
                                {!! $data['product']->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>Produk Lainnya</h5>
                    </div>
                </div>
               @foreach ($data['product_related'] as $product_related)
               <div class="col-lg-3 col-md-4 col-sm-6">
                @component('components.frontend.product-card')
                @slot('image', asset('storage/' . $product_related->thumbnails))
                @slot('route', route('product.show', ['categoriSlug' => $product_related->Category->slug, 'productSlug' =>
                    $product_related->slug]))
                    @slot('name', $product_related->name)
                    @slot('price', $product_related->price)
                @endcomponent
                </div>
               @endforeach
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
@endsection
