<!DOCTYPE html>
{assign var='errorSize' value=$errorSize|default:'ok'}
{assign var='errorType' value=$errorType|default:'ok'}
{assign var='errorEmailExist' value=$errorEmailExist|default:'ok'}
{assign var='errorUsername' value=$errorUsername|default:'ok'}
{assign var='errorEmail' value=$errorEmail|default:'ok'}
{assign var='errorNome' value=$errorNome|default:'ok'}
{assign var='errorPartitaiva' value=$errorPartitaiva|default:'ok'}
{assign var='errorIntestatario' value=$errorIntestatario|default:'ok'}
{assign var='errorCvv' value=$errorCvv|default:'ok'}
{assign var='errorNumerocarta' value=$errorNumerocarta|default:'ok'}
{assign var='errorPassword' value=$errorPassword|default:'ok'}
<html lang="en">
<head>

  <meta charset="utf-8">
  <title>reg_negozio</title>

    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->


</head>
<body>

  <nav class="navbar navbar sticky-top navbar-dark bg-dark">
    <div class="container=50px">
    <a class="navbar-brand" href="/vinylwebmarket/">
      <img src="/vinylwebmarket/Utility/immagini/logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
      Vinyl Web Market
    </a>
    </div>
  </nav>

    <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
      <div class="container=50px">

      </div>
      <a class="navbar-brand" href="/vinylwebmarket/">Home</a>
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
                <a class="dropdown-item" href="/vinylwebmarket/User/FormRegPrivato">Iscriviti come privato</a>              <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/vinylwebmarket/User/FormRegNegozio">Iscriviti come negozio</a>            </div>
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

  <div class="container register-form">
      <div class="form">
          <div class="note">
              <p>Iscriviti al nostro sito web come negozio:</p>
          </div>

          <form  enctype="multipart/form-data" class="form-content" action="/vinylwebmarket/User/registrazioneNegozio" method="POST">
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Email" name="email"/>
                      </div>

                      <div class="form-group">
                          <input type="password" class="form-control" placeholder="Password" name="password"/>
                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Nome negozio" name="nomenegozio"/>
                      </div>

                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Useraname" name="username"/>
                      </div>
                  </div>

                    <div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Telefono" name="telefono"/>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Indirizzo" name="indirizzo"/>
                  </div>
                  <div class="form-group">
                      <input type="text" class="form-control" placeholder="Partita Iva" name="partitaiva"/>
                  </div>
                    </div>
                  <br>
                  <div class="col-md-6">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="customFile" name="file">
                          <label class="custom-file-label" for="customFile">Carica foto profilo</label>
                          <!-- <input type="file" name="file" />-->
                      </div>
                  </div>
                  <br>
                  <br>
                  <br>
                  <div class="container">
                      <form class="form-content" role="form">
                          <fieldset>
                              <div class="form-group">
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" name="intestatario" id="card-holder-name" placeholder="Nome e cognome intestatrio">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" name="numerocarta" id="card-number" placeholder="Numero carta di credito/debito">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-9">

                                          <div class="col-xs-3">
                                              <select class="form-control" name="mese">

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
                                      <br>
                                          <div class="col-xs-3">
                                              <select class="form-control" name="anno">

                                                  <option value="2020">2020</option>
                                                  <option value="2021">2021</option>
                                                  <option value="2022">2022</option>
                                                  <option value="2023">2023</option>
                                                  <option value="2024">2024</option>
                                                  <option value="2025">2025</option>
                                                  <option value="2026">2026</option>
                                                  <option value="2027">2027</option>
                                                  <option value="2028">2028</option>
                                                  <option value="2029">2029</option>
                                                  <option value="2030">2030</option>
                                              </select>
                                          </div>

                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="col-sm-3">
                                      <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Codice di sicurezza CVV">
                                  </div>
                              </div>
                          </fieldset>
                      </form>
                      {if $errorSize!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! File troppo grande!  </p>
                          </div>
                      {/if}
                      {if $errorType!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Formato immagine non supportato (provare con .png o .jpg)!  </p>
                          </div>
                      {/if}
                      {if $errorEmailExist!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Email già esistente!  </p>
                          </div>
                      {/if}
                      {if $errorUsername!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione!Nell'username non sono ammessi simboli!  </p>
                          </div>
                      {/if}
                      {if $errorEmail!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! formato Email non valida!  </p>
                          </div>
                      {/if}
                      {if $errorPartitaiva!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Partita Iva non valido!  </p>
                          </div>
                      {/if}
                      {if $errorNome!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Nome non valido!  </p>
                          </div>
                      {/if}
                      {if $errorNumerocarta!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Numero carta non valido!  </p>
                          </div>
                      {/if}
                      {if $errorPassword!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! La password deve avere più di 8 caratteri!  </p>
                          </div>
                      {/if}
                      {if $errorCvv!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! CVV non valido!  </p>
                          </div>
                      {/if}
                      {if $errorIntestatario!='ok'}
                          <div style="color: red;">
                              <p align="center">Attenzione! Intestatario non valido!  </p>
                          </div>
                      {/if}
                  </div>
                  <button type="submit" class="btnSubmit">Iscriviti</button>
              </div>
             <!-- <button type="submit" class="btnSubmit">Iscriviti</button> -->
          </form>
      </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
</body>

</html>
