<?php


class EImage
{

    private $id;

    private $filename;

    private $dataImage;

    private $MimeType;

//-------------------------COSTRUTTORE-------------------------

    public function __construct($fname,$data,$type){
        $this->filename=$fname;
        $this->dataImage=$data;
        $this->MimeType=$type;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getDataImage()
    {
        return $this->dataImage;
    }

    /**
     * @return mixed
     */
    public function getMimeType()
    {
        return $this->MimeType;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $filename
     */
    public function setFilename($filename): void
    {
        $this->filename = $filename;
    }

    /**
     * @param mixed $dataImage
     */
    public function setDataImage($dataImage): void
    {
        $this->dataImage = $dataImage;
    }

    /**
     * @param mixed $MimeType
     */
    public function setMimeType($MimeType): void
    {
        $this->MimeType = $MimeType;
    }

    /**
     * Verificano la corrispondenza con il valore in input con i requisiti richiesti
     * @param $type valore inserito
     * @return bool
     */
    public function valPic($type) {
        if($type=="image/jpeg" || $type=="image/png")
            return true;
        else
            return false;
    }

    /**
     * @return $st String
     */
    public function __toString(){
        $st="Id: ".$this->getId()." | filename: ".$this->getFilename()." | type: ".$this->getMimeType()." | Data: ".$this->getDataImage();
        return $st;
    }


}