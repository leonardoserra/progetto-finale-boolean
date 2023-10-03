<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDishesRequest;
use App\Http\Requests\UpdateDishesRequest;
use App\Models\Dish;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class DishesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filteredMenu = 'default';
        $dishesRestaurantId = Auth::user()->restaurant->id;

        $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('name', 'asc')->get();

        return view('ur.dishes.index', compact('dishes', 'filteredMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ur.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDishesRequest $request)
    {
        $data = $request->validated();
        $dataRestaurantId = Auth::user()->restaurant->id;
        $newDish = new Dish;
        $newDish->name = $data['name'];
        $newDish->ingredients_description = $data['ingredients_description'];
        $newDish->price = $data['price'];
        $newDish->restaurant_id = $dataRestaurantId;

        $newDish->visibility = $data['visibility'];
        $newDish->save();

        return redirect()->route('ur.dishes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        // verifico che nella get ci sia un numero o mando errore
        if (!is_numeric($id)) {
            return view('error');
        }

        $userRestaurantId = Auth::user()->restaurant->id;

        $dish = Dish::where('id', $id)->first();

        if ($dish->restaurant_id == $userRestaurantId) {
            return view('ur.dishes.show', compact('dish'));
        }

        return view('error');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userRestaurantId = Auth::user()->restaurant->id;

        $dish = Dish::where('id', $id)->first();

        if ($dish->restaurant_id == $userRestaurantId) {
            return view('ur.dishes.edit', compact('id', 'dish'));
        }

        return view('error');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDishesRequest $request, $id)
    {
        $data = $request->validated();

        $dish = Dish::where('id', $id)->first();
        $dish->update($data);

        return redirect()->route('ur.dishes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $userRestaurantId = Auth::user()->restaurant->id;
        $dish = Dish::where('id', $id)->first();

        if ($dish->restaurant_id == $userRestaurantId) {
            //settare il dish che non viene cancellato per colpa della many to many
            $dish->delete();

            return redirect()->route('ur.dishes.index');
        }

        return view('error');
    }

    public function filterDishes(Request $request)
    {

        // validazione
        $validatedData = $request->validate([
            'filter' => [
                'required',
                Rule::in(['az', 'za', 'priceAsc', 'priceDesc', 'default']),
            ]
        ]);

        $filteredMenu = $validatedData['filter'];
        // dd($filteredMenu);

        //creato controllo per filtro scelto
        $dishesRestaurantId = Auth::user()->restaurant->id;
        if ($filteredMenu == 'az') {
            $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('name', 'asc')->get();
        } elseif ($filteredMenu == 'za') {
            $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('name', 'desc')->get();
        } elseif ($filteredMenu == 'priceAsc') {
            $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('price', 'asc')->get();
        } elseif ($filteredMenu == 'priceDesc') {
            $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('price', 'desc')->get();
        } else {
            $dishes = Dish::where('restaurant_id', $dishesRestaurantId)->orderBy('name', 'asc')->get();
        }

        return view('ur.dishes.index', compact('dishes', 'filteredMenu'));
    }
}
