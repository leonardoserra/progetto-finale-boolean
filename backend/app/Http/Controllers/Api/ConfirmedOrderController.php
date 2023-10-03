<?php

namespace App\Http\Controllers\Api;

use App\Models\ConfirmedOrderLead;
use App\Mail\ConfirmedOrder;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfirmedOrderController extends Controller
{
    public function store(Request $request)
    {

        $data = $request->all();
        $email_customer = $data['email_customer'];
        $newConfirmedOrderLead = new ConfirmedOrderLead();

        $newConfirmedOrderLead->fill($data);

        Mail::to($email_customer)->send(new ConfirmedOrder($newConfirmedOrderLead));

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
