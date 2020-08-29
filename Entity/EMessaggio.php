<?php

/**
 * Enità Messaggio, dove sono presenti le caratteristiche di specifica e i suoi metodi peculiari.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

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

    /** Questo metodo è il costruttore della classe EMessaggio.
     * EMessaggio constructor.
     * @param $fname
     * @param $data
     * @param $type
     */

    function __construct($mitt, $dest, $ogg, $test)
    {
        $this->mittente = $mitt;
        $this->destinatario = $dest;
        $this->oggetto = $ogg;
        $this->testo = $test;
    }

    /**Metodo getId che ci permette di prendere il valore di Id
     * @return mixed
     */

    function getId()
    {
        return $this->id;
    }

    /**Metodo che ci permette di cambiare l'id di vinile
     * @param mixed $id
     */

    public function setId($id): void
    {
        $this->id = $id;
    }

    /**Metodo getMittente che ci permettere di prendere il mittente
     * @return mixed
     */

    function getMittente()
    {
        return $this->mittente;
    }

    /**Metodo che ci permette di cambiare il mittente
     * @param mixed $mittente
     */

    function setMittente($mittente)
    {
        $this->mittente = $mittente;
    }

    /**Metodo che ci permette di prendere il valore di destinatario
     * @return mixed
     */

    function getDestinatario()
    {
        return $this->destinatario;
    }

    /**Metodo che ci permette di cambiare il destinatario
     * @param mixed $destinatario
     */

    function setDestinatario($destinatario)
    {
        $this->destinatario = $destinatario;
    }

    /** Metodo che ci permette di prendere il valore dell'oggetto
     * @return mixed
     */

    function getOggetto()
    {
        return $this->oggetto;
    }

    /**Metodo che ci permette di cambiare il valore dell'oggetto
     * @param mixed $oggetto
     */

    function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;
    }

    /**Metodo che ci permette di prendere il testo del messaggio
     * @return mixed
     */

    function getTesto()
    {
        return $this->testo;
    }

    /**Metodo che permette di cambiare il testo del messaggio
     * @param mixed $testo
     */

    function setTesto($testo)
    {
        $this->testo = $testo;
    }

    /**
     * Metodo che restituisce una stringa con i dati relativi all'immagine.
     * @return $st String
     */

    function toString()
    {
        return
            "Mittente del messaggio: ".$this->mittente."\n" .
            "Destinatario del messaggio: ".$this->destinatario."\n" .
            "Oggetto del messaggio: ".$this->oggetto."\n" .
            "Testo del messaggio: ".$this->testo ."\n";
    }

}