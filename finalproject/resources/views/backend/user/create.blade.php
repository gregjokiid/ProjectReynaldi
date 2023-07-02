@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-form')
                @slot('isfile', true)
                @slot('action', Route('user.store'))
                @slot('method', 'POST')
                @slot('content')
                    <x-forms.input name="name" label="Nama" :isRequired="true"/>

                    <x-forms.select name="role" label="Jabatan" :isRequired="true">
                        <option value="1">admin</option>
                        <option value="2">user</option>
                        <option value="3">purchasing</option>
                        <option value="4">cashier</option>
                        <option value="5">owner</option>
                    </x-forms.select>

                    <x-forms.input name="email" type="email" label="Email" :isRequired="true" />

                    <x-forms.input name="password" type="password" label="Kata Sandi" :isRequired="true" />

                    <div class="text-right">
                        <a href="{{ Route('user.index') }}" class="btn btn-danger" href="#">{{ __('button.cancel') }}</a>
                        <button type="submit" class="btn btn-primary" href="#">{{ __('button.save') }}</button>
                    </div>
                @endslot
            @endcomponent
        @endsection
