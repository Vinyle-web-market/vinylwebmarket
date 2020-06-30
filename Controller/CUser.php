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
        $err=null;
        //POTENZIALE ERRORE QUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
        if ($veremail) {
            $error_email = "email";
            $view2->ErrorRegistrazionePrivato($error_email);

        } else {
            $privato = new EPrivato($username, $email, $password, $telefono, $nome, $cognome);
            $input = EInputControl::getInstance();
            $err = $input->validPrivato($privato);
        if (!$err) {
                $view2->ErrorInputRegistrazionePrivato($err);
            }
            if ($privato != null) {
            if (isset($_FILES['file'])) {
                $nome_file = 'file';
                $img = static::uploadImage($privato,"registrazionePrivato",$nome_file);
                switch ($img) {
                    case "size":
                        $view2->ErrorRegistrazionePrivato("size");
                        break;
                    case "type":
                        $view2->ErrorRegistrazionePrivato("typeimg");
                        break;
                    case "ok":
                        header('Location:/vinylwebmarket/');
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
        $nomeNegozio = $_POST["nome"];
        $iva = $_POST["partitaiva"];
        $indirizzo = $_POST["indirizzo"];
        //carta
        $numeroCarta=$_POST["numero"];
        $cvv=$_POST["cvv"];
        $intestatario=$_POST["intestatario"];
        $scadenza=$_POST["scadenza"];
        $ris = "ok";
        $pm = new FPersistentManager();
        $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
        $view2 = new VUser();
        $err=null;
        //POTENZIALE ERRORE QUIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIIII
        if ($veremail) {
            $error_email = "email";
            $view2->ErrorRegistrazioneNegozio($error_email);

        } else {
            $abb=new EAbbonamento();
            $carta=new ECarta($intestatario,$numeroCarta,$scadenza,$cvv);
            $negozio = new ENegozio($username, $email, $password, $telefono, $nomeNegozio, $iva,$indirizzo,$carta,$abb);
            $input = EInputControl::getInstance();
            $err = $input->validNegozio($negozio);
            //Rivederer da qui
            if (!$err) {
                $view2->ErrorInputRegistrazionePrivato($err);
            }
            if ($negozio != null) {
                if (isset($_FILES['file'])) {
                    $nome_file = 'file';
                    $img = static::uploadImage($privato,"registrazionePrivato",$nome_file);
                    switch ($img) {
                        case "size":
                            $view2->ErrorRegistrazionePrivato("size");
                            break;
                        case "type":
                            $view2->ErrorRegistrazionePrivato("typeimg");
                            break;
                        case "ok":
                            header('Location:/vinylwebmarket/');
                            break;
                    }
                }
            }
        }

    }

    static function uploadImage($utente,$funz,$nome_file) {
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
            if ($funz == "registrazionePrivato") {
                $pm->store($utente);
                //return "ok";
                $ris = "ok";
            }
            if ($funz == "registrazioneNegozio") {
              //da implementare
            }
        } else {
            if ($size > $max_size) {
                //Il file è troppo grande
                //return "size";
                $ris = "size";
            }
            //$type = $_FILES[$nome_file]['type'];
            elseif ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/jpg') {
                if ($funz == "registrazionePrivato") {
                    $data = file_get_contents($img["tmp_name"]);
                    $data = base64_encode($data);
                    $pm->store($utente);
                    $mutente = new EImageUtente($name, $data, $type, $utente->getEmail());
                    $pm->storeImg($mutente);
                    //return "ok";
                    $ris = "ok";
                }
                elseif ($funz == "modificaUtente") {
                    /* DA IMPLEMENTARE
                    $pm->delete("emailutente",$utente->getEmail(),"FMediaUtente");
                    $mutente = new EMediaUtente($nome, $utente->getEmail());
                    $mutente->setType($type);
                    $pm->storeMedia($mutente,$nome_file);
                    //return "ok";
                    $ris = "ok";
                    */
                }
                elseif ($funz = "registrazioneTrasportatore") {
                    $a = static:: reg_immagine_mezzo_tra($utente,$max_size,$nome,true,$nome_file);
                    //return $a;
                    $ris = $a;
                }
            }
            else {
                //formato diverso
                //return "type";
                $ris = "type";
            }
        }
        return $ris;
    }









}


