<!DOCTYPE html>
{assign var='userlogged' value=$userlogged|default:'nouser'}
{assign var='errorEmail' value=$errorEmail|default:'ok'}
{assign var='errorPassword' value=$errorPassword|default:'ok'}
{assign var='errorSize' value=$errorSize|default:'ok'}
{assign var='errorType' value=$errorType|default:'ok'}
{assign var='errorEmailInput' value=$errorEmailInput|default:'ok'}
{assign var='errorUsername' value=$errorUsername|default:'ok'}
{assign var='errorPartitaiva' value=$errorPartitaiva|default:'ok'}
{assign var='errorTelefono' value=$errorTelefono|default:'ok'}
{assign var='errorPasswordInput' value=$errorPasswordInput|default:'ok'}
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>modifica profilo privato</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      <!-- JS, Popper.js, and jQuery -->
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

    <div class="container register-form">
        <div class="form">
            <div class="note">
                <p>Inserisci i campi che desideri modificare:</p>
                <p>Reinserisci i campi che intendi mantenere.</p>
            </div>
            <form enctype="multipart/form-data" name="form_mod" onsubmit="return validateForm()" class="form-content" action="/vinylwebmarket/User/modificaProfilo" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Email" value="{$email}" name="email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Vecchia password-CAMPO OBBLIGATORIO" name="old_password" required/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Nuova password" name="new_password"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username" value="{$username}" name="username"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Nome negozio" value="{$nomenegozio}" name="nomenegozio"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Telefono" value="{$telefono}" name="telefono"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Indirizzo" value="{$indirizzo}" name="indirizzo"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Partita IVA" value="{$partitaiva}" name="partitaiva"/>
                        </div>
                    </div>
                    <br>
                    <!-- <div class="col-md-6">
                         <div class="custom-file">
                             <input type="file" class="custom-file-input" id="customFile" name="file">
                          <label class="custom-file-label" for="customFile">Inserisci nuova foto profilo</label>
                         </div>
                    </div>-->
                </div>
                <div class="form-group">
                    <button type="submit" class="btnSubmit">Aggiorna</button>
                </div>
                <hr>
                {if $errorEmail!='ok'}
                    <div style="color: red;">
                        <p align="center">Cambiare Email poichè già assegnata!</p>
                    </div>
                {/if}
                <!--  </form> -->
                {if $errorPassword!='ok'}
                    <div style="color: red;">
                        <p align="center">Password errata!</p>
                    </div>
                {/if}
                {if $errorSize!='ok'}
                    <div style="color: red;">
                        <p align="center">Attenzione! Formato immagine troppo grande!  </p>
                    </div>
                {/if}
                {if $errorType!='ok'}
                    <div style="color: red;">
                        <p align="center">Attenzione! Formato immagine non supportato (provare con .png o .jpg)!  </p>
                    </div>
                {/if}
            </form>
        </div>
    </div>
    <script>
        function validateForm() {
            var nome = document.forms["form_mod"]["nomenegozio"].value;
            let exp = /^([a-zA-Z '-]*)$/;
            if (!nome.match(exp)) {
                alert("Inserisci un nome corretto,solo caratteri!");
                return false;
            }

            var  partitaiva= document.forms["form_mod"]["partitaiva"].value;
            if (partitaiva.length!=11) {
                alert("Inserisci una partita iva corretta!");
                return false;
            }

            var telefono = document.forms["form_mod"]["telefono"].value;
            let exp1 = /^([0-9 '-]*)$/;
            if (!telefono.match(exp1)) {
                if(telefono.length<7){
                    alert("Inserisci un numero di telefono corretto");
                    return false;
                }}
            var  username= document.forms["form_mod"]["username"].value;
            let exp2 = /^[A-Za-z0-9]+(?:[ _-][A-Za-z0-9]+)*$/;
            if (!username.match(exp2)) {
                alert("Inserisci un username corretto!!!");
                return false;
            }
            var  password= document.forms["form_mod"]["new_password"].value;
            if (password!="" && password<7) {
                alert("Inserisci password di almeno 8 caratteri!!!");
                return false;
            }
            var email = document.forms["form_mod"]["email"].value;
            let exp3 =/^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/  ;
            if (!email.match(exp3)) {
                alert("Inserisci un email corretta!");
                return false;
            }

        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
  </body>
</html>
