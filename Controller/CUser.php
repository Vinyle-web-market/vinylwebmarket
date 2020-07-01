<?php


class CUser
{
    public function FormRegPrivato()
    {
        $view = new VRegistrazione();
        $view->formRegistrazionePrivato();
    }

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
            }else if($_SERVER['REQUEST_METHOD']=="POST") {
            static::controlRegistrazionePrivato();
        }
	}

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
        $err=array();
        $error_stringa="";
        //POTENZIALE ERRORE QUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
        if ($veremail) {
            $error_stringa = "email";
            $view2->ErrorInputRegistrazionePrivato($err,$error_stringa);

        } else {
            $privato = new EPrivato($username, $email, $password, $telefono, $nome, $cognome);
            $input = EInputControl::getInstance();
            $err = $input->validPrivato($privato);
        if ($err) {
                $view2->ErrorInputRegistrazionePrivato($err,$error_stringa);
            }
            else if ($privato != null) {
            if (isset($_FILES['file'])) {
                $nome_file = 'file';
                $img = static::uploadImage($privato,"registrazionePrivato",$nome_file);
                switch ($img) {
                    case "size":
                        $view2->ErrorInputRegistrazionePrivato($err,"size");
                        break;
                    case "type":
                        $view2->ErrorInputRegistrazionePrivato($err,"typeimg");
                        break;
                    case "ok":
                        header('Location:/vinylwebmarket/Homepage/impostaPaginaULnegozio');
                        break;
                }
                }
            }
            }
        }

    public function FormRegNegozio()
    {
        $view = new VRegistrazione();
        $view->formRegistrazioneNegozio();
    }

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
        }else if($_SERVER['REQUEST_METHOD']=="POST") {
            static::controlRegistrazioneNegozio();
        }
    }

    public function controlRegistrazioneNegozio(){
        $ris = "ok";
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $telefono = $_POST["telefono"];
        $nomeNegozio = $_POST["nomenegozio"];
        $iva = $_POST["partitaiva"];
        $indirizzo = $_POST["indirizzo"];
        //carta
        $numeroCarta=$_POST["numerocarta"];
        $cvv=$_POST["cvv"];
        $intestatario=$_POST["intestatario"];
        $mese=$_POST["mese"];
        $anno=$_POST["anno"];
        $scadenza=$anno."-".$mese."-01";
        $ris = "ok";
        $pm = new FPersistentManager();
        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
        $view2 = new VUser();
        $err=array();
        $error_stringa="";
        //POTENZIALE ERRORE QUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
        if ($veremail) {
            $error_email = "email";
            $view2->ErrorInputRegistrazioneNegozio($err,$error_email);

        } else {
            $abb=new EAbbonamento();
            $carta=new ECarta($intestatario,$numeroCarta,$scadenza,$cvv);
            $negozio = new ENegozio($username, $email, $password, $telefono, $nomeNegozio, $iva,$indirizzo,$carta,$abb);
            $input = EInputControl::getInstance();
            $err = $input->validNegozio($negozio);
            //Rivederer da qui
            if ($err) {
                $view2->ErrorInputRegistrazioneNegozio($err,$error_stringa);
            }
            else if ($negozio != null) {
                if (isset($_FILES['file'])) {
                    $nome_file = 'file';
                    $img = static::uploadImage($negozio,"registrazioneNegozio",$nome_file);
                    switch ($img) {
                        case "size":
                            $view2->ErrorInputRegistrazioneNegozio($err,"size");
                            break;
                        case "type":
                            $view2->ErrorInputRegistrazioneNegozio($err,"typeimg");
                            break;
                        case "ok":
                            header('Location:/vinylwebmarket/');
                            break;
                    }
                }
            }
        }

    }


    static function uploadImage($utente,$funz,$nome_file)
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
                        $data = file_get_contents($img["tmp_name"]);
                        $data = base64_encode($data);
                        $pm->store($utente);
                        $mutente = new EImageUtente($name, $data, $type, $utente->getEmail());
                        $pm->storeImg($mutente);
                        //return "ok";
                        $ris = "ok";
                    } elseif ($funz == "modificaUtente") {
                        /* DA IMPLEMENTARE
                        $pm->delete("emailutente",$utente->getEmail(),"FMediaUtente");
                        $mutente = new EMediaUtente($nome, $utente->getEmail());
                        $mutente->setType($type);
                        $pm->storeMedia($mutente,$nome_file);
                        //return "ok";
                        $ris = "ok";
                        */

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
     *   - se l'utente è già loggato viene reindirizzato alla homepage;
     * 	 - se l'utente non è loggato si viene indirizzati alla form di login;
     * 2) se il metodo della richiesta HTTP è POST viene richiamata la funzione verifica().
     */
    static function login (){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $sessione = Session::getInstance();
            if($sessione->isLoggedUtente()) {
                $pm = new FPersistentManager();
                //CARICAMENTO PROFILO
                /*
                $view = new VUtente();
                $result = $pm->loadTrasporti();
                $view->loginOk($result);
                */
            }
            else{
                $view=new VUser();
                $view->formLogin();
            }
        }elseif ($_SERVER['REQUEST_METHOD']=="POST")
            static::checkLogin();
    }

    /**
     * Controllo esistenza username e password nel db
     * 1)risultato negativo->viene ricaricata la pagina con l'aggunta dell'errore nel login.
     * 2) se l'utente ed è attivo, avviene il reindirizzamaneto alla homepage degli annunci;
     * 3) se le credenziali inserite rispettano i vincoli per l'amministratore, avviene il reindirizamento alla homepage dell'amministratore;
     * 4) se si verifica la presenza di particolari cookie avviene il reindirizzamento alla pagina specifica.
     */
    static function checkLogin() {
        $view = new VUser();
        $email="";
        $valoreMail="non settato";
        $pm = new FPersistentManager();
        $exist=$pm->exist('email',$_POST['email'],"FUtente_loggato");
        if($exist){
            $email="esiste";
            $valoreMail=$_POST['email'];
        }
        $utente = $pm->loginUtente($_POST['email'], $_POST['password']);
        if ($utente != null && $utente->isState() != false) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $salva_sessione = serialize($utente);
                $_SESSION['utente'] = $salva_sessione;
                if ($_POST['email'] != 'admin@admin.com') {
                    if (isset($_COOKIE['chat']) && $_COOKIE['chat'] != $_POST['email']){
                        header('Location: /FillSpaceWEB/Messaggi/chat');
                    }
                    elseif (isset($_COOKIE['nome_visitato'])) {
                        header('Location: /FillSpaceWEB/Utente/dettaglioutente');
                    }
                    else {
                        if (isset($_COOKIE['chat']))
                            setcookie("chat", null, time() - 900,"/");
                        else
                            header('Location: /FillSpaceWEB/');
                    }
                }
                else {
                    header('Location: /FillSpaceWEB/Admin/homepage');
                }
            }
        }
        else {
            $view->loginError($email,$valoreMail);
        }
    }










}


