<?php


class FMessaggio
{
    private static $table = "messaggio";

    private static $class = "FMessaggio";

    private static $values = (":id, :mittente, :destinatario, :testo, :oggetto");

    public function __construct()
    {
    }

    public static function bind($pdost, EMessaggio $messaggio)
    {
        $pdost->bindValue(':id', null, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $messaggio->getMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $messaggio->getDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo', $messaggio->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':oggetto', $messaggio->getOggetto(), PDO::PARAM_STR);
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

    public function store ($messaggio)
    {
        $db = FDataBase::getInstance();  /*se dovesse funzionare senza questa riga, dobbiamo eliminarla */
        $id =$db->store(static::getClass(), $messaggio);
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
}