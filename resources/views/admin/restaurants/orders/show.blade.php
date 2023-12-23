@extends('layouts.admin')

@section('content')
    <div class="container-lg px-sm-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <span class="d-flex align-items-center">
                <a class="text-dark" href="{{ route('admin.restaurants.orders', $restaurant) }}"><i
                        class="fa-solid fa-circle-arrow-left fs-3 me-2"></i></a>

                <em>
                    <a class="text-decoration-none text-dark"
                        href="{{ route('admin.restaurants.orders', $restaurant) }}">Ordini</a> /
                    <strong>
                        {{ $order->user_mail }}
                    </strong>
                </em>
            </span>
        </div>

        <div class="row">
            <div class="row flex-wrap justify-content-center gap-4 gap-md-5">
                <div class="col-12 col-md-5 card shadow border-0 bg_color_gradient">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-4"><strong>Informazioni Cliente</strong></h5>
                        <p><strong>Nome:</strong> {{ $order->username }}</p>
                        <p><strong>Email:</strong> {{ $order->user_mail }}</p>
                        <p><strong>Indirizzo:</strong> {{ $order->address }}</p>
                        <p><strong>Telefono:</strong> {{ $order->phone }}</p>
                        <p><strong>Data e ora:</strong> {{ $order->created_at }}</p>

                    </div>
                </div>

                <div class="col-12 col-md-6 card shadow border-0 bg_color_gradient">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-4"><strong>Dettagli Ordine</strong></h5>
                        <p><strong>Totale:</strong> {{ $order->total }}€</p>
                        <p><strong>Stato Pagamento:</strong>
                            @if ($order->payment_status)
                                <strong><span style="color: green;">Accettato <i
                                            class="fa-solid fa-circle-check"></i></span></strong>
                            @else
                                <strong><span style="color: red;">Rifiutato <i
                                            class="fa-solid fa-circle-xmark"></i></span></strong>
                            @endif
                        </p>

                        <h6><strong>Piatti Ordinati:</strong></h6>
                        <ul>
                            @foreach ($order->dishes as $dish)
                                <li>{{ $dish->name }}</li>
                            @endforeach
                        </ul>

                        <p><strong>Note:</strong>
                            @if ($order->notes)
                                {{ $order->notes }}
                            @else
                                Nessuna
                            @endif
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
