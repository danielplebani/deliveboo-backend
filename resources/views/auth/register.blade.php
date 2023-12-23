@extends('layouts.admin')

@section('content')
    <div class="container my-2">
        <div class="row justify-content-around">
            <div class="d-none d-xl-flex align-items-center col-5">
                <img class="img-fluid" src="{{ asset('img/logo.png') }}" alt="logo">
            </div>

            <form id="registrationForm" class="form col-12 col-md-9 col-xl-5 px-5 d-flex flex-column" method="POST"
                action="{{ route('register') }}">
                @csrf
                <span class="signup">Registrazione</span>



                <input id="name" type="text" placeholder="Nome e cognome"
                    class="mb-0 form--input @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"
                    required autocomplete="name" autofocus>



                <input id="email" type="email" placeholder="Indirizzo Email"
                    class="mt-4 mb-0 form--input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div style="height: 25px;" class="d-flex align-items-center">
                    @error('email')
                        <span style="font-size: 13px" class="text-danger">
                            {{ $message }}
                        </span>
                    @enderror
                </div>



                <input id="vat_number" type="text" placeholder="Partita IVA"
                    class="mb-0 form--input @error('vat_number') is-invalid @enderror" name="vat_number"
                    value="{{ old('vat_number') }}" required autocomplete="vat_number" autofocus>
                <div style="height: 25px" class="d-flex align-items-center">
                    <span style="font-size: 13px" id="vat_number-error" class="text-danger"></span>
                </div>



                <input id="password" type="password" placeholder="Password" class="mb-0 form--input" name="password"
                    required autocomplete="new-password">
                <div style="height: 25px" class="d-flex align-items-center">
                    <span style="font-size: 13px" id="password-error-2" class="text-danger"></span>
                </div>



                <input id="password-confirm" type="password" placeholder="Conferma password"
                    class="mb-0 form--input @error('password-confirm') is-invalid @enderror @error('password') is-invalid @enderror"
                    name="password_confirmation" value="{{ old('password-confirm') }}" required autocomplete="new-password"
                    autofocus>
                <div style="height: 25px" class="d-flex align-items-center">
                    <span style="font-size: 13px" id="password-error" class="text-danger"></span>
                </div>



                <button class="form--submit mt-1" type="submit">
                    Registrati
                </button>

                <span style="font-size: 13px;" class="mt-2">
                    Hai già un account su DeliveBoo?
                    <a class="text-decoration-none text-black" href="{{ route('login') }}"><strong>Accedi</strong></a>
                </span>
            </form>

        </div>
    </div>

    <script>
        // Funzione per validare la conferma della password
        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password-confirm').value;
            const passwordError = document.getElementById('password-error');

            if (password !== confirmPassword) {
                passwordError.innerText = 'Le password non coincidono';
                return false;
            } else {
                passwordError.innerText = '';
                return true;
            }
        }
        document.getElementById('password').addEventListener('input', validatePassword);
        document.getElementById('password-confirm').addEventListener('input', validatePassword);

        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            if (!validatePassword()) {
                event.preventDefault();
            }
        });



        // Funzione per validare la lunghezza della partita IVA
        function validateVatNumber() {
            const vatNumber = document.getElementById('vat_number').value;
            return vatNumber.length === 11;
        }
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const vatError = document.getElementById('vat_number-error');
            if (!validateVatNumber()) {
                vatError.innerText = 'La partita IVA deve essere di 11 caratteri';
                event.preventDefault();
            } else {
                vatError.innerText = '';
            }
        });
        document.getElementById('vat_number').addEventListener('input', function() {
            const vatError = document.getElementById('vat_number-error');
            if (!validateVatNumber()) {
                vatError.innerText = 'La partita IVA deve essere di 11 caratteri';
            } else {
                vatError.innerText = '';
            }
        });



        // Funzione per validare la lunghezza della password
        function validatePasswordLength() {
            const password = document.getElementById('password').value;
            return password.length >= 8;
        }
        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            const passwordError = document.getElementById('password-error-2');
            if (!validatePasswordLength()) {
                passwordError.innerText = 'La password deve contenere almeno 8 caratteri';
                event.preventDefault();
            } else {
                passwordError.innerText = '';
            }
        });
        document.getElementById('password').addEventListener('input', function() {
            const passwordError = document.getElementById('password-error-2');
            if (!validatePasswordLength()) {
                passwordError.innerText = 'La password deve contenere almeno 8 caratteri';
            } else {
                passwordError.innerText = '';
            }
        });
    </script>
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
