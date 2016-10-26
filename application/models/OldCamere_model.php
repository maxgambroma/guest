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
            SELECT * FROM conti
            INNER JOIN foglio_giorno ON (conti.foglio_id = foglio_giorno.foglio_id)
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
            SELECT *           
            FROM   conti 
            INNER JOIN foglio_giorno ON (conti.conto_id = foglio_giorno.conto_id) 
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
            SELECT * FROM conti 
            WHERE (conti.hotel_id = '$hotel_id') AND
            (conti.conti_stato_camere <> '7') 
            ORDER BY conti.numero_camera
            ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /*
     * Elenca tutti i contoi di
     */

    public function conti_id($hotel_id, $conto_id) {

        $sql = "
			SELECT *
			FROM
			  conti
			  INNER JOIN `camere` ON (conti.camera_id = `camere`.camera_id)
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
            SELECT tipologia_camera.tipologia_id,
            tipologia_camera.nome_tipologia,
            tipologia_camera.nome_tipologia_en, 
            foglio_giorno.foglio_id, 
            foglio_giorno.hotel_id,
            foglio_giorno.conto_id,
            foglio_giorno.camera_id,
            foglio_giorno.preno_id,
            foglio_giorno.tipologia_id,
            foglio_giorno.cognome_cliente,
            foglio_giorno.in_conto, 
            foglio_giorno.out_preno,
            foglio_giorno.stato_camera,
            foglio_giorno.preno_agenzia,
            colori.colore_codice,
            colori.col_preno_id,
            `camere`.camera_id,
            `camere`.numero_camera,
            `camere`.tipologia_id as tipologia_camera
            FROM foglio_giorno  
            LEFT OUTER JOIN colori ON (foglio_giorno.preno_id = colori.col_preno_id)
            INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
            INNER JOIN `camere` ON (foglio_giorno.camera_id = `camere`.camera_id)
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

    public function arrivicamara($hotel_id, $today, $camera_id) {

        $sql = "
            SELECT tipologia_camera.tipologia_id,
            tipologia_camera.nome_tipologia,
            tipologia_camera.nome_tipologia_en, 
            foglio_giorno.foglio_id, 
            foglio_giorno.hotel_id,
            foglio_giorno.conto_id,
            foglio_giorno.camera_id,
            foglio_giorno.preno_id,
            foglio_giorno.tipologia_id,
            foglio_giorno.cognome_cliente,
            foglio_giorno.in_conto, 
            foglio_giorno.out_preno,
            foglio_giorno.stato_camera,
            foglio_giorno.preno_agenzia,
            colori.colore_codice,
            colori.col_preno_id,
            `camere`.camera_id,
            `camere`.numero_camera,
            `camere`.tipologia_id as tipologia_camera
            FROM foglio_giorno  
            LEFT OUTER JOIN colori ON (foglio_giorno.preno_id = colori.col_preno_id)
            INNER JOIN tipologia_camera ON (foglio_giorno.tipologia_id = tipologia_camera.tipologia_id)
            INNER JOIN `camere` ON (foglio_giorno.camera_id = `camere`.camera_id)
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

}
