<?php

/**
 * Entità Utente Loggato (utenti iscritti nel sito), dove sono presenti le caratteristiche di
 * specifica e i suoi metodi peculiari a livello generico.
 * Essa, infatti, rappresenta una interfaccia (una classe padre da cui i figli ereditano attributi e metodi).
 * @author Gruppo Cruciani - Nanni - Scarselli.
 * @package Entity
 */

class EUtente_loggato
{
    private $email;
    private $password;
    private $phone;
    private $state;
    private $_recensioni;


    //-------------------------COSTRUTTORE-------------------------
    /** Questo metodo è il costruttore della classe EUtente_loggato.
     * EMessaggio constructor.
     * @param $username
     * @param $email
     * @param $password
     * @param $phone
     * @param $state
     * @param array $recensioni
     */

    public function __construct($name, $mail, $pw, $tel)
    {
        $this->username = $name;
        $this->email = $mail;
        $this->password = $pw;
        $this->phone = $tel;
        $this->state = true;
        $this->_recensioni = array();
    }

    /**
     * Metodo getId che ci permette di prendere il valore della password.
     * @return mixed
     */

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Metodo getId che ci permette di prendere il valore dell'Email.
     * @return mixed
     */

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Metodo getId che ci permette di prendere il valore del numero di telefono.
     * @return mixed
     */

    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * Metodo getId che ci permette di prendere l'attuale stato dell'utente.
     * @return bool
     */

    public function isState()
    {
        return $this->state;
    }

    /**
     * Metodo getId che ci permette di prendere il valore dell'username.
     * @return mixed
     */

    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Metodo che ci permette di cambiare l'email.
     * @param mixed $email
     */

    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Metodo che ci permette di cambiare la password.
     * @param mixed $password
     */

    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * Metodo che ci permette di cambiare il numero di telefono.
     * @param mixed $phone
     */

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    /**
     * Metodo che ci permette di cambiare lo stato.
     * @param mixed $state
     */

    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Metodo che ci permette di prendere il vettore delle recensioni associato all'utente.
     * @return array
     */

    public function getRecensioni()
    {
        return $this->_recensioni;
    }

    /**
     * Metodo che ci permette di cambiare l'username.
     * @param mixed $username
     */

    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Metodo che restituisce una stringa con i dati relativi all'immagine.
     */

    function toString()
    {
        return "Username: " . $this->username . "\n" .
            "Email: " . $this->email . "\n" .
            "Password: " . $this->password . "\n" .
            "Phone: " . $this->phone . "\n" .
            "State: " . $this->state . "\n" ;
    }

    /**
     * Metodo che restituisce username dell'utente con il vettore di recensioni associato.
     */

    function toStringRecensioni()
    {
        return "Username: " . $this->username . "\n" .
            "Recensioni: ".$this->arrayToString($this->_recensioni)."\n";
    }

    /**
     * Metodo che ci permette di stampare a video il vettore delle recensioni.
     * @return mixed
     */

    protected function arrayToString($vet)
    {
        $stringa=null;
        if(is_array($vet))
            foreach ($vet as $valore)
            {
                $stringa=$stringa."-".$valore;
            }
        else $stringa=$vet;
        return $stringa;
    }

    /**
     * Metodo che permette di aggiungere un oggetto di tipo recensione nel vettore associato all'utente.
     */

    public function addRecensione(Erecensione $rec)
    {
        array_push($this->_recensioni,$rec);
    }

    /**
     * Metodo che permette di rimuovere un oggetto di tipo recensione nel vettore associato all'utente.
     */

    public function removeRecensione($pos)
    {
        unset($this->_recensioni[$pos]);
        $this->_recensioni=array_values($this->_recensioni);
    }

}