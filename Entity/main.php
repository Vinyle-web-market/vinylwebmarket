<?php
include("EAbbonamento.php");
include("ECarta.php");
/*
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
*/

/*
//prova ECarta se non serve escluderla mediante commento
$intestatarioCarta="tonino scarselli";
$numeroCarta="4023 6009 2356 7896";
$scadenzaCarta="27/09/2026";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
print "prova toString ".$carta->toString()."br";
$intestatarioCarta1="mangusta nannus";
$numeroCarta1="0000";
$scadenzaCarta1="000";
$codiceCVV1="000";
$carta->setNum($numeroCarta1);
$carta->setIntestat($intestatarioCarta1);
$carta->setCodcvv($codiceCVV1);
$carta->setScad($scadenzaCarta1);
print "prova getNum ".$carta->getNum();
print "prova getIntestat ".$carta->getIntestat();
print "prova getCodcvv ".$carta->getCodcvv();
print "prova getScad ".$carta->getScad();
// FINE CODICE PROVA
*/

?>