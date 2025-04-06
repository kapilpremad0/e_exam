<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    function index(Request $request){
        $query_search = $request->input('search');
        $customers = User::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%')
                ->orWhere('email', 'like', '%' . $query_search . '%')
                ->orWhere('mobile', 'like', '%' . $query_search . '%')
                ->orWhereHas('state', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%');
                })
                ->orWhereHas('city', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%');
                });
        })
        ->where('role',2)
        ->with('state','city')
        ->latest()
        ->paginate(10);

        if ($request->ajax()) {
            return view('admin.users.pagination', compact('customers'))->render();
        }

        return view('admin.users.index',compact('customers'));
    }

}

