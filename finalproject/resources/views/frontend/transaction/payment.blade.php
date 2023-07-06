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
        @component('components.backend.card.card-form')
            @slot('isfile', true)
            @slot('action', route('transaction.paymentChecking', $data['order']->invoice_number))
            @slot('method', 'POST')
            @slot('content')
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice" style="border-top: 2px solid #6777ef;">
                                <div class="invoice-print">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="invoice-title">
                                                <h2>Upload Bukti Pembayaran</h2>
                                                <div class="invoice-number">Total {{ rupiah($data['order']->total_pay) }}</div>
                                            </div>
                                            <hr>
                                            <x-forms.input type="file" name="payment" id="payment" :label="__('field.payment')" :isRequired="true" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-md-right">
                                    <a href="{{ Route('transaction.index') }}" class="btn btn-secondary " href="#">Batal</a>
                                    <button type="submit" class="btn btn-primary " href="#">Proses</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endslot
        @endcomponent
    </section>
@endsection
