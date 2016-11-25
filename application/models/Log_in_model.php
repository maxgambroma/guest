<?php
// Log_in_model.php
class Log_in_model extends CI_Model {

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
                return $this->db->get( 'log_in' )->result() ;
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
                FROM log_in
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
                return $this->db->count_all('log_in');
            }

	/** 
       * function find_by_id($log_in_id)
       * find log_in_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($log_in_id)
            {	
                return $this->db->get_where( 'log_in' , array('log_in_id' => $log_in_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to log_in data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('log_in');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($log_in_id, $data)
       * insert update log_in_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($log_in_id, $data)
            {
                $this->db->where('log_in_id', $log_in_id);
                $this->db->set($data);
                $this->db->update('log_in');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($log_in_id)
       * delete form log_in data
       * @param 
       * @return 
       */

	public function delete($log_in_id)
            {
                $this->db->where('log_in_id', $log_in_id);
                $this->db->delete('log_in');
                return $this->db->affected_rows();
            }
	
}
?>