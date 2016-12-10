<div class="row">
            <div class="small-12 large-12 columns">
                
                <div id="calendario1" class="av-summary" > 
                    <div class="row"> 
                        <div class="small-4 large-3 columns">
                            <p>   From  <br> <?php echo date("D M j Y", strtotime($preno_dal));  ; ?></p>
                        </div>
                        <div class="small-4 large-3 columns">
                         <p>   To <br> <?php echo date("D M j Y", strtotime($preno_al));  ; ?> </p>
                             </div>
                           <div class="small-4 large-3 columns">
                         <p>  Soggiorno:  <br> <?php $night; ?> notti)  </p>
                           
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
                                <form action="<?php echo base_url().'index.php/obmp/index/?'. $_SERVER['QUERY_STRING']; ?> method="post" id="form_prezzi" name="form_prezzi">
                                    <div class="row">
                                        <div class="   large-12 columns">
                                            <label>Arrivo  
                                                <input class="calendario_jquery " name="preno_dal" id="preno_dal_c" value="<?php echo $preno_dal; ?>" type="text">
                                            </label>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class=" large-12 columns">
                                            <label>Partenza
                                                <input class="calendario_jquery " name="preno_al" id="preno_al_c" value="<?php echo $preno_al; ?>" type="text">
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
                                            <label>Numero Camere   
                                                               <?php
                                            $options = array(
                                                '1' => '1',
                                                '2' => '2',
                                                '3' => '3',
                                                '4' => '4',
                                                '5' => '5',
                                                '30' => '30',
                                            );
                                            ?>
                                             <?php echo form_dropdown('Q1', $options,   (! set_value('Q1')) ?  $Q1 :  set_value('Q1')   )?>
                                                    
                                            </label>
                                            
                                            
                          
</p>            
                                            
                                            
                                            
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
                                    <input name="hotel_id" id="hotel_id" value="<?php echo $stat['hotel_id'];  ?>" type="hidden">
                                    <input name="ref_site" id="ref_site" value="<?php echo $stat['ref_site'];  ?>" type="hidden">
                                    <input name="ref_event" id="ref_event" value="<?php echo $stat['ref_event'];  ?>" type="hidden">
                                    <input name="agenzia_id" id="agenzia_id" value="<?php echo $stat['ref_agency'];  ?>" type="hidden">
                                    <input name="lg" id="lg" value="<?php echo $this->lg;  ?>" type="hidden">
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
                            
                   
                            
             
                            <span id="chiudi_cercatore1" class="chiudi_pannello"  > <i  class="fi-x-circle"></i>   </span>



                            
                        </div>
                    </fieldset>
                    
                    
                </div>
            </div>
        </div>





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




    $("#chiudi_cercatore1").click(function () {
        $("#cercatore1").toggle("slow");
    });




</script>