@extends('layouts.app')

@section('content')
    <section class="login-container my-img">
        <div class="container py-4 my-img">
            <div class="row g-0 align-items-center justify-content-center">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="card cascading-right my-form">
                        <div class="card-body p-4 shadow-5 text-center">
                            <h2 class="fw-bold mb-4">{{ __('Reset Password') }}</h2>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
                                <div class="fst-italic fw-lighter small mb-4 text-center">I campi contrassegnati con il simbolo
                                    <span style="color: red">*</span> sono
                                    obbligatori
                                </div>

                                <!-- Email input -->
                                <div class="mb-4 row">
                                    <label for="email"class="col-md-5 col-form-label text-md-right">{{ __('Indirizzo E-Mail') }}<span
                                            style="color: red">
                                            *</span></label>

                                    <div class="col-md-6">
                                        <input id="email" placeholder="Indirizzo e-mail" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="off" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="my-button my-submit">
                                    {{ __('Invia Link') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- IMMAGINE -->
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <img src="https://cdn.pixabay.com/photo/2020/12/28/03/49/food-5865805_1280.png" class="w-100"
                        alt="" />
                </div>
            </div>
        </div>
    </section>
@endsection
