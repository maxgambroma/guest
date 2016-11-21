<div class="row">


    <div class="small-12    large-12  columns">
        <form  data-abide  action="<?php echo ''; ?>" method="post"   name="booking" id="booking">
            <fieldset> 
                <legend><?php echo $tax_lg['guest_details']; ?></legend>
                <h5> <?php echo $tax_lg['your_privacy_is_guaranteed']; ?></h5>
               
                
                
                
                <div class="row">
                    <div class=" small-12 large-6 columns">
   
                <p>
                    <label><?php echo $tax_lg['first_name']; ?>: <small>required</small>
                        <input name="preno_nome" type="text" id="preno_nome" required  />
                    </label>
                    <small class="error"><?php echo $tax_lg['first_name']; ?> is required </small>
                </p>
               
                    </div>  
                    
                    <div class="small-12 large-6 columns">
                            <p>
                    <label><?php echo $tax_lg['last_name']; ?>: <small>required</small>
                        <input name="preno_cogno" type="text" id="preno_cogno" required  />
                    </label>
                    <small class="error"><?php echo $tax_lg['last_name']; ?> is required </small>
                </p>                   
                        
                    </div>  
                </div>
                
                
                
                
                
                                
                <div class="row">
                    <div class=" small-12 large-6 columns">
   
              
                <p>
                    <label><?php echo $tax_lg['e-mail']; ?>: <small>required</small>
                        <input name="preno_email"  type="email" class="email_jquery"  id="preno_email" required />
                    </label>
                    <small class="error"><?php echo $tax_lg['e-mail']; ?> address is required.</small>
                </p>
               
                    </div>  
                    
                    <div class="small-12 large-6 columns">
                              
                <p>
                    <label><?php echo $tax_lg['confirm_e-mail ']; ?>: <small>required</small>
                        <input name="o_email_conf" type="email" class="email_jquery"  id="o_email_conf" required data-equalto="preno_email" />
                    </label>
                    <small class="error"><?php echo $tax_lg['confirm_e-mail ']; ?> did not match</small>
                </p>      
                        
                    </div>  
                </div>
                
                
                
                
                
                                   
                <div class="row">
                    <div class=" small-12 large-6 columns"
   
               <p>
                    <label><?php echo $tax_lg['city']; ?>: <small>required</small>
                        <input name="preno_city" type="text" id="preno_city"  required "/>
                    </label>
                    <small class="error"><?php echo $tax_lg['city']; ?> is required </small>
                </p>
                
               
                    </div>  
                    
                    <div class="small-12 large-6 columns">
                              
                   <p>
                    <label><?php echo $tax_lg['country']; ?>: <small>required</small>
                        <select name="preno_country" id="preno_country"  required="" data-invalid="" > 
                            <option value="">Select Country</option>
                            <option style="font-weight: bold" value="Australia" phone-code="61"> Australia</option>
                            <option style="font-weight: bold" value="Canada" phone-code="1"> Canada</option>
                            <option style="font-weight: bold" value="France" phone-code="33"> France</option>
                            <option style="font-weight: bold" value="Germany" phone-code="49"> Germany</option>
                            <option style="font-weight: bold" value="Ireland" phone-code="353"> Ireland</option>
                            <option style="font-weight: bold" value="Italy" phone-code="39"> Italy</option>
                            <option style="font-weight: bold" value="Spain" phone-code="34"> Spain</option>
                            <option style="font-weight: bold" value="Switzerland" phone-code="41"> Switzerland</option>
                            <option style="font-weight: bold" value="USA" phone-code="phone-code"> USA</option>
                            <option style="font-weight: bold" value="United Kingdom" phone-code="44"> United Kingdom</option>
                        </select>
                    </label>
                    <small class="error"><?php echo $tax_lg['country']; ?>is required </small>
                </p>
                        
                    </div>  
                </div>
                
                
                
                
              
               
                
                
                <div class="row">
                    <div class="small-4 large-4 columns">
                        <p>
                            <label><?php echo $tax_lg['international_code']; ?> <small>required</small>
                                <input name="tel_stato" type="text"  placeholder="+99"  pattern="number" required />
                            </label>
                            <small class="error"><?php echo $tax_lg['international_code']; ?> is required </small>
                        </p>
                    </div>
                    <div class="small-4 large-4 columns">
                        <p>
                            <label><?php echo $tax_lg['domestic_code']; ?><small>required</small>
                                <input name="tel_prefisso" type="text" placeholder="09"   pattern="number" required  />
                            </label>
                            <small class="error"><?php echo $tax_lg['domestic_code']; ?> is required </small>
                        </p>
                    </div>
                    <div class="small-4 large-4 columns">
                        <p>
                            <label><?php echo $tax_lg['phone_number']; ?><small>required</small>
                                <input name="tel_nemero" type="text" id="tel_nemero" placeholder="999999999"  pattern="number" required  />
                            </label>
                            <small class="error"><?php echo $tax_lg['phone_number']; ?> is required </small>        </p>
                    </div>
                </div>
 
                <p>

            </fieldset>
            
            
            <fieldset>
                <legend><?php echo $tax_lg['notes_for_the_property']; ?></legend>
                
                
                
                 <div class="row">
                    <div class="small-12 large-6 columns">
                        <p>

                    <label><?php echo $tax_lg['i_would_like_to_notify_my_arrival_time']; ?>
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
                    <label> <?php echo $tax_lg['newsletter']; ?>:
                        <input name="newsletter" type="checkbox" id="newsletter" value="1" checked="checked" />
                    </label>
                </p>
                       
                    </div>
                   
                </div>
                
                
                 <p>
                    <label><?php echo $tax_lg['special_requests']; ?>
                        <textarea name="preno_note" cols="60" rows="4" id="preno_note"></textarea>
                    </label>
                </p>
                
                
              
            </fieldset>
            <fieldset>
                <legend><?php echo $tax_lg['cancellation_policy']; ?></legend>
                <h4>  <?php echo $tax_lg['cancellation_without_penalty_until']; ?>
                    <?php // echo @date("D M j Y", strtotime(sottrazione_gg($preno_dal, $giorni_cancallazione))); ?>
                </h4> 
            </fieldset>
            <fieldset>
                <legend><?php echo $tax_lg['credit_card']; ?></legend>
                <h4><?php echo $tax_lg['no_pre-payment']; ?></h4>
                <p>
                    <label> <?php echo $tax_lg['type_of_credit_card']; ?>: <small>required</small>
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
                    <small class="error"><?php echo $tax_lg['type_of_credit_card']; ?> is required </small>
                </p>
                <p>
                    <label><?php echo $tax_lg['number']; ?>: <small>required</small>
                        <input name="preno_cc_n" type="text" id="preno_cc_n" pattern="card" required  />
                    </label>
                    <small class="error"> <?php echo $tax_lg['number']; ?> is required and must be a number</small>
                </p>
                <p>
                    <label><?php echo $tax_lg['Holder']; ?>: <small>required</small>
                        <input name="preno_cc_holder" type="text" id="preno_cc_holder" required  />
                    </label>
                    <small class="error"><?php echo $tax_lg['Holder']; ?> is required.</small>
                </p>
                <p>
                    <label><?php echo $tax_lg['expiry_date']; ?>: <small>required</small>
                        <input name="preno_cc_scad" type="text" id="preno_cc_scad"  required   />
                    </label>
                    <small class="error"><?php echo $tax_lg['expiry_date']; ?> is required </small></p>
            </fieldset>
            
            <input name="submit_booking" class="button  expand round success" type="submit" value="<?php echo $tax_lg['confirm_booking']; ?>">
          
            <h5> <?php echo $tax_lg['you_receive_e-mail']; ?> </h5>
           
            
  
            
            
        </form>
    </div>
</div>