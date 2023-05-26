@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('master.purchaseOrder.store'))
                @slot('method', 'POST')
                @slot('content')

                    <div class="form-group">
                        <label>Pilih Produk :</label>
                        <select class="custom-select" name="product_id" onmouseover="this.style.boxShadow='0px 0px 15px LightSkyBlue'" onmouseout="this.style.boxShadow='0px 0px 0px LightSkyBlue'">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-forms.input name="name" id="name" :label="__('field.product_name')" :isRequired="true" />

                    <x-forms.input type="number" name="quantity" id="quantity" label="Kuantitas" :isRequired="true" />

                    <x-forms.input type="number" name="price" id="price" :label="__('field.price')" :isRequired="true" />

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
