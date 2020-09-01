<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Aggiorna carta</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <nav class="navbar navbar sticky-top navbar-dark bg-dark">
      <div class="container=50px">
      <a class="navbar-brand" href="/vinylwebmarket/Homepage/impostaPaginaULnegozio">
        <img src="/vinylwebmarket/Utility/immagini/logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        Vinyl Web Market
      </a>
      </div>
    </nav>

      <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
        <div class="container=50px">

        </div>
        <a class="navbar-brand" href="/vinylwebmarket/Homepage/impostaPaginaULnegozio">Home</a>
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
        <form class="form-horizontal" role="form">
          <fieldset>
            <legend>Aggiornamento carta</legend>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="card-holder-name">Nome intestatario</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Nome e cognome intestatrio">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="card-number">Numero carta</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Numero carta di credito/debito">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="expiry-month">Data scadenza:</label>
              <div class="col-sm-9">
                <div class="row">
                  <div class="col-xs-3">
                    <select class="form-control" name="expiry-month">

                      <option value="01">Jan (01)</option>
                      <option value="02">Feb (02)</option>
                      <option value="03">Mar (03)</option>
                      <option value="04">Apr (04)</option>
                      <option value="05">May (05)</option>
                      <option value="06">June (06)</option>
                      <option value="07">July (07)</option>
                      <option value="08">Aug (08)</option>
                      <option value="09">Sep (09)</option>
                      <option value="10">Oct (10)</option>
                      <option value="11">Nov (11)</option>
                      <option value="12">Dec (12)</option>
                    </select>
                  </div>
                  <div class="col-xs-3">
                    <select class="form-control" name="expiry-year">

                      <option value="20">2020</option>
                      <option value="21">2021</option>
                      <option value="22">2022</option>
                      <option value="23">2023</option>
                      <option value="13">2024</option>
                      <option value="14">2025</option>
                      <option value="15">2026</option>
                      <option value="16">2027</option>
                      <option value="17">2028</option>
                      <option value="18">2029</option>
                      <option value="19">2030</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-3 control-label" for="cvv">Codice CVV</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Codice di sicurezza CVV">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <button type="button" class="btn btn-success">Aggiorna carta</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>

  </body>
</html>
