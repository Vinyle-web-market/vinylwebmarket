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
            $value = $_POST['ngiri'];
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
     * URLDECODE per passare eventuali risultati di precedenti ricerche attraverso in Post con input hidden e cosi si procede
     * per filtraggi iterativi fino alle condizioni che l'utente richiede
     */
    static function ricerca (){
        //$r, $image, $imageP
        //var_dump($_POST['vinili']);
        $a=URLDECODE($_POST['vinili']);
        $vinili=unserialize($a);
        //var_dump($vinili);
        $r=array();
        $image=array();
        $imageP=array();
        $pm = new FPersistentManager();
        $VFiltro = new VFiltro();
        if(isset($vinili)) {
            if(is_array($vinili)){
                $n_vinili = count($vinili);
                //var_dump($n_vinili);
                for ($i = 0; $i < $n_vinili; $i++) {
                    $result=null;
                    $img=null;
                    $imgP=null;
                    $titolo = null;
                    $artista = null;
                    $genere = null;;
                    $ngiri = null;
                    $condizione = null;
                    $prezzo = null;
                    $titolo = $vinili[$i]->getTitolo();
                    $artista = $vinili[$i]->getArtista();
                    $genere = static::getGenere();
                    $ngiri = static::getNgiri();
                    $condizione = static::getCondizione();
                    $prezzo = static::getPrezzo();
                    //var_dump($prezzo);
                    if ($titolo != null || $artista != null || $genere != null || $ngiri != null || $condizione != null || $prezzo != null) {
                        $result[] = $pm->searchVinyl($titolo, $artista, $genere, $ngiri, $condizione, $prezzo);

                        if($result[0]!=null){ //non result senza [0] perchè un vettore con (1 elemento nullnon vale null)
                            $img[] = static::ImageVinyls($result);
                            $imgP[] = static::ImageVinyls2($result);
                        $r=array_merge($r,$result);
                        $image=array_merge($image,$img);
                        $imageP=array_merge($imageP,$imgP);
                        }
                    }
                }
            }
        }else{
            $VFiltro->ViniliCercati(null, null, null);
        }
        $VFiltro->ViniliCercati($r, $image, $imageP);
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

    /**
     * Funzione per la ricerca di una parola all'interno della Search sulla NavBar
     * la ricerca è effetuata anche per sottostrighe Case_nonSensitive e nei campi Artista e NomeVinile
     */
    static function ricercaParola (){
        $pm = new FPersistentManager();
        $VFiltro = new VFiltro();
        $VVinile=new VVinile();
        $value = null;
        $result1=array();
        if (isset($_POST['parola']))
            $value = $_POST['parola'];
        if ($value != null) {
            $result1 = $pm->ricercaVinili ($value);
            $result2 = $pm->cercaViniliCampo($value,"artista");
            if(!isset($result1))$result=$result2;
               elseif(!isset($result2))$result=$result1;
                  else $result=array_merge($result1,$result2);

            //fare la funzione per le immagini vinili,simile imageReviews in Cuser
            $img=static::ImageVinyls($result);
            $imgP=static::ImageVinyls2($result);
            $VVinile->Vetrina($result,$img,$imgP);

        } else
            header('Location: /vinylwebmarket/Vinile/Vetrina');
    }


}