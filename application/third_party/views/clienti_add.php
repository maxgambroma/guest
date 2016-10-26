
<!--  clienti_add.php  -->
 <fieldset>
    <legend>clienti:</legend>		

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');	           
        echo form_open( uri_string() . '?'. $_SERVER['QUERY_STRING'], $attributes); ?>   

<p>       <input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo set_value('clienti_id'); ?>"  /><p>       <input id="preno_id" type="hidden" name="preno_id"  value="<?php echo set_value('preno_id'); ?>"  /><p>       <input id="hotel_id" type="hidden" name="hotel_id"  value="<?php echo set_value('hotel_id'); ?>"  /><p>       <input id="camera_id" type="hidden" name="camera_id"  value="<?php echo set_value('camera_id'); ?>"  /><p>       <input id="camera_numero" type="hidden" name="camera_numero"  value="<?php echo set_value('camera_numero'); ?>"  /><p>       <input id="camara_tipologia" type="hidden" name="camara_tipologia"  value="<?php echo set_value('camara_tipologia'); ?>"  />
<p>
         <?php echo lang('clienti_nome', 'clienti_nome'); ?>
        <?php echo form_error('clienti_nome'); ?>
       <input id="clienti_nome" type="text" name="clienti_nome"  value="<?php echo set_value('clienti_nome'); ?>"  />
</p>

<p>
         <?php echo lang('clienti_cogno', 'clienti_cogno'); ?>
        <?php echo form_error('clienti_cogno'); ?>
       <input id="clienti_cogno" type="text" name="clienti_cogno"  value="<?php echo set_value('clienti_cogno'); ?>"  />
</p>
<p>       <input id="cliente_nato_a" type="hidden" name="cliente_nato_a"  value="<?php echo set_value('cliente_nato_a'); ?>"  /><p>       <input id="cliente_nato_il" type="hidden" name="cliente_nato_il"  value="<?php echo set_value('cliente_nato_il'); ?>"  /><p>       <input id="cliente_nazione" type="hidden" name="cliente_nazione"  value="<?php echo set_value('cliente_nazione'); ?>"  /><p>       <input id="cliente_provincia" type="hidden" name="cliente_provincia"  value="<?php echo set_value('cliente_provincia'); ?>"  /><p>       <input id="cliente_residenza" type="hidden" name="cliente_residenza"  value="<?php echo set_value('cliente_residenza'); ?>"  /><p>       <input id="cliente_cocumento_tipo" type="hidden" name="cliente_cocumento_tipo"  value="<?php echo set_value('cliente_cocumento_tipo'); ?>"  /><p>       <input id="cliente_cocumento_numero" type="hidden" name="cliente_cocumento_numero"  value="<?php echo set_value('cliente_cocumento_numero'); ?>"  /><p>       <input id="cliente_cocumento_rilasciato_il" type="hidden" name="cliente_cocumento_rilasciato_il"  value="<?php echo set_value('cliente_cocumento_rilasciato_il'); ?>"  /><p>       <input id="cliente_sesso" type="hidden" name="cliente_sesso"  value="<?php echo set_value('cliente_sesso'); ?>"  /><p>       <input id="clienti_nome1" type="hidden" name="clienti_nome1"  value="<?php echo set_value('clienti_nome1'); ?>"  /><p>       <input id="clienti_nome2" type="hidden" name="clienti_nome2"  value="<?php echo set_value('clienti_nome2'); ?>"  /><p>       <input id="clienti_nome3" type="hidden" name="clienti_nome3"  value="<?php echo set_value('clienti_nome3'); ?>"  /><p>       <input id="clienti_nome4" type="hidden" name="clienti_nome4"  value="<?php echo set_value('clienti_nome4'); ?>"  /><p>       <input id="clienti_cogno1" type="hidden" name="clienti_cogno1"  value="<?php echo set_value('clienti_cogno1'); ?>"  /><p>       <input id="clienti_cogno2" type="hidden" name="clienti_cogno2"  value="<?php echo set_value('clienti_cogno2'); ?>"  /><p>       <input id="clienti_cogno3" type="hidden" name="clienti_cogno3"  value="<?php echo set_value('clienti_cogno3'); ?>"  />
<p>
         <?php echo lang('clienti_cogno4', 'clienti_cogno4'); ?>
        <?php echo form_error('clienti_cogno4'); ?>
       <input id="clienti_cogno4" type="text" name="clienti_cogno4"  value="<?php echo set_value('clienti_cogno4'); ?>"  />
</p>

<p>
         <?php echo lang('cliente_nato_a1', 'cliente_nato_a1'); ?>
        <?php echo form_error('cliente_nato_a1'); ?>
       <input id="cliente_nato_a1" type="text" name="cliente_nato_a1"  value="<?php echo set_value('cliente_nato_a1'); ?>"  />
</p>
<p>       <input id="cliente_nato_a2" type="hidden" name="cliente_nato_a2"  value="<?php echo set_value('cliente_nato_a2'); ?>"  /><p>       <input id="cliente_nato_a3" type="hidden" name="cliente_nato_a3"  value="<?php echo set_value('cliente_nato_a3'); ?>"  />
<p>
         <?php echo lang('cliente_nato_a4', 'cliente_nato_a4'); ?>
        <?php echo form_error('cliente_nato_a4'); ?>
       <input id="cliente_nato_a4" type="text" name="cliente_nato_a4"  value="<?php echo set_value('cliente_nato_a4'); ?>"  />
</p>
<p>       <input id="cliente_nato_il1" type="hidden" name="cliente_nato_il1"  value="<?php echo set_value('cliente_nato_il1'); ?>"  /><p>       <input id="cliente_nato_il2" type="hidden" name="cliente_nato_il2"  value="<?php echo set_value('cliente_nato_il2'); ?>"  /><p>       <input id="cliente_nato_il3" type="hidden" name="cliente_nato_il3"  value="<?php echo set_value('cliente_nato_il3'); ?>"  /><p>       <input id="cliente_nato_il4" type="hidden" name="cliente_nato_il4"  value="<?php echo set_value('cliente_nato_il4'); ?>"  /><p>       <input id="cliente_sesso1" type="hidden" name="cliente_sesso1"  value="<?php echo set_value('cliente_sesso1'); ?>"  /><p>       <input id="cliente_sesso2" type="hidden" name="cliente_sesso2"  value="<?php echo set_value('cliente_sesso2'); ?>"  /><p>       <input id="cliente_sesso3" type="hidden" name="cliente_sesso3"  value="<?php echo set_value('cliente_sesso3'); ?>"  /><p>       <input id="cliente_sesso4" type="hidden" name="cliente_sesso4"  value="<?php echo set_value('cliente_sesso4'); ?>"  /><p>       <input id="cliente_nazione1" type="hidden" name="cliente_nazione1"  value="<?php echo set_value('cliente_nazione1'); ?>"  /><p>       <input id="cliente_nazione2" type="hidden" name="cliente_nazione2"  value="<?php echo set_value('cliente_nazione2'); ?>"  /><p>       <input id="cliente_nazione3" type="hidden" name="cliente_nazione3"  value="<?php echo set_value('cliente_nazione3'); ?>"  /><p>       <input id="cliente_nazione4" type="hidden" name="cliente_nazione4"  value="<?php echo set_value('cliente_nazione4'); ?>"  /><p>       <input id="cliente_provincia1" type="hidden" name="cliente_provincia1"  value="<?php echo set_value('cliente_provincia1'); ?>"  /><p>       <input id="cliente_provincia2" type="hidden" name="cliente_provincia2"  value="<?php echo set_value('cliente_provincia2'); ?>"  /><p>       <input id="cliente_provincia3" type="hidden" name="cliente_provincia3"  value="<?php echo set_value('cliente_provincia3'); ?>"  /><p>       <input id="cliente_provincia4" type="hidden" name="cliente_provincia4"  value="<?php echo set_value('cliente_provincia4'); ?>"  /><p>       <input id="clienti_cc_tip" type="hidden" name="clienti_cc_tip"  value="<?php echo set_value('clienti_cc_tip'); ?>"  /><p>       <input id="clienti_cc_n" type="hidden" name="clienti_cc_n"  value="<?php echo set_value('clienti_cc_n'); ?>"  /><p>       <input id="clienti_cc_scad" type="hidden" name="clienti_cc_scad"  value="<?php echo set_value('clienti_cc_scad'); ?>"  /><p>       <input id="clienti_tel" type="hidden" name="clienti_tel"  value="<?php echo set_value('clienti_tel'); ?>"  /><p>       <input id="clienti_fax" type="hidden" name="clienti_fax"  value="<?php echo set_value('clienti_fax'); ?>"  /><p>       <input id="clienti_email" type="hidden" name="clienti_email"  value="<?php echo set_value('clienti_email'); ?>"  /><p>       <input id="clienti_note" type="hidden" name="clienti_note"  value="<?php echo set_value('clienti_note'); ?>"  /><p> <span class="required">*</span>
        <?php echo form_error('privacy'); ?>
        <?php // Change the values/css classes to suit your needs ?>
        <input type="checkbox" id="privacy" name="privacy" value="enter_value_here" class="" <?php echo set_checkbox('privacy', 'enter_value_here'); ?>> 
	 <?php echo lang('privacy', 'privacy'); ?>
</p> <p>       <input id="clienti_data_record" type="hidden" name="clienti_data_record"  value="<?php echo set_value('clienti_data_record'); ?>"  /><p>       <input id="clienti_utente_id" type="hidden" name="clienti_utente_id"  value="<?php echo set_value('clienti_utente_id'); ?>"  />

<p>
        <?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>

<?php echo form_close(); ?>
</fieldset>
