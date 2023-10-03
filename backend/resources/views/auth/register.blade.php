@extends('layouts.app')

@section('content')
      <div class="container py-4 my-img">
            <div class="row g-0 align-items-center justify-content-center">
                  <div class="col-lg-5 mb-4 mb-lg-0">
                        <div class="card cascading-right my-form">
                              <div class="card-body p-4 shadow-5">
                                    <h2 class="fw-bold mb-4 text-center">Registrazione</h2>

                                    <!-- Form di registrazione dati per il login -->

                                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registration-form" onsubmit="return validateType()">
                                          @csrf
                                          <div class="fst-italic fw-lighter small mb-4 text-center">I campi contrassegnati con il simbolo
                                                <span style="color: red">*</span> sono
                                                obbligatori
                                          </div>

                                          <!-- dati utente registrato -->

                                          <section class="">
                                                <div class="card-title text-center fs-4">{{ __('Dati Utente') }}</div>

                                                <!-- Email input -->
                                                <div class="form-outline mb-3">
                                                      <label for="email">{{ __('Indirizzo E-Mail') }}<span style="color: red">
                                                                  *</span></label>

                                                      <input id="email" placeholder="esempio@gmail.com"type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off"
                                                            autofocus>

                                                      @if ($errors->has('email'))
                                                            @error('email')
                                                                  <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                  </div>
                                                            @enderror
                                                      @elseif ($errors->any() && old('email'))
                                                            <p class="text-success">Campo inserito correttamente!</p>
                                                      @endif
                                                </div>

                                                <!-- Password input -->
                                                <div class="form-outline mb-3">
                                                      <label for="password">{{ __('Password') }}<span style="color: red"> *</span></label>
                                                      <input id="password" placeholder="Lunghezza minima 8 caratteri" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                      @if ($errors->has('password'))
                                                            @error('password')
                                                                  <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                  </div>
                                                            @enderror
                                                      @elseif ($errors->any() && old('password'))
                                                            <p class="text-success">Campo inserito correttamente!</p>
                                                      @endif
                                                </div>

                                                <!-- Conferma Password -->
                                                <div class="form-outline mb-3">
                                                      <label for="password-confirm">{{ __('Conferma Password') }}<span style="color: red">
                                                                  *</span></label>
                                                      <input id="password-confirm" placeholder="Ripeti la password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>

                                                <hr>

                                                <!-- dati aggiunta ristorante -->
                                                <div class="card-title text-center fs-4">{{ __('Dati Ristorante') }}</div>

                                                <!-- nome ristorante -->
                                                <div class="form-outline mb-3">
                                                      <label for="name">{{ __('Nome Ristorante') }}<span style="color: red">
                                                                  *</span></label>

                                                      <input id="name" type="text" placeholder="Inserire il nome del ristorante" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required
                                                            autocomplete="off" autofocus>

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
                                                <!-- indirizzo ristorante -->
                                                <div class="form-outline mb-3">
                                                      <label for="address">{{ __('Indirizzo') }}<span style="color: red">
                                                                  *</span></label>

                                                      <input id="address" type="text" placeholder="Inserire indirizzo del ristorante" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required
                                                            autocomplete="off" autofocus>

                                                      @if ($errors->has('address'))
                                                            @error('address')
                                                                  <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                  </div>
                                                            @enderror
                                                      @elseif ($errors->any() && old('address'))
                                                            <p class="text-success">Campo inserito correttamente!</p>
                                                      @endif
                                                </div>
                                                <!-- partita IVA ristorante -->
                                                <div class="form-outline mb-3">
                                                      <label for="vat" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}<span style="color: red">
                                                                  *</span></label>

                                                      <input id="vat" placeholder="Inserisci 11 cifre esatte" type="text" pattern="[0-9]{11}" minlength="11" maxlength="11" class="form-control @error('vat') is-invalid @enderror" name="vat"
                                                            value="{{ old('vat') }}" required autocomplete="off" autofocus oninvalid="this.setCustomValidity('Inserisci un numero di 11 cifre.')" oninput="this.setCustomValidity('')">

                                                      @if ($errors->has('vat'))
                                                            @error('vat')
                                                                  <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                  </div>
                                                            @enderror
                                                      @elseif ($errors->any() && old('vat'))
                                                            <p class="text-success">Campo inserito correttamente!</p>
                                                      @endif
                                                </div>

                                                <!-- immagine ristorante -->
                                                <div class="form-outline mb-3">
                                                      <label for="img"class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>

                                                      <input type="file" class="form-control @error('img') is-invalid @enderror " id="img" name="img">
                                                      @if ($errors->has('img'))
                                                            @error('img')
                                                                  <div class="invalid-feedback">
                                                                        {{ $message }}
                                                                  </div>
                                                            @enderror
                                                      @elseif ($errors->any() && old('img'))
                                                            <p class="text-success">Campo inserito correttamente!</p>
                                                      @endif
                                                </div>

                                                <!-- tipo ristorante -->
                                                <div class="form-outline mb-3 type-validate">
                                                      <label for="types" class="col-md-2 col-form-label text-md-right">{{ __('Tipo') }}<span style="color: red">
                                                                  *</span></label>

                                                      <div class="flex-wrap text-center" role="group">
                                                            @foreach ($types as $type)
                                                                  <input id="type_{{ $type->id }}" class="btn-check @error('types') is-invalid @enderror " @if (in_array($type->id, old('types', []))) checked @endif type="checkbox" name="types[]"
                                                                        value="{{ $type->id }}">
                                                                  <label for="type_{{ $type->id }}" class="btn btn-outline-dark my-type my-button" id="type_{{ $type->id }}"style="color: whithe;">{{ $type->name }}
                                                                  </label>
                                                            @endforeach

                                                            @if ($errors->has('types'))
                                                                  @error('types')
                                                                        <div class="invalid-feedback">
                                                                              {{ $message }}
                                                                        </div>
                                                                  @enderror
                                                            @elseif ($errors->any() && old('types'))
                                                                  <p class="text-success">Campo inserito correttamente!</p>
                                                            @endif
                                                      </div>
                                                </div>
                                          </section>
                                          <!-- Submit button -->
                                          <div class="text-center">
                                                <button id="registration-form-button" type="submit" class="my-button my-submit">
                                                      {{ __('Register') }}
                                                </button>
                                          </div>
                                    </form>
                              </div>
                        </div>
                  </div>
                  <!-- IMMAGINE -->
                  <div class="col-lg-5 mb-4 mb-lg-0">
                        <img src="https://cdn.pixabay.com/photo/2020/12/28/03/49/food-5865805_1280.png" class="w-100" alt="" />
                  </div>
            </div>
      </div>
@endsection


{{-- script da spostare in app.js prima o poi --}}
<script>
      //   creo elemento div per errore
      const errorMessage = document.createElement('div');

      function validateType() {
            const types = document.querySelectorAll('input[name="types[]"]:checked');

            if (types.length === 0) {

                  errorMessage.classList.add('text-danger');
                  errorMessage.textContent = 'Seleziona almeno un tipo di ristorante.';

                  const typesContainer = document.querySelector('.type-validate');
                  typesContainer.appendChild(errorMessage);


                  return false;
            } else {
                  errorMessage.textContent = '';
            }
            return true;
      }
</script>
