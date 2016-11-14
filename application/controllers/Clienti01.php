<?php

//  Clienti.php             
class Clienti extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('clienti_model');
        $this->load->model('hotel_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camera_model');
        $this->load->model('obmp_review_model');
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

    public function index() {


        $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;



        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);

        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);    

        
        $data['punti'] =  $this->clienti_model->clienti_punti($clienti_id); 
         
        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'clienti_index';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);
    }

    /**
     * Elenco i clienti che non hanno firmato la privacy
     */
    public function privacy() {

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

        $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);


// scegli il templete
        $temi = 'tem_full';
// carica la vista del contenuto
        $vista = 'clienti_privacy_list';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes_guest', $data);
    }

    /**
     * edit data in to clienti
     */
    function edit_privacy() {

        $data['lg'] = $this->lg;
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
        $data['albergo'] = $albergo = $this->hotel_model->hotel($hotel_id);

        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);

//old
//$data['rs_clienti'] =  $cliente =  $this->clienti_model->find_by_id($clienti_id);

        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);


        $this->form_validation->set_rules('clienti_id', 'lang:clienti_id', 'trim');
        $this->form_validation->set_rules('clienti_email', 'lang:clienti_email', 'required|trim');
        $this->form_validation->set_rules('privacy', 'lang:privacy', 'required|trim');
        $this->form_validation->set_rules('marketing', 'lang:marketing', 'trim');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');


        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed          
// scegli il templete
            $temi = 'tem_full';
// carica la vista del contenuto
            $vista = 'clienti_privacy_edit';
// gestore templete

            $data['temp'] = array
                ('templete' => $temi,
                'contenuto' => $vista,
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top');
            $this->load->view('templetes_guest', $data);

//$this->load->view('clienti_edit');
        } else { // passed validation proceed to post success logic
// build array for the model
            $form_data = array(
                'clienti_id' => set_value('clienti_id'),
                'clienti_email' => set_value('clienti_email'),
                'privacy' => set_value('privacy'),
                'marketing' => set_value('marketing')
            );

// run insert model to write data to db

            if ($this->clienti_model->update($clienti_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db
// redirect('clienti/edit_privacy/?' . $_SERVER['QUERY_STRING']);
                $this->email->from($albergo[0]->hotel_email);
                $this->email->to(set_value('clienti_email'));
                $this->email->subject('Privacy');
                $this->email->set_mailtype('html');
// html
                $data['testo'] = "<h5>" . $this->lang->line('tak_privacy') . "</h5>" . "<br>" . $this->lang->line('lex_privacy') . "<br>" . $cliente[0]->clienti_nome . ' ' . $cliente[0]->clienti_cogno;
                $body = $this->load->view('temp_email_hotel.php', $data, TRUE);
                $this->email->message($body);
                $this->email->send();
//echo $body ;
// scegli il templete
                $temi = 'tem_full';
// carica la vista del contenuto
                $vista = 'clienti_privacy_thk';
// gestore templete


                $data['temp'] = array
                    ('templete' => $temi,
                    'contenuto' => $vista,
                    'bar_1' => 'bar_1',
                    'bar_2' => 'bar_2',
                    'box_top' => 'box_top');
                $this->load->view('templetes_guest', $data);
            } else {
                redirect('clienti/privacy?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }




    function email() {
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


        $this->email->from('info@hotellaurentia.com');
        $this->email->to('maxgamb.roma@gmail.com');
        $this->email->subject('Test email from CI and Gmail');
// $this->email->message(' <h1>Hello </h1> We are <strong>Example Inc.</strong>  This is a test. maxgamb.roma@gmail.com');
        $this->email->set_mailtype('html');
// html
        $data['testo'] = "<h5>" . $this->lang->line('tak_privacy') . "</h5>" . "<br>" . $this->lang->line('lex_privacy');
        ;
        $body = $this->load->view('temp_email_hotel.php', $data, TRUE);
        $this->email->message($body);


        if (!$this->email->send()) {
            echo $this->email->print_debugger();
        } else {
            echo $body;
        }
    }

    /**
     * elenca le prenotazioni del clienti_id
     */
    function bookings() {


        $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);

        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;

            $email = $cliente[0]->clienti_email;
//trovo i vecchi conti
            $data['conti_old'] = $conti_old = $this->clienti_model->conti_by_clienti($clienti_id);
// trovo le nuove preno
            $data['preno'] = $preno = $this->agenda_model->get_booking_by_email($email);
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);


// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'clienti_bookings';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);
    }

    /**
     * restituisce i dettagli della prentoazine e se foture le amminista
     */
    function bookings_edit() {


        $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);

        $preno_id = $this->uri->segment(5, 1);

        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;

            $email = $cliente[0]->clienti_email;
//trovo i vecchi conti
            $data['conti_old'] = $conti_old = $this->clienti_model->conti_by_clienti($clienti_id);
// trovo le nuove preno
            $data['preno'] = $preno = $this->agenda_model->booking_id_email($preno_id, $email);
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);


// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'clienti_bookings_edit';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);
    }

    /**
     * elenca tutti i rewiev del cliente
     */
    function review() {

        $data['lg'] = $this->lg;
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);

        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

        $data['reviews'] = $reviews = $this->obmp_review_model->review_cliente_id($clienti_id);

//         print_r($reviews);
// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'review_clienti';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);
    }
    
    
    

    function impostazioni() {
        $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);



      //  $this->form_validation->set_rules('clienti_id', 'lang:clienti_id', 'required|trim');
      //  $this->form_validation->set_rules('clienti_nome', 'lang:clienti_nome', 'trim');
      //  $this->form_validation->set_rules('clienti_cogno', 'lang:clienti_cogno', 'trim');
      //  $this->form_validation->set_rules('cliente_nato_a', 'lang:cliente_nato_a', 'trim');
      //  $this->form_validation->set_rules('cliente_nato_il', 'lang:cliente_nato_il', 'trim');
        $this->form_validation->set_rules('clienti_tel', 'lang:clienti_tel', 'trim');
        $this->form_validation->set_rules('clienti_fax', 'lang:clienti_fax', 'trim');
        $this->form_validation->set_rules('clienti_email', 'lang:clienti_email', 'trim');
        $this->form_validation->set_rules('password', 'lang:password', 'trim|xss_clean');		
        $this->form_validation->set_rules('clienti_note', 'lang:clienti_note', 'trim');
        $this->form_validation->set_rules('privacy', 'lang:privacy', 'trim');
        $this->form_validation->set_rules('marketing', 'lang:marketing', 'trim');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed

         
// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'clienti_impostazioni';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);

//$this->load->view('Clienti_edit');
        } else { // passed validation proceed to post success logic
// build array for the model

            $form_data = array(
              //  'clienti_id' => set_value('clienti_id'),
              //  'clienti_nome' => set_value('clienti_nome'),
              //  'clienti_cogno' => set_value('clienti_cogno'),
              //  'cliente_nato_a' => set_value('cliente_nato_a'),
              //  'cliente_nato_il' => set_value('cliente_nato_il'),
                'clienti_tel' => set_value('clienti_tel'),
                'clienti_fax' => set_value('clienti_fax'),
                'clienti_email' => set_value('clienti_email'),
                'password' => set_value('password'),
                'clienti_note' => set_value('clienti_note'),
                'privacy' => set_value('privacy'),
                'marketing' => set_value('marketing')
            );

// run insert model to write data to db

            $clienti_id = $cliente[0]->clienti_id;


               
        	if ($this->clienti_model->update($clienti_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db  
                {
                
                
                redirect('clienti/index/'.$conto_id.'/'.$clienti_id.'/?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('clienti/index/'.$conto_id.'/'.$clienti_id.'/?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }

    
    
    
    
    
    
    
    function imp_privacy() {
        $data['lg'] = $this->lg;

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);



      //  $this->form_validation->set_rules('clienti_id', 'lang:clienti_id', 'required|trim');
      //  $this->form_validation->set_rules('clienti_nome', 'lang:clienti_nome', 'trim');
      //  $this->form_validation->set_rules('clienti_cogno', 'lang:clienti_cogno', 'trim');
      //  $this->form_validation->set_rules('cliente_nato_a', 'lang:cliente_nato_a', 'trim');
      //  $this->form_validation->set_rules('cliente_nato_il', 'lang:cliente_nato_il', 'trim');
      //  $this->form_validation->set_rules('clienti_tel', 'lang:clienti_tel', 'trim');
      //  $this->form_validation->set_rules('clienti_fax', 'lang:clienti_fax', 'trim');
      //  $this->form_validation->set_rules('clienti_email', 'lang:clienti_email', 'trim');
      //  $this->form_validation->set_rules('clienti_note', 'lang:clienti_note', 'trim');
      //  $this->form_validation->set_rules('privacy', 'lang:privacy', 'trim');
        $this->form_validation->set_rules('marketing', 'lang:marketing', 'trim');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed

         
// scegli il templete
        $temi = 'tem_clienti';
// carica la vista del contenuto
        $vista = 'clienti_privacy_utente';
// gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);

//$this->load->view('Clienti_edit');
        } else { // passed validation proceed to post success logic
// build array for the model

            $form_data = array(
              //  'clienti_id' => set_value('clienti_id'),
              //  'clienti_nome' => set_value('clienti_nome'),
              //  'clienti_cogno' => set_value('clienti_cogno'),
              //  'cliente_nato_a' => set_value('cliente_nato_a'),
              //  'cliente_nato_il' => set_value('cliente_nato_il'),
              //  'clienti_tel' => set_value('clienti_tel'),
              //  'clienti_fax' => set_value('clienti_fax'),
              //  'clienti_email' => set_value('clienti_email'),
              //  'clienti_note' => set_value('clienti_note'),
              //  'privacy' => set_value('privacy'),
                'marketing' => set_value('marketing')
            );

// run insert model to write data to db

            $clienti_id = $cliente[0]->clienti_id;


               
        	if ($this->clienti_model->update($clienti_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db  
                {
                
                
                redirect('clienti/index/'.$conto_id.'/'.$clienti_id.'/?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('clienti/index/'.$conto_id.'/'.$clienti_id.'/?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }

    
    
    
    
    
    
    
    
}

?>
