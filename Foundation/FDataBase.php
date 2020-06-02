<?php

class FDataBase
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
            self::$instance = new FDataBase();
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




}


