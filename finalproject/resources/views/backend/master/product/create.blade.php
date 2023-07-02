@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('master.product.store'))
                @slot('method', 'POST')
                @slot('content')

                    <x-forms.select name="categories_id" id="categories_id"
                        label="{{ __('button.select') }} {{ __('menu.category') }}" :isRequired="true">
                        <option value="" selected disabled>{{ __('button.select') }} {{ __('menu.category') }}</option>
                        @foreach ($data['category'] as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.input name="name" id="name" :label="__('field.product_name')" :isRequired="true" />

                    <x-forms.input name="slug" id="slug" :label="__('field.slug')" :isRequired="true" readonly />

                    <x-forms.input type="number" name="weight" id="weight" :label="__('field.weight')" :isRequired="true" min="50"/>

                    <x-forms.input type="number" name="price" id="price" :label="__('field.price')" :isRequired="true" min="100"/>

                    <x-forms.input type="number" name="stock" id="stock" :label="__('field.stock')" :isRequired="true" min="1"/>

                    <x-forms.input type="textarea" name="description" id="description" :label="__('field.description')" :isRequired="true" />

                    <x-forms.input type="file" name="thumbnails" id="thumbnails" label="Gambar 1" :isRequired="true" />
                    <x-forms.input type="file" name="thumbnails2" id="thumbnails2" label="Gambar 2"/>
                    <x-forms.input type="file" name="thumbnails3" id="thumbnails3" label="Gambar 3"/>
                    <x-forms.input type="file" name="thumbnails4" id="thumbnails4" label="Gambar 4"/>
                    <x-forms.input type="file" name="thumbnails5" id="thumbnails5" label="Gambar 5"/>

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
