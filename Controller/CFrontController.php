<?php

/**
 * la classe controller principale che risveglia il server,il primo controllore che parte.
 * nel nostro caso si occupa:
 *                        -creare il controllore responsabile per la gestione della chiamata
 *                        -identificare il metodo da eseguire
 *                        -identificare eventuali dati da passare al metodo
 * $_SERVER['REQUEST_URI'] restiruisce L URL in formato stringa
 * explode successiva spezza la stringa per ogni / ,ed array_shift butta una componente
 *
 */

class CFrontController
{
    /**
     * Metodo che dalla URL recupera il controllore da istanziare e il relativo metodo con eventuale parametri
     * /vinylwebmarket/controller/metodo/param1/param2/param3
     */
    public function run()
    {

        $path = $_SERVER['REQUEST_URI'];
        $array = explode('/', $path);
        array_shift($array);

        $count = count($array);

        if ($array[$count - 1] == null) {
            unset($array[$count - 1]);
        }
        if (count($array) != 1) {
            $controller = $array[1];
            $controller = "C" . $controller;
            if (class_exists($controller)) {
                $metodo = $array[2];
                if (method_exists($controller, $metodo)) {
                    $c = new $controller();
                    if (isset($array[3])) {
                        $parametro = $array[3];
                        if (isset($array[4])) {
                            $parametro2 = $array[4];
                            if (isset($array[5])) {
                                $parametro3 = $array[5];
                                $c->$metodo($parametro, $parametro2, $parametro3);
                            } else {
                                $c->$metodo($parametro, $parametro2);
                            }
                        } else
                            $c->$metodo($parametro);
                    } else {
                        $c->$metodo();
                    }
                } else {
                    header('HTTP/1.1 405 Method Not Allowed');
                    exit;
                }
            }
            else {
                header('HTTP/1.1 404 Not Found');
                exit;
            }

        }
        else { //richiesta per la Homepage
            $controller = new CHomepage();
            $controller->impostaPagina();
        }

    }

        }



?>
