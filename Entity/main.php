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
$nom="claudio crucio";
$email="claudio0000@virgilio.it";
$pw="pippo0";
$tel="33450756896";
$nome="claudioe";
$cogn="crucianie";
$utente1=new EPrivato($nom,$email,$pw,$tel,$nome,$cogn);
print " PROVA toString <br> ".$utente1->toString()."<br>";
echo "<hr>";
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
echo "<h3>prove Erecensione</h3>";
$stelle = 4;
$testo = "Utente molto affidabile!";
$mittente = $utente1->getEmail();
$destinatario = $utente2->getEmail();
$recensione = new ERecensione($stelle, $testo, $mittente, $destinatario);
print "Test toString: ".$recensione->toString()."<br>";
//-----------------------------------------------------------------------
*/

/*
//---------------------COSTRUTTORE EMESSAGGIO--------------------------------
echo "<h3> prova EMessaggio</h3>";
$email="claudio0000@virgilio.it";
$emai="ZioTony@virgeilio.it";
$ogg="cia crist";
$text="il tabaccaio di pescara";
$mex=new EMessaggio($emai, $email, $ogg, $text);
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
*/

/*
//----------STORE FPRIVATO--------------
$idpriv=new FPrivato();
$idpriv->store($utente1);
//--------------------------------------
*/

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
//---------------LOAD FVINILE----------------------------
$vin=new FVinile();
$vin_r=$vin->load("id_vinile", "1");
var_dump($vin_r);
//--------------------------------------------------------
*/

/*
//------------LOAD FRECENSIONE-------------------------
$rec=new FRecensione();
$rec_r=$rec->load("id","1");
var_dump($rec_r);
//-----------------------------------------------------
*/

/*
//------------LOAD FMESSAGGIO--------------------------
$mex=new FMessaggio();
$mex_r=$mex->load("mittente", "ZioTony@virgeilio.it");
var_dump($mex_r);
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
$out=$f->load('email', 'claudio97@virgilio.it');
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

?>

</body>
</html>