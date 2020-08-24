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
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

<div class="col-md-auto centrato">
  <br>
<h3 class="text-center">Elenco Messaggi:</h3>
  <hr color="black">

        <div class="centrato">
          {if $utent}
            {if is_array($utent)}
              {for $i=0 to $n_immagini}

                    <div class="chat_people">
                      <div class="chat_img">
                        {if $immagine == 'ok'}
                          <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA[$i]};base64,{$pic64att[$i]}"  alt="profile picture" />
                        {else}
                          <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                        {/if}
                      </div>
                      <div class="col-md-auto">
                        <br>
                        <h5>{$utent[$i]->getEmail()}</h5>
                      </div>
                      <div class="col-md-5 right">
                        <form action="/vinylwebmarket/Messaggi/redirect_chat" method="POST">
                          <input type="hidden" value="{$utent[$i]->getEmail()}" name="email2">
                          <button class="btn btnSubmit">Visualizza conversazione</button>
                        </form>
                      </div>
                      <br>
                      <br>
                        <hr>
                        <br>
                      </div>

              {/for}
            {else}
                <div class="inbox_chat">
                  <div class="chat_list active_chat">
                    <div class="chat_people">
                      <div class="chat_img">
                        {if $immagine == 'ok'}
                        <img class="rounded-circle ml-3" width="60" height="60" src="data:{$typeA};base64,{$pic64att}"  alt="profile picture" />
                        {else}
                        <img class=" ml-3" width="60" height="60" src="/vinylwebmarket/Smarty/immagini/user.png"  alt="profile picture" />
                        {/if}
                      </div>
                      <div class="chat_ib">
                        <h5>{$utent->getEmail()}</h5>
                        <p>Test, which is a new approach to have all solutions
                          astrology under one roof.</p>
                      </div>
                    </div>
                  </div>
                </div>
            {/if}
          {else}
            <div class="text-center"
           <h1>Al momento non ci sono messaggi.</h1>
            </div>
          {/if}

</div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
    </body>
    </html>
