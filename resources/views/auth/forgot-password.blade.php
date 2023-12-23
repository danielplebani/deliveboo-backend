@extends('layouts.admin')

@section('content')
    <div class="container my-3">
        <div class="row justify-content-around">
            <div class="d-none d-xl-flex align-items-center col-5">
                <img class="img-fluid" src="{{ asset('img/cicogna-errore.png') }}" alt="logo">
            </div>

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form class="form col-10 col-md-9 col-xl-5 px-5 d-flex flex-column justify-content-center" method="POST"
                action="{{ route('password.email') }}">

                @csrf

                <span class="signup">Resetta password</span>

                <input id="email" type="email" placeholder="Indirizzo Email"
                    class="form--input
                        @error('email') is-invalid mb-0 @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback mb-2" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <button class="form--submit mt-2">
                    Invia email
                </button>


            </form>

        </div>
    </div>
@endsection



<style lang="scss" scoped>
    .form {
        padding: 3.125em;
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
    }

    .signup {
        color: rgb(77, 75, 75);
        text-transform: uppercase;
        letter-spacing: 2px;
        display: block;
        font-weight: bold;
        font-size: x-large;
        margin-bottom: 0.5em;
    }

    .form--input {
        width: 100%;
        margin-bottom: 1.25em;
        height: 40px;
        border-radius: 5px;
        border: 1px solid gray;
        padding: 0.8em;
        outline: none;
    }

    .form--input:focus {
        border: 1px solid #3d348b;
        box-shadow: 0 0 10px #3d348b8a;
        outline: none;
    }

    .form--marketing {
        display: flex;
        margin-bottom: 1.25em;
        align-items: center;
    }

    .form--marketing>input {
        margin-right: 0.625em;
    }

    .form--marketing>label {
        color: grey;
    }

    .checkbox,
    input[type="checkbox"] {
        accent-color: #3d348b;
    }

    .form--submit {
        width: 50%;
        padding: 0.625em;
        border-radius: 5px;
        color: white;
        background-color: #3d348b;
        border: 1px dashed #3d348b;
        cursor: pointer;
    }

    .form--submit:hover {
        box-shadow: 0px 0px 15px #534e81;
        background-color: white;
        border: #3d348b;
        color: #3d348b;
        font-weight: bold;
        cursor: pointer;
        transition: 0.5s;
    }
</style>
