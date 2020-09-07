<?php

/**
 * Classe che permette il salvataggio e il caricamento di oggetti IMG (EImageUtente oppure EImageVinile) dal DB.
 * Class FImage
 * @author cruciani-scarselli-nanni
 * @package Foundation
 */


class FImage
{

    /**
     * Nome della Fclasse.
     */
    private static string $className       = "FImage";
    /**
     * Nome della corrispondente tabella presente sul DB se ci si riferisce ad una immagine del profilo.
     */
    private static string $tableImgUtente  = "imageutente";
    /**
     * Nome della corrispondente tabella presente sul DB se ci si riferisce alla foto di un vinile
     */
    private static string $tableImgVinile  = "imagevinile";
    /**
     * Insieme delle colonne presenti nella tabella sul DB che verrà sostituita in fase di binding se l'oggetto è una immagine del profilo.
     */
    private static string $valuesImgUtente = "(:id,:filename,:mimetype,:dataimage,:email_utente)";
    /**
     * Insieme delle colonne presenti nella tabella sul DB che verrà sostituita in fase di binding se l'oggetto è una immagine di un vinile.
     */
    private static string $valuesImgVinile = "(:id,:filename,:mimetype,:dataimage,:id_vinile)";

    public function __construct(){}

    /*
     *     public static function bind($stmt, EMediaUtente $md,$nome_file){
        //$path=$_FILES['file']['tmp_name'];
        $path = $_FILES[$nome_file]['tmp_name'];
        $file=fopen($path,'rb') or die ("Attenzione! Impossibile da aprire!");
        $stmt->bindValue(':id',NULL, PDO::PARAM_INT); //l'id � posto a NULL poich� viene dato automaticamente dal DBMS (AUTOINCREMENT_ID)
        $stmt->bindValue(':nome',$md->getFname(), PDO::PARAM_STR);
        $stmt->bindValue(':type',$md->getType(), PDO::PARAM_STR);
        $stmt->bindValue(':emailutente', $md->getEmailUte(), PDO::PARAM_STR);
        $stmt->bindValue(':immagine', fread($file,filesize($path)), PDO::PARAM_LOB);
        unset($file);
        unlink($path);
    }
     */
    /**
     *Associa un valore a un segnaposto con nome corrispondente nell'istruzione SQL utilizzata per preparare l'istruzione
     * $media è l oggetto a cui si vogliono prelevare i valori
     * file_get_contents () è il modo preferito per leggere il contenuto di un file in una stringa.
     * La funzione addlashes () restituisce una stringa con backslash davanti a caratteri predefiniti.la rende adatta ad essere salvata sul database
     */
    public static function bind($pdost,$media) {
        $dataimage=file_get_contents($media->getDataImage());
        $dataimage = addslashes($dataimage);
        if ($media instanceof EImage) {
            $pdost->bindValue(":id",           NULL,                                PDO::PARAM_INT);
            $pdost->bindValue(":filename",     $media->getFilename(),               PDO::PARAM_STR);
            $pdost->bindValue(":mimetype",     $media->getMimeType(),               PDO::PARAM_STR);
            $pdost->bindValue(':dataimage',    $dataimage,        PDO::PARAM_LOB);

            if ($media instanceof EImageUtente) {
                $pdost->bindValue(":email_utente", $media->getEmailUtente(),         PDO::PARAM_STR);
            } else if ($media instanceof EImageVinile) {
                $pdost->bindValue(":id_vinile",   $media->getIdVin(),                PDO::PARAM_INT);
            };
        } else {
            die("Not a media!!");
        }
    }

    /**
     * Funzione che ritorna il nome della classe.
     * @return string
     */
    public static function getClass() {
        return self::$className;
    }

    /**
     * Funzione che ritorna il nome della tabella presente sul DB.
     * @param string $media
     * @return string|null
     */
    public static function getTable(string $media) {
        if ($media       === "EImageUtente") {
            return self::$tableImgUtente;
        } elseif ($media === "EImageVinile") {
            return self::$tableImgVinile;
        }

        return null;
    }

    /**
     * Funzione che ritorna i valori delle colonne della tabella per il binding.
     * @param EImage $media
     * @return string|null
     */
    public static function getValues(EImage $media) {
        if ($media instanceof EImageUtente) {
            return self::$valuesImgUtente;
        } else if ($media instanceof EImageVinile) {
            return self::$valuesImgVinile;
        }

        return null;
    }

    /**
     * Funzione che permette di salvare una immagine sul DB.
     * @param EMedia $media, immagine da salvare.
     */
    public static function storeI(EImage $media) {
        $db = FDatabase::getInstance();

        $id = $db->storeMedia(static::getClass(), $media);

        $media->setId($id);

        return $id;
    }

    /**
     * Funzione che elimina un oggetto nel DB. Ritorna l'esito dell'operazione.
     * @param $value, valore necessario ad indetificare l'oggetto.
     * @param $row, colonna nella quale cercare il valore.
     * @return bool, esito dell'operazione.
     */
    public static function deleteI(string $categoriaImage,$field, $id){
        $result = false;
        $db=FDatabase::getInstance();
        if($categoriaImage === 'EImageUtente')
        $result=$db->deleteMedia('EImageUtente', $field, $id);
         else if($categoriaImage === 'EImageVinile')
            $result=$db->deleteMedia('EImageVinile', $field, $id);
         return $result;
    }
/*
    public static function exist($keyField, $id)
    {
        $db = FDatabase::getInstance();
        $exist = $db->existP(self::getClass(), $keyField, $id);
        if ($exist != null)
            return true;
        else
            return false;
    }
*/

    /**
     * Funzione che sulla base della tabella richiamata ritorna un oggetto immagine vinile o utente
     */
    public static function loadI(string $categoriaImage,$field,$id){
        $image=null;
        $Fclass=static::getClass();
        $db=FDatabase::getInstance();
        if($categoriaImage === 'EImageUtente') {
            $result = $db->loadMedia('EImageUtente', $field, $id);
            $num = $db->countLoadMedia($categoriaImage, $field, $id);
            if(($result!=null) && ($num == 1)) {
                // ($fname, $data, $type,$mail)
                $data=base64_encode(stripslashes($result['dataimage']));
                $image=new EImageUtente($result['filename'],$data,$result['mimetype'],$result['email_utente']);
                $image->setId($result['id']);
            }
            else {
                if(($result!=null) && ($num > 1)){
                    $image = array();
                    for($i=0; $i<count($result); $i++){
                        $data=base64_encode(stripslashes($result[$i]['dataimage']));
                        $image[]=new EImageUtente($result[$i]['filename'],$data,$result[$i]['mimetype'],$result[$i]['email_utente']);
                        $image[$i]->setId($result[$i]['id']);
                    }
                }
            }
        }
        else if($categoriaImage === 'EImageVinile') {
            $result = $db->loadMedia('EImageVinile', $field, $id);
            $num = $db->countLoadMedia($categoriaImage, $field, $id);
            if(($result!=null) && ($num == 1)) {
                // ($fname, $data, $type,$mail)
                $data=base64_encode(stripslashes($result['dataimage']));
                $image=new EImageVinile($result['filename'],$data,$result['mimetype'],$result['id_vinile']);
                $image->setId($result['id']);
            }
            else {
                if(($result!=null) && ($num > 1)){
                    $image = array();
                    for($i=0; $i<count($result); $i++){
                        $data=base64_encode(stripslashes($result[$i]['dataimage']));
                        $image[]=new EImageVinile($result[$i]['filename'],$data,$result[$i]['mimetype'],$result[$i]['id_vinile']);
                        $image[$i]->setId($result[$i]['id']);
                    }
                }
            }
        }
        return $image;
    }

    /**
     * Il vinile ha in genere 2 foto
     * Funzione che sulla base della tabella richiamata ritorna 1 e solo 1 oggetto immagine vinile(in questo caso un solo la foto principale)
     */
    public static function loadI1(string $categoriaImage,$field,$id){
        $image=null;
        $image1 = null;
        $Fclass=static::getClass();
        $db=FDatabase::getInstance();
        $result = $db->loadMedia('EImageVinile', $field, $id);
        $num = $db->countLoadMedia($categoriaImage, $field, $id);
        if(($result!=null) && ($num == 1)) {
            // ($fname, $data, $type,$mail)
            $data=base64_encode(stripslashes($result['dataimage']));
            $image1=new EImageVinile($result['filename'],$data,$result['mimetype'],$result['id_vinile']);
            $image1->setId($result['id']);
        }
        else {
            if(($result!=null) && ($num > 1)){
                $image = array();
                for($i=0; $i<count($result); $i++){
                    $data=base64_encode(stripslashes($result[$i]['dataimage']));
                    $image[]=new EImageVinile($result[$i]['filename'],$data,$result[$i]['mimetype'],$result[$i]['id_vinile']);
                    $image[$i]->setId($result[$i]['id']);
                }
                $image1=$image[0];
            }
        }
return $image1;
}

    /**
     * Il vinile ha in genere 2 foto
     * Funzione che sulla base della tabella richiamata ritorna 1 e solo 1 oggetto immagine vinile(in questo caso un solo la foto RETRO de vinile)
     */
    public static function loadI2(string $categoriaImage,$field,$id){
        $image=null;
        $image1 = null;
        $Fclass=static::getClass();
        $db=FDatabase::getInstance();
        $result = $db->loadMedia('EImageVinile', $field, $id);
        $num = $db->countLoadMedia($categoriaImage, $field, $id);
        if(($result!=null) && ($num == 1)) {
            // ($fname, $data, $type,$mail)
            $data=base64_encode(stripslashes($result['dataimage']));
            $image1=new EImageVinile($result['filename'],$data,$result['mimetype'],$result['id_vinile']);
            $image1->setId($result['id']);
        }
        else {
            if(($result!=null) && ($num > 1)){
                $image = array();
                for($i=0; $i<count($result); $i++){
                    $data=base64_encode(stripslashes($result[$i]['dataimage']));
                    $image[]=new EImageVinile($result[$i]['filename'],$data,$result[$i]['mimetype'],$result[$i]['id_vinile']);
                    $image[$i]->setId($result[$i]['id']);
                }
                $image1=$image[1];
            }
        }
        return $image1;
    }




}