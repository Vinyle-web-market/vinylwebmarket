<?php

/**
 * Persistenza FDatabase, classe per la connessione con il database tramite la tecnologia PDO.
 * Inoltre, esegue delle query per tutte le operazioni necessarie al recupero e alla persistenza delle
 * entità sul database gestita come classe Singleton.
 * @author Gruppo Cruciani - Nanni - Scarselli.
 * @package Foundation
 */

class FDatabase
{
    /**
     * Unica istanza della classe.
     */
    private static $instance;

    /**
     * Oggetto che gestisce la connessione al database.
     */
    private $db;

    private $dsn = 'mysql:host=localhost;dbname=vinylwebmarket';
    private $username = 'root';
    private $password = 'pippo';
    private $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

    //-------------------------COSTRUTTORE-------------------------

    /**
     * L'unico accesso possibile è effettuato dal metodo getInstance().
     */

    private function __construct()
    {
        try
        {
            $this->db = new PDO($this->dsn, $this->username, $this->password, $this->options);
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            die;
        }
    }

    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return mixed
     */

    public static function getInstance()
    {
        if (self::$instance == null)
        {
            self::$instance = new FDatabase();
        }
        return self::$instance;
    }

    /**
     * Metodo che conclude la connesione con il database.
     */

    public function dbCloseConnection()
    {
        static::$instance = NULL;
    }

    /**
     * Metodo che permette di salvare una tupla nel database.
     * Ritorna l'id dell'oggetto salvato.
     * @param $object oggetto da salvare.
     * @param $Fclass classe Foundation in questione.
     */

    public function storeP($object, $Fclass)
    {
        try
        {
            $this->db->begintransaction();
            $sql = " INSERT INTO " . $Fclass::getTable() . " VALUES " . $Fclass::getValues();
            $pdost = $this->db->prepare($sql);
            $Fclass::bind($pdost, $object);
            $pdost->execute();
            $id = $this->db->lastInsertId();
            $this->db->commit();
            $this->dbCloseConnection();
            return $id;
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che verifica se una tupla è già presente nel database.
     * Ritorna un oggetto della classe in questione.
     * @param $Fclass Foundation in questione.
     * @param $keyField chiave con cui si fà il test.
     * @param $id valore che viene richiesto.
     */

    public function existP($Fclass, $keyField, $id)
    {
        try
        {
            $sql = " SELECT * FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "'";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $array = $pdost->fetchAll(PDO::FETCH_ASSOC);
            if (count($array) == 1)
                return $array[0];
            if (count($array) > 1)
                return $array;
            $this->dbCloseConnection();
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }

    /**
     * Metodo che permette di eliminare una tupla presente nel database.
     * Ritorna un booleano di verifica.
     * @param $Fclass Foundation in questione.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function deleteP($Fclass, $keyField, $id)
    {
        try
        {
            $eliminato = NULL;
            $this->db->beginTransaction();
            $presente = $this->existP($Fclass, $keyField, $id);
            if ($presente)
            {
                $sql = "DELETE FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "'";
                $pdost = $this->db->prepare($sql);
                $pdost->execute();
                $this->db->commit();
                $eliminato = TRUE;
            }
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $eliminato = FALSE;
        }
        return $eliminato;
    }

    /**
     * Metodo che permette di aggiornare una tupla presente nel database.
     * Ritorna un booleano di verifica.
     * @param $Fclass Foundation in questione.
     * @param $field campo con cui si fà il test.
     * @param $newvalue nuovo valore con cui aggiornare.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function updateP($Fclass, $field, $newvalue, $keyField, $id)
    {
        try
        {
            $this->db->beginTransaction();
            $query = "UPDATE " . $Fclass::getTable() . " SET " . $field . "='" . $newvalue . "' WHERE " . $keyField . "='" . $id . "';";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $this->db->commit();
            $this->dbCloseConnection();
            return true;
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return false;
        }
    }

    /**
     * Metodo che permette di caricare tutte le tuple presenti
     * nel database dal campo chiave di ricerca.
     * Ritorna un array di oggetti carica dal db.
     * @param $Fclass Foundation in questione.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function loadP($Fclass,$keyField,$id)
    {
        try
        {
            $sql="SELECT * FROM ".$Fclass::getTable()." WHERE ".$keyField."='".$id."';";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else
                {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result[] = $e;
                }
            return $result;

           }
             catch (PDOException $err)
             {
             echo "ATTENZIONE ERRORE: " . $err->getMessage();
              return null;
            }
    }

    /**
     * Metodo che permette di contare le righe interessate dalla query.
     * Ritorna un numero intero in risposta.
     * @param $Fclass Foundation in questione.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

        public function countLoadP ($Fclass, $keyField, $id)
        {
            try
            {
                $this->db->beginTransaction();
                $query = "SELECT * FROM " . $Fclass::getTable() . " WHERE " . $keyField . "='" . $id . "';";
                $stmt = $this->db->prepare($query);
                $stmt->execute();
                $num = $stmt->rowCount();
                $this->dbCloseConnection();
                return $num;
            }
            catch (PDOException $e)
            {
                echo "Attenzione errore: " . $e->getMessage();
                $this->db->rollBack();
                return null;
            }
        }

    /**
     * Funzione che permette di salvare nel Database una immagine. ù
     * Ritorna l'id dell'oggetto inserito oppure una schermata di errore.
     * @param $class
     * @param EImage $media
     * @return mixed $id valore che viene richiesto.
     */
    public function storeMedia($class, EImage $media)
    {
        try
        {
            $this->db->beginTransaction();
            $query = "INSERT INTO ".$class::getTable(get_class($media))." VALUES ".$class::getValues($media);
            $pdost = $this->db->prepare($query);
            $class::bind($pdost, $media);
            $pdost->execute();
            $id=$this->db->lastInsertId();
            $this->db->commit();

            return $id;
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che permette di cancellare una immagine nel database.
     * Ritorna un booleano in risposta.
     * @param $categoriaImmagine rappresenta la categoria dell'immagine.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function deleteMedia(string $categoriaImmagine, $keyField, $id)
    {
        try
        {
            $Fclass='FImage';
            $eliminato = NULL;
            $this->db->beginTransaction();
            $sql = "DELETE FROM " . $Fclass::getTable($categoriaImmagine) . " WHERE " . $keyField . "='" . $id . "'";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $this->db->commit();
            $eliminato = TRUE;
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            $eliminato = FALSE;
        }
        return $eliminato;
    }

    /**
     * Metodo che permette di caricare una immagine presente nel database.
     * Ritorna un oggetto / array di immagine in risposta.
     * @param $categoriaImmagine rappresenta la categoria dell'immagine.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function loadMedia($categoriaImage,$keyField,$id)
    {
        $Fclass='FImage';
        try
        {
            $sql="SELECT * FROM ".$Fclass::getTable($categoriaImage)." WHERE ".$keyField."='".$id."';";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else
                {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result[] = $e;
            }
            return $result;

        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }

    /**
     * Metodo che permette di contatare, nel database, il numero
     * di righe interessate dalla query.
     * Ritorna un numero intero in risposta.
     * @param $categoriaImmagine rappresenta la categoria dell'immagine.
     * @param $keyField campo della chiave.
     * @param $id valore che viene richiesto.
     */

    public function countLoadMedia (string $categoriaImage, $keyField, $id)
    {
        $Fclass='FImage';
        try
        {
            $this->db->beginTransaction();
            $query = "SELECT * FROM " . $Fclass::getTable($categoriaImage) . " WHERE " . $keyField . "='" . $id . "';";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            $this->dbCloseConnection();
            return $num;
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che permette di filtrare i vinili secondo alcuni parametri
     * passati come attributi di ricerca.
     * Ritorna un oggetto / array in risposta.
     * @param $titolo rappresenta il titolo del vinile da ricercare.
     * @param $artista rappresenta l'artista del vinile da ricercare.
     * @param $genere rappresenta il genere del vinile da cercare.
     * @param $ngiri rappresenta il numero di giri del vinile da cercare.
     * @param $condizioni rappresenta la condizione del vinile da cercare.
     * @param $prezzo rappresenta il prezzo del vinile da cercare.
     */

    public function searchVinile ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo)
    {
        try
        {
            $class = "FVinile";
            $query = "SELECT * FROM " . $class::getTable() . " WHERE visibility =1";
            $param = array($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo);
            for ($i = 0; $i < count($param); $i++)
            {
                if ($param[$i] != null)
                {
                    switch ($i)
                    {
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
                                $query = $query . " AND prezzo <='" . $prezzo . "'";
                            break;
                    }
                }
            }
            $query = $query . ";";

            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0)
            {
                $result = null;        //nessuna riga interessata. return null
            }
            elseif ($num == 1)
            {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            } else
                {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;                    //ritorna un array di righe.
            }
            return array($result, $num);

        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    //Non lo abbiamo utilizzato
    public function searchMessaggio ($mittente, $destinatario)
    {
        try
        {
            $query = null;
            $class = "FMessaggio";
            $param = array($mittente, $destinatario);
            for ($i = 0; $i < count($param); $i++)
            {
                if ($param[$i] != null)
                {
                    switch ($i)
                    {
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
            if ($num == 0)
            {
                $result = null;        //nessuna riga interessata. return null
            }
            elseif ($num == 1)
            {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            }
            else
                {
                $result = array();                         //nel caso in cui piu' righe fossero interessate
                $stmt->setFetchMode(PDO::FETCH_ASSOC);   //imposta la modalità di fetch come array associativo
                while ($row = $stmt->fetch())
                    $result[] = $row;                    //ritorna un array di righe.
                }
            return array($result);
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che permette di verificare che le credenziale, email e passowrd, siano
     * presenti nel database.
     * Ritorna un utente con tali email e password se esistente, altrimenti NULL.
     * @param $email da constatare nel database.
     * @param $pass da constatare nel database.
     */

    public function loginP ($email, $pass)
    {
        try
        {
            $query = null;
            $class = "FUtente_loggato";
            $query = "SELECT * FROM " . $class::getTable() . " WHERE email ='" . $email . "' AND password ='" . $pass . "';";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            $num = $stmt->rowCount();
            if ($num == 0)
            {
                $result = null;        //nessuna riga interessata. return null
            }
            else
                {                          //nel caso in cui una sola riga fosse interessata
                $result = $stmt->fetch(PDO::FETCH_ASSOC);   //ritorna una sola riga
            }
            return $result;
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che permette di caricare tutte le recensioni, in assoluto, presenti nel database.
     * Ritorna un oggetto / array di ERecensione, altrimenti NULL.
     */

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

    /**
     * Metodo che permette di caricare tutti i vinili non bannati nella
     * parte pubblica del sito.
     * Ritorna un oggetto / array di EVinile, altrimenti NULL.
     */

    public function prendiVinile ()
    {
        try {
            $query = "SELECT * FROM vinile WHERE visibility = 1;";
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
                return $result['id_vinile'];
            }
            else
                {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($row = $pdost->fetch())
                    $result[] = $row['id_vinile'];
                return $result;
            }
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
            $this->db->rollBack();
            return null;
        }
    }

    /**
     * Metodo che permette di cercare una parola all'interno del campo $campo.
     * Ritorna un oggetto / array della classe $class, altrimenti NULL.
     * @param $campo in cui effettuare la ricerca.
     * @param $class classe di riferimento in cui cercare.
     * @param $input parola da cercare.
     */

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

    /**
     * Metodo che carica la chat tra due utenti, identificati dal sistema con le proprie email.
     *@param $email : email del primo utente
     *@param $email2 : email del secondo utente
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

    /**
     * Metodo che permette di mostrare tutte le conversazioni
     * con gli utenti avante $email e $email2.
     * Ritorna un oggetto / array della classe EMessaggio, altrimenti NULL.
     * @param $email
     * @param $email2
     * Essi sono quelli che effettuano la conversazione.
     */

    public function elenco_Chats ($email, $email2)
    {
        try
        {
            $query = null;
            if (!$email2)
                $query = "SELECT * FROM messaggio WHERE mittente ='" . $email . "' OR destinatario ='" . $email . "';";
            else
                $query = "SELECT * FROM messaggio WHERE (mittente ='" . $email . "' OR destinatario ='" . $email . "') AND id IN 
							(SELECT id FROM messaggio where (mittente ='" . $email2 . "' OR destinatario ='" . $email2 . "'));";
            $pdost = $this->db->prepare($query);
            $pdost->execute();
            $num = $pdost->rowCount();

            if ($num == 0)
            {
                $result = null;
            }
            elseif ($num == 1)
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
            return array($result, $num);
        }
        catch (PDOException $e)
        {
            echo "Attenzione errore: " . $e->getMessage();
        }
    }

    /**
     * Metodo che permette di caricare tutti i vinili attivi del venditore
     * con l'email in input.
     * Ritorna un oggetto / array della classe EVinile, altrimenti NULL.
     * @param $email del venditore che possiede i vinili.
     */

    public function loadViniliAtt($email)
    {
        try
        {
            $sql="SELECT * FROM vinile WHERE venditore='" .$email. "' AND visibility=1;";
            $pdost = $this->db->prepare($sql);
            $pdost->execute();
            $nload=$pdost->rowCount();
            if($nload==0)
                $result=NULL;
            else if($nload==1)
                $result=$pdost->fetch(PDO::FETCH_ASSOC);
            else
                {
                $result = array();
                $pdost->setFetchMode(PDO::FETCH_ASSOC);
                while ($e = $pdost->fetch())
                    $result[] = $e;
            }
            return $result;
        }
        catch (PDOException $err)
        {
            echo "ATTENZIONE ERRORE: " . $err->getMessage();
            return null;
        }
    }
}


