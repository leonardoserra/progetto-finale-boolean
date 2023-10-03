<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Type;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Type::all();
        return view('auth.register', compact('types'));
    }

    /**
     * Questa funzione store registra lo user e crea anche il 
     * record per la tabella dei ristoranti.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        // $flag = $request->types;

        // $type_validate = false;
        // if(count($flag) > 0){
        //     $type_validate = true;
        // }

        $validated_data =  $request->validate([
            'email' => ['required', 'string', 'email', 'max:100', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'max:100'],
            'name' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:100'],
            'vat' => ['required', 'string', 'max:11'],
            'img' => ['nullable', 'image', 'max:1024'],
            'types' => ['required', 'min:1', 'exists:types,id'],
        ]);


        $validated_data['slug'] = Str::slug($request->name, '-');

        $checkRegistration = Restaurant::where('slug', $validated_data['slug'])->first();
        if ($checkRegistration) {
            return back()->withInput()->withErrors(['slug' => 'Impossibile creare lo slug per questo post, cambia il titolo']);
        }
        // dd($validated_data);


        //creato record per user
        $user = User::create([
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
        ]);



        if ($request->hasFile('img')) {
            $path = Storage::put('restaurant_img', $request->img);
            $validated_data['img'] = $path;
        }

        if (!($request->img)) {
            $validated_data['img'] = 'restaurant_img/default_img.jpg';
        }

        //creo record per restaurant
        $restaurant = Restaurant::create([
            'name' => $validated_data['name'],
            'user_id' => $user->id,
            'slug' => $validated_data['slug'],
            'address' => $validated_data['address'],
            'vat' => $validated_data['vat'],
            'img' => $validated_data['img'],
        ]);

        if ($request->has('types')) {
            $restaurant->types()->attach($request->types);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
