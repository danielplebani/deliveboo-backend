<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>
        Ciao {{ $lead->username }}!
    </h1>

    <p>
        Prepara la tavola! <br>
        Il tuo ordine di Deliveboo sta arrivando! <br>
        Ecco un riepilogo dei dati che hai inserito: <br>
        Nome e cognome: {{ $lead->username }} <br>
        Email: {{ $lead->user_mail }} <br>
        Telefono: {{ $lead->phone }}
    </p>

    <br>

    <p>
        Il cibo da spedire a: <br>
        Indirizzo: {{ $lead->address }} <br>
    </p>

    <p>
        Message: <br>
        {{ $lead->notes }}
    </p>
</body>

</html>
