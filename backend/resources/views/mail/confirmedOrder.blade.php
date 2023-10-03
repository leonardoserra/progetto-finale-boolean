<h1>
      Il tuo ordine è stato confermato!
</h1>


<br />
<ul style="list-style: none">
      <li>
            Ordine numero: &nbsp; {{ $lead->order_id }}
      </li>
      <li>
            Nome citofono: &nbsp; {{ $lead->name_customer }}
      </li>
      <li>
            L'ordine verrà consegnato in: &nbsp; {{ $lead->address_customer }}
      </li>

      {{-- menu: &nbsp; {{ $lead->menu[0]['value'] }} --}}
      <li>Articoli ordine:
            <ul>
                  @foreach ($lead->menu as $dish)
                        @if ($dish['quantity'] > 0)
                              <li>
                                    {{ $dish['value'] }}&nbsp;x{{ $dish['quantity'] }}, prezzo : {{ $dish['price'] * $dish['quantity'] }}€
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
