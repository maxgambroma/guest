<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Obmp extends CI_Controller {
    
    
    
     function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('clienti_model');
        $this->load->model('hotel_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camera_model');
        $this->load->model('obmp_review_model');
         $this->load->model('conti_model');
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->helper('language');

        // $idiom = $this->session->get_userdata('language');  
        


        if ($this->input->get('lg')) {
            $this->lg = $lg = $this->input->get('lg');
        } else {
            $this->lg = $lg = 'en';
        }

        $lingue['en'] = 'english';
        $lingue['jp'] = 'english';
        $lingue['ru'] = 'english';
        $lingue['se'] = 'english';
        $lingue['fr'] = 'french';
        $lingue['de'] = 'german';
        $lingue['it'] = 'italian';
        $lingue['es'] = 'spanish';


        $this->idiom = $idiom = $lingue[$lg];
//        $this->idiom = $idiom = $this->uri->segment(5, 'english');
        $this->lang->load('form_validation_lang', $idiom);
        $this->lang->load('form_lang', $idiom);
    }



	public function index()
	{
		
                
                
                
                 $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

    //    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);


        // scegli il templete
        $temi = 'tem_full';
        // carica la vista del contenuto
        $vista = 'master_b';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_guest', $data);
                
                
                
	}



        
        
        
	public function availability()
	{
		
                
                
                
                 $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

    //    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);


       $dati =  $this->input->post(); 
       
       
      //  print_r($dati);
 $i = 1;
        foreach ($dati['num'] as $key => $value) {
           
            if ($value != 0) {
                if ($i < 7) {
                   ${'t'.$i} = $dati['cm_rooms_id'][$key];
                    ${'q'.$i} = $dati['num'][$key];
                    ${'p'.$i} = $dati['price'][$key];

                    $i++;
                }
            }
        }



        
        // scegli il templete
        $temi = 'tem_full';
        // carica la vista del contenuto
        $vista = 'master_b_availability';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_guest', $data);
                
                
                
	}

        
        
          
	public function confirmation()
	{
		
                
                
                
                 $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

    //    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);


        // scegli il templete
        $temi = 'tem_full';
        // carica la vista del contenuto
        $vista = 'master_b_confirmation';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_guest', $data);
                
                
                
	}

        
        




	public function summary_select()
	{
		
   
                
      $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

$num_cm = $this->input->get('num_cm');
$prezzo_cm = $this->input->get('prezzo_cm');
$camara_cm = $this->input->get('camara_cm');


if($num_cm){
     echo $num_cm . ' Camera ' .$camara_cm .  ' @ '. $prezzo_cm  ;
}  else {
     echo '';
}

        }

	public function booking_select()
	{
		
   
                
      $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

$num_cm = $this->input->get('num_cm');
$prezzo_cm = $this->input->get('prezzo_cm');
$camara_cm = $this->input->get('camara_cm');


if($num_cm){
         echo '<button type = "submit"  class="button small ">Book</button>' ;
}  else {
     echo 'Seleziona';


}


                  
                
                
	}
        
        }