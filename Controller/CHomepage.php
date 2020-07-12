<?php


class CHomepage
{
    public function impostaPagina()
    {
        $result=null;
        $img=null;
        $view = new VHomepage();
        $pm = new FPersistentManager();
        list($result,$img) = $pm->vinylHome();
        $view->Home($result,$img);
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