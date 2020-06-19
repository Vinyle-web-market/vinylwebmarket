<?php


class FImage
{


    private static string $className       = "FMedia";

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

    public static function bind($pdost,$media,$nome_file) {
        $path = $_FILES[$nome_file]['tmp_name'];
        $file=fopen($path,'rb') or die ("impossibile aprire il file!");
        if ($media instanceof EImage) {
            $pdost->bindValue(":id",           NULL,                                PDO::PARAM_INT);
            $pdost->bindValue(":filename",     $media->getFilename(),               PDO::PARAM_STR);
            $pdost->bindValue(":mimetype",     $media->getMimeType(),               PDO::PARAM_STR);
            $pdost->bindValue(':immagine',     fread($file,filesize($path)),        PDO::PARAM_LOB);

            if ($media instanceof EImageUtente) {
                $pdost->bindValue(":email_utente", $media->getEmailUtente(),         PDO::PARAM_STR);
            } else if ($media instanceof EImageVinile) {
                $pdost->bindValue(":id_vinile",   $media->getIdVin(),                PDO::PARAM_INT);
            };
        } else {
            die("Not a media!!");
        }
        unset($file);
        unlink($path);
    }

    /**
     * Funzione che ritorna il nome della classe.
     * @return string
     */
    public static function getClassName() {
        return self::$className;
    }

    /**
     * Funzione che ritorna il nome della tabella presente sul DB.
     * @param string $media
     * @return string|null
     */
    public static function getTableName(string $media) {
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
    public static function getValuesName(EImage $media) {
        if ($media instanceof EImageUtente) {
            return self::$valuesImgUtente;
        } else if ($media instanceof EImageVinile) {
            return self::$valuesImgVinile;
        }

        return null;
    }

    public static function store(EMedia $media,$nomefile) {
        $db = FDatabase::getInstance();

        $id = $db->storeMedia(static::getClassName(), $media,$nomefile);

        $media->setId($id);
    }


}