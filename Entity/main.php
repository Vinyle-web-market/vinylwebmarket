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
include("../Foundation/FDataBase.php");
include("../Foundation/FRecensione.php");
include("../Foundation/FAbbonamento.php");
include("../Foundation/FCarta.php");
include("../Foundation/FUtente_loggato.php");


//  !!! MANCA IL TEST DI MESSAGGIO !!! E IL TEST DI VINILE VA RIFATTO DOPO LE MODIFICHE
/*echo "<hr>";
echo "<h3>prove EAbbonamento</h3>";
$data="08-12-2020";
$importoAbb="0";
$stato="non attivo";
$abb=new EAbbonamento();
//print "prova toString ".$abb->toString()."\n";
//$data1="3/05/2020";
//$importo1="30";
//$abb->setData($data1);
//$abb->setImporto($importo1);
//print "prova getData ".$abb->getData();
//print "prova getImporto ".$abb->getImporto();
$nummesi=3;
//echo "numero mesi richiesti: ".$nummesi."\n";
echo "prezzo abbonamento per numero mesi richiesti: ".$abb->CalcolaPrezzo($nummesi)." €"."\n";
echo "numero mesi pagati: ".$nummesi."\n";
$abb->AggiornaAbbonamento($nummesi);
echo "".$abb->toString()."<br>";
echo "<hr>";


echo "<h3>prove Erecensione</h3>";
$stelle = "4";
$testo = "Utente molto affidabile!";
$mittente = "Tonino";
$destinatario = "Gordo";
$recensione = new ERecensione($stelle, $testo, $mittente, $destinatario);
print "Test toString: ".$recensione->toString()."<br>";
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
echo "<h3>prove EPrivato</h3>";
//public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nom,$cog)
$nome="claudio97";
$email="claudio@virgilio.it";
$pw="pippo";
$tel="3345756896";
$stato="attivo";
$datareg="24-10-1019";
$nome="claudio";
$cogn="cruciani";
$utente1=new EPrivato($nome,$email,$pw,$tel,$stato,$datareg,$nome,$cogn);
print " PROVA toString <br> ".$utente1->toString()."br";
echo "<hr>";
*/

/*
echo "<h3>prove ENegozio</h3>";
// public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nomeNegozio,$iva,$indirizzo,ECarta $cart,EAbbonamento $abb)
$nom="ZioTony";
$emai="ZioTony@virgilio.it";
$passw="pappeppino";
$tele="3313476567";
$state="attivo";
$datar="24-9-1019";
$nomeNeg="Vynilshop";
$iva="19856784611";
$indirizzo="via Paolo Fabbri 23";
$utente2=new ENegozio($nom,$emai,$passw,$tele,$state,$datar,$nomeNeg,$iva,$indirizzo,$carta,$abb);
print " PROVA toString <br> ".$utente2->toString()."<br>";
echo "<hr>";
*/


echo "<h3>prove EUtente_loggato</h3>";
$nome="claudio";
$email="claudio97@virgilio.it";
$pw="pippo";
$tel="3345756889";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
echo "<hr>";

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
$vinile = new Evinile($u, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
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


    /* $host="localhost";
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

var_dump($db);*/
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

/*
try {
    $db->begintransaction();
    $sql = " INSERT INTO carta VALUES (:id,intestatario,:numero,:scadenza,:cvv);";
    $pdost = $db->prepare($sql);
    $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
    $pdost->bindValue(':intestatario', $carta->getIntestat(), PDO::PARAM_STR);
    $pdost->bindValue(':numero', $carta->getNum(), PDO::PARAM_STR);
    $pdost->bindValue(':scadenza', $carta->getScad(), PDO::PARAM_STR);
    $pdost->bindValue(':cvv', $carta->getCodcvv(), PDO::PARAM_STR);
    $pdost->execute();
    $id = $db->lastInsertId();
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
          $db=NULL;
           var_dump($id);
$data="2020-10-10";
$importoAbb="0";
$stato="non attivo";
$abb=new EAbbonamento();
*/

/*prova Fabbonamento,funziona me vedere vari casi
$id=new FAbbonamento();
$id1=$id->store($abb);
var_dump($id1);
*/

/*store Fabbonamneto ,funziona me vedere vari casi
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
?>

</body>
</html>