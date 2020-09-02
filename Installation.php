<?php

/**
 * Class Installation
 * Classe che si occupa dell'installazione dell'applicativo
 */

class Installation
{

    /**
     * Funzione che si occupa del controllo dei requisiti minimi per l'installazione, ovvero:
     * PHP version 7 o successiva;
     * Cookie abilitati;
     * JavaScript abilitato.
     */

    static function Inizio()
    {
        $smarty = smartyConfiguration::configuration();
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            // viene inviato un cookie per verificare se questi sono abilitati
            setcookie('verifica_cookie', 'verifica', time()+3600);
            $smarty->display('installazione.tpl');           //tpl da fare
        }
        else
            {
            $noPHP = false;
            $noCookie = false;
            $noJS = false;

            // controllo versione PHP
            if (version_compare(PHP_VERSION,'7.0.0' , '<' ))   //in questo caso constatiamo se la versione in uso sia inferiore ad PHP7
            {
                $noPHP = true;
                $smarty->assign('nophpv', $noPHP);
            }
            // controllo cookie
            if (!isset($_COOKIE['verifica_cookie']))
            {
                $noCookie = true;
                $smarty->assign('nocookie', $noCookie);
            }
            // verifica JS (Jason)
            if (!isset($_COOKIE['checkjs']))
            {
                $noJS = true;
                $smarty->assign('nojs', $noJS);
            }

            // se almeno uno dei controlli non è andato a buon fine, si mostra la pagina di installazione con i relativi errori.
            if ($noPHP || $noJS || $noCookie)
            {
                $smarty->display('installazione.tpl');
            }

            // altrimenti, se i requisiti sono verificati elimino i cookie inviati in precedenza
            else
                {
                setcookie('verifica_cookie', '',time()-3600);
                setcookie('checkjs', '',time()-3600);

                // si procede con l'installazione e il popolamento del database
                if(static::Installazione())

                header ('Location: /vinylwebmarket');
            }

        }
    }

    /**
     * Funzione che provvede alla creazione del file config.inc.php per l'accesso al database e della creazione del database.
     */

    static function Installazione()
    {
        try
        {
            $db = new PDO("mysql:host=localhost;", $_POST['nomeutente'], $_POST['password']);
            $db->beginTransaction();
            $query = 'DROP DATABASE IF EXISTS ' .$_POST['nomedb']. '; CREATE DATABASE ' . $_POST['nomedb'] . ' ; USE ' . $_POST['nomedb'] . ';' . 'SET GLOBAL max_allowed_packet=16777216;';
            $query = $query . file_get_contents('vinylwebmarket.sql');
            $db->exec($query);
            $db->commit();
            $file = fopen('config.inc.php', 'c+');      //azionato in modalità scrittura
            $script = '<?php $host= \'localhost\'; $GLOBALS[\'database\']= \'' . $_POST['nomedb'] . '\'; $GLOBALS[\'username\']= \'' . $_POST['nomeutente'] . '\'; $GLOBALS[\'password\']= \'' . $_POST['password'] . '\';?>';
            fwrite($file, $script);
            fclose($file);
            $db = null;
            //return true;                            //si puo' mettere, ma non è necessaria
        }
        catch (PDOException $e)
        {
            echo "Errore : " . $e->getMessage();
            $db->rollBack();
            die;
            //return false;                      //si puo' mettere, ma non è necessaria
        }
    }

    /**
     * Funzione che verifica la presenza del cookie di installazione.
     * Quindi si verificherà se l'installazione è stata effettuata.
     */

    static function Verifica_Installazione()
    {
        $verifica = false;
        if(file_exists('config.inc.php'))
            $verifica = true;
        return $verifica;
    }

}