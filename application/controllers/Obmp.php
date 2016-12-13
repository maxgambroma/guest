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
        $this->load->model('conti_model');
        $this->load->model('prezzi_disponibilita_model');
        $this->load->model('tex_lingue_model');
        $this->load->model('obmp_ref_event_model');
        $this->load->model('obmp_review_model');
        $this->load->model('log_obmp_model');
        $this->load->model('log_obmp_full_model');
        $this->load->model('ref_obmp_booking_model');     
        $this->load->model('obmp_clienti_model');   
        $this->load->library('form_validation');
        $this->load->library('table');
        $this->load->library('pagination');
        $this->load->library('email');
        $this->load->library('my_tools');
        $this->load->library('session');
        $this->load->helper('cookie');
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

    /**
     * diponibilita e prezzi per obmo
*/
    public function index() {

        $data['lg'] = $lg = $this->lg;
// richimo campi lingue del db
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
// hotel di defaul
        if ($this->input->get_post('hotel_id')) {
            $hotel_id = $this->input->get_post('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['hotel_id'] = $hotel_id;

// tipologia di defaul Matrimoniale
        if ($this->input->get_post('T1')) {
            $T1 = $this->input->get_post('t1');
        } else {
            $T1 = 3;
        }

        $data['today'] = $today = date('Y-m-d');
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

        $preno_dal = $today;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1;

        if ($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')) {
            $preno_dal = $this->input->get_post('preno_dal');
            $preno_al = $this->input->get_post('preno_al');
            $Q1 = $this->input->get_post('Q1');
        }

        $data['preno_dal'] = $preno_dal;
        $data['preno_al'] = $preno_al;
        $data['Q1'] = $Q1;
        $data['night'] = $this->my_tools->data_diff($preno_al, $preno_dal);
        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        $errore = 0;
// inserisco i date della richiesta nella statistica
        $data['stat'] = $stat = $this->stat_rechiesta($hotel_id, $preno_dal, $preno_al, $Q1, $T1, $errore, 1);
        $ref_event = $stat['ref_event'];
//        print_r($stat);
//        print_r($this->input->cookie());
        $stato = 1; // camera attive
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id, $tipologia_id = NULL, $agenzia_id = 279, $lg, $stato);
        $data['prezzi'] = $this->prezzi_disponibilita_model->prezzo_web($hotel_id, $preno_dal, $preno_al, $includi_prezzi = 1, $ref_event);
        $evento_html = $this->evento_html($hotel_id, $ref_event);
        $data['table_evento'] = $evento_html['table_evento'];
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

    /**
     * compilo il form per la conferma
*/
    public function availability() {

        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $data['today'] = $today = date('Y-m-d');

// hotel di defaul
        if ($this->input->get_post('hotel_id')) {
            $hotel_id = $this->input->get_post('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['hotel_id'] = $hotel_id;

// tipologia di defaul Matrimoniale
        if ($this->input->get_post('T1')) {
            $T1 = $this->input->get_post('T1');
        } else {
            $T1 = 3;
        }

        $preno_dal = $today;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1;

        if ($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')) {
            $preno_dal = $this->input->get_post('preno_dal');
            $preno_al = $this->input->get_post('preno_al');
            $Q1 = $this->input->get_post('Q1');
        }

        $data['preno_dal'] = $preno_dal;
        $data['preno_al'] = $preno_al;
        $data['Q1'] = $Q1;
        $data['night'] = $night = $this->my_tools->data_diff($preno_al, $preno_dal);

        $conto_id = 0;
        $clienti_id = 0;
        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

// mercato 
        if ($this->input->cookie('mercato')) {
            $mercato = $this->input->cookie('mercato');
        } else {
            $mercato = 1;
        }

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        $data['camere_obmp'] = $room_obmp = $this->prezzi_disponibilita_model->camere_obmp($hotel_id);
        $dati = $this->input->post();
//        Creo una array per camare id 
        foreach ($room_obmp as $key => $value) {
            $room[$value->obmp_cm_rooms_id] = $value;
        }

//        print_r($room);

        $data['room'] = $room;
        $errore = 0;
        $data['stat'] = $stat = $this->stat_rechiesta($hotel_id, $preno_dal, $preno_al, $Q1, $T1, $errore);

//print_r($stat); 

        $ref_event = $stat['ref_event'];
        $evento_html = $this->evento_html($hotel_id, $ref_event);
        $data['table_evento'] = $evento_html['table_evento'];
//    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);
//print_r($dati);
        $t[1] = 0;         $q[1] = 0;         $p[1] = 0;
        $t[2] = 0;         $q[2] = 0;         $p[2] = 0;
        $t[3] = 0;         $q[3] = 0;         $p[3] = 0;
        $t[4] = 0;         $q[4] = 0;         $p[4] = 0;
        $t[5] = 0;         $q[5] = 0;         $p[5] = 0;
        $t[6] = 0;         $q[6] = 0;         $p[6] = 0;
// sovrascrivo le variabili 
        $i = 1;
        foreach ($dati['num'] as $key => $value) {
            if ($value != 0) {
                if ($i < 7) {
                    $t[$i] = $room[$dati['cm_rooms_id'][$key]]->obmp_cm_rooms_tipologia_id;
                    $q[$i] = $dati['num'][$key];
                    $p[$i] = $dati['price'][$key];
                    $i++;
                }
            }
        }

// passo le variabili al fom            
        $data['t'] = $t;
        $data['q'] = $q;
        $data['p'] = $p;
// calcolo importo          
        $importo = $q[1] * $p[1] + $q[2] * $p[2] + $q[3] * $p[3] + $q[4] * $p[4] + $q[5] * $p[5] + $q[6] * $p[6];

// Sovrascrivo
// per trovare i valori delle camare prenotate 

        $this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'trim');
        $this->form_validation->set_rules('t1', 't1', 'trim|xss_clean');
        $this->form_validation->set_rules('q1', 'q1', 'trim|xss_clean');
        $this->form_validation->set_rules('p1', 'p1', 'trim|xss_clean');
        $this->form_validation->set_rules('t2', 't2', 'trim|xss_clean');
        $this->form_validation->set_rules('q2', 'q2', 'trim|xss_clean');
        $this->form_validation->set_rules('p2', 'p2', 'trim|xss_clean');
        $this->form_validation->set_rules('t3', 't3', 'trim|xss_clean');
        $this->form_validation->set_rules('q3', 'q3', 'trim|xss_clean');
        $this->form_validation->set_rules('p3', 'p3', 'trim|xss_clean');
        $this->form_validation->set_rules('t4', 't4', 'trim|xss_clean');
        $this->form_validation->set_rules('q4', 'q4', 'trim|xss_clean');
        $this->form_validation->set_rules('p4', 'p4', 'trim|xss_clean');
        $this->form_validation->set_rules('t5', 't5', 'trim|xss_clean');
        $this->form_validation->set_rules('q5', 'q5', 'trim|xss_clean');
        $this->form_validation->set_rules('p5', 'p5', 'trim|xss_clean');
        $this->form_validation->set_rules('t6', 't6', 'trim|xss_clean');
        $this->form_validation->set_rules('q6', 'q6', 'trim|xss_clean');
        $this->form_validation->set_rules('p6', 'p6', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_email', 'lang:preno_email', 'required|trim|xss_clean|valid_email');
        $this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_city', 'lang:obm_cliente_city', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_country', 'lang:obm_cliente_country', 'trim|xss_clean');
        $this->form_validation->set_rules('newsletter', 'lang:obm_cliente_newsletter', 'trim|xss_clean');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
        //        print_r($this->form_validation);
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            // scegli il templete
            $temi = 'tem_full_obmp';
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
        } else { // passed validation proceed to post success logic
                // build array for the model
                // ricavo il telefono
            $preno_tel = set_value('tel_stato') . " " . set_value('tel_prefisso') . " " . set_value('tel_nemero');

            $form_data = array(
                // 'preno_id' => set_value('preno_id'),
                'hotel_id' => $hotel_id,
                'preno_in_data' => date("Y-m-d H:i:s"),
                'preno_importo' => $importo,
                'preno_impoto_mod' => $importo,
                'preno_dal' => $preno_dal,
                'preno_al' => $preno_al,
                'preno_n_notti' => $night,
                'preno_arr_ore' => set_value('preno_arr_ore'),
                'preno_trattamento' => 'BB',
                't1' => set_value('t1'),
                'q1' => set_value('q1'),
                'p1' => set_value('p1'),
                't2' => set_value('t2'),
                'q2' => set_value('q2'),
                'p2' => set_value('p2'),
                't3' => set_value('t3'),
                'q3' => set_value('q3'),
                'p3' => set_value('p3'),
                't4' => set_value('t4'),
                'q4' => set_value('q4'),
                'p4' => set_value('p4'),
                't5' => set_value('t5'),
                'q5' => set_value('q5'),
                'p5' => set_value('p5'),
                't6' => set_value('t6'),
                'q6' => set_value('q6'),
                'p6' => set_value('p6'),
                'preno_nome' => set_value('preno_nome'),
                'preno_cogno' => set_value('preno_cogno'),
                'preno_agenzia' => $stat['ref_agency'],
                'preno_cc_tip' => set_value('preno_cc_tip'),
                'preno_cc_n' => substr(set_value('preno_cc_n'), 0, -5),
                'preno_cc_scad' => set_value('preno_cc_scad'),
                'preno_tel' => $preno_tel,
                'preno_email' => set_value('preno_email'),
                'preno_mercato' => $mercato,
                'preno_note' => set_value('preno_note'),
                'preno_doc_form' => 1,
                'preno_pag_modalita' => 1,
                'preno_stato' => 1,
                'agenda_utente_id' => '999'
            );

               // run insert model to write data to db
            $preno_id = $this->agenda_model->insert($form_data);

            if (!$preno_id) {
                echo 'errore agebda';
            }
            if ($preno_id) {
                // controllo che il cliente non sia gia registrato 
                $obm_cliente = $this->obmp_clienti_model->get_by_email(set_value('preno_email'));
                //lo registro 
                if (!$obm_cliente) {
                // condizione di non cliente 
                // INIZIO iserisci il cliente nuovo per l'email 
                // INIZIO si crea la password di accesso al gentianale   
                    $cogn = set_value('preno_cogno');
                    $obm_cliente_pass = rand(10000, 99999) . "-" . substr("$cogn", 0, 5) . "-" . rand(1000, 9999);
                    // FINE si crea la password di accesso al gentianale
                    $form_obmp_clienti = array(
                     // 'obm_cliente_id' => set_value('obm_cliente_id'),
                        'obm_cliente_first_name' => set_value('preno_nome'),
                        'obm_cliente_last_name' => set_value('preno_cogno'),
                        'obm_cliente_email' => set_value('preno_email'),
                        'obm_cliente_city' => set_value('preno_city'),
                        'obm_cliente_country' => set_value('preno_country'),
                        'obm_cliente_phone' => $preno_tel,
                        'obm_cliente_newsletter' => set_value('newsletter'),
                        'obm_cliente_pass' => $obm_cliente_pass,
                        'obm_cliente_data_insert' => date("Y-m-d H:i:s"),
                        'obm_cliente_cc_type' => set_value('obm_cliente_cc_type'),
                        'obm_cliente_cc_number' => substr(set_value('preno_cc_n'), 0, -5),
                        'obm_cliente_holder' => set_value('preno_cc_holder'),
                        'obm_cliente_cc_expire' => set_value('preno_cc_scad')
                    );

                    //Sovrasceivo il 
                    $obm_cliente_id = $this->obmp_clienti_model->insert($form_obmp_clienti);

                    if (!$obm_cliente_id) {
                        echo 'errore clienti_model';
                    }
                }
                // è gia cliente 
                else {
                    $obm_cliente_id = $obm_cliente->obm_cliente_id;
                }
                $form_obmp_booking = array(
                //  'ref_obm_data' => date("Y-m-d H:i:s"),
                    'preno_id' => $preno_id,
                    'obm_cliente_id' => $obm_cliente_id,
                    'hotel_id' => $hotel_id,
                    'ref_site' => $stat['ref_site'],
                    'ref_agency' => $stat['ref_agency'],
                    'ref_event' => $stat['ref_event'],
                    'ref_session' => $stat['ref_session'],
                    'ref_cookie' => $stat['ref_cookie']
                );
            //print_r($form_obmp_booking) ;

                if ($this->ref_obmp_booking_model->insert($form_obmp_booking) == TRUE) {
                    // the information has therefore been successfully saved in the db
                    redirect( $dase_url . '/obmp/confirmation/?preno_id=' . $preno_id . '&obm_cliente_id=' . $obm_cliente_id . '&' . $_SERVER['QUERY_STRING']);   // or whatever logic needs to occur
                } else {
                    echo 'errore obmp_booking';
                }
            }
        }
    }

    /**
     * conferma le prenotazione
     */
    public function confirmation() {

        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] =  $this->tex_lingue_model->tex_lg($lg);

        
            
      $preno_id =  $this->input->get_post('preno_id') ;
      $obm_cliente_id =   $this->input->get_post('obm_cliente_id') ;    
      $data['preno']= $preno =  $this->obmp_clienti_model->get_preno_obmp($preno_id,$obm_cliente_id);
        
            // hotel di defaul
        if ($this->input->get_post('hotel_id')) {
            $hotel_id = $this->input->get_post('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['hotel_id'] = $hotel_id;
        
        $data['today'] = $today = date('Y-m-d');
        

        $preno_dal = $today;
        $preno_al = $this->my_tools->somma_gg($today, 1);
        $Q1 = 1;
        if ($this->input->get_post('preno_dal') && $this->input->get_post('preno_al')) {
            $preno_dal = $this->input->get_post('preno_dal');
            $preno_al = $this->input->get_post('preno_al');
            $Q1 = $this->input->get_post('Q1');
        }

        $data['preno_dal'] = $preno_dal;
        $data['preno_al'] = $preno_al;
        $data['Q1'] = $Q1;
        $data['night'] = $this->my_tools->data_diff($preno_al, $preno_dal);

        $conto_id = 0;
        $clienti_id = 0;
        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        
        $data['camere_obmp'] = $room_obmp = $this->prezzi_disponibilita_model->camere_obmp($hotel_id);
        
        foreach ($room_obmp as $key => $value) {
            $room[$value->obmp_cm_rooms_tipologia_id] = $value;
        }
        
    $data['rooms'] = $room ;
        
       $errore = 0;  
       $T1 = 1;
     $data['stat'] =  $stat = $this->stat_rechiesta($hotel_id,$preno_dal,$preno_al,$Q1,$T1, $errore ) ; 
      $ref_event = $stat['ref_event'];
      $evento_html =   $this->evento_html($hotel_id, $ref_event);  
      $data['table_evento'] = $evento_html['table_evento'];
        

        
//    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);
// scegli il templete
        $temi = 'tem_full_obmp';
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

    /**
     * restetuisce la camare selzionate dal index()
     */
    public function summary_select() {

        $data['lg'] = $lg = $this->lg;
        $data['tax_lg'] = $tax_row = $this->tex_lingue_model->tex_lg($lg);

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

        if ($num_cm) {
            echo $num_cm . ' Camera ' . $camara_cm . ' @ ' . (float) $prezzo_cm * (float) $num_cm;
        } else {
            echo '';
        }
    }

    /**
     * non mi ricordo ???
     */
    public function booking_select() {
        $data['lg'] = $lg = $this->lg;
        $data['tax_lg'] = $tax_row = $this->tex_lingue_model->tex_lg($lg);

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

        if ($num_cm) {
            echo '<button class="room-select" type = "submit"  class="button small ">Book</button>';
        } else {
            echo 'Seleziona';
        }
    }

    
    /**
     * 
     * @param array $form_data
     */
    
    function ins_obmp_clienti($form_data) {

        $form_data = array(
            'obm_cliente_id' => set_value('obm_cliente_id'),
            'obm_cliente_first_name' => set_value('obm_cliente_first_name'),
            'obm_cliente_last_name' => set_value('obm_cliente_last_name'),
            'obm_cliente_email' => set_value('obm_cliente_email'),
            'obm_cliente_city' => set_value('obm_cliente_city'),
            'obm_cliente_country' => set_value('obm_cliente_country'),
            'obm_cliente_phone' => set_value('obm_cliente_phone'),
            'obm_cliente_newsletter' => set_value('obm_cliente_newsletter'),
            'obm_cliente_pass' => set_value('obm_cliente_pass'),
            'obm_cliente_data_insert' => set_value('obm_cliente_data_insert'),
            'obm_cliente_data_record' => set_value('obm_cliente_data_record'),
            'obm_cliente_cc_type' => set_value('obm_cliente_cc_type'),
            'obm_cliente_cc_number' => set_value('obm_cliente_cc_number'),
            'obm_cliente_holder' => set_value('obm_cliente_holder'),
            'obm_cliente_cc_expire' => set_value('obm_cliente_cc_expire'),
            'obm_cliente_cc_security' => set_value('obm_cliente_cc_security')
        );

// run insert model to write data to db

        if ($this->obmp_clienti_model->insert($form_data) == TRUE) { // the information has therefore been successfully saved in the db
            redirect('obmp_clienti/?' . $_SERVER['QUERY_STRING']);   // or whatever logic needs to occur
        }
    }
    
    
   

    /** se ho un evento lo setto 
     * 
     */
  private  function get_event($hotel_id) {
        $ref_event = 0;
        $agenzia_id = 279;
        
//    $evento_ris = array('evento_stato' => 0, 'table_evento' => '', 'agenzia_id' => $agenzia_id);
/// nel caso ci sia un evento da GET|| POST si setta il cookie
        
        
        
        if ($this->input->get_post('ref_event') != NULL ) {
         
    $ref_event = $this->input->get_post('ref_event') ; 
          $evento_row = $this->obmp_ref_event_model->controlla_evento($hotel_id, $ref_event);


//print_r($evento_ris); 
            if ($evento_row) {
                
            $cookie_valore = $evento_row->ref_event_id ;

            $cookie_nome = "ref_event";
            $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 2; //  2 Mesi  (60*60*20*30) 
            $cookie_dominio = "";
            setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");

            
            // setto il mercato
            $cookie_mercato = $evento_row->ref_event_nome ; 
            $cookie_nome = "mercato";
            $cookie_dominio = "";
            setcookie($cookie_nome, $cookie_mercato, $cookie_scadenza, "/");

            
            
            
            // setto l'agenzia   
            $agenzia_id =  $cookie_valore = $evento_row->agenzia_id ;
            $cookie_nome = "agenzia_id"; 
            $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 2; // un anno 
            $cookie_dominio = "";
            setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");
               
            }
            
            
 else {  $ref_event = 0 ; }
            
        }
        
        
       if($this->input->get_post('ref_event') === NULL && $this->input->cookie('ref_event') !== NULL) 
       {
           
          $ref_event =  $this->input->cookie('ref_event') ;
       }
       
       return $ref_event;
        
    }

    
    
    /**
     * se un affiliazione 
     */
    private function get_site() {

        if ($this->input->get_post('ref_site') != NULL) {

            if (!$this->input->cookie('ref_site')) {
//se esiste un sito di affiliazione si setta in cookie dell sito di provenienza 
                $cookie_valore = $this->input->get_post('ref_site');
                $cookie_nome = "ref_site";
                $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 12;
                $cookie_dominio = "";
                setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");

                $ref_site = $this->input->get_post('ref_site');
            }
        }

        if ($this->input->cookie('ref_site')) {
            $ref_site = $this->input->cookie('ref_site');
        }

        if (!$this->input->cookie('ref_site') && !$this->input->get_post('ref_site')) {
            $ref_site = 0;
        }
        return $ref_site;
    }

    /**
     * setto l'agenzia di riferimento 
     * @return int
     */
     
    
 private  function get_agenzia() {
      
      $agenzia_id = 279;
  //se esiste un sito di affiliazione si setta in cookie dell sito di provenienza     
      if ( $this->input->get_post('agenzia_id')) {
            if ( !$this->input->cookie('agenzia_id') ) {
                $cookie_nome = "agenzia_id";
                if ($this->input->get_post('agenzia_id')!== null ) {
                    $cookie_valore = $this->input->get_post('agenzia_id');
                }
                
                $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 12;
                $cookie_dominio = "";
                setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");
                
                 $agenzia_id = $this->input->get_post('agenzia_id');
                
            }
//fine // ref_event facoltativo 
  
        } else {
            if ( $this->input->cookie('agenzia_id') ) {
                $agenzia_id = $this->input->cookie('agenzia_id') ;
            }
        }
        
        
        if ( !$this->input->cookie('agenzia_id') && !$this->input->get_post('agenzia_id')  ) {
           $agenzia_id =  $cookie_valore = 279;
             
             $cookie_nome = "agenzia_id"; 
              $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 12;
                $cookie_dominio = "";
                setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");
        }
        
        return $agenzia_id ;  
        
    }
    
    
    
    /**
     * setto il vistatore obmp_id
     */
    
    
  private  function get_cookie() {
// $ref_agency = $agenzia_id = 279 ;


        if (!$this->input->cookie('ref_cookie')) { // e il cookie e nullo
            $max_id = $this->log_obmp_model->max_obmp_id();

            $ref_cookie = $max_id->max_cookie + 1; // si mette il max del id 

            /* si setta il cookie */
            $cookie_nome = "ref_cookie";
            $cookie_valore = $ref_cookie;
            $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 12 * 10; // 10 anni(60*60*20*30) 
            $cookie_dominio = "";
            setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");
              return $ref_cookie ;         
        } 
 else {
     
            return $ref_cookie = $this->input->cookie('ref_cookie');
 }
        
               
       
    }

    
    /**
     * detemino il la KW di entrata di goole
     * @param type $param
     */
            
    private function get_google_key() {
//   setto il cookie per le parole chiave provenienti da google 
        $mygooglekeyword = NULL;
        if (!isset($_COOKIE['mygooglekeyword']) && empty($_COOKIE['mygooglekeyword'])) {
            if ($this->input->get_post('mygooglekeyword') !== NULL) {
                $mygooglekeyword = $this->input->get_post('mygooglekeyword');

// ref_event facoltativo 
                $cookie_nome = "mygooglekeyword";
                $cookie_valore = $mygooglekeyword;
                $cookie_scadenza = time() + 60 * 60 * 24 * 30 * 4; //  4 Mesi  (60*60*20*30) 
                $cookie_dominio = "";
                setcookie($cookie_nome, $cookie_valore, $cookie_scadenza, "/");
            }
        } else {
            $mygooglekeyword = $_COOKIE['mygooglekeyword'];
        }
        return $mygooglekeyword;
    }

    /**
     * eleima caratteri stranieri dalla stringa
     * @param type $sString
     * @return type
     */
    
  private  function getURL($sString) {
        $string = strtolower(htmlentities($sString));
        $string = preg_replace("/&(.)(uml);/", "$1e", $string);
        $string = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml|grave);/", "$1", $string);
        $string = preg_replace("/([^a-z0-9]+)/", "-", html_entity_decode($string));
        $string = trim($string, "-");
        return $string;
    }

    
    /**
     * ref_event=339
     * @param type $hotel_id
     * @param type $ref_event
     * @return type
     */
    
private function evento_html($hotel_id, $ref_event) {
$row =  $this->obmp_ref_event_model->controlla_evento($hotel_id, $ref_event) ; 

if ( $row) {
$agenzia_id = $row->agenzia_id;
$table_evento = "<div class=\"evento\">You Welcome Participants of Meeting<br> <table width=\"100%\" border=\"0\">
<tr>
<td bgcolor=\"#FF99CC\"><strong>" . $row->ref_event_nome .
" -" . $row->listino_nome_id . "-" . $row->ref_site_id . "- " . $row->ref_event_id . "</strong></td>
</tr>
</table> </div> ";

$evento = array('evento_stato' => $row->ref_event_id, 'table_evento' => $table_evento, 'agenzia_id' => $agenzia_id);


} else {
$evento = array('evento_stato' => '', 'table_evento' => '', 'agenzia_id' => '279');
}


return $evento;
}

    
    /**
     * per la visualizzazione del prezzo nel caso dei portali
     */
    
    
    private function nazione_host() {

       $host_nazione = substr(gethostbyaddr($_SERVER['REMOTE_ADDR']), -3, 3);

        if (
                gethostbyaddr($_SERVER['REMOTE_ADDR']) == ('proxy3.activehotels.net') ||
                gethostbyaddr($_SERVER['REMOTE_ADDR']) == ('del-static-226-162-196-203.direct.net.in') ||
                gethostbyaddr($_SERVER['REMOTE_ADDR']) == ('NSG-Static-050.33.71.182.airtel.in') ||
                gethostbyaddr($_SERVER['REMOTE_ADDR']) == ('del-static-162-70-7-210.direct.net.in') ||
                strstr($host_nazione, '.in')  // tutti gli indiani, hanno rotto 
        ) {
            $pr_portale = $row_rs_hotel_obmp['hotel_incremento_prezzo_xml'];
            $TO = $row_rs_hotel_obmp['hotel_email'];
            $SUDIECT = "stanno entrando $ref_cookie cookie  ";
            $mail_body = ' ti ho pizzicato Booking' . 'il tuo host � ' . gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $FROM = $row_rs_hotel_obmp['hotel_email'];
            mail($TO, $SUDIECT, $mail_body, "From: $FROM");
        } else {
            $pr_portale = 1;
        }
    }
    
    
    




   /**
     *  imserico le richiestrte del db
     * @param type $param
     * @return array
     */
   

function stat_rechiesta($hotel_id, $preno_dal, $preno_al, $Q1, $T1, $errore_booking, $ins = NULL) {
// controlo l'evento 
        $ref_event = $this->get_event($hotel_id);
        $ref_agency = $this->get_agenzia();
        $ref_cookie = $this->get_cookie();
        $ref_site = $this->get_site();
        $google_kw = $this->get_google_key();
        $ref_session = $this->input->ip_address();
        $today = date("Y-m-d");

        $param = array(
// 'log_obmp_id' => $this->input->get_post('log_obmp_id'),
            'preno_dal' => $preno_dal,
            'preno_al' => $preno_al,
            'Q1' => $Q1,
            'T1' => $T1,
            'hotel_id' => $hotel_id,
            'ref_site' => $ref_site,
            'ref_agency' => $ref_agency,
            'ref_event' => $ref_event,
            'ref_session' => $ref_session, // ip address
            'ref_cookie' => $ref_cookie,
            'mygooglekeyword' => $google_kw,
        );

        if ($ins !== NULL) {
// inserico le richiesta nel db
            $param['log_obmp_id'] = $log_id = $this->log_obmp_model->insert($param);
            if ($errore_booking > 0) {
// ho un errore di disponibilita o prezzo e le inserrisco 
                $param = array(
                    'log_obmp_id_full' => $log_id,
                    'preno_dal' => $preno_dal,
                    'preno_al' => $preno_al,
                    'Q1' => $Q1,
                    'T1' => $T1,
                    'hotel_id' => $hotel_id,
                    'ref_site' => $ref_site,
                    'ref_agency' => $ref_agency,
                    'ref_event' => $ref_event,
                    'ref_session' => $ref_session, // ip address
                    'ref_cookie' => $ref_cookie,
                    'mygooglekeyword' => $google_kw,
                    'today' => $today
                );

                $id = $this->insert_log_fullobmp($param);
            }
        }
        return $param;
    }

}




