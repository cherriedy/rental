<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.pages.users.index', compact('users'));
    }

    public function create() {
        return view('admin.pages.users.create');
    }

    public function store(Request $request) {
        $validated = Validator::make($request->all(), [
            'name' => 'required|min:3|max:40',
            'email' => 'required|string|max:255|email|unique:users,email',
            'phone' => ['regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'password' => 'required|string|min:8',
            'isAdmin' => 'required',
        ], [
            'name.required' => 'Không được để trống tên',
            'name.min' => 'Tên phải lớn hơn 3 kí tự',
            'name.max' => 'Tên phải bé hơn 40 kí tự',
            'email.required' => 'Không được để trống email',
            'email.max' => 'Email phải bé hơn 255 kí tự',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ]);

        $room = $request->only('name', 'email', 'phone', 'password', 'isAdmin');

        if (User::create($room)) {
            return redirect()->route('admins.users.index');
        }
    }

    public function edit(User $user) {
        return view('admin.pages.users.update', compact('user'));
    }

    public function update(Request $request,  User $user) {
        $validated = Validator::make($request->all(), [
            'name' => 'required|min:3|max:40',
            'email' => 'required|string|max:255|email|unique:users,email',
            'phone' => ['regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            // 'password' => 'required|string|min:8',
            'isAdmin' => 'required',
        ], [
            'name.required' => 'Không được để trống tên',
            'name.min' => 'Tên phải lớn hơn 3 kí tự',
            'name.max' => 'Tên phải bé hơn 40 kí tự',
            'email.required' => 'Không được để trống email',
            'email.max' => 'Email phải bé hơn 255 kí tự',
            'email.email' => 'Vui lòng nhập đúng định dạng',
            'email.unique' => 'Email đã được sử dụng',
            'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
            'phone.regex' => 'Số điện thoại không đúng định dạng.',
        ]);

        $room = $request->only('name', 'email', 'phone', 'password', 'isAdmin');

        if ($user->update($room)) {
            return redirect()->route('admins.users.index');
        }
    }
}
