<?php


class EAbbonamento
{
    private $date;
    private $import;
    private $stato;
    private $id;

    //COSTRUTTORE

    function __construct($dataRinnovo)
    {
        $this->date = $dataRinnovo;
        $this->import="0";
        $this->stato="non attivo";
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
                //"Importo: ".$this->import." €"."\n".
                "Stato: ".$this->stato;
    }

    public function CalcolaPrezzo($n_mesi){
        $this->import=($n_mesi*15);
        return $this->import;
    }

    public function AggiornaAbbonamento($n_mesiPagati){
        $data =date("j-m-Y",mktime(0,0,0,date('j'),date('m')+$n_mesiPagati,date('Y')));
        $this->date=$data;
        $this->stato="attivo";
    }

}