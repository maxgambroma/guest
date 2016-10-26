<?php

/**
 * Description of Camere
 *
 * @author massimo
 */
class Camere_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * Elenca i conti in partenza
     */

    public function partenze($hotel_id, $today) {

        $sql = "
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record,
conti.nome_cliente,
conti.cognome_cliente
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
LEFT OUTER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)

WHERE   (conti.hotel_id = '$hotel_id') AND 
(conti.out_preno <= '$today') AND  
(conti.conti_stato_camere <> '7') 
ORDER BY   conti.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /*
     * Elenca i conti partiti
      date_format(conti.data_record, '%d %b %H:%i,%S') AS ap_conto
     */

    public function partiti($hotel_id, $today) {

        $sql = "		
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record,
conti.nome_cliente,
conti.cognome_cliente
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
LEFT OUTER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)
WHERE   (conti.hotel_id = '$hotel_id') AND 
(conti.out_conto >= '$today') AND
(conti.conti_stato_camere = '7')
ORDER BY conti.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /*
     * ADR camere ex fermate
     */

    public function adr($hotel_id, $today) {

        $sql = "
SELECT SUM(conti.prezzo) AS fatt_notte_app, 
truncate(AVG(conti.prezzo),2) AS media_app
FROM   conti 
WHERE(conti.conti_stato_camere <> '7') AND
(conti.in_conto <= '$today') AND
(conti.out_preno > '$today') AND  
(conti.hotel_id = '$hotel_id')
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /*
     * Elenca tutti i contoi Aperti
     */

    public function conti_aperti($hotel_id) {

        $sql = "
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record,
conti.nome_cliente,
conti.cognome_cliente
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
INNER   JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)  
WHERE (conti.hotel_id = '$hotel_id') AND
(conti.conti_stato_camere <> '7') 
ORDER BY conti.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    public function camere($hotel_id) {

        $sql = "
    SELECT * 
    FROM camere 
    WHERE (camere.hotel_id = '$hotel_id')
    ORDER BY   camere.camere_edificio,   camere.numero_camera
    ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
    
    
        public function camare_id($hotel_id, $camara_id ) {

        $sql = "
    SELECT * 
    FROM camere 
     WHERE (camere.hotel_id = '$hotel_id')AND
        (camere.camara_id = '$camara_id')
    ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }
    
    
    
    

    public function foglio_dettagli($hotel_id, $today , $camera_id = NULL) {

        
        if($camera_id <> NULL) { $stringa  = "`foglio_giorno`.`camara_id` = '$camara_id' AND "; }
        else {  $stringa  = '';}
        
        
        $sql = "
SELECT 
`foglio_giorno`.`foglio_id`,
`foglio_giorno`.`hotel_id`,
`foglio_giorno`.`conto_id`,
`foglio_giorno`.`camera_id`,
`foglio_giorno`.`preno_agenzia`,
`foglio_giorno`.`tipologia_id`,
`foglio_giorno`.`stato_camera`,
`foglio_giorno`.`cognome_cliente`,
`foglio_giorno`.`nome_cliente`,
`foglio_giorno`.`in_conto`,
`foglio_giorno`.`out_preno`,
`tipologia_camera`.`nome_tipologia`,
`tipologia_camera`.`numero_pax`,
`agenzie`.`agenzia_nome`,
`agenda`.`preno_id`,
`agenda`.`preno_mercato`,
`agenda`.`preno_note`,
`agenda`.`preno_n_notti`,
`agenda`.`preno_arr_ore`,
`agenda`.`preno_trattamento`,
`conti`.`numero_camera`,
`conti`.`trattamento_sog`,
`conti`.`prezzo`,
`clienti`.`clienti_id`,
`clienti`.`clienti_nome`,
`clienti`.`clienti_nome1`,
`clienti`.`clienti_nome2`,
`clienti`.`clienti_nome3`,
`clienti`.`clienti_nome4`,
`clienti`.`clienti_cogno`,
`clienti`.`clienti_cogno1`,
`clienti`.`clienti_cogno2`,
`clienti`.`clienti_cogno3`,
`clienti`.`clienti_cogno4`,
`colori`.`colore_codice`,
`colori`.`colore_nome`
FROM
`foglio_giorno`
LEFT OUTER JOIN `agenda` ON (`foglio_giorno`.`preno_id` = `agenda`.`preno_id`)
LEFT OUTER JOIN `agenzie` ON (`foglio_giorno`.`preno_agenzia` = `agenzie`.`agenzia_id`)
LEFT OUTER JOIN `tipologia_camera` ON (`foglio_giorno`.`tipologia_id` = `tipologia_camera`.`tipologia_id`)
LEFT OUTER JOIN `conti` ON (`foglio_giorno`.`conto_id` = `conti`.`conto_id`)
LEFT OUTER JOIN `refer_clienti` ON (`conti`.`conto_id` = `refer_clienti`.`conto_id`)
LEFT OUTER JOIN `clienti` ON (`refer_clienti`.`clienti_id` = `clienti`.`clienti_id`)
LEFT OUTER JOIN `colori` ON (`agenda`.`preno_id` = `colori`.`col_preno_id`)  
WHERE
`foglio_giorno`.`hotel_id` = '$hotel_id' AND
" .  $stringa . "
`foglio_giorno`.`stato_camera` <> '7' AND 
`foglio_giorno`.`in_conto` <= '$today'
ORDER BY
`foglio_giorno`.`stato_camera` DESC";

        $query = $this->db->query($sql);
        $return = $query->result();

// creo una arrey per il numero della camara
        
        
        foreach ($query->result() as $row_foglio) {

            $dati[$row_foglio->camera_id] = array(
                'foglio_id' => $row_foglio->foglio_id,
                'hotel_id' => $row_foglio->hotel_id,
                'conto_id' => $row_foglio->conto_id,
                'camera_id' => $row_foglio->camera_id,
                'agenzia_id' => $row_foglio->preno_agenzia,
                'tipologia_id' => $row_foglio->tipologia_id,
                'stato_camera' => $row_foglio->stato_camera,
                'cognome_cliente' => ucfirst(strtolower($row_foglio->cognome_cliente)),
                'nome_cliente' => ucfirst(strtolower($row_foglio->nome_cliente)),
                'in_conto' => $row_foglio->in_conto,
                'out_preno' => $row_foglio->out_preno,
                'nome_tipologia' => $row_foglio->nome_tipologia,
                'numero_pax' => $row_foglio->numero_pax,
                'agenzia_nome' => $row_foglio->agenzia_nome,
                'preno_id' => $row_foglio->preno_id,
                'preno_mercato' => $row_foglio->preno_mercato,
                'preno_note' => $row_foglio->preno_note,
                'preno_n_notti' => $row_foglio->preno_n_notti,
                'preno_arr_ore' => $row_foglio->preno_arr_ore,
                'preno_trattamento' => $row_foglio->preno_trattamento,
                'numero_camera' => $row_foglio->numero_camera,
                'trattamento_sog' => $row_foglio->trattamento_sog,
                'prezzo' => $row_foglio->prezzo,
                'clienti_id' => $row_foglio->clienti_id,
                'clienti_nome' => $row_foglio->clienti_nome,
                'clienti_nome1' => $row_foglio->clienti_nome1,
                'clienti_nome2' => $row_foglio->clienti_nome2,
                'clienti_nome3' => $row_foglio->clienti_nome3,
                'clienti_nome4' => $row_foglio->clienti_nome4,
                'clienti_cogno' => $row_foglio->clienti_cogno,
                'clienti_cogno1' => $row_foglio->clienti_cogno1,
                'clienti_cogno2' => $row_foglio->clienti_cogno2,
                'clienti_cogno3' => $row_foglio->clienti_cogno3,
                'clienti_cogno4' => $row_foglio->clienti_cogno4,
                'colore_codice' => $row_foglio->colore_codice,
                'colore_nome' => $row_foglio->colore_nome,
            );
        }
        return $dati;
    }

    /*
     * Elenca tutti i contoi di
     */

    public function conti_id($hotel_id, $conto_id) {

        $sql = "
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record,
conti.nome_cliente,
conti.cognome_cliente
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
INNER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id) 

WHERE
(conti.hotel_id = '$hotel_id') AND 
(conti.conto_id = '$conto_id')
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    public function arrivi($hotel_id, $today) {

        $sql = "
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.cognome_cliente,
foglio_giorno.nome_cliente,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
LEFT OUTER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)
WHERE (foglio_giorno.hotel_id = '$hotel_id') AND 
(foglio_giorno.in_conto = '$today')  AND 
(foglio_giorno.stato_camera != '4') AND 
(camere.camera_id IS Not NULL)
ORDER BY foglio_giorno.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    public function arrivicamara($camera_id, $hotel_id, $today) {

        $sql = "
SELECT 
tipologia_camera.tipologia_id,
tipologia_camera.nome_tipologia,
tipologia_camera.nome_tipologia_en,
foglio_giorno.foglio_id,
foglio_giorno.hotel_id,
foglio_giorno.conto_id,
foglio_giorno.preno_id,
foglio_giorno.tipologia_id,
foglio_giorno.cognome_cliente,
foglio_giorno.nome_cliente,
foglio_giorno.in_conto,
foglio_giorno.out_preno,
foglio_giorno.stato_camera,
foglio_giorno.preno_agenzia,
camere.camera_id,
camere.numero_camera,
camere.camere_piano,
camere.tipologia_id AS tipologia_camera,
conti.in_conto_time,
conti.out_conto,
conti.conti_stato_camere,
foglio_giorno.foglio_utente_id,
foglio_giorno.foglio_data_record
FROM
foglio_giorno
INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
INNER JOIN camere ON (foglio_giorno.camera_id = camere.camera_id)
LEFT OUTER JOIN conti ON (foglio_giorno.conto_id = conti.conto_id)
WHERE  (foglio_giorno.camera_id = '$camera_id') AND 
(foglio_giorno.hotel_id = '$hotel_id') AND 
(foglio_giorno.in_conto = '$today')  AND 
(foglio_giorno.stato_camera != '4') AND 
(camere.camera_id IS Not NULL)
ORDER BY foglio_giorno.numero_camera
";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    public $table = 'camere';

    public function find() {
        return $this->db->get($this->table)->result();
    }

    public function find_by_id($id) {
        return $this->db->where('camera_id', $id)->limit(1)->get($this->table)->row();
    }

//public function insert($data)
//{
//$this->db->set($data);
//$this->db->insert($this->table);
//return $this->db->insert_id();
//}
//public function update($id, $data)
//{
//$this->db->where('camere_id', $id);
//$this->db->set($data);
//$this->db->update($this->table);
//return $this->db->affected_rows();
//}
//public function delete($id)
//{
//$this->db->where('camere_id', $id);
//$this->db->delete($this->table);
//return $this->db->affected_rows();
//}
//    
}
