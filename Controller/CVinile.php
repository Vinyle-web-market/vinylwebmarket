<?php


class CVinile
{


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
                                $new_vinile = new Evinile($utente_log, $_POST['titolo'], $_POST['artista'], $_POST['genere'],$_POST['artista'], $_POST['numerogiri'], $_POST['condizioni'], $_POST['prezzo'],$_POST['descrizione'],$_POST['quantita']);
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
                $data = file_get_contents($img["tmp_name"]);
                $data = base64_encode($data);
                if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
                    $nome = $_FILES[$nome_file]['name'];
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
     * Funzione di supporto che gestisce le varie combinazioni tra le due immagini selezioate nella pubblicazione dell'annuncio
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
            $pm->storeImage($m_vinile,'file');
            $ris = "ok";
        }
        elseif ($stato == "no_img" && $stato_1 == "ok_img") {
            $idAn = $pm->store($new_vinile);
            $m_vinile = new EImageVinile($nome_1,$data_1,$type_1,$idAn);
            $pm->storeMedia($m_vinile,'file_1');
            $ris = "ok";
        }
        elseif ($stato == "ok_img" && $stato_1 == "ok_img") {
            $idAn = $pm->store($new_vinile);
            $m_vinile1 = new EImageVinile($nome_1,$data_1,$type_1,$idAn);
            $pm->storeMedia($m_vinile1,'file_1');
            $m_vinile = new EImageVinile($nome,$data,$type,$idAn);
            $pm->storeMedia($m_vinile,'file');
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
            $utente_log=new EUtente_loggato($utente->getUsername(), $utente>getEmail(), $utente->getPassword(), $utente->getPhone());
            $new_vinile = new Evinile($utente_log, $_POST['titolo'], $_POST['artista'], $_POST['genere'],$_POST['artista'], $_POST['numerogiri'], $_POST['condizioni'], $_POST['prezzo'],$_POST['descrizione'],$_POST['quantita']);
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



}