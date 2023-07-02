@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('master.product.update',$data['product']->id))
                @slot('method', 'POST')
                @slot('content')

                    <x-forms.select name="categories_id" id="categories_id"
                        label="{{ __('button.select') }} {{ __('menu.category') }}" :isRequired="true">
                        @foreach ($data['category'] as $category)
                            <option value="{{ $category->id }}" {{ $data['product']->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.input name="name" id="name" :label="__('field.product_name')" :isRequired="true" value="{{ $data['product']->name }}"/>

                    <x-forms.input name="slug" id="slug" :label="__('field.slug')" :isRequired="true" readonly value="{{ $data['product']->slug }}"/>

                    <x-forms.input type="number" name="price" id="price" :label="__('field.price')" :isRequired="true" value="{{ $data['product']->price }}"/>

                    <x-forms.input type="number" name="weight" id="weight" :label="__('field.weight')" :isRequired="true" value="{{ $data['product']->weight }}"/>

                    <x-forms.input type="number" name="stock" id="stock" :label="__('field.stock')" :isRequired="true" value="{{ $data['product']->stock }}"/>

                    <x-forms.input type="textarea" name="description" id="description" :label="__('field.description')" :isRequired="true" value="{{ $data['product']->description }}"/>

                    <x-forms.input type="file" name="thumbnails" id="thumbnails" label="Gambar 1" hintText="Kosongkan jika tidak akan mengubah file"/>
                    <x-forms.input type="file" name="thumbnails2" id="thumbnails2" label="Gambar 2" hintText="Kosongkan jika tidak akan mengubah file"/>
                    <x-forms.input type="file" name="thumbnails3" id="thumbnails3" label="Gambar 3" hintText="Kosongkan jika tidak akan mengubah file"/>
                    <x-forms.input type="file" name="thumbnails4" id="thumbnails4" label="Gambar 4" hintText="Kosongkan jika tidak akan mengubah file"/>
                    <x-forms.input type="file" name="thumbnails5" id="thumbnails5" label="Gambar 5" hintText="Kosongkan jika tidak akan mengubah file"/>

                    <div class="text-right">
                        <a href="{{ Route('master.product.index') }}" class="btn btn-danger" href="#">{{ __('button.cancel') }}</a>
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
