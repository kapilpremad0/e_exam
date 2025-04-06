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
        $profile = User::with('state','city')->find(Auth::user()->id);
        // $profile = new ProfileResource($profile);
        return response()->json($profile);
    }


    function store(UpdateProfileRequest $request){
        $data = $request->validated();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Unique filename

            $image->move(public_path('storage'), $filename); // Move the file to a public directory
            $data['image'] = $filename;
        }
        User::where('id',Auth::id())->update($data);
        $profile = User::with('state','city')->find(Auth::user()->id);
        // $profile = new ProfileResource($profile);
        return response()->json($profile);   
    }
}
