<?php
// Obmp_ref_event_model.php
class Obmp_ref_event_model extends CI_Model {

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
                return $this->db->get( 'obmp_ref_event' )->result() ;
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
                FROM obmp_ref_event
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
                return $this->db->count_all('obmp_ref_event');
            }

	/** 
       * function find_by_id($ref_event_id)
       * find ref_event_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($ref_event_id)
            {	
                return $this->db->get_where( 'obmp_ref_event' , array('ref_event_id' => $ref_event_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to obmp_ref_event data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('obmp_ref_event');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($ref_event_id, $data)
       * insert update ref_event_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($ref_event_id, $data)
            {
                $this->db->where('ref_event_id', $ref_event_id);
                $this->db->set($data);
                $this->db->update('obmp_ref_event');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($ref_event_id)
       * delete form obmp_ref_event data
       * @param 
       * @return 
       */

	public function delete($ref_event_id)
            {
                $this->db->where('ref_event_id', $ref_event_id);
                $this->db->delete('obmp_ref_event');
                return $this->db->affected_rows();
            }

            
            
            
            function controlla_evento($hotel_id, $ref_event) {
                
                $sql= "SELECT * FROM obmp_ref_event WHERE obmp_ref_event.hotel_id='$hotel_id' AND obmp_ref_event.ref_event_id='$ref_event'";
                
$query = $this->db->query($sql);
$return = $query->row();
return $return;
                
                
                
                
            }
            
            
            
            
            
            
}
?>