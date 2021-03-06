<div id="riepilogo" >  
    <fieldset>  
        <div class="row">
            <div class="small-4 large-4 columns">
                <!-- Check-in-->
                <div class="ContenitoreCalendarioInterno">
                    <div class="ContenitoreMeseAnno">
                        <span> Check-in</span>
                    </div>
                    <div class="ContenitoreGiorno">
                        <span><?php echo date("d", strtotime($preno_dal)); ?></span>
                    </div>
                    <div class="ContenitoreGiornoSettimana">
                        <span><?php echo date("M y", strtotime($preno_dal)); ?> </span>
                    </div>
                </div>
            </div>
            <!-- Check-Out-->
            <div class="small-4 large-4 columns">
                <div class="ContenitoreCalendarioInterno">
                    <div class="ContenitoreMeseAnno">
                        <span> Check-out</span>
                    </div>
                    <div class="ContenitoreGiorno">
                        <span><?php echo date("d", strtotime($preno_al)); ?></span>
                    </div>
                    <div class="ContenitoreGiornoSettimana">
                        <span><?php echo date("M y", strtotime($preno_al)); ?> </span>
                    </div>
                </div>
            </div>
            <!-- Giorni-->
            <div class="small-4 large-4 columns">
                <div class="ContenitoreCalendarioInternonotti">
                    <div class="ContenitoreMeseAnnonotti">
                        <span>N° of nights</span>
                    </div>
                    <div class="ContenitoreGiornonotti">
                        <span><?php echo $night; ?></span>
                    </div>
                    <div class="ContenitoreGiornoSettimananotti">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <div class="av-summary">          
        SUMMARY
        <?php foreach ($camere_obmp as $key => $row_rooms) { ?>
            <div class="room-summary" id="summary_a_<?php echo $row_rooms->obmp_cm_rooms_id; ?>" ></div>
            <script>
                $(function () {
            // Clienti prezzi web 
                    $('#num_<?php echo $row_rooms->obmp_cm_rooms_id; ?>').change(function () {
                        var camara_cm = $('#cm_rooms_id_<?php echo $row_rooms->obmp_cm_rooms_id; ?>').val();
                        var prezzo_cm = $('#price_<?php echo $row_rooms->obmp_cm_rooms_id; ?>').val();
                        var num_cm = $('#num_<?php echo $row_rooms->obmp_cm_rooms_id; ?>').val();
                        $("div#summary_a_<?php echo $row_rooms->obmp_cm_rooms_id; ?>").load("<?php echo base_url(); ?>index.php/obmp/summary_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm);
                        $("div#book_bot_<?php echo $row_rooms->obmp_cm_rooms_id ?>").load("<?php echo base_url(); ?>index.php/obmp/booking_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm);
                        $("div#panel_book_bot_<?php echo $row_rooms->obmp_cm_rooms_id ?>").load("<?php echo base_url(); ?>index.php/obmp/booking_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm);
                    });
                });
            </script>
        <?php } ?>
    </div>  
</div>