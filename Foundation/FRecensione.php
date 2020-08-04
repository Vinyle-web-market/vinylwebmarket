<?php

class FRecensione
{
  private static $table = "recensione";
  private static $values= "(:id,:mittente,:destinatario,:testo_recensione,:voto, :ban)"; //mettere ban
  private static $class= "FRecensione";
  //METTERE COSTRUTTORE?
    function __construct(){}
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
        $db=FDatabase::getInstance();
        $id=$db->storeP($r, self::getClass());
        if($id)
            return $id;
        else
            return NULL;
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

    public static function delete($keyField,$id){
        $db = FDatabase::getInstance();
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
        $recensione = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $recensione=new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
           // $recensione->setId($result['id']);
            $recensione->setBan($result['ban']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $recensione=array();
                for($i=0; $i<count($result); $i++){
                    $recensione[]=new ERecensione($result[$i]['voto'],$result[$i]['testo_recensione'],$result[$i]['mittente'],$result[$i]['destinatario']);
                   // $recensione[]->setId($result[$i]['id']);
                    $recensione[$i]->setBan($result[$i]['ban']);
                }
            }
        }
        return $recensione;
    }

    public static function adminAllReviews() {
        $review = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number)=$db->adminGetRev();
        if(($result != null) && ($rows_number == 1)) {
            $review = new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $review->setId($result['id']);
        }
        else {
            if(($result != null) && ($rows_number > 1)){
                $review = array();
                for($i = 0; $i < count($result); $i++){
                    $review[] = new ERecensione($result[$i]['voto'], $result[$i]['testo_recensione'],$result[$i]['mittente'], $result[$i]['destinatario']);
                    $review[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $review;
    }

    /**
     * @param $parola valore da ricercare all'interno del campo di testo della recensione
     */

    public static function ricercaParola($parola)
    {
        $rec = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->ricercaP('testo_recensione',static::getClass(),$parola);

        if(($result != null) && ($rows_number == 1))
        {
            $rec = new ERecensione($result['voto'],$result['testo_recensione'],$result['mittente'],$result['destinatario']);
            $rec->setId($result['id']);
        }
        else
            {
            if(($result != null) && ($rows_number > 1))
            {
                $rec = array();
                for($i = 0; $i < count($result); $i++)
                {
                    $rec[] = new ERecensione($result[$i]['voto'], $result[$i]['testo_recensione'],$result[$i]['mittente'], $result[$i]['destinatario']);
                    $rec[$i]->setId($result[$i]['id']);
                }
            }
        }
        return $rec;
    }

  }