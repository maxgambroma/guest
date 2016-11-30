<?php
//  Log_obmp.php             
class Log_obmp extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
                $this->load->database();
                $this->load->model('log_obmp_model');
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
	
        /** list of log_obmp
         * pagination
         */

     	public function index()
	{       
       
                $limit = 15; 
                $this->cont_record =  $this->log_obmp_model->record_count() ;            
               
                $config['base_url'] = base_url().'index.php/log_obmp';
                $config['total_rows'] =  $this->cont_record ;
                $config['per_page'] =    $limit ;  // limit
                $config['page_query_string'] = TRUE;
                $config['full_tag_open'] = '<div id="pagination" class="pagination">';
                $config['full_tag_close'] = '</div>';
                $pagination =   $this->pagination->initialize($config);
                $data['pagination'] = $this->pagination->create_links();
                
                if( $this->input->get('per_page'))
                {
                    $offset = $this->input->get('per_page');
                }
                else {
                     $offset = 0 ;
                }
                
                $data['rs_log_obmp'] =   $this->log_obmp_model->find_limit($limit , $offset);
               
		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'log_obmp_list'; 
		// gestore templete
                $data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);		

                 //$this->load->view('log_obmp_list.php');    
                
	}

	 /**
         * inser data in to log_obmp
         */

        function insert()
	{			
		$this->form_validation->set_rules('log_obmp_id', 'lang:log_obmp_id', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'trim');			
		$this->form_validation->set_rules('Q1', 'lang:Q1', 'trim');			
		$this->form_validation->set_rules('T1', 'lang:T1', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'trim');			
		$this->form_validation->set_rules('ref_site', 'lang:ref_site', 'trim');			
		$this->form_validation->set_rules('ref_agency', 'lang:ref_agency', 'trim');			
		$this->form_validation->set_rules('ref_event', 'lang:ref_event', 'trim');			
		$this->form_validation->set_rules('ref_session', 'lang:ref_session', 'trim');			
		$this->form_validation->set_rules('ref_cookie', 'lang:ref_cookie', 'trim');			
		$this->form_validation->set_rules('mygooglekeyword', 'lang:mygooglekeyword', 'trim');			
		$this->form_validation->set_rules('log_obmp_daterecord', 'lang:log_obmp_daterecord', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'log_obmp_add';
		// gestore templete

		$data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);		

               //$this->load->view('log_obmp_add');

		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			 'log_obmp_id' => set_value('log_obmp_id'),
			 'preno_dal' => set_value('preno_dal'),
			 'preno_al' => set_value('preno_al'),
			 'Q1' => set_value('Q1'),
			 'T1' => set_value('T1'),
			 'hotel_id' => set_value('hotel_id'),
			 'ref_site' => set_value('ref_site'),
			 'ref_agency' => set_value('ref_agency'),
			 'ref_event' => set_value('ref_event'),
			 'ref_session' => set_value('ref_session'),
			 'ref_cookie' => set_value('ref_cookie'),
			 'mygooglekeyword' => set_value('mygooglekeyword'),
			 'log_obmp_daterecord' => set_value('log_obmp_daterecord')
						);
					
			// run insert model to write data to db
		
			if ($this->log_obmp_model->insert($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('log_obmp/?'.$_SERVER['QUERY_STRING'] );   // or whatever logic needs to occur
			}
			else
			{

                            redirect('log_obmp/?error=noinsert&'.$_SERVER['QUERY_STRING'] );	
			}
		}
	}
	

	 /**
         * edit data in to log_obmp
         */

        function edit()
            {			
		$this->form_validation->set_rules('log_obmp_id', 'lang:log_obmp_id', 'trim');			
		$this->form_validation->set_rules('preno_dal', 'lang:preno_dal', 'trim');			
		$this->form_validation->set_rules('preno_al', 'lang:preno_al', 'trim');			
		$this->form_validation->set_rules('Q1', 'lang:Q1', 'trim');			
		$this->form_validation->set_rules('T1', 'lang:T1', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'trim');			
		$this->form_validation->set_rules('ref_site', 'lang:ref_site', 'trim');			
		$this->form_validation->set_rules('ref_agency', 'lang:ref_agency', 'trim');			
		$this->form_validation->set_rules('ref_event', 'lang:ref_event', 'trim');			
		$this->form_validation->set_rules('ref_session', 'lang:ref_session', 'trim');			
		$this->form_validation->set_rules('ref_cookie', 'lang:ref_cookie', 'trim');			
		$this->form_validation->set_rules('mygooglekeyword', 'lang:mygooglekeyword', 'trim');			
		$this->form_validation->set_rules('log_obmp_daterecord', 'lang:log_obmp_daterecord', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
                       
                /** function find_by_id('log_obmp_id')
                * find preno_id
                * @param $form_data - array
                * @return object
                */
                

                $log_obmp_id = $this->input->get('log_obmp_id') ; 
                $data['rs_log_obmp'] =   $this->log_obmp_model->find_by_id($log_obmp_id);

		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'log_obmp_edit';
		// gestore templete
                
                $data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);

		//$this->load->view('log_obmp_edit');
			
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			      	'log_obmp_id' => set_value('log_obmp_id'),
			      	'preno_dal' => set_value('preno_dal'),
			      	'preno_al' => set_value('preno_al'),
			      	'Q1' => set_value('Q1'),
			      	'T1' => set_value('T1'),
			      	'hotel_id' => set_value('hotel_id'),
			      	'ref_site' => set_value('ref_site'),
			      	'ref_agency' => set_value('ref_agency'),
			      	'ref_event' => set_value('ref_event'),
			      	'ref_session' => set_value('ref_session'),
			      	'ref_cookie' => set_value('ref_cookie'),
			      	'mygooglekeyword' => set_value('mygooglekeyword'),
			      	'log_obmp_daterecord' => set_value('log_obmp_daterecord')
                    );
					
			// run insert model to write data to db
		
		    $log_obmp_id = $this->input->get('log_obmp_id');
			

			if ($this->log_obmp_model->update($log_obmp_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				                                  
                                redirect('log_obmp/index/?'.$_SERVER['QUERY_STRING'] );
			}
			else
			{
                          redirect('log_obmp/index/?error=noupdata&'.$_SERVER['QUERY_STRING'] );			

			}
		}
	}
	
	 /**
         * delete record by to log_obmp
         */

       function delete()
       {
          
        $log_obmp_id = $this->input->post('log_obmp_id');
       
            if( $this->input->post('CAX') == 10 && isset($log_obmp_id ) ) {
              $this->log_obmp_model->delete($log_obmp_id);
              redirect('log_obmp/index/?'.$_SERVER['QUERY_STRING'] );

                }  
        else{

            redirect('log_obmp/edit/?error=nodelete&'.$_SERVER['QUERY_STRING'] );	

            }               
           
       }

	function success()
	{
            echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
	    sessions have not been used and would need to be added in to suit your app';
	}
}
?>
