
<!--  tex_lingue_edit.php  -->
 <fieldset>
    <legend>tex_lingue:</legend>	
        
            <?php if($this->input->get('error')){ ?>
            <p>
            <div class="error"><?php echo $this->lang->line($this->input->get('error'), FALSE ) ; ?> </div> 
            </p>
            <?php }?>

	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');
        echo form_open( uri_string() . '?'. $_SERVER['QUERY_STRING'], $attributes); ?>     


<p>
	       <input id="tex_lingue_id" type="hidden" name="tex_lingue_id"  value="<?php echo ( !set_value('tex_lingue_id')) ? $rs_tex_lingue->tex_lingue_id  : set_value('tex_lingue_id');  ?>"  />
<p>
         <?php echo lang('etichetta_lg', 'etichetta_lg'); ?> <span class="required">*</span>
        <?php echo form_error('etichetta_lg'); ?>
       <input id="etichetta_lg" type="text" name="etichetta_lg"  value="<?php echo ( !set_value('etichetta_lg')) ? $rs_tex_lingue->etichetta_lg  : set_value('etichetta_lg');  ?>"  />
</p>

<p>
         <?php echo lang('en', 'en'); ?> <span class="required">*</span>
        <?php echo form_error('en'); ?>
       <input id="en" type="text" name="en"  value="<?php echo ( !set_value('en')) ? $rs_tex_lingue->en  : set_value('en');  ?>"  />
</p>

<p>
         <?php echo lang('it', 'it'); ?> <span class="required">*</span>
        <?php echo form_error('it'); ?>
       <input id="it" type="text" name="it"  value="<?php echo ( !set_value('it')) ? $rs_tex_lingue->it  : set_value('it');  ?>"  />
</p>

<p>
         <?php echo lang('es', 'es'); ?>
        <?php echo form_error('es'); ?>
       <input id="es" type="text" name="es"  value="<?php echo ( !set_value('es')) ? $rs_tex_lingue->es  : set_value('es');  ?>"  />
</p>

<p>
         <?php echo lang('fr', 'fr'); ?>
        <?php echo form_error('fr'); ?>
       <input id="fr" type="text" name="fr"  value="<?php echo ( !set_value('fr')) ? $rs_tex_lingue->fr  : set_value('fr');  ?>"  />
</p>

<p>
         <?php echo lang('de', 'de'); ?>
        <?php echo form_error('de'); ?>
       <input id="de" type="text" name="de"  value="<?php echo ( !set_value('de')) ? $rs_tex_lingue->de  : set_value('de');  ?>"  />
</p>



<p>
<?php echo form_submit( 'submit', 'Submit', 'class="button"'); ?>
</p>
<?php echo form_close(); ?>
</fieldset>                
<br>
<div>
    <fieldset>

    <?php // Change the css classes to suit your needs    
     $atri = array('class' => '', 'id' => ''); 
     echo form_open('tex_lingue/delete/?'.$_SERVER['QUERY_STRING'], $atri); ?>   <p>      
<label for="tex_lingue_id">Conferma cancellazione record Id tex_lingue_id </label>        
<input type="checkbox" name="CAX" value="10" />
<input type="hidden" name="tex_lingue_id" value="<?php echo ( !set_value('de')) ? $rs_tex_lingue->tex_lingue_id  : set_value('tex_lingue_id');  ?>" />
     </p>
<p>
    <?php echo form_submit( 'submit', 'Cancella', 'class="button"'); ?>
    </p>
    <?php echo form_close(); ?>
    </fieldset>
</div>