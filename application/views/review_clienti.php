<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


?>


<?php  
         
        
  foreach ($reviews  as $review) {
    

        
        ?> 
<div class="row"> 
<div class="large-12 small-12  columns">

<fieldset>
                    <legend> </legend>
                    
                    <div class="row">
                        <div class="large-12   columns">
                            <div class="row">  
                                <div class="large-6 small-4  columns">
                                     <img src="<?php echo base_url(); ?><?php echo $review->hotel_foto_piccola; ?>"/>
                                     <br>
                                     <br>
                                </div>
                                <div class="large-6 small-8  columns">
                               
                                     
                                      <h3> <?php echo $this->lang->line('rev_Totel'); ?> <?php echo round($review->Total_score, 2); ?> </h3> 
                                         <h5> <?php echo $review->hotel_tipologia; ?>  <?php echo $review->nome_hotel; ?> </h5>
                                         <p><?php echo $this->lang->line('room_numbar'); ?> : <?php echo $review->numero_camera; ?> <br>
                                          IN <?php echo $review->in_conto ?>  <br>
                                          OUT <?php echo $review->out_conto ?> </p>
                                      <p>  <?php echo    $review->agenzia_nome ; ?>    </p>
                                      <a href="<?php echo base_url(); ?>index.php/obmp_review/edit/<?php echo $review->conto_id; ?>/<?php  echo  $review->clienti_id; ?>?lg=<?php echo $this->lg; ?> " class="button right tiny">Vedi</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Clean'); ?>:
                        </div>
                        <div class="large-6  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review->Clean * 10; ?>%;" > <?php echo round($review->Clean, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Comfort'); ?>:
                        </div>
                        <div class="large-6  small-8  columns">
                            <div class="review-bar" style="width: <?php echo $review->Comfort * 10; ?>%;" > <?php echo round($review->Comfort, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Location'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review->Location * 10; ?>%;"  > <?php echo round($review->Location, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Services'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review->Services * 10; ?>%;"  > <?php echo round($review->Services, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6  small-4  columns">
    <?php echo $this->lang->line('rev_Staff'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar" style="width: <?php echo $review->Staff * 10; ?>%;"  > <?php echo round($review->Staff, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_ValQua'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <div class="review-bar"  style="width: <?php echo $review->Value_for_money * 10; ?>%;"  > <?php echo round($review->Value_for_money, 2); ?> </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-6 small-4   columns">
    <?php echo $this->lang->line('rev_Raccomandi'); ?>:
                        </div>
                        <div class="large-6 small-8   columns">
                            <img src="<?php echo base_url(); ?>asset/img/images<?php echo ($review->Raccomandi == 10 ) ? 'Ok' : 'Ko'; ?>.png" width="30" height="30" alt="<?php echo $review->Raccomandi; ?>"/>
                        </div>
                    </div>
                    <blockquote><?php echo $review->commento_tex; ?></blockquote>
                </fieldset>
            </div>
    
    </div>

<?php   }  ?> 