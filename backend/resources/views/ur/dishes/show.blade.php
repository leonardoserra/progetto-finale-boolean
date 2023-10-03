@extends('layouts.app')

@section('content')
    <div class="ms_container_bg">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    @include('ur.partials.sidebar')
                </div>
                <div class="col-6 mt-4">
                    <div class="col">
                        <div class="card ms_black_container ps-4 pt-2">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ $dish->ingredients_description }}</p>
                                <p class="card-text"> € {{ $dish->price }}</p>
                                <p class="card-text">Visibile al pubblico : {{ $dish->visibility == 1 ? 'Si' : 'No' }}</p>
                                <a href="{{ route('ur.dishes.edit', ['dishes' => $dish->id]) }}">
                                    <button class="ms_button_variant ms_secondary_button mt-3">
                                        Modifica Piatto
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
