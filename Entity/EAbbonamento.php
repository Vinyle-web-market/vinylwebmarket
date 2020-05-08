<?php


class EAbbonamento
{
    private $date;
    private $import;
    private $stato;
    private $id;

    /** Questo metodo è il costruttore della classe EAbbonamento.
     * EAbbonamento constructor.
     * @param DateTime $dataRinnovo
     */
    function __construct($dataRinnovo)
    {
        $this->date = $dataRinnovo;
        $this->import="0";
        $this->stato="non attivo";
    }

    //METODI SET
    /** Questo metodo setta la data di rinnovo dell'abbonamento
     * @param DateTime $data
     */
    function setData($data) {
        $this->date=$data;
    }

    /** Questo metodo setta l' importo dell'abbonamento
     * @param Int $importo_abb
     */
    function setImporto($importo_abb) {
        $this->import=$importo_abb;
    }

    /** Questo metodo setta lo stato dell'abbonamento
     * @param String $status
     */
    function setStato($status)
    {
        $this->stato = $status;
    }

    /** Questo metodo setta l' ID dell'abonamento
     * @param mixed $IDabbonamento
     */
    public function setId($IDabbonamento)
    {
        $this->id = $IDabbonamento;
    }

    //METODI GET

    /** Questo metodo ritorna la data di scadenza dell'abbonamento
     * @return DateTime
     */
    function getData() {
        return $this->date;
    }

    /** Questo metodo ritorna l'importo dell'abbonamento
     * @return Int
     */
    function getImporto() {
        return $this->import;
    }

    /** Questo metodo ritorna lo stato dell'abbonamento
     * @return String
     */
    function getStato()
    {
        return $this->stato;
    }

    /** Questo metodo ritorna l'ID dell'abbonamento
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    //METODO TO STRING
    /**metodo che restituisce una stringa con i dati relativi all'abbonamento
     * @return string
     */
    function toString() {
        return "Data rinnovo: ".$this->date."\n".
                "Stato: ".$this->stato;
    }

    /** Metodo per calcolare il prezzo dell'abbonamento
     * @param int $n_mesi
     * @return int
     */
    public function CalcolaPrezzo($n_mesi){
        $this->import=($n_mesi*15);
        return $this->import;
    }

    /** Metodo per aggiornare la data di scadenza dell'abbonamento
     * @param int $n_mesiPagati
     */
    public function AggiornaAbbonamento($n_mesiPagati){
        $data =date("j-m-Y",mktime(0,0,0,date('j'),date('m')+$n_mesiPagati,date('Y')));
        $this->date=$data;
        $this->stato="attivo";
    }

}