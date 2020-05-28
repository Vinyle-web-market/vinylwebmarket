<?php


class FNegozio
{
    private static $table = "negozio";

    private static $class = "FNegozio";

    private static $values = (":email_negozio, :nome, :partitaiva, :indirizzo, :carta, :abbonamento");

    public function __construct()
    {
    }

    public static function bind($pdost, ENegozio $negozio)
    {
        $pdost->bindValue(':email_negozio', $negozio->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':nome', $negozio->getNameShop(), PDO::PARAM_STR);
        $pdost->bindValue(':partitaiva', $negozio->getPIva(), PDO::PARAM_STR);
        $pdost->bindValue(':indirizzo', $negozio->getAddress(), PDO::PARAM_STR);
        $pdost->bindValue(':carta', $negozio->getCarta(), PDO::PARAM_INT);
        $pdost->bindValue(':abbonamento', $negozio->getAbbonamento(), PDO::PARAM_INT);
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

    public function store (ENegozio $negozio)
    {
        $db = FDataBase::getInstance();
        $id =$db->storeP($negozio, static::getClass());
        if ($id)
            return $id;
        else
            return null;
    }

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