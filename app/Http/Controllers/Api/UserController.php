<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    public function store(CreateUserRequest $request)
    {
        $validated = $request->validated();

        if (User::create($validated)) {
            return response()->json([
                'message' => 'Đăng kí tài khoản thành công.',
                'status_code' => 200,
            ]);
        }
    }

    public function update(UpdateUserRequest $request, User $user) {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('profile', 'public');

            Storage::disk('public')->delete($user->avatar ?? '');
        }

        if ($user->update($validated)) {
            return response()->json([
                'message' => 'Cập nhật thành công.',
                'status_code' => 200,
            ]);
        }
    }
}
