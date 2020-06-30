<?php


class CUser
{
    public function FormRegPrivato()
    {
        $view = new VRegistrazione();
        $view->formRegistrazionePrivato();
    }

    public function FormRegNegozio()
    {
        $view = new VRegistrazione();
        $view->formRegistrazioneNegozio();
    }


/*
    public function registrazione_privato()
    {
          $pm = new FPersistentManager();
          $email_esistente = $pm->exist("email", $_POST['email'],"FUtente_loggato");
          if ($email_esistente) {
              echo 'gia esistente';
                                }
          else
              // $utenteloggato = new EUtente_loggato($_POST['username'],$_POST['email'],$_POST['password'],$_POST['telefono']);
              $privato = new EPrivato($_POST['username'],$_POST['email'],$_POST['password'],$_POST['telefono'],$_POST['nome'],$_POST['cognome']);
              $pm->store($privato);
              header('Location: /vinylwebmarket/');
    }
*/

/*
    static function registrazionePrivato1()
    {
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                header('Location: /vinylwebmarket/');
            } else {
                $view = new VRegistrazione();
                $view->formRegistrazionePrivato();
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $nome = $_POST["nome"];
            $cognome = $_POST["cognome"];
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $telefono = $_POST["telefono"];
            $error_email = false;
            $ris="ok";
            $pm = new FPersistentManager();
            $veremail = $pm->exist("email", $_POST['email'], "FUtente_loggato");
            $view2 = new VUser();
            if ($veremail) {
                $error_email = "Email";
                $view2->ErrorRegistrazionePrivato($error_email);
            } else {
                    $privato = new EPrivato($username, $email, $password, $telefono, $nome, $cognome);
                    $input=EInputControl::getInstance();
                    $err=$input->validPrivato($privato);
                    if(!$err){
                        $view2->ErrorInputRegistrazionePrivato($err);
                             }
           else if ($privato != null) {
                $pm->store($privato);
                if (isset($_FILES['file'])) {
                    $img = $_FILES["file"];
                    $ris = null;
                    $nome = '';
                    $max_size = 300000;
                    $result = is_uploaded_file($img['tmp_name']);
                    $img = $_FILES["file"];
                    $name = $img["name"];
                    $size = $img['size'];
                    $mimeType = $img["type"];
                    $data = file_get_contents($img["tmp_name"]);
                    $data = base64_encode($data);
                    if (!$result) {  //no image
                        $pm->store($privato);
                        //return "ok";
                        $ris = "ok";
                    } else {
                        if ($size > $max_size) {
                            //Il file è troppo grande
                            //return "size";
                            $ris = "size";
                        } elseif ($mimeType == 'image/jpeg' || $mimeType == 'image/png' || $mimeType == 'image/jpg') {
                            //$pm->store($privato);
                            $file = new EImageUtente($name, $data, $mimeType, $email);
                            $pm->storeImg($file);
                            //return "ok";
                            $ris = "ok";
                        } else {
                            $ris = "type";
                        }
                    }
                }
            }
        }
        }
            $view2=new VUser();
            switch ($ris) {
                case "size":
                    $view->ErrorRegistrazionePrivato("size");
                    break;
                case "type":
                    $view->ErrorRegistrazionePrivato("typeimg");
                    break;
                case "ok":
                    //header('Location: /vinylwebmarket/User/login');
                    //header('Location: /vinylwebmarket/User/login');
                    break;
            }
        }
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
                var_dump($_FILES['file']);
            if (isset($_FILES['file'])) {
                $nome_file = 'file';
                echo'ciao bayyy';
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


