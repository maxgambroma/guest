<div class="row">   
<?php  if ( !empty($temp['bar_1'])) { ?>
    <div class="large-9 push-3 columns">
               <div class="contenuto">
            <p><?php $this->load->view($temp['contenuto']); ?></p>
        </div> 
    </div>
    <div class="large-3 pull-9 columns">
        <?php   $this->load->view('sections/' . $temp['bar_1']); ?>  

    </div>
    
<?php }
  else{  ?>
  
      <div class="large-12  columns">
        <p><?php $this->load->view($temp['contenuto']); ?></p>
    </div>
    <?php } ?>
</div>