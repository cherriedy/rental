<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        if (User::create($validated)) {
            return redirect()->route('login')->with('success', 'Tài khoản đã được tạo thành công, đăng nhập để truy cập tài!');
        }

        return redirect()->route('register')->withErrors([
            'RegisterError' => 'Có lỗi, vui lòng thử lại!',
        ]);
    }
}
