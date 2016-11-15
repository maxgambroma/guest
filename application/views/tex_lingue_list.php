
        <?php 
            //  tex_lingue_list.php
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
            <caption>tex_lingue</caption>
            <thead>
            <tr>
               <th><?php echo $this->lang->line('tex_lingue_id') ; ?></th>
               <th><?php echo $this->lang->line('etichetta_lg') ; ?></th>
               <th><?php echo $this->lang->line('en') ; ?></th>
               <th><?php echo $this->lang->line('it') ; ?></th>
               <th><?php echo $this->lang->line('es') ; ?></th>
               <th><?php echo $this->lang->line('fr') ; ?></th>
               <th><?php echo $this->lang->line('de') ; ?></th>    
            </tr>
            </thead>
            <tbody> 
           <?php  foreach($rs_tex_lingue as  $val) { ?>
            <tr> 
              <td><a href = '<?php echo base_url(); ?>index.php/tex_lingue/edit/?tex_lingue_id=<?php echo $val->tex_lingue_id;?>'><?php echo $val->tex_lingue_id;?></a></td>
              <td><?php echo $val->etichetta_lg ; ?></td>
              <td><?php echo $val->en ; ?></td>
              <td><?php echo $val->it ; ?></td>
              <td><?php echo $val->es ; ?></td>
              <td><?php echo $val->fr ; ?></td>
              <td><?php echo $val->de ; ?></td>         
                </tr>
                <?php } ?>
                </tbody>
                </table>
                <div>
                <fieldset>
                <a href="
                <?php echo base_url(); ?>index.php/tex_lingue/insert/?<?php echo $_SERVER['QUERY_STRING']?>"> <input type="button" value="Insert Record" class="button" /></a>
                </fieldset>  
                </div>
                </fieldset>
                </div>