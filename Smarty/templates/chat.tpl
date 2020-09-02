{assign var='immagine' value=$immagine|default:'ok'}
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>messaggi</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/vinylwebmarket/Smarty/css/bootstrap.min.css">
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
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
    <div class="my-3 p-3 bg-white rounded shadow-sm">
      <center><h4 class="border-bottom border-gray pb-2 mb-0">Elenco messaggi:</h4></center>
      <div class=" text-muted pt-3 border-bottom ">
        {if $utent}
          {if is_array($utent)}
            {for $i=0 to $n_utent}
              <br>
              <div class="row border-bottom">
                <div class="col-md-1 mt-2 mb-2">
                  {if $immagine == 'ok'}
                    <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA[$i]};base64,{$pic64att[$i]}"  alt="profile picture" />
                  {else}
                    <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                  {/if}
                </div>
                <div class="col-md-8">
                  <p class="mt-1">
                    <strong class="d-block text-gray-dark">{$utent[$i]->getEmail()} </strong>
                  </p>
                </div>
                <div class="col-md-3">
                  <form action="/vinylwebmarket/Messaggi/chat" method="POST">
                    <input type="hidden" value="{$utent[$i]->getEmail()}" name="email2">
                    <button class="btn btnSubmit">Visualizza conversazione</button>
                  </form>
                  <br>
                </div>
              </div>
            {/for}
          {else}
            <div class="row border-bottom">
              <div class="col-md-1 mt-2 mb-2">
                {if $immagine == 'ok'}
                  <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA};base64,{$pic64att}"  alt="profile picture" />
                {else}
                  <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                {/if}
              </div>
              <div class="col-md-9 ">
                <p class="mt-1">
                  <strong class="d-block text-gray-dark">{$utent->getEmail()} </strong>
                </p>
              </div>
              <div class="col-md-2 mt-3">
                <form action="/vinylwebmarket/Messaggi/chat" method="POST">
                  <input type="hidden" value="{$utent->getEmail()}" name="email2">
                  <button class="btn btnSubmit">Visualizza conversazione</button>
                </form>
                <br>
              </div>
            </div>
          {/if}
        {else}
          Al momento non ci sono messaggi
        {/if}
      </div>
    </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
    </body>
    </html>
