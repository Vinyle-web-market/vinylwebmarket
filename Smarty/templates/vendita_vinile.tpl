<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>vendita vinile</title>

        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
  </head>
  <body>
    <nav class="navbar navbar sticky-top navbar-dark bg-dark">
      <div class="container=50px">
      <a class="navbar-brand" href="#">
        <img src="../../Utility/immagini/logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        Vinyl Web Market
      </a>
      </div>
    </nav>

      <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
        <div class="container=50px">

        </div>
        <a class="navbar-brand" href="homepage_utente_loggato.html">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="chisiamo.html">Chi siamo?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Homepage.html">Log Out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="profilo_negozio.html">Profilo</a>
            </li>

            <li class="nav-item dropdown">
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
<form enctype="multipart/form-data" action="/vinylwebmarket/Vinile/pubblica" method="POST">
    <div class="container">
    	<div class="row">
    		<div class="col-md-12">
    		     <div id="accordion">

                  </div>

                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                            Titolo e Foto
                          </a>
                        </div>
                        <div id="collapseThree" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <div class="container">
                            	<div class="row">
                                 <div class="col-md-6 border card-body">
                                      <div class="form-group">
                                        <label for="expectedprice" class="control-label col-xs-4">Titolo del vinile:</label>
                                        <div class="col-xs-8">
                                          <div class="input-group">
                                            <div class="input-group-addon">
                                              <i class="fa fa-inr"></i>
                                            </div>
                                            <input id="expectedprice" name="titolo" class="form-control" type="text">
                                          </div>
                                        </div>
                                      </div>



                                 </div>
                                 <div class="col-md-6">
                                     <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile" name="file">
                                      <label class="custom-file-label" for="customFile">1. Upload Photos</label>
                                     </div>
                                     <div class="custom-file">
                                      <input type="file" class="custom-file-input" id="customFile" name="file_1">
                                      <label class="custom-file-label" for="customFile"> 2.  Upload Photos </label>
                                     </div>
                                 </div>

                                </div>
                            </div>
                          </div>
                        </div>
                      </div>


                                            <div class="card">
                                              <div class="card-header">
                                                <a class="collapsed card-link" data-toggle="collapse" href="#collapseFour">
                                                  Informazioni sul vinile
                                                </a>
                                              </div>
                                              <div id="collapseFour" class="collapse" data-parent="#accordion">
                                                <div class="card-body">
                                                  <div class="container">
                                                  	<div class="row">
                                                       <div class="col-md-6 border card-body">
                                                          <form class="form-horizontal">
                                                            <div class="form-group">
                                                              <label for="expectedprice" class="control-label col-xs-4">Autore del vinile:</label>
                                                              <div class="col-xs-8">
                                                                <div class="input-group">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-inr"></i>
                                                                  </div>
                                                                  <input id="expectedprice" name="autore" class="form-control" type="text">
                                                                </div>
                                                              </div>
                                                            </div>

                                                            <div class="form-group">
                                                              <label for="expectedprice" class="control-label col-xs-4">Prezzo del vinile:</label>
                                                              <div class="col-xs-8">
                                                                <div class="input-group">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-inr"></i>
                                                                  </div>
                                                                  <input id="expectedprice" name="prezzo" class="form-control" type="text">
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="expectedprice" class="control-label col-xs-4">Genere del vinile:</label>
                                                              <div class="col-xs-8">
                                                                <div class="input-group">
                                                                  <div class="input-group-addon">
                                                                    <i class="fa fa-inr"></i>
                                                                  </div>
                                                                  <input id="expectedprice" name="genere" class="form-control" type="text">
                                                                </div>
                                                              </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="carcolor" class="control-label col-xs-4">Condizioni:</label>
                                                              <div class="col-xs-8">
                                                                <select id="carcolor" name="condizioni" class="select form-control">
                                                                  <option value="nuovo">Nuovo</option>
                                                                  <option value="usato">Usato</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                            <div class="form-group">
                                                              <label for="carcolor" class="control-label col-xs-4">Numero di giri del vinile:</label>
                                                              <div class="col-xs-8">
                                                                <select id="carcolor" name="numerogiri" class="select form-control">
                                                                  <option value="33">33</option>
                                                                  <option value="45">45</option>
                                                                  <option value="78">78</option>
                                                                </select>
                                                              </div>
                                                            </div>
                                                          </form>
                                                       </div>

                                                      </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>




                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed card-link" data-toggle="collapse" href="#collapseFive">
                            Descrizione e quantità:
                          </a>
                        </div>
                        <div id="collapseFive" class="collapse" data-parent="#accordion">
                          <div class="card-body">
                            <div class="row">
                                 <div class="col-md-6 border card-body">
                                    <small>Descrizione:</small>
                                    <form class="form-horizontal">
                                      <div class="form-group">
                                        <label for="textarea" class="control-label col-xs-4">Inserisci una descrizione del vinile in vendita:</label>
                                        <div class="col-xs-8">
                                            <input id="expectedprice" name="descrizione" class="form-control" type="text">
                                        </div>
                                      </div>
                                    </form>

                                    <div class="form-group">
                                      <label for="expectedprice" class="control-label col-xs-4">Quantità dei vinili in vendita:</label>
                                      <div class="col-xs-8">
                                        <div class="input-group">
                                          <div class="input-group-addon">
                                            <i class="fa fa-inr"></i>
                                          </div>
                                          <input id="expectedprice" name="quantita" class="form-control" type="text">
                                        </div>
                                      </div>
                                    </div>


                                </div>
                          </div>
                        </div>
                      </div>
                    </div>
    		</div>
    	</div>
    </div>
    <button type="submit" >Compila le sezioni e pubblica</button>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="../js/bootstrap.js"></script>

  </body>
</html>