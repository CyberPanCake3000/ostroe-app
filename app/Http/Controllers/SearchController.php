<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function customersSearch(Request $request)
    {
        $query = $request->get('query');

        $data = Customer::where('phone', 'LIKE', "%{$query}%")->get(['phone', 'name', 'birth_date', 'id']);

        return response()->json($data);
    }

    public function customerSearch(Request $request)
    {
        $query = $request->get('query');
        $data = Customer::where('id', $query)->first();

        return response()->json($data);
    }

    public function globalSearch(Request $request)
    {
        $query = $request->get('search');

        $customers = Customer::where('phone', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('comment', 'LIKE', "%{$query}%")
            ->orWhere('id', 'LIKE', "%{$query}%")->get();

        $orders = Order::where('comment', 'LIKE', '%' . $query . '%')
            ->orWhere('id', 'LIKE', "%{$query}%")->get();

        return view('search-results', ["customers" => $customers, "orders" => $orders, "query" => $query]);

    }

    public function suggestions(Request $request)
    {
        $query = $request->get('query');

        $data = Customer::where('phone', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('comment', 'LIKE', "%{$query}%")->get();

        return response()->json($data);
    }
}
