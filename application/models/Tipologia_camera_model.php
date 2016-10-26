<?php
// Tipologia_camera_model.php
class Tipologia_camera_model extends CI_Model {

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
                return $this->db->get( 'tipologia_camera' )->result() ;
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
                FROM tipologia_camera
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
                return $this->db->count_all('tipologia_camera');
            }

	/** 
       * function find_by_id($tipologia_id)
       * find tipologia_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($tipologia_id)
            {	
                return $this->db->get_where( 'tipologia_camera' , array('tipologia_id' => $tipologia_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to tipologia_camera data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('tipologia_camera');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($tipologia_id, $data)
       * insert update tipologia_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($tipologia_id, $data)
            {
                $this->db->where('tipologia_id', $tipologia_id);
                $this->db->set($data);
                $this->db->update('tipologia_camera');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($tipologia_id)
       * delete form tipologia_camera data
       * @param 
       * @return 
       */

	public function delete($tipologia_id)
            {
                $this->db->where('tipologia_id', $tipologia_id);
                $this->db->delete('tipologia_camera');
                return $this->db->affected_rows();
            }
            
            
            
            
               function get_tiplogia_hotel($hotel_id) {
        
        $now = date('Y-m-d');
        $query = $this->db->query("
        SELECT *
        FROM
	usr_web1_3.tipologia_camera
        WHERE
	usr_web1_3.obmp_cm_rooms.hotel_id = $hotel_id
        ");
        return $query->result();
    }

            
	
}





?>