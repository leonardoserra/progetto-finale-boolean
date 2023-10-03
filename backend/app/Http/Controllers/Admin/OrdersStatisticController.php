<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersStatisticController extends Controller
{
    public function index()
    {


        $userRestaurant = Auth::user()->restaurant;
        $ordersWithDuplicate = $userRestaurant->dishes()->with('orders')->get()->pluck('orders')->flatten()->sortBy('created_at');

        $orders = $ordersWithDuplicate->unique('id');


        $lastTwelveMonth=[];
        //ciclo per assegnare i dati al graficon dei mesi
        $currentMonth = date('Y-F');
        for($i=0;$i<12;$i++){

            $monthToAdd= date('Y-F',strtotime('-'.$i.' month'));
            $lastTwelveMonth[]=[
                'month'=>$monthToAdd,
                'earned'=>0,
            ];
        };

        foreach ($orders as $order) {
            $priceOrder = $order->total_price;

            $date = date('Y-F', strtotime($order->created_at));

            for($i=0;$i< count($lastTwelveMonth);$i++){
                if($lastTwelveMonth[$i]['month'] == $date){
                    $lastTwelveMonth[$i]['earned']+=$priceOrder;
                    break;
                }
            }

        }
        $labelsData = array_reverse($lastTwelveMonth);
        $labelsYearsData = [];
        $labelsYears = [];
        //ciclo per assegnare i dati al grafico degli anni
        foreach ($orders as $order) {
            $year = date('Y', strtotime($order->created_at));
            $priceOrder = $order->total_price;

            if (!in_array($year, $labelsYears)) {
                $labelsYears[] = $year;
                $labelsYearsData[] = [
                    'year' => $year,
                    'earned' => $priceOrder,
                ];
            } else {
                $index = array_search($year, array_column($labelsYearsData, 'year'));
                $labelsYearsData[$index]['earned'] += $priceOrder;
            }
        }
        return view('ur.ordersStatistic', compact('labelsData','labelsYearsData'));
    }
}
