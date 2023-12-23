@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success mt-4" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <h1 class="text-muted pt-4">&#128898; Ristoranti Eliminati 🗑</h1>
    <div class="card my-5">

        <div class="card-body p-0">

            <div class="table-responsive-sm ">
                <table class="table table-hover table-striped table-borderless custom_table align-middle text-center">
                    <thead class="">
                        <caption>Trashed restaurants table</caption>
                        <tr>
                            <th>ID</th>
                            <th>TIPOLOGIA</th>
                            <th>NOME</th>
                            <th>DESCRIZIONE</th>
                            <th>IMMAGINE</th>
                            <th>AZIONE</th>

                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($trashed as $trashed_restaurant)
                            <tr class="table-secondary">
                                <td scope="row">{{ $trashed_restaurant->id }}</td>
                                <td><span class="badge rounded-pill w-100 col-1 d-flex flex-wrap gap-2">
                                        @foreach ($trashed_restaurant->types as $type)
                                            <li class="badge bg-secondary">
                                                {{ $type->name }}
                                            </li>
                                        @endforeach
                                    </span>
                                </td>
                                <td>{{ $trashed_restaurant->name }}</td>
                                <td class="w-50">{{ $trashed_restaurant->description }}</td>
                                <td>
                                    @if (str_contains($trashed_restaurant->image, 'http'))
                                        <img height="100" src="{{ asset($trashed_restaurant->image) }}"
                                            alt="trashed_ preview">
                                    @else
                                        <img height="100" src="{{ asset('storage/' . $trashed_restaurant->image) }}"
                                            alt="restaurant preview">
                                    @endif

                                </td>

                                <td>
                                    <div class="col d-flex justify-content-evenly">

                                        <form action="{{ route('admin.restore', $trashed_restaurant->slug) }}"
                                            method="post">

                                            @csrf

                                            @method('PUT')

                                            <button class="btn btn-warning" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-arrow-counterclockwise"
                                                    viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                                    <path
                                                        d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Modal trigger button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modalId-{{ $trashed_restaurant->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                                <path
                                                    d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z" />
                                            </svg>
                                        </button>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-{{ $trashed_restaurant->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $trashed_restaurant->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="modalTitleId-{{ $trashed_restaurant->id }}">Stai
                                                            cancellando il tuo ristorante
                                                            "{{ $trashed_restaurant->name }}"
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Attenzione! Questa operazione è irreversibile! Questa operazione
                                                        cancellerà il tuo ristorante <span
                                                            class="text-decoration-underline text-danger">permanentemente!</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annulla</button>

                                                        <form
                                                            action="{{ route('admin.forceDelete', $trashed_restaurant->slug) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-danger">Elimina</button>

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty

                            <td></td>
                            <td></td>
                            <td>non ci sono ristoranti eliminati ♻</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{ $trashed->links('pagination::bootstrap-5') }}
@endsection
