<?php


class EMessaggio
{
    /**
     * identificativo univoco del messaggio
     * attributeType Integer
     * autoincrement
     */
    private $id;
    /**
     * mittente del messaggio
     * References Utente_loggato
     */
    private $mittente;
    /**
     * destinatario del messaggio
     * References Utente_loggato
     */
    private $destinatario;

    private $oggetto;

    private $testo;

    /*Costruttore della classe Messaggio*/

    function __construct($mitt, $dest, $ogg, $test)
    {
        $this->mittente = $mitt;
        $this->destinatario = $dest;
        $this->oggetto = $ogg;
        $this->testo = $test;
    }
    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }
    /**
     * @return mixed
     */
    function getMittente()
    {
        return $this->mittente;
    }
    /**
     * @param mixed $mittente
     */
    function setMittente($mittente)
    {
        $this->mittente = $mittente;
    }
    /**
     * @return mixed
     */
    function getDestinatario()
    {
        return $this->destinatario;
    }
    /**
     * @param mixed $destinatario
     */
    function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    }
    /**
     * @return mixed
     */
    function getOggetto()
    {
        return $this->oggetto;
    }
    /**
     * @param mixed $oggetto
     */
    function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;
    }
    /**
     * @return mixed
     */
    function getTesto()
    {
        return $this->testo;
    }
    /**
     * @param mixed $testo
     */
    function setTesto($testo)
    {
        $this->testo = $testo;
    }
    function toString()
    {
        return "Mittente del messaggio: ".$this->mittente."\n" .
               "Destinatario del messaggio: ".$this->destinatario."\n" .
               "Oggetto del messaggio: ".$this->oggetto."\n" .
               "Testo del messaggio: ".$this->testo ."\n";
    }
}