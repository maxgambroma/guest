    <?php 
            //  obmp_review_list.php
        ?>    
        
            <div>
            <fieldset> 
            <?php if($this->input->get('error')){ ?>
            <div class="error">
              <p>
            <?php echo $this->lang->line($this->input->get('error'), FALSE ) ; ?>
            </p>
            </div> 
            <?php }?>
            <div> <?php echo  $pagination; ?> </div>
           <table  id='tablesorter' class='tablesorter' >
            <caption>obmp_review</caption>
            <thead>
            <tr>
               <th><?php echo $this->lang->line('review_id') ; ?></th>
               <th><?php echo $this->lang->line('hotel_id') ; ?></th>
               <th><?php echo $this->lang->line('preno_id') ; ?></th>
               <th><?php echo $this->lang->line('conto_id') ; ?></th>
               <th><?php echo $this->lang->line('postazione_id') ; ?></th>
               <th><?php echo $this->lang->line('camera_numero') ; ?></th>
               <th><?php echo $this->lang->line('nome') ; ?></th>
               <th><?php echo $this->lang->line('stato') ; ?></th>
               <th><?php echo $this->lang->line('user_type') ; ?></th>
               <th><?php echo $this->lang->line('pulizia_camera') ; ?></th>
               <th><?php echo $this->lang->line('accoglienza') ; ?></th>
               <th><?php echo $this->lang->line('rumore_camere') ; ?></th>
               <th><?php echo $this->lang->line('spazio_camera') ; ?></th>
               <th><?php echo $this->lang->line('spazi_comuni') ; ?></th>
               <th><?php echo $this->lang->line('competenza_impiegati') ; ?></th>
               <th><?php echo $this->lang->line('qualita_servizi') ; ?></th>
               <th><?php echo $this->lang->line('dintorni') ; ?></th>
               <th><?php echo $this->lang->line('colazione') ; ?></th>
               <th><?php echo $this->lang->line('tariffa') ; ?></th>
               <th><?php echo $this->lang->line('servizi_offerti') ; ?></th>
               <th><?php echo $this->lang->line('foto') ; ?></th>
               <th><?php echo $this->lang->line('indicazione_mappa') ; ?></th>
               <th><?php echo $this->lang->line('giudizio_totale') ; ?></th>
               <th><?php echo $this->lang->line('prezzo_qualita') ; ?></th>
               <th><?php echo $this->lang->line('commento_tex') ; ?></th>
               <th><?php echo $this->lang->line('raccomandi') ; ?></th>
               <th><?php echo $this->lang->line('ip_review') ; ?></th>
               <th><?php echo $this->lang->line('data_review') ; ?></th>
               <th><?php echo $this->lang->line('review_data_record') ; ?></th>    
            </tr>
            </thead>
            <tbody> 
           <?php  foreach($rs_obmp_review as  $val) { ?>
            <tr> 
              <td><a href = '<?php echo base_url(); ?>index.php/obmp_review/edit/?review_id=<?php echo $val->review_id;?>'><?php echo $val->review_id;?></a></td>
              <td><?php echo $val->hotel_id ; ?></td>
              <td><?php echo $val->preno_id ; ?></td>
              <td><?php echo $val->conto_id ; ?></td>
              <td><?php echo $val->postazione_id ; ?></td>
              <td><?php echo $val->camera_numero ; ?></td>
              <td><?php echo $val->nome ; ?></td>
              <td><?php echo $val->stato ; ?></td>
              <td><?php echo $val->user_type ; ?></td>
              <td><?php echo $val->pulizia_camera ; ?></td>
              <td><?php echo $val->accoglienza ; ?></td>
              <td><?php echo $val->rumore_camere ; ?></td>
              <td><?php echo $val->spazio_camera ; ?></td>
              <td><?php echo $val->spazi_comuni ; ?></td>
              <td><?php echo $val->competenza_impiegati ; ?></td>
              <td><?php echo $val->qualita_servizi ; ?></td>
              <td><?php echo $val->dintorni ; ?></td>
              <td><?php echo $val->colazione ; ?></td>
              <td><?php echo $val->tariffa ; ?></td>
              <td><?php echo $val->servizi_offerti ; ?></td>
              <td><?php echo $val->foto ; ?></td>
              <td><?php echo $val->indicazione_mappa ; ?></td>
              <td><?php echo $val->giudizio_totale ; ?></td>
              <td><?php echo $val->prezzo_qualita ; ?></td>
              <td><?php // echo $val->commento_tex ; ?></td>
              <td><?php echo $val->raccomandi ; ?></td>
              <td><?php echo $val->ip_review ; ?></td>
              <td><?php echo $val->data_review ; ?></td>
              <td><?php echo $val->review_data_record ; ?></td>         
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <div>
                <fieldset>
                <a href="
                <?php echo base_url(); ?>index.php/obmp_review/insert/?<?php echo $_SERVER['QUERY_STRING']?>"> <input type="button" value="Insert Record" class="button" /></a>
                </fieldset>  
                </div>
                </fieldset>
                </div>