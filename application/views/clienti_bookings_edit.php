<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// print_r($rs_clienti);
// print_r($conti_old); 
//  print_r($preno); 
//    
//    [0] => stdClass Object
//        (
//            [conto_id] => 239470
//            [hotel_id] => 1
//            [foglio_id] => 320886
//            [in_conto] => 2016-09-21
//            [out_preno] => 2016-09-23
//            [out_conto] => 0000-00-00
//            [in_conto_time] => 2016-09-21 18:37:01
//            [preno_id] => 135609
//            [camera_id] => 168
//            [numero_camera] => 109
//            [trattamento_sog] => BB
//            [tipo_camera] => Doppia Uso
//            [tipologia_id] => 7
//            [prezzo] => 85.00
//            [mercato] => 
//            [preno_agenzia] => 
//            [conti_stato_camere] => 4
//            [clienti_nome] => CETINKAYA
//            [clienti_cogno] => SEMIH 
//            [cliente_nato_a] => TURCHIA
//            [cliente_nato_il] => 30/05/1981
//            [cliente_nazione] => TURCHIA
//            [cliente_provincia] => TUR
//            [cliente_residenza] => TURCHIA
//            [cliente_cocumento_tipo] => 3
//            [cliente_cocumento_numero] => U06096997
//            [cliente_cocumento_rilasciato_il] => 18/10/2012
//            [cliente_sesso] => M
//            [clienti_tel] => 
//            [clienti_fax] => 
//            [clienti_email] => info@hotellaurentia.com
//            [clienti_note] => 
//            [privacy] => 1
//            [marketing] => 0
//            [clienti_data_record] => 2016-09-22 08:16:38
//            [clienti_utente_id] => 12
//            [preno_in_data] => 2016-09-20 13:39:14
//            [preno_importo] => 170
//            [preno_dal] => 2016-09-21
//            [preno_al] => 2016-09-23
//            [preno_n_notti] => 2
//            [preno_trattamento] => BB
//            [preno_nome] => CETINKAYA
//            [preno_cogno] => SEMIH 
//            [t1] => 7
//            [q1] => 1
//            [p1] => 85
//            [t2] => 0
//            [q2] => 0
//            [p2] => 0
//            [t3] => 0
//            [q3] => 0
//            [p3] => 0
//            [t4] => 0
//            [q4] => 0
//            [p4] => 0
//            [t5] => 0
//            [q5] => 0
//            [p5] => 0
//            [t6] => 0
//            [q6] => 0
//            [p6] => 0
//            [voucher_id] => 
//            [preno_tel] => 
//            [preno_email] => 
//            [preno_mercato] => 
//            [preno_stato] => 1
//            
//              hotels.nome_hotel,
//	hotels.hotel_tipologia,
//	hotels.hotel_citta,
//	hotels.hotel_tel,
//	hotels.hotel_email,
//	hotels.hotel_web,
//	hotels.hotel_logo,
//	hotels.hotel_mappa,
//	hotels.hotel_foto_piccola,
//	hotels.hotel_foto_grande,
//	hotels.hotel_booking_url,
//	hotels.facebook,
//	hotels.google,
//	hotels.instagram,
//	hotels.twitter,
//	hotels.linkedin,
//	hotels.analytics
//	obmp_review.review_id,
//	obmp_review.giudizio_totale
//        )
//print_r($preno);
//
//
//[preno_id] => 113675
//            [hotel_id] => 2
//            [preno_in_data] => 2014-12-22 16:24:07
//            [preno_importo] => 51
//            [preno_impoto_mod] => 51
//            [preno_dal] => 2014-12-22
//            [preno_al] => 2014-12-23
//            [preno_n_notti] => 1
//            [preno_arr_ore] => 15
//            [preno_trattamento] => BB
//            [t1] => 1
//            [q1] => 1
//            [p1] => 51
//            [t2] => 0
//            [q2] => 0
//            [p2] => 0
//            [t3] => 0
//            [q3] => 0
//            [p3] => 0
//            [t4] => 0
//            [q4] => 0
//            [p4] => 0
//            [t5] => 0
//            [q5] => 0
//            [p5] => 0
//            [t6] => 0
//            [q6] => 0
//            [p6] => 0
//            [preno_nome] => massimo
//            [preno_cogno] => DE ROSSI
//            [preno_agenzia] => 279
//            [voucher_id] => 
//            [allotment_id] => 
//            [preno_cc_tip] => vi
//            [preno_cc_n] => 44443333222
//            [preno_cc_scad] => 11
//            [preno_tel] => 22 22 22
//            [preno_fax] => 
//            [preno_email] => INFO@HOTELLAURENTIA.COM
//            [preno_mercato] => 1
//            [preno_note] => 
//            [preno_doc_fax] => 
//            [preno_doc_email] => 
//            [preno_doc_form] => 1
//            [preno_doc_mail] => 
//            [preno_doc_vaglia] => 
//            [preno_doc_woucher] => 
//            [preno_pag_modalita] => 
//            [preno_caparra] => 
//            [preno_stato] => 1
//            [data_opzione] => 
//            [cancella_data_record] => 
//            [cancella_user] => 
//            [cancella_pass] => 
//            [preno_data_record] => 2014-12-22 16:24:49
//            [agenda_utente_id] => 999
//            [agenzia_id] => 279
//            [agenzia_tipologia] => IDS
//            [agenzia_nome] => MAX_OBMP
//            [agenzia_via] => 
//            [agenzia_citta] => 
//            [agenzia_state] => 
//            [agenzia_country] => Italy
//            [agenzia_cap] => 
//            [agenzia_tel] => 
//            [agenzia_fax] => 
//            [agenzia_email] => 
//            [agenzia_web] => 
//            [agenzia_par_iva] => 
//            [agenzia_par_cf] => 
//            [agenzia_referente] => 
//            [agenzia_banca_nome] => 
//            [agenzia_banca_iban] => 
//            [agenzia_banca_swift] => 
//            [agenzia_banca_iata] => 
//            [agenzia_cc_tipo] => 
//            [agenzia_cc_nome] => 
//            [agenzia_cc_numero] => 
//            [agenzia_cc_scadenza] => 
//            [agenzia_cc_cod_sicurezza] => 
//            [agenzia_login] => maxsdf
//            [agenzia_password] => 123032v
//            [agenzia_ab_web] => 0
//            [agenzia_ab_affiliati] => 1
//            [agenzia_ad_vis] => 0
//            [agenzia_ab_sospeso] => 0
//            [agenzia_data_record] => 2015-08-30 10:24:56
//            [agenzie_utente_id] => 
//            [Tot_cam] => 1
//            [Singola] => 1
//            [Doppia_Uso] => 0
//            [Doppia] => 0
//            [Matrimoniale] => 0
//            [Matri_Balcone] => 0
//            [Tripla] => 0
//            [Quadrupla] => 0
//            [Junior_Suit] => 0
//            [Quintupla] => 0
//
//print_r($lg_tipologia);
//
//
//
//(
//    [1] => stdClass Object
//        (
//            [agenzia_id] => 279
//            [obmp_cm_id] => 6
//            [hotel_id] => 1
//            [obmp_cm_rooms_attiva] => 1
//            [obmp_cm_rooms_tipologia_id] => 1
//            [obmp_cm_rooms_trattamento] => BB
//            [obmp_cm_rooms_max_pax] => 1
//            [obmp_cm_rooms_max_room] => 10
//            [obmp_cm_rooms_foto] => 
//            [obmp_cm_rooms_foto150] => images/singola_1.jpg
//            [obmp_cm_rooms_foto270] => 
//            [obmp_cm_rooms_foto700] => images/web_singola.jpg
//            [obmp_cm_rooms_room_note] => Singola
//            [obmp_cm_lingue_codice] => en
//            [obmp_cm_lingue_nome] => Single
//            [obmp_cm_lingue_descrizione] => 
//            [obmp_cm_lingue_html1] => Room for, 1 people one single beds ensuite soundproof with free high-speed Internet access direct dial phone, individually controlled air conditioning cable television and mini bar Breakfast included
//            [obmp_cm_lingue_html2] => <h6>Included in room price:</h6>
//<ul>
//  <li> Breakfast is included</li>
//  <li> Internet Corner and Wi Fi it is free.</li>
//  <li> 10% VAT.</li>
//</ul>
//<h6> Not included in room price:</h6>
//<ul>
//  <li> EUR 4 city tax per person per night.</li>
//  <li> Parking is not included.</li>
//  <li> The shuttle service is not included. </li>
//</ul>
//            [obmp_cm_lingue_html3] => 
//            [obmp_cm_lingue_note] => 
//            [obmp_cm_lingue_politiche] => 
//            [obmp_cm_lingue_condizioni] => 
//            [obmp_cm_rooms_id] => 51
//            [obmp_cm_lingue_id] => 14
//        )
?>
<?php foreach ($preno as $key => $row_new) { ?>
    <div>
        <fieldset> 
            <legend> Booking id : <?php echo $row_new->preno_id; ?>  </legend>
            <div class="row ">
                <div class="small-5 large-5 columns">
                    <img src="<?php echo base_url(); ?><?php echo $row_new->hotel_foto_piccola; ?>"/>
                </div>
                <div class="small-7 large-7 columns">
                    <h4>  <?php echo $row_new->hotel_tipologia; ?>  <?php echo $row_new->nome_hotel; ?></h4>
                    <p>
                    </p> 
                    <p>
                        IN: <?php echo $row_new->preno_dal; ?> <br>
                        OUT: <?php echo $row_new->preno_al; ?> <br>
                    </p>
                </div>
            </div>            
            <div class="row">
                <div class="small-12 large-12 columns">
                    <?php if ($row_new->q1) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q1; ?>  <img  align="right" title="<?php echo $lg_tipologia[$row_new->t1]->obmp_cm_lingue_nome; ?> " src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t1; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">
                                <h3><?php echo $lg_tipologia[$row_new->t1]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t1]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?> 
                    <?php if ($row_new->q2) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q2; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t2; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_new->t2]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t2]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?> 
                    <?php if ($row_new->q3) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q3; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t3; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_new->t3]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t3]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?> 
                    <?php if ($row_new->q4) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q4; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t4; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_new->t4]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t4]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?> 
                    <?php if ($row_new->q5) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q5; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t5; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_new->t5]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t5]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?>            
                    <?php if ($row_new->q6) { ?> 
                        <div class="row  ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_new->q6; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_new->t6; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_new->t6]->obmp_cm_lingue_nome; ?>  </h3>
                                <?php echo $lg_tipologia[$row_new->t6]->obmp_cm_lingue_html1; ?> 
                            </div> 
                        </div>   
                    <?php } ?>            
                    <br>
                    <p></p>
                    <a href="#" data-reveal-id="firstModal" class="radius button">Cancella</a>
                    <a href="#" data-reveal-id="secondModal" class="radius button">Modifica</a>
                </div>
            </div>
            
            <!-- Reveal Modals begin -->
            <div id="secondModal" class="reveal-modal" data-reveal aria-labelledby="secondModalTitle" aria-hidden="true" role="dialog">
                <h2 id="secondModalTitle">This is a modal.</h2>
                <div class="row">
                    <div class="large-3 columns">
                        <p>
                            <?php echo lang('check_in', 'Check-in'); ?> 
                            <?php echo form_error('check_in'); ?>
                            <input id="preno_dal" type="text" name="preno_dal" value="<?php echo $row_new->preno_dal; ?>"  />
                        </p>
                    </div>
                    <div class="large-3 columns">
                        <?php echo lang('check_out', 'Check-out'); ?> 
                        <?php echo form_error('check_out'); ?>
                        <input id="preno_al" type="text" name="preno_al"   value="<?php echo  $row_new->preno_al; ?>"  />
                    </div>
                    <div  class="large-3 columns"> 
                        <p> 
                            <a href="#"  id="aggiorna_preno"  class="button right">Default Button</a>
                        </p>
                    </div>
                </div>
                <div id="new_preno"></div>
                
                   <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
            
            
            
            <!-- Triggers the modals -->
            <!-- Cancella Preno -->
            <div id="firstModal" class="reveal-modal" data-reveal aria-labelledby="firstModalTitle" aria-hidden="true" role="dialog">
                <h2 id="firstModalTitle">Cancella Prenotazione</h2>
                <p>
                    <!--  agenda_edit.php  -->
                <fieldset>
                    <?php echo form_error('preno_stato'); ?>
                    <legend>Agenda:</legend>	
                    <?php
// Change the css classes to suit your needs    
                    $attributes = array('class' => '', 'id' => '');
                    echo form_open(uri_string() . '?' . $_SERVER['QUERY_STRING'], $attributes);
                    ?>     
                    <p> </p>
                    Qual è il motivo principale della cancellazione?<br>
                    La risposta è facoltativa, ma rispondendo ci aiuterai a fornirti un servizio sempre migliore <br>
                    <input type="radio" name="motivo" value="1" id="motivo1" /> <label for="motivo1"> Ho trovato un posto migliore in cui soggiornare </label>  <br>
                    <input type="radio" name="motivo" value="2" id="motivo2"  /> <label for="motivo1">Ho trovato un tariffa migliore in su un altro sito </label><br>
                    <input type="radio" name="motivo" value="3" id="motivo3"  /> <label for="motivo1">Devo modificare i dettagli della mia prenotazione </label><br>
                    <input type="radio" name="motivo" value="4" id="motivo4"  /> <label for="motivo1">Non devo più andare in questa destinazione</label><br>
                    <input type="radio" name="motivo" value="5" id="motivo5"  /> <label for="motivo1">Motivi personali </label><br>
                    <label class="inline" for="preno_stato" >Si voglio cancellare questa Prenotazione
                        <div class="switch round">
                            <input id="preno_stato" type="checkbox" name="preno_stato" value="9"  >
                            <label for="preno_stato"></label>  
                        </div>
                    </label>
                    <input id="agenda_utente_id" type="hidden" name="agenda_utente_id"  value="<?php echo (!set_value('agenda_utente_id')) ? $preno[0]->agenda_utente_id : set_value('agenda_utente_id'); ?>"  />
                    <p>
                        <?php echo form_submit('submit', 'Cancella', 'class="button"'); ?>
                    </p>
                    <?php echo form_close(); ?>
                </fieldset>  
                <p></p>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
        </fieldset>
    </div>
<?php } ?>





<script>
    $(function () {
// Dal
        $("#preno_dal").datepicker({
            defaultDate: "",
            showButtonPanel: true,
            currentText: "Today",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#preno_al").datepicker("option", "minDate", selectedDate);
             // trovo i nuovi valori    
             var preno_dal = $('#preno_dal').val();
            var preno_al = $('#preno_al').val();
            $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_new->preno_id ?>&hotel_id=<?php echo $row_new->hotel_id ?>&conto_id=<?php echo $rs_clienti[0]->conto_id; ?>&clienti_id=<?php echo $rs_clienti[0]->clienti_id; ?>&lg=<?php echo $lg; ?>");

                
                
            }
        });
// Al
        $("#preno_al").datepicker({
            defaultDate: "+1d",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });

    });
</script>

<script>
    $(function () {
// aggiorna il div 
        $("#preno_al").change(function () {
            var preno_dal = $('#preno_dal').val();
            var preno_al = $('#preno_al').val();
            $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_new->preno_id ?>&hotel_id=<?php echo $row_new->hotel_id ?>&conto_id=<?php echo $rs_clienti[0]->conto_id; ?>&clienti_id=<?php echo $rs_clienti[0]->clienti_id; ?>&lg=<?php echo $lg; ?>");
        });
    });
</script> 


<script> 
    $(function () {
// aggiorna il div 
        $("#aggiorna_preno").click(function () {
            var preno_dal = $('#preno_dal').val();
            var preno_al = $('#preno_al').val();
            $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_new->preno_id ?>&hotel_id=<?php echo $row_new->hotel_id ?>&conto_id=<?php echo $rs_clienti[0]->conto_id; ?>&clienti_id=<?php echo $rs_clienti[0]->clienti_id; ?>&lg=<?php echo $lg; ?>");
        });
    });
</script> 

