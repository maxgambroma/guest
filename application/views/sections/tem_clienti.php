<section class="hero-content">
    <div class="row">
<!--    contenuto-->
        <div class="small-12 large-7  large-push-2 columns about-content">
            <div class="contenuto">
                <p><?php $this->load->view($temp['contenuto']); ?></p>
            </div> 
        </div>
<!--    barra-->
        <div class="small-12 large-2 large-pull-7  columns">
            <?php $this->load->view('sections/' . $temp['bar_1']); ?>  
        </div>  
<!--    preno-->
        <div class="small-12  large-3   columns">
            <?php $this->load->view('sections/' . $temp['bar_2']); ?>  
        </div>  
    </div>
</section>


