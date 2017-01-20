<?php
$url_img = 'http://www.ciaohotel.com/html/obmpmax/obmpmax/';
$string = $preno->room_obmp_string;
$risu = json_decode($string, true);
// print_r($risu) ;
// print_r($rooms) ;
?>
<div class="row">
    <div class="small-12  medium-12  large-12 columns">
        <fieldset>
            <legend>BOOKING_ID <?php echo $preno->preno_id; ?></legend>
            <h6><?php echo $lg_tex['RESERVATION CODE']; ?> <?php echo $preno->preno_id; ?> / h:<?php echo $preno->preno_in_data; ?></h6>
            <p><?php echo $lg_tex['please_keep_the_reservation']; ?></p>
<!--            <fieldset>-->
                <legend>BOOKING</legend>
                <!-- Guest-->
                <div class="small-12  medium-6 large-6 columns">
                    <fieldset>   
                        <p> Guest Details :<br>
                            <?php echo $lg_tex['first_name']; ?>: <strong> <?php echo $preno->preno_cogno; ?> </strong> <br>
                            <?php echo $lg_tex['last_name']; ?>: <strong> <?php echo $preno->preno_nome; ?> </strong> <br>
                            <?php echo $lg_tex['e-mail']; ?>: <strong> <?php echo $preno->preno_email; ?> </strong> <br>
                            <?php echo $lg_tex['city']; ?>: <strong> <?php echo $preno->obm_cliente_city; ?> </strong> <br>
                            <?php echo $lg_tex['country']; ?>:<strong> <?php echo $preno->obm_cliente_country; ?> </strong> <br>
<?php echo $lg_tex['phone_number']; ?>:<strong> <?php echo $preno->preno_tel; ?> </strong> <br>
                        </p>
                    </fieldset>
                </div>
                <!-- Hotel-->
                <div class=" small-12  medium-6 large-6 columns">
                    <fieldset> 
                        <p> <strong> <?php echo $albergo[0]->hotel_tipologia; ?> <?php echo $albergo[0]->nome_hotel; ?>: </strong> <br>
                            <?php echo $albergo[0]->hotel_via; ?> <br />   
<?php echo $albergo[0]->hotel_citta; ?>, <?php echo $albergo[0]->hotel_stato; ?> <?php echo $albergo[0]->hotel_cap; ?><br />
                            <strong><?php echo $lg_tex['phone_number']; ?>:</strong> <?php echo $albergo[0]->hotel_tel; ?><br />
                            <strong><?php echo $lg_tex['fax_number']; ?>: </strong><?php echo $albergo[0]->hotel_fax; ?><br />
                            <strong><?php echo $lg_tex['e-mail']; ?>:</strong> <?php echo $albergo[0]->hotel_email; ?><br />
                        </p>
                    </fieldset>
                </div>
                <div class="row">
                    <?php
                    $i = 1;
                    foreach ($risu as $key => $row_rooms) {
                        ?>
                        <!--camere-->
                        <div class="small-12  medium-6 large-6 columns">
                            <fieldset>  
                                <p> <?php echo $lg_tex['your_reservation']; ?>:<br>
                                    <strong><?php echo $preno->{'q' . $i}; ?> <?php echo $rooms_obmp[$key]->obmp_cm_lingue_nome; ?>, <?php echo $preno->preno_n_notti; ?> <?php echo $lg_tex['night']; ?> </strong> <br>
                                    <?php echo $lg_tex['check-in']; ?>: <strong><?php echo date("D F j, Y", strtotime($preno->preno_dal)); ?> </strong> <br>
                                    <?php echo $lg_tex['check-out']; ?>: <strong> <?php echo date("D F j, Y", strtotime($preno->preno_al)); ?> </strong><br>
                                    <br>
    <?php echo $lg_tex['totale_price']; ?>: <strong> <?php echo number_format(( $preno->{'p' . $i} * $preno->preno_n_notti * $preno->{'q' . $i}), 2, '.', ','); ?> EUR </strong> <br>
                                    <br>
                                </p>
                            </fieldset> 
                        </div>
    <?php $i ++;
} ?> 
                </div>
                
</fieldset>
                </div>
     
            <fieldset>
                <legend><?php echo $lg_tex['notify']; ?></legend>
                <p><?php echo $lg_tex['i_would_like_to_notify_my_arrival_time']; ?> h: <?php echo $preno->preno_arr_ore; ?> <br>
<?php echo $lg_tex['special_requests']; ?> <?php echo $preno->preno_note; ?> <br>
                </p>
            </fieldset>
            <fieldset>
                <legend><?php echo $lg_tex['how_to_reach']; ?></legend>
                <p><strong><?php echo $lg_tex['by_car']; ?>:</strong> <?php echo $albergo[0]->hotel_reach_by_car; ?> <br>
                    <strong><?php echo $lg_tex['by_train']; ?>:</strong> <?php echo $albergo[0]->hotel_reach_by_treno; ?> <br>
                    <strong><?php echo $lg_tex['by_airplane']; ?>:</strong> <?php echo $albergo[0]->hotel_reach_aereo; ?> </p>
            </fieldset>
            <label><?php echo $lg_tex['cancellation_without_penalty_until']; ?>
                <?php
// si determina la data di cancellazione senza penale 
                $DATA = strtotime($preno->preno_dal);
                $anno = date("Y", $DATA);
                $mese = date("m", $DATA);
                $giorno = date("d", $DATA);
                $ora = date("H");
                $minute = date("i");
                $canc_polity = $albergo[0]->hotel_cancel_pol;
                /* si incrementa la data di un giono */
                echo date("D F j, Y H : i", mktime($ora, $minute, 0, $mese, ($giorno - $canc_polity), $anno));
                ?>
            </label>
<!--        </fieldset>-->
    </div>
</div>