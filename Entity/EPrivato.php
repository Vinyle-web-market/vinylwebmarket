<?php


class EPrivato extends EUtente_loggato {

    private $nome;
    private $cognome;
    private $email_privato;

    /*Costruttore della classe EPrivato, che è una classe ereidtaria della
      classe padre EUtente_loggato*/

    public function __construct($name, $mail, $pw, $tel,$nom,$cog)
    {
        parent::__construct($name, $mail, $pw, $tel);
        $this->nome=$nom;
        $this->cognome=$cog;
    }

    //METODI GET

    /**Metodo che ci permette di prendere il nome del privato
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**Metodo che ci permette di prendere il cognome del privato
     * @return mixed
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    //METODI SET

    /**Metodo che ci permette di cambiare il nome del privato
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**Metodo che ci permette di cambiare il cognome del privato
     * @param mixed $cognome
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;
    }
    /*Metodo che ci permette di stampare a video tutti gli
      attributi della classe EPrivato*/
    public function toString()
    {
        return parent::toString(). // TODO: Change the autogenerated stub
            "Nome: ".$this->nome."\n".
            "Cognome: ".$this->cognome."\n";
    }

}