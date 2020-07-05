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
                        header('Location:/vinylwebmarket/Homepage/impostaPaginaULprivato');
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
                            header('Location:/vinylwebmarket/Homepage/impostaPaginaULnegozio');
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
                        $imagex=$pm->loadImg("EImageUtente","email_utente",$utente->getEmail());
                        if($imagex) {
                            $pm->deleteImg("EImageUtente", "email_utente", $utente->getEmail());
                        }
                        //public static function deleteImg(string $categoriaImage,$field, $id){
                        $img = $_FILES["file"];
                        $data = file_get_contents($img["tmp_name"]);
                        $data = base64_encode($data);
                        $mutente = new EImageUtente($img["name"],$data,$img["type"], $utente->getEmail());
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
     * 1)risultato negativo->viene ricaricata la pagina con l'aggunta dell'errore nel login.
     * 2) se l'utente ed è attivo, avviene il reindirizzamaneto alla homepage degli annunci;
     * 3) se le credenziali inserite rispettano i vincoli per l'amministratore, avviene il reindirizamento alla homepage dell'amministratore;
     * 4) se si verifica la presenza di particolari cookie avviene il reindirizzamento alla pagina specifica.
     * @throws SmartyException
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
            $sessione=Session::getInstance();
            $sessione->setUtenteLoggato($utente);
            /*if (session_status() == PHP_SESSION_NONE) {
                session_start();
                $salva_sessione = serialize($utente);
                $_SESSION['utente'] = $salva_sessione;*/
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
                        else {
                            if(get_class($utente)== "EPrivato")
                                 header('Location: /vinylwebmarket/Homepage/impostaPaginaULprivato/');
                            else
                                header('Location: /vinylwebmarket/Homepage/impostaPaginaULnegozio/');
                        }
                    }
                }
                else {
                    header('Location: /FillSpaceWEB/Admin/homepage');
                }
           // }
        }
        else {
            $view->loginError($email,$valoreMail);
        }
    }

    /** Funzione che mostra il profilo dell'utente loggato.
     * 1) se il metodo di richiesta HTTP è GET e si è loggati, avviene il reindirizzamento al profilo.
     *    Tale reindirizzamento avviene tramite il controllo se si è un Privato o negozio;
     * 2) altrimenti, avviene il reindirizzamento alla form di login
     */
    static function profile() {
        $view = new VUser();
        $pm = new FPersistentManager();
        if($_SERVER['REQUEST_METHOD'] == "GET") {
            $sessione=Session::getInstance();
            if ($sessione->isLoggedUtente()) {
                $utente=$sessione->getUtente();
               // $utente = unserialize($_SESSION['utente']);
                if (get_class($utente) == "EPrivato") {
                    $img = $pm->loadImg("EImageUtente", "email_utente",$utente->getEmail());
                    $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                    //RECENSIONI
                    $view->profilePrivato($utente, $vinili, $img);
                } else {
                    $img = $pm->loadImg("EImageVinile", "email_utente", $utente->getEmail());
                    $annunci = $pm->load("venditore", $utente->getEmail(), "FVinile");
                    //RECENSIONI
                    $view->profileNegozio($utente, $annunci, $img,);
                }
            } else
                header('Location: /vinylwebmarket/User/login');
        }
    }

    public function modificaProfilo()
    {
        $pm = new FPersistentManager();
        $view = new VUser();
        //session_start();
        $sessione=Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                //$utente = unserialize($_SESSION['utente']);
                $utente=$sessione->getUtente();
                $img = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
                if (get_class($utente) == "EPrivato") {
                    $view->formModificaProfiloPrivato($utente, $img, "ok");
                } else {
                    $view->formModificaProfiloNegozio($utente, $img , "ok");
                }
            } else
                header('Location: /vinylwebmarket/User/login');
        }
        elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
            //$utente = unserialize($_SESSION['utente']);
            $utente=$sessione->getUtente();
            $img = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
            if (get_class($utente) == "EPrivato") {
                if ($utente->getPassword() == $_POST['old_password']) {
                    if ($utente->getEmail() == $_POST['email']) {
                        $statoimg = static::modificaprofiloimmagine($utente);
                        if ($statoimg) {
                            $err=static::updateCampi($utente);
                            $newutente = $pm->load("email_privato", $utente->getEmail(), "FPrivato");
                                $salvare = serialize($newutente);
                                $_SESSION['utente'] = $salvare;
                                header('Location: /vinylwebmarket/User/profile');

                        }
                    } else {  //se vuole cambiare anche l'email
                        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
                        if ($veremail) {
                            //UTENTE GIA NEL DB
                            $view->formModificaProfiloPrivato($utente, $img, "errorEmail");
                        } else {
                            $statoimg = static::modificaprofiloimmagine($utente);
                            if ($statoimg) {
                                static::updateCampi($utente);
                                $input=EInputControl::getInstance();
                                if($input->testEmail($_POST['email'])){
                                $pm->update("email", $_POST['email'], "email", $utente->getEmail(), "FUtente_loggato");
                                $newutente = $pm->load("email_privato", $_POST['email'], "FPrivato");
                                    $img1 = $pm->loadImg("EImageUtente", "email_utente",$utente->getEmail());
                                    $vinili = $pm->load("venditore", $utente->getEmail(), "FVinile");
                                    $sessione->setUtenteLoggato($newutente);
                                //$salvare = serialize($newutente);
                                //$_SESSION['utente'] = $salvare;
                                $view->profilePrivato($newutente, $vinili, $img1);
                                }else{
                                    $view->formModificaProfiloPrivato($utente, $img, "errorEmailInput");
                                }
                            }
                        }
                    }
                } else {
                    //ERRORE PASSWORD
                    $view->formModificaProfiloPrivato($utente, $img, "errorPassword");
                }
            }
        }

    }
    /**
     * Funzione che si occupa di fare tutti i controlli necessari per aggiornare i coli campi che un utente desidera modificare
     * nella sua form di modifica profilo
     * @param $utente obj rappresentante l'utente

     */
    static function updateCampi($utente) {
        $pm = new FPersistentManager();
        $view=new Vuser;
        $result=array();
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
        if(get_class($utente) == "ENegozio") {
            $classeDB="FNegozio";
            $input = EInputControl::getInstance();
            if ($utente->getUsername() != $_POST['username'])
                $pm->update("username", $_POST['username'], "email", $utente->getEmail(), "FUtente_loggato");
          //  if ($utente->getEmail() != $_POST['email'])
            //    $pm->update("email", $_POST['email'], "email", $utente->getEmail(), $classeDB);
            if ($_POST['new_password'] != "")
                $pm->update("password", $_POST['new_password'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getPhone() != $_POST['telefono'])
                $pm->update("telefono", $_POST['telefono'], "email", $utente->getEmail(), "FUtente_loggato");
            if ($utente->getNameShop() != $_POST['nomenegozio'])
                $pm->update("nomenegozio", $_POST['nomenegozio'], "email_negozio", $utente->getEmail(), $classeDB);
            if ($utente->getPIva() != $_POST['partitaiva'])
                $pm->update("partitaiva", $_POST['partitaiva'], "email_negozio", $utente->getEmail(), $classeDB);
            if ($utente->getAddress() != $_POST['indirizzo'])
                $pm->update("indirizzo", $_POST['indirizzo'], "email_negozio", $utente->getEmail(), $classeDB);
        }
    }

    static function modificaprofiloimmagine($utente) {
        $view = new VUser();
        $pm = new FPersistentManager();
        $ris = true;
        $img1 = $pm->loadImg("EImageUtente", "email_utente", $utente->getEmail());
        if (get_class($utente) == "EPrivato") {
            if (isset($_FILES['file'])) {
                $nome_file = 'file';
                $img = static::uploadImage($utente, "modificaUtente",$nome_file);
                switch ($img) {
                    case "size":
                        $ris = false;
                        $view->formModificaProfiloPrivato($utente, $img1, "errorSize");
                        break;
                    case "type":
                        $ris = false;
                        $view->formModificaProfiloPrivato($utente, $img1, "errorType");
                        break;
                    case "ok":
                        $ris = true;
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
                if ($ris == true) {
                    if ($_FILES['imm_mezzo']['name'] != null) {
                        $nome_file_img = "imm_mezzo";
                        $img_m = static::upload_media_mezzo($utente,$nome_file_img);
                        switch ($img_m) {
                            case "size":
                                $ris = false;
                                $view->formmodificatrasp($utente, $mezzo, $img1, $img_mezzo, "errorSizeM");
                                break;
                            case "type":
                                $ris = false;
                                $view->formmodificatrasp($utente, $mezzo, $img1, $img_mezzo, "errorTypeM");
                                break;
                            case "ok":
                                $ris = true;
                                break;
                        }
                    }
                }
            }
        }
        return $ris;
    }













}


