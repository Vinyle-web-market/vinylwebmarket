<?php


class Evinile
{
    /**
     * identificativo univoco annuncio
     * attributeType Integer
     * autoincrement
     */
    private $id;
    /**
     * informazione sul venditore
     * attributeType Integer
     * autoincrement
     */
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
    /**Metodo che ci permette di prendere l'Id
     * @return mixed
     */
    function getId()
    {
        return $this->id;
    }
    /*Metodo che ci permette di cambiare il nome utente
    del venditore
    */
    function getUserVenditore()
    {
        return $this->user_venditore;
    }
    /**Metodo che ci permette di cambiare il
     * nome utente del venditore
     * @param mixed $user_venditore
     */
    function setUserVenditore($user_venditore)
    {
        $this->user_venditore = $user_venditore;
    }
    /** Metodo che ci permette di prendere
     * in esame il titolo del vinile
     * @return mixed
     */
    function getTitolo()
    {
        return $this->titolo;
    }
    /**Metodo che ci permette di cambiare il
     * testo del vinile
     * @param mixed $titolo
     */
    function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }
    /**Metodo che ci permette di prendere il
     * nome dell'artista del vinile
     * @return mixed
     */
    function getArtista()
    {
        return $this->artista;
    }
    /**Metodo che ci permette di cambiare
     *il nome dell'artista del vinile
     * @param mixed $artista
     */
    function setArtista($artista)
    {
        $this->artista = $artista;
    }
    /**Metodo che ci permette di prendere
     * il genere musicale del vinile
     * @return mixed
     */
    function getGenere()
    {
        return $this->genere;
    }
    /**Metodo che ci permette di cambiare
     * il genere musicale del vinile
     * @param mixed $genere
     */
    function setGenere($genere)
    {
        $this->genere = $genere;
    }
    /** Metodo che ci permette di prendere
     * il numero di giri del vinile
     * @return mixed
     */
    function getNgiri()
    {
        return $this->ngiri;
    }
    /**Metodo che ci permette di cambiare
     * il numero di giri del vinile
     * @param mixed $ngiri
     */
    function setNgiri($ngiri)
    {
        $this->ngiri = $ngiri;
    }
    /**Metodo che ci permette di verificare
     * le condizioni del vinile
     * @return mixed
     */
    function getCondizione()
    {
        return $this->condizione;
    }
    /**Metodo che ci permette di cambiare
     * le condizioni del vinile
     * @param mixed $condizione
     */
    function setCondizione($condizione)
    {
        $this->condizione = $condizione;
    }
    /**Metodo che ci permette di prendere
     * il prezzo del vinile
     * @return mixed
     */
    function getPrezzo()
    {
        return $this->prezzo;
    }
    /**Metodo che ci permette di cambiare
     * il prezzo del vinile
     * @param mixed $prezzo
     */
    function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }
    /**Metodo che ci permette di prendere
     * la descrizione del vinile
     * @return mixed $descrizione;
     */
    function getDescrizione()
    {
        return $this->descrizione;
    }
    /**Metodo che ci permette di cambiare
     * la descrizione del vinile
     * @param mixed $descrizione
     */
    function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }
    /** Metodo che prende la quantità
     * disponibile del vinile
     * @return mixed
     */
    function getQuantita()
    {
        return $this->quantita;
    }
    /**Metodo che ci permette di cambiare
     * la quantità disponibile del vinile
     * @param mixed $quantita
     */
    function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }
    /*Metodo che ci permette di stampare
     * a video tutti gli attributi della
     * classe EVinile
     */
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