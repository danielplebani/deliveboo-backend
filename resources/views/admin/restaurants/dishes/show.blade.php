@extends('layouts.admin')

@section('content')
    <div class="container-xl px-1 px-md-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <span class="d-flex align-items-center">
                <a class="text-dark" href="{{ route('admin.restaurants.show', $restaurant) }}"><i
                        class="fa-solid fa-circle-arrow-left fs-3 me-2"></i></a>

                <em class="d-flex gap-1">
                    <a class="d-none d-md-block text-dark text-decoration-none"
                        href="{{ route('admin.restaurants.show', $restaurant) }}">
                        {{ $restaurant->name }}
                    </a> /
                    <strong>
                        <a class="text-dark text-decoration-none"
                            href="{{ route('admin.restaurant.dishes.show', [$restaurant, $dish]) }}">
                            {{ $dish->name }}
                        </a>
                    </strong>
                </em>
            </span>

            <div class="d-flex gap-2 gap-lg-3">
                <button class="animated-button">
                    <a href="{{ route('admin.restaurant.dishes.edit', [$restaurant, $dish]) }}"
                        class="text-decoration-none d-flex align-items-center gap-1">
                        <span><i class="fa-solid fa-pen"></i> Modifica</span>
                        <span></span>
                    </a>
                </button>


                <button class="d-none d-sm-block animated-delete-button" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal_{{ $dish->id }}">
                    <span><i class="fa-solid fa-trash"></i> Elimina</span>
                    <span></span>
                </button>

                <div class="modal fade" id="exampleModal_{{ $dish->id }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content bg_select">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 text-uppercase col_color" id="exampleModalLabel">
                                    <strong>Elimina il
                                        piatto</strong>
                                </h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body border-0 text-white">
                                Sei sicuro di voler eliminare questo piatto?
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                <form action="{{ route('admin.restaurant.dishes.destroy', [$restaurant, $dish]) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i>
                                        Elimina</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row justify-content-around justify-content-md-around justify-content-xl-between">
            <div class="col-10 mb-4 mb-md-0 col-md-6 position-relative">
                @if ($dish->available)
                    <div style="background-color:green;" class="rounded-top-5 text-center">
                        <strong class="text-white"><em>DISPONIBILE</em></strong>
                    </div>
                @else
                    <div style="background-color: red;" class="rounded-top-5 text-center">
                        <strong class="text-white"><em>ESAURITO</em></strong>
                    </div>
                @endif

                @if (str_contains($dish->image, 'http'))
                    <img style="object-fit: cover" class="rounded-bottom-5 w-100 shadow" src="{{ $dish->image }}"
                        alt="dish-image">
                @else
                    <img style="object-fit:cover;" class="dish-img rounded-bottom-5 w-100 shadow"
                        src="{{ asset('storage/' . $dish->image) }}" alt="dish-image">
                @endif

                <div class="badge-price bg_select shadow">
                    <strong>{{ $dish->price }}€</strong>
                </div>
            </div>

            <div class="col-10 col-md-5 d-flex flex-column justify-content-center">
                <h4 class="mb-0 dish-name text-uppercase">{{ $dish->name }}</h4>

                <span class="fst-italic">
                    @switch($dish->course)
                        @case(1)
                            Primo piatto
                        @break

                        @case(2)
                            Secondo piatto
                        @break

                        @case(3)
                            Dolce
                        @break

                        @case(4)
                            Antipasto
                        @break

                        @case(5)
                            Contorno
                        @break

                        @case(6)
                            Bibita
                        @break

                        @default
                    @endswitch
                </span>

                <span class="my-3 my-md-4">Ingredienti: {{ $dish->ingredients }}</span>

                <p>{{ $dish->description }}</p>
            </div>
        </div>
    </div>
@endsection




<style lang="scss" scoped>
    .animated-button,
    .animated-delete-button {
        position: relative;
        display: inline-block;
        box-shadow: 0 0 0 2px #3d348b9b;
        padding: 12px 24px;
        border: none;
        font-size: 16px;
        background-color: inherit;
        border-radius: 100px;
        font-weight: 600;
        cursor: pointer;
        overflow: hidden;
        transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);

        a,
        span {
            color: #3d348b9b;
        }

        span:last-child {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border-radius: 50%;
            opacity: 0;
            transition: all 0.8s cubic-bezier(0.23, 1, 0.320, 1);
        }

        span:first-child {
            position: relative;
            z-index: 1;
        }
    }

    .animated-button {
        span:last-child {
            box-shadow: 0 0 0 5px #2195f360;
            background-color: #2196F3;
        }
    }

    .animated-button:hover {
        box-shadow: 0 0 0 5px #2195f360;
    }

    .animated-delete-button {
        span:last-child {
            box-shadow: 0 0 0 5px #2195f360;
            background-color: red;
        }
    }

    .animated-delete-button:hover {
        box-shadow: 0 0 0 5px rgba(255, 0, 0, 0.3);
    }

    .animated-button:hover,
    .animated-delete-button:hover {

        a,
        span {
            color: #ffffff;
        }

        span:last-child {
            width: 190px;
            height: 150px;
            opacity: 1;
        }
    }

    .animated-button:active,
    .animated-delete-button:active {
        scale: 0.95;
    }

    .dish-name {
        font-weight: bold;
    }

    .badge-price {
        color: white;
        padding: 15px;
        border-radius: 50%;
        position: absolute;
        top: -15px;
        right: -15px;
        font-size: 1.7rem;

    }

    .dish-img {
        min-height: 51.7vh;
    }

    @media screen and (max-width:450px) {
        .badge-price {
            padding: 10px;
            position: absolute;
            top: -5px;
            right: -10px;
            font-size: large;
        }

        .dish-img {
            min-height: 35vh;
        }
    }
</style>
