<?php
// Log_obmp_model.php
class Log_obmp_model extends CI_Model {

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
                return $this->db->get( 'log_obmp' )->result() ;
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
                FROM log_obmp
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
                return $this->db->count_all('log_obmp');
            }

	/** 
       * function find_by_id($log_obmp_id)
       * find log_obmp_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($log_obmp_id)
            {	
                return $this->db->get_where( 'log_obmp' , array('log_obmp_id' => $log_obmp_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to log_obmp data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('log_obmp');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($log_obmp_id, $data)
       * insert update log_obmp_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($log_obmp_id, $data)
            {
                $this->db->where('log_obmp_id', $log_obmp_id);
                $this->db->set($data);
                $this->db->update('log_obmp');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($log_obmp_id)
       * delete form log_obmp data
       * @param 
       * @return 
       */

	public function delete($log_obmp_id)
            {
                $this->db->where('log_obmp_id', $log_obmp_id);
                $this->db->delete('log_obmp');
                return $this->db->affected_rows();
            }
            
            
            
            function max_obmp_id() {
                
                
                $sql = "SELECT MAX(log_obmp.log_obmp_id) AS max_cookie FROM log_obmp";
         $query = $this->db->query($sql);
        $return = $query->row();
        return $return;
                
                
            }
            
            
            
            
            
	
}
?>