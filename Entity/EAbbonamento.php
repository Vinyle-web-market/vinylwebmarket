<?php


class EAbbonamento
{
    private $date;
    private $import;
    private $stato;
    private $id;

    function __construct($IDabbonamento, $dataRinnovo , $importo, $status)
    {
        $this->date = $dataRinnovo;
        $this->import= $importo;
        $this->id=$IDabbonamento;
        $this->stato=$status;
    }

    function setData($data) {
        $this->date=$data;
    }

    function setImporto($importo_abb) {
        $this->import=$importo_abb;
    }

    function getData() {
        return $this->date;
    }

    function getImporto() {
        return $this->import;
    }

    /**
     * @param mixed $stato
     */
    function setStato($status)
    {
        $this->stato = $status;
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

    function toString() {
        return "data rinnovo: ".$this->date." importo: ".$this->import."€"." stato: ".$this->stato;
    }

}