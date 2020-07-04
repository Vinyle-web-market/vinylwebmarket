<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test</title>
</head>
<body>
<?php
include_once("../AutoLoad.php");
//include_once 'smartyConfiguration.php';
/*
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
include ("../Foundation/FPersistentManager.php");
include ("../View/VUser.php");
*/

//-------MAIN ORDINATO:
//-------1. COSTRUTTORI CLASSI ENTITY
//-------2. OPERAZIONI CRUD
//-------  2.1 STORE
//-------  2.2 DELETE
//-------  2.3 EXIST
//-------  2.4 LOAD
//-------  2.5 UPDATE


/*
//---------COSTRUTTORE EABBONAMENTO--------------------------
echo "<hr>";
echo "<h3>prove EAbbonamento</h3>";
$abb=new EAbbonamento();
print "prova toString ".$abb->toString()."<br>";
//----------------------------------------------------------
*/

/*
//---------COSTRUTTORE ECARTA-------------------------------------------------------
$intestatarioCarta="toninoo selli";
$numeroCarta="40603566";
$scadenzaCarta="27/09/2026";
$codiceCVV="728";
$carta=new ECarta($intestatarioCarta, $numeroCarta, $scadenzaCarta, $codiceCVV);
print "prova toString ".$carta->toString()."<br>";
//----------------------------------------------------------------------------------
*/

/*
//---------COSTRUTTORE EPRIVATO------------------------------------------------------
echo "<h3>prove EPrivato</h3>";
//public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nom,$cog)
$nom="ciok82";
$email="carlo82@virgilio.it";
$pw="ciii";
$tel="33457";
$nome="carlo";
$cogn="fonzi";
//$utente1=new EPrivato($nom,$email,$pw,$tel,$nome,$cogn);
//print " PROVA toString <br> ".$utente1->toString()."<br>";
//echo "<hr>";
    $utente1=new EPrivato($nom,$email,$pw,$tel,$nome,$cogn);
    print " PROVA toString <br> ".$utente1->toString()."<br>";
    echo "<hr>";
    $c=EInputControl::getInstance();
    echo "<hr>";
    $err=$c->validPrivato($utente1);
    print_r($err);
    echo "<br>";
    //-------------------------------------------------------------------------------------
*/

/*
//------------------COSTRUTTORE ENEGOZIO-----------------------------------------------------------------------------------------------
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
//----------------------------------------------------------------------------------------------------------------------------------------
*/

/*
//-----------COSTRUTTORE ERECENSIONE--------------------------------------
//----------load per un utente1-----------------------------------------
$out= new FUtente_loggato();
$utente1=$out->load('email', 'rugg67@virgilio.it');
//----------load per un utente-----------------------------------------
$out= new FUtente_loggato();
$utente2=$out->load('username', 'enrico');
//---------------------------------------------------------------------
echo "<h3>prove Erecensione</h3>";
$stelle = 5;
$testo = "affidabile come sempre!";
$mittente = $utente1->getEmail();
$destinatario = $utente2->getEmail();
$recensione = new ERecensione($stelle, $testo, $mittente, $destinatario);
print "Test toString: ".$recensione->toString()."<br>";
//-----------------------------------------------------------------------
*/

/*
//---------------------COSTRUTTORE EMESSAGGIO--------------------------------
echo "<h3> prova EMessaggio</h3>";
$email2="claudio0000@virgilio.it";
$email1="ZioTony@virgeilio.it";
$ogg="cia crist";
$text="il tabaccaio di pescara";
$mex=new EMessaggio($email1, $email2, $ogg, $text);
print "Test to String: ".$mex->toString()."<br>";
//---------------------------------------------------------------------------
*/

/*
//------------COSTRUTTORE EUTENTE_LOGGATO------------------
echo "<h3>prove EUtente_loggato</h3>";
$nome="claudio";
$email="claudio97@virgilio.it";
$pw="pippo";
$tel="3345756889";
$u=new EUtente_Loggato($nome,$email,$pw,$tel);
print " PROVA toString <br> ".$u->toString()."<br>";
echo "<hr>";
//-----------------------------------------------------------
*/

/*
//---------COSTRUTTORE EVINILE-------------------------------------------------------------
//----------load per un utente-----------------------------------------
$out= new FUtente_loggato();
$out=$out->load('email', 'rugg67@virgilio.it');
//---------------------------------------------------------------------
echo "<h3> Prova Vinile </h3>";
$titolo = "domani smetto";
$artist = "articolo 31";
$gen = "rap";
$ng = "66";
$cond = "usato";
$pr = "€7.99";
$des = "anno 2001,settimo album per i cantanti milanesi";
$quant = "5";
$vinile = new Evinile($out, $titolo, $artist, $gen, $ng, $cond, $pr, $des, $quant);
echo "Test toString ".$vinile->toString()."br";
//------------------------------------------------------------------------------------------
*/

/*
//-----------------STORE FCARTA-------
$id=new FCarta();
$id2=$id->store($carta);
var_dump($id2);
//--------------------------------------
*/

/*
//---------------------STORE FABBONAMENTO------------
$idabb=new FAbbonamento();
$idabb=$idabb->store($abb);
var_dump($idabb);
//----------------------------------------------------
/*

/*
//----------STORE FPRIVATO--------------FUNZIOANTE 100%
$idpriv=new FPrivato();
$id=$idpriv->store($utente1);
echo $id;
//--------------------------------------
*/
/*  //store con PM
$idpriv=new FPersistentManager();
$id=$idpriv->store($utente1);
echo $id;
/*


/*
//-------STORE FNEGOZIO------------
$idneg=new FNegozio();
$idneg->store($utente2);
//---------------------------------
*/

/*
//--------------STORE FRECENSIONE-----------
$idrec=new FRecensione();
$idrec=$idrec->store($recensione);
var_dump($idrec);
//-----------------------------------------
*/

/*
//----------STORE FMESSAGGIO---------------
$idmex=new FMessaggio();
$idmex=$idmex->store($mex);
var_dump($idmex);
//-----------------------------------------
*/

/*
//--------STORE FUTENTE_LOGGATO-----------
$email = new FUtente_loggato();
$email = $email->store($u);
var_dump($email);
//----------------------------------------
*/

/*
//-------STORE FVINILE-------
$id=new FVinile();
$id1=$id->store($vinile);
var_dump($id1);
//---------------------------
*/

/*
//-----------DELETE FABBONAMENTO--------
$id=new FAbbonamento();
var_dump($id->delete("id",5));
//--------------------------------------
*/

/*
//------------DELETE FUTENTE_LOGGATO--------------
$id = new FUtente_loggato();
$id->delete('username', 'claudio');
//------------------------------------------------
*/

/*
//------------DELETE FCARTA-------------
$id=new FCarta();
var_dump($id->delete("id",4));
//--------------------------------------
*/

/*
//------------DELETE FMESSAGGIO---------------
$mex=new FMessaggio();
$id=$mex->delete("id","2");
echo $id;
//--------------------------------------------
*/

/*
//----------------DELETE FVINILE------------------------
$vin=new FVinile();
$vin->delete("id_vinile", "1");
//------------------------------------------------------
*/

/*
//------------DELETE FRECENSIONE-------------------
$rec=new FRecensione();
$rec->delete("id", "1");
//-------------------------------------------------
*/

/*
//--------------EXIST FPRIVATO----------------------------
$priv=new FPrivato();
$priv_r=$priv->exist("email_privato", "claudio0000@virgilio.it");
var_dump($priv_r);
//--------------------------------------------------------
*/

/*
//--------------EXIST FNEGOZIO----------------------------
$id=new FNegozio();
$id=$id->exist("email_negozio", "ZioTony@virgeilio.it");
echo $id;
//---------------------------------------------------------
*/

/*
//---------------EXIST FVINILE----------------------------
$vin=new FVinile();
$vin_r=$vin->exist("id_vinile", "1");
var_dump($vin_r);
//--------------------------------------------------------
*/

/*
//--------------EXIST FCARTA--------------
$id=new FCarta();
var_dump($id->exist("id",12));
//----------------------------------------
*/

/*
//----------EXIST FUTENTE_LOGGATO------------
$f= new FUtente_loggato();
$e=$f->exist('username','claudio');
echo $e;
//-------------------------------------------
*/

/*
//-----------EXIST FABBONAMENTO------------
$abb=new FAbbonamento();
$abb_r=$abb->exist("id","1");
echo $abb_r;
//-----------------------------------------
*/

/*
//--------EXIST FMEASSAGGIO--------
$mex=new FMessaggio();
$ex=$mex->exist("id","2");
echo $ex;
//----------------------------------
*/

/*
//-------------EXIST FRECENSIONE----------------------
$rec=new FRecensione();
$rec_r=$rec->exist("id","1");
echo $rec_r;
//----------------------------------------------------
*/

/*
//---------------LOAD FVINILE----------------------------FUNZIONANTE 100%
echo "<hr>";
$vin=new FPersistentManager();
$vin_r=$vin->load("venditore", "rugg67@virgilio.it",'FVinile');
//var_dump($vin_r);
//echo "<br>"."<br>";
echo $vin_r->toString();
//echo "<br>"."<br>";
//cho $vin_r[1]->toString();
//--------------------------------------------------------
*/

/*
//------------LOAD FRECENSIONE-------------------------FUNZIONANTE 100%
$rec=new FRecensione();
$rec_r=$rec->load("mittente","rugg67@virgilio.it");
var_dump($rec_r);
echo "<br>"."<br>";
echo $rec_r[0]->toString();
echo "<br>"."<br>";
echo $rec_r[1]->toString();
//-----------------------------------------------------
*/

/*
//------------LOAD FMESSAGGIO--------------------------

$mex=new FMessaggio();
$mex_r=$mex->load("mittente", "ZioTony@virgeilio.it");
var_dump($mex_r);
echo "<br>"."<br>";
echo $mex_r[0]->toString();
echo "<br>"."<br>";
echo $mex_r[1]->toString();
//-----------------------------------------------------
*/

/*
//------------LOAD FABBONAMENTO------------
echo "<br>";
$id=new FAbbonamento();
$a=new EAbbonamento();
$a=$id->load("id",6);
var_dump($a);
echo "<br>";
echo $a->toString();
//---------------------------------------
*/

/*
//----------LOAD FUTENTE_LOGGATO-----------------------------------------
$out= new FUtente_loggato();
$out=$out->load('email', 'claudio97@virgilio.it');
var_dump($out);
//------------------------------------------------------------------------
*/

/*
//----------LOAD FPRIVATO-----------------------------------------FUNZIONANTE 100%
echo"<hr>";
$out= new FPrivato();
$o=$out->load('cognome', 'rossi');
var_dump($o);
echo "<br>"."<br>";
echo $o[0]->toString();
echo "<br>"."<br>";
echo $o[1]->toString();
//------------------------------------------------------------------------
*/

/*
//----------LOAD FNEGOZIO-------------------------------------------------
$n=new FNegozio();
$out=$n->load('email_negozio', 'ZioTony@virgeilio.it');
var_dump($out);
//------------------------------------------------------------------------
*/

/*
//------------UPDATE FUTENTE_LOGGATO-------------------------------------
$f= new FUtente_loggato();
$f->update('username', 'pasquale', 'email', 'claudio97@virgilio.it');
//-----------------------------------------------------------------------
*/

/*
//--------------UPDATE FVINILE-----------------
$vin=new FVinile();
$vin->update("ngiri", "45", "id_vinile", "1");
//---------------------------------------------
*/

/*
//-----------------UPDATE FMESSAGGIO------------
$mex=new FMessaggio();
$mex->update("oggetto", "ciao", "id", "4");
//----------------------------------------------
*/

/*
//------------UPDATE FRECENSIONE---------------
$rec=new FRecensione();
$rec->update("voto","5", "id", "1");
//---------------------------------------------
*/

/*
//------------------UPDATE FCARTA------------
$mex=new FMessaggio();
$mex->update("oggetto", "marco", "id", "2");
$mes=$mex->load("id", "2");
var_dump($mes);
//-------------------------------------------
*/

/*
//----------UPDATE FABBONAMENTO-------------
$abb=new FAbbonamento();
$abb->update("scadenza","02/06/2021", "id","2");
//------------------------------------------
*/

/*
//----------UPDATE FNEGOZIO-------------------
$neg= new FNegozio();
$neg->update("nome", "marco", "email_negozio", "ZioTony@virgeilio.it");
//--------------------------------------------
*/

/*
//--------------UPDATE FPRIVATO---------------
$priv= new FPrivato();
$priv->update("nome", "marco", "email_privato", "claudio0000@virgilio.it");
//--------------------------------------------
*/

/*
//-----------------RICERCA VINILE-----------------------
$id=new FVinile();
$id_v=$id->search(NULL,'liga',NULL,'99',NULL,NULL);
var_dump($id_v);
*/

/*
//-----------------ADMIN__PRENDI TUTTE LE RECENSIONI------
$id=new FPersistentManager();
$id1=$id->adminAllReviews();
print_r($id1);
//array_values($id1)
/*

/*
echo $id1[0]->toString();
echo "<br>"."<br>";
echo $id1[1]->toString();
echo "<br>"."<br>";
echo $id1[2]->toString();
*/

//------------OPERAZIONI/TEST IMMAGINI---------------------
/*
 // OPERAZIONI DA FARE IN CONTROLLER PRIMA DI INVOCARE I COSTRUTTORI E METODI
echo"<hr>";
$name=$_FILES['foto']["name"];
$type=$_FILES['foto']["type"];
$dataimage=file_get_contents($_FILES['foto']["tmp_name"]);
$dataimage=base64_decode($dataimage);
$immagine=new EImageUtente($name,$dataimage,$type,'gianluca@virgilio.it');
var_dump($immagine);


//-----------STORE
$f=new FImage();
$f1=$f->storeI($immagine,'foto');
echo"<hr>";
echo $f1;
*/
//---------DELETE
/*
$f=new FImage();
$f1=$f->deleteI('EImageVinile','id','2');
var_dump($f1);

$f=new Fimage();
$f1=$f->loadI('EImageVinile','id','4');
var_dump($f1);
*/


$pm=new FPersistentManager();
$miao=$pm->deleteImg("EImageUtente","email_utente","Michele@virgilio.it");
var_dump($miao);





?>

</body>
</html>