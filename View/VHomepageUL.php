<?php

class VHomepageUL
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

         public function HomeULprivato(){
        $this->smarty->display("homepage_privato.tpl");
    }

    public function HomeULnegozio() {
        $this->smarty->display('homepage_negozio.tpl');
    }
}