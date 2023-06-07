@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['category']->name }}</h4>
                    <div class="card-header-action">
                        <a href="{{ route('master.category.edit',$data['category']->id) }}" class="btn btn-success">{{ __('button.edit') }}</a>
                        <a href="{{ route('master.category.index') }}" class="btn btn-primary">{{ __('button.back') }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>{{ __('field.product_name') }}</td>
                                    <td>: {{ $data['category']->name }}</td>
                                </tr>
{{--                                <tr>--}}
{{--                                    <td>{{ __('field.price') }}</td>--}}
{{--                                    <td>: {{ rupiah($data['product']->price) }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ __('field.weight') }}</td>--}}
{{--                                    <td>: {{ $data['product']->weight }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ __('field.stock') }}</td>--}}
{{--                                    <td>: {{ $data['product']->stock }}</td>--}}
{{--                                </tr>--}}
{{--                                <tr>--}}
{{--                                    <td>{{ __('field.description') }}</td>--}}
{{--                                    <td>: {!! $data['product']->description !!}</td>--}}
{{--                                </tr>--}}
                            </table>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ $data['category']->thumbnails_path }}" alt="" class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
