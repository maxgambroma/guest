<?php

//  Obmp_review.php             
class Obmp_review extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('obmp_review_model');
        $this->load->model('clienti_model');
        $this->load->model('hotel_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camera_model');
        
        
        
        
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->library('pagination');
         $this->load->library('my_tools');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('language');
       // $idiom = $this->session->get_userdata('language');  
        $this->load->model('hotel_model');
       
        
       if ( $this->input->get('lg') ) {
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

    /** list of obmp_review
     * pagination
     */
    public function index() {


        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $date['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;


        $limit = 15;
        $this->cont_record = $this->obmp_review_model->record_count();

        $config['base_url'] = base_url() . 'index.php/obmp_review';
        $config['total_rows'] = $this->cont_record;
        $config['per_page'] = $limit;  // limit
        $config['page_query_string'] = TRUE;
        $config['full_tag_open'] = '<div id="pagination" class="pagination">';
        $config['full_tag_close'] = '</div>';
        $pagination = $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        if ($this->input->get('per_page')) {
            $offset = $this->input->get('per_page');
        } else {
            $offset = 0;
        }

        $data['rs_obmp_review'] = $this->obmp_review_model->find_limit($limit, $offset);

        // scegli il templete
        $temi = 'tem_full';
        // carica la vista del contenuto
        $vista = 'welcome_message';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_1',
            'bar_2' => 'bar_2',
            'box_top' => 'box_top');
        $this->load->view('templetes', $data);

        //$this->load->view('obmp_review_list.php');    
    }

    /**
     * inser data in to obmp_review
     */
    function insert() {
        
         $date['today'] = $today = date('Y-m-d');
        // $product_id = $this->uri->segment(3, 0);
//         $hotel_id = $this->uri->segment(3, 2 );
         $conto_id = $this->uri->segment(3, 0 );
         $clienti_id = $this->uri->segment(4, 1 );   
 

        // get Dati camara cliente da $conto_id
        $data['cliente'] = $cliente = $this->obmp_review_model->get_cliente_rew($conto_id, $clienti_id) ;
       // print_r( $data['cliente']); 
       
       
       //print_r($cliente_data)  ;
       
       if ($cliente) {
            $hotel_id = $cliente->hotel_id;
        } else {

            $hotel_id = 1;
        }
        $data['hotel_id'] = $hotel_id;

        
        
        if ( $cliente) {
            $conto_id = $cliente->conto_id;
        } else {

            $conto_id = 0;
        }

        $data['lg'] = $this->lg ; 

        // get review by conto_id
        $data['review'] = $this->obmp_review_model->review_area_id($conto_id);

        // media delle recnzioni hotel
        $data['review_avg'] = $this->obmp_review_model->review_avg($hotel_id );
    //  print_r( $data['review']); 

        $data['albergo'] = $this->hotel_model->hotel($hotel_id) ;

//        
//        print_r($date['albergo']) ;
//        
       // $this->form_validation->set_rules('review_id', 'lang:review_id', 'trim');
        $this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim');
        $this->form_validation->set_rules('preno_id', 'lang:preno_id', 'required|trim');
        $this->form_validation->set_rules('conto_id', 'lang:conto_id', 'required|trim');
        $this->form_validation->set_rules('postazione_id', 'lang:postazione_id', 'trim');
        $this->form_validation->set_rules('camera_numero', 'lang:camera_numero', 'required|trim');
        $this->form_validation->set_rules('nome', 'lang:nome', 'required|trim');
        $this->form_validation->set_rules('stato', 'lang:stato', 'required|trim');
        $this->form_validation->set_rules('user_type', 'lang:user_type', 'required|trim');
        $this->form_validation->set_rules('pulizia_camera', 'lang:pulizia_camera', 'required|trim');
        $this->form_validation->set_rules('accoglienza', 'lang:accoglienza', 'required|trim');
        $this->form_validation->set_rules('rumore_camere', 'lang:rumore_camere', 'required|trim');
        $this->form_validation->set_rules('spazio_camera', 'lang:spazio_camera', 'required|trim');
        $this->form_validation->set_rules('spazi_comuni', 'lang:spazi_comuni', 'required|trim');
        $this->form_validation->set_rules('competenza_impiegati', 'lang:competenza_impiegati', 'required|trim');
        $this->form_validation->set_rules('qualita_servizi', 'lang:qualita_servizi', 'required|trim');
        $this->form_validation->set_rules('dintorni', 'lang:dintorni', 'required|trim');
        $this->form_validation->set_rules('colazione', 'lang:colazione', 'required|trim');
        $this->form_validation->set_rules('tariffa', 'lang:tariffa', 'required|trim');
        $this->form_validation->set_rules('servizi_offerti', 'lang:servizi_offerti', 'required|trim');
        $this->form_validation->set_rules('foto', 'lang:foto', 'required|trim');
        $this->form_validation->set_rules('indicazione_mappa', 'lang:indicazione_mappa', 'required|trim');
        $this->form_validation->set_rules('giudizio_totale', 'lang:giudizio_totale', 'required|trim');
        $this->form_validation->set_rules('prezzo_qualita', 'lang:prezzo_qualita', 'required|trim');
        $this->form_validation->set_rules('commento_tex', 'lang:commento_tex', 'trim');
        $this->form_validation->set_rules('raccomandi', 'lang:raccomandi', 'required|trim');
        $this->form_validation->set_rules('ip_review', 'lang:ip_review', 'trim');
        $this->form_validation->set_rules('data_review', 'lang:data_review', 'trim');
       // $this->form_validation->set_rules('review_data_record', 'lang:review_data_record', 'trim');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            
            // scegli il templete
            $temi = 'tem_full';
            // carica la vista del contenuto
            $vista = 'obmp_review_add';
            // gestore templete

            $data['temp'] = array
                ('templete' => $temi,
                'contenuto' => $vista,
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top');
            $this->load->view('templetes_guest', $data);

            //$this->load->view('obmp_review_add');
        } else { // passed validation proceed to post success logic
            // build array for the model

            $form_data = array(
               // 'review_id' => set_value('review_id'),
                'hotel_id' => set_value('hotel_id'),
                'preno_id' => set_value('preno_id'),
                'conto_id' => set_value('conto_id'),
                'postazione_id' => set_value('postazione_id'),
                'camera_numero' => set_value('camera_numero'),
                'nome' => set_value('nome'),
                'stato' => set_value('stato'),
                'user_type' => set_value('user_type'),
                'pulizia_camera' => set_value('pulizia_camera'),
                'accoglienza' => set_value('accoglienza'),
                'rumore_camere' => set_value('rumore_camere'),
                'spazio_camera' => set_value('spazio_camera'),
                'spazi_comuni' => set_value('spazi_comuni'),
                'competenza_impiegati' => set_value('competenza_impiegati'),
                'qualita_servizi' => set_value('qualita_servizi'),
                'dintorni' => set_value('dintorni'),
                'colazione' => set_value('colazione'),
                'tariffa' => set_value('tariffa'),
                'servizi_offerti' => set_value('servizi_offerti'),
                'foto' => set_value('foto'),
                'indicazione_mappa' => set_value('indicazione_mappa'),
                'giudizio_totale' => set_value('giudizio_totale'),
                'prezzo_qualita' => set_value('prezzo_qualita'),
                'commento_tex' => set_value('commento_tex'),
                'raccomandi' => set_value('raccomandi'),
                'ip_review' => set_value('ip_review'),
                'data_review' => set_value('data_review'),
               // 'review_data_record' => set_value('review_data_record')
            );

            // run insert model to write data to db

            if ($this->obmp_review_model->insert($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect( uri_string() . '?'. $_SERVER['QUERY_STRING'] );   // or whatever logic needs to occur
            } else {

                redirect( uri_string() . '?'. $_SERVER['QUERY_STRING']  );
            }
        }
    }

    /**
     * edit data in to obmp_review
     */
    function edit() {
        
                 $data['lg'] = $this->lg;

        
        $today = date('Y-m-d');
        
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $date['today'] = $today = date('Y-m-d');
       
                      
          $conto_id = $this->uri->segment(3, 1 );
          $clienti_id = $this->uri->segment(4, 1 );  
     
       $data['rs_clienti'] =  $cliente =  $this->clienti_model->get_conto_cliente($conto_id, $clienti_id );
       
            
       if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;

            $email = $cliente[0]->clienti_email;
            //trovo i vecchi conti
            $data['conti_old'] = $conti_old = $this->clienti_model->conti_by_clienti($clienti_id);
            // trovo le nuove preno
            $data['preno'] = $preno = $this->agenda_model->get_booking_by_email($email);
            
             $data['hotel_id'] = $hotel_id;
            
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        $data['cicco'] = $review =  $this->obmp_review_model->review_area_id($conto_id);
             
           $review_id = $review->review_id;
           $data['rs_obmp_review'] = $this->obmp_review_model->find_by_id($review_id);


      //  $this->form_validation->set_rules('review_id', 'review_id', 'trim');
      //  $this->form_validation->set_rules('hotel_id', 'hotel_id', 'required|trim');
      //  $this->form_validation->set_rules('preno_id', 'preno_id', 'required|trim');
      //  $this->form_validation->set_rules('conto_id', 'conto_id', 'required|trim');
      //  $this->form_validation->set_rules('postazione_id', 'postazione_id', 'required|trim');
      //  $this->form_validation->set_rules('camera_numero', 'camera_numero', 'required|trim');
      //  $this->form_validation->set_rules('nome', 'nome', 'required|trim');
      //  $this->form_validation->set_rules('stato', 'stato', 'required|trim');
        $this->form_validation->set_rules('user_type', 'user_type', 'required|trim');
        $this->form_validation->set_rules('pulizia_camera', 'pulizia_camera', 'required|trim');
        $this->form_validation->set_rules('accoglienza', 'accoglienza', 'required|trim');
        $this->form_validation->set_rules('rumore_camere', 'rumore_camere', 'required|trim');
        $this->form_validation->set_rules('spazio_camera', 'spazio_camera', 'required|trim');
        $this->form_validation->set_rules('spazi_comuni', 'spazi_comuni', 'required|trim');
        $this->form_validation->set_rules('competenza_impiegati', 'competenza_impiegati', 'required|trim');
        $this->form_validation->set_rules('qualita_servizi', 'qualita_servizi', 'required|trim');
        $this->form_validation->set_rules('dintorni', 'dintorni', 'required|trim');
        $this->form_validation->set_rules('colazione', 'colazione', 'required|trim');
        $this->form_validation->set_rules('tariffa', 'tariffa', 'required|trim');
        $this->form_validation->set_rules('servizi_offerti', 'servizi_offerti', 'required|trim');
        $this->form_validation->set_rules('foto', 'foto', 'required|trim');
        $this->form_validation->set_rules('indicazione_mappa', 'indicazione_mappa', 'required|trim');
        $this->form_validation->set_rules('giudizio_totale', 'giudizio_totale', 'required|trim');
        $this->form_validation->set_rules('prezzo_qualita', 'prezzo_qualita', 'required|trim');
        $this->form_validation->set_rules('commento_tex', 'commento_tex', 'required|trim');
        $this->form_validation->set_rules('raccomandi', 'raccomandi', 'required|trim');
        $this->form_validation->set_rules('ip_review', 'ip_review', 'trim');
     //   $this->form_validation->set_rules('data_review', 'data_review', 'trim');
    //    $this->form_validation->set_rules('review_data_record', 'review_data_record', 'trim');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed

            /** function find_by_id('review_id')
             * find preno_id
             * @param $form_data - array
             * @return object
             */
                
            
        // scegli il templete
        $temi = 'tem_clienti';
        // carica la vista del contenuto
        $vista = 'obmp_review_edit';
        // gestore templete
        $data['temp'] = array
            ('templete' => $temi,
            'contenuto' => $vista,
            'bar_1' => 'bar_clienti',
            'bar_2' => 'bar_booking',
            'box_top' => 'box_top');
        $this->load->view('templetes_clienti', $data);
            
            
            
            
            
            

            //$this->load->view('obmp_review_edit');
        } else { // passed validation proceed to post success logic
            // build array for the model

            $form_data = array(
               // 'review_id' => set_value('review_id'),
               // 'hotel_id' => set_value('hotel_id'),
               // 'preno_id' => set_value('preno_id'),
               // 'conto_id' => set_value('conto_id'),
               // 'postazione_id' => set_value('postazione_id'),
               // 'camera_numero' => set_value('camera_numero'),
               // 'nome' => set_value('nome'),
               // 'stato' => set_value('stato'),
                'user_type' => set_value('user_type'),
                'pulizia_camera' => set_value('pulizia_camera'),
                'accoglienza' => set_value('accoglienza'),
                'rumore_camere' => set_value('rumore_camere'),
                'spazio_camera' => set_value('spazio_camera'),
                'spazi_comuni' => set_value('spazi_comuni'),
                'competenza_impiegati' => set_value('competenza_impiegati'),
                'qualita_servizi' => set_value('qualita_servizi'),
                'dintorni' => set_value('dintorni'),
                'colazione' => set_value('colazione'),
                'tariffa' => set_value('tariffa'),
                'servizi_offerti' => set_value('servizi_offerti'),
                'foto' => set_value('foto'),
                'indicazione_mappa' => set_value('indicazione_mappa'),
                'giudizio_totale' => set_value('giudizio_totale'),
                'prezzo_qualita' => set_value('prezzo_qualita'),
                'commento_tex' => set_value('commento_tex'),
                'raccomandi' => set_value('raccomandi'),
                'ip_review' => set_value('ip_review'),
                //'data_review' => set_value('data_review'),
                //'review_data_record' => set_value('review_data_record')
                
            );
//
//            // run insert model to write data to db
//            
            if ($this->obmp_review_model->update($review_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db

                redirect( 'obmp_review/insert/'.$conto_id . '/'.$clienti_id .'?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('obmp_review/insert/'.$conto_id . '/'.$clienti_id .'?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }
    

    /**
     * delete record by to obmp_review
     */
//    function delete() {
//
//
//
//        $today = date('Y-m-d');
//        if ($this->input->get('hotel_id')) {
//            $hotel_id = $this->input->get('hotel_id');
//        } else {
//            $hotel_id = 1;
//        }
//        $date['today'] = $today = date('Y-m-d');
//        $data['hotel_id'] = $hotel_id;
//
//
//
//        $review_id = $this->input->post('review_id');
//
//        if ($this->input->post('CAX') == 10 && isset($review_id)) {
//            $this->obmp_review_model->delete($review_id);
//            redirect('obmp_review/index/?' . $_SERVER['QUERY_STRING']);
//        } else {
//
//            redirect('obmp_review/edit/?error=nodelete&' . $_SERVER['QUERY_STRING']);
//        }
//    }

    function success() {
        echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
	    sessions have not been used and would need to be added in to suit your app';
    }

    
    
    
    
    
        function coupon() {

        $date['today'] = $today = date('Y-m-d');
        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);
        
        $data['cliente'] = $cliente = $this->obmp_review_model->get_cliente_rew($conto_id, $clienti_id);

//        echo $cliente->out_conto ;
        
        $data['valido'] =  $this->my_tools->somma_gg($cliente->out_conto, 180); 
        
        
        if ($cliente) {
            $hotel_id = $cliente->hotel_id;
        } else {

            $hotel_id = 1;
        }
        $data['hotel_id'] = $hotel_id;


        if ($cliente) {
            $conto_id = $cliente->conto_id;
        } else {

            $conto_id = 0;
        }

        $data['lg'] = $this->lg;

        // get review by conto_id
//        $data['review'] = $this->obmp_review_model->review_area_id($conto_id);
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);


       // scegli il templete
        $temi = 'tem_full';
        // carica la vista del contenuto
        $vista = 'cuopon_view';
        // gestore templete

      
            // gestore templete

            $data['temp'] = array
                ('templete' => $temi,
                'contenuto' => $vista,
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top');
            $this->load->view('templetes_guest', $data);
        
        
    }

}
