<?php


/**
 * La classe VAbbonamento si occupa dell'input / output riguardante l'abbonamento
 * che, gli utenti registrati come negozio, devono sottoscrivere per
 * poter registrasi aggiungere vinili illimitati
 * @author Cruciani - Nanni - Scarselli
 * @package View
 */

class VAbbonamento
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

     public function form_carta($carta, $errori)
     {
         if(isset($errori)){
         foreach ($errori as $err) {
             switch ($err) {
                 case "intestatario":
                     $this->smarty->assign('errorIntestatario', "errore");
                     break;

                 case "cvv":
                     $this->smarty->assign('errorCvv', "errore");
                     break;

                 case "numerocarta":
                     $this->smarty->assign('errorNumerocarta', "errore");
                     break;
             }
             }
         }
         if ($carta)
         {
             $this->smarty->assign('nome', $carta->getIntestat());
             $this->smarty->assign('numero', $carta->getNum());
             $this->smarty->assign('cvv', $carta->getCodCVV());
             $this->smarty->assign('scadenza', $carta->getScad());
             $this->smarty->assign('id', $carta->getId());
             $this->smarty->assign('carta', 1);
         }
         else  $this->smarty->assign('carta', 0);

         $this->smarty->assign('classe', "abb");
         $this->smarty->display('modificaCarta.tpl');
     }

     public function pagamento(){
         $this->smarty->display('pagamento.tpl');
     }
}