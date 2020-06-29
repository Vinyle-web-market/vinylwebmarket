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


    static function registrazionePrivato()
    {
        $sessione = Session::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            if ($sessione->isLoggedUtente()) {
                header('Location: /FillSpaceWEB/');
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
            if ($privato != null) {
                echo $privato->toString();
                $pm->store($privato);
            }
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
            switch ($ris) {
                case "size":
                    $view->ErrorRegistrazionePrivato("size");
                    break;
                case "type":
                    $view->ErrorRegistrazionePrivato("typeimg");
                    break;
                case "ok":
                    //header('Location: /vinylwebmarket/User/login');
                    header('Location: /vinylwebmarket/');
                    break;
            }
        }














}
