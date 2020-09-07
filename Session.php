<?php


class Session
{
    /**
     * L'unica istanza della classe
     */
    private static $instance = null;

    /**
     * Metodo che restituisce l'unica istanza dell'oggetto.
     * @return Session l'istanza dell'oggetto.
     */

    //restituisce l'unica istanza (creandola se non esiste gia)
    public static function getInstance()
    {
        if(static::$instance==null)
        {
            static::$instance=new Session();
        }
        return static::$instance;
    }

    /**
     * Metodo che verifica se l'utente è loggato, ovvero se la componente 'utente' di $_SESSION è settata.
     * @return bool
     */

    public function isLoggedUtente()
    {
        $identificato = false;
        if (isset($_COOKIE['PHPSESSID']))
        {
            if (session_status() == PHP_SESSION_NONE)
            {
                session_start();
            }
        }
        if (isset($_SESSION['utente']))
        {
            $identificato = true;
        }
        return $identificato;
    }

    /**
     * Metodo che verifica se l'amministratore è loggato, ovvero
     * se la componente 'amministratore' di $_SESSION, è settata.
     * @return bool
     */

    public function isLoggedAdmin()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }

        if(isset($_SESSION['amministratore']))
        {
            return true;
        } else
            {
            return false;
            }
    }

    /**
     * Metodo che recupera l'utente loggato dai dati di sessione.
     * @return EUtente_loggato
     */

    public function getUtente()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }

        $u = $_SESSION['utente']; //stringa
        $utente = unserialize($u);
        return $utente;
    }

    /**
     * Metodo che salva nei dati di sessione l'utente (quando il login utente ha successo).
     * @param $utente da salvare in $_SESSION.
     */

    public function setUtenteLoggato($utente)
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }

        $u = serialize($utente);
        $_SESSION['utente'] = $u;
    }



    /**
     * Metodo che provvede ad eliminare i dati di sessione (quando l'utente fa logout).
     */

    public function logout()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
        session_unset();
        session_destroy();
    }

    public function setVinile($vinile)
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
            //$_SESSION['vinili']=array();
        }
        if(isset($_SESSION['vinili'])){
            $v=array();
        $v = serialize($vinile);
        array_push($_SESSION['vinili'],$v);
        }
        else
            {
            $_SESSION['vinili']=array();
            $v = serialize($vinile);
            $_SESSION['vinili'][]=$v;
            }
    }

    public function getVinile()
    {
        if(session_status()==PHP_SESSION_NONE)
        {
            session_start();
        }
        $v=array();
        if(isset($_SESSION['vinili']))
        {
        if(is_array($_SESSION['vinili']))
        {
            foreach ($_SESSION['vinili'] as $item)
            {
                $vs = unserialize($item);
                array_push($v, $vs);
                $v = (array_unique($v, SORT_REGULAR));
            }
           // $u = $_SESSION['vinili']; //stringa
        }
        else
            {
            $vs = $_SESSION['vinili']; //stringa
            $v = unserialize($vs);
            }
        }
        else
            {
            $v=null;
            }
        return $v;
    }

}