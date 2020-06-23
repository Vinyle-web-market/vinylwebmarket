<?php


class FUtente_loggato
{
    private static $table = "utente_loggato";

    private static $values = "(:username,:email,:password,:telefono,:stato)";

    private static $class = "FUtente_loggato";

    function __construct() {}

   public static function bind($pdost, EUtente_loggato $utente)
   {
       $pdost->bindValue(':username', $utente->getUsername(), PDO::PARAM_STR);
       $pdost->bindValue(':email', $utente->getEmail(), PDO::PARAM_STR);
       $pdost->bindValue(':password', $utente->getPassword(), PDO::PARAM_STR);
       $pdost->bindValue(':telefono', $utente->getPhone(), PDO::PARAM_STR);
       $pdost->bindValue(':stato', $utente->isState(), PDO::PARAM_BOOL);
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

    public static function store(EUtente_loggato $u)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(),"email",$u->getEmail());
        if($exist==TRUE)
           return "Utente ".$u->getEmail()." già esistente nel Database";
        else {
            $db->storeP($u, static::getClass());
            return "operazione a buon fine: " . $u->getEmail() . " salvato nella tablle utente_loggato ";
             }
    }

    public static function delete($keyField, $id)
    {
        $db = FDatabase::getInstance();
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
        $db = FDatabase::getInstance();
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
            $utente = new EUtente_loggato($result['username'], $result['password'], $result['telefono'], $result['stato']);
            $utente->setEmail($result['email']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $utente []= new EUtente_loggato($result[$i]['username'],$result[$i]['password'],$result[$i]['telefono'], $result[$i]['stato']);  //ARRAY DI ARRAY ATTENTO
                    $utente[$i]->setEmail($result[$i]['email']);

                }
            }
        }
        return $utente;
    }

    public static function login($email, $pass){
        $db=FDatabase::getInstance();
        $r=$db->loginP($email, $pass);
        if ($r!=null)
            echo "accesso eseguito";
        else echo "accesso non eseguito";
    }
}