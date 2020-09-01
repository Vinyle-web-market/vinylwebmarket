<?php
/**
 * Function per recensire il servizio scambiato con un altro utente
 * Get:
 * - se il metodo è GET e si è loggati, avviene il reindirizzamento alla homepage del profilo;
 * - se il metodo è GET e non si è loggati, si viene reindirizzati alla form di login.
 * - se il metodo della richiesta HTTP è GET, ma esiste il cookie allora questo ci permette di caricare la pagina relativa
 *    all'utente che si stava visitando prima del login;
 * POST:
 * - se il metodo della richiesta HTTP è POST ed esiste il valore passato in $_POST['recensione'] viene salvata la recensione e
 *   e preparata la nuova pagina aggiornata
 *   Viene anche gestito l'inserimento o no delle stelle con $_POST['rate']
 * - se non si è loggati, viene inviato un cookie per tenere traccia delle informazioni utili per il reindirizzamento,
 *   dopo il login, alla pagina in cui ci troviamo;
 * !!!La view relativa è in VUser in quanto ripresenta semplicemente la pagina aggiornata con l'ultima recensione
 */


class CRecensione
{
    public function Review(){
        $sessione = Session::getInstance();
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                header('Location: /vinylwebmarket/User/profile');
                //header('Location: /vinylwebmarket/');
            }
            else
                header('Location: /vinylwebmarket/User/login');
        }
        elseif($_SERVER['REQUEST_METHOD'] == "POST") {
            $view = new VUser();
            $pm = new FPersistentManager();
             if (isset($_POST['recensione'])) {
                if ($sessione->isLoggedUtente()) {
                    $user = unserialize($_SESSION['utente']);
                    if (isset($_POST['rate']))
                        $review = new ERecensione($_POST['rate'], $_POST['commento'], $user->getEmail(), $_POST['destinatario']);
                    else
                        $review = new ERecensione(0, $_POST['commento'], $user->getEmail(), $_POST['destinatario']);
                    $pm->store($review);
                    $negozio = $pm->load("email_negozio", $_POST['destinatario'], "FNegozio");
                    $privato = $pm->load("email_privato", $_POST['destinatario'], "FPrivato");
                    if (isset($negozio)) {
                        $img = $pm->loadImg("EImageUtente", "email_utente", $negozio->getEmail());

                        $imgrecensioni = CUser::ImageReviews($negozio);
                       // $rec = CUser::info_cliente_rec($negozio);
                        $rec=$pm->load("destinatario",$_POST['destinatario'],"FRecensione");
                        $sessione = Session::getInstance();
                        if ($sessione->isLoggedUtente()) {
                            $utente = $sessione->getUtente();
                            //$utente = unserialize($_SESSION['utente']);
                            if ($negozio->getEmail() == $utente->getEmail())
                                //se ha cercato lui stesso non si contatta da solo:)
                                $view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "no");
                            else
                                $view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "si");
                        } else
                            $view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "si");
                    } else {
                        $img = $pm->loadImg("EImageUtente", "email_utente", $privato->getEmail());
                        $imgrecensioni = CUser::ImageReviews($privato);
                        //$rec = CUser::info_cliente_rec($privato);
                        $rec=$pm->load("destinatario",$_POST['destinatario'],"FRecensione");
                        $sessione = Session::getInstance();
                        if ($sessione->isLoggedUtente()) {
                            $utente = $sessione->getUtente();
                            // $utente = unserialize($_SESSION['utente']);
                            if ($privato->getEmail() == $utente->getEmail())
                                $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "no");
                            else
                                $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "si");
                        } else
                            $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "si");
                    }
                }else {
                    if(isset($_COOKIE["profilo_visitato"])){
                        setcookie("profilo_visitato", null, time() - 900, "/");
                    }
                    setcookie("profilo_visitato", $_POST['destinatario'], time()+900);
                    header('Location: /vinylwebmarket/User/login');
                }
            }
        }
       // elseif(isset($_COOKIE['profilo_visitato'])) {
        //    static::return_dettaglioutente($_COOKIE['profilo_visitato']);
        //}
    }
    /*presenti in CUser
    static function ImageReviews($user) {
        $pm = new FPersistentManager();
        $recensioniImage = null;
        //$recensioni = $pm->load("emailConveyor", $tra->getEmail(), "FRecensione");
        $recensioni = $pm->load("destinatario",$user->getEmail(),"FRecensione");
        if (isset($recensioni)) {
            if (is_array($recensioni)) {
                foreach ($recensioni as $item) {
                    $recensioniImage[] = $pm->loadImg("EImageUtente","email_utente",$item->getUsernameMittente());
                    //$recensioniImage = $pm->load("emailutente", $item->getEmailClient(), "FMediaUtente");
                }
            } else {
                $recensioniImage = $pm->loadImg("EImageUtente","email_utente",$recensioni->getUsernameMittente());
            }
        }
        return $recensioniImage;
    }

    static function info_cliente_rec ($user) {
        $pm = new FPersistentManager();
        $rec = $user->getRecensioni(); // SEMPRE UN ARRAY
        if(count($rec) > 1) {
            foreach ($rec as $r) {
                $ute = $pm->load("email", $r->getUsernameMittente(), "FUtente_loggato");
                $r->setUsernameMittente($ute);
            }
        }
        elseif (count($rec) == 1) {
            $ute = $pm->load("email", $rec[0]->getUsernameMittente(), "FUtente_loggato");
            $rec[0]->setUsernameMittente($ute);
        }
        return $rec;
    }
    */


}