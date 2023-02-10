<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\UsersLoginRequest;
use App\Http\Requests\UsersOtpRequest;
use App\Http\Resources\UsersResource;
use App\Mail\ResetPassword;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        try {
            $verify = User::where('email', $request->email)->exists();
            if ($verify) {
                $verify2 = DB::table('password_resets')->where([
                    ['email', $request->email]
                ]);
                if ($verify2->exists()) {
                    $verify2->delete();
                }
                $token = random_int(1000, 9999);
                $password_reset = DB::table('password_resets')->insert([
                    'email' => $request->all()['email'],
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);

                if ($password_reset) {
                    Mail::to($request->all()['email'])->send(new ResetPassword($token));
                    return $this->SuccessResponse(200, null, ["Please check your email for a 4 digit pin"], 200, 'success');
                }
            }
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }

    public function verifyPin(UsersOtpRequest $request)
    {
        try {
            $check = DB::table('password_resets')->where([
                ['email', $request->all()['email']],
                ['token', $request->all()['otp']],
            ]);

            if ($check->exists()) {
                $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
                if ($difference > 3600) {
                    return $this->FailResponse(200, ["Token Expired"], false, 400);
                }

                $delete = DB::table('password_resets')->where([
                    ['email', $request->all()['email']],
                    ['token', $request->all()['otp']],
                ])->delete();
                return $this->SuccessResponse(200, null, ["You can now reset your password"], 200, 'success');
            }
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }

    public function resetPassword(UsersLoginRequest $request)
    {
        try {
            $user = User::where('email',$request->email);
            $user->update([
                'password'=>bcrypt($request->password)
            ]);
            $data['access_token'] = $user->first()->createToken('persian-kitchen-user-token')->accessToken;
            $data['user'] = new UsersResource($user);
            return $this->SuccessResponse(200, $data, ["Your password has been reset"], 200, 'success');
        }catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }


}
