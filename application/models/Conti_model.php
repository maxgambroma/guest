<?php

class Conti_model extends CI_Model {

    function __construct() {
        parent::__construct();
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
    function rs_conto_id( $conto_id, $today) {
        $query = $this->db->query(
                "SELECT *, conti.camera_id,   
                (to_days('$today') - to_days(in_conto)) AS numero_notti,   
                (to_days(out_preno) - to_days(in_conto)) AS numero_notti_previste,   
                DATE_FORMAT(conti.in_conto_time, '%k') AS ora_check_in,   
                DATE_FORMAT(now(), '%H') AS ora_check_out 
                FROM conti 
                LEFT JOIN refer_clienti ON conti.conto_id = refer_clienti.conto_id 
                LEFT JOIN clienti ON refer_clienti.clienti_id = clienti.clienti_id
                LEFT JOIN agenzie ON conti.preno_agenzia = agenzie.agenzia_id
                WHERE
                (conti.conto_id = '$conto_id') "
        );

        $result = $query->result();
        return $result;
    }

    /**
     * Fornice i dati del conto
     * @param type $today
     * @param type $conto_id
     * @param type $hotel_id
     * @return type 
     */
    function rs_diff_data($today, $conto_id ) {

        $sql = "
    SELECT *,
    ( if ( conti_stato_camere <> '7',(to_days('$today') - to_days(in_conto)) ,  (to_days(out_conto) - to_days(in_conto))  ) ) AS numero_notti,
    (to_days(out_preno) - to_days(in_conto)) AS notti_previste,
    DATE_FORMAT(conti.in_conto_time, '%k') AS ora_check_in,
    DATE_FORMAT(now(), '%H') AS ora_check_out
    FROM
    conti 
    WHERE
    (conti.conto_id = '$conto_id')
    ";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**fff
     * Calcola il Totale degli extra
     * @param type $conto_id
     * @param type $hotel_id
     * @return type
     */
    function rs_tot_extra($conto_id) {

        $sql = "
        SELECT adebiti.prezzo,
        SUM( adebiti.prezzo * adebiti.quantita ) AS tot_extra,
        adebiti.descrizione,
        adebiti.prodotto_id,
        adebiti.conto_id,
        adebiti.hotel_id,
        adebiti.adebito_id,
        adebiti.adebiti_data_record,
        adebiti.quantita
        FROM
        adebiti
        WHERE
        (adebiti.conto_id = '$conto_id') 
        GROUP BY
        adebiti.conto_id";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * Calcola il totale degli acconti
     * @param type $conto_id
     * @param type $hotel_id
     * @return type
     */
    function rs_acconti($conto_id ) {

        $sql = "
SELECT
	SUM( cassa.pagamento_importo_pag ) AS tot_p_acconti,
	cassa.cassa_id,
	cassa.hotel_id,
	cassa.preno_id,
	cassa.conto_id,
	cassa.out_conto,
	cassa.totale_modificato,
	cassa.pagamento_importo_pag,
	cassa.pagamento_forma,
	cassa.cassa_stato_camera,
	cassa.sospeso,
	cassa.fattura_numero,
	cassa.nome_pagante,
	cassa.cassa_data_record,
	cassa.cassa_utente_id
FROM
	cassa
WHERE
	(cassa.conto_id = '$conto_id')
GROUP BY
	cassa.conto_id    

";

        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    /**
     * Calcola le tasse pagate 
     * @param type $conto_id
     * @param type $hotel_id
     * @return type
     */
    function rs_tax($conto_id ) {

        $sql = "
    SELECT   tax_pagamento.hotel_id,
    SUM( tax_pagamento.importo ) AS totale_pagato,
    COUNT( tax_pagamento.tax_pagamento_id ) AS pax_numero
    FROM
    tax_pagamento
    WHERE
    (tax_pagamento.conto_id = '$conto_id') AND
    (tax_pagamento.tassa_stato = '1') 
    GROUP BY   tax_pagamento.hotel_id

";

        $query = $this->db->query($sql);
        $return = $query->row();
        
  
            return $return;
     
   
        
        
    }

    
    
    
       function conto_aperto_cliente_id($clienti_id ) {

        $sql = "
SELECT
 conti.conti_stato_camere,
	refer_clienti.clienti_id,
	conti.conto_id,
	conti.hotel_id,
	conti.foglio_id,
	conti.clienti_id,
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
	conti.nome_cliente,
	conti.cognome_cliente,
	conti.preno_agenzia,
	conti.mercato,
	conti.conti_utente_id
FROM
	conti
	LEFT OUTER JOIN refer_clienti
	 ON conti.conto_id = refer_clienti.conto_id
WHERE
	conti.conti_stato_camere <> 7
	AND refer_clienti.clienti_id = '$clienti_id'
            ORDER BY
	conti.conto_id DESC
";
        $query = $this->db->query($sql);
        $return = $query->result();
        return $return;
    }

    
    
    
    
    
    
    
    function totale_conto_camera($conto_id, $today) {
        /* ----------------inizio  Calcola il Totale Notti ------------------------------------------ */

        

     
        
// conto 
        $diff_data = $this->rs_diff_data($today, $conto_id);

   
// extra
        $tot_extra = $this->rs_tot_extra($conto_id);
        
        if($tot_extra){
            $rs_tot_extra = $tot_extra[0]->tot_extra ; 
        }
       
 else {
      $rs_tot_extra = 0;
     
 }
//acconti
        $acconti_a = $this->rs_acconti($conto_id) ;
        
        if ($acconti_a) {
            $acconti = $acconti_a[0]->tot_p_acconti ;
        }

 else {
       $acconti = 0 ;
 }

        $numero_notti = (float) $diff_data[0]->numero_notti;

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


        $notti_preno = (float)  $diff_data[0]->notti_previste; // notti previste 
        $prezzo_camara = (float) $diff_data[0]->prezzo; // prezzo Camera 
        $notti_solare =  (float) $diff_data[0]->numero_notti; // notti solare 
        $notti_conto = (float)  $numero_notti + (float) $ora_gg_in + (float) $ora_gg_out + (float) $ora_gg_cl ; // notti da pagare
        $conto_camera = (float) $diff_data[0]->prezzo * (float) $notti_conto;     // importo del pernotto attuale 
        $conto_camera_preno = (float) $diff_data[0]->prezzo * (float) $notti_preno;     // importo del pernotto previsto
        $totale_extra = (float) $rs_tot_extra;  // impoto degli extra
        $totale_acconti = (float)  $acconti; // totale Acconti 
        $saldo = (float)  $conto_camera + (float) $totale_extra - (float) $totale_acconti; // saldo  attuale
        $saldo_preno = (float) $conto_camera_preno + (float) $totale_extra -(float)  $totale_acconti; // saldo da reno
        $tot_conto_preno = (float) $conto_camera_preno + (float) $totale_extra;

        /* ----------------------- Fine Calcola il Totale Notti----------------------------------- */



         // tax
        $tot_tax_pagato = $this->rs_tax($conto_id );

        $dati = array(
            "notti_preno" => round($notti_preno, 3),
            "notti_solare" => round($notti_solare, 3),
            "notti_conto" => round($notti_conto, 3),
            "conto_camera" => round($conto_camera, 3),
            "conto_camera_preno" => round($conto_camera_preno, 3),
            "totale_extra" => round($totale_extra, 3),
            "totale_acconti" => round($totale_acconti, 3),
            "saldo" => round($saldo, 3),
            "saldo_preno" => round($saldo_preno, 3),
            "tot_conto_preno" => round($tot_conto_preno, 3),
            "tot_tax_pagato" => round($tot_tax_pagato, 3),
        );

        return $dati;
    }

}
