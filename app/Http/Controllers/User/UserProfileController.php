<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Room;
use App\Models\TemporaryFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function show(User $user)
    {
        $rooms = Room::where('user_id', $user->id)
            ->orderbyDesc('hot_service')
            ->orderbyDesc('starting_date')
            ->paginate(6);

        return view('users.show', compact('user', 'rooms'));
    }

    public function profile()
    {
        return $this->show(Auth::user());
    }

    public function edit()
    {
        $user = Auth::user();
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    /* AJAX */
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $this->authorize('update', $user);

        $validated = $request->validated();

        if ($request->has('image')) {
            $temporaryFiles = TemporaryFile::all();

            foreach ($temporaryFiles as $temporaryFile) {
                Storage::copy('images/tmp/' . $temporaryFile->folder . '/' . $temporaryFile->filename, 'images/' . $temporaryFile->folder . '/' . $temporaryFile->filename);

                $validated['avatar'] = $temporaryFile->folder . '/' . $temporaryFile->filename;

                Storage::deleteDirectory('images/tmp/' . $temporaryFile->folder);

                Storage::disk('public')->delete($user->avatar ?? '');

                $temporaryFile->delete();
            }
        }

        if ($user->update($validated)) {
            return response()->json([
                'status_code' => 200,
                'message' => 'Cập nhật thành công.',
            ]);
        }
    }
}
