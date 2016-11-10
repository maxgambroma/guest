
<!--  punti_spesi_add.php  -->
 <fieldset>
    <legend>punti_spesi:</legend>		

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');	           
        echo form_open( uri_string() . '?'. $_SERVER['QUERY_STRING'], $attributes); ?>   

<p>       <input id="punti_spesi_id" type="hidden" name="punti_spesi_id"  value="<?php echo set_value('punti_spesi_id'); ?>"  /><p> <span class="required">*</span>       <input id="hotel_id" type="hidden" name="hotel_id"  value="<?php echo set_value('hotel_id'); ?>"  /><p> <span class="required">*</span>       <input id="cliente_id" type="hidden" name="cliente_id"  value="<?php echo set_value('cliente_id'); ?>"  />
<p>
         <?php echo lang('conto_id', 'conto_id'); ?> <span class="required">*</span>
        <?php echo form_error('conto_id'); ?>
       <input id="conto_id" type="text" name="conto_id"  value="<?php echo set_value('conto_id'); ?>"  />
</p>

<p>
         <?php echo lang('punti', 'punti'); ?> <span class="required">*</span>
        <?php echo form_error('punti'); ?>
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php 
                    // $options = array('' => 'Please Select'    
                    //                   );
                    // or FORM DB
                        foreach ($rs_data as $value) {
                        $options[$value->id] = $value->nome;
                        }
                      ?>
       <?php echo form_dropdown('punti', $options, set_value('punti'))?>
</p>                                             
                        <p> <span class="required">*</span>       <input id="data" type="hidden" name="data"  value="<?php echo set_value('data'); ?>"  /><p>       <input id="data_record" type="hidden" name="data_record"  value="<?php echo set_value('data_record'); ?>"  /><p>       <input id="utente_id" type="hidden" name="utente_id"  value="<?php echo set_value('utente_id'); ?>"  />

<p>
        <?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>

<?php echo form_close(); ?>
</fieldset>
