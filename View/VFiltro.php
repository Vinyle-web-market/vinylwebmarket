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
                foreach ($img as $item) {
                    if (isset($item)) {
                        $pic64[] = $item->getDataImage();
                        $type[] = $item->getMimeType();
                    }
                }
                $this->smarty->assign('n_vinili', count($img) - 1);
                //$this->smarty->assign('img', $img);
                // $this->smarty->assign('type', $img->getMimeType());
                // $this->smarty->assign('pic64', $img->getDataImage());
                //$this->smarty->assign('n_vinili', count($img) - 1);
            }
            elseif (isset($imgrec)) {
                $pic64 = $imgrec->getDataImage();
                $type = $imgrec->getMimeType();
                $this->smarty->assign('n_vinili', 1);
            }
        }
        else
            $this->smarty->assign('n_vinili', 0);
        $this->smarty->assign('vinili', $result);
        $this->smarty->assign('type', $type);
        $this->smarty->assign('pic64', $pic64);
        $this->smarty->display('vetrina_vinili.tpl');
    }


}