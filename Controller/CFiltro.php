<?php


class CFiltro
{
    /**
     * Titolo inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getTitolo(){
        $value = null;
        if (isset($_POST['titolo']))
            $value = $_POST['titolo'];
        return $value;
    }

    /**
     * Artista inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getArtista(){
        $value = null;
        if (isset($_POST['artista']))
            $value = $_POST['artista'];
        return $value;
    }

    /**
     * Genere inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getGenere(){
        $value = null;
        if (isset($_POST['genere']))
            $value = $_POST['genere'];
        return $value;
    }

    /**
     * Numero giri del vinile inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getNgiri(){
        $value = null;
        if (isset($_POST['ngiri']))
            $value = $_POST['ngiti'];
        return $value;
    }

    /**
     * Condizione(nuovo o Usato) inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getCondizione(){
        $value = null;
        if (isset($_POST['condizione']))
            $value = $_POST['condizione'];
        return $value;
    }

    /**
     * Prezzo massimo inviato con metodo post
     * @return string il valore cercato dall'utente
     */
    public function getPrezzo(){
        $value = null;
        if (isset($_POST['prezzo']))
            $value = $_POST['prezzo'];
        return $value;
    }

    /**
     * Metodo per la ricerca di vinili attraverso il filtri
     */
    /*
    static function ricerca (){
        $pm = new FPersistentManager();
        $VFiltro = new VFiltro();
        $titolo = static::getTitolo();
        $artista=static::getArtista();
        $genere= static ::getGenere();
        $ngiri = static::getNgiri();
        $condizione = static::getCondizione();
        $prezzo=static::getPrezzo();
        if ($titolo != null || $artista != null || $genere != null || $ngiri != null || $condizione != null || $prezzo != null) {
                $result = $pm->searchVinyl ($titolo, $artista, $genere, $ngiri, $condizione, $prezzo);
                //fare la funzione per le immagini vinili,simile imageReviews in Cuser
                $img=static::ImageVinyls($result);
                $imgP=static::ImageVinyls2($result);
                $VFiltro->showResult($result,$img,$imgP);

        } else
            header('Location: /vinylwebmarket/');
    }
    */
    static function ricerca ($vinili){
        $pm = new FPersistentManager();
        $VFiltro = new VFiltro();
        if(isset($vinili)) {
            $titolo = static::getTitolo();
            $artista = static::getArtista();
            $genere = static::getGenere();
            $ngiri = static::getNgiri();
            $condizione = static::getCondizione();
            $prezzo = static::getPrezzo();
            if ($titolo != null || $artista != null || $genere != null || $ngiri != null || $condizione != null || $prezzo != null) {
                $result = $pm->searchVinyl($titolo, $artista, $genere, $ngiri, $condizione, $prezzo);
                //fare la funzione per le immagini vinili,simile imageReviews in Cuser
                $img = static::ImageVinyls($result);
                $imgP = static::ImageVinyls2($result);
                $VFiltro->showResult($result, $img, $imgP);

            } else
                header('Location: /vinylwebmarket/');
        }
    }

    /**
     * Funzione di supporto per le funzioni di filtro necessaria a preparare le immagini dei vinili
     */
    static function ImageVinyls($vinili) {
        $pm = new FPersistentManager();
        $imgVynils = null;
        $img=null;
        //$recensioni = $pm->load("emailConveyor", $tra->getEmail(), "FRecensione");
        //$recensioni = $pm->load("destinatario",$user->getEmail(),"FRecensione");
        if (isset($vinili)) {
            if (is_array($vinili)) {
                $n_vinili = count($vinili);
                //var_dump($n_vinili);
                for ($i = 0; $i < $n_vinili; $i++) {
                    echo "<hr>";
                    $img = null;
                    $img[] = $pm->loadImg2("EImageVinile", "id_vinile", $vinili[$i]->getId());
                    if ($img != null) {
                        //echo "<hr>";
                        // var_dump($img);
                        $imgVynils[$i] = $img;
                    } else {
                        $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                        $pic64 = base64_encode($data);
                        $type = "image/png";
                        $imgVynils[$i] = new EImageVinile("user.png", $data, $type, $vinili[$i]->getId());
                    }

                }
            } elseif (isset($vinili)) {
                $img = $pm->loadImg2("EImageVinile", "id_vinile", $vinili->getId());
                if ($img != null) {
                    $imgVynils = $img;
                } else {
                    $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                    $pic64 = base64_encode($data);
                    $type = "image/png";
                    $imgVynils = new EImageVinile("user.png", $data, $type, $vinili->getId());
                }
            }
        }
        return $imgVynils;
    }

    static function ImageVinyls2($vinili) {
        $pm = new FPersistentManager();
        $imgVynils = null;
        $img=null;
        //$recensioni = $pm->load("emailConveyor", $tra->getEmail(), "FRecensione");
        //$recensioni = $pm->load("destinatario",$user->getEmail(),"FRecensione");
        if (isset($vinili)) {
            if (is_array($vinili)) {
                $n_vinili = count($vinili);
                //var_dump($n_vinili);
                for ($i = 0; $i < $n_vinili; $i++) {
                    echo "<hr>";
                    $img = null;
                    $img[] = $pm->loadImgP2("EImageVinile", "id_vinile", $vinili[$i]->getId());
                    if ($img != null) {
                        //echo "<hr>";
                        // var_dump($img);
                        $imgVynils[$i] = $img;
                    } else {
                        $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                        $pic64 = base64_encode($data);
                        $type = "image/png";
                        $imgVynils[$i] = new EImageVinile("user.png", $data, $type, $vinili[$i]->getId());
                    }

                }
            } elseif (isset($vinili)) {
                $img = $pm->loadImgP2("EImageVinile", "id_vinile", $vinili->getId());
                if ($img != null) {
                    $imgVynils = $img;
                } else {
                    $data = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/vinylwebmarket/Smarty/immagini/user.png');
                    $pic64 = base64_encode($data);
                    $type = "image/png";
                    $imgVynils = new EImageVinile("user.png", $data, $type, $vinili->getId());
                }
            }
        }
        return $imgVynils;
    }


    static function ricercaParola (){
        $pm = new FPersistentManager();
        $VFiltro = new VFiltro();
        $value = null;
        $result1=array();
        if (isset($_POST['parola']))
            $value = $_POST['parola'];

        if ($value != null) {
            $result1 = $pm->ricercaVinili ($value);
            $result2 = $pm->cercaViniliCampo($value,"artista");
            $result=array_merge($result1,$result2);
            //fare la funzione per le immagini vinili,simile imageReviews in Cuser
            $img=static::ImageVinyls($result);
            $imgP=static::ImageVinyls2($result);
            $VFiltro->showResult($result,$img,$imgP);

        } else
            header('Location: /vinylwebmarket/');
    }


}