<?php


class FPrivato
{
    private static $table = "privato";
    private static $values = "(:email_privato,:nome,:cognome)";
    private static $class = "FPrivato";

    function __construct() {}

    public static function bind($pdost, EPrivato $privato)
    {
        $pdost->bindValue(':email_privato', $privato->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':nome', $privato->getNome(), PDO::PARAM_STR);
        $pdost->bindValue(':cognome', $privato->getCognome(), PDO::PARAM_STR);
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

    /**
     * @return string
     */
    public static function getClass(): string
    {
        return self::$class;
    }

    public static function store(Eprivato $p)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP("FUtente_loggato","email",$p->getEmail());
        // $control=$db->static::exist("email",$u->getEmail());
        if($exist==TRUE)
            return "Utente ".$p->getEmail()." già esistente nel Database";
        else {
            $db->storeP($p,"FUtente_loggato");
            $db->storeP($p, static::getClass());
            return "operazione a buon fine: " . $p->getEmail() . " salvato ";
        }
    }


    public static function update($field, $newvalue, $keyField, $id)
    {
        $db=FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if($result) return true;
        else return false;
    }

    public static function exist($keyField,$id)
    {
        $db=FDatabase::getInstance();
        $exist=$db->existP(self::getClass(),$keyField,$id);
        if($exist!=NULL)
            return true;
        else
            return false;
    }

    public static function load($field,$id){
        $privato=NULL;
        $db=FDatabase::getInstance();
        $resultLoadDB=$db->loadP(static::getClass(),$field,$id);
        $rows_number=$db->countLoadP(static::getClass(),$field,$id);
        if (($resultLoadDB!=null) && ($rows_number == 1)) {
            $utenteloggato = FUtente_loggato::load("email", $resultLoadDB["email_privato"]);
            $privato = new EPrivato($utenteloggato->getUsername(), $utenteloggato->getEmail(), $utenteloggato->getPassword(), $utenteloggato->getPhone(),$resultLoadDB["nome"],$resultLoadDB["cognome"]);
            $privato->setState($utenteloggato->isState());
        } else {
            if (($resultLoadDB != null) && ($rows_number > 1)) {
                $privato = array();
                $utenteloggato=array();
                for ($i = 0; $i < count($resultLoadDB); $i++) {
                    $utenteloggato[] = FUtente_loggato::load("email", $resultLoadDB[$i]["email_privato"]);
                    $privato[] = new EPrivato($utenteloggato[$i]->getUsername(), $utenteloggato[$i]->getEmail(), $utenteloggato[$i]->getPassword(), $utenteloggato[$i]->getPhone(),$resultLoadDB[$i]["nome"],$resultLoadDB[$i]["cognome"]);
                    $privato[$i]->setState($utenteloggato[$i]->isState());
                }
            }
        }
        return $privato;
    }


}