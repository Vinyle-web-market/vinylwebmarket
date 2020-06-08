<?php

class FAbbonamento
{
    private static $table = "abbonamento";
    private static $values = "(:id,:scadenza,:stato)";
    private static $class = "FAbbonamento";

    public function __construct()
    {
    }

    public static function bind($pdost, EAbbonamento $a)
    {
        $pdost->bindValue(':id', NULL, PDO::PARAM_INT);
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

    //OPERAZIONI CRUD
    public static function store(EAbbonamento $a)
    {
        $db = FDataBase::getInstance();
        $id = $db->storeP($a, self::getClass());
        if ($id)
            return $id;
        else
            return NULL;
    }

    public static function delete($keyField, $id)
    {
        $db = FDataBase::getInstance();
        $execute = $db->deleteP(self::getClass(), $keyField, $id);
        if ($execute)
            return true;
        else
            return false;
    }


    public static function exist($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(), $keyField, $id);
        if ($exist != null)
            return true;
        else
            return false;
    }

    public static function update($field, $newvalue, $keyField, $id)
    {
        $result = false;
        $db = FDataBase::getInstance();
        $result = $db->updateP(self::getClass(), $field, $newvalue, $keyField, $id);
        if($result)
            return $result;
        else
            return $result = false;
    }

    public static function load($field, $id){
        $mezzo = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $abbonamento=new EAbbonamento();
            $abbonamento->setId($result['id']);
            $abbonamento->setData($result['scadenza']);
            $abbonamento->setStato($result['stato']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
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