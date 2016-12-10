<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($preno_new);
// print_r($disponibilita);
?>


<?php
// Change the css classes to suit your needs    
$attributes = array('class' => '', 'id' => '');
echo form_open( base_url().'index.php/agenda/edit_data_preno', $attributes);
?>     
<fieldset>
    <legend>Cambia le date </legend>
    <?php echo $lg_tex['cambia_data_tex']; ?>
    <div class="row">
        <div class="small-12 large-12 columns">
            <table >
                <thead>
                    <tr>
                        <th></th>
                        <th><?php echo $lg_tex['check-in']; ?></th>
                        <th><?php echo $lg_tex['check-out']; ?></th>
                        <th><?php echo $lg_tex['totale_price']; ?></th>
                        <th><?php echo $lg_tex['night']; ?></th>
                        <th><?php echo $lg_tex['note']; ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $lg_tex['date_iniziali']; ?></td>
                        <td><?php echo $preno->preno_dal; ?></td>
                        <td><?php echo $preno->preno_al; ?></td>
                        <td><?php echo $preno->preno_importo; ?></td>
                        <td><?php echo $preno->preno_n_notti; ?></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><?php echo $lg_tex['nuove_date']; ?></td>
                        <td><?php echo $preno_new['preno_dal']; ?> </td>
                        <td><?php echo $preno_new['preno_al']; ?> </td>
                        <td> <?php echo $importo; ?> </td>
                        <td><?php echo $preno_new['notti']; ?> </td>
                        <td><?php echo max($disponibilita); ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="small-12 large-12 columns">
            <ul class="button-group">
                <?php if (max($disponibilita) == 0) { ?>
                <li>
                    <input class="button success " type="submit" value="<?php  echo   $lg_tex['aggiorna']; ?>" name="go" />
                </li>  <?php
                } else {
                    echo 'Non e possibile modificare con queste date cambia periodo';
                }
                ?>   
            </ul>
        </div>
</fieldset>
<input id="preno_importo" type="hidden" name="preno_importo"  value="<?php echo $importo; ?> "  />
<input id="cambia_data" type="hidden" name="cambia_data"  value="1"  />
<input id="disponibilita" type="hidden" name="disponibilita"  value="<?php echo max($disponibilita) ?>"  />
<input id="conto_id" type="hidden" name="conto_id"  value="<?php echo $this->input->get('conto_id'); ?>"  />
<input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo $this->input->get('clienti_id'); ?>"  />
<input id="preno_id" type="hidden" name="preno_id"  value="<?php echo $preno->preno_id ?>"  />
<input id="preno_dal" type="hidden" name="preno_dal"  value="<?php echo $preno_new['preno_dal'] ?>"  />
<input id="preno_al" type="hidden" name="preno_al"  value="<?php echo $preno_new['preno_al']; ?>"  />
<input id="preno_n_notti" type="hidden" name="preno_n_notti"  value="<?php echo $preno_new['notti']; ?>"  />
<input id="t1" type="hidden" name="t1"  value="<?php echo (!set_value('t1')) ? $preno->t1 : set_value('t1'); ?>"  />
<input id="q1" type="hidden" name="q1"  value="<?php echo (!set_value('q1')) ? $preno->q1 : set_value('q1'); ?>"  />
<input id="p1" type="hidden" name="p1"  value="<?php echo $preno_new['avg_prezzo'][$preno->t1]; ?>"  />
<input id="t2" type="hidden" name="t2"  value="<?php echo (!set_value('t2')) ? $preno->t2 : set_value('t2'); ?>"  />
<input id="q2" type="hidden" name="q2"  value="<?php echo (!set_value('q2')) ? $preno->q2 : set_value('q2'); ?>"  />
<input id="p2" type="hidden" name="p2"  value="<?php echo $preno_new['avg_prezzo'][$preno->t2]; ?>"  />      
<input id="t3" type="hidden" name="t3"  value="<?php echo (!set_value('t3')) ? $preno->t3 : set_value('t3'); ?>"  />
<input id="q3" type="hidden" name="q3"  value="<?php echo (!set_value('q3')) ? $preno->q3 : set_value('q3'); ?>"  />
<input id="p3" type="hidden" name="p3"  value="<?php echo $preno_new['avg_prezzo'][$preno->t3]; ?>"  />  
<input id="t4" type="hidden" name="t4"  value="<?php echo (!set_value('t4')) ? $preno->t4 : set_value('t4'); ?>"  />
<input id="q4" type="hidden" name="q4"  value="<?php echo (!set_value('q4')) ? $preno->q4 : set_value('q4'); ?>"  />
<input id="p4" type="hidden" name="p4"  value="<?php echo $preno_new['avg_prezzo'][$preno->t4]; ?>"  />       
<input id="t5" type="hidden" name="t5"  value="<?php echo (!set_value('t5')) ? $preno->t5 : set_value('t5'); ?>"  />
<input id="q5" type="hidden" name="q5"  value="<?php echo (!set_value('q5')) ? $preno->q5 : set_value('q5'); ?>"  />
<input id="p5" type="hidden" name="p5"  value="<?php echo $preno_new['avg_prezzo'][$preno->t5]; ?>"  />      
<input id="t6" type="hidden" name="t6"  value="<?php echo (!set_value('t6')) ? $preno->t6 : set_value('t6'); ?>"  />
<input id="q6" type="hidden" name="q6"  value="<?php echo (!set_value('q6')) ? $preno->q6 : set_value('q6'); ?>"  />
<input id="p6" type="hidden" name="p6"  value="<?php echo $preno_new['avg_prezzo'][$preno->t6]; ?>"  />
<?php echo form_close(); ?>