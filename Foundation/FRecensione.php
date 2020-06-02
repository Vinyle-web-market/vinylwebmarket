<?php

class FRecensione
{
  private static $table = "recensione";
  private static $values= "(:id,:mittente,:destinatario,:testo_recensione,:voto, :ban)"; //mettere ban
  private static $class= "FRecensione";
  //METTERE COSTRUTTORE?
    function __construct()
    {
    }
  ///
    public static function bind($pdost,ERecensione $r)
    {
        $pdost->bindValue(':id', NULL, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $r->getUsernameMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $r->getUsernameDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo_recensione', $r->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':voto', $r->getVotostelle(), PDO::PARAM_INT);
        $pdost->bindValue(':ban', $r->isBan(), PDO::PARAM_BOOL);
    }
        //int o float?


    /**
     * @return string
     */
    public static function getTable(){
        return self::$table;
    }

    /**
     * @return string
     */
    public static function getValues(){
        return self::$values;
    }

    /**
     * @return string
     */
    public static function getClass(){
        return self::$class;
    }

    public static function store (ERecensione $r)
    {
        $db=FDataBase::getInstance();
        $id=$db->storeP($r, self::getClass());
        if($id)
            return $id;
        else
            return NULL;
    }

    public function exist ($field, $id)
    {
        $exist = false;
        $db = FDataBase::getInstance();
        $exist = $db->existP(static::getClass(), $field, $id);
        if($exist)
            return $exist = true;
        else
            return $exist = false;
    }

    public static function delete($keyField,$id){
        $db = FDataBase::getInstance();
        $id=$db->deleteP(self::getClass(),$keyField,$id);
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
            $recensione=new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $recensione->setId($result['id']);
            $recensione->setBan($result['ban']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $recensione=new ERecensione($result['mittente'],$result['destinatario'],$result['testo_recensione'],$result['voto'],$result['ban']);
                    $recensione->setId($result['id']);
                    $recensione->setBan($result['ban']);
                }
            }
        }
        return $recensione;
    }
}