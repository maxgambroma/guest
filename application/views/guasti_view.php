<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('Guasti', $attributes); ?>




<p>
        <label for="guasto_priorita">guasto_priorita <span class="required">*</span></label>
        <?php echo form_error('guasto_priorita'); ?>
        
        <?php // Change the values in this array to populate your dropdown as required ?>
        <?php $options = array(
                                                  ''  => 'Please Select',
                                                  'example_value1'    => 'example option 1'
                                                ); ?>

        <br /><?php echo form_dropdown('guasto_priorita', $options, set_value('guasto_priorita'))?>
</p>                                             
                        
<p>
        <label for="guasto_area">guasto_area <span class="required">*</span></label>
        <?php echo form_error('guasto_area'); ?>
        <br /><input id="guasto_area" type="text" name="guasto_area"  value="<?php echo set_value('guasto_area'); ?>"  />
</p>

<p>
        <label for="guasto_piano">guasto_piano <span class="required">*</span></label>
        <?php echo form_error('guasto_piano'); ?>
        <br /><input id="guasto_piano" type="text" name="guasto_piano"  value="<?php echo set_value('guasto_piano'); ?>"  />
</p>

<p>
        <label for="guasto_note">guasto_note</label>
	<?php echo form_error('guasto_note'); ?>
	<br />
							
	<?php echo form_textarea( array( 'name' => 'guasto_note', 'rows' => '5', 'cols' => '80', 'value' => set_value('guasto_note') ) )?>
</p>
<p>
        <label for="guasto_stato">guasto_stato</label>
        <?php echo form_error('guasto_stato'); ?>
        <br />
                <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                <input id="guasto_stato" name="guasto_stato" type="radio" class="" value="option1" <?php echo $this->form_validation->set_radio('guasto_stato', 'option1'); ?> />
        		<label for="guasto_stato" class="">Radio option 1</label>

        		<input id="guasto_stato" name="guasto_stato" type="radio" class="" value="option2" <?php echo $this->form_validation->set_radio('guasto_stato', 'option2'); ?> />
        		<label for="guasto_stato" class="">Radio option 2</label>
</p>

<p>
        <label for="guasto_data">guasto_data</label>
        <?php echo form_error('guasto_data'); ?>
        <br /><input id="guasto_data" type="text" name="guasto_data"  value="<?php echo set_value('guasto_data'); ?>"  />
</p>

<p>
        <label for="guasto_data_record">guasto_data_record</label>
        <?php echo form_error('guasto_data_record'); ?>
        <br /><input id="guasto_data_record" type="text" name="guasto_data_record"  value="<?php echo set_value('guasto_data_record'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>