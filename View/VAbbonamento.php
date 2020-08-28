<?php


class VAbbonamento
{
    private $smarty;

    public function __construct()
    {
        //FARE IL FILE DI CONFIGURAZIONE StartSmarty.php(mettere fuori dalle cartelle?)
        $this->smarty = smartyConfiguration::configuration();
    }

     public function form_carta($carta, $err)
     {
         if ($carta)
         {
             $this->smarty->assign('nome', $carta->getIntestat());
             $this->smarty->assign('numero', $carta->getNum());
             $this->smarty->assign('cvv', $carta->getCodCVV());
             $this->smarty->assign('scadenza', $carta->getScad());
             $this->smarty->assign('carta', 1);
         }
         else  $this->smarty->assign('carta', 0);

         $this->smarty->display('modificaCarta.tpl');
     }

     public function pagamento(){
         $this->smarty->display('pagamento.tpl');
     }
}