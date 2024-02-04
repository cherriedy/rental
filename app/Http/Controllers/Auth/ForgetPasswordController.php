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

        // dd($user[0]['id']);

        Token::create([
            'user_id' => $user[0]['id'],
            'token' => $token,
            'starting_time' => Carbon::now()->toDateTimeString(),
            'type' => Token::TOKEN_REST_PASSWORD,
            'service' => Token::SERVICE_EMAIL,
        ]);

        $mail = new SendResetPasswordCodeMail($user, $token);
        Mail::to($validated['email'])->send($mail);

        return response()->json([
            'status_code' => 200,
            'message' => 'Truy cập vào hộp thư để xem hướng dẫn.',
        ]);
    }

    public function getPasswordIndex() {
        // return
    }

    public function getPasswordProcess($user, $token) {
        // return
    }
}
