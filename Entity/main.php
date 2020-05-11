<?php
include("EAbbonamento.php");
include("ECarta.php");

//prova di EAbbonamento se non serve escluderla mediante commento
$data="08-12-2020";
$importoAbb="0";
$stato="non attivo";
$abb=new EAbbonamento($data, $importoAbb, $stato);
print "prova toString ".$abb->toString()."\n";
//$data1="3/05/2020";
//$importo1="30";
//$abb->setData($data1);
//$abb->setImporto($importo1);
//print "prova getData ".$abb->getData();
//print "prova getImporto ".$abb->getImporto();
$nummesi=3;
echo "numero mesi richiesti: ".$nummesi."\n";
$abb->CalcolaPrezzo($nummesi);
echo "prezzo abbonamento per numero mesi richiesti: ".$abb->getImporto()." €"."\n";
echo "numero mesi pagati: ".$nummesi."\n";
$abb->AggiornaAbbonamento($nummesi);
echo $abb->toString();



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
*/

?>