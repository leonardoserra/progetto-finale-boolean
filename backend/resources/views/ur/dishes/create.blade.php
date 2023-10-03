@extends('layouts.app')

@section('content')
    <div class="ms_container_bg">
            <div class="row">
                <div class="col-3 p-0">
                    @include('ur.partials.sidebar')
                </div>
                <div class="col-9 p-0">
                    <div class="ms_black_container create p-4 mt-5 mx-auto">

                        <h2 class="py-4">Aggiungi al menù</h2>
                        <form method="POST" action="{{ route('ur.dishes.store') }}  ">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label ">Nome:</label>
                                <input type="text" placeholder="Nome prodotto"
                                    class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                    value="{{ old('name') }}" autocomplete="off">
                                @if ($errors->has('name'))
                                    @error('name')
                                        <div class="invalid-feedback">
                                            <span>{{ $message }}</span>
                                        </div>
                                    @enderror
                                @elseif ($errors->any() && old('name'))
                                    <p class="text-success">Campo inserito correttamente!</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="ingredients_description" class="form-label">ingredienti/descrizione:</label>
                                <input type="text" placeholder="Inserisci ingredienti/descrizione"
                                    class="form-control @error('ingredients_description') is-invalid @enderror"
                                    id="ingredients_description" name="ingredients_description"
                                    value="{{ old('ingredients_description') }}" autocomplete="off">
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
                                <label for="price" class="form-label">prezzo:</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror"
                                    id="price" min="0.01" step="0.01" max="99.99" name="price"
                                    value="{{ old('price', '0.00') }}">
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
                                <input class="form-check-input" type="radio" name="visibility" id="visible"
                                    value="1" checked>
                                <label class="form-check-label" for="visible">
                                    Visibile
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="visibility" id="invisible"
                                    value="0">
                                <label class="form-check-label" for="invisible">
                                    Nascosto
                                </label>
                            </div>
                            <button type="submit" class="ms_button_variant ms_primary_button my-1">Salva il piatto</button>
                            <button type="reset" class="ms_button_variant ms_secondary_button my-1">Resetta i
                                parametri</button>
                        </form>
                    </div>

                </div>
        </div>
    </div>
@endsection
