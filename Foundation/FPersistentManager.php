<?php
/**
 * La classe FPersistentManager si presenta come interfaccia fra le classi del package Foundation e le
 * classi Controller che la interrogano per effettuare le operazioni CRUD sul database.
 * @access public
 * @author Cruciani - Nanni - Scarselli
 * @package Foundation
 */

class FPersistentManager
{
    private static $instance = null;

    /**
     * funzione che ritorna l istanza del persistence manager
     * @return null
     */

    public static function getInstance()
    {
        if(static::$instance==null)
        {
            static::$instance=new FPersistentManager();
        }
        return static::$instance;
    }

    public function __construct() {}

    /**
     * Metodo che permette di salvare un oggetto sul db
     */

    public static function store($object)
    {
        //$PM=static::getInstance();  //
        $classe_entity = get_class($object);
        $classe_foundation = str_replace("E", "F", $classe_entity);
        $id=$classe_foundation::store($object);
        return $id;
    }

    /**
     * Metodo che permette di salvare un oggetto EImage sul db
     */

    public static function storeImg(EImage $media)
    {
        $result=null;
        $fclass='FImage';
        $result=$fclass::storeI($media);
        return $result;
    }

    /**
     * Funzione che permette di eliminare un oggetto dal DB dato un valore ed una colonna.
     */

    public static function delete($field,$value,$Fclass)
    {
        $Fclass::delete($field,$value);
    }

    /**
     * Funzione che permette di eliminare un oggetto EImage dal DB dato la categoria dell'immagine,un valore ed una colonna.
     */

    public static function deleteImg(string $categoriaImage,$field, $id)
    {
        $result=null;
        $fclass='FImage';
        $result=$fclass::deleteI($categoriaImage,$field,$id);
        return $result;
    }

    /**
     * Metodo che accerta l'esistenza di un valore di un campo passato come parametro
     */

    public static function exist($field, $value ,$Fclass)
    {
        $esiste = null;
        $esiste = $Fclass::exist($field,$value);
        return $esiste;
    }

    /**
     * Metodo che permette di caricare un oggetto con un valore passato come parametro di una determinata colonna
     */

    public static function load($field, $value,$Fclass)
    {
        $result = null;
        $result = $Fclass::load($field,$value);
        return $result;
    }

    /**
     * Metodo che permette di caricare solo vimnili attvi di un venditore con email passata in input
     */

    public static function loadViniliAttivi($email)
    {
        $result = null;
        $Fclass="FVinile";
        $result = $Fclass::loadVinAtt($email);
        return $result;
    }

    /**
     * Metodo per caricare oggetti Eimage
     */

    public static function loadImg(string $categoriaImage,$field,$id)
    {
        $result=null;
        $fclass='FImage';
        $result=$fclass::loadI($categoriaImage,$field,$id);
        return $result;
    }

    /**
     * Metodo per caricare 1 oggetto EimageVinile,foto pricipale
     */

    public static function loadImg2(string $categoriaImage,$field,$id)
    {
        $result=null;
        $fclass='FImage';
        $result=$fclass::loadI1($categoriaImage,$field,$id);
        return $result;
    }

    /**
     * Metodo per caricare 1 oggetto EimageVinile, ma in questo la foto posteriore
     */

    public static function loadImgP2(string $categoriaImage,$field,$id)
    {
        $result=null;
        $fclass='FImage';
        $result=$fclass::loadI2($categoriaImage,$field,$id);
        return $result;
    }

    /**
     * Metodo che permette l'aggiornamento del valore di un campo passato per parametro
     */

    public static function update($field, $newValue, $keyField, $idValue ,$Fclass)
    {
        $result = null;
        $result = $Fclass::update($field, $newValue, $keyField, $idValue);
        return $result;
    }

    /**
     * Metodo che permette il caricamento vinili che rispettano 6 i parametri passati in input alla funzione
     * @param $titolo nome del vinile che si sta cerando
     * @param $artista nome dell'artista del vinile
     * @param $genere tipologia musicale del vinile
     * @param $ngiri caratteristica tecnica del vinile
     * @param $condizioni caratteristica tecnica del vinile
     * @param $prezzo caratteristica tecnica del vinile
     */

    public static function searchVinyl ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo)
    {
        $search = null;
        $search = FVinile::searchVinyl ($titolo, $artista, $genere, $ngiri, $condizioni, $prezzo);
        return $search;
    }

    /**
     * Metodo che permette di caricare tutte le recensioni, in assoluto, presenti nel database.
     */

    public function adminAllReviews()
    {
        $rec=NULL;
        $rec=FRecensione::adminAllReviews();
        return $rec;
    }

    /**
     * Metodo per controllare la vera presenza si email e password di un utente che tenta di loddarsi
     * se ha successo la funzione restiruisce un oggetto utente
     * @param $email stringa con cui si effettua / verifica l'accesso.
     * @param $pass (password) con si effettua / verifica l'accesso.
     */

    public static function loginUtente ($email, $pass)
    {
        $ris = null;
        $ris = FUtente_loggato::login($email, $pass);
        return $ris;
    }

    /**
     * funzione per caricare gli ultimi 6 vinili e presentarli come novità nel carosello sulle homepage
     */

    public function vinylHome()
    {
        $ris=null;
        $ris=FVinile::loadSixVinyls();
        return $ris;
    }

    /**
     * PER LE RECENSIONI:
     * Metodo che permette il caricamento delle sole tuple che abbiano in un loro campo una parola data in input
     *  @param parola da cercare nell'area di testo
     */

    public static function searchWords($parola)
    {
        $ris = null;
        $ris = FRecensione::ricercaParola($parola);
        return $ris;
    }

    /**
     * PER I VINILI
     * Metodo che permette il caricamento delle sole tuple che abbiano nel campo titolo una stringa/sottostringa data in input
     *  @param parola da cercare nell'area di testo
     */

    public static function ricercaVinili($parola)
    {
        $ris = null;
        $ris = FVinile::ricercaParola($parola);
        return $ris;
    }

    /**
     * Metodo che permette il caricamento delle sole tuple che abbiano nel campo $field una stringa/sottostringa data in input come $parola
     *  @param parola da cercare nell'area di testo
     */

    public static function cercaViniliCampo($parola,$field)
    {
        $ris = null;
        $ris = FVinile::ricercaParolaCampo($parola,$field);
        return $ris;
    }

    /**
     * PER GLI UTENTI
     * Metodo che permette il caricamento delle sole tuple che abbiano in un loro campo una parola data in input
     *  @param parola da cercare nell'area di testo
     */

    public static function searchUtenti($parola)
    {
        $ris = null;
        $ris = FUtente_loggato::ricercaParola($parola);
        return $ris;
    }

    /**
     * Metodo che permette il caricamento dei messaggi per andare ad instaurare una conversazione
     *  @param $email mittente
     * @param $email2 destinatario
     */

    public static function caricaChats($email, $email2)
    {
        $ris = null;
        $ris = FMessaggio::loadChats($email,$email2);
        return $ris;
    }

    /**
     * Metodo che permette il caricamento di tutte le conversazioni
     * dell'utente (con cui si è loggati) e gli altri utenti del sito.
     *  @param $email utente con cui si è loggati;
     * @param $email2 altro utente del sito.
     */

    public static function elenco_Chats($email, $email2)
    {
        $ris = null;
        $ris = FMessaggio::elencoChats($email,$email2);
        return $ris;
    }

}