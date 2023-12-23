@extends('layouts.admin')

@section('page-title', 'Aggiorna ristorante')

@section('content')
    <div class="container-lg px-sm-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="d-flex align-items-center gap-1">
                <a class="d-none d-sm-block text-dark" href="{{ route('admin.restaurants.index') }}"><i
                        class="fa-solid fa-circle-arrow-left fs-3 me-2"></i></a>

                <em> <a class="text-dark text-decoration-none" href="{{ route('admin.restaurants.index') }}">
                        {{ $restaurant->name }}
                    </a> /
                    <strong>
                        Modifica ristorante
                    </strong>
                </em>
            </span>
        </div>

        <h2 class="fw-bolder text-center mb-4">
            Modifica ristorante:
        </h2>

        <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="mb-3 form-floating ">

                <input type="text" class="form-control " name="name" id="name" aria-describedby="helpId"
                    placeholder="Ristorante Miramare" value="{{ old('name', $restaurant->name) }}">
                <label for="name" class="form-label text-warning">Nome del locale</label>
                <div>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 form-floating">

                <input type="text" class="form-control" name="address" id="address" aria-describedby="addressHelper"
                    placeholder="Via don Mattei 43, Brescia" value="{{ old('address', $restaurant->address) }}">
                <label for="address" class="form-label text-warning">Indirizzo</label>
                <div>
                    @error('address')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 form-floating">
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ old('description', $restaurant->description) }}</textarea>
                <label for="floatingTextarea2" class="text-warning">Descrizione</label>
            </div>

            <div class="mb-3 pt-2 form-floating">
                <div class="list-group">
                    <div class="rounded-2">
                        <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.2);"
                            class="bg-white p-2 rounded-top-2 text-warning ">
                            Tipologia/e di
                            cucina</div>
                        <div class="d-flex flex-wrap">
                            @foreach ($types as $type)
                                @if ($errors->any())
                                    <label
                                        class="col-12 col-sm-6 border-0 border-bottom list-group-item @error('types') is-invalid @enderror">
                                        <input class="form-check-input" name="types[]" id="types" type="checkbox"
                                            value="{{ $type->id }}"{{ in_array($type->id, old('types', [])) ? 'checked' : '' }}>
                                        {{ $type->name }}
                                    </label>
                                @else
                                    <label
                                        class="col-12 col-sm-6 border-0 border-bottom list-group-item @error('types') is-invalid @enderror">
                                        <input class="form-check-input" name="types[]" id="types" type="checkbox"
                                            value="{{ $type->id }}"{{ $restaurant->types->contains($type) ? 'checked' : '' }}>
                                        {{ $type->name }}
                                    </label>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div>
                        @error('types')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>


            <div class="mb-3">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.2)"
                    class="form-label text-warning rounded-top-2 bg-white p-2 pb-0 mb-0">
                    @if ($restaurant->image)
                        <img src="{{ asset('storage/' . $restaurant->image) }}" class="rounded-2 mb-1"
                            style="max-width: 200px; max-height: 200px;">
                    @endif
                    <div>Modifica immagine</div>
                </div>
                <input type="file" class="form-control rounded-0 border-0 rounded-bottom-2" name="image" id="image"
                    placeholder="" aria-describedby="image_helper">
                <div>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-warning text-uppercase text-white">
                Modifica
            </button>
        </form>
    </div>

@endsection
