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
    public function formRegistrazionePrivato()
    {
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
    public function ErrorInputRegistrazionePrivato($errori, $errore)
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
                case "email":
                    $this->smarty->assign('errorEmail', "errore");
                    break;
                case "cognome":
                    $this->smarty->assign('errorCognome', "errore");
                    break;
                case "nome":
                    $this->smarty->assign('errorNome', "errore");
                    break;
                case "telefono":
                    $this->smarty->assign('errorTelefono', "errore");
                    break;
                case "password":
                    $this->smarty->assign('errorPassword', "errore");
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
    public function formRegistrazioneNegozio()
    {
        $this->smarty->display('reg_negozio.tpl');
    }

    public function ErrorInputRegistrazioneNegozio($errori, $errore)
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
    public function formLogin()
    {
        $this->smarty->display('login.tpl');
    }

    /**
     * Display login in caso di login non effettuato
     * @throws SmartyException
     * passo la variabile exist con true se l'email è salvato nel db
     */
    public function loginError($exist, $valoreMail)
    {
        if ($exist == "esiste") {
            $this->smarty->assign("emailExist", "exist");
            $this->smarty->assign("valoreEmail", $valoreMail);
        }
        $this->smarty->assign('errorLogin', "errore");
        $this->smarty->display('login.tpl');
    }

    public function profilePrivato($user, $vinili, $image)
    {
        if (isset($image)) {
            $pic64 = base64_encode($image->getDataImage());
            $type = $image->getMimeType();
        } else {
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
            $type = "image/png";
        }
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('userlogged', "loggato");
        $this->smarty->assign('nome', $user->getNome());
        $this->smarty->assign('cognome', $user->getCognome());
        $this->smarty->assign('email', $user->getEmail());
        $this->smarty->assign('array', $vinili);
        $this->smarty->display('profilo_privato.tpl');
    }

    public function profileNegozio($user, $vinili, $image)
    {
        if (isset($image)) {
            $pic64 = base64_encode($image->getDataImage());
            $type = $image->getMimeType();
        } else {
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
            $type = "image/png";
        }
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('userlogged', "loggato");
        $this->smarty->assign('nomeNegozio', $user->getNameShop());
        $this->smarty->assign('email', $user->getEmail());
        $this->smarty->assign('array', $vinili);
        $this->smarty->display('profilo_negozio.tpl');
    }

        /**
         * Funzione che si occupa di gestire la visualizzazione della form di modifica per il cliente
         * @param $user informazioni sull'utente che desidera mdificare i suoi dati
         * @param $img immagine dell'utente
         * @param $error tipo di errore nel caso in cui le modifiche siano sbagliate
         * @throws SmartyException
         */
        public function formModificaProfiloPrivato($utente, $image, $errore) {
        switch ($errore) {
            case "errorEmail" :
                $this->smarty->assign('errorEmail', "errore");
                break;
            case "ErrorEmailInput" :
                $this->smarty->assign("errorEmailInput","errore");
                break;
            case "errorPassw":
                $this->smarty->assign('errorPassword', "errore");
                break;
            case "errorSize" :
                $this->smarty->assign('errorSize', "errore");
                break;
            case "errorType" :
                $this->smarty->assign('errorType', "errore");
                break;
        }
        if (isset($img)) {
            $pic64 = base64_encode($img->getDataImage());
        }
        else {
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
        }
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('pic64',$pic64);
        $this->smarty->assign('username',$utente->getUsername());
        $this->smarty->assign('nome',$utente->getNome());
        $this->smarty->assign('email',$utente->getEmail());
        $this->smarty->assign('cognome',$utente->getCognome());
        $this->smarty->assign('telefono',$utente->getPhone());
        $this->smarty->display('modificaProfiloPrivato.tpl');
    }

    public function ErrorInputModificaNegozio($errori)
    {
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
            }
        }
        $this->smarty->display('modificaProfiloNegozio.tpl');
    }

    public function ErrorInputModificaPrivato($errori)
    {
        foreach ($errori as $err) {
            switch ($err) {
                case "username":
                    $this->smarty->assign('errorUsername', "errore");
                    break;
                case "email":
                    $this->smarty->assign('errorEmail', "errore");
                    break;
                case "cognome":
                    $this->smarty->assign('errorCognome', "errore");
                    break;
                case "nome":
                    $this->smarty->assign('errorNome', "errore");
                    break;
                case "telefono":
                    $this->smarty->assign('errorTelefono', "errore");
                    break;
                case "password":
                    $this->smarty->assign('errorPassword', "errore");
                    break;
            }
            $this->smarty->display('modificaProfiloPrivato.tpl');
        }
    }


}