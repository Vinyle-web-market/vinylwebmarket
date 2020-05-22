<?php

class FDataBase
{
    //approccio statico,una sola istanza
    private static $instance;
    private $db;

    private function __construct()
    {
        try{
            $this->db=new PDO("mysql:dbname=".$GLOBALS["database"].";host=localhost;charset=utf8;",$GLOBALS["username"],$GLOBALS["password"]);
           }
           catch(PDOException $err)
           {
             echo"ATTENZIONE ERRORE: ".$err->getMessage();
             die;
           }
    }

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if(self::$instance==null){
            self::$instance=new FDataBase();
        }
        return self::$instance;
    }

    public function dbCloseConnection(){
        self::$instance=NULL;     //IN CASO USARE STATIC::
    }


    public function store($object,$Fclass)
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
 //field è chiave primaria della classe
    public function exists($Fclass,$field,$id){
        try{
            $sql=" SELECT * FROM ".$Fclass::getTable(). " WHERE ".$field."='".$id."'";
            $pdost=$this->db->prepare($sql);
            $pdost->execute();
            $array=$pdost->fetchAll(PDO::FETCH_ASSOC) ;
            if(count($array)==1) return $array[0];
            if(count($array)>1) return $array;     //fare test
            $this->dbCloseConnection();

            } catch (PDOException $err) {
                      echo "ATTENZIONE ERRORE: " . $err->getMessage();
                        return null;
        }
    }
//field chiave primaria della classe a cui fa riferimento
    public function delete($Fclass,$field,$id){
       try{
        $this->db->beginTransaction();
        $presente=$this->exists($Fclass,$field,$id);
        if($presente){
        $sql="DELETE FROM ".$Fclass::getTable()." WHERE ".$field."='".$id."'";
        $pdost=$this->db->prepare($sql);
        $pdost->execute();
        $this->db->commit();
        $eliminato=TRUE;
                      }
        }
        catch (PDOException $err) {
               echo "ATTENZIONE ERRORE: " . $err->getMessage();
               return null;
       }
    }


}


