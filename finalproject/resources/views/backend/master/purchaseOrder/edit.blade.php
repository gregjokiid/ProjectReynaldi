@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('master.purchaseOrder.update',$purchaseOrder->id))
                @slot('method', 'POST')
                @slot('content')

                    <x-forms.input name="name" id="name" label="Name" :isRequired="true" value="{{ $purchaseOrder->name }}"/>

                    <x-forms.input type="number" name="quantity" id="price" label="Kuantitas" :isRequired="true" value="{{ $purchaseOrder->quantity }}"/>

                    <x-forms.input type="number" name="price" id="weight" label="Harga" :isRequired="true" value="{{ $purchaseOrder->price }}"/>

                    <div class="text-right">
                        <a href="{{ Route('master.purchaseOrder.index') }}" class="btn btn-secondary " href="#">{{ __('button.cancel') }}</a>
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
