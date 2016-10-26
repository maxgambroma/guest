<section  class="hero-content" ><!--  --> 
  <div class="row">
    <div class="large-10 columns about-content">
        <div class="contenuto">
            <p><?php $this->load->view($temp['contenuto']); ?></p>
        </div> 
    </div>
     <div class="large-2 columns">
         
       <?php $this->load->view('sections/sidebar_admin'); ?>  
    </div>
  </div>
</section>