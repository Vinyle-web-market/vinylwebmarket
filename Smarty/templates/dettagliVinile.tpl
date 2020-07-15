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

            <li class="nav-item dropdown">
          </ul>
          <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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
                                         <img id="ProductPhotoImg" class="product-zoom"  src="data:{$typeVin[0]};base64,{$pic64Vin[0]}"></a>
                                 </div>
                                 <div id="ProductThumbs" class="product-thumbnail owl-carousel">
                                     <a href="data:{$typeVin[1]};base64,{$pic64Vin[1]}">
                                         <img src="data:{$typeVin[1]};base64,{$pic64Vin[1]}"></a>
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
                                     <form method="post" id="AddToCartForm" accept-charset="UTF-8" class="shopify-product-form" enctype="multipart/form-data">
                                         <input type="hidden" name="form_type" value="product" /><input type="hidden" name="utf8" value="✓" />
                                         <div class="product-details">
                                           <hr color="black">
                                             <h1 class="single-product-name">{$ris->getTitolo()}</h1>
                                             <hr>
                                             <h1 class="single-product-name1">Lucio Battisti</h1>
                                             <div class="single-product-price">
                                               <hr color=black>
                                                 <div class="product-discount"><span  class="price" id="ProductPrice"><span class=money>$20.66</span></span></div>
                                                 <hr color=black>
                                             </div>
                                             <div>
                                                <h1 class="single-product-name1">Messo in vendita da:<a href="messaggi.html">
                                                <i class="glyphicon glyphicon-user"></i>
                                                Venditore</a></h1>
                                                <hr color=black>
                                             </div>
                                             <div>
                                               <h1 class="single-product-name2">Genere:
                                               <i class="glyphicon glyphicon-user"></i>
                                               Genere</h1>
                                               <hr color=black>
                                             </div>
                                             <div>
                                               <h1 class="single-product-name1">Condizioni:
                                               <i class="glyphicon glyphicon-user"></i>
                                               Nuovo</h1>
                                               <hr color=black>
                                             </div>
                                             <div>
                                               <h1 class="single-product-name2">Tipologia:
                                               <i class="glyphicon glyphicon-user"></i>
                                               45 giri</h1>
                                               <hr color=black>
                                             </div>
                                             <div>
                                               <h1 class="single-product-name1">Quantità:
                                               <i class="glyphicon glyphicon-user"></i>
                                               8</h1>
                                               <hr color=black>
                                             </div>
                                             <h1 class="single-product-name2">Descirizione: </h1>
                                             <div class="product-info">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</div>
                                          
                                             <div class="single-product-action">
                                                 <div class="product-variant-option">
                                                     <select name="id" id="productSelect" class="product-single__variants" style="display:none;">
                                                         <option  selected="selected"  data-sku="YQT71020193" value="19506517377094">Default Title - <span class=money>$20.66 USD</span></option>
                                                     </select>
                                                 </div>

                                                 <div class="product-add-to-cart">
                                                     <span class="control-label">Quantità</span>
                                                     <div class="cart-plus-minus">
                                                         <input class="cart-plus-minus-box" type="text" name="quantity" value="1">
                                                     </div>
                                                     <div class="add">
                                                         <button type="submit" class="add-to-cart ajax-spin-cart" id="AddToCart">
                                                             <i class="ion-bag"></i>
                                                             <span class="list-cart-title cart-title" id="AddToCartText">Contatta il venditore!</span>
                                                         </button>

                                                     </div>
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
