<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($preno_new);

?>





<fieldset>
    <legend>Cambia le date </legend>
    Stai per modificare le date della tua prenotazione
    <div class="row">
        <div class="small-12 large-12 columns">
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
                        <td> <?php echo $importo; ?> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="small-12 large-12 columns">


            <ul class="button-group">
                <li><a href="#" class="button alert  ">Annulla</a></li>
                <li><a href="#" class="button success ">Confermo</a></li>

            </ul>
        </div>

</fieldset>