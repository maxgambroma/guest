<?php

class Guasti_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

// --------------------------------------------------------------------

    /**
     *
     * insert form data
     * @param $form_data - array
     * @return Bool - TRUE or FALSE
     */
    function SaveForm($form_data) {
        $this->db->insert('guasti', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 
     * @param type $hotel_id
     * @param type $camera_id
     * @param type $guasto_stato
     * @return type
     */
    public function guasti_camara($hotel_id, $camera_id, $guasto_stato = 1) {

        $sql = "
            SELECT *
            FROM
            camere
            INNER JOIN guasti ON (`camere`.camera_id = `guasti`.camera_id)
            WHERE
            (`guasti`.camera_id = '$camera_id') AND
            (guasti.guasto_stato = '$guasto_stato')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * 
     * @param type $hotel_id
     * @param type $today
     * @return type
     */
    public function guasti_giorno($hotel_id, $today) {

        $sql = "
            SELECT 	*
            FROM
            camere
            INNER JOIN guasti ON (camere.camera_id = guasti.camera_id)
            WHERE
            (camere.hotel_id = $hotel_id) AND 
            (guasti.guasto_data = $today )
            ORDER BY
            camere.numero_camera
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

// $guasto_stato = 1 Aperto ; 2 chiuso

    /**
     * 
     * @param type $hotel_id
     * @param type $guasto_stato
     * @return type
     */
    public function guasti_stato($hotel_id, $guasto_stato = 1) {

        $sql = "
            SELECT *
            FROM
            camere
            INNER JOIN guasti ON (camere.camera_id = guasti.camera_id)
            WHERE
            (camere.hotel_id = '$hotel_id') AND
            (guasti.guasto_stato = '$guasto_stato')
            ORDER BY
            camere.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

// $guasto_stato = 1 Aperto ; 2 chiuso

    /**
     * 
     * @param type $hotel_id
     * @param type $guasto_stato
     * @return type
     */
    public function guasti_area($hotel_id, $guasto_stato = 1) {

        $sql = "
            SELECT *
            FROM
            guasti
            WHERE
            (guasti.hotel_id = '$hotel_id') AND
            (guasti.camera_id = 0) AND 
            (guasti.guasto_stato = '$guasto_stato')
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    
    
        public function lista_30($hotel_id) {

        $sql = "          
SELECT 
  guasti.guasto_id,
  guasti.hotel_id,
  camere.camera_id,
  guasti.guasto_priorita,
  guasti.guasto_area,
  guasti.guasto_piano,
  guasti.guasto_note,
  guasti.guasto_stato,
  guasti.guasto_utente_id,
  guasti.guasto_data,
  guasti.guasto_data_record,
  camere.numero_camera,
  camere.tipologia_camera,
  camere.tipologia_id,
  camere.camere_max_pax,
  camere.camere_metri_quadri,
  camere.camere_vista,
  camere.camere_piano,
  camere.camere_bagno,
  camere.camere_edificio
FROM
  guasti
  LEFT OUTER JOIN camere ON (guasti.camera_id = camere.camera_id)
WHERE
  (guasti.hotel_id = '$hotel_id')
            ORDER BY guasti.guasto_id DESC 
            LIMIT 50
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

	
	
	       public function lista_stato($hotel_id, $guasto_stato = 1) {

        $sql = "          
SELECT 
  guasti.guasto_id,
  guasti.hotel_id,
  camere.camera_id,
  guasti.guasto_priorita,
  guasti.guasto_area,
  guasti.guasto_piano,
  guasti.guasto_note,
  guasti.guasto_stato,
  guasti.guasto_utente_id,
  guasti.guasto_data,
  guasti.guasto_data_record,
  camere.numero_camera,
  camere.tipologia_camera,
  camere.tipologia_id,
  camere.camere_max_pax,
  camere.camere_metri_quadri,
  camere.camere_vista,
  camere.camere_piano,
  camere.camere_bagno,
  camere.camere_edificio
FROM
  guasti
  LEFT OUTER JOIN camere ON (guasti.camera_id = camere.camera_id)
WHERE
  (guasti.hotel_id = '$hotel_id') AND
  (guasti.guasto_stato = '$guasto_stato')
            ORDER BY guasti.guasto_id DESC 
      
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

	
    
    
// ------------------------------------
    
    
    public $table = 'guasti';

    public function find() {
        return $this->db->get($this->table)->result();
    }

    public function find_by_id($id) {
        return $this->db->where('guasto_id', $id)->limit(1)->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->set($data);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('guasto_id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('guasto_id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }
    
    
// ------------------------------------

}

?>