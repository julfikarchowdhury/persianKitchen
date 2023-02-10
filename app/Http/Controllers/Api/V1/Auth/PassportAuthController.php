<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UsersLoginRequest;
use App\Http\Requests\UsersOtpRequest;
use App\Http\Requests\UsersRequest;
use App\Http\Resources\UsersResource;
use App\Mail\VerifyEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PassportAuthController extends Controller
{
    /**
     * Registration Req
     */
    public function register(UsersRequest $request)
    {
        try {
            $request['password'] = bcrypt($request->password);
            $user = User::create($request->all());
            if ($user) {
                $verify2 = DB::table('password_resets')->where([
                    ['email', $request->all()['email']]
                ]);
                if ($verify2->exists()) {
                    $verify2->delete();
                }
                $otp = rand(1000, 9999);
                DB::table('password_resets')
                    ->insert(
                        [
                            'email' => $request->all()['email'],
                            'token' => $otp
                        ]
                    );
                Mail::to($request->email)->send(new VerifyEmail($otp));
            }
            $data['access_token'] = $user->createToken('persian-kitchen-user-token')->accessToken;
            $data['email']= $request->email;
            return $this->SuccessResponse(200, $data, ["Successfully Registered"], 200, 'success');
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }

    public function verifyOtp(UsersOtpRequest $request)
    {
        try {
            DB::table('password_resets')
                ->where('email', auth()->user()->email)
                ->where('token', $request->token)
                ->delete();
            $user = User::find(auth()->user()->id);
            $user->email_verified_at = Carbon::now()->getTimestamp();
            $user->save();
            $data['user'] = new UsersResource($user);
            return $this->SuccessResponse(200, $data, ["Successful"], 200, 'success');
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }

    /**
     * Login Req
     */
    public function login(UsersLoginRequest $request)
    {
        try {
            $user = User::where('email', $request->all()['email'])->first();
            // Check Password
            if (!$user || !Hash::check($request->all()['password'], $user->password)) {
                return $this->FailResponse(200, ['Invalid Credentials'], false, 400);
            }
            // Auth check
            if (auth()->attempt($request->all())) {
                $data['access_token'] = auth()->user()->createToken('persian-kitchen-user-token')->accessToken;
                $data['user'] = new UsersResource(auth()->user());
                return $this->SuccessResponse(200, $data, ["Successful"], 200, 'success');
            } else {
                return $this->FailResponse(200, ['Unauthorised'], false, 401);
            }
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }

    public function userInfo()
    {
        try {
            $data['user'] = new UsersResource(auth()->user());
            return $this->SuccessResponse(200, $data, ["Successful"], 200, 'success');
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }
    public function changePassword(ChangePasswordRequest $request){
         try {
            $user = auth()->user();
            if (app('hash')->check($request->new_password, $user->password)) {
                return $this->FailResponse(200,["Same as old password please tyr again"],false,404);
            }
            if (app('hash')->check($request->old_password, $user->password)) {
                $user->password = app('hash')->make($request->new_password);
                $user->save();

                return $this->SuccessResponse(200,$user,['Successfully Changed Password'],200,'success');

            } else {
                return $this->FailResponse(200,["Invalid Old Same Password"],false,404);
            }
        }catch (\Exception $e){
            Log::debug('PassportAuth Change Password => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(200,["Something Wrong"],false,500);
        }
    }
    public function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->SuccessResponse(200, null, ["Logged Out Successfully"], 200, 'success');
        } catch (\Exception $e) {
            Log::debug('PassportAuth create => ' . $e->getMessage() . ' ' . $e->getFile() . ' ' . $e->getLine());
            return $this->FailResponse(500, ["Something Wrong"], false, 500);
        }
    }
}
