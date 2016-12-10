
<p> </p>

<div id="login">
    

<div class="row">
    <div class="medium-6 medium-centered large-6 large-centered columns">
    
        
        
	<?php // Change the css classes to suit your needs    
	$attributes = array('class' => '', 'id' => '');	           
        echo form_open( uri_string() . '?'. $_SERVER['QUERY_STRING'], $attributes); ?>   
        
            <div class="row column log-in-form">
                <h4 class="text-center">Log in with you email account</h4>
                
                <?php if($this->input->get('stato')>0) {
                echo '<h4>Retrieve your password Your account access information has been sent to your email address</h4>' ;
                 } ?>
                
 
                
                <p>
         <?php echo lang('user', 'user'); ?> <span class="required">*</span>
        <?php echo form_error('user'); ?>
       <input id="user" type="text" name="user"   placeholder="somebody@example.com"  value="<?php echo set_value('user'); ?>"  />
</p>

<p>
         <?php echo lang('pass', 'pass'); ?> <span class="required">*</span>
        <?php echo form_error('pass'); ?>
       <input id="pass" type="text" name="pass"  placeholder="Password" value="<?php echo set_value('pass'); ?>"  />
</p>

<input type="hidden" name="MM_login" value="1" />
                
                
                
   <label>
                      <input type="submit"  value="Insert Record" class="button" name="" />
                    </label> 
                
                
                
                
                
                
                
                <!--        <input id="show-password" type="checkbox"><label for="show-password">Show password</label>-->
                               
                   
                
                
                
<!-- testo variabile  -->
<p>After login on Laurentia you will be able to:
</p>
<p> View and cancel your reservations <br />
You can view the details and the status or cancel your reservations;
</p>  
<p>View and modify your personal data <br />
You can view and modify your registered details;
</p>
<p>Insert your feedbacks regarding the properties you have booked <br />
Every time you book a property using our system, we will ask you to fill in a questionnaire to get your feedback regarding your stay.
</p>
<!-- testo variabile  -->
          
                      <div id="richiedi_pass" >
                    <p class="text-center"><a href="#">Forgot your password?</a></p>
                </div>   
                
            </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>

<div id="password_ricevi" style="display: none;" >
    


<div class="row">
    <div class="medium-6 medium-centered large-6 large-centered columns">
        <form>
            <div class="row column log-in-form">
                <h4>Retrieve your password </h4> 
                <p> If you have forgotten your password, insert your exact email address in the form below.</p>
                <p>
   
<p>
<?php echo lang('user', 'user'); ?> <span class="required">*</span>
<?php echo form_error('user'); ?>
<input id="user" type="text" name="user"   placeholder="somebody@example.com"  value="<?php echo set_value('user'); ?>"  />
</p>
                    
                    
                        <input name="ric_pass" id="ric_pass" type="hidden">
                                          
                </p> 
                <p>
                    <label>
                      <input type="submit"  value="Insert Record" class="button" name="" />
                    </label> 
                </p> 
                <div id="new_log"  > <a href="#">Go back to login page</a>  </div> 
            </div>
            
            <input type="hidden" name="MM_pass" value="1" />
            
        </form>
    </div>
</div>

</div>


<script>
// apri password_ricevi           
$("#richiedi_pass").click(function () {
$("#password_ricevi").toggle("slow");
});
// chiudi login
$("#richiedi_pass").click(function () {
$("#login").toggle("slow");
});

//----------------

// Chiudi password_ricevi               
$("#new_log").click(function () {
$("#password_ricevi").toggle("slow");
});
//  Apri 
$("#new_log").click(function () {
$("#login").toggle("slow");
});

</script>


