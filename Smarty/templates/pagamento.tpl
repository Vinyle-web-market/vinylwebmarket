<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pagamento</title>
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\js\bootstrap.js">
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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

            <li class="nav-item dropdown">
        </ul>
        <form class="form-inline my-2 my-lg-0" method="post" action="/vinylwebmarket/Filtro/ricercaParola">
            <input name="parola" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">I nostri abbonamenti:</h1>
    <p class="lead">Con uno dei nostri pacchetti potrai diventare un utente premium e inserire in vendita tutti gli annunci che desideri! </p>
</div>

<div class="container">
    <div class="card-deck mb-3 text-center">
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Abbonamento base</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">15€<small class="text-muted"></small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>1 mese</li>
                    <li>di account</li>
                    <li>Premium</li>
                </ul>
                <div class="col-md-8">
                    <form class="form-content" action="/vinylwebmarket/Abbonamento/transazione" method="POST">
                    <input type="hidden" value="1" name="numeromesi">
                    <button type="submit" class="btn btnSubmit">Abbonati</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Abbonamento intermedio</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">40€ <small class="text-muted"></small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>3 mesi</li>
                    <li>di account</li>
                    <li>Premium</li>
                </ul>
                <div class="col-md-8">
                    <form class="form-content" action="/vinylwebmarket/Abbonamento/transazione" method="POST">
                    <input type="hidden" value="3" name="numeromesi">
                    <button type="submit" class="btn btnSubmit">Abbonati</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Abbonamento esperto</h4>
            </div>
            <div class="card-body">
                <h1 class="card-title pricing-card-title">70€<small class="text-muted"></small></h1>
                <ul class="list-unstyled mt-3 mb-4">
                    <li>6 mesi</li>
                    <li>di account</li>
                    <li>Premium</li>
                </ul>
                <div class="col-md-8">
                    <form class="form-content" action="/vinylwebmarket/Abbonamento/transazione" method="POST">
                    <input type="hidden" value="6" name="numeromesi">
                   <button type="submit" class="btn btnSubmit">Abbonati</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>