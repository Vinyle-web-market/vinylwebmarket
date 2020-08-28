<?php


class CAbbonamento
{

    static function form_carta(){
        $sessione= Session::getInstance();
        if ($sessione->isLoggedUtente())
            {
            $view= new VAbbonamento();
            $c=$sessione->getUtente()->getCarta();
            if ($c->getNum()!=null)
            {
              $view->form_carta($c, null);
            }
            else $view->form_carta(null, null);
            }
        else header('Location: /vinylwebmarket/User/login');
    }

    public function check_carta()
    {
        $view=new VAbbonamento();
        $numeroCarta = $_POST["numerocarta"];
        $cvv = $_POST["cvv"];
        $intestatario = $_POST["intestatario"];
        $mese = $_POST["mese"];
        $anno = $_POST["anno"];
        $id= $_POST["id"];
        $scadenza = $anno . "-" . $mese . "-01";
        $pm = new FPersistentManager();
        $err = array();
        $carta = new ECarta($intestatario, $numeroCarta, $scadenza, $cvv);
        $carta->setId($id);
            $input = EInputControl::getInstance();
           $err = $input->validCard($carta);
            if ($err) {
                $view->form_carta($carta, $err);
            }
            else {
                $pm->update("numero", $numeroCarta, "id", $carta->getId(), "FCarta");
                $pm->update("cvv", $cvv, "id", $carta->getId(), "FCarta");
                $pm->update("intestatario", $intestatario, "id", $carta->getId(), "FCarta");
                $scadenza = $anno . "-" . $mese . "-01";
                $pm->update("scadenza", $scadenza, "id", $carta->getId(), "FCarta");
                $view->pagamento();
            }
    }

    static function transazione(){
        $sessione= Session::getInstance();
        if ($sessione->isLoggedUtente())
        {
            $abb = $sessione->getUtente()->getAbbonamento();
            $pm = new FPersistentManager();
            $id=$abb->getId();
            $n_mesi=$_POST['numeromesi'];
            $data=$abb->AggiornaAbbonamento($n_mesi);
            $pm->update("scadenza", $data, "id", $id, "FAbbonamento");
            $pm->update("stato", 1, "FAbbonamento");
            header('Location: /vinylwebmarket/User/profile');
        }
        else header('Location: /vinylwebmarket/User/login');
    }

}