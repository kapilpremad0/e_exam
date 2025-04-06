<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index(Request $request)
    {
        $query_search = $request->input('serach');

        $transactions = Order::when($query_search, function ($query) use ($query_search) {
            $query->where('name', 'like', '%' . $query_search . '%');
        })->with('user','level')->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.transactions.pagination', compact('transactions'))->render();
        }

        
        return view('admin.transactions.index', compact('transactions'));
    }


}
