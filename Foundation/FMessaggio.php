<?php


class FMessaggio
{
    private static $table = "messaggio";

    private static $class = "FMessaggio";

    private static $values ="(:id, :mittente, :destinatario, :testo, :oggetto)";

    public function __construct()
    {
    }

    public static function bind($pdost, EMessaggio $m)
    {
        $pdost->bindValue(':id', null, PDO::PARAM_INT);
        $pdost->bindValue(':mittente', $m->getMittente(), PDO::PARAM_STR);
        $pdost->bindValue(':destinatario', $m->getDestinatario(), PDO::PARAM_STR);
        $pdost->bindValue(':testo', $m->getTesto(), PDO::PARAM_STR);
        $pdost->bindValue(':oggetto', $m->getOggetto(), PDO::PARAM_STR);
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

    public function store(EMessaggio $m)
    {
        $db = FDatabase::getInstance();  /*se dovesse funzionare senza questa riga, dobbiamo eliminarla */
        $id =$db->storeP($m, self::getClass());
        if ($id)
            return $id;
        else
            return null;
    }

    public function exist ($field, $id)
    {
        $exist = false;
        $db = FDatabase::getInstance();
        $exist = $db->existP(static::getClass(), $field, $id);
        if($exist)
            return $exist = true;
        else
            return $exist = false;
    }

    public function delete($keyField,$id){
        $db = FDatabase::getInstance();
        $id = $db->deleteP(self::getClass(),$keyField,$id);
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
        $messaggio = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $messaggio=new EMessaggio($result['mittente'],$result['destinatario'],$result['oggetto'],$result['testo']);
            //$messaggio[$i]->setId($result['id']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $messaggio = array();
                for($i=0; $i<count($result); $i++){
                    $messaggio[]=new EMessaggio($result[$i]['mittente'],$result[$i]['destinatario'],$result[$i]['oggetto'],$result[$i]['testo']);
                   // $messaggio[$i]->setId($result['id']);

                }
            }
        }
        return $messaggio;
    }

    /**
     * Permette di ottenere tutti i messaggi in cui l'utente passato come parametro risulti mittente o destinatario
     * @param $id valore da ricercare nel campo $field
     * @param $field valore del campo della ricerca
     * @return object $mess l'oggetto messaggio se presente
     */
    public static function loadChats($email, $email2)
    {
        $messaggio1 = null;
        $messaggio2 = null;
        $db = FDatabase::getInstance();
        list ($result1, $result2, $rows_number1, $rows_number2)=$db->loadChats($email, $email2);

        if(($result1 != null) && ($rows_number1 == 1))
        {
            $messaggio1=new EMessaggio($result1['mittente'],$result1['destinatario'],$result1['oggetto'],$result1['testo']);
            $messaggio1->setId($result1['id']);
        }
        else
            {
            if(($result1 != null) && ($rows_number1 > 1))
            {
                $messaggio1 = array();
                for($i = 0; $i < count($result1); $i++)
                {
                    $messaggio1[]=new EMessaggio($result1[$i]['mittente'],$result1[$i]['destinatario'],$result1[$i]['oggetto'],$result1[$i]['testo']);
                    $messaggio1[$i]->setId($result1[$i]['id']);
                }
            }
        }
        if(($result2 != null) && ($rows_number2 == 1))
        {
            $messaggio2=new EMessaggio($result2['mittente'],$result2['destinatario'],$result2['oggetto'],$result2['testo']);
            $messaggio2->setId($result2['id']);
        }
        else
        {
            if(($result2 != null) && ($rows_number2 > 1))
            {
                $messaggio2 = array();
                for($i = 0; $i < count($result2); $i++)
                {
                    $messaggio2[]=new EMessaggio($result2[$i]['mittente'],$result2[$i]['destinatario'],$result2[$i]['oggetto'],$result2[$i]['testo']);
                    $messaggio2[$i]->setId($result2[$i]['id']);
                }
            }
        }
        echo "primo array:";
        var_dump($messaggio1);
        echo "<hr>";
        echo "secondo array:";
        var_dump($messaggio2);
        echo "<hr>";
        return array($messaggio1, $messaggio2);
    }

}