<?php


class EAbbonamento
{
    private $date;
    private $import;

    function __construct($dataRinnovo , $importo)
    {
        $this->date = $dataRinnovo;
        $this->import= $importo;
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

    function toString() {
        return "data rinnovo: ".$this->date." importo: ".$this->import."€";
    }

}