<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index() 
    {
        return view('auth.register');
    }
    public function store(Request $request) 
    {
        $request->request->add(['username'=> str::SLUG($request->username)]);

        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required|unique:users|min:3|max:20',
            'email' => 'required|unique:users|email|max:60',
            'password' =>'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username,
        ]);

        auth()->attempt([
            'email'=>$request->email,
            'password' => $request->password,
        ]);
        
        return redirect()->route('posts.index', auth()->user()->username);

    }

}
