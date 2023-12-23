@extends('layouts.admin')

@section('content')
    <div class="container my-3">
        <div class="row justify-content-around">
            <div class="d-none d-xl-flex align-items-center col-5">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="logo">
            </div>

            <form class="form col-12 col-md-9 col-xl-5 px-5 d-flex flex-column justify-content-center" method="POST"
                action="{{ route('login') }}">

                @csrf
                <span class="signup">Accesso</span>

                <input id="email" type="email" placeholder="Indirizzo Email"
                    class="form--input
                    @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>

                <input id="password" type="password" placeholder="Password"
                    class="form--input mb-0 @error('password') is-invalid mb-0 @enderror" name="password" required
                    autocomplete="current-password">
                @if (Route::has('password.request'))
                    <a style="color: #3d348b; font-size:13px;"
                        class="btn btn-link p-0 text-decoration-none align-self-start @error('password') is-invalid mb-0 @enderror"
                        href="{{ route('password.request') }}">
                        Password dimenticata?
                    </a>
                @endif
                @error('password')
                    <span class="invalid-feedback mb-1 mt-0" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                @error('email')
                    <span class="invalid-feedback mb-1 mt-0" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <button class="form--submit mt-2" type="submit">
                    Accedi
                </button>

                <span style="font-size: 13px;" class="mt-2 mb-5">
                    Sei nuovo su DeliveBoo?
                    <a class="text-decoration-none text-black"
                        href="{{ route('register') }}"><strong>Registrati</strong></a>
                </span>

                <div class="mt-2">CONTINUA CON:</div>

                <div class="socials-container">
                    <a href="#" class="social twitter text-decoration-none">
                        <i class="fa-brands fa-twitter"></i>
                    </a>

                    <a href="#" class="social facebook text-decoration-none">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="#" class="social google-plus text-decoration-none">
                        <i class="fa-brands fa-google"></i>
                    </a>

                    <a href="#" class="social instagram text-decoration-none">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </div>
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


    .socials-container {
        width: fit-content;
        height: fit-content;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 25px;
        padding: 20px 40px;
        background-color: transparent;
    }

    .social {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        border: 1px solid #3d348b;
        color: #3d348b;
    }

    .twitter:hover {
        background: linear-gradient(45deg, #66757f, #00acee, #36daff, #dbedff);
        color: white;
        border-color: white;
    }

    .facebook:hover {
        background: linear-gradient(45deg, #134ac0, #316ff6, #78a3ff);
        color: white;
        border-color: white;
    }

    .google-plus:hover {
        background: linear-gradient(45deg, #872419, #db4a39, #ff7061);
        border-color: white;
        color: white;
    }

    .instagram:hover {
        background: #f09433;
        background: -moz-linear-gradient(45deg,
                #f09433 0%,
                #e6683c 25%,
                #dc2743 50%,
                #cc2366 75%,
                #bc1888 100%);
        background: -webkit-linear-gradient(45deg,
                #f09433 0%,
                #e6683c 25%,
                #dc2743 50%,
                #cc2366 75%,
                #bc1888 100%);
        background: linear-gradient(45deg,
                #f09433 0%,
                #e6683c 25%,
                #dc2743 50%,
                #cc2366 75%,
                #bc1888 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f09433', endColorstr='#bc1888', GradientType=1);
        border-color: white;
        color: white;
    }

    .social svg {
        fill: white;
        height: 20px;
    }
</style>
