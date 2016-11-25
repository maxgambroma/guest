<?php
// Obmp_clienti_model.php
class Obmp_clienti_model extends CI_Model {

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
                return $this->db->get( 'obmp_clienti' )->result() ;
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
                FROM obmp_clienti
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
                return $this->db->count_all('obmp_clienti');
            }

	/** 
       * function find_by_id($obm_cliente_id)
       * find obm_cliente_id
       * @param $form_data - array
       * @return object
       */

	public function find_by_id($obm_cliente_id)
            {	
                return $this->db->get_where( 'obmp_clienti' , array('obm_cliente_id' => $obm_cliente_id ))->row();
            }

        /** 
       * function insert($data)
       * insert to obmp_clienti data
       * @param $form_data - array
       * @return object
       */
		
	public function insert($data)
            {
                $this->db->set($data);
                $this->db->insert('obmp_clienti');
                return $this->db->insert_id();
            }
		
        /** 
       * function update($obm_cliente_id, $data)
       * insert update obm_cliente_idform data
       * @param $form_data 
       * @return id
       */
		
	public function update($obm_cliente_id, $data)
            {
                $this->db->where('obm_cliente_id', $obm_cliente_id);
                $this->db->set($data);
                $this->db->update('obmp_clienti');
                return $this->db->affected_rows();
            }

		/** 
       * function delete($obm_cliente_id)
       * delete form obmp_clienti data
       * @param 
       * @return 
       */

	public function delete($obm_cliente_id)
            {
                $this->db->where('obm_cliente_id', $obm_cliente_id);
                $this->db->delete('obmp_clienti');
                return $this->db->affected_rows();
            }
	
            
  /**
   * aurentica cliente obmp
   * @param type $user
   * @param type $pass
   * @return type row
   */          
function get_autentica($user, $pass)
{
$sql = "SELECT
	*
FROM
	usr_web1_3.obmp_clienti
WHERE
	usr_web1_3.obmp_clienti.obm_cliente_email = '$user'
	AND usr_web1_3.obmp_clienti.obm_cliente_pass = '$pass'";

$query = $this->db->query($sql);
$return = $query->row();
return $return;
}


function get_by_email($user)
{
$sql = "SELECT
	*
FROM
	usr_web1_3.obmp_clienti
WHERE
	usr_web1_3.obmp_clienti.obm_cliente_email = '$user'
	";

$query = $this->db->query($sql);
$return = $query->row();
return $return;
}



}
?>