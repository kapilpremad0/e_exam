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
            $query->where('id', 'like', '%' . $query_search . '%') // Search by order ID
                ->orWhere('amount', 'like', '%' . $query_search . '%') // Search by amount
                ->orWhere('status', 'like', '%' . $query_search . '%') // Search by status
                ->orWhere('payment_status', 'like', '%' . $query_search . '%') // Search by payment status
                ->orWhereHas('level.subject', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%'); // Search by subject name
                })
                ->orWhereHas('level.exam', function ($q) use ($query_search) {
                    $q->where('name', 'like', '%' . $query_search . '%'); // Search by exam name
                });
        })->with('user','level')->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.transactions.pagination', compact('transactions'))->render();
        }

        
        return view('admin.transactions.index', compact('transactions'));
    }


}
