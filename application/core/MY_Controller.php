<?php

Class MY_Controller extends CI_Controller {

    public function __construct() {
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

// controllo se il cliente è settato se proviene da link  
        if ( isset($this->uri->segment(3, 1)) && isset($his->uri->segment(4, 1)) ) {
            $this->cliente_session();
        }

// verifivo la sessione clente e lo butto fuori
        $this->check_login();
    }

    /**
     * La funzione controlla che l'utente sia loggato
     */
    function check_login() {
        if ($this->session->userdata('area') < 1 && $this->session->userdata('clienti_id') < 1 ) {
            $this->logout();
        }
    }

    /**
     *  Funzione per il logout
     */
    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/log_in', 'refresh');
    }

    /**
     * controllo il cliente da url
     */
    protected function cliente_session() {
        $conto_id = $this->uri->segment(3, 1);
        $clienti_id = $this->uri->segment(4, 1);
        $data['rs_clienti'] = $cliente = $this->clienti_model->get_conto_cliente($conto_id, $clienti_id);

        if ($cliente) {
            $newdata = array(
                'clienti_id' => $cliente[0]->clienti_id,
                'conto_id' => $cliente[0]->conto_id,
                'clienti_cogno' => $cliente[0]->clienti_cogno,
                'clienti_nome' => $cliente[0]->clienti_nome,
                'hotel_id' => $cliente[0]->hotel_id,
                'area' => '2'
            );
            $this->session->set_userdata($newdata);
        }
    }

}
