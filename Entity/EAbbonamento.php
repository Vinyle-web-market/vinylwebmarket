<?php


class EAbbonamento
{
    private $date;
    private $import;
    private $stato;
    private $id;

    //COSTRUTTORE

    function __construct($dataRinnovo , $importo, $status)
    {
        $this->date = $dataRinnovo;
        $this->import= $importo;
        $this->stato=$status;
    }

    //METODI SET

    function setData($data) {
        $this->date=$data;
    }

    function setImporto($importo_abb) {
        $this->import=$importo_abb;
    }

    /**
     * @param mixed $stato
     */
    function setStato($status)
    {
        $this->stato = $status;
    }

    /**
     * @param mixed $id
     */
    public function setId($IDabbonamento)
    {
        $this->id = $IDabbonamento;
    }

    //METODI GET

    function getData() {
        return $this->date;
    }

    function getImporto() {
        return $this->import;
    }

    /**
     * @return mixed
     */
    function getStato()
    {
        return $this->stato;
    }

    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    //METODO TO STRING

    function toString() {
        return "Data rinnovo: ".$this->date."\n".
                "Importo: ".$this->import." €"."\n".
                "Stato: ".$this->stato;
    }

}