<?php
include("EAbbonamento.php");

//prova di EAbbonamento se non serve escluderla mediante commento
$data="27/06/1970";
$importoAbb="5";
$abb=new EAbbonamento($data, $importoAbb);
print "prova toString ".$abb->toString()."br";
$data1="3/05/2020";
$importo1="30";
$abb->setData($data1);
$abb->setImporto($importo1);
print "prova getData ".$abb->getData();
print "prova getImporto ".$abb->getImporto();
// FINE CODICE PROVA

?>