<?php

class Adebbiti_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	// --------------------------------------------------------------------

      /** 
       * function SaveForm()
       *
       * insert form data
       * @param $form_data - array
       * @return Bool - TRUE or FALSE
       */

	function SaveForm($form_data)
	{
		$this->db->insert('adebiti', $form_data);
		if ($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		return FALSE;
	}

	public function adebbiti_conto($conto_id, $hotel_id)
	{

	$sql = "
			SELECT 
			`adebiti`.adebito_id,
			`adebiti`.conto_id,
			`adebiti`.hotel_id,
			`adebiti`.prodotto_id,
			`adebiti`.prezzo,
			`adebiti`.quantita,
			`prodotti`.nome_prodotto,
			  adebiti.adebiti_data_record,
			`adebiti`.adebiti_utente_id
			FROM
			`adebiti`
			INNER JOIN `prodotti` ON (`adebiti`.prodotto_id = `prodotti`.prodotto_id)
			WHERE
			(`adebiti`.conto_id = '$conto_id') AND
			(`adebiti`.hotel_id = '$hotel_id')
					";
		$query = $this->db->query($sql);
		$return = $query->result();
		return $return;
    }
	

    
    public $table = 'adebiti' ;

public function find()
{
return $this->db->get($this->table)->result();
}

public function find_by_id($id)
{
return $this->db->where('adebiti_id', $id)->limit(1)->get($this->table)->row();
}

public function insert($data)
{
$this->db->set($data);
$this->db->insert($this->table);
return $this->db->insert_id();
}

public function update($id, $data)
{
$this->db->where('adebiti_id', $id);
$this->db->set($data);
$this->db->update($this->table);
return $this->db->affected_rows();
}

public function delete($id)
{
$this->db->where('adebiti_id', $id);
$this->db->delete($this->table);
return $this->db->affected_rows();
}
    
    

}

?>