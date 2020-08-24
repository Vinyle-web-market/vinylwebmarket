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
            $utente = $sessione->getUtente();

            if (get_class($utente) != 'EUtente_loggato')
            {
                $view = new VMessaggi();
                $pm = new FPersistentManager();
                $messaggi = $pm->elenco_Chats($utente->getEmail(), null);

                if (is_object($messaggi))
                {
                    // c'è un solo oggetto messaggio -> quindi devo prendere solo l'utente sender/recipient che non sono io
                    if ($messaggi->getMittente() != $utente->getEmail())
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
                    //$img_chats = static::caricamento_immagini_utenti($utent);
                    //$view->showChats($utent, $img_chats);

                    $utentiOrdinati = null;
                    // prendo solo oggetti non replicati
                   $utenti = (array_unique($utent, SORT_REGULAR));

                    foreach ($utenti as $ute)
                    {
                        $utentiOrdinati[] = $ute;
                    }
                    $img_chats = static::caricamento_immagini_utenti($utentiOrdinati);

                    $view->showChats($utentiOrdinati, $img_chats);
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
     * Restituisce l'email dell'utente che invia/riceve il messaggio
     * Inviato con metodo post
     * @return string contenente l'email dell'utente
     */

    function getEmail()
    {
        $email = null;
        if (isset($_POST['email']))
            $email = $_POST['email'];
        return $email;
    }

    /**
     * Restituisce il testo del messaggio
     * Inviato con metodo post
     * @return string contenente il testo del messaggio
     */

    function getTesto()
    {
        $testo = null;
        if (isset($_POST['testo']))
            $testo = $_POST['testo'];
        return $testo;
    }

    /**
     * Restituisce l'oggetto del messaggio
     * Inviato con metodo post
     * @return string contenente l'oggetto del messaggio
     */

    function getOggetto()
    {
        $oggetto = null;
        if (isset($_POST['oggetto']))
            $oggetto = $_POST['oggetto'];
        return $oggetto;
    }

    /**
     * Funzione di supporto per altre.
     * Essa garantisce il corretto reindirizzameto verso la chat richiesta.
     */

    static function redirect_chat()
    {
        $sessione = Session::getInstance();
        $utente = $sessione->getUtente();

        if (get_class($utente) != 'EUtente_loggato')
        {
            $view = new VMessaggi();
            $pm = new FPersistentManager();
            $email = null;

            if(isset($_COOKIE['chat']))
            {
                $email = $_COOKIE['chat'];
                setcookie("chat", null, time() - 900,"/");
            }

            elseif (isset($_POST['email2']))
                $email = $_POST['email2'];

            if (isset ($_POST['testo']))
            {
                $oggetto = static::getOggetto();    //in caso, modificare in formato dinamico
                $testo = static::getTesto();
                $messaggio = new EMessaggio($utente->getEmail(), $email, $testo, $oggetto);   // da rivedere un attimo
                $pm->store($messaggio);
            }

            //$destinatario = $pm->load("destinatario", $email, "FMessaggio");
            $result = $pm->caricaChats($utente->getEmail(), $email);

            if (is_object($result))
            {
                $mittente = $pm->load("email", $utente->getEmail(), "FUtente_loggato");
                $destinatario = $pm->load("email", $email, "FUtente_loggato");
                //$result->setMittente($mittente);
                //$result->setDestinatario($destinatario);
                //$view->showMessaggi($result, $utente);
                var_dump($utente->getEmail());
                echo '<hr>';
                var_dump($email);
                echo '<hr>';
                var_dump($result);
                echo '<hr>';
            }
            elseif (is_array($result))
            {
                foreach ($result as $res)
                {
                    $mittente[] = $pm->load("email", $utente->getEmail(), "FUtente_loggato");
                    $destinatario[] = $pm->load("email", $email, "FUtente_loggato");
                    //$res->setMittente($mittente);
                    //$res->setDestinatario($destinatario);
                }
                var_dump($utente->getEmail());
                echo '<hr>';
                var_dump($email);
                echo '<hr>';
                var_dump($result);
                //$view->showMessaggi($result, $utente);
            }
        }
    }

    /**
     * Funzione che si occupa di avviare (o riprendere) una chat.
     * 1) se il metodo di richiesta HTTP è GET e non si è loggati, si viene reindirizzati alla form di login;
     * 2) se il metodo di richiesta HTTP è POST e si è loggati, attraverso la funzione redirect_chat(), avviene l'invio vero e proprio del messaggio;
     * 3) se il metodo di richiesta HTTP è GET e si è loggati, avviene il redirect alla pagina per visualizzare l'elenco delle proprie chat;
     * 4) l'utilizzo del COOKIE viene sfruttato per il redirect alla casella di chat corretta, se si cerca di contattare un utente e non si è ancora loggati.
     */

    static function chat()
    {
        $sessione = Session::getInstance();

        if ($sessione->isLoggedUtente())
        {
            if ($_SERVER['REQUEST_METHOD'] == "POST")
            {
                static::redirect_chat();
            }
            elseif (isset($_COOKIE['chat']))
            {
                static::redirect_chat();
            }
            else
                {
                header('Location: /vinylwebmarket/Messaggi/elencoChat');
            }
        }
        else
            {
            setcookie("chat", $_POST['email_ritorno'], time()+900,"/");
            header('Location: /vinylwebmarket/User/login');
        }
    }

}