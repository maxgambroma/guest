<div class="row">
  <div class="small-12  medium-8  large-9 columns">
    <fieldset>
    <legend>BOOKING_ID <?php echo $row_rs_tip_camere['preno_id']; ?></legend>
    <h6><?php echo $lg_tex['RESERVATION CODE'] ; ?> <?php echo $row_rs_tip_camere['preno_id']; ?> / h:<?php echo $row_rs_tip_camere['preno_in_data']; ?></h6>
    <p><?php echo $lg_tex['please_keep_the_reservation'] ; ?></p>
    <fieldset>
    <legend>BOOKING</legend>
    <div class="row">
      <div class="small-12  medium-6 large-6 columns">
        <p> <?php echo $lg_tex['your_reservation'] ; ?>:<br>
          <strong><?php echo $row_rs_tip_camere['q1']; ?> <?php echo @$tariffa_selezione['lingue_nome'];?>, <?php echo $row_rs_tip_camere['preno_n_notti']; ?> <?php echo $lg_tex['night'] ; ?> </strong> <br>
          <?php echo $lg_tex['check-in'] ; ?>: <strong><?php echo date("D F j, Y", strtotime($row_rs_tip_camere['preno_dal'])) ; ?> </strong> <br>
          <?php echo $lg_tex['check-out'] ; ?>: <strong> <?php echo date("D F j, Y", strtotime($row_rs_tip_camere['preno_al'])) ; ?> </strong><br>
          <br>
          <?php echo $lg_tex['totale_price'] ; ?>: <strong> <?php echo  number_format(( $row_rs_tip_camere['p1'] * $row_rs_tip_camere['q1']), 2, '.', ',');?> EUR </strong> <br>
          <br>
        </p>
      </div>
      <div class="small-12  medium-6 large-6 columns">
        <p> Guest Details :<br>
          <?php echo $lg_tex['first_name'] ; ?>: <strong> <?php echo $row_rs_tip_camere['preno_cogno']; ?> </strong> <br>
          <?php echo $lg_tex['last_name'] ; ?>: <strong> <?php echo $row_rs_tip_camere['preno_nome']; ?> </strong> <br>
          <?php echo $lg_tex['e-mail'] ; ?>: <strong> <?php echo $row_rs_tip_camere['preno_email']; ?> </strong> <br>
          <?php echo $lg_tex['city'] ; ?>: <strong> <?php echo $row_rs_tip_camere['obm_cliente_city']; ?> </strong> <br>
          <?php echo $lg_tex['country'] ; ?>:<strong> <?php echo $row_rs_tip_camere['obm_cliente_country']; ?> </strong> <br>
          <?php echo $lg_tex['phone_number'] ; ?>:<strong> <?php echo $row_rs_tip_camere['preno_tel']; ?> </strong> <br>
        </p>
      </div>
    </div>
    <div class="row">
      <div class="ssmall-12  medium-6 large-6 columns">
        <p> <?php echo $tariffa_selezione['html1'] ; ?></p>
      </div>
      <div class=" small-12  medium-6 large-6 columns">
        <p> <strong> <?php echo $row_rs_tip_camere['hotel_tipologia']; ?> <?php echo $row_rs_tip_camere['nome_hotel']; ?>: </strong> <br>
          <?php echo $row_rs_tip_camere['hotel_via']; ?> <br />
          <?php echo $row_rs_tip_camere['hotel_citta']; ?>, <?php echo $row_rs_tip_camere['hotel_stato']; ?> <?php echo $row_rs_tip_camere['hotel_cap']; ?><br />
          <strong><?php echo $lg_tex['phone_number'] ; ?>:</strong> <?php echo $row_rs_tip_camere['hotel_tel']; ?><br />
          <strong><?php echo $lg_tex['fax_number'] ; ?>: </strong><?php echo $row_rs_tip_camere['hotel_fax']; ?><br />
          <strong><?php echo $lg_tex['e-mail'] ; ?>:</strong> <?php echo $row_rs_tip_camere['hotel_email']; ?><br />
        </p>
      </div>
    </div>
    </fieldset>
    <fieldset>
    <legend><?php echo $lg_tex['notify'] ; ?></legend>
    <p><?php echo $lg_tex['i_would_like_to_notify_my_arrival_time'] ; ?> h: <?php echo $row_rs_tip_camere['preno_arr_ore']; ?> <br>
      <?php echo $lg_tex['special_requests'] ; ?> <?php echo $row_rs_tip_camere['preno_note']; ?> <br>
    </p>
    </fieldset>
    <fieldset>
    <legend><?php echo $lg_tex['how_to_reach'] ; ?></legend>
    <p><strong><?php echo $lg_tex['by_car'] ; ?>:</strong> <?php echo $row_rs_tip_camere['hotel_reach_by_car']; ?> <br>
      <strong><?php echo $lg_tex['by_train'] ; ?>:</strong> <?php echo $row_rs_tip_camere['hotel_reach_by_treno']; ?> <br>
      <strong><?php echo $lg_tex['by_airplane'] ; ?>:</strong> <?php echo $row_rs_tip_camere['hotel_reach_aereo']; ?> </p>
    </fieldset>
    <label><?php echo $lg_tex['cancellation_without_penalty_until'] ; ?>
    <?php 
// si determina la data di cancellazione senza penale 
	$DATA = strtotime($row_rs_tip_camere['preno_dal']) ;
  		  $anno = date("Y", $DATA);
		  $mese = date("m", $DATA);
		  $giorno = date("d", $DATA);
		  $ora = date("H" );
		  $minute = date("i");
		$canc_polity = $row_rs_tip_camere['hotel_cancel_pol'];
		 /* si incrementa la data di un giono */
	echo date("D F j, Y H : i", mktime($ora, $minute, 0 , $mese, ($giorno - $canc_polity ) ,$anno) ) ;
		 ?>
    </label>
    </fieldset>
  </div>