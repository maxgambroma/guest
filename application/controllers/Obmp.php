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
         $this->load->model('prezzi_disponibilita_model');
         $this->load->model('tex_lingue_model');
         
         
         
         
         
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->library('email');
         $this->load->library('my_tools');
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

$data['lg'] = $lg = $this->lg;
// richimo i dati del db
$data['tax_lg'] =   $tax_row =   $this->tex_lingue_model->tex_lg($lg);
  
        

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        
        
        
        
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

        
        
        $preno_dal = $today ;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1 ;
        
        if($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')){
            
        $preno_dal = $this->input->get_post('preno_dal');   
        $preno_al   = $this->input->get_post('preno_al') ;
   
        $Q1 =  $this->input->get_post('Q1') ;
        
        }
        
       
        
        
        
        $data['preno_dal'] =  $preno_dal;
        $data['preno_al'] =  $preno_al;
         $data['Q1'] =  $Q1;
        
        $data['night']  = $this->my_tools->data_diff($preno_al, $preno_dal);
        
        
        $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);

        
        $stato = 1 ; // camera attive
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id, $tipologia_id = NULL, $agenzia_id = 279, $lg , $stato ) ;
        
        
        $data['prezzi'] =  $this->prezzi_disponibilita_model->prezzo_web($hotel_id, $preno_dal, $preno_al, $includi_prezzi = 1) ;
        
        

        // scegli il templete
        $temi = 'tem_cb_obmp';
        // carica la vista del contenuto
        $vista = 'obmp';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1_obmp',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_obmp', $data);
                
                
                
	}



        
        
        
	public function availability()
	{
		
                
                
                
                 $data['lg'] = $lg =  $this->lg;
$data['tax_lg'] =   $tax_row =   $this->tex_lingue_model->tex_lg($lg);

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
        
        
        $preno_dal = $today ;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1 ;
        
        if($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')){
            
        $preno_dal = $this->input->get_post('preno_dal');   
        $preno_al   = $this->input->get_post('preno_al') ;
   
        $Q1 =  $this->input->get_post('Q1') ;
        
        }
              $data['preno_dal'] =  $preno_dal;
        $data['preno_al'] =  $preno_al;
         $data['Q1'] =  $Q1;
        
        
        

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        
        
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id ) ;

    //    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);


       $dati =  $this->input->post(); 
       
       
     // print_r($dati);
       
       
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
        $temi = 'tem_cb_obmp';
        // carica la vista del contenuto
        $vista = 'obmp_availability';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1_obmp',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_obmp', $data);
        
        
        
                
                
	}

        
        
          
	public function confirmation()
	{
		
                
                
                
                 $data['lg'] = $lg = $this->lg;
                 $data['tax_lg'] =   $tax_row =   $this->tex_lingue_model->tex_lg($lg);

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
        
        
        
        $preno_dal = $today ;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1 ;
        
        if($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')){
            
        $preno_dal = $this->input->get_post('preno_dal');   
        $preno_al   = $this->input->get_post('preno_al') ;
   
        $Q1 =  $this->input->get_post('Q1') ;
        
        }
              $data['preno_dal'] =  $preno_dal;
        $data['preno_al'] =  $preno_al;
         $data['Q1'] =  $Q1;
        

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id ) ;
        
        
    //    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);

    
        

        
        // scegli il templete
        $temi = 'tem_cb_obmp';
        // carica la vista del contenuto
        $vista = 'obmp_confirmation';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1_obmp',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_obmp', $data);
        
                
                
                
	}

        
        




	public function summary_select()
	{
		
   
                
      $data['lg'] = $lg = $this->lg;
      $data['tax_lg'] =   $tax_row =   $this->tex_lingue_model->tex_lg($lg);
      
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
     echo $num_cm . ' Camera ' .$camara_cm .  ' @ '. (float)$prezzo_cm * (float) $num_cm ;
}  else {
     echo '';
}

        }

	public function booking_select()
	{
		
   
                
      $data['lg'] = $lg = $this->lg;
      $data['tax_lg'] =   $tax_row =   $this->tex_lingue_model->tex_lg($lg);

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
         echo '<button class="room-select" type = "submit"  class="button small ">Book</button>' ;
}  else {
     echo 'Seleziona';


}


                  
                
                
	}
        
        }