<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginUserRequest;

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
            $response = [
                'status_code' => 200,
                'message' => 'Đăng nhập thành công',
            ];

            $response['isAdmin'] = Auth::user()->isAdmin ? true : false;

            return response()->json($response);
        }
    }
}
