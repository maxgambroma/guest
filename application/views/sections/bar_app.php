<nav class="tab-bar">
    <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" aria-expanded="false"><span></span></a>
    </section>
    <section class="right tab-bar-section">
        <h1 class="title">Camere <?php
            if ($this->input->get('scelta')) {
                echo $menu[$this->input->get('scelta')];
            } else {
                echo $menu['conti_aperti'];
            }
            ?></h1>
    </section>
</nav>
<aside class="left-off-canvas-menu">
    <ul class="off-canvas-list">
        <li><label>AppHotel</label></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'conti_aperti'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Occupate</a></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'partiti'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Partite</a></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'partenze'; ?>&hotel_id=<?php echo $hotel_id; ?>' >In Partenza</a></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'arrivi'; ?>&hotel_id=<?php echo $hotel_id; ?>' >In Arrivo</a></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'rifatte'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Rifatte </a></li>
        <li><a href='<?php echo base_url(); ?>?scelta=<?php echo 'controllo'; ?>&hotel_id=<?php echo $hotel_id; ?>' >Controllo</a></li>
        <li><a href='<?php echo base_url(); ?>index.php/apphotel/rooms/?hotel_id=<?php echo $hotel_id; ?>' >All-Rooms</a></li>
		 <li><a href='<?php echo base_url(); ?>/index.php/pulizia/lista_note/?hotel_id=<?php echo $hotel_id; ?>' >Elenco Note</a></li>

    </ul>
</aside>


