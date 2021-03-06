{assign var='contatta' value=$contatta|default:'ok'}
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Annuncio</title>
<link rel="stylesheet" href="/vinylwebmarket/Smarty/css/bootstrap.min.css">
    <link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
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
            <li class="nav-item dropdown">
          </ul>
            <form class="form-inline my-2 my-lg-0" method="POST" action="/vinylwebmarket/Filtro/ricercaParola">
                <input name="parola" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
      </nav>


 <div class="wrapper">
         <main>
             <div id="shopify-section-product-template" class="shopify-section">
                 <div class="single-product-area mt-80 mb-80">
                     <div class="container">
                         <div class="row">

                            {if $n_img_annuncio==2}
                             <div class="col-md-5">
                                 <div class="product-details-large" id="ProductPhoto">
                                     <a href="data:{$typeVin[0]};base64,{$pic64Vin[0]}">
                                         <img id="ProductPhotoImg" class="product-zoom" width="450" height="450" src="data:{$typeVin[0]};base64,{$pic64Vin[0]}"></a>
                                 </div>
                                 <div id="ProductThumbs" class="product-thumbnail owl-carousel">
                                     <a href="data:{$typeVin[1]};base64,{$pic64Vin[1]}">
                                         <img src="data:{$typeVin[1]};base64,{$pic64Vin[1]}" width="250" height="250"></a>
                                 </div>
                             </div>
                             {/if}

                             {if $n_img_annuncio==1}
                                 <div class="col-md-5">
                                     <div class="product-details-large" id="ProductPhoto">
                                         <a href="data:{$typeVin};base64,{$pic64Vin}">
                                             <img id="ProductPhotoImg" class="product-zoom"  src="data:{$typeVin};base64,{$pic64Vin}"></a>
                                     </div>
                                 </div>
                             {/if}

                             {if $n_img_annuncio==0}
                                 <div class="col-md-5">
                                     <div class="product-details-large" id="ProductPhoto">
                                         <a href="/vinylwebmarket/Utility/immagini/fotovinileassente.jpg">
                                             <img id="ProductPhotoImg" class="product-zoom"  src="data:{$typeVin[1]};base64,{$pic64Vin[1]}"></a>
                                     </div>
                                 </div>
                             {/if}

                             <div class="col-md-7">
                                 <div class="single-product-content">
                                     <form method="post" id="AddToCartForm" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data" action="/vinylwebmarket/Messaggi/chat">
                                         <input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
                                         <div class="product-details">
                                           <hr color="black">
                                             <h1 class="single-product-name">Titolo: {$ris->getTitolo()}</h1>
                                             <h1 class="single-product-name1">Artista: {$ris->getArtista()}</h1>
                                             <div class="single-product-price">
                                                 <div class="product-discount"><span  class="price" id="ProductPrice"><span class=money>Prezzo:{$ris->getprezzo()}€</span></span></div>
                                             </div>
                                             <div>
                                                <h1 class="single-product-name2">Messo in vendita da:
                                                <i class="glyphicon glyphicon-user"></i>
                                                        {$ris->getVenditore()->getUsername()}</a></h1>

                                             </div>
                                             <div>
                                               <h1 class="single-product-name2">Genere:
                                               <i class="glyphicon glyphicon-user"></i>
                                                   {$ris->getGenere()}</h1>

                                             </div>
                                             <div>
                                               <h1 class="single-product-name2">Condizioni:
                                               <i class="glyphicon glyphicon-user"></i>
                                                   {$ris->getCondizione()}</h1>

                                             </div>
                                             <div>
                                               <h1 class="single-product-name2">Tipologia:
                                               <i class="glyphicon glyphicon-user"></i>
                                                   {$ris->getNgiri()}</h1>

                                             </div>
                                             <div>
                                               <h1 class="single-product-name1">Quantità:
                                               <i class="glyphicon glyphicon-user"></i>
                                                   {$ris->getQuantita()}</h1>

                                             </div>
                                             <hr color="black">
                                             <h1 class="single-product-name2">Descrizione: </h1>
                                             <div class="product-info">{$ris->getDescrizione()}</div>
                                                 <div class="product-variant-option">
                                                     <select name="id" id="productSelect" class="product-single__variants" style="display:none;">
                                                         <option  selected="selected"  data-sku="YQT71020193" value="19506517377094">Default Title - <span class=money>{$ris->getPrezzo()}€</span></option>
                                                     </select>
                                                 </div>
                                                    <hr color="black">
                                                 <div class="product-add-to-cart">
                                                     <span class="control-label">Quantità:</span>
                                                     <div class="cart-plus-minus">
                                                         <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                                     </div>
                                                     {if $contatta=='ok'}
                                                     <div class="add">
                                                         <input type="hidden" value="{$ris->getVenditore()->getEmail()}" name="email2">
                                                         <button type="submit" class="add-to-cart ajax-spin-cart" id="AddToCart">
                                                             <i class="ion-bag"></i>
                                                             <span class="list-cart-title cart-title" id="AddToCartText">Contatta il venditore!</span>
                                                         </button>

                                                     </div>
                                                     {/if}
                                                 </div>

                                             </div>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </main>
     </div>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="/vinylwebmarket/Smarty/js/bootstrap.js"></script>
</body>
</html>
