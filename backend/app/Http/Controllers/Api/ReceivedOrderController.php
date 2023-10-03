<?php

namespace App\Http\Controllers\Api;

use App\Models\ReceivedOrderLead;
use App\Mail\ReceivedOrder;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ReceivedOrderController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();
        $email_restaurant = $data['restaurant_user'][0]['email'];

        $newReceivedOrderLead = new ReceivedOrderLead();

        $newReceivedOrderLead->fill($data);

        Mail::to($email_restaurant)->send(new ReceivedOrder($newReceivedOrderLead));

        return response()->json([
            'success' => true,
            'data' => $data,
            'email_restaurant' => $email_restaurant
        ]);
    }
}
