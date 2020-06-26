<?php


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
     *  @throws Exception, se almeno uno dei parametri passato al costruttore non rispetta la relativa sintassi.
     */
    function __construct($intestatario , $numeroCarta , $scadenza , $cvv)
    {
        $this->setIntestat($intestatario);
        $this->setNum($numeroCarta);
        $this->setScad($scadenza);
        $this->setCodcvv($cvv);
    }

    //METODI SET

    /** Questo metodo setta il nome dell'intestatario della carta.
     * @param mixed $intestat
     */
    function setIntestat($intestat)
    {
        if (EInputControl::getInstance()->testIntestatario($intestat)) {
        $this->intestat = $intestat;
        } else {
            throw new Exception( 'Intestatario inserito non valido!');
        }
    }

    /** Questo metodo setta il nome dell'intestatario della carta
     * @param mixed $num
     */
    function setNum($num)
    {
        if (EInputControl::getInstance()->testCardNumber($num)) {
            $this->num = $num;
        } else {
           throw new Exception( 'Numero di carta non valido!');
        }
    }

    /** Questo metodo setta la scadenza della carta
     * @param mixed $scad
     */
    function setScad($scad)
    {
        if (EInputControl::getInstance()->testDate($scad)) {
        $this->scad = $scad;
        } else {
            throw new Exception( 'Data inserita non valida!');
        }
    }

    /** Questo metodo setta il cvv della carta
     * @param mixed $codcvv
     */
    function setCodcvv($codcvv)
    {
        if (EInputControl::getInstance()->testCvv($codcvv)) {
            $this->codcvv = $codcvv;
        } else {
            throw new Exception( 'Codice CVV inserito non valido!');
        }
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