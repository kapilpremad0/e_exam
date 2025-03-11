<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ForgotPasswordRequest;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\VerifyOtpRequest;
use App\Models\OtpVerify;
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
        $user = User::updateOrCreate($data);
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
        // return Hash::make($request->pssword);
        $data['password'] = Hash::make($request->pssword);
        $user = User::where('id',Auth::user()->id)->update($data);
        $user = User::find(Auth::id());
        $user['message'] = 'Password Change Successfully';
        $user['new_password'] = $request->password;
        return response()->json($user);
    }


    public function getCities(Request $request)
    {
        // try {
            $state_id = $request->state_id;
            $states = config('cities');
            $collect = collect($states)->map(function ($item) use ($state_id) {
                if ($state_id == $item['state_id']) {
                    return [
                        'id' => $item['id'],
                        'name' => $item['name']
                    ];
                }
            })->filter()
                ->sortBy('name', SORT_NATURAL | SORT_FLAG_CASE)
                ->values();

            return response()->json($collect);
            // return $this->sendSuccess('CITIES FETCH SUCCESSFULLY', $collect);
        // } catch (\Throwable $e) {
        //     return $this->sendFailed($e->getMessage() . ' On Line ' . $e->getLine(), 200);
        // }
    }


    public function getStates()
    {
        // try {
            // $states = DB::table('states')->select('id','name','iso2 as code')->orderBy('name','ASC')->get();

            $states = config('states');

            $collect = collect($states);
            $filteredCollection = $collect->map(function ($item) {
                return [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'code' => $item['iso2']
                ];
            });
            return response()->json($filteredCollection);

            // return $this->sendSuccess('STATES FETCH SUCCESSFULLY', $filteredCollection);
        // } catch (\Throwable $e) {
        //     return $this->sendFailed($e->getMessage() . ' On Line ' . $e->getLine(), 200);
        // }
    }
}
