<?php
// Agenda_model.php
class Agenda_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function find()
       * find form data
       * @param $form_data - array
       * @return object
       */
	
	public function find()
            {
                return $this->db->get( 'agenda' )->result() ;
            }

      /** 
       * function find_limit($offset,$limit)
       * find form data
       * @param $form_data - array
       * @return Array
       */
       	
	public function find_limit($limit = 100, $offset = 0 )
            {
                $query= $this->db->query("
                SELECT *
                FROM agenda
                LIMIT $offset , $limit "); 
                return   $query->result();
            }

         /** 
       * function count all record 
       * 
       * @param $form_data - array
       * @return object
       */
	
        public function record_count()
            {
                return $this->db->count_all('agenda');
            }

	/** 
       * function find_by_id($preno_id)
       * find preno_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($preno_id)
            {	
                $query = $this->db->query("
                SELECT
                *,
                ( agenda.q1 + agenda.q2 + agenda.q3 + agenda.q4 + agenda.q5 + agenda.q6 ) AS Tot_cam,
                ( if( agenda.t1 = 1 , agenda.q1 , 0 ) + if( agenda.t2 = 1 , agenda.q2 , 0 ) + if( agenda.t3 = 1 , agenda.q3 , 0 ) + if( agenda.t4 = 1 , agenda.q4 , 0 ) + if( agenda.t5 = 1 , agenda.q5 , 0 ) + if( agenda.t6 = 1 , agenda.q6 , 0 ) ) AS Singola,
                ( if( agenda.t1 = 7 , agenda.q1 , 0 ) + if( agenda.t2 = 7 , agenda.q2 , 0 ) + if( agenda.t3 = 7 , agenda.q3 , 0 ) + if( agenda.t4 = 7 , agenda.q4 , 0 ) + if( agenda.t5 = 7 , agenda.q5 , 0 ) + if( agenda.t6 = 7 , agenda.q6 , 0 ) ) AS Doppia_Uso,
                ( if( agenda.t1 = 2 , agenda.q1 , 0 ) + if( agenda.t2 = 2 , agenda.q2 , 0 ) + if( agenda.t3 = 2 , agenda.q3 , 0 ) + if( agenda.t4 = 2 , agenda.q4 , 0 ) + if( agenda.t5 = 2 , agenda.q5 , 0 ) + if( agenda.t6 = 2 , agenda.q6 , 0 ) ) AS Doppia,
                ( if( agenda.t1 = 3 , agenda.q1 , 0 ) + if( agenda.t2 = 3 , agenda.q2 , 0 ) + if( agenda.t3 = 3 , agenda.q3 , 0 ) + if( agenda.t4 = 3 , agenda.q4 , 0 ) + if( agenda.t5 = 3 , agenda.q5 , 0 ) + if( agenda.t6 = 3 , agenda.q6 , 0 ) ) AS Matrimoniale,
                ( if( agenda.t1 = 9 , agenda.q1 , 0 ) + if( agenda.t2 = 9 , agenda.q2 , 0 ) + if( agenda.t3 = 9 , agenda.q3 , 0 ) + if( agenda.t4 = 9 , agenda.q4 , 0 ) + if( agenda.t5 = 9 , agenda.q5 , 0 ) + if( agenda.t6 = 9 , agenda.q6 , 0 ) ) AS Matri_Balcone,
                ( if( agenda.t1 = 4 , agenda.q1 , 0 ) + if( agenda.t2 = 4 , agenda.q2 , 0 ) + if( agenda.t3 = 4 , agenda.q3 , 0 ) + if( agenda.t4 = 4 , agenda.q4 , 0 ) + if( agenda.t5 = 4 , agenda.q5 , 0 ) + if( agenda.t6 = 4 , agenda.q6 , 0 ) ) AS Tripla,
                ( if( agenda.t1 = 5 , agenda.q1 , 0 ) + if( agenda.t2 = 5 , agenda.q2 , 0 ) + if( agenda.t3 = 5 , agenda.q3 , 0 ) + if( agenda.t4 = 5 , agenda.q4 , 0 ) + if( agenda.t5 = 5 , agenda.q5 , 0 ) + if( agenda.t6 = 5 , agenda.q6 , 0 ) ) AS Quadrupla,
                ( if( agenda.t1 = 6 , agenda.q1 , 0 ) + if( agenda.t2 = 6 , agenda.q2 , 0 ) + if( agenda.t3 = 6 , agenda.q3 , 0 ) + if( agenda.t4 = 6 , agenda.q4 , 0 ) + if( agenda.t5 = 6 , agenda.q5 , 0 ) + if( agenda.t6 = 6 , agenda.q6 , 0 ) ) AS Junior_Suit,
                ( if( agenda.t1 = 8 , agenda.q1 , 0 ) + if( agenda.t2 = 8 , agenda.q2 , 0 ) + if( agenda.t3 = 8 , agenda.q3 , 0 ) + if( agenda.t4 = 8 , agenda.q4 , 0 ) + if( agenda.t5 = 8 , agenda.q5 , 0 ) + if( agenda.t6 = 8 , agenda.q6 , 0 ) ) AS Quintupla
                FROM
                agenda
                 WHERE
                agenda.preno_id = '$preno_id'
                ");
                return $query->row();
            }

        /** 
       * function insert($data)
       * insert to agenda data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('agenda');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($preno_id, $data)
       * insert update preno_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($preno_id, $data)
            {
                $this->db->where('preno_id', $preno_id);
                $this->db->set($data);
                $this->db->update('agenda');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($preno_id)
       * delete form agenda data
       * @param 
       * @return 
       */

	public function delete($preno_id)
            {
                $this->db->where('preno_id', $preno_id);
                $this->db->delete('agenda');
                return $this->db->affected_rows();
            }
	
            
            
               
    /**
     * elenca le prenotazioni che hanno la stessa email forse dello stesso cliente
     *  $filtro = 1 solo le confermate o attive
     * @param type $email
     * @return type
     */
    
    
    function get_booking_by_email($email, $filtro = 0 ) {
        
       if( $filtro == 1){ 
      $filtro =  " AND 

	((agenda.preno_stato = '1') OR
            ((agenda.preno_stato = '2') AND
            (agenda.data_opzione >= '$now')))" ;

       }
 else {
          $filtro = NULL ; 
       }
        
        $now = date('Y-m-d');
        $query = $this->db->query("
SELECT
	*,
	( agenda.q1 + agenda.q2 + agenda.q3 + agenda.q4 + agenda.q5 + agenda.q6 ) AS Tot_cam,
	( if( agenda.t1 = 1 , agenda.q1 , 0 ) + if( agenda.t2 = 1 , agenda.q2 , 0 ) + if( agenda.t3 = 1 , agenda.q3 , 0 ) + if( agenda.t4 = 1 , agenda.q4 , 0 ) + if( agenda.t5 = 1 , agenda.q5 , 0 ) + if( agenda.t6 = 1 , agenda.q6 , 0 ) ) AS Singola,
	( if( agenda.t1 = 7 , agenda.q1 , 0 ) + if( agenda.t2 = 7 , agenda.q2 , 0 ) + if( agenda.t3 = 7 , agenda.q3 , 0 ) + if( agenda.t4 = 7 , agenda.q4 , 0 ) + if( agenda.t5 = 7 , agenda.q5 , 0 ) + if( agenda.t6 = 7 , agenda.q6 , 0 ) ) AS Doppia_Uso,
	( if( agenda.t1 = 2 , agenda.q1 , 0 ) + if( agenda.t2 = 2 , agenda.q2 , 0 ) + if( agenda.t3 = 2 , agenda.q3 , 0 ) + if( agenda.t4 = 2 , agenda.q4 , 0 ) + if( agenda.t5 = 2 , agenda.q5 , 0 ) + if( agenda.t6 = 2 , agenda.q6 , 0 ) ) AS Doppia,
	( if( agenda.t1 = 3 , agenda.q1 , 0 ) + if( agenda.t2 = 3 , agenda.q2 , 0 ) + if( agenda.t3 = 3 , agenda.q3 , 0 ) + if( agenda.t4 = 3 , agenda.q4 , 0 ) + if( agenda.t5 = 3 , agenda.q5 , 0 ) + if( agenda.t6 = 3 , agenda.q6 , 0 ) ) AS Matrimoniale,
	( if( agenda.t1 = 9 , agenda.q1 , 0 ) + if( agenda.t2 = 9 , agenda.q2 , 0 ) + if( agenda.t3 = 9 , agenda.q3 , 0 ) + if( agenda.t4 = 9 , agenda.q4 , 0 ) + if( agenda.t5 = 9 , agenda.q5 , 0 ) + if( agenda.t6 = 9 , agenda.q6 , 0 ) ) AS Matri_Balcone,
	( if( agenda.t1 = 4 , agenda.q1 , 0 ) + if( agenda.t2 = 4 , agenda.q2 , 0 ) + if( agenda.t3 = 4 , agenda.q3 , 0 ) + if( agenda.t4 = 4 , agenda.q4 , 0 ) + if( agenda.t5 = 4 , agenda.q5 , 0 ) + if( agenda.t6 = 4 , agenda.q6 , 0 ) ) AS Tripla,
	( if( agenda.t1 = 5 , agenda.q1 , 0 ) + if( agenda.t2 = 5 , agenda.q2 , 0 ) + if( agenda.t3 = 5 , agenda.q3 , 0 ) + if( agenda.t4 = 5 , agenda.q4 , 0 ) + if( agenda.t5 = 5 , agenda.q5 , 0 ) + if( agenda.t6 = 5 , agenda.q6 , 0 ) ) AS Quadrupla,
	( if( agenda.t1 = 6 , agenda.q1 , 0 ) + if( agenda.t2 = 6 , agenda.q2 , 0 ) + if( agenda.t3 = 6 , agenda.q3 , 0 ) + if( agenda.t4 = 6 , agenda.q4 , 0 ) + if( agenda.t5 = 6 , agenda.q5 , 0 ) + if( agenda.t6 = 6 , agenda.q6 , 0 ) ) AS Junior_Suit,
	( if( agenda.t1 = 8 , agenda.q1 , 0 ) + if( agenda.t2 = 8 , agenda.q2 , 0 ) + if( agenda.t3 = 8 , agenda.q3 , 0 ) + if( agenda.t4 = 8 , agenda.q4 , 0 ) + if( agenda.t5 = 8 , agenda.q5 , 0 ) + if( agenda.t6 = 8 , agenda.q6 , 0 ) ) AS Quintupla
FROM
	agenda
	LEFT OUTER JOIN agenzie
	 ON agenda.preno_agenzia = agenzie.agenzia_id
         	INNER JOIN hotels
	 ON agenda.hotel_id = hotels.hotel_id
WHERE
    agenda.preno_email = '$email' AND
        agenda.preno_dal >= '$now' 
        $filtro

ORDER BY
	agenda.preno_dal ASC,
	agenda.preno_al DESC
        ");
        return $query->result();
    }

       
    
    
       function booking_id_email($preno_id, $email) {
        
        $now = date('Y-m-d');
        $query = $this->db->query("
SELECT *
	
FROM
	agenda
	LEFT OUTER JOIN agenzie
	 ON agenda.preno_agenzia = agenzie.agenzia_id
         	INNER JOIN hotels
	 ON agenda.hotel_id = hotels.hotel_id
WHERE
    agenda.preno_id = '$preno_id' AND 
        agenda.preno_email = '$email'

        ");
        return $query->result();
    }
    
    
    
       
       function booking_id($preno_id) {
        
        $now = date('Y-m-d');
        $query = $this->db->query("
SELECT
	usr_web1_3.obmp_review.hotel_id,
	usr_web1_3.obmp_review.postazione_id,
	usr_web1_3.obmp_review.nome,
	usr_web1_3.obmp_review.stato,
	usr_web1_3.obmp_review.user_type,
	usr_web1_3.obmp_review.pulizia_camera,
	usr_web1_3.obmp_review.accoglienza,
	usr_web1_3.obmp_review.rumore_camere,
	usr_web1_3.obmp_review.spazio_camera,
	usr_web1_3.obmp_review.spazi_comuni,
	usr_web1_3.obmp_review.competenza_impiegati,
	usr_web1_3.obmp_review.qualita_servizi,
	usr_web1_3.obmp_review.colazione,
	usr_web1_3.obmp_review.dintorni,
	usr_web1_3.obmp_review.tariffa,
	usr_web1_3.obmp_review.servizi_offerti,
	usr_web1_3.obmp_review.foto,
	usr_web1_3.obmp_review.indicazione_mappa,
	usr_web1_3.obmp_review.giudizio_totale,
	usr_web1_3.obmp_review.prezzo_qualita,
	usr_web1_3.obmp_review.commento_tex,
	usr_web1_3.obmp_review.raccomandi,
	hotels.nome_hotel,
	hotels.hotel_tipologia,
	hotels.hotel_categoria,
	hotels.hotel_citta,
	hotels.hotel_via,
	hotels.hotel_tel,
	hotels.hotel_fax,
	hotels.hotel_email,
	hotels.hotel_stato,
	hotels.hotel_cap,
	hotels.hotel_piva,
	hotels.hotel_numero_camere,
	agenzie.agenzia_id,
	agenzie.agenzia_tipologia,
	agenzie.agenzia_nome,
	agenzie.agenzia_via,
	agenzie.agenzia_citta,
	agenzie.agenzia_state,
	agenzie.agenzia_country,
	agenzie.agenzia_cap,
	agenzie.agenzia_tel,
	agenzie.agenzia_fax,
	agenzie.agenzia_email,
	agenzie.agenzia_web,
	agenda.preno_id,
	agenda.hotel_id,
	agenda.preno_in_data,
	agenda.preno_importo,
	agenda.preno_impoto_mod,
	agenda.preno_dal,
	agenda.preno_al,
	agenda.preno_n_notti,
	agenda.preno_arr_ore,
	agenda.preno_trattamento,
	agenda.t1,
	agenda.q1,
	agenda.p1,
	agenda.t2,
	agenda.q2,
	agenda.p2,
	agenda.t3,
	agenda.q3,
	agenda.p3,
	agenda.t4,
	agenda.q4,
	agenda.p4,
	agenda.t5,
	agenda.q5,
	agenda.p5,
	agenda.t6,
	agenda.q6,
	agenda.p6,
	agenda.preno_nome,
	agenda.preno_cogno,
	agenda.voucher_id,
	agenda.allotment_id,
	agenda.preno_cc_tip,
	agenda.preno_cc_n,
	agenda.preno_cc_scad,
	agenda.preno_tel,
	agenda.preno_fax,
	agenda.preno_email,
	agenda.preno_mercato,
	agenda.preno_note,
	agenda.preno_doc_fax,
	agenda.preno_doc_email,
	agenda.preno_doc_form,
	agenda.preno_doc_mail,
	agenda.preno_doc_vaglia,
	agenda.preno_doc_woucher,
	agenda.preno_pag_modalita,
	agenda.preno_caparra,
	agenda.preno_stato,
	agenda.data_opzione,
	agenda.cancella_data_record,
	agenda.cancella_user,
	agenda.cancella_pass,
	agenda.preno_data_record,
	agenda.agenda_utente_id,
	hotels.hotel_data_record,
	hotels.hotels_utente_id,
	hotels.hotel_web,
	hotels.hotel_logo,
	hotels.hotel_mappa,
	hotels.hotel_reach_by_car,
	hotels.hotel_reach_by_treno,
	hotels.hotel_reach_aereo,
	hotels.hotel_reach_nave,
	hotels.hotel_foto_piccola,
	hotels.hotel_foto_grande,
	hotels.hotel_testo_en,
	hotels.hotel_testo_it,
	hotels.hotel_disp_modo,
	hotels.hotel_limite_vendite_web,
	hotels.hotel_incremento_prezzo_xml,
	hotels.hotel_limite_vendite_xml,
	hotels.hotel_id,
	hotels.hotel_booking_attivazione,
	hotels.hotel_booking_url,
	hotels.hotel_tarif_cambia_gg,
	hotels.hotel_tarif_listino_nome_id,
	hotels.hotel_agenzia_attivazione,
	hotels.hotel_type_booking,
	hotels.hotel_check_in,
	hotels.hotel_check_out,
	hotels.hotel_serv_inclusi,
	hotels.hotel_cancel_pol,
	hotels.facebook,
	hotels.google,
	hotels.instagram,
	hotels.twitter,
	hotels.linkedin,
	hotels.analytics,
	hotels.email_desk
      FROM  
	agenda
	LEFT OUTER JOIN agenzie
	 ON agenda.preno_agenzia = agenzie.agenzia_id
	INNER JOIN hotels
	 ON agenda.hotel_id = hotels.hotel_id
	LEFT OUTER JOIN usr_web1_3.obmp_review
	 ON agenda.preno_id = usr_web1_3.obmp_review.hotel_id
WHERE
	agenda.preno_id = '$preno_id'
        ");
        return $query->result();
    }
    
    
    
    
    /**
     * elenco tutte le camare presenti sul web nella lingua selezionate
     * @param type $lg
     * @param type $hotel_id
     * @return type
     */

          function tip_lg_preno($lg, $hotel_id ) {
        
        $now = date('Y-m-d');
        $query = $this->db->query("

            SELECT
            obmp_cm.agenzia_id,
            obmp_cm.obmp_cm_id,
            obmp_cm.hotel_id,
            obmp_cm_rooms.obmp_cm_rooms_attiva,
            obmp_cm_rooms.obmp_cm_rooms_tipologia_id,
            obmp_cm_rooms.obmp_cm_rooms_trattamento,
            obmp_cm_rooms.obmp_cm_rooms_max_pax,
            obmp_cm_rooms.obmp_cm_rooms_max_room,
            obmp_cm_rooms.obmp_cm_rooms_foto,
            obmp_cm_rooms.obmp_cm_rooms_foto150,
            obmp_cm_rooms.obmp_cm_rooms_foto270,
            obmp_cm_rooms.obmp_cm_rooms_foto700,
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
            obmp_cm_rooms.obmp_cm_rooms_id,
            obmp_cm_lingue.obmp_cm_lingue_id
            FROM
            obmp_cm_rooms
            INNER JOIN obmp_cm
             ON obmp_cm_rooms.obmp_cm_id = obmp_cm.obmp_cm_id
            INNER JOIN obmp_cm_lingue
             ON obmp_cm_rooms.obmp_cm_rooms_id = obmp_cm_lingue.obmp_cm_rooms_id
            WHERE
            obmp_cm_lingue.obmp_cm_lingue_codice = '$lg'
            AND obmp_cm.agenzia_id = '279'
            AND obmp_cm.hotel_id = '$hotel_id'
            AND obmp_cm_rooms.obmp_cm_rooms_attiva = '1'

        ");
         $dati =  $query->result();
         
         foreach ($dati  as $key => $value) {
             $row[$value->obmp_cm_rooms_tipologia_id] = $value;
         } 
         
         return $row;
         
         
         
    }

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
            
            
}
?>