<?php
//  Punti_spesi.php             
class Punti_spesi extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
                $this->load->database();
                $this->load->model('punti_spesi_model');
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
	
        /** list of punti_spesi
         * pagination
         */

//     	public function index()
//	{       
//       
//                $limit = 15; 
//                $this->cont_record =  $this->punti_spesi_model->record_count() ;            
//               
//                $config['base_url'] = base_url().'index.php/punti_spesi';
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
//                $data['rs_punti_spesi'] =   $this->punti_spesi_model->find_limit($limit , $offset);
//               
//		// scegli il templete
//		$temi = 'tem_bcb';
//		// carica la vista del contenuto
//		$vista = 'punti_spesi_list'; 
//		// gestore templete
//                $data['temp'] = array
//                ('templete' => $temi, 
//                'contenuto' => $vista, 
//                'bar_1' => 'bar_1',
//                'bar_2' => 'bar_2',
//                'box_top' => 'box_top' );
//                $this->load->view('templetes', $data);		
//
//                 //$this->load->view('punti_spesi_list.php');    
//                
//	}

	 /**
         * inser data in to punti_spesi
         */

        function insert()
	{			
		$this->form_validation->set_rules('punti_spesi_id', 'lang:punti_spesi_id', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim');			
		$this->form_validation->set_rules('cliente_id', 'lang:cliente_id', 'required|trim');			
		$this->form_validation->set_rules('conto_id', 'lang:conto_id', 'required|trim');			
		$this->form_validation->set_rules('punti', 'lang:punti', 'required|trim|is_numeric');			
		$this->form_validation->set_rules('data', 'lang:data', 'required|trim');			
		$this->form_validation->set_rules('data_record', 'lang:data_record', 'trim');			
		$this->form_validation->set_rules('utente_id', 'lang:utente_id', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'punti_spesi_add';
		// gestore templete

		$data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);		

               //$this->load->view('punti_spesi_add');

		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			 'punti_spesi_id' => set_value('punti_spesi_id'),
			 'hotel_id' => set_value('hotel_id'),
			 'cliente_id' => set_value('cliente_id'),
			 'conto_id' => set_value('conto_id'),
			 'punti' => set_value('punti'),
			 'data' => set_value('data'),
			 'data_record' => set_value('data_record'),
			 'utente_id' => set_value('utente_id')
						);
					
			// run insert model to write data to db
		
			if ($this->punti_spesi_model->insert($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('punti_spesi/?'.$_SERVER['QUERY_STRING'] );   // or whatever logic needs to occur
			}
			else
			{

                            redirect('punti_spesi/?error=noinsert&'.$_SERVER['QUERY_STRING'] );	
			}
		}
	}
	

	 /**
         * edit data in to punti_spesi
         */

        function edit()
            {			
		$this->form_validation->set_rules('punti_spesi_id', 'lang:punti_spesi_id', 'trim');			
		$this->form_validation->set_rules('hotel_id', 'lang:hotel_id', 'required|trim');			
		$this->form_validation->set_rules('cliente_id', 'lang:cliente_id', 'required|trim');			
		$this->form_validation->set_rules('conto_id', 'lang:conto_id', 'required|trim');			
		$this->form_validation->set_rules('punti', 'lang:punti', 'required|trim|is_numeric');			
		$this->form_validation->set_rules('data', 'lang:data', 'required|trim');			
		$this->form_validation->set_rules('data_record', 'lang:data_record', 'trim');			
		$this->form_validation->set_rules('utente_id', 'lang:utente_id', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
                       
                /** function find_by_id('punti_spesi_id')
                * find preno_id
                * @param $form_data - array
                * @return object
                */
                

                $punti_spesi_id = $this->input->get('punti_spesi_id') ; 
                $data['rs_punti_spesi'] =   $this->punti_spesi_model->find_by_id($punti_spesi_id);

		// scegli il templete
		$temi = 'tem_bcb';
		// carica la vista del contenuto
		$vista = 'punti_spesi_edit';
		// gestore templete
                
                $data['temp'] = array
                ('templete' => $temi, 
                'contenuto' => $vista, 
                'bar_1' => 'bar_1',
                'bar_2' => 'bar_2',
                'box_top' => 'box_top' );
                $this->load->view('templetes', $data);

		//$this->load->view('punti_spesi_edit');
			
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			      	'punti_spesi_id' => set_value('punti_spesi_id'),
			      	'hotel_id' => set_value('hotel_id'),
			      	'cliente_id' => set_value('cliente_id'),
			      	'conto_id' => set_value('conto_id'),
			      	'punti' => set_value('punti'),
			      	'data' => set_value('data'),
			      	'data_record' => set_value('data_record'),
			      	'utente_id' => set_value('utente_id')
                    );
					
			// run insert model to write data to db
		
		    $punti_spesi_id = $this->input->get('punti_spesi_id');
			

			if ($this->punti_spesi_model->update($punti_spesi_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				                                  
                                redirect('punti_spesi/index/?'.$_SERVER['QUERY_STRING'] );
			}
			else
			{
                          redirect('punti_spesi/index/?error=noupdata&'.$_SERVER['QUERY_STRING'] );			

			}
		}
	}
	


	function punti_valore() {

        $punti = array(
            '50' => 10,
            '100' => 20,
            '150' => 40,
            '200' => 60,
            '250' => 100,
            '300' => 120,
            '350' => 175,
            '400' => 220,
        );

        return $punti;
    }
}

?>