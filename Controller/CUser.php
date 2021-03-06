<?php

/**
 * Classe che gestisce l'utente:
 *                -sua iscrizione al sito(connotati biografici e informazioni per il contatto )
 *                -modifica profilo e carta di credito
 *                -presentazione sezione privata e pubblica per essere visitati e contattati dagli altri utenti
 */


class CUser
{

    /**
     * Metodo GET per l'indirixxamento alla form di registrazione del privato7
     * evitabile e implementato anche registrazione privato
     */
    public function FormRegPrivato()
    {
        $view = new VRegistrazione();
        $view->formRegistrazionePrivato();
    }

    /**
     * Funzione che mostra la form per l'iscrizione al sito di un utente tipo Privato
     * 1------- metodo è GET e si è loggati, avviene il reindirizzamento al profilo utente privato;
     * -------- metodo è GET e non si è loggati-->reindirizzamento alla form di registrazione;
     * 2--- se il metodo è POST viene chiamata la funzione controlRegistrazionePrivato() per la gestione dei dati inseriti dall'utente
     */
    public function registrazionePrivato()
    {

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                header('Location: /vinylwebmarket/');
            } else {
                $view = new VRegistrazione();
                $view->formRegistrazionePrivato();
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            static::controlRegistrazionePrivato();
        }
    }

    /**
     * Funzione per il controllo della validità dei dati inseriti nella form di registrazione da parte dell'utente privato.
     *  Controllo sull'email che deve essere univoca-->segnalazione nel caso contrario ;
     * Controllo su ogni tipo di campo che deve rispettare formati specifici attraverso L'EInputControl
     * Controllo sull'immagine effettuato su questa classe
     */
    public function controlRegistrazionePrivato()
    {
        $nome = $_POST["nome"];
        $cognome = $_POST["cognome"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $ris = "ok";
        $pm = new FPersistentManager();
        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
        $view2 = new VUser();
        $err = array();
        $error_stringa = "";
        if ($veremail) {
            $error_stringa = "email";
            $view2->ErrorInputRegistrazionePrivato($err, $error_stringa);
        } else {
            $privato = new EPrivato($username, $email, $password, $telefono, $nome, $cognome);
            $input = EInputControl::getInstance();
            $err = $input->validPrivato($privato);
            if ($err) {
                $view2->ErrorInputRegistrazionePrivato($err, $error_stringa);
            } else if ($privato != null) {
                if (isset($_FILES['file'])) {
                    $nome_file = 'file';
                    $img = static::uploadImage($privato, "registrazionePrivato", $nome_file);
                    switch ($img) {
                        case "size":
                            $view2->ErrorInputRegistrazionePrivato($err, "size");
                            break;
                        case "type":
                            $view2->ErrorInputRegistrazionePrivato($err, "typeimg");
                            break;
                        case "ok":
                            header('Location:/vinylwebmarket/Homepage/impostaPaginaUL');
                            break;
                    }
                }
            }
        }
    }

    /**
     * Metodo GET per l'indirixxamento alla form di registrazione del negozio
     * evitabile e implementato anche registrazione privato
     */
    public function FormRegNegozio()
    {
        $view = new VRegistrazione();
        $view->formRegistrazioneNegozio();
    }

    /**
     * Funzione che mostra la form per l'iscrizione al sito di un utente tipo Negozio
     * 1------- metodo è GET e si è loggati, avviene il reindirizzamento al profilo utente negozio;
     * -------- metodo è GET e non si è loggati-->reindirizzamento alla form di registrazione;
     * 2--- se il metodo è POST viene chiamata la funzione controlRegistrazioneNegozio() per la gestione dei dati inseriti dall'utente
     */
    public function registrazioneNegozio()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                header('Location: /vinylwebmarket/');
            } else {
                $view = new VRegistrazione();
                $view->formRegistrazioneNegozio();
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            static::controlRegistrazioneNegozio();
        }
    }

    /**
     * Funzione per il controllo della validità dei dati inseriti nella form di registrazione da parte dell'utente negozio.
     *  Controllo sull'email che deve essere univoca-->segnalazione nel caso contrario ;
     * Controllo su ogni tipo di campo che deve rispettare formati specifici attraverso L'EInputControl
     * Controllo sull'immagine effettuato su questa classe
     */
    public function controlRegistrazioneNegozio()
    {
        $ris = "ok";
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $nomeNegozio = $_POST["nomenegozio"];
        $iva = $_POST["partitaiva"];
        $indirizzo = $_POST["indirizzo"];
        //carta
        $numeroCarta = $_POST["numerocarta"];
        $cvv = $_POST["cvv"];
        $intestatario = $_POST["intestatario"];
        $mese = $_POST["mese"];
        $anno = $_POST["anno"];
        $scadenza = $anno . "-" . $mese . "-01";
        $ris = "ok";
        $pm = new FPersistentManager();
        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
        $view2 = new VUser();
        $err = array();
        $error_stringa = "";
        if ($veremail) {
            $error_email = "email";
            $view2->ErrorInputRegistrazioneNegozio($err, $error_email);

        } else {
            $abb = new EAbbonamento();
            $carta = new ECarta($intestatario, $numeroCarta, $scadenza, $cvv);
            $negozio = new ENegozio($username, $email, $password, $telefono, $nomeNegozio, $iva, $indirizzo, $carta, $abb);
            $input = EInputControl::getInstance();
            $err = $input->validNegozio($negozio);
            if ($err) {
                $view2->ErrorInputRegistrazioneNegozio($err, $error_stringa);
            } else if ($negozio != null) {
                if (isset($_FILES['file'])) {
                    $nome_file = 'file';
                    $img = static::uploadImage($negozio, "registrazioneNegozio", $nome_file);
                    switch ($img) {
                        case "size":
                            $view2->ErrorInputRegistrazioneNegozio($err, "size");
                            break;
                        case "type":
                            $view2->ErrorInputRegistrazioneNegozio($err, "typeimg");
                            break;
                        case "ok":
                            header('Location:/vinylwebmarket/Homepage/impostaPaginaUL');
                            break;
                    }
                }
            }
        }

    }

    /**
     * Funzione di di controllo della validità dell'immagine inserita nella form di registrazione.
     * Segnalazione e store rifiutata in caso di errore
     * @param $utente obj utente
     * @param $funz tipo di funzione da svolgere
     * @param $nome_file passato nella form pe l'immagine
     * @return string stato verifa immagine
     */
    static function uploadImage($utente, $funz, $nome_file)
    {
        $pm = new FPersistentManager();

        $img = $_FILES["file"];
        $ris = null;
        $nome = '';
        $max_size = 300000;
        $result = is_uploaded_file($img['tmp_name']);
        $img = $_FILES["file"];
        $name = $img["name"];
        $size = $img['size'];
        $type = $img["type"];

        if (!$result) {
            //no immagine
            if ($funz == "registrazionePrivato" || $funz = "registrazioneNegozio") {
                $pm->store($utente);
                //return "ok";
                $ris = "ok";
            }
        } else {
            if ($size > $max_size) {
                //Il file è troppo grande
                //return "size";
                $ris = "size";
            }//$type = $_FILES[$nome_file]['type'];
            elseif ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
                if ($funz == "registrazionePrivato" || $funz = "registrazioneNegozio") {
                    //$data = file_get_contents($img["tmp_name"]);
                    // $data = base64_encode($data);
                    $pm->store($utente);
                    $mutente = new EImageUtente($name, $img["tmp_name"], $type, $utente->getEmail());
                    $pm->storeImg($mutente);
                    //return "ok";
                    $ris = "ok";
                } elseif ($funz == "modificaUtente") {
                    $pm->deleteImg("EImageUtente", "email_utente", $utente->getEmail());
                    //public static function deleteImg(string $categoriaImage,$field, $id){
                    $img = $_FILES["file"];
                    //$data = file_get_contents($img["tmp_name"]);
                    //$data = base64_encode($data);
                    $mutente = new EImageUtente($img["name"], $img["tmp_name"], $img["type"], $utente->getEmail());
                    $pm->storeImg($mutente);
                    //return "ok";
                    $ris = "ok";

                }
            } else {
                //formato diverso
                //return "type";
                $ris = "type";
            }
        }
        return $ris;
    }

    /**
     * login di un utente registrato:
     * 1) se il metodo della richiesta HTTP è GET:
     *   - se l'utente è già loggato viene reindirizzato sul suo profilo;
     *     - se l'utente non è loggato si viene indirizzati alla form di login;
     * 2) se il metodo della richiesta HTTP è POST viene richiamata la funzione checkLogin().
     */
    static function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                header('location: /vinylwebmarket/User/profile');
            } else {
                $view = new VUser();
                $view->formLogin();
            }
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST")
            static::checkLogin();
    }


    /**
     * Si appoggia alla classe Session con metodi per la gestione di ogni sessione
     * Metodo che provvede ad eliminare i dati di sessione (quando l'utente fa logout)
     */
    public function Logout()
    {
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente()) {
            $sessione->logout(); //cancello i dati di sessione
        }
        //redirect a login in entrambi i casi
        header('Location: /vinylwebmarket');
    }

    /**
     * Controllo esistenza username e password nel db
     * 1)risultato negativo->viene ricaricata la pagina con l'aggunta dell'errore nel login(PW o email errata/e)
     * 2) se l'utente esiste e non è bannato, avviene il reindirizzamaneto alla homepage privata dell'utente;
     * per il negozio viene effettuato il controllo dell'abbonamento,se scaduto di vedrà bannare i suoi vinili a meno di 3
     * 3)se Pw e email sono quelle dell'amministratore si viene reindirizzati alla sezione ADMIN;
     * 4) se si verifica la presenza di particolari cookie(e sessione scaduta) avviene il reindirizzamento alla pagina specificata:
     * -durante una chat si viene reindirizzati all'elenco chat pronti per riprendere la conversazione
     * -se stiamo visitando un profilo di un altro utente vieniamo poi reindirizzati li' per riprendere eventuali recensioni o chat
     * @throws SmartyException
     */
    static function checkLogin()
    {
        $view = new VUser();
        $email = "";
        $valoreMail = "non settato";
        $pm = new FPersistentManager();
        $exist = $pm->exist('email', $_POST['email'], "FUtente_loggato");
        if ($exist) {
            $email = "esiste";
            $valoreMail = $_POST['email'];
        }
        $utente = $pm->loginUtente($_POST['email'], $_POST['password']);
        if ($utente != null && $utente->isState() != false) {
        if(get_class($utente)=='ENegozio'){
            $today = strtotime(date("Y-m-d"));
            $data= strtotime($utente->getAbbonamento()->getData());
            if ($data < $today){
                $pm->update('stato', 0, 'id',$utente->getAbbonamento()->getId(), 'FAbbonamento' );
                self::disattivaVinili($utente);
            }

        }
            $sessione = Session::getInstance();
            $sessione->setUtenteLoggato($utente);
            /*if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $salva_sessione = serialize($utente);
                $_SESSION['utente'] = $salva_sessione;*/
            if ($_POST['email'] != 'admin@admin.com') {
                if (isset($_COOKIE['chat']) && $_COOKIE['chat'] != $_POST['email']) {
                    header('Location: /vinylwebmarket/Messaggi/elencoChat');
                } //elseif (isset($_COOKIE['profilo_visitato'])) {
                   // header('Location: /vinylwebmarket/User/viewProfilePublic');
               // }
                elseif (isset($_COOKIE['profilo_visitato'])) {
                    $emailRedirect=$_COOKIE['profilo_visitato'];
                    setcookie("profilo_visitato", null, time() - 900, "/");
                    header('Location: /vinylwebmarket/User/return_dettaglioutente/'.$emailRedirect);
                }
                elseif (isset($_COOKIE['elenco_chat'])) {
                    $emailRedirect=$_COOKIE['elenco_chat'];
                    setcookie("elenco_chat", null, time() - 900, "/");
                    header('Location: /vinylwebmarket/Messaggi/elencoChat');
                }/*
                elseif (isset($_COOKIE['conversazione'])) {
                    $emailRedirect=$_COOKIE['conversazione'];
                    setcookie("conversazione", null, time() - 900, "/");
                    header('Location: /vinylwebmarket/Messaggi/elencoChat');
                }*/
                   else {
                    if (isset($_COOKIE['chat']))
                        setcookie("chat", null, time() - 900, "/");
                    else {
                        header('Location: /vinylwebmarket/Homepage/impostaPaginaUL');

                    }
                }
            } else header('Location: /vinylwebmarket/Admin/homepage');
        } else {
            $view->loginError($email, $valoreMail);
        }
    }

    /**
     * Funzione di supporto a checklogin che disattiva i vinili oltre i 3 se l'abbonamento è disattivato
     */
    static function disattivaVinili($utente){
        $pm=new FPersistentManager();
        $vinili=$pm->load('venditore', $utente->getEmail(), 'FVinile');
        if ($utente->getAbbonamento()->isStato()==0){
            for ($i=3; $i<count($vinili); $i++){
                $pm->update('visibility', '0', 'id_vinile', $vinili[$i]->getId(), 'FVinile');
            }
        }
    }

    /**
     * Profilo dell'utente dopo aver effettuato il login
     * - metodo GET ed il Log ha avuto successo->ingresso nel proprio profilo privato o negozio che sia.
     * -se non loggati-> reindirizzati nella form di login
     * -si recupera tutti i dati necessari alla preparazione del profilo:
     *    vinili e loro img
     *    img utente e info utente
     *    informazioni sull'abbonamento in caso di negozio
     * CFiltro::ImageVinyls è una funzione di supporto che poteva sfruttarsi da un CUtility
     */
    static function profile()
    {
        $view = new VUser();
        $pm = new FPersistentManager();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                // $utente = unserialize($_SESSION['utente']);
                    $tipo=get_class($utente);
                    $img = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                    $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                    $img_v=CFiltro::ImageVinyls($vinili);
                    if ($tipo=='ENegozio'){
                        $stato=$utente->getAbbonamento()->isStato();
                        $view->profile($utente, $vinili, $img, $tipo, $stato,$img_v);
                    }
                    else $view->profile($utente, $vinili, $img, $tipo, null,$img_v);
            } else
                header('Location: /vinylwebmarket/User/login');
        }
    }


    /**
     * funzione per la modifica dei dati profilo.
     * 1) se il metodo è GET e si è loggati->form per l'invio delle modifiche.
     * 2) se il metodo è GET ma non si è loggati, allora avviene il reindirizzamento verso la form di login;
     * 3) se il metodo della richiesta HTTP è POST,controllo e gestione dei dati inseriti dall'utente
     *     per effettuare le modifiche bisogna inserire la vecchia password e deve corrispondere
     * 	  CONTROLLO deel'univocità dell'email, e validazione di tutti gli altri campi che devono rispettare un formato prestabilito
     */
    public function modificaProfilo()
    {
        $pm = new FPersistentManager();
        $view = new VUser();
        //session_start();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                //$utente = unserialize($_SESSION['utente']);
                $utente = $sessione->getUtente();
                $img = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                if (get_class($utente) == "EPrivato") {
                    $view->formModificaProfiloPrivato($utente, $img, "ok");
                } elseif (get_class($utente) == "ENegozio") {
                    $view->formModificaProfiloNegozio($utente, $img, "ok");
                }
            } else
                header('Location: /vinylwebmarket/User/login');
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            //$utente = unserialize($_SESSION['utente']);
            $utente = $sessione->getUtente();
            $img = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
            if (get_class($utente) == "EPrivato") {
                if ($utente->getPassword() == $_POST['old_password']) {
                    if ($utente->getEmail() == $_POST['email']) {
                        $err = static::updateCampi($utente);
                        $newutente = $pm->load("email_privato", $utente->getEmail(), "FPrivato");
                        $salvare = serialize($newutente);
                        $_SESSION['utente'] = $salvare;
                        header('Location: /vinylwebmarket/User/profile');
                    } else {  //se vuole cambiare anche l'email
                        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
                        if ($veremail) {
                            //UTENTE GIA NEL DB
                            $view->formModificaProfiloPrivato($utente, $img, "errorEmail");
                        } else {
                            static::updateCampi($utente);
                            $input = EInputControl::getInstance();
                            if ($input->testEmail($_POST['email'])) {
                                $pm->update("email", $_POST['email'], "email", $utente->getEmail(), "FUtente_loggato");
                                $newutente = $pm->load("email_privato", $_POST['email'], "FPrivato");
                                $img1 = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                                $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                                $sessione->setUtenteLoggato($newutente);
                                //$salvare = serialize($newutente);
                                //$_SESSION['utente'] = $salvare;
                                //$view->profilePrivato($newutente, $vinili, $img1);
                                header('Location: /vinylwebmarket/User/profile');
                            } else {
                                $view->formModificaProfiloPrivato($utente, $img, "errorEmailInput");
                            }

                        }
                    }
                } else {
                    //ERRORE PASSWORD
                    $view->formModificaProfiloPrivato($utente, $img, "errorPassword");
                }
            } elseif (get_class($utente) == "ENegozio") {
                if ($utente->getPassword() == $_POST['old_password']) {
                    if ($utente->getEmail() == $_POST['email']) {
                        $err = static::updateCampi($utente);
                        $newutente = $pm->load("email_negozio", $utente->getEmail(), "FNegozio");
                        $salvare = serialize($newutente);
                        $_SESSION['utente'] = $salvare;
                        header('Location: /vinylwebmarket/User/profile');
                    } else {
                        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
                        if ($veremail) {
                            $view->formModificaProfiloNegozio($utente, $img, "errorEmail");
                        } else {
                            static::updateCampi($utente);
                            $input = EInputControl::getInstance();
                            if ($input->testEmail($_POST['email'])) {
                                $pm->update("email", $_POST['email'], "email", $utente->getEmail(), "FUtente_loggato");
                                $newutente = $pm->load("email_negozio", $_POST['email'], "FNegozio");
                                $img1 = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                                $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                                $sessione->setUtenteLoggato($newutente);
                                //$salvare = serialize($newutente);
                                //$_SESSION['utente'] = $salvare;
                                //$view->profileNegozio($newutente, $vinili, $img1);
                                header('Location: /vinylwebmarket/User/profile');
                            } else {
                                $view->formModificaProfiloNegozio($utente, $img, "errorEmailInput");
                            }
                        }
                    }
                } else {
                    $view->formModificaProfiloNegozio($utente, $img, "errorPassword");
                }

            }
        }
    }

    /**
     * Funzione che si occupa di fare tutti i controlli necessari per aggiornare i coli campi che un utente desidera modificare
     * nella sua form di modifica profilo
     * il nuovo object utente deve passare i test dell'EInputControl per poter effetture effettivamente le modifiche
     * @param $utente obj rappresentante l'utente
     */
    static function updateCampi($utente)
    {
        $pm = new FPersistentManager();
        $view = new VUser();
        $result = array();
        $input = EInputControl::getInstance();
        //public static function update($field, $newValue, $keyField, $idValue ,$Fclass)
        if (get_class($utente) == "EPrivato") {
            $classeDB = "FPrivato";
            if ($utente->getUsername() != $_POST['username'] and $input->testUsername($_POST['username']))
                $pm->update("username", $_POST['username'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($_POST['new_password'] != "" and $input->testPassword($_POST['new_password']))
                $pm->update("password", $_POST['new_password'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getPhone() != $_POST['telefono'] and $input->testPhone($_POST['telefono']))
                $pm->update("telefono", $_POST['telefono'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getNome() != $_POST['nome'] and $input->testName($_POST['nome']))
                $pm->update("nome", $_POST['nome'], "email_privato", $utente->getEmail(), $classeDB);
            if ($utente->getCognome() != $_POST['cognome'] and $input->testName($_POST['nome']))
                $pm->update("cognome", $_POST['cognome'], "email_privato", $utente->getEmail(), $classeDB);
        }
        if (get_class($utente) == "ENegozio") {
            $classeDB = "FNegozio";
            $input = EInputControl::getInstance();
            if ($utente->getUsername() != $_POST['username'] and $input->testUsername($_POST['username']))
                $pm->update("username", $_POST['username'], "email", $utente->getEmail(), "FUtente_loggato");
            //  if ($utente->getEmail() != $_POST['email'])
            //    $pm->update("email", $_POST['email'], "email", $utente->getEmail(), $classeDB);
            if ($_POST['new_password'] != "" and $input->testPassword($_POST['new_password']))
                $pm->update("password", $_POST['new_password'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getPhone() != $_POST['telefono'] and $input->testPhone($_POST['telefono']))
                $pm->update("telefono", $_POST['telefono'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getNameShop() != $_POST['nomenegozio'])
                $pm->update("nome", $_POST['nomenegozio'], "email_negozio", $utente->getEmail(), $classeDB);
            if ($utente->getPIva() != $_POST['partitaiva'] and $input->testIva($_POST['partitaiva']))
                $pm->update("partitaiva", $_POST['partitaiva'], "email_negozio", $utente->getEmail(), $classeDB);
            if ($utente->getAddress() != $_POST['indirizzo'])
                $pm->update("indirizzo", $_POST['indirizzo'], "email_negozio", $utente->getEmail(), $classeDB);
        }
    }

    /*
    public function modificaProfiloImage() {
        $pm = new FPersistentManager();
        $view = new VUser();
        //session_start();
        $sessione=Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                //$utente = unserialize($_SESSION['utente']);
                $utente=$sessione->getUtente();
                    $view->formModificaProfiloImage($utente,"ok");
            } else {
                header('Location: /vinylwebmarket/User/login');
            }
        }
        elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            echo "ciao";
            $utente=$sessione->getUtente();
        $ris = true;
        $img1 = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
        if (get_class($utente) == "EPrivato") {
            if (isset($_FILES['file'])) {
                $nome_file = 'file';
                $img = static::uploadImage($utente, "modificaUtente",$nome_file);
                switch ($img) {
                    case "size":
                        $ris = false;
                        $view->formModificaProfiloImage($utente,"errorSize");
                        break;
                    case "type":
                        $ris = false;
                        $view->formModificaProfiloImage($utente, "errorType");
                        break;
                    case "ok":
                        header('Location: /vinylwebmarket/User/profile');
                        break;
                }
            }
        } elseif (get_class($utente) == "ETrasportatore") {
            if (isset($_FILES['file'])) {
                $img_mezzo = $pm->load("targa", $utente->getVehicle()->getPlate(), "FMediaMezzo");
                $mezzo = $pm->load("plate", $utente->getVehicle()->getPlate(), "FMezzo");
                $nome_file = 'file';
                $img = static::uploadImage($utente, "modificaUtente",$nome_file);
                switch ($img) {
                    case "size":
                        $ris = false;
                        $view->formmodificatrasp($utente, $mezzo, $img1, $img_mezzo, "errorSize");
                        break;
                    case "type":
                        $ris = false;
                        $view->formmodificatrasp($utente, $mezzo, $img1, $img_mezzo, "errorType");
                        break;
                    case "ok":
                        $ris = true;
                        break;
                }
            }
            }
        }
    }
    */

    /**
     * funzione per la modifica della carta
     * 1) se il metodo è GET e si è loggati->form per l'invio delle modifiche.
     * 2) se il metodo è GET ma non si è loggati, allora avviene il reindirizzamento verso la form di login;
     * 3) se il metodo della richiesta HTTP è POST,controllo e gestione dei dati inseriti dall'utente
     *     per effettuare le modifiche(devono essere formati validi)
     * 	  CONTROLLO dei formati dei campi della carta con EInputControl
     */
    public function modificaCarta()
    {
        $pm = new FPersistentManager();
        $view = new VUser();
        //session_start();
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                $view->formModificaCarta($utente, "ok");
            } else
                header('Location: /vinylwebmarket/User/login');
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            //$utente = unserialize($_SESSION['utente']);
            $utente = $sessione->getUtente();
            $controllo = static::updateCarta($utente);
            if ($controllo == "ok") {
                $newutente = $pm->load("email_negozio", $utente->getEmail(), "FNegozio");
                $img1 = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                $sessione->setUtenteLoggato($newutente);
                //$salvare = serialize($newutente);
                //$_SESSION['utente'] = $salvare;
                header('Location: /vinylwebmarket/User/profile');
            }
        }
    }

    /**
     * Funzione che si occupa di fare tutti i controlli necessari per aggiornare la carta che un utente desidera modificare
     * il nuovo object csrta deve passare i test dell'EInputControl per poter effetture effettivamente le modifiche
     *  $utente obj rappresentante l'utente
     */
    static function updateCarta($utente)
    {
        $pm = new FPersistentManager();
        $view = new Vuser;
        $controllo = "ok";
        //public static function exist($field, $value ,$Fclass) {
        $exist = $pm->exist("numero", $_POST['numerocarta'], "Fcarta");
        if ($exist) {
            $view->formModificaCarta($utente, "errorNumberExist");
            $controllo = "errore";
        } else {
            //public static function update($field, $newValue, $keyField, $idValue ,$Fclass) {
            // $pm->load("email_negozio",$utente->getEmail(),"FNegozio");
            $input = EInputControl::getInstance();
            if ($input->testCardNumber($_POST['numerocarta']) and $input->testCvv($_POST['cvv']) and $input->testIntestatario($_POST['intestatario'])) {
                $pm->update("numero", $_POST['numerocarta'], "id", $utente->getCarta()->getId(), "FCarta");
                $pm->update("cvv", $_POST['cvv'], "id", $utente->getCarta()->getId(), "FCarta");
                $pm->update("intestatario", $_POST['intestatario'], "id", $utente->getCarta()->getId(), "FCarta");
                $mese = $_POST["mese"];
                $anno = $_POST["anno"];
                $scadenza = $anno . "-" . $mese . "-01";
                $pm->update("scadenza", $scadenza, "id", $utente->getCarta()->getId(), "FCarta");
            } else {
                $view->formModificaCarta($utente, "errorInput");
                $controllo = "errore";
            }
        }
        return $controllo;
    }

    /**
     * Function per la presentazione del profilo pubblico di un negozio o cliente
     * Get:
     * - se il metodo è GET e si è loggati, avviene il reindirizzamento alla homepage del profilo->si accede a un profilo solo dopo aver mostrato interesse per un vinile
     *   e quindi si è fatta una richietsa di visita ad un profilo pubblico tramite POST
     * - se il metodo è GET e non si è loggati, si viene reindirizzati alla form di login.
     * - se il metodo della richiesta HTTP è GET, ma esiste il cookie allora questo ci permette di caricare la pagina relativa
     *    all'utente che si stava visitando prima del login;
     * POST:
     * - se il metodo della richiesta HTTP è POST ed esiste il valore passato in $_POST['email'] allora viene richiamato
     *      il metodo return_dettaglioutente();
     * - se il metodo della richiesta HTTP è POST  ma non si è loggati, viene inviato un cookie
     *    per tenere traccia delle informazioni utili per il reindirizzamento, dopo il login, alla pagina profilo pubblico dell'utente desiderata;
     */
    public function viewProfilePublic()
    {
        $sessione = Session::getInstance();
            if ($_SERVER['REQUEST_METHOD'] == "GET") {
                if ($sessione->isLoggedUtente()) {
                    header('Location: /vinylwebmarket/User/profile');
                    //header('Location: /vinylwebmarket/');
                } else{
                    header('Location: /vinylwebmarket/User/login');
                }

            } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
                $view = new VUser();
                $pm = new FPersistentManager();
                if ($sessione->isLoggedUtente()) {
                if (isset($_POST['email'])) {
                    static::return_dettaglioutente($_POST['email']);
                    //presente in CRecensione
                }
            } else {
                    setcookie("profilo_visitato", $_POST['email'], time()+900);
                    header('Location: /vinylwebmarket/User/login');
            }
        }
    }

    /**
     * Supporto per viewProfilePublic()
     * Questa funzione recupera i dati per la presentazione del profilo pubblico di un negozio o un privato
     * @param $visitato email del'utente di cui si vuol visitare il profilo
     */
    static function return_dettaglioutente($visitato)
    {
        if (isset($_COOKIE['profilo_visitato'])) {
            setcookie("profilo_visitato", null, time() - 900);
        }
        $view = new VUser();
        $pm = new FPersistentManager();
        $privato = $pm->load("email_privato", $visitato, "FPrivato");
        $negozio = $pm->load("email_negozio", $visitato, "FNegozio");
        if (isset($negozio)) {
            $img = $pm->loadImg("EImageUtente", "email_utente", $visitato);

            $imgrecensioni = static::ImageReviews($negozio);
            $rec = $pm->load("destinatario", $visitato, "FRecensione");
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                //$utente = unserialize($_SESSION['utente']);
                if ($visitato == $utente->getEmail())
                    //se ha cercato lui stesso non si contatta da solo:)
                    //$view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "no");
                    header('Location: /vinylwebmarket/User/profile');
                else
                    $view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "si");
            } else
                $view->profilopubblico($negozio, $negozio->getEmail(), $img, $imgrecensioni, $rec, "si");
        } else {
            $img = $pm->loadImg("EImageUtente", "email_utente", $visitato);
            $imgrecensioni = static::ImageReviews($privato);
            //$rec = static::info_cliente_rec($privato);
            $rec = $pm->load("destinatario", $visitato, "FRecensione");
            $sessione = Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                $utente = $sessione->getUtente();
                // $utente = unserialize($_SESSION['utente']);
                if ($visitato == $utente->getEmail())
                    header('Location: /vinylwebmarket/User/profile');
                   // $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "no");
                else
                    $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "si");
            } else
                $view->profilopubblico($privato, $privato->getEmail(), $img, $imgrecensioni, $rec, "si");
        }
    }

    /**
     * Funzione di supporto per la creazione dell'elenco delle recensioni presenti sul profilo pubblico di un utente
     * @param $user obj EUtente_loggato
     * @return mixed array|ERecensione
     */
    static function ImageReviews($user)
    {
        $pm = new FPersistentManager();
        $recensioniImage = null;
        $recensioni = $pm->load("destinatario", $user->getEmail(), "FRecensione");
        if (isset($recensioni)) {
            if (is_array($recensioni)) {
                foreach ($recensioni as $item) {
                    $recensioniImage[] = $pm->loadImg("EImageUtente", "email_utente", $item->getUsernameMittente());
                    //$recensioniImage = $pm->load("emailutente", $item->getEmailClient(), "FMediaUtente");
                }
            } else {
                $recensioniImage = $pm->loadImg("EImageUtente", "email_utente", $recensioni->getUsernameMittente());
            }
        }
        return $recensioniImage;
    }


    /*
    public function TuoiAnnunci($email)
    {
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                header('Location: /vinylwebmarket/User/profile');
                //header('Location: /vinylwebmarket/');
            } else
                header('Location: /vinylwebmarket/User/login');
        } elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            $view = new VUser();
            $pm = new FPersistentManager();
            if (isset($_POST['email'])) {
                $view = new VUser();
                $pm = new FPersistentManager();
                $vinili = $pm->load("venditore", $email, "FVinile");
                $img=CFiltro::ImageVinyls($vinili);
                $view->TuoiVinili($vinili,$img);
            }
        }
    }
*/

}


