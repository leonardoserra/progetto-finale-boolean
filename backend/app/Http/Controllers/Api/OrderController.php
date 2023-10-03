<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    public function payment(Request $request)
    {
        $data = $request->all();

        $validatedData = Validator::make(
            $data,
            [
                'name_customer' => 'required|max:50',
                'address_customer' => 'required|max:100',
                'phone_number_customer' => 'nullable|max_digits:15|min_digits:10|numeric',
                'email_customer' => 'required|email|max:100',

            ]
        );

        if ($validatedData->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validatedData->errors(),
                'validation' => $data,
            ]);
        }

        $newOrder = new Order();
        $newOrder->fill($data);
        $newOrder->save();

        foreach ($data['menu'] as $dish) {
            if ($dish['quantity'] > 0) {
                $newOrder->dishes()->attach($dish['id'], ['quantity' => $dish['quantity']]);
            }
        }

        return response()->json([
            'success' => true,
            'results' => $data,
            'newOrderData' => $newOrder
        ]);
    }
}
