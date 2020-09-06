<?php


/**
 * La classe FPrivato implementa le funzionalità di persistenza dati per l'oggetto privato.
 * Essa rappresenta una estensione della classe FUtente_loggato, poichè il privato
 * rappresenta una delle due tipologie di utente presente nel sito.
 * Si occupa di mantenere e recuperare i dati della tabella 'privato' presente nel database.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FPrivato
{
    private static $table = "privato";
    private static $values = "(:email_privato,:nome,:cognome)";
    private static $class = "FPrivato";

    //-------------------------COSTRUTTORE-------------------------
    function __construct() {}

    /**
     * Metodo che permette di specificare a quale segnaposto della tabella dobbiamo associare
     * al place holder (terzo elemento del bind, necessario per il PDO).
     * @param $pdost (PDO statement) variabile utilizzata per l'approccio ad oggetti con il PDO.
     * @param EPrivato $privato da associare al place holder.
     */

    public static function bind($pdost, EPrivato $privato)
    {
        $pdost->bindValue(':email_privato', $privato->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':nome', $privato->getNome(), PDO::PARAM_STR);
        $pdost->bindValue(':cognome', $privato->getCognome(), PDO::PARAM_STR);
    }

    /**
     * Metodo che permette di recuperare il nome dela tabella
     * presente nel database, associata a tale classe Foundation.
     * @return string
     */

    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * Metodo che permette di recupero i valori
     * specifici di determinati campi della tabella, all'interno
     * del database.
     * @return string
     */

    public static function getValues(): string
    {
        return self::$values;
    }

    /**
     * Metodo che ci permette di
     * prendere la classe specifica.
     * Essa verrà recuperata e passata in tutte le query di FDatabase.
     * @return string
     */

    public static function getClass(): string
    {
        return self::$class;
    }

    /**
     * Metodo che permette di salvare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param EPrivato $p da associare al place holder.
     */

    public static function store(Eprivato $p)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP("FUtente_loggato","email",$p->getEmail());
        if($exist==TRUE)
            return "Utente ".$p->getEmail()." già esistente nel Database";
        else
            {
            $db->storeP($p,"FUtente_loggato");
            $db->storeP($p, static::getClass());
            return "operazione a buon fine: " . $p->getEmail() . " salvato ";
        }
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
        $db=FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if($result) return true;
        else return false;
    }

    /**
     * Metodo che permette di verificare se una specifica tupla, nella tabella
     * di associazione, risulta esser presente nel database.
     * @param $keyField chiave della ricerca.
     * @param $id valore identificativo della ricerca.
     */

    public static function exist($keyField, $id)
    {
        $db=FDatabase::getInstance();
        $exist=$db->existP(self::getClass(), $keyField, $id);
        if($exist!=NULL)
            return true;
        else
            return false;
    }

    /**
     * Metodo che permette di caricare una o più tuple dalla tabella
     * di associazione presente nel database.
     * @param $field campo della tabella su cui si fà la richiesta.
     * @param $id valore che viene richiesto.
     */

    public static function load($field, $id)
    {
        $privato=NULL;
        $db=FDatabase::getInstance();
        $resultLoadDB=$db->loadP(static::getClass(), $field, $id);
        $rows_number=$db->countLoadP(static::getClass(), $field, $id);
        if (($resultLoadDB!=null) && ($rows_number == 1))
        {
            $utenteloggato = FUtente_loggato::load("email", $resultLoadDB["email_privato"]);
            $privato = new EPrivato($utenteloggato->getUsername(), $utenteloggato->getEmail(), $utenteloggato->getPassword(), $utenteloggato->getPhone(),$resultLoadDB["nome"],$resultLoadDB["cognome"]);
            $privato->setState($utenteloggato->isState());
        }
        else
            {
            if (($resultLoadDB != null) && ($rows_number > 1))
            {
                $privato = array();
                $utenteloggato=array();
                for ($i = 0; $i < count($resultLoadDB); $i++)
                {
                    $utenteloggato[] = FUtente_loggato::load("email", $resultLoadDB[$i]["email_privato"]);
                    $privato[] = new EPrivato($utenteloggato[$i]->getUsername(), $utenteloggato[$i]->getEmail(), $utenteloggato[$i]->getPassword(), $utenteloggato[$i]->getPhone(),$resultLoadDB[$i]["nome"],$resultLoadDB[$i]["cognome"]);
                    $privato[$i]->setState($utenteloggato[$i]->isState());
                }
            }
        }
        return $privato;
    }

}