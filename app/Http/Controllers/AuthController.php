<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller

{
    public function showLogin() {
    return view('login');
}

public function login(Request $request) {
    $validator = Validator::make($request->all(), [
        'nim' => 'required|numeric',
        'password' => 'required|regex:/^[a-zA-Z0-9]+$/',
    ]);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

    $user = \App\Models\User::where('nim', $request->nim)->first();
    if ($user && Hash::check($request->password, $user->password)) {
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    return back()->with('error', 'NIM atau password salah');
}
}
