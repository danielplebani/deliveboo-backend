@extends('layouts.admin')

@section('content')
    <div class="container-lg px-sm-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span>
                <em>{{ Auth::user()->name }} /
                    <strong>
                        <a class="text-dark text-decoration-none" href="{{ route('admin.restaurants.index') }}">
                            Ristoranti({{ count($restaurants) }})
                        </a>
                    </strong>
                </em>
            </span>

            <button class="animated-button">
                <a href="{{ route('admin.restaurants.create') }}" class="text-decoration-none">
                    <span><i class="fa-solid fa-plus"></i> Nuovo ristorante</span>
                    <span></span>
                </a>

            </button>

        </div>


        @if (count($restaurants) > 0)
            <h2 class="text-center fw-bolder text-uppercase mb-4">
                I tuoi ristoranti
            </h2>

            <div class="row flex-column align-items-center gap-4">
                @foreach ($restaurants as $restaurant)
                    <div class="restaurant-card p-md-3 p-lg-4 d-flex gap-5 col-xxl-10">
                        <a class="text-decoration-none text-dark d-flex align-items-center gap-sm-3 gap-md-5"
                            href="{{ route('admin.restaurants.show', $restaurant) }}">

                            @if (str_contains($restaurant->image, 'http'))
                                <img class="d-none d-sm-block" src="{{ $restaurant->image }}" alt="restaurant">
                            @else
                                <img class="d-none d-sm-block" src="{{ asset('storage/' . $restaurant->image) }}"
                                    alt="restaurant">
                            @endif



                            <div
                                class="col-10 col-sm-6 col-md-4 col-lg-6 d-flex flex-column justify-content-start gap-3 py-5">
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
                                href="{{ route('admin.restaurants.orders', $restaurant) }}"><button type="button"
                                    class="order-button">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                </button>
                            </a>

                            <a class="text-decoration-none"
                                href="{{ route('admin.restaurants.edit', $restaurant) }}"><button type="button"
                                    class="edit-button">
                                    <i class="fa-solid fa-pencil"></i>
                                </button>
                            </a>

                            <button type="button" class="delete-button" data-bs-toggle="modal"
                                data-bs-target="#exampleModal_{{ $restaurant->id }}">
                                <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                    <path
                                        d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                    </path>
                                </svg>
                            </button>



                            <div class="modal fade" id="exampleModal_{{ $restaurant->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content bg_select">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 text-uppercase col_color" id="exampleModalLabel">
                                                <strong>Elimina il
                                                    ristorante</strong>
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body border-0 text-white">
                                            Sei sicuro di voler eliminare questo ristorante?
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annulla</button>
                                            <form action="{{ route('admin.restaurants.destroy', $restaurant) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="fa-solid fa-trash"></i>
                                                    Elimina</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="d-flex flex-column align-items-center pt-5">
                <span class="fs-3">non hai nessun ristorante</span>
                <i class="fa-regular fa-face-sad-cry fs-1"></i>
            </div>
        @endif
    </div>
@endsection


<style lang="scss" scoped>
    .restaurant-card {
        border-radius: 30px;
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
        cursor: pointer;
        position: relative;

        .edit-and-delete {
            position: absolute;
            top: 35px;
            right: 35px;
        }

        img {
            min-width: 18rem;
            width: 18rem;
            aspect-ratio: 1/1;
            border-radius: 50%;
            object-fit: cover;
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
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
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

    .restaurant-card:hover {
        box-shadow: 0 0 32px #3d348b9b;
    }

    .restaurant-card:hover img {
        transform: scale(1.1)
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
            color: #ffffff;
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
</style>
