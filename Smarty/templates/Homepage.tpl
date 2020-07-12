<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>index</title>

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
    <a class="navbar-brand" href="\vinylwebmarket\">Home</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/vinylwebmarket/Chisiamo/info">Chi siamo?</a>
        </li>
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
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </form>
    </div>
  </nav>





      <div class="container cta-100 ">
        <div class="container">
          <div class="row blog">
            <div class="col-md-12">
              <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#blogCarousel" data-slide-to="1"></li>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <div class="row">

                      <!-- primo vinile -->
                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <!--  <figure> <img alt="" src="/vinylwebmarket/Utility/immagini/vinile0.jpg"> </figure>-->
                            <figure><img alt="immagine vinile vuota"  src="data:{$type[0]};base64,{$pic64[0]}"></figure>
                            </div>
                            <div class="item-box-blog-body">
                              <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[0]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i>{$vinili[0]->getVenditore()->getUsername()}, <i class="fa fa-comments-o"></i>{$vinili[0]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il Venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>

                      <!-- secondo vinile -->
                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <figure><img alt="immagine vinile vuota" width="60" height="60" src="data:{$type[1]};base64,{$pic64[1]}"> <figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[1]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i> {$vinili[1]->getVenditore()->getUsername()}, <i class="fa fa-comments-o"></i> {$vinili[1]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il Venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>

                      <!--terzo vinile-->

                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <figure> <img alt="" src="data:{$type[2]};base64,{$pic64[2]}"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[2]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i>{$vinili[2]->getVenditore()->getUsername()} <i class="fa fa-comments-o"></i> {$vinili[2]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->
                  <div class="carousel-item ">
                    <div class="row">


                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <figure> <img alt="" src="data:{$type[3]};base64,{$pic64[3]}"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[3]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i>{$vinili[3]->getVenditore()->getUsername()}, <i class="fa fa-comments-o"></i> {$vinili[3]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <figure> <img alt="" src="data:{$type[4]};base64,{$pic64[4]}"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[4]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i>{$vinili[4]->getVenditore()->getUsername()}, <i class="fa fa-comments-o"></i>{$vinili[4]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                            <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>


                      <div class="col-md-4" >
                        <div class="item-box-blog">
                          <div class="item-box-blog-image">
                            <!--Date-->
                            <div class="item-box-blog-date white"> <span class="mon">Novità</span> </div>
                            <!--Image-->
                            <figure> <img alt="" src="data:{$type[5]};base64,{$pic64[5]}"> </figure>
                          </div>
                          <div class="item-box-blog-body">
                            <!--Heading-->
                            <div class="item-box-blog-heading">
                              <a href="#" tabindex="0">
                                <h5>{$vinili[5]->getTitolo()}</h5>
                              </a>
                            </div>
                            <!--Data-->
                            <div class="item-box-blog-data" style="padding: px 15px;">
                              <p><i class="fa fa-user-o"></i>{$vinili[5]->getVenditore()->getUsername()}, <i class="fa fa-comments-o"></i> {$vinili[5]->getPrezzo()}</p>
                            </div>
                            <!--Text-->
                            <div class="item-box-blog-text">
                              <p>descrizione del prodotto e maggiori informazioni</p>
                            </div>
                             <div class="mt"> <a href="#" tabindex="0" class="btn white read">Contatta il venditore!</a> </div>
                            <!--Read More Button-->
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--.row-->
                  </div>
                  <!--.item-->
                </div>
                <!--.carousel-inner-->
              </div>
              <!--.Carousel-->
            </div>
          </div>
        </div>
      </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>

</body>
</html>
