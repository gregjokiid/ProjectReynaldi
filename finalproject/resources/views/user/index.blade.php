@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-table')
                @slot('header')
                    <h4>User</h4>
                    <div class="card-header-action">
                      <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
                    </div>
                @endslot
                @slot('thead')
                    <tr>
                        <th class="text-center">
                            #
                        </th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($data['user'] as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            @foreach ($roles as $role)
                                @if ($user->id == $role->model_id)
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $role->model_type }}
                                    </td>
                                @endif
                            @endforeach
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
