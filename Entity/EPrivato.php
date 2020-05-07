<?php


class EPrivato extends EUtente_Loggato {

       private $nome;
       private $cognome;
       private $email_privato;


            public function __construct($name, $mail, $pw, $tel, $stato, $datareg,$nom,$cog)
               {
                      parent::__construct($name, $mail, $pw, $tel, $stato, $datareg);
                      $this->nome=$nom;
                      $this->cognome=$cog;
               }

       //METODI GET

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    //METODI SET

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }

    public function toString()
    {
        return parent::toString(); // TODO: Change the autogenerated stub
        "Nome: ".$this->nome."\n";
        "Cognome: ".$this->cognome."\n";
    }

}