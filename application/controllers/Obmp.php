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

    /**
     * diponibilita e prezzi per obmo
     */
    public function index() {

        $data['lg'] = $lg = $this->lg;
// richimo i dati del db
        $data['tax_lg'] = $tax_row = $this->tex_lingue_model->tex_lg($lg);

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }

        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
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
        
        $stato = 1; // camera attive
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id, $tipologia_id = NULL, $agenzia_id = 279, $lg, $stato);
        $data['prezzi'] = $this->prezzi_disponibilita_model->prezzo_web($hotel_id, $preno_dal, $preno_al, $includi_prezzi = 1);

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
        $data['tax_lg'] = $tax_row = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;

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
        $data[' num'] = $Q1;
        $data['night'] = $this->my_tools->data_diff($preno_al, $preno_dal);
        
        $conto_id = 0;
        $clienti_id = 0;
        $conto_id = $this->uri->segment(3, 0);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        

        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id);
//    $data['rs_clienti'] = $this->clienti_model->get_privacy($today, $hotel_id);
        $dati = $this->input->post();

        $t1 = 0;
        $q1 = 0;
        $p1 = 0;
        $t2 = 0;
        $q2 = 0;
        $p2 = 0;
        $t3 = 0;
        $q3 = 0;
        $p3 = 0;
        $t4 = 0;
        $q4 = 0;
        $p4 = 0;
        $t5 = 0;
        $q5 = 0;
        $p5 = 0;
        $t6 = 0;
        $q6 = 0;
        $p6 = 0;

// print_r($dati);
// Sovrascrivo
// per trovare i valori delle camare prenotate 

     //   $this->form_validation->set_rules('preno_id', 'lang:preno_id', 'trim');
        $this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_in_data', 'lang:preno_in_data', 'required|trim|xss_clean');
      //  $this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'required|trim|xss_clean');
      //  $this->form_validation->set_rules('preno_impoto_mod', 'lang:preno_impoto_mod', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_al', 'lang:preno_al', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'trim');
        $this->form_validation->set_rules('preno_trattamento', 'lang:preno_trattamento', 'required|trim|xss_clean');
//        $this->form_validation->set_rules('t1', 'lang:t1', 'required|trim|is_numeric');
//        $this->form_validation->set_rules('q1', 'lang:q1', 'required|trim|is_numeric');
//        $this->form_validation->set_rules('p1', 'lang:p1', 'required|trim|is_numeric');
//        $this->form_validation->set_rules('t2', 'lang:t2', 'trim|is_numeric');
//        $this->form_validation->set_rules('q2', 'lang:q2', 'trim|is_numeric');
//        $this->form_validation->set_rules('p2', 'lang:p2', 'trim|is_numeric');
//        $this->form_validation->set_rules('t3', 'lang:t3', 'trim|is_numeric');
//        $this->form_validation->set_rules('q3', 'lang:q3', 'trim|is_numeric');
//        $this->form_validation->set_rules('p3', 'lang:p3', 'trim|is_numeric');
//        $this->form_validation->set_rules('t4', 'lang:t4', 'trim|is_numeric');
//        $this->form_validation->set_rules('q4', 'lang:q4', 'trim|is_numeric');
//        $this->form_validation->set_rules('p4', 'lang:p4', 'trim|is_numeric');
//        $this->form_validation->set_rules('t5', 'lang:t5', 'trim|is_numeric');
//        $this->form_validation->set_rules('q5', 'lang:q5', 'trim|is_numeric');
//        $this->form_validation->set_rules('p5', 'lang:p5', 'trim|is_numeric');
//        $this->form_validation->set_rules('t6', 'lang:t6', 'trim|is_numeric');
//        $this->form_validation->set_rules('q6', 'lang:q6', 'trim|is_numeric');
//        $this->form_validation->set_rules('p6', 'lang:p6', 'trim|is_numeric');
        $this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_agenzia', 'lang:preno_agenzia', 'required|trim|is_numeric');
       // $this->form_validation->set_rules('voucher_id', 'lang:voucher_id', 'trim');
       // $this->form_validation->set_rules('allotment_id', 'lang:allotment_id', 'trim');
        $this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'required|trim|is_numeric');
        $this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_tel', 'lang:preno_tel', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_fax', 'lang:preno_fax', 'trim');
        $this->form_validation->set_rules('preno_email', 'lang:preno_email', 'required|trim|xss_clean|is_numeric');
        $this->form_validation->set_rules('preno_mercato', 'lang:preno_mercato', 'required|trim|xss_clean');
        $this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim|xss_clean');
        //$this->form_validation->set_rules('preno_doc_fax', 'lang:preno_doc_fax', 'trim|xss_clean');
       // $this->form_validation->set_rules('preno_doc_email', 'lang:preno_doc_email', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_doc_form', 'lang:preno_doc_form', 'trim|xss_clean');
       // $this->form_validation->set_rules('preno_doc_mail', 'lang:preno_doc_mail', 'trim|xss_clean');
        //$this->form_validation->set_rules('preno_doc_vaglia', 'lang:preno_doc_vaglia', 'trim|xss_clean');
        //$this->form_validation->set_rules('preno_doc_woucher', 'lang:preno_doc_woucher', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_pag_modalita', 'lang:preno_pag_modalita', 'trim|xss_clean');
       // $this->form_validation->set_rules('preno_caparra', 'lang:preno_caparra', 'trim|xss_clean');
        $this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim|xss_clean');
       // $this->form_validation->set_rules('data_opzione', 'lang:data_opzione', 'trim');
        //$this->form_validation->set_rules('cancella_data_record', 'lang:cancella_data_record', 'trim');
        //$this->form_validation->set_rules('cancella_user', 'lang:cancella_user', 'trim');
        //$this->form_validation->set_rules('cancella_pass', 'lang:cancella_pass', 'trim');
        //$this->form_validation->set_rules('preno_data_record', 'lang:preno_data_record', 'trim');
        $this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
       
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
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
        } else { // passed validation proceed to post success logic
// build array for the model
           
            $i = 1;
            foreach ($dati['num'] as $key => $value) {
                if ($value != 0) {
                    if ($i < 7) {
                        ${'t' . $i} = $dati['cm_rooms_id'][$key];
                        ${'q' . $i} = $dati['num'][$key];
                        ${'p' . $i} = $dati['price'][$key];
                        $i++;
                    }
                }
            }

            $importo = $q1 * $p1 + $q2 * $p2 + $q3 * $p3 + $q4 * $p4 + $q5 * $p5 + $q6 * $p6;
            $preno_tel = set_value('tel_stato') . " " . set_value('tel_prefisso') . " " . set_value('tel_nemero');

            $form_data = array(
// 'preno_id' => set_value('preno_id'),
                'hotel_id' => set_value('hotel_id'),
                'preno_in_data' => set_value('preno_in_data'),
                'preno_importo' => $importo,
                'preno_impoto_mod' => $importo,
                'preno_dal' => set_value('preno_dal'),
                'preno_al' => set_value('preno_al'),
                'preno_n_notti' => set_value('preno_n_notti'),
                'preno_arr_ore' => set_value('preno_arr_ore'),
                'preno_trattamento' => set_value('preno_trattamento'),
                't1' => $t1,
                'q1' => $q1,
                'p1' => $p1,
                't2' => $t2,
                'q2' => $q2,
                'p2' => $p2,
                't3' => $t3,
                'q3' => $q3,
                'p3' => $p3,
                't4' => $t4,
                'q4' => $q4,
                'p4' => $p4,
                't5' => $t5,
                'q5' => $q5,
                'p5' => $p5,
                't6' => $t6,
                'q6' => $q6,
                'p6' => $p6,
                'preno_nome' => set_value('preno_nome'),
                'preno_cogno' => set_value('preno_cogno'),
                'preno_agenzia' => set_value('preno_agenzia'),
// 'voucher_id' => set_value('voucher_id'),
//  'allotment_id' => set_value('allotment_id'),
                'preno_cc_tip' => set_value('preno_cc_tip'),
                'preno_cc_n' => substr(set_value('preno_cc_n'), 0, -5),
                'preno_cc_scad' => set_value('preno_cc_scad'),
                'preno_tel' => $preno_tel,
//'preno_fax' => set_value('preno_fax'),
                'preno_email' => set_value('preno_email'),
                'preno_mercato' => set_value('preno_mercato'),
                'preno_note' => set_value('preno_note'),
// 'preno_doc_fax' => set_value('preno_doc_fax'),
// 'preno_doc_email' => set_value('preno_doc_email'),
                'preno_doc_form' => set_value('preno_doc_form'),
// 'preno_doc_mail' => set_value('preno_doc_mail'),
// 'preno_doc_vaglia' => set_value('preno_doc_vaglia'),
// 'preno_doc_woucher' => set_value('preno_doc_woucher'),
                'preno_pag_modalita' => set_value('preno_pag_modalita'),
// 'preno_caparra' => set_value('preno_caparra'),
                'preno_stato' => set_value('preno_stato'),
// 'data_opzione' => set_value('data_opzione'),
// 'cancella_data_record' => set_value('cancella_data_record'),
// 'cancella_user' => set_value('cancella_user'),
// 'cancella_pass' => set_value('cancella_pass'),
// 'preno_data_record' => set_value('preno_data_record'),
                'agenda_utente_id' => set_value('agenda_utente_id')
            );

// run insert model to write data to db
        $preno_id   = $this->agenda_model->insert($form_data) ;

            if ($preno_id) {
// the information has therefore been successfully saved in the db
                $obm_cliente_id = rs_cliento_obmp_email($email);

                if ($obm_cliente_id) {
// condizione di non cliente 
// INIZIO iserisci il cliente nuovo per l'email 
// INIZIO si crea la password di accesso al gentianale   
                    $cogn = set_value('preno_cogno');
                    $obm_cliente_pass = rand(10000, 99999) . "-" . substr("$cogn", 0, 5) . "-" . rand(1000, 9999);
// FINE si crea la password di accesso al gentianale

                    $form_data = array(
// 'obm_cliente_id' => set_value('obm_cliente_id'),
                        'obm_cliente_first_name' => set_value('preno_nome'),
                        'obm_cliente_last_name' => set_value('preno_cogno'),
                        'obm_cliente_email' => set_value('preno_email'),
                        'obm_cliente_city' => set_value('city'),
                        'obm_cliente_country' => set_value('country'),
                        'obm_cliente_phone' => $preno_tel,
                        'obm_cliente_newsletter' => set_value('newsletter'),
                        'obm_cliente_pass' => $obm_cliente_pass,
                        'obm_cliente_data_insert' => set_value('obm_cliente_data_insert'),
// 'obm_cliente_data_record' => set_value('obm_cliente_data_record'),
// 'obm_cliente_cc_type' => set_value('obm_cliente_cc_type'),
// 'obm_cliente_cc_number' => substr(set_value('preno_cc_n'), 0, -5), 
// 'obm_cliente_holder' => set_value('preno_cc_holder'),
// 'obm_cliente_cc_expire' => set_value('preno_cc_scad'),
// 'obm_cliente_cc_security' => set_value('preno_cc_s_cod')
                    );

//Sovrasceivo il 
                    $obm_cliente_id = $this->obmp_clienti_model->insert($form_data);
                }




                $form_data = array(
                    'ref_obm_data' => set_value('ref_obm_data'),
                    'preno_id' => $preno_id,
                    'obm_cliente_id' => $obm_cliente_id,
                    'hotel_id' => set_value('hotel_id'),
                    'ref_site' => set_value('ref_site'),
                    'ref_agency' => set_value('ref_agency'),
                    'ref_event' => set_value('ref_event'),
                    'ref_session' => set_value('ref_session'),
                    'ref_cookie' => set_value('ref_cookie')
                );
            }

            redirect('agenda/?' . $_SERVER['QUERY_STRING']);   // or whatever logic needs to occur
        }
    }

    /**
     * conferma le prenotazione
     */
    public function confirmation() {

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
        $data['camere_obmp'] = $this->prezzi_disponibilita_model->camere_obmp($hotel_id);
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

    function ins_obmp_ref_obmp_booking() {


        $this->form_validation->set_rules('ref_obm_data', 'lang:ref_obm_data', 'trim');
        $this->form_validation->set_rules('preno_id', 'lang:preno_id', 'required|trim|is_numeric');
        $this->form_validation->set_rules('obm_cliente_id', 'lang:obm_cliente_id', 'trim|is_numeric');
        $this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim|is_numeric');
        $this->form_validation->set_rules('ref_site', 'lang:ref_site', 'trim|xss_clean');
        $this->form_validation->set_rules('ref_agency', 'lang:ref_agency', 'trim|xss_clean|is_numeric');
        $this->form_validation->set_rules('ref_event', 'lang:ref_event', 'trim|xss_clean|is_numeric');
        $this->form_validation->set_rules('ref_session', 'lang:ref_session', 'trim|xss_clean');
        $this->form_validation->set_rules('ref_cookie', 'lang:ref_cookie', 'trim|xss_clean');

        $this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');

        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
            
        } else { // passed validation proceed to post success logic
            // build array for the model

            $form_data = array(
                'ref_obm_data' => set_value('ref_obm_data'),
                'preno_id' => set_value('preno_id'),
                'obm_cliente_id' => set_value('obm_cliente_id'),
                'hotel_id' => set_value('hotel_id'),
                'ref_site' => set_value('ref_site'),
                'ref_agency' => set_value('ref_agency'),
                'ref_event' => set_value('ref_event'),
                'ref_session' => set_value('ref_session'),
                'ref_cookie' => set_value('ref_cookie')
            );

            // run insert model to write data to db

            if ($this->ref_obmp_booking_model->insert($form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('ref_obmp_booking/?' . $_SERVER['QUERY_STRING']);   // or whatever logic needs to occur
            }
        }
    }

}
