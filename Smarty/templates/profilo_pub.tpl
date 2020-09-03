<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>profilo pubblico</title>
      <link rel="stylesheet" href="\vinylwebmarket\Smarty\js\bootstrap.js">
      <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>
  <body>
    <!-- NAVBAR -->
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
    <!--  FINE NAVBAR -->

    <!-- UTENTE PRIVATO -->
    {if $tipoutente=='privato'}
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="data:{$type};base64,{$pic64}" width="300" height="300" class="img-responsive">
                    </div>
                    <hr color=black>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {$nome} {$cognome}
                        </div>
                        <div class="profile-usertitle-job">

                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <hr color=black>
                    <!-- SIDEBAR MENU -->
                    <div class="profile-usermenu">
                        <li>
                            <a>
                                <i class="glyphicon glyphicon-user"></i>
                                {$username}
                            </a>
                        </li>
                        <li>
                            <a>
                                <i class="glyphicon glyphicon-user"></i>
                                {$email} </a>
                        </li>
                        <li>
                            <a>
                                <i class="glyphicon glyphicon-user"></i>
                                {$telefono}
                            </a>
                        </li>
                        <hr color=black>
                        <form action="/vinylwebmarket/Messaggi/redirect_chat" method="POST">
                            <input type="hidden" value="{$email}" name="email2">
                            <button class="btn-product">Invia un messaggio</button>
                        </form>
                        <hr color=black>
                        <form action="/vinylwebmarket/Vinile/VetrinaUtenteVisitato " method="POST">
                            <input type="hidden" value="{$email}" name="email_venditore">
                            <button type="sumbit" class="btn-product">Visualizza vinili in vendita</button>
                        </form>
                    </div>
                    <hr color=black>
                    <!-- END MENU -->
                </div>
            </div>

            <div class="col-md-9">
                <br>
                <div class="col-md-12">
                    <h3>Lascia una recensione a: <b>{$nome} {$cognome}</b> </h3>
                </div>
            <form action="/vinylwebmarket/Recensione/Review" method="POST">
                <input type="text" hidden name="recensione" value="recensione" />
                <input type="text" hidden name="destinatario" value="{$email}" />
                <div class="border">
                    <div class="row">

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="form-control"  rows="3" placeholder="Commento..." name="commento" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- stelline -->
                            <div class="rate">
                                <h5>
                                    Voto:
                                <input type="radio" id="star5" name="rate" value="5" />
                                <label for="star5" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (5)</label>
                                <input type="radio" id="star4" name="rate" value="4" />
                                <label for="star4" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"> (4) </i></label>
                                <input type="radio" id="star3" name="rate" value="3" />
                                <label for="star3" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (3)</label>
                                <input type="radio" id="star2" name="rate" value="2" />
                                <label for="star2" title="text"><i class="fa fa-star"></i><i class="fa fa-star"> (2)</i></label>
                                <input type="radio" id="star1" name="rate" value="1" />
                                <label for="star1" title="text"><i class="fa fa-star"> (1)</i> </label>
                                </h5>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="right">
                                <input type="submit" class="btn btn-product"  value="Invia recensione"/>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <hr color=black>
            <div class="row">
                <div class="col-md-10">
                    {if $media_rec != 0}
                        <div class="ml-3">
                            <h3> Valutazione media di <b>{$nome} {$cognome}</b> :
                                    {if $media_rec==5}
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    {/if}
                                    {if $media_rec==4}
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    {/if}
                                    {if $media_rec==3}
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    {/if}
                                    {if $media_rec==2}
                                        <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                    {/if}
                                    {if $media_rec==1}
                                        <i class="fa fa-star"></i>
                                    {/if}
                                ({$media_rec})
                                </h3>
                        </div>
                    {/if}
                </div>
            </div>
                <hr color=black>
                <br>
                <h3 class="text-center">Recensione dell utente:</h3>
                <div class="border" style="max-height: 500px; overflow-y: scroll; overflow-x: hidden;">
                {if $rec!=null}
                    {if is_array($rec)}
                        {for $i=0 to $n_recensioni}
                            <div class="col-md-12">
                    <hr color=black>
                    <section class="reviews py-5" id="reviews">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <section class="col-md-12">
                                                    <div class="one-reivew">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5>Scritta da: <a href="#">{$rec[$i]->getUsernameMittente()}</a></h5>
                                                            </div>

                                                        </div>
                                                        <div class="row text-success">
                                                            <div class="col-md-12">
                                                                {if $rec[$i]->getVotostelle()==5}
                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                {/if}
                                                                {if $rec[$i]->getVotostelle()==4}
                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                {/if}
                                                                {if $rec[$i]->getVotostelle()==3}
                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                {/if}
                                                                {if $rec[$i]->getVotostelle()==2}
                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                {/if}
                                                                {if $rec[$i]->getVotostelle()==1}
                                                                    <i class="fa fa-star"></i>
                                                                {/if}
                                                            </div>
                                                        </div>

                                                        <div class="row pt-2">
                                                            <div class="col-md-12">



                                                                <p>{$rec[$i]->getTesto()}</p>
                                                            </div>
                                                        </div>
                                                        <hr color=black>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                        {/for}
                    {else}
                        <div class="col-md-12">
                                                <hr color=black>
                                                <section class="reviews py-5" id="reviews">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <section class="col-md-12">
                                                                                <div class="one-reivew">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                            <h5>Scritta da: <a href="#">{$rec->getUsernameMittente()}</a></h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row text-success">
                                                                                        <div class="col-md-12">
                                                                                            {if $rec->getVotostelle()==5}
                                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                            {/if}
                                                                                            {if $rec->getVotostelle()==4}
                                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                            {/if}
                                                                                            {if $rec->getVotostelle()==3}
                                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                            {/if}
                                                                                            {if $rec->getVotostelle()==2}
                                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                            {/if}
                                                                                            {if $rec->getVotostelle()==1}
                                                                                                <i class="fa fa-star"></i>
                                                                                            {/if}
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row pt-2">
                                                                                        <div class="col-md-12">


                                                                                            <p>{$rec->getTesto()}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                    <hr color=black>
                                                                                </div>
                                                                            </section>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                    {/if}
                {else}
                        <div class="col-md-9">
                                                                            <br>
                                                                            <h3 class="text-center">-Nessuna Recensione-</h3>
                                                                        </div>
                {/if}
                </div>
            </div>
        {/if}

        {if $tipoutente=='negozio'}
        <div class="container">
            <div class="row profile">
                <div class="col-md-3">
                    <div class="profile-sidebar">
                        <!-- SIDEBAR USERPIC -->
                        <div class="profile-userpic">
                            <img src="data:{$type};base64,{$pic64}" width="300" height="300" class="img-responsive">
                        </div>
                        <hr color=black>
                        <!-- END SIDEBAR USERPIC -->
                        <!-- SIDEBAR USER TITLE -->
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name">
                                {$nomenegozio}
                            </div>
                            <div class="profile-usertitle-job">

                            </div>
                        </div>
                        <!-- END SIDEBAR USER TITLE -->
                        <hr color=black>
                        <!-- SIDEBAR MENU -->
                        <div class="profile-usermenu">
                            <li>
                                <a>
                                    <i class="glyphicon glyphicon-user"></i>
                                    {$email}
                                </a>
                            </li>
                            <li>
                                <a>
                                    <i class="glyphicon glyphicon-user"></i>
                                    {$indirizzo} </a>
                            </li>
                            <li>
                                <a>
                                    <i class="glyphicon glyphicon-user"></i>
                                    {$partitaiva}
                                </a>
                            </li>
                            <hr color=black>
                            <form action="/vinylwebmarket/Messaggi/redirect_chat" method="POST">
                                <input type="hidden" value="{$email}" name="email2">
                                <button class="btn-product">Invia un messaggio</button>
                            </form>
                            <hr color=black>
                            <form action="/vinylwebmarket/Vinile/VetrinaUtenteVisitato " method="POST">
                                <input type="hidden" value="{$email}" name="email_venditore">
                                <button type="submit" class="btn-product">Visualizza vinili in vendita</button>
                            </form>
                        </div>
                        <hr color=black>
                        <!-- END MENU -->
                    </div>
                </div>
                <div class="col-md-9">
                    <br>
                    <div class="col-md-12">
                        <h3>Lascia una recensione a: <b>{$nomenegozio}</b> </h3>
                    </div>
                    <form action="/vinylwebmarket/Recensione/Review" method="POST">
                        <input type="text" hidden name="recensione" value="recensione" />
                        <input type="text" hidden name="destinatario" value="{$email}" />
                        <div class="border">
                            <div class="row">

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <textarea class="form-control"  rows="3" placeholder="Commento..." name="commento" required></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- stelline -->
                                    <div class="rate">
                                        <h5>
                                            Voto:
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label for="star5" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (5)</label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label for="star4" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"> (4) </i></label>
                                            <input type="radio" id="star3" name="rate" value="3" />
                                            <label for="star3" title="text"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> (3)</label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label for="star2" title="text"><i class="fa fa-star"></i><i class="fa fa-star"> (2)</i></label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label for="star1" title="text"><i class="fa fa-star"> (1)</i> </label>
                                        </h5>

                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="right">
                                        <input type="submit" class="btn btn-product"  value="Invia recensione"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr color=black>
                    <div class="row">
                        <div class="col-md-10">
                            {if $media_rec != 0}
                                <div class="ml-3">
                                    <h3> Valutazione media di <b>{$nomenegozio}</b> :
                                        {if $media_rec==5}
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        {/if}
                                        {if $media_rec==4}
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        {/if}
                                        {if $media_rec==3}
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        {/if}
                                        {if $media_rec==2}
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        {/if}
                                        {if $media_rec==1}
                                            <i class="fa fa-star"></i>
                                        {/if}
                                        ({$media_rec})
                                    </h3>
                                </div>
                            {/if}
                        </div>
                    </div>
                    <hr color=black>
                    <br>
                    <h3 class="text-center">Recensione dell utente:</h3>
                    <div class="border" style="max-height: 500px; overflow-y: scroll; overflow-x: hidden;">
                    {if $rec!=null}
                        {if is_array($rec)}
                            {for $i=0 to $n_recensioni}
                                <div class="col-md-12">
                                    <hr color=black>
                                    <section class="reviews py-5" id="reviews">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <section class="col-md-12">
                                                                    <div class="one-reivew">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h5>Scritta da: <a href="#">{$rec[$i]->getUsernameMittente()}</a></h5>
                                                                            </div>

                                                                        </div>
                                                                        <div class="row text-success">
                                                                            <div class="col-md-12">
                                                                                {if $rec[$i]->getVotostelle()==5}
                                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                {/if}
                                                                                {if $rec[$i]->getVotostelle()==4}
                                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                {/if}
                                                                                {if $rec[$i]->getVotostelle()==3}
                                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                {/if}
                                                                                {if $rec[$i]->getVotostelle()==2}
                                                                                    <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                                {/if}
                                                                                {if $rec[$i]->getVotostelle()==1}
                                                                                    <i class="fa fa-star"></i>
                                                                                {/if}
                                                                            </div>
                                                                        </div>

                                                                        <div class="row pt-2">
                                                                            <div class="col-md-12">



                                                                                <p>{$rec[$i]->getTesto()}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </section>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                            {/for}
                        {else}
                            <div class="col-md-12">
                                <hr color=black>
                                <section class="reviews py-5" id="reviews">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <section class="col-md-12">
                                                                <div class="one-reivew">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5>Scritta da: <a href="#">{$rec->getUsernameMittente()}</a></h5>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row text-success">
                                                                        <div class="col-md-12">
                                                                            {if $rec->getVotostelle()==5}
                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                            {/if}
                                                                            {if $rec->getVotostelle()==4}
                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                            {/if}
                                                                            {if $rec->getVotostelle()==3}
                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                            {/if}
                                                                            {if $rec->getVotostelle()==2}
                                                                                <i class="fa fa-star"></i><i class="fa fa-star"></i>
                                                                            {/if}
                                                                            {if $rec->getVotostelle()==1}
                                                                                <i class="fa fa-star"></i>
                                                                            {/if}
                                                                        </div>
                                                                    </div>

                                                                    <div class="row pt-2">
                                                                        <div class="col-md-12">


                                                                            <p>{$rec->getTesto()}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        {/if}
                    {else}
                        <div class="col-md-9">
                            <br>
                            <h3 class="text-center">-Nessuna Recensione-</h3>
                        </div>
                    {/if}

                    </div>
                </div>
                </div>
            </div>
        {/if}




      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
  </body>
</html>
