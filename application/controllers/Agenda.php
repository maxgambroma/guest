<?php
//  Agenda.php             
class Agenda extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
                $this->load->database();
                $this->load->model('agenda_model');
                $this->load->model('prezzi_disponibilita_model');
                
                 $this->load->model('tex_lingue_model');
                
		$this->load->library('form_validation');
		$this->load->library('table');
                $this->load->library('pagination');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
                $this->load->helper('language'); 
                //$idiom = $this->session->get_userdata('language');             
      
                
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
	

        function insert()
	{			
		$this->form_validation->set_rules('preno_id', 'lang:preno_id', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'trim');			
		$this->form_validation->set_rules('preno_in_data', 'lang:preno_in_data', 'trim');			
		$this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'trim');			
		$this->form_validation->set_rules('preno_impoto_mod', 'lang:preno_impoto_mod', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'required|trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'required|trim');			
		$this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'trim');			
		$this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'trim');			
		$this->form_validation->set_rules('preno_trattamento', 'lang:preno_trattamento', 'trim');			
		$this->form_validation->set_rules('t1', 'lang:t1', 'trim');			
		$this->form_validation->set_rules('q1', 'lang:q1', 'trim');			
		$this->form_validation->set_rules('p1', 'lang:p1', 'trim');			
		$this->form_validation->set_rules('t2', 'lang:t2', 'trim');			
		$this->form_validation->set_rules('q2', 'lang:q2', 'trim');			
		$this->form_validation->set_rules('p2', 'lang:p2', 'trim');			
		$this->form_validation->set_rules('t3', 'lang:t3', 'trim');			
		$this->form_validation->set_rules('q3', 'lang:q3', 'trim');			
		$this->form_validation->set_rules('p3', 'lang:p3', 'trim');			
		$this->form_validation->set_rules('t4', 'lang:t4', 'trim');			
		$this->form_validation->set_rules('q4', 'lang:q4', 'trim');			
		$this->form_validation->set_rules('p4', 'lang:p4', 'trim');			
		$this->form_validation->set_rules('t5', 'lang:t5', 'trim');			
		$this->form_validation->set_rules('q5', 'lang:q5', 'trim');			
		$this->form_validation->set_rules('p5', 'lang:p5', 'trim');			
		$this->form_validation->set_rules('t6', 'lang:t6', 'trim');			
		$this->form_validation->set_rules('q6', 'lang:q6', 'trim');			
		$this->form_validation->set_rules('p6', 'lang:p6', 'trim');			
		$this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'trim');			
		$this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'trim');			
		$this->form_validation->set_rules('preno_agenzia', 'lang:preno_agenzia', 'trim');			
		$this->form_validation->set_rules('voucher_id', 'lang:voucher_id', 'trim');			
		$this->form_validation->set_rules('allotment_id', 'lang:allotment_id', 'trim');			
		$this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'trim');			
		$this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'trim');			
		$this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'trim');			
		$this->form_validation->set_rules('preno_tel', 'lang:preno_tel', 'trim');			
		$this->form_validation->set_rules('preno_fax', 'lang:preno_fax', 'trim');			
		$this->form_validation->set_rules('preno_email', 'lang:preno_email', 'trim');			
		$this->form_validation->set_rules('preno_mercato', 'lang:preno_mercato', 'trim');			
		$this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim');			
		$this->form_validation->set_rules('preno_doc_fax', 'lang:preno_doc_fax', 'trim');			
		$this->form_validation->set_rules('preno_doc_email', 'lang:preno_doc_email', 'trim');			
		$this->form_validation->set_rules('preno_doc_form', 'lang:preno_doc_form', 'trim');			
		$this->form_validation->set_rules('preno_doc_mail', 'lang:preno_doc_mail', 'trim');			
		$this->form_validation->set_rules('preno_doc_vaglia', 'lang:preno_doc_vaglia', 'trim');			
		$this->form_validation->set_rules('preno_doc_woucher', 'lang:preno_doc_woucher', 'trim');			
		$this->form_validation->set_rules('preno_pag_modalita', 'lang:preno_pag_modalita', 'trim');			
		$this->form_validation->set_rules('preno_caparra', 'lang:preno_caparra', 'trim');			
		$this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim');			
		$this->form_validation->set_rules('data_opzione', 'lang:data_opzione', 'trim');			
		$this->form_validation->set_rules('cancella_data_record', 'lang:cancella_data_record', 'trim');			
		$this->form_validation->set_rules('cancella_user', 'lang:cancella_user', 'trim');			
		$this->form_validation->set_rules('cancella_pass', 'lang:cancella_pass', 'trim');			
		$this->form_validation->set_rules('preno_data_record', 'lang:preno_data_record', 'trim');			
		$this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'agenda_add';
		// gestore templete

		$data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);		

               //$this->load->view('agenda_add');

		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			 'preno_id' => set_value('preno_id'),
			 'hotel_id' => set_value('hotel_id'),
			 'preno_in_data' => set_value('preno_in_data'),
			 'preno_importo' => set_value('preno_importo'),
			 'preno_impoto_mod' => set_value('preno_impoto_mod'),
			 'preno_dal' => set_value('preno_dal'),
			 'preno_al' => set_value('preno_al'),
			 'preno_n_notti' => set_value('preno_n_notti'),
			 'preno_arr_ore' => set_value('preno_arr_ore'),
			 'preno_trattamento' => set_value('preno_trattamento'),
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
			 'preno_agenzia' => set_value('preno_agenzia'),
			 'voucher_id' => set_value('voucher_id'),
			 'allotment_id' => set_value('allotment_id'),
			 'preno_cc_tip' => set_value('preno_cc_tip'),
			 'preno_cc_n' => set_value('preno_cc_n'),
			 'preno_cc_scad' => set_value('preno_cc_scad'),
			 'preno_tel' => set_value('preno_tel'),
			 'preno_fax' => set_value('preno_fax'),
			 'preno_email' => set_value('preno_email'),
			 'preno_mercato' => set_value('preno_mercato'),
			 'preno_note' => set_value('preno_note'),
			 'preno_doc_fax' => set_value('preno_doc_fax'),
			 'preno_doc_email' => set_value('preno_doc_email'),
			 'preno_doc_form' => set_value('preno_doc_form'),
			 'preno_doc_mail' => set_value('preno_doc_mail'),
			 'preno_doc_vaglia' => set_value('preno_doc_vaglia'),
			 'preno_doc_woucher' => set_value('preno_doc_woucher'),
			 'preno_pag_modalita' => set_value('preno_pag_modalita'),
			 'preno_caparra' => set_value('preno_caparra'),
			 'preno_stato' => set_value('preno_stato'),
			 'data_opzione' => set_value('data_opzione'),
			 'cancella_data_record' => set_value('cancella_data_record'),
			 'cancella_user' => set_value('cancella_user'),
			 'cancella_pass' => set_value('cancella_pass'),
			 'preno_data_record' => set_value('preno_data_record'),
			 'agenda_utente_id' => set_value('agenda_utente_id')
						);
					
			// run insert model to write data to db
		
			if ($this->agenda_model->insert($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('agenda/?'.$_SERVER['QUERY_STRING'] );   // or whatever logic needs to occur
			}
			else
			{

                            redirect('agenda/?error=noinsert&'.$_SERVER['QUERY_STRING'] );	
			}
		}
	}
	

	 /**
         * edit data in to agenda
         */

        function edit()
            {			
		$this->form_validation->set_rules('preno_id', 'lang:preno_id', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'trim');			
		$this->form_validation->set_rules('preno_in_data', 'lang:preno_in_data', 'trim');			
		$this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'trim');			
		$this->form_validation->set_rules('preno_impoto_mod', 'lang:preno_impoto_mod', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'required|trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'required|trim');			
		$this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'trim');			
		$this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'trim');			
		$this->form_validation->set_rules('preno_trattamento', 'lang:preno_trattamento', 'trim');			
		$this->form_validation->set_rules('t1', 'lang:t1', 'trim');			
		$this->form_validation->set_rules('q1', 'lang:q1', 'trim');			
		$this->form_validation->set_rules('p1', 'lang:p1', 'trim');			
		$this->form_validation->set_rules('t2', 'lang:t2', 'trim');			
		$this->form_validation->set_rules('q2', 'lang:q2', 'trim');			
		$this->form_validation->set_rules('p2', 'lang:p2', 'trim');			
		$this->form_validation->set_rules('t3', 'lang:t3', 'trim');			
		$this->form_validation->set_rules('q3', 'lang:q3', 'trim');			
		$this->form_validation->set_rules('p3', 'lang:p3', 'trim');			
		$this->form_validation->set_rules('t4', 'lang:t4', 'trim');			
		$this->form_validation->set_rules('q4', 'lang:q4', 'trim');			
		$this->form_validation->set_rules('p4', 'lang:p4', 'trim');			
		$this->form_validation->set_rules('t5', 'lang:t5', 'trim');			
		$this->form_validation->set_rules('q5', 'lang:q5', 'trim');			
		$this->form_validation->set_rules('p5', 'lang:p5', 'trim');			
		$this->form_validation->set_rules('t6', 'lang:t6', 'trim');			
		$this->form_validation->set_rules('q6', 'lang:q6', 'trim');			
		$this->form_validation->set_rules('p6', 'lang:p6', 'trim');			
		$this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'trim');			
		$this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'trim');			
		$this->form_validation->set_rules('preno_agenzia', 'lang:preno_agenzia', 'trim');			
		$this->form_validation->set_rules('voucher_id', 'lang:voucher_id', 'trim');			
		$this->form_validation->set_rules('allotment_id', 'lang:allotment_id', 'trim');			
		$this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'trim');			
		$this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'trim');			
		$this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'trim');			
		$this->form_validation->set_rules('preno_tel', 'lang:preno_tel', 'trim');			
		$this->form_validation->set_rules('preno_fax', 'lang:preno_fax', 'trim');			
		$this->form_validation->set_rules('preno_email', 'lang:preno_email', 'trim');			
		$this->form_validation->set_rules('preno_mercato', 'lang:preno_mercato', 'trim');			
		$this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim');			
		$this->form_validation->set_rules('preno_doc_fax', 'lang:preno_doc_fax', 'trim');			
		$this->form_validation->set_rules('preno_doc_email', 'lang:preno_doc_email', 'trim');			
		$this->form_validation->set_rules('preno_doc_form', 'lang:preno_doc_form', 'trim');			
		$this->form_validation->set_rules('preno_doc_mail', 'lang:preno_doc_mail', 'trim');			
		$this->form_validation->set_rules('preno_doc_vaglia', 'lang:preno_doc_vaglia', 'trim');			
		$this->form_validation->set_rules('preno_doc_woucher', 'lang:preno_doc_woucher', 'trim');			
		$this->form_validation->set_rules('preno_pag_modalita', 'lang:preno_pag_modalita', 'trim');			
		$this->form_validation->set_rules('preno_caparra', 'lang:preno_caparra', 'trim');			
		$this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim');			
		$this->form_validation->set_rules('data_opzione', 'lang:data_opzione', 'trim');			
		$this->form_validation->set_rules('cancella_data_record', 'lang:cancella_data_record', 'trim');			
		$this->form_validation->set_rules('cancella_user', 'lang:cancella_user', 'trim');			
		$this->form_validation->set_rules('cancella_pass', 'lang:cancella_pass', 'trim');			
		$this->form_validation->set_rules('preno_data_record', 'lang:preno_data_record', 'trim');			
		$this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
                       
                /** function find_by_id('preno_id')
                * find preno_id
                * @param $form_data - array
                * @return object
                */
                

                $preno_id = $this->input->get('preno_id') ; 
                $data['rs_agenda'] =   $this->agenda_model->find_by_id($preno_id);

		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'agenda_edit';
		// gestore templete
                
                $data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);

		//$this->load->view('agenda_edit');
			
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			      	'preno_id' => set_value('preno_id'),
			      	'hotel_id' => set_value('hotel_id'),
			      	'preno_in_data' => set_value('preno_in_data'),
			      	'preno_importo' => set_value('preno_importo'),
			      	'preno_impoto_mod' => set_value('preno_impoto_mod'),
			      	'preno_dal' => set_value('preno_dal'),
			      	'preno_al' => set_value('preno_al'),
			      	'preno_n_notti' => set_value('preno_n_notti'),
			      	'preno_arr_ore' => set_value('preno_arr_ore'),
			      	'preno_trattamento' => set_value('preno_trattamento'),
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
			      	'preno_agenzia' => set_value('preno_agenzia'),
			      	'voucher_id' => set_value('voucher_id'),
			      	'allotment_id' => set_value('allotment_id'),
			      	'preno_cc_tip' => set_value('preno_cc_tip'),
			      	'preno_cc_n' => set_value('preno_cc_n'),
			      	'preno_cc_scad' => set_value('preno_cc_scad'),
			      	'preno_tel' => set_value('preno_tel'),
			      	'preno_fax' => set_value('preno_fax'),
			      	'preno_email' => set_value('preno_email'),
			      	'preno_mercato' => set_value('preno_mercato'),
			      	'preno_note' => set_value('preno_note'),
			      	'preno_doc_fax' => set_value('preno_doc_fax'),
			      	'preno_doc_email' => set_value('preno_doc_email'),
			      	'preno_doc_form' => set_value('preno_doc_form'),
			      	'preno_doc_mail' => set_value('preno_doc_mail'),
			      	'preno_doc_vaglia' => set_value('preno_doc_vaglia'),
			      	'preno_doc_woucher' => set_value('preno_doc_woucher'),
			      	'preno_pag_modalita' => set_value('preno_pag_modalita'),
			      	'preno_caparra' => set_value('preno_caparra'),
			      	'preno_stato' => set_value('preno_stato'),
			      	'data_opzione' => set_value('data_opzione'),
			      	'cancella_data_record' => set_value('cancella_data_record'),
			      	'cancella_user' => set_value('cancella_user'),
			      	'cancella_pass' => set_value('cancella_pass'),
			      	'preno_data_record' => set_value('preno_data_record'),
			      	'agenda_utente_id' => set_value('agenda_utente_id')
                    );
					
			// run insert model to write data to db
		
		    $preno_id = $this->input->get('preno_id');
			

			if ($this->agenda_model->update($preno_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				                                  
                                redirect('agenda/index/?'.$_SERVER['QUERY_STRING'] );
			}
			else
			{
                          redirect('agenda/index/?error=noupdata&'.$_SERVER['QUERY_STRING'] );			

			}
		}
	}
	
	

/**
 * 
 */        


	function cambia_date() {
         
            
        $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] =  $this->tex_lingue_model->tex_lg($lg);
    
            
            
        $hotel_id = $this->input->get('hotel_id');
        $preno_id = $this->input->get('preno_id');
        $preno_dal = $this->input->get('preno_dal');
        $preno_al = $this->input->get('preno_al');


// trovo la vecchia prenotazione
        $data['preno'] = $preno = $this->agenda_model->find_by_id($preno_id);
// trovo le nuove date 
        $data['preno_new'] = $preno_new = $this->prezzi_disponibilita_model->prezzo_web($hotel_id, $preno_dal, $preno_al, $includi_prezzi = 0);

// trovo il nuovo importo   rchiamado la funzine new_iporto      
        $data['importo'] = $this->new_iporto($preno, $preno_new);

// trovo la disponibilita        
        $data['disponibilita'] = $diso =  $this->new_dispo($preno, $preno_new) ;
        
        $this->load->view('clienti_cambia_date', $data);
        
        
    }

    /**
     * trovo l'importo totale del nuovo perido stessa preno
     * @param type $preno
     * @param type $preno_new
     * @return type
     */
    function new_iporto($preno, $preno_new) {

        $importo = $preno_new['sum_prezzo'][$preno->t1] * $preno->q1 +
                $preno_new['sum_prezzo'][$preno->t2] * $preno->q2 +
                $preno_new['sum_prezzo'][$preno->t3] * $preno->q3 +
                $preno_new['sum_prezzo'][$preno->t4] * $preno->q4 +
                $preno_new['sum_prezzo'][$preno->t5] * $preno->q5 +
                $preno_new['sum_prezzo'][$preno->t6] * $preno->q6;

        //  $today = $preno_dal ;
        // $result =    $this->prezzi_disponibilita_model->prezzo_hotel($hotel_id, $today, $includi_prezzi = 1)  ;

        return $importo;
    }  
        
        /**
     * controllo la disponibilita del nuovo perido stessa PRENO 
     * @param type $preno
     * @param type $preno_new
     * @return type
     */
    function new_dispo($preno, $preno_new) {

        $preno_new['nesting'][0] = 0;
        $preno_new['nesting'][10] = 0;

// minimo camare libere er il periodo 
        $cam_libere = min($preno_new['tot_cam_libere']);

// controllo che ho pui camere rispetto a quelle richieste
        if ($preno->Tot_cam <= $cam_libere) {

// per ogni singola tipologia t1,
            if ($preno->t1 > 0) {
                if (min($preno_new['nesting'][$preno->t1]) >= $preno->q1) {
                    $errore[$preno->t1] = 0;
                } else {
                    $errore[$preno->t1] = 1;
                }
            }
// per ogni singola tipologia t2,
            if ($preno->t2 > 0) {
                if (min($preno_new['nesting'][$preno->t2]) >= $preno->q2) {
                    $errore[$preno->t2] = 0;
                } else {
                    $errore[$preno->t2] = 1;
                }
            }
// per ogni singola tipologia t3,
            if ($preno->t3 > 0) {
                if (min($preno_new['nesting'][$preno->t3]) >= $preno->q3) {
                    $errore[$preno->t3] = 0;
                } else {
                    $errore[$preno->t3] = 1;
                }
            }
// per ogni singola tipologia t4,
            if ($preno->t4 > 0) {
                if (min($preno_new['nesting'][$preno->t4]) >= $preno->q4) {
                    $errore[$preno->t4] = 0;
                } else {
                    $errore[$preno->t4] = 1;
                }
            }
// per ogni singola tipologia t5,
            if ($preno->t5 > 0) {
                if (min($preno_new['nesting'][$preno->t5]) >= $preno->q5) {
                    $errore[$preno->t5] = 0;
                } else {
                    $errore[$preno->t5] = 1;
                }
            }
// per ogni singola tipologia t6,
            if ($preno->t6 > 0) {
                if (min($preno_new['nesting'][$preno->t6]) >= $preno->q6) {
                    $errore[$preno->t6] = 0;
                } else {
                    $errore[$preno->t6] = 1;
                }
            }
        }
// non ho disponibilita 
        else {
            $errore[10] = 1;
        }

        return $errore;
    }

    
    
    /**
     * aggiorna la prenotazione dal form
     */
    
    
    function edit_data_preno() {
        
        
         $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] =  $this->tex_lingue_model->tex_lg($lg);

        

        $this->form_validation->set_rules('disponibilita', 'lang:disponibilita', 'trim|required');
        $this->form_validation->set_rules('preno_id', 'lang:preno_id', 'trim|required');
        $this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'trim|required');
        $this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'trim|required');
        $this->form_validation->set_rules('preno_al', 'lang:preno_al', 'trim|required');
        $this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'trim|required');
        $this->form_validation->set_rules('p1', 'lang:p1', 'trim|required');
        $this->form_validation->set_rules('p2', 'lang:p2', 'trim');
        $this->form_validation->set_rules('p3', 'lang:p3', 'trim');
        $this->form_validation->set_rules('p4', 'lang:p4', 'trim');
        $this->form_validation->set_rules('p5', 'lang:p5', 'trim');
        $this->form_validation->set_rules('p6', 'lang:p6', 'trim');
        ;
        $this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');

        if ($this->form_validation->run() == FALSE && set_value('preno_importo') == 1 && set_value('disponibilita') != 1) { // validation hasn't been passed
            redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '?lg=' . $this->lg);
        } else { // passed validation proceed to post success logic
// build array for the model

            $form_data = array(
// 'preno_id' => set_value('preno_id'),
                'preno_importo' => set_value('preno_importo'),
                'preno_impoto_mod' => set_value('preno_importo'),
                'preno_dal' => set_value('preno_dal'),
                'preno_al' => set_value('preno_al'),
                'preno_n_notti' => set_value('preno_n_notti'),
                'p1' => set_value('p1'),
                'p2' => set_value('p2'),
                'p3' => set_value('p3'),
                'p4' => set_value('p4'),
                'p5' => set_value('p5'),
                'p6' => set_value('p6'),
//  	'agenda_utente_id' => set_value('agenda_utente_id')
            );

// run insert model to write data to db
            $preno_id = set_value('preno_id');
            if ($this->agenda_model->update($preno_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '/?lg=' . $this->lg);
            } else {
                redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '/?lg=' . $this->lg);
            }
        }
    }

    /**
     * cancella la prenotazione 
     * lato cliente
     */
    function cax_preno() {
        
         $data['lg'] = $lg = $this->lg;
        $data['lg_tex'] =  $this->tex_lingue_model->tex_lg($lg);

        

        $this->form_validation->set_rules('preno_id', 'lang:preno_id', 'trim|required');
        // metto il cliente
        $this->form_validation->set_rules('clienti_id', 'lang:cancella_user', 'trim|required');
        $this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim|required');
        $this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'trim');
         $this->form_validation->set_rules('motivo', 'lang:motivo', 'trim');
        
        $this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');

        if ($this->form_validation->run() == FALSE && set_value('preno_stato') != 9) { // validation hasn't been passed
            redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '?lg=' . $this->lg);
        } else { // passed validation proceed to post success logic
// build array for the model
            $form_data = array(
// 'preno_id' => set_value('preno_id'),
                // è il cliente che cancwella
                'cancella_user' => set_value('clienti_id'),
                'preno_stato' => set_value('preno_stato'),
                // metto il cliente id
               // 'agenda_utente_id' => set_value('agenda_utente_id'),
                // metto il motivo
                'cancella_pass' => set_value('motivo')
            );
            
            
            
            
            
            
            

            
            
            

// run insert model to write data to db
            $preno_id = set_value('preno_id');

            if ($this->agenda_model->update($preno_id, $form_data) == TRUE) { // the information has therefore been successfully saved in the db
                redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '/?lg=' . $this->lg);
            } else {
                redirect(base_url() . 'index.php/clienti/bookings/' . $this->input->post('conto_id') . '/' . $this->input->post('clienti_id') . '/?lg=' . $this->lg);
            }
        }
    }

}
?>