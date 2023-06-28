@extends('layouts.backend.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @component('components.backend.card.card-table')
                @slot('header')
                    <h4>User</h4>
                    <div class="card-header-action">
                      <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah User</a>
                    </div>
                @endslot
                @slot('thead')
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email</th>
                        <th>Bergabung</th>
                    </tr>
                @endslot
                @slot('tbody')
                    @foreach ($data['user'] as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            @foreach ($roles as $role)
                                @if ($user->id == $role->model_id)
                                    <td>
                                        @if($role->role_id == 1)
                                            admin
                                        @elseif($role->role_id == 2)
                                            user
                                        @elseif($role->role_id == 3)
                                            purchasing
                                        @elseif($role->role_id == 4)
                                            cashier
                                        @elseif($role->role_id == 5)
                                            owner
                                        @endif
                                    </td>
                                @endif
                            @endforeach
                            <td>{{ $user->email }}</td>
                            <td>{{ tanggal($user->created_at) }}</td>
                        </tr>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </div>
@endsection
