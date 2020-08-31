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

    public function profile($user, $vinili, $image, $tipo, $stato,$imagev)
    {
        if (isset($image)) {
            $pic64 = $image->getDataImage();
            $type = $image->getMimeType();
        } else {
            $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
            $type = "image/png";
        }
        if ($tipo=='ENegozio'){
            $this->smarty->assign('nomeNegozio', $user->getNameShop());
            if ($stato!=null)
            {
                $this->smarty->assign('stato', 'ok');
            }
            else $this->smarty->assign('stato', 'no');
        }

        else {
            $this->smarty->assign('nome', $user->getNome());
            $this->smarty->assign('cognome', $user->getCognome());
            }

        if (isset($imagev)) {
            if (is_array($imagev)) {
                foreach ($imagev as $it) {
                    foreach($it as $item)
                        if (isset($item)) {
                            $pic64v[] = $item->getDataImage();
                            $typev[] = $item->getMimeType();
                        }
                }
                $this->smarty->assign('n_vinili', count($imagev)-1 );
            }
            elseif (isset($imagev)) {
                $pic64v = $imagev->getDataImage();
                $typev = $imagev->getMimeType();
                $this->smarty->assign('n_vinili', 1);
            }
        }
        else
            $this->smarty->assign('n_vinili', 0);


        $this->smarty->assign('typev', $typev);
        $this->smarty->assign('pic64v', $pic64v);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('userlogged', "loggato");
        $this->smarty->assign('email', $user->getEmail());
        $this->smarty->assign('vinili', $vinili);
        //$this->smarty->assign('n_vinili', count($vinili)-1);
        $this->smarty->assign('tipo', $tipo);
        $this->smarty->display('profilo_personale.tpl');
    }

    public function profilePrivato($user, $vinili, $image)
    {
        if (isset($image)) {
            $pic64 = $image->getDataImage();
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
        //$this->smarty->display('claudia.tpl');
        $this->smarty->display('profilo_privato.tpl');
    }

    public function profileNegozio($user, $vinili, $image)
    {
        if (isset($image)) {
            $pic64 = $image->getDataImage();
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
            case "errorPassword":
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

    public function formModificaProfiloNegozio($utente, $image, $errore) {
        switch ($errore) {
            case "errorEmail" :
                $this->smarty->assign('errorEmail', "errore");
                break;
            case "ErrorEmailInput" :
                $this->smarty->assign("errorEmailInput","errore");
                break;
            case "errorPassword":
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
            $pic64 = $img->getDataImage();
        }
        else {
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64 = base64_encode($data);
        }
        $this->smarty->assign('userlogged',"loggato");
        $this->smarty->assign('pic64',$pic64);
        $this->smarty->assign('username',$utente->getUsername());
        $this->smarty->assign('email',$utente->getEmail());
        $this->smarty->assign('telefono',$utente->getPhone());
        $this->smarty->assign('partitaiva',$utente->getPIva());
        $this->smarty->assign('nomenegozio',$utente->getNameShop());
        $this->smarty->assign('indirizzo',$utente->getAddress());
        $this->smarty->display('modificaProfiloNegozio.tpl');
    }
/*
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
                    $this->smarty->assign('errorPasswordInput', "errore");
                    break;

                case "email":
                    $this->smarty->assign('errorEmail', "errore");
                    break;
            }
        }
        $this->smarty->display('modificaProfiloNegozio.tpl');
    }
*/

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
                    $this->smarty->assign('errorPasswordInput', "errore");
                    break;
            }
            $this->smarty->display('modificaProfiloPrivato.tpl');
        }
    }

    /*
    public function formModificaProfiloImage($utente, $errore) {
        switch ($errore) {
            case "errorSize" :
                $this->smarty->assign('errorSize', "errore");
                break;
            case "errorType" :
                $this->smarty->assign('errorType', "errore");
                break;
        }
        $this->smarty->display('modificaProfiloImage.tpl');
    }
    */

    public function formModificaCarta($utente,$errore){
        switch ($errore) {
            case "errorNumberExist" :
                $this->smarty->assign('errorNumberExist', "errore");
                break;
            case "errorInput" :
                $this->smarty->assign("errorInput","errore");
                break;
        }
        $this->smarty->assign('userlogged',"loggato");

        $this->smarty->assign('username',$utente->getUsername());
        $this->smarty->assign('email',$utente->getEmail());
        $this->smarty->assign('telefono',$utente->getPhone());
        $this->smarty->assign('partitaiva',$utente->getPIva());
        $this->smarty->assign('nomenegozio',$utente->getNameShop());
        $this->smarty->assign('indirizzo',$utente->getAddress());
        $this->smarty->display('modificaCarta.tpl');
    }

    public function profilopubblico($user, $emailvisitato, $img,$imgrec,$rec,$cont) {
       // if (count($rec) == 0)
       //     $this->smarty->assign('media_voto', 0);
       // else
       //     $this->smarty->assign('media_voto', $user->averageMark());
        list($typeR,$pic64rec) = $this->SetImageRecensione($imgrec);
        if ($cont == "no")
            $this->smarty->assign('contatta', $cont);
        if ($typeR == null && $pic64rec == null)
            $this->smarty->assign('immagine', "/vinylwebmarket/Smarty/immagini/user.png");
        if (isset($imgrec)) {
            if (is_array($imgrec)) {
                $this->smarty->assign('typeR', $typeR);
                $this->smarty->assign('pic64rec', $pic64rec);
                $this->smarty->assign('n_recensioni', count($imgrec) - 1);
            }
            else {
                $t[] = $typeR;
                $im[] = $pic64rec;
                $this->smarty->assign('typeR', $t);
                $this->smarty->assign('pic64rec', $im);
                $this->smarty->assign('n_recensioni', 0);
            }
        }
        else
            $this->smarty->assign('n_recensioni', 0);
        $this->smarty->assign('rec',$rec);
        $this->smarty->assign('media_rec',static::media($rec));
        list($type,$pic64) = $this->setImage($img, 'user');
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
            $this->smarty->assign('userlogged',"loggato");


        $this->smarty->assign('username',$user->getUsername());
        $this->smarty->assign('email',$user->getEmail());
        $this->smarty->assign('telefono',$user->getPhone());

        if(get_class($user)=="EPrivato"){
            $this->smarty->assign('tipoutente',"privato");
            $this->smarty->assign('nome',$user->getNome());
            $this->smarty->assign('email',$user->getEmail());
            $this->smarty->assign('cognome',$user->getCognome());
        }
        elseif (get_class($user)=="ENegozio"){
            $this->smarty->assign('tipoutente',"negozio");
            $this->smarty->assign('partitaiva',$user->getPIva());
            $this->smarty->assign('nomenegozio',$user->getNameShop());
            $this->smarty->assign('indirizzo',$user->getAddress());
        }
        //var_dump($rec);
        $this->smarty->display('profilo_pub.tpl');

    }

    public function SetImageRecensione ($imgrec) {
        $type = null;
        $pic64 = null;
        if (is_array($imgrec)) {
            foreach ($imgrec as $item) {
                if (isset($item)) {
                    $pic64[] = $item->getDataImage();
                    $type[] = $item->getMimeType();
                } else {
                    $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                    $pic64[] =$data;
                    $type[] = "image/png";
                }
            }
        }
        elseif (isset($imgrec)) {
            $pic64 = $imgrec->getDataImage();
            $type = $imgrec->getMimeType();
        }
        return array($type, $pic64);
    }

    static function media($rec){
        $s=null;
        if (is_array($rec)) {
            foreach ($rec as $item) {
                $s=$s+$item->getVotostelle();
            }
            $m=$s/count($rec);
            return $m;
        }
        elseif($rec!=null){
            return $rec->getVotostelle();
        }
        else {
            return $s; //vale null in caso
        }


    }

    public function setImage($image, $tipo) {
        if (isset($image)) {
            $pic64 = $image->getDataImage();
            $type = $image->getMimeType();
        }
        elseif ($tipo == 'user') {
            $data = file_get_contents( $_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
            $pic64= base64_encode($data);
            $type = "image/png";
        }
        return array($type, $pic64);
    }





}