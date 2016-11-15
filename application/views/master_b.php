<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row" id="contenitore_b">
    
    
    
    
    <div class="small-12  medium-8  large-9 columns" id="col_principale" >
        
        <div class="row">
            <div class="small-12 large-12 columns">
                
                <div id="calendario1" class="av-summary" > 
                    <div class="row"> 
                        <div class="small-4 large-3 columns">
                            <p>   From  <br> 13/11/201</p>
                        </div>
                        <div class="small-4 large-3 columns">
                         <p>   To <br> 14/11/2016 </p>
                             </div>
                           <div class="small-4 large-3 columns">
                         <p>  Soggiorno:  <br> 2 notti)  </p>
                           
                        </div>
                 
                        <div class="small-12 large-3 columns">
                            <a href="#" class="button expand ">Modifica Ricerca</a>
                        </div>
                    </div>
                </div>
                
                <div id="cercatore1" style="display: none;"  >  
                    <fieldset> 
                        <div class="row">
                            
                            
                            <div class="box_booking">
                            
                            <div class="small-12 large-4 columns box_booking"> 
                               Verifica Disponibilità
                                <form action="<?php echo base_url(); ?>index.php/obmp/?hotel_id=2&amp;lg=it" method="post" id="form_prezzi" name="form_prezzi">
                                    <div class="row">
                                        <div class="   large-12 columns">
                                            <label>Arrivo  
                                                <input class="calendario_jquery " name="preno_dal" id="preno_dal_c" value="" type="text">
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class=" large-12 columns">
                                            <label>Partenza
                                                <input class="calendario_jquery " name="preno_al" id="preno_al_c" value="" type="text">
                                            </label>
                                        </div>
                                    </div>
<!--                                    <div class="row">
                                        <div class="  large-12 columns">
                                            <label>Tipo di Camere    <select name="T1" id="select" size="1">
                                                    <option value="0" selected="">Select e rooms</option>
                                                    <option value="1">Single</option>
                                                    <option value="2" selected="selected">Twin</option>
                                                    <option value="3">Double</option>
                                                    <option value="4">Triple</option>
                                                    <option value="5">Quadruple</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>  -->
                                    <div class="row">
                                        <div class="  large-12 columns">
                                            <label>Numero Camere    <select name="Q1" id="select2">
                                                    <option value="1" selected="selected"> 1</option>
                                                    <option value="2"> 2</option>
                                                    <option value="3"> 3</option>
                                                    <option value="4"> 4</option>
                                                    <option value="5"> 5</option>
                                                    <option value="6"> 6</option>
                                                    <option value="7"> 7</option>
                                                    <option value="8"> 8</option>
                                                    <option value="9"> 9</option>
                                                    <option value="10"> 10</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="  large-12 columns">
                                            <label>Promozionale    <input name="promocod" id="promocod" size="4" maxlength="6" type="text">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="large-12 columns">
                                            <label>&nbsp;
                                                <input class="button postfix" name="" value="Cerca" type="submit">
                                            </label>
                                        </div>
                                    </div>
                                    <input name="hotel_id" id="hotel_id" value="2" type="hidden">
                                    <input name="ref_site" id="ref_site" value="408" type="hidden">
                                    <input name="ref_event" id="ref_event" value="340" type="hidden">
                                    <input name="agenzia_id" id="agenzia_id" value="279" type="hidden">
                                    <input name="lg" id="hiddenField" value="it" type="hidden">
                                </form>
                            </div>
                            
                             </div>
                            
                            
                            <div class="small-12 large-8 columns"> 
                                <!--<div id="datepickerM"></div> -->
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <th width="80%">Prenota il tuo prossimo viaggio direttamente qui e avrai i seguenti Vantaggi </th>
                                            <th width="20%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Tariffe inferiore del 5%  </td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Programma fedeltà</td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Early check-in a partire dalle 10:00*</td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Late Check-out fino alle 13,00*</td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                        <tr>
                                            <td> Upgrade a Camera di categoria Superiore* </td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                        <tr>
                                            <td>1 Bottiglia d'Acqua Minerale </td>
                                            <td><i class="fi-check"></i></td>
                                        </tr>
                                    </tbody>
                                </table>
                                Nei nostri alberghi ricevi 1 punto per ogni 10 
                                <a href="#" data-reveal-id="myModal">Click Me For A Modal</a>
                            </div>
                            
                            
                            
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
       
        
        <?php
        $attributes = array('class' => '', 'id' => '');	           
        echo form_open( base_url(). 'index.php/obmp/availability/?'. $_SERVER['QUERY_STRING'], $attributes); 
        ?>   
        
 
        <?php
        

        
        for ($a = 1; $a <= 4; $a++) {
            ?>
            <fieldset>

                <div class="row">
                        <!--    immagine-->
                        <div class="small-12 large-4 columns">
                            <ul class="clearing-thumbs clearing-feature" data-clearing>
                                <!--    img featured-->
                                <li class="clearing-featured-img">
                                    <a href="http://placehold.it/800x500" alt="Photo of 1 Uranus." ><img src="http://placehold.it/250x250" alt="Photo  1 TH." ></a>
                                </li>
                                <li>
                                    <a href="http://placehold.it/800x500"  alt="Photo of 2 Uranus." > <img src="http://placehold.it/250X250"   alt="Photo  1 TH." ></a>
                                </li>
                                <li>
                                    <a href="http://placehold.it/800x500" alt="Photo of 3 Uranus."><img src="http://placehold.it/250X250"   alt="Photo  1 TH." ></a>
                                </li>
                            </ul>          
                            <!--<img class="thumbnail" src="http://placehold.it/250x250" alt="Photo of Uranus.">-->
                        </div>
                        <!--  corpo-->
                        <div class="small-12 large-8 columns">
                            <!--    1 riga  titolo e sconto -->
                            <div class="row">
                                <div class="small-6  large-8 columns">
                                    <p>   STANDARD SINGLEE</p>
                                </div>
                                <div class="small-6  large-4 columns">
                                    <p> SCONTO 30%</p> 
                                </div>
                            </div>
                             <!--    2 riga selezione  -->
                            <div class="row">
                                <div class="small-4 large-6 columns">
                                    <p>  STARTING FROM 144.00€ </p>  
                                </div>
                                <div class="small-4  large-3 columns">
                                    <!--                             camara-->
                                    <input type="hidden" name="cm_rooms_id[]" value="<?php echo $a; ?>" id="cm_rooms_id_<?php echo $a; ?>"  />
                                    <!--                            prezzo-->
                                    <input type="hidden" name="price[]" value="<?php echo $a; ?>" id="price_<?php echo $a; ?>"  />
                                    <!--                              quantita -->
                                    <select name="num[]" id="num_<?php echo $a; ?>" >
                                        <option value="0">0  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     &#8364; 0</option>
                                        <option value="1">1  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     &#8364; 100</option>
                                        <option value="2">2  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     &#8364; 200</option>
                                        <option value="3">3  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     &#8364; 300</option>
                                    </select>
                                </div>
                                <div class="small-4  large-3 columns">
                                    <!--  booking-->
                                    <div id="book_bot_<?php echo $a ?>" > <span title="Seleziona la quantita "> Seleziona </span>  </div>
                                </div>
                            </div>
                            <!-- 3 riga  informazioni -->
                            <div class="row">
                                <div class="small-12 large-12 columns">
                                    <span id="info_<?php echo $a ?>" >
                                        <p> 
                                            Special Offer, Welcome drink, Free Wi-Fi, Air conditioning,.more..
                                        </p>
                                    </span> 
                                    <p> 
                                        <button type="button"  id="bottone_<?php echo $a ?>" class=" tiny button info "> More </button>
                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </fieldset>
          
            
            <!--                                    contenuto nascondi -->
            <div id="tipologia_id_<?php echo $a ?>" style="display: none;" class="av-summary" >  

                <fieldset>
                    <div class="row">
                        <div class="small-12 large-12 columns"> 
                            <a href="#" class="accordion-title">Accordion 1</a>
                            <div class="accordion-content" data-tab-content>


                                <div class="row">
                                    <div class="small-12 large-12 columns"> 
                                        <p> 
                                            Standard double as single occupancy (1 person - 13 square metres) charming and cosy with parquet floor, private bathroom with shower or tub, hairdryer, courtesy kit.
                                            Comfort: air conditioning, no smoking room, DSL/Wi-Fi free of charge, satellite TV, direct dial telephone, minibar, safe, soundproof window.
                                            With our compliments: FREE MINIBAR, one bottle of mineral water in room on arrival, coffee & tea maker facilities.
                                            Buffet breakfast served on our terrace. 
                                        </p>    
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="small-12 large-8 columns"> 
                                        <div>
                                            <h6>Incluso nel prezzo della camera:</h6>
                                            <ul>
                                                <li>La colazione è inclusa</li>
                                                <li> Internet Corner e Wi-Fi è gratuita.</li>
                                                <li> IVA al 10%. </li>
                                            </ul>
                                            <h6> Non incluso nella tariffa della camera: </h6>
                                            <ul>
                                                <li> 4 Euro a persona per notte.</li>
                                                <li> Il parcheggio non è incluso.</li>
                                                <li> Il servizio navetta non è incluso</li>
                                            </ul>
                                            <p>  </p>
                                        </div>

                                    </div>
                                    <div class="small-12 large-4 columns"> 
                                        <img src="http://placehold.it/250x250" alt="Photo  1 TH." >   
                                    </div>
                                </div>


                                <!--tag        -->
                                <p></p>
                                <span class="secondary label">Secondary Label</span>
                                <span class="success label">Success Label</span>
                                <span class="alert label">Alert Label</span>
                                <span class="warning label">Warning Label</span>

                                <p></p>
                                <table class="_bresponsive" id="tabel_2_59" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th class="hide-for-small-only">Disponibilità</th>
                                            <th class="hide-for-small-only">Prezzo per notte </th>
                                            <th>Totale prezzo al giorno</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Sun November 13, 2016</td><td class="hide-for-small-only">OK Availability</td><td class="hide-for-small-only">90.00</td><td>90.00 Euro </td></tr>              <tr>
                                            <td>Notti: 1</td>
                                            <td class="hide-for-small-only">Prezzo medio</td>
                                            <td class="hide-for-small-only">90.00</td>
                                            <td class="tex_arencione">Totale Prezzo <br>
                                                Euro 90.00 </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="hide-for-small-only">Prezzo Normale</td>
                                            <td class="hide-for-small-only">155.00</td>
                                            <td class="ui-accordion-icons">                  <span class="tex_verde">Risparmia<br>
                                                    Euro 65.00</span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <p></p>

                                <div class="row">
                                    <?php
                                    for ($i = 8; $i <= 6; $i++) {
                                        ?>
                                        <div class="small-4 large-2 columns">
                                            <!--    daly preice-->
                                            <ul class="pricing-table">
                                                <li class="title">Standard</li>
                                                <li class="price">$99.99</li>
                                                <li class="description">An awesome description</li>
                                                <li class="bullet-item">1 Database</li>
                                                <li class="bullet-item">5GB Storage</li>
                                                <li class="bullet-item">20 Users</li>
                                                <li class="cta-button"><a class="button" href="#">Buy Now</a></li>
                                            </ul>
                                        </div>
                                    <?php } ?>
                                </div>


                                <div id="panel_book_bot_<?php echo $a ?>"></div>


                            </div>
                        </div>

                    </div>
                </fieldset>

                <!--                                     / contenuto nascondi-->
            </div>


            <script>
                $("#bottone_<?php echo $a ?>").click(function () {
                    $("#tipologia_id_<?php echo $a ?>").toggle("slow");
                });

                $("#info_<?php echo $a ?>").click(function () {
                    $("#tipologia_id_<?php echo $a ?>").toggle("slow");
                });

            </script>
            

            
            
            
            
        <?php } ?>

            <?php echo form_close(); ?>
            
    </div>
    
    
    <div class="show-for-medium-up small-12 medium-4 large-3 columns" id="col_riepilogo" >
        <div id="riepilogo" >  
            <fieldset>  
                riepilogo <br> 
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <!--            Check-in-->
                        <div class="ContenitoreCalendarioInterno">
                            <div class="ContenitoreMeseAnno">
                                <span> Check-in</span>
                            </div>
                            <div class="ContenitoreGiorno">
                                <span>13</span>
                            </div>
                            <div class="ContenitoreGiornoSettimana">
                                <span>NOV 2016</span>
                            </div>
                        </div>
                    </div>
                    <!--Check-Out-->
                    <div class="small-4 large-4 columns">
                        <div class="ContenitoreCalendarioInterno">
                            <div class="ContenitoreMeseAnno">
                                <span> Check-out</span>
                            </div>
                            <div class="ContenitoreGiorno">
                                <span>14</span>
                            </div>
                            <div class="ContenitoreGiornoSettimana">
                                <span> NOV 2016</span>
                            </div>
                        </div>
                    </div>
                    <!--            giorni-->
                    <div class="small-4 large-4 columns">
                        <div class="ContenitoreCalendarioInternonotti">
                            <div class="ContenitoreMeseAnnonotti">
                                <span>N° of nights</span>
                            </div>
                            <div class="ContenitoreGiornonotti">
                                <span>1</span>
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

 <?php   for ($a = 1; $a <= 4; $a++) { ?>

<div class="" id="summary_a_<?php echo $a ; ?>" ></div>


        <script>
    $(function() {
    // Clienti prezzi web 
    $('#num_<?php echo $a; ?>').change(function(){
    var camara_cm = $('#cm_rooms_id_<?php echo $a ; ?>').val();
    var prezzo_cm = $('#price_<?php echo $a; ?>').val();
     var num_cm = $('#num_<?php echo $a; ?>').val();

    $("div#summary_a_<?php echo $a; ?>").load("<?php echo base_url(); ?>index.php/obmp/summary_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm  );

    $("div#book_bot_<?php echo $a ?>").load("<?php echo base_url(); ?>index.php/obmp/booking_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm  );


    $("div#panel_book_bot_<?php echo $a ?>").load("<?php echo base_url(); ?>index.php/obmp/booking_select/?camara_cm=" + camara_cm + "&prezzo_cm=" + prezzo_cm + "&num_cm=" + num_cm  );





    });

    });

    </script>

 <?php } ?>
            </div>  
            
        </div>
    </div>
    
    
    
    
</div>
<!--dettagli-->



<div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">

   <h3> Programma fedelta </h3>


    <div class="panel callout radius">
     

        Ogni volta che soggiorni * nei nostri alberghi ricevi 1 punto per ogni 10 Euro speso per  il soggiorno
        <table width="100%">
            <thead>
                <tr>
                    <th>Punti</th>
                    <th>Coupon in Euro (**) </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>50</td>
                    <td>10,00</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>20,00</td>
                </tr>
                <tr>
                    <td>150</td>
                    <td>40,00</td>
                </tr>
                <tr>
                    <td>200</td>
                    <td>60,00</td>
                </tr>
                <tr>
                    <td>250</td>
                    <td>100.00</td>
                </tr>
                <tr>
                    <td>300</td>
                    <td>120.00</td>
                </tr>
                <tr>
                    <td>350</td>
                    <td>175.00</td>
                </tr>
                <tr>
                    <td>400</td>
                    <td>220.00</td>
                </tr>
            </tbody>
        </table>
        (*) vengono  calcolato solo i soggiorni  prenotati on-line sul booking dell’hotel e hanno scadenze annuale 
        <br>
        (**)Il Coupon è spendibile in ogni nostro hotel 
        </p> 
    </div>


    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>



<script>



    $("#calendario1").click(function () {
        $("#cercatore1").toggle("slow");
    });



</script>
<script>
    $("#datepickerM").datepicker();
</script>  
<script>

    $(function () {
// Dal 
        $("#preno_dal_c").datepicker({
            defaultDate: "",
            showButtonPanel: true,
            currentText: "Today",
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd',
            onSelect: function (selectedDate) {
                $("#preno_al_c").datepicker("option", "minDate", selectedDate);

            }
        });
// Al
        $("#preno_al_c").datepicker({
            defaultDate: "+1d",
            showButtonPanel: true,
            changeMonth: true,
            changeYear: true,
            numberOfMonths: 2,
            firstDay: 1,
            minDate: new Date(),
            dateFormat: 'yy-mm-dd'
        });


    });
</script>


<div class="show-for-large-up"> 

<script>
   $(window).scroll(function () {
      $("#riepilogo").stop().animate({"marginTop": ($(window).scrollTop()) + "px", "marginLeft": ($(window).scrollLeft()) + "px"}, "slow");
  });
</script>

</div>