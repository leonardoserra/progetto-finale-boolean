@extends('layouts.app')

@section('content')
    <div class="ms_container_bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3">
                    @include('ur.partials.sidebar')
                </div>
                <div class="col-7 mt-5 overflow-x-auto table-orders">
                    @if (count($orders) > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Indirizzo Cliente</th>
                                    <th>Contatto Cliente</th>
                                    <th>Email Cliente</th>
                                    <th>Data Ordine</th>
                                    <th>Prezzo Totale</th>
                                    <th>Status Pagamento</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->name_customer }}</td>
                                        <td>{{ $order->address_customer }}</td>
                                        <td>{{ $order->phone_number_customer }}</td>
                                        <td>{{ $order->email_customer }}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>{{ $order->status == 1 ? 'Confermato' : 'Fallito' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            <div class="total_gains">
                                <p>Totale guadagni: € {{ $totalPrice }}</p>
                            </div>
                    @else
                        <div class="ms_alert my-4">
                            <h3>Non ci sono ordini.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
