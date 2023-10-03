@extends('layouts.app')

@section('content')
    <div class="ms_container_bg">
        <div class="container text-white ps-4">
            <div class="row">
                <div class="col-3">
                    @include('ur.partials.sidebar')
                </div>
                <div class="col-6 ms_black_container mt-4 ps-4">
                    <h2 class="py-4">Aggiorna il piatto</h2>
                    <form method="POST" action="{{ route('ur.dishes.update', ['dishes' => $id]) }}" class="w-100">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome:</label>
                            <input type="text" placeholder="nome piatto"
                                class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $dish->name) }}" autocomplete="off">
                            @if ($errors->has('name'))
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @elseif ($errors->any() && old('name'))
                                <p class="text-success">Campo inserito correttamente!</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="ingredients_description" class="form-label">Ingredienti/Descrizione:</label>
                            <input type="text" placeholder="inserisci ingredienti/descrizione"
                                class="form-control @error('ingredients_description') is-invalid @enderror"
                                id="ingredients_description" name="ingredients_description"
                                value="{{ old('ingredients_description', $dish->ingredients_description) }}"
                                autocomplete="off">
                            @if ($errors->has('ingredients_description'))
                                @error('ingredients_description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @elseif ($errors->any() && old('ingredients_description'))
                                <p class="text-success">Campo inserito correttamente!</p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Prezzo:</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                                min="0.01" step="0.01" max="99.99" name="price"
                                value="{{ old('price', $dish->price) }}">

                            @if ($errors->has('price'))
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            @elseif ($errors->any() && old('price'))
                                <p class="text-success">Campo inserito correttamente!</p>
                            @endif
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="visible" value="1"
                                @if ($dish->visibility == 1) checked @endif>
                            <label class="form-check-label" for="visible">
                                Visibile
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="visibility" id="invisible" value="0"
                                @if ($dish->visibility == 0) checked @endif>
                            <label class="form-check-label" for="invisible">
                                Nascosto
                            </label>
                        </div>
                        <button type="submit" class="ms_button_variant ms_primary_button my-1">Aggiorna il piatto</button>
                        <button type="reset" class="ms_button_variant ms_secondary_button mb-1">Resetta i
                            parametri</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
