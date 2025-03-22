<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    


    function index(){
        $statistics = [
            'active_vendors' => '0',
            'unapprover_vendors' => '0',
            'active_subscriptions' => '0',
            'expire_subscriptions' => '0',
        ];
        return view('admin.dashboard.index',compact('statistics'));
    }
}
