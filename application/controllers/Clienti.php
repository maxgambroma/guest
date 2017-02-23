<?php

//  Clienti.php             
class Clienti extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('clienti_model');
        $this->load->model('hotel_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camera_model');
        $this->load->model('obmp_review_model');
        $this->load->model('conti_model');
        $this->load->model('obmp_clienti_model');

        $this->load->model('tex_lingue_model');

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

//-------------------------------- lato cliente--------------------------
    /**
     * lato cliente 
     * pagina iniziale cliente
     */
    public function index() {

// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
// hotel   
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
// data          
        $data['today'] = $today = date('Y-m-d');

// controllo se il cliente è settato se proviene da link  
        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;

        if ($this->session->area > 1) {
            $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
            $data['hotel_id'] = $hotel_id = $cliente[0]->hotel_id;
//      print_r($cliente);
// trovo i punti per i fidelizzati
            $data['punti'] = $this->clienti_model->clienti_punti($clienti_id);
// trovo i conti aperti
            $data['conti'] = $conti_new = $this->conti_model->conto_aperto_cliente_id($clienti_id);
            if ($conti_new) {
                $data['conti_saldo'] = $conti_saldo = $this->conti_model->totale_conto_camera($conti_new[0]->conto_id, $today);
            }
// elenco le nuove prenotazioni 
// trovo le nuove preno
            $data['preno'] = $preno = $this->agenda_model->get_booking_by_email($email);
        }
// Obmp cliente in sessione no conti solo preno
        else {
            $data['preno'] = $preno = $this->agenda_model->get_booking_by_email($this->session->email);
        }
        $data['albergo'] = $cc = $this->hotel_model->hotel($hotel_id);

// scegli il templete
        $temi = 'tem_cb_clienti';
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
     * 
     */
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
     * lato cliente elenca tutte le prenotazioni
     * elenca le prenotazioni del clienti_id
     */
    function bookings() {
// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);

        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');

        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
//trovo i vecchi conti
            $data['conti_old'] = $conti_old = $this->clienti_model->conti_by_clienti($clienti_id);
            $data['hotel_id'] = $hotel_id = $cliente[0]->hotel_id;
        }
// trovo le nuove preno
        $data['preno'] = $preno = $this->agenda_model->get_booking_by_email($email);
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

// scegli il templete
        $temi = 'tem_cb_clienti';
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
     * lato cliente 
     * vedi i dettagli delle prenotazioni 
     * cancella e modifica preno
     * restituisce i dettagli della prentoazine e se future le amminista
     */
    function bookings_edit() {
// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;
        $preno_id = $this->uri->segment(3, 1);
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
// trovo le caratteristiche della camare nelle lingue 
        $data['lg_tipologia'] = $this->agenda_model->tip_lg_preno($this->lg, $hotel_id);
        if ($cliente) {
            $data['hotel_id'] = $hotel_id = $cliente[0]->hotel_id;
//trovo i vecchi conti
            $data['conti_old'] = $conti_old = $this->clienti_model->conti_by_clienti($clienti_id);
        }
// trovo le  preno
// da modificare inserendo email
        $data['preno'] = $preno = $this->agenda_model->booking_id($preno_id);
// recenzioni
        $data['review'] = $this->obmp_review_model->review_preno_cliente($preno_id, $clienti_id);
// hotel        
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
// scegli il templete
        $temi = 'tem_cb_clienti';
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
     * consente il cambio di date nelle prentoazione
     */

    /**
     * latocliente,
     *  elenca tutti i rewiev del cliente
     */
    function review() {

// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);

        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        if ($data['rs_clienti']) {
            $data['hotel_id'] = $hotel_id = $cliente[0]->hotel_id;
        }
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        $data['reviews'] = $reviews = $this->obmp_review_model->review_cliente_id($clienti_id);

//         print_r($reviews);
// scegli il templete
        $temi = 'tem_cb_clienti';
// carica la vista del contenuto
        $vista = 'clienti_review';
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
     * lato cliente 
     * per grstire le prprie impostazioni 
     *  
     */
    function impostazioni() {
// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        if ($data['rs_clienti']) {
            $data['hotel_id'] = $hotel_id = $cliente[0]->hotel_id;
        }
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
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
            $temi = 'tem_cb_clienti';
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
            if ($this->clienti_model->update($clienti_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db  
                redirect('clienti/index/' . $conto_id . '/' . $clienti_id . '/?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('clienti/index/' . $conto_id . '/' . $clienti_id . '/?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }

    /**
     * lato cliente
     *  per gestire il marketing
     */
    function imp_privacy() {
// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
        $conto_id = $this->session->conto_id;
        $clienti_id = $this->session->clienti_id;
        $email = $this->session->email;
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);
        if ($data['rs_clienti']) {
            $hotel_id = $cliente[0]->hotel_id;
        }
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);
        $this->form_validation->set_rules('marketing', 'lang:marketing', 'trim');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed
// scegli il templete
            $temi = 'tem_cb_clienti';
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
                'marketing' => set_value('marketing')
            );
// run insert model to write data to db
            $clienti_id = $cliente[0]->clienti_id;
            if ($this->clienti_model->update($clienti_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db  
                redirect('clienti/index/' . $conto_id . '/' . $clienti_id . '/?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('clienti/index/' . $conto_id . '/' . $clienti_id . '/?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }

    /**
     *  sessione i dati del cliente
     * @param type $cliente
     */
    function log_out() {
        $this->logout();
    }

    /**
     * edit data in to obmp_clienti
     */
    function obmp_impostazioni() {
// lingua
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] = $this->tex_lingue_model->tex_lg($lg);
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        $data['today'] = $today = date('Y-m-d');
        $data['hotel_id'] = $hotel_id;
        $email = $this->session->email;
        $obm_cliente_id = $this->session->obm_cliente_id;
        $data['albergo'] = $this->hotel_model->hotel($hotel_id);

        $this->form_validation->set_rules('obm_cliente_first_name', 'lang:obm_cliente_first_name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('obm_cliente_last_name', 'lang:obm_cliente_last_name', 'required|trim|xss_clean');
        $this->form_validation->set_rules('obm_cliente_email', 'lang:obm_cliente_email', 'required|trim|valid_email|xss_clean');
        $this->form_validation->set_rules('obm_cliente_city', 'lang:obm_cliente_city', 'trim|xss_clean');
        $this->form_validation->set_rules('obm_cliente_country', 'lang:obm_cliente_country', 'required|trim');
        $this->form_validation->set_rules('obm_cliente_phone', 'lang:obm_cliente_phone', 'required|trim|xss_clean');
        $this->form_validation->set_rules('obm_cliente_newsletter', 'lang:obm_cliente_newsletter', 'trim|xss_clean');
        $this->form_validation->set_rules('obm_cliente_pass', 'lang:obm_cliente_pass', 'required|trim|xss_clean');
             
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
        if ($this->form_validation->run() == FALSE) { // validation hasn't been passed

            /** function find_by_id('obm_cliente_id')
             * find preno_id
             * @param $form_data - array
             * @return object
             */
            $data['rs_obmp_clienti'] = $this->obmp_clienti_model->find_by_id($obm_cliente_id);
 // scegli il templete
            $temi = 'tem_cb_clienti';
// carica la vista del contenuto
            $vista = 'obmp_impo';
// gestore templete
// gestore templete
            $data['temp'] = array
                ('templete' => $temi,
                'contenuto' => $vista,
                'bar_1' => 'bar_clienti',
                'bar_2' => 'bar_booking',
                'box_top' => 'box_top');
            $this->load->view('templetes_clienti', $data);
        } else { // passed validation proceed to post success logic
// build array for the model
            $form_data = array(
//	'obm_cliente_id' => set_value('obm_cliente_id'),
                'obm_cliente_first_name' => set_value('obm_cliente_first_name'),
                'obm_cliente_last_name' => set_value('obm_cliente_last_name'),
                'obm_cliente_email' => set_value('obm_cliente_email'),
                'obm_cliente_city' => set_value('obm_cliente_city'),
                'obm_cliente_country' => set_value('obm_cliente_country'),
                'obm_cliente_phone' => set_value('obm_cliente_phone'),
                'obm_cliente_newsletter' => set_value('obm_cliente_newsletter'),
                'obm_cliente_pass' => set_value('obm_cliente_pass'),
            );
// run insert model to write data to db
            if ($this->obmp_clienti_model->update($obm_cliente_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect('clienti/index/?' . $_SERVER['QUERY_STRING']);
            } else {
                redirect('clienti/index/?error=noupdata&' . $_SERVER['QUERY_STRING']);
            }
        }
    }

}

?>