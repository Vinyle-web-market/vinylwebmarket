<?php
include_once("AutoLoad.php");

//$controller = new CHomepage();
//$controller->impostaPagina();
//SI LANCIA CON LOCALHOST /vinylwebmarket/
if (Installation::Verifica_Installazione()){
    //$fcontroller=new CFrontController();
    //$fcontroller->run($_SERVER['REQUEST_URI']);
    $fc = new CFrontController();
    $fc->run();
}
else
    Installation::Inizio();


//$fc = new CFrontController();
//$fc->run();






