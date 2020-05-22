<?php

class FRecensione
{
  private static $table = "recensione";
  private static $values= "(:id,:mittente,:destinatario,:testo_recensione,:voto)"; //mettere ban
  private static $class= "FRecensione";
  //METTERE COSTRUTTORE?
    function __construct()
    {
    }

    public static function bind($pdost,ERecensione $r)
    {
        $pdost->bindValue(':id', NULL, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $r->getUsernameMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $r->getUsernameDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo_recensione', $r->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':voto', $r->getUsernameMittente(), PDO::PARAM_INT);
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

    public static function storeRecensione(ERecensione $r)
    {
        $db=FDataBase::getInstance();
        $id=$db->store($r , self::getClass());    //usare static al posto di self?
        if($id)
            return $id;
        else
            return NULL;
    }

    public static function existRecensione($field,$id){
        $db=FDataBase::getInstance();
        $exist=$db->exists(self::getClass(),$field,$id);
        if($exist!=NULL)
            $exist=true;
        else
            $exist=false;
    }

}