<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php // print_r($partenze);                       ?>
<?php // print_r($partiti);                       ?>
<?php //print_r($conto);                       ?>
<?php
// print_r($guasti);  
//            [camera_id] => 157
//            [hotel_id] => 1
//            [numero_camera] => 67
//            [tipologia_camera] => Doppia
//            [tipologia_id] => 2
//            [camere_max_pax] => 1
//            [camere_metri_quadri] => 16.80
//            [camere_vista] => INTERNA
//            [camere_piano] => 0
//            [camere_bagno] => Doccia
//            [camere_edificio] => B
//            [camere_data_record] => 2013-01-21 15:27:31
//            [camere_utente_id] => 
//            [guasto_id] => 9
//            [guasto_priorita] => 2
//            [guasto_area] => Camere
//            [guasto_piano] => 0
//            [guasto_note] => seconda
//            [guasto_stato] => 1
//            [guasto_data] => 2015-10-02
//            [guasto_utente_id] => 1
//            [guasto_data_record] => 2015-10-02 18:15:51

//
//    [camera_id] => 166
//    [hotel_id] => 1
//    [numero_camera] => 107
//    [tipologia_camera] => Singola
//    [tipologia_id] => 1
//    [camere_max_pax] => 1
//    [camere_metri_quadri] => 6.60
//    [camere_vista] => INTERNA
//    [camere_piano] => 1
//    [camere_bagno] => Doccia
//    [camere_edificio] => B
//    [camere_data_record] => 2006-01-06 10:14:29
//    [camere_utente_id] => 

$today = date('Y-m-d');



/*
 */
?>

<!-- content goes here -->
<div class="row">
    <div class="large-12 columns">
        <p>
        <div class="risosrsa">
            <h1><?php echo $camera->numero_camera; ?></h1> 
        </div>
        </p>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">

        <fieldset> 
            <legend>Elenco manutenzioni</legend>


            <ul class="tabs" data-tab>
                <li class="tab-title active"><a href="#panel1">Guasti Aperti</a></li>
                <li class="tab-title"><a href="#panel2">Guasti Chiusi</a></li>

            </ul>
            <div class="tabs-content">
                <div class="content active" id="panel1">
                   
                    <p>
                    <ul class="accordion" data-accordion >
                        <?php
                        $i = 0;

                        foreach ($guasti as $rowgua) {
                            ?>

                            <li class="accordion-navigation">
                                <a href="#panel1a<?php echo $rowgua->guasto_id; ?>"> <h3> Guasti  #<?php echo $rowgua->guasto_id; ?> del <?php echo $rowgua->guasto_data; ?></h3>  </a>
                                <div id="panel1a<?php echo $rowgua->guasto_id; ?>" class="content   <?php echo (0 == $i) ? 'active' : ''; // 'Yes' will be printed  ?>" >
                                    <h2 id="manutenzioneTitle">Manutenzione Aperta  #<?php echo $rowgua->guasto_id; ?> </h2>
                                    <?php
// Change the css classes to suit your needs    
                                    $attributes = array('class' => '', 'id' => '');
                                    echo form_open(base_url() . 'index.php/guasti/mod_manutenzioni', $attributes);
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
                                        <?php echo form_dropdown('guasto_priorita', $options, $rowgua->guasto_priorita) ?>
                                    </p>                                                                    
                                    <p>
                                        <label for="guasto_note">guasto_note</label>
                                        <?php echo form_error('guasto_note'); ?>
                                        <?php echo form_textarea(array('name' => 'guasto_note', 'rows' => '5', 'cols' => '80', 'value' => $rowgua->guasto_note)) ?>
                                    </p>
                                    <div class="switch round large">
                                        Modifica <input id="guasto_stato1<?php echo $rowgua->guasto_id; ?>" type="radio" value="1"  <?php
                                        if ($rowgua->guasto_stato == 1) {
                                            echo 'checked';
                                        }
                                        ?>  name="guasto_stato" >
                                        <label for="guasto_stato1<?php echo $rowgua->guasto_id; ?>" ></label>
                                    </div> 
                                    <div class="switch round large">
                                        Chiudi <input id="guasto_stato2<?php echo $rowgua->guasto_id; ?>" type="radio" value="2"  <?php
                                        if ($rowgua->guasto_stato == 2) {
                                            echo 'checked';
                                        }
                                        ?>
                                                      name="guasto_stato" >
                                        <label for="guasto_stato2<?php echo $rowgua->guasto_id; ?>" ></label>
                                    </div>            
                                    <p>
    <?php echo form_submit('submit', 'Conferma', 'class="button"'); ?>
                                    </p>
                                    <input type="hidden" name="guasto_id" value="<?php echo $guasti['0']->guasto_id; ?>" />
                                    <input type="hidden" name="hotel_id" value="<?php echo $guasti['0']->hotel_id; ?>" />

                                    <input type="hidden" name="camera_id" value="<?php echo $guasti['0']->camera_id; ?>" />
                                    <input type="hidden" name="guasto_area" value="Camere" />
                                    <input type="hidden" name="guasto_utente_id" value="88" />
    <?php echo form_close(); ?>
                                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                </div>
                            </li>
    <?php $i++;
} ?>
                    </ul>
                    </p>



                </div>
                <div class="content" id="panel2">
                    
                                        <p>
                    <ul class="accordion" data-accordion >
                        <?php
                        $i = 0;

                        foreach ($guasticax as $rowguacax ) {
                            ?>

                            <li class="accordion-navigation">
                                <a href="#panel1a<?php echo $rowguacax->guasto_id; ?>"> <h3> Guasto #<?php echo $rowguacax->guasto_id; ?> del <?php echo $rowguacax->guasto_data; ?></h3>  </a>
                                <div id="panel1a<?php echo $rowguacax->guasto_id; ?>" class="content   " >
                                    <h2 id="manutenzioneTitle">Manutenzione Chiusa #<?php echo $rowguacax->guasto_id; ?> </h2>
                                    <?php
// Change the css classes to suit your needs    
                                    $attributes = array('class' => '', 'id' => '');
                                    echo form_open(base_url() . 'index.php/guasti/mod_manutenzioni', $attributes);
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
                                        <?php echo form_dropdown('guasto_priorita', $options, $rowguacax->guasto_priorita) ?>
                                    </p>                                                                    
                                    <p>
                                        <label for="guasto_note">guasto_note</label>
                                        <?php echo form_error('guasto_note'); ?>
                                        <?php echo form_textarea(array('name' => 'guasto_note', 'rows' => '5', 'cols' => '80', 'value' => $rowguacax->guasto_note)) ?>
                                    </p>
                                    <div class="switch round large">
                                        Modifica <input id="guasto_stato1<?php echo $rowguacax->guasto_id; ?>" type="radio" value="1"  <?php
                                        if ($rowguacax->guasto_stato == 1) {
                                            echo 'checked';
                                        }
                                        ?>  name="guasto_stato" >
                                        <label for="guasto_stato1<?php echo $rowguacax->guasto_id; ?>" ></label>
                                    </div> 
                                    <div class="switch round large">
                                        Chiudi <input id="guasto_stato2<?php echo $rowguacax->guasto_id; ?>" type="radio" value="2"  <?php
                                        if ($rowguacax->guasto_stato == 2) {
                                            echo 'checked';
                                        }
                                        ?>
                                                      name="guasto_stato" >
                                        <label for="guasto_stato2<?php echo $rowguacax->guasto_id; ?>" ></label>
                                    </div>            
                                    <p>
    <?php echo form_submit('submit', 'Conferma', 'class="button"'); ?>
                                    </p>
                                    <input type="hidden" name="guasto_id" value="<?php echo $guasticax['0']->guasto_id; ?>" />
                                    <input type="hidden" name="hotel_id" value="<?php echo $guasticax['0']->hotel_id; ?>" />

                                    <input type="hidden" name="camera_id" value="<?php echo $guasticax['0']->camera_id; ?>" />
                                    <input type="hidden" name="guasto_area" value="Camere" />
                                    <input type="hidden" name="guasto_utente_id" value="88" />
    <?php echo form_close(); ?>
                                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                </div>
                            </li>
    <?php $i++;
} ?>
                    </ul>
                    </p>
                    
                    
                    
                </div>

            </div> 






























        </fieldset>


    </div>
</div>