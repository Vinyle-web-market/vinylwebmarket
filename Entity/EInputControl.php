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
        $accettato = preg_match('/[0-9]$/', $x);
        if($accettato and strlen($x)>8){
            return true;
        }
        else
            return false;
       }

       public function validPrivato(EPrivato $privato){

       }

    public function testIntestatario(string $intestatario){
        $test = preg_match('/[A-Za-z]$/', $intestatario);
        return $test;
    }

    public function testCardNumber(string $num ):bool {
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