<?php


class FCarta
{
    private static $table="carta";
    private static $values="(:id, :intestatario, :numero, :scadenza, :cvv)";
    private static $class="FCarta";

    public static function bind($pdost, ECarta $c)
    {
       $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
       $pdost->bindValue(':intestatrio', $c->getIntestat(), PDO::PARAM_STR);
       $pdost->bindValue(':numero', $c->getNum(), PDO::PARAM_STR);
       $pdost->bindValue(':scadenza', $c->getScad(), PDO::PARAM_STR);
       $pdost->bindValue(':cvv', $c->getCodcvv(), PDO::PARAM_STR);
    }

    /**
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getClass()
    {
        return self::$class;
    }

    /**
     * @return string
     */
    public static function getValues()
    {
        return self::$values;
    }

    public static function storeCarta(ECarta $c){
        $db = FDataBase::getInstance();
       $id=$db->store(self::getClass(), $c);
       if ($id)
           return $id;
       else
           return NULL;
    }

    public static function existCarta($field,$id)
    {
        $db=FDataBase::getInstance();
        $exist=$db->exists(self::getClass(),$field,$id);
        if($exist!=NULL)
            $exist=true;
        else
            $exist=false;
    }
}