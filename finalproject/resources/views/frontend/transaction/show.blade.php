@extends('layouts.frontend.app')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{ url('/') }}"><i class="fa fa-home"></i> Beranda</a>
                        <a href="{{ route('transaction.index') }}"> Transaksi</a>
                        <span>{{ $data['order']->invoice_number }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="shop-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice" style="border-top: 2px solid #6777ef;">
                        <div class="invoice-print">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="invoice-title">
                                        <h2>Invoice</h2>
                                        <div class="invoice-number">Order {{ $data['order']->invoice_number }}</div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Dibayar Oleh:</strong><br>
                                                {{ $data['order']->Customer->name }}<br>
                                                {{ $data['order']->Customer->email }}<br>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Dikirim Ke:</strong><br>
                                                {{ $data['order']->recipient_name }}<br>
                                                {{ $data['order']->address_detail }}<br>
                                                {{ $data['order']->destination }}
                                            </address>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                                <strong>Status Pesanan:</strong>
                                                <div class="mt-2">
                                                    {!! $data['order']->status_name !!}
                                                </div>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Tanggal Pesanan:</strong><br>
                                                {{ $data['order']->created_at }}<br><br>
                                            </address>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <div class="section-title font-weight-bold">Ringkasan Pesanan</div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-md">
                                            <tbody>
                                                <tr>
                                                    <th data-width="40" style="width: 40px;">#</th>
                                                    <th>Nama Produk</th>
                                                    <th class="text-center">Harga</th>
                                                    <th class="text-center">Jumlah</th>
                                                    <th class="text-right">Total</th>
                                                </tr>
                                                @foreach ($data['order']->orderDetail()->get() as $detail)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td><a
                                                                href="{{ route('product.show', ['categoriSlug' => $detail->Product->category->slug, 'productSlug' => $detail->Product->slug]) }}">{{ $detail->product->name }}</a>
                                                        </td>
                                                        <td class="text-center">{{ rupiah($detail->price) }}
                                                        </td>
                                                        <td class="text-center">{{ $detail->qty }}</td>
                                                        <td class="text-right">
                                                            {{ rupiah($detail->total_price_per_product) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mt-4">
                                        @if ($data['order']->status == 5 || $data['order']->status == 6 || $data['order']->status == 7)
                                            <div class="col-lg-8"></div>
                                        @else
                                            <div class="col-lg-8">
                                                <address>
                                                    <strong>Metode Pengiriman:</strong>
                                                    <div class="mt-2">
                                                        <p class="section-lead text-uppercase">{{ $data['order']->courier }}
                                                            {{ $data['order']->shipping_method }}</p>
                                                    </div>
                                                </address>
                                                @if ($data['order']->receipt_number != null)
                                                    <address>
                                                        <strong>{{ __('text.receipt_number') }}:</strong>
                                                        <div class="mt-2">
                                                            <p class="section-lead text-uppercase">
                                                                {{ $data['order']->receipt_number }}</p>
                                                        </div>
                                                    </address>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="col-lg-4 text-right">
                                            <div class="invoice-detail-item">
                                                @if ($data['order']->status == 5 || $data['order']->status == 6 || $data['order']->status == 7)
                                                    <div class="invoice-detail-name">Total</div>
                                                @else
                                                    <div class="invoice-detail-name">Subtotal</div>
                                                @endif
                                                <div class="invoice-detail-value">{{ rupiah($data['order']->subtotal) }}
                                                </div>
                                            </div>
                                            @if ($data['order']->status == 5 || $data['order']->status == 6 || $data['order']->status == 7)
                                            @else
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Ongkos Kirim</div>
                                                    @if($data['order']->shipping_cost == "offline")
                                                        <div class="invoice-detail-value">{{ rupiah("0") }}</div>
                                                    @else
                                                        <div class="invoice-detail-value">{{ rupiah($data['order']->shipping_cost) }}</div>
                                                    @endif
                                                </div>
                                                <hr class="mt-2 mb-2">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Total</div>
                                                    <div class="invoice-detail-value invoice-detail-value-lg">
                                                        {{ rupiah($data['order']->total_pay) }}</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($data['order']->status == 1 || $data['order']->status == 2 || $data['order']->status == 3)
                            <img src=" {{ $path.$file_path }}" alt="" width="1000">
                        @endif

                        @if(isset($data['order']->tracking))
                            @foreach($data['order']->tracking->data as $key => $order)
                                <h1>{{ucfirst($key)}}</h1>
                                @if($key == "history")
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Desc</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(array_reverse($order) as $thisKey => $value)
                                            <tr>
                                                <td>{{$value->date}}</td>
                                                <td>{{$value->desc}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <table class="table">
                                        <tbody>
                                        @foreach($order as $thisKey => $value)
                                            <tr>
                                                <th scope="row">{{ucfirst($thisKey)}}</th>
                                                <td>{{$value}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            @endforeach
                        @endif
                        <hr>
                        <div class="text-md-right">
                            <div class="float-lg-left mb-lg-0 mb-3">
                                <a href="{{ route('transaction.email', $data['order']->invoice_number) }}" class="btn btn-info btn-icon icon-left" id="pay-button"><i class="fa fa-envelope"></i>
                                    Kirim Invoice Ke Email</a>
                                @if ($data['order']->status == 0)
                                    <a href="{{ route('transaction.payment', $data['order']->invoice_number) }}" class="btn btn-primary btn-icon icon-left" id="pay-button"><i
                                            class="fa fa-credit-card"></i>
                                        Proses Pembayaran</a>
                                    <a href="{{ route('transaction.canceled', $data['order']->invoice_number) }}" class="btn btn-danger btn-icon icon-left"><i class="fa fa-times"></i>
                                        Batalkan Pesanan</a>
                                    <a href="{{ route('transaction.offline', $data['order']->invoice_number) }}" class="btn btn-warning btn-icon icon-left"><i class="fa fa-credit-card"></i>
                                        Bayar Offline</a>
                                @elseif ($data['order']->status == 2)
                                    <a href="{{ route('transaction.received', $data['order']->invoice_number) }}"
                                        class="btn btn-primary text-white btn-icon icon-left"><i
                                            class="fa fa-credit-card"></i>
                                        Pesanan Diterima</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
