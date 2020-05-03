<?php


class EUtente_Loggato
{
    private $username;
    private $email;
    private $password;
    private $phone;
    private $state;
    private $registrationDate;

    //COSTRUTTORE
    public function __construct($name,$mail,$pw,$tel,$stato,$datareg)
    {
        $this->username=$name;
        $this->email=$mail;
        $this->password=$pw;
        $this->phone=$tel;
        $this->state=$stato;
        $this->registrationDate=$datareg;
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
     * @return mixed
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     * @return mixed
     */
    public function getState()
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
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
//eiei
    function toString(){
        return  "Username: ".$this->username."\n".
            "Email: ".$this->email."\n".
            "Password: ".$this->password."\n".
            "Phone: ".$this->phone."\n".
            "State: ".$this->state."\n".
            "DateRegistration: ".$this->registrationDate."\n";
    }

}