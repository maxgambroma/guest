<?php
$url_img = 'http://www.ciaohotel.com/html/obmpmax/obmpmax/';
$string = $preno->room_obmp_string;
$risu = json_decode($string, true);
// print_r($risu) ;
// print_r($rooms) ;


// rooms_obmp  camare Obmp
// $rooms camre gestionale
?>
<div class="row">
    <div class="small-12  medium-12  large-12 columns">
            
        
        <fieldset> 
        <legend>BOOKING_ID <?php echo $preno->preno_id; ?></legend>
            <h6><?php echo $lg_tex['RESERVATION CODE']; ?> <?php echo $preno->preno_id; ?> / h:<?php echo $preno->preno_in_data; ?></h6>
            <p><?php echo $lg_tex['please_keep_the_reservation']; ?></p>
            </fieldset>
    </div>

    <div class="row"> 
        <!-- Guest-->
        <div class="small-12  medium-6 large-6 columns">
            <fieldset>   
                <legend> Guest Details </legend>
                <p> <?php echo $lg_tex['first_name']; ?>: <strong> <?php echo $preno->preno_cogno; ?> </strong> <br>
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
                <legend>Hotel Details </legend>

                <p> <strong> <?php echo $albergo[0]->hotel_tipologia; ?> <?php echo $albergo[0]->nome_hotel; ?>: </strong> <br>
                    <?php echo $albergo[0]->hotel_via; ?> <br />   
                    <?php echo $albergo[0]->hotel_citta; ?>, <?php echo $albergo[0]->hotel_stato; ?> <?php echo $albergo[0]->hotel_cap; ?><br />
                    <strong><?php echo $lg_tex['phone_number']; ?>:</strong> <?php echo $albergo[0]->hotel_tel; ?><br />
                    <strong><?php echo $lg_tex['fax_number']; ?>: </strong><?php echo $albergo[0]->hotel_fax; ?><br />
                    <strong><?php echo $lg_tex['e-mail']; ?>:</strong> <?php echo $albergo[0]->hotel_email; ?><br />
                </p>
            </fieldset>
        </div>
    </div>
    
    <div class="row"> 
        <?php
        $i = 1;
        
        
        // per i dati della stringa json_decode
        foreach ($risu as $key => $row_rooms) {
            ?>
            <!--camere-->
            <div class="small-12  medium-12 large-6 columns">
                <fieldset> 
                    <legend><?php echo $lg_tex['your_reservation']; ?> <?php echo $i; ?> ° </legend>
                    <div class="row">
                          <div class="small-12  medium-4 large-4 columns"> <img src="<?php echo $url_img . $rooms_obmp[$key]->obmp_cm_rooms_foto150; ?>"/>
                        </div> 
                        <div class="small-12  medium-8 large-8 columns">
                            <p> 
                                <strong><?php echo $preno->{'q' . $i}; ?> <?php echo $rooms_obmp[$key]->obmp_cm_lingue_nome; ?>, <?php echo $preno->preno_n_notti; ?> <?php echo $lg_tex['night']; ?> </strong> <br>
                                <?php echo $lg_tex['check-in']; ?>: <strong><?php echo date("D F j, Y", strtotime($preno->preno_dal)); ?> </strong> <br>
                                <?php echo $lg_tex['check-out']; ?>: <strong> <?php echo date("D F j, Y", strtotime($preno->preno_al)); ?> </strong><br>
                                <?php echo $lg_tex['totale_price']; ?>: <strong> <?php echo number_format(( $preno->{'p' . $i} * $preno->preno_n_notti * $preno->{'q' . $i}), 2, '.', ','); ?> EUR </strong> <br>
                                <br>
                            </p>
                        </div>
                      
                    </div>
                </fieldset> 
            </div>
            <?php
            $i ++;
        }
        ?> 
    </div>
</div>


<div class="row">
    <div class="small-12  medium-12  large-12 columns"> 
        <fieldset>
            <legend><?php echo $lg_tex['notify']; ?></legend>
            <p><?php echo $lg_tex['i_would_like_to_notify_my_arrival_time']; ?> h: <?php echo $preno->preno_arr_ore; ?> <br>
                <?php echo $lg_tex['special_requests']; ?> <?php echo $preno->preno_note; ?> <br>
            </p>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="small-12  medium-12  large-12 columns"> 
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
