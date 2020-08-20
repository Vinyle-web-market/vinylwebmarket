<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>vendita vinile</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

      <!-- JS, Popper.js, and jQuery -->
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
      <a class="navbar-brand" href="">
        <img src="\vinylwebmarket\Utility\immagini\logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        Vinyl Web Market
      </a>
      </div>
    </nav>

      <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
        <div class="container=50px">

        </div>

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

    <form  enctype="multipart/form-data" class="form-content" action="/vinylwebmarket/Vinile/pubblica" method="POST">
      <div class="container register-form">
                  <div class="form">
                      <div class="note">
                          <p>Inserisci il tuo vinile in vendita: </p>
                      </div>

                      <div class="form-content">
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Titolo:" name="titolo"/>
                                  </div>
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Artista:" name="artista"/>
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="form-group ">
                                          <select id="inputState " class="form-control" name="genere">
                                              <option selected>Genere:</option>
                                              <option>Blues</option>
                                              <option>Classica</option>
                                              <option>Country</option>
                                              <option>Dance</option>
                                              <option>Hip-Hop</option>
                                              <option>House</option>
                                              <option>Jazz</option>
                                              <option>Pop</option>
                                              <option>Punk</option>
                                              <option>Reggae</option>
                                              <option>Rock</option>
                                              <option>Techno</option>
                                              <option>Altro</option>
                                          </select>
                                      </div>
                                  </div>

                                    <div class="col-xs-3">
                                      <select class="form-control" name="numerogiri">
                                          <option selected>Numero giri:</option>
                                        <option value="33">33 giri</option>
                                        <option value="45">45 giri</option>
                                        <option value="78">78 giri</option>
                                      </select>
                                    </div>
                                    <br>
                                    <div class="col-xs-3">
                                      <select class="form-control" name="condizioni">
                                          <option selected>Condizioni:</option>
                                        <option value="nuovo">Nuovo</option>
                                        <option value="usato">Usato</option>

                                      </select>
                                    </div>
                                    <br>
                                  <div class="form-group">
                                      <textarea class="form-control"  rows="3" placeholder="Descrizione:" name="descrizione" required></textarea>
                                  </div>
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Prezzo: " name="prezzo"/>
                                  </div>
                                  <div class="form-group">
                                      <input type="text" class="form-control" placeholder="Quantità: " name="quantita"/>
                                  </div>
                              <br>
                              <div class="col-md-6">

                                  <div class="custom-file">
                                   <input type="file" class="custom-file-input" id="customFile" name="file">
                                   <label class="custom-file-label" for="customFile">Carica foto vinile posteriore </label>
                                  </div>
                                  <br>
                                  <br>
                                  <div class="custom-file">
                                   <input type="file" class="custom-file-input" id="customFile" name="file_1">
                                   <label class="custom-file-label" for="customFile">Carica foto vinile anteriore </label>
                                  </div>
                                  <br>
                                  <center>INSERIRE DUE FOTO!</center>
                              </div>
                              <br>
                              <div class="col-md-12">
                              <button type="submit" class="btnSubmit">Inserisci vinile in vendita</button>
                          </div>
                          </div>

                  </div>
              </div>

    </div>
      </div>
    </form>
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>

  </body>
</html>
