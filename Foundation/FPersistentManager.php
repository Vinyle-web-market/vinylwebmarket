<?php


class FPersistentManager
{
    private static $instance = null;

    /**
     * funzione che ritorna l istanza del persistence manager
     * @return null
     */
    public static function getInstance(){ //restituisce l'unica istanza (creandola se non esiste gia)
        if(static::$instance==null){
            static::$instance=new FPersistentManager();
        }
        return static::$instance;
    }

    public function __construct(){}

    /** Metodo che permette di salvare un oggetto sul db */
    //1...claudia fa una distinzione con uan classe,tenere conto
    public static function store($object) {
        //$PM=static::getInstance();  //
        $classe_entity = get_class($object);
        $classe_foundation = str_replace("E", "F", $classe_entity);
        $classe_foundation::store($object);
    }

    public static function delete($field,$value,$Fclass) {
        $Fclass::delete($field,$value);  //
    }

    public static function exist($field, $value ,$Fclass) {
        $esiste = null;
        $esiste = $Fclass::exist($field,$value);
        return $esiste;
    }

    public static function load($field, $value,$Fclass) {
        $result = null;
        $result = $Fclass::load($field,$value);
        return $result;
    }


    /** Metodo che permette l'aggiornamento del valore di un campo passato per parametro */
    public static function update($field, $newValue, $keyField, $idValue ,$Fclass) {
        $result = null;
       // if ($Fclass == "FAnnuncio" || $Fclass == "FMezzo" || $Fclass == "FTappa" || $Fclass == "FTrasportatore" || $Fclass == "FUtenteloggato" || $Fclass == "FCliente")
            $ris = $Fclass::update($field, $newValue, $keyField, $idValue);
        //else
           // print ("METODO NON SUPPORTATO DALLA CLASSE");
        return $result;
    }

    public static function searchVinyl ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo) {
        $search = null;
        $search = FVinile::searchVinyl ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo);
        return $search;
    }

    //carica tutte le recensioni per l admin
    public function adminAllReviews(){
        $rec=NULL;
        $rec=FRecensione::adminAllReviews();
        return $rec;
    }




}