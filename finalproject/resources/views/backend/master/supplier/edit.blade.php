@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('master.supplier.update',$supplier->id))
                @slot('method', 'POST')
                @slot('content')

                    <x-forms.input name="name" id="name" label="Name" :isRequired="true" value="{{ $supplier->name }}"/>

                    <x-forms.input name="address" id="address" label="Address" :isRequired="true" value="{{ $supplier->address }}"/>

                    <x-forms.input type="number" name="phone" id="phone" label="Kuantitas" :isRequired="true" value="{{ $supplier->phone }}"/>

                    <x-forms.input type="email" name="email" id="email" label="Harga" :isRequired="true" value="{{ $supplier->email }}"/>

                    <div class="text-right">
                        <a href="{{ Route('master.supplier.index') }}" class="btn btn-secondary " href="#">{{ __('button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary " href="#">{{ __('button.save') }}</button>
                    </div>

                @endslot
            @endcomponent
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).on('keyup', '#name', function() {
            let val = $(this).val();
            let slugformat = val.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
            $('#slug').val(slugformat);
        });
    </script>
@endpush
