<?php


/**
 * La classe VMessaggi si occupa dell'input/output riguardante chat/messaggi
 * Solo per gli utenti loggati
 * @author Cruciani - Nanni - Scarselli
 * @package View
 */

class VMessaggi
{

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Funzione che permette di visualizzare sulla pagina dell'elenco delle chat di tutti utenti con cui è avvenuta conversazione.
     * @param $mittenti array di utenti / oggetto utente che sarà visualizzato nella pagina
     * @param $img_ute immagine / array di immagini che saranno visualizzati accanto al nome del rispettivo utente
     * @throws SmartyException
     */

    public function showChats($utent, $img_ute)
    {
        list($typeA,$pic64att) = $this->SetImageUtente($img_ute);
        if ($typeA == null && $pic64att == null)
            $this->smarty->assign('immagine', "no");

        if (isset($img_ute))
        {
            if (is_array($img_ute) && is_array($utent))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('n_immagini',count($img_ute)-1);
                $this->smarty->assign('n_utent',count($utent)-1);
            }
            else
                {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
            }
        }
        else
            $this->smarty->assign('immagine', 0);

        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('utent', $utent);
        $this->smarty->display('chat.tpl');
    }

    /**
     * Funzione che imposta le immagini da visualizzare nella pagina per ogni utente.
     * Nel caso in cui l'utente abbia un'immagine caricata nel db, si provvede a caricarne i relativi dati, altrimenti a questo utente verrà attribuita un'immagine di default
     * @param $img immagine dell'utente
     * @return array $type MIME type dell'immagine, $pic64 dati dell'immagine
     */

    public function SetImageUtente($img_ute)
    {
        $type = null;
        $pic64 = null;

        if (is_array($img_ute))
        {
            foreach ($img_ute as $item)
            {
                if (isset($item))
                {
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
        elseif (isset($img_ute))
        {
            $pic64 = $img_ute->getDataImage();
            $type = $img_ute->getMimeType();
        }
        return array($type, $pic64);
    }

    /**
     * Funzione che permette di visualizzare, nella pagina chat, i messaggi scambiati con un determinato utente
     * @param $result oggetto messaggio o array di messaggi scambiati con un utente
     * @param $img2 immagine del destinatario della conversazione
     * @throws SmartyException
     */

    public function showMessaggi($result, $img, $email1, $email2)
    {
        list($type,$pic64) = $this->SetImageUtente($img);

        if ($type == null && $pic64 == null)
            $this->smarty->assign('immagine', "no");
        if (isset($img))
        {
                $this->smarty->assign('type', $type);
                $this->smarty->assign('pic64', $pic64);
        }
        else
            $this->smarty->assign('immagine', 0);
        $this->smarty->assign('email1',$email1);
        $this->smarty->assign('email2',$email2);
        $this->smarty->assign('mes',$result);

        if (isset($result)) {
            if (is_array($result)) {
                $this->smarty->assign('n_mes', count($result)-1 );
            }
            elseif (is_object($result)) {
                $this->smarty->assign('n_mes', 1);
            }
        }
        else
            $this->smarty->assign('n_mes', 0);

        $this->smarty->display('messaggi.tpl');
    }


}