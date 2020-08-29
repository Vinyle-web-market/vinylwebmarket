<?php


/**
 * Enità Carta, dove sono presenti le caratteristiche di specifica e i suoi metodi peculiari.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

class ECarta
{
    private $intestat;
    private $num;
    private $scad;
    private $codcvv;
    /** $id è l'identificativo della carta */
    private $id;

    /** Questo metodo è il costruttore della classe ECarta.
     * ECarta constructor.
     * @param String $intestatario
     * @param String $numeroCarta
     * @param int $cvv
     * @param string $scadenza
     */

    function __construct($intestatario , $numeroCarta , $scadenza , $cvv)
    {
        $this->intestat=$intestatario;
        $this->num=$numeroCarta;
        $this->scad=$scadenza;
        $this->codcvv=$cvv;
    }

    //METODI SET

    /** Questo metodo setta il nome dell'intestatario della carta.
     * @param mixed $intestat
     */

    function setIntestat($intestat)
    {
        $this->intestat = $intestat;
    }

    /** Questo metodo setta il nome dell'intestatario della carta
     * @param mixed $num
     */

    function setNum($num)
    {
        $this->num = $num;
    }

    /** Questo metodo setta la scadenza della carta
     * @param mixed $scad
     */

    function setScad($scad)
    {
        $this->scad = $scad;
    }

    /** Questo metodo setta il cvv della carta
     * @param mixed $codcvv
     */

    function setCodcvv($codcvv)
    {
        $this->codcvv = $codcvv;
    }

    /** Questo metodo setta l'ID della carta
     * @param mixed $id
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    //METODI GET

    /** Questo metodo ritorna il nome dell'intestatario della carta
     * @return mixed
     */

    function getIntestat()
    {
        return $this->intestat;
    }

    /** Questo metodo ritorna il numero della carta
     * @return mixed
     */

    function getNum()
    {
        return $this->num;
    }

    /** Questo metodo ritorna la scadenza della carta
     * @return mixed
     */

    function getScad()
    {
        return $this->scad;
    }

    /** Questo metodo ritorna il cvv della carta
     * @return mixed
     */

    function getCodcvv()
    {
        return $this->codcvv;
    }

    /** Questo metodo ritorna l'ID della carta
     * @return mixed
     */

    function getId()
    {
        return $this->id;
    }

    //METODO TOSTRING
    /**metodo che restituisce una stringa con i dati relativi alla carta
     * @return string
     */

    function toString()
    {
        return "Codice carta: ".$this->num."\n".
            "Intestata a: ".$this->intestat."\n".
            "Scadenza: ".$this->scad."\n".
            "CVV: ".$this->codcvv;
    }

}