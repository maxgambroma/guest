<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if ($rs_clienti) {

// print_r($rs_clienti);
    ?>

    <div class="panel">
        <p>
            Ciao <?php echo $rs_clienti[0]->clienti_nome; ?>, <br>
            Prenota il tuo prossimo viaggio direttamente qui e avrai i seguenti Vantaggi
        </p>

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
                        <td>Tariffe inferiore del 5% rispetto a Booking e Expedia  </td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td>Early check-in a partire dalle 10:00*</td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td>Late Check-out fino alle 13,00*</td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td> Upgrade a Camera di categoria Superiore* </td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                    <tr>
                        <td>1 Bottiglia d'Acqua Minerale </td>
                        <td><i class="fi-check"></i></td>
                    </tr>
                </tbody>
            </table>
            <p>
                (*) Questo servizio è soggetto a disponibilità
                <span id="vantaggi_chiudi" class="chiudi_pannello"> <i class="fi-x-circle"></i>   </span>
            </p>
            <p>&nbsp;</p>


        </div>


    </div>

    <?php if (isset($punti)) { ?>
        <div class="panel callout radius">
            <p>
            <h2> <?php echo lang('punti_tex') ?>: <?php echo $punti; ?></h2>
            <p>
                <span id="punti_apri" class="apri_pannello"> <i class="fi-plus"></i>   </span>
            <p>&nbsp;</p>

            <div id="punti" style="display: none;" >
                Ogni volta che soggiorni * nei nostri alberghi ricevi 1 punto per ogni 10 Euro speso per  il soggiorno
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
                (*) vengono  calcolato solo i soggiorni  prenotati on-line sul booking dell’hotel e hanno scadenze annuale
                <br>
                (**)Il Coupon è spendibile in ogni nostro hotel

                <span id="punti_chiudi" class="chiudi_pannello"> <i class="fi-x-circle"></i> </span>


                </p>
                <p>&nbsp;</p>

            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="panel callout radius">
        <p>
            Cliente non riconosciuto
        </p>
    </div>
    <?php
}
?>



<?php if ($conti) { ?>

<div class="panel">
    <h4>Room</h4>

<div class="row">
<div class="large-6 columns">

C

</div>
    
<div class="large-6 columns"> 
    



<ul class="pricing-table">
<li class="title">ROOM N° <?php echo $conti[0]->numero_camera; ?></li>
<li class="price"> Importo Camera <?php echo $conti_saldo['conto_camera']; ?></li>
<li class="bullet-item"> IN <?php echo $conti[0]->in_conto; ?> OUT <?php echo $conti[0]->out_preno; ?></li>
<li class="bullet-item">Extra <?php echo $conti_saldo['totale_extra']; ?></li>
<li class="bullet-item">Acconti <?php echo $conti_saldo['totale_acconti']; ?></li>
<li class="bullet-item">Saldo Soggiorno <?php echo $conti_saldo['saldo_preno']; ?></li>
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
                            <a href="<?php echo base_url(); ?>/index.php/clienti/bookings_edit/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>/<?php echo $row_new->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button right">Amminista Prenotazione</a>
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






