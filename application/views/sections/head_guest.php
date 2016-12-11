<body>
    
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', '<?php echo $albergo[0]->analytics ?>', 'auto', {allowLinker: true});
ga('require', 'linker');
ga('linker:autoLink', ['ciaohotel.com', 'hotellaurentia.it', 'hotellaurentia.com', 'hotellapergola.it', 'hotellapergola.com', 'ateneorome.com', 'carlomagnohotel.com'], true, true));

<?php if( $this->input->get_post('preno_id')  && $this->input->get_post('obm_cliente_id') ) {?>

ga('ecommerce:addTransaction', {
'id': '<?php echo $preno->preno_id; ?>',// Transaction ID. Required.
'affiliation': '<?php echo $preno->ref_site; ?>', // Affiliation or store name.
'revenue': '<?php echo $preno->preno_importo; ?>', // Grand Total.
'shipping': '0', // Shipping.
'tax': '0' // Tax.
});



<?php if($preno->q1 != 0 ){ ?>
ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t1]->nome_tipologia; ?>', // Product name. Required.
'sku': '<?php echo $preno->t1; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p1; ?>', // Unit price.
'quantity': '<?php echo $preno->q1 * $preno->preno_n_notti; ?>' // Quantity.
});

<?php } if($preno->q2  != 0 ){ ?>
ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t2]->nome_tipologia; ?>', // Product name. Required.
'sku': '<?php echo $preno->t2; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p2; ?>', // Unit price.
'quantity': '<?php echo $preno->q2 * $preno->preno_n_notti; ?>' // Quantity.
});

<?php } if($preno->q3  != 0 ){ ?>
ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t3]->nome_tipologia ?>', // Product name. Required.
'sku': '<?php echo $preno->t3; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p3; ?>', // Unit price.
'quantity': '<?php echo $preno->q3 * $preno->preno_n_notti; ?>' // Quantity.
});

<?php } if($preno->q4  != 0 ){ ?>

ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t4]->nome_tipologia ?>', // Product name. Required.
'sku': '<?php echo $preno->t4; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p4; ?>', // Unit price.
'quantity': '<?php echo $preno->q4 * $preno->preno_n_notti; ?>' // Quantity.
});

<?php } if($preno->q5  != 0 ){ ?>

ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t5]->nome_tipologia; ?>', // Product name. Required.
'sku': '<?php echo $preno->t5; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p5; ?>', // Unit price.
'quantity': '<?php echo $preno->q5 * $preno->preno_n_notti; ?>' // Quantity.
});

<?php } if($preno->q6 != 0 ){ ?>

ga('ecommerce:addItem', {
'id': '<?php echo $preno->preno_id; ?>', // Transaction ID. Required.
'name': '<?php echo $rooms[$preno->t6]->nome_tipologia ?>', // Product name. Required.
'sku': '<?php echo $preno->t6; ?>',  // SKU/code.
'category': 'Rooms', // Category or variation.
'price': '<?php echo $preno->p6; ?>', // Unit price.
'quantity': '<?php echo $preno->q6 * $preno->preno_n_notti; ?>' // Quantity.
});
<?php } ?>

ga('ecommerce:send');
<?php }?>
    
ga('send', 'pageview');

</script>    

    
    <?php
//se ho il cliente settato 
    
    if ($this->session->area >= 2) {
        ?>
        <div class="barra_icone">
            <div class="row">
                <div class="large-12  columns">
                    <div class="barra_icone"> 
                        <div class="barra_icone">
                            <div class="icon-bar  six-up">
                                <a class="item" href="<?php echo base_url(); ?>index.php/clienti/index/<?php echo $this->session->conto_id; ?>/<?php echo $this->session->clienti_id; ?>?lg=<?php echo $this->lg; ?>" >
                                    <i class="fi-home"></i>
                                    <label class="show-for-medium-up" >Home</label>
                                </a>
                                <a class="item"  href="<?php echo base_url(); ?>index.php/clienti/bookings/<?php echo $this->session->conto_id; ?>/<?php echo $this->session->clienti_id; ?>?lg=<?php echo $this->lg; ?>"  >
                                    <i class="fi-key"></i>
                                    <label class="show-for-medium-up" >Bookings</label>
                                </a>
                                <a class="item" href="<?php echo base_url(); ?>index.php/clienti/review/<?php echo $this->session->conto_id; ?>/<?php echo $this->session->clienti_id; ?>?lg=<?php echo $this->lg; ?>" >
                                    <i class="fi-comment"></i>
                                    <label class="show-for-medium-up">Review</label>
                                </a>
                                <a class="item" href="<?php echo base_url(); ?>index.php/clienti/impostazioni/<?php echo $this->session->conto_id; ?>/<?php echo $this->session->clienti_id; ?>?lg=<?php echo $this->lg; ?>">
                                    <i class="fi-wrench"></i>
                                    <label class="show-for-medium-up">Impostazioni</label>
                                </a>
                                <a class="item" href="<?php echo base_url(); ?>index.php/clienti/imp_privacy/<?php echo $this->session->conto_id; ?>/<?php echo $this->session->clienti_id; ?>?lg=<?php echo $this->lg; ?>">
                                    <i class="fi-widget"></i>
                                    <label class="show-for-medium-up">Privacy</label>
                                </a>
                                
                                 <a class="item" href="<?php echo base_url(); ?>index.php/clienti/log_out/?<?php echo $_SERVER['QUERY_STRING'];?>">
                                     <i class="fi-x"></i>
                                    <label class="show-for-medium-up">Log Out</label>
                                </a>
                                
                                
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div>

            <div class="row">
                <div class="large-12  columns">&nbsp; </div>
            </div>

        <?php }
         
    ?>   
    </div>

    <div class="row">
        <div class="large-2 medium-3 small-4 columns">
            <a href="http://<?php echo $albergo['0']->hotel_web; ?>" ><img src="<?php echo base_url(); ?>asset/img/logo_<?php echo $albergo['0']->hotel_id; ?>.gif"   title="WWWW HOTEL"  /> </a> 
        </div>
        <div class="large-9 medium-9 small-8  columns">
            <div class="show-for-small-only"> 
                <button href="<?php echo uri_string(); ?>" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button small right dropdown"><img src="<?php echo base_url(); ?>asset/img/flags/<?php echo $lg; ?>.gif" alt="Hotel rome" border="0" /></button>
            </div>
            <div class="show-for-medium-up"> 
                <button href="<?php echo uri_string(); ?>" data-dropdown="drop1" aria-controls="drop1" aria-expanded="false" class="button small right dropdown"><img src="<?php echo base_url(); ?>asset/img/flags/<?php echo $lg; ?>.gif" alt="Hotel rome" border="0" /> Language</button>
            </div>
            <br>
            <ul id="drop1" data-dropdown-content class="f-dropdown" aria-hidden="true">
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=en" ><img src="<?php echo base_url(); ?>asset/img/flags/en.gif"  border="0" /> English </a> </li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=de" ><img src="<?php echo base_url(); ?>asset/img/flags/de.gif"  border="0" /> Deutsch </a> </li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=es"><img src="<?php echo base_url(); ?>asset/img/flags/es.gif"  border="0" /> Espa&ntilde;ol </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=fr"><img src="<?php echo base_url(); ?>asset/img/flags/fr.gif"  border="0" /> Fran&ccedil;ais </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?<?php echo $_SERVER['QUERY_STRING'] ?>&lg=it"><img src="<?php echo base_url(); ?>asset/img/flags/it.gif"  border="0" /> Italiano </a></li>
                <!-- <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=jp"><img src="<?php echo base_url(); ?>asset/img/flags/jp.gif"  border="0" /> Nihongo </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=ru"><img src="<?php echo base_url(); ?>asset/img/flags/ru.gif"  border="0" /> Russian </a></li>
                <li><a href="<?php echo base_url(); ?>index.php/<?php echo uri_string(); ?>?lg=se"><img src="<?php echo base_url(); ?>asset/img/flags/se.gif"  border="0" /> Svenska </a></li>
                -->
            </ul>
            </p>            
        </div>
     
    </div>





