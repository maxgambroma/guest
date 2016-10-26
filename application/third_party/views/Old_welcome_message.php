<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php 

$today = date('Y-m-d');
// print_r($partenze);     
// print_r($partiti);     
 // print_r($fermate); media camere   
// // print_r($conti_aperti); 

// 
//
//  $conti_aperti
//        [tipologia_id] => 1
//            [nome_tipologia] => Singola
//            [nome_tipologia_en] => Single
//            [foglio_id] => 278941
//            [hotel_id] => 1
//            [conto_id] => 222111
//            [camera_id] => 163
//            [preno_id] => 0
//            [cognome_cliente] => aut dal carlo magno
//            [in_conto] => 2015-10-04
//            [out_preno] => 2015-10-06
//            [stato_camera] => 4
//            [preno_agenzia] => 0
//            [numero_camera] => 104
//            [tipologia_camera] => 1
//            [in_conto_time] => 2015-10-04 17:08:47
//            [out_conto] => 0000-00-00
//            [conti_stato_camere] => 4
//            [foglio_utente_id] => 
//            [foglio_data_record] => 2015-10-04 17:08:50
//            [nome_cliente] => FEDERICO




//print_r($menu); 
// print_r($arrivi);
//print_r($conti_aperti);
/*


 */
// dati di defoult
$scelta = $conti_aperti;
if ($this->input->get('scelta') == 'conti_aperti') {
    $scelta = $conti_aperti;
}
if ($this->input->get('scelta') == 'partiti') {
    $scelta = $partiti;
}
if ($this->input->get('scelta') == 'partenze') {
    $scelta = $partenze;
}
if ($this->input->get('scelta') == 'arrivi') {
    $scelta = 'arrivi';
}
?>
<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>
            <section class="middle tab-bar-section">
                <h1 class="title">Camere <?php echo $menu[$this->input->get('scelta')]; ?></h1>
            </section>
        </nav>
        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><label>AppHotel</label></li>
                <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'conti_aperti'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Occupate</a></li>
                <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'partiti'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Partite</a></li>
                <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'partenze'; ?>&hotel_id=<?php echo $hotel_id; ?>' >In Partenza</a></li>
                <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'arrivi'; ?>&hotel_id=<?php echo $hotel_id; ?>' >In Arrivo</a></li>
            </ul>
        </aside>
        <section class="main-section">
            <!-- content goes here -->
            <div class="row">
                <div class="large-12 columns">
                    <?php
                    if ($scelta <> 'arrivi') {
                        foreach ($scelta as $row) {
// coloro le partenze
                            if ($row->out_preno > $today) {
                                $colorediv = 'room_fermata';
                                $stato = 'Fermata';
                            } else {
                                $colorediv = 'room_partenza';
                                $stato = 'Partenza';
                            }
                            ?>
							<!-- quadrato -->
                            <a href="<?php echo base_url(); ?>index.php/apphotel/risorsa?conto_id=<?php echo $row->conto_id; ?>&foglio_id=<?php echo $row->foglio_id; ?>&hotel_id=<?php echo $row->hotel_id; ?> ">
                                <div class='<?php echo $colorediv; ?>'  >
                                    <div class="row">
                                        <div class="large-4  small-4 columns">
                                            <i class="fi-check" title="Pronta" ></i>
                                            <?php echo ''; ?>
                                        </div>
                                        <div class="large-4 small-4 columns">
                                            <i class="fi-alert" title="Manutenzione"   ></i>
                                            <?php echo ''; ?>
                                        </div>
                                        <div class="large-4 small-4  columns">
                                            <i class="fi-dollar-bill" title="Adebbiti"  ></i>
                                            <?php echo ''; ?>
                                        </div>
                                    </div>

                                    <h2><?php echo $row->numero_camera; ?></h2>

                                    <span data-tooltip aria-haspopup="true" class="has-tip"
                                          title="<?php echo $row->nome_tipologia; ?> :
                                          <?php echo $row->cognome_cliente . ' ' . $row->nome_cliente; ?>  
                                          In : <?php echo $row->in_conto; ?>
                                          Out : <?php echo $row->out_preno; ?> " >
                                        <p><?php echo $stato ?></p>


                                    </span>
                                </div>
                            </a>
							<!-- / quadrato -->
                            <?php
                        }
                    }
// arrivi
                    if ($scelta == 'arrivi') {
                        foreach ($arrivi as $rowarrivi) {
                            if ($rowarrivi->tipologia_camera == $rowarrivi->nome_tipologia) {
                                $bcolore = 'room_arrivi_ok';
                            } else {
                                $bcolore = 'room_arrivi_ko';
                            }
                            ?>
                            <a  href="<?php echo base_url(); ?>?hotel_id=<?php echo $rowarrivi->hotel_id ;?>" >
                                <div class='<?php echo $bcolore; ?>'  >
                                    <span data-tooltip aria-haspopup="true" class="has-tip"
                                          title="Preparare come <?php echo $rowarrivi->nome_tipologia; ?>">
                                        <h2><?php echo $rowarrivi->numero_camera; ?></h2>
                                    </span>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    echo '<br><br><br><br><br><br><br><br><br><br><br><br>.';
                    ?>
                </div>
            </div>
        </section>
        <a class="exit-off-canvas"></a>
    </div>
</div>
