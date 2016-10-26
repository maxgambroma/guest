<?php

class Prezzi_disponibilita_model extends CI_Model {

    protected $now = '';
    protected $today = '';
    protected $hotel_id = '';
    // gestione camere
    protected $tot_cam_in_arrivo = 0;
    protected $tot_cam_in_opzione = 0;
    protected $tot_cam_presenti = 0;
    protected $tot_cam_libere = 0;
    protected $camere_occupate = 0;
    protected $tot_cam_occupate = 0;
    protected $diff_gg_preno = 0;
    protected $tot_occ_percetuale_hotel = 0;
    protected $preno_gia_arrivati = 0;
    // gestione camere /
    // rs_hotel
    protected $rs_hotel = 0;
    protected $hotel_numero_camere = 0;
    protected $hotel_tarif_cambia_gg = 0;
    protected $hotel_disp_modo = 0;

    function __construct() {
        parent::__construct();
    }

    /**
     * dati dell'hotel
     * @param type $hotel_id
     * @return type
     */
    public function rs_hotel($hotel_id) {

        $sql = "
            SELECT *
            FROM hotels
            WHERE
            hotels.hotel_id = '$hotel_id'
            ";

        $query = $this->db->query($sql);
        $return = $query->row();
        return $return;
    }

    /**
     * conti aperti (CONTI)
     * @param type $hotel_id
     * @param type $today
     * @return type
     */
    public function rs_conti_aperti($hotel_id, $today) {

        $sql = "
            SELECT COUNT(*) AS occ_conti
            FROM conti 
            WHERE (conti.conti_stato_camere <> '7')AND
            (conti.in_conto <= '$today') AND
            (conti.out_preno > '$today') AND
            (conti.hotel_id = '$hotel_id')  
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /** conti aperti che provengono da preno di $today in avanti (CONTI) da sottrarre alle rs_preno_da_oggi
     * 
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    public function rs_conti_preno($now, $today, $hotel_id) {

        $sql = "
            SELECT   COUNT(*) AS preno_arrivate,
            conti.conto_id,
            conti.foglio_id,
            conti.preno_id,
            conti.in_conto,
            agenda.preno_id,
            agenda.preno_dal
            FROM conti INNER JOIN agenda ON (conti.preno_id = agenda.preno_id) AND 
            (conti.in_conto = agenda.preno_dal) WHERE (conti.in_conto >= '$now') AND 
            (conti.conti_stato_camere <> '7') AND (conti.in_conto <= '$today') AND 
            (conti.out_preno > '$today') AND (conti.hotel_id = '$hotel_id') 
            GROUP BY conti.in_conto
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * camere in opzione con data di opzione <= ad Now (AGENDA)
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    public function rs_opzione_preno($hotel_id, $today, $now) {

        $sql = "
            SELECT  COUNT(*) AS FIELD_1,
            SUM(agenda.q1) AS somma_q1, 
            SUM(agenda.q2) AS somma_q2, 
            SUM(agenda.q3) AS somma_q3, 
            SUM(agenda.q4) AS somma_q4, 
            SUM(agenda.q5) AS somma_q5 ,
            SUM(agenda.q6) AS somma_q6 
            FROM   agenda 
            WHERE   (agenda.preno_stato = '2') AND    
            (agenda.preno_dal <= '$today') AND   
            (agenda.preno_al > '$today') AND  
            (agenda.hotel_id = '$hotel_id') AND   
            (agenda.data_opzione >= '$now')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * Prenotazioni presenti today agenda con data > now() (AGENDA)
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    public function rs_preno_da_oggi($hotel_id, $today, $now) {

        $sql = "
            SELECT COUNT(*) AS FIELD_1,
            SUM(agenda.q1) AS somma_q1, 
            SUM(agenda.q2) AS somma_q2, 
            SUM(agenda.q3) AS somma_q3, 
            SUM(agenda.q4) AS somma_q4, 
            SUM(agenda.q5) AS somma_q5 ,
            SUM(agenda.q6) AS somma_q6 
            FROM agenda 
            WHERE (agenda.preno_stato = '1') AND
            (agenda.preno_dal <= '$today') AND
            (agenda.preno_al > '$today') AND
            (agenda.hotel_id = '$hotel_id') AND
            (agenda.preno_dal >= '$now')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * tutti i conti aperti nel passato (CONTI) esiste un errore non calcola i day use
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    public function rs_cont_passati($hotel_id, $today, $now) {

        $sql = "
            SELECT    COUNT(*) AS occ_conti 
            FROM   conti 
            WHERE   (conti.in_conto <= '$today') AND
            (conti.out_preno > '$today') AND 
            (conti.hotel_id = '$hotel_id')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * prezzo dal listino  listino_periodi_obmp 
     * @param type $hotel_id
     * @param type $today
     * @param type $tipologia_id
     * @return type
     */
    public function rs_prezzo($hotel_id, $today, $tipologia_id) {

        $sql = "
            SELECT  *, 
            listino_periodi_obmp.listino_dal, 
            listino_periodi_obmp.listino_al
            FROM   listino_nome_obmp  
            INNER JOIN listino_obmp ON (listino_nome_obmp.listino_nome_id = listino_obmp.listino_nome_id) 
            INNER JOIN listino_periodi_obmp ON (listino_nome_obmp.listino_nome_id = listino_periodi_obmp.listino_nome_id)
            INNER JOIN tipologia_camera ON (listino_obmp.tipologia_id = tipologia_camera.tipologia_id) 
            WHERE   (listino_obmp.tipologia_id = '$tipologia_id') AND
            (listino_periodi_obmp.listino_dal <= '$today') AND
            (listino_periodi_obmp.listino_al > '$today') AND
            (listino_nome_obmp.hotel_id = '$hotel_id') 
            ORDER BY   listino_periodi_obmp.listino_dal DESC,
            listino_periodi_obmp.listino_al
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     *  listino prezzo protezione tariffa   
     * @param type $hotel_id
     * @param type $tipologia_id
     * @return type
     */
    public function rs_cambio_prezzo($hotel_id, $tipologia_id) {

        $sql = "
            SELECT
            listino_obmp.tipologia_id,
            listino_obmp.listino_prezzo,
            listino_obmp.listino_nome_id,
            hotels.hotel_id, 
            listino_obmp.hotel_id 
            FROM   hotels
            INNER JOIN listino_obmp ON (hotels.hotel_tarif_listino_nome_id = listino_obmp.listino_nome_id)
            WHERE   (listino_obmp.tipologia_id = '$tipologia_id') AND
            (listino_obmp.hotel_id = '$hotel_id')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * Tetemino le tipologie di camare prenotate 
     * @param type $hotel_id
     * @param type $today
     * @param type $tipologia_id
     * @return type
     */
    public function rs_tableau($tipologia_id, $now, $today, $hotel_id) {

        $sql = "
            SELECT   
            SUM( 
            if(agenda.t1 = '$tipologia_id', agenda.q1, 0) +
            if(agenda.t2 = '$tipologia_id', agenda.q2, 0) +
            if(agenda.t3 = '$tipologia_id', agenda.q3, 0) +
            if(agenda.t4 = '$tipologia_id', agenda.q4, 0) +
            if(agenda.t5 =' $tipologia_id', agenda.q5, 0) +
            if(agenda.t6 = '$tipologia_id', agenda.q6, 0)
            ) AS 'somma_tipologia' 
            FROM   agenda   
            WHERE   ((agenda.preno_stato = '1') OR ((agenda.preno_stato = '2') AND (agenda.data_opzione >= '$now'))) AND
            (agenda.preno_dal <= '$today') AND
            (agenda.preno_al > '$today') AND
            (agenda.hotel_id = '$hotel_id')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * elenca le tipologie dell'hotel
     * @param type $hotel_id
     * @return type
     */
    public function rs_tip_camere($hotel_id) {

        $sql = "
            SELECT    tipologia_camera.tipologia_id, 
            tipologia_camera.numero_pax, 
            tipologia_camera.nome_tipologia 
            FROM tipologia_camera 
            INNER JOIN camere ON (tipologia_camera.tipologia_id = camere.tipologia_id)
            INNER JOIN hotels ON (camere.hotel_id = hotels.hotel_id) 
            WHERE (camere.hotel_id = '$hotel_id') 
            GROUP BY tipologia_camera.tipologia_id 
            ORDER BY tipologia_camera.numero_pax
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * Conti aperti
     * @param type $hotel_id
     * @param type $today
     * @return type
     */
    /* inizio conti in casa -------------------------------------------------- */
    /* se la data  e futura  e presente */

    function camere_presenti($hotel_id, $today, $now) {


        /*  se la data è anteriore */
        if ($today >= $now) {
            $conti_aperti = $this->rs_conti_aperti($hotel_id, $today);
            $tot_cam_presenti = $conti_aperti['0']->occ_conti;
        }
        /*  se la data o passata */
        if ($today < $now) {
            $conti_aperti = $this->rs_cont_passati($hotel_id, $today, $now);
            $tot_cam_presenti = $conti_aperti['0']->occ_conti;
        }

        return $tot_cam_presenti;
    }

    /**
     * Camere che devono ancora arrvare da preno 
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    function camere_in_arrivo($hotel_id, $today, $now) {

        if ($today >= $now) {
            $arrivi = $this->rs_preno_da_oggi($hotel_id, $today, $now);

            $conti_gia_arrivati = $this->rs_conti_preno($now, $today, $hotel_id);


            if ($conti_gia_arrivati) {

                $this->preno_gia_arrivati = $conti_gia_arrivati['0']->preno_arrivate;
            } else {
                $this->preno_gia_arrivati = 0;
            }



            //echo "<pre>";print_r($disponibilita);
            if (count($arrivi) > 0) {
                $tot_camere_in_arrivo = (int) $arrivi['0']->somma_q1 +
                        (int) $arrivi['0']->somma_q2 +
                        (int) $arrivi['0']->somma_q3 +
                        (int) $arrivi['0']->somma_q4 +
                        (int) $arrivi['0']->somma_q5 +
                        (int) $arrivi['0']->somma_q6 -
                        (int) $this->preno_gia_arrivati;
                return $tot_camere_in_arrivo;
            } else {
                return $tot_camere_in_arrivo = 0;
            }
        }
    }

    /**
     *  prnotazon n opzone
     * @param type $hotel_id
     * @param type $today
     * @return type
     */
    function camere_in_opzione($hotel_id, $today, $now) {

        if ($today >= $now) {
            $cam_opzione = $this->rs_opzione_preno($hotel_id, $today, $now);

            return $tot_cam_opzione = $cam_opzione['0']->somma_q1 + $cam_opzione['0']->somma_q2 + $cam_opzione['0']->somma_q3 + $cam_opzione['0']->somma_q4 + $cam_opzione['0']->somma_q5 + $cam_opzione['0']->somma_q6;
        } else {
            return $tot_cam_opzione = 0;
        }
    }

    /**
     * rcavo le camare occupate
     * @param type $tot_cam_presenti
     * @param type $tot_camere_in_arrivo
     * @param type $tot_cam_opzione
     * @return type
     */
    function camere_occupate($tot_cam_presenti, $tot_camere_in_arrivo, $tot_cam_opzione) {
        $camere_occupate = $tot_cam_presenti + $tot_camere_in_arrivo + $tot_cam_opzione;
        return $camere_occupate;
    }

    /**
     *  trovo le camare lbere
     * @param type $hotel_numero_camere
     * @param type $camere_occupate
     * @return type
     */
    function camere_libere($hotel_numero_camere, $camere_occupate) {
        $tot_cam_libere = (int) $hotel_numero_camere - (int) $camere_occupate;
        return $tot_cam_libere;
    }

    /**
     * Occupazone % hotel
     * @return type
     */
    function occ_percentuale_hotel() {
        if ($this->tot_cam_occupate > 0) {
            (float) $tot_occ_percetuale_hotel = (float) $this->tot_cam_occupate / (float) $this->hotel_numero_camere;

            return (float) $tot_occ_percetuale_hotel;
        } else {
            return $tot_occ_percetuale_hotel = 0;
        }
    }

    /**
     * 
     * Restituisce un array con tutti i dati relativi alla disponibilità ed ai
     * prezzi(se includi_prezzi è = 1) per una determinata data
     * 
     * @param int $hotel_id
     * @param date $OGGI
     * @param int $includi_prezzi
     * 
     * @return array
     */
    function prezzo_hotel($hotel_id, $today, $includi_prezzi = 0) {

        $now = date('Y-m-d');


        // Utilizzo rs_hotel per estrarre i dati che mi interessano
        $this->rs_hotel = $this->rs_hotel($hotel_id);

        $this->hotel_numero_camere = $this->rs_hotel->hotel_numero_camere;

        $this->diff_gg_preno = $this->data_diff($today, $now);

        $this->hotel_tarif_cambia_gg = $this->rs_hotel->hotel_tarif_cambia_gg;
        $this->hotel_disp_modo = $this->rs_hotel->hotel_disp_modo;
        // Fine di utilizzo rs_hotel
        // 
        // Calcolo il totale delle camere in arrivo oggi

        $this->tot_cam_in_arrivo = $this->camere_in_arrivo($hotel_id, $today, $now);

        $this->tot_cam_in_opzione = $this->camere_in_opzione($hotel_id, $today, $now);

        $this->tot_cam_presenti = $this->camere_presenti($hotel_id, $today, $now);

        $this->tot_cam_occupate = $this->camere_occupate($this->tot_cam_in_arrivo, $this->tot_cam_presenti, $this->tot_cam_in_opzione);
        $this->tot_cam_libere = $this->camere_libere($this->hotel_numero_camere, $this->tot_cam_occupate);
        $this->tot_occ_percetuale_hotel = $this->occ_percentuale_hotel();


        if ($this->tot_occ_percetuale_hotel > 0.66 && $this->tot_cam_libere > 4) {
            $style = "yellow";
        } elseif ($this->tot_occ_percetuale_hotel <= 0.66 && $this->tot_occ_percetuale_hotel > 0.33) {
            $style = "blue";
        } elseif ($this->tot_occ_percetuale_hotel <= 0.33) {
            $style = "green";
        } elseif ($this->tot_cam_libere <= 4) {
            $style = "red";
        }

// inizio i prezzi 

        $tipologia_camere = $this->rs_tip_camere($hotel_id);


        $prezzo = array();
        $totale_prezzo = array();

        if ($includi_prezzi == 1) {
            foreach ($tipologia_camere as $key => $value) {

// per tutte le tipologia 

                $tipologia_id = $value->tipologia_id;
                $nome_tipologia[$tipologia_id] = $value->nome_tipologia;


// dettagli camare affittate
                $appoggio[$tipologia_id] = $this->rs_tableau($tipologia_id, $now, $today, $hotel_id);


//                print_r($appoggio);

                $tableau[$tipologia_id] = $appoggio[$tipologia_id]['0']->somma_tipologia;



// prezzo 
                $result = $this->rs_prezzo($hotel_id, $today, $tipologia_id);

                if ($result) {
                    $prezzo[$key] = $result[0];
                    $flex = $prezzo[$key]->listino_periodi_flex;
                    $soldi = $prezzo[$key]->listino_prezzo;
                } else {
                    $prezzo[$key] = 0;
                    $flex = 0;
                    $soldi = 0;
                }


// yield
                if ($this->hotel_disp_modo == 1 && $flex == 1 && $tipologia_id <> '5' && $tipologia_id <> '4' && $tipologia_id <> '8') {
//                echo $occu =   $this->tot_occ_percetuale_hotel; 

                    $occ = (float) $this->tot_occ_percetuale_hotel;
                    $num = (float) round($occ, 3);


                    $yield = $this->yield_manager($num);
                    $risultato = (float) $soldi * (float) $yield;

                    $totale_prezzo[$tipologia_id] = $risultato;
                } else {
                    $totale_prezzo[$tipologia_id] = $soldi;
                }


// cambio la tariffa se protetta

                if ( ($this->diff_gg_preno <= $this->hotel_tarif_cambia_gg ) && ( $today >= $now )  ) {
                    $totale_prezzo[$tipologia_id] = $this->rs_cambia_prezzo($hotel_id, $tipologia_id);
                }


// creo Ouput                

                $array_totale_risultati = array(
                    // area prezzi
                    'prezzo_giorno' => $totale_prezzo,
                    'tableau_dett' => $tableau,
                    'nome_tipologia' => $nome_tipologia,
                    // area disponibilita
                    'tot_cam_opzione' => $this->tot_cam_in_opzione,
                    'tot_cam_in_arrivo' => $this->tot_cam_in_arrivo,
                    'tot_cam_presenti' => $this->tot_cam_presenti,
                    'preno_gia_arrivati' => $this->preno_gia_arrivati,
                    'tot_cam_giorno' => $this->tot_cam_occupate,
                    'tot_cam_libere' => $this->tot_cam_libere,
                    'style_colore' => $style,
                    'hotel_numero_camere' => $this->hotel_numero_camere,
                    'tot_occ_percetuale_hotel' => $this->tot_occ_percetuale_hotel,
                    'diff_gg_preno' => $this->diff_gg_preno,
                    'hotel_tarif_cambia_gg' => $this->hotel_tarif_cambia_gg,
                    'hotel_disp_modo' => $this->hotel_disp_modo
                );
            }
        }
// fine iserimento prezzi 
        else {


// creo Ouput              

            $array_totale_risultati = array(
                'tot_cam_opzione' => $this->tot_cam_in_opzione,
                'tot_cam_in_arrivo' => $this->tot_cam_in_arrivo,
                'tot_cam_presenti' => $this->tot_cam_presenti,
                'preno_gia_arrivati' => $this->preno_gia_arrivati,
                'tot_cam_giorno' => $this->tot_cam_occupate,
                'tot_cam_libere' => $this->tot_cam_libere,
                'style_colore' => $style,
                'hotel_numero_camere' => $this->hotel_numero_camere,
                'tot_occ_percetuale_hotel' => $this->tot_occ_percetuale_hotel,
                'diff_gg_preno' => $this->diff_gg_preno,
                'hotel_tarif_cambia_gg' => $this->hotel_tarif_cambia_gg,
                'hotel_disp_modo' => $this->hotel_disp_modo
            );
        }
        return $array_totale_risultati;
    }

    /**
     * yield_manager
     * @param type $tot_occ_percetuale_hotel
     * @return real
     */
    function yield_manager($tot_occ_percetuale_hotel) {

        if ($tot_occ_percetuale_hotel >= -10 && $tot_occ_percetuale_hotel < 0.20) {
            $moltiplicatore = 0.75;
        }
        if ($tot_occ_percetuale_hotel >= 0.2 && $tot_occ_percetuale_hotel < 0.25) {
            $moltiplicatore = 0.775;
        }
        if ($tot_occ_percetuale_hotel >= 0.25 && $tot_occ_percetuale_hotel < 0.30) {
            $moltiplicatore = 0.80;
        }
        if ($tot_occ_percetuale_hotel >= 0.30 && $tot_occ_percetuale_hotel < 0.35) {
            $moltiplicatore = 0.825;
        }
        if ($tot_occ_percetuale_hotel >= 0.35 && $tot_occ_percetuale_hotel < 0.40) {
            $moltiplicatore = 0.850;
        }
        if ($tot_occ_percetuale_hotel >= 0.40 && $tot_occ_percetuale_hotel < 0.45) {
            $moltiplicatore = 0.875;
        }
        if ($tot_occ_percetuale_hotel >= 0.45 && $tot_occ_percetuale_hotel < 0.50) {
            $moltiplicatore = 0.90;
        }
        if ($tot_occ_percetuale_hotel >= 0.50 && $tot_occ_percetuale_hotel < 0.55) {
            $moltiplicatore = 0.925;
        }
        if ($tot_occ_percetuale_hotel >= 0.55 && $tot_occ_percetuale_hotel < 0.60) {
            $moltiplicatore = 0.950;
        }
        if ($tot_occ_percetuale_hotel >= 0.60 && $tot_occ_percetuale_hotel < 0.65) {
            $moltiplicatore = 0.975;
        }
        if ($tot_occ_percetuale_hotel >= 0.65 && $tot_occ_percetuale_hotel < 0.70) {
            $moltiplicatore = 1;
        }
        if ($tot_occ_percetuale_hotel >= 0.70 && $tot_occ_percetuale_hotel < 0.75) {
            $moltiplicatore = 1;
        }
        if ($tot_occ_percetuale_hotel >= 0.75 && $tot_occ_percetuale_hotel < 0.80) {
            $moltiplicatore = 1;
        }
        if ($tot_occ_percetuale_hotel >= 0.80 && $tot_occ_percetuale_hotel < 0.85) {
            $moltiplicatore = 1;
        }
        if ($tot_occ_percetuale_hotel >= 0.85 && $tot_occ_percetuale_hotel < 0.90) {
            $moltiplicatore = 1;
        }
        if ($tot_occ_percetuale_hotel >= 0.90 && $tot_occ_percetuale_hotel < 0.95) {
            $moltiplicatore = 1.05;
        }
        if ($tot_occ_percetuale_hotel >= 0.95 && $tot_occ_percetuale_hotel < 10) {
            $moltiplicatore = 1.1;
        }

        return $moltiplicatore;
    }

    /**
     * 
     * @param type $preno_al
     * @param type $preno_dal
     * @return type
     */
    public function data_diff($preno_al, $preno_dal) {

        if ($preno_al >= $preno_dal) {
            $differenza_date = strtotime($preno_al) - strtotime($preno_dal);
             return $data_diff = date('z', $differenza_date);
        } else {

            $differenza_date = (strtotime($preno_dal) - strtotime($preno_al)) ;
             return  $data_diff = date('z', $differenza_date);
        }

      
    }
    
    
    
    public function prezzo_web($hotel_id, $today, $includi_prezzi = 0) {
        
      $prezzo_hotel  =  prezzo_hotel($hotel_id, $today, $includi_prezzi = 0) ;
      
      
//      Array
//(
//    [prezzo_giorno] => Array
//        (
//            [7] => 105
//            [1] => 100
//            [3] => 119
//            [9] => 138
//            [2] => 119
//            [4] => 138
//            [5] => 152
//            [8] => 180
//        )
//
//    [tableau_dett] => Array
//        (
//            [7] => 12
//            [1] => 3
//            [3] => 3
//            [9] => 0
//            [2] => 6
//            [4] => 1
//            [5] => 0
//            [8] => 0
//        )
//
//    [nome_tipologia] => Array
//        (
//            [7] => Doppia Uso
//            [1] => Singola
//            [3] => Matrimoniale
//            [9] => Matri Balcone
//            [2] => Doppia
//            [4] => Tripla
//            [5] => Quadrupla
//            [8] => Quintupla
//        )
//
//    [tot_cam_opzione] => 0
//    [tot_cam_in_arrivo] => 13
//    [tot_cam_presenti] => 22
//    [tot_cam_giorno] => 35
//    [tot_cam_libere] => 12
//    [style_colore] => yellow
//    [tot_occ_percetuale_hotel] => 0.74468085106383
//    [diff_gg_preno] => 0
//    [hotel_tarif_cambia_gg] => -1
//    [hotel_disp_modo] => 1
//)

      
      
      
      
      
      
      
        
    }
    
    

}
