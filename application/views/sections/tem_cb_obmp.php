<div class="row" id="contenitore_b">
   
    
    
<?php  if ( !empty($temp['bar_1'])) { ?>
   
    
    
    
     <div class="small-12  medium-8  large-9 columns" id="col_principale" >
         <div><?php $this->load->view('sections/cercatore_obmp'); ?></div>      
         
         <div> <?php echo $table_evento ;?></div>
         
         
         <div class="contenuto">
                   
            <p><?php $this->load->view($temp['contenuto']); ?></p>
        </div> 
    </div>
   <div class="show-for-medium-up small-12 medium-4 large-3 columns" id="col_riepilogo" >
        <?php   $this->load->view('sections/' . $temp['bar_1']); ?>  

    </div>
    
<?php }
  else{  ?>
  
    
    <?php echo $evento['table_evento']; ?>
    
      <div class="large-12  columns">
        <p><?php $this->load->view($temp['contenuto']); ?></p>
    </div>
    <?php } ?>
</div>

