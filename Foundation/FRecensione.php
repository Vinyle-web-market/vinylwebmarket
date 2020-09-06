<?php

/**
 * La classe FRecensione implementa le funzionalità di persistenza dati per l'oggetto recensione.
 * Si occupa di mantenere e recuperare i dati della tabella 'recensione' presente nel database.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FRecensione
{
  private static $table = "recensione";
  private static $values= "(:id,:mittente,:destinatario,:testo_recensione,:voto, :ban)";
  private static $class= "FRecensione";

    //-------------------------COSTRUTTORE-------------------------
    function __construct(){}

    /**
     * Metodo che permette di specificare a quale segnaposto della tabella dobbiamo associare
     * al place holder (terzo elemento del bind, necessario per il PDO).
     * @param $pdost (PDO statement) variabile utilizzata per l'approccio ad oggetti con il PDO.
     * @param ERecensione $r da associare al place holder.
     */

    public static function bind($pdost,ERecensione $r)
    {
        $pdost->bindValue(':id', NULL, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $r->getUsernameMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $r->getUsernameDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo_recensione', $r->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':voto', $r->getVotostelle(), PDO::PARAM_INT);
        $pdost->bindValue(':ban', $r->isBan(), PDO::PARAM_BOOL);
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
     * Metodo che permette di salvare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param EMessaggio $m da associare al place holder.
     */

    public static function store (ERecensione $r)
    {
        $db=FDatabase::getInstance();
        $id=$db->storeP($r, self::getClass());
        if($id)
            return $id;
        else
            return NULL;
    }

    /**
     * Metodo che permette di verificare se una specifica tupla, nella tabella
     * di associazione, risulta esser presente nel database.
     * @param $keyField chiave della ricerca.
     * @param $id valore identificativo della ricerca.
     */

    public function exist ($field, $id)
    {
        $exist = false;
        $db = FDatabase::getInstance();
        $exist = $db->existP(static::getClass(), $field, $id);
        if($exist)
            return $exist = true;
        else
            return $exist = false;
    }

    /**
     * Metodo che permette di eliminare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param $keyField chiave della ricerca.
     * @param $id valore identificativo della ricerca.
     */

    public static function delete($keyField,$id)
    {
        $db = FDatabase::getInstance();
        $id=$db->deleteP(self::getClass(),$keyField,$id);
        if ($id)
            return $id;
        else
            return NULL;
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
     * Metodo che permette di caricare una o più tuple dalla tabella
     * di associazione presente nel database.
     * @param $field campo della tabella su cui si fà la richiesta.
     * @param $id valore che viene richiesto.
     */

    public static function load($field, $id)
    {
        $recensione = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1))
        {
            $recensione=new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $recensione->setBan($result['ban']);
        }
        else
            {
            if(($result!=null) && ($rows_number > 1))
            {
                $recensione=array();
                for($i=0; $i<count($result); $i++)
                {
                    $recensione[]=new ERecensione($result[$i]['voto'],$result[$i]['testo_recensione'],$result[$i]['mittente'],$result[$i]['destinatario']);
                    $recensione[$i]->setBan($result[$i]['ban']);
                }
            }
        }
        return $recensione;
    }

    /**
     * Metodo che permette di caricare tutte le recensioni, in assoluto, presenti nel database.
     */

    public static function adminAllReviews()
    {
        $review = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number)=$db->adminGetRev();
        if(($result != null) && ($rows_number == 1))
        {
            $review = new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $review->setId($result['id']);
        }
        else
            {
            if(($result != null) && ($rows_number > 1))
            {
                $review = array();
                for($i = 0; $i < count($result); $i++)
                {
                    $review[] = new ERecensione($result[$i]['voto'], $result[$i]['testo_recensione'],$result[$i]['mittente'], $result[$i]['destinatario']);
                    $review[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $review;
    }

    /**
     * Metodo che permette di effettuare una parola data come valore in input.
     * @param $parola valore da ricercare all'interno del campo di testo della recensione
     */

    public static function ricercaParola($parola)
    {
        $rec = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->ricercaP('testo_recensione',static::getClass(),$parola);

        if(($result != null) && ($rows_number == 1))
        {
            $rec = new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $rec->setId($result['id']);
        }
        else
            {
            if(($result != null) && ($rows_number > 1))
            {
                $rec = array();
                for($i = 0; $i < count($result); $i++)
                {
                    $rec[] = new ERecensione($result[$i]['voto'], $result[$i]['testo_recensione'],$result[$i]['mittente'], $result[$i]['destinatario']);
                    $rec[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $rec;
    }

  }