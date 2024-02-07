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
        // $this->authorize('login');

        return view('auth.login');
    }

    public function authentication(LoginUserRequest $request)
    {
        // $this->authorize('login');

        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            // if (Auth::user()->isAdmin) {
            //     return redirect()->route('admins.dashboard');
            // }

            // return redirect()->route('index')->with('success', 'Đăng nhập thành công!');

            $response = [
                'status_code' => 200,
                'message' => 'Đăng nhập thành công',
            ];

            $response['isAdmin'] = Auth::user()->isAdmin ? true : false;

            return response()->json($response);
        }

        // return redirect()->route('login')->withErrors([
        //     'LoggedInError' => 'Email hoặc số điện thoại không kết nối với bất kì tài khoản nào.',
        // ]);
    }
}
