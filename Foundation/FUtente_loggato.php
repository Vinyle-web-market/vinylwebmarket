<?php

/**
 * La classe FUtente_loggato implementa le funzionalità di persistenza dati per l'oggetto utente.
 * Si occupa di mantenere e recuperare i dati della tabella 'utente_loggato' presente nel database.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FUtente_loggato
{
    private static $table = "utente_loggato";
    private static $values = "(:username,:email,:password,:telefono,:stato)";
    private static $class = "FUtente_loggato";

    //-------------------------COSTRUTTORE-------------------------
    function __construct() {}

    /**
 * Metodo che permette di specificare a quale segnaposto della tabella dobbiamo associare
 * al place holder (terzo elemento del bind, necessario per il PDO).
 * @param $pdost (PDO statement) variabile utilizzata per l'approccio ad oggetti con il PDO.
 * @param EUtente_loggato $utente da associare al place holder.
 */

   public static function bind($pdost, EUtente_loggato $utente)
   {
       $pdost->bindValue(':username', $utente->getUsername(), PDO::PARAM_STR);
       $pdost->bindValue(':email', $utente->getEmail(), PDO::PARAM_STR);
       $pdost->bindValue(':password', $utente->getPassword(), PDO::PARAM_STR);
       $pdost->bindValue(':telefono', $utente->getPhone(), PDO::PARAM_STR);
       $pdost->bindValue(':stato', $utente->isState(), PDO::PARAM_BOOL);
   }

    /**
     * Metodo che permette di recuperare il nome dela tabella
     * presente nel database, associata a tale classe Foundation.
     * @return string
     */

    public static function getTable()
    {
        return self::$table;
    }

    /**
     * Metodo che ci permette di
     * prendere la classe specifica.
     * Essa verrà recuperata e passata in tutte le query di FDatabase.
     * @return string
     */

    public static function getClass()
    {
        return self::$class;
    }

    /**
     * Metodo che permette di recupero i valori
     * specifici di determinati campi della tabella, all'interno
     * del database.
     * @return string
     */

    public static function getValues()
    {
        return self::$values;
    }

    /**
     * Metodo che permette di salvare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param EUtente_loggato $u da associare al place holder.
     */

    public static function store(EUtente_loggato $u)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(),"email",$u->getEmail());
        if($exist==TRUE)
           return "Utente ".$u->getEmail()." già esistente nel Database";
        else
            {
            $db->storeP($u, static::getClass());
            return "operazione a buon fine: " . $u->getEmail() . " salvato nella tablle utente_loggato ";
            }
    }

    /**
     * Metodo che permette di eliminare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param $keyField chiave della ricerca.
     * @param $id valore identificativo della ricerca.
     */

    public static function delete($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $execute = $db->deleteP(self::getClass(), $keyField, $id);
        if ($execute)
            return true;
        else
            return false;
    }

    /**
     * Metodo che permette di verificare se una specifica tupla, nella tabella
     * di associazione, risulta esser presente nel database.
     * @param $keyField chiave della ricerca.
     * @param $id valore identificativo della ricerca.
     */

    public static function exist($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(), $keyField, $id);
        if ($exist != null)
            return true;
        else
            return false;
    }

    /**
     * Metodo che permette di aggiornare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param $field campo della tabella su cui fare l'aggiornamento.
     * @param $newvalue valore da inserire per l'aggiornamento.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public static function update($field, $newvalue, $keyField, $id)
    {
        $result = false;
        $db = FDatabase::getInstance();
        $result = $db->updateP(self::getClass(), $field, $newvalue, $keyField, $id);
        if($result)
            return $result;
        else
            return $result = false;
    }

    /**
     * Metodo che permette di caricare una o più tuple dalla tabella
     * di associazione presente nel database.
     * @param $field campo della tabella su cui si fà la richiesta.
     * @param $id valore che viene richiesto.
     */

    public static function load($field, $id)
    {
        $utente = null;
        $db = FDatabase::getInstance();
        $result = $db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1))
        {
            $utente = new EUtente_loggato($result['username'], $result['email'], $result['password'], $result['telefono']);
        }
        else
            {
            if(($result!=null) && ($rows_number > 1))
            {
                $utente = array();
                for($i=0; $i<count($result); $i++)
                {
                    $utente []= new EUtente_loggato($result[$i]['username'],$result[$i]['email'],$result[$i]['password'], $result[$i]['telefono']);
                }
            }
        }
        return $utente;
    }

    //ritorna oggetto utente,fa una load
    /**
     * Metodo che permette di verificare che le credenziale, email e passowrd, siano
     * presenti nel database.
     * @param $email (e-mail) che deve essere verificata nel database.
     * @param $pass (password) che deve essere verificata nel database.
     * @return EUtente_loggato
     */

    public static function login($email, $pass)
    {
        $utente=null;
        $db=FDatabase::getInstance();
        $result=$db->loginP($email, $pass);
        print_r($result);
        if (isset($result))
        {
            $privato = FPrivato::load("email_privato" , $result["email"]);
            $negozio = FNegozio::load("email_negozio" , $result["email"]);
            $admin = static::load("email", $result["email"]);
            if ($privato)
                $utente = $privato;
            elseif ($negozio)
                $utente = $negozio;
            elseif ($admin)
                $utente = $admin;
        }
        return $utente;
    }

    /**
     * Metodo che permette di effettuare una ricerca con una parola data come valore in input.
     * @param $parola valore da ricercare all'interno del campo di testo della recensione
     * @return EUtente_loggato
     */

    public static function ricercaParola($parola)
    {
        $utente = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->ricercaP('email',static::getClass(),$parola);

        if(($result!=null) && ($rows_number == 1))
        {
            $utente = new EUtente_loggato($result['username'], $result['email'], $result['password'], $result['telefono']);
            $utente->setState($result['stato']);
        }
        else
            {
            if(($result!=null) && ($rows_number > 1))
            {
                $utente = array();
                for($i=0; $i<count($result); $i++)
                {
                    $utente []= new EUtente_loggato($result[$i]['username'],$result[$i]['email'],$result[$i]['password'], $result[$i]['telefono']);  //ARRAY DI ARRAY ATTENTO
                    $utente[$i]->setState($result[$i]['stato']);
                }
            }
        }
        return $utente;
    }

}