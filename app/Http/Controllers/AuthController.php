<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login()
    {
        return view('Auth.index', [
            'title' => 'Login'
        ]);
    }

    public function auth(Request $request) : RedirectResponse
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if(Auth::attempt($credentials)) {
            return redirect('/dashboard')->with(['success']);
        }
        return back()->with(['gagal']);
    }

    public function logout()
    {

    }
}
