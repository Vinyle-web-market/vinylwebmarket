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
    /*
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
    */

    //Errore durante la registrazione
    public function ErrorInputRegistrazionePrivato ($errori,$errore) {
        switch ($errore) {
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
        /*
        foreach ($errori as $err){
            if($err=="username")
            $this->smarty->assign('errorUsername',"errore");
            if($err=="email")
            $this->smarty->assign('errorEmail',"errore");
            if($err=="cognome")
            $this->smarty->assign('errorCognome',"errore");
            if($err=="nome")
            $this->smarty->assign('errorNome',"errore");
            if($err=="telefono")
            $this->smarty->assign('errorTelefono',"errore");
            if($err=="password")
            $this->smarty->assign('errorPassword',"errore");
        }
        */
        $this->smarty->display('reg_privato.tpl');
    }

    //form di registrazione del Negozio
    public function formRegistrazioneNegozio() {
            $this->smarty->display('reg_negozio.tpl');
    }

    public function ErrorInputRegistrazioneNegozio ($errori,$errore)
    {
        switch ($errore) {
            case "email":
                $this->smarty->assign('errorEmailExist', "errore");
                break;
            case "typeimg" :
                $this->smarty->assign('errorType', "errore");
                break;
            case "size" :
                $this->smarty->assign('errorSize', "errore");
                break;
        }
        foreach ($errori as $err) {
            switch ($err) {
                case "username":
                    $this->smarty->assign('errorUsername', "errore");
                    break;

                case "nome":
                    $this->smarty->assign('errorNome', "errore");
                    break;

                case "partitaiva":
                    $this->smarty->assign('errorPartitaiva', "errore");
                    break;

                case "password":
                    $this->smarty->assign('errorPassword', "errore");
                    break;

                case "email":
                    $this->smarty->assign('errorEmail', "errore");
                    break;

                case "numerocarta":
                    $this->smarty->assign('errorNumerocarta', "errore");
                    break;

                case "cvv":
                    $this->smarty->assign('errorCvv', "errore");
                    break;

                case "intestatario":
                    $this->smarty->assign('errorIntestatario', "errore");
                    break;

            }
        }
        $this->smarty->display('reg_negozio.tpl');
    }

    /**
     * Funzione che si occupa di gestire la visualizzazione della form di login
     * @throws SmartyException
     */
    public function formLogin(){
        $this->smarty->display('login.tpl');
    }


}