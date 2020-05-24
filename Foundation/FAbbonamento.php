<?php


class FAbbonamento
{
    private static $table="abbonamento";
    private static $values="(:id,:scadenza,:stato)";
    private static $class="FAbbonamento";

    public function __construct()
    {
    }

    public static function bind($pdost, EAbbonamento $a)
    {
        $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
        $pdost->bindValue(':scadenza', $a->getData(), PDO::PARAM_STR);
        $pdost->bindValue(':stato', $a->getStato(), PDO::PARAM_STR);
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
    /**
     * @return string
     */
    public static function getTable()
    {
        return self::$table;
    }

    public static function store(EAbbonamento $a){
        $db = FDataBase::getInstance();
        $id=$db->storeP($a,self::getClass());
        if ($id)
            return $id;
        else
            return NULL;
    }

    public function delete($keyField,$id){
        $db = FDataBase::getInstance();
        $execute=$db->deleteP(self::getClass(),$keyField,$id);
        if($execute)
            return true;
        else
            return false;
    }


    public static function exist($keyField, $id){
        $db=FDatabase::getInstance();
        $exist=$db->existP(self::getClass(), $keyField, $id);
        if($exist!= null)
            return true;
        else
            return false;
    }


}