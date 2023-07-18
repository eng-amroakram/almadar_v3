<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        return view('panel.table', ['service' => 'UsersService', 'title' => 'المستخدمين']);
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function edit($user_id)
    {
        return view('panel.users.edit', ['user_id' => $user_id]);
    }

    public function profile(User $user)
    {
        return view('panel.users.profile', ['user' => $user, 'title' => 'المستخدم']);
    }
}
