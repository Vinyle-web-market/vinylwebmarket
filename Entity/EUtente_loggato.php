<?php


class EUtente_loggato
{
    private $username;
    private $email;
    private $password;
    private $phone;
    private $state;
    private $_recensioni;

    //COSTRUTTORE
    /**
     * EUtente constructor.
     * @param string $name, username dell'utente
     * @param string $mail, email dell'utente.
     * @param string $password, password dell'utente.
     * @param string $tel, telefono dell'utente.
     * @throws Exception, se almeno uno dei parametri passato al costruttore non rispetta la relativa sintassi.
     */
    public function __construct($name, $mail, $pw, $tel)
    {
        $this->setUsername($name);
        $this->setEmail($mail);
        $this->setPassword($pw);
        $this->setPhone($tel);
        $this->state =true;
        $this->_recensioni=array();
    }

    //METODI GET


    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }


    /**
     * @return bool
     */
    public function isState()
    {
        return $this->state;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }


    //METODI SET



    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        if (EInputControl::getInstance()->testEmail($email)) {
            $this->email = $email;
        } else {
            throw new Exception("Email non valida");
        }
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        if (EInputControl::getInstance()->testPassword($password)) {
            $this->password = $password;
        } else {
            throw new Exception("Password non valida");
        }
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        if (EInputControl::getInstance()->testPhone($phone)) {
            $this->password = $phone;
        } else {
            throw new Exception("Numero di telefono non valido");
        }
    }


    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return array
     */
    public function getRecensioni()
    {
        return $this->_recensioni;
    }

    /**
     * @return array
     */

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        if (EInputControl::getInstance()->testUsername($username)) {
            str_replace("\'", "'", $username);
            $this->username = $username;
        } else {
            throw new Exception("Username non corretto");
        }
    }

//eiei
    function toString()
    {
        return "Username: " . $this->username . "\n" .
            "Email: " . $this->email . "\n" .
            "Password: " . $this->password . "\n" .
            "Phone: " . $this->phone . "\n" .
            "State: " . $this->state . "\n" ;
    }

    function toStringRecensioni()
    {
        return "Username: " . $this->username . "\n" .
               "Recensioni: ".$this->arrayToString($this->_recensioni)."\n";
    }


    protected function arrayToString($vet){
        $stringa=null;
        if(is_array($vet))
            foreach ($vet as $valore)
            {
                $stringa=$stringa."-".$valore;
            }
        else $stringa=$vet;
        return $stringa;
    }

    public function addRecensione(Erecensione $rec)
    {
        array_push($this->_recensioni,$rec);
    }

    public function removeRecensione($pos)
    {
        unset($this->_recensioni[$pos]);
        $this->_recensioni=array_values($this->_recensioni);
    }

}