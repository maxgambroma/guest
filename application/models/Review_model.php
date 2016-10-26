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

	   
	   
/*

Clean:
	pulizia_camera
Comfort:
	rumore_camere
	spazio_camera
	spazi_comuni
Location:
	dintorni
Services:
	qualita_servizi
	colazione
Staff:
	accoglienza
	competenza_impiegati
Valore/Qualit�
	prezzo_qualita
Totale:
	giudizio_totale
Raccomandi
	raccomandi

	   */
	   
        
        
           public function review_list($hotel_id) {

        $sql = "
		SELECT 
  (obmp_review.pulizia_camera) AS Clean,
  ((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
  (obmp_review.dintorni) AS Location,
  ((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
  ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
  (obmp_review.prezzo_qualita) AS Value_for_money,
  (obmp_review.giudizio_totale) AS Total_score,
  obmp_review.review_id,
  obmp_review.hotel_id,
  obmp_review.preno_id,
  obmp_review.conto_id,
  obmp_review.postazione_id,
  obmp_review.nome,
  obmp_review.stato,
  obmp_review.user_type,
  (obmp_review.rumore_camere) AS Rumore_camere,
  (obmp_review.spazio_camera) AS Spazio_camera,
  (obmp_review.spazi_comuni) AS Spazi_comuni,
  (obmp_review.dintorni) AS Dintorni,
  (obmp_review.qualita_servizi) AS Qualita_servizi,
  (obmp_review.colazione) AS Colazione,
  (obmp_review.accoglienza) AS Accoglienza,
  (obmp_review.competenza_impiegati) AS Competenza_impiegati,
  (obmp_review.prezzo_qualita) AS Prezzo_qualita,
  (obmp_review.giudizio_totale) AS Giudizio_totale,
  (obmp_review.raccomandi) AS Raccomandi,
  obmp_review.commento_tex,
  obmp_review.ip_review,
  obmp_review.data_review,
  obmp_review.review_data_record,
  camere.numero_camera,
  `agenzie`.agenzia_nome,
  conti.preno_agenzia,
  `clienti`.clienti_nome,
  `clienti`.clienti_cogno,
  `clienti`.cliente_nazione,
  `nazioni`.Nazioni_Descrizione
FROM
  obmp_review
  INNER JOIN camere ON (obmp_review.camera_numero = camere.camera_id)
  INNER JOIN conti ON (obmp_review.conto_id = conti.conto_id)
  LEFT OUTER JOIN `agenzie` ON (conti.preno_agenzia = `agenzie`.agenzia_id)
  INNER JOIN `refer_clienti` ON (obmp_review.conto_id = `refer_clienti`.conto_id)
  INNER JOIN `clienti` ON (`refer_clienti`.clienti_id = `clienti`.clienti_id)
  LEFT OUTER JOIN nazioni ON (clienti.cliente_nazione = nazioni.Nazioni_Id_Codice)
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
			  AVG(obmp_review.pulizia_camera) AS Clean,
			  AVG((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
			  AVG(obmp_review.dintorni) AS Location,
			  AVG((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
			  AVG((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
			  AVG(obmp_review.prezzo_qualita) AS Value_for_money,
			  AVG(obmp_review.giudizio_totale) AS Total_score,
			  obmp_review.review_id,
			  obmp_review.hotel_id,
			  obmp_review.preno_id,
			  obmp_review.conto_id,
			  obmp_review.postazione_id,
			  obmp_review.nome,
			  obmp_review.stato,
			  obmp_review.user_type,
			  
			  AVG(obmp_review.rumore_camere) AS Rumore_camere,
			  AVG(obmp_review.spazio_camera) AS Spazio_camera,
			  AVG(obmp_review.spazi_comuni) AS Spazi_comuni,
			  AVG(obmp_review.dintorni) AS Dintorni,
			  AVG(obmp_review.qualita_servizi) AS Qualita_servizi,
			  AVG(obmp_review.colazione) AS Colazione,
			  AVG(obmp_review.accoglienza) AS Accoglienza,
			  AVG(obmp_review.competenza_impiegati) AS Competenza_impiegati,
			  AVG(obmp_review.prezzo_qualita) AS Prezzo_qualita,
			  AVG(obmp_review.giudizio_totale) AS Giudizio_totale,
			  AVG(obmp_review.raccomandi) AS Raccomandi,
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
                ((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
                (obmp_review.dintorni) AS Location,
                ((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
                ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
                (obmp_review.prezzo_qualita) AS Value_for_money,
                (obmp_review.giudizio_totale) AS Total_score,
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