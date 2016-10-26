<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Apphotel extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('camere_model');
        $this->load->model('adebbiti_model');
        $this->load->model('guasti_model');
        $this->load->model('pulizia_model');
        $this->load->model('hotel_model');
        $this->load->model('prodotti_model');
        $this->load->model('pulizia_model');


//$temi = array( 'tem_cb', 'tem_bc', 'tem_bcb' , 'tem_m' ); 
    }

    function index() {
        $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
         $date['today'] = $today = date('Y-m-d');  
// 
        $data['hotel_id'] = $hotel_id;
        
		
	
		if ( (!$this->input->get('scelta'))  OR $this->input->get('scelta') == 'conti_aperti') {
		$data['conti_aperti'] = $this->camere_model->conti_aperti($hotel_id);
		}
		if ($this->input->get('scelta') == 'partiti') {
		$data['partiti'] = $this->camere_model->partiti($hotel_id, $today);
		}
		if ($this->input->get('scelta') == 'partenze') {
		$data['partenze'] = $this->camere_model->partenze($hotel_id, $today);
		}

		if ($this->input->get('scelta') == 'rifatte') {
		$data['rifatte'] = $this->pulizia_model->pulizia_riep_giorno($hotel_id, $today );
		}
		if ($this->input->get('scelta') == 'arrivi') {
		$data['arrivi'] = $this->camere_model->arrivi($hotel_id, $today);
		}

		if ($this->input->get('scelta') == 'controllo') {
		$data['controllo'] = $this->pulizia_model->pulizia_controllo( $hotel_id );
		}

      //  print_r( $data['rifatte'] );
        
        $tex['conti_aperti'] = 'Occupate';
        $tex['partiti'] = 'Partite';
        $tex['partenze'] = 'In Partenza';
        $tex['arrivi'] = 'In Arrivo';
        $tex['rifatte'] = 'In Rifatte';
		$tax['controllo'] = 'Da Rifare';        

        $data['menu'] = $tex;

// print_r($data['arrivi']);
// scegli il templete
        $temi = 'tem_bc_new';
// carica la vista del contenuto
        $vista = 'welcome_message';
// gestore templete
        $data['temp'] = array('templete' => $temi, 'contenuto' => $vista, 'bar1' => 'bar_1', 'bar_2' => 'bar_app');
        $this->load->view('templetes', $data);
// fine
    }
	
	

    function risorsa() {
        $date['today'] = $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }

        $tex['conti_aperti'] = 'Occupate';
        $tex['partiti'] = 'Partite';
        $tex['partenze'] = 'In Partenza';
        $tex['arrivi'] = 'In Arrivo';
        $data['menu'] = $tex;
        $data['hotel_id'] = $hotel_id;


        $conto_id = $this->input->get('conto_id');
        $data['conto'] = $this->camere_model->conti_id($hotel_id, $conto_id);
        //  print_r($data['conto']);
         $camera_id = $data['conto']['0']->camera_id;
        $data['pulizie'] = $this->pulizia_model->pulizia_conto($hotel_id, $conto_id, $camera_id);
        $data['guasti'] = $this->guasti_model->guasti_camara($hotel_id, $camera_id);
        $data['adebbiti'] = $this->adebbiti_model->adebbiti_conto($conto_id, $hotel_id);
        $data['camera_arrivo'] = $this->camere_model->arrivicamara($camera_id , $hotel_id , $today );
        
        
        //print_r($data['adebbiti']);
        // print_r($data['guasti']);
        //print_r($data['pulizie']);

        if (($data['conto']['0']->conti_stato_camere <> 7) && ($data['conto']['0']->out_preno > $today)) {
            $data['status'] = 'Fermata';
        };
        if (($data['conto']['0']->conti_stato_camere <> 7) && ($data['conto']['0']->out_preno <= $today)) {
            $data['status'] = 'Partenza';
        };
        if ($data['conto']['0']->conti_stato_camere == 7) {
            $data['status'] = 'Partito';
        };
        //print_r($data['conto']); 

        $data['prodotti'] = $this->prodotti_model->prodotti_all($hotel_id);
        $data['conti_aperti'] = $this->camere_model->conti_aperti($hotel_id);
//        $data['arrivi'] = $this->camere_model->arrivi($hotel_id, $today);
// scegli il templete
        $temi = 'tem_bc_new';
// carica la vista del contenuto
        $vista = 'risorsa';
// gestore templete
        $data['temp'] = array('templete' => $temi, 'contenuto' => $vista, 'bar1' => 'bar_1', 'bar_2' => 'bar_risorse');
        $this->load->view('templetes', $data);
    }
    
    
      function pronte() {
          
         $today = date('Y-m-d');
        if ($this->input->get('hotel_id')) {
            $hotel_id = $this->input->get('hotel_id');
        } else {
            $hotel_id = 1;
        }
        
        
     
                   
       // scegli il templete
        $temi = 'tem_bc';
// carica la vista del contenuto
        $vista = 'camare_pronte';
// gestore templete
        $data['temp'] = array('templete' => $temi, 'contenuto' => $vista, 'bar1' => 'bar_1', 'bar2' => '');
        $this->load->view('templetes', $data);   
    
      }

    function adebbita() {
        // ok funziona
        $prodotti = $this->prodotti_model->prodotto_id($this->input->post('hotel_id'), $this->input->post('prodotto_id'));

        $prezzo = $prodotti['0']->prezzo_prodotto;
        //  $this->input->post()
        $form_adebbiti = array('conto_id' => $this->input->post('conto_id'),
            'hotel_id' => $this->input->post('hotel_id'),
            'prodotto_id' => $this->input->post('prodotto_id'),
            //   'descrizione' => $this->input->post('descrizione'),
            'prezzo' => $prezzo,
            'quantita' => $this->input->post('quantita'),
            'adebiti_utente_id' => $this->input->post('adebiti_utente_id')
        );

        if ($this->adebbiti_model->SaveForm($form_adebbiti) == TRUE) { // the information has therefore been successfully saved in the db
            redirect(base_url() . '/index.php/apphotel/risorsa?conto_id=' . $this->input->post('conto_id') . 'foglio_id=' . $this->input->post('foglio_id') . '&hotel_id=' . $this->input->post('hotel_id') . '');   // or whatever logic needs to occur
        }
    }

    function pulizia() {
// ok funzione
        //  $this->input->post()
        $form_pulizia = array(
//                'pulizia_id' => $this->input->post('pulizia_id'),
            'hotel_id' => $this->input->post('hotel_id'),
            'conto_id' => $this->input->post('conto_id'),
            'camera_id' => $this->input->post('camera_id'),
            'cambio_biancheria' => $this->input->post('cambio_biancheria'),
            'pulizia_stato' => $this->input->post('pulizia_stato'),
            'pulizia_data' => $this->input->post('pulizia_data'),
            'pulizia_note' => $this->input->post('pulizia_note'),
            'utente_id' => $this->input->post('utente_id')
//                'pulizia_data_record' => set_value('pulizia_data_record'
        );

        if ($this->pulizia_model->SaveForm($form_pulizia) == TRUE) { // the information has therefore been successfully saved in the db
            redirect(base_url() . '/index.php/apphotel/risorsa?conto_id=' . $this->input->post('conto_id') . 'foglio_id=' . $this->input->post('foglio_id') . '&hotel_id=' . $this->input->post('hotel_id') . '');   // or whatever logic needs to occur
        }
    }

    function manutenzioni() {
        $form_guasti = array(
            'hotel_id' => $this->input->post('hotel_id'),
            'camera_id' => $this->input->post('camera_id'),
            'guasto_priorita' => $this->input->post('guasto_priorita'),
            'guasto_area' => $this->input->post('guasto_area'),
            'guasto_piano' => $this->input->post('guasto_piano'),
            'guasto_note' => $this->input->post('guasto_note'),
            'guasto_stato' => $this->input->post('guasto_stato'),
            'guasto_data' => $this->input->post('guasto_data'),
            'guasto_utente_id' => $this->input->post('guasto_utente_id')
        );

        if ($this->guasti_model->SaveForm($form_guasti) == TRUE) { // the information has therefore been successfully saved in the db
            redirect(base_url() . '/index.php/apphotel/risorsa?conto_id=' . $this->input->post('conto_id') . 'foglio_id=' . $this->input->post('foglio_id') . '&hotel_id=' . $this->input->post('hotel_id') . '');   // or whatever logic needs to occur
        }
    }

}
