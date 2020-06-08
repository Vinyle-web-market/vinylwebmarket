<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <title>reg_negozio</title>

    <link rel="stylesheet" href="\vinylwebmarket\Smartycss\bootstrap.css">
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\bootstrap.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

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
      <a class="navbar-brand" href="index.tpl">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="login.tpl">Log In</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Iscriviti
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="reg_privato.tpl">Iscriviti come privato</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="reg_negozio.tpl">Iscriviti come negozio</a>
            </div>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

  <div class="container register-form">
              <div class="form">
                  <div class="note">
                      <p>Iscriviti al nostro sito web come privato:</p>
                  </div>

                  <div class="form-content">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Your Name *" value=""/>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Phone Number *" value=""/>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Your Password *" value=""/>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" placeholder="Confirm Password *" value=""/>
                              </div>
                          </div>
                      </div>
                      <button type="button" class="btnSubmit">Iscriviti</button>
                  </div>
              </div>
          </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>

</body>

</html>
