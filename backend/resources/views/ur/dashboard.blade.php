@extends('layouts.app')
@section('content')
<div class="ms_container_bg">
    <div class="container-fluid">

        <div class="row justify-content-center">
            <div class="col-3">
                @include('ur.partials.sidebar')
            </div>
            <div class="col-9">
                <div class="card ms_black_container-dashboard mt-5 mx-auto">
                    <img src="{{ asset('storage/' . $restaurant->img) }}" class="card-img-top-dashboard" alt="{{ $restaurant->name }}">
                    <div class="card-body">
                        <h1 class="card-title">{{ $restaurant->name }}</h1>
                        <p class="card-text"><strong>Indirizzo: </strong>{{ $restaurant->address }}</p>
                        <p class="card-text"><strong>Partita IVA: </strong>{{ $restaurant->vat }}</p>
                        <p class="card-text"><strong>Tipo: </strong>
                            @foreach ($restaurant->types as $type)
                                <span>{{ $type->name}};</span>
                            @endforeach</p>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

@endsection
