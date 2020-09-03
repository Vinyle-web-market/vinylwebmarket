<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>chi siamo</title>
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
      <a class="navbar-brand" href="/vinylwebmarket/">
        <img src="\vinylwebmarket\Utility\immagini\logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        Vinyl Web Market
      </a>
      </div>
    </nav>
      <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
        <div class="container=50px">
        </div>
        <a class="navbar-brand" href="\vinylwebmarket\">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/vinylwebmarket/User/login">Log In</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Iscriviti
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="/vinylwebmarket/User/FormRegPrivato">Iscriviti come privato</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/vinylwebmarket/User/FormRegNegozio">Iscriviti come negozio</a>
              </div>
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
        <hr>
        <p class="lead">
          Il nostro sito si pone come intermediario tra utenti che vogliono vendere e creare un piccolo profitto dai propri vinili.
           Raccogliamo e proponiamo sul nostro portale tutti i tipi di dischi a seconda della tipologia fisica (33, 45 e 78 giri), del genere (rock, pop, house, dance, techno, soul, jazz,...), e per diverso autore.
          <br>
          <br>
          Il mercato dei vinili, specialmente negli ultimi anni, ha acquisito sempre maggiore importanza ed espansione nel mercato della musica. Le cause sono dovute all’elevata qualità del suono e al ritorno nostalgico del disco fisico. Inoltre, ha superato di gran lunga le vendite di CD ed ha eguagliato le vendite di musica su piattaforme digitali.
          <br>
          <br>
          L’idea di tale sito nasce dalla volontà di creare uno strumento per riuscire ad agevolare il contatto e la visibilità di piccoli negozi che non hanno la possibilità di potersi permettere un sito web personale.
          Con tale portale proponiamo la possibilità di poter farsi conoscere con una semplice registrazione al sito, sottoscrivendo un abbonamento.
          Tuttavia, la nostra idea non è solo mirata all’esigenza di piccoli negozi, ma anche alle necessità di grandi enti commerciali che hanno la possibilità di poter espandere il loro commercio di vinili in un sito completamente dedicato.</p>
         <hr>
          <center><img src="/vinylwebmarket/Utility/immagini/vynilwebmarket.png" height="200" width="200"></center>
      </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
  </body>
</html>
