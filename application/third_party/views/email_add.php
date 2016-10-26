
<!--  email_add.php  -->
 <fieldset>
    <legend>email:</legend>		

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');	           
        echo form_open('clienti/email?'. $_SERVER['QUERY_STRING'], $attributes); ?>   


<p>
         <?php echo lang('email', 'email'); ?> <span class="required">*</span>
        <?php echo form_error('email'); ?>
       <input id="email" type="text" name="email"  value="<?php echo set_value('email'); ?>"  />
</p>


<p>
         <?php echo lang('', 'titolo'); ?> <span class="required">*</span>
        <?php echo form_error(''); ?>
       <input id="" type="text" name="titolo"  value="<?php echo set_value('titolo'); ?>"  />
</p>


<p>
         <?php echo lang('testo', 'testo'); ?> <span class="required">*</span>
	<?php echo form_error('titolo'); ?>						
	<?php echo form_textarea( array( 'name' => 'testo', 'rows' => '5', 'cols' => '80', 'value' => set_value('testo') ) )?>
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>

<?php echo form_close(); ?>
</fieldset>