<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotPasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\VerifyOtpRequest;
use App\Models\City;
use App\Models\OtpVerify;
use App\Models\State;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function register(RegisterRequest $request){
        $data = $request->validated();
        $data['password'] = Hash::make($request->password);
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename

            $image->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['image'] = $filename;
        }
        $user = User::updateOrCreate(['email' => $request->email],$data);
        return response()->json($user);
    }


    function login(LoginRequest $request){
        $user = User::where('mobile',$request->mobile)->first();
        if(Hash::check($request->password , $user->password)){

            $token = $user->createToken($user->name)->plainTextToken;
            $user->token = $token;
            $user->message = "Login successfully.";

            return response()->json($user);

        }else{
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => [
                    'password' => 'Your password is invalid.'
                ],
            ],422);            
        }
    }

    function forgot_password(ForgotPasswordRequest $request){
        $user = User::where('mobile',$request->mobile)->first();
        $otp = rand(0000,9999);
        $data = OtpVerify::updateOrCreate(['mobile' => $request->mobile],['otp' => $otp]);
        $user['otp'] = $otp;
        $user['message'] = "OTO Sent Successfully";
        return response()->json($user);
    }   


    function verify_otp(VerifyOtpRequest $request){
        $otp = OtpVerify::where($request->validated())->first();
        if($otp){
            $user = User::where('mobile',$request->mobile)->first();

            $token = $user->createToken($user->name)->plainTextToken;

            $user->token = $token;
            $user->message = "OTP verified successfully.";
            $complete_profile = 1;
            
            return response()->json($user);
        }else{
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => [
                    'otp' => 'Invalid OTP or OTP has expired.'
                ],
            ],422);            
        }
    }



    function reset_password(ResetPasswordRequest $request){
        $data['password'] = Hash::make($request->pssword);
        $user = User::where('id',Auth::user()->id)->update([
            'password' => Hash::make($request->pssword)
        ]);
        $user = User::find(Auth::id());
        $user['message'] = 'Password Change Successfully';
        $user['new_password'] = $request->password;
        return response()->json($user);
    }


    public function getCities(Request $request)
    {
        $cities = City::when($request->state_id,function($query) use ($request){
            $query->where('state_id',$request->state_id);
        })->orderBy('name','ASC')->get();
        return response()->json($cities);
    }


    public function getStates()
    {
        $states = State::orderBy('name','ASC')->get();
        return response()->json($states);
    }
}
