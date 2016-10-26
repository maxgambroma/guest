<nav class="tab-bar">
    <section class="left-small">
        <a class="left-off-canvas-toggle menu-icon" aria-expanded="false"><span></span></a>
    </section>
    <section class="right tab-bar-section">
        <h1 class="title">Elenco Manutenzioni</h1>
    </section>
</nav>


<aside class="left-off-canvas-menu">
    <ul class="off-canvas-list">
<li><label>AppHotel</label></li>
<li><a href='<?php echo base_url(); ?>/index.php/guasti/?hotel_id=<?php echo $hotel_id; ?>' >Manutenzioni</a></li>

<li><a href='<?php echo base_url(); ?>index.php/guasti/guasti_add/?hotel_id=<?php echo $hotel_id; ?>' >Manutenzione Reparti</a></li>
<li><a href='<?php echo base_url(); ?>index.php/guasti/lista_30/?hotel_id=<?php echo $hotel_id; ?>' >Lista 30</a></li>


    </ul>
</aside>
