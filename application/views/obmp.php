 <?php  // print_r($prezzi) ;
 //print_r($camere_obmp);
 
 $url_img = 'http://www.ciaohotel.com/html/obmpmax/obmpmax/'; 
 
// 
//  [0] => stdClass Object
//        (
//            [obmp_cm_rooms_max_room] => 6
//            [hotel_id] => 1
//            [agenzia_id] => 279
//            [obmp_cm_id_hotel_agenzia] => 
//            [obmp_cm_attiva] => 0
//            [obmp_cm_rooms_id] => 51
//            [obmp_cm_rooms_attiva] => 1
//            [obmp_cm_rooms_tipologia_id] => 1
//            [obmp_cm_rooms_room_var_prezzo] => 1
//            [obmp_cm_rooms_room_min_prezzo] => 80
//            [obmp_cm_rooms_trattamento] => BB
//            [obmp_cm_rooms_max_pax] => 1
//            [obmp_cm_rooms_room_note] => Singola
//            [obmp_cm_lingue_codice] => en
//            [obmp_cm_lingue_nome] => Single
//            [obmp_cm_lingue_descrizione] => 
//            [obmp_cm_lingue_html1] => Room for, 1 people one single beds ensuite soundproof with free high-speed Internet access direct dial phone, individually controlled air conditioning cable television and mini bar Breakfast included
//            [obmp_cm_lingue_html2] => <h6>Included in room price:</h6>
//<ul>
//  <li> Breakfast is included</li>
//  <li> Internet Corner and Wi Fi it is free.</li>
//  <li> 10% VAT.</li>
//</ul>
//<h6> Not included in room price:</h6>
//<ul>
//  <li> EUR 4 city tax per person per night.</li>
//  <li> Parking is not included.</li>
//  <li> The shuttle service is not included. </li>
//</ul>
//            [obmp_cm_lingue_html3] => 
//            [obmp_cm_lingue_note] => 
//            [obmp_cm_lingue_politiche] => 
//            [obmp_cm_lingue_condizioni] => 
//            [obmp_cm_id] => 6
//            [obmp_cm_lingue_id] => 14
//            [obmp_cm_rooms_nesting] => 87
//            [obmp_cm_rooms_foto] => 
//            [obmp_cm_rooms_foto270] => 
//            [obmp_cm_rooms_foto150] => images/singola_1.jpg
//            [obmp_cm_rooms_foto700] => images/web_singola.jpg
//        )
// 
// 
//  $rs_clienti[0]->
 

 
  ?>
       
<!--

<?php  print_r($prezzi) ;?>

-->


       <?php
        $adttributes = array('class' => '', 'id' => '');	           
        echo form_open( base_url(). 'index.php/obmp/availability/index/?'. $_SERVER['QUERY_STRING'], $adttributes); 
        
     
?>   
        
 
<input type = "hidden" name = "preno_dal" value = "<?php echo $preno_dal; ?>" />
<input type = "hidden" name = "preno_al" value = "<?php echo $preno_al; ; ?>" />
<input type = "hidden" name = "hotel_id" value = "<?php echo $hotel_id; ?>" />
<input type = "hidden" name = "night" value = "<?php echo $night; ?>" />
<!--<input type = "hidden" name = "preno_dal" value = "1" />
<input type = "hidden" name = "preno_dal" value = "1" />-->



        <?php
        

  foreach ($camere_obmp as $key => $row_rooms) {
            
      
      

$p_var_somma = 0;
$p_var_perc = 1;
$p_sconto =    1- ( $prezzi['avg_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id]/ $prezzi['rack_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id]  ) *100; 
$p_sconto =   number_format(($p_sconto ), 0, '.', ',');
      
      
      
            ?>
        

<div id="room_id_<?php echo $row_rooms->obmp_cm_rooms_id ?>"> 
<fieldset>

                <div class="row">
                        <!--    immagine-->
                        <div class="small-12  medium-12  large-4 columns">
                            <ul class="clearing-thumbs clearing-feature" data-clearing>
                                <!--    img featured-->
                                <li class="clearing-featured-img">
                                    <a href="<?php  echo $url_img . $row_rooms->obmp_cm_rooms_foto150 ;  ?> " alt="Photo of 1 Uranus." ><img src="<?php  echo $url_img . $row_rooms->obmp_cm_rooms_foto150 ;  ?> " alt="Photo  1 TH." ></a>
                                </li>
                                <li>
                                    <a href="http://placehold.it/800x500"  alt="Photo of 2 Uranus." > <img src="http://placehold.it/250X250"   alt="Photo  1 TH." ></a>
                                </li>
                                <li>
                                    <a href="http://placehold.it/800x500" alt="Photo of 3 Uranus."><img src="http://placehold.it/250X250"   alt="Photo  1 TH." ></a>
                                </li>
                            </ul>          
                            <!--<img class="thumbnail" src="http://placehold.it/250x250" alt="Photo of Uranus.">-->
                            <p></p>
                        </div>
                        <!--  corpo-->
                        <div class="small-12  medium-12   large-8 columns">
                            <!--    1 riga  titolo e sconto -->
                            <div class="row">
                                <div class="small-6  medium-6  large-8 columns">
                                    <p><?php echo $row_rooms->obmp_cm_lingue_nome ; ?></p>
                                </div>
                                <div class="small-6   medium-6 large-4 columns ">
                                    <span class="sconto"> SCONTO <?php echo $p_sconto ;?> % </span>
                                </div>
                            </div>
                             <!--    2 riga selezione  -->
                            <div class="row">
                                <div class="small-12  medium-12   large-6 columns">
                                    <p>  STARTING FROM   </p>  
                                </div>
                                <div class="small-6  medium-6 large-3 columns">
                                    <!--                             camara-->
                                    <input type="hidden" name="cm_rooms_id[]" value="<?php  echo $row_rooms->obmp_cm_rooms_id ; ?>" id="cm_rooms_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>"  />
                                    <!--                            prezzo-->
                                    <input type="hidden" name="price[]" value="<?php echo $prezzi['avg_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id] ; ?>" id="price_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>"  />
                                    <!--  
                                    quantita -->
                                    <select name="num[]" id="num_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" >
                                     <option value="0">0  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;    &#8364; 0 </option>                     
                                    <?php    for ( $i = 1 ; $i <= (float)  min( $Q1, (float)$prezzi['min_nesting'][$row_rooms->obmp_cm_rooms_tipologia_id]) ;   $i++ )
                                    { ?>
                                     <option value="<?php echo $i; ?>"><?php echo $i; ?>  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;     &#8364; <?php echo   $prezzi['avg_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id] * $i ; ?></option>
                                      <?php } ?>
                                    </select>
                                    
                                </div>
                                <div class="small-6 medium-6 large-3 columns">
                                    <!--  booking-->
                                    <div id="book_bot_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" > <span class="room-select" title="Seleziona la quantita "> Seleziona </span>  </div>
                                </div>
                            </div>
                            <!-- 3 riga  informazioni -->
                            <div class="row">
                                <div class="small-12 large-12 columns">
                                    <span id="info_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" >
                                        <p> 
                                            Special Offer, Welcome drink, Free Wi-Fi, Air conditioning,.more..
                                        </p>
                                    </span> 
                                    <p> 
                                           <span id="bottone_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" class="apri_pannello"  > <i  class="fi-plus"></i>   </span>
                                        
                                        <!--<button type="button"  id="bottone_<?php echo $row_rooms->obmp_cm_rooms_id ?>" class=" tiny button info "> More </button>-->
                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div>
                </fieldset>
          
            
            <!--                                    contenuto nascondi -->
            <div id="tipologia_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" style="display: none;" class="av-summary" >  

                <fieldset>
                    <div class="row">
                        <div class="small-12 large-12 columns"> 
                            
                            <div class="" >


                                <div class="row">
                                    <div class="small-12 large-12 columns"> 
                                        <p> 
                                            <?php echo $row_rooms->obmp_cm_lingue_html1 ; ?>
                                        </p>    
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="small-12 large-8 columns"> 
                                        <div>
                                            <?php echo $row_rooms->obmp_cm_lingue_html2 ; ?>
                                        </div>

                                    </div>
                                    <div class="small-12 large-4 columns"> 
                                        <img src="<?php  echo $url_img . $row_rooms->obmp_cm_rooms_foto700 ;  ?>" alt="Photo  1 TH." >   
                                    </div>
                                </div>


                                <!--tag        -->
                                <p></p>
                                <span class="secondary label">Secondary Label</span>
                                <span class="success label">Success Label</span>
                                <span class="alert label">Alert Label</span>
                                <span class="warning label">Warning Label</span>

                                <p></p>
                                
                                
                                <table class="_bresponsive" id="tabel_" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th class="hide-for-small-only">Availability </th>
                                                <th class="hide-for-small-only">Price per night </th>
                                                <th>Total Daily Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach ($prezzi['prezzo_giorno'][$row_rooms->obmp_cm_rooms_tipologia_id] as $key => $row_prezzi) {
                                             
                                           ?>
                                            
                                            <tr><td><?php echo $key ; ?></td>
                                                <td class="hide-for-small-only"><?php echo $prezzi['nesting'][$row_rooms->obmp_cm_rooms_tipologia_id][$key] ; ?>   OK Availability</td>
                                                <td class="hide-for-small-only"><?php echo $row_prezzi ; ?> </td>
                                                <td>  90.00 Euro </td>
                                            </tr>
                                            
                                            
                                             <?php  } ?>
                                            
                                            <tr>
                                                <td>Night: <?php echo  $prezzi['notti']; ?> </td>
                                                <td class="hide-for-small-only">Average rate</td>
                                                <td class="hide-for-small-only"><?php echo $prezzi['avg_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id] ; ?> </td>
                                                <td class="tex_arencione">Totale Price <br>
                                                    Euro <?php //echo $row_prezzi[''] ; ?>  90.00 </td>
                                            </tr>
                                            
                                           
                                            
                                            <tr>
                                                <td></td>
                                                <td class="hide-for-small-only">Regular Price</td>
                                                <td class="hide-for-small-only"><?php echo $prezzi['rack_prezzo'][$row_rooms->obmp_cm_rooms_tipologia_id] ; ?> </td>
                                                <td class="ui-accordion-icons">                  <span class="tex_verde">Save OFF<br>
                                                        Euro <?php // echo $row_prezzi[''] ; ?>  65.00</span> </td>
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


                                <div id="panel_book_bot_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>"></div>

                                     <span id="chiudi_tipo_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>" class="chiudi_pannello"  > <i  class="fi-x-circle"></i>   </span>

                            </div>
                        </div>

                    </div>
                </fieldset>

                <!--                                     / contenuto nascondi-->
            </div>


            <script>
                $("#bottone_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").click(function () {
                    $("#tipologia_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").toggle("slow");
                });

                $("#info_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").click(function () {
                    $("#tipologia_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").toggle("slow");
                });
                
                
                
                $("#chiudi_tipo_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").click(function () {
                    $("#tipologia_id_<?php echo $row_rooms->obmp_cm_rooms_id ; ?>").toggle("slow");
                });
                
               
            </script>
            

            
            
            </div>
            
        <?php } ?>

            <?php echo form_close(); ?>
