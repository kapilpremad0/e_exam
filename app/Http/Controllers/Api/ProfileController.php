<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function index(){
        $profile = User::find(Auth::user()->id);
        // $profile = new ProfileResource($profile);
        return response()->json($profile);
    }


    function store(UpdateProfileRequest $request){

        
        

        $data = $request->validated();
        
        User::where('id',Auth::id())->update($data);
        $profile = User::find(Auth::user()->id);
        // $profile = new ProfileResource($profile);
        return response()->json($profile);   
    }
}
