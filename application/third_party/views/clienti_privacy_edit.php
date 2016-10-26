<!--  clienti_edit.php  -->
<fieldset>
    <legend></legend>	

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
<input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo (!set_value('clienti_id')) ? $rs_clienti[0]->clienti_id : set_value('clienti_id'); ?>"  />
<input id="privacy" type="hidden" name="privacy"  value="1"  />  
<p> 
    <?php echo ($rs_clienti[0]->cliente_sesso == 'F') ? $this->lang->line('dear_F') : $this->lang->line('dear_M'); ?>  <?php echo $rs_clienti[0]->clienti_nome; ?>  <?php echo $rs_clienti[0]->clienti_cogno; ?>,
    <br>
     <?php echo $this->lang->line('lex_privacy'); ?>
</p>
<p>
        <?php echo form_error('marketing'); ?>
        <?php // Change the values/css classes to suit your needs ?>
        <input type="checkbox" id="marketing" name="marketing" value="1" class="" <?php echo set_checkbox('marketing', '1'); ?>>           
	 <?php echo lang('points', 'marketing'); ?>
</p> 

<p>
    <img src="<?php echo base_url(); ?>asset/img/firma-emal.png" >
    <br>
        <?php echo lang('firma_email', 'clienti_email'); ?>
    <?php echo form_error('clienti_email'); ?>
    <input id="clienti_email" type="text" name="clienti_email"  value="<?php echo (!set_value('clienti_email')) ? $rs_clienti[0]->clienti_email : set_value('clienti_email'); ?>"  />
</p>
<p>
    <?php echo form_submit('submit', 'Submit', 'class="button"'); ?>
</p>
<?php echo form_close(); ?>
</fieldset>                

