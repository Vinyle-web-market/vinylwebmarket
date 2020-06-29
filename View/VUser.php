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
    public function ErrorRegistrazionePrivato ( string $error) {
        switch ($error) {
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
        $this->smarty->display('reg_privato.tpl');
    }

    //form di registrazione del Negozio
    public function formRegistrazioneNegozio() {
            $this->smarty->display('reg_negozio.tpl');
    }

}