<?php

// Obmp_review_model.php
class Obmp_review_model extends CI_Model {

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
        return $this->db->get('obmp_review')->result();
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
        FROM obmp_review
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
        return $this->db->count_all('obmp_review');
    }

    /**
     * function find_by_id($review_id)
     * find review_id
     * @param $form_data - array
     * @return object
     */
    public function find_by_id($review_id) {
        return $this->db->get_where('obmp_review', array('review_id' => $review_id))->row();
    }

    /**
     * function insert($data)
     * insert to obmp_review data
     * @param $form_data - array
     * @return object
     */
    public function insert($data) {
        $this->db->set($data);
        $this->db->insert('obmp_review');
        return $this->db->insert_id();
    }

    /**
     * function update($review_id, $data)
     * insert update review_idform data
     * @param $form_data 
     * @return id
     */
    public function update($review_id, $data) {
        $this->db->where('review_id', $review_id);
        $this->db->set($data);
        $this->db->update('obmp_review');
        return $this->db->affected_rows();
    }

    /**
     * function delete($review_id)
     * delete form obmp_review data
     * @param 
     * @return 
     */
    public function delete($review_id) {
        $this->db->where('review_id', $review_id);
        $this->db->delete('obmp_review');
        return $this->db->affected_rows();
    }

    /**
     * Elenca i clienti partiti nella data per tutti gli hotel
     * per inviare lìemail  del review
     * @param type $preno_dal
     * @return type
     */
    public function get_partiti($preno_dal) {
        $query = $this->db->query("
        SELECT    hotels.nome_hotel,  
        hotels.hotel_id, 
        agenda.preno_id,  
        conti.conto_id,   
        conti.hotel_id,   
        conti.foglio_id,   
        conti.in_conto,   
        conti.out_conto,   
        clienti.clienti_nome,   
        clienti.clienti_cogno,   
        clienti.clienti_id,   
        conti.numero_camera,   
        hotels.hotel_tipologia,   
        hotels.hotel_categoria,   
        hotels.hotel_citta,   
        hotels.hotel_email,   
        conti.conti_stato_camere,   
        conti.camera_id,   
        conti.preno_agenzia,   
        agenda.preno_email,   
        clienti.clienti_nome1,   
        clienti.cliente_sesso,   
        clienti.cliente_sesso1,   
        clienti.clienti_cogno1,   
        clienti.cliente_nazione,   
        nazioni.Nazioni_Id_Codice,   
        nazioni.Nazioni_Descrizione 
        FROM   agenda   
        INNER JOIN hotels ON (agenda.hotel_id = hotels.hotel_id)   
        INNER JOIN conti ON (agenda.preno_id = conti.preno_id)   
        INNER JOIN refer_clienti ON (conti.conto_id = refer_clienti.conto_id)   
        INNER JOIN clienti ON (refer_clienti.clienti_id = clienti.clienti_id)   
        INNER JOIN nazioni ON (clienti.cliente_nazione = nazioni.Nazioni_Id_Codice) 
        WHERE (date_format(conti.out_conto, '%Y-%m-%d') = '$preno_dal') 
        AND (conti.conti_stato_camere = '7') 
        AND (
        (conti.preno_agenzia = '279') 
        OR    (conti.preno_agenzia = '23') 
        OR    (conti.preno_agenzia = '596') 
        OR    (agenda.preno_email LIKE '%@%')
        )            
        ");
        return $query->result();
    }

//  //  $clienti_id = $this->input->get('clienti_id');
//    $conto_id = $this->input->get('conto_id');
//    $foglio_id = $this->input->get('foglio_id');
//    $camera_id = $this->input->get('$camera_id');
//    $preno_id = $this->input->get('$preno_id');
// get data da $conto_id e $clienti_id

 
    
    /**
     * restituisce i dati del cliente in base al conto 
     * @param type $conto_id
     * @param type $clienti_id
     * @return type
     */
    
    
    public function get_cliente_rew($conto_id = NULL, $clienti_id = NULL) {
        $sql = "
        SELECT 
        `conti`.conto_id,
        `conti`.hotel_id,
        `conti`.foglio_id,
        `clienti`.clienti_id,
        `conti`.in_conto,
        `conti`.out_preno,
        `conti`.out_conto,
        `conti`.preno_id,
        `conti`.camera_id,
        `conti`.numero_camera,
        `conti`.trattamento_sog,
        `conti`.tipo_camera,
        `conti`.tipologia_id,
        `conti`.prezzo,
        `clienti`.clienti_nome,
        `clienti`.clienti_cogno,
        `clienti`.cliente_nato_a,
        `clienti`.cliente_nato_il,
        `clienti`.cliente_nazione,
        `clienti`.cliente_provincia,
        `clienti`.cliente_residenza,
        `clienti`.cliente_sesso,
        `clienti`.clienti_nome1,
        `clienti`.clienti_cogno1
        FROM
        `conti`
        INNER JOIN `refer_clienti` ON (`conti`.conto_id = `refer_clienti`.conto_id)
        INNER JOIN `clienti` ON (`refer_clienti`.clienti_id = `clienti`.clienti_id)
        WHERE
        `conti`.conto_id = $conto_id   AND
        `clienti`.clienti_id = $clienti_id
        ";

        $query = $this->db->query($sql);
        $return = $query->row();
        return $return;
    }

    /**
     * review per il singolo conto id
     * @param type $conto_id
     * @return type
     */
    public function review_area_id($conto_id) {

        $sql = "
        SELECT 
        (obmp_review.pulizia_camera) AS Clean,
        ((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
        (obmp_review.dintorni) AS Location,
        ((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
        ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
        (obmp_review.prezzo_qualita) AS Value_for_money,
        (obmp_review.giudizio_totale) AS Total_score,
        obmp_review.review_id,
        obmp_review.hotel_id,
        obmp_review.preno_id,
        obmp_review.conto_id,
        obmp_review.postazione_id,
        obmp_review.nome,
        obmp_review.stato,
        obmp_review.user_type,
        (obmp_review.rumore_camere) AS Rumore_camere,
        (obmp_review.spazio_camera) AS Spazio_camera,
        (obmp_review.spazi_comuni) AS Spazi_comuni,
        (obmp_review.dintorni) AS Dintorni,
        (obmp_review.qualita_servizi) AS Qualita_servizi,
        (obmp_review.colazione) AS Colazione,
        (obmp_review.accoglienza) AS Accoglienza,
        (obmp_review.competenza_impiegati) AS Competenza_impiegati,
        (obmp_review.prezzo_qualita) AS Prezzo_qualita,
        (obmp_review.giudizio_totale) AS Giudizio_totale,
        (obmp_review.raccomandi) AS Raccomandi,
        obmp_review.commento_tex,
        obmp_review.ip_review,
        obmp_review.data_review,
        obmp_review.review_data_record,
        camere.numero_camera,
        `agenzie`.agenzia_nome,
        conti.preno_agenzia,
        `clienti`.clienti_nome,
        `clienti`.clienti_cogno,
        `clienti`.cliente_nazione,
        `nazioni`.Nazioni_Descrizione
        FROM
        obmp_review
        INNER JOIN camere ON (obmp_review.camera_numero = camere.camera_id)
        INNER JOIN conti ON (obmp_review.conto_id = conti.conto_id)
        LEFT OUTER JOIN `agenzie` ON (conti.preno_agenzia = `agenzie`.agenzia_id)
        INNER JOIN `refer_clienti` ON (obmp_review.conto_id = `refer_clienti`.conto_id)
        INNER JOIN `clienti` ON (`refer_clienti`.clienti_id = `clienti`.clienti_id)
        LEFT OUTER JOIN nazioni ON (clienti.cliente_nazione = nazioni.Nazioni_Id_Codice)
        WHERE (obmp_review.conto_id = $conto_id )
        ";

        $query = $this->db->query($sql);
        $return = $query->row();
        return $return;
    }

    /**
     * Media dei review per singola hotel
     * @param type $hotel_id
     * @return type
     */
    public function review_avg($hotel_id) {

        $sql = "
        SELECT 
        AVG(obmp_review.pulizia_camera) AS Clean,
        AVG((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
        AVG(obmp_review.dintorni) AS Location,
        AVG((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
        AVG((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
        AVG(obmp_review.prezzo_qualita) AS Value_for_money,
        AVG(obmp_review.giudizio_totale) AS Total_score,
        obmp_review.review_id,
        obmp_review.hotel_id,
        obmp_review.preno_id,
        obmp_review.conto_id,
        obmp_review.postazione_id,
        obmp_review.nome,
        obmp_review.stato,
        obmp_review.user_type,
        AVG(obmp_review.rumore_camere) AS Rumore_camere,
        AVG(obmp_review.spazio_camera) AS Spazio_camera,
        AVG(obmp_review.spazi_comuni) AS Spazi_comuni,
        AVG(obmp_review.dintorni) AS Dintorni,
        AVG(obmp_review.qualita_servizi) AS Qualita_servizi,
        AVG(obmp_review.colazione) AS Colazione,
        AVG(obmp_review.accoglienza) AS Accoglienza,
        AVG(obmp_review.competenza_impiegati) AS Competenza_impiegati,
        AVG(obmp_review.prezzo_qualita) AS Prezzo_qualita,
        AVG(obmp_review.giudizio_totale) AS Giudizio_totale,
        AVG(obmp_review.raccomandi) AS Raccomandi,
        obmp_review.commento_tex,
        obmp_review.ip_review,
        obmp_review.data_review,
        obmp_review.review_data_record
        FROM
        obmp_review
        WHERE
        (obmp_review.hotel_id = '$hotel_id')
        GROUP BY obmp_review.hotel_id 
        ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * elenca tutti le recenzioi del clienti_id
     * @param type $clienti_id
     * @return type
     */
    
//    public function review_cliente_id($clienti_id) {
//
//        $sql = "
//        SELECT
//        FROM
//        usr_web1_3.obmp_review
//        INNER JOIN usr_web1_3.refer_clienti
//        ON usr_web1_3.obmp_review.conto_id = usr_web1_3.refer_clienti.conto_id
//        WHERE
//       
//        ";
//
//        $query = $this->db->query($sql);
//        $return = $query->result();
//        return $return;
//    }

    
    
      public function review_cliente_id($clienti_id) {

        $sql = "
       SELECT 
        (obmp_review.pulizia_camera) AS Clean,
        ((obmp_review.rumore_camere + obmp_review.spazio_camera + obmp_review.spazi_comuni) / 3) AS Comfort,
        (obmp_review.dintorni) AS Location,
        ((obmp_review.colazione + obmp_review.qualita_servizi ) / 2) AS Services,
        ((obmp_review.accoglienza + obmp_review.competenza_impiegati) / 2) AS Staff,
        (obmp_review.prezzo_qualita) AS Value_for_money,
        (obmp_review.giudizio_totale) AS Total_score,
        obmp_review.review_id,
        obmp_review.hotel_id,
        obmp_review.preno_id,
        obmp_review.conto_id,
        obmp_review.postazione_id,
        obmp_review.nome,
        obmp_review.stato,
        obmp_review.user_type,
        (obmp_review.rumore_camere) AS Rumore_camere,
        (obmp_review.spazio_camera) AS Spazio_camera,
        (obmp_review.spazi_comuni) AS Spazi_comuni,
        (obmp_review.dintorni) AS Dintorni,
        (obmp_review.qualita_servizi) AS Qualita_servizi,
        (obmp_review.colazione) AS Colazione,
        (obmp_review.accoglienza) AS Accoglienza,
        (obmp_review.competenza_impiegati) AS Competenza_impiegati,
        (obmp_review.prezzo_qualita) AS Prezzo_qualita,
        (obmp_review.giudizio_totale) AS Giudizio_totale,
        (obmp_review.raccomandi) AS Raccomandi,
        obmp_review.commento_tex,
        obmp_review.ip_review,
        obmp_review.data_review,
        obmp_review.review_data_record,
        camere.numero_camera,
        agenzie.agenzia_nome,
        conti.preno_agenzia,
        conti.in_conto,
         conti.out_conto,
        clienti.clienti_id,
        clienti.clienti_nome,
        clienti.clienti_cogno,
        clienti.cliente_nazione,
        hotels.nome_hotel,
        hotels.hotel_tipologia,
        hotels.hotel_citta, 
        hotel_foto_piccola,
        hotel_foto_grande
         FROM
        obmp_review
        INNER JOIN camere ON (obmp_review.camera_numero = camere.camera_id)
        INNER JOIN conti ON (obmp_review.conto_id = conti.conto_id)
         INNER JOIN hotels ON (obmp_review.hotel_id = hotels.hotel_id)
         LEFT OUTER JOIN `agenzie` ON (conti.preno_agenzia = `agenzie`.agenzia_id)
         INNER JOIN `refer_clienti` ON (obmp_review.conto_id = `refer_clienti`.conto_id)
         INNER JOIN `clienti` ON (`refer_clienti`.clienti_id = `clienti`.clienti_id)
 WHERE 
 usr_web1_3.refer_clienti.clienti_id = $clienti_id
        ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
    
    
    
}

?>