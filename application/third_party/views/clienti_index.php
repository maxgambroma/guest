<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if($rs_clienti) {
    
   // print_r($rs_clienti);
    
?>



<div class="panel callout radius">

<p> Genius Week <br />
Ciao <?php echo $rs_clienti[0]->clienti_nome ; ?>, non perderti gli sconti e i vantaggi riservati a te questa settimana!

Fino al giorno 27 settembre puoi usufruire di sconti del 10% e vantaggi speciali! Perché non approfittarne per prenotare un viaggetto (o anche due)?
Scopri di più
</p> 

</div>



<?php }

 else {
     ?> 
     
<div class="panel callout radius">
    <p>
Cliente non riconosciuto 
</p> 
</div>

<?php 
 }
 
 ?>