<h1>
      Hai ricevuto un'ordine!
</h1>

Dettagli ordine
<br />
<ul style="list-style: none">
      <li>
            Ordine effettuato alle : &nbsp; {{ date('j-n-Y, g:i a', strtotime($lead->created_at)) }}

      </li>
      <li>
            Ordine numero: &nbsp; {{ $lead->order_id }}
      </li>
      <li>
            Nome citofono: &nbsp; {{ $lead->name_customer }}
      </li>
      <li>
            E-mail cliente: &nbsp; {{ $lead->email_customer }}
      </li>
      <li>
            Indirizzo di consegna: &nbsp; {{ $lead->address_customer }}
      </li>
      <li>
            Contatto telefonico: &nbsp; {{ $lead->phone_number_customer }}
      </li>

      <li>Articoli ordinati:
            <ul>
                  @foreach ($lead->menu as $dish)
                        @if ($dish['quantity'] > 0)
                              <li>
                                    {{ $dish['value'] }}&nbsp;x{{ $dish['quantity'] }}
                              </li>
                        @endif
                  @endforeach
            </ul>
      </li>

      <li>
            <b>
                  Totale ordine: &nbsp; {{ $lead->total_price }}€
            </b>
      </li>
</ul>

<br />
