<?php


class FVinile
{
    private static $table = "vinile";
    private static $values = "(:id_vinile, :venditore, :titolo, :artista, :genere, :ngiri, :condizione, :prezzo, :descrizione, :quantita)";
    private static $class = "FVinile";

    public function __construct(){}

    public static function bind($pdost, Evinile $vinile)
    {

        $pdost->bindValue(':id_vinile',NULL, PDO::PARAM_INT);
        $pdost->bindValue(':venditore', $vinile->getVenditore()->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':titolo', $vinile->getTitolo(), PDO::PARAM_STR);
        $pdost->bindValue(':artista', $vinile->getArtista(), PDO::PARAM_STR);
        $pdost->bindValue(':genere', $vinile->getGenere(), PDO::PARAM_STR);
        $pdost->bindValue(':ngiri', $vinile->getNgiri(), PDO::PARAM_INT);
        $pdost->bindValue(':condizione', $vinile->getCondizione(), PDO::PARAM_STR);
        $pdost->bindValue(':prezzo', $vinile->getPrezzo(), PDO::PARAM_STR);
        $pdost->bindValue(':descrizione', $vinile->getDescrizione(), PDO::PARAM_STR);
        $pdost->bindValue(':quantita', $vinile->getQuantita(), PDO::PARAM_INT);
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

    public static function store(EVinile $vinile)
    {
        $db = FDataBase::getInstance();
        $exist = FUtente_loggato::exist("email",$vinile->getVenditore()->getEmail());
        if($exist==TRUE){

              $db->storeP($vinile, static::getClass());
              return "operazione riuscita";
                        }
        else {
            $str="operazione non riuscita";
            return $str;
             }
    }


    public static function delete($keyField, $id)
    {
        $db = FDataBase::getInstance();
        $id = $db->deleteP(self::getClass(),$keyField,$id);
        if ($id)
            return $id;
        else
            return NULL;
    }

    public static function exist($keyField,$id)
    {
        $db = FDataBase::getInstance();
        $exist = $db->existP(self::getClass(), $keyField, $id);
        if($exist!=NULL)
            return true;
        else
            return false;
    }

    public static function load($field, $id)
    {
        $mezzo = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $vinile = new Evinile($result['venditore'],$result['titolo'],$result['artista'],$result['genere'],$result['ngiri'],
                                  $result['condizione'],$result['prezzo'],$result['descrizione'],$result['quantità']);
            $vinile->setId($result['id']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $vinile = new Evinile($result['venditore'],$result['titolo'],$result['artista'],$result['genere'],$result['ngiri'],
                                          $result['condizione'],$result['prezzo'],$result['descrizione'],$result['quantità']);
                    $vinile->setId($result['id']);

                }
            }
        }
        return $vinile;
    }


    public static function update($field, $newvalue, $keyField, $id)
    {
        $db=FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if($result) return true;
        else return false;
    }
}