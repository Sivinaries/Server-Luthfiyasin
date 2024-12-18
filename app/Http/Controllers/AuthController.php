<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chair;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->level = 'User';
        $user->save();

        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect('/')->with('toast_success', 'Registration successful!')
            ->with('access_token', $token);
    }

    public function signin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return redirect()->route('login')->withErrors(['email' => 'Unauthorized']);
        }

        $user = Auth::user();
        $token = $user->createToken('auth_token')->plainTextToken;

        return redirect()->route('dashboard')->with('auth_token', $token)->with('toast_success', 'Login successful!');
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens()->delete();  // Delete all user tokens
        }

        Auth::logout();  // Log the user out

        return redirect()->route('login')->with('toast_success', 'Logged Out Successfully!');
    }
}
