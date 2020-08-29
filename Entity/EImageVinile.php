<?php

/**
 * Enità Immagine Vinile (immagine dei vinili pubblicati nel sito), dove sono presenti
 * le caratteristiche di specifica e i suoi metodi peculiari, ereditando anche dalla classe padre.
 * Essa, infatti, rappresenta una classe figlio dell'interfaccia.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Entity
 */

class EImageVinile extends EImage
{
  private $idVin;

    /**
     * EImageVinile constructor.
     * @param $fname
     * @param $data
     * @param $type
     * @param $idVin
     */

  public function __construct($fname, $data, $type,$id)
  {
      parent::__construct($fname, $data, $type);
      $this->idVin=$id;
  }


    /**
     * Metodo che ci permette di prendere l'id del vinile.
     * @return mixed
     */

    public function getIdVin()
    {
        return $this->idVin;
    }

    /**
     * Metodo che ci permette di cambiare l'id del vinile.
     * @param mixed $idVin
     */

    public function setIdVin($idVin): void
    {
        $this->idVin = $idVin;
    }

    /**
     * Metodo che ci permette di stampare a video tutti i dati dell'immagine.
     * @return string
     */

    public function __toString()
    {
        $str="Id_Vinile: ".$this->getIdVin();
        $str =  parent::__toString(); // TODO: Change the autogenerated stub
        return $str;
    }


}