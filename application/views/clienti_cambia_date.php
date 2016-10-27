<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print_r($preno_new);

?>

<table>
    <thead>
        <tr>
            <th></th>
            <th>Arrivo</th>
            <th>Partenza</th>
            <th>Prezzo</th>
           
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Dati iniziali</td>
            <td><?php echo $preno->preno_dal; ?></td>
            <td><?php echo $preno->preno_al; ?></td>
            <td><?php echo $preno->preno_importo; ?></td>
            
        </tr>
        <tr>
            <td>Nuove date</td>
            <td><?php echo $preno_new['preno_dal']; ?> </td>
            <td><?php echo $preno_new['preno_al']; ?> </td>
            <td> <?php echo  ($preno_new['sum_prezzo'][$preno->t1] * $preno->q1 ) ; ?> </td>
           
        </tr>
 
    </tbody>
</table>
