<?php
//  Tex_lingue.php             
class Tex_lingue extends CI_Controller {
               
	function __construct()
	{
 		parent::__construct();
                $this->load->database();
                $this->load->model('tex_lingue_model');
                
                
                 $this->load->model('clienti_model');
        $this->load->model('hotel_model');
        $this->load->model('agenda_model');
        $this->load->model('tipologia_camera_model');
        $this->load->model('obmp_review_model');
         $this->load->model('conti_model');
                
                
                
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
                
                
                
                
//                $idiom = 'english';
                $this->lang->load('form_lang', $idiom);
                
	}	
	
        /** list of tex_lingue
         * pagination
         */

     	public function index()
	{       
       
            
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
            
            
                $limit = 300; 
                $this->cont_record =  $this->tex_lingue_model->record_count() ;            
               
                $config['base_url'] = base_url().'index.php/tex_lingue';
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
                
                $data['rs_tex_lingue'] =   $this->tex_lingue_model->find_limit($limit , $offset);
               
//		// scegli il templete
//		$temi = 'tem_full';
//		// carica la vista del contenuto
//		$vista = 'tex_lingue_list'; 
//		// gestore templete
//                $data['temp'] = array
//                ('templete' => $temi, 
//                'contenuto' => $vista, 
//                'bar_1' => 'bar_1',
//                'bar_2' => 'bar_2',
//                'box_top' => 'box_top' );
//                $this->load->view('templetes_guest', $data);		

                 $this->load->view('tex_lingue_list.php', $data);    
                
	}

	 /**
         * inser data in to tex_lingue
         */

        function insert()
	{			
		
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
            
            
            
                $this->form_validation->set_rules('tex_lingue_id', 'lang:tex_lingue_id', 'trim');			
		$this->form_validation->set_rules('etichetta_lg', 'lang:etichetta_lg', 'required|trim');			
		$this->form_validation->set_rules('en', 'lang:en', 'required|trim|xss_clean');			
		$this->form_validation->set_rules('it', 'lang:it', 'required|trim|xss_clean');			
		$this->form_validation->set_rules('es', 'lang:es', 'trim|xss_clean');			
		$this->form_validation->set_rules('fr', 'lang:fr', 'trim|xss_clean');			
		$this->form_validation->set_rules('de', 'lang:de', 'trim|xss_clean');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span> <br />');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
			
//		// scegli il templete
//		$temi = 'tem_full';
//		// carica la vista del contenuto
//		$vista = 'tex_lingue_add';
//		// gestore templete
//
//		$data['temp'] = array
//                ('templete' => $temi, 
//                'contenuto' => $vista, 
//                'bar_1' => 'bar_1',
//                'bar_2' => 'bar_2',
//                'box_top' => 'box_top' );
//                $this->load->view('templetes_guest', $data);		

               $this->load->view('tex_lingue_add', $data );

		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			 'tex_lingue_id' => set_value('tex_lingue_id'),
			 'etichetta_lg' => set_value('etichetta_lg'),
			 'en' => set_value('en'),
			 'it' => set_value('it'),
			 'es' => set_value('es'),
			 'fr' => set_value('fr'),
			 'de' => set_value('de')
						);
					
			// run insert model to write data to db
		
			if ($this->tex_lingue_model->insert($form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				redirect('tex_lingue/?'.$_SERVER['QUERY_STRING'] );   // or whatever logic needs to occur
			}
			else
			{

                            redirect('tex_lingue/?error=noinsert&'.$_SERVER['QUERY_STRING'] );	
			}
		}
	}
	

	 /**
         * edit data in to tex_lingue
         */

        function edit()
            {			
		
            
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
            
                $this->form_validation->set_rules('tex_lingue_id', 'lang:tex_lingue_id', 'trim');			
		$this->form_validation->set_rules('etichetta_lg', 'lang:etichetta_lg', 'required|trim');			
		$this->form_validation->set_rules('en', 'lang:en', 'required|trim');			
		$this->form_validation->set_rules('it', 'lang:it', 'required|trim');			
		$this->form_validation->set_rules('es', 'lang:es', 'trim');			
		$this->form_validation->set_rules('fr', 'lang:fr', 'trim');			
		$this->form_validation->set_rules('de', 'lang:de', 'trim');
			
		$this->form_validation->set_error_delimiters('<span class="error">', '</span><br /> ');
	
		if ($this->form_validation->run() == FALSE) // validation hasn't been passed
		{
                       
                /** function find_by_id('tex_lingue_id')
                * find preno_id
                * @param $form_data - array
                * @return object
                */
                

                $tex_lingue_id = $this->input->get('tex_lingue_id') ; 
                $data['rs_tex_lingue'] =   $this->tex_lingue_model->find_by_id($tex_lingue_id);

//		// scegli il templete
//		$temi = 'tem_full';
//		// carica la vista del contenuto
//		$vista = 'tex_lingue_edit';
//		// gestore templete
//                
//                $data['temp'] = array
//                ('templete' => $temi, 
//                'contenuto' => $vista, 
//                'bar_1' => 'bar_1',
//                'bar_2' => 'bar_2',
//                'box_top' => 'box_top' );
//                $this->load->view('templetes_guest', $data);

		$this->load->view('tex_lingue_edit', $data);
			
		}
		else // passed validation proceed to post success logic
		{
		 	// build array for the model
			
			$form_data = array(
			      	'tex_lingue_id' => set_value('tex_lingue_id'),
			      	'etichetta_lg' => set_value('etichetta_lg'),
			      	'en' => set_value('en'),
			      	'it' => set_value('it'),
			      	'es' => set_value('es'),
			      	'fr' => set_value('fr'),
			      	'de' => set_value('de')
                    );
					
			// run insert model to write data to db
		
		    $tex_lingue_id = $this->input->get('tex_lingue_id');
			

			if ($this->tex_lingue_model->update($tex_lingue_id, $form_data) == TRUE) // the information has therefore been successfully saved in the db
			{
				                                  
                                redirect('tex_lingue/index/?'.$_SERVER['QUERY_STRING'] );
			}
			else
			{
                          redirect('tex_lingue/index/?error=noupdata&'.$_SERVER['QUERY_STRING'] );			

			}
		}
	}
	
	 /**
         * delete record by to tex_lingue
         */

       function delete()
       {
          
           
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
           
           
        $tex_lingue_id = $this->input->post('tex_lingue_id');
       
            if( $this->input->post('CAX') == 10 && isset($tex_lingue_id ) ) {
              $this->tex_lingue_model->delete($tex_lingue_id);
              redirect('tex_lingue/index/?'.$_SERVER['QUERY_STRING'] );

                }  
        else{

            redirect('tex_lingue/edit/?error=nodelete&'.$_SERVER['QUERY_STRING'] );	

            }               
           
       }

	function success()
	{
            echo 'this form has been successfully submitted with all validation being passed. All messages or logic here. Please note
	    sessions have not been used and would need to be added in to suit your app';
	}
}
?>