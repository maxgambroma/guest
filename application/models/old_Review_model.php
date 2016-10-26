<?php

class Review_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

        
        
           public function review_list($hotel_id) {

        $sql = "
		SELECT 
		  (obmp_review.pulizia_camera) AS Clean,
		  ((obmp_review.rumore_camere + obmp_review.spazio_camera) / 2) AS Comfort,
		  ((obmp_review.spazi_comuni + obmp_review.dintorni) / 2) AS Location,
		  ((obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti) / 3) AS Services,
		  ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
		  ((obmp_review.tariffa + obmp_review.raccomandi + obmp_review.prezzo_qualita + obmp_review.giudizio_totale) / 4) AS Value_for_money,
		  ((obmp_review.pulizia_camera + obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni + obmp_review.dintorni + obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti + obmp_review.accoglienza + obmp_review.competenza_impiegati + obmp_review.tariffa + (obmp_review.raccomandi * 3) + obmp_review.prezzo_qualita + (obmp_review.giudizio_totale * 2)) / 17) AS Total_score,
		  obmp_review.review_id,
		  obmp_review.hotel_id,
		  obmp_review.preno_id,
		  obmp_review.conto_id,
		  obmp_review.postazione_id,
		  obmp_review.nome,
		  obmp_review.stato,
		  obmp_review.user_type,
		  obmp_review.foto,
		  obmp_review.indicazione_mappa,
		  obmp_review.commento_tex,
		  obmp_review.ip_review,
		  obmp_review.data_review,
		  obmp_review.review_data_record,
		  camere.numero_camera,
		  conti.preno_agenzia,
		  obmp_review.raccomandi
		FROM
		  obmp_review
		  INNER JOIN camere ON (obmp_review.camera_numero = camere.camera_id)
		  INNER JOIN conti ON (obmp_review.conto_id = conti.conto_id)
		WHERE
		  (obmp_review.hotel_id = '$hotel_id')
		  ORDER BY   obmp_review.review_id DESC
		  LIMIT 25
                ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
        
		
		
	   public function review_avg($hotel_id ) {

        $sql = "
			SELECT 
			  AVG((obmp_review.pulizia_camera)) AS Clean,
			  AVG((obmp_review.rumore_camere + obmp_review.spazio_camera) / 2) AS Comfort,
			  AVG((obmp_review.spazi_comuni + obmp_review.dintorni) / 2) AS Location,
			  AVG((obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti) / 3) AS Services,
			  AVG((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
			  AVG((obmp_review.tariffa + obmp_review.raccomandi + obmp_review.prezzo_qualita + obmp_review.giudizio_totale) / 4) AS Value_for_money,
			  AVG((obmp_review.pulizia_camera + obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni + obmp_review.dintorni + obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti + obmp_review.accoglienza + obmp_review.competenza_impiegati + obmp_review.tariffa + (obmp_review.raccomandi * 3) + obmp_review.prezzo_qualita + (obmp_review.giudizio_totale * 2)) / 17) AS Total_score,
			  obmp_review.review_id,
			  obmp_review.hotel_id,
			  obmp_review.preno_id,
			  obmp_review.conto_id,
			  obmp_review.postazione_id,
			  obmp_review.camera_numero,
			  obmp_review.nome,
			  obmp_review.stato,
			  obmp_review.user_type,
			  obmp_review.foto,
			  obmp_review.indicazione_mappa,
			  obmp_review.commento_tex,
			  obmp_review.ip_review,
			  obmp_review.data_review,
			  obmp_review.review_data_record
			FROM
			  obmp_review
			WHERE
			  (obmp_review.hotel_id = '$hotel_id')
			GROUP BY  hotel_id
                ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
		
				
		
   public function review_camara($hotel_id , $camera_id ) {

        $sql = "
		  (obmp_review.pulizia_camera) AS Clean,
		  ((obmp_review.rumore_camere + obmp_review.spazio_camera) / 2) AS Comfort,
		  ((obmp_review.spazi_comuni + obmp_review.dintorni) / 2) AS Location,
		  ((obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti) / 3) AS Services,
		  ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
		  ((obmp_review.tariffa + obmp_review.raccomandi + obmp_review.prezzo_qualita + obmp_review.giudizio_totale) / 4) AS Value_for_money,
		  ((obmp_review.pulizia_camera + obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni + obmp_review.dintorni + obmp_review.colazione + obmp_review.qualita_servizi + obmp_review.servizi_offerti + obmp_review.accoglienza + obmp_review.competenza_impiegati + obmp_review.tariffa + (obmp_review.raccomandi * 3) + obmp_review.prezzo_qualita + (obmp_review.giudizio_totale * 2)) / 17) AS Total_score,
		  obmp_review.review_id,
		  obmp_review.hotel_id,
		  obmp_review.preno_id,
		  obmp_review.conto_id,
		  obmp_review.postazione_id,
		  obmp_review.nome,
		  obmp_review.stato,
		  obmp_review.user_type,
		  obmp_review.foto,
		  obmp_review.indicazione_mappa,
		  obmp_review.commento_tex,
		  obmp_review.ip_review,
		  obmp_review.data_review,
		  obmp_review.review_data_record,
		  camere.numero_camera,
		  conti.preno_agenzia,
		  obmp_review.raccomandi
		FROM
		  obmp_review
		  INNER JOIN camere ON (obmp_review.camera_numero = camere.camera_id)
		  INNER JOIN conti ON (obmp_review.conto_id = conti.conto_id)
		WHERE
		  (obmp_review.hotel_id = '$hotel_id')  AND 
		  (camere.camera_id = 'camera_id')
		  
		  ORDER BY obmp_review.review_id DESC
		   IMIT 25
                ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
		
		
	
        
}
?>