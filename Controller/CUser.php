<?php


class CUser
{
    public function FormRegistrazionePrivato()
    {
        $view = new VUser();
        $view->formRegistrazionePrivato();
    }

    public function registratione_privato()
    {
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
          $pm = new FPersistentManager();
          $email_esistente = $pm->exist("email", $_POST['email'],"FUtente_loggato");
          if ($email_esistente) {
              echo 'gia esistente';
                                }
          else
              // $utenteloggato = new EUtente_loggato($_POST['username'],$_POST['email'],$_POST['password'],$_POST['telefono']);
              $privato = new EPrivato($_POST['username'],$_POST['email'],$_POST['password'],$_POST['telefono'],$_POST['nome'],$_POST['cognome']);
              $pm->store($privato);
        }
    }

}