<?php


/**
 * Enità Image (immagine), dove sono presenti le caratteristiche di specifica e i suoi metodi peculiari a livello generico.
 * Infatti rappresenta una interfaccia (una classe padre da cui i figli ereditano attributi e metodi).
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

class EImage
{

    private $id;

    private $filename;

    private $dataImage;

    private $MimeType;

//-------------------------COSTRUTTORE-------------------------

    /** Questo metodo è il costruttore della classe EImage.
     * EImage constructor.
     * @param $fname
     * @param $data
     * @param $type
     */

    public function __construct($fname,$data,$type)
    {
        $this->filename=$fname;
        $this->dataImage=$data;
        $this->MimeType=$type;
    }

    /**
     * Questo metodo prende l'ID dell'immagine.
     * @return mixed
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * Questo metodo prende il nome del file.
     * @return mixed
     */

    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Questo metodo prende il tipo di dato dell'immagine.
     * @return mixed
     */

    public function getDataImage()
    {
        return $this->dataImage;
    }

    /**
     * Questo metodo prende la tipologia di immagine.
     * @return mixed
     */

    public function getMimeType()
    {
        return $this->MimeType;
    }

    /*
     * Questo metodo cambia il valore dell'id.
     * @param mixed $id
     */

    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Questo metodo cambia il valore del filename.
     * @param mixed $filename
     */

    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    /**
     * Questo metodo cambia il valore del dato dell'immagine.
     * @param mixed $dataImage
     */

    public function setDataImage($dataImage): void
    {
        $this->dataImage = $dataImage;
    }

    /*
     * Questo metodo cambia il valore della tipologia d'immagine.
     * @param mixed $MimeType
     */

    public function setMimeType($MimeType): void
    {
        $this->MimeType = $MimeType;
    }

    /**
     * Verificano la corrispondenza con il valore in input con i requisiti richiesti
     * @param $type
     * @return bool
     */

    public function valPic($type)
    {
        if($type=="image/jpeg" || $type=="image/png")
            return true;
        else
            return false;
    }

    /**
     * Metodo che restituisce una stringa con i dati relativi all'immagine.
     * @return $st String
     */

    public function __toString()
    {
        $st="Id: ".$this->getId()." | filename: ".$this->getFilename()." | type: ".$this->getMimeType()." | Data: ".$this->getDataImage();
        return $st;
    }


}