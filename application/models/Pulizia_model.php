<?php

class Pulizia_model extends CI_Model {

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

	function SaveForm($form_data)
	{
		$this->db->insert('pulizia', $form_data);
		
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		
		return FALSE;
	}
        
        
           public function pulizia_conto($hotel_id, $conto_id, $camera_id ) {

        $sql = "
                SELECT *
                FROM
                `pulizia`
                WHERE
                (`pulizia`.hotel_id = '$hotel_id') AND
                (`pulizia`.conto_id = '$conto_id') AND
                (`pulizia`.camera_id = '$camera_id')
                ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
        
		
		 public function pulizia_riep_giorno($hotel_id, $today ) {
        $sql = "
            SELECT 
              tipologia_camera.tipologia_id,
              tipologia_camera.nome_tipologia,
              tipologia_camera.nome_tipologia_en,
              foglio_giorno.foglio_id,
              foglio_giorno.hotel_id,
              foglio_giorno.conto_id,
              foglio_giorno.preno_id,
              foglio_giorno.tipologia_id,
              foglio_giorno.in_conto,
              foglio_giorno.out_preno,
              foglio_giorno.stato_camera,
              foglio_giorno.preno_agenzia,
              camere.camera_id,
              camere.numero_camera,
              camere.camere_piano,
              camere.tipologia_id AS tipologia_camera,
              conti.in_conto_time,
              conti.out_conto,
              conti.conti_stato_camere,
              foglio_giorno.foglio_utente_id,
              foglio_giorno.foglio_data_record,
              conti.nome_cliente,
              conti.cognome_cliente,
              pulizia.utente_id,
              pulizia.pulizia_data_record,
              pulizia.pulizia_note,
              pulizia.pulizia_data,
              pulizia.cambio_biancheria,
              pulizia.camera_id
            FROM
              foglio_giorno
              INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
              INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
              INNER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)
              INNER JOIN pulizia ON (conti.conto_id = pulizia.conto_id)
            WHERE
              (conti.hotel_id = '$hotel_id') AND 
              (pulizia.pulizia_data = '$today')
            ORDER BY
              camere.numero_camera
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
        
    
	    public function pulizia_controllo( $hotel_id ) {

        $sql = "
		  SELECT 
		  tipologia_camera.tipologia_id,
		  tipologia_camera.nome_tipologia,
		  tipologia_camera.nome_tipologia_en,
		  foglio_giorno.foglio_id,
		  foglio_giorno.hotel_id,
		  foglio_giorno.conto_id,
		  foglio_giorno.preno_id,
		  foglio_giorno.tipologia_id,
		  foglio_giorno.in_conto,
		  foglio_giorno.out_preno,
		  foglio_giorno.stato_camera,
		  foglio_giorno.preno_agenzia,
		  camere.camera_id,
		  camere.numero_camera,
		  camere.camere_piano,
		  camere.tipologia_id AS tipologia_camera,
		  conti.in_conto_time,
		  conti.out_conto,
		  conti.conti_stato_camere,
		  foglio_giorno.foglio_utente_id,
		  foglio_giorno.foglio_data_record,
		  conti.nome_cliente,
		  conti.cognome_cliente,
		  conti.in_conto,
		  pulizia.pulizia_data,
		  pulizia.pulizia_note,
		  pulizia.utente_id,
		  pulizia.pulizia_data_record
		FROM
		  foglio_giorno
		  INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
		  INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
		  INNER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)
		  LEFT OUTER JOIN pulizia ON (conti.conto_id = pulizia.conto_id)
		WHERE
		   (conti.in_conto >= '2016-04-10') AND 
		  (conti.hotel_id = '$hotel_id') AND 
		  (pulizia.pulizia_id IS NULL)
                ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
	

	
	public function pulizia_note($hotel_id) {

        $sql = "
SELECT *
FROM
  pulizia
  INNER JOIN camere ON (pulizia.camera_id = camere.camera_id)
WHERE
  (pulizia.hotel_id = '$hotel_id') AND 
  (CHARACTER_LENGTH(pulizia.pulizia_note) > 3)
		ORDER BY
		  pulizia.pulizia_id DESC
	       ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
	
	
	
public $table = 'pulizia' ;

public function find()
{
return $this->db->get($this->table)->result();
}

public function find_by_id($id)
{
return $this->db->where('pulizia_id', $id)->limit(1)->get($this->table)->row();
}

public function insert($data)
{
$this->db->set($data);
$this->db->insert($this->table);
return $this->db->insert_id();
}

public function update($id, $data)
{
$this->db->where('pulizia_id', $id);
$this->db->set($data);
$this->db->update($this->table);
return $this->db->affected_rows();
}

public function delete($id)
{
$this->db->where('pulizia_id', $id);
$this->db->delete($this->table);
return $this->db->affected_rows();
}
    
        
}
?>