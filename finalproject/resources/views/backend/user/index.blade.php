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
                        <th>No</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Email</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($data['user'] as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            @foreach ($roles as $role)
                                @if ($user->id == $role->model_id)
                                    <td>
                                        @if($role->model_id == 1)
                                            admin
                                        @elseif($role->model_id == 2)
                                            user
                                        @elseif($role->model_id == 3)
                                            purchasing
                                        @elseif($role->model_id == 4)
                                            cashier
                                        @elseif($role->model_id == 5)
                                            owner
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
