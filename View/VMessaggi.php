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
            if (is_array($img_ute))
            {
                $this->smarty->assign('typeA', $typeA);
                $this->smarty->assign('pic64att', $pic64att);
                $this->smarty->assign('n_mittente', count($img_ute) - 1);
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
        $this->smarty->assign('mittente', $utent);
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
     * @param $utente oggetto utente a cui saranno recapitati i messaggi
     * @throws SmartyException
     */

    public function showMessaggi($result, $utente)
    {
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('messaggio', $result);
        $this->smarty->assign('utente', $utente);
        $this->smarty->display('messaggi.tpl');
    }

    /**
     * Funzione richiamata quando un utente contatta un altro utente per la prima volta.
     * Consente di visualizzare la pagina di messaggistica senza alcun messaggio e con il box per inserire il testo da inviare.
     * @param $destinatario oggetto utente a cui saranno recapitati i messaggi
     * @throws SmartyException
     */

    public function primoMessaggio($destinatario)
    {
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('destinatario', $destinatario);
        $this->smarty->display('primo_messaggio.tpl');
    }

}