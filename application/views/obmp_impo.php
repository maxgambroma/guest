<!--   -->
<fieldset>
    <legend>obmp_clienti:</legend>	
    <?php if ($this->input->get('error')) { ?>
        <p>
        <div class="error"><?php echo $this->lang->line($this->input->get('error'), FALSE); ?> </div> 
    </p>
<?php } ?>

<?php
// Change the css classes to suit your needs    
$attributes = array('class' => '', 'id' => '');
echo form_open(uri_string() . '?' . $_SERVER['QUERY_STRING'], $attributes);
?>     

   
<p>
<?php echo lang('obm_cliente_first_name', 'obm_cliente_first_name'); ?> <span class="required">*</span>
<?php echo form_error('obm_cliente_first_name'); ?>
    <input id="obm_cliente_first_name" type="text" name="obm_cliente_first_name"  value="<?php echo (!set_value('obm_cliente_first_name')) ? $rs_obmp_clienti->obm_cliente_first_name : set_value('obm_cliente_first_name'); ?>"  />
</p>
<p>
<?php echo lang('obm_cliente_last_name', 'obm_cliente_last_name'); ?> <span class="required">*</span>
<?php echo form_error('obm_cliente_last_name'); ?>
    <input id="obm_cliente_last_name" type="text" name="obm_cliente_last_name"  value="<?php echo (!set_value('obm_cliente_last_name')) ? $rs_obmp_clienti->obm_cliente_last_name : set_value('obm_cliente_last_name'); ?>"  />
</p>
<p>
<?php echo lang('obm_cliente_email', 'obm_cliente_email'); ?> <span class="required">*</span>
<?php echo form_error('obm_cliente_email'); ?>
    <input id="obm_cliente_email" type="text" name="obm_cliente_email"  value="<?php echo (!set_value('obm_cliente_email')) ? $rs_obmp_clienti->obm_cliente_email : set_value('obm_cliente_email'); ?>"  />
</p>
<p>
<?php echo lang('obm_cliente_city', 'obm_cliente_city'); ?>
<?php echo form_error('obm_cliente_city'); ?>
    <input id="obm_cliente_city" type="text" name="obm_cliente_city"  value="<?php echo (!set_value('obm_cliente_city')) ? $rs_obmp_clienti->obm_cliente_city : set_value('obm_cliente_city'); ?>"  />
</p>
<p>
    <?php echo lang('obm_cliente_country', 'obm_cliente_country'); ?> <span class="required">*</span>        <?php echo form_error('obm_cliente_country'); ?>
    <?php // Change the values in this array to populate your dropdown as required ?>
    <?php
// $options = array('' => 'Please Select'    
////                   );
//// or FORM DB
//    foreach ($rs_data as $value) {
//        $options[$value->id] = $value->nome;
//    }
//  
//    echo form_dropdown('obm_cliente_country', $options, (!set_value('obm_cliente_country')) ? $rs_obmp_clienti->obm_cliente_country : set_value('obm_cliente_country') ) 
//            
//            ?>
</p>   

<p>

<label><?php echo $lg_tex['country']; ?>: <small>required</small>
<select name="preno_country" id="preno_country"  required="" data-invalid="" > 
<option value="">Select Country</option>
<option style="font-weight: bold" value="Australia" phone-code="61"> Australia</option>
<option style="font-weight: bold" value="Canada" phone-code="1"> Canada</option>
<option style="font-weight: bold" value="France" phone-code="33"> France</option>
<option style="font-weight: bold" value="Germany" phone-code="49"> Germany</option>
<option style="font-weight: bold" value="Ireland" phone-code="353"> Ireland</option>
<option style="font-weight: bold" value="Italy" phone-code="39"> Italy</option>
<option style="font-weight: bold" value="Spain" phone-code="34"> Spain</option>
<option style="font-weight: bold" value="Switzerland" phone-code="41"> Switzerland</option>
<option style="font-weight: bold" value="USA" phone-code="phone-code"> USA</option>
<option style="font-weight: bold" value="United Kingdom" phone-code="44"> United Kingdom</option>
</select>
</label>

 </p>

<p>
<?php echo lang('obm_cliente_phone', 'obm_cliente_phone'); ?> <span class="required">*</span>
<?php echo form_error('obm_cliente_phone'); ?>
    <input id="obm_cliente_phone" type="text" name="obm_cliente_phone"  value="<?php echo (!set_value('obm_cliente_phone')) ? $rs_obmp_clienti->obm_cliente_phone : set_value('obm_cliente_phone'); ?>"  />
</p>
<p>
    <?php echo form_error('obm_cliente_newsletter'); ?>
    <?php // Change the values/css classes to suit your needs ?>
    <input type="checkbox" id="obm_cliente_newsletter" name="obm_cliente_newsletter" value="enter_value_here" class="" <?php echo set_checkbox('obm_cliente_newsletter', 'enter_value_here', $rs_obmp_clienti->obm_cliente_newsletter === "option1" ? TRUE : FALSE ); ?>> 
    <?php echo lang('obm_cliente_newsletter', 'obm_cliente_newsletter'); ?>
</p> 
<p>
<?php echo lang('obm_cliente_pass', 'obm_cliente_pass'); ?> <span class="required">*</span>
<?php echo form_error('obm_cliente_pass'); ?>
    <input id="obm_cliente_pass" type="text" name="obm_cliente_pass"  value="<?php echo (!set_value('obm_cliente_pass')) ? $rs_obmp_clienti->obm_cliente_pass : set_value('obm_cliente_pass'); ?>"  />
</p>
<p>
    <input id="obm_cliente_id" type="hidden" name="obm_cliente_id"  value="<?php echo (!set_value('obm_cliente_id')) ? $rs_obmp_clienti->obm_cliente_id : set_value('obm_cliente_id'); ?>"  />
    <input id="obm_cliente_data_insert" type="hidden" name="obm_cliente_data_insert"  value="<?php echo (!set_value('obm_cliente_data_insert')) ? $rs_obmp_clienti->obm_cliente_data_insert : set_value('obm_cliente_data_insert'); ?>"  />
    <input id="obm_cliente_data_record" type="hidden" name="obm_cliente_data_record"  value="<?php echo (!set_value('obm_cliente_data_record')) ? $rs_obmp_clienti->obm_cliente_data_record : set_value('obm_cliente_data_record'); ?>"  />
    <input id="obm_cliente_cc_type" type="hidden" name="obm_cliente_cc_type"  value="<?php echo (!set_value('obm_cliente_cc_type')) ? $rs_obmp_clienti->obm_cliente_cc_type : set_value('obm_cliente_cc_type'); ?>"  />
    <input id="obm_cliente_cc_number" type="hidden" name="obm_cliente_cc_number"  value="<?php echo (!set_value('obm_cliente_cc_number')) ? $rs_obmp_clienti->obm_cliente_cc_number : set_value('obm_cliente_cc_number'); ?>"  />
    <input id="obm_cliente_holder" type="hidden" name="obm_cliente_holder"  value="<?php echo (!set_value('obm_cliente_holder')) ? $rs_obmp_clienti->obm_cliente_holder : set_value('obm_cliente_holder'); ?>"  />
    <input id="obm_cliente_cc_expire" type="hidden" name="obm_cliente_cc_expire"  value="<?php echo (!set_value('obm_cliente_cc_expire')) ? $rs_obmp_clienti->obm_cliente_cc_expire : set_value('obm_cliente_cc_expire'); ?>"  />
    <input id="obm_cliente_cc_security" type="hidden" name="obm_cliente_cc_security"  value="<?php echo (!set_value('obm_cliente_cc_security')) ? $rs_obmp_clienti->obm_cliente_cc_security : set_value('obm_cliente_cc_security'); ?>"  />
<p>
<?php echo form_submit('submit', 'Submit', 'class="button"'); ?>
</p>
<?php echo form_close(); ?>
</fieldset>                
