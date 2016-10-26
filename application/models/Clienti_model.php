<?php

// Clienti_model.php
class Clienti_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

// --------------------------------------------------------------------

    /**
     * function find()
     * find form data
     * @param $form_data - array
     * @return object
     */
    public function find() {
        return $this->db->get('clienti')->result();
    }

    /**
     * function find_limit($offset,$limit)
     * find form data
     * @param $form_data - array
     * @return Array
     */
    public function find_limit($limit = 100, $offset = 0) {
        $query = $this->db->query("
SELECT *
FROM clienti
LIMIT $offset , $limit ");
        return $query->result();
    }

    /**
     * function count all record 
     * 
     * @param $form_data - array
     * @return object
     */
    public function record_count() {
        return $this->db->count_all('clienti');
    }

    /**
     * function find_by_id($clienti_id)
     * find clienti_id
     * @param $form_data - array
     * @return object
     */
    public function find_by_id($clienti_id) {
        return $this->db->get_where('clienti', array('clienti_id' => $clienti_id))->row();
    }

    /**
     * function insert($data)
     * insert to clienti data
     * @param $form_data - array
     * @return object
     */
    public function insert($data) {
        $this->db->set($data);
        $this->db->insert('clienti');
        return $this->db->insert_id();
    }

    /**
     * function update($clienti_id, $data)
     * insert update clienti_idform data
     * @param $form_data 
     * @return id
     */
    public function update($clienti_id, $data) {
        $this->db->where('clienti_id', $clienti_id);
        $this->db->set($data);
        $this->db->update('clienti');
        return $this->db->affected_rows();
    }

    /**
     * function delete($clienti_id)
     * delete form clienti data
     * @param 
     * @return 
     */
    public function delete($clienti_id) {
        $this->db->where('clienti_id', $clienti_id);
        $this->db->delete('clienti');
        return $this->db->affected_rows();
    }

    /**
     * elenco delle camare che devono firmare la privacy
     * @param type $today
     * @param type $hotel_id
     * @return type
     */
    
    public function get_privacy($today, $hotel_id) {
        $query = $this->db->query("
        SELECT
        conti.conto_id,  
        conti.conti_stato_camere,
        conti.in_conto,
        conti.in_conto_time,
        conti.out_conto,
        conti.out_preno,
        clienti.privacy,
        clienti.marketing,
        cliente_nazione,
        conti.hotel_id,
        clienti.clienti_nome,
        clienti.clienti_cogno,
        clienti.cliente_sesso,
        clienti.clienti_id,
        conti.numero_camera
        FROM
        refer_clienti
        INNER JOIN clienti
        ON refer_clienti.clienti_id = clienti.clienti_id
        INNER JOIN conti
        ON refer_clienti.conto_id = conti.conto_id
        WHERE
        conti.in_conto <= '$today'
        AND conti.out_preno > '$today'

        AND conti.hotel_id = $hotel_id
        ");
        return $query->result();
    }
    
    
    /**
     * riconosce il cliente per il conto_id e il clienti_id
     * serve per auteneticare 
     * @param type $conto_id
     * @param type $clienti_id
     * @return type
     */

    public function get_conto_cliente($conto_id, $clienti_id) {
        $query = $this->db->query("
        SELECT
        clienti.clienti_id,
        conti.conto_id,
        clienti.hotel_id,
        clienti.clienti_nome,
        clienti.clienti_cogno,
        clienti.cliente_nato_a,
        clienti.cliente_nato_il,
        clienti.cliente_nazione,
        clienti.cliente_provincia,
        clienti.cliente_residenza,
        clienti.cliente_cocumento_tipo,
        clienti.cliente_cocumento_numero,
        clienti.cliente_cocumento_rilasciato_il,
        clienti.cliente_sesso,
        clienti.clienti_email,
        clienti.password,
clienti.clienti_tel,
clienti.clienti_fax,
clienti.clienti_note,
        clienti.privacy,
        clienti.marketing,
        clienti.clienti_data_record,
        clienti.clienti_note,
        conti.foglio_id,
        conti.in_conto,
        conti.in_conto_time,
        conti.out_preno,
        conti.out_conto,
        conti.preno_id,
        conti.camera_id,
        conti.numero_camera,
        conti.trattamento_sog,
        conti.tipo_camera,
        conti.tipologia_id,
        conti.prezzo,
        conti.preno_agenzia,
        conti.mercato,
        conti.conti_stato_camere,
        conti.conti_utente_id,
        agenzie.agenzia_nome,
	agenzie.agenzia_tipologia,
	agenzie.agenzia_id
        FROM
        refer_clienti
        INNER JOIN conti
        ON refer_clienti.conto_id = conti.conto_id
        INNER JOIN clienti
        ON refer_clienti.clienti_id = clienti.clienti_id
        LEFT OUTER JOIN agenzie
	 ON conti.preno_agenzia = agenzie.agenzia_id
        WHERE
        refer_clienti.conto_id = $conto_id
        AND refer_clienti.clienti_id = $clienti_id
        ");
        return $query->result();
    }

    
    /**
     * tutte i conti passati e le prenotazioni dello stesso cliente 
     * @param type $clienti_id
     * @param type $email
     * @return type
     */
    
    function conti_by_clienti($clienti_id ) {
        $query = $this->db->query("
        SELECT
        conti.conto_id,
        conti.hotel_id,
        conti.foglio_id,
        conti.in_conto,
        conti.out_preno,
        conti.out_conto,
        conti.in_conto_time,
        conti.preno_id,
        conti.camera_id,
        conti.numero_camera,
        conti.trattamento_sog,
        conti.tipo_camera,
        conti.tipologia_id,
        conti.prezzo,
        conti.mercato,
        conti.preno_agenzia,
        conti.conti_stato_camere,
        clienti.clienti_id,
        clienti.clienti_nome,
        clienti.clienti_cogno,
        clienti.cliente_nato_a,
        clienti.cliente_nato_il,
        clienti.cliente_nazione,
        clienti.cliente_provincia,
        clienti.cliente_residenza,
        clienti.cliente_cocumento_tipo,
        clienti.cliente_cocumento_numero,
        clienti.cliente_cocumento_rilasciato_il,
        clienti.cliente_sesso,
        clienti.clienti_tel,
        clienti.clienti_fax,
        clienti.clienti_email,
        clienti.clienti_note,
        clienti.privacy,
        clienti.marketing,
        clienti.clienti_data_record,
        clienti.clienti_utente_id,
        agenda.preno_id,
        agenda.preno_in_data,
        agenda.preno_importo,
        agenda.preno_dal,
        agenda.preno_al,
        agenda.preno_n_notti,
        agenda.preno_trattamento,
        agenda.preno_nome,
        agenda.preno_cogno,
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
        agenda.voucher_id,
        agenda.preno_tel,
        agenda.preno_email,
        agenda.preno_mercato,
        agenda.preno_stato, 
        hotels.nome_hotel,
	hotels.hotel_tipologia,
	hotels.hotel_citta,
	hotels.hotel_tel,
	hotels.hotel_email,
	hotels.hotel_web,
	hotels.hotel_logo,
	hotels.hotel_mappa,
	hotels.hotel_foto_piccola,
	hotels.hotel_foto_grande,
	hotels.hotel_booking_url,
	hotels.facebook,
	hotels.google,
	hotels.instagram,
	hotels.twitter,
	hotels.linkedin,
	hotels.analytics, 
        hotels.nome_hotel,
	hotels.hotel_tipologia,
        obmp_review.review_id,
	obmp_review.giudizio_totale,
        agenzie.agenzia_nome,
	agenzie.agenzia_tipologia,
	agenzie.agenzia_id
        FROM
        refer_clienti
        
        LEFT OUTER JOIN obmp_review
	 ON  refer_clienti.conto_id = obmp_review.conto_id     
        INNER JOIN conti
        ON refer_clienti.conto_id = conti.conto_id
        INNER JOIN clienti
        ON refer_clienti.clienti_id = clienti.clienti_id
        LEFT OUTER JOIN agenda
        ON conti.preno_id = agenda.preno_id
        INNER JOIN hotels
	 ON conti.hotel_id = hotels.hotel_id
          LEFT OUTER JOIN agenzie
	 ON conti.preno_agenzia = agenzie.agenzia_id
         WHERE
        (refer_clienti.clienti_id = $clienti_id)
     ORDER BY
     conti.in_conto DESC
        ");
        return $query->result();
    }

 
    
    
    /**
     * un punto ogni 10 euro spesi  
     * @param type $clienti_id
     * @return type
     */
     
    function clienti_punti($clienti_id ) {
        $query = $this->db->query("
            SELECT
            sum( conti.prezzo * ( to_days( conti.out_conto ) - to_days( conti.in_conto ) ) ) AS importo
            FROM
            conti 
            INNER JOIN ref_obmp_booking 
            ON conti.preno_id = ref_obmp_booking.preno_id
            INNER JOIN refer_clienti 
            ON conti.conto_id = refer_clienti.conto_id
            WHERE
            refer_clienti.clienti_id = '$clienti_id'
            GROUP BY
            refer_clienti.conto_id
            ");
        
        $num = $query->result();
// un punto ogni 10 euro spesi      
        
     

     
        
        if ( isset($num[0]->importo) ) {
               $numero =  $num[0]->importo;
            return $punti = round(($numero / 10), 0);
        } else {
            return $punti = 0;
        }
    }

 
    
    
    
    
    
    
 
    
    
    
}

?>