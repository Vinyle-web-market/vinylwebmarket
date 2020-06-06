<?php


class ERecensione
{
    /**
     * identificativo univoco recensione
     */
    private $id;
    private $votostelle;
    private $testo;
    /**
     *mittente recensione
     * references utente loggato
     */
    private $username_mittente;
    private $username_destinatario;
    private $ban;
    /*Questo è il costruttore della classe Recensione*/

    function __construct($vt,$test, $user_mitt, $user_dest)
    {
        $this->votostelle = $vt;
        $this->testo = $test;
        $this->username_mittente = $user_mitt;
        $this->username_destinatario = $user_dest;
        $this->ban = false;
    }
    /** Metodo che ci permette di prendere l'Id del messaggio
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }
    /*Metodo che ci permette di prendere il voto delle stelle*/
    function getVotostelle()
    {
        return $this->votostelle;
    }
    /**Metodo che ci permette di cambiare il voto in stelle
     * @param mixed $votostelle
     */
    function setVotostelle($votostelle)
    {
        $this->votostelle = $votostelle;
    }
    /**Metodo che ci permette di prendere il testo della recensione
     * @return mixed
     */
    function getTesto()
    {
        return $this->testo;
    }
    /**Metodo che ci permette di cambiare il testo della recensione
     * @param mixed $testo
     */
    function setTesto($testo)
    {
        $this->testo = $testo;
    }
    /**Metodo che ci permette di prendere il testo del messaggio
     * @return mixed
     */
    function getUsernameMittente()
    {
        return $this->username_mittente;
    }
    /**Metodo che ci permette di cambiare l'username del mittente
     * @param mixed $username_mittente
     */
    function setUsernameMittente($username_mittente)
    {
        $this->username_mittente = $username_mittente;
    }
    /**Metodo che ci permette di prendere l'username del destinatario
     * @return mixed
     */
    function getUsernameDestinatario()
    {
        return $this->username_destinatario;
    }
    /**Metodo che ci permette di cambiare l'username del destinatario
     * @param mixed $username_destinatario
     */
    function setUsernameDestinatario($username_destinatario)
    {
        $this->username_destinatario = $username_destinatario;
    }

    /** Metodo che ci resitituisce l'attuale
     * stato dell'attributo ban
     * @return bool
     */
    function isBan()
    {
        return $this->ban;
    }

    /** Metodo che ci permette di cambiare
     * lo stato dell'attributo ban
     * @param bool $ban
     */
    function setBan($ban)
    {
        $this->ban = $ban;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /*Metodo che ci permette di stampare a video tutti gli
     attributi della classe Recensione*/
    function toString()
    {
        return "Voto con stella: ".$this->votostelle."\n".
               "Testo: ".$this->testo."\n".
               "Recensione effetuata da: ".$this->username_mittente."\n".
               "Recensione ricevuta da: ".$this->username_destinatario."\n";
    }
    protected function arrayToString($rec){
        $stringa=null;
        if(is_array($rec))
            foreach ($rec as $valore)
            {
                $stringa=$stringa."-".$valore;
            }
        else $stringa=$rec;
        return $stringa;
    }


}