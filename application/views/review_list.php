<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
// print_r($review);    
// print_r($review_avg);

/* 
    [0] => stdClass Object
        (
            [Clean] => 10
            [Comfort] => 8.0000
            [Location] => 6
            [Services] => 5.6667
            [Staff] => 10.0000
            [Value_for_money] => 8
            [Total_score] => 8
            [review_id] => 981
            [hotel_id] => 4
            [preno_id] => 122951
            [conto_id] => 223390
            [postazione_id] => 
            [nome] => KARAMPETIAN
            [stato] => 220
            [user_type] => 2
            [Rumore_camere] => 8
            [Spazio_camera] => 6
            [Spazi_comuni] => 10
            [Dintorni] => 6
            [Qualita_servizi] => 10
            [Colazione] => 6
            [Accoglienza] => 10
            [Competenza_impiegati] => 10
            [Prezzo_qualita] => 8
            [Giudizio_totale] => 8
            [Raccomandi] => 10
            [commento_tex] => 
            [ip_review] => 81.243.142.180
            [data_review] => 2015-10-26
            [review_data_record] => 2015-10-26 22:00:48
            [numero_camera] => 305
            [preno_agenzia] => 600
			
			  `agenzie`.agenzia_nome,

  `clienti`.clienti_nome,
  `clienti`.clienti_cogno,
  `clienti`.cliente_nazione
*/
//print_r($review_avg);





?>
<div class="row"> 
    <div  class="large-12 small-12 columns"   >
        <fieldset>
            <legend> Generale </legend>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Totale:
                </div>
                <div class="large-8  small-8  columns">
                    <div class="review-bar" style="width: <?php echo $review_avg['0']->Total_score * 10; ?>%;" > <?php echo round($review_avg['0']->Total_score, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Clean:
                </div>
                <div class="large-8  small-8  columns">
                    <div class="review-bar" style="width: <?php echo $review_avg['0']->Clean * 10; ?>%;" > <?php echo round($review_avg['0']->Clean, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Comfort:
                </div>
                <div class="large-8  small-8  columns">
                    <div class="review-bar" style="width: <?php echo $review_avg['0']->Comfort * 10; ?>%;" > <?php echo round($review_avg['0']->Comfort, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Location:
                </div>
                <div class="large-8 small-8   columns">
                    <div class="review-bar" style="width: <?php echo $review_avg['0']->Location * 10; ?>%;"  > <?php echo round($review_avg['0']->Location, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Services:
                </div>
                <div class="large-8 small-8   columns">
                    <div class="review-bar"  style="width: <?php echo $review_avg['0']->Services * 10; ?>%;"  > <?php echo round($review_avg['0']->Services, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4  small-4  columns">
                    Staff:
                </div>
                <div class="large-8 small-8   columns">
                    <div class="review-bar" style="width: <?php echo $review_avg['0']->Staff * 10; ?>%;"  > <?php echo round($review_avg['0']->Staff, 2); ?> </div>
                </div>
            </div>
            <div class="row">
                <div class="large-4 small-4   columns">
                    Valore/Qualità:
                </div>
                <div class="large-8 small-8   columns">
                    <div class="review-bar"  style="width: <?php echo $review_avg['0']->Value_for_money * 10; ?>%;"  > <?php echo round($review_avg['0']->Value_for_money, 2); ?> </div>
                </div>
            </div>
    </div>
</div>
<?php
$i = 0;
foreach ($review as $row) {
    ?>
    <?php if ($i == 0) { ?>		
        <div class="row">
        <?php } ?>
        <!-- quadrato  <?php echo $i; ?>-->
        <div  class="large-6 small-12 columns"   >
            <fieldset>
                <legend>Data : <?php echo $row->data_review; ?> </legend>
                <div class="row">
                    <div class="large-12   columns">
                        <div class="row">  
                            <div class="large-6 small-6  columns">
                                <h3> Rooom: <?php echo $row->numero_camera; ?></h3> 
                            </div>
                            <div class="large-6 small-6  columns">
                                <h2><?php echo round($row->Total_score, 2); ?></h2> 
                            </div>
                        </div>
                        Cliente : <?php echo $row->clienti_cogno; ?>  <small>( <?php echo $row->Nazioni_Descrizione; ?> ) </small> <br>
                        Agenzia : <?php echo $row->agenzia_nome; ?> <br>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Clean:
                    </div>
                    <div class="large-6  small-8  columns">
                        <div class="review-bar" style="width: <?php echo $row->Clean * 10; ?>%;" > <?php echo round($row->Clean, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Comfort:
                    </div>
                    <div class="large-6  small-8  columns">
                        <div class="review-bar" style="width: <?php echo $row->Comfort * 10; ?>%;" > <?php echo round($row->Comfort, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Location:
                    </div>
                    <div class="large-6 small-8   columns">
                        <div class="review-bar" style="width: <?php echo $row->Location * 10; ?>%;"  > <?php echo round($row->Location, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Services:
                    </div>
                    <div class="large-6 small-8   columns">
                        <div class="review-bar"  style="width: <?php echo $row->Services * 10; ?>%;"  > <?php echo round($row->Services, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6  small-4  columns">
                        Staff:
                    </div>
                    <div class="large-6 small-8   columns">
                        <div class="review-bar" style="width: <?php echo $row->Staff * 10; ?>%;"  > <?php echo round($row->Staff, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Valore/Qualità:
                    </div>
                    <div class="large-6 small-8   columns">
                        <div class="review-bar"  style="width: <?php echo $row->Value_for_money * 10; ?>%;"  > <?php echo round($row->Value_for_money, 2); ?> </div>
                    </div>
                </div>
                <div class="row">
                    <div class="large-6 small-4   columns">
                        Raccomandi:
                    </div>
                    <div class="large-6 small-8   columns">


                        <img src="<?php echo base_url(); ?>asset/img/images<?php echo ($row->Raccomandi == 10 ) ? 'Ok' : 'Ko'; ?>.png" width="30" height="30" alt="<?php echo $row->Raccomandi; ?>"/>

                    </div>
                </div>
                <blockquote><?php echo $row->commento_tex; ?></blockquote>
            </fieldset>
        </div>
        <!-- / quadrato -->
        <?php
        if ($i != 1) {
            $i++;
        } else {

            $i = 0;

            echo '</div>';
        }
        ?>
    <?php } ?>