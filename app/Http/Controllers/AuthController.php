<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


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
        $mobile = $request->input('mobile_number');

        if (!preg_match('/^\d{10}$/', $mobile)) {
            return response()->json(['message' => 'Invalid phone number.'], 400);
        }

        // Generate OTP
        $otp = rand(1000, 9999); // Generate a 4-digit OTP

        // Store OTP in cache for validation (expires in 90 seconds)
        Cache::put('otp_' . $mobile, $otp, 90);

        // Send OTP via SMS (use your SMS service)
        // Example with Twilio (replace with your SMS gateway)
        // Twilio::message($mobile, "Your OTP is $otp");

        return response()->json(['message' => 'OTP sent successfully.', 'otp'=>$otp]);
    }

    public function validateOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|regex:/^\d{10}$/', // 10-digit number
            'otp' => 'required|digits:4', // OTP should be exactly 4 digits
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid OTP or mobile number.'], 400);
        }

        $mobile = $request->input('mobile_number');
        $otp = $request->input('otp');

        // Retrieve OTP from cache
        $storedOtp = Cache::get('otp_' . $mobile);

        if ($storedOtp && $storedOtp == $otp) {
          $user=   User::where('mobile', $mobile)->where('status',1)->first();
          if($user){
            Auth::login($user);

          }else{
            $user =   User::updateOrCreate([
                'mobile' => $mobile,   
                'status' => 1,              
            ]);
            Auth::login($user);

          }
          

            return response()->json(['message' => 'OTP validated successfully.']);
        } else {
            // OTP is incorrect or expired
            return response()->json(['message' => 'Invalid OTP.'], 400);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
