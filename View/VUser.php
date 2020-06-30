<?php


class VUser
{
    private $smarty;

    public function __construct()
    {
        //FARE IL FILE DI CONFIGURAZIONE StartSmarty.php(mettere fuori dalle cartelle?)
        $this->smarty = smartyConfiguration::configuration();
    }


    //form di registrazione del privato
    public function formRegistrazionePrivato() {
        $this->smarty->display('reg_privato.tpl');
    }
    //Errore durante la registrazione
    public function ErrorRegistrazionePrivato (string $errori) {

        switch ($errori) {
            case "email":
                $this->smarty->assign('errorEmailExist',"errore");
                break;
            case "typeimg" :
                $this->smarty->assign('errorType',"errore");
                break;
            case "size" :
                $this->smarty->assign('errorSize',"errore");
                break;
        }
        $this->smarty->display('reg_privato.tpl');
    }

    //Errore durante la registrazione
    public function ErrorInputRegistrazionePrivato (array $errori) {
        foreach ($errori as $err){
            switch($err){
                case "username":
                    $this->smarty->assign('errorUsername',"errore");
                    break;
                case "email":
                    $this->smarty->assign('errorEmail',"errore");
                    break;
                case "cognome":
                    $this->smarty->assign('errorCognome',"errore");
                    break;
                case "nome":
                    $this->smarty->assign('errorNome',"errore");
                    break;
                case "telefono":
                    $this->smarty->assign('errorTelefono',"errore");
                    break;
                case "password":
                    $this->smarty->assign('errorPassword',"errore");
                    break;
            }
        }
        $this->smarty->display('reg_privato.tpl');
    }

    //form di registrazione del Negozio
    public function formRegistrazioneNegozio() {
            $this->smarty->display('reg_negozio.tpl');
    }

    public function ErrorRegistrazioneNegozio (string $errori) {

        switch ($errori) {
            case "email":
                $this->smarty->assign('errorEmail',"errore");
                break;
            case "typeimg" :
                $this->smarty->assign('errorType',"errore");
                break;
            case "size" :
                $this->smarty->assign('errorSize',"errore");
                break;
        }
        $this->smarty->display('reg_negozio.tpl');
    }


}