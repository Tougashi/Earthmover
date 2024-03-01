<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signin()
    {
        return view('pages.Auth.index', [
            'title' => 'SignIn'
        ]);
    }

    public function registration()
    {
        return view('pages.Auth.Registration.index', [
            'title' => 'Registration'
        ]);
    }

    public function auth(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required',
        ], [
            'username.exists' => 'There is no such username.',
            'password.required' => 'The password field is required.',
        ]);
    
        $credentials = $request->only('username', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
    
            if($user->roleId == 1) {
                return redirect('admin/dashboard')->with('success', 'Hallo, Admin!');
            } elseif($user->roleId == 2) {
                return redirect('cashier/dashboard')->with('success', 'Hallo, Cashier!');
            } elseif($user->roleId == 3) {
                return redirect('/home')->with('success', 'Hallo, Customers!');   
            } else {
                return redirect('/')->with('warning', 'Unknown role for this user.');
            }
        }
    
        return back()->withErrors(['Failed to signin']);
    }
    

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns|email:rfc|unique:users',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:8|max:255|customPassword'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->remember_token = Str::random(60);
        $user->email_verified_at = Carbon::now();
        $user->password = Bcrypt($request->password);
        $user->roleId = 3;
        $user->save();
    
        return back()->with('success', 'Success created account!');
    }

    public function signout()
    {
        Auth::logout();
        return redirect()->route('signin');
    }

}
