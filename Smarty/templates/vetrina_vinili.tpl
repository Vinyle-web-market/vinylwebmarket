<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>vinili in vendita</title>
  </head>
  <link rel="stylesheet" href="\vinylwebmarket\Smarty\js\bootstrap.js">
  <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
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
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>


<div class="container">
    <h3 class="h3">Vinili in vendita:</h3>
    <hr color=black>
    <div class="row">
    {if $vinili}
        {if is_array($vinili)}
            {for $i=0 to $n_vinili}
        <div class="col-md-3 col-sm-6">
            <div class="product-grid4">
                                <div class="product-image4">
                                    <a href="#">
                                        <img class="pic-1" src="data:{$type[$i]};base64,{$pic64[$i]}"/>
                                        <img class="pic-2" src="data:{$typeP[$i]};base64,{$pic64P[$i]}" />
                                    </a>
                                </div>
                            <div class="product-content">
                                <h3 class="title"><a href="#">{$vinili[$i]->getTitolo()}</a></h3>
                                <h3 class="title">{$vinili[$i]->getArtista()}</h3>
                                <hr color=black>
                                <div class="price">
                                    {$vinili[$i]->getPrezzo()}€
                                </div>
                                <hr color=black>
                                <a class="add-to-cart" href="">CONTATTA IL VENDITORE</a>
                            </div>
            </div>
        </div>
            {/for}
        {else}<div class="col-md-3 col-sm-6">
            <div class="product-grid4">
                <div class="product-image4">
                    <a href="#">
                        <img class="pic-1" src="data:{$type};base64,{$pic64}"/>
                        <img class="pic-2" src="data:{$typeP};base64,{$pic64P}" />
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="title"><a href="#">{$vinili->getTitolo()}</a></h3>
                    <h3 class="title">{$vinili->getArtista()}</h3>
                    <hr color=black>
                    <div class="price">
                        {$vinili->getPrezzo()}€
                    </div>
                    <hr color=black>
                    <a class="add-to-cart" href="">CONTATTA IL VENDITORE</a>
                </div>
            </div>
            </div>
        {/if}
            </div>

    {else}
        Non ci sono vinili in vendita
    {/if}

</div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
  </body>
</html>
