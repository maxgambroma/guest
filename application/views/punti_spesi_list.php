
        <?php 
            //  punti_spesi_list.php
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
            <caption>punti_spesi</caption>
            <thead>
            <tr>
               <th><?php echo $this->lang->line('punti_spesi_id') ; ?></th>
               <th><?php echo $this->lang->line('hotel_id') ; ?></th>
               <th><?php echo $this->lang->line('cliente_id') ; ?></th>
               <th><?php echo $this->lang->line('conto_id') ; ?></th>
               <th><?php echo $this->lang->line('punti') ; ?></th>
               <th><?php echo $this->lang->line('data') ; ?></th>
               <th><?php echo $this->lang->line('data_record') ; ?></th>
               <th><?php echo $this->lang->line('utente_id') ; ?></th>    
            </tr>
            </thead>
            <tbody> 
           <?php  foreach($rs_punti_spesi as  $val) { ?>
            <tr> 
              <td><a href = '<?php echo base_url(); ?>index.php/punti_spesi/edit/?punti_spesi_id=<?php echo $val->punti_spesi_id;?>'><?php echo $val->punti_spesi_id;?></a></td>
              <td><?php echo $val->hotel_id ; ?></td>
              <td><?php echo $val->cliente_id ; ?></td>
              <td><?php echo $val->conto_id ; ?></td>
              <td><?php echo $val->punti ; ?></td>
              <td><?php echo $val->data ; ?></td>
              <td><?php echo $val->data_record ; ?></td>
              <td><?php echo $val->utente_id ; ?></td>         
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <div>
                <fieldset>
                <a href="
                <?php echo base_url(); ?>index.php/punti_spesi/insert/?<?php echo $_SERVER['QUERY_STRING']?>"> <input type="button" value="Insert Record" class="button" /></a>
                </fieldset>  
                </div>
                </fieldset>
                </div>