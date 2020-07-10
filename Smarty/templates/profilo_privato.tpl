<!DOCTYPE html>
{assign var='nome' value=$nome}
{assign var='cognome' value=$cognome}
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>profilo privato</title>
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
      <a class="navbar-brand" href="#">
        <img src="\vinylwebmarket\Utility\immagini\logo.svg" width="40" height="40" class="d-inline-block align-top" alt="" loading="lazy">
        Vinyl Web Market
      </a>
      </div>
    </nav>

      <nav class="navbar navbar-expand-lg navbar sticky-top navbar-dark bg-dark">
        <div class="container=50px">

        </div>
        <a class="navbar-brand" href="/vinylwebmarket/Homepage/impostaPaginaULprivato">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="/vinylwebmarket/Chisiamo/info">Chi siamo?</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vinylwebmarket/User/Logout">Log Out</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/vinylwebmarket/User/profile">Profilo</a>
            </li>

            <li class="nav-item dropdown">
          </ul>
          <form class="form-inline my-2 my-lg-0" action="/vinylwebmarket/User/viewProfilePublic" method="post">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="email">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
          </form>
        </div>
      </nav>

      <div class="container">
      <div class="row profile">
  		<div class="col-md-3">
  			<div class="profile-sidebar">
  				<!-- SIDEBAR USERPIC -->

  				<div class="profile-userpic">
                    <a href="/vinylwebmarket/User/modificaProfiloImage">
  					<img src="https://static.vecteezy.com/system/resources/previews/000/550/731/non_2x/user-icon-vector.jpg" width="300" height="300" class="img-responsive" alt="">
                    </a>
                </div>
  				<!-- END SIDEBAR USERPIC -->
  				<!-- SIDEBAR USER TITLE -->
  				<div class="profile-usertitle">
  					<div class="profile-usertitle-name">
  						{$nome}
                        {$cognome}
  					</div>
  					<div class="profile-usertitle-job">
  						<br>
  					</div>
  				</div>
  				<!-- END SIDEBAR USER TITLE -->

  				<!-- SIDEBAR MENU -->
  				<div class="profile-usermenu">
            <li>
              <a href="messaggi.html">
              <i class="glyphicon glyphicon-user"></i>
              Messaggio </a>
            </li>
                    <li>
  							<a href="/vinylwebmarket/User/modificaProfilo">
  							<i class="glyphicon glyphicon-user"></i>
  							Impostazioni account </a>
  						</li>

  						<li>
  							<a href="#" target="_blank">
  							<i class="glyphicon glyphicon-user"></i>
  							Aiuto </a>
  						</li>
                    <li>
                        <a href="/vinylwebmarket/Vinile/pubblica" target="_blank">
                            <i class="glyphicon glyphicon-user"></i>
                            Pubblica e vendi i tuoi vinili </a>
                    </li>

  				</div>
  				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
			   Ciò che si deve inserire nel profilo
            </div>
		</div>
	</div>
</div>
<br>
<br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>

  </body>
</html>
