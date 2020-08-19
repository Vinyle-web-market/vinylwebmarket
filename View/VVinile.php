<?php


class VVinile
{
    private $smarty;

    public function __construct()
    {
        //FARE IL FILE DI CONFIGURAZIONE StartSmarty.php(mettere fuori dalle cartelle?)
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Vetrina Negozio.
     * @param $result contiene i vinili
     * @param $img un'immagine per vinile
     * @throws SmartyException
     */
    public function Vetrina($result,$img,$imgP){
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
            $this->smarty->assign('userlogged',"loggato");
        //echo "<hr>";
       // echo "<hr>";
        //var_dump($img);

        if (isset($img)) {
            if (is_array($img)) {
                    foreach ($img as $it) {
                        foreach($it as $item)
                        if (isset($item)) {
                            $pic64[] = $item->getDataImage();
                            $type[] = $item->getMimeType();
                        }
                    }
                $this->smarty->assign('n_vinili', count($img)-1 );
            }
            elseif (isset($img)) {
                $pic64 = $img->getDataImage();
                $type = $img->getMimeType();
                $this->smarty->assign('n_vinili', 1);
            }
        }
        else
            $this->smarty->assign('n_vinili', 0);

        if (isset($imgP)) {
            if (is_array($imgP)) {
                foreach ($imgP as $it) {
                    foreach($it as $item)
                        if (isset($item)) {
                            $pic64P[] = $item->getDataImage();
                            $typeP[] = $item->getMimeType();
                        }
                }
            }
            elseif (isset($imgP)) {
                $pic64P = $imgP->getDataImage();
                $typeP = $imgP->getMimeType();
            }
        }


        $this->smarty->assign('vinili', $result);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('typeP', $typeP);
        $this->smarty->assign('pic64P', $pic64P);
        $this->smarty->display('vetrina_vinili.tpl');
    }

    /**
     * Metodo richiamato quando un cliente o un trasportatore creano un annuncio.
     * In caso di errori nella compilazione dei campi dell'annuncio, verrà ricaricata la stessa pagina con un messaggio esplicativo
     * dell'errore commesso in fase di compilazione.
     * @param $utente oggetto utente che effettua l'inserimento dei dati nei campi dell'annuncio
     * @param $error codice di errore con svariati significati. In base al suo valore verrà eventualmente visualizzato un messaggio
     * di errore nella pagina di creazione dell'annuncio
     * @throws SmartyException
     */
    public function formVinile($user,$error)
    {
            switch ($error) {
                case "type" :
                    $this->smarty->assign('errorType', "errore");
                    break;
                case "size" :
                    $this->smarty->assign('errorSize', "errore");
                    break;
                case "no" :
                    $this->smarty->assign('successo', "si");
                    break;
            }
            $this->smarty->assign('username', $user->getUsername());
            $this->smarty->assign('email', $user->getEmail());
            $this->smarty->assign('userlogged', "loggato");;
            $this->smarty->display('vendita_vinile.tpl');

    }

    /**
     * showDetails claudia,$result è il vinile
     * Mostra la pagina contenente i dettagli dell'annuncio selezionato
     * @param array contiene l'id dell'array da visualizzare
     * @param $tipo definisce il tipo di annuncio da visualizzare (carichi/trasporti)
     * @throws SmartyException
     *
     */
    public function dettagliVinile($result, $nome, $cognome,$nomenegozio,$indirizzo,$partitaiva,$username,$email,$telefono,$img_utente,$med_annuncio,$cont) {

        if ($cont == "no")
            $this->smarty->assign('contatta', $cont);

        if (is_array($med_annuncio)) {
            foreach ($med_annuncio as $item) {
                $pic64Vin[] = $item->getDataImage();
                $typeVin[] = $item->getMimeType();
            }
        }
        elseif (isset($med_annuncio)) {
            $pic64Vin = $med_annuncio->getDataImage();
            $typeVin = $med_annuncio->getMimeType();
        }
        if (isset($med_annuncio)) {
            if (is_array($med_annuncio)) {
                $this->smarty->assign('typeVin', $typeVin);
                $this->smarty->assign('pic64Vin', $pic64Vin);
                $this->smarty->assign('n_img_annuncio', 2);
            }
            else {
                $this->smarty->assign('typeVin', $typeVin);
                $this->smarty->assign('pic64Vin', $pic64Vin);
                $this->smarty->assign('n_img_annuncio', 1);
            }
            //$this->smarty->assign('n_img_annuncio', count($med_annuncio) - 1);
        }
        else
            $this->smarty->assign('n_img_annuncio', 0);

        $this->smarty->assign('media_ann', $med_annuncio);
        list($type,$pic64) = VUser::setImage($img_utente, 'user');
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);

        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
            $this->smarty->assign('userlogged',"loggato");

        $this->smarty->assign('ris', $result);

        $this->smarty->assign('username', $username);
        $this->smarty->assign('email', $email);
        $this->smarty->assign('telefono', $telefono);

        if(!$nome)
            $this->smarty->assign('nome', $nome);
        if(!$cognome)
           $this->smarty->assign('cognome', $cognome);
        if(!$nomenegozio)
            $this->smarty->assign('nomenegozio', $nomenegozio);
        if(!$indirizzo)
            $this->smarty->assign('indirizzo', $indirizzo);
        if(!$partitaiva)
            $this->smarty->assign('partitaiva', $partitaiva);

            $this->smarty->display('dettagliVinile.tpl');
        }

    /**
     * Funzione che si occupa di gestire la visualizzazione della form di modifica per il cliente
     * @param $user informazioni sull'utente che desidera mdificare i suoi dati
     * @param $img immagine dell'utente
     * @param $error tipo di errore nel caso in cui le modifiche siano sbagliate
     * @throws SmartyException
     */
    public function formModificaVinile($vinile, $image, $errore) {
        switch ($errore) {
            /* FARE TUTTI CONTROLLI PER DELLE MODIFICHE CORRETTE COME NEL CASO PROFILO UTENTE
            case "errorEmail" :
                $this->smarty->assign('errorEmail', "errore");
                break;
            case "ErrorEmailInput" :
                $this->smarty->assign("errorEmailInput","errore");
                break;
            case "errorPassword":
                $this->smarty->assign('errorPassword', "errore");
                break;
            case "errorSize" :
                $this->smarty->assign('errorSize', "errore");
                break;
            case "errorType" :
                $this->smarty->assign('errorType', "errore");
                break;
            */
        }

        if (isset($img)) {
            $pic64 = base64_encode($img->getDataImage());
        }
        else {
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
        }
        $this->smarty->assign('vinile',$vinile);
        $this->smarty->display('formModificaVinile.tpl');
    }





}