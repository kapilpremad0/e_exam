<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubmitResult;
use Illuminate\Http\Request;

class SubmitResultController extends Controller
{
    function index(Request $request){
        $query_search = $request->input('serach');

        $levels = SubmitResult::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%');
        })->with('level')->latest()->paginate(10);

        // return $levels;

        if ($request->ajax()) {
            return view('admin.levels.pagination', compact('levels'))->render();
        }

        return view('admin.levels.index', compact('levels'));
    }
}
