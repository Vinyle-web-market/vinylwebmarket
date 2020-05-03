<?php


class ECarta
{
    private $intestat;
    private $num;
    private $scad;
    private $codcvv;

    function __construct($intestatario , $numeroCarta , $scadenza , $cvv)
    {
        $this->intestat=$intestatario;
        $this->num=$numeroCarta;
        $this->scad=$scadenza;
        $this->codcvv=$cvv;
    }

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

    function toString()
    {
        return "codice carta: ".$this->num." intestata a: ".$this->intestat." scadenza: ".$this->scad." CVV: ".$this->codcvv;
    }

}