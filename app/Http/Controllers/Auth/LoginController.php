<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authentication(LoginUserRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            if (Auth::user()->isAdmin) {
                return redirect()->route('admins.dashboard');
            }

            return redirect()->route('index')->with('success', 'Đăng nhập thành công!');
        }

        return redirect()->route('login')->withErrors([
            'LoggedInError' => 'Email hoặc số điện thoại không kết nối với bất kì tài khoản nào.',
        ]);
    }
}
