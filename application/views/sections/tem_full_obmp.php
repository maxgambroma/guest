<div class="row" id="contenitore_b">
    <div class="small-12  medium-12  large-12 columns" id="col_principale" >
        <div><?php $this->load->view('sections/cercatore_obmp'); ?></div>      
        <div> <?php echo $table_evento; ?></div>
        <div class="contenuto">
            <p><?php $this->load->view($temp['contenuto']); ?></p>
        </div> 
    </div>
</div>

