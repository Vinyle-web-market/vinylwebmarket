<?php

/**
 * La classe VFiltro si occupa dell'input / output riguardante il filtraggio
 * di tutte le caratteristiche dei vinili che esposti nella vetrina
 * del nostro sito.
 * @author Cruciani - Nanni - Scarselli
 * @package View
 */

class VFiltro
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Vetrina aggiornata dopo il filtraggio applicato dall'utentr.
     * neanche serve, bastava richiamare la funzione in VVinile per la presentazione della vetrina
     * @param $result contiene i vinili
     * @param $img un'immagine per vinile
     * @throws SmartyException
     */
    public function ViniliCercati($result,$img,$imgP){
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
            $this->smarty->assign('userlogged',"loggato");

        $type=null;
        $typeP=null;
        $pic64=null;
        $pic64P=null;



        if (isset($img)) {
            if (is_array($img)) {
                foreach ($img as $it) {
                    foreach ($it as $ite){
                      foreach ($ite as $item) {
                        if (isset($item)) {
                            $pic64[] = $item->getDataImage();
                            $type[] = $item->getMimeType();
                           }
                        }
                    }
                }
                $this->smarty->assign('n_vinili', count($img)-1 );
            }
            elseif (isset($img)) {
                $pic64 = $img->getDataImage();
                $type = $img->getMimeType();
                $this->smarty->assign('n_vinili', 1);
            }
        }
        else
            $this->smarty->assign('n_vinili', 0);

        if (isset($imgP)) {
            if (is_array($imgP)) {
                foreach ($imgP as $it) {
                    foreach($it as $ite){
                        foreach ($ite as $item) {
                        if (isset($item)) {
                            $pic64P[] = $item->getDataImage();
                            $typeP[] = $item->getMimeType();
                           }
                        }
                    }
                }
            }
            elseif (isset($imgP)) {
                $pic64P = $imgP->getDataImage();
                $typeP = $imgP->getMimeType();
            }
        }

        $b=serialize($result);
        $s=urlencode($b);


        $this->smarty->assign('S_vinili', $s);
        $this->smarty->assign('vinili', $result);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->assign('typeP', $typeP);
        $this->smarty->assign('pic64P', $pic64P);
        $this->smarty->display('vetrina_vinili.tpl');
    }


}