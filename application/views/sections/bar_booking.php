<!--  myform_add.php  -->

<div class="box_booking">
    <fieldset>
        <!--    <legend>Myform:</legend>		-->
        <p><?php echo lang('booking_slogan'); ?>  
            </p>
        <?php
        // Change the css classes to suit your needs    
        $attributes = array('class' => '', 'id' => '');
        echo form_open( base_url().'index.php/obmp/?' . $_SERVER['QUERY_STRING'], $attributes);
        ?>   
        <p>
            <?php echo lang('property', 'hotel_id'); ?>        <?php echo form_error('hotel_id'); ?>
            <?php // Change the values in this array to populate your dropdown as required ?>
            <?php
            $options = array(
                '2' => 'Hotel Laurentia',
                '4' => 'Ateneo Garden Palace',
                '1' => 'Hotel La Pergola',
            );
            
        
            ?>
           
            <?php echo form_dropdown('hotel_id', $options, (!set_value('hotel_id')) ? $albergo[0]->hotel_id : set_value('hotel_id') ) ?>
        </p>                                             
        <p>
<?php echo lang('check_in', 'Check-in'); ?> 
<?php echo form_error('check_in'); ?>
            <input id="preno_dal_c" type="text" name="preno_dal" value="<?php echo set_value('preno_dal'); ?>"  />
        </p>
        <p>
<?php echo lang('check_out', 'Check-out'); ?> 
<?php echo form_error('check_out'); ?>
            <input id="preno_al_c" type="text" name="preno_al"   value="<?php echo set_value('preno_dal'); ?>"  />
        </p>
        <p>
<?php echo lang('numbers', 'Numbers'); ?> 
<?php echo form_error('numbers'); ?>    
            <select id="numbers" name="Q1" class="rooms_jquery"  >
                <option selected="selected" value="1">1</option>
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
        </p>
        <p>
        <?php echo form_submit('submit', lang('prenota'), 'class="button"'); ?>
        </p>
<?php echo form_close(); ?>
    </fieldset>
</div>
<script>
    $(function () {
// Dal
        $("#preno_dal_c").datepicker({
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
                $("#preno_al_c").datepicker("option", "minDate", selectedDate);
            }
        });
// Al
        $("#preno_al_c").datepicker({
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

