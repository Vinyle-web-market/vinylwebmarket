<?php

/**
 * La classe FMessaggio implementa le funzionalità di persistenza dati per l'oggetto messaggio.
 * Si occupa di mantenere e recuperare i dati della tabella 'messaggio' presente nel database.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FMessaggio
{
    private static $table = "messaggio";
    private static $class = "FMessaggio";
    private static $values ="(:id, :mittente, :destinatario, :testo, :oggetto)";

    //-------------------------COSTRUTTORE-------------------------
    public function __construct() {}

    /**
     * Metodo che permette di specificare a quale segnaposto della tabella dobbiamo associare
     * al place holder (terzo elemento del bind, necessario per il PDO).
     * @param $pdost (PDO statement) variabile utilizzata per l'approccio ad oggetti con il PDO.
     * @param EMessaggio $m da associare al place holder.
     */

    public static function bind($pdost, EMessaggio $m)
    {
        $pdost->bindValue(':id', null, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $m->getMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $m->getDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo', $m->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':oggetto', $m->getOggetto(), PDO::PARAM_STR);
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
     * Metodo che permette di salvare una specifica tupla nella tabella
     * di associazione presente nel database.
     * @param EMessaggio $m da associare al place holder.
     */

    public function store(EMessaggio $m)
    {
        $db = FDatabase::getInstance();
        $id =$db->storeP($m, self::getClass());
        if ($id)
            return $id;
        else
            return null;
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

    public function delete($keyField,$id)
    {
        $db = FDatabase::getInstance();
        $id = $db->deleteP(self::getClass(),$keyField,$id);
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
        $messaggio = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1))
        {
            $messaggio=new EMessaggio($result['mittente'],$result['destinatario'],$result['oggetto'],$result['testo']);
        }
        else
            {
            if(($result!=null) && ($rows_number > 1))
            {
                $messaggio = array();
                for($i=0; $i<count($result); $i++)
                {
                    $messaggio[]=new EMessaggio($result[$i]['mittente'],$result[$i]['destinatario'],$result[$i]['oggetto'],$result[$i]['testo']);
                }
            }
        }
        return $messaggio;
    }

    /**
     * Permette di ottenere due vettori di messaggi, uno dall'utente che contatta, l'altro dall'utente che risponde
     * @param $email valore da ricercare nel campo $field
     * @param $email2 valore del campo della ricerca
     */

    public static function loadChats($email, $email2)
    {
        $messaggio1 = null;
        $messaggio2 = null;
        $db = FDatabase::getInstance();
        list ($result1, $result2, $rows_number1, $rows_number2)=$db->loadChats($email, $email2);

        if(($result1 != null) && ($rows_number1 == 1))
        {
            $messaggio1=new EMessaggio($result1['mittente'],$result1['destinatario'],$result1['oggetto'],$result1['testo']);
            $messaggio1->setId($result1['id']);
        }
        else
            {
            if(($result1 != null) && ($rows_number1 > 1))
            {
                $messaggio1 = array();
                for($i = 0; $i < count($result1); $i++)
                {
                    $messaggio1[]=new EMessaggio($result1[$i]['mittente'],$result1[$i]['destinatario'],$result1[$i]['oggetto'],$result1[$i]['testo']);
                    $messaggio1[$i]->setId($result1[$i]['id']);
                }
            }
        }
        if(($result2 != null) && ($rows_number2 == 1))
        {
            $messaggio2=new EMessaggio($result2['mittente'],$result2['destinatario'],$result2['oggetto'],$result2['testo']);
            $messaggio2->setId($result2['id']);
        }
        else
        {
            if(($result2 != null) && ($rows_number2 > 1))
            {
                $messaggio2 = array();
                for($i = 0; $i < count($result2); $i++)
                {
                    $messaggio2[]=new EMessaggio($result2[$i]['mittente'],$result2[$i]['destinatario'],$result2[$i]['oggetto'],$result2[$i]['testo']);
                    $messaggio2[$i]->setId($result2[$i]['id']);
                }
            }
        }
        return array($messaggio1, $messaggio2);
    }

    /**
     * Permette di ottenere tutti i messaggi in cui l'utente passato come parametro risulti o il ricevente o il mittente
     * @param $email valore da ricercare nel campo $field
     * @param $email2 valore del campo della ricerca
     */

    public static function elencoChats($email, $email2)
    {
        $messaggio = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number)=$db->elenco_Chats($email, $email2);

        if(($result != null) && ($rows_number == 1))
        {
            $messaggio=new EMessaggio($result['mittente'],$result['destinatario'],$result['oggetto'],$result['testo']);
            $messaggio->setId($result['id']);
        }
        else
        {
            if(($result != null) && ($rows_number > 1))
            {
                $messaggio = array();
                for($i = 0; $i < count($result); $i++)
                {
                    $messaggio[]=new EMessaggio($result[$i]['mittente'],$result[$i]['destinatario'],$result[$i]['oggetto'],$result[$i]['testo']);
                    $messaggio[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $messaggio;
    }

}