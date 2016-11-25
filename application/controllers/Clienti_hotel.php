<?php

//  Clienti_hotel.php             
class Clienti_hotel extends CI_Controller {

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

    /**
     * lato hotel 
     * Elenco i clienti che non hanno firmato la privacy
     */
    public function index(){

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
        $data['temp'] = array ('templete' => $temi, 'contenuto' => $vista, 'bar_1' => 'bar_1', 'bar_2' => 'bar_2', 'box_top' => 'box_top');
        $this->load->view('templetes_guest', $data);
    }

    /**
     * lato hotel 
     * richiede l'email del cliente 
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

//-------------------------------- lato cliente--------------------------

    
    
    

}

?>