<?php
// print_r($cliente); 
/**
  [conto_id] => 22524
  [hotel_id] => 1
  [foglio_id] => 23785
  [clienti_id] => 8670
  [in_conto] => 2006-11-13
  [out_preno] => 2006-11-15
  [out_conto] => 2006-11-15
  [preno_id] => 12051
  [camera_id] => 154
  [numero_camera] => 64
  [trattamento_sog] => BB
  [tipo_camera] => Doppia
  [tipologia_id] => 2
  [prezzo] => 115
  [clienti_nome] => KARIN ASTRID
  [clienti_cogno] => DEL MEDICO
  [cliente_nato_a] => DEUTCH-KRONE
  [cliente_nato_il] => 05/06/2034
  [cliente_nazione] => Germany
  [cliente_provincia] =>
  [cliente_residenza] =>
  [cliente_sesso] => F
  [clienti_nome1] => BEATRICE ARIANNA
  [clienti_cogno1] => DEL MEDICO
 */
?>
<?php  
//print_r($review);  

//[Clean] => 10
//    [Comfort] => 4.0000
//    [Location] => 8
//    [Services] => 8.0000
//    [Staff] => 6.0000
//    [Value_for_money] => 8
//    [Total_score] => 10
//    [review_id] => 1104
//    [hotel_id] => 3
//    [preno_id] => 128768
//    [conto_id] => 231838
//    [postazione_id] => 128768
//    [nome] => cinardo
//    [stato] => 7
//    [user_type] => 3
//    [Rumore_camere] => 6
//    [Spazio_camera] => 4
//    [Spazi_comuni] => 2
//    [Dintorni] => 8
//    [Qualita_servizi] => 6
//    [Colazione] => 10
//    [Accoglienza] => 8
//    [Competenza_impiegati] => 4
//    [Prezzo_qualita] => 8
//    [Giudizio_totale] => 10
//    [Raccomandi] => 2
//    [commento_tex] => Hotel pulito e confortevole, vicino a stazione Termini e Università La Sapienza: quello che ci serviva! Colazione a buffet, buona varietà e qualità . Personale cortese e disponibile. Collegamenti con mezzi pubblici per il centro. Nel quartiere San Lorenzo, molti locali per la sera.
//    [ip_review] => 79.58.247.98
//    [data_review] => 2016-07-23
//    [review_data_record] => 2016-07-23 12:46:21
//    [numero_camera] => 310
//    [agenzia_nome] => Booking.com
//    [preno_agenzia] => 596
//    [clienti_nome] => salvatore
//    [clienti_cogno] => cinardo
//    [cliente_nazione] => Italia
//    [Nazioni_Descrizione] => 


//print_r($albergo) ;

?>

<!--  obmp_review_add.php  -->

<?php if (empty($review->Total_score) && !empty($cliente->clienti_cogno)) { ?>


    <fieldset>
        <legend><?php echo $this->lang->line('obmp_review'); ?>  <?php echo $this->lang->line("room_numbar"); ?> # <?php echo $cliente->numero_camera; ?> </legend>		

        <h3> <?php echo $this->lang->line('ms&mr'); ?> <?php echo $cliente->clienti_nome; ?> <?php echo $cliente->clienti_cogno; ?> </h3> 
        <?php echo $this->lang->line('tell_us_tex'); ?>

        <?php
// Change the css classes to suit your needs    
        $attributes = array('class' => '', 'id' => '');
        echo form_open(uri_string() . '?' . $_SERVER['QUERY_STRING'], $attributes);
        ?>   

        <fieldset>
            <legend><?php echo $this->lang->line('pro_car'); ?></legend>
            <p>
                <?php echo lang('pulizia_camera', 'pulizia_camera'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="pulizia_camera2"  title="<?php echo $this->lang->line('POOR'); ?>"  name="pulizia_camera" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('pulizia_camera', '2'); ?> />
                <input id="pulizia_camera3" title="<?php echo $this->lang->line('BELOWAVG'); ?>"   name="pulizia_camera" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('pulizia_camera', '4'); ?> />
                <input id="pulizia_camera4"  title="<?php echo $this->lang->line('AVEREGE'); ?>"   name="pulizia_camera" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('pulizia_camera', '6'); ?> />
                <input id="pulizia_camera5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="pulizia_camera" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('pulizia_camera', '8'); ?> />
                <input id="pulizia_camera6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="pulizia_camera" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('pulizia_camera', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('pulizia_camera'); ?>
            </p>
            <p>
                <?php echo lang('accoglienza', 'accoglienza'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="accoglienza2" title="<?php echo $this->lang->line('POOR'); ?>" name="accoglienza" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('accoglienza', '2'); ?> />
                <input id="accoglienza3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="accoglienza" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('accoglienza', '4'); ?> />
                <input id="accoglienza4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="accoglienza" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('accoglienza', '6'); ?> />
                <input id="accoglienza5" title="<?php echo $this->lang->line('GOOD'); ?>" name="accoglienza" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('accoglienza', '8'); ?> />
                <input id="accoglienza6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="accoglienza" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('accoglienza', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('accoglienza'); ?>
            </p>
            <p>
                <?php echo lang('rumore_camere', 'rumore_camere'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="rumore_camere2" title="<?php echo $this->lang->line('POOR'); ?>" name="rumore_camere" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('rumore_camere', '2'); ?> />
                <input id="rumore_camere3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="rumore_camere" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('rumore_camere', '4'); ?> />
                <input id="rumore_camere4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="rumore_camere" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('rumore_camere', '6'); ?> />
                <input id="rumore_camere5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="rumore_camere" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('rumore_camere', '8'); ?> />
                <input id="rumore_camere6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="rumore_camere" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('rumore_camere', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('rumore_camere'); ?>
            </p>
            <p>
                <?php echo lang('spazio_camera', 'spazio_camera'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="spazio_camera2" title="<?php echo $this->lang->line('POOR'); ?>" name="spazio_camera" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('spazio_camera', '2'); ?> />
                <input id="spazio_camera3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="spazio_camera" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('spazio_camera', '4'); ?> />
                <input id="spazio_camera4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="spazio_camera" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('spazio_camera', '6'); ?> />
                <input id="spazio_camera5" title="<?php echo $this->lang->line('GOOD'); ?>" name="spazio_camera" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('spazio_camera', '8'); ?> />
                <input id="spazio_camera6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="spazio_camera" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('spazio_camera', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('spazio_camera'); ?>
            </p>
            <p>
                <?php echo lang('spazi_comuni', 'spazi_comuni'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="spazi_comuni2" title="<?php echo $this->lang->line('POOR'); ?>" name="spazi_comuni" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('spazi_comuni', '2'); ?> />
                <input id="spazi_comuni3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="spazi_comuni" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('spazi_comuni', '4'); ?> />
                <input id="spazi_comuni4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="spazi_comuni" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('spazi_comuni', '6'); ?> />
                <input id="spazi_comuni5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="spazi_comuni" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('spazi_comuni', '8'); ?> />
                <input id="spazi_comuni6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="spazi_comuni" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('spazi_comuni', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('spazi_comuni'); ?>
            </p>
            <p>
                <?php echo lang('competenza_impiegati', 'competenza_impiegati'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="competenza_impiegati2" title="<?php echo $this->lang->line('POOR'); ?>" name="competenza_impiegati" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('competenza_impiegati', '2'); ?> />
                <input id="competenza_impiegati3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="competenza_impiegati" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('competenza_impiegati', '4'); ?> />
                <input id="competenza_impiegati4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="competenza_impiegati" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('competenza_impiegati', '6'); ?> />
                <input id="competenza_impiegati5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="competenza_impiegati" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('competenza_impiegati', '8'); ?> />
                <input id="competenza_impiegati6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="competenza_impiegati" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('competenza_impiegati', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('competenza_impiegati'); ?>
            </p>
            <p>
                <?php echo lang('qualita_servizi', 'qualita_servizi'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="qualita_servizi2" title="<?php echo $this->lang->line('POOR'); ?>" name="qualita_servizi" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('qualita_servizi', '2'); ?> />
                <input id="qualita_servizi3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="qualita_servizi" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('qualita_servizi', '4'); ?> />
                <input id="qualita_servizi4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="qualita_servizi" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('qualita_servizi', '6'); ?> />
                <input id="qualita_servizi5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="qualita_servizi" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('qualita_servizi', '8'); ?> />
                <input id="qualita_servizi6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="qualita_servizi" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('qualita_servizi', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('qualita_servizi'); ?>
            </p>
            <p>
                <?php echo lang('dintorni', 'dintorni'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="dintorni2"  title="<?php echo $this->lang->line('POOR'); ?>" name="dintorni" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('dintorni', '2'); ?> />
                <input id="dintorni3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="dintorni" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('dintorni', '4'); ?> />
                <input id="dintorni4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="dintorni" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('dintorni', '6'); ?> />
                <input id="dintorni5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="dintorni" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('dintorni', '8'); ?> />
                <input id="dintorni6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="dintorni" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('dintorni', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('dintorni'); ?>
            </p>
            <p>
                <?php echo lang('colazione', 'colazione'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="colazione2" title="<?php echo $this->lang->line('POOR'); ?>" name="colazione" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('colazione', '2'); ?> />
                <input id="colazione3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="colazione" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('colazione', '4'); ?> />
                <input id="colazione4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="colazione" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('colazione', '6'); ?> />
                <input id="colazione5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="colazione" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('colazione', '8'); ?> />
                <input id="colazione6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="colazione" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('colazione', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('colazione'); ?>
            </p>
        </fieldset>
        <fieldset>
            <legend><?php echo $this->lang->line('gen_rew'); ?> </legend>
            <p>
                <?php echo lang('giudizio_totale', 'giudizio_totale'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="giudizio_totale2" title="<?php echo $this->lang->line('POOR'); ?>" name="giudizio_totale" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('giudizio_totale', '2'); ?> />
                <input id="giudizio_totale3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="giudizio_totale" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('giudizio_totale', '4'); ?> />
                <input id="giudizio_totale4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="giudizio_totale" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('giudizio_totale', '6'); ?> />
                <input id="giudizio_totale5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="giudizio_totale" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('giudizio_totale', '8'); ?> />
                <input id="giudizio_totale6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="giudizio_totale" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('giudizio_totale', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('giudizio_totale'); ?>
            </p>
        </fieldset>
        <fieldset>
            <legend><?php echo $this->lang->line('qual_pre'); ?></legend>
            <p>
                <?php echo lang('prezzo_qualita', 'prezzo_qualita'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="prezzo_qualita2" title="<?php echo $this->lang->line('POOR'); ?>" name="prezzo_qualita" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('prezzo_qualita', '2'); ?> />
                <input id="prezzo_qualita3" title="<?php echo $this->lang->line('BELOWAVG'); ?>"  name="prezzo_qualita" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('prezzo_qualita', '4'); ?> />
                <input id="prezzo_qualita4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="prezzo_qualita" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('prezzo_qualita', '6'); ?> />
                <input id="prezzo_qualita5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="prezzo_qualita" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('prezzo_qualita', '8'); ?> />
                <input id="prezzo_qualita6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="prezzo_qualita" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('prezzo_qualita', '10'); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('prezzo_qualita'); ?>
            </p>
        </fieldset>
        <fieldset>
            <legend> <?php echo $this->lang->line('scr_com'); ?> </legend>
            <p>
                <?php echo $this->lang->line('max400'); ?>
                <?php echo lang('commento_tex', 'commento_tex'); ?>
                <?php echo form_error('commento_tex'); ?>						
    <?php echo form_textarea(array('name' => 'commento_tex', 'rows' => '5', 'cols' => '80', 'value' => set_value('commento_tex'))) ?>
            </p>
        </fieldset>
        <p>
         <?php echo lang('raccomandi', 'raccomandi'); ?>   
            <?php echo $this->lang->line('yes'); ?>
            <input id="raccomandi2" name="raccomandi" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('raccomandi', '10'); ?> />
         <br>
    <?php echo $this->lang->line('no'); ?> 

            <input id="raccomandi6" name="raccomandi" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('raccomandi', '2'); ?> /> 
    <?php echo form_error('raccomandi'); ?> 
        </p>
        <p>
            <?php echo lang('user_type', 'user_type'); ?>
            <?php // Change the values in this array to populate your dropdown as required ?>
            <?php
                $options = array(
                '' => $this->lang->line('User_type_a'),
                1 => $this->lang->line('User_type_b'),
                2 => $this->lang->line('User_type_c'),
                3 => $this->lang->line('User_type_d') ,
                4 =>  $this->lang->line('User_type_e'),
                5 => $this->lang->line('User_type_f'),
                6 => $this->lang->line('User_type_g'),
                7 => $this->lang->line('User_type_h')
                       )

            ?>
            
            
            <?php echo form_dropdown('user_type', $options, set_value('user_type')) ?>
    <?php echo form_error('user_type'); ?>
        </p>  
        <input id="review_id" type="hidden" name="review_id"  value="<?php echo set_value('review_id'); ?>">  
        <input id="hotel_id" type="hidden" name="hotel_id"  value="<?php echo $cliente->hotel_id; ?>">
        <input id="preno_id" type="hidden" name="preno_id"  value="<?php echo $cliente->preno_id; ?>">
        <input id="conto_id" type="hidden" name="conto_id"  value="<?php echo $cliente->conto_id; ?>" >
        <input id="postazione_id" type="hidden" name="postazione_id"  value="<?php echo $cliente->preno_id; ?>">  
        <input id="camera_numero" type="hidden" name="camera_numero"  value="<?php echo $cliente->camera_id; ?>" > 
        <input id="nome" type="hidden" name="nome"  value="<?php echo $cliente->clienti_cogno; ?>"  >     
        <input id="ip_review" type="hidden" name="ip_review"  value="<?php echo $this->input->ip_address(); ?>"  />
        <input id="data_review" type="hidden" name="data_review"  value="<?php echo date('Y-m-d') ?>"  />
        <input id="review_data_record" type="hidden" name="review_data_record"  value="">  
        <input id="servizi_offerti" type="hidden" name="servizi_offerti"  value="1"  >
        <input id="tariffa" type="hidden" name="tariffa"  value="1"  >
        <input id="foto" type="hidden" name="foto"  value="1" > 
        <input id="indicazione_mappa" type="hidden" name="indicazione_mappa"  value="1">
        <input id="stato" type="hidden" name="stato"  value="7">  		

        <p>
        <?php echo form_submit('submit', 'Submit', 'class="button"'); ?>
        </p>
    <?php echo form_close(); ?>
    </fieldset>

<?php
}


// se ho gi acompilatoi form


if (!empty($review->Total_score) && !empty($cliente->clienti_cogno)) {
    ?>
   
<fieldset>
        <legend><?php echo $this->lang->line('obmp_review'); ?>  <?php echo $this->lang->line("room_numbar"); ?> # <?php echo $cliente->numero_camera; ?> </legend>	


        <div class="row" >
  


            <h2><?php echo $this->lang->line('thank_rev'); ?></h2> 

            <div class="large-6 small-12  columns">
                <!--    risultati-->
                <!-- quadrato -->
                <fieldset>
                    <legend> <?php echo $this->lang->line('room_numbar'); ?> : <?php echo $review->numero_camera; ?> </legend>
                    
                    <div class="row">
                        <div class="large-12   columns">
                            <div class="row">  
                                <div class="large-6 small-4  columns">
                                    <h3> <?php echo $this->lang->line('rev_Totel'); ?> </h3> 
                                </div>
                                <div class="large-6 small-8  columns">
                                    <h2><?php echo round($review->Total_score, 2); ?></h2> 
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Clean'); ?>:
                        </div>
                        <div class="large-6  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review->Clean * 10; ?>%;" > <?php echo round($review->Clean, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Comfort'); ?>:
                        </div>
                        <div class="large-6  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review->Comfort * 10; ?>%;" > <?php echo round($review->Comfort, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Location'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review->Location * 10; ?>%;"  > <?php echo round($review->Location, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Services'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review->Services * 10; ?>%;"  > <?php echo round($review->Services, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6  small-4  columns">
    <?php echo $this->lang->line('rev_Staff'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review->Staff * 10; ?>%;"  > <?php echo round($review->Staff, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_ValQua'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review->Value_for_money * 10; ?>%;"  > <?php echo round($review->Value_for_money, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Raccomandi'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <img src="<?php echo base_url(); ?>asset/img/images<?php echo ($review->Raccomandi == 10 ) ? 'Ok' : 'Ko'; ?>.png" width="30" height="30" alt="<?php echo $review->Raccomandi; ?>"/>
                        </div>
                    </div>
                    <blockquote><?php echo $review->commento_tex; ?></blockquote>
                </fieldset>
            </div>
            
            <div class="large-6 small-12  columns"  >
                <!--    wiget tripavisor-->
                <fieldset> 

                    <legend>Data : <?php echo $review->data_review; ?> </legend>


                    <?php
                    // si mostra il formo di tripavisor per i giudizzi positivi 
                    //   thank_rev

                    if (($review->Raccomandi >= 8) && ($review->Total_score >= 7)) {
                        ?>
                        <?php echo '<p>' . $this->lang->line('tell_thank_tex') . '</p>'; ?>
                        <?php if ($hotel_id == 4) { ?>
                            <div id="TA_cdswritereviewlg592" class="TA_cdswritereviewlg">
                                <ul id="KbYA4eNTp3" class="TA_links DmPufR">
                                    <li id="PlrbaSKK" class="RtW9VvSpI">Review <a  href="http://www.tripadvisor.com/Hotel_Review-g187791-d259742-Reviews-Ateneo_Garden_Palace_Hotel-Rome_Lazio.html">Ateneo Garden Palace Hotel</a></li>
                                </ul>
                            </div>
                            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=592&amp;locationId=259742&amp;lang=en_US"></script>
                        <?php } ?>
                        <?php if ($hotel_id == 2) { ?>
                            <div id="TA_cdswritereviewlg899" class="TA_cdswritereviewlg">
                                <ul id="HQeyZtxE84vK" class="TA_links qZ9U158Xj">
                                    <li id="a18LRxA" class="4NWFWzK">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d280226-Reviews-Hotel_Laurentia-Rome_Lazio.html">Hotel Laurentia</a></li>
                                </ul>
                            </div>
                            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=899&amp;locationId=280226&amp;lang=en_UK"></script>
                        <?php } ?>
                        <?php if ($hotel_id == 1) { ?>
                            <div id="TA_cdswritereviewlg233" class="TA_cdswritereviewlg">
                                <ul id="EZNshY4" class="TA_links r04cwBBhbK">
                                    <li id="pb07WqB0UlI" class="xJSoOy">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d258996-Reviews-Hotel_La_Pergola-Rome_Lazio.html">Hotel La Pergola</a></li>
                                </ul>
                            </div>
                            <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=233&amp;locationId=258996&amp;lang=en_UK"></script>
                        <?php } ?>
                        <?php if ($hotel_id == 3) { ?>
                            <div id="TA_cdswritereviewlg398" class="TA_cdswritereviewlg">
                                <ul id="DFZ1C6ewL" class="TA_links 1PVIgUQnBBV">
                                    <li id="X9Id2Kdrs7VL" class="QaDj0ZleMzoG">Review <a  href="http://www.tripadvisor.co.uk/Hotel_Review-g187791-d203196-Reviews-Albergo_Carlo_Magno_Hotel-Rome_Lazio.html">Albergo Carlo Magno Hotel</a></li>
                                </ul>
                            </div>
                            <p>
                                <script src="http://www.jscache.com/wejs?wtype=cdswritereviewlg&amp;uniq=398&amp;locationId=203196&amp;lang=en_UK"></script>
                            <?php } ?>
                        <?php
                        } else {
                            echo '<p>' . $this->lang->line('thank_rev') . '</p>';
                        }
                        ?>    



                </fieldset>
            </div>
            
        </div>


        <!--    media review-->
        <div class="row"> 
            <div  class="large-12 small-12 columns"   >
                <fieldset>
                    <legend> <?php echo $this->lang->line('rev_avg'); ?>: </legend>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_Totel'); ?>:
                        </div>
                        <div class="large-8  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review_avg['0']->Total_score * 10; ?>%;" > <?php echo round($review_avg['0']->Total_score, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_Clean'); ?>:
                        </div>
                        <div class="large-8  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review_avg['0']->Clean * 10; ?>%;" > <?php echo round($review_avg['0']->Clean, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_Comfort'); ?>:
                        </div>
                        <div class="large-8  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review_avg['0']->Comfort * 10; ?>%;" > <?php echo round($review_avg['0']->Comfort, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_Location'); ?>:
                        </div>
                        <div class="large-8 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review_avg['0']->Location * 10; ?>%;"  > <?php echo round($review_avg['0']->Location, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_Services'); ?>:
                        </div>
                        <div class="large-8 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review_avg['0']->Services * 10; ?>%;"  > <?php echo round($review_avg['0']->Services, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4  small-4  columns">
    <?php echo $this->lang->line('rev_Staff'); ?>:
                        </div>
                        <div class="large-8 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review_avg['0']->Staff * 10; ?>%;"  > <?php echo round($review_avg['0']->Staff, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-4 small-4   columns">
    <?php echo $this->lang->line('rev_ValQua'); ?>:
                        </div>
                        <div class="large-8 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review_avg['0']->Value_for_money * 10; ?>%;"  > <?php echo round($review_avg['0']->Value_for_money, 2); ?> </div>
                        </div>
                    </div>
            </div>
        </div>
        <!--  /  -->


    </fieldset>
<?php } ?>
