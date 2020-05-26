<?php


class EUtente_Loggato
{
    private $username;
    private $email;
    private $password;
    private $phone;
    private $state;
    private $registrationDate;
    private $_recensioni;
    private $id;

    //COSTRUTTORE

    public function __construct($name, $mail, $pw, $tel, $datareg)
    {
        $this->username = $name;
        $this->email = $mail;
        $this->password = $pw;
        $this->phone = $tel;
        $this->state = true;
        $this->registrationDate = $datareg;
        $this->_recensioni=array();
    }

    //METODI GET

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

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
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
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
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @param mixed $registrationDate
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;
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
        $this->username = $username;
    }

//eiei
    function toString()
    {
        return "Username: " . $this->username . "\n" .
            "Email: " . $this->email . "\n" .
            "Password: " . $this->password . "\n" .
            "Phone: " . $this->phone . "\n" .
            "State: " . $this->state . "\n" .
            "DateRegistration: " . $this->registrationDate . "\n";
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

    public function mediaRecensioni() {
        $s = 0;
        $med = 0;
        $numVoti=is_array($this->_recensioni)?count($this->_recensioni):0;
        if ($numVoti>1)
            foreach ($this->_recensioni as $rec) {
                $s = $s + $rec->getVotostelle();
                $med = $s / $numVoti;
            }
        elseif (null !== $this->_recensioni[0]->getVotostelle())
            $med = $this->_recensioni[0]->getVotostelle();
        $str = number_format($med,1);
        return $str;
    }




}