<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$today = date('Y-m-d');
/**
/ print_r($partenze);     
// print_r($partiti);     
// print_r($fermate); media camere   
// // ; 
print_r($guasti);
  [0] => stdClass Object
        (
            [camera_id] => 53
            [hotel_id] => 4
            [numero_camera] => 101
            [tipologia_camera] => Doppia
            [tipologia_id] => 2
            [camere_max_pax] => 3
            [camere_metri_quadri] => 20
            [camere_vista] => INTERNA
            [camere_piano] => 0
            [camere_bagno] => Vasca
            [camere_edificio] => A
            [camere_data_record] => 2009-05-03 10:39:58
            [camere_utente_id] => 
            [guasto_id] => 21
            [guasto_priorita] => 2
            [guasto_area] => Camere
            [guasto_piano] => 0
            [guasto_note] => Tenda binario
            [guasto_stato] => 1
            [guasto_data] => 2015-10-06
            [guasto_utente_id] => 88
            [guasto_data_record] => 2015-10-06 10:00:06
        )
*/


//print_r($guasti_area);



    $options = array(
            '' => 'Please Select',
            '1' => 'Alta',
            '2' => 'Media',
            '3' => 'Bassa',
        );



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


$txguasto['1'] = 'Fuori Uso';
$txguasto['2'] = 'Medio';
$txguasto['3'] = 'Basso';
?>
<?php

	$colorediv = 'room_manutenzione';
	$stato = 'Guasto';

	
    foreach ($guasti as $row) { ?>

        <!-- quadrato -->
        <a href="<?php echo base_url(); ?>index.php/guasti/guasto_camera?camera_id=<?php echo $row->camera_id ; ?>&hotel_id=<?php echo $row->hotel_id; ?> ">
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
                      title="Segnalato il <?php echo $row->guasto_data; ?>:
					  <?php echo $row->guasto_note; ?>:" >
                    <p><?php echo $options[$row->guasto_priorita];  ?></p>
                </span>
            </div>
        </a> 
        <!-- / quadrato -->
        <?php  }  ?>
        

<?php  foreach ($guasti_area as $row_area) { ?>

        
        <!-- quadrato -->
        <a href="<?php echo base_url(); ?>index.php/guasti/guasti_area_adm/?guasto_id=<?php echo $row_area->guasto_id ; ?>&hotel_id=<?php echo $row_area->hotel_id; ?> ">
            <div class='<?php echo 'area_manutenzione'; ?>'  >
 
                <h4><?php echo $options_area[$row_area->guasto_area] ;  ?></h4>
                <span data-tooltip aria-haspopup="true" class="has-tip"
                      title="Segnalato il <?php echo $row_area->guasto_data; ?>:
					  <?php echo $row_area->guasto_note; ?>:" >
                    <p><?php echo $options[$row_area->guasto_priorita];  ?></p>
                </span>
            </div>
        </a> 
        <!-- / quadrato -->
        
        
<?php }?>
        
        