<?php

//  Clienti.php             
class Pippo extends MY_Controller {

    function __construct() {
        parent::__construct();
//        $this->load->database();
//        $this->load->model('clienti_model');
//        $this->load->model('hotel_model');
//        $this->load->model('agenda_model');
//        $this->load->model('tipologia_camera_model');
//        $this->load->model('obmp_review_model');
//        $this->load->model('conti_model');
//        $this->load->library('form_validation');
//        $this->load->library('table');
//        $this->load->library('pagination');
//        $this->load->library('email');
//        $this->load->helper('form');
//        $this->load->helper('url');
//        $this->load->helper('security');
//        $this->load->helper('language');

// $idiom = $this->session->get_userdata('language');  


    
    
}



    public function index(){  
        
        
        print_r($_SESSION);
    }  
  
    public function miniscript(){  
        $this->example();  
        
          print_r($_SESSION);
        
        }  


}