@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.backend.card.card-table')
                @slot('header')
                    <h4 class="card-title">Purchase Order</h4>
                    <div class="card-header-action">
                        <a href="{{ route('purchaseOrder.create') }}" class="btn btn-primary">{{ __('button.add') }}
                            {{ __('menu.product') }}</a>
                    </div>
                @endslot
                @slot('thead')
                    <tr>
                        <th>Product ID</th>
                        <th>Supplier ID</th>
                        <th>Status</th>
                        <th>Qty</th>
                        <th>Dibuat</th>
                        <th>Diupdate</th>
                        <th>Action</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($purchaseOrders as $purchaseOrder)
                        <tr>
                            @foreach ($products as $product)
                                @if ($purchaseOrder->product_id == $product->id)
                                    <td>{{ $product->name }}</td>
                                @endif
                            @endforeach

                                @foreach ($suppliers as $supplier)
                                    @if ($purchaseOrder->supplier_id == $supplier->id)
                                        <td>{{ $supplier->name }}</td>
                                    @endif
                                @endforeach

                                @if($purchaseOrder->status == 0)
                                    <td>Sedang Diproses</td>
                                @endif

                                @if($purchaseOrder->status == 1)
                                    <td>Selesai</td>
                                @endif
                            <td>{{ $purchaseOrder->qty }}</td>
                            <td>{{ $purchaseOrder->created_at }}</td>
                            <td>{{ $purchaseOrder->updated_at }}</td>
                            <td>
                                <x-button.dropdown-button :title="__('field.action')">
                                    @if($purchaseOrder->status == 0)
                                        <a class="dropdown-item has-icon" href="{{ route('purchaseOrder.done',$purchaseOrder->id) }}"><i class="far fa-check"></i>
                                            Tandai selesai</a>
                                    @endif
                                    <a class="dropdown-item has-icon" href="{{ route('purchaseOrder.edit',$purchaseOrder->id) }}"><i class="far fa-edit"></i>
                                        {{ __('button.edit') }}</a>
                                    <a class="dropdown-item has-icon btn-delete" href="{{ route('purchaseOrder.delete',$purchaseOrder->id) }}"><i class="fa fa-trash"></i>
                                        {{ __('button.delete') }}</a>
                                </x-button.dropdown-button>
                            </td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
