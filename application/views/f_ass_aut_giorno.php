<?php require_once('../Connections/hotel_intrgrati.php'); ?>
<?php require_once('../Connections/hotel_intrgrati.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


// elenco delle camare adatte al gruppo per tipolpgia
function f_assegna_elenco($hotel_id, $agenzia_id, $tipologia_id)
{
	global $database_hotel_intrgrati;
	global $hotel_intrgrati;

	mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_individua_camare = " SELECT COUNT( `camere`.`camera_id` ) AS `ranking` , `camere`.`numero_camera` , `camere`.`tipologia_camera` , `conti`.`hotel_id` , `conti`.`in_conto` , `conti`.`out_conto` , `conti`.`tipologia_id` , `tipologia_camera`.`tipologia_sigla` , `tipologia_camera`.`numero_pax` , `tipologia_camera`.`nome_tipologia` , `conti`.`camera_id` FROM `conti` INNER JOIN `camere` ON ( `conti`.`camera_id` = `camere`.`camera_id` ) INNER JOIN `tipologia_camera` ON ( `conti`.`tipologia_id` = `tipologia_camera`.`tipologia_id` ) WHERE    (conti.preno_agenzia = '$agenzia_id') AND    (conti.out_conto >= '2014-01-01') AND    (conti.hotel_id = '$hotel_id') AND    (conti.tipologia_id = '$tipologia_id') GROUP BY `conti`.`tipologia_id` , `conti`.`camera_id` HAVING   ranking > 4 ORDER BY `tipologia_camera`.`numero_pax` DESC , `ranking` DESC ";
$rs_individua_camare = mysql_query($query_rs_individua_camare, $hotel_intrgrati) or die(mysql_error());
$row_rs_individua_camare = mysql_fetch_assoc($rs_individua_camare);
$totalRows_rs_individua_camare = mysql_num_rows($rs_individua_camare);
	
	$camare_adatte = array(); 
	do
	{ 
		$camare_adatte[] =  $row_rs_individua_camare['camera_id']; 
	} 
	while ($row_rs_individua_camare = mysql_fetch_assoc($rs_individua_camare)); 
	
	return $camare_adatte; 
	
	mysql_free_result($rs_individua_camare);
}


// elenco delle camare disponibili 
function f_camere_disponibili($hotel_id, $preno_dal , $preno_al)
{
	global $database_hotel_intrgrati;
	global $hotel_intrgrati;

	mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
	$query_rs_elenco_camere = "SELECT * ,   camere.numero_camera FROM camere WHERE camere.hotel_id = '$hotel_id' AND  camera_id NOT IN  ( SELECT    camera_id FROM   foglio_giorno WHERE    (foglio_giorno.hotel_id = '$hotel_id') AND  (foglio_giorno.stato_camera <> '7') AND    (foglio_giorno.in_conto < '$preno_al') AND   (foglio_giorno.out_preno > '$preno_dal') ) ORDER BY camere.numero_camera";
	$rs_elenco_camere = mysql_query($query_rs_elenco_camere, $hotel_intrgrati) or die(mysql_error());
	$row_rs_elenco_camere = mysql_fetch_assoc($rs_elenco_camere);
	$totalRows_rs_elenco_camere = mysql_num_rows($rs_elenco_camere);
	
	$camare_disp = array();
	do
	{ 
		$camare_disp[] =  $row_rs_elenco_camere['camera_id']; 
	}
	while ($row_rs_elenco_camere = mysql_fetch_assoc($rs_elenco_camere)); 
		
	return $camare_disp; 

	mysql_free_result($rs_elenco_camere);
}

// funzione che mi inserisce nel foglio l'assegnamento 
function f_ins_assegna($dati)
{
	global $database_hotel_intrgrati;
	global $hotel_intrgrati;

	if (isset($dati['camera_id'])  && !empty($dati['camera_id']))
	{
	  $insertSQL = sprintf("INSERT INTO foglio_giorno (hotel_id, camera_id, preno_id, tipologia_id, foglio_prezzo_camera, nome_cliente, cognome_cliente, in_conto, out_preno, stato_camera, preno_agenzia) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
						   GetSQLValueString($dati['hotel_id'], "int"),
						   GetSQLValueString($dati['camera_id'], "int"),
						   GetSQLValueString($dati['preno_id'], "int"),
						   GetSQLValueString($dati['tipologia_id'], "int"),
						   GetSQLValueString(round($dati['foglio_prezzo_camera'],2) , "double"),
						   GetSQLValueString($dati['nome_cliente'], "text"),
						   GetSQLValueString($dati['cognome_cliente'], "text"),
						   GetSQLValueString($dati['in_conto'], "date"),
						   GetSQLValueString($dati['out_preno'], "date"),
						   GetSQLValueString($dati['stato_camera'], "text"),
						   GetSQLValueString($dati['preno_agenzia'], "int"));

	  mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
	  $Result1 = mysql_query($insertSQL, $hotel_intrgrati) or die(mysql_error());

	}
}

//  P = round($row_rs_vedi_preno['p1'],3)
// conta le camere gia aassegnate per campo di tipologia t1 . t2 .. 
function f_cont_assegnate($T,$P,$preno_id ) {
   global $database_hotel_intrgrati;
   global $hotel_intrgrati;
   global $hotel_id;
mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_t1 = "SELECT    count(*) AS `qa_1`,   `foglio_giorno`.`foglio_id`,   `foglio_giorno`.`hotel_id`,   `foglio_giorno`.`preno_id`,   `foglio_giorno`.`tipologia_id` FROM   `foglio_giorno` WHERE   `foglio_giorno`.`preno_id` = '$preno_id' AND    `foglio_giorno`.`hotel_id` = '$hotel_id' AND    `foglio_giorno`.`tipologia_id` = '$T' AND   round(`foglio_giorno`.`foglio_prezzo_camera`,2) = '$P' GROUP BY   `foglio_giorno`.`tipologia_id`";
$rs_t1 = mysql_query($query_rs_t1, $hotel_intrgrati) or die(mysql_error());
$row_rs_t1 = mysql_fetch_assoc($rs_t1);
$totalRows_rs_t1 = mysql_num_rows($rs_t1);
return $row_rs_t1['qa_1'];
mysql_free_result(rs_t1);

}



// modificato 

function f_intersect_assegna($hotel_id , $preno_id , $id_tipologia )
{
	global $database_hotel_intrgrati;
	global $hotel_intrgrati;


	
	// prenotazione preno_id
	mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
	$query_rs_vedi_preno = "SELECT * FROM agenda   LEFT OUTER JOIN agenzie ON (agenda.preno_agenzia = agenzie.agenzia_id) WHERE (agenda.preno_id = '$preno_id')";
	$rs_vedi_preno = mysql_query($query_rs_vedi_preno, $hotel_intrgrati) or die(mysql_error());
	$row_rs_vedi_preno = mysql_fetch_assoc($rs_vedi_preno);
	$totalRows_rs_vedi_preno = mysql_num_rows($rs_vedi_preno);


	
	// preparo i campi
	$dati['preno_id'] =  $preno_id  ;
	$dati['hotel_id'] = $hotel_id ;
	$dati['preno_agenzia'] =  $agenzia_id  = $row_rs_vedi_preno['preno_agenzia'] ;
	$dati['in_conto']  = $preno_dal   = $row_rs_vedi_preno['preno_dal'] ;
	$dati['out_preno'] = $preno_al    = $row_rs_vedi_preno['preno_al']  ;
	$dati['cognome_cliente'] = $row_rs_vedi_preno['preno_cogno'] ;
	$dati['nome_cliente'] =  $row_rs_vedi_preno['preno_nome'] ;
	$dati['stato_camera'] =  5 ; 

	// solo prenotazioni  presenti future 
	if($row_rs_vedi_preno['preno_dal'] >= date("Y-m-d"))
		{
			
	
/* // cancello le camare gia assegnate 
		$deleteSQL = sprintf("DELETE FROM foglio_giorno WHERE (foglio_giorno.preno_id = %s) AND (foglio_giorno.stato_camera = '5')",
		GetSQLValueString($preno_id, "int"));
		mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
		$Result1 = mysql_query($deleteSQL, $hotel_intrgrati) or die(mysql_error());
 */

    // print_r($array2) ;
	// contollo tutti i campi 
		for ($t = 1; $t <= 6; $t++ ) 
		{  
	
	          
			$vt = 't' . $t ; 
			$qt = 'q' . $t ; 
			$pt = 'p' . $t ; 
			
			// controllo la tipologia di referimento 	data da l'ordne di f_assegna_today()
          if( ($row_rs_vedi_preno[$vt] == $id_tipologia) ) {
			
			$dati['tipologia_id'] = $tipologia_id  = $row_rs_vedi_preno[$vt] ;
			$dati['foglio_prezzo_camera'] = $row_rs_vedi_preno[$pt]  ; 
			
			// camre adatte alla tipologia
			$cam_adatte[$tipologia_id] = f_assegna_elenco($hotel_id, $agenzia_id, $tipologia_id ); 
			// print_r($cam_adatte); 
			
			// elenca le camere disponibili $camare_id
			$cam_dispo = f_camere_disponibili($hotel_id, $preno_dal , $preno_al) ;
			// print_r($cam_dispo);	
		
			$result[$tipologia_id] = array_intersect($cam_adatte[$tipologia_id], $cam_dispo);
			// print_r($result[$tipologia_id]) ;
			 
			 
			foreach ( $result[$tipologia_id]  as $ris)
				{
			    $risultato[$tipologia_id][] = $ris ;
				}	
			 
			 
			// print_r($risultato);
			// assegno per ogni q* delle stessa tipologia
		 // controllo le camare gia assegnate
          $assegnate =  f_cont_assegnate($row_rs_vedi_preno[$vt] , round($row_rs_vedi_preno[$pt],2) ,$preno_id ) ; 
			// echo $assegnate .'<br>' ; 
			$Q =  $row_rs_vedi_preno[$qt] - $assegnate  ;
				for( $j = 0 ; $j < $Q ; $j++ )
				{

					$dati['camera_id'] =   $risultato[$tipologia_id][$j] ;	
					
					 //  print_r($dati) ;
					// iserisco i dati 
					 $ins =  f_ins_assegna($dati);
				}

			}
		}


	}


	mysql_free_result($rs_vedi_preno);

//mysql_free_result($rs_preno_tipologia);
}

// estraggo tutte le tipologia per un determinato giorno
 function  f_assegna_today($hotel_id , $OGGI ){
	
	global $database_hotel_intrgrati;
	global $hotel_intrgrati;

	$now = date('Y-m-d');
	
mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_preno_tipologia = "SELECT    (if(agenda.t1 = 1, agenda.q1, 0) + if(agenda.t2 = 1, agenda.q2, 0) + if(agenda.t3 = 1, agenda.q3, 0) + if(agenda.t4 = 1, agenda.q4, 0) + if(agenda.t5 = 1, agenda.q5, 0) + if(agenda.t6 = 1, agenda.q6, 0)) AS Singola,   (if(agenda.t1 = 7, agenda.q1, 0) + if(agenda.t2 = 7, agenda.q2, 0) + if(agenda.t3 = 7, agenda.q3, 0) + if(agenda.t4 = 7, agenda.q4, 0) + if(agenda.t5 = 7, agenda.q5, 0) + if(agenda.t6 = 7, agenda.q6, 0)) AS Doppia_Uso,   (if(agenda.t1 = 2, agenda.q1, 0) + if(agenda.t2 = 2, agenda.q2, 0) + if(agenda.t3 = 2, agenda.q3, 0) + if(agenda.t4 = 2, agenda.q4, 0) + if(agenda.t5 = 2, agenda.q5, 0) + if(agenda.t6 = 2, agenda.q6, 0)) AS Doppia,   (if(agenda.t1 = 3, agenda.q1, 0) + if(agenda.t2 = 3, agenda.q2, 0) + if(agenda.t3 = 3, agenda.q3, 0) + if(agenda.t4 = 3, agenda.q4, 0) + if(agenda.t5 = 3, agenda.q5, 0) + if(agenda.t6 = 3, agenda.q6, 0)) AS Matrimoniale,   (if(agenda.t1 = 9, agenda.q1, 0) + if(agenda.t2 = 9, agenda.q2, 0) + if(agenda.t3 = 9, agenda.q3, 0) + if(agenda.t4 = 9, agenda.q4, 0) + if(agenda.t5 = 9, agenda.q5, 0) + if(agenda.t6 = 9, agenda.q6, 0)) AS Matri_Balcone,   (if(agenda.t1 = 4, agenda.q1, 0) + if(agenda.t2 = 4, agenda.q2, 0) + if(agenda.t3 = 4, agenda.q3, 0) + if(agenda.t4 = 4, agenda.q4, 0) + if(agenda.t5 = 4, agenda.q5, 0) + if(agenda.t6 = 4, agenda.q6, 0)) AS Tripla,   (if(agenda.t1 = 5, agenda.q1, 0) + if(agenda.t2 = 5, agenda.q2, 0) + if(agenda.t3 = 5, agenda.q3, 0) + if(agenda.t4 = 5, agenda.q4, 0) + if(agenda.t5 = 5, agenda.q5, 0) + if(agenda.t6 = 5, agenda.q6, 0)) AS Quadrupla,   (if(agenda.t1 = 6, agenda.q1, 0) + if(agenda.t2 = 6, agenda.q2, 0) + if(agenda.t3 = 6, agenda.q3, 0) + if(agenda.t4 = 6, agenda.q4, 0) + if(agenda.t5 = 6, agenda.q5, 0) + if(agenda.t6 = 6, agenda.q6, 0)) AS Junior_Suit,   (if(agenda.t1 = 8, agenda.q1, 0) + if(agenda.t2 = 8, agenda.q2, 0) + if(agenda.t3 = 8, agenda.q3, 0) + if(agenda.t4 = 8, agenda.q4, 0) + if(agenda.t5 = 8, agenda.q5, 0) + if(agenda.t6 = 8, agenda.q6, 0)) AS Quintupla,   (agenda.q1 + agenda.q2 + agenda.q3 + agenda.q4 + agenda.q5 + agenda.q6) AS Num_camare,   agenda.preno_dal,   agenda.preno_al,   agenda.preno_n_notti,   agenda.preno_cogno,   agenda.preno_agenzia,   agenda.preno_nome,   agenda.preno_id,   agenzie.agenzia_nome,   agenda.t1,   agenda.q1,   agenda.p1,   agenda.t2,   agenda.q2,   agenda.p2,   agenda.t3,   agenda.q3,   agenda.p3,   agenda.t4,   agenda.q4,   agenda.p4,   agenda.t5,   agenda.q5,   agenda.p5,   agenda.t6,   agenda.q6,   agenda.p6 FROM   agenda   LEFT OUTER JOIN agenzie ON (agenda.preno_agenzia = agenzie.agenzia_id) WHERE ((agenda.preno_stato = '1') OR    ((agenda.preno_stato = '2') AND    (agenda.data_opzione = '$now'))) AND    (agenda.preno_dal <= '$OGGI') AND    (agenda.preno_al > '$OGGI') AND    (agenda.hotel_id = '$hotel_id') ORDER BY agenda.preno_n_notti DESC,   agenda.preno_dal ,   Quintupla DESC,  Quadrupla DESC,  Tripla DESC, Junior_Suit DESC,  Matri_Balcone DESC,   Doppia DESC,   Matrimoniale DESC,   Doppia_Uso DESC,   Singola DESC";
$rs_preno_tipologia = mysql_query($query_rs_preno_tipologia, $hotel_intrgrati) or die(mysql_error());
$row_rs_preno_tipologia = mysql_fetch_assoc($rs_preno_tipologia);
$totalRows_rs_preno_tipologia = mysql_num_rows($rs_preno_tipologia);

/* echo $query_rs_preno_tipologia ;


print_r($row_rs_preno_tipologia);
 */


do {  

// Quintupla
$dati[8][$row_rs_preno_tipologia['preno_id']] = array('tipo' =>'Five',  'preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Quintupla'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] , 't1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6'] ) ; 

// Quadrupla
$dati[5][$row_rs_preno_tipologia['preno_id']] = array('tipo' =>'Quad', 'preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Quadrupla'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6']  ) ; 

// Tripla
$dati[4][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'Tripl','preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Tripla'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6'] ) ; 

// Js
$dati[6][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'JuSi', 'preno_id' => $row_rs_preno_tipologia['preno_id'] , 'Q' => $row_rs_preno_tipologia['Junior_Suit'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'], 't1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6'] ) ; 

// Doppia
$dati[2][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'Twin', 'preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Doppia'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6']  ) ; 

// Matrimoniale
$dati[3][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'Doub','preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Matrimoniale'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6']  ) ; 

// DUS
$dati[7][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'Dus', 'preno_id' => $row_rs_preno_tipologia['preno_id'] , 'Q' => $row_rs_preno_tipologia['Doppia_Uso'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6'] ) ; 
// Singola
$dati[1][$row_rs_preno_tipologia['preno_id']] = array( 'tipo' =>'Sing', 'preno_id' => $row_rs_preno_tipologia['preno_id'], 'Q' => $row_rs_preno_tipologia['Singola'], 'dal' => $row_rs_preno_tipologia['preno_dal'], 'al' => $row_rs_preno_tipologia['preno_al'], 'agenzia_id' => $row_rs_preno_tipologia['preno_agenzia'] ,'t1'  => $row_rs_preno_tipologia['t1'], 'q1' => $row_rs_preno_tipologia['q1'], 'p1' => $row_rs_preno_tipologia['p1'] , 't2'  => $row_rs_preno_tipologia['t2'], 'q2' => $row_rs_preno_tipologia['q2'] , 'p2' => $row_rs_preno_tipologia['p2'] ,'t3'  => $row_rs_preno_tipologia['t3'], 'q3' => $row_rs_preno_tipologia['q3'] , 'p3' => $row_rs_preno_tipologia['p3'] ,'t4'  => $row_rs_preno_tipologia['t4'], 'q4' => $row_rs_preno_tipologia['q4'] , 'p4' => $row_rs_preno_tipologia['p4'] ,'t5'  => $row_rs_preno_tipologia['t5'], 'q5' => $row_rs_preno_tipologia['q5'] , 'p5' => $row_rs_preno_tipologia['p5'] ,'t6'  => $row_rs_preno_tipologia['t6'], 'q6' => $row_rs_preno_tipologia['q6'] , 'p6' => $row_rs_preno_tipologia['p6'] ) ; 

} while ($row_rs_preno_tipologia = mysql_fetch_assoc($rs_preno_tipologia)); 



return $dati;

}



?>
<?php 

$hotel_id =  $_GET['hotel_id'] ;
$preno_dal =  $_GET['preno_dal'] ;


if( isset($hotel_id) && !empty($hotel_id) && isset($preno_dal) && !empty($preno_dal)	 ) 
{

 $dati = f_assegna_today($hotel_id , $preno_dal) ;

//  print_r($dati);

foreach ($dati  as $kw => $val) {

	foreach ($val  as $k => $v) {
		f_intersect_assegna($hotel_id , $v['preno_id'] , $kw  );
		
//		echo ' hotel ' .$hotel_id . ' preno ' .$v['preno_id']. ' tipologia ' .$kw . ' tipo ' .$v['tipo'] .'<br>' ;   
	}

	
	
}

  
$url = '../foglio_futuri.php?preno_dal=' . $preno_dal .'&hotel_id=' .$hotel_id  ; 
 header("Location:$url" ); /* Redirect browser */ 
}
?>
