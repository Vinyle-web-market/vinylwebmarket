<?php

class FDatabase
{
    //approccio statico,una sola istanza
    private static $instance;
    private $db;
    private $dsn = 'mysql:host=localhost;dbname=vinylwebmarket';
    private $username = 'root';
    private $password = 'pippo';
    private $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );


    private function __construct()
    {
        try {
            $this->db = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            die;
        }
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new FDatabase();
        }
        return self::$instance;
    }

    public function dbCloseConnection()
    {
        static::$instance = NULL;     //IN CASO USARE STATIC::
    }

    //OPERAZIONI CRUD
    public function storeP($object, $Fclass)
    {
        try {
            $this->db->begintransaction();
            $sql = " INSERT INTO " . $Fclass::getTable() . " VALUES " . $Fclass::getValues();
            $pdost = $this->db->prepare($sql);
            $Fclass::bind($pdost, $object);
            $pdost->execute();
            $id = $this->db->lastInsertId();
            $this->db->commit();
            $this->dbCloseConnection();
            return $id;
        } catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $this->db->rollBack();
            return null;
        }
    }



    //keyField è chiave primaria della classe
    public function existP($Fclass, $keyField, $id)
    {
        try {
            $sql = " SELECT * FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "'";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $array = $pdost->fetchAll(PDO::FETCH_ASSOC);
            if (count($array) == 1) return $array[0];
            if (count($array) > 1) return $array;     //fare test
            $this->dbCloseConnection();

        } catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }

//field chiave primaria della classe a cui fa riferimentO
    public function deleteP($Fclass, $keyField, $id)
    {
        try {
            $eliminato = NULL;
            $this->db->beginTransaction();
            $presente = $this->existP($Fclass, $keyField, $id);
            if ($presente) {
                $sql = "DELETE FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "'";
                $pdost = $this->db->prepare($sql);
                $pdost->execute();
                $this->db->commit();
                $eliminato = TRUE;
            }
        } catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $eliminato = FALSE;
        }
        return $eliminato;
    }


    public function updateP($Fclass, $field, $newvalue, $keyField, $id)
    {
        try {
            $this->db->beginTransaction();
            $query = "UPDATE " . $Fclass::getTable() . " SET " . $field . "='" . $newvalue . "' WHERE " . $keyField . "='" . $id . "';";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $this->db->commit();
            $this->dbCloseConnection();
            return true;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    //caricamento attraverso il campo chiave
    public function loadP($Fclass,$keyField,$id){
        try{
            $sql="SELECT * FROM ".$Fclass::getTable()." WHERE ".$keyField."='".$id."';";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result[] = $e;
                }
            return $result;

           }
             catch (PDOException $err) {
             echo "ATTENZIONE ERRORE: " . $err->getMessage();
              return null;
            }
    }
         //interestedrows claudia
        public function countLoadP ($Fclass, $keyField, $id)
        {
            try {
                $this->db->beginTransaction();
                $query = "SELECT * FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "';";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                $this->dbCloseConnection();
                return $num;
            } catch (PDOException $e) {
                echo "Attenzione errore: " . $e->getMessage();
                $this->db->rollBack();
                return null;
            }
        }

    /**
     * Funzione che permette di salvare nel Database una immagine. Ritorna l'id dell'oggetto inserito oppure una schermata di errore.
     * @param $class
     * @param $filename
     * @param EImage $media
     * @return mixed
     */
    public function storeMedia($class, EImage $media) {
        try {
            $this->db->beginTransaction();
            $query = "INSERT INTO ".$class::getTable(get_class($media))." VALUES ".$class::getValues($media);
            $pdost = $this->db->prepare($query);
            $class::bind($pdost, $media);
            $pdost->execute();
            $id=$this->db->lastInsertId();
            $this->db->commit();

            return $id;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }
    //categoriaImmagine è EImageUtente o EImageVinile
    public function deleteMedia(string $categoriaImmagine, $keyField, $id)
    {
        try {
            $Fclass='FImage';
            $eliminato = NULL;
            $this->db->beginTransaction();
           // $presente = $this->existP($Fclass, $keyField, $id);
            //if ($presente) {
                $sql = "DELETE FROM " . $Fclass::getTable($categoriaImmagine) . " WHERE " . $keyField . "='" . $id . "'";
                $pdost = $this->db->prepare($sql);
                $pdost->execute();
                $this->db->commit();
                $eliminato = TRUE;
         //   }
        } catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $eliminato = FALSE;
        }
        return $eliminato;
    }

    public function loadMedia($categoriaImage,$keyField,$id){
        $Fclass='FImage';
        try{
            $sql="SELECT * FROM ".$Fclass::getTable($categoriaImage)." WHERE ".$keyField."='".$id."';";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result[] = $e;
            }
            return $result;

        }
        catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }
    //se sono due immagini vinili ne torna una sola
    /*
    public function loadMedia2($categoriaImage,$keyField,$id){
        $Fclass='FImage';
        try{
            $sql="SELECT * FROM ".$Fclass::getTable($categoriaImage)." WHERE ".$keyField."='".$id."';";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else {
                $result2 = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result2[] = $e;
                $result=$result2[0];
            }
            //var_dump($result);
            return $result;

        }
        catch (PDOException $err) {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }
    */

    public function countLoadMedia (string $categoriaImage, $keyField, $id)
    {
        $Fclass='FImage';
        try {
            $this->db->beginTransaction();
            $query = "SELECT * FROM " . $Fclass::getTable($categoriaImage) . " WHERE " . $keyField . "='" . $id . "';";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            $this->dbCloseConnection();
            return $num;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }



    public function searchVinile ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo)
    {
        try {
            $query = null;
            $class = "FVinile";
            $param = array($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo);
            for ($i = 0; $i < count($param); $i++) {
                if ($param[$i] != null) {
                    switch ($i) {
                        case 0:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE titolo ='" . $titolo . "'";
                            else
                                $query = $query . " AND titolo ='" . $titolo . "'";
                            break;
                        case 1:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE artista ='" . $artista . "'";
                            else
                                $query = $query . " AND artista ='" . $artista . "'";
                            break;
                        case 2:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE genere ='" . $genere . "'";
                            else
                                $query = $query . " AND genere ='" . $genere . "'";
                            break;
                        case 3:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE ngiri ='" . $ngiri . "'";
                            else
                                $query = $query . " AND ngiri ='" . $ngiri . "'";
                            break;
                        case 4:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE condizione ='" . $condizioni . "'";
                            else
                                $query = $query . " AND condizione ='" . $condizioni . "'";
                            break;
                        case 5:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE prezzo <='" . $prezzo . "'";
                            else
                                $query = $query . " AND prezzo ='" . $prezzo . "'";
                            break;
                    }
                }
            }
            $query = $query . ";";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;        //nessuna riga interessata. return null
            } elseif ($num == 1) {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            } else {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;                    //ritorna un array di righe.
            }
            //  $this->closeDbConnection();
            return array($result, $num);

        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }
    public function searchMessaggio ($mittente, $destinatario)
    {
        try {
            $query = null;
            $class = "FMessaggio";
            $param = array($mittente, $destinatario);
            for ($i = 0; $i < count($param); $i++) {
                if ($param[$i] != null) {
                    switch ($i) {
                        case 0:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE mittente ='" . $mittente . "'";
                            else
                                $query = $query . " AND mittente ='" . $mittente . "'";
                            break;
                        case 1:
                            if ($query == null)
                                $query = "SELECT * FROM " . $class::getTable() . " WHERE destinatario ='" . $destinatario . "'";
                            else
                                $query = $query . " AND destinatario ='" . $destinatario . "'";
                            break;
                    }
                }
            }
            $query = $query . ";";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;        //nessuna riga interessata. return null
            } elseif ($num == 1) {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            } else {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;                    //ritorna un array di righe.
            }
            //  $this->closeDbConnection();
            return array($result);

        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    public function loginP ($email, $pass)
    {
        try {
            $query = null;
            $class = "FUtente_loggato";
            $query = "SELECT * FROM " . $class::getTable() . " WHERE email ='" . $email . "' AND password ='" . $pass . "';";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0) {
                $result = null;        //nessuna riga interessata. return null
            } else {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            }
            return $result;
        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }
   
    //torna tutte le recensioni 
    public function adminGetRev ()
    {
        try
        {
            $query = "SELECT * FROM recensione;";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $rowsNumber = $pdost->rowCount();
            if ($rowsNumber == 0)
            {
                $result = null;
            }
            elseif ($rowsNumber == 1)
            {
                $result = $pdost->fetch(PDO::FETCH_ASSOC);
            }
            else
                {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $pdost->fetch())
                    $result[] = $row;
                }
            return array($result, $rowsNumber);
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    public function prendiVinile ()
    {
        try {
            $query = "SELECT * FROM vinile;";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $rowsNumber = $pdost->rowCount();
            if ($rowsNumber == 0) {
                $result = null;
            } elseif ($rowsNumber == 1) {
                $result = $pdost->fetch(PDO::FETCH_ASSOC);
                return $result['id_vinile'];
            } else {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $pdost->fetch())
                    $result[] = $row['id_vinile'];
                return $result;
            }

        } catch (PDOException $e) {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    //funzione che ci permette di effettuare la ricerca di parole. La utilizziamo per recensioni, utenti e vinili.
    public function ricercaP($campo,$class,$input)
    {
        try
        {
            $query = "SELECT * FROM " . $class::getTable() . " WHERE " . $campo . " LIKE '%" . $input . "%';";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $rowsNumber = $pdost->rowCount();

            if ($rowsNumber == 0)
            {
                $result = null;
            }
            elseif ($rowsNumber == 1)
            {
                $result = $pdost->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $pdost->fetch())
                    $result[] = $row;
            }
            return array($result, $rowsNumber);
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /** Metodo che carica la chat tra due utenti, identificati dal sistema con le proprie email
     *@param email ,email del primo utente
     *@param email2 ,email del secondo utente
     */

    public function loadChats ($email, $email2)
    {
        try
        {
            $query1 = "SELECT * FROM messaggio WHERE mittente ='" . $email . "' AND destinatario ='" . $email2 . "';";
            $query2 = "SELECT * FROM messaggio WHERE mittente ='" . $email2 . "' AND destinatario ='" . $email . "';";

            $pdost1 = $this->db->prepare($query1);
            $pdost1->execute();
            $num1 = $pdost1->rowCount();

            if ($num1 == 0)
            {
                $result1 = null;
            }
            elseif ($num1 == 1)
            {
                $result1 = $pdost1->fetch(PDO::FETCH_ASSOC);
            }
            else
                {
                $result1 = array();
                $pdost1->setFetchMode(PDO::FETCH_ASSOC);
                while ($row1 = $pdost1->fetch())
                    $result1[] = $row1;
            }
            $pdost2 = $this->db->prepare($query2);
            $pdost2->execute();
            $num2 = $pdost2->rowCount();

            if ($num2 == 0)
            {
                $result2 = null;
            }
            elseif ($num2 == 1)
            {
                $result2 = $pdost2->fetch(PDO::FETCH_ASSOC);
            }
            else
            {
                $result2 = array();
                $pdost2->setFetchMode(PDO::FETCH_ASSOC);
                while ($row2 = $pdost2->fetch())
                    $result2[] = $row2;
            }
            return array($result1, $result2, $num1, $num2);
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
        }
    }

}


