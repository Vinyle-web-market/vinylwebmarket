<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>vinili in vendita</title>
</head>
<link rel="stylesheet" href="\vinylwebmarket\Smarty\js\bootstrap.js">
<link rel="stylesheet" href="\vinylwebmarket\Smarty\css\style.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body>


        <form  enctype="form-data" method="POST" action="/vinylwebmarket/Filtro/ricerca/{$vinili}">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-2 pt-3">
                        <div class="form-group ">
                            <select class="form-control" name="genere">
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
                    <div class="col-md-2 pt-3">
                        <div class="form-group">
                            <select id="inputState" class="form-control" name="ngiri">
                                <option selected>Numero giri:</option>
                                <option>33 giri</option>
                                <option>45 giri</option>
                                <option>78 giri</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-3">
                        <div class="form-group">
                            <select id="inputState" class="form-control" name="condizione">
                                <option selected>Condizioni:</option>
                                <option>Nuovo</option>
                                <option>Usato</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 pt-3">
                        <div class="form-group">
                            <select id="inputState" class="form-control" name="prezzo">
                                <option selected>Prezzo:</option>
                                <option>Fino a 15€</option>
                                <option>Fino a 25€</option>
                                <option>Fino a 40€</option>
                                <option>Oltre</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btnSubmit">Applica filtri</button>
                    </div>
                </div>
            </div>
        </form>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
</body>
</html>
