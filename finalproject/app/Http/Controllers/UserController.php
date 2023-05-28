<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\CrudRepositories;
use Illuminate\Http\Request;
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
        return view('user.index',compact('data'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $request)
    {
        $posts = DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'App\Models\User',
            'model_id' => 2
            ]);

        $data = $request->except('_token');
        $data['password'] = bcrypt($request->password);
        $this->user->store($data);
        return redirect()->route('user.index')->with('success',__('message.store'));
    }
}
