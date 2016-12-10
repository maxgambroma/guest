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
     * ANY_VALUE() 
     * @param type $hotel_id
     * @param type $today
     * @param type $now
     * @return type
     */
    
    
//            ANY_VALUE(conti.conto_id),
//            ANY_VALUE(conti.foglio_id),
//            ANY_VALUE(conti.preno_id),
//            ANY_VALUE(agenda.preno_id),
    
    public function rs_conti_preno($now, $today, $hotel_id) {

        $sql = "
            SELECT   COUNT(*) AS preno_arrivate,

            conti.conto_id,
            conti.foglio_id,
            conti.preno_id,
            agenda.preno_id,
            
            agenda.preno_dal,
            conti.in_conto
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
        $return = $query->row();
        return $return;
    }

    /**
     * trovo il prezzo per l'evento 
     * da modificare con la data evento ora non iserita
     * @param type $T1
     * @param type $hotel_id
     * @param type $today
     * @param type $ref_event
     * @return type
     */
    public function prezzo_eventi($tipologia_id, $hotel_id,  $ref_event, $today) {

        $sql = "
         SELECT
        listino_obmp.listino_nome_id,
        listino_obmp.tipologia_id,
        listino_obmp.hotel_id,
        listino_obmp.listino_prezzo,
        obmp_ref_event.listino_nome_id,
        obmp_ref_event.ref_event_id,
        obmp_ref_event.hotel_id
        FROM
        obmp_ref_event
        INNER JOIN listino_obmp ON (obmp_ref_event.listino_nome_id = listino_obmp.listino_nome_id)
        WHERE   
        (listino_obmp.tipologia_id = '$tipologia_id')
	AND (listino_obmp.hotel_id = '$hotel_id')
	AND (obmp_ref_event.ref_event_id = '$ref_event')
	AND obmp_ref_event.event_dal <= '$today'
	AND obmp_ref_event.event_al > '$today'
            ";

        $query = $this->db->query($sql);
        $return = $query->row();
        return $return;
    }

    /**
     * Detemino le tipologie di camare prenotate 
     * @param type $hotel_id
     * @param type $today
     * @param type $tipologia_id
     * @return type
     */
    
    
    
    
    
   /**
    * detemina il prezzo rack dell'hotel
    * @param type $hotel_id
    * @param type $tipologia_id
    * @return type
    */ 
    

public function prezzo_rack($hotel_id) {

$sql ="
SELECT *
FROM listino_nome_obmp
INNER JOIN listino_obmp ON (listino_nome_obmp.listino_nome_id = listino_obmp.listino_nome_id)
WHERE (listino_nome_obmp.listino_nome = 'rack') AND
(listino_nome_obmp.hotel_id = '$hotel_id') 
"; 

$query = $this->db->query($sql);
$return = $query->result();
return $return;
}

    
    
    
    
    
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
     * elenca tutte le camere vendibili sul web in una daterminta lingua
     * solo su camare reali, serve per il nasting
     * @param type $hotel_id
      @param type $tipologia_id
     * @param type $agenzia_id
     * @param type $lg
     * @return type 
     */
    function camere_obmp($hotel_id, $tipologia_id = NULL, $agenzia_id = 279, $lg = 'en', $stato = NULL) {


        if ($tipologia_id != NULL) {
            $filtro_a = " obmp_cm_rooms.obmp_cm_rooms_tipologia_id = '$tipologia_id' AND ";
        } else {
            $filtro_a = '';
        }



        if ($stato != NULL) {
            $filtro_b = " obmp_cm_rooms.obmp_cm_rooms_attiva = '$stato' AND ";
        } else {
            $filtro_b = '';
        }


        $filtro = $filtro_a . $filtro_b;


        $sql = "
            SELECT
            obmp_cm_rooms.obmp_cm_rooms_max_room,
            obmp_cm.hotel_id,
            obmp_cm.agenzia_id,
            obmp_cm.obmp_cm_id_hotel_agenzia,
            obmp_cm.obmp_cm_attiva,
            obmp_cm_rooms.obmp_cm_rooms_id,
            obmp_cm_rooms.obmp_cm_rooms_attiva,
            obmp_cm_rooms.obmp_cm_rooms_tipologia_id,
            obmp_cm_rooms.obmp_cm_rooms_room_var_prezzo,
            obmp_cm_rooms.obmp_cm_rooms_room_min_prezzo,
            obmp_cm_rooms.obmp_cm_rooms_trattamento,
            obmp_cm_rooms.obmp_cm_rooms_max_pax,
            obmp_cm_rooms.obmp_cm_rooms_room_note,
            obmp_cm_lingue.obmp_cm_lingue_codice,
            obmp_cm_lingue.obmp_cm_lingue_nome,
            obmp_cm_lingue.obmp_cm_lingue_descrizione,
            obmp_cm_lingue.obmp_cm_lingue_html1,
            obmp_cm_lingue.obmp_cm_lingue_html2,
            obmp_cm_lingue.obmp_cm_lingue_html3,
            obmp_cm_lingue.obmp_cm_lingue_note,
            obmp_cm_lingue.obmp_cm_lingue_politiche,
            obmp_cm_lingue.obmp_cm_lingue_condizioni,
            obmp_cm.obmp_cm_id,
            obmp_cm_lingue.obmp_cm_lingue_id,
            obmp_cm_rooms.obmp_cm_rooms_nesting,
            obmp_cm_rooms.obmp_cm_rooms_foto,
            obmp_cm_rooms.obmp_cm_rooms_foto270,
            obmp_cm_rooms.obmp_cm_rooms_foto150,
            obmp_cm_rooms.obmp_cm_rooms_foto700,
            tipologia_camera.tipologia_sigla,
            tipologia_camera.numero_pax
            FROM
            obmp_cm_rooms
            INNER JOIN obmp_cm
            ON obmp_cm_rooms.obmp_cm_id = obmp_cm.obmp_cm_id
            INNER JOIN obmp_cm_lingue
            ON obmp_cm_rooms.obmp_cm_rooms_id = obmp_cm_lingue.obmp_cm_rooms_id
            INNER JOIN tipologia_camera
            ON obmp_cm_rooms.obmp_cm_rooms_tipologia_id = tipologia_camera.tipologia_id
            WHERE
            obmp_cm.hotel_id = '$hotel_id' AND    
            $filtro 
            obmp_cm.agenzia_id = '$agenzia_id'  AND
            obmp_cm_lingue.obmp_cm_lingue_codice = '$lg' AND  
            obmp_cm_rooms.obmp_cm_rooms_nesting IS NOT NULL AND
            obmp_cm_rooms.obmp_cm_rooms_max_room IS NOT NULL
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

            return round($tot_occ_percetuale_hotel, 4);
            ;
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
    function prezzo_hotel($hotel_id, $today, $includi_prezzi = 0, $ref_event = NULL) {

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

// colori occupazione
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

        $tableau[0] = 0;
        $prezzo[0] = 0;

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

                if (($this->diff_gg_preno <= $this->hotel_tarif_cambia_gg ) && ( $today >= $now )) {
                    $protetta = $this->rs_cambio_prezzo($hotel_id, $tipologia_id);
                    if ($protetta) {
                        $totale_prezzo[$tipologia_id] = $protetta->listino_prezzo;
                    } else {
                        $totale_prezzo[$tipologia_id] = 0;
                    }
                }

// se è un evento metto il prezzo 

                if (!empty($ref_event) && isset($ref_event)) {
                    
                    $evento = $this->prezzo_eventi($tipologia_id, $hotel_id,  $ref_event, $today);
                    
                    if ($evento) {
                        $totale_prezzo[$tipologia_id] = $evento->listino_prezzo;
                    } 
                    
//                    else {
//                        $totale_prezzo[$tipologia_id] = 200;
//                    }
                }


// setto l'errore
                if ($totale_prezzo[$tipologia_id] > 1) {
                    $errore_booking = 0;
                } else {
                    $errore_booking = 1;
                }

                if ($this->tot_cam_libere >= 0) {
                    $errore_booking = 0;
                } else {
                    $errore_booking = 1;
                }
            } //fine ciclo tipologia
            // nesting                

            $nesting = $this->nesting_tipologia($hotel_id, $tableau, $this->tot_cam_libere);


            // creo Ouput                

            $array_totale_risultati = array(
                // area prezzi
                'prezzo_giorno' => $totale_prezzo,
                'tableau_dett' => $tableau,
                'nesting' => $nesting,
                'nome_tipologia' => $nome_tipologia,
                'errore_booking' => $errore_booking,
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
     * Cerco le tariffe dei singoli giorni di soggiorno 
     * @param type $hotel_id
     * @param type $preno_dal
     * @param type $preno_al
     * @param int $includi_prezzi
     */
    public function prezzo_web($hotel_id, $preno_dal, $preno_al, $includi_prezzi = 0, $ref_event = NULL) {

        
        
// protezioni per le date passate
        if ($preno_dal < date('Y-m-d')) {
            $preno_dal = date('Y-m-d');
        }
        if ($preno_al <= $preno_dal) {
            $preno_al = $this->somma_gg($preno_dal, 1);
        }

        $notti = $this->data_diff($preno_al, $preno_dal);
        $oggi = $preno_dal;
// scorro le date per le array 
        while ($oggi < $preno_al) {

            $today = $oggi;
            $giorno = $this->prezzo_hotel($hotel_id, $today, $includi_prezzi = 1, $ref_event);

// array KW prezzi tipologia giorno 
            foreach ($giorno['prezzo_giorno'] as $key => $value) {
                $prezzo_giorno[$key][$oggi] = round($value, 2);
            }
// array KW tableau_dett giornaliarei
            foreach ($giorno['tableau_dett'] as $key => $value) {
                $tableau_dett[$key][$oggi] = $value;
            }

// array KW nesting giornaliarei
            foreach ($giorno['nesting'] as $key => $value) {
                $nesting[$key][$oggi] = $value;
            }

// array giorno
            $errore_booking[$oggi] = $giorno['errore_booking'];
            $tot_cam_opzione[$oggi] = $giorno['tot_cam_opzione'];
            $tot_cam_in_arrivo[$oggi] = $giorno['tot_cam_in_arrivo'];
            $tot_cam_presenti[$oggi] = $giorno['tot_cam_presenti'];
            $tot_cam_giorno[$oggi] = $giorno['tot_cam_giorno'];
            $tot_cam_libere[$oggi] = $giorno['tot_cam_libere'];
            $style_colore[$oggi] = $giorno['style_colore'];
            $tot_occ_percetuale_hotel[$oggi] = $giorno['tot_occ_percetuale_hotel'];

// incremento di un giorno loop
            $oggi = $this->somma_gg($oggi, 1);
        }

        $diff_gg_preno = $giorno['diff_gg_preno'];
        $hotel_tarif_cambia_gg = $giorno['hotel_tarif_cambia_gg'];
        $nome_tipologia = $giorno['nome_tipologia'];
        $hotel_numero_camere = $giorno['hotel_numero_camere'];
        $hotel_disp_modo = $giorno['hotel_disp_modo'];
       
        

// totale soggiorno   
        $sum_prezzo[0] = 0;

        foreach ($prezzo_giorno as $key => $value) {
            $sum_prezzo[$key] = round(array_sum($value), 2);
        }
        
// min_nesting
        
        foreach ($nesting as $key => $value) {
            $min_nesting[$key] = min($value);
        }
        

// prezzo medio giornaliero
        $avg_prezzo[0] = 0;
        foreach ($prezzo_giorno as $key => $value) {
            $avg_prezzo[$key] = round(array_sum($value) / count($value), 2);
        }

 // tariffa rack

        
$rack  =  $this->prezzo_rack($hotel_id) ;
foreach ($rack as $value) {



$rack_prezzo[$value->tipologia_id] = $value->listino_prezzo;

}


        $array_totale_risultati = array(
// area prezzi
            'prezzo_giorno' => $prezzo_giorno,
            'sum_prezzo' => $sum_prezzo,
            'avg_prezzo' => $avg_prezzo,
            'rack_prezzo' =>  $rack_prezzo,
            'min_nesting' => $min_nesting,
            'tableau_dett' => $tableau_dett,
            'nesting' => $nesting,
            'nome_tipologia' => $nome_tipologia,
            'errore_booking' => $errore_booking,
// area disponibilita
// 'tot_cam_opzione' => $tot_cam_in_opzione,
            'tot_cam_in_arrivo' => $tot_cam_in_arrivo,
            'tot_cam_presenti' => $tot_cam_presenti,
// 'preno_gia_arrivati' => $preno_gia_arrivati,
            'tot_cam_giorno' => $tot_cam_giorno,
            'tot_cam_libere' => $tot_cam_libere,
//  'style_colore' => $style,
            'hotel_numero_camere' => $hotel_numero_camere,
            'tot_occ_percetuale_hotel' => $tot_occ_percetuale_hotel,
            'diff_gg_preno' => $diff_gg_preno,
            'hotel_tarif_cambia_gg' => $hotel_tarif_cambia_gg,
            'hotel_disp_modo' => $hotel_disp_modo,
            'preno_dal' => $preno_dal,
            'preno_al' => $preno_al,
            'notti' => $notti
        );

        return $array_totale_risultati;
    }

    
    
    
    function functionName($prezzo, $camere) {

     foreach ($camere as $key => $room) {
         
//
//     obmp_cm_rooms_id,
//     obmp_cm_rooms_tipologia_id
//     obmp_cm_rooms_room_var_prezzo
                 
                 
                 
         foreach ($prezzo['prezzo_giorno'][$room['obmp_cm_rooms_id']] as $gg => $price) {
             
              $prezzo_giorno[$room['obmp_cm_rooms_id']][$room['obmp_cm_rooms_tipologia_id']][$gg] = $price *  $room->obmp_cm_rooms_room_var_prezzo;     
             
         } 
                 
          
                 
     }
             
             
             
//         Array
//(
//    [prezzo_giorno] => Array
//        (
//            [7] => Array
//                (
//                    [2016-12-07] => 85
//                )
//
//            [1] => Array
//                (
//                    [2016-12-07] => 85
//                )
//
//            [2] => Array
//                (
//                    [2016-12-07] => 105
//                )
//
//            [3] => Array
//                (
//                    [2016-12-07] => 105
//                )
//
//            [4] => Array
//                (
//                    [2016-12-07] => 135
//                )
//
//            [5] => Array
//                (
//                    [2016-12-07] => 150
//                )
//
//            [8] => Array
//                (
//                    [2016-12-07] => 160
//                )
//
//        )
//
//    [sum_prezzo] => Array
//        (
//            [0] => 0
//            [7] => 85
//            [1] => 85
//            [2] => 105
//            [3] => 105
//            [4] => 135
//            [5] => 150
//            [8] => 160
//        )
//
//    [avg_prezzo] => Array
//        (
//            [0] => 0
//            [7] => 85
//            [1] => 85
//            [2] => 105
//            [3] => 105
//            [4] => 135
//            [5] => 150
//            [8] => 160
//        )
//
//    [min_nesting] => Array
//        (
//            [7] => 6
//            [1] => 6
//            [2] => 6
//            [3] => 6
//            [4] => 3
//            [5] => 2
//            [8] => 0
//        )
//
//    [tableau_dett] => Array
//        (
//            [0] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//            [7] => Array
//                (
//                    [2016-12-07] => 16
//                )
//
//            [1] => Array
//                (
//                    [2016-12-07] => 4
//                )
//
//            [2] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//            [3] => Array
//                (
//                    [2016-12-07] => 2
//                )
//
//            [4] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//            [5] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//            [8] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//        )
//
//    [nesting] => Array
//        (
//            [7] => Array
//                (
//                    [2016-12-07] => 6
//                )
//
//            [1] => Array
//                (
//                    [2016-12-07] => 6
//                )
//
//            [2] => Array
//                (
//                    [2016-12-07] => 6
//                )
//
//            [3] => Array
//                (
//                    [2016-12-07] => 6
//                )
//
//            [4] => Array
//                (
//                    [2016-12-07] => 3
//                )
//
//            [5] => Array
//                (
//                    [2016-12-07] => 2
//                )
//
//            [8] => Array
//                (
//                    [2016-12-07] => 0
//                )
//
//        )
//
//    [nome_tipologia] => Array
//        (
//            [7] => Doppia Uso
//            [1] => Singola
//            [2] => Doppia
//            [3] => Matrimoniale
//            [4] => Tripla
//            [5] => Quadrupla
//            [8] => Quintupla
//        )
//
//    [errore_booking] => Array
//        (
//            [2016-12-07] => 0
//        )
//
//    [tot_cam_in_arrivo] => Array
//        (
//            [2016-12-07] => 4
//        )
//
//    [tot_cam_presenti] => Array
//        (
//            [2016-12-07] => 15
//        )
//
//    [tot_cam_giorno] => Array
//        (
//            [2016-12-07] => 19
//        )
//
//    [tot_cam_libere] => Array
//        (
//            [2016-12-07] => 75
//        )
//
//    [hotel_numero_camere] => 94
//    [tot_occ_percetuale_hotel] => Array
//        (
//            [2016-12-07] => 0.2021
//        )
//
//    [diff_gg_preno] => 0
//    [hotel_tarif_cambia_gg] => -1
//    [hotel_disp_modo] => 1
//    [preno_dal] => 2016-12-07
//    [preno_al] => 2016-12-08
//    [notti] => 1
//)
//        
        
    }
    
   
    
    
    /**
     * 
     * @param type $hotel_id
     * @param type $tableau
     * @param type $tot_cam_libere
     * @return int
     */
    
    
    function nesting_tipologia($hotel_id, $tableau, $tot_cam_libere) {
// print_r($tableau);
// per tutte le tipologie
// setto tutte le tipoloie a zero     
$tab[1] = 0; // X
$tab[2] = 0; // XX
$tab[3] = 0; // M
$tab[4] = 0; // MX
$tab[5] = 0; // MXX
$tab[6] = 0; // JS
$tab[7] = 0; // DUS
$tab[8] = 0; // MMX
$tab[9] = 0; // MT
$tab[10] = 0;
$tab[11] = 0;
//print_r($tableau);
// sovrascrivo
        foreach ($tableau as $key => $value) {
            $tab[$key] = $value;
        }

        foreach ($tableau as $key => $value) {

// proteggo dalle tipologia 0
            if ($key != 0) {
                $camere = $this->camere_obmp($hotel_id, $key);

                foreach ($camere as $cam_value) {

//  [1] => Singola
                    if ($key == 1) {
                        
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - ( (float) $tab[0] + ( (float) $tab[1] + (float) $tab[7]) + ((float) $tab[3] + (float) $tab[2] + (float) $tab[9] + (float) $tab[6] ) + ((float) $tab[4]) + ((float) $tab[5]) + ((float) $tab[8]) );
                        
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

                    
                    
                    
                    
//  [7] => Doppia Uso
                    if ($key == 7) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] + (float) $tab[7]) + ((float) $tab[3] + (float) $tab[2] + (float) $tab[9] + (float) $tab[6] ) + ( (float) $tab[4]) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                            
                            
     
                            
                            
                            
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

// [2] => Doppia
                    if ($key == 2) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ((float) $tab[3] + (float) $tab[2] + (float) $tab[9] + (float) $tab[6] ) + (float) ($tab[4]) + (float) ($tab[5]) + (float) ($tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

// [3] => Matrimoniale
                    if ($key == 3) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ( (float) $tab[3] + (float) $tab[2] + (float) $tab[9] + (float) $tab[6] ) + ((float) $tab[4]) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

//   [4] => Tripla
                    if ($key == 4) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ( (float) $tab[6] ) + ((float) $tab[4]) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

//   [5] => Quadrupla
                    if ($key == 5) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ( (float) $tab[6] ) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

//   [6] => Junior Suit
                    if ($key == 6) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ( (float) $tab[6] ) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

//    [8] => Quintupla   
                    if ($key == 8) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - (( (float) $tab[0] ) + ( (float) $tab[6] ) + ((float) $tab[5]) + ((float) $tab[8]));
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

//   [9] => Terrazzo   
                    if ($key == 9) {
                        $nesting[$key] = (float) $cam_value->obmp_cm_rooms_nesting - ((float) $tab[0] + (float) $tab[9] );
// ho diaponibilita generale
                        if ($tot_cam_libere > 0 && $nesting[$key] > 0) {

// trovo il valore minimo da mostrare
                            $rooms_nesting[$key] = min((float) $cam_value->obmp_cm_rooms_max_room, $nesting[$key], $tot_cam_libere);
                        }
//      non ho disponoibilita e metto zero
                        else {
// non ho disponibilità
                            $rooms_nesting[$key] = 0;
                        }
                    }

                    if ($key == 0) {
                        $nesting[$key] = 0;
                    }

//  $nesting[$key] = $cam_value->obmp_cm_rooms_nesting - $tab[$key] ;
                }
            }
        }

// return $nesting;
        return $rooms_nesting;
    }
    
    
    
    
     function qualcosa() {
      
    
$tab[1] = 0; // X
$tab[2] = 0; // XX

$tab[3] = 0; // M
$tab[4] = 0; // MX
$tab[5] = 0; // MXX
$tab[6] = 0; // JS
$tab[7] = 0; // DUS
$tab[8] = 0; // MMX
$tab[9] = 0; // MT    
         
         
// elenco la camare
         $camere = $this->camere_obmp($hotel_id, $key);

    
                    
                 $dif_nest[2] =   ((float) $cam_value[2]->obmp_cm_rooms_max_room - (float) $cam_value[1]->obmp_cm_rooms_max_room ) ; // DUS  -X
                 
                 $dif_nest[2] =   ((float) $cam_value[3]->obmp_cm_rooms_max_room - (float) $cam_value[2]->obmp_cm_rooms_max_room ) ; // M - XX
                 $dif_nest[2] =   ((float) $cam_value[2]->obmp_cm_rooms_max_room - (float) $cam_value[1]->obmp_cm_rooms_max_room ) ; // - 
                 $dif_nest[2] =   ((float) $cam_value[2]->obmp_cm_rooms_max_room - (float) $cam_value[1]->obmp_cm_rooms_max_room ) ;
                 $dif_nest[2] =   ((float) $cam_value[2]->obmp_cm_rooms_max_room - (float) $cam_value[1]->obmp_cm_rooms_max_room ) ;
                 $dif_nest[2] =   ((float) $cam_value[2]->obmp_cm_rooms_max_room - (float) $cam_value[1]->obmp_cm_rooms_max_room ) ;
                    
      
                    
                    
    
         
         
        return $data_gg;
    }

    
    
    

    /**
     * sommo i giorni ad una data
     * @param type $OGGI
     * @param type $gg
     * @return type
     */
    protected function somma_gg($OGGI, $gg) {
        $appoggio = explode('-', $OGGI);
        $anno = $appoggio[0];
        $mese = $appoggio[1];
        $giorno = $appoggio[2];

        return $data_gg = date("Y-m-d", mktime(0, 0, 0, $mese, ($giorno + $gg), $anno));
    }

    /**
     *  trovo i giorni tra due date
     * @param type $preno_al
     * @param type $preno_dal
     * @return type
     */
    protected function data_diff($preno_al, $preno_dal) {

        if ($preno_al >= $preno_dal) {
            $differenza_date = strtotime($preno_al) - strtotime($preno_dal);
            return $data_diff = date('z', $differenza_date);
        } else {

            $differenza_date = (strtotime($preno_dal) - strtotime($preno_al));
            return $data_diff = date('z', $differenza_date);
        }
    }

}
