<?php


/**
 * La classe CAdmin implementa funzionalità per l'admin della piattaforma, al quale è consentito
 * bannare/attivare utenti, eliminare recensioni, cercare vinili, recensioni ed utenti, filtrando i dati del database attraverso un campo di ricerca.
 * @author Gruppo Cruciani - Nanni - Scarselli
 * @package Controller
 */

class CAdmin
{

    /**
     * Funzione utilizzata per visualizzare la homepage dell'amministratore, dove sono presenti tutti gli utenti della piattaforma.
     * Gli utenti sono divisi in due liste: utenti attivi e bannati.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati con le credenziali dell'amministratore viene visualizzata la homepage con l'elenco di tutti gli utenti;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati ma non come amministratore, viene visualizzata una pagina di errore 401 (Authorization Required);
     * 3) altrimenti, reindirizza alla pagina di login.
     */

    static function homepage ()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")         //getEmail della view
                {
                    $view = new VAdmin();
                    $pm = new FPersistentManager();
                    //visualizza elenco utenti attivi e bannati
                    $utentiAttivi = $pm->load('stato','1','FUtente_loggato');
                    $utentiBannati = $pm->load('stato','0','FUtente_loggato');
                    $img_attivi = static::caricamento_immagini_utenti($utentiAttivi);
                    $img_bann = static::caricamento_immagini_utenti($utentiBannati);
                    $view->HomeAdmin($utentiAttivi, $utentiBannati,$img_attivi,$img_bann);
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/Admin/homepage');
            }
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
                $img =  $pm->loadImg("EImageUtente", "email_utente", $utenti->getEmail());
        }
        return $img;
    }

    /**
     * Funzione di supporto per le altre.
     * Questo ha il compito di restituire:
     * 1) array di oggetti EVinile, se il paramtero in ingresso è un array di EVinile;
     * 2) un oggetto EVinile, se il parametro in ingresso è un EVinile;
     * 3) null, se la variabile in ingresso non è definita.
     * @param $vinili
     * @return array|null|object
     */

    static function caricamento_immagini_vinili($vinili)
    {
        $pm = new FPersistentManager();
        $img = null;
        if (isset($vinili))
        {
            if (is_array($vinili))
            {
                foreach ($vinili as $item)
                {
                    $img[] = $pm->loadImg2("EImageVinile", "id_vinile", $item->getId());
                }
            }
            else
                $img =  $pm->loadImg2("EImageVinile", "id_vinile", $vinili->getId());
        }
        return $img;
    }

    /**
     * Funzione utile per cambiare lo stato di attività di un utente (nel caso specifico porta il ban a true).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla homepage dell'amministratore;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria di bannaggio utente
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     */

    static function bannaggioUtente()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $view = new VAdmin();
            $pm = new FPersistentManager();
            $email = $view->getEmail();
            $utente = $pm->load('email', $email, 'FUtente_loggato');
            $pm->update('stato', $utente->setState(0), 'email', $email, 'FUtente_loggato');
            $pm->update("visibility", 0,"venditore",$email,"FVinile");  //vedere se a noi serve
            header('Location: /vinylwebmarket/Admin/homepage');
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")           //getEmail della view
                {
                    header('Location: /vinylwebmarket/Admin/homepage');
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();       //da vedere se poi serve
                header('Location: /vinylwebmarket/Admin/homepage');
            }
        }
    }

    /**
     * Funzione utile per cambiare lo stato di visibilità di un utente ( visibilità a true).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla homepage dell'amministratore;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria di riattivazione dell'utente
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     */

    static function attivazioneUtente()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $view = new VAdmin();
            $pm = new FPersistentManager();
            $email = $view->getEmail();
            //$utente = $pm->load("email", $email, "FUtenteloggato");
            $pm->update("stato", 1, "email", $email, "FUtente_loggato");  //aggiorniamo tutti i dati dell'utente per la sua riattivazione
            $pm->update("visibility", 1,"venditore",$email,"FVinile");  //vedere se a noi serve
            header('Location: /vinylwebmarket/Admin/homepage');
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")                      //getEmail della view
                {
                    header('Location: /vinylwebmarket/Admin/homepage');
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();       //da vedere se poi serve
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione che permette la visualizzazione dell'elenco delle recensioni pubblicate.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, viene visualizzata la pagina con tutte le recensioni;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati ma non come amministratore, viene visualizzata una pagina di errore 401 (Authorization Required);
     * 3) altrimenti, reindirizza alla pagina di login.
     */

    static function elencoRecensioni()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")       //getEmail della view
                {
                    $view = new VAdmin();
                    $pm = new FPersistentManager();
                    $recensione = $pm->adminAllReviews();
                    $img = null;
                    $utente = null;
                    if (is_array($recensione))
                    {
                        foreach ($recensione as $rec)
                        {
                            $utente[] = $pm->load("email", $rec->getUsernameMittente(), "FUtente_loggato");
                            $img[] = $pm->loadImg("EImageUtente", 'email_utente', $rec->getUsernameMittente());  //vedere se è corretto successivamente
                            //$rec->setUsernameMittente($utente[]);
                        }
                    }
                    elseif ($recensione != null)
                    {
                        $utente = $pm->load("email", $recensione->getUsernameMittente(), "FUtente_loggato");     //rivedere questa riga (in caso rinserire getEmail()) e la successiva
                        $img = $pm->loadImg("EImageUtente", 'email_utente', $recensione->getUsernameMittente());  //vedere se è corretto successivamente
                        //$recensione->getUsernameMittente()->setEmail($utente);
                        //$recensione->setEmailUtente($utente1);
                    }
                    $view->ShowPaginaRecensioni($recensione,$img);
                }
                else
                    {
                    $view = new VAdmin();
                    $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }
    /**
     * Funzione utile per bannare una recensione.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla pagina contenente tutte le recensioni;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione del bannaggio della recensione;
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     * @param $id
     * @throws SmartyException
     */

    static function bannaggioRecensione($id)
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $pm = new FPersistentManager();
            $pm->update('ban', 0,'id', $id,'FRecensione');
            header('Location: /vinylwebmarket/Admin/elencoRecensioni'); //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/recensioni
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")
                {
                    header('Location: /vinylwebmarket/Admin/elencoRecensioni'); //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/recensioni
                }
                else
                {
                    $view = new VAdmin();
                    $view->errore('1');
                }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione utile per eliminare una recensione.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla pagina contenente tutte le recensioni;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria di eliminare una recensione;
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     * @param $id
     * @throws SmartyException
     */

    static function eliminaRecensione($id)
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $pm = new FPersistentManager();
            $pm->delete("id", $id, "FRecensione");
            header('Location:'); //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/recensioni
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")
                {
                    header('Location: /vinylwebmarket/Admin/elencoRecensioni'); //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/recensioni
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
                }
                else
                {
                    $end = $sessione->logout();
                    header('Location: /vinylwebmarket/User/login');
                }
        }
    }

    /**
     * Funzione utilizzata per visualizzare l'elenco dei vinili in mostra (gli annunci).
     * Gli anunci sono divisi in due liste: bannati e attivi (rispettivamente, per utenti attivi ed utenti bannati).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati con le credenziali dell'amministratore viene visualizzata la pagina con l'elenco di tutti gli annunci;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati ma non come amministratore, viene visualizzata una pagina di errore 401 (Authorization Required);
     * 3) altrimenti, reindirizza alla pagina di login.
     */

    static function elencoVinili()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")               //getEmail della view
                {
                    $view = new VAdmin();
                    $pm = new FPersistentManager();
                    $viniliAttivi = $pm->load("visibility", 1, "FVinile");
                    $utentiAttivi = null;
                    if (is_array($viniliAttivi))
                    {
                        foreach ($viniliAttivi as $item)
                            $utentiAttivi[] = $item->getVenditore();     //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()
                    }
                    elseif (isset($viniliAttivi))
                        $utentiAttivi = $viniliAttivi->getVenditore();     //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()->getEmail()
                    $img_attivi = static::caricamento_immagini_vinili($viniliAttivi);

                    $viniliBannati = $pm->load("visibility", 0, "FVinile");
                    $utentiBannati = null;
                    if (is_array($viniliBannati))
                    {
                        foreach ($viniliBannati as $item)
                            $utentiBannati[] = $item->getVenditore();
                    }
                    elseif (isset($viniliBannati))
                        $utentiBannati = $viniliBannati->getVenditore();      //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()->getEmail()

                    $img_bann = static::caricamento_immagini_vinili($viniliBannati);
                    $view->showPaginaVinili($viniliAttivi, $viniliBannati, $img_attivi, $img_bann);
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione utile per cambiare lo stato di visibilità di un vinile (nel caso specifico porta la visibilità a false).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento allapagina contenente l'elenco dei vinili;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria di bannare l'annuncio selezionato cambiando il suo stato di visibilità a false;
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     * @param $id del vinile da bannare
     * @throws SmartyException
     */

    static function bannaggioVinile($id)
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $pm = new FPersistentManager();
            //$annuncio = $pm->load("idAd", $id, "FAnnuncio");
            $pm->update("visibility", 0, "id_vinile", $id, "FVinile");
            header('Location: /vinylwebmarket/Admin/elencoVinili');    //da cambiare in base al nostro tpl, verosibilmente sarà /vinylwebmarket/Admin/vinili
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")         //getEmail della view
                {
                    header('Location: /vinylwebmarket/Admin/elencoVinili');  //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/vinili
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione utile per cambiare lo stato di visibilità di un vinile (nel caso specifico porta la visibilità a true).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento allapagina contenente l'elenco dei vinili;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria di riattivare l'annuncio selezionato cambiando il suo stato di visibilità a true;
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     * @param $id dei vinili da bannare da bannare
     * @throws SmartyException
     */

    function ripristinazioneVinile($id)
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $pm = new FPersistentManager();
            //$annuncio = $pm->load("idAd", $id, "FAnnuncio");
            $pm->update("visibility", 1, "id_vinile", $id, "FVinile");
            header('Location: /vinylwebmarket/Admin/elencoVinili');    //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/vinili
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")
                {
                    header('Location: /vinylwebmarket/Admin/elencoVinili');   //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/vinili
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione utilizzata per visualizzare l'elenco degli abbonamenti in mostra.
     * Gli abbonamenti sono divisi in due liste: bannati e attivi (rispettivamente, per utenti attivi ed utenti bannati).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati con le credenziali dell'amministratore viene visualizzata la pagina con l'elenco di tutti gli abbonamenti;
     * 2) se il metodo di richiesta HTTP è GET e si è loggati ma non come amministratore, viene visualizzata una pagina di errore 401 (Authorization Required);
     * 3) altrimenti, reindirizza alla pagina di login.
     */

    static function elencoAbbonamenti()
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")               //getEmail della view
                {
                    $view = new VAdmin();
                    $pm = new FPersistentManager();
                    $abbonamentiAttivi = $pm->load('stato', 1, "FAbbonamento");
                    $negoziAttivi = null;
                    if (is_array($abbonamentiAttivi))
                    {
                        foreach ($abbonamentiAttivi as $abb)
                            $negoziAttivi[] = $abb->getEmail();     //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()
                    }
                    elseif (isset($abbonamentiAttivi))
                        $negoziAttivi->getEmail();     //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()

                    $abbonamentiBan = $pm->load("stato", 0, "FAbbonamento");
                    $negoziBan = null;
                    if (is_array($abbonamentiBan))
                    {
                        foreach ($abbonamentiBan as $abb)
                            $negoziBan[] = $abb->getEmail();
                    }
                    elseif (isset($abbonamentiBan))
                        $negoziBan->getEmail();      //prima era scritto getEmailWriter(), dovrebbe esser corretto getVenditore()

                    $view->showPaginaAbbonamenti($abbonamentiAttivi, $abbonamentiBan, $negoziAttivi, $negoziBan);
                }
                else
                    {
                        $view = new VAdmin();
                        $view->errore('1');
                    }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Funzione utile per cambiare lo stato di visibilità di un abbonamento (nel caso specifico porta la visibilità a false).
     * 1) se il metodo di richiesta HTTP è GET e si è loggati come amministratore, avviene il reindirizzamento alla pagina contenente l'elenco degli abbonamenti;
     * 2) se il metodo di richiesta HTTP è POST (ovviamente per fare ciò bisogna già essere loggati come amminstratore), avviene l'azione vera e propria del ban dell'abbonamento;
     * 3) se il metodo di richiesta HTTP è GET e non si è loggati, avviene il reindirizzamento verso la pagina di login;
     * 4) se il metodo di richiesta HTTP è GET e si è loggati come utente (non amministratore) compare una pagina di errore 401 (Authorization Required).
     * @param $id del vinile da bannare
     * @throws SmartyException
     */
/*
    static function bannaggioAbbonamento($abb)
    {
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $pm = new FPersistentManager();
            $pm->update('stato',0, 'email_negozio', $abb->getEmail() );
            $pm->update("visibility", 0, "id_vinile", $id, "FVinile");
            header('Location: /FillSpaceWEB/Admin/annunci');    //da cambiare in base al nostro tpl, verosibilmente sarà /vinylwebmarket/Admin/vinili
        }
        elseif($_SERVER['REQUEST_METHOD'] == "GET")
        {
            if ($sessione->isLoggedUtente())
            {
                $utente = unserialize($_SESSION['utente']);
                if ($utente->getEmail() == "admin@admin.com")         //getEmail della view
                {
                    header('Location: /FillSpaceWEB/Admin/annunci');  //da cambiare in base al nostro tpl, verosimilmente sarà /vinylwebmarket/Admin/vinili
                }
                else
                {
                    $view = new VAdmin();
                    $view->errore('1');
                }
            }
            else
            {
                $end = $sessione->logout();
                header('Location: /vinylwebmarket/User/login');
            }
        }
    }
*/

}