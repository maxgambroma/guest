<?php $url_img = 'http://www.ciaohotel.com/html/obmpmax/obmpmax/'; 


       //  prendo i dati del post
        $cm_rooms = $this->input->post('cm_rooms_id');
        $cm_num = $this->input->post('num');
        $cm_price = $this->input->post('price');


?>

<div class="row">
<div class="small-12    large-12  columns"> 
<form  data-abide  action="<?php echo base_url(); ?>index.php/obmp/availability/?<?php echo $_SERVER['QUERY_STRING']; ?>" method="post"   name="booking" id="booking">   
    <fieldset> 
        <p>
<?php echo $lg_tex['check-in']; ?>:   <?php    echo $preno_dal ;?>  <?php echo $lg_tex['check-out']; ?>:  <?php   echo $preno_al ;?> 
    
         <br>
    
    </p> 
    
    <?php
// controllo le tipologie selezionate
foreach ($this->input->post('cm_rooms_id') as $key => $value) {
// se selezionate 
if ($cm_num[$key] != 0) {
$row_rooms = $room[$value];
?>  
<div class="row">
    <div class="large-2 columns" >
        <img src="<?php echo $url_img . $row_rooms->obmp_cm_rooms_foto150; ?>">
    </div>             
    <div class="large-10 columns" >
        <h4> <?php echo $cm_num[$key]; ?>  <?php echo $row_rooms->obmp_cm_lingue_nome; ?>  </h4>
        <div class="row">
            <div class="large-12 columns">  </div>   
        </div>
        <div class="row">
            <div class="large-12 columns">
                <?php echo $row_rooms->obmp_cm_lingue_html1; ?>
            </div>   
        </div>
        
               <div class="row">
            <div class="large-12 columns">
               Prezzo:  <?php echo $cm_price[$key]; ?> euro X <?php echo $night; ?> night =  <?php echo (float) $cm_price[$key] * (float) $night * (float) $cm_num[$key]; ?>
            </div>   
        </div>
        

    </div>   
</div>   

<hr>
<?php } ?>


             <div class="row">
            <div class="large-12 columns">
              Totale   <?php echo (float) $cm_price[$key] * (float) $night * (float) $cm_num[$key]; ?>
            </div>   
        </div>
        



<?php } ?>         
</fieldset>
    <fieldset> 
<legend><?php echo $lg_tex['guest_details']; ?></legend>
<h5> <?php echo $lg_tex['your_privacy_is_guaranteed']; ?></h5>

<div class="row">
<div class=" small-12 large-6 columns">
<p>
<label><?php echo $lg_tex['first_name']; ?>: <small>required</small>
<input name="preno_nome" type="text" id="preno_nome" required  />
</label>
<small class="error"><?php echo $lg_tex['first_name']; ?> is required </small>
</p>
</div>  
<div class="small-12 large-6 columns">
<p>
<label><?php echo $lg_tex['last_name']; ?>: <small>required</small>
<input name="preno_cogno" type="text" id="preno_cogno" required  />
</label>
<small class="error"><?php echo $lg_tex['last_name']; ?> is required </small>
</p>                   
</div>  
</div>
<div class="row">
<div class=" small-12 large-6 columns">

<p>
<label><?php echo $lg_tex['e-mail']; ?>: <small>required</small>
<input name="preno_email"  type="email" class="email_jquery"  id="preno_email" required />
</label>
<small class="error"><?php echo $lg_tex['e-mail']; ?> address is required.</small>
</p>
</div>  
<div class="small-12 large-6 columns">
<p>
<label><?php echo $lg_tex['confirm_e-mail ']; ?>: <small>required</small>
<input name="o_email_conf" type="email" class="email_jquery"  id="o_email_conf" required data-equalto="preno_email" />
</label>
<small class="error"><?php echo $lg_tex['confirm_e-mail ']; ?> did not match</small>
</p>      
</div>  
</div>

<div class="row">
<div class=" small-12 large-6 columns">
    <p>
<label> <?php echo $lg_tex['city']; ?>: <small>required</small>
<input name="preno_city" type="text" id="preno_city"  required "/>
</label>
<small class="error"><?php echo $lg_tex['city']; ?> is required </small>
</p>
</div>  

<div class="small-12 large-6 columns">
<p>
<label><?php echo $lg_tex['country']; ?>: <small>required</small>
<select name="preno_country" id="preno_country"  required="" data-invalid="" > 
<option value="">-- Please Select --</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Belgium">Belgium</option>
<option value="Brazil">Brazil</option>
<option value="Canada">Canada</option>
<option value="China">China</option>
<option value="Denmark">Denmark</option>
<option value="France" >France</option>
<option value="Germany">Germany</option>
<option value="Ireland">Ireland</option>
<option value="Italy">Italy</option>
<option value="Japan">Japan</option>
<option value="Netherlands">Netherlands</option>
<option value="Norway">Norway</option>
<option value="Poland">Poland</option>
<option value="Russia">Russia</option>
<option value="Spain">Spain</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="USA">USA</option>
<option value="United Kingdom">United Kingdom</option>
<option value="--">-- All Country -- </option>
<option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Eel (island)">Eel (island)</option>
<option value="Antigua and barbuda">Antigua and barbuda</option>
<option value="British antilless">British antilless</option>
<option value="Dutch antilless">Dutch antilless</option>
<option value="Stateless person">Stateless person</option>
<option value="Southern arabia">Southern arabia</option>
<option value="Saudi arabia">Saudi arabia</option>
<option value="Argentine">Argentine</option>
<option value="Armenia">Armenia</option>
<option value="Azerbaigian">Azerbaigian</option>
<option value="Bahama">Bahama</option>
<option value="Bahrein">Bahrein</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Basutoland british south africa">Basutoland british south africa</option>
<option value="Beciuania british south africa">Beciuania british south africa</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermude">Bermude</option>
<option value="Bhutan">Bhutan</option>
<option value="Bielorussia">Bielorussia</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and erzegovina">Bosnia and erzegovina</option>
<option value="Bosnia-herzegovina">Bosnia-herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brasil">Brasil</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina faso">Burkina faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroun">Cameroun</option>
<option value="Capoverde">Capoverde</option>
<option value="Caroline">Caroline</option>
<option value="Cayman (islands)">Cayman (islands)</option>
<option value="Czechoslovakia">Czechoslovakia</option>
<option value="Centrafrica">Centrafrica</option>
<option value="Christmas">Christmas</option>
<option value="Ciad">Ciad</option>
<option value="Chile">Chile</option>
<option value="China national republic">China national republic</option>
<option value="Cyprus">Cyprus</option>
<option value="Ciskei">Ciskei</option>
<option value="Citta' of the vatican">Citta' of the vatican</option>
<option value="Cocos">Cocos</option>
<option value="Colombia">Colombia</option>
<option value="Comore">Comore</option>
<option value="The congo">The congo</option>
<option value="Korea of the north">Korea of the north</option>
<option value="Korea of the south">Korea of the south</option>
<option value="Costad' ivory">Costad' ivory</option>
<option value="Costarica">Costarica</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Australian dependencies">Australian dependencies</option>
<option value="British dependencies">British dependencies</option>
<option value="Canadian dependencies">Canadian dependencies</option>
<option value="French dependencies">French dependencies</option>
<option value="New zealand dependencies">New zealand dependencies</option>
<option value="Soviet dependencies">Soviet dependencies</option>
<option value="South african dependencies">South african dependencies</option>
<option value="Dominica">Dominica</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El salvador">El salvador</option>
<option value="Ellice">Ellice</option>
<option value="The united arab emirates">The united arab emirates</option>
<option value="Eritrean">Eritrean</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Faer oer">Faer oer</option>
<option value="Figi">Figi</option>
<option value="Figi or lives">Figi or lives</option>
<option value="The philippines">The philippines</option>
<option value="Finland">Finland</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany rep. democratic">Germany rep. democratic</option>
<option value="Ghana">Ghana</option>
<option value="Giamaica">Giamaica</option>
<option value="Gibuti">Gibuti</option>
<option value="Jordan">Jordan</option>
<option value="Greece">Greece</option>
<option value="Grenada">Grenada</option>
<option value="Greenland">Greenland</option>
<option value="Guadalupa">Guadalupa</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="French guayana">French guayana</option>
<option value="Guinea">Guinea</option>
<option value="Guinea bissau">Guinea bissau</option>
<option value="Equatorial guinea">Equatorial guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Honduras">Honduras</option>
<option value="Ifni">Ifni</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Western irian">Western irian</option>
<option value="Islanda">Islanda</option>
<option value="Islands vergini">Islands vergini</option>
<option value="Israel">Israel</option>
<option value="Yugoslavia">Yugoslavia</option>
<option value="Kazakistan">Kazakistan</option>
<option value="Kenya">Kenya</option>
<option value="Kirghizistan">Kirghizistan</option>
<option value="Kiribati">Kiribati</option>
<option value="Kuwait">Kuwait</option>
<option value="The reunion">The reunion</option>
<option value="Laos">Laos</option>
<option value="Lesotho">Lesotho</option>
<option value="Lettonia">Lettonia</option>
<option value="Lebanese">Lebanese</option>
<option value="Liberia">Liberia</option>
<option value="Libia">Libia</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lituania">Lituania</option>
<option value="Lussemburgo">Lussemburgo</option>
<option value="Macedonian">Macedonian</option>
<option value="Macquarie">Macquarie</option>
<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldive">Maldive</option>
<option value="Evils">Evils</option>
<option value="Mortar">Mortar</option>
<option value="The falklands">The falklands</option>
<option value="Man">Man</option>
<option value="Marcus">Marcus</option>
<option value="Marianne">Marianne</option>
<option value="Morocco">Morocco</option>
<option value="Marshall">Marshall</option>
<option value="Martinica">Martinica</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Maurizio">Maurizio</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia be federal">Micronesia be federal</option>
<option value="Midway">Midway</option>
<option value="Moldavia">Moldavia</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Norfolk">Norfolk</option>
<option value="Normanne">Normanne</option>
<option value="New caledonia">New caledonia</option>
<option value="New guinea">New guinea</option>
<option value="New zeland">New zeland</option>
<option value="New ebridi">New ebridi</option>
<option value="Oman">Oman</option>
<option value="Low countries">Low countries</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau republic">Palau republic</option>
<option value="Panama hat">Panama hat</option>
<option value="Panama hat zone of the channel">Panama hat zone of the channel</option>
<option value="Papuasia-n.guinea">Papuasia-n.guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Passover">Passover</option>
<option value="Peru">Peru</option>
<option value="Pitcairn">Pitcairn</option>
<option value="Polynesia">Polynesia</option>
<option value="Portugal">Portugal</option>
<option value="Prince">Prince</option>
<option value="Protettorato of southern arabia">Protettorato of southern arabia</option>
<option value="Puerto rico">Puerto rico</option>
<option value="Qatar">Qatar</option>
<option value="United kingdom">United kingdom</option>
<option value="Rep. czech">Rep. czech</option>
<option value="Rep. dominicana">Rep. dominicana</option>
<option value="Czech republic">Czech republic</option>
<option value="Slovakian republic">Slovakian republic</option>
<option value="Rumania">Rumania</option>
<option value="Ruanda">Ruanda</option>
<option value="Russia (russian federation)">Russia (russian federation)</option>
<option value="Ryukyu">Ryukyu</option>
<option value="S. christopher and nevis">S. christopher and nevis</option>
<option value="S. vincent and grenadine">S. vincent and grenadine</option>
<option value="Spanish sahara">Spanish sahara</option>
<option value="Saint lucia">Saint lucia</option>
<option value="Saint pierre et miquelon">Saint pierre et miquelon</option>
<option value="Saint vincent and grenadine">Saint vincent and grenadine</option>
<option value="Saint vincente grenadine">Saint vincente grenadine</option>
<option value="Salomone">Salomone</option>
<option value="Samoa">Samoa</option>
<option value="American samoa">American samoa</option>
<option value="Sanmarino">Sanmarino</option>
<option value="Sant elena">Sant elena</option>
<option value="Sao tome' and prince">Sao tome' and prince</option>
<option value="Savage">Savage</option>
<option value="Seicelle">Seicelle</option>
<option value="Senegal">Senegal</option>
<option value="Sierra leone">Sierra leone</option>
<option value="Sierraleone">Sierraleone</option>
<option value="Sikkim">Sikkim</option>
<option value="Singapore">Singapore</option>
<option value="Syria">Syria</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Somalia">Somalia</option>
<option value="French somalia">French somalia</option>
<option value="Srilanka">Srilanka</option>
<option value="South africa">South africa</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Tagikistan">Tagikistan</option>
<option value="Taiwan">Taiwan</option>
<option value="Tanganica">Tanganica</option>
<option value="Tanzania">Tanzania</option>
<option value="Territory of gaza">Territory of gaza</option>
<option value="Thailandia">Thailandia</option>
<option value="Timor">Timor</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Tonga or of the friends">Tonga or of the friends</option>
<option value="Transkei">Transkei</option>
<option value="Trinida de tobago">Trinida de tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkemenistan">Turkemenistan</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks">Turks</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Ucraina">Ucraina</option>
<option value="Uganda">Uganda</option>
<option value="Hungary">Hungary</option>
<option value="Uruguay">Uruguay</option>
<option value="Usa">Usa</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="It sells">It sells</option>
<option value="Venezuela">Venezuela</option>
<option value="British vergini (islands)">British vergini (islands)</option>
<option value="Vietnam">Vietnam</option>
<option value="Vietnam of the north">Vietnam of the north</option>
<option value="Vietnam of the south">Vietnam of the south</option>
<option value="Wallis">Wallis</option>
<option value="Yemen">Yemen</option>
<option value="Yemen rep. dem. popular">Yemen rep. dem. popular</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zanzibar">Zanzibar</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
</label>
    
<small class="error"><?php echo $lg_tex['country']; ?>is required </small>
</p>

</div>  
</div>

<div class="row">
<div class="small-4 large-4 columns">
<p>
<label><?php echo $lg_tex['international_code']; ?> <small>required</small>
    <input name="tel_stato" type="text" id="tel_stato" placeholder="+99"  pattern="number" required />
</label>
<small class="error"><?php echo $lg_tex['international_code']; ?> is required </small>
</p>
</div>
<div class="small-4 large-4 columns">
<p>
<label><?php echo $lg_tex['domestic_code']; ?><small>required</small>
<input name="tel_prefisso" type="text" placeholder="09"   pattern="number" required  />
</label>
<small class="error"><?php echo $lg_tex['domestic_code']; ?> is required </small>
</p>
</div>
<div class="small-4 large-4 columns">
<p>
<label><?php echo $lg_tex['phone_number']; ?><small>required</small>
<input name="tel_nemero" type="text" id="tel_nemero" placeholder="999999999"  pattern="number" required  />
</label>
<small class="error"><?php echo $lg_tex['phone_number']; ?> is required </small>        </p>
</div>
</div>


</fieldset>


<fieldset>
<legend><?php echo $lg_tex['notes_for_the_property']; ?></legend>



<div class="row">
<div class="small-12 large-6 columns">
<p>

<label><?php echo $lg_tex['i_would_like_to_notify_my_arrival_time']; ?>
<select name="preno_arr_ore" id="preno_arr_ore">
<option>--</option>
<option value="1">01 AM</option>
<option value="2">02 AM</option>
<option value="3">03 AM</option>
<option value="4">04 AM</option>
<option value="5">05 AM</option>
<option value="6">06 AM</option>
<option value="7">07 AM</option>
<option value="8">08 AM</option>
<option value="9">09 AM </option>
<option value="10">10 AM</option>
<option value="11">11 AM</option>
<option value="12">12 AM</option>
<option value="13">01 PM</option>
<option value="14">02 PM </option>
<option value="15">03 PM</option>
<option value="16">04 PM</option>
<option value="17">05 PM</option>
<option value="18">06 PM </option>
<option value="19">07 PM </option>
<option value="20">08 PM</option>
<option value="21">09 PM </option>
<option value="22">10 PM </option>
<option value="23">11 PM </option>
<option value="24">12 PM</option>
</select>
</label>
</p>
</div>
<div class="small-12 large-6 columns">
<p>
<label> <?php echo $lg_tex['newsletter']; ?>:
<input name="newsletter" type="checkbox" id="newsletter" value="1" checked="checked" />
</label>
</p>

</div>

</div>


<p>
<label><?php echo $lg_tex['special_requests']; ?>
<textarea name="preno_note" cols="60" rows="4" id="preno_note"></textarea>
</label>
</p>



</fieldset>
    
<fieldset>
<legend><?php echo $lg_tex['cancellation_policy']; ?></legend>
<h4>  <?php echo $lg_tex['cancellation_without_penalty_until']; ?>
<?php // echo @date("D M j Y", strtotime(sottrazione_gg($preno_dal, $giorni_cancallazione))); ?>
</h4> 
</fieldset>
    
<fieldset>
<legend><?php echo $lg_tex['credit_card']; ?></legend>
<h4><?php echo $lg_tex['no_pre-payment']; ?></h4>


<div class="row">
    <div class="small-12 large-6 columns">
        
<p>
<label><?php echo $lg_tex['Holder']; ?>: <small>required</small>
<input name="preno_cc_holder" type="text" id="preno_cc_holder" required  />
</label>
<small class="error"><?php echo $lg_tex['Holder']; ?> is required.</small>
</p>

    </div>
    <div class="small-12 large-6 columns">
        

<p>
<label> <?php echo $lg_tex['type_of_credit_card']; ?>: <small>required</small>
<select name="preno_cc_tip" id="preno_cc_tip" required="" data-invalid=""  >
<option value="">Seleziona cc</option>
<option value="vi">Visa</option>
<option value="ax">American Express</option>
<option value="dc">Diners Club</option>
<option value="mc">MasterCard</option>
<option value="eu">Eurocard</option>
<option value="jc">JCB</option>
</select>
</label>
<small class="error"><?php echo $lg_tex['type_of_credit_card']; ?> is required </small>
</p>

    </div>
    
</div>


<div class="row">
    <div class="small-12 large-6 columns">
        
<p>
<label><?php echo $lg_tex['number']; ?>: <small>required</small>
<input name="preno_cc_n" type="text" id="preno_cc_n" pattern="card" required  />
</label>
<small class="error"> <?php echo $lg_tex['number']; ?> is required and must be a number</small>
</p>

    </div>
    <div class="small-12 large-6 columns">
        
<p>
<label><?php echo $lg_tex['expiry_date']; ?>: <small>required</small>
<input name="preno_cc_scad" type="text" id="preno_cc_scad"  required   />
</label>
<small class="error"><?php echo $lg_tex['expiry_date']; ?> is required </small>
</p>
    </div>
    
</div>





</fieldset>

<input name="submit_booking" class="button  expand round success" type="submit" value="<?php echo $lg_tex['confirm_booking']; ?>">

<h5> <?php echo $lg_tex['you_receive_e-mail']; ?> </h5>

      <input name="hotel_id" type="hidden" id="hotel_id" value="<?php echo $hotel_id ; ?>" />
      <input name="preno_dal" type="hidden" id="preno_dal" value="<?php echo $preno_dal ?>" />
      <input name="preno_al" type="hidden" id="preno_al" value="<?php echo $preno_al; ?>" />
        
      
      
<input id="t1" type="hidden" name="t1"  value="<?php echo ( !set_value('t1')) ? $t[1]  : set_value('t1');  ?>"  />
<input id="q1" type="hidden" name="q1"  value="<?php echo ( !set_value('q1')) ? $q[1]  : set_value('q1');  ?>"  />
<input id="p1" type="hidden" name="p1"  value="<?php echo ( !set_value('p1')) ? $p[1]  : set_value('p1');  ?>"  />

<input id="t2" type="hidden" name="t2"  value="<?php echo ( !set_value('t2')) ? $t[2]  : set_value('t2');  ?>"  />
<input id="q2" type="hidden" name="q2"  value="<?php echo ( !set_value('q2')) ? $q[2]  : set_value('q2');  ?>"  />
<input id="p2" type="hidden" name="p2"  value="<?php echo ( !set_value('p2')) ? $p[2]  : set_value('p2');  ?>"  />

<input id="t3" type="hidden" name="t3"  value="<?php echo ( !set_value('t3')) ? $t[3]  : set_value('t3');  ?>"  />
<input id="q3" type="hidden" name="q3"  value="<?php echo ( !set_value('q3')) ? $q[3]  : set_value('q3');  ?>"  />
<input id="p3" type="hidden" name="p3"  value="<?php echo ( !set_value('p3')) ? $p[3]  : set_value('p3');  ?>"  />

<input id="t4" type="hidden" name="t4"  value="<?php echo ( !set_value('t4')) ? $t[4]  : set_value('t4');  ?>"  />
<input id="q4" type="hidden" name="q4"  value="<?php echo ( !set_value('q4')) ? $q[4]  : set_value('q4');  ?>"  />
<input id="p4" type="hidden" name="p4"  value="<?php echo ( !set_value('p4')) ? $p[4]  : set_value('p4');  ?>"  />

<input id="t5" type="hidden" name="t5"  value="<?php echo ( !set_value('t5')) ? $t[5]  : set_value('t5');  ?>"  />
<input id="q5" type="hidden" name="q5"  value="<?php echo ( !set_value('q5')) ? $q[5]  : set_value('q5');  ?>"  />
<input id="p5" type="hidden" name="p5"  value="<?php echo ( !set_value('p5')) ? $p[5]  : set_value('p5');  ?>"  />

<input id="t6" type="hidden" name="t6"  value="<?php echo ( !set_value('t6')) ? $t[6]  : set_value('t6');  ?>"  />
<input id="q6" type="hidden" name="q6"  value="<?php echo ( !set_value('q6')) ? $q[6]  : set_value('q6');  ?>"  />
<input id="p6" type="hidden" name="p6"  value="<?php echo ( !set_value('p6')) ? $p[6]  : set_value('p6');  ?>"  />
      




<?php foreach ($this->input->post('cm_rooms_id') as $key => $value) { ?>
<input id="" type="hidden" name="cm_rooms_id[]"  value="<?php echo $value ;  ?>"  />
<?php } ?>

<?php foreach ($this->input->post('num') as $key => $value) { ?>
<input id="" type="hidden" name="num[]"  value="<?php echo $value ;  ?>"  />
<?php } ?>

<?php foreach ($this->input->post('price') as $key => $value) { ?>
<input id="" type="hidden" name="price[]"  value="<?php echo $value ;  ?>"  />
<?php } ?>
      
      
      
</form>
</div>
</div>

     <script>
    $(function() {
    // Clienti prezzi web 
    $('#preno_country').change(function(){
   
//   var camara_cm = $('#preno_country').val();
    var camara_cm = $('#preno_country').attr('phone-code', value);


$('input#tel_stato').val(camara_cm');

    });

    });


document.write(camara_cm);

    </script>
