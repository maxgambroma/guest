<?php ?>
<div class="new_preno">
    <fieldset>
        <legend> NewPreno</legend>
        <?php foreach ($preno as $key => $row_new) { ?>
            <div>
                <fieldset>
                    <legend> Booking id : <?php echo $row_new->preno_id; ?></legend>
                    <div class="row">
                        <div class="small-12 medium-5 large-5 <?php if($row_new->preno_stato == 9){ ?>  box_cancellata <?php } ?>  columns">
                            <img src="<?php echo base_url(); ?><?php echo $row_new->hotel_foto_piccola; ?>"/>
                        </div>
                        <div class="small-12 medium-7 large-7  <?php if($row_new->preno_stato == 9){ ?>  box_cancellata <?php } ?> columns">
                            <h4>  <?php echo $row_new->hotel_tipologia; ?>  <?php echo $row_new->nome_hotel; ?></h4>
           
                    <div class="event-date">
                            <p class="event-title">IN</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row_new->preno_dal)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row_new->preno_dal)); ?></p>
                        </div>
                        <div class="event-date">
                            <p class="event-title">OUT</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row_new->preno_al)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row_new->preno_al)); ?></p>
                        </div>
                        <p> 
                            <?php if ($row_new->agenzia_nome) { ?>
                                By <?php
                                echo ($row_new->agenzia_nome ) . '<br>';
                            }
                            ?>
                        </p>
                    
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 large-12 columns">
                            
                            <?php if($row_new->preno_stato != 9){ ?>
                            
                            <a href="<?php echo base_url(); ?>/index.php/clienti/bookings_edit/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>/<?php echo $row_new->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button success right"><?php echo $lg_tex['amm_preno']; ?></a>
                       
                            <?php } else { ?>
                            <a href="#" class="button alert right"> <?php echo $lg_tex['cax']; ?> </a>
    <?php  } ?>
                        </div>
                    </div>
                </fieldset>
            </div>
        <?php } ?>

    </fieldset>
</div>


<div class="old_preno">
    <fieldset>
        <legend> Old Preno</legend>
        



<?php foreach ($conti_old as $key => $row) { ?>
    <div>
        <fieldset>
            <legend> Booking id : <?php echo $row->preno_id; ?></legend>
            <div class="row box_cancellata ">
                
               
                    
               
                <div class="small-12 medium-5 large-5 columns">
                    <img src="<?php echo base_url(); ?><?php echo $row->hotel_foto_piccola; ?>"/>
                </div>
                <div class="small-12 medium-7 large-7 columns">
                    <h4>  <?php echo $row->hotel_tipologia; ?>  <?php echo $row->nome_hotel; ?></h4>
                    <p>
                        ROOM: <?php echo $row->numero_camera; ?> 
                    </p> 
           
                       
                    <div class="event-date">
                            <p class="event-title">IN</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row->preno_dal)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row->preno_dal)); ?></p>
                        </div>
                        <div class="event-date">
                            <p class="event-title">OUT</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row->preno_al)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row->preno_al)); ?></p>
                        </div>
                        <p> 
                            <?php if ($row->agenzia_nome) { ?>
                                By <?php
                                echo ($row->agenzia_nome ) . '<br>';
                            }
                            ?>
                        </p>
                    
          
                    </div>
                    </div>
            
            <div class="row">
                <p> &#8203;</p>
            </div>
                   
            <div class="row">
               
                 <div class="small-12 large-12 columns">
                     
                     
     
                       
                   
<ul class="button-group radius right">
<!--<li><a href="#" class="button">Punti</a></li>-->
<li><a href="<?php echo base_url(); ?>index.php/clienti/bookings_edit/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>/<?php  echo  $row->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button secondary "><?php echo $lg_tex['vedi_preno']; ?></a></li>

    <?php if (!isset($row->review_id)) { ?>
<li><a href="<?php echo base_url(); ?>index.php/obmp_review/insert/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>?lg=<?php echo $this->lg; ?>" class="button"><?php echo $lg_tex['scrivi_review']; ?></a></li>
<?php } else { ?>
<li><a href="<?php echo base_url(); ?>index.php/obmp_review/edit/<?php echo $row->conto_id; ?>/<?php  echo  $row->clienti_id; ?>?lg=<?php echo $this->lg; ?> " class="button success"><?php echo $lg_tex['leggi_review']; ?></a></li>
<?php } ?>
</ul>                                      

                                                       
                   
                   
                   </div>
            </div>
            
        </fieldset>
    </div>
<?php } ?>

            </fieldset>

 </div>
