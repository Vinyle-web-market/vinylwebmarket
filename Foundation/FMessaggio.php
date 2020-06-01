<?php


class FMessaggio
{
    private static $table = "messaggio";

    private static $class = "FMessaggio";

    private static $values ="(:id, :mittente, :destinatario, :testo, :oggetto)";

    public function __construct()
    {
    }

    public static function bind($pdost, EMessaggio $m)
    {
        $pdost->bindValue(':id', null, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $m->getMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $m->getDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo', $m->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':oggetto', $m->getOggetto(), PDO::PARAM_STR);
    }

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
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
    public static function getValues(): string
    {
        return self::$values;
    }

    public function store(EMessaggio $m)
    {
        $db = FDataBase::getInstance();  /*se dovesse funzionare senza questa riga, dobbiamo eliminarla */
        $id =$db->storeP($m, self::getClass());
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

    public static function load($field, $id){
        $mezzo = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $messaggio=new EMessaggio($result['mittente'],$result['destinatario'],$result['testo'],$result['oggetto']);
            $messaggio->setId($result['id']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $messaggio=new EMessaggio($result['mittente'],$result['destinatario'],$result['testo'],$result['oggetto']);
                    $messaggio->setId($result['id']);

                }
            }
        }
        return $messaggio;
    }
}