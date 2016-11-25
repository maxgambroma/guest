<?php

//  Log_in.php             
class Log_in extends CI_Controller {

function __construct() {
parent::__construct();
$this->load->database();
$this->load->model('hotel_model');
// autentico ca clienti conto
$this->load->model('clienti_model');
// aurentico da obmp
$this->load->model('obmp_clienti_model');


$this->load->library('form_validation');
$this->load->library('table');
$this->load->library('pagination');
$this->load->library('email');

$this->load->helper('form');
$this->load->helper('url');
$this->load->helper('security');
$this->load->helper('language');
$this->load->library('session');
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


function index(){

$data = NULL;



$this->form_validation->set_rules('user', 'lang:user', 'required|trim|xss_clean|valid_email');			
$this->form_validation->set_rules('pass', 'lang:pass', 'required|trim|xss_clean');
$this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');





if ($this->form_validation->run() == FALSE) // validation hasn't been passed
{

$this->load->view('sections/head_html_guest'); 
// $this->load->view('sections/head_guest'); 
$this->load->view('log_in', $data);
$this->load->view('sections/footer_scripts'); 
// $this->output->enable_profiler(TRUE); 
}

 else {
     
         
     if($this->input->post('MM_login')== 1 ){
         
        $user = set_value('user');
         $pass = set_value('pass');
         
         $this->autentica($user, $pass);
     }
     
          
     if($this->input->post('MM_email')==1 ){
         
          $user = set_value('user');
          
         $this->richiedi_pass($pass) ;
     }
    
}



}


function autentica($user, $pass) {
        
       
    
        $cliente = $this->clienti_model->get_autentica($user, $pass);
// controllo tra i clienti conto
        if ($cliente) {
            $newdata = array(
                'clienti_id' => $cliente->clienti_id,
                'conto_id' => $cliente->conto_id,
                'clienti_cogno' => $cliente->clienti_cogno,
                'clienti_nome' => $cliente->clienti_nome,
                'hotel_id' => $cliente->hotel_id,
                'area' => '2'
            );
            $this->session->set_userdata($newdata);
            redirect(base_url() . 'index.php/clienti/index/', 'refresh');
        }

//Controllo tra i clenti obmp
        $cliente_obmp = $this->obmp_clienti_model->get_autentica($user, $pass);
        if ($cliente_obmp && !$cliente) {
            $newdata = array(
                'obm_cliente_id' => $cliente_obmp->obm_cliente_id,       
                'clienti_cogno' => $cliente_obmp->obm_cliente_last_name,
                'clienti_nome' => $cliente_obmp->obm_cliente_first_name,
                'area' => '1'
            );
            $this->session->set_userdata($newdata);
            redirect(base_url() . 'index.php/clienti/index/', 'refresh');
        }

// non ho trovto nulla non clente
        if (!$cliente && $cliente_obmp) {
            redirect(base_url() . 'index.php/log_in', 'refresh');
        }
    }
    
    
    
    
    
    function richiedi_pass($pass) {
        
        
        // controllo tra i clienti conto
        
        $cliente = $this->clienti_model->get_by_email($user);
        
        if ($cliente) {
    
            
            
                $this->email->from($albergo[0]->hotel_email);
                $this->email->to($user);
                $this->email->subject('Password');
                $this->email->set_mailtype('html');
// html
                $data['testo'] = 'tex';
                $body = $this->load->view('temp_email_hotel.php', $data, TRUE);
                $this->email->message($body);
                $this->email->send();
            
            
            
            
            
            
            redirect(base_url() . 'index.php/log_in?stato=1', 'refresh');
        }

//Controllo tra i clenti obmp
        $cliente_obmp = $this->obmp_clienti_model->get_by_email($user);
        if ($cliente_obmp && !$cliente) {
            
         
            
        
                $this->email->from($albergo[0]->hotel_email);
                $this->email->to($user);
                $this->email->subject('Password');
                $this->email->set_mailtype('html');
// html
                $data['testo'] = 'tex';
                $body = $this->load->view('temp_email_hotel.php', $data, TRUE);
                $this->email->message($body);
                $this->email->send();
            
            
            
            
        }

// non ho trovto nulla non clente
        if (!$cliente && $cliente_obmp) {
           redirect(base_url() . 'index.php/log_in?stato=0', 'refresh');
        }
        
        
        
        
        
    }

}
