<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    /* AJAX Validate */
    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        if (User::create(Arr::except($validated, 'password_confirmation'))) {
            return response()->json([
                'message' => 'Đăng kí tài khoản thành công.',
                'status_code' => 200,
            ]);
        }
    }
}
