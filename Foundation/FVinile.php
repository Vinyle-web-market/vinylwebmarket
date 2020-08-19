<?php


class FVinile
{
    private static $table = "vinile";
    private static $values = "(:id_vinile, :venditore, :titolo, :artista, :genere, :ngiri, :condizione, :prezzo, :descrizione, :quantita, :visibility)";
    private static $class = "FVinile";

    public function __construct()
    {
    }

    public static function bind($pdost, EVinile $vinile)
    {

        $pdost->bindValue(':id_vinile', NULL, PDO::PARAM_INT);
        $pdost->bindValue(':venditore', $vinile->getVenditore()->getEmail(), PDO::PARAM_STR);
        $pdost->bindValue(':titolo', $vinile->getTitolo(), PDO::PARAM_STR);
        $pdost->bindValue(':artista', $vinile->getArtista(), PDO::PARAM_STR);
        $pdost->bindValue(':genere', $vinile->getGenere(), PDO::PARAM_STR);
        $pdost->bindValue(':ngiri', $vinile->getNgiri(), PDO::PARAM_INT);
        $pdost->bindValue(':condizione', $vinile->getCondizione(), PDO::PARAM_STR);
        $pdost->bindValue(':prezzo', $vinile->getPrezzo(), PDO::PARAM_STR);
        $pdost->bindValue(':descrizione', $vinile->getDescrizione(), PDO::PARAM_STR);
        $pdost->bindValue(':quantita', $vinile->getQuantita(), PDO::PARAM_INT);
        $pdost->bindValue(':visibility',$vinile->isVisibility(), PDO::PARAM_BOOL);
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
        $db = FDatabase::getInstance();
        $exist = FUtente_loggato::exist("email", $vinile->getVenditore()->getEmail());
        if ($exist == TRUE) {
            $id=$db->storeP($vinile, static::getClass());
        } else {
            return null;
        }
        return $id;
    }


    public static function delete($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $id = $db->deleteP(self::getClass(), $keyField, $id);
        if ($id)
            return $id;
        else
            return NULL;
    }

    public static function exist($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(), $keyField, $id);
        if ($exist != NULL)
            return true;
        else
            return false;
    }

    /*
    public static function load($field, $id)
    {
        $mezzo = null;
        $db=FDatabase::getInstance();
        $result=$db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if(($result!=null) && ($rows_number == 1)) {
            $vinile = new EVinile($result['venditore'],$result['titolo'],$result['artista'],$result['genere'],$result['ngiri'],
                                  $result['condizione'],$result['prezzo'],$result['descrizione'],$result['quantità']);
            $vinile->setId($result['id']);
        }
        else {
            if(($result!=null) && ($rows_number > 1)){
                $mezzo = array();
                for($i=0; $i<count($result); $i++){
                    $vinile = new EVinile($result['venditore'],$result['titolo'],$result['artista'],$result['genere'],$result['ngiri'],
                                          $result['condizione'],$result['prezzo'],$result['descrizione'],$result['quantità']);
                    $vinile->setId($result['id']);

                }
            }
        }
        return $vinile;
    }
   */

    public static function load($field, $id)
    {
        $utenteloggato= null;
        $vinile = null;
        $db = FDatabase::getInstance();
        $resultLoadDB = $db->loadP(static::getClass(), $field, $id);
        $rows_number = $db->countLoadP(static::getClass(), $field, $id);
        if (($resultLoadDB != null) && ($rows_number == 1)) {
            $utenteloggato = FUtente_loggato::load("email", $resultLoadDB["venditore"]);
            //function __construct(EUtente_Loggato $vend, $tit,$art, $gen, $ng, $cond, $pr, $des, $quan)
            $vinile = new EVinile($utenteloggato, $resultLoadDB["titolo"], $resultLoadDB["artista"], $resultLoadDB["genere"], $resultLoadDB["ngiri"], $resultLoadDB["condizione"], $resultLoadDB["prezzo"], $resultLoadDB["descrizione"], $resultLoadDB["quantita"],);
            $vinile->setId($resultLoadDB['id_vinile']);
            $vinile->setVisibility($resultLoadDB['visibility']);  //vedere se ci andrà messa
        } else {
            if (($resultLoadDB != null) && ($rows_number > 1)) {
                $vinile = array();
                $utenteloggato = array();
                for ($i = 0; $i < count($resultLoadDB); $i++) {
                    $utenteloggato[] = FUtente_loggato::load("email", $resultLoadDB[$i]["venditore"]);
                    $vinile[$i] = new EVinile($utenteloggato[$i], $resultLoadDB[$i]["titolo"], $resultLoadDB[$i]["artista"], $resultLoadDB[$i]["genere"], $resultLoadDB[$i]["ngiri"], $resultLoadDB[$i]["condizione"], $resultLoadDB[$i]["prezzo"], $resultLoadDB[$i]["descrizione"], $resultLoadDB[$i]["quantita"],);
                    $vinile[$i]->setId($resultLoadDB[$i]['id_vinile']);
                    $vinile[$i]->setVisibility($resultLoadDB[$i]['visibility']); //vedere se ci andrà messa
                }
            }
        }
        return $vinile;
    }


    public static function update($field, $newvalue, $keyField, $id)
    {
        $db = FDatabase::getInstance();
        $result = $db->updateP(static::getClass(), $field, $newvalue, $keyField, $id);
        if ($result) return true;
        else return false;
    }

    //loadByform di claudia
    public static function searchVinyl($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo)
    {
        $vinile = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->searchVinile($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo);
        var_dump($result);
        echo "<br>".$rows_number;
        if (($result != null) && ($rows_number == 1)) {
            $utente_loggato = FUtente_loggato::load("email", $result["venditore"]);
            $vinile = new EVinile($utente_loggato, $result["titolo"], $result["artista"], $result["genere"], $result["ngiri"], $result["condizione"], $result["prezzo"], $result["descrizione"], $result["quantita"],); //forse bisogna togliere le quadre
            $vinile->setId($result['id_vinile']);
            $vinile->setVisibility($result['visibility']);
        } else {
            if (($result != null) && ($rows_number > 1)) {
                $vinile[] = array();
                for ($i = 0; $i < count($result); $i++) {
                    $utente_loggato[] = FUtente_loggato::load("email", $result[$i]["venditore"]);
                    $vinile[$i] = new EVinile($utente_loggato[$i], $result[$i]["titolo"], $result[$i]["artista"], $result[$i]["genere"], $result[$i]["ngiri"], $result[$i]["condizione"], $result[$i]["prezzo"], $result[$i]["descrizione"], $result[$i]["quantita"],);
                    $vinile[$i]->setId($result[$i]['id_vinile']);
                    $vinile[$i]->setVisibility($result[$i]['visibility']); //vedere se ci andrà messa
                }
            }
        }
        return $vinile;
     }

     public static function loadSixVinyls()
     {
         $vinile = null;
         $load=null;
         $img=null;
         $db = FDatabase::getInstance();
         $vinile= $db->prendiVinile();
         rsort($vinile);
         if(count($vinile)<6)
             $n=count($vinile);
         else
             $n=6;
         for ($i=0; $i<$n; $i++)
         {
                 //ublic static function loadI(string $categoriaImage,$field,$id){
             // echo '<br>';
                 $img[$i] = FImage::loadI1("EImageVinile", "id_vinile", $vinile[$i]);
                 $result[$i] = $vinile[$i];
                 $load[$i] = FVinile::load('id_vinile', $result[$i]);
            //var_dump($load[$i]);
            // echo '<br>';
            // var_dump($img[$i]);
             //echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';echo '<br>';

         }
         return array($load,$img);
    }

    /**
     * @param $parola valore da ricercare all'interno del campo di testo del vinile
     * @param $campo restituisce il campo interessati da tale ricerca associati alla parola in input
     * @param $class classe a cui si vuole far riferimento
     */
     //ricerca titolo
    public static function ricercaParola($parola)
    {
        $vinile = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->ricercaP('titolo',static::getClass(),$parola);

        if (($result != null) && ($rows_number == 1))
        {
            $utente_loggato = FUtente_loggato::load("email", $result["venditore"]);
            $vinile[] = new EVinile($utente_loggato, $result["titolo"], $result["artista"], $result["genere"], $result["ngiri"], $result["condizione"], $result["prezzo"], $result["descrizione"], $result["quantita"]);
            $vinile->setId($result['id_vinile']);
            $vinile->setVisibility($result['visibility']);  //vedere se ci andrà messa
        }
        else
            {
            if (($result != null) && ($rows_number > 1))
            {
                $vinile[] = array();
                for ($i = 0; $i < count($result); $i++)
                {
                    $utente_loggato[] = FUtente_loggato::load("email", $result[$i]["venditore"]);
                    $vinile[$i] = new EVinile($utente_loggato[$i], $result[$i]["titolo"], $result[$i]["artista"], $result[$i]["genere"], $result[$i]["ngiri"], $result[$i]["condizione"], $result[$i]["prezzo"], $result[$i]["descrizione"], $result[$i]["quantita"]);
                    $vinile[$i]->setId($result[$i]['id_vinile']);
                    $vinile[$i]->setVisibility($result[$i]['visibility']); //vedere se ci andrà messa
                }
            }
        }
        return $vinile;
    }

    public static function ricercaParolaCampo($parola,$field)
    {
        $vinile = null;
        $db = FDatabase::getInstance();
        list ($result, $rows_number) = $db->ricercaP($field,static::getClass(),$parola);

        if (($result != null) && ($rows_number == 1))
        {
            $utente_loggato = FUtente_loggato::load("email", $result["venditore"]);
            $vinile[] = new EVinile($utente_loggato, $result["titolo"], $result["artista"], $result["genere"], $result["ngiri"], $result["condizione"], $result["prezzo"], $result["descrizione"], $result["quantita"]);
            $vinile->setId($result['id_vinile']);
            $vinile->setVisibility($result['visibility']);  //vedere se ci andrà messa
        }
        else
        {
            if (($result != null) && ($rows_number > 1))
            {
                $vinile[] = array();
                for ($i = 0; $i < count($result); $i++)
                {
                    $utente_loggato[] = FUtente_loggato::load("email", $result[$i]["venditore"]);
                    $vinile[$i] = new EVinile($utente_loggato[$i], $result[$i]["titolo"], $result[$i]["artista"], $result[$i]["genere"], $result[$i]["ngiri"], $result[$i]["condizione"], $result[$i]["prezzo"], $result[$i]["descrizione"], $result[$i]["quantita"]);
                    $vinile[$i]->setId($result[$i]['id_vinile']);
                    $vinile[$i]->setVisibility($result[$i]['visibility']); //vedere se ci andrà messa
                }
            }
        }
        return $vinile;
    }


}

