<?php

class Adebbiti_model extends CI_Model {

    function __construct() {
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
    function SaveForm($form_data) {
        $this->db->insert('adebiti', $form_data);
        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * elenca gli adebbiti su un determinato conto 
     * @param type $conto_id
     * @param type $hotel_id
     * @return type
     */
    public function adebbiti_conto($conto_id, $hotel_id) {
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

    /**
     * elenca i punti utulizzati da un cliente 
     * @param type $conto_id
     * @param type $prodotto_id
     * @return type
     */
    public function punti_utilizzari($conto_id, $prodotto_id = 222) {
        $sql = "
            SELECT
            `conti`.`conto_id`,
            `conti`.`hotel_id`,
            `conti`.`foglio_id`,
            `conti`.`in_conto`,
            `conti`.`in_conto_time`,
            `conti`.`out_preno`,
            `conti`.`out_conto`,
            `conti`.`preno_id`,
            `conti`.`camera_id`,
            `conti`.`numero_camera`,
            `conti`.`trattamento_sog`,
            `conti`.`tipo_camera`,
            `conti`.`tipologia_id`,
            `conti`.`prezzo`,
            `conti`.`nome_cliente`,
            `conti`.`cognome_cliente`,
            `conti`.`preno_agenzia`,
            `conti`.`mercato`,
            `conti`.`conti_stato_camere`,
            `adebiti`.`adebito_id`,
            `adebiti`.`prodotto_id`,
            `adebiti`.`descrizione`,
            `adebiti`.`prezzo`,
            `adebiti`.`quantita`,
            `refer_clienti`.`clienti_id`,
            `refer_clienti`.`hotel_id`,
            `refer_clienti`.`ps_valore`,
            `refer_clienti`.`ref_clinti_data_record`,
            `refer_clienti`.`refer_clienti_utente_id`
            FROM
            `conti`
            INNER JOIN .`adebiti`
            ON `conti`.`conto_id` = .`adebiti`.`conto_id`
            INNER JOIN .`refer_clienti`
            ON `conti`.`conto_id` = .`refer_clienti`.`conto_id`
            WHERE
            `refer_clienti`.`clienti_id` = $clienti_id
            AND `adebiti`.`prodotto_id` = '$prodotto_id'
            ";
        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * trova i punti utilizzati
     * @param type $conto_id
     * @param type $prodotto_id
     * @return type
     */
    public function somma_punti_utilizzari($conto_id, $prodotto_id = 222) {
        $sql = "
            SELECT
            sum(`adebiti`.`prezzo`) AS Punti_importo,
            sum(`adebiti`.`quantita`) AS Punti_utilizzati,
            `refer_clienti`.`conto_id`
            FROM
            `conti`
            INNER JOIN .`adebiti`
            ON `conti`.`conto_id` = .`adebiti`.`conto_id`
            INNER JOIN .`refer_clienti`
            ON `conti`.`conto_id` = .`refer_clienti`.`conto_id`
            WHERE
            `refer_clienti`.`clienti_id` = '$clienti_id'
            AND `adebiti`.`prodotto_id` = '$prodotto_id'
            GROUP BY
            `refer_clienti`.`clienti_id`
            ";
        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    public $table = 'adebiti';

    public function find() {
        return $this->db->get($this->table)->result();
    }

    public function find_by_id($id) {
        return $this->db->where('adebiti_id', $id)->limit(1)->get($this->table)->row();
    }

    public function insert($data) {
        $this->db->set($data);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where('adebiti_id', $id);
        $this->db->set($data);
        $this->db->update($this->table);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('adebiti_id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

}

?>