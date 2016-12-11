<?php
// Ref_obmp_booking_model.php
class Ref_obmp_booking_model extends CI_Model {

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
                return $this->db->get( 'ref_obmp_booking' )->result() ;
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
                FROM ref_obmp_booking
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
                return $this->db->count_all('ref_obmp_booking');
            }

	/** 
       * function find_by_id($ref_obm_data)
       * find ref_obm_data
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($ref_obm_data)
            {	
                return $this->db->get_where( 'ref_obmp_booking' , array('ref_obm_data' => $ref_obm_data ))->row();
            }

        /** 
       * function insert($data)
       * insert to ref_obmp_booking data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('ref_obmp_booking');
                //return $this->db->insert_id();
                return $this->db->affected_rows();
            }
		
        /** 
       * function update($ref_obm_data, $data)
       * insert update ref_obm_dataform data
       * @param $form_data 
       * @return id
       */
		
	public function update($ref_obm_data, $data)
            {
                $this->db->where('ref_obm_data', $ref_obm_data);
                $this->db->set($data);
                $this->db->update('ref_obmp_booking');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($ref_obm_data)
       * delete form ref_obmp_booking data
       * @param 
       * @return 
       */

	public function delete($ref_obm_data)
            {
                $this->db->where('ref_obm_data', $ref_obm_data);
                $this->db->delete('ref_obmp_booking');
                return $this->db->affected_rows();
            }

            
       /**
        * 
        */     
function rs_cliento_obmp_email($email)
{
$query = $this->db->query("
SELECT * FROM obmp_clienti WHERE obmp_clienti.obm_cliente_email = '$email'
");
$num = $query->row();
}

            
            
}
?>