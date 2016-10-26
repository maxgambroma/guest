<!--  myform_add.php  -->
 
<div class="box_booking">
<fieldset>
<!--    <legend>Myform:</legend>		-->

<p>
Plan Your Next Adventure
Destination, property name or address:</p>

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');	           
        echo form_open( uri_string() . '?'. $_SERVER['QUERY_STRING'], $attributes); ?>   


<p>
         <?php echo lang('check_in', 'Check-in'); ?> 
        <?php echo form_error('check_in'); ?>
       <input id="check_in" type="text" name="check_in"  value="<?php echo set_value('check_in'); ?>"  />
</p>

<p>
         <?php echo lang('check_out', 'Check-out'); ?> 
        <?php echo form_error('check_out'); ?>
       <input id="check_out" type="text" name="check_out"  value="<?php echo set_value('check_out'); ?>"  />
</p>




<p>
         <?php echo lang('numbers', 'Numbers'); ?> 
        <?php echo form_error('numbers'); ?>
       <input id="numbers" type="text" name="numbers"  value="<?php echo set_value('numbers'); ?>"  />
</p>

<p>
         <?php echo lang('promotional', 'Promotional'); ?>
        <?php echo form_error('promotional'); ?>
       <input id="promotional" type="text" name="promotional"  value="<?php echo set_value('promotional'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>

<?php echo form_close(); ?>
</fieldset>
</div>