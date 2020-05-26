<?php


class FUtente_loggato
{
    private static $table = "utente_loggato";

    private static $values = "(:username, :email, :password, :telefono, :stato, :data_registrazione); ";

    private static $class = "FUtente_loggato";

    function __construct() {}

   public static function bind($pdost, EUtente_loggato $utente)
   {
       $pdost->bindValue(':username', $utente->getUsername(), PDO::PARAM_STR);
       $pdost->bindValue(':email', $utente->getEmail(), PDO::PARAM_STR);
       $pdost->bindValue(':password', $utente->getPassword(), PDO::PARAM_STR);
       $pdost->bindValue(':telefono', $utente->getPhone(), PDO::PARAM_STR);
       $pdost->bindValue(':stato', $utente->isState(), PDO::PARAM_BOOL);
       $pdost->bindValue(':data_registrazione', $utente->getRegistrationDate(), PDO::PARAM_INPUT_OUTPUT);
       /*$pdost->bindValue(':media_recensioni', $utente->getRecensioni(), PDO::PARAM_INPUT_OUTPUT);*/
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

    /**
     * @return string
     */
    public static function getValues(): string
    {
        return self::$values;
    }

    //OPERAZIONI CRUD

    public static function store(EUtente_Loggato $utente)
    {
        $db = FDataBase::getInstance();
        $id = $db->storeP($utente, self::getClass());
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
        $utente = null;
        $db = FDatabase::getInstance();
        $result = $db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $utente = new EUtente_Loggato($result['username'], $result['password'], $result['telefono'], $result['stato'],
                                          $result['data_registrazione'], $result['media_recensioni']);
            $utente->setEmail($result['email']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $utente []= new EUtente_Loggato($result[$i]['username'],$result[$i]['password'],$result[$i]['telefono'],
                                                  $result[$i]['stato'],$result[$i]['data_registrazione'],$result[$i]['media_recensioni']);  //ARRAY DI ARRAY ATTENTO
                    $utente[$i]->setEmail($result['email']);

                }
            }
        }
        return $utente;
    }
}