<!--  obmp_review_add.php  -->

<?php // if (empty($rs_obmp_review->Total_score) && !empty($rs_client->iclienti_cogno)) {


 // print_r($rs_obmp_review);

?>



<?php // Change or Add the radio values/labels/css classes to suit your needs ?>

    <fieldset>
        <legend><?php echo $this->lang->line('obmp_review'); ?>  <?php echo $this->lang->line("room_numbar"); ?> # <?php echo $rs_clienti[0]->numero_camera; ?> </legend>		

        <h3> <?php echo $this->lang->line('ms&mr'); ?> <?php echo $rs_clienti[0]->clienti_nome; ?> <?php  echo $rs_clienti[0]->clienti_cogno; ?> </h3> 

        <?php
        

        // Change the css classes to suit your needs    
        $attributes = array('class' => '', 'id' => '');
        echo form_open(uri_string() . '?' . $_SERVER['QUERY_STRING'], $attributes);
        ?>   

        <fieldset>
            <legend><?php echo $this->lang->line('pro_car'); ?>   </legend> 
            <p>
                <?php echo lang('pulizia_camera', 'pulizia_camera'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="pulizia_camera2"  title="<?php echo $this->lang->line('POOR'); ?>"  name="pulizia_camera" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('pulizia_camera', '2', $rs_obmp_review->pulizia_camera === '2' ? TRUE : FALSE  ); ?> />
                <input id="pulizia_camera3" title="<?php echo $this->lang->line('BELOWAVG'); ?>"   name="pulizia_camera" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('pulizia_camera', '4', $rs_obmp_review->pulizia_camera === "4" ? TRUE : FALSE); ?> />
                <input id="pulizia_camera4"  title="<?php echo $this->lang->line('AVEREGE'); ?>"   name="pulizia_camera" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('pulizia_camera', '6', $rs_obmp_review->pulizia_camera === "6" ? TRUE : FALSE); ?> />
                <input id="pulizia_camera5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="pulizia_camera" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('pulizia_camera', '8', $rs_obmp_review->pulizia_camera === "8" ? TRUE : FALSE); ?> />
                <input id="pulizia_camera6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="pulizia_camera" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('pulizia_camera', '10', $rs_obmp_review->pulizia_camera === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('pulizia_camera'); ?>
            </p>
            
       
            
            <p>
                <?php echo lang('accoglienza', 'accoglienza'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="accoglienza2" title="<?php echo $this->lang->line('POOR'); ?>" name="accoglienza" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('accoglienza', '2', $rs_obmp_review->accoglienza === "2" ? TRUE : FALSE); ?> />
                <input id="accoglienza3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="accoglienza" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('accoglienza', '4', $rs_obmp_review->accoglienza === "4" ? TRUE : FALSE); ?> />
                <input id="accoglienza4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="accoglienza" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('accoglienza', '6', $rs_obmp_review->accoglienza === "8" ? TRUE : FALSE); ?> />
                <input id="accoglienza5" title="<?php echo $this->lang->line('GOOD'); ?>" name="accoglienza" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('accoglienza', '8', $rs_obmp_review->accoglienza === "8" ? TRUE : FALSE); ?> />
                <input id="accoglienza6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="accoglienza" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('accoglienza', '10', $rs_obmp_review->accoglienza === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('accoglienza'); ?>
            </p>
            <p>
                <?php echo lang('rumore_camere', 'rumore_camere'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="rumore_camere2" title="<?php echo $this->lang->line('POOR'); ?>" name="rumore_camere" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('rumore_camere', '2', $rs_obmp_review->rumore_camere === "2" ? TRUE : FALSE ); ?> />
                <input id="rumore_camere3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="rumore_camere" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('rumore_camere', '4',$rs_obmp_review->rumore_camere === "4" ? TRUE : FALSE); ?> />
                <input id="rumore_camere4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="rumore_camere" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('rumore_camere', '6',$rs_obmp_review->rumore_camere === "6" ? TRUE : FALSE); ?> />
                <input id="rumore_camere5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="rumore_camere" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('rumore_camere', '8',$rs_obmp_review->rumore_camere === "8" ? TRUE : FALSE); ?> />
                <input id="rumore_camere6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="rumore_camere" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('rumore_camere', '10',$rs_obmp_review->rumore_camere === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('rumore_camere'); ?>
            </p>
            <p>
                <?php echo lang('spazio_camera', 'spazio_camera'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="spazio_camera2" title="<?php echo $this->lang->line('POOR'); ?>" name="spazio_camera" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('spazio_camera', '2', $rs_obmp_review->spazio_camera === "2" ? TRUE : FALSE); ?> />
                <input id="spazio_camera3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="spazio_camera" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('spazio_camera', '4', $rs_obmp_review->spazio_camera === "4" ? TRUE : FALSE); ?> />
                <input id="spazio_camera4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="spazio_camera" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('spazio_camera', '6', $rs_obmp_review->spazio_camera === "6" ? TRUE : FALSE); ?> />
                <input id="spazio_camera5" title="<?php echo $this->lang->line('GOOD'); ?>" name="spazio_camera" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('spazio_camera', '8', $rs_obmp_review->spazio_camera === "8" ? TRUE : FALSE); ?> />
                <input id="spazio_camera6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="spazio_camera" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('spazio_camera', '10', $rs_obmp_review->spazio_camera === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('spazio_camera'); ?>
            </p>
            <p>
                <?php echo lang('spazi_comuni', 'spazi_comuni'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="spazi_comuni2" title="<?php echo $this->lang->line('POOR'); ?>" name="spazi_comuni" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('spazi_comuni', '2', $rs_obmp_review->spazi_comuni === "2" ? TRUE : FALSE ); ?> />
                <input id="spazi_comuni3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="spazi_comuni" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('spazi_comuni', '4', $rs_obmp_review->spazi_comuni === "4" ? TRUE : FALSE ); ?> />
                <input id="spazi_comuni4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="spazi_comuni" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('spazi_comuni', '6', $rs_obmp_review->spazi_comuni === "6" ? TRUE : FALSE ); ?> />
                <input id="spazi_comuni5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="spazi_comuni" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('spazi_comuni', '8', $rs_obmp_review->spazi_comuni === "8" ? TRUE : FALSE ); ?> />
                <input id="spazi_comuni6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="spazi_comuni" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('spazi_comuni', '10', $rs_obmp_review->spazi_comuni === "10" ? TRUE : FALSE ); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('spazi_comuni'); ?>
            </p>
            <p>
                <?php echo lang('competenza_impiegati', 'competenza_impiegati'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="competenza_impiegati2" title="<?php echo $this->lang->line('POOR'); ?>" name="competenza_impiegati" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('competenza_impiegati', '2', $rs_obmp_review->competenza_impiegati === "2" ? TRUE : FALSE  ); ?> />
                <input id="competenza_impiegati3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="competenza_impiegati" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('competenza_impiegati', '4' , $rs_obmp_review->competenza_impiegati === "4" ? TRUE : FALSE ); ?> />
                <input id="competenza_impiegati4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="competenza_impiegati" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('competenza_impiegati', '6', $rs_obmp_review->competenza_impiegati === "6" ? TRUE : FALSE ); ?> />
                <input id="competenza_impiegati5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="competenza_impiegati" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('competenza_impiegati', '8', $rs_obmp_review->competenza_impiegati === "8" ? TRUE : FALSE ); ?> />
                <input id="competenza_impiegati6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="competenza_impiegati" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('competenza_impiegati', '10', $rs_obmp_review->competenza_impiegati === "10" ? TRUE : FALSE ); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('competenza_impiegati'); ?>
            </p>
            <p>
                <?php echo lang('qualita_servizi', 'qualita_servizi'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="qualita_servizi2" title="<?php echo $this->lang->line('POOR'); ?>" name="qualita_servizi" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('qualita_servizi', '2', $rs_obmp_review->qualita_servizi === "2" ? TRUE : FALSE  ); ?> />
                <input id="qualita_servizi3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="qualita_servizi" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('qualita_servizi', '4', $rs_obmp_review->qualita_servizi === "4" ? TRUE : FALSE ); ?> />
                <input id="qualita_servizi4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="qualita_servizi" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('qualita_servizi', '6', $rs_obmp_review->qualita_servizi === "6" ? TRUE : FALSE ); ?> />
                <input id="qualita_servizi5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="qualita_servizi" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('qualita_servizi', '8', $rs_obmp_review->qualita_servizi === "8" ? TRUE : FALSE); ?> />
                <input id="qualita_servizi6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="qualita_servizi" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('qualita_servizi', '10', $rs_obmp_review->qualita_servizi === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('qualita_servizi'); ?>
            </p>
            <p>
                <?php echo lang('dintorni', 'dintorni'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="dintorni2"  title="<?php echo $this->lang->line('POOR'); ?>" name="dintorni" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('dintorni', '2', $rs_obmp_review->dintorni === "2" ? TRUE : FALSE ); ?> />
                <input id="dintorni3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="dintorni" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('dintorni', '4', $rs_obmp_review->dintorni === "4" ? TRUE : FALSE ); ?> />
                <input id="dintorni4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="dintorni" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('dintorni', '6', $rs_obmp_review->dintorni === "6" ? TRUE : FALSE); ?> />
                <input id="dintorni5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="dintorni" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('dintorni', '8', $rs_obmp_review->dintorni === "8" ? TRUE : FALSE); ?> />
                <input id="dintorni6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="dintorni" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('dintorni', '10', $rs_obmp_review->dintorni === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('dintorni'); ?>
            </p>
            <p>
                <?php echo lang('colazione', 'colazione'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="colazione2" title="<?php echo $this->lang->line('POOR'); ?>" name="colazione" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('colazione', '2', $rs_obmp_review->colazione === "2" ? TRUE : FALSE); ?> />
                <input id="colazione3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="colazione" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('colazione', '4', $rs_obmp_review->colazione === "4" ? TRUE : FALSE); ?> />
                <input id="colazione4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="colazione" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('colazione', '6', $rs_obmp_review->colazione === "6" ? TRUE : FALSE); ?> />
                <input id="colazione5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="colazione" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('colazione', '8', $rs_obmp_review->colazione === "8" ? TRUE : FALSE); ?> />
                <input id="colazione6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="colazione" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('colazione', '10', $rs_obmp_review->colazione === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?>
    <?php echo form_error('colazione'); ?>
            </p>
        </fieldset>
        <fieldset>
            <legend><?php echo $this->lang->line('gen_rew'); ?> </legend>
            <p>
                <?php echo lang('giudizio_totale', 'giudizio_totale'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="giudizio_totale2" title="<?php echo $this->lang->line('POOR'); ?>" name="giudizio_totale" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('giudizio_totale', '2', $rs_obmp_review->giudizio_totale === "2" ? TRUE : FALSE); ?> />
                <input id="giudizio_totale3" title="<?php echo $this->lang->line('BELOWAVG'); ?>" name="giudizio_totale" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('giudizio_totale', '4', $rs_obmp_review->giudizio_totale === "4" ? TRUE : FALSE ); ?> />
                <input id="giudizio_totale4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="giudizio_totale" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('giudizio_totale', '6', $rs_obmp_review->giudizio_totale === "6" ? TRUE : FALSE ); ?> />
                <input id="giudizio_totale5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="giudizio_totale" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('giudizio_totale', '8', $rs_obmp_review->giudizio_totale === "8" ? TRUE : FALSE ); ?> />
                <input id="giudizio_totale6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="giudizio_totale" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('giudizio_totale', '10', $rs_obmp_review->giudizio_totale === "10" ? TRUE : FALSE); ?> /> 
                <?php echo $this->lang->line('EXCELLENT'); ?> 
    <?php echo form_error('giudizio_totale'); ?>
            </p>
        </fieldset>
        <fieldset>
            <legend><?php echo $this->lang->line('qual_pre'); ?></legend>
            <p>
                <?php echo lang('prezzo_qualita', 'prezzo_qualita'); ?> <span class="required">*</span>
    <?php echo $this->lang->line('POOR'); ?>
                <input id="prezzo_qualita2" title="<?php echo $this->lang->line('POOR'); ?>" name="prezzo_qualita" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('prezzo_qualita', '2', $rs_obmp_review->prezzo_qualita === "2" ? TRUE : FALSE); ?> />
                <input id="prezzo_qualita3" title="<?php echo $this->lang->line('BELOWAVG'); ?>"  name="prezzo_qualita" type="radio" class="" value="4" <?php echo $this->form_validation->set_radio('prezzo_qualita', '4', $rs_obmp_review->prezzo_qualita === "4" ? TRUE : FALSE); ?> />
                <input id="prezzo_qualita4" title="<?php echo $this->lang->line('AVEREGE'); ?>" name="prezzo_qualita" type="radio" class="" value="6" <?php echo $this->form_validation->set_radio('prezzo_qualita', '6', $rs_obmp_review->prezzo_qualita === "6" ? TRUE : FALSE); ?> />
                <input id="prezzo_qualita5" title="<?php echo $this->lang->line('GOOD'); ?>"  name="prezzo_qualita" type="radio" class="" value="8" <?php echo $this->form_validation->set_radio('prezzo_qualita', '8', $rs_obmp_review->prezzo_qualita === "8" ? TRUE : FALSE); ?> />
                <input id="prezzo_qualita6" title="<?php echo $this->lang->line('EXCELLENT'); ?>" name="prezzo_qualita" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('prezzo_qualita', '10', $rs_obmp_review->prezzo_qualita === "10" ? TRUE : FALSE); ?> /> 
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
 	<?php echo form_textarea( array( 'name' => 'commento_tex', 'rows' => '5', 'cols' => '80', 'value' => ( !set_value('commento_tex'))   ? $rs_obmp_review->commento_tex : set_value('commento_tex') ) )?>               
            </p>
        </fieldset>
        <p>
         <?php echo lang('raccomandi', 'raccomandi'); ?>   
            <?php echo $this->lang->line('yes'); ?>
            <input id="raccomandi2" name="raccomandi" type="radio" class="" value="10" <?php echo $this->form_validation->set_radio('raccomandi', '2', $rs_obmp_review->raccomandi === "2" ? TRUE : FALSE ); ?> />
         <br>
    <?php echo $this->lang->line('no'); ?> 

            <input id="raccomandi6" name="raccomandi" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('raccomandi', '10', $rs_obmp_review->raccomandi === "10" ? TRUE : FALSE); ?> /> 
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
              
              <?php echo form_dropdown('user_type', $options,   (! set_value('user_type')) ?  $rs_obmp_review->user_type :  set_value('user_type')   )?>
            
            
            
    <?php echo form_error('user_type'); ?>
        </p>  
        <input id="review_id" type="hidden" name="review_id"  value="<?php echo $rs_obmp_review->review_id; ; ?>">  
        <input id="hotel_id" type="hidden" name="hotel_id"  value="<?php echo $rs_clienti[0]->hotel_id; ?>">
        <input id="preno_id" type="hidden" name="preno_id"  value="<?php echo $rs_clienti[0]->preno_id; ?>">
        <input id="conto_id" type="hidden" name="conto_id"  value="<?php echo $rs_clienti[0]->conto_id; ?>" >
        <input id="postazione_id" type="hidden" name="postazione_id"  value="<?php echo $rs_clienti[0]->preno_id; ?>">  
        <input id="camera_numero" type="hidden" name="camera_numero"  value="<?php echo $rs_clienti[0]->camera_id; ?>" > 
        <input id="nome" type="hidden" name="nome"  value="<?php echo $rs_clienti[0]->clienti_cogno; ?>"  >     
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


