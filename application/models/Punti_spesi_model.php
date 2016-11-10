<?php
// Punti_spesi_model.php
class Punti_spesi_model extends CI_Model {

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
                return $this->db->get( 'punti_spesi' )->result() ;
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
                FROM punti_spesi
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
                return $this->db->count_all('punti_spesi');
            }

	/** 
       * function find_by_id($punti_spesi_id)
       * find punti_spesi_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($punti_spesi_id)
            {	
                return $this->db->get_where( 'punti_spesi' , array('punti_spesi_id' => $punti_spesi_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to punti_spesi data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('punti_spesi');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($punti_spesi_id, $data)
       * insert update punti_spesi_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($punti_spesi_id, $data)
            {
                $this->db->where('punti_spesi_id', $punti_spesi_id);
                $this->db->set($data);
                $this->db->update('punti_spesi');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($punti_spesi_id)
       * delete form punti_spesi data
       * @param 
       * @return 
       */

	public function delete($punti_spesi_id)
            {
                $this->db->where('punti_spesi_id', $punti_spesi_id);
                $this->db->delete('punti_spesi');
                return $this->db->affected_rows();
            }
	
}
?>