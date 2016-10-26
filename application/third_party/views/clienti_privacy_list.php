
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
        <?php if ($this->input->get('error')) { ?>
            <div class="error">
                <p>
                    <?php echo $this->lang->line($this->input->get('error'), FALSE); ?>
                </p>
            </div> 
        <?php } ?>
        <div> <?php // echo  $pagination;   ?> </div>


        <ul class="tabs" data-tab role="tablist">
            <li class="tab-title active" role="presentation"><a href="#panel2-1" role="tab" tabindex="0" aria-selected="true" aria-controls="panel2-1">Tab 1</a></li>
            <li class="tab-title" role="presentation"><a href="#panel2-2" role="tab" tabindex="0" aria-selected="false" aria-controls="panel2-2">Tab 2</a></li>

        </ul>
        <div class="tabs-content">
            <section role="tabpanel" aria-hidden="false" class="content active" id="panel2-1">
                <h2></h2>
                
                <?php foreach ($rs_clienti as $val) { ?>
                    <a href = '<?php echo base_url(); ?>index.php/clienti/edit_privacy/<?php echo $val->conto_id; ?>/<?php echo $val->clienti_id; ?>/?hotel_id=<?php echo $hotel_id; ?>&lg=<?php echo $this->input->get('lg'); ?>'>
                        <div class='privacy_box'>
                            <h2><?php echo $val->numero_camera; ?></h2> 
                            
                        </div>
                    </a>
                <?php } ?>

            </section>
            <section role="tabpanel" aria-hidden="true" class="content" id="panel2-2">
                     <h2> </h2>
                <table  id='tablesorter' class='tablesorter' >
                    <caption>clienti</caption>
                    <thead>
                        <tr>
                            <th><?php echo $this->lang->line('clienti_id'); ?></th>
                            <th><?php echo $this->lang->line('numero_camera'); ?></th>
                            <th><?php echo $this->lang->line('clienti_nome'); ?></th>
                            <th><?php echo $this->lang->line('clienti_cogno'); ?></th>            
                            <th><?php echo $this->lang->line('cliente_sesso'); ?></th>
                            <th><?php echo $this->lang->line('privacy'); ?></th> 
                            <th><?php echo $this->lang->line('cliente_nazione'); ?></th> 
                        </tr>
                    </thead>
                    <tbody> 
                        <?php foreach ($rs_clienti as $val) { ?>
                            <tr> 
                                <td><a href = '<?php echo base_url(); ?>index.php/clienti/edit_privacy/<?php echo $val->conto_id; ?>/<?php echo $val->clienti_id; ?>/?hotel_id=<?php echo $hotel_id; ?>&lg=<?php echo $this->input->get('lg'); ?>'><?php echo $val->clienti_id; ?></a></td>    
                                <td><?php echo $val->numero_camera; ?></td>
                                <td><?php echo $val->clienti_nome; ?></td>
                                <td><?php echo $val->clienti_cogno; ?></td>
                                <td><?php echo $val->cliente_sesso; ?></td>
                                <td><?php echo $val->privacy; ?></td>
                                <td><?php echo $val->cliente_nazione; ?></td>    
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </section>

        </div>
       
    </fieldset>
</div>



