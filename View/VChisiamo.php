<?php



/**
 * La classe VChisiamo è specializzata nel visualizzare la pagina di informazioni della nostra applicazione
 * @author Cruciani - Nanni - Scarselli
 * @package View
 */

class VChisiamo
{

    private $smarty;

    public function __construct()
    {
        $this->smarty = smartyConfiguration::configuration();
    }

    /**
     * Mostra la pagina di informazioni dell'applicazione
     * Si verifica semplicemente se l'utente è loggato per visualizzare correttamente i dati nella toolbar superiore.
     */
    public function showInfo(){
        $this->smarty->display('comeFunziona.tpl');
    }

}
