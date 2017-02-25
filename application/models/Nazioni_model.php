<?php
// Nazioni_model.php
class Nazioni_model extends CI_Model {

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
                return $this->db->get( 'nazioni' )->result() ;
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
                FROM nazioni
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
                return $this->db->count_all('nazioni');
            }

	/** 
       * function find_by_id($)
       * find 
       * @param $form_data - array
       * @return object
       */

//	public function find_by_id($)
//            {	
//                return $this->db->get_where( 'nazioni' , array('' => $ ))->row();
//            }

        /** 
       * function insert($data)
       * insert to nazioni data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('nazioni');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($, $data)
       * insert update form data
       * @param $form_data 
       * @return id
       */
		
//	public function update($, $data)
//            {
//                $this->db->where('', $);
//                $this->db->set($data);
//                $this->db->update('nazioni');
//                return $this->db->affected_rows();
//            }

		/** 
       * function delete($)
       * delete form nazioni data
       * @param 
       * @return 
       */

//	public function delete($)
//            {
//                $this->db->where('', $);
//                $this->db->delete('nazioni');
//                return $this->db->affected_rows();
//            }
	
}
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

