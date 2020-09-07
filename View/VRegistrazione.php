<?php


/**
 * La classe VRegistrazione si occupa dell'input / output riguardante la registrazione
 * di tutti gli utenti che vogliono entrare nel sito.
 * @author Cruciani - Nanni - Scarselli
 * @package View
 */

class VRegistrazione
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

    //form di registrazione del Negozio
    public function formRegistrazioneNegozio() {
        $this->smarty->display('reg_negozio.tpl');
    }
}