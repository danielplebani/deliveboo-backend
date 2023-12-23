@extends('layouts.admin')

@section('page-title', 'crea piatto')

@section('content')
    <div class="container-lg px-sm-5">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="d-flex align-items-center gap-1">
                <a class="d-none d-sm-block text-dark" href="{{ route('admin.restaurants.show', $restaurant) }}"><i
                        class="fa-solid fa-circle-arrow-left fs-3 me-2"></i></a>
                <em class="d-flex align-items-center gap-1">
                    <a class="d-none d-md-block text-dark text-decoration-none"
                        href="{{ route('admin.restaurants.show', $restaurant) }}">
                        {{ $restaurant->name }}
                    </a> /
                    <strong>
                        Nuovo piatto
                    </strong>
                </em>
            </span>
        </div>

        <h2 class="fw-bolder text-center mb-4">
            Crea un nuovo piatto:
        </h2>


        <form action="{{ route('admin.restaurant.dishes.store', $restaurant->id) }}" method="POST"
            enctype="multipart/form-data">

            @csrf
            <div class="mb-3 form-floating">
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId"
                    placeholder="Pasta al ragù" value="{{ old('name') }}">
                <label for="name" class="form-label text-warning">Nome</label>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-floating">
                <input type="text" class="form-control" name="price" id="price" aria-describedby="priceHelper"
                    placeholder="22.50$" value="{{ old('price') }}">
                <label for="price" class="form-label text-warning d-flex gap-2 align-items-center">Prezzo <i
                        class="fa-solid fa-euro-sign"></i></label>
                @error('price')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-floating mb-3">
                <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                    placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px">{{ old('description') }}</textarea>
                <label for="floatingTextarea2" class="text-warning">Descrizione</label>
            </div>


            <div class="mb-3">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.2)"
                    class="form-label text-warning mb-0 bg-white p-2 rounded-top-2">Portata</div>
                <select class="form-select @error('course') is-invalid  @enderror rounded-top-0 border-0" name="course"
                    id="course">
                    <option value="1" selected>Primo piatto</option>
                    <option value="2">Secondo piatto</option>
                    <option value="3">Dolce</option>
                    <option value="4">Antipasto</option>
                    <option value="5">Contorno</option>
                </select>


                @error('course')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-floating">

                <input type="text" class="form-control" name="ingredients" id="ingredients"
                    aria-describedby="ingredientsHelper" placeholder="Aglo, olio, peperoncino..."
                    value="{{ old('ingredients') }}">
                <label for="ingredients" class="form-label text-warning">Ingredienti</label>


                @error('ingredients')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            </div>

            <div class="mb-3">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.2)"
                    class="form-label text-warning p-2 mb-0 bg-white rounded-top-2">Disponibilità</div>
                <select class="form-select @error('available') is-invalid  @enderror border-0 rounded-top-0"
                    name="available" id="available">
                    <option value="1" selected>Disponibile</option>
                    <option value="0">Esaurito</option>
                </select>

                @error('available')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <div style="border-bottom: 1px solid rgba(128, 128, 128, 0.2)"
                    class="form-label text-warning rounded-top-2 bg-white p-2 mb-0">Scegli immagine</div>
                <input type="file" class="form-control rounded-top-0 border-0" name="image" id="image"
                    placeholder="" aria-describedby="image_helper">

                @error('image')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-warning text-white text-uppercase">
                CREA piatto
            </button>
        </form>

    </div>
@endsection
