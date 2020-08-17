<?php


class VFiltro
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Vetrina aggiornata dopo il filtraggio applicato dall'utentr.
     * @param $result contiene i vinili
     * @param $img un'immagine per vinile
     * @throws SmartyException
     */
    public function ViniliCercati($result,$img){
        $sessione = Session::getInstance();
        if ($sessione->isLoggedUtente())
            $this->smarty->assign('userlogged',"loggato");

        if (isset($img)) {
            if (is_array($img)) {
                $this->smarty->assign('type', $img->getMimeType());
                $this->smarty->assign('pic64', $img->getDataImage());
                $this->smarty->assign('n_vinili', count($img) - 1);
            }
            else {
                $t[] = $img->getMimeType();
                $im[] = $img->getDataImage();
                $this->smarty->assign('type', $t);
                $this->smarty->assign('pic64', $im);
                $this->smarty->assign('n_vinili', 1);
            }
        }
        else
            $this->smarty->assign('n_vinili', 0);
        $this->smarty->assign('vinili', $result);
        $this->smarty->assign('imgVinili', $img);
        //mostro la home con i risultati della query
        $this->smarty->display('vetrinaVinili.tpl');
    }


}