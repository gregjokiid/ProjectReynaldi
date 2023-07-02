@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('purchaseOrder.store'))
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

                    <div class="form-group">
                        <label>Pilih Supplier :</label>
                        <select class="custom-select" name="supplier_id" onmouseover="this.style.boxShadow='0px 0px 15px LightSkyBlue'" onmouseout="this.style.boxShadow='0px 0px 0px LightSkyBlue'">
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <x-forms.input name="status" id="status" value=0 hidden/>

                    <x-forms.input type="number" name="qty" id="qty" label="Jumlah" :isRequired="true" />

                    <div class="text-right">
                        <a href="{{ Route('purchaseOrder.index') }}" class="btn btn-danger" href="#">{{ __('button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary" href="#">{{ __('button.save') }}</button>
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
