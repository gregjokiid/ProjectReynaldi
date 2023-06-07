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
                                    <td>{{ __('field.category_name') }}</td>
                                    <td>: {{ $data['category']->name }}</td>
                                </tr>
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
