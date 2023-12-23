@extends('layouts.admin')

@section('content')
    <div class="container-lg px-sm-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="d-flex align-items-center">
                <a class="text-dark" href="{{ route('admin.restaurants.index') }}"><i
                        class="fa-solid fa-circle-arrow-left fs-3 me-2"></i></a>

                <em>
                    <button class="btn p-0 m-0 border-0 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">{{ $restaurant->name }}
                    </button>
                    <div class="dropdown-menu bg_select_gradient rounded-bottom-5 rounded-end-5">
                        <div class="restaurant-card px-3 p-lg-4 d-flex gap-5 col-xxl-10">
                            <a class="text-decoration-none text-dark d-flex align-items-center gap-sm-3 gap-md-5"
                                href="#">

                                @if (str_contains($restaurant->image, 'http'))
                                    <img class="d-none d-sm-block" src="{{ $restaurant->image }}" alt="restaurant">
                                @else
                                    <img class="d-none d-sm-block" src="{{ asset('storage/' . $restaurant->image) }}"
                                        alt="restaurant">
                                @endif



                                <div
                                    class="col-10 col-sm-6 col-md-4 col-lg-6 d-flex flex-column justify-content-start gap-3 py-2">
                                    <div>
                                        <h5 class="mb-0"><strong>{{ $restaurant->name }}</strong></h5>
                                        <span class="text-muted">{{ $restaurant->address }}</span>
                                    </div>

                                    <p style="font-size: 15px; word-wrap:break-word;">
                                        {{ $restaurant->description }}
                                    </p>

                                    <div>
                                        <div class="mb-1">Tipologie di cucina:</div>
                                        <ul class="d-flex flex-wrap gap-1 list-unstyled">
                                            @foreach ($restaurant->types as $type)
                                                <li class="badge bg_color">
                                                    {{ $type->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </a>

                            <div class="edit-and-delete d-flex flex-column gap-2 align-items-end">

                                <a class="text-decoration-none"
                                    href="{{ route('admin.restaurants.edit', $restaurant) }}"><button type="button"
                                        class="edit-button">
                                        <i class="fa-solid fa-pencil"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <strong>
                        / Ordini
                    </strong>
                </em>
            </span>
        </div>

        @if (count($orders) > 0)
            <h2 class="fw-bolder text-uppercase text-center mb-4">
                Ordini
            </h2>

            <div class="rounded-4 table-responsive mx-auto">
                <table style="cursor: pointer;" class="table table-hover table-bordered text-center">
                    <thead class="bg-light">
                        <tr>
                            <th class="col">Data e ora</th>
                            <th class="col">Nome</th>
                            <th class="col">Email</th>
                            <th class="col">Indirizzo</th>
                            <th class="col">telefono</th>
                            <th class="col">Totale</th>
                            <th class="col">pagamento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr
                                onclick="window.location='{{ route('admin.restaurants.orders.show', ['restaurant' => $restaurant, 'order' => $order]) }}';">
                                <td>{{ $order->created_at }}</td>
                                <td>{{ $order->username }}</td>
                                <td>{{ $order->user_mail }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->total }}€</td>
                                @if ($order->payment_status)
                                    <td><i style="color: green" class="fa-solid fa-circle-check fs-4"></i></td>
                                @else
                                    <td><i style="color: red" class="fa-solid fa-circle-xmark fs-4"></i></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="d-flex flex-column align-items-center pt-5">
                <span class="fs-3">nessun ordine ricevuto</span>
                <i class="fa-regular fa-face-sad-cry fs-1"></i>
            </div>
        @endif

    </div>
@endsection


<style lang="scss" scoped>
    .restaurant-card {
        cursor: pointer;
        position: relative;

        .edit-and-delete {
            position: absolute;
            top: 30px;
            right: -80px;
        }

        img {
            min-width: 18rem;
            width: 18rem;
            aspect-ratio: 1/1;
            border-radius: 50%;
            object-fit: cover;
        }

        @media screen and (max-width: 1399px) {
            .edit-and-delete {
                position: absolute;
                top: 15px;
                right: 15px;
            }
        }

        @media screen and (max-width: 767.9px) {
            img {
                width: 15rem;
                min-width: 15rem;
            }

            .edit-and-delete {
                position: absolute;
                top: 15px;
                right: 15px;
            }
        }

        @media screen and (max-width: 700px) {
            img {
                width: 10rem;
                min-width: 10rem;
            }
        }

        .delete-button,
        .edit-button,
        .order-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #3d348b9b;
            border: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition-duration: 0.3s;
            overflow: hidden;
            position: relative;

            i {
                color: white;
                width: 17px;
            }

            .delete-svgIcon {
                width: 15px;
                transition-duration: 0.3s;
            }

            .delete-svgIcon path {
                fill: white;
            }
        }

        .delete-button:hover {
            width: 90px;
            border-radius: 50px;
            transition-duration: 0.3s;
            background-color: rgb(255, 69, 69);
            align-items: center;

            .delete-svgIcon {
                width: 20px;
                transition-duration: 0.3s;
                transform: translateY(60%);
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .edit-button:hover {
            width: 90px;
            border-radius: 50px;
            transition-duration: 0.3s;
            background-color: green;
            align-items: center;

            i {
                width: 20px;
                transition-duration: 0.3s;
                transform: translateY(60%);
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        .order-button:hover {
            width: 90px;
            border-radius: 50px;
            transition-duration: 0.3s;
            background-color: lightcoral;
            align-items: center;

            i {
                width: 20px;
                transition-duration: 0.3s;
                transform: translateY(60%);
                -webkit-transform: rotate(360deg);
                -moz-transform: rotate(360deg);
                -o-transform: rotate(360deg);
                -ms-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }


        .delete-button::before {
            display: none;
            content: "Elimina";
            color: white;
            transition-duration: 0.3s;
            font-size: 2px;
        }

        .edit-button::before {
            display: none;
            content: "Modifica";
            color: white;
            transition-duration: 0.3s;
            font-size: 2px;
        }

        .order-button::before {
            display: none;
            content: "Ordini";
            color: white;
            transition-duration: 0.3s;
            font-size: 2px;
        }

        .delete-button:hover::before,
        .edit-button:hover::before,
        .order-button:hover::before {
            display: block;
            padding-right: 10px;
            font-size: 13px;
            opacity: 1;
            transform: translateY(0px);
            transition-duration: 0.3s;
        }
    }

    .animated-button {
        position: relative;
        display: inline-block;
        padding: 12px 24px;
        border: none;
        font-size: 16px;
        background-color: inherit;
        border-radius: 100px;
        font-weight: 600;
        box-shadow: 0 0 0 2px #3d348b9b;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);

        a {
            color: #3d348b9b;
        }

        span:last-child {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            background-color: #2196F3;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.320, 1);
        }

        span:first-child {
            position: relative;
            z-index: 1;
        }
    }

    .animated-button:hover {
        box-shadow: 0 0 0 5px #2195f360;

        a {
            color: white;
        }

        span:last-child {
            width: 190px;
            height: 150px;
            opacity: 1;
        }
    }

    .animated-button:active {
        scale: 0.95;
    }

    table.table {
        --bs-table-bg: #3d348b42;
        --bs-table-striped-bg: #3d348b26;

        th {
            color: rgb(71, 0, 102);
            text-transform: uppercase;
            vertical-align: middle;
        }

        td {
            color: #231f4d;
            vertical-align: middle;
        }
    }
</style>
