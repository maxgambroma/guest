
        <?php 
//        
// print_r($rs_clienti)  ;      
//  (
//            [conto_id] => 238925
//            [conti_stato_camere] => 4
//            [in_conto] => 2016-09-12
//            [in_conto_time] => 2016-09-12 08:26:53
//            [out_conto] => 0000-00-00
//            [out_preno] => 2016-09-21
//            [privacy] => 0
//            [marketing] => 0
//            [cliente_nazione] => ROMANIA
//            [hotel_id] => 1
//            [clienti_nome] => LAURENTIU
//            [clienti_cogno] => GABOR
//            [cliente_sesso] => M
//            [clienti_id] => 79547
//            [numero_camera] => 103

        
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
            <div> <?php // echo  $pagination; ?> </div>
           <table  id='tablesorter' class='tablesorter' >
            <caption>clienti</caption>
            <thead>
            <tr>
               <th><?php echo $this->lang->line('clienti_id') ; ?></th>
               <th><?php echo $this->lang->line('numero_camera') ; ?></th>
               <th><?php echo $this->lang->line('clienti_nome') ; ?></th>
               <th><?php echo $this->lang->line('clienti_cogno') ; ?></th>            
               <th><?php echo $this->lang->line('cliente_sesso') ; ?></th>
               <th><?php echo $this->lang->line('privacy') ; ?></th> 
               <th><?php echo $this->lang->line('cliente_nazione') ; ?></th> 
            </tr>
            </thead>
            <tbody> 
           <?php  foreach($rs_clienti as  $val) { ?>
            <tr> 
              <td><a href = '<?php echo base_url(); ?>index.php/clienti/edit_privacy/<?php echo $val->conto_id;?>/<?php echo $val->clienti_id;?>/?hotel_id=<?php echo $hotel_id; ?>&lg=<?php echo $this->input->get('lg') ; ?>'><?php echo $val->clienti_id;?></a></td>    
              <td><?php echo $val->numero_camera ; ?></td>
              <td><?php echo $val->clienti_nome ; ?></td>
              <td><?php echo $val->clienti_cogno ; ?></td>
              <td><?php echo $val->cliente_sesso ; ?></td>
              <td><?php echo $val->privacy ; ?></td>
                <td><?php echo $val->cliente_nazione ; ?></td>    
                </tr>
                <?php } ?>
                </tbody>
                </table>
            
<!--                <div>
                <fieldset>
                <a href="
                <?php // echo base_url(); ?>index.php/clienti/insert/?<?php // echo $_SERVER['QUERY_STRING']?>"> <input type="button" value="Insert Record" class="button" /></a>
                </fieldset>  
                </div>
                </fieldset>
                </div>-->