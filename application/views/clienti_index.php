<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// print_r($rs_clienti);
    ?>
    <div class="panel">
        Ciao <?php echo $this->session->clienti_nome; ?>, <br>
        <?php echo $lg_tex['vantaggi_breve']; ?> <br>
        <span id="vantaggi_apri" class="apri_pannello"> <i class="fi-plus"></i>   </span>
        <p>&nbsp;</p>

        <div id="vantaggi" style="display: none;" >
            <br>
            <table width="100%">
                <thead>
                    <tr>
                        <th width="80%" ></th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>  <?php echo $lg_tex['vantaggi_inferiore']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td>  <?php echo $lg_tex['vantaggi_fedelta']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td><?php echo $lg_tex['vantaggi_early']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td><?php echo $lg_tex['vantaggi_late']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td><?php echo $lg_tex['vantaggi_upgrade']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td><?php echo $lg_tex['vantaggi_bottiglia']; ?></td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                </tbody>
            </table>
            <p>
                <?php echo $lg_tex['vantaggi_dispo']; ?>
                <span id="vantaggi_chiudi" class="chiudi_pannello"> <i class="fi-x-circle"></i>   </span>
            </p>
            <p>&nbsp;</p>
        </div>
    </div>




        <div class="panel callout radius">
            <p>
            <h2><?php echo $lg_tex['punti_tot']; ?> : <?php echo isset($punti)? $punti : 0;  ?></h2>
            <p>
                <span id="punti_apri" class="apri_pannello"> <i class="fi-plus"></i>   </span>
            <p>&nbsp;</p>

            <div id="punti" style="display: none;" >
                <?php echo $lg_tex['punti_soggiorno']; ?>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Punti</th>
                            <th>Coupon in Euro (**) </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>50</td>
                            <td>10,00</td>
                        </tr>
                        <tr>
                            <td>100</td>
                            <td>20,00</td>
                        </tr>
                        <tr>
                            <td>150</td>
                            <td>40,00</td>
                        </tr>
                        <tr>
                            <td>200</td>
                            <td>60,00</td>
                        </tr>
                        <tr>
                            <td>250</td>
                            <td>100.00</td>
                        </tr>
                        <tr>
                            <td>300</td>
                            <td>120.00</td>
                        </tr>
                        <tr>
                            <td>350</td>
                            <td>175.00</td>
                        </tr>
                        <tr>
                            <td>400</td>
                            <td>220.00</td>
                        </tr>
                    </tbody>
                </table>
                <?php echo $lg_tex['punti_calcolo']; ?>
                <br>
                <?php echo $lg_tex['punti_dove_spendi']; ?>
                <span id="punti_chiudi" class="chiudi_pannello"> <i class="fi-x-circle"></i> </span>
                <p>&nbsp;</p>
            </div>
        </div>





<?php if ( isset($conti) ) { ?>
    <div class="panel">
        <div class="row">
            <div class="large-12 columns"> 
        
        <h4>Room</h4>
        <img src="<?php echo base_url(); ?>/asset/img/governante.jpg" width="80" height="80" align="left" style="margin: 10px; " />
        <p>   Salve, sono Mirella e mi sono occupata delle tua camere.
            Qui puo esprimere un giudizzio per migliorere il soggiorno.
        </p>
            </div>
        </div>

        <div class="row">
            <div class="large-6 columns"> 
                <fieldset>
                    <legend> Cosa ti è piaciuto? </legend>
                    <ol>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Letto confortevole</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Pulita </label> </li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Rinnovata / nuova</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Ottimi servizi</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Spaziosa </label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Silenziosa</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Bagno pulito</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Altro</label></li>
                    </ol>
                </fieldset>        
            </div>

            <div class="large-6 columns"> 
                <fieldset> 
                    <legend>Cosa non ti è piaciuto? </legend>
                    <ol>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Letto pessimo</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Scarsa pulizia</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Vecchia/obsoleta</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Pochi servizi</label> </li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Piccola</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Rumorosa</label></li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Bagno sporco</label> </li>
                        <li><input type="checkbox" name="" value="ON" /><label for="">Altro</label></li>
                    </ol>
                </fieldset>
            </div>

        </div>

    </div>

    <div class="panel"> 
        <div class="row">
            <div class="large-12 columns"> 
                <img src="<?php echo base_url(); ?>/asset/img/manutenzione.png" width="50" height="50" align="left"  />  
                <h4> Segnala un Malfunzionamento  </h4> 
                <textarea name="" rows="4" cols="20">
                </textarea>
                <input class="button"  type="submit" value="invia" />
            </div>
        </div> 
    </div>

    <div class="panel"> 
        <div class="row">

            <div class="large-6 columns"> 
                <ul class="pricing-table">
                    <li class="title">ROOM N° <?php echo $conti[0]->numero_camera; ?></li>
                    <li class="price"> <?php echo $lg_tex['imp_camera']; ?> <?php echo $conti_saldo['conto_camera']; ?></li>
                    <li class="bullet-item"> <?php echo $lg_tex['check-in']; ?> <?php echo $conti[0]->in_conto; ?> <?php echo $lg_tex['check-out'] ?> <?php echo $conti[0]->out_preno; ?></li>
                    <li class="bullet-item"><?php echo $lg_tex['extra']; ?> <?php echo $conti_saldo['totale_extra']; ?></li>
                    <li class="bullet-item"><?php echo $lg_tex['acconti']; ?> <?php echo $conti_saldo['totale_acconti']; ?></li>
                    <li class="bullet-item"><?php echo $lg_tex['saldo']; ?>  <?php echo $conti_saldo['saldo_preno']; ?></li>
                    <li class="cta-button"><a class="button" href="#">Buy Now</a></li>
                </ul>
            </div>

            <div class="large-6 columns">   
                <ul class="pricing-table">
                    <li class="title">Utilizza i tuoi punti</li>
                    <li class="price">
                        <select name="punti">
                            <option>50   10&#8364;</option>
                            <option>100  20&#8364;</option>
                            <option>150  40&#8364;</option>
                            <option>200  60&#8364;</option>
                            <option>250 100&#8364;</option>
                        </select>
                    </li>
                    <li class="bullet-item"> <p>Ottieni una riduzione del tuo conto al momento del Check-Out  </p></li>
                    <li class="cta-button"><a class="button" href="#">Buy Now</a></li>
                </ul>
            </div>

        </div>
    </div>
<?php } ?>
<?php // } ?>


<?php if (isset($preno)) { ?>
    <?php foreach ($preno as $key => $row_new) { ?>
        <div>
            <fieldset>
                <legend> Booking id : <?php echo $row_new->preno_id; ?></legend>
                <div class="row">
                    <div class="small-12 medium-4 large-5 columns">
                        <img src="<?php echo base_url(); ?><?php echo $row_new->hotel_foto_piccola; ?>"/>
                    </div>

                    <div class="small-12  medium-8 large-7 columns">
                        <h4> <?php echo $row_new->hotel_tipologia; ?>  <?php echo $row_new->nome_hotel; ?> <?php echo $row_new->hotel_citta; ?></h4>
                        <div class="event-date">
                            <p class="event-title">IN</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row_new->preno_dal)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row_new->preno_dal)); ?></p>
                        </div>

                        <div class="event-date">
                            <p class="event-title">OUT</p>
                            <p class="event-month"><?php echo date('M y', strtotime($row_new->preno_al)); ?></p>
                            <p class="event-day"><?php echo date('d', strtotime($row_new->preno_al)); ?></p>
                        </div>

                        <p> 
                            <?php if ($row_new->agenzia_nome) { ?>
                                By <?php
                                echo ($row_new->agenzia_nome ) . '<br>';
                            }
                            ?>
                        </p>
                        <div class="row">
                            <div class="small-12 large-12 columns">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="small-12 large-12 columns">
                        <p>
                            <a href="<?php echo base_url(); ?>/index.php/clienti/bookings_edit/<?php echo $row_new->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button right">Amminista Prenotazione</a>
                        </p>
                    </div>
                </div>
            </fieldset>
        </div>
    <?php } ?>
<?php } ?>

<script>
    $("#vantaggi_apri").click(function () {
        $("#vantaggi").toggle("slow");
    });

    $("#vantaggi_chiudi").click(function () {
        $("#vantaggi").toggle("slow");
    });

    $("#punti_apri").click(function () {
        $("#punti").toggle("slow");
    });

    $("#punti_chiudi").click(function () {
        $("#punti").toggle("slow");
    });
</script>






