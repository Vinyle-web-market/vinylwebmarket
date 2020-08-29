<?php
/**
 * Enità Abbonamento, dove sono presenti le caratteristiche di specifica e i suoi metodi peculiari.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

class EAbbonamento
{
    private $date;
    private $stato;
    /** $id è l'identificativo dell'abbonamento */
    private $id;

    /** Questo metodo è il costruttore della classe EAbbonamento.
     * EAbbonamento constructor.
     */

    function __construct()
    {
        $this->date ="0000-00-00";
        $this->stato = 0;
    }

    //METODI SET
    /** Questo metodo setta la data di rinnovo dell'abbonamento.
     */

    function setData($data)
    {
        $this->date=$data;
    }

    /** Questo metodo setta lo stato dell'abbonamento
     * @param bool $status
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
     * @return string
     */

    function getData()
    {
        return $this->date;
    }

    /** Questo metodo ritorna lo stato dell'abbonamento
     * @return bool
     */

    public function isStato()
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

    function toString()
    {
        return "Data rinnovo: ".$this->date."\n".
                "Stato: ".$this->stato;
    }

    /** Metodo per calcolare il prezzo dell'abbonamento
     * @param int $n_mesi
     * @return int
     */

    public function CalcolaPrezzo($n_mesi){
        $x=($n_mesi*15);
        return $x;
    }

    /** Metodo per aggiornare la data di scadenza dell'abbonamento
     * @param int $n_mesiPagati
     */

    public function AggiornaAbbonamento($n_mesi)
    {
        if($this->isStato()=="0")
        {

        $data=date("Y-m-d");
        $d=date_create($data);
        date_add($d,date_interval_create_from_date_string($n_mesi."months"));
        $d = date('Y-m-d', $d->getTimestamp());

      } else {
            $d=date_create($this->date);
            date_add($d,date_interval_create_from_date_string($n_mesi."months"));
            $d = date('Y-m-d', $d->getTimestamp());
        }
        return $d;
    }

}