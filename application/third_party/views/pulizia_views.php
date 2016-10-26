<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('pulizia', $attributes); ?>

<p>
        <label for="pulizia_id">pulizia_id</label>
        <?php echo form_error('pulizia_id'); ?>
        <br /><input id="pulizia_id" type="text" name="pulizia_id"  value="<?php echo set_value('pulizia_id'); ?>"  />
</p>

<p>
        <label for="hotel_id">hotel_id</label>
        <?php echo form_error('hotel_id'); ?>
        <br /><input id="hotel_id" type="text" name="hotel_id"  value="<?php echo set_value('hotel_id'); ?>"  />
</p>

<p>
        <label for="conto_id">conto_id</label>
        <?php echo form_error('conto_id'); ?>
        <br /><input id="conto_id" type="text" name="conto_id"  value="<?php echo set_value('conto_id'); ?>"  />
</p>

<p>
        <label for="camara_id">camara_id</label>
        <?php echo form_error('camara_id'); ?>
        <br /><input id="camara_id" type="text" name="camara_id"  value="<?php echo set_value('camara_id'); ?>"  />
</p>

<p>
        <label for="pulizia_data">pulizia_data</label>
        <?php echo form_error('pulizia_data'); ?>
        <br /><input id="pulizia_data" type="text" name="pulizia_data"  value="<?php echo set_value('pulizia_data'); ?>"  />
</p>

<p>
        <label for="pulizia_note">pulizia_note</label>
	<?php echo form_error('pulizia_note'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'pulizia_note', 'rows' => '5', 'cols' => '80', 'value' => set_value('pulizia_note') ) )?>
</p>
<p>
        <label for="utente_id">utente_id</label>
        <?php echo form_error('utente_id'); ?>
        <br /><input id="utente_id" type="text" name="utente_id"  value="<?php echo set_value('utente_id'); ?>"  />
</p>

<p>
        <label for="pulizia_data_record">pulizia_data_record</label>
        <?php echo form_error('pulizia_data_record'); ?>
        <br /><input id="pulizia_data_record" type="text" name="pulizia_data_record"  value="<?php echo set_value('pulizia_data_record'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
