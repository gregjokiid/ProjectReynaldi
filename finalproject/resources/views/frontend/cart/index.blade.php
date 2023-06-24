@extends('layouts.frontend.app')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <span>Keranjang</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('cart.update') }}" method="post">
                        @csrf
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['carts'] as $carts)
                                    <tr>
                                        <td class="cart__product__item">
                                            <img src="{{ asset($carts->Product->thumbnails_path) }}" alt="" width="90">
                                            <div class="cart__product__item__title">
                                                <h6>{{ $carts->Product->name }}</h6>
                                                <div class="rating">
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="cart__price">{{ $carts->Product->price_rupiah }}</td>
                                        <input type="hidden" name="cart_id[]" value="{{ $carts->id }}">
                                        <td class="cart__quantity">
                                            <div class="pro-qty">
                                                <input type="text" value="{{ $carts->qty }}" name="cart_qty[]">
                                            </div>
                                        </td>
                                        <td class="cart__total">{{ rupiah($carts->total_price_per_product) }}</td>
                                        <td class="cart__close"><a href="{{ route('cart.delete',$carts->id) }}"><span class="icon_close"></span></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{ route('product.index') }}">Lanjutkan belanja</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn update__btn">
                        @if(empty($carts))
                        @else
                            <button type="submit"><span class="icon_loading"></span> Perbarui keranjang</button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
            @if(empty($carts))
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
                <br/>
            @else
                <div class="row">
                    <div class="col-lg-6">
                    </div>
                    <div class="col-lg-4 offset-lg-2">
                        <div class="cart__total__procced">
                            <h6>Total keranjang</h6>
                            <ul>
                                <li>Total <span>{{ rupiah($data['carts']->sum('total_price_per_product')) }}</span></li>
                            </ul>
                            <form action="{{ route('checkout.offlineProcess') }}" class="checkout__form" method="POST">
                                @csrf
                                <button type="submit" class="site-btn">Konfirmasi</button>
                            </form>
                            <a href="{{ route('checkout.index') }}" class="primary-btn">Proses</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
