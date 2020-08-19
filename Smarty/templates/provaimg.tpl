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
<body>


                    {for $i=0 to $n_vinili}

                        <img class="pic-1" width="600" height="600" src="data:{$type[$i]};base64,{$pic64[$i]}"  alt="profile picture" />

                    {/for}



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="\vinylwebmarket\Smarty\js\bootstrap.js"></script>
</body>
</html>
