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
//	
//	   agenzie.agenzia_nome,
//	agenzie.agenzia_tipologia,
//	agenzie.agenzia_id
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


?>

<div class="new_preno">
    <fieldset>
        <legend> NewPreno</legend>
        <?php foreach ($preno as $key => $row_new) { ?>
            <div>
                <fieldset>
                    <legend> Booking id : <?php echo $row_new->preno_id; ?></legend>
                    <div class="row">
                        <div class="small-5 large-5 columns">
                            <img src="<?php echo base_url(); ?><?php echo $row_new->hotel_foto_piccola; ?>"/>
                        </div>
                        <div class="small-7 large-7 columns">
                            <h4>  <?php echo $row_new->hotel_tipologia; ?>  <?php echo $row_new->nome_hotel; ?></h4>
                            <p>
                                <?php if ($row_new->agenzia_nome) { ?>  By <?php echo ($row_new->agenzia_nome ) . '<br>';
                        } ?>
                                IN: <?php echo $row_new->preno_dal; ?> <br>
                                OUT: <?php echo $row_new->preno_al; ?> <br>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-12 columns">
                            <a href="<?php echo base_url(); ?>/index.php/clienti/bookings_edit/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>/<?php echo $row_new->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button success small right">Amministra Preno </a>
                        </div>
                    </div>
                </fieldset>
            </div>
        <?php } ?>

    </fieldset>
</div>














<div class="old_preno">
    <fieldset>
        <legend> Old Preno</legend>
        




<?php foreach ($conti_old as $key => $row) { ?>
    <div>
        <fieldset>
            <legend> Booking id : <?php echo $row->preno_id; ?></legend>
            <div class="row box_cancellata ">
                
               
                    
               
                <div class="small-5 large-5 columns">
                    <img src="<?php echo base_url(); ?><?php echo $row->hotel_foto_piccola; ?>"/>
                </div>
                <div class="small-7 large-7 columns">
                    <h4>  <?php echo $row->hotel_tipologia; ?>  <?php echo $row->nome_hotel; ?></h4>
                    <p>
                        ROOM: <?php echo $row->numero_camera; ?> 
                    </p> 
           
                      
                    <p>
                        <?php if($row->agenzia_nome ){?>  By <?php echo ($row->agenzia_nome ) . '<br>'; } ?>
                        
                        IN: <?php echo $row->in_conto; ?> <br>
                        OUT: <?php echo $row->out_conto; ?> <br>
                    </p>
                    </div>
                    </div>
                    <div class="row">
                        <?php if (!isset($row->review_id)) { ?>
                        
                            <div class="small-12 large-12 columns">
                                <a href="<?php echo base_url(); ?>index.php/obmp_review/insert/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>?lg=<?php echo $this->lg; ?>  " class="button small round right">Scrivi Review</a>
                            </div>
                            <?php } else { ?>
                            <div class="small-12 large-12 columns">
                                <a href="<?php echo base_url(); ?>index.php/obmp_review/edit/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>?lg=<?php echo $this->lg; ?> " class="button small success round right">You Review </a>
                                <a href="<?php echo base_url(); ?>index.php/clienti/bookings_edit/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>/<?php  echo  $row->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button success small ">Amministra Preno </a>

                            
                            
                            </div>
                         <?php } ?>
                    </div>
                
            
        </fieldset>
    </div>
<?php } ?>

            </fieldset>

 </div>
