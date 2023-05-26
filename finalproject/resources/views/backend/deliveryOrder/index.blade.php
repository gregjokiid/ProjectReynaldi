@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.backend.card.card-table')
                @slot('header')
                    <h4 class="card-title">{{ __('menu.product') }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('master.deliveryOrder.create') }}" class="btn btn-primary">{{ __('button.add') }}
                            {{ __('menu.product') }}</a>
                    </div>
                @endslot
                @slot('thead')
                    <tr>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Product ID</th>
                        <th>Penerima</th>
                        <th>Tanggal Dibuat</th>
                        <th>Action</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($deliveryOrders as $deliveryOrder)
                        <tr>
                            <td>{{ $deliveryOrder->name }}</td>
                            <td>{{ $deliveryOrder->quantity }}</td>
                            <td>{{ $deliveryOrder->price }}</td>
                            @foreach ($products as $product)
                                @if ($deliveryOrder->product_id == $product->id)
                                    <td>{{ $product->name }}</td>
                                @endif
                            @endforeach
                            <td>{{ $deliveryOrder->receiver }}</td>
                            <td>{{ tanggal($deliveryOrder->created_at) }}</td>
                            <td>
                                <x-button.dropdown-button :title="__('field.action')">
                                    <a class="dropdown-item has-icon" href="{{ route('master.deliveryOrder.edit',$deliveryOrder->id) }}"><i class="far fa-edit"></i>
                                        {{ __('button.edit') }}</a>
{{--                                    <a class="dropdown-item has-icon" href="{{ route('master.purchaseOrder.show',$purchaseOrder->id) }}"><i class="far fa-eye"></i>--}}
{{--                                        {{ __('button.detail') }}</a>--}}
                                    <a class="dropdown-item has-icon btn-delete" href="{{ route('master.deliveryOrder.delete',$deliveryOrder->id) }}"><i class="fa fa-trash"></i>
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
