<div class="row">
		<div class="large-9  columns">
		<fieldset>
		
                    <?php if( $cliente ){  ?>
                    
		<img src="<?php echo base_url(); ?>asset/img/coupon_img.gif" align="left" />
                
		<h2>Regaliamo  10 &euro; al giorno! </h2>
		
                <p>Stampa questo Coupon e prenota attraverso il nostro sito <a href="http://www.<?php echo $albergo[0]->hotel_web ; ?>/">www.<?php echo $albergo[0]->hotel_web ; ;?></a></p>
		
                <p> All'arrivo consegnalo al concierge e riceverai in omaggio 10 € di credito per camera per notte da consumare nel nostro albergo.</p>
		<?php   }  ?>
		</fieldset>
		</div>

  <div class="large-3 columns">
  <fieldset>

      
    	<?php if($cliente) { ?>
    
    	  <h2>N° <?php echo $cliente->conto_id; ?></h2>
      
     <h4>Restrizioni:</h4>

      <p>Valido fino al:<br>
 <?php  echo $valido ; ?></p>
 
 <p>
Soggiorno minimo di 2 notti
dal Veneredì al Lunedì</p>
         <?php } ?>

    </fieldset> 
  </div>
</div>