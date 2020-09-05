<?php
/**
 * Entità Vinile, dove sono presenti le caratteristiche di specifica e i suoi metodi peculiari.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

class EVinile
{
    /**
     * Identificativo univoco del vinile in annuncio.
     * AttributeType Integer.
     * Autoincrement.
     */
    private $id;

    /**
     * Informazione sul venditore.
     * AttributeType Integer.
     * Autoincrement.
     */
    private $venditore;

    private $titolo;
    private $artista;
    private $genere;
    private $ngiri;
    private $condizione;
    private $prezzo;
    private $descrizione;
    private $quantita;
    private $visibility;

    //-------------------------COSTRUTTORE-------------------------
    /** Questo metodo è il costruttore della classe EVinile.
     * EVinile constructor.
     * @param EUtente_loggato $vend
     * @param String $tit
     * @param String $art
     * @param String $gen
     * @param integer $ng
     * @param String $cond
     * @param String $pr
     * @param String $des
     * @param integer $quan
     */

    function __construct(EUtente_loggato $vend, $tit, $art, $gen, $ng, $cond, $pr, $des, $quan)
    {
        $this->venditore = new EUtente_loggato($vend->getUsername(), $vend->getEmail(), $vend->getPassword(), $vend->getPhone());
        $this->titolo = $tit;
        $this->artista = $art;
        $this->genere = $gen;
        $this->ngiri = $ng;
        $this->condizione = $cond;
        if(strpos($pr,"$")!==false or strpos($pr,"€")!==false)
        {
            $pr = str_replace("$", "", $pr);
            $pr = str_replace("€", "", $pr);
        }
        $this->prezzo = $pr;
        $this->descrizione = $des;
        $this->quantita = $quan;
        $this->visibility = true;
    }

    /**
     * Metodo che ci permette di prendere l'Id.
     * @return mixed
     */

    function getId()
    {
        return $this->id;
    }

    /**
     * Metodo che ci permette di cambiare l'id del vinile.
     * @param mixed $id
     */

    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * Metodo che ci permette di cambiare il nome utente del venditore.
     */

    function getVenditore()
    {
        return $this->venditore;
    }

    /**
     * Metodo che ci permette di cambiare il nome utente del venditore.
     */

    function setUserVenditore(EUtente_loggato $vend)
    {
          $this->venditore = $vend;
    }

    /**
     * Metodo che ci permette di prendere in esame il titolo del vinile.
     * @return mixed
     */

    function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Metodo che ci permette di cambiare il testo del vinile.
     * @param mixed $titolo
     */

    function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    }

    /**
     * Metodo che ci permette di prendere il nome dell'artista del vinile.
     * @return mixed
     */

    function getArtista()
    {
        return $this->artista;
    }

    /**
     * Metodo che ci permette di cambiare il nome dell'artista del vinile.
     * @param mixed $artista
     */

    function setArtista($artista)
    {
        $this->artista = $artista;
    }

    /**
     * Metodo che ci permette di prendere il genere musicale del vinile.
     * @return mixed
     */

    function getGenere()
    {
        return $this->genere;
    }

    /**
     * Metodo che ci permette di cambiare il genere musicale del vinile.
     * @param mixed $genere
     */

    function setGenere($genere)
    {
        $this->genere = $genere;
    }

    /**
     * Metodo che ci permette di prendere il numero di giri del vinile.
     * @return mixed
     */

    function getNgiri()
    {
        return $this->ngiri;
    }

    /**
     * Metodo che ci permette di cambiare il numero di giri del vinile.
     * @param mixed $ngiri
     */

    function setNgiri($ngiri)
    {
        $this->ngiri = $ngiri;
    }

    /**
     * Metodo che ci permette di verificare le condizioni del vinile.
     * @return mixed
     */

    function getCondizione()
    {
        return $this->condizione;
    }

    /**
     * Metodo che ci permette di cambiare le condizioni del vinile.
     * @param mixed $condizione
     */

    function setCondizione($condizione)
    {
        $this->condizione = $condizione;
    }

    /**
     * Metodo che ci permette di prendere il prezzo del vinile.
     * @return mixed
     */

    function getPrezzo()
    {
        return $this->prezzo;
    }

    /**
     * Metodo che ci permette di cambiare il prezzo del vinile.
     * @param mixed $prezzo
     */

    function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    /**
     * Metodo che ci permette di prendere la descrizione del vinile.
     * @return mixed $descrizione;
     */

    function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Metodo che ci permette di cambiare la descrizione del vinile.
     * @param mixed $descrizione
     */

    function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    }

    /**
     * Metodo che prende la quantità disponibile del vinile.
     * @return mixed
     */

    function getQuantita()
    {
        return $this->quantita;
    }

    /**
     * Metodo che ci permette di cambiare la quantità disponibile del vinile.
     * @param mixed $quantita
     */

    function setQuantita($quantita)
    {
        $this->quantita = $quantita;
    }

    /**
     * Metodo che ci permette di prendere l'attuale visibilità del vinile di un utente.
     * @return bool
     */

    function isVisibility()
    {
        return $this->visibility;
    }

    /**
     * Metodo che ci permette di cambiare la visibilità del vinile in mostra da un utente.
     * @param bool $visibility
     */

    function setVisibility(bool $visibility)
    {
        $this->visibility = $visibility;
    }

    /**
     * Metodo che ci permette di stampare a video tutti gli attributi della classe EVinile.
     */

    public function toString()
    {
        return
               "Titolo vinile: ".$this->titolo."\n".
               "Artista è: ".$this->artista."\n".
               "Numero di giri: ".$this->ngiri."\n".
               "Condizione vinile : ".$this->condizione."\n".
               "Prezzo: ".$this->prezzo."\n".
               "Descrizione:".$this->descrizione."\n".
               "Quantità: ".$this->quantita."\n".
               "Venditore: ".$this->venditore->toString();
    }

}