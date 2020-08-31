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
        $view = new VAbbonamento();
        $r=null;
        $numeroCarta = $_POST["numerocarta"];
        $cvv = $_POST["cvv"];
        $intestatario = $_POST["intestatario"];
        $mese = $_POST["mese"];
        $anno = $_POST["anno"];
        $id = $_POST["id"];
        $r=$_POST["ricorda"];
        $scadenza = $anno . "-" . $mese . "-01";
        $pm = new FPersistentManager();
        $err = array();
        $carta = new ECarta($intestatario, $numeroCarta, $scadenza, $cvv);
        $carta->setId($id);
        $input = EInputControl::getInstance();
        $err = $input->validCard($carta);
        if ($err) {
            $view->form_carta($carta, $err);
        } else {
            if ($r == "si") {
                $pm->update("numero", $numeroCarta, "id", $carta->getId(), "FCarta");
                $pm->update("cvv", $cvv, "id", $carta->getId(), "FCarta");
                $pm->update("intestatario", $intestatario, "id", $carta->getId(), "FCarta");
                $scadenza = $anno . "-" . $mese . "-01";
                $pm->update("scadenza", $scadenza, "id", $carta->getId(), "FCarta");
            }
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
            //FARE UNA SESSIONE PER L'ABBONAMENT0?
            //attento perche la carta è salvata in sessione perciò due rinnovi sulla stessa sessione riusiltato un problema
                //$abb->setData(date("Y-m-d"));
                $n_mesi = $_POST['numeromesi'];
                $data = $abb->AggiornaAbbonamento($n_mesi);
                $pm->update("scadenza", $data, "id", $id, "FAbbonamento");
                $pm->update("stato", 1, "id", $id, "FAbbonamento");
                $pm->update("visibility", 1, "venditore",$sessione->getUtente()->getEmail(), "FVinile");
                $u=$pm->load("id_abbonamento",$id,"FNegozio");
                $sessione->setUtenteLoggato($u);   //AGGIORNO LA SESSIONE
                header('Location: /vinylwebmarket/User/profile');
        }
        else header('Location: /vinylwebmarket/User/login');
    }

}