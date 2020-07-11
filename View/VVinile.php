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
                $pic64ann[] = base64_encode($item->getDataImage());
                $typeA[] = $item->getMimeType();
            }
        }
        elseif (isset($med_annuncio)) {
            $pic64ann = base64_encode($med_annuncio->getDataImage());
            $typeA = $med_annuncio->getMimeType();
        }
        if (isset($med_annuncio)) {
            if (is_array($med_annuncio)) {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64ann', $pic64ann);
                $this->smarty->assign('n_img_annuncio', count($med_annuncio) - 1);
            }
            else {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64ann', $pic64ann);
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

            $this->smarty->display('dettagliVinyl.tpl');
        }





}