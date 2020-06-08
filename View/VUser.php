<?php
include ('../smartyConfiguration.php');


class VUser
{
    private $smarty;

    public function __construct()
    {
        //FARE IL FILE DI CONFIGURAZIONE StartSmarty.php(mettere fuori dalle cartelle?)
        $this->smarty = smartyConfiguration::configuration();
    }

    public function form_mostra() {
        $this->smarty->display('index.tpl');
    }

    //form di registrazione del privato
    public function form_regPrivato() {
        $this->smarty->display('reg_privato.tpl');
    }

    //form di registrazione del Negozio
    public function form_regNegozio() {
        $this->smarty->display('reg_negozio.tpl');
    }

}