<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test</title>
</head>
<body>
<?php
include("EAbbonamento.php");
include("ECarta.php");
include("ERecensione.php");
include("Evinile.php");
include("EPrivato.php");
include("ENegozio.php");
include ("EMessaggio.php");
include("../Foundation/FDataBase.php");
include("../Foundation/FRecensione.php");
include("../Foundation/FAbbonamento.php");
include("../Foundation/FCarta.php");
include("../Foundation/FUtente_loggato.php");
include("../Foundation/FPrivato.php");
include("../Foundation/FNegozio.php");
include("../Foundation/FVinile.php");
include ("../Foundation/FMessaggio.php");


//  !!! MANCA IL TEST DI MESSAGGIO !!! E IL TEST DI VINILE VA RIFATTO DOPO LE MODIFICHE
/*
echo "<hr>";
echo "<h3>prove EAbbonamento</h3>";
$abb=new EAbbonamento();
print "prova toString ".$abb->toString()."<br>";
*/

//$data1="3/05/2020";
//$importo1="30";
//$abb->setData($data1);
//$abb->setImporto($importo1);
//print "prova getData ".$abb->getData();
//print "prova getImporto ".$abb->getImporto();
/*
$nummesi=3;
//echo "numero mesi richiesti: ".$nummesi."\n";
echo "prezzo abbonamento per numero mesi richiesti: ".$abb->CalcolaPrezzo($nummesi)." €"."\n";
echo "numero mesi pagati: ".$nummesi."\n";
$abb->AggiornaAbbonamento($nummesi);
echo "".$abb->toString()."<br>";
echo "<hr>";
*/
/*
//prova ECarta se non serve escluderla mediante commento
$intestatarioCarta="toninoo selli";
$numeroCarta="40603566";
$scadenzaCarta="27/09/2026";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
print "prova toString ".$carta->toString()."<br>";
*/
/*
echo "<h3>prove EPrivato</h3>";
//public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nom,$cog)
$nom="claudio crucio";
$email="claudio0000@virgilio.it";
$pw="pippo0";
$tel="33450756896";
$nome="claudioe";
$cogn="crucianie";
$utente1=new EPrivato($nom,$email,$pw,$tel,$nome,$cogn);
print " PROVA toString <br> ".$utente1->toString()."<br>";
echo "<hr>";
*/
/*
echo "<h3>prove ENegozio</h3>";
// public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nomeNegozio,$iva,$indirizzo,ECarta $cart,EAbbonamento $abb)
$nom="ZioTonye";
$emai="ZioTony@virgeilio.it";
$passw="pappepepino";
$tele="3313476567";
$nomeNeg="Vynilshop";
$iva="19856784611";
$indirizzo="via Paolo Fabbri 23";
$utente2=new ENegozio($nom,$emai,$passw,$tele,$nomeNeg,$iva,$indirizzo,$carta,$abb);
print " PROVA toString <br> ".$utente2->toString()."<br>";
echo "<hr>";
*/
/*
echo "<h3>prove Erecensione</h3>";
$stelle = 4;
$testo = "Utente molto affidabile!";
$mittente = $utente1->getEmail();
$destinatario = $utente2->getEmail();
$recensione = new ERecensione($stelle, $testo, $mittente, $destinatario);
print "Test toString: ".$recensione->toString()."<br>";
*/
/*
echo "<h3> prova EMessaggio</h3>";
//$mitt=$utente2->getEmail();
//$dest=$utente1->getEmail();
$ogg="cia crist";
$text="il tabaccaio di pescara";
$mex=new EMessaggio($emai, $email, $ogg, $text);
print "Test to String: ".$mex->toString()."<br>";
*/
/*
$id=new FCarta();
$id2=$id->store($carta);
var_dump($id2);

$idabb=new FAbbonamento();
$idabb=$idabb->store($abb);
var_dump($idabb);

$idpriv=new FPrivato();
$idpriv->store($utente1);

$idneg=new FNegozio();
$idneg->store($utente2);

$idrec=new FRecensione();
$idrec=$idrec->store($recensione);
var_dump($idrec);


$idmex=new FMessaggio();
$idmex=$idmex->store($mex);
var_dump($idmex);
*/

/*$stelle2 = "5";
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
echo "<hr>";


/*
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
echo "<h3>prove Ecarta</h3>";
//prova ECarta se non serve escluderla mediante commento
$intestatarioCarta="toni selli";
$numeroCarta="40 60 2356 96";
$scadenzaCarta="27/09/2026";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
print "prova toString ".$carta->toString()."br";
*/

/*
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

echo "<hr>";





/*
echo "<h3>prove EUtente_loggato</h3>";
$nome="claudio";
$email="claudio97@virgilio.it";
$pw="pippo";
$tel="3345756889";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
echo "<hr>";
*/

/*
echo "<h3> Prova Vinile </h3>";

$titolo = " Kittamuort";
$artist = "Il piccolo Lucio";
$gen = "Napoletano puro";
$ng = "99";
$cond = "Non male";
$pr = "€7.99";
$des = "Tutt appost";
$quant = "2";
$vinile = new Evinile($utente1, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
echo "Test toString ".$vinile->toString()."br";
*/

/*
$stelle = "5";
$testo = "ciao caio caio";
$mittente = "nanni";
$destinatario = "pasquale";
$rec = new ERecensione($stelle, $testo, $mittente, $destinatario);
print "Test toString: ".$rec->toString()."<br>";
*/

/*
     $host="localhost";
     $database="vinylwebmarket";
     $username = 'root';
     $password = 'pippo';
try{
    $db=new PDO("mysql:host=$host;dbname=$database; charset=utf8",$username,$password);
}
catch(PDOException $err)
{
    echo"ATTENZIONE ERRORE: ".$err->getMessage();
    die;
}
*/



/*
var_dump($carta->getIntestat());
var_dump($carta->getNum());
var_dump($carta->getScad());
var_dump($carta->getCodcvv());
$int=$carta->getCodcvv();
$num=$carta->getNum();
$scad=$carta->getScad();
$cv=$carta->getCodcvv();
echo "<br>";
var_dump('miao');
var_dump('45667');
var_dump('24');
var_dump('101');
*/

/*
try {
    $db->begintransaction();
    $sql = " INSERT INTO " ."abbonamento"." VALUES "."(:id,:scadenza,:stato);";
    $pdost = $db->prepare($sql);

   $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
    $pdost->bindValue(':scadenza', $abb->getData(), PDO::PARAM_STR);
    $pdost->bindValue(':stato', $abb->getStato(), PDO::PARAM_INT);
    /*
    $pdost->bindValue(':scadenza', $carta->getScad(), PDO::PARAM_STR);
    $pdost->bindValue(':cvv', $carta->getCodcvv(), PDO::PARAM_INT);
    */


/*
    $pdost->execute();
    $id = $db->lastInsertId();
    $db->commit();

    echo"operazione effettuta";
} catch (PDOException $err) {
    echo "ATTENZIONE ERRORE: " . $err->getMessage();
    $db->rollBack();
    return null;
}
echo"<br>";
echo $sql;
echo "<br>";
var_dump($id);
*/
/*
$nome="vanessa";
$email="vanny@virgilio.it";
$pw="stupos";
$tel="33784535";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
$prova=new FUtente_loggato();
$prova1=$prova->store($u);
var_dump($prova1);
echo "<hr>";
$titolo = "notti";
$artist = "liga";
$gen = "rock";
$ng = 98;
$cond = "nuovo";
$pr = 22;
$des = "schifo musica italiana";
$quant = 7;
$vinile = new Evinile($u, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
var_dump($vinile);
echo "<br>";
echo "Test toString ".$vinile->toString()."<br>";
echo $vinile->getVenditore()->getEmail();
echo "<hr>";
*/
/*
try {
    $db->begintransaction();
   //$sql = " INSERT INTO vinile VALUES (NULL,:venditore,:titolo,:artista,:genere,:ngiri,:condizione,:prezzo,:descrizione,:quantità);";
   $sql = " INSERT INTO vinile VALUES (NULL,'Ziotony','notti','liga','rock',98,'nuovo',22,'schifo musica italiana',7);";
    $pdost = $db->prepare($sql);
    /*
        $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
        $pdost->bindValue(':venditore', $vinile->getVenditore()->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':titolo', $vinile->getTitolo(), PDO::PARAM_STR);
        $pdost->bindValue(':artista', $vinile->getArtista(), PDO::PARAM_STR);
        $pdost->bindValue(':genere', $vinile->getGenere(), PDO::PARAM_STR);
        $pdost->bindValue(':ngiri', $vinile->getNgiri(), PDO::PARAM_INT);
        $pdost->bindValue(':condizione', $vinile->getCondizione(), PDO::PARAM_STR);
        $pdost->bindValue(':prezzo', $vinile->getPrezzo(), PDO::PARAM_INT);
        $pdost->bindValue(':descrizione', $vinile->getDescrizione(), PDO::PARAM_STR);
        $pdost->bindValue(':quantità', $vinile->getQuantita(), PDO::PARAM_INT);
    */
/*
    $pdost->execute();
    $db->commit();
    $db=NULL;
    }
          catch(PDOException $err) {
              echo "ATTENZIONE ERRORE: " . $err->getMessage();
              die;
          }


echo"<br>";
echo $sql;
echo "<br>";
*/
/*

$data="2020-10-10";
$importoAbb="0";
$stato="non attivo";
$abb=new EAbbonamento();
*/

/*
//prova Fabbonamento,funziona me vedere vari casi
$a=new EAbbonamento();
var_dump($a);
//PER LA DATA INSERIRE FORMATO DATA CORRETTO
//$a->setData("1997-11-11");
$miao=new FAbbonamento();
$id1=$miao->store($a);
echo "<br>";
var_dump($id1);
*/

/*store Fabbonamneto ,funziona me vedere vari casi
$intestatarioCarta="seee";
$numeroCarta="40 60 2356 96";
$scadenzaCarta="27/09/2026";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
$id=new FCarta();
$id2=$id->store($carta);
var_dump($id2);
*/

/*delete abbonamento,OK
$id=new FAbbonamento();
var_dump($id->delete("id",5));
*/

/*delete abbonamento,OK
$id=new FCarta();
var_dump($id->delete("id",4));
*/

/*prova exist
$id=new FCarta();
var_dump($id->exist("id",12));
*/

/*
echo "<br>";
$id=new FAbbonamento();
$a=new EAbbonamento();
$a=$id->load("id",6);
var_dump($a);
echo "<br>";
echo $a->toString();
*/
 /* Prova FUtente_loggato, store() */
/*$email = new FUtente_loggato();
$email = $email->store($u);
var_dump($email);*/
/*
$id = new FUtente_loggato();
$id = $id->store($u);
//var_dump($id);
//$id->delete('username', 'claudio');
$f= new FUtente_loggato();
//$e=$f->exist('username','claudio');
//echo $e;
//$f->update('username', 'pasquale', 'email', 'claudio97@virgilio.it');
$out=$f->load('email', 'claudio97@virgilio.it');
var_dump($out);
*/
/*
//Prova Fprivato
echo "<h3>prove EUtente_loggato</h3>";
$nome="Carmelo96";
$email="carme@virgilio.it";
$pw="mj";
$tel="3378345";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
echo "<hr>";
$n="Carmelo";
$c="cstronsss";
$p=new EPrivato($nome,$email,$pw,$tel,$n,$c);
$id=new fPrivato();
$id1=$id->store($p);
var_dump($id1);
*/

/*
echo "<h3>prove EUtente_loggato</h3>";
$nome="cicco97";
$email="cicco@rgilio.it";
$pw="najnjrjcrjo";
$tel="337867867";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
$abb=new EAbbonamento();
print "prova toString ".$abb->toString()."<br>";
echo "<h3>prove Ecarta</h3>";
$intestatarioCarta="cicco";
$numeroCarta="4055 345 45";
$scadenzaCarta="2020-12-11";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
print "prova toString ".$carta->toString()."<br>";
echo "<hr>";
$nomeNeg="Shop_cicco";
$iva="196543";
$indirizzo="cvia cicco";
$negozio=new ENegozio($nome,$email,$pw,$tel,$nomeNeg,$iva,$indirizzo,$carta,$abb);


$id=new fNegozio();

$id1=$id->store($negozio);

var_dump($id1);
*/




/*
$id2=new FCarta();
$id_carta=$id2->store($carta);
$id3=new FAbbonamento();
$id_abb=$id3->store($abb);
$negozio->getCarta()->setId($id_carta);
$negozio->getAbbonamento()->setId($id_abb);
$id5=new FUtente_loggato();
$id5->store($u);
*/



/*
$host="localhost";
$database="vinylwebmarket";
$username = 'root';
$password = 'pippo';
try{
    $db=new PDO("mysql:host=$host;dbname=$database; charset=utf8",$username,$password);
}
catch(PDOException $err) {
    echo "ATTENZIONE ERRORE: " . $err->getMessage();
    die;
}
*/

/*
$db->begintransaction();
$sql = " INSERT INTO negozio VALUES ('tommy@rgilio.it', 'micio', '34567', 'via pippetto', '56', '52');";
$pdost = $db->prepare($sql);
$pdost->execute();
$db->commit();
$db=NULL;
*/


/*
try {
    $db->begintransaction();
    $sql = " INSERT INTO negozio VALUES (:email_negozio, :nome, :partitaiva, :indirizzo, :id_carta, :id_abbonamento)";
   // $sql=  " INSERT INTO negozio VALUES ('turbo@rgilio.it','turbo_shop','66696','via turbo turbo',27,23)";
    $pdost = $db->prepare($sql);

    $pdost->bindValue(':email_negozio', $negozio->getEmail(), PDO::PARAM_STR);
    $pdost->bindValue(':nome', $negozio->getNameShop(), PDO::PARAM_STR);
    $pdost->bindValue(':partitaiva', $negozio->getPIva(), PDO::PARAM_STR);
    $pdost->bindValue(':indirizzo', $negozio->getAddress(), PDO::PARAM_STR);
    $pdost->bindValue(':id_carta', $negozio->getCarta()->getId(), PDO::PARAM_INT);
    $pdost->bindValue(':id_abbonamento', $negozio->getAbbonamento()->getId(), PDO::PARAM_INT);

    $pdost->execute();
    $db->commit();
    $db=NULL;
    }
          catch(PDOException $err) {
              echo "ATTENZIONE ERRORE: " . $err->getMessage();
              die;
          }


echo"<br>";
echo $sql;
echo "<br>";
*/

//prova vinile
/*
echo "<h3>prove EUtente_loggato</h3>";
$nome="vanessa";
$email="vanny@virgilio.it";
$pw="stupos";
$tel="33784535";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
$prova=new FUtente_loggato();
$prova1=$prova->store($u);
var_dump($prova1);
echo "<hr>";
*/
/*$u=new EUtente_Loggato('cicco97','cicco@rgilio.it','najnjrjcrjo','337867867','1');
var_dump($u);

$titolo = "ragazzi funziona";
$artist = "il gordo";
$gen = "blues";
$ng = 99;
$cond = "nuovo";
$pr = "$22";
$des = "schifo musica italiana";
$quant = 2;
$vinile = new Evinile($u, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
var_dump($vinile);
echo "<br>";
echo "Test toString ".$vinile->toString()."<br>";
echo "<hr>";*/

/*
$id=new FVinile();
$id1=$id->store($vinile);
var_dump($id1);
*/

/*
echo "<hr>";
var_dump($vinile->getVenditore()->getEmail());
echo "<hr>";
var_dump($vinile->getTitolo());
echo "<hr>";
var_dump($vinile->getArtista());
echo "<hr>";
var_dump($vinile->getGenere());
echo "<hr>";
var_dump($vinile->getNgiri());
echo "<hr>";
var_dump($vinile->getCondizione());
echo "<hr>";
var_dump($vinile->getPrezzo());
echo "<hr>";
var_dump($vinile->getDescrizione());
echo "<hr>";
var_dump($vinile->getQuantita());
echo "<hr>";
try {
    $db->begintransaction();
    $sql = " INSERT INTO vinile VALUES (:id,:venditore,:titolo,:artista,:genere,:ngiri,:condizione,:prezzo,:descrizione,:quantità);";
    //$sql = " INSERT INTO vinile VALUES (NULL,'cicco@rgilio.it','notti','liga','rock',98,'nuovo','22','schifo musica italiana',7);";
    $pdost = $db->prepare($sql);

        $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
        $pdost->bindValue(':venditore', $vinile->getVenditore()->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':titolo', $vinile->getTitolo(), PDO::PARAM_STR);
        $pdost->bindValue(':artista', $vinile->getArtista(), PDO::PARAM_STR);
        $pdost->bindValue(':genere', $vinile->getGenere(), PDO::PARAM_STR);
        $pdost->bindValue(':ngiri', $vinile->getNgiri(), PDO::PARAM_INT);
        $pdost->bindValue(':condizione', $vinile->getCondizione(), PDO::PARAM_STR);
        $pdost->bindValue(':prezzo', $vinile->getPrezzo(), PDO::PARAM_STR);
        $pdost->bindValue(':descrizione', $vinile->getDescrizione(), PDO::PARAM_STR);
        $pdost->bindValue(':quantità', $vinile->getQuantita(), PDO::PARAM_INT);

    var_dump($pdost);

    $pdost->execute();
    $db->commit();
    $db=NULL;
    }
          catch(PDOException $err) {
              echo "ATTENZIONE ERRORE: " . $err->getMessage();
              die;
          }
*/
/*
$id=new FNegozio();
$id=$id->exist("email_negozio", "ZioTony@virgeilio.it");
echo $id;
*/









?>

</body>
</html>