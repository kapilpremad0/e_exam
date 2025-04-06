<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubmitResult;
use Illuminate\Http\Request;

class SubmitResultController extends Controller
{
    function index(Request $request)
    {
        $query_search = $request->input('search'); // Fixed typo: 'serach' → 'search'

        $levels = SubmitResult::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%') // Search by SubmitResult name (if applicable)
                ->orWhereHas('user', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%') // Search by user name
                        ->orWhere('email', 'like', '%' . $query_search . '%') // Search by user email
                        ->orWhere('mobile', 'like', '%' . $query_search . '%'); // Search by user mobile
                })
                ->orWhereHas('level', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%') // Search by level name
                        ->orWhereHas('subject', function ($subQ) use ($query_search) {
                            $subQ->where('name', 'like', '%' . $query_search . '%'); // Search by subject name
                        })
                        ->orWhereHas('exam', function ($examQ) use ($query_search) {
                            $examQ->where('name', 'like', '%' . $query_search . '%'); // Search by exam name
                        });
                });
        })
            ->with('level.subject', 'level.exam', 'user') // Include relationships for optimized query performance
            ->latest()
            ->paginate(10);


        if ($request->ajax()) {
            return view('admin.levels.pagination', compact('levels'))->render();
        }

        return view('admin.levels.index', compact('levels'));
    }
}
