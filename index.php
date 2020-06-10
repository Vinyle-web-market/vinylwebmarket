<?php
include_once("AutoLoad.php");

//$controller = new CHomepage();
//$controller->impostaPagina();
//SI LANCIA CON LOCALHOST /vinylwebmarket/
$fc = new CFrontController();
$fc->run();






/*
$path = $_SERVER['REQUEST_URI'];
echo $path;
echo"----------------";
$array = explode('/', $path);
print_r($array);
array_shift($array);

echo"----------------";

$count = count($array);
echo"-----------------------------------------------------------------";
echo $count;
echo"----------------";
$p="C".$array[0];
echo $p;
//$vero=class_exists($p);
 //var_dump($vero);


if ($array[$count - 1] == null) {
    unset($array[$count - 1]);
}
if (count($array) != 1) {
    $controller = $array[1];
    $controller = "C" . $controller;
    if (class_exists($controller)) {
        $metodo = $array[2];
        if (method_exists($controller, $metodo)) {
            $c = new $controller();
            if (isset($array[3])) {
                $parametro = $array[3];
                if (isset($array[4])) {
                    $parametro2 = $array[4];
                    if (isset($array[5])) {
                        $parametro3 = $array[5];
                        $c->$metodo($parametro, $parametro2, $parametro3);
                    } else {
                        $c->$metodo($parametro, $parametro2);
                    }
                } else
                    $c->$metodo($parametro);
            } else {
                $c->$metodo();
            }
            /* } else {
                 header('HTTP/1.1 405 Method Not Allowed');
                 exit;
             }
           */
      /*
        }
   */
        /*
        else {
            $errore="Pagina non trovata";
            $view = new VError();
            $view->mostraErrore($errore);
        }
        */
/*
    } else { //richiesta per la Homepage
        $controller = new CHomepage();
        $controller->impostaPagina();
    }
}
*/


//echo $controller;
//echo " "."----------------".$path;


//$fc = new CFrontController();
//$fc->run();
