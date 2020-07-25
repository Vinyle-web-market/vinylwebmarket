<?php

class VHomepageUL
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

         public function HomeULprivato($vinili,$img){
             //var_dump($img);
             if (is_array($img)) {
                 $n = count($img);
                 for ($i = 0; $i < $n; $i++) {
                     if ($img[$i] != null) {
                         $pic64[] = $img[$i]->getDataImage();
                         $type[] = $img[$i]->getMimeType();
                     }
                 }
             }
             elseif (isset($img)) {
                 $pic64 = $img->getDataImage();
                 $type = $img->getMimeType();
             }
             if (isset($img)) {
                 if (is_array($img)) {
                     $this->smarty->assign('type', $type);
                     $this->smarty->assign('pic64', $pic64);
                 }
                 else {
                     $this->smarty->assign('type', $type);
                     $this->smarty->assign('pic64', $pic64);
                 }
             }
             else
                 $this->smarty->assign('n_img_annuncio', 0);
             $this->smarty->assign('vinili', $vinili);
             $this->smarty->assign('img', $img);

        $this->smarty->display("homepage_privato.tpl");
    }

    public function HomeULnegozio($vinili,$img) {
        //var_dump($img);
        if (is_array($img)) {
            $n = count($img);
            for ($i = 0; $i < $n; $i++) {
                if ($img[$i] != null) {
                    $pic64[] = $img[$i]->getDataImage();
                    $type[] = $img[$i]->getMimeType();
                }
            }
        }

        elseif (isset($img)) {
            $pic64 = $img->getDataImage();
            $type = $img->getMimeType();
        }
        if (isset($img)) {
            if (is_array($img)) {
                $this->smarty->assign('type', $type);
                $this->smarty->assign('pic64', $pic64);
            }
            else {
                $this->smarty->assign('type', $type);
                $this->smarty->assign('pic64', $pic64);
            }
        }
        else
            $this->smarty->assign('n_img_annuncio', 0);
        $this->smarty->assign('vinili', $vinili);
        $this->smarty->assign('img', $img);

        $this->smarty->display('homepage_negozio.tpl');
    }

}