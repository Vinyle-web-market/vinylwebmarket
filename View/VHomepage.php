<?php

include_once("./View/VHomepage.php");
class VHomepage
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }
    //public function Home($utente){
         public function Home($vinili,$img){
        //var_dump($img);
             if (is_array($img)) {
                 $n = count($img);
                 for ($i = 0; $i < $n; $i++) {
                     if ($img[$i] != null) {
                         $pic64[] = $img[$i]->getDataImage();
                        // $miao = base64_encode($img[$i][0]->getDataImage());
                        // echo $miao;
                        // echo "<br>";
                         $type[] = $img[$i]->getMimeType();
                        // $miao=$img[$i][0]->getMimeType();
                        // echo $miao;
                         //echo "<br>";

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
                 //$this->smarty->assign('n_img_annuncio', count($med_annuncio) - 1);
             }
             else
                 $this->smarty->assign('n_img_annuncio', 0);
             $this->smarty->assign('vinili', $vinili);
             $this->smarty->assign('img', $img);


        //$this->smarty->assign("utente",$utente);
       // $this->smarty->display("Homepage.tpl");
             $this->smarty->display("Homepage.tpl");

    }

    public function HomeUL($vinili,$img){
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

        $this->smarty->display("homepageUL.tpl");
    }
}