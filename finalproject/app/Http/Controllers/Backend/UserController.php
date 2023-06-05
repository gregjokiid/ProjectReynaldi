<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\CrudRepositories;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = new CrudRepositories($user);
    }

    public function index()
    {
        $data['user'] = $this->user->get();
        $roles = DB::table('model_has_roles')->get();
        return view('backend.user.index',compact('data', 'roles'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(UserRequest $request)
    {
        $user_count = count(User::all()) + 1;

        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        $this->user->store($data);
        DB::table('model_has_roles')->insert([
            'role_id' => $data['role'],
            'model_type' => 'App\Models\User',
            'model_id' => $user_count,
        ]);
        return redirect()->route('user.index')->with('success',__('message.store'));
    }
}
