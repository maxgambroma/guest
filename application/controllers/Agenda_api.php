<?php
//  Agenda.php             
class Agenda extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
                $this->load->database();
                $this->load->model('agenda_model');
		$this->load->library('form_validation');
		$this->load->library('table');
                $this->load->library('pagination');
		$this->load->helper('form');
		$this->load->helper('url');
		$this->load->helper('security');
                $this->load->helper('language'); 
                //$idiom = $this->session->get_userdata('language');             
                $idiom = 'english';
                $this->lang->load('form_lang', $idiom);
                
	}	
	
        /** list of agenda
         * pagination
         */

//     	public function index()
//	{       
//       
//                $limit = 15; 
//                $this->cont_record =  $this->agenda_model->record_count() ;            
//               
//                $config['base_url'] = base_url().'index.php/agenda';
//                $config['total_rows'] =  $this->cont_record ;
//                $config['per_page'] =    $limit ;  // limit
//                $config['page_query_string'] = TRUE;
//                $config['full_tag_open'] = '<div id="pagination" class="pagination">';
//                $config['full_tag_close'] = '</div>';
//                $pagination =   $this->pagination->initialize($config);
//                $data['pagination'] = $this->pagination->create_links();
//                
//                if( $this->input->get('per_page'))
//                {
//                    $offset = $this->input->get('per_page');
//                }
//                else {
//                     $offset = 0 ;
//                }
//                
//                $data['rs_agenda'] =   $this->agenda_model->find_limit($limit , $offset);
//               
//		// scegli il templete
//		$temi = 'tem_bcb';
//		// carica la vista del contenuto
//		$vista = 'agenda_list'; 
//		// gestore templete
//                $data['temp'] = array
//                ('templete' => $temi, 
//                'contenuto' => $vista, 
//                'bar_1' => 'bar_1',
//                'bar_2' => 'bar_2',
//                'box_top' => 'box_top' );
//                $this->load->view('templetes', $data);		
//
//                 //$this->load->view('agenda_list.php');    
//                
//	}

	 /**
         * inser data in to agenda
         */

        function insert()
	{			
		
            
            
              		
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim');			
		$this->form_validation->set_rules('preno_in_data', 'lang:preno_in_data', 'required|trim');			
		$this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'required|trim');			
		$this->form_validation->set_rules('preno_impoto_mod', 'lang:preno_impoto_mod', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'required|trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'required|trim');			
		$this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'required|trim');			
		$this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'required|trim');			
		$this->form_validation->set_rules('preno_trattamento', 'lang:preno_trattamento', 'required|trim');			
		$this->form_validation->set_rules('t1', 'lang:t1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q1', 'lang:q1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p1', 'lang:p1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t2', 'lang:t2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q2', 'lang:q2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p2', 'lang:p2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t3', 'lang:t3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q3', 'lang:q3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p3', 'lang:p3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t4', 'lang:t4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q4', 'lang:q4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p4', 'lang:p4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t5', 'lang:t5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q5', 'lang:q5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p5', 'lang:p5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t6', 'lang:t6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q6', 'lang:q6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p6', 'lang:p6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'required|trim|xss_clean');			
		$this->form_validation->set_rules('preno_agenzia', 'lang:preno_agenzia', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('voucher_id', 'lang:voucher_id', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('allotment_id', 'lang:allotment_id', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_tel', 'lang:preno_tel', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_fax', 'lang:preno_fax', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_email', 'lang:preno_email', 'trim|xss_clean|valid_email');			
		$this->form_validation->set_rules('preno_mercato', 'lang:preno_mercato', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_fax', 'lang:preno_doc_fax', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_email', 'lang:preno_doc_email', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_form', 'lang:preno_doc_form', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_mail', 'lang:preno_doc_mail', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_vaglia', 'lang:preno_doc_vaglia', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_woucher', 'lang:preno_doc_woucher', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_pag_modalita', 'lang:preno_pag_modalita', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_caparra', 'lang:preno_caparra', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim|xss_clean');			
		$this->form_validation->set_rules('data_opzione', 'lang:data_opzione', 'trim|xss_clean');			
		$this->form_validation->set_rules('cancella_data_record', 'lang:cancella_data_record', 'trim|xss_clean');			
		$this->form_validation->set_rules('cancella_user', 'lang:cancella_user', 'trim');			
		$this->form_validation->set_rules('cancella_pass', 'lang:cancella_pass', 'trim');					
		$this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'required|trim');
			
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
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim');			
		$this->form_validation->set_rules('preno_in_data', 'lang:preno_in_data', 'required|trim');			
		$this->form_validation->set_rules('preno_importo', 'lang:preno_importo', 'required|trim');			
		$this->form_validation->set_rules('preno_impoto_mod', 'lang:preno_impoto_mod', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'required|trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'required|trim');			
		$this->form_validation->set_rules('preno_n_notti', 'lang:preno_n_notti', 'required|trim');			
		$this->form_validation->set_rules('preno_arr_ore', 'lang:preno_arr_ore', 'required|trim');			
		$this->form_validation->set_rules('preno_trattamento', 'lang:preno_trattamento', 'required|trim');			
		$this->form_validation->set_rules('t1', 'lang:t1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q1', 'lang:q1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p1', 'lang:p1', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t2', 'lang:t2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q2', 'lang:q2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p2', 'lang:p2', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t3', 'lang:t3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q3', 'lang:q3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p3', 'lang:p3', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t4', 'lang:t4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q4', 'lang:q4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p4', 'lang:p4', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t5', 'lang:t5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q5', 'lang:q5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p5', 'lang:p5', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('t6', 'lang:t6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('q6', 'lang:q6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('p6', 'lang:p6', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('preno_nome', 'lang:preno_nome', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cogno', 'lang:preno_cogno', 'required|trim|xss_clean');			
		$this->form_validation->set_rules('preno_agenzia', 'lang:preno_agenzia', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('voucher_id', 'lang:voucher_id', 'trim|xss_clean|is_numeric');			
		$this->form_validation->set_rules('allotment_id', 'lang:allotment_id', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_tip', 'lang:preno_cc_tip', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_n', 'lang:preno_cc_n', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_cc_scad', 'lang:preno_cc_scad', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_tel', 'lang:preno_tel', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_fax', 'lang:preno_fax', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_email', 'lang:preno_email', 'trim|xss_clean|valid_email');			
		$this->form_validation->set_rules('preno_mercato', 'lang:preno_mercato', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_note', 'lang:preno_note', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_fax', 'lang:preno_doc_fax', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_email', 'lang:preno_doc_email', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_form', 'lang:preno_doc_form', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_mail', 'lang:preno_doc_mail', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_vaglia', 'lang:preno_doc_vaglia', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_doc_woucher', 'lang:preno_doc_woucher', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_pag_modalita', 'lang:preno_pag_modalita', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_caparra', 'lang:preno_caparra', 'trim|xss_clean');			
		$this->form_validation->set_rules('preno_stato', 'lang:preno_stato', 'trim|xss_clean');			
		$this->form_validation->set_rules('data_opzione', 'lang:data_opzione', 'trim|xss_clean');			
		$this->form_validation->set_rules('cancella_data_record', 'lang:cancella_data_record', 'trim|xss_clean');			
		$this->form_validation->set_rules('cancella_user', 'lang:cancella_user', 'trim');			
		$this->form_validation->set_rules('cancella_pass', 'lang:cancella_pass', 'trim');			
		$this->form_validation->set_rules('preno_data_record', 'lang:preno_data_record', 'trim');			
		$this->form_validation->set_rules('agenda_utente_id', 'lang:agenda_utente_id', 'required|trim');
			
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
         * delete record by to agenda
         */

       function delete()
       {
          
        $preno_id = $this->input->post('preno_id');
       
            if( $this->input->post('CAX') == 10 && isset($preno_id ) ) {
              $this->agenda_model->delete($preno_id);
              redirect('agenda/index/?'.$_SERVER['QUERY_STRING'] );

                }  
        else{

            redirect('agenda/edit/?error=nodelete&'.$_SERVER['QUERY_STRING'] );	

            }               
           
       }

	function success()
	{
            echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
	    sessions have not been used and would need to be added in to suit your app';
	}
}
?>