<?php


class VHomepage
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }
    //public function Home($utente){
         public function Home(){
        //$this->smarty->assign("utente",$utente);
        $this->smarty->display("Homepage.tpl");

    }
}