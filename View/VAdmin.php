<?php


class VAdmin
{
    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Restituisce l'email dell'utente da bannare/riattivare
     * Inviato con metodo post
     * @return string contenente l'email dell'utente
     */

    function getEmail()
    {
        $value = null;
        if (isset($_POST['email']))
            $value = $_POST['email'];
        return $value;
    }

    /**
     * Restituisce l'id della recensione da eliminare
     * Inviato con metodo post
     * @return string contenente l'id della recensione
     */

    function getId()
    {
        $value = null;
        if (isset($_POST['valore']))
            $value = $_POST['valore'];
        return $value;
    }

    /** Funzione che ci permette di mostrare la tipologia di errore che possono avvenire all'interno del sito (principalmente error 401 e 404)
     * @param $caso mostra il tipo di errore da mostrare
     * @throws SmartyException
     */

    public function errore($caso)
    {
        $this->smarty->assign('caso', $caso);
        switch ($caso)
        {
            case 1 :
                $this->smarty->assign('testo', 'Autorizzazione necessaria.');    //altrimenti sostituire con una stringa che ne indica il caso
                break;
            case 4 :
                $this->smarty->assign('testo', 'La URL richiesta non esiste/non è stata trovata su questo server.');    //altrimenti sostituire con una stringa che ne indica il caso
                break;
        }
        $this->smarty->display('error404.tpl');
    }

    /**
     * Funzione che permette di visualizzare la pagina home dell'admin (contenente tutti gli utenti della piattaforma), divisi in: utenti attivi e bannati.
     * @param $utentiAttivi array di utenti attivi presenti nel sito
     * @param $utentiBannati array di utenti bannati nel sito
     * @param $img_attivi array di immagini degli utenti attivi
     * @param $img_ban array di immagini degli utenti bannati
     * @throws SmartyException
     */

    public function HomeAdmin($utentiAttivi, $utentiBannati, $img_attivi, $img_ban)
    {
        list($typeA,$pic64att) = $this->SetImageRecensione($img_attivi);
        if ($typeA == null && $pic64att == null)
            $this->smarty->assign('immagine', "no");
        if (isset($img_attivi))
        {
            if (is_array($img_attivi))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('n_attivi', count($img_attivi) - 1);
            }
            else
                {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                }
        }
        else
            $this->smarty->assign('n_attivi', 0);

        list($typeB,$pic64ban) = $this->SetImageRecensione($img_ban);
        if ($typeB == null && $pic64ban == null)
            $this->smarty->assign('immagine_1', "no");
        if (isset($img_ban))
        {
            if (is_array($img_ban))
            {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                $this->smarty->assign('n_bannati', count($img_ban) - 1);
            }
            else {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                }
        }
        else
            $this->smarty->assign('n_bannati', 0);

        $this->smarty->assign('utenti',$utentiAttivi);
        $this->smarty->assign('utentiBan',$utentiBannati);
        $this->smarty->display('homepage_admin.tpl');
    }

    /**
     * Funzione di supporto che si occupa gestire le immgini degli utenti presenti nell'elenco delle recensioni
     * @param $imgrec rappresenta l'immagine presente nella recensione
     * @return array $type array dei MIME type delle immagini, $pic64 array dei dati delle immagini
     */

    public function SetImageRecensione ($imgrec)
    {
        $type = null;
        $pic64 = null;

        if (is_array($imgrec))
        {
            foreach ($imgrec as $item)
            {
                if (isset($item))
                {
                    //$pic64[] = base64_encode($item->getDataImage());
                    $pic64[] = $item->getDataImage();
                    $type[] = $item->getMimeType();

                }
                else
                    {
                    $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                    $pic64[] = base64_encode($data);
                    $type[] = "image/png";
                }
            }
        }
        elseif (isset($imgrec))
        {
            $pic64 = $imgrec->getDataImage();
           // $pic64 = base64_encode($imgrec->getDataImage());
            $type = $imgrec->getMimeType();
        }
        return array($type, $pic64);
    }

    /**
     * Funzione che permette di visualizzare la lista delle recensioni presenti nel database
     * @param $rec array di recensioni
     * @param $img array di immagini
     * @throws SmartyException
     */

    public function ShowPaginaRecensioni($rec,$img)
    {
        list($typeA,$pic64att) = $this->SetImageRecensione($img);
        if ($typeA == null && $pic64att == null)
            $this->smarty->assign('immagine_attiva', "no");
        if (isset($img))
        {
            if (is_array($img))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('n_attivi', count($img) - 1);
            }
            else
                {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
            }
        }
        $this->smarty->assign('recensioni',$rec);
        $this->smarty->display('admin_recensioni.tpl');
    }

    /**
     * Funzione che si occupa di presentare l'elenco dei vinili presenti nel database
     * @param $viniliAttivi array di vinili attivi
     * @param $viniliBan array di vinili bannati
     * @param $img_attivi array di immagini relative ai vinili attivi (riferiti a gli utenti attivi)
     * @param $img_bann array di immagini relative ai vinili bannati (riferiti a gli utenti bannati)
     * @throws SmartyException
     */

    public function showPaginaVinili($viniliAttivi, $viniliBan, $img_attivi, $img_bann)
    {
        list($typeA,$pic64att) = $this->SetImageRecensione($img_attivi);
        if ($typeA == null && $pic64att == null)
            $this->smarty->assign('immagine_attiva', "no");
        if (isset($img_attivi))
        {
            if (is_array($img_attivi))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('n_attivi', count($img_attivi) - 1);
            }
            else
                {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                }
        }
        else
            $this->smarty->assign('n_attivi', 0);

        list($typeB,$pic64ban) = $this->SetImageRecensione($img_bann);
        if ($typeB == null && $pic64ban == null)
            $this->smarty->assign('immagine_bannata', "no");
        if (isset($img_bann))
        {
            if (is_array($img_bann))
            {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                $this->smarty->assign('n_bannati', count($img_bann) - 1);
            }
            else
                {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                }
        }
        else
            $this->smarty->assign('n_bannati', 0);

        $this->smarty->assign('viniliAttivi',$viniliAttivi);
        $this->smarty->assign('viniliBannati',$viniliBan);
        $this->smarty->display('admin_vinili.tpl');
    }

    /**
     * Funzione che si occupa di presentare l'elenco degli abbonamenti presenti nel database
     * @param $abbonamentiAttivi array di abbonamenti attivi
     * @param $abbonamentiBan array di abbonamenti bannati
     * @param $negoziAttivi array di negozi attivi
     * @param $negoziBan array di negozi bannati
     * @param $img_attivi array di immagini di negozi attivi
     * @param $img_bann array di immagini di negozi bannati
     * @throws SmartyException
     */

    public function showPaginaAbbonamenti($abbonamentiAttivi, $abbonamentiBan, $negoziAttivi, $negoziBan, $img_attivi, $img_bann)
    {
        list($typeA,$pic64att) = $this->SetImageRecensione($img_attivi);
        if ($abbonamentiAttivi == null && $negoziAttivi == null && $img_attivi == null)
        {
            $this->smarty->assign('lista_attivi', "no");
            $this->smarty->assign('immagine', "no");
        }
        if (isset($abbonamentiAttivi) && isset($negoziAttivi) && isset($img_attivi))
        {
            if (is_array($abbonamentiAttivi) && is_array($negoziAttivi))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('negoziAttivi', $negoziAttivi);
                $this->smarty->assign('abbonamentiAttivi', $abbonamentiAttivi);
                $this->smarty->assign('n_attivi', count($abbonamentiAttivi) - 1);

            }
            else
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('negoziAttivi', $negoziAttivi);
                $this->smarty->assign('abbonamentiAttivi', $abbonamentiAttivi);
            }
        }
        else
            $this->smarty->assign('abbonamentiAttivi', 0);

        list($typeB,$pic64ban) = $this->SetImageRecensione($img_bann);
        if ($abbonamentiBan == null && $negoziBan == null && $img_bann == null)
        {
            $this->smarty->assign('lista_bannati', "no");
            $this->smarty->assign('immagine_1', "no");
        }
        if (isset($abbonamentiBan) && isset($negoziBan) && isset($img_bann))
        {
            if (is_array($abbonamentiBan) && is_array($negoziBan) && is_array($img_bann))
            {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                $this->smarty->assign('negoziBannati', $negoziBan);
                $this->smarty->assign('abbonamentiBannati', $abbonamentiBan);
                $this->smarty->assign('n_bannati', count($abbonamentiBan) - 1);
            }
            else
            {
                $this->smarty->assign('typeB', $typeB);
                $this->smarty->assign('pic64ban', $pic64ban);
                $this->smarty->assign('negoziBannati', $negoziBan);
                $this->smarty->assign('abbonamentiBannati', $abbonamentiBan);
            }
        }
        else
            $this->smarty->assign('numero_Bannati', 0);

        $this->smarty->assign('negoziAttivi',$negoziAttivi);
        $this->smarty->assign('negoziBannati',$negoziBan);
        $this->smarty->display('admin_abbonamenti.tpl');
    }

}