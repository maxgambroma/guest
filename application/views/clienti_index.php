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
        </p>
    </div>

    <?php if (isset($punti)) { ?>
        <div class="panel callout radius">
            <p> 
            <h2> <?php echo lang('punti_tex') ?>: <?php echo $punti; ?></h2>
            <p>         
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
            </p> 
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


<?php

// conti aperti
// 

 print_r($conti_saldo) ;

//foreach ($conti as $key => $value) {
//    
//    [conto_id] => 159576
//            [hotel_id] => 
//            [foglio_id] => 187459
//            [clienti_id] => 67491
//            [in_conto] => 2012-12-06
//            [in_conto_time] => 2012-12-06 10:06:05
//            [out_preno] => 2012-12-07
//            [out_conto] => 2012-12-07
//            [preno_id] => 88262
//            [camera_id] => 68
//            [numero_camera] => 204
//            [trattamento_sog] => BB
//            [tipo_camera] => Doppia Uso
//            [tipologia_id] => 7
//            [prezzo] => 125.00
//            [nome_cliente] => ROBERTO
//            [cognome_cliente] => PAOLUZZI
//            [preno_agenzia] => 0
//            [mercato] => 
//            [conti_stato_camere] => 7
//            [acconto] => 
//            [conto_pag_modalita] => 
//            [data_record] => 2012-12-07 08:48:37
//       
//ray
//(
//    [totale_notti] => 1
//    [iporto_conto_camera] => 0
//    [totale_extra] => 2
//    [totale_acconti] => 127
//    [totale_a_saldo] => -125
//    [totale_saldo_previsto] => -125
//    [totale_conto_previsto] => 2
//)

?>

<ul class="pricing-table">
  <li class="title">MR  <?php echo $conti[0]->clienti_nome; ?>  ROOM N° <?php echo $conti[0]->numero_camera; ?></li>
  <li class="price"> Importo Camera <?php echo $conti_saldo['iporto_conto_camera']; ?></li>
  <li class="description"> IN <?php echo $conti[0]->in_conto; ?> OUT <?php echo $conti[0]->out_preno; ?></li>
  <li class="bullet-item">Acconto <?php echo $conti_saldo['totale_acconti']; ?></li>
  <li class="bullet-item">Totale a Saldo ad oggi <?php echo $conti_saldo['totale_a_saldo']; ?></li>
  <li class="bullet-item">Saldo previsto <?php echo $conti_saldo['totale_saldo_previsto']; ?></li>
    <li class="bullet-item"><?php echo $conti_saldo['totale_conto_previsto']; ?></li>
  <li class="cta-button"><a class="button" href="#">Buy Now</a></li>
</ul>


<?php // } ?>



<?php if (isset($preno)) { ?>
    <?php foreach ($preno as $key => $row_new) { ?>
        <div>
            <fieldset>
                <legend> Booking id : <?php echo $row_new->preno_id; ?></legend>
                <div class="row">
                    <div class="small-5 large-5 columns">
                        <img src="<?php echo base_url(); ?><?php echo $row_new->hotel_foto_piccola; ?>"/>
                    </div>
                    <div class="small-7 large-7 columns">
                        <h4>  <?php echo $row_new->hotel_tipologia; ?>  <?php echo $row_new->nome_hotel; ?></h4>
                        <p>
                            <?php if ($row_new->agenzia_nome) { ?>  By <?php echo ($row_new->agenzia_nome ) . '<br>';
                }
                            ?>
                            IN: <?php echo $row_new->preno_dal; ?> <br>
                            OUT: <?php echo $row_new->preno_al; ?> <br>
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
                        <ul class="button-group radius ">
<!--                            <li><a href="#" class="button">Cancella Prentoazione</a></li>-->
                            <li><a href="<?php echo base_url(); ?>/index.php/clienti/bookings_edit/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>/<?php echo $row_new->preno_id; ?>?lg=<?php echo $this->lg; ?>" class="button">Vedi Prenotazione</a></li>
                        </ul> 
                        </p>
                    </div>
                </div>
            </fieldset>
        </div>
    <?php } ?>
<?php } ?>
