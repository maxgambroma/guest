<?php if ($rs_clienti) { ?>

<div class="barra_icone"> 
        <div class="barra_icone">
        <div class="icon-bar vertical five-up">
            <a class="item" href="<?php echo base_url(); ?>index.php/clienti/index/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>?lg=<?php echo $this->lg; ?>"" >
                <i class="fi-home"></i>
                <label>Home</label>
            </a>
            <a class="item"  href="<?php echo base_url(); ?>index.php/clienti/bookings/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>?lg=<?php echo $this->lg; ?>"  >
                <i class="fi-key"></i>
                <label>Bookings</label>
            </a>
            <a class="item" href="<?php echo base_url(); ?>index.php/clienti/review/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>?lg=<?php echo $this->lg; ?>" >
                <i class="fi-comment"></i>
                <label>Review</label>
            </a>
            <a class="item" href="<?php echo base_url(); ?>index.php/clienti/impostazioni/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>?lg=<?php echo $this->lg; ?>"">
                <i class="fi-wrench"></i>
                <label>Impostazioni</label>
            </a>
            <a class="item" href="<?php echo base_url(); ?>index.php/clienti/imp_privacy/<?php echo $rs_clienti[0]->conto_id; ?>/<?php echo $rs_clienti[0]->clienti_id; ?>?lg=<?php echo $this->lg; ?>"">
                <i class="fi-widget"></i>
                <label>Privacy</label>
            </a>
        </div>
    </div> 
 </div>
     <?php  }  ?>
