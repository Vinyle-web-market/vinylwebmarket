<?php


class FNegozio
{
    private static $table = "negozio";

    private static $class = "FNegozio";

    private static $values = "(:email_negozio, :nome, :partitaiva, :indirizzo, :id_carta, :id_abbonamento)";

    public function __construct()
    {
    }

    public static function bind($pdost, ENegozio $negozio)
    {
        $pdost->bindValue(':email_negozio', $negozio->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':nome', $negozio->getNameShop(), PDO::PARAM_STR);
        $pdost->bindValue(':partitaiva', $negozio->getPIva(), PDO::PARAM_STR);
        $pdost->bindValue(':indirizzo', $negozio->getAddress(), PDO::PARAM_STR);
        $pdost->bindValue(':id_carta', $negozio->getCarta()->getId(), PDO::PARAM_INT);
        $pdost->bindValue(':id_abbonamento', $negozio->getAbbonamento()->getId(), PDO::PARAM_INT);
    }

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }

    /**
     * @return string
     */
    public static function getTable(): string
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }


    public static function store(ENegozio $n)
    {
        $db = FDataBase::getInstance();
        $exist = $db->existP("FUtente_loggato","email",$n->getEmail());
        // $control=$db->static::exist("email",$u->getEmail());
        if($exist!=NULL)
            return "Utente ".$n->getEmail()." già esistente nel Database";
        else {
               $id1=$db->storeP($n->getCarta(),"FCarta");
               $id2=$db->storeP($n->getAbbonamento(),"FAbbonamento");
               $db->storeP($n,"FUtente_loggato");
           $n->getCarta()->setId($id1);
           $n->getAbbonamento()->setId($id2);
           $db->storeP($n, static::getClass());
           return "operazione a buon fine: " . $n->getEmail() . " salvato le tabelle utente_loggato,carta,abbonamneto e negozio sono state aggiornate ";
        }
    }

/*
    public static function store(ENegozio $n) {
        $db = FDatabase::getInstance();
        $id = $db->storeP( $n,"FUtente_loggato");
        $id1=$db->storeP($n->getCarta(),"FCarta");
        $id2=$db->storeP($n->getAbbonamento(),"FAbbonamento");
        $id3=$db->storeP($n, static::getClass());
        return $id3;
    }
*/



    public function exist ($field, $id)
    {
        $exist = false;
        $db = FDataBase::getInstance();  /*se dovesse funzionare senza questa riga, dobbiamo eliminarla */
        $exist = $db->exist(static::getClass(), $field, $id);
        if($exist)
            return $exist = true;
        else
            return $exist = false;
    }

    public function delete ($keyField,$id){
        $db = FDataBase::getInstance();
        $id = $db->deleteP(self::getClass(),$keyField,$id);
        if ($id)
            return $id;
        else
            return NULL;
    }

    public static function update($field, $newvalue, $keyField, $id)
    {
        $db=FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if($result) return true;
        else return false;
    }

    public static function load($field, $id)
    {
        $mezzo = null;
        $db = FDatabase::getInstance();
        $result = $db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if (($result != null) && ($rows_number == 1)) {
            $negozio = new ENegozio($result['email_negozio'], $result['nome'], $result['partitaiva'], $result['indirizzo'], $result['carta'], $result['abbonamento']);
            $negozio->setEmail($result['email_negozio']);
        } else {
            if (($result != null) && ($rows_number > 1)) {
                $mezzo = array();
                for ($i = 0; $i < count($result); $i++) {
                    $negozio = new ENegozio($result['email_negozio'], $result['nome'], $result['partitaiva'], $result['indirizzo'], $result['carta'], $result['abbonamento']);
                    $negozio->setEmail($result['email_negozio']);

                }
            }
        }
        return $negozio;
    }
}