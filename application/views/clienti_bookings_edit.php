<?php 
//print_r($preno);
foreach ($preno as $key => $row_preno) { 
?>
    <div>
        <fieldset> 
            <legend> Booking id : <?php echo $row_preno->preno_id; ?>  </legend>
            <div class="row ">
                <div class="small-12 medium-4 large-5 columns">
                    <img src="<?php echo base_url(); ?><?php echo $row_preno->hotel_foto_piccola; ?>"/>
                </div>
                <div class="small-12 medium-8 large-7 columns">
                    <h4>  <?php echo $row_preno->hotel_tipologia; ?>  <?php echo $row_preno->nome_hotel; ?></h4>
                    <div class="event-date">
                        <p class="event-title">IN</p>
                        <p class="event-month"><?php echo date('M y', strtotime($row_preno->preno_dal)); ?></p>
                        <p class="event-day"><?php echo date('d', strtotime($row_preno->preno_dal)); ?></p>
                    </div>
                    <div class="event-date">
                        <p class="event-title">OUT</p>
                        <p class="event-month"><?php echo date('M y', strtotime($row_preno->preno_al)); ?></p>
                        <p class="event-day"><?php echo date('d', strtotime($row_preno->preno_al)); ?></p>
                    </div>
                    <p> 
                        <?php if ($row_preno->agenzia_nome) { ?>
                            By <?php
                            echo ($row_preno->agenzia_nome ) . '<br>';
                        }
                        ?>
                    </p>
                </div>
            </div>   
            <hr>
            <div class="row">
                <div class="small-12 large-12 columns">
                    <?php if ($row_preno->q1) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q1; ?>  <img  align="right" height="150" width="150" title="<?php echo $lg_tipologia[$row_preno->t1]->obmp_cm_lingue_nome; ?> " src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t1; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">
                                <h3><?php echo $lg_tipologia[$row_preno->t1]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >  <?php echo $lg_tipologia[$row_preno->t1]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>   
                        <hr>
                    <?php } ?> 
                    <?php if ($row_preno->q2) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q2; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t2; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_preno->t2]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >   <?php echo $lg_tipologia[$row_preno->t2]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>
                        <hr>
                    <?php } ?> 
                    <?php if ($row_preno->q3) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q3; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t3; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_preno->t3]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >   <?php echo $lg_tipologia[$row_preno->t3]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>  
                        <hr>
                    <?php } ?> 
                    <?php if ($row_preno->q4) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q4; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t4; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_preno->t4]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >   <?php echo $lg_tipologia[$row_preno->t4]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>   
                        <hr>
                    <?php } ?> 
                    <?php if ($row_preno->q5) { ?> 
                        <div class="row ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q5; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t5; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_preno->t5]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >     <?php echo $lg_tipologia[$row_preno->t5]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>   
                        <hr>
                    <?php } ?>            
                    <?php if ($row_preno->q6) { ?> 
                        <div class="row  ">
                            <div class="small-6 large-6 columns">
                                <div class="numero_camara ">  <?php echo $row_preno->q6; ?>  <img  align="right"  src="<?php echo base_url(); ?>/asset/img/tipologia_<?php echo $row_preno->t6; ?>.jpg"/>  </div> 
                            </div>
                            <div class="small-6 large-6 columns ">              
                                <h3><?php echo $lg_tipologia[$row_preno->t6]->obmp_cm_lingue_nome; ?>  </h3>
                                <span class="desc_camare" >    <?php echo $lg_tipologia[$row_preno->t6]->obmp_cm_lingue_html1; ?> </span>
                            </div> 
                        </div>   
                        <hr>
                    <?php } ?>            
                    <br>
                    <p></p>
                    <?php
//                            print_r($review);
// non posso modicare la prenotazioni passata
                    if ( $row_preno->preno_dal >= $today) {
                        ?>
                        <a href="#" data-reveal-id="secondModal" class="radius button right"><?php echo $lg_tex['modifica_data']; ?></a> &nbsp;
                        <a href="#" data-reveal-id="firstModal" class="radius button alert right"><?php echo $lg_tex['cax_preno']; ?></a> 
                        <?php
                    } else {
// preno passate senza review 
                        if ( isset($review)) {
                            ?>  
                                    <a href="<?php echo base_url(); ?>index.php/obmp_review/insert/<?php echo $review->conto_id; ?>/<?php echo $this->session->clienti_id; ?>/?lg=en" class="button right"><?php echo $lg_tex['scrivi_review']; ?></a>

                        <?php
                        }
// preno passate con  review  
                        else {
                            ?>
                               <a href="<?php echo base_url(); ?>index.php/obmp_review/edit/<?php echo $review->conto_id; ?>/<?php echo $this->session->clienti_id; ?>/?lg=en " class="button success right"><?php echo $lg_tex['leggi_review']; ?></a>



 <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- Reveal Modals begin -->
            <div id="secondModal" class="reveal-modal" data-reveal aria-labelledby="secondModalTitle" aria-hidden="true" role="dialog">
                <h2 id="secondModalTitle"><?php echo $lg_tex['mod_periodo']; ?></h2>
                <div class="row">
                    <div class="large-3 columns">
                        <p>
    <?php echo lang('check_in', 'Check-in'); ?> 
    <?php echo form_error('check_in'); ?>
                            <input id="preno_dal" type="text" name="preno_dal" value="<?php echo $row_preno->preno_dal; ?>"  />
                        </p>
                    </div>
                    <div class="large-3 columns">
    <?php echo lang('check_out', 'Check-out'); ?> 
    <?php echo form_error('check_out'); ?>
                        <input id="preno_al" type="text" name="preno_al"   value="<?php echo $row_preno->preno_al; ?>"  />
                    </div>
                    <div  class="large-3 columns"> 
                    <!--                        <p> 
                    <a href="#"  id="aggiorna_preno"  class="button right">Default Button</a>
                    </p>-->
                    </div>
                </div>
                <div id="new_preno"></div>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>

            
            
            <!-- Triggers the modals -->
            <!-- Cancella Preno -->
            <div id="firstModal" class="reveal-modal" data-reveal aria-labelledby="firstModalTitle" aria-hidden="true" role="dialog">
                <h2 id="firstModalTitle">Cancella Prenotazione</h2>
                <p>
                    <!--  agenda_edit.php  -->
                <fieldset>                                
                    <legend>Agenda:</legend>	
                    <?php
// Change the css classes to suit your needs    
                    $attributes = array('class' => '', 'id' => '');
                    echo form_open(base_url() . 'index.php/agenda/cax_preno', $attributes);
                    ?>
                    <p>
    <?php echo $lg_tex['motivo_cax']; ?>
                        <input type="radio" name="motivo" value="1" id="motivo1" /> <label for="motivo1"> <?php echo $lg_tex['motivo1']; ?></label> <br>
                        <input type="radio" name="motivo" value="2" id="motivo2"  /> <label for="motivo1"><?php echo $lg_tex['motivo2']; ?></label><br>
                        <input type="radio" name="motivo" value="3" id="motivo3"  /> <label for="motivo1"><?php echo $lg_tex['motivo3']; ?></label><br>
                        <input type="radio" name="motivo" value="4" id="motivo4"  /> <label for="motivo1"><?php echo $lg_tex['motivo4']; ?></label><br>
                        <input type="radio" name="motivo" value="5" id="motivo5"  /> <label for="motivo1"><?php echo $lg_tex['motivo5']; ?></label><br>
                    </p>
                    <label class="inline" for="preno_stato" ><?php echo $lg_tex['si_cax']; ?>
                        <div class="switch round">
                            <input id="preno_stato" type="checkbox" name="preno_stato" value="9"  >
                            <label for="preno_stato"></label>  
                        </div>
                    </label>

                    <input id="agenda_utente_id" type="hidden" name="agenda_utente_id"  value="<?php echo (!set_value('agenda_utente_id')) ? $preno[0]->agenda_utente_id : set_value('agenda_utente_id'); ?>"  />    
                    <input id="cancella_user" type="hidden" name="cancella_user"  value="1"  />
                    <input id="conto_id" type="hidden" name="conto_id"  value="<?php echo $this->uri->segment(3, 1); ?>"  />
                    <input id="clienti_id" type="hidden" name="clienti_id"  value="<?php echo $this->uri->segment(4, 1); ?>"  />
                    <input id="preno_id" type="hidden" name="preno_id"  value="<?php echo $row_preno->preno_id ?>"  />
                    <p>
                    <?php echo form_submit('submit', $lg_tex['cax_preno'], 'class="button"'); ?>
                    </p>
    <?php echo form_close(); ?>
                </fieldset>  
                <p></p>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
        </fieldset>
    </div>
<?php } ?>

<script>
    $(function () {
// Dal
        $("#preno_dal").datepicker({
            defaultDate: "",
            showButtonPanel: true,
            currentText: "Today",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#preno_al").datepicker("option", "minDate", selectedDate);
                // trovo i nuovi valori    
                var preno_dal = $('#preno_dal').val();
                var preno_al = $('#preno_al').val();
                $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_preno->preno_id ?>&hotel_id=<?php echo $row_preno->hotel_id ?>&conto_id=<?php echo isset($rs_clienti[0]->conto_id) ? $rs_clienti[0]->conto_id : NULL; ?>&clienti_id=<?php echo isset($rs_clienti[0]->clienti_id) ? $rs_clienti[0]->clienti_id : NULL; ?>&lg=<?php echo $lg; ?>");

            }
        });
// Al
        $("#preno_al").datepicker({
            defaultDate: "+1d",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 1,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });

    });
</script>

<script>
    $(function () {
// aggiorna il div 
        $("#preno_al").change(function () {
            var preno_dal = $('#preno_dal').val();
            var preno_al = $('#preno_al').val();
            $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_preno->preno_id ;?>&hotel_id=<?php echo $row_preno->hotel_id ;?>&conto_id=<?php echo isset($rs_clienti[0]->conto_id) ? $rs_clienti[0]->conto_id : NULL; ?>&clienti_id=<?php echo isset($rs_clienti[0]->clienti_id) ? $rs_clienti[0]->clienti_id : NULL; ?>&lg=<?php echo $lg; ?>");
        });
    });
</script> 

<script>
    $(function () {
// aggiorna il div 
        $("#aggiorna_preno").click(function () {
            var preno_dal = $('#preno_dal').val();
            var preno_al = $('#preno_al').val();
            $("div#new_preno").load("<?php echo base_url(); ?>index.php/agenda/cambia_date?preno_dal=" + preno_dal + "&preno_al=" + preno_al + "&preno_id=<?php echo $row_preno->preno_id ; ?>&hotel_id=<?php echo $row_preno->hotel_id ;?>&conto_id=<?php echo isset($rs_clienti[0]->conto_id) ? $rs_clienti[0]->conto_id : NULL; ?>&clienti_id=<?php echo isset($rs_clienti[0]->clienti_id) ? $rs_clienti[0]->clienti_id : NULL; ?>&lg=<?php echo $lg; ?>");
        });
    });
</script> 

