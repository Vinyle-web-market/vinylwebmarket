<?php
include_once("AutoLoad.php");

//$controller = new CHomepage();
//$controller->impostaPagina();
if (Installation::Verifica_Installazione()){
    $fc = new CFrontController();
    $fc->run();
}
else
    Installation::Inizio();


//$fc = new CFrontController();
//$fc->run();






