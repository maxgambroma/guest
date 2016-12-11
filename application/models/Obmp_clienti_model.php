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




/**
 * restituisco la prentoazione ombp fatta
 * @param type $preno_id
 * @param type $obm_cliente_id
 * @return type
 */


function get_preno_obmp($preno_id,$obm_cliente_id) {

$sql = "

SELECT
	ref_obmp_booking.ref_obm_data,
	ref_obmp_booking.hotel_id,
	ref_obmp_booking.ref_site,
	ref_obmp_booking.ref_agency,
	ref_obmp_booking.ref_event,
	ref_obmp_booking.ref_session,
	ref_obmp_booking.ref_cookie,
	agenda.preno_id,
	agenda.hotel_id,
	agenda.preno_in_data,
	agenda.preno_importo,
	agenda.preno_impoto_mod,
	agenda.preno_dal,
	agenda.preno_al,
	agenda.preno_n_notti,
	agenda.preno_arr_ore,
	agenda.preno_trattamento,
	agenda.t1,
	agenda.q1,
	agenda.p1,
	agenda.t2,
	agenda.q2,
	agenda.p2,
	agenda.t3,
	agenda.q3,
	agenda.p3,
	agenda.t4,
	agenda.q4,
	agenda.p4,
	agenda.t5,
	agenda.q5,
	agenda.p5,
	agenda.t6,
	agenda.q6,
	agenda.p6,
	agenda.preno_nome,
	agenda.preno_cogno,
	agenda.preno_agenzia,
	agenda.voucher_id,
	agenda.allotment_id,
	agenda.preno_cc_tip,
	agenda.preno_cc_n,
	agenda.preno_cc_scad,
	agenda.preno_tel,
	agenda.preno_fax,
	agenda.preno_email,
	agenda.preno_mercato,
	agenda.preno_note,
	agenda.preno_doc_fax,
	agenda.preno_doc_email,
	agenda.preno_doc_form,
	agenda.preno_doc_mail,
	agenda.preno_doc_vaglia,
	agenda.preno_doc_woucher,
	agenda.preno_pag_modalita,
	agenda.preno_caparra,
	agenda.preno_stato,
	agenda.data_opzione,
	agenda.cancella_data_record,
	agenda.cancella_user,
	agenda.cancella_pass,
	agenda.preno_data_record,
	agenda.agenda_utente_id,
	obmp_clienti.obm_cliente_first_name,
	obmp_clienti.obm_cliente_last_name,
	obmp_clienti.obm_cliente_email,
	obmp_clienti.obm_cliente_city,
	obmp_clienti.obm_cliente_country,
	obmp_clienti.obm_cliente_phone,
	obmp_clienti.obm_cliente_newsletter,
	obmp_clienti.obm_cliente_pass,
	obmp_clienti.obm_cliente_data_insert,
	obmp_clienti.obm_cliente_data_record,
	obmp_clienti.obm_cliente_cc_type,
	obmp_clienti.obm_cliente_cc_number,
	obmp_clienti.obm_cliente_holder,
	obmp_clienti.obm_cliente_cc_expire,
	obmp_clienti.obm_cliente_cc_security,
	obmp_clienti.obm_cliente_id
FROM
	agenda
	INNER JOIN ref_obmp_booking
	 ON agenda.preno_id = ref_obmp_booking.preno_id
	INNER JOIN obmp_clienti
	 ON ref_obmp_booking.obm_cliente_id = obmp_clienti.obm_cliente_id
WHERE
	ref_obmp_booking.preno_id = '$preno_id'
	AND ref_obmp_booking.obm_cliente_id = '$obm_cliente_id'";  
    

$query = $this->db->query($sql);
$return = $query->row();
return $return;
    
}
















}
?>