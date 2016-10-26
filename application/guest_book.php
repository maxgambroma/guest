<?php require_once('Connections/hotel_intrgrati.php'); ?>
<?php 
include("private_php/variabili.php"); 


 @$barra=1 ;
  @$gruppo ='home';
// @$gruppo ='mappa' ;
// @$gruppo ='camere';
// @$gruppo ='longues';
// @$gruppo ='prezzi';

/* Terrible
Poor
Average
Very Good
Excellent
 */
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "User_Review")) {
  $insertSQL = sprintf("INSERT INTO obmp_review (hotel_id, preno_id, conto_id, postazione_id, camera_numero, nome, stato, user_type, pulizia_camera, accoglienza, rumore_camere, spazio_camera, spazi_comuni, competenza_impiegati, qualita_servizi, dintorni, colazione, tariffa, servizi_offerti, foto, indicazione_mappa, giudizio_totale, prezzo_qualita, commento_tex, raccomandi, ip_review, data_review) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hotel_id'], "int"),
                       GetSQLValueString($_POST['preno_id'], "int"),
                       GetSQLValueString($_POST['conto_id'], "int"),
                       GetSQLValueString($_POST['postazione_id'], "int"),
                       GetSQLValueString($_POST['camera_numero'], "int"),
                       GetSQLValueString($_POST['nome'], "text"),
                       GetSQLValueString($_POST['stato'], "text"),
                       GetSQLValueString($_POST['user_type'], "int"),
                       GetSQLValueString($_POST['pulizia_camera'], "int"),
                       GetSQLValueString($_POST['accoglienza'], "int"),
                       GetSQLValueString($_POST['rumore_camere'], "int"),
                       GetSQLValueString($_POST['spazio_camera'], "int"),
                       GetSQLValueString($_POST['spazi_comuni'], "int"),
                       GetSQLValueString($_POST['competenza_impiegati'], "int"),
                       GetSQLValueString($_POST['qualita_servizi'], "int"),
                       GetSQLValueString($_POST['dintorni'], "int"),
                       GetSQLValueString($_POST['colazione'], "int"),
                       GetSQLValueString($_POST['tariffa'], "int"),
                       GetSQLValueString($_POST['servizi_offerti'], "int"),
                       GetSQLValueString($_POST['foto'], "int"),
                       GetSQLValueString($_POST['indicazione_mappa'], "int"),
                       GetSQLValueString($_POST['giudizio_totale'], "int"),
                       GetSQLValueString($_POST['prezzo_qualita'], "int"),
                       GetSQLValueString($_POST['commento_tex'], "text"),
                       GetSQLValueString($_POST['raccomandi'], "int"),
                       GetSQLValueString($_POST['ip_review'], "text"),
                       GetSQLValueString($_POST['data_review'], "date"));

  mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
  $Result1 = mysql_query($insertSQL, $hotel_intrgrati) or die(mysql_error());

  $insertGoTo = "guest_book.php?hotel_id=" . $_GET['hotel_id'] . "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
 
$hotel_id = @$_GET['hotel_id'] ;
$conto_id = @$_GET['conto_id'] ;
$foglio_id = @$_GET['foglio_id'] ;
$clienti_id = @$_GET['clienti_id'] ;

$preno_id = @$_GET['preno_id'] ;


mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_tip_camere = "SELECT *,   tipologia_camera.tipologia_id,   tipologia_camera.numero_pax FROM tipologia_camera   INNER JOIN camere ON (tipologia_camera.tipologia_id = camere.tipologia_id)   INNER JOIN hotels ON (camere.hotel_id = hotels.hotel_id) WHERE (camere.hotel_id = '$hotel_id')  GROUP BY tipologia_camera.tipologia_id ORDER BY tipologia_camera.numero_pax";
$rs_tip_camere = mysql_query($query_rs_tip_camere, $hotel_intrgrati) or die(mysql_error());
$row_rs_tip_camere = mysql_fetch_assoc($rs_tip_camere);
$totalRows_rs_tip_camere = mysql_num_rows($rs_tip_camere);

mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_clente = "SELECT    clienti.clienti_nome,   clienti.clienti_cogno,   clienti.cliente_nazione,   clienti.cliente_provincia,   clienti.cliente_sesso,   conti.conto_id,   conti.foglio_id,   conti.in_conto,   conti.out_conto,   conti.hotel_id,   conti.camera_id,   conti.numero_camera,   agenda.preno_id FROM   clienti   INNER JOIN refer_clienti ON (clienti.clienti_id = refer_clienti.clienti_id)   INNER JOIN conti ON (refer_clienti.conto_id = conti.conto_id)   INNER JOIN agenda ON (conti.preno_id = agenda.preno_id) WHERE   (conti.hotel_id = '$hotel_id') AND    (conti.conto_id = '$conto_id') AND    (conti.foglio_id = '$foglio_id') AND    (clienti.clienti_id = '$clienti_id')";
$rs_clente = mysql_query($query_rs_clente, $hotel_intrgrati) or die(mysql_error());
$row_rs_clente = mysql_fetch_assoc($rs_clente);
$totalRows_rs_clente = mysql_num_rows($rs_clente);

mysql_select_db($database_hotel_intrgrati, $hotel_intrgrati);
$query_rs_review = "SELECT *, (`obmp_review`.`pulizia_camera`) AS `Clean`,   (`obmp_review`.`rumore_camere` + `obmp_review`.`spazio_camera`) / 2 AS `Comfort`,   (`obmp_review`.`dintorni`) AS `Location`,   (`obmp_review`.`spazi_comuni` + `obmp_review`.`colazione` + `obmp_review`.`qualita_servizi`) / 3 AS `Services`,   (`obmp_review`.`accoglienza` + `obmp_review`.`competenza_impiegati`) / 2 AS `Staff`,   (`obmp_review`.`raccomandi` + `obmp_review`.`prezzo_qualita` + `obmp_review`.`giudizio_totale`) / 3 AS `Value_for_money`,   (`obmp_review`.`pulizia_camera` + `obmp_review`.`rumore_camere` + `obmp_review`.`spazio_camera` + `obmp_review`.`spazi_comuni` + `obmp_review`.`dintorni` + `obmp_review`.`colazione` + `obmp_review`.`qualita_servizi` + `obmp_review`.`accoglienza` + `obmp_review`.`competenza_impiegati` + (`obmp_review`.`raccomandi` * 3) + `obmp_review`.`prezzo_qualita` + (`obmp_review`.`giudizio_totale` * 2)) / 15 AS `Total_score` FROM `obmp_review`   INNER JOIN `camere` ON (`obmp_review`.`camera_numero` = `camere`.`camera_id`)   INNER JOIN `conti` ON (`obmp_review`.`conto_id` = `conti`.`conto_id`) WHERE (obmp_review.conto_id = '$conto_id')";
$rs_review = mysql_query($query_rs_review, $hotel_intrgrati) or die(mysql_error());
$row_rs_review = mysql_fetch_assoc($rs_review);
$totalRows_rs_review = mysql_num_rows($rs_review);

?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php echo $hotel_name ; ?>:<?php echo $stelle; ?>Star hotel - Official Booking Site</title>
<?php include("private_php/head.php"); ?>
<!-- 
<?php  

echo "mygooglekeyword = " . $mygooglekeyword  . '<br><br><br>' ;
/*  
echo "cOOKIE mygooglekeyword = " . @$_COOKIE['mygooglekeyword'];
echo '$ref_event '. $ref_event .  "<br>" ;
echo '$ref_session '. $ref_session . "<br>" ;
echo '$ref_cookie ' . $ref_cookie . "<br>"  ;
echo  '$ref_agency '. $ref_agency . "<br>"  ; 
echo 'print_r($xml)//ottegngo tutti i prezzi per una data ' ; print_r($xml); 
echo 'print_r($WebPrice)//ottegngo tutti i prezzi camera  ' ; print_r($WebPrice); 
echo 'print_r($Mvalore)//ottegngo tutti i prezzi camera $Mvalore  ' ; print_r($Mvalore); 
echo "sooma valore [1] = " ;
print_r(array_sum($Mvalore['1']));
echo "  numero di giorni =  " . count($Mvalore['1']) ;
echo "post" ; print_r($_POST);
echo "GET" ; print_r($_GET);
echo "COOKIE" ; print_r($_COOKIE); 
*/
?>
-->
</head>
<body>
<div class="row">
  <?php  include("private_php/top_1.php"); ?>
</div>
<div class="row">
  <div class="large-12 columns">
    <!--<img src="Lbooking.jpg">  -->
  </div>
</div>
<div class="row">
  <div class="large-12 columns">
    <?php include("private_php/top_basso.php"); ?>
</div>
</div>
<div class="row">
  <div class="large-12  columns">
    <fieldset>
    <legend>Review</legend>
    <?php if ($totalRows_rs_review > 0) { // Show if recordset not empty ?>
      <blockquote>
        <h2> Thank you for inserting your comment!</h2>
      </blockquote>
      <table width="90%"  border="0" align="center" cellpadding="10" cellspacing="0" >
        <tr >
          <td width="50%" bordercolor="#D9F9E1" bgcolor="#D9F9E1"><h2>Your Hotel Score : <?php echo 
number_format($row_rs_review['Total_score'] , 2, '.', ',') ;
 ?> </h2></td>
          <td width="50%" align="center" valign="middle" bordercolor="#D9F9E1" bgcolor="#F5E887"><?php 
	  
	  
	  // si mostra il testo  di tripavisor per i giudizzi positivi 
	  
	  
	  if( ($row_rs_review['raccomandi'] > 8) && ($row_rs_review['giudizio_totale'] >=7)  ) { ?>
            <div align="left"><strong><font color="#336633">Write a Review By sharing your experience, you're helping travellers make better choices and plan their dream trips. Thank You!</font></strong> <br />
            </div>
            <?php } ?>
          </td>
        </tr>
        <tr >
          <td width="50%" valign="top" bordercolor="#D9F9E1" bgcolor="#D9F9E1"><ul>
              <li><strong>The hotel score in the different areas</strong></li>
            </ul>
            <ul>
              <li> Clean <?php echo  number_format( $row_rs_review['Clean'], 2, '.', ',')  ; ?></li>
              <li> Comfort <?php echo  number_format($row_rs_review['Comfort'], 2, '.', ',') ; ?></li>
              <li> Location <?php echo number_format( $row_rs_review['Location'],  2, '.', ',')  ; ?></li>
              <li> Services <?php echo  number_format($row_rs_review['Services'],  2, '.', ',')  ;  ?></li>
              <li> Staff <?php echo  number_format($row_rs_review['Staff'], 2, '.', ',') ; ?></li>
              <li> Value for money <?php echo  number_format( $row_rs_review['Value_for_money'] , 2, '.', ','); ?></li>
            </ul></td>
          <td width="50%" align="center" valign="top" bordercolor="#D9F9E1" bgcolor="#F5E887"><h4 align="left"></h4>
            <?php 
	  // si mostra il formo di tripavisor per i giudizzi positivi 	  
	  if( ($row_rs_review['raccomandi'] > 8) && ($row_rs_review['giudizio_totale'] >=7)  ) { ?>
            <?php if( $_GET['hotel_id'] == 4) {?>
            <div id="TA_cdswritereviewlg592" class="TA_cdswritereviewlg">
              <ul id="KbYA4eNTp3" class="TA_links DmPufR">
                <li id="PlrbaSKK" class="RtW9VvSpI">Review <a  href="http://www.tripadvisor.com/Hotel_Review-g187791-d259742-Reviews-Ateneo_Garden_Palace_Hotel-Rome_Lazio.html">Ateneo Garden Palace Hotel</a></li>
              </ul>
            </div>
            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=592&amp;locationId=259742&amp;lang=en_US"></script>
            <?php }?>
            <?php if( $_GET['hotel_id'] == 2) {?>
            <div id="TA_cdswritereviewlg899" class="TA_cdswritereviewlg">
              <ul id="HQeyZtxE84vK" class="TA_links qZ9U158Xj">
                <li id="a18LRxA" class="4NWFWzK">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d280226-Reviews-Hotel_Laurentia-Rome_Lazio.html">Hotel Laurentia</a></li>
              </ul>
            </div>
            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=899&amp;locationId=280226&amp;lang=en_UK"></script>
            <?php }?>
            <?php if( $_GET['hotel_id'] == 1) {?>
            <div id="TA_cdswritereviewlg233" class="TA_cdswritereviewlg">
              <ul id="EZNshY4" class="TA_links r04cwBBhbK">
                <li id="pb07WqB0UlI" class="xJSoOy">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d258996-Reviews-Hotel_La_Pergola-Rome_Lazio.html">Hotel La Pergola</a></li>
              </ul>
            </div>
            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=233&amp;locationId=258996&amp;lang=en_UK"></script>
            <?php }?>
            <?php if( $_GET['hotel_id'] == 3) {?>
            <div id="TA_cdswritereviewlg398" class="TA_cdswritereviewlg">
              <ul id="DFZ1C6ewL" class="TA_links 1PVIgUQnBBV">
                <li id="X9Id2Kdrs7VL" class="QaDj0ZleMzoG">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d203196-Reviews-Albergo_Carlo_Magno_Hotel-Rome_Lazio.html">Albergo Carlo Magno Hotel</a></li>
              </ul>
            </div>
            <p>
              <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=398&amp;locationId=203196&amp;lang=en_UK"></script>
              <?php }?>
              <?php }?>
            </p></td>
        </tr>
        <tr >
          <td colspan="2" valign="top" bordercolor="#D9F9E1"><blockquote>
              <p> <em><font color="#336633"><strong>Your comment</strong><br />
                <?php echo $row_rs_review['commento_tex']; ?></font></em></p>
            </blockquote></td>
        </tr>
      </table>
      <p>&nbsp; </p>
      <p> <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
      </p>
      <?php } // Show if recordset not empty ?>
    <?php if ($totalRows_rs_review == 0) { // Show if recordset empty ?>
      <form action="<?php echo $editFormAction; ?>" method="POST" name="User_Review" id="User_Review" data-abide >
        <h4>Hi, <?php echo $row_rs_clente['clienti_nome']; ?> Tell us what you think!</h4>
        <p> Write a rewiew for this hotel and share your opinion with others. </p>
        <p> Please indicate your rating starting from <strong>POOR </strong><img alt="star" src="images/stars_1.gif" width="59" height="11"> to <strong>EXCELLENT </strong><img alt="star" src="images/stars_5.gif" width="59" height="11"><br>
        </p>

        <p>
        <strong>Room Number * </strong> <?php echo $row_rs_clente['numero_camera']; ?> </strong>
        </p>
  
        <fieldset>
        <legend>Property Characteristics</legend>
        <p>
          <label  class="inline" for="pulizia_camera" >Cleanliness of rooms <strong class="small">POOR </strong>&nbsp;
          <input name="pulizia_camera"   type="radio" value="2"  required="" >
          <input name="pulizia_camera"  type="radio" value="4" required="">
          <input name="pulizia_camera"   type="radio" value="6"  required="">
          <input name="pulizia_camera"  type="radio" value="8"  required="">
          <input name="pulizia_camera"  type="radio" value="10"  required="">
          <strong>EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline"  for="accoglienza" >Welcoming <strong>POOR </strong>&nbsp;
          <input name="accoglienza"   type="radio" value="2" data-invalid="" required="">
          <input name="accoglienza"  type="radio" value="4" data-invalid="" required="">
          <input name="accoglienza"   type="radio" value="6" data-invalid="" required="">
          <input name="accoglienza"   type="radio" value="8" data-invalid="" required="">
          <input name="accoglienza"  type="radio" value="10" data-invalid="" required="">
          <strong>EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline" for="rumore_camere" >Noise level in rooms <strong>POOR </strong>&nbsp;
          <input name="rumore_camere" type="radio" value="2" data-invalid="" required="">
          <input name="rumore_camere" type="radio" value="4" data-invalid="" required="">
          <input name="rumore_camere" type="radio" value="6" data-invalid="" required="">
          <input name="rumore_camere" type="radio" value="8" data-invalid="" required="">
          <input name="rumore_camere" type="radio" value="10" data-invalid="" required="">
          <strong> EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline" for="spazio_camera" >Spaciousness of rooms <strong>POOR </strong>&nbsp;
          <input name="spazio_camera" type="radio" value="2" data-invalid="" required="">
          <input name="spazio_camera" type="radio" value="4" data-invalid="" required="">
          <input name="spazio_camera" type="radio" value="6" data-invalid="" required="">
          <input name="spazio_camera" type="radio" value="8" data-invalid="" required="">
          <input name="spazio_camera" type="radio" value="10" data-invalid="" required="">
          <strong>EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline"  for="spazi_comuni" >Public areas <strong>POOR </strong>&nbsp;
          <input name="spazi_comuni" type="radio" value="2" data-invalid="" required="">
          <input name="spazi_comuni" type="radio" value="4" data-invalid="" required="">
          <input name="spazi_comuni" type="radio" value="6" data-invalid="" required="">
          <input name="spazi_comuni" type="radio" value="8" data-invalid="" required="">
          <input name="spazi_comuni" type="radio" value="10" data-invalid="" required="">
          <strong>EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline" for="competenza_impiegati" >Competence of employees <strong>POOR </strong>&nbsp;
          <input name="competenza_impiegati" type="radio" value="2" data-invalid="" required="">
          <input name="competenza_impiegati" type="radio" value="4" data-invalid="" required="">
          <input name="competenza_impiegati" type="radio" value="6" data-invalid="" required="">
          <input name="competenza_impiegati" type="radio" value="8" data-invalid="" required="">
          <input name="competenza_impiegati" type="radio" value="10" data-invalid="" required="">
          <strong> EXCELLENT</strong> </label>
        </p>
        <p>
          <label class=" inline"  for="qualita_servizi" >Quality of service provided <strong>POOR </strong>&nbsp;
          <input name="qualita_servizi" type="radio" value="2" data-invalid="" required="">
          <input name="qualita_servizi" type="radio" value="4" data-invalid="" required="">
          <input name="qualita_servizi" type="radio" value="6" data-invalid="" required="">
          <input name="qualita_servizi" type="radio" value="8" data-invalid="" required="">
          <input name="qualita_servizi" type="radio" value="10" data-invalid="" required="">
          <strong>EXCELLENT</strong> </label>
        </p>
        <p>
          <label class=" inline" for="dintorni" >Location: <strong>POOR </strong>&nbsp;
          <input name="dintorni" type="radio" value="2" data-invalid="" required="">
          <input name="dintorni" type="radio" value="4" data-invalid="" required="">
          <input name="dintorni" type="radio" value="6" data-invalid="" required="">
          <input name="dintorni" type="radio" value="8" data-invalid="" required="">
          <input name="dintorni" type="radio" value="10" data-invalid="" required="">
          <strong>EXCELLENT </strong> </label>
        </p>
        <p>
          <label class=" inline"  for="colazione" >Breakfast <strong>POOR </strong>&nbsp;
          <input name="colazione" type="radio" value="2" data-invalid="" required="">
          <input name="colazione" type="radio" value="4" data-invalid="" required="">
          <input name="colazione" type="radio" value="6" data-invalid="" required="">
          <input name="colazione" type="radio" value="8" data-invalid="" required="">
          <input name="colazione" type="radio" value="10" data-invalid="" required="">
          <strong> EXCELLENT </strong> </label>
        </p>
        </fieldset>
        <fieldset>
        <legend>General Review </legend>
        <label  class=" inline"  for="giudizio_totale"  >How do you rate your overall stay? <strong>POOR </strong>
        <input name="giudizio_totale" type="radio" value="2" required="">
        <input name="giudizio_totale" type="radio" value="4" required="">
        <input name="giudizio_totale" type="radio" value="6" required="">
        <input name="giudizio_totale" type="radio" value="8" required="">
        <input name="giudizio_totale" type="radio" value="10" required="">
        <strong>EXCELLENT </strong></label>
        </fieldset>
        <fieldset>
        <legend>Quality vs. Price </legend>
        <label  class=" inline"  for="prezzo_qualita"  >How do you rate the relationship between price/quality <strong>POOR </strong>
        <input name="prezzo_qualita" type="radio" value="2" required="">
        <input name="prezzo_qualita" type="radio" value="4" required="">
        <input name="prezzo_qualita" type="radio" value="6" required="">
        <input name="prezzo_qualita" type="radio" value="8" required="">
        <input name="prezzo_qualita" type="radio" value="10" required="">
        &nbsp; <strong>EXCELLENT </strong> </label>
        </fieldset>
        <fieldset>
        <legend>Write your review</legend>
        <p> Write your comment (max 4000 characters) </p>
        <p >
          <textarea name="commento_tex" cols="60" rows="8" id="commento"></textarea>
        </fieldset>
        <p>
          <label  class=" inline"  for="raccomandi"   >Do you recommend this Hotel? <strong>Yes</strong>
          <input name="raccomandi" type="radio" value="10" required="">
          |
          <input name="raccomandi" type="radio" value="2" required="">
          <strong> No &nbsp; </strong> </label>
        </p>
        
              <p>
          <label>Which type of user are you?*
          <select size="1" name="user_type" required="" data-invalid="" >
            <option value="" selected="selected">Not Specified</option>
            <option value="1">Single leisure traveller</option>
            <option value="2">Single corporate traveller</option>
            <option value="3">Young couples</option>
            <option value="4">Mature couples</option>
            <option value="5">Families with older children </option>
            <option value="6">Families with young children </option>
            <option value="7">Group of friends</option>
            <option value="8">Other</option>
          </select></label>
<small class="error"> Type of user <?php // echo $tax_lg['country'][$lg] ; ?>is required </small>
      
        </p>
        
        <p>
          <input name="post"  type="submit" class="button [tiny small large]" id="post" value=" Post Your Review">
          <input class="button right secondary " name="ripristina" type="reset" id="ripristina" value="Refresh">
        </p>
        <!-- ex-->
        <input name="tariffa" type="hidden" value="1">
        <input name="servizi_offerti" type="hidden" value="1">
        <input name="foto" type="hidden" value="1">
        <input name="indicazione_mappa" type="hidden" value="1">
        <!-- / ex -->
        <input name="hotel_id" type="hidden" id="hotel_id" value="<?php echo @$_GET['hotel_id']; ?>">
        <input name="preno_id" type="hidden" id="preno_id" value="<?php echo @$_GET['preno_id']; ?>">
        <input name="postazione_id" type="hidden" id="<?php echo @$postazione_id; ?>">
        <input name="ip_review" type="hidden" id="ip_review" value="<?php echo @$REMOTE_ADDR ; ?>">
        <input name="data_review" type="hidden" id="data_review" value="<?php echo date('Y-m-d'); ?>">
        <input name="conto_id" type="hidden" id="conto_id" value="<?php echo @$_GET['conto_id']; ?>">
        <input name="stato" type="hidden" id="stato" value="<?php echo $row_rs_clente['cliente_nazione']; ?>" />
       <input name="nome" type="hidden" id="nome" value="<?php echo $row_rs_clente['clienti_cogno']; ?>" />
       <input name="camera_numero" type="hidden" id="camera_numero" value="<?php echo $row_rs_clente['camera_id']; ?>" />
        
        <input type="hidden" name="MM_insert" value="User_Review">
      </form>
      <?php } // Show if recordset empty ?>
    <!-- / Testo -->
    </fieldset>
  </div>
  <!--
  <div class="large-3 columns">
     -->
  <!--    <fieldset>
    <legend></legend>
    <?php // include("private_php/boby_destra.php"); ?>
    <?php // include("private_php/boby_sinistra_1.php"); ?>
    </fieldset> -->
  <!-- 
  </div>
  -->
</div>
<!-- chiudi row -->
<div class="row">
  <div class="large-12 columns">
    <?php include("private_php/foot_2.php"); ?>
  </div>
</div>
<footer class="row">
  <div class="large-2 columns">
    <?php include("private_php/foot_1.php"); ?>
  </div>
  <div class="large-8 columns">
    <?php include("private_php/foot_basso.php"); ?>
  </div>
  <div class="large-2 columns">
    <?php include("private_php/foot_3.php"); ?>
  </div>
</footer>
</body>
</html>
<?php
mysql_free_result($rs_review);
?>
