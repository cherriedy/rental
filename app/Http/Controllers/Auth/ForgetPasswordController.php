<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordCodeMail;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\SetNewPasswordRequest;
use Illuminate\Support\Facades\Hash;

class ForgetPasswordController extends Controller
{
    public function forgetPasswordIndex()
    {
        return view('auth.forget-password');
    }

    public function forgetPasswordProcess(ResetPasswordRequest $request)
    {
        // $this->authorize('reset');

        $validated = $request->validated();

        $token = generateRandomString(16);

        // $user = User::select('id')
        //     ->where('email', $validated['email'])
        //     ->get();

        $user = User::select('id')
            ->where('email', $validated['email'])
            ->get()->toArray();

        Token::create([
            'user_id' => $user[0]['id'],
            'token' => $token,
            'starting_time' => Carbon::now()->toDateTimeString(),
            'type' => Token::TOKEN_REST_PASSWORD,
            'service' => Token::SERVICE_EMAIL,
        ]);

        // $mail = new SendResetPasswordCodeMail($user, $token);
        // Mail::to($validated['email'])->send($mail);

        Mail::to($validated['email'])->send(new SendResetPasswordCodeMail($user[0]['id'], $token));

        return response()->json([
            'status_code' => 200,
            'message' => 'Truy cập vào hộp thư để xem hướng dẫn.',
        ]);
    }

    public function getPasswordIndex($user, $token) {
        $user_token = Token::select('starting_time')
            ->where([ ['user_id', $user], ['token', $token] ])
            ->whereDate('starting_time', '>=', Carbon::now())
            ->get();

        if (!$user_token->isEmpty()) {
            return view('auth.set-new-password', compact('user', 'token'));
        } else {
            abort(404);
        }
    }

    public function getPasswordProcess(SetNewPasswordRequest $request, User $user, $token) {
        $validated = $request->validated();

        $user->update($validated);

        return response()->json([
            'status_code' => 200,
            'message' => 'Cập nhật mật khẩu thành công.'
        ]);
    }
}
