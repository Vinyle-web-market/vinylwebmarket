<?php


class FImage
{


    private static string $className       = "FImage";

    private static string $tableImgUtente  = "imageutente";

    private static string $tableImgVinile  = "imagevinile";

    private static string $valuesImgUtente = "(:id,:filename,:mimetype,:dataimage,:email_utente)";

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

    public static function bind($pdost,$media) {
        if ($media instanceof EImage) {
            $pdost->bindValue(":id",           NULL,                                PDO::PARAM_INT);
            $pdost->bindValue(":filename",     $media->getFilename(),               PDO::PARAM_STR);
            $pdost->bindValue(":mimetype",     $media->getMimeType(),               PDO::PARAM_STR);
            $pdost->bindValue(':dataimage',    $media->getDataImage(),        PDO::PARAM_LOB);

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

    public static function storeI(EImage $media) {
        $db = FDatabase::getInstance();

        $id = $db->storeMedia(static::getClass(), $media);

        $media->setId($id);

        return $id;
    }

    public static function deleteI(string $categoriaImage,$field, $id){
        $db=FDatabase::getInstance();
        if($categoriaImage === 'EImageUtente')
        $result=$db->deleteMedia('EImageUtente', $field, $id);
         else if($categoriaImage === 'EImageVinile')
            $result=$db->deleteMedia('EImageVinile', $field, $id);
         return $result;
    }


    public static function loadI(string $categoriaImage,$field,$id){
        $image=null;
        $Fclass=static::getClass();
        $db=FDatabase::getInstance();
        if($categoriaImage === 'EImageUtente') {
            $result = $db->loadMedia('EImageUtente', $field, $id);
            $num = $db->countLoadMedia($categoriaImage, $field, $id);
            if(($result!=null) && ($num == 1)) {
                // ($fname, $data, $type,$mail)
                $image=new EImageUtente($result['filename'],$result['mimetype'],$result['dataimage'],$result['email_utente']);
                $image->setId($result['id']);
            }
            else {
                if(($result!=null) && ($num > 1)){
                    $image = array();
                    for($i=0; $i<count($result); $i++){
                        $image[]=new EImageUtente($result[$i]['filename'],$result[$i]['mimetype'],$result['dataimage'],$result[$i]['email_utente']);
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
                $image=new EImageVinile($result['filename'],$result['mimetype'],$result['dataimage'],$result['id_vinile']);
                $image->setId($result['id']);
            }
            else {
                if(($result!=null) && ($num > 1)){
                    $image = array();
                    for($i=0; $i<count($result); $i++){
                        $image[]=new EImageVinile($result[$i]['filename'],$result[$i]['mimetype'],$result['dataimage'],$result[$i]['id_vinile']);
                        $image[$i]->setId($result[$i]['id']);
                    }
                }
            }
        }
        return $image;
    }




}