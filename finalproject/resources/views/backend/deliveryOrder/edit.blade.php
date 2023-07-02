@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('deliveryOrder.update',$purchaseOrder->id))
                @slot('method', 'POST')
                @slot('content')

                    <div class="form-group">
                        <label>Pilih Produk :</label>
                        <select class="custom-select" name="product_id" onmouseover="this.style.boxShadow='0px 0px 15px LightSkyBlue'" onmouseout="this.style.boxShadow='0px 0px 0px LightSkyBlue'">
                            @foreach ($products as $product)
                                @if ($purchaseOrder->product_id == $product->id) {
                                <option value="{{ $product->id }}" selected>{{$product->name}}</option>
                                }
                                @else{
                                <option value="{{ $product->id }}">{{$product->name}}</option>
                                }
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pilih Supplier :</label>
                        <select class="custom-select" name="supplier_id" onmouseover="this.style.boxShadow='0px 0px 15px LightSkyBlue'" onmouseout="this.style.boxShadow='0px 0px 0px LightSkyBlue'">
                            @foreach ($suppliers as $supplier)
                                @if ($purchaseOrder->supplier_id == $supplier->id) {
                                <option value="{{ $supplier->id }}" selected>{{$supplier->name}}</option>
                                }
                                @else{
                                <option value="{{ $supplier->id }}">{{$supplier->name}}</option>
                                }
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <x-forms.input type="number" name="qty" id="qty" label="Jumlah" :isRequired="true" value="{{ $purchaseOrder->qty }}"/>

                    <x-forms.input type="number" name="price" id="price" label="Harga" :isRequired="true" value="{{ $purchaseOrder->price }}"/>

                    <div class="text-right">
                        <a href="{{ Route('deliveryOrder.index') }}" class="btn btn-danger" href="#">{{ __('button.cancel') }}</a>
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
