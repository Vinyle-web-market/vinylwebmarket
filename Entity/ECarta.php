<?php


class ECarta
{
    private $intestat;
    private $num;
    private $scad;
    private $codcvv;
    private $id;

    //COSTRUTTORE

    function __construct($intestatario , $numeroCarta , $scadenza , $cvv)
    {
        $this->intestat=$intestatario;
        $this->num=$numeroCarta;
        $this->scad=$scadenza;
        $this->codcvv=$cvv;
    }

    //METODI SET

    /**
     * @param mixed $intestat
     */
    function setIntestat($intestat)
    {
        $this->intestat = $intestat;
    }

    /**
     * @param mixed $num
     */
    function setNum($num)
    {
        $this->num = $num;
    }

    /**
     * @param mixed $scad
     */
    function setScad($scad)
    {
        $this->scad = $scad;
    }

    /**
     * @param mixed $codcvv
     */
    function setCodcvv($codcvv)
    {
        $this->codcvv = $codcvv;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    //METODI GET

    /**
     * @return mixed
     */
    function getIntestat()
    {
        return $this->intestat;
    }

    /**
     * @return mixed
     */
    function getNum()
    {
        return $this->num;
    }

    /**
     * @return mixed
     */
    function getScad()
    {
        return $this->scad;
    }

    /**
     * @return mixed
     */
    function getCodcvv()
    {
        return $this->codcvv;
    }

    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }

    //METODO TOSTRING

    function toString()
    {
        return "Codice carta: ".$this->num."\n".
                "Intestata a: ".$this->intestat."\n".
                "Scadenza: ".$this->scad."\n".
                "CVV: ".$this->codcvv;
    }

}