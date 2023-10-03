<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OrdersController extends Controller
{
    public function index()
    {

        $userRestaurant = Auth::user()->restaurant;
        $ordersWithDuplicate = $userRestaurant->dishes()->with('orders')->get()->pluck('orders')->flatten()->sortByDesc('created_at');

        $orders = $ordersWithDuplicate->unique('id');

        $totalPrice = 0;
        foreach ($orders as $order) {
            $totalPrice += $order->total_price;
        }

        return view('ur.orders', compact('orders', 'totalPrice'));
    }

}
