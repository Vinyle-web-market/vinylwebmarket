<?php

/**
 * Classe Per la gestione dell'elemento chiave del nostro sito,IL VINILE:
 * FUNZIONI:
 *        -attività utente:  pagina di gestione,pubblicazione,modifica quantità,eliminazione dei vinili;
 *        -supporto utente:  memorizzazione della storia dei vinili visitati;
 *        -presentazione vetrine: vetrina sito,vetrina di un dato utente
 *
 */


class CVinile
{

    /**
 * Funzione che si preoccupa di verificare lo stato dell'immagine inserita
     * supporto a pubblica()
 */
    static function uploadImg($nome_file)
    {
        $ris = "no_img";
        $type = null;
        $nome = null;
        $data=null;
        $max_size = 300000;
        $result = is_uploaded_file($_FILES[$nome_file]['tmp_name']);
        if (!$result) {
            $ris = "no_img";
        } else {
            $size = $_FILES[$nome_file]['size'];
            //$type = $_FILES[$nome_file]['type'];
            if ($size > $max_size) {
                $ris = "size";
            } else {
                $type = $_FILES[$nome_file]['type'];
                $img = $_FILES["file"];
                //$data=file_get_contents($_FILES[$nome_file]["tmp_name"]);
               // $data=base64_decode($data);
                if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
                    $nome = $_FILES[$nome_file]['name'];
                    $data = $_FILES[$nome_file]['tmp_name'];
                    //$immagine = file_get_contents($_FILES[$nome_file]['tmp_name']);
                    //$immagine = addslashes($immagine);
                    $ris = "ok_img";
                } else {
                    $ris = "type";
                }
            }
        }
        return array($ris, $nome, $type,$data);
    }

    /**
     * Funzione di supporto che gestisce le varie combinazioni tra le due immagini selezioate nella pubblicazione del vinile
     * supporto a pubblica()
     * @param $stato stato prima immagine
     * @param $nome nome prima immagine
     * @param $type MIME type prima immagine
     * @param $stato_1 stato seconda immagine
     * @param $nome_1 nome immagine
     * @param $type_1 MIME type seconda immagine
     * @param $new_annuncio annuncio da salvare nel database
     * @return array $ris risultato dell'operazione, $idAd id annuncio aggiunto
     */
    static function test_img ($stato,$nome,$type,$data,$stato_1,$nome_1,$type_1,$data_1,$new_vinile) {
        $pm = new FPersistentManager();
        $ris = null;
        $idAn = null;
        if ($stato == "type" || $stato_1 == "type")
            $ris = "type";
        elseif ($stato == "size" || $stato_1 == "size")
            $ris = "size";
        elseif ($stato == "no_img" && $stato_1 == "no_img") {
            $idAn = $pm->store($new_vinile);
            $ris = "ok";
        }
        elseif ($stato == "ok_img" && $stato_1 == "no_img") {
            //public function __construct($fname, $data, $type,$id)
            $idAn = $pm->store($new_vinile);
            $m_vinile = new EImageVinile($nome,$data,$type,$idAn);
            $pm->storeImg($m_vinile);
            $ris = "ok";
        }
        elseif ($stato == "no_img" && $stato_1 == "ok_img") {
            $idAn = $pm->store($new_vinile);
            $m_vinile = new EImageVinile($nome_1,$data_1,$type_1,$idAn);
            $pm->storeImg($m_vinile);
            $ris = "ok";
        }
        elseif ($stato == "ok_img" && $stato_1 == "ok_img") {
            $idAn = $pm->store($new_vinile);
            $m_vinile1 = new EImageVinile($nome_1,$data_1,$type_1,$idAn);
            $r=$pm->storeImg($m_vinile1);
            $m_vinile = new EImageVinile($nome,$data,$type,$idAn);
            $pm->storeImg($m_vinile);
            $ris = "ok";
        }
        return array ($ris,$idAn);
    }


    /**
     * Pubblicazione dell'annuncio da parte dell'utente:
     * GET:
     *   -se non si è loggati si rimanda al login
     *   -se l'utente è loggato si viene reindirizzati alla form per la pubblicazione del vinile
     * POST:
     *    1)l'utente PRIVATO non può pubblicare piu di 3 vinili->segnalazione se ha già 3 Annunci vinile
     *    2)l'utente NEGOZIO può pubblicare quanti vinili vuole a patto che il suo abbonamneto sia attivo
     *      altrimenti ha le stesse limitazioni del privato
     *      INPUTCONTROL:viene effettuato sempre un controllo sulla validità dei formati prezzo,quantità ecc.....
     *     il test per le IMG è fatto con funzioni di supporto,prima uploadImg() e testImg() poi...
     */
    public function pubblica()
    {
        $view = new VVinile();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                $utente=$sessione->getUtente();
                $view->formVinile($utente,null);
            }else
                header('Location: /vinylwebmarket/User/login');
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pm = new FPersistentManager();
            $input = EInputControl::getInstance();
            $utente=$sessione->getUtente();
            $tipo=get_class($utente);
            if($tipo=='EPrivato' && self::contaVinili($utente)==1){
                $view->formVinile($utente,'limite');
            }
            elseif ($tipo=='ENegozio' && self::contaVinili($utente)==1 && $utente->getAbbonamento()->isStato()==0){
                 $view->formVinile($utente,'limite');
                }
            else {
                $utente_log = new EUtente_loggato($utente->getUsername(), $utente->getEmail(), $utente->getPassword(), $utente->getPhone());
                $new_vinile = new EVinile($utente_log, $_POST['titolo'], $_POST['artista'], $_POST['genere'], $_POST['numerogiri'], $_POST['condizioni'], $_POST['prezzo'], $_POST['descrizione'], $_POST['quantita']);
                $err = $input->validVinile($new_vinile);
                if ($err) {
                    $view->formVinile($utente, $err);
                } else {
                    list ($stato, $nome, $type, $data) = static::uploadImg('file');
                    list ($stato_1, $nome_1, $type_1, $data_1) = static::uploadImg('file_1');
                    list($fun, $idAn) = static::test_img($stato, $nome, $type, $data, $stato_1, $nome_1, $type_1, $data_1, $new_vinile);
                    if ($fun == "type")
                        $view->formVinile($utente, "type");
                    elseif ($fun == "size")
                        $view->formVinile($utente, "size");
                    elseif ($fun == "ok") {
                        $view->formVinile($utente, "no");
                    }
                }
            }
        }
    }

    /**
     * Funzione di supporto a pubblica per contare il numero di vinili in vendita
     * @param $id id dell'annuncio selezionato
     */
    static function contaVinili($utente){
        $pm=new FPersistentManager();
        $vinili=$pm->load('venditore', $utente->getEmail(), 'FVinile');
            if (is_array($vinili) && count($vinili)>2){
                return 1;
            }
            else return 0;
    }




    /**
     * Metodo per il caricamento della vetrina del negozio
     * carica tutti i vinili con visibilità ad 1
     * sfrutta la funzione di CFiltro ImageVynils per l associazione delle immagini per ogni vinile
     */
    static function Vetrina (){
        $view = new VVinile();
        $pm = new FPersistentManager();
        //public static function load($field, $value,$Fclass) {
        $result = $pm->load("visibility",1,"FVinile");
        //fare la funzione per le immagini vinili,simile imageReviews in Cuser
        $img=CFiltro::ImageVinyls($result);     //img anteriori
        $imgP=CFiltro::ImageVinyls2($result);//img posteriori
        $view->Vetrina($result,$img,$imgP);
    }

    /**
     * Funzione con il compito di indirizzare alla pagina pagina specifica dell'annuncio selezionato
     * @param $id id dell'annuncio selezionato
     */
    static function dettagliVinile($id){
        $nome = null;
        $cognome=null;
        $nomenegozio=null;
        $indirizzo=null;
        $partitaiva=null;
        $view = new VVinile();
        $pm = new FPersistentManager();
        //ublic static function load($field, $value,$Fclass) {
        $result = $pm->load("id_vinile", $id, "FVinile");
        $sessione=Session::getInstance();
        $sessione->setVinile($result);
        if(get_class($result->getVenditore())=="EPrivato") {
            $nome = $result->getVenditore()->getNome();
            $cognome = $result->getVenditore()->getCognome();
        }elseif(get_class($result->getVenditore())=="ENegozio"){
            $nomenegozio= $result->getVenditore()->getNameShop();
            $indirizzo=$result->getVenditore()->getAddress();
            $partitaiva=$result->getVenditore()->getPIva();
        }
        $username = $result->getVenditore()->getUsername();
        $email = $result->getVenditore()->getEmail();
        $telefono = $result->getVenditore()->getPhone();
        //public static function loadImg(string $categoriaImage,$field,$id){
        $img_utente = $pm->loadImg("EImageUtente","email_utente",$result->getVenditore()->getEmail());
        $id = $result->getId();
        $med_annuncio = $pm->loadImg("EImageVinile","id_vinile",$id);
        $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
            //$utente = unserialize($_SESSION['utente']);
            if ($result->getVenditore()->getEmail() == $utente->getEmail())
                $view->dettagliVinile($result, $nome, $cognome,$nomenegozio,$indirizzo,$partitaiva,$username,$email,$telefono,$img_utente,$med_annuncio,"no");
            else
                $view->dettagliVinile($result, $nome, $cognome,$nomenegozio,$indirizzo,$partitaiva,$username,$email,$telefono,$img_utente,$med_annuncio,"si");
        }
        else
            $view->dettagliVinile($result, $nome, $cognome,$nomenegozio,$indirizzo,$partitaiva,$username,$email,$telefono,$img_utente,$med_annuncio,"si");
    }
    /**
     * Funzione che permette la modifica di un vinile già pubblicato dall'utente.
     * - metodo GET e si è loggati:si viene indirizzati alla form per scegliere le modofiche da apportare;
     *                            se  non si è loggati, avviene il reindirizzamento verso la form di login.
     * @param $id id del vinile che si vuol modificare
     */
    /*
    static function modificaVinile($id)
    {
        $pm = new FPersistentManager();
        $view = new VVinile();
        $img=null;
        $errore=null;
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                $vinile = $pm::load("id_vinile", $id, "FVinile");
                $view->modificaFormVinile($vinile,$img,$errore);
            } else
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }
    */

    /**
     * Funzione che apre una pagina per la gestione dei vinili pubblicati da un utente
     * - metodo GET e si è loggati:si viene indirizzati alla pagina di gestione;
     *                            se  non si è loggati, avviene il reindirizzamento verso la form di login.
     * @param $venditore email del venditore in questione
     */
    static function MieiVinili($venditore)
    {
        $pm = new FPersistentManager();
        $view = new VVinile();
        $img=null;
        $errore=null;
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                $vinili = $pm->load("venditore", $venditore, "FVinile");
                $img=CFiltro::ImageVinyls($vinili);
                $view->ModificaVinile($vinili,$img,null);
            } else
                header('Location: /vinylwebmarket/User/login');
        }
    }

    /**
     * funzione per confermare la modifica della quantità in seguito ad accordi raggiunti o nuovi arrivi
     *  se il metodoPOST :
     *       -se non si è loggati, si viene reindirizzati alla form di login.
     *       -se loggati effetua l'aggiornamento della quantità
     */
    static function AggiornaVinile()
    {
        $view = new VVinile();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                $pm = new FPersistentManager();
                $id=$_POST['id'];
                $q = $_POST['quantità'];
                $pm->update("quantita", $q, "id_vinile", $id, "FVinile");
                $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                $img=CFiltro::ImageVinyls($vinili);
                //serve èer segnalare la corretta modifica delle quantita "modifica"
                $view->ModificaVinile($vinili,$img,"modifica");
            } else
                header('Location: /vinylwebmarket/User/login');
        } else
            header('Location: /vinylwebmarket/User/profile');
    }


    /**
     * Tramite Post e loggati:
     * funzione per eliminare Vinili nella sezione di gestione dei vinili
     * @param $id id dell'annuncio da eliminare
     */
    static function EliminaVinile($id) {
        $view = new VVinile();
        $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
            $pm = new FPersistentManager();
            $pm->delete("id_vinile", $id, "FVinile");
                $utente = $sessione->getUtente();
                $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                $img=CFiltro::ImageVinyls($vinili);
                //serve a segnalare la corretta eliminazione del vinile
                $view->ModificaVinile($vinili,$img,"eliminazione");
        }
        else
            header('Location: /vinylwebmarket/User/login');
    }

    /**
     * funzione di supporto alla memoria dell'utente:
     * viene tenuta traccia dei vinili a cui l'utente ha mostrato attenzione nella sessione
     * La funzione CFiltro ca messa in una CUtility e usarla da là
     */
    static function UltimiViniliCercati (){
        $view = new VVinile();
        $pm = new FPersistentManager();
        $sessione = Session::getInstance();
        if($sessione->isLoggedUtente()) {
            $result = $sessione->getVinile();
            $img = CFiltro::ImageVinyls($result);     //img anteriori
            $imgP = CFiltro::ImageVinyls2($result);//img posteriori
            $view->Vetrina($result, $img, $imgP);
        }
        else
            header('Location: /vinylwebmarket/User/login');
    }

    /**
     * se loggati:
     * funzione che mostra in vetrina i vinili di un utente visitato
     */
    static function VetrinaUtenteVisitato (){
        $view = new VVinile();
        $pm = new FPersistentManager();
        $sessione = Session::getInstance();
        if($sessione->isLoggedUtente()) {
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $email=$_POST["email_venditore"];
                //$result = $pm->load("venditore",$email,"FVinile");
                $result = $pm->loadViniliAttivi($email);
                $img = CFiltro::ImageVinyls($result);     //img anteriori
                $imgP = CFiltro::ImageVinyls2($result);//img posteriori
                $view->Vetrina($result, $img, $imgP);
            }
            else
                header('Location: /vinylwebmarket/User/profile');
        }
        else
            header('Location: /vinylwebmarket/User/login');
    }










}