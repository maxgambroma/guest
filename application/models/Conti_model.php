<?php
class Conti_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * Restituisce l'elenco di tutti i conti aperti
     * 
     * @param int $hotel_id
     * 
     * @return type
     */
    function rs_conti_aperti_elenco($hotel_id) {
        $this->db->select('*');
        $this->db->from('conti');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('conti_stato_camere <> ', 7);
        $this->db->order_by('numero_camera');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Inserisce in conti_trasferisci lo storico dei trasferimenti di conto 
     * (solo riferimenti per id)
     * 
     * @param type $form_data
     * 
     * @return boolean
     */
    function conti_trasferisci($form_data) {
        $this->db->insert('conti_trasferisci', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 
     * Funzione che elenca i prodotti acquistabili
     * 
     * @param int $hotel_id
     * 
     * @return type
     */
    function elenco_prodotti($hotel_id) {
        $this->db->select('*');
        $this->db->from('prodotti');
        $this->db->where('hotel_id', $hotel_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Inserisce in addebiti il valore passato dalla form di addebito
     * 
     * @param type $form_data
     * @return boolean
     */
    function acquista_prodotto($form_data) {

        $this->db->insert('adebiti', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 
     * Seleziona un prodotto da un id
     * 
     * @param type $prodotto_id
     * @return type
     */
    function prodotto_from_id($prodotto_id) {
        $this->db->select('*');
        $this->db->from('prodotti');
        $this->db->where('prodotto_id', $prodotto_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Funzione che controlla se il conto di una determiata camera è aperto 
     * 
     * @param int $hotel_id
     * @param int $camera_id
     * 
     * @return
     */
    function rs_controllo_stato_conto($hotel_id, $camera_id) {
        $this->db->select('foglio_id, camera_id, preno_id, stato_camera');
        $this->db->from('foglio_giorno');
        $this->db->where('stato_camera', 4);
        $this->db->where('camera_id', $camera_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Elenca i conti in partenza oggi
     * 
     * @param int $hotel_id
     * @param date $today
     * 
     * @return type
     */
    function rs_conti_partenza($hotel_id, $today) {
        $this->db->select('*');
        $this->db->from('conti');
        $this->db->join('foglio_giorno', 'conti.foglio_id = foglio_giorno.foglio_id', 'left');
        $this->db->where('conti.hotel_id', $hotel_id);
        $this->db->where('conti.out_preno', $today);
        $this->db->where('conti.conti_stato_camere <>', 7);
        $this->db->order_by('conti.numero_camera');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Elenca i conti partiti in data di oggi
     * 
     * @param int $hotel_id
     * @param date $today
     * 
     * @return type
     */
    function rs_conti_partiti($hotel_id, $today) {
        $this->db->select('*,   date_format(conti.data_record, "%d %b %H:%i,%S") AS ap_conto');
        $this->db->from('conti');
        $this->db->join('foglio_giorno', 'conti.foglio_id = foglio_giorno.foglio_id', 'left');
        $this->db->where('conti.hotel_id', $hotel_id);
        $this->db->where('conti.out_preno >=', $today);
        $this->db->where('conti.conti_stato_camere', 7);
        $this->db->order_by('conti.numero_camera');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Restituisce l'importo medio dei conti aperti e il fatturato del giorno
     * 
     * @param int $hotel_id
     * @param date $today
     * 
     * @return type
     */
    function rs_imp_conti_gg($hotel_id, $today) {
        $this->db->select('SUM(conti.prezzo) AS fatt_notte_app, * truncate(AVG(conti.prezzo),2) AS media_app');
        $this->db->from('conti');
        $this->db->where('conti.conti_stato_camere <>', 7);
        $this->db->where('conti.in_conto <=', $today);
        $this->db->where('conti.out_preno >', $today);
        $this->db->where('conti.hotel_id', $hotel_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Calcola gli extra su un determinato conto
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_tot_extra($hotel_id, $conto_id) {
        $this->db->select('SUM(prezzo * quantita) AS tot_extra, prezzo, descrizione, prodotto_id, conto_id, hotel_id, adebito_id, adebiti_data_record, quantita');
        $this->db->from('adebiti');
        $this->db->where('conto_id', $conto_id);
        $this->db->where('hotel_id', $hotel_id);
        $this->db->group_by('conto_id');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Elenca tutti gli extra di cui ha usufruito una camera
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_elenca_extra($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('adebiti');
        $this->db->join('prodotti', 'adebiti.prodotto_id = prodotti.prodotto_id', 'left');
        $this->db->where('adebiti.conto_id', $conto_id);
        $this->db->where('adebiti.hotel_id', $hotel_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Calcola gli acconti pagati per un determinato conto
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_acconti($hotel_id, $conto_id) {
        $this->db->select_sum('cassa.pagamento_importo_pag');
        $this->db->from('cassa');
        $this->db->join('agenda', 'cassa.preno_id = agenda.preno_id', 'left');
        $this->db->where('cassa.conto_id', $conto_id);
        $this->db->where('cassa.hotel_id', $hotel_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Elenca tutti gli acconti pagati da una determinata camera
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_elenco_acconti($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('cassa');
        $this->db->where('cassa.conto_id', $conto_id);
        $this->db->where('cassa.hotel_id', $hotel_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Fornisce i dati di un determinato conto
     * 
     * @param int $conto_id
     * @param date $today
     * 
     * @return type
     */
    function rs_conto_id($conto_id, $today) {
        $query = $this->db->query("SELECT *, conti.camera_id,   
                        (to_days('$today') - to_days(in_conto)) AS numero_notti,   
                        (to_days(out_preno) - to_days(in_conto)) AS numero_notti_previste,   
                        DATE_FORMAT(conti.in_conto_time, '%k') AS ora_check_in,   
                        DATE_FORMAT(now(), '%H') AS ora_check_out 
                        FROM conti 
                        LEFT JOIN refer_clienti ON conti.conto_id = refer_clienti.conto_id 
                        LEFT JOIN clienti ON refer_clienti.clienti_id = clienti.clienti_id
                        LEFT JOIN agenzie ON conti.preno_agenzia = agenzie.agenzia_id
                        WHERE   (conti.conto_id = '$conto_id')");

        $result = $query->result();
        return $result;
    }

    /**
     * 
     * Restituisce tutti i dati di un conto in base ad un id
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_conto_from_id($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('conti');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('conto_id', $conto_id);

        $query = $this->db->get();
        $result = $query->row();

        return $result;
    }

    /**
     * 
     * Modifica i dati un conto in base a conto_id e foglio_id nell tabella foglio_giorno
     * 
     * @param int $hotel_id
     * @param array $dati
     */
    function modifica_conto_foglio($hotel_id, $dati) {

        $dati_update_foglio = array(
            'nome_cliente' => $dati['nome'],
            'cognome_cliente' => $dati['cognome'],
            'out_preno' => $dati['preno_al'],
            'foglio_prezzo_camera' => $dati['prezzo'],
            'preno_agenzia' => $dati['preno_agenzia']
        );

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('foglio_id', $dati['foglio_id']);
        $this->db->where('conto_id', $dati['conto_id']);
        $this->db->update('foglio_giorno', $dati_update_foglio);
    }

    /**
     * 
     * Modifica i dati un conto in base a conto_id e foglio_id nell tabella conti
     * 
     * @param int $hotel_id
     * @param array $dati
     */
    function modifica_conto_conti($hotel_id, $dati) {
        $dati_update_conti = array(
            'out_preno' => $dati['preno_al'],
            'nome_cliente' => $dati['nome'],
            'cognome_cliente' => $dati['cognome'],
            'preno_agenzia' => $dati['preno_agenzia'],
            'prezzo' => $dati['prezzo'],
            'trattamento_sog' => $dati['trattamento'],
            'conto_pag_modalita' => $dati['pagamento_modalita'],
            'mercato' => $dati['mercato']
        );

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('foglio_id', $dati['foglio_id']);
        $this->db->where('conto_id', $dati['conto_id']);
        $this->db->update('conti', $dati_update_conti);
    }

    /**
     * 
     * Assegna una camera diversa  in foglio
     * 
     * @param int $hotel_id
     * @param array $dati
     */
    function sposta_camera_foglio($hotel_id, $dati) {

        $numero_camera = $this->numero_di_camera_da_id($dati['camera_id']);

        $dati_update_foglio = array(
            'numero_camera' => $numero_camera,
            'camera_id' => $dati['camera_id']
        );

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('foglio_id', $dati['foglio_id']);
        $this->db->where('conto_id', $dati['conto_id']);
        $this->db->update('foglio_giorno', $dati_update_foglio);
    }

    /**
     * 
     * Assegna una camera diversa in conti
     * 
     * @param int $hotel_id
     * @param array $dati
     */
    function sposta_camera_conti($hotel_id, $dati) {

        $numero_camera = $this->numero_di_camera_da_id($dati['camera_id']);

        $dati_update_conti = array(
            'numero_camera' => $numero_camera,
            'camera_id' => $dati['camera_id']
        );

        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('foglio_id', $dati['foglio_id']);
        $this->db->where('conto_id', $dati['conto_id']);
        $this->db->update('conti', $dati_update_conti);
    }

    /**
     * 
     * Restituisce un numero di camera a partire da un id camera
     * 
     * @param int $camera_id
     * @return type
     */
    function numero_di_camera_da_id($camera_id) {
        $this->db->select('numero_camera');
        $this->db->from('camere');
        $this->db->where('camera_id', $camera_id);

        $query = $this->db->get();
        $result = $query->row();

        return $result->numero_camera;
    }

    /**
     * 
     * Copia una determinata riga dalla tabella conti alla tabella di backup
     * 
     * @param int $hotel_id
     * @param int $conto_id
     */
    function backup_riga_conto($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('conti');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('conto_id', $conto_id);

        $query = $this->db->get();
        $result = $query->row();

        $array_insert = array('mod_conto_id' => $result->conto_id,
            'mod_hotel_id' => $result->hotel_id,
            'mod_foglio_id' => $result->foglio_id,
            'mod_clienti_id' => $result->clienti_id,
            'mod_in_conto' => $result->in_conto,
            'mod_out_preno' => $result->out_preno,
            'mod_out_conto' => $result->out_conto,
            'mod_preno_id' => $result->preno_id,
            'mod_camera_id' => $result->camera_id,
            'mod_numero_camera' => $result->numero_camera,
            'mod_trattamento_sog' => $result->trattamento_sog,
            'mod_tipo_camera' => $result->tipo_camera,
            'mod_prezzo' => $result->prezzo,
            'mod_nome_cliente' => $result->nome_cliente,
            'mod_cognome_cliente' => $result->cognome_cliente,
            'mod_preno_agenzia' => $result->preno_agenzia,
            'mod_mercato' => $result->mercato,
            'mod_conti_stato_camere' => $result->conti_stato_camere,
            'mod_acconto' => $result->acconto,
            'modifica_conti_adebiti_utente_id' => $this->utente_id
        );

        $this->db->insert('modifica_conti', $array_insert);
    }

    /**
     * 
     * Crea un array con tutti i dati relativi al conto di una camera
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function totale_conto_camera($hotel_id, $conto_id) {
        /* ----------------inizio  Calcola il Totale Notti ------------------------------------------ */
        $diff_data = $this->rs_conto_id($conto_id, $this->today);
        $numero_notti = $diff_data[0]->numero_notti;

        /* Arrivi nella notte se il check in e prima delle 6.59 si calcola una altra notte  */
        if ($diff_data[0]->ora_check_in < 7) {
            $ora_gg_in = 1;
        } else {
            $ora_gg_in = 0;
        };

        /* fine $diff_data['ora_check_in'] */

        /* Partenze nel pomeriggio se il check out e dopo le 13.59 si calcola una altra notte  */
        if ($diff_data[0]->ora_check_out > 13) {
            $ora_gg_out = 1;
        } else {
            $ora_gg_out = 0;
        };
        /* fine  */

        /* Day Use  numero di notti  è = 0 se il check in e tra delle 7.00 e il check out prima 14.00 si calcola una altra notte  */
        if (($diff_data[0]->numero_notti < 1) && ($diff_data[0]->ora_check_in >= 7) && ($diff_data[0]->ora_check_out <= 13)) {
            $ora_gg_cl = 1;
        } else {
            $ora_gg_cl = 0;
        };
        /* fine  */

        $totale_notti = ($numero_notti + $ora_gg_in + $ora_gg_out + $ora_gg_cl );

        $numero_notti_previste = $diff_data[0]->numero_notti_previste;
        if ($numero_notti_previste != 0) {
            if ($numero_notti_previste < $totale_notti) {
                $numero_notti_previste = $totale_notti;
            }
        } else {
            $numero_notti_previste = 1;
        }

        $iporto_conto_camera = $diff_data[0]->prezzo * $totale_notti;

        $tot_extra = $this->rs_tot_extra($hotel_id, $conto_id);
        if (count($tot_extra) > 0) {
            $totale_extra = (float) $tot_extra[0]->tot_extra;
        } else {
            $totale_extra = 0;
        }

        $acconti = $this->rs_acconti($hotel_id, $conto_id);
        if (count($acconti) > 0) {
            $totale_acconti = (float) $acconti[0]->pagamento_importo_pag;
        } else {
            $totale_acconti = 0;
        }

        $totale_a_saldo = $iporto_conto_camera + $totale_extra - $totale_acconti;
        $totale_conto_previsto = $totale_extra + ($numero_notti_previste * $diff_data[0]->prezzo);
        $totale_saldo_previsto = $totale_extra + ($numero_notti_previste * $diff_data[0]->prezzo) - $totale_acconti;

        $return_array = array(
            'totale_notti' => $totale_notti,
            'iporto_conto_camera' => $iporto_conto_camera,
            'totale_extra' => $totale_extra,
            'totale_acconti' => $totale_acconti,
            'totale_a_saldo' => $totale_a_saldo,
            'totale_saldo_previsto' => $totale_saldo_previsto,
            'totale_conto_previsto' => $totale_conto_previsto
        );

        return $return_array;
    }

    /**
     * 
     * Collaga il cliente al conto
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_rif_cliente($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('refer_clienti');
        $this->db->join('clienti', 'refer_clienti.clienti_id = clienti.clienti_id', 'left');
        $this->db->where('refer_clienti.conto_id', $conto_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    
    
    
    
    
    
    /**
     * 
     * Collega le fatture al conto id
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function rs_sopesi($hotel_id, $conto_id) {
        $this->db->select('sospesi.sospeso_fatt_numero,   sospesi.sospeso_data, sospesi.sospeso_conto_id,   sospesi.sospeso_pratica_id,   pratiche.pratica_id, pratiche_rif.pratica_rif_conto_id,   sospesi.sopeso_importo, sospesi.sopeso_societa,   agenzie.agenzia_id,   agenzie.agenzia_nome, sospesi.sospeso_id ');
        $this->db->from('sospesi');
        $this->db->join('pratiche', 'sospesi.sospeso_pratica_id = pratiche.pratica_id', 'left');
        $this->db->join('pratiche_rif', 'pratiche.pratica_id = pratiche_rif.pratica_rif_pratica_id', 'left');
        $this->db->join('agenzie', 'sospesi.sopeso_societa = agenzie.agenzia_id', 'left');
        $where = "(sospesi.hotel_id = '$hotel_id') AND ((sospesi.sospeso_conto_id = '$conto_id') OR (pratiche_rif.pratica_rif_conto_id = '$conto_id'))";
        $this->db->where($where);


        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Restituisce tutte le note raltive ad un conto
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function get_conti_note($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('conti_note');
        $this->db->join('utenti', 'utenti.Utente_id = conti_note.note_conto_utente_id', 'left');
        $this->db->where('conti_note.conto_id', $conto_id);
        $this->db->where('conti_note.hotel_id', $hotel_id);
        $this->db->order_by('conti_note.conto_nota_id', 'DESC');

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Funzione che si occupa di fare il check out di una stanza
     * 
     * @param date $form_data
     * 
     * @return boolean
     */
    function check_out($form_data) {
        $insert_array = array(
            'preno_id' => $form_data['preno_id'],
            'conto_id' => $form_data['conto_id'],
            'hotel_id' => $form_data['hotel_id'],
            'cassa_utente_id' => $form_data['cassa_utente_id'],
            'out_conto' => $form_data['out_conto'],
            'cassa_stato_camera' => $form_data['cassa_stato_camera'],
            'totale_importo' => $form_data['totale_importo'],
            'totale_modificato' => $form_data['totale_modificato'],
            'pagamento_importo_pag' => $form_data['pagamento_importo_pag'],
            'pagamento_forma' => $form_data['pagamento_forma']
        );
        $this->db->insert('cassa', $insert_array);

        $update_foglio = array('stato_camera' => $form_data['cassa_stato_camera']);
        $update_foglio_where = array('foglio_id' => $form_data['foglio_id']);

        $this->db->update('foglio_giorno', $update_foglio, $update_foglio_where);

        $update_conto = array(
            'hotel_id' => $form_data['hotel_id'],
            'out_conto' => $form_data['out_conto'],
            'conti_stato_camere' => $form_data['cassa_stato_camera']
        );
        $update_conto_where = array('foglio_id' => $form_data['foglio_id']);

        $this->db->update('conti', $update_conto, $update_conto_where);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * 
     * Ritorna tutte le modifiche effettuate ad un conto dalla tabella modifica_conti
     * 
     * @param int $hotel_id
     * @param int $conto_id
     * 
     * @return type
     */
    function cronologia_elenco($hotel_id, $conto_id) {
        $this->db->select('*');
        $this->db->from('modifica_conti');
        $this->db->where('mod_hotel_id', $hotel_id);
        $this->db->where('mod_conto_id', $conto_id);

        $query = $this->db->get();
        $result = $query->result();

        return $result;
    }

    /**
     * 
     * Ritorna il conto modificato
     * 
     * @param int $hotel_id
     * @param int $id_mod_conto
     * 
     * @return type
     */
    function cronologia_elenco_from_id($hotel_id, $id_mod_conto) {
        $this->db->select('*');
        $this->db->from('modifica_conti');
        $this->db->where('mod_hotel_id', $hotel_id);
        $this->db->where('id_mod_conto', $id_mod_conto);

        $query = $this->db->get();
        $result = $query->row();

        return $result;
    }

    /**
     * 
     * Ritorna un determianto pagamento
     * 
     * @param int $hotel_id
     * @param int $cassa_id
     * 
     * @return type
     */
    function estrai_pagamento_from_id($hotel_id, $cassa_id) {
        $this->db->select('*');
        $this->db->from('cassa');
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('cassa_id', $cassa_id);

        $query = $this->db->get();
        $result = $query->row();

        return $result;
    }

    /**
     * 
     * Modifica un pagamento
     * 
     * @param int $hotel_id
     * @param int $cassa_id
     * 
     * @param type $dati
     */
    function modifica_pagamento($hotel_id, $cassa_id, $dati) {
        $this->db->where('hotel_id', $hotel_id);
        $this->db->where('cassa_id', $cassa_id);

        $this->db->update('cassa', $dati);
    }
    
    /**
     * 
     * Inserisce una nota nel db in conti_note
     * 
     * @param array $form_data
     * 
     * @return boolean
     */
    function inserisci_nota($form_data) {
        $this->db->insert('conti_note', $form_data);

        if ($this->db->affected_rows() == '1') {
            return TRUE;
        }

        return FALSE;
    }

    
    
    /**
     * trova i conti aperti per cliente
     * @param type $clienti_id
     */
    function conto_clienti($clienti_id) {

        $sql = "
SELECT
refer_clienti.clienti_id,
refer_clienti.conto_id,
refer_clienti.hotel_id,
refer_clienti.ps_valore,
refer_clienti.refer_clienti_utente_id
FROM
refer_clienti
WHERE
refer_clienti.clienti_id = $clienti_id AND
'conti_stato_camere <>  7 ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * 
     * @param type $clienti_id
     */
    
    
    function conti_clienti($clienti_id) {

        $elenco_conti = $this->conto_clienti($clienti_id);

        foreach ($elenco_conti as $key => $value) {

            $conto_id = $value->conto_id;
            $hotel_id = $value->hotel_id;

           $conti =  $this->totale_conto_camera($hotel_id, $conto_id);
        }
        
        return $conti;
        
    }

}

?>