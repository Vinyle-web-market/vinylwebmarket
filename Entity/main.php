<?php
include("EAbbonamento.php");
include("ECarta.php");
/*
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
$stelle = "4";
$testo = "Utente molto affidabile!";
$mittente = "Tonino";
$destinatario = "Gordo";
$recensione = new ERecensione($stelle, $testo, $mittente, $destinatario);
//print "Test toString: ".$recensione->toString()."\n";
$stelle2 = "5";
$recensione->setVotostelle($stelle2);
print "Il voto è: ".$recensione->getVotostelle();
$testo2 = "Questo utente è uno dei più affidabili che abbia mai trovato!";
$recensione->setTesto($testo2);
print "Il testo del nuovo messaggio è: ".$recensione->getTesto();
$mittente2 = "Cammill billi cappilli";
$recensione->setUsernameMittente($mittente2);
print "Il mittente della recensione è: ".$recensione->getUsernameMittente();
$destinatario2 = "Matt il biondo";
$recensione->setUsernameDestinatario($destinatario2);
print "Il destinatario della recensione è: ".$recensione->getUsernameDestinatario();
*/

$venditore = "I am a bello uaglione";
$titolo = " Kittamuort";
$artist = "Il piccolo Lucio";
$gen = "Napoletano puro";
$ng = "99";
$cond = "Non male";
$pr = "€7.99";
$des = "Tutt appost";
$quant = "2";
$vinile = new Evinile($venditore, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
//echo "Test toString ".$vinile->toString();
$venditore2 = "IO";
$vinile->setUserVenditore($venditore2);
//echo " il nuovo venditore è: ".$vinile->getUserVenditore();
$titolo2 = "AAA";
$vinile->setTitolo($titolo2);
//echo " Il nuovo titolo è: ".$vinile->getTitolo();
$art2 = "Marò";
$vinile->setArtista($art2);
//echo "nuovo artista: ".$vinile->getArtista();
$gen2 = "ccc";
$vinile->setGenere($gen2);
//echo "Genere nuovo: ".$vinile->getGenere();
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