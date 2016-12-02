<?php
// Log_obmp_full_model.php
class Log_obmp_full_model extends CI_Model {

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
                return $this->db->get( 'log_obmp_full' )->result() ;
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
                FROM log_obmp_full
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
                return $this->db->count_all('log_obmp_full');
            }

	/** 
       * function find_by_id($)
       * find 
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($log_obmp_id_full)
            {	
                return $this->db->get_where( 'log_obmp_full' , array('log_obmp_id_full' => $log_obmp_id_full ))->row();
            }

        /** 
       * function insert($data)
       * insert to log_obmp_full data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('log_obmp_full');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($, $data)
       * insert update form data
       * @param $form_data 
       * @return id
       */
		
	public function update($log_obmp_id_full, $data)
            {
                $this->db->where('log_obmp_id_full', $log_obmp_id_full);
                $this->db->set($data);
                $this->db->update('log_obmp_full');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($)
       * delete form log_obmp_full data
       * @param 
       * @return 
       */

	public function delete($log_obmp_id_full)
            {
                $this->db->where('log_obmp_id_full', $log_obmp_id_full);
                $this->db->delete('log_obmp_full');
                return $this->db->affected_rows();
            }
	
}
?>