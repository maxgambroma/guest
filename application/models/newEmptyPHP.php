<?php

class Conto_model extends CI_Model {

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
    function rs_conto_id($hotel_id, $conto_id, $today) {
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
                (conti.conto_id = '$conto_id')AND
                (conti.hotel_id = '$hotel_id') "
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


function rs_diff_data($today, $conto_id, $hotel_id ) {

$sql = "
    SELECT *,
    (if( conti_stato_camere <> '7',(to_days('$today') - to_days(in_conto)) ,  (to_days(out_conto) - to_days(in_conto))  ) ) AS numero_notti,
    (to_days(out_preno) - to_days(in_conto)) AS notti_previste,
    DATE_FORMAT(conti.in_conto_time, '%k') AS ora_check_in,
    DATE_FORMAT(now(), '%H') AS ora_check_out
    FROM
    conti 
    WHERE
    (conti.conto_id = '$conto_id')AND 
    (conti.hotel_id = '$hotel_id')";

$query = $this->db->query($sql);
$return = $query->result();
return $return;
}


/**
 * Calcola il Totale degli extra
 * @param type $conto_id
 * @param type $hotel_id
 * @return type
 */


function rs_tot_extra($conto_id, $hotel_id) {

$sql = "
        SELECT adebiti.prezzo,
        SUM(adebiti.prezzo * adebiti.quantita) AS tot_extra,
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
        (adebiti.conto_id = '$conto_id') AND 
        (adebiti.hotel_id = '$hotel_id')
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


function rs_acconti($conto_id, $hotel_id) {

$sql = "
    SELECT
    SUM(cassa.pagamento_importo_pag) AS tot_contanti
    FROM
    cassa
    LEFT OUTER JOIN agenda ON (cassa.preno_id = agenda.preno_id)
    WHERE
    (cassa.conto_id = '$conto_id')AND 
    (cassa.hotel_id = '$hotel_id')AND 
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


function rs_tax($conto_id, $hotel_id) {

$sql = "
    SELECT   tax_pagamento.hotel_id,
    SUM(tax_pagamento.importo) AS totale_pagato,
    COUNT(tax_pagamento.tax_pagamento_id) AS pax_numero
    FROM
    tax_pagamento
    WHERE
    (tax_pagamento.hotel_id = '$hotel_id') AND
    (tax_pagamento.tassa_stato = '1') AND 
    (tax_pagamento.conto_id = '$conto_id') 
    GROUP BY   tax_pagamento.hotel_id

";

$query = $this->db->query($sql);
$return = $query->result();
return $return;
}



function totale_conto_camera($hotel_id, $conto_id, $today) {
/* ----------------inizio  Calcola il Totale Notti ------------------------------------------ */
 
// conto 
$diff_data = $this->rs_diff_data($today, $conto_id, $hotel_id ) ;
// e4xtra
$rs_tot_extra = $this->rs_tot_extra($conto_id, $hotel_id)  ; 
//acconti
$rs_acconti = $this->rs_acconti($conto_id, $hotel_id) ; 
// tax
$rs_tax = $this->rs_tax($conto_id, $hotel_id)  ; 



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


$notti_preno = $diff_data[0]->notti_previste ; // notti previste 
$prezzo_camara = $diff_data[0]->prezzo ; // prezzo Camera 
$notti_solare = $diff_data[0]->numero_notti; // notti solare 


$notti_conto = ($numero_notti+ $ora_gg_in + $ora_gg_out + $ora_gg_cl ); // notti da pagare
 
$conto_camera = $diff_data[0]->prezzo * $notti_conto ;     // importo del pernotto attuale 
$conto_camera_preno = $diff_data[0]->prezzo * $notti_preno ;     // importo del pernotto previsto

$totale_extra = $rs_tot_extra[0]->tot_extra ;  // impoto degli extra
$totale_acconti = $rs_acconti[0]->tot_contanti; // totale Acconti 

$saldo = $conto_camera + $totale_extra - $totale_acconti ; // saldo  attuale
$saldo_preno = $conto_camera_preno + $totale_extra - $totale_acconti ; // saldo da reno
$tot_conto_preno = $conto_camera_preno + $totale_extra  ;

/* ----------------------- Fine Calcola il Totale Notti----------------------------------- */



$tot_tax_pagato = $rs_tax[0]->totale_pagato ;

$dati = array(
"notti_preno" => round($notti_preno, 3) ,
"notti_solare" => round($notti_solare, 3)  ,
"notti_conto" => round($notti_conto, 3) ,
"conto_camera" => round($conto_camera, 3),
"conto_camera_preno" => round($conto_camera_preno, 3) , 
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