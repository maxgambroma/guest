<?php
// Tex_lingue_model.php
class Tex_lingue_model extends CI_Model {

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
                return $this->db->get( 'tex_lingue' )->result() ;
                
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
                FROM tex_lingue
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
                return $this->db->count_all('tex_lingue');
            }

	/** 
       * function find_by_id($tex_lingue_id)
       * find tex_lingue_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($tex_lingue_id)
            {	
                return $this->db->get_where( 'tex_lingue' , array('tex_lingue_id' => $tex_lingue_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to tex_lingue data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('tex_lingue');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($tex_lingue_id, $data)
       * insert update tex_lingue_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($tex_lingue_id, $data)
            {
                $this->db->where('tex_lingue_id', $tex_lingue_id);
                $this->db->set($data);
                $this->db->update('tex_lingue');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($tex_lingue_id)
       * delete form tex_lingue data
       * @param 
       * @return 
       */

	public function delete($tex_lingue_id)
            {
                $this->db->where('tex_lingue_id', $tex_lingue_id);
                $this->db->delete('tex_lingue');
                return $this->db->affected_rows();
            }
            
            
/**
     * prendo le traduzioni del db
     * @param type $lg
     * @return type array
     */
    public function tex_lg($lg='en') {
        $dati = $this->find();
        foreach ($dati as $key => $value) {
            $data_lg[$value->etichetta_lg] = $value->{$lg};
        }
        return $data_lg;
    }

}
?>

