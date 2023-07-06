@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <form action="{{ route('feature.order.accept', $data['order']->id) }}" method="get">
            <div class="col-md-12">
                <div class="invoice">
                    <div class="invoice-print">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-md-right">
                                    <div class="mb-lg-0 mb-3">
                                        <a href="{{ route('feature.order.index') }}"
                                           class="btn btn-success btn-icon icon-left"><i class="fa fa-arrow-left"></i>
                                            Kembali</a>
                                        @if ($data['order']->status == 1)
                                            <!-- <a href="{{ route('feature.order.accept', $data['order']->id) }}" class="btn btn-primary btn-icon icon-left"><i class="fa fa-check"></i>
                                            Terima</a> -->
                                            <button class="btn btn-primary btn-icon icon-left"><i class="fa fa-check"></i>
                                                Terima</button>
                                            <a href="{{ route('feature.order.refuse', $data['order']->id) }}"
                                               class="btn btn-danger btn-icon icon-left"><i class="fa fa-times"></i>
                                                Tolak</a>
                                        @endif
                                        @if ($data['order']->status == 6)
                                            <a href="{{ route('feature.order.payOffline', $data['order']->id) }}"
                                               class="btn btn-primary btn-icon icon-left"><i class="fa fa-check"></i>
                                                Proses</a>
                                        @endif
                                    </div>
                                </div>
                                <hr class="mb-2">
                                <div class="invoice-title">
                                    <h2>Invoice</h2>
                                    <div class="invoice-number">{{ $data['order']->invoice_number }}</div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>{{ __('text.billed_to') }}:</strong><br>
                                            {{ $data['order']->Customer->name }}<br>
                                            {{ $data['order']->Customer->email }}<br>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>{{ __('text.shipped_to') }}:</strong><br>
                                            {{ $data['order']->recipient_name }}<br>
                                            {{ $data['order']->address_detail }}<br>
                                            {{ $data['order']->destination }}
                                        </address>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <address>
                                            <strong>{{ __('text.order_status') }}:</strong>
                                            <div class="mt-2">
                                                {!! $data['order']->status_name !!}
                                            </div>
                                        </address>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <address>
                                            <strong>{{ __('text.order_date') }}:</strong><br>
                                            {{ $data['order']->created_at }}<br><br>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($data['order']->status == 1)
                            <div class="form-group">
                                <label for="">Masukkan Resi</label>
                                <input type="text" class="form-control" name="resi" id="" aria-describedby="helpId"
                                       placeholder="Nomor Resi" value="{{$data['order']->receipt_number}}">
                                <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                            </div>
                        @endif
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="section-title font-weight-bold">{{ __('text.order_summary') }}</div>
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
                                                <td class="text-center">{{ rupiah($detail->price) }}</td>
                                                <td class="text-center">{{ $detail->qty }}</td>
                                                <td class="text-right">{{ rupiah($detail->total_price_per_product) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row mt-4">
                                    @if ($data['order']->status == 5 || $data['order']->status == 6)
                                        <div class="col-lg-8"></div>
                                    @else
                                        <div class="col-lg-8">
                                            <address>
                                                <strong>{{ __('text.shipping_method') }}:</strong>
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
                                            @if ($data['order']->status == 5 || $data['order']->status == 6)
                                                <div class="invoice-detail-name">Total</div>
                                            @else
                                                <div class="invoice-detail-name">Subtotal</div>
                                            @endif
                                            <div class="invoice-detail-value">{{ rupiah($data['order']->subtotal) }}</div>
                                        </div>
                                        @if ($data['order']->status == 5 || $data['order']->status == 6)
                                        @else
                                            <div class="invoice-detail-item">
                                                <div class="invoice-detail-name">{{ __('text.shipping_cost') }}</div>
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
                                    @if ($data['order']->status == 1 || $data['order']->status == 2 || $data['order']->status == 3)
                                        <img src=" {{ $path.$file_path }}" alt="" width="1000">
                                    @endif
                                </div>
                            </div>
                        </div>
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
                    </div>
                </div>
                <hr>
            </div>
        </form>
    </div>
@endsection
