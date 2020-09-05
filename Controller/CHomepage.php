<?php


class CHomepage
{
    /**
     * Funzione che si occupa di gestire il recupero dedli ULTIMI 6 VINILI  PERla visualizzazione dell'Homepage del nostro sito
     * Precisamnete prepara attraverso una funzioni di Foundation 6 vinili e le rispettive immagini per il carosselo
     */
    public function impostaPagina()
    {
        $result=null;
        $img=null;
        $view = new VHomepage();
        $pm = new FPersistentManager();
        list($result,$img) = $pm->vinylHome();
        $view->Home($result,$img);
    }

    /**
     * Funzione che si occupa di gestire il recupero dedli ULTIMI 6 VINILI PER la visualizzazione dell'Homepage del untente registrato che si presenta simile alla home generale
     * Precisamnete prepara attraverso una funzioni di Foundation 6 vinili e le rispettive immagini per il carosselo
     */
    public function impostaPaginaUL()
    {
        $result=null;
        $img=null;
        $view = new VHomepage();
        $pm = new FPersistentManager();
        list($result,$img) = $pm->vinylHome();
        $view->HomeUL($result,$img);
    }
/*
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
*/
}