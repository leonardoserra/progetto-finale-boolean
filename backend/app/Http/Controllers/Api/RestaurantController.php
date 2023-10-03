<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with(['types', 'dishes'])->get();

        return response()->json([
            'success' => true,
            'results' => $restaurants
        ]);
    }

    public function show($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->with(['types', 'dishes'])->first();
        $restaurant_user = $restaurant->user()->get();
        if ($restaurant) {
            return response()->json([
                'success' => true,
                'restaurant' => $restaurant,
                'restaurant_user' => $restaurant_user
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Ristorante non esistente'
            ]);
        }
    }
}
