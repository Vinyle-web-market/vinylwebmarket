<?php


/**
 * La classe VMessaggi si occupa dell'input/output riguardante chat/messaggi solo per gli utenti loggati
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Controller
 */

class CMessaggi
{
    /**
     * Funzione che si occupa della gestione dell'elenco delle chat attive per un utente e da anche la possibilità di riprendere
     * delle conversazioni precedenti.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla homepage dell'amministratore;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati, si viene indirizzati alla pagina contenente l'elenco di tutte le conversazioni
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento alla form di login
     */
    public function elencoChat()
    {
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
        {
            $utent = null;
            $utente = unserialize($_SESSION['utente']);
            if (get_class($utente) != 'EUtente_loggato')
            {
                $view = new VMessaggi();
                $pm = new FPersistentManager();
                $messaggi = $pm->caricaChats($utente->getEmail(), null);

                if (is_object($messaggi))
                {
                    // c'è un solo oggetto messaggio -> quindi devo prendere solo l'utente sender/recipient che non sono io
                    if ($messaggi->getUsernameMittente() != $utente->getEmail())
                        $utent = $pm->load("email", $messaggi->getMittente(), "FUtente_loggato");
                    else
                        $utent = $pm->load("email", $messaggi->getDestinatario(), "FUtente_loggato");
                    $img_chats = static::caricamento_immagini_utenti($utent);
                    $view->showChats($utent, $img_chats);    //da fare nella view
                }
                elseif (is_array($messaggi))
                {
                    $utent = array();
                    // devo fare il merge tra tutte le mail sender/recipient e poi prendere i valori non duplicati
                    for ($i = 0; $i < count($messaggi); $i++)
                    {
                        // prendo solo le email che sono diverse dalla mia.
                        if ($messaggi[$i]->getMittente() != $utente->getEmail())
                            $utent[$i] = $pm->load("email", $messaggi[$i]->getMittente(), "FUtente_loggato");
                        else
                            $utent[$i] = $pm->load("email", $messaggi[$i]->getDestinatario(), "FUtente_loggato");
                    }
                    $utentiOrdinati = null;
                    // prendo solo oggetti non replicati
                    $utent = (array_unique($utent));
                    foreach ($utent as $ute)
                    {
                        $utentiOrdinati[] = $ute;
                    }
                    $img_chats = static::caricamento_immagini_utenti($utentiOrdinati);
                    $view->showChats($utentiOrdinati, $img_chats);    //da fare nella view
                }
                elseif ($messaggi == null)
                {
                    $img_chats = static::caricamento_immagini_utenti($utent);
                    $view->showChats($utent, $img_chats);    //da fare nella view. Forse al posto di img_chats mettere null
                }
            }
            else
                header('Location: /vinylwebmarket/Admin/homepage');
        }
        else
        {
            $end = $sessione->logout();
            header('Location: /vinylwebmarket/User/login');
        }
    }

    /**
     * Funzione di supporto per le altre.
     * Questo ha il compito di restituire:
     * 1) array di oggetti EUtente_loggato, se il paramtero in ingressto è un array di EUtente_loggato;
     * 2) un oggetto EUtente_loggato, se il parametro in ingresso è un EUtente_loggato;
     * 3) null, se la variabile in ingresso non è definita.
     * @param $utenti
     * @return array|null|object
     */

    static function caricamento_immagini_utenti($utenti)
    {
        $pm = new FPersistentManager();
        $img = null;

        if (isset($utenti))
        {
            if (is_array($utenti))
            {
                foreach ($utenti as $item)
                {
                    $img[] = $pm->loadImg("EImageUtente", "email_utente", $item->getEmail());
                }
            }
            else
            {
                $img =  $pm->loadImg("EImageUtente", "email_utente", $utenti->getEmail());
            }
        }
        return $img;
    }

    /**
     * Funzione di supporto per altre.
     * Questa garantisce il corretto reindirizzameto verso la chat richiesta.
     */

    static function set_chat()
    {
        $utente = unserialize($_SESSION['utente']);
        if (get_class($utente) != 'EUtente_loggato')
        {
            $view = new VMessaggi();
            $pm = new FPersistentManager();

            if(isset($_COOKIE['chat']))
            {
                $email = $_COOKIE['chat'];
                setcookie("chat", null, time() - 900,"/");
            }
            elseif (isset($_POST['email_ritorno']))
                $email = $_POST['email_ritorno'];
            else
                $email = $_POST['email'];

            if (isset ($_POST['text']))
            {
                $messaggio = $_POST['text'];
                $mess = new EMessaggio($messaggio, $utente->getEmail(), $email);   // da rivedere un attimo
                $pm->store($mess);
            }

            $oggettoUtente = $pm->load("email", $email, "FUtenteloggato");
            $result = $pm->caricaChats($utente->getEmail(), $email);

            if (is_object($result))
            {
                $mittente = $pm->load("email", $result->getMittente(), "FUtente_loggato");
                $destinatario = $pm->load("email", $result->getDestinatario(), "FUtente_loggato");
                $result->setMittente($mittente);
                $result->setDestinatario($destinatario);
                $view->showMessaggi($result, $utente);
            }
            elseif (is_array($result))
            {
                foreach ($result as $res)
                {
                    $mittente = $pm->load("email", $res->getMittente(), "FUtente_loggato");
                    $destinatario = $pm->load("email", $res->getDestinatario(), "FUtente_loggato");
                    $res->setMittente($mittente);
                    $res->setDestinatario($destinatario);
                }
                $view->showMessaggi($result, $utente);
            }
            else
                {
                $view->primoMessaggio($oggettoUtente);    //vediamo un attimo se servirà
            }
            //  $view->showMessaggi($result, $utente);
        }
        else
            header('Location: /vinylwebmarket/Admin/homepage');
    }

}