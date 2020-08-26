{assign var='messaggio' value=$messaggio|default:'ok'}
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>admin vinili</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
<nav class="navbar navbar sticky-top navbar-dark bg-dark">
    <div class="container=50px">
        <a class="navbar-brand" href="/vinylwebmarket/Homepage/impostaPaginaUL">
            <img src="\vinylwebmarket\Utility\immagini\logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
            Vinyl Web Market
        </a>
    </div>
</nav>

<nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
    <div class="container=50px">

    </div>
    <a class="navbar-brand" href="/vinylwebmarket/Homepage/impostaPaginaUL">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/User/Logout">Log Out</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/User/profile">Profilo</a>
            </li>

            <li class="nav-item dropdown">
        </ul>
        <form class="form-inline my-2 my-lg-0" method="POST" action="/vinylwebmarket/Filtro/ricercaParola">
            <input name="parola" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-blue rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">I miei vinili in vendita:</h6>
        </div>
    </div>
    {if $messaggio=='modifica'}
        <div style="color: green">
            <h4 align="center">Modifica effettuata correttamente!</h4>
        </div>
    {/if}
    {if $messaggio=='eliminazione'}
        <div style="color: red">
            <h4 align="center">Vinile eliminato correttamente!</h4>
        </div>
    {/if}
        <div class=" text-muted pt-3 ">
            {if $vinili}
                {if is_array($vinili)}
                    {for $i=0 to $n_vinili}
                        <div class="row border-bottom">
                            <div class="col-md-1 mt-2 mb-2">
                                    <img class="rounded-circle ml-3" width="60" height="60" src="data:{$type[$i]};base64,{$pic64[$i]}" />
                            </div>
                            <div class="col-md-7 ">
                                <p class="mt-1">
                                    <strong>Titolo: {$vinili[$i]->getTitolo()} | Artista: {$vinili[$i]->getArtista()} </strong>
                                    <br>
                                    Q.ta:{$vinili[$i]->getQuantita()}
                                    <br>
                                    Prezzo:{$vinili[$i]->getPrezzo()}€
                                </p>
                            </div>
                            <div class="col-md-2 mt-3">
                                <form action="/vinylwebmarket/Vinile/AggiornaVinile" method="POST">
                                    <label for="quantity">Q.ta</label>
                                    <input type="number" id="quantity" name="quantità" min="1" max="100" step="1" PLACEHOLDER="{$vinili[$i]->getQuantita()}">
                                    <input type="hidden" name="id" value="{$vinili[$i]->getId()}" />
                                    <button class="btn btn-success" type="submit" value="Submit">Aggiorna quantità</button>
                                    <br>
                                    <br>
                                </form>
                            </div>
                            <div class="col-md-2 mt-3">
                                <a href="/vinylwebmarket/Vinile/EliminaVinile/{$vinili[$i]->getId()}">
                                    <center><button class="btn btn-danger">Elimina</button></center>
                                </a>
                            </div>

                            </div>
                        </div>
                    {/for}
                {else}
                <div class="row border-bottom">
                    <div class="col-md-1 mt-2 mb-2">
                        <img class="rounded-circle ml-3" width="60" height="60" src="data:{$type};base64,{$pic64}" />
                    </div>
                    <div class="col-md-7 ">
                        <p class="mt-1">
                            <strong>Titolo: {$vinili->getTitolo()} | Artista: {$vinili->getArtista()} </strong>
                            <br>
                            Q.ta:{$vinili->getQuantita()}
                            <br>
                            Prezzo:{$vinili->getPrezzo()}€
                        </p>
                    </div>
                    <div class="col-md-2 mt-3">
                        <form action="/vinylwebmarket/Vinile/AggiornaVinile" method="POST">
                            <label for="quantity">Q.ta</label>
                            <input type="number" id="quantity" name="quantità" min="1" max="100" step="1" PLACEHOLDER="{$vinili->getQuantita()}">
                            <input type="hidden" name="id" value="{$vinili->getId()}" />
                            <button class="btn btn-success" type="submit" value="Submit">Aggiorna quantità</button>
                            <br>
                            <br>
                        </form>
                    </div>
                    <div class="col-md-2 mt-3">
                        <a href="/vinylwebmarket/Vinile/EliminaVinile/{$vinili->getId()}">
                            <center><button class="btn btn-danger">Elimina</button></center>
                        </a>
                    </div>
                </div>
                </div>
                {/if}
            {else}
                Al momento non hai vinili in vendita
            {/if}
        </div>
    </div>



</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
</body>
</html>