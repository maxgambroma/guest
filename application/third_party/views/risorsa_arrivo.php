
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php // print_r($partenze);                ?>
<?php // print_r($partiti);                ?>
<?php  //print_r($conto);                ?>
<?php // print_r($camera_arrivo);  


$today = date('Y-m-d');

/**  $conti_aperti
            tipologia_camera.tipologia_id,
            tipologia_camera.nome_tipologia,
            tipologia_camera.nome_tipologia_en,
            foglio_giorno.foglio_id,
            foglio_giorno.hotel_id,
            foglio_giorno.conto_id,
            foglio_giorno.preno_id,
            foglio_giorno.tipologia_id,
            foglio_giorno.in_conto,
            foglio_giorno.out_preno,
            foglio_giorno.stato_camera,
            foglio_giorno.preno_agenzia,
            camere.camera_id,
            camere.numero_camera,
            camere.camere_piano,
            camere.tipologia_id AS tipologia_camera,
            conti.in_conto_time,
            conti.out_conto,
            conti.conti_stato_camere,
            foglio_giorno.foglio_utente_id,
            foglio_giorno.foglio_data_record,
            conti.nome_cliente,
            conti.cognome_cliente

/*
 */
?>
<div class="off-canvas-wrap" data-offcanvas>
    <div class="inner-wrap">
        <nav class="tab-bar">
            <section class="left-small">
                <a class="left-off-canvas-toggle menu-icon" href="#"><span></span></a>
            </section>
            <section class="middle tab-bar-section">
                <h1 class="title">Camere  <?php echo $conto['0']->numero_camera; ?> in  <?php echo $status; ?></h1>
            </section>
        </nav> 
        <aside class="left-off-canvas-menu">
            <ul class="off-canvas-list">
                <li><label>App hotel</label></li>
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
                    <p>
                    <div class="risosrsa">
                        <h1><?php echo $conto['0']->numero_camera; ?></h1> 
                        <div class="row">
                            <div class="large-4 columns">
                                Mr/Ms:  <?php echo $conto['0']->cognome_cliente; ?>  <?php echo $conto['0']->nome_cliente; ?>                              
                            </div>
                            <div class="large-4 columns">
                                <?php echo $conto['0']->nome_tipologia; ?>                              
                            </div>
                            <div class="large-4 columns">
                                In: <?php echo $conto['0']->in_conto; ?>  Out: <?php echo $conto['0']->out_preno; ?>                              
                            </div>
                        </div>
                    </div>
                    </p>
                </div>
            </div>
            <?php if( @$conto['0']->camera_id  == @$camera_arrivo['0']->camera_id  ) { ?>
            <div class="row">
                <fieldset>
                    <legend>Note Arrivo di Oggi</legend>
                    
                <div class="large-6 columns" >
                    <h3>Camera in Partenza:</h3>
                    <p> <?php if( $conto['0']->nome_tipologia ){ echo $conto['0']->nome_tipologia ;} ?>  
                    </p>
                </div>
                <div class="large-6 columns" >
                    <h3>Camera in Arrivo:</h3>
                    <p>
                      <?php  if( $camera_arrivo['0']->nome_tipologia ) {  echo 'Preparare come : '.$camera_arrivo['0']->nome_tipologia ; } ?>  
                    </p>
                </div>
                 </fieldset>
            </div>
            <?php } ?>
            <div class="row" > 
                <div class="large-3 columns">
                    <a href="#"  data-reveal-id="Pulita"  class="button expand success">Pulita</a>
                    <!-- Reveal Modals begin -->
                    <div id="Pulita" class="reveal-modal" data-reveal aria-labelledby="pulitaTitle" aria-hidden="true" role="dialog">
                        <h2 id="pulitaTitle">Camera In <?php echo $status; ?></h2>
                        <?php
                        // Change the css classes to suit your needs    
                        $attributes = array('class' => '', 'id' => '');
                        echo form_open('apphotel/pulizia', $attributes);
                        ?>
                        <p>
                        <div class="switch round large">
                            <p>Cambio Biancheria</p>
                            <input id="cambio_biancheria" type="checkbox" value="1" name="cambio_biancheria">
                            <label for="cambio_biancheria"></label>
                        </div>   
                        </p>
                        <p>
                        <div class="switch round large">
                            <p>Camera Pronta</p>
						<?php if( $status == 'Fermata'){ $pulizia_stato = 1 ;} else{ $pulizia_stato = 2 ;} ?>	
                            <input id="pulizia_stato" type="checkbox" value="<?php echo $pulizia_stato ; ?>" name="pulizia_stato">
                            <label for="pulizia_stato"></label>                           
                        </div>   
                        </p>
                        <p>
                            <?php echo form_submit('submit', 'Conferma', 'class="button"'); ?>
                        </p>
                        <p>
                            <label for="pulizia_note">Note Governanate</label>
                            <?php echo form_error('pulizia_note'); ?>
                            <?php echo form_textarea(array('name' => 'pulizia_note', 'rows' => '5', 'cols' => '80', 'value' => set_value('pulizia_note'))) ?>
                        </p>
                        <input type="hidden" name="hotel_id" value="<?php echo $conto['0']->hotel_id; ?>" />
                        <input type="hidden" name="conto_id" value="<?php echo $conto['0']->conto_id; ?>" />
                        <input type="hidden" name="camera_id" value="<?php echo $conto['0']->camera_id; ?>" />
                        <input type="hidden" name="pulizia_data" value="<?php echo date('Y-m-d'); ?>" />
                        <input type="hidden" name="utente_id" value="<?php echo '88'; ?>" />
                        <?php echo form_close(); ?>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>
                </div>

                <div class="large-3 columns">
                    <!--                    <a href="#" class="button expand alert ">Manutenzione</a>-->
                    <a href="#"  data-reveal-id="Manutenzione"  class="button expand alert">Manutenzione</a>
                    <!-- Reveal Modals begin -->
                    <div id="Manutenzione" class="reveal-modal" data-reveal aria-labelledby="manutenzioneTitle" aria-hidden="true" role="dialog">
                        <h2 id="manutenzioneTitle">Manutenzione</h2>
                        <?php
                        // Change the css classes to suit your needs    
                        $attributes = array('class' => '', 'id' => '');
                        echo form_open('apphotel/manutenzioni', $attributes);
                        ?>
                        <p>
                            <label for="guasto_priorita">guasto_priorita <span class="required">*</span></label>
                            <?php echo form_error('guasto_priorita'); ?>
                            <?php // Change the values in this array to populate your dropdown as required   ?>
                            <?php
                            $options = array(
                                '' => 'Please Select',
                                '1' => 'Alta - fuori uso',
                                '2' => 'Media - piccolo intervento  ',
                                '3' => 'Bassa - si puo affittare ',
                            );
                            ?>
                            <?php echo form_dropdown('guasto_priorita', $options, set_value('guasto_priorita')) ?>
                        </p>                                                                    
                        <p>
                            <label for="guasto_note">guasto_note</label>
                            <?php echo form_error('guasto_note'); ?>
                            <?php echo form_textarea(array('name' => 'guasto_note', 'rows' => '5', 'cols' => '80', 'value' => set_value('guasto_note'))) ?>
                        </p>
                        <p>
                            <?php echo form_submit('submit', 'Conferma', 'class="button"'); ?>
                        </p>
                        <input type="hidden" name="hotel_id" value="<?php echo $conto['0']->hotel_id; ?>" />
                        <input type="hidden" name="camera_id" value="<?php echo $conto['0']->camera_id; ?>" />
                        <input type="hidden" name="conto_id" value="<?php echo $conto['0']->conto_id; ?>" />
                        <input type="hidden" name="guasto_area" value="Camere" />
                        <input type="hidden" name="guasto_piano" value="<?php echo $conto['0']->camere_piano; ?>" />
                        <input type="hidden" name="guasto_stato" value="1" />
                        <input type="hidden" name="guasto_data" value="<?php echo date('Y-m-d'); ?>" />
                        <input type="hidden" name="guasto_utente_id" value="88" />

                        <?php echo form_close(); ?>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>            
                </div>

                <div class="large-3 columns">
                    <!--                    <a href="#" class="button expand secondary">Adebbita</a>-->            
                    <a href="#"  data-reveal-id="Adebbita"  class="button expand secondary">Adebbita</a>
                    <!-- Reveal Modals begin -->
                    <div id="Adebbita" class="reveal-modal" data-reveal aria-labelledby="adebbitaTitle" aria-hidden="true" role="dialog">
                        <h2 id="adebbitaTitle">Adebbita</h2>
                        <?php
                        // Change the css classes to suit your needs    
                        $attributes = array('class' => '', 'id' => '');
                        echo form_open('apphotel/adebbita', $attributes);
                        ?>
                        <p>
                            <label for="prodotto_id">prodotto_id</label>
                            <?php // Change the values in this array to populate your dropdown as required    ?>
                            <?php
// $options = array('' => 'Please  pippo Select');
                            foreach ($prodotti as $value) {
                                $options[$value->prodotto_id] = $value->nome_prodotto;
                            }
                            ?>
                            <?php echo form_dropdown('prodotto_id', $options, set_value('prodotto_id')) ?>
                        </p> 
                        <p>
                            <label for="quantita">quantita</label>
                            <input id="quantita" type="text" name="quantita"  value="<?php echo set_value('quantita'); ?>"  />
                        </p>
                        <input type="hidden" name="hotel_id" value="<?php echo $conto['0']->hotel_id; ?>" />
                        <input type="hidden" name="conto_id" value="<?php echo $conto['0']->conto_id; ?>" />
                        <input type="hidden" name="prezzo" value="<?php echo 0; ?>" />
                        <input type="hidden" name="adebiti_utente_id" value="88" />
                        <p>
						<?php
						if( $status != 'Partito') {
						echo form_submit('submit', 'Conferma', 'class="button"'); 
						}
						?>
                        </p>
                        <?php echo form_close(); ?>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>
                </div>
                <div class="large-3 columns">
                    <a href="#" class="button expand">Default Button</a>
                </div>
            </div>

        </section>
        <a class="exit-off-canvas"></a>
    </div>
</div>

<!--    tab-->
<div class="row">

    <fieldset>
        <legend>Riepiloghi</legend>   

        <div class="large-12 columns ">
            <ul class="tabs" data-tab>
                <li class="tab-title active"><a href="#panel1"><img src="<?php echo base_url(); ?>/asset/img/-Pulizia50.jpg" width="30" height="30" alt="-Pulizia50"/>
                    </a></li>
                <li class="tab-title"><a href="#panel2"><img src="<?php echo base_url(); ?>/asset/img/manutenzione.png" width="30" height="30" alt="manutenzione"/>
                    </a></li>
                <li class="tab-title"><a href="#panel3"><img src="<?php echo base_url(); ?>/asset/img/adebbita.gif" width="30" height="30" alt="adebbita"/>
                    </a></li>
            </ul>
            <div class="tabs-content">
                <div class="content active" id="panel1">
                    <p>
                    <h3>Governante</h3>
                    <table border="0" cellpadding=""  width="100%" >
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Biancheria</th>
                                <th>Stato</th>
                                <th>Notre</th>
                                <th>Utente</th>
                                <th>Ora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pulizie as $rowpul) { ?>
                                <tr>
                                    <td><?php echo $rowpul->pulizia_data; ?></td>
                                    <td><?php echo $rowpul->cambio_biancheria; ?></td>
                                    <td><?php echo $rowpul->pulizia_stato; ?></td>
                                    <td><?php echo $rowpul->pulizia_note; ?></td>
                                    <td><?php echo $rowpul->utente_id; ?></td>
                                    <td><?php echo $rowpul->pulizia_data_record; ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>

                    </p>
                </div>
                <div class="content" id="panel2">
                    <p>
                    <h3> Manutenzioni</h3>
                    <table border="0" cellpadding="1" width="100%" >
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Priorità</th>
                                <th>Descrizione</th>
                                <th>Stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($guasti as $rowgua) { ?>
                                <tr>
                                    <td><?php echo $rowgua->guasto_data; ?></td>
                                    <td><?php echo $rowgua->guasto_priorita; ?></td>
                                    <td><?php echo $rowgua->guasto_note; ?></td>
                                    <td><?php echo $rowgua->guasto_stato; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    .</p>
                </div>

                <div class="content" id="panel3">
                    <p>
                    <h3>Adebbiti</h3>
                    <table border="0" cellpadding="1" width="100%" >
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Prodotto</th>
                                <th>Quantita</th>
                                <th>Prezzo</th>
                                <th>Importo</th>
                                <th>Utente</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adebbiti as $rowadeb) { ?>
                                <tr>
                                    <td><?php echo $rowadeb->adebiti_data_record; ?></td>
                                    <td><?php echo $rowadeb->nome_prodotto; ?></td>
                                    <td><?php echo $rowadeb->quantita; ?></td>
                                    <td><?php echo $rowadeb->prezzo; ?></td>
                                    <td><?php echo $rowadeb->prezzo * $rowadeb->quantita; ?></td>
                                    <td><?php echo $rowadeb->adebiti_utente_id; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
</div>

