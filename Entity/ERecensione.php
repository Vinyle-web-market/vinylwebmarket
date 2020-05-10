<?php


class ERecensione
{
    private $id;
    private $votostelle;
    private $testo;
    private $username_mittente;
    private $username_destinatario;
    /*Questo è il costruttore della classe Recensione*/

    function __construct($vt,$test, $user_mitt, $user_dest)
    {
        $this->votostelle = $vt;
        $this->testo = $test;
        $this->username_mittente = $user_mitt;
        $this->username_destinatario = $user_dest;
    }
    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }
    function getVotostelle()
    {
        return $this->votostelle;
    }
    /**
     * @param mixed $votostelle
     */
    function setVotostelle($votostelle)
    {
        $this->votostelle = $votostelle;
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
    /**
     * @return mixed
     */
    function getUsernameMittente()
    {
        return $this->username_mittente;
    }
    /**
     * @param mixed $username_mittente
     */
    function setUsernameMittente($username_mittente)
    {
        $this->username_mittente = $username_mittente;
    }
    /**
     * @return mixed
     */
    function getUsernameDestinatario()
    {
        return $this->username_destinatario;
    }
    /**
     * @param mixed $username_destinatario
     */
    function setUsernameDestinatario($username_destinatario)
    {
        $this->username_destinatario = $username_destinatario;
    }
    function toString()
    {
        return "Voto con stella: ".$this->votostelle."\n".
               "Testo: ".$this->testo."\n".
               "Recensione effetuata da: ".$this->username_mittente."\n".
               "Recensione ricevuta da: ".$this->username_destinatario."\n";
    }
}