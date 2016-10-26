<?php // Change the css classes to suit your needs    

$attributes = array('class' => '', 'id' => '');
echo form_open('Adebbiti', $attributes); ?>

<p>
        <label for="adebito_id">adebito_id</label>
        <?php echo form_error('adebito_id'); ?>
        <br /><input id="adebito_id" type="text" name="adebito_id"  value="<?php echo set_value('adebito_id'); ?>"  />
</p>

<p>
        <label for="conto_id">conto_id</label>
        <?php echo form_error('conto_id'); ?>
        <br /><input id="conto_id" type="text" name="conto_id"  value="<?php echo set_value('conto_id'); ?>"  />
</p>

<p>
        <label for="hotel_id">hotel_id</label>
        <?php echo form_error('hotel_id'); ?>
        <br /><input id="hotel_id" type="text" name="hotel_id"  value="<?php echo set_value('hotel_id'); ?>"  />
</p>

<p>
        <label for="prodotto_id">prodotto_id</label>
        <?php echo form_error('prodotto_id'); ?>
        <br /><input id="prodotto_id" type="text" name="prodotto_id"  value="<?php echo set_value('prodotto_id'); ?>"  />
</p>

<p>
        <label for="descrizione">descrizione</label>
        <?php echo form_error('descrizione'); ?>
        <br /><input id="descrizione" type="text" name="descrizione"  value="<?php echo set_value('descrizione'); ?>"  />
</p>

<p>
        <label for="prezzo">prezzo</label>
        <?php echo form_error('prezzo'); ?>
        <br /><input id="prezzo" type="text" name="prezzo"  value="<?php echo set_value('prezzo'); ?>"  />
</p>

<p>
        <label for="quantita">quantita</label>
        <?php echo form_error('quantita'); ?>
        <br /><input id="quantita" type="text" name="quantita"  value="<?php echo set_value('quantita'); ?>"  />
</p>

<p>
        <label for="adebiti_data_record">adebiti_data_record</label>
        <?php echo form_error('adebiti_data_record'); ?>
        <br /><input id="adebiti_data_record" type="text" name="adebiti_data_record"  value="<?php echo set_value('adebiti_data_record'); ?>"  />
</p>

<p>
        <label for="adebiti_utente_id">adebiti_utente_id</label>
        <?php echo form_error('adebiti_utente_id'); ?>
        <br /><input id="adebiti_utente_id" type="text" name="adebiti_utente_id"  value="<?php echo set_value('adebiti_utente_id'); ?>"  />
</p>


<p>
        <?php echo form_submit( 'submit', 'Submit'); ?>
</p>

<?php echo form_close(); ?>
