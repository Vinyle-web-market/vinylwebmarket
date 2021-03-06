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
  <div>
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
              <li class="nav-item">
                  <a class="nav-link" href="/vinylwebmarket/Vinile/Vetrina">Visualizza vinili in vendita</a>
              </li>
          </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="/vinylwebmarket/Filtro/ricercaParola">
                <input name="parola" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
      </nav>
    <div class="container">
        <br>
        <h3 class=" text-center">Messaggi:</h3>
        <hr color="black">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="col-md-12">
                    <div class="msg_history">
    {if $mes}
                        {if is_array($mes)}
            {for $i=0 to $n_mes}
                    {if $mes[$i]->getMittente()==$email1}
                        <div class="outgoing_msg">
                            <div class="sent_msg">
                                <p>{$mes[$i]->getTesto()}</p>
                            </div>
                        </div>
                        {else}
                        <div class="incoming_msg">
                            <br>
                            <div class="incoming_msg_img">
                                {if $immagine == 'ok'}
                                    <img class="rounded-circle ml-3" width="40" height="40" src="data:{$type};base64,{$pic64}" width="40" height="40" alt="sunil">
                                {else}
                                    <img class="rounded-circle ml-3" width="40" height="40"  src="/vinylwebmarket/Smarty/immagini/user.png" width="40" height="40" alt="sunil">
                                {/if}
                            </div>
                            <div class="received_msg">
                                <div class="received_withd_msg">
                                    <p>{$mes[$i]->getTesto()}</p>
                                </div>
                            </div>
                        </div>
                    {/if}
                {/for}
               {else}
                            {if $mes->getMittente()==$email1}
                                <div class="outgoing_msg">
                                    <div class="sent_msg">
                                        <p>{$mes->getTesto()}</p>
                                    </div>
                                </div>
                            {else}
                                <div class="incoming_msg">
                                    <br>
                                    <div class="incoming_msg_img">
                                        {if $immagine == 'ok'}
                                            <img class="rounded-circle ml-3" width="40" height="40" src="data:{$type};base64,{$pic64}" width="40" height="40" alt="sunil">
                                        {else}
                                            <img class="rounded-circle ml-3" width="40" height="40"  src="/vinylwebmarket/Smarty/immagini/user.png" width="40" height="40" alt="sunil">
                                        {/if}
                                    </div>
                                    <div class="received_msg">
                                        <div class="received_withd_msg">
                                            <p>{$mes->getTesto()}</p>
                                        </div>
                                    </div>
                                </div>
                            {/if}
                        {/if}
                        {else}
        <div class="text-center"
        <h1>Al momento non ci sono messaggi. Inizia la conversazione.</h1>
        </div>
    {/if}
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form action="/vinylwebmarket/Messaggi/invio_mes" method="POST">
                            <input type="text" class="write_msg" placeholder="Type a message" name="testo" required/>
                                <input type="hidden" value="{$email2}" name="email2">
                            <button class="msg_send_btn"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
    </body>
    </html>
