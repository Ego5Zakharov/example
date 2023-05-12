<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'first_name' => ['required', 'string', 'max:50', 'alpha'],
            'last_name' => ['required', 'string', 'max:50', 'alpha'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:7', 'max:50', 'confirmed'],
            'agreement' => ['accepted'],
        ]);

        $user = User::query()->create([
            'first_name' => $validate['first_name'],
            'last_name' => $validate['last_name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
        ]);

        return redirect()->route('user');
    }
}
