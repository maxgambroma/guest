<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
/*

  [camera_id] => 56
  [hotel_id] => 4
  [numero_camera] => 104
  [tipologia_camera] => Junior Suit
  [tipologia_id] => 6
  [camere_max_pax] => 4
  [camere_metri_quadri] => 25
  [camere_vista] => INTERNA
  [camere_piano] => 0
  [camere_bagno] => Vasca
  [camere_edificio] => A
  [camere_data_record] => 2009-05-03 10:40:18
  [camere_utente_id] =>

  $foglio[$row->camera_id]['foglio_id'] ;
  $foglio[$row->camera_id]['conto_id'] ;
  $foglio[$row->camera_id]['agenzia_nome'] ;
  $foglio[$row->camera_id]['nome_tipologia'] ;

 */

foreach ($rooms AS $row) {

// ho assegnato la camare   
    if (isset($foglio[$row->camera_id]['foglio_id']) && (!isset($foglio[$row->camera_id]['conto_id']))) {
        ?>

        <!-- quadrato foglio assegnati -->
        <a href="<?php echo base_url(); ?>index.php/risorsa/arrivo/??>&foglio_id=<?php echo $foglio[$row->camera_id]['foglio_id']; ?>&hotel_id=<?php echo $foglio[$row->camera_id]['hotel_id']; ?> ">
            <div class='<?php echo 'room_arrivi_ok'; ?>'  >
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
                      title="<?php echo $foglio[$row->camera_id]['nome_tipologia']; ?> :
                      <?php echo $foglio[$row->camera_id]['cognome_cliente'] . ' ' . $foglio[$row->camera_id]['nome_cliente']; ?>  
                      In : <?php echo $foglio[$row->camera_id]['in_conto']; ?>
                      Out : <?php echo $foglio[$row->camera_id]['out_preno']; ?> " >
                    <p><?php echo 'Asseganta'; ?></p>
                </span>
            </div>
        </a> 
        <!-- / quadrato -->
        <?php
    }
    
// camara conto aperto    
    if (isset($foglio[$row->camera_id]['foglio_id']) && ( isset($foglio[$row->camera_id]['conto_id']))) {
        ?>   

        <!-- quadrato conti -->

        <!-- quadrato conti -->
        <a href="<?php echo base_url(); ?>index.php/apphotel/risorsa/?conto_id=<?php echo $foglio[$row->camera_id]['conto_id']; ?>&foglio_id=<?php echo $foglio[$row->camera_id]['foglio_id']; ?>&hotel_id=<?php echo $foglio[$row->camera_id]['hotel_id']; ?> ">
            <div class='<?php echo 'room_fermata'; ?>'  >
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
                      title="<?php echo $foglio[$row->camera_id]['nome_tipologia']; ?> :
                      <?php echo $foglio[$row->camera_id]['cognome_cliente'] . ' ' . $foglio[$row->camera_id]['nome_cliente']; ?>  
                      In : <?php echo $foglio[$row->camera_id]['in_conto']; ?>
                      Out : <?php echo $foglio[$row->camera_id]['out_preno']; ?> " >
                    <p><?php echo 'Conti'; ?></p>
                </span>
            </div>
        </a> 
        <!-- / quadrato -->
        <!-- / quadrato -->
        <?php
    }
// non assegnate
    if (!isset($foglio[$row->camera_id]['foglio_id'])) {
        ?>
        <!-- quadrato -->
        <a href="<?php echo base_url(); ?>index.php/risorsa/camera/?camera_id=<?php echo $row->camera_id; ?>&hotel_id=<?php echo $row->hotel_id; ?> ">
            <div class='<?php
            if (!isset($foglio[$row->camera_id]['foglio_id'])) {
                echo 'rooms';
            }
            ?>' >
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
                      title="<?php echo $row->tipologia_camera; ?> :
                      " >
                    <p><?php echo 'Libera' ?></p>
                </span>
            </div>
        </a>
        <!-- / quadrato -->
        <?php
    }
}
?>