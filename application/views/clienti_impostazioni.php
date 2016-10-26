<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



?>



<!--  Clienti_edit.php  -->
 <fieldset>
    <legend><?php echo ($rs_clienti[0]->cliente_sesso == 'F') ? $this->lang->line('dear_F') : $this->lang->line('dear_M'); ?>  <?php echo $rs_clienti[0]->clienti_nome; ?>  <?php echo $rs_clienti[0]->clienti_cogno; ?> </legend>	
        
            <?php if($this->input->get('error')){ ?>
            <p>
            <div class="error"><?php echo $this->lang->line($this->input->get('error'), FALSE ) ; ?> </div> 
            </p>
            <?php }?>

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');
        echo form_open( uri_string() .'/?'. $_SERVER['QUERY_STRING'], $attributes); ?>   


	 <input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo ( !set_value('clienti_id')) ? $rs_clienti[0]->clienti_id  : set_value('clienti_id');  ?>"  />


<p>
         <?php echo lang('clienti_nome', 'clienti_nome'); ?>
        <?php echo form_error('clienti_nome'); ?>
    <input id="clienti_nome" type="text" name="clienti_nome"  class="cliente_cognome_jquery"   readonly value="<?php echo ( !set_value('clienti_nome')) ? $rs_clienti[0]->clienti_nome  : set_value('clienti_nome');  ?>"  />
</p>

<p>
         <?php echo lang('clienti_cogno', 'clienti_cogno'); ?>
        <?php echo form_error('clienti_cogno'); ?>
    <input id="clienti_cogno" type="text" name="clienti_cogno" class="cliente_nome_jquery"  readonly value="<?php echo ( !set_value('clienti_cogno')) ? $rs_clienti[0]->clienti_cogno  : set_value('clienti_cogno');  ?>"  />
</p>

<p>
         <?php echo lang('clienti_tel', 'clienti_tel'); ?>
        <?php echo form_error('clienti_tel'); ?>
    <input id="clienti_tel" type="text" name="clienti_tel"   class="telefono_jquery" value="<?php echo ( !set_value('clienti_tel')) ? $rs_clienti[0]->clienti_tel  : set_value('clienti_tel');  ?>"  />
</p>



<p>
         <?php echo lang('clienti_email', 'clienti_email'); ?>
        <?php echo form_error('clienti_email'); ?>
    <input id="clienti_email" type="text" name="clienti_email"  class="email_jquery" value="<?php echo ( !set_value('clienti_email')) ? $rs_clienti[0]->clienti_email  : set_value('clienti_email');  ?>"  />
</p>

<p>
         <?php echo lang('password', 'password'); ?>
        <?php echo form_error('password'); ?>
    <input id="password" type="text" name="password"  class="password_jquery" value="<?php echo ( !set_value('password')) ? $rs_clienti[0]->password  : set_value('password');  ?>"  />
</p>


<p>
         <?php echo lang('clienti_note', 'clienti_note'); ?>
	<?php echo form_error('clienti_note'); ?>

							
	<?php echo form_textarea( array( 'name' => 'clienti_note', 'rows' => '5', 'cols' => '80', 'value' => ( !set_value('clienti_note'))   ? $rs_clienti[0]->clienti_note : set_value('clienti_note') ) )?>
</p>


<p>
<?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>





<?php echo form_close(); ?>
</fieldset>                
   