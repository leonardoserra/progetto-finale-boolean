@extends('layouts.app')

@section('content')
      <section class="login-container my-img">
            <div class="container py-4 my-img">
                  <div class="row g-0 align-items-center justify-content-center">
                        <div class="col-lg-4 mb-4 mb-lg-0">
                              <div class="card cascading-right my-form">
                                    <div class="card-body p-4 shadow-5 text-center">
                                          <h2 class="fw-bold mb-4">{{ __('Login') }}</h2>
                                          <form method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <!-- Email input -->
                                                <div class="form-outline mb-3">
                                                      <label for="email"></label>

                                                      <input id="email" placeholder="Indirizzo e-mail"type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off"
                                                            autofocus>

                                                      @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                      @enderror
                                                </div>

                                                <!-- Password input -->
                                                <div class="form-outline mb-3">
                                                      <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                      @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                  <strong>{{ $message }}</strong>
                                                            </span>
                                                      @enderror
                                                      <label for="password"></label>
                                                </div>

                                                <!-- Checkbox -->
                                                <div class="form-check d-flex justify-content-center mb-3">
                                                      <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="remember">
                                                                  {{ __("Ricorda i dati d'accesso") }}
                                                            </label>
                                                      </div>
                                                </div>

                                                <!-- Submit button -->
                                                <button type="submit" class="my-button my-submit">
                                                      {{ __('Login') }}
                                                </button>
                                          </form>
                                    </div>
                              </div>
                        </div>
                        <!-- IMMAGINE -->
                        <div class="col-lg-4 mb-4 mb-lg-0">
                              <img src="https://cdn.pixabay.com/photo/2020/12/28/03/49/food-5865805_1280.png" class="w-100" alt="" />
                        </div>
                  </div>
            </div>
      </section>
@endsection
