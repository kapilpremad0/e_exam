<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    function term_and_condition(){
        $data = Setting::where('key','term_and_condition')->first();
        $sku = [
            'sku' => 'term_and_condition',
            'name' => 'Term And Condition',
        ];
        return view('admin.settings.page',compact('data','sku'));
    }

    function privacy_policy(){
        $data = Setting::where('key','privacy_policy')->first();
        $sku = [
            'sku' => 'privacy_policy',
            'name' => 'Privacy Policy',
        ];
        return view('admin.settings.page',compact('data','sku'));
    }

    function show(){

    }

    function store(Request $request){
        Setting::updateOrCreate(['key' => $request->key],[
            'value' => $request->description,
        ]);
        session()->flash('success','Setting Update Successfully');
    }
}
