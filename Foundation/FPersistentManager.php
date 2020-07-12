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
        $id=$classe_foundation::store($object);
        return $id;

    }

    public static function storeImg(EImage $media){
        $result=null;
        $fclass='FImage';
        $result=$fclass::storeI($media);
        return $result;
    }

    public static function delete($field,$value,$Fclass) {
        $Fclass::delete($field,$value);  //
    }

    public static function deleteImg(string $categoriaImage,$field, $id){
        $result=null;
        $fclass='FImage';
        $result=$fclass::deleteI($categoriaImage,$field,$id);
        return $result;
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

    public static function loadImg(string $categoriaImage,$field,$id){
        $result=null;
        $fclass='FImage';
        $result=$fclass::loadI($categoriaImage,$field,$id);
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

    public static function loginUtente ($email, $pass) {
        $ris = null;
        $ris = FUtente_loggato::login($email, $pass);
        return $ris;
    }

    public function vinylHome(){
        $ris=null;
        $ris=FVinile::loadSixVinyls();
        return $ris;
    }



}