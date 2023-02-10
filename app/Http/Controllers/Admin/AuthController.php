<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            //Error messages
            $messages = [
                "email.required" => "Email is required",
                "email.email" => "Email is not valid",
                "email.exists" => "Email doesn't exists",
                "password.required" => "Password is required",
                "password.min" => "Password must be at least 6 characters"
            ];

            // validate the form data
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:4'
            ], $messages);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                //attempt to log in
                $credentials = $request->all();
                if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'type' => 'admin'])) {
                    return redirect()->intended('admin/dashboard')
                        ->with('success_message', 'Signed in');
                }
            }
            //login fail
            return back()->withErrors([
                'password' => 'Wrong password.',
            ])->withInput();
        }
        //login view page
        return view('auth.login');
    }



    public function register(Request $request)
    {
        if ($request->isMethod('post')) {
            //Error messages
            $messages = [
                "name.required" => "Name is required",
                "name.min" => "Name must be at least 3 characters",
                "email.required" => "Email is required",
                "email.email" => "Email is not valid",
                "email.exists" => "Email doesn't exists",
                "password.required" => "Password is required",
                "password.confirmed" => "Password does not match",
                "password.min" => "Password must be at least 6 characters"
            ];

            // validate the form data
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:4'
            ], $messages);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                //attempt to log in
                $credentials = $request->all();
                if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'type' => 'admin'])) {
                    return redirect()->intended('admin/dashboard')
                        ->withSuccess('Signed up');
                }
            }
            //login fail
            return redirect("/register")->with('success_message', 'Register credentials are not valid');
        }
        //login view page
        return view('auth.register');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
