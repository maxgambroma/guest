<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="large-6 columns">
        <div id="Manutenzione">
            <h2 id="manutenzioneTitle">Manutenzione N° <?php echo $guasti->guasto_id; ?>  </h2>
            <?php
// Change the css classes to suit your needs    
            $attributes = array('class' => '', 'id' => 'ins_man');
            echo form_open(base_url() . 'index.php/guasti/mod_manutenzioni','data-abide', $attributes);
            ?>
            <p>
                <?php
                $options = array(
                    '' => 'Please Select',
                    '1' => 'Alta - fuori uso',
                    '2' => 'Media - piccolo intervento  ',
                    '3' => 'Bassa - si puo affittare ',
                );
                ?>
                <label>Priorita Guasto<small class="error">required</small>*
                    <?php echo form_dropdown('guasto_priorita', $options, $guasti->guasto_priorita , 'required class="medium" id="guasto_priorita"') ?>
                </label> 
            </p>   
            <p>
                <?php
                $options_area = array(
                    '' => 'Please Select',
                    '1' => 'Hall',
                    '2' => 'Bar',
                    '3' => 'SalaColazione',
                    '4' => 'Giardino',
                    '5' => 'Esterno',
                    '6' => 'Scale',
                    '7' => 'Corridoio',
                    '8' => 'Terrazzo',
                    '9' => 'BagnoServizio',
                    '10' => 'Ufficio',
                    '11' => 'Magazzino',
                    '12' => 'Spogliatoi',
                    '13' => 'Cantine',
                );
                ?>
                <label>Area Guasto* <small class="error">required</small>
                    <?php echo form_dropdown('guasto_area', $options_area, $guasti->guasto_area, 'required class="medium" id="guasto_area"') ?>
                </label> 
            </p>
            <p>
            <div class="name-field">
                <label>Guasto Piano* <small class="error">required</small>
                    <input type="text"  name="guasto_piano" value="<?php echo $guasti->guasto_piano ; ?>" required >
                </label>
            </div>
            </p>
            <p>
                <label>Descrizione*							
                    <small class="error">Name is required and must be a string.</small>
                    <?php
                    echo form_textarea(
                            array('name' => 'guasto_note',
                        'rows' => '5',
                        'cols' => '80',
                        'value' => $guasti->guasto_note . $guasti->guasto_stato
                            ), '', 'required '
                    )
                    ?>
                </label>
            </p>
            
            <div class="switch round large">
                Modifica <input id="guasto_stato1<?php echo  $guasti->guasto_id; ?>" type="radio" value="1"
                                accept=""  <?php
                
                if ($guasti->guasto_stato == 1) {
                    echo 'checked';
                }
                ?>  name="guasto_stato" >
                
                <label for="guasto_stato1<?php echo $guasti->guasto_id; ?>" ></label>
            </div> 
            
            <div class="switch round large">
                Chiudi <input id="guasto_stato2<?php echo  $guasti->guasto_id; ?>" type="radio" value="2"  <?php
                if ($guasti->guasto_stato == 2) {
                    echo 'checked';
                }
                ?>
                              name="guasto_stato" >
                
                <label for="guasto_stato2<?php echo $guasti->guasto_id; ?>" ></label>
            </div>   
            <p>
                <?php echo form_submit('submit', 'Conferma', 'class="button"'); ?>
            </p>
            

            <input type="hidden" name="guasto_id" value="<?php echo $guasti->guasto_id; ?> " />
            <input type="hidden" name="hotel_id" value="<?php echo $hotel_id; ?>" />
            <input type="hidden" name="camera_id" value="0" />
            <input type="hidden" name="conto_id" value="0" />
            <input type="hidden" name="guasto_data" value="<?php echo date('Y-m-d'); ?>" />
            <input type="hidden" name="guasto_utente_id" value="88" />
            <?php echo form_close(); ?>
            <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>            
    </div>
    <div class="large-6 columns">
    </div>
</div>
