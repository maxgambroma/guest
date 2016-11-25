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