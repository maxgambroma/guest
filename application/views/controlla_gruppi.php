<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<form>

<input type="hidden" name="hotel_id" value="" />
<input type="hidden" name="preno_id" value="" />
<input type="hidden" name="utente_id" value="" />
<input type="hidden" name="date_time" value="" />

<h4> DOCUMENTAZIONE</h4>
<p>
    Hai documentazione per questo gruppo ( email ) ? SI <input type="radio" name="email" value="1" /> | NO <input type="radio" name="email" value="0" />  <br>
Se si l’hai allegata sul PMS ? <input type="checkbox" name="email_pms" value="" /> SI <input type="radio" name="email" value="1" /> | NO <input type="radio" name="email" value="0" />  <br>

Hai la lista nominativa <input type="checkbox" name="lista" value="" />  <br>
Se si l’hai  allegata sul PMS ?  <input type="checkbox" name="lista_pms" value="" />  <br>
 
   </p> 
   <h4>PAGAMENTO </h4>  

   <p>  
 Il pagamento è a sospeso ? <input type="checkbox" name="pagamento" value="" />  <br>
 Le tasse di soggiorno chi le paga ? Clienti <input type="radio" name="tassa" value="1" /> | Agenzia <input type="radio" name="tassa" value="2" />  <br>

Hai inviato il proforma ?  <input type="checkbox" name="proforma" value="" />  <br>
Se si, l’hai  allegata sul PMS ? <input type="checkbox" name="proforma_pms" value="" />  <br>

Hai la copia del bonifico ? <input type="checkbox" name="bonifico" value="" />  <br>
Se si, quale è l'importo ? <input type="text" name="importo" value="" />
Se si,  l’hai allegata sul PMS ? <input type="checkbox" name="bonifico_pms" value="" />  <br>

</p> 
  </form>

