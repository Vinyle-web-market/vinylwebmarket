{assign var='immagine' value=$immagine|default:'ok'}
{assign var='immagine_1' value=$immagine_1|default:'ok'}
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
</head>
<body>
<nav class="navbar navbar sticky-top navbar-dark bg-dark">
    <div class="container=50px">
        <a class="navbar-brand" href="/vinylwebmarket/Admin/homepage">
            <img src="\vinylwebmarket\Utility\immagini\logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
            Vinyl Web Market
        </a>
    </div>
</nav>
<nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/Admin/homepage">Homepage</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/Admin/elencoRecensioni">Visualizza recensioni</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/Admin/elencoAbbonamenti">Visualizza abbonamenti</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/vinylwebmarket/User/Logout">Log Out</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="/vinylwebmarket/Admin/ricercaParolaVinile" method="post">
            <input class="form-control mr-sm-2" type="search" placeholder="Cerca parola" aria-label="Search" name="parola">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
<main role="main" class="container">
    <div class="d-flex align-items-center p-3 my-3 text-white-50 bg-blue rounded shadow-sm">
        <div class="lh-100">
            <h6 class="mb-0 text-white lh-100">Elenco vinili:</h6>
        </div>
    </div>

    <!-- ANNUNCI ATTIVI -->
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">VINILI ATTIVI</h6>
        <div class=" text-muted pt-3 ">
            {if $viniliAttivi}
                {if is_array($viniliAttivi)}
                    {for $i=0 to $n_attivi}
                        <div class="row border-bottom">
                            <div class="col-md-1 mt-2 mb-2">
                                {if $immagine == 'ok'}
                                    <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA[$i]};base64,{$pic64att[$i]}"  alt="profile picture" />
                                {else}
                                    <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                                {/if}
                            </div>
                            <div class="col-md-9 ">
                                <p class="mt-1">
                                    <strong class="d-block text-gray-dark">Vinile venduto da: {$viniliAttivi[$i]->getVenditore()->getEmail()} </strong>
                                   Titolo: {$viniliAttivi[$i]->getTitolo()}
                                    <br>
                                    Artista: {$viniliAttivi[$i]->getArtista()}
                                </p>
                            </div>
                            <div class="col-md-2 mt-3">
                                <form action="/vinylwebmarket/Admin/bannaggioVinile/{$viniliAttivi[$i]->getId()}" method="POST">
                                    <button class="btn btn-danger">Banna</button>
                                </form>
                            </div>
                        </div>
                    {/for}
                {else}
                    <div class="row">
                        <div class="col-md-1 mt-2 mb-2">
                            {if $immagine == 'ok'}
                                <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA};base64,{$pic64att}"  alt="profile picture" />
                            {else}
                                <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                            {/if}
                        </div>
                        <div class="col-md-9 ">
                            <p class="mt-1">
                                <strong class="d-block text-gray-dark">Vinile venduto da: {$viniliAttivi->getVenditore()->getEmail()} </strong>
                                Titolo: {$viniliAttivi->getTitolo()}
                                <br>
                                Artista: {$viniliAttivi->getArtista()}
                            </p>
                        </div>
                        <div class="col-md-2 mt-3">
                            <form action="/vinylwebmarket/Admin/bannaggioVinile/{$viniliAttivi->getId()}" method="POST" >
                                <button class="btn btn-danger">Banna</button>
                            </form>

                        </div>
                    </div>
                {/if}
            {else}
                Al momento non ci sono vinili attivi
            {/if}
        </div>
    </div>

    <!-- ANNUNCI BANNATI -->
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">VINILI BANNATI</h6>
        <div class=" text-muted pt-3 border-bottom ">
            {if $viniliBannati}
                {if is_array($viniliBannati)}
                    {for $i=0 to $n_bannati}
                        <div class="row border-bottom">
                            <div class="col-md-1 mt-2 mb-2">
                                {if $immagine_1 == 'ok'}
                                    <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeB[$i]};base64,{$pic64ban[$i]}"  alt="profile picture" />
                                {else}
                                    <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                                {/if}
                            </div>
                            <div class="col-md-9 ">
                                <p class="mt-1">
                                    <strong class="d-block text-gray-dark">Venile venduto da: {$viniliBannati[$i]->getVenditore()->getEmail()} </strong>
                                   Titolo: {$viniliBannati[$i]->getTitolo()}
                                    <br>
                                    Artista: {$viniliBannati[$i]->getArtista()}
                                </p>
                            </div>
                            <div class="col-md-2 mt-3">
                                <form action="/vinylwebmarket/Admin/ripristinazioneVinile/{$viniliBannati[$i]->getId()}" method="POST">
                                    <button class="btn btn-success">Ripristina</button>
                                </form>
                            </div>
                        </div>
                    {/for}
                {else}
                    <div class="row">
                        <div class="col-md-1 mt-2 mb-2">
                            {if $immagine_1 == 'ok'}
                                <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeB};base64,{$pic64ban}"   alt="profile picture" />
                            {else}
                                <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                            {/if}
                        </div>
                        <div class="col-md-9 ">
                            <p class="mt-1">
                                <strong class="d-block text-gray-dark">Venile venduto da: {$viniliBannati->getVenditore()->getEmail()} </strong>
                                Titolo: {$viniliBannati->getTitolo()}
                                <br>
                                Artista: {$viniliBannati->getArtista()}
                            </p>
                        </div>
                        <div class="col-md-2 mt-3">
                            <form action="/vinylwebmarket/Admin/ripristinazioneVinile/{$viniliBannati->getId()}" method="POST">
                                <button class="btn btn-success">Ripristina</button>
                        </div>
                    </div>
                {/if}
            {else}
                Al momento non ci sono vinili bannati
            {/if}
        </div>
    </div>



</main>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
</body>
</html>