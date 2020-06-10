<?php


class CUser
{
    public function FormRegPrivato()
    {
        $view = new VUser();
        $view->formRegistrazionePrivato();
    }

    public function FormRegNegozio()
    {
        $view = new VUser();
        $view->formRegistrazioneNegozio();
    }

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

}