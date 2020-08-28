<?php


class EInputControl
{
    /**
     * gestita come singleton.
     * @var
     */
    private static $instance;

    private function __construct() {}


    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new EInputControl();
        }

        return self::$instance;
    }

    /**
     * @param string $nome, nome da controllare.
     * @return bool, esito del controllo.
     */
    public function testName(string $nome): bool {
        $test = preg_match('/[A-Za-z]$/',$nome);
        return $test;
    }


    /**
     * @param string $username, username da controllare.
     * @return bool, esito del controllo.
     */
    public function testUsername(string $username): bool {
        $result = preg_match('/[a-zA-Z0-9]$/', $username);
        return $result;
    }

    /**
     * Funzione che controlla se un file caricato abbia un mimeType associato ad un file di immagine.
     * @param $typefile, mimeType da controllare.
     * @return bool, esito del controllo.
     */
    public function testImage($typefile): bool
    {
        $estensione = strtolower(strrchr($typefile, '/'));
        switch($estensione) {
            case '/jpg':
            case '/jpeg':
            case '/gif':
            case '/png':
                return true;
            default:
                return false;
        }
    }

    /**
     * Funzione che controlla se un file caricato non sia più grande di 2 MB.
     * @param $size, dimensione espressa un byte.
     * @return bool, esito del controllo.
     */
    public function testSizeImage($size) {
        return (intval($size) <  2048000);
    }

    /**
     * Funzione che controlla se una password sia valida.
     * @param string $password, password da controllare.
     * @return bool, esito del controllo.
     */
    public function testPassword(string $password): bool {
        return strlen($password) > 7;
    }

    /**
     * Funzione che controlla se una email sia valida.
     * @param string $email, email da controllare.
     * @return bool, esito del controllo.
     */
    public function testEmail(string $email): bool {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function testPhone(string $phone):bool{
        $x=str_replace(" ","",$phone);
        $accettato = preg_match('/^[0-9]{2,10}$/', $x);
        if($accettato and strlen($x)>8){
            return true;
        }
        else
            return false;
       }

    public function testQuantita(string $q):bool
    {
        $x = str_replace(" ", "", $q);
        $accettato = preg_match('/^[0-9]{1,10}$/', $x);
        return $accettato;
    }

    public function testPrezzo(string $prezzo):bool{
        $accettato = preg_match('/^\d+(\,\d{1,2})?$/', $prezzo);
        return $accettato;
    }

    public function validVinile(EVinile $vinile){
        $err=array();
        $test=static::testPrezzo($vinile->getPrezzo());
        if (!$test)
            array_push($err,"prezzo");

        $test=static::testQuantita($vinile->getQuantita());
        if(!$test)
            array_push($err,"quantità");

        return $err;

    }

       public function validPrivato(EPrivato $privato){
         $err=array();
         $test=static::testUsername($privato->getUsername());
         if (!$test)
             array_push($err,"username");

         $test=static::testName($privato->getNome());
         if(!$test)
             array_push($err,"nome");

           $test=static::testName($privato->getCognome());
           if(!$test)
               array_push($err,"cognome");

           $test=static::testPhone($privato->getPhone());
           if(!$test)
               array_push($err,"telefono");

           $test=static::testPassword($privato->getPassword());
           if(!$test)
               array_push($err,"password");

           $test=static::testEmail($privato->getEmail());
           if(!$test)
               array_push($err,"email");

           return $err;

    }

    public function validNegozio(ENegozio $negozio){
        $err=array();
        $test=static::testUsername($negozio->getUsername());
        if (!$test)
            array_push($err,"username");

        $test=static::testName($negozio->getNameShop());
        if(!$test)
            array_push($err,"nome");

        $test=static::testIva($negozio->getPIva());
        if(!$test)
            array_push($err,"partitaiva");

        $test=static::testPassword($negozio->getPassword());
        if(!$test)
            array_push($err,"password");

        $test=static::testEmail($negozio->getEmail());
        if(!$test)
            array_push($err,"email");

        $test=static::testCardNumber($negozio->getCarta()->getNum());
        if(!$test)
            array_push($err,"numerocarta");

        $test=static::testCvv($negozio->getCarta()->getCodcvv());
        if(!$test)
            array_push($err,"cvv");

        $test=static::testIntestatario($negozio->getCarta()->getIntestat());
        if(!$test)
            array_push($err,"intestatario");

        return $err;

    }

    public function validCard(ECarta $carta){
        $err=array();

        $test=static::testCardNumber($carta->getNum());
        if(!$test)
            array_push($err,"numerocarta");

        $test=static::testCvv($carta->getCodcvv());
        if(!$test)
            array_push($err,"cvv");

        $test=static::testIntestatario($carta->getIntestat());
        if(!$test)
            array_push($err,"intestatario");

        return $err;

    }



    public function testIntestatario(string $intestatario){
        $test = preg_match('/[A-Za-z]$/', $intestatario);
        return $test;
    }

    public function testCardNumber(string $num):bool {
        $x=str_replace(" ","",$num);
        $accettato = preg_match('/[0-9]$/', $x);
        if($accettato and strlen($x)==16){
                return true;
        }
        else
                return false;

    }

    public function testCvv(string $num ):bool {
        $x=str_replace(" ","",$num);
        $accettato = preg_match('/[0-9]$/', $x);
        if($accettato and strlen($x)==3){
            return true;
        }
        else
            return false;
         }

         public function testIva(string $iva):bool{
             $accettato = preg_match('/^[0-9]{11}$/', $iva);
             if($accettato){
                 return true;
             }
             else
                 return false;

         }

    /**
     * Funzione che controlla se una data sia valida.
     * @param string $date, data da controllare.
     * @return string, ritorna la data stessa se corretta o una stringa vuota in caso non sia valida.
     */
    public function testDate(string $date): string {
        $temp = DateTime::createfromFormat('Y-m-d', $date);

        if($date === false) {
            return "";
        }

        return $date;
    }

}