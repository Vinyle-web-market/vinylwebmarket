
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Installazione</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.1/examples/cover/">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

</head>

<body class="text-center">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <div class="row">
                <h1 class="cover-heading mt-5 mr-4">Installazione VinylWebMarket</h1>
                <img src="/vinylwebmarket/Utility/immagini/logo.svg"  width="190" height="160">
            </div>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h3 class=" text-danger">{if isset($nophpv)} La tua versione di php non è compatibile! {/if} {if isset($nocookie)} L'app necessita dei cookie abilitati! {/if} <br> {if isset($nojs)} L'app necessita di javascript! {/if}<br> </h3>
        <h3 class="pb-3">Profilo Database</h3>
        <form action="/vinylwebmarket/" method="POST">
            <div class="form-group">
                <label>Nome del database</label>
                <input class="form-control" name="nomedb"> </div>
            <div class="form-group">
                <label>Nome Utente</label>
                <input type="text" class="form-control" name="nomeutente"> </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password"> </div>
            <div class="form-group">
                <button type="submit" class="btn mt-2 btn btn-light" onclick="setcookie()">Installa</button>
    </main>

    <footer class="mastfoot mt-auto">
    </footer>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
