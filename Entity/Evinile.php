<?php


class Evinile
{
    private $id;
    private $user_venditore;
    private $titolo;
    private $artista;
    private $genere;
    private $ngiri;
    private $condizione;
    private $prezzo;
    private $descrizione;
    private $quantita;

    /*Questo è il costruttore della classe Vinile
     * @param $id
     * @param $user_venditore
     * @param $titolo
     * @param $artista
     * @param $genere
     * @param $ngiri
     * @param $condizione
     * @param $prezzo
     * @param descrizione
     * @param quantità
     */

    function __construct($user_vend, $tit,$art, $gen, $ng, $cond, $pr, $des, $quan)
    {
        $this->user_venditore = $user_vend;
        $this->titolo = $tit;
        $this->artista = $art;
        $this->genere = $gen;
        $this->ngiri = $ng;
        $this->condizione = $cond;
        $this->prezzo = $pr;
        $this->descrizione = $des;
        $this->quantita = $quan;
    }
    /**
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }
    function getUserVenditore()
    {
        return $this->user_venditore;
    }
    /**
     * @param mixed $user_venditore
     */
    function setUserVenditore($user_venditore)
    {
        $this->user_venditore = $user_venditore;
    }
    /**
     * @return mixed
     */
    function getTitolo()
    {
        return $this->titolo;
    }
    /**
     * @param mixed $titolo
     */
    function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }
    /**
     * @return mixed
     */
    function getArtista()
    {
        return $this->artista;
    }
    /**
     * @param mixed $artista
     */
    function setArtista($artista)
    {
        $this->artista = $artista;
    }
    /**
     * @return mixed
     */
    function getGenere()
    {
        return $this->genere;
    }
    /**
     * @param mixed $genere
     */
    function setGenere($genere)
    {
        $this->genere = $genere;
    }
    /**
     * @return mixed
     */
    function getNgiri()
    {
        return $this->ngiri;
    }
    /**
     * @param mixed $ngiri
     */
    function setNgiri($ngiri)
    {
        $this->ngiri = $ngiri;
    }
    /**
     * @return mixed
     */
    function getCondizione()
    {
        return $this->condizione;
    }
    /**
     * @param mixed $condizione
     */
    function setCondizione($condizione)
    {
        $this->condizione = $condizione;
    }
    /**
     * @return mixed
     */
    function getPrezzo()
    {
        return $this->prezzo;
    }
    /**
     * @param mixed $prezzo
     */
    function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }
    /**
     * @return mixed $descrizione;
     */
    function getDescrizione()
    {
        return $this->descrizione;
    }
    /**
     * @param mixed $descrizione
     */
    function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
    /** Metodo che prende la Quantità
     * @return mixed
     */
    function getQuantita()
    {
        return $this->quantita;
    }
    /**
     * @param mixed $quantita
     */
    function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }
    function toString()
    {
        return "Venditore: ".$this->user_venditore."\n".
               "Titolo vinile: ".$this->titolo."\n".
               "Artista è: ".$this->artista."\n".
               "Numero di giri: ".$this->ngiri."\n".
               "Condizione vinile : ".$this->condizione."\n".
               "Prezzo: ".$this->prezzo."\n".
               "Descrizione:".$this->descrizione."\n".
               "Quantità: ".$this->quantita."\n";
    }
}