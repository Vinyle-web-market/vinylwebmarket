<?php

/**
 * La classe FAbbonamento implementa le funzionalità di persistenza dati per l'oggetto abbonamento.
 * Si occupa di mantenere e recuperare i dati della tabella 'abbonamento' presente nel database.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FAbbonamento
{
    private static $table = "abbonamento";
    private static $values = "(:id,:scadenza,:stato)";
    private static $class = "FAbbonamento";

//-------------------------COSTRUTTORE-------------------------

    public function __construct() {}

    /**
     * Metodo che permette di specificare a quale segnaposto della tabella dobbiamo associare
     * al place holder (terzo elemento del bind, necessario per il PDO).
     * @param $pdost (PDO statement) variabile utilizzata per l'approccio ad oggetti con il PDO.
     * @param EAbbonamento $a da associare al place holder.
     */

    public static function bind($pdost, EAbbonamento $a)
    {
        $pdost->bindValue(':id', NULL, PDO::PARAM_INT);
        $pdost->bindValue(':scadenza', $a->getData(), PDO::PARAM_STR);
        $pdost->bindValue(':stato', $a->isStato(), PDO::PARAM_BOOL);
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
     * Metodo che permette di recuperare il nome dela tabella
     * presente nel database, associata a tale classe Foundation.
     * @return string
     */

    public static function getTable()
    {
        return self::$table;
    }

    /**
     * Metodo che permette di salvare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param EAbbonamento $a da associare al place holder.
     */

    public static function store(EAbbonamento $a)
    {
        $db = FDatabase::getInstance();
        $id = $db->storeP($a, self::getClass());
        if ($id)
            return $id;
        else
            return NULL;
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
        $mezzo = null;
        $abbonamento= null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1))
        {
            $abbonamento=new EAbbonamento();
            $abbonamento->setId($result['id']);
            $abbonamento->setData($result['scadenza']);
            $abbonamento->setStato($result['stato']);
        }
        else
            {
            if(($result!=null) && ($rows_number > 1))
            {
                $mezzo = array();
                for($i=0; $i<count($result); $i++)
                {
                    $abbonamento[]=new EAbbonamento();  //ARRAY DI ARRAY ATTENTO
                    $abbonamento[$i]->setId($result[$i]['id']);
                    $abbonamento[$i]->setData($result[$i]['scadenza']);
                    $abbonamento[$i]->setStato($result[$i]['stato']);
                }
            }
        }
        return $abbonamento;
    }

}