<?php


class CVinile
{
    /**
     * Metodo per il caricamento della vetrina del negozio
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


/*
    static function pubblica()
    {
        //$sessione = Session::getInstance();
        //if ($sessione->isLoggedUtente()) {
            $view = new VVinile();
        $sessione = Session::getInstance();
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if ($sessione->isLoggedUtente()) {
                $utente=$sessione->getUtente();
                //$utente = unserialize($_SESSION['utente']);
                    $view->showFormCreation($utente,null);
                }else
                    header('Location: /vinylwebmarket/User/login');
            } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
                $pm = new FPersistentManager();
               // $utente = unserialize($_SESSION['utente']);
                $utente=$sessione->getUtente();
                //new EUtente_loggato($vend->getUsername(), $vend->getEmail(), $vend->getPassword(), $vend->getPhone());
                $utente_log=new EUtente_loggato($utente->getUsername(), $utente>getEmail(), $utente->getPassword(), $utente->getPhone());
                                $new_vinile = new EVinile($utente_log, $_POST['titolo'], $_POST['artista'], $_POST['genere'],$_POST['artista'], $_POST['numerogiri'], $_POST['condizioni'], $_POST['prezzo'],$_POST['descrizione'],$_POST['quantita']);
                                list ($stato, $nome, $type) =  uploadImg('file');
                                list ($stato_1, $nome_1, $type_1) =uploadImg('file_1');
                                list($fun, $idAn) = static::test_img($stato, $nome, $type, $stato_1, $nome_1, $type_1, $new_vinile);
                                if ($fun == "type")
                                    $view->showFormCreation($utente, "type");
                                elseif ($fun == "size")
                                    $view->showFormCreation($utente, "size");
                                elseif ($fun == "ok") {
                                    $view->showFormCreation($utente, "no");
                                }
                            }
                        }

                        */
                     /*else {
                        if ($ver_luogo_part == true && $ver_luogo_arr == true) {
                            $new_annuncio = new EAnnuncio($_POST['data_p'], $_POST['data_arr'], $_POST['dim'], $ver_luogo_part, $ver_luogo_arr, $_POST['peso'], $_POST['desc'], $utente);
                            $new_annuncio->setVis();
                            list ($stato, $nome, $type) = static::upload('file');
                            list ($stato_1, $nome_1, $type_1) = static::upload('file_1');
                            list($fun, $idAn) = static::test_img($stato, $nome, $type, $stato_1, $nome_1, $type_1, $new_annuncio);
                            if ($fun == "type")
                                $view->showFormCreation($utente, "type");
                            elseif ($fun == "size")
                                $view->showFormCreation($utente, "size");
                            elseif ($fun == "ok") {
                                $view->showFormCreation($utente, "no");
                            }
                        } else {
                            $view->showFormCreation($utente, "no_part_arrivo");
                        }
                    }
}*/

    /**
     * Funzione che si preoccupa di verificare lo stato dell'immagine inserita
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
     * @param $stato stato prima immagine
     * @param $nome nome prima immagine
     * @param $type MIME type prima immagine
     * @param $stato_1 stato seconda immagine
     * @param $nome_1 nome immagine
     * @param $type_1 MIME type seconda immagine
     * @param $new_annuncio annuncio da salvare nel databse
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

    public function pubblica()
    {
        //$sessione = Session::getInstance();
        //if ($sessione->isLoggedUtente()) {
        $view = new VVinile();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                $utente=$sessione->getUtente();
                //$utente = unserialize($_SESSION['utente']);
                $view->formVinile($utente,null);
            }else
                header('Location: /vinylwebmarket/User/login');
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $pm = new FPersistentManager();
            // $utente = unserialize($_SESSION['utente']);
            $utente=$sessione->getUtente();
            //new EUtente_loggato($vend->getUsername(), $vend->getEmail(), $vend->getPassword(), $vend->getPhone());
            $utente_log=new EUtente_loggato($utente->getUsername(),$utente->getEmail(), $utente->getPassword(), $utente->getPhone());
            //function __construct(EUtente_loggato $vend, $tit, $art, $gen, $ng, $cond, $pr, $des, $quan)
            $new_vinile = new EVinile($utente_log, $_POST['titolo'], $_POST['artista'], $_POST['genere'], $_POST['numerogiri'], $_POST['condizioni'], $_POST['prezzo'], $_POST['descrizione'], $_POST['quantita'],);
            list ($stato, $nome, $type,$data) =static::uploadImg('file');
            list ($stato_1, $nome_1, $type_1,$data_1) =static::uploadImg('file_1');
            list($fun, $idAn) = static::test_img($stato, $nome, $type,$data, $stato_1, $nome_1, $type_1,$data_1, $new_vinile);
            if ($fun == "type")
                $view->formVinile($utente, "type");
            elseif ($fun == "size")
                $view->formVinile($utente, "size");
            elseif ($fun == "ok") {
                $view->formVinile($utente, "no");
            }
        }
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
                header('Location: /FillSpaceWEB/Utente/login');
        }
    }

    /**
     * Funzione che viene invocata nel momento in cui si modificano i valori dell'annuncio
     * 1) se il metodo di richiesta HTTP è POST e si è loggati come trasportatore, si applicano le modifiche all'annuncio;
     * 2) se il metodo di richiesta HTTP è GET e non si è loggati come trasportatori, avviene il reindirizzamento alla pagina del prorpio profilo;
     * 3) se non si è loggati, si viene reindirizzati alla form di login.
     */
    static function AggiornaVinile()
    {
        $view = new VVinile();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                $pm = new FPersistentManager();
                /*
                if (CUtente::isLogged()) {
                    $view = new VGestioneAnnunci();
                    $pm = new FPersistentManager();
                    $vistaProfilo = new VUtente();
                    $peso = $view->getPeso();
                    $spazio = $view->getSpazio();
                */
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
     * funzione per eliminare Vinili nella sezione per la gestione dei vinili
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

                /*
            if (get_class($utente) == "ECliente") {
                header('Location: /FillSpaceWEB/Utente/profile');
            } else {
                header('Location: /FillSpaceWEB/Utente/profile');
            }
                */
        }
        else
            header('Location: /vinylwebmarket/User/login');
    }



}