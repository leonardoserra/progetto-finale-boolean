@extends('layouts.app')

@section('content')
    <div class="ms_container_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    @include('ur.partials.sidebar')
                </div>
                <div class="col-9">

                    {{-- form di filtraggio  --}}

                    <form class="row g-3 my-2 form-dishes-index" method="POST" action="{{ route('ur.filterdishes') }}">
                        @csrf
                        <div class="col-3">

                            <select class="form-select bg-dark text-white" id="filter" name="filter">
                                <option value="default" {{ $filteredMenu == 'default' ? 'selected' : ' ' }}>
                                    <span class="ms_filter">Ordina Menù</span>
                                </option>
                                <option value="az" {{ $filteredMenu == 'az' ? 'selected' : ' ' }}>Nome A-Z</option>
                                <option value="za" {{ $filteredMenu == 'za' ? 'selected' : ' ' }}>Nome Z-A</option>
                                <option value="priceAsc" {{ $filteredMenu == 'priceAsc' ? 'selected' : ' ' }}>Prezzo dal più
                                    basso al più alto</option>
                                <option value="priceDesc" {{ $filteredMenu == 'priceDesc' ? 'selected' : ' ' }}>Prezzo dal
                                    più
                                    alto al più basso</option>
                            </select>

                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary bg-dark ms_primary_button mb-3">Ordina</button>

                        </div>
                    </form>

                    {{-- foreach lista piatti --}}
                    @if ($dishes->isEmpty())
                        <div class="ms_alert">
                            <h3>Ops, sembra che il tuo menù sia vuoto!</h3>
                        </div>
                    @else
                        <div class="row">
                            @foreach ($dishes as $dish)
                                <div class=" col-sm-12 col-md-2 col-lg-4 col-xl-3 dish">
                                    <div class="card ms_black_container mb-4">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title">{{ $dish->name }}</h5>
                                                <p class="card-text">{{ $dish->ingredients_description }}</p>
                                                <p class="card-text">€ {{ $dish->price }}</p>
                                                <p class="card-text">Visibile al pubblico :

                                                    {{ $dish->visibility == 1 ? 'Si' : 'No' }}</p>
                                            <div class="d-flex align-items-center">
                                                <a href="{{ route('ur.dishes.show', ['dishes' => $dish->id]) }}">
                                                    <button class="ms_button ms_primary_button">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </a>

                                                <a href="{{ route('ur.dishes.edit', ['dishes' => $dish->id]) }}">
                                                    <button class="ms_button ms_secondary_button ms-2 me-2">
                                                        <i class="fa-solid fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <form class="my-2 form_delete_dish"
                                                    action="{{ route('ur.dishes.destroy', ['dishes' => $dish->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" id="btn-delete"
                                                        class="ms_button ms_tertiary_button">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
        {{-- qui ci sta la modale --}}
        <div class="modal fade" id="confirmModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminazione prodotto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Sei sicuro di voler eliminare il prodotto selezionato?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Annulla</button>
                        <button id="form-delete" type="button" class="btn btn-danger">Conferma Eliminazione</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
