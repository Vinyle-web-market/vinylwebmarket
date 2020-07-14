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
        $result=null;
        $img=null;
        $view = new VHomepageUL();
        $pm = new FPersistentManager();
        list($result,$img) = $pm->vinylHome();
        $view->HomeULnegozio($result,$img);
    }
    public function impostaPaginaULprivato()
    {
        $result=null;
        $img=null;
        $view = new VHomepageUL();
        $pm = new FPersistentManager();
        list($result,$img) = $pm->vinylHome();
        $view->HomeULprivato($result,$img);
    }
}