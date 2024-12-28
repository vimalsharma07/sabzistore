<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_or_mobile' => 'required',
            'password' => 'nullable|min:6',
        ]);

        $credentials = filter_var($request->email_or_mobile, FILTER_VALIDATE_EMAIL)
            ? ['email' => $request->email_or_mobile]
            : ['mobile' => $request->email_or_mobile];

        if ($request->password) {
            $credentials['password'] = $request->password;
            if (Auth::attempt($credentials)) {
                return redirect()->intended('admin/dashboard');
            } else {
                return back()->withErrors(['login' => 'Invalid credentials']);
            }
        } else {
            // OTP Login flow
            return $this->sendOtp($request);
        }
    }

    public function sendOtp(Request $request)
    {
        $request->validate(['email_or_mobile' => 'required']);

        $user = filter_var($request->email_or_mobile, FILTER_VALIDATE_EMAIL)
            ? User::where('email', $request->email_or_mobile)->first()
            : User::where('mobile', $request->email_or_mobile)->first();

        if (!$user) {
            return back()->withErrors(['login' => 'User not found.']);
        }

        // Simulate sending OTP
        $otp = rand(1000, 9999);
        session(['otp' => $otp, 'user_id' => $user->id]);

        // In production, send via SMS or Email
        \Log::info("OTP for {$user->email_or_mobile}: {$otp}");

        return view('auth.verify-otp', ['email_or_mobile' => $request->email_or_mobile]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric']);

        if (session('otp') == $request->otp) {
            Auth::loginUsingId(session('user_id'));
            session()->forget(['otp', 'user_id']);
            return redirect('/dashboard');
        }

        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
