<body>
    <?php
//se ho il cliente settato 

    
    if ($this->session->area >= 2) {
        ?>
        <div class="barra_icone">
            <div class="row">
                <div class="large-12  columns">
                    <div class="barra_icone"> 
                        <div class="barra_icone">
                            <div class="icon-bar  five-up">
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
            <h1>  <a href="http://<?php echo $albergo['0']->hotel_web; ?>" ><img src="<?php echo base_url(); ?>asset/img/logo_<?php echo $albergo['0']->hotel_id; ?>.gif"/> </a></h1>
        </div>
        <div class="large-9 medium-8 small-6  columns">
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
        <div class="large-1 medium-1 small-2  columns"">
                    <?php  if($this->session->area){ ?>
          
            <a href="<?php echo base_url(); ?>index.php/clienti/log_out/?<?php echo $_SERVER['QUERY_STRING'];?>" >
                         
                
                
                <span data-tooltip aria-haspopup="true" class="has-tip log_out " title="LOG OUT"><i class="fi-x"></i> </span>
                
                
            </a>
            <?php } ?>
            
        </div>
    </div>





