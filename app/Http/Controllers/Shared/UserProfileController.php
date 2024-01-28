<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show(User $user) {
        if (!$user) { abort(404); }

        return view('users.show', compact('user'));
    }

    public function profile() {
        return $this->show(Auth::user());
    }

    public function edit(User $user) {
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user) {
        $this->authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('profile', 'public');

            Storage::disk('public')->delete($user->avatar ?? '');
        }

        if ($user->update($validated)) {
            return redirect()->route('users.show', $user->id)->with('success', 'Cập nhật thông tin thành công!');
        }

        return redirect()->route('user.edit')->withErrors([
            'error' => 'Có lỗi, vui lòng thử lại.',
        ]);
    }

    /* AJAX */

}
