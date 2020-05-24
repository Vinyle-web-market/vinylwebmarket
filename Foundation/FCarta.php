<?php



class FCarta
{
    private static $table="carta";
    private static $values="(:id, :intestatario, :numero, :scadenza, :cvv)";
    private static $class="FCarta";

    public function __construct()
    {
    }

    public static function bind($pdost, ECarta $c)
    {
       $pdost->bindValue(':id',NULL, PDO::PARAM_INT);
       $pdost->bindValue(':intestatario', $c->getIntestat(), PDO::PARAM_STR);
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
    //OPERAZIONI CRUD
    public static function store(ECarta $c){
        $db = FDataBase::getInstance();
       $id=$db->storeP($c,self::getClass());
       if ($id)
           return $id;
       else
           return NULL;
    }

    public static function delete($keyField,$id){
        $db = FDataBase::getInstance();
        $id=$db->deleteP(self::getClass(),$keyField,$id);
        if ($id)
            return $id;
        else
            return NULL;
    }

    public static function exist($keyField,$id)
    {
        $db=FDataBase::getInstance();
        $exist=$db->existP(self::getClass(),$keyField,$id);
        if($exist!=NULL)
            return true;
        else
            return false;
    }

    public static function update($field, $newvalue, $keyField, $id)
    {
        $db=FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if($result) return true;
        else return false;
    }

    /*public static function load($field, $id)
    {
        $cli = null;
        $tra = null;
        $db = FDatabase::getInstance();
        $result = $db->load(static::getClass(), $field, $id);
        $rows_number = $db->interestedRows(static::getClass(), $field, $id);
        if (($result != null) && ($rows_number == 1)) {
            $ute = FUtenteloggato::loadByField("email", $result["emailUtente"]);
            $cli = new ECliente($ute->getName(), $ute->getSurname(), $ute->getEmail(), $ute->getPassword(),$ute->getState());
        } else {
            if (($result != null) && ($rows_number > 1)) {
                $tra = array();
                for ($i = 0; $i < count($result); $i++) {
                    $ute[] = FUtenteloggato::loadByField("email", $result[$i]["emailUtente"]);
                    $cli[] = new ECliente($ute[$i]->getName(), $ute[$i]->getSurname(), $ute[$i]->getEmail(), $ute[$i]->getPassword(),$ute->getState());
                }
            }
        }
        return $cli;
    }*/
}