<?php // print_r($rs_clienti) ;  ?>


<fieldset>
    
    <legend><?php  echo lang('privacyLow') ;  ?>  </legend>

    
    <?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');
        echo form_open( uri_string() .'/?'. $_SERVER['QUERY_STRING'], $attributes); ?>   


    
	 <input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo ( !set_value('clienti_id')) ? $rs_clienti[0]->clienti_id  : set_value('clienti_id');  ?>"  />


    
    
<p>
     <?php echo ($rs_clienti[0]->cliente_sesso == 'F') ? $this->lang->line('dear_F') : $this->lang->line('dear_M'); ?>  <?php echo $rs_clienti[0]->clienti_nome; ?>  <?php echo $rs_clienti[0]->clienti_cogno; ?>,<br> 
    <?php echo lang('lex_privacy') ;  ?> 
    
</p>


<p>
         <?php echo lang('points12', 'privacy'); ?>
        <?php echo form_error('privacy'); ?>
        
                    <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
    <input id="privacy" name="privacy" type="radio" class="" readonly  value="1" <?php echo $this->form_validation->set_radio('privacy', '1',  $rs_clienti[0]->privacy === "1" ? TRUE : FALSE ); ?> />
                    <?php echo $this->lang->line('accetto');  ?> <br>

                   
</p>






<p>
         <?php echo lang('points', 'marketing'); ?>
        <?php echo form_error('marketing'); ?>
        
                    <?php // Change or Add the radio values/labels/css classes to suit your needs ?>
                    <input id="marketing" name="marketing" type="radio" class="" value="1" <?php echo $this->form_validation->set_radio('marketing', '1',  $rs_clienti[0]->marketing === "1" ? TRUE : FALSE ); ?> />
                   <?php echo $this->lang->line('accetto');  ?> <br>

                    <input id="marketing" name="marketing" type="radio" class="" value="0" <?php echo $this->form_validation->set_radio('marketing', '0',  $rs_clienti[0]->marketing === "0" ? TRUE : FALSE ); ?> />
                   <?php echo $this->lang->line('rifiuto');  ?>
</p>




<p>
<?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>


<?php echo form_close(); ?>
</fieldset>                
<br>   