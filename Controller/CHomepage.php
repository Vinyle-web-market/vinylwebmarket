<?php


class CHomepage
{
    public function impostaPagina()
    {
        $view = new VHomepage();
        $view->Home();
    }
    public function impostaPaginaULnegozio()
    {
        $view = new VHomepageUL();
        $view->HomeULprivato();
    }
    public function impostaPaginaULprivato()
    {
        $view = new VHomepageUL();
        $view->HomeULnegozio();
    }
}