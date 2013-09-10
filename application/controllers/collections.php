<?php
class Collections extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('collection_model');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('ion_auth');

		$this->data['subjects_array'] = array('english-literature', 'american-literature', 'canadian-literature','history-of-the-book','small-presses','art-books','canadian-history','education', 'biological-science','law','religious-studies','native-studies');
		$this->data['types_array'] = array('books', 'journals', 'newspapers', 'letters', 'diaries','manuscripts','reports', 'oversized folio', 'photographs', 'slides', 'video', 'audio', 'maps', 'paintings','artbooks', 'ephemra','artifcats', 'pamphlets');
		$this->load->vars($this->data);
	}
	public function index(){
		$data['collections'] = $this->collection_model->get_collection();
		$data['title'] = "Our Collections";
	
		$this->load->view('common/header', $data);
		$this->load->view('collections/index', $data);
		$this->load->view('common/footer');
	}
	public function view($slug){
		$data['collection_item'] = $this->collection_model->get_collection($slug);
		if (empty($data['collection_item'])){
			show_404();
		}

		$data['title'] = $data['collection_item']['title'];

		$data['collection_item']['subjects'] = explode(',', $data['collection_item']['subjects']);
		
		$this->load->view('common/header', $data);
		$this->load->view('collections/view', $data);
		$this->load->view('common/footer');
	}
	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper('ckeditor');

		$data['title'] = 'Create a collection';
		$data['upload_error'] =  '';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('short_description', 'Short Description', 'max_length[80]');

		//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	
				'height' 	=> 	'200px',	
			)
		);

	if (!$this->ion_auth->logged_in())
		{
			redirect('/login');
	}else{	
    
		//check that the form validation passes
		if ($this->form_validation->run() === FALSE){
			$this->load->view('common/header', $data);
			$this->load->view('collections/create');
			$this->load->view('common/footer');
		}
		else{
			$cleantitle = strtolower(url_title($this->input->post('title')));

			$config['upload_path'] = './assets/uploads/display';
            $config['allowed_types'] = 'jpg|png';               
            $config['file_name'] = $cleantitle;
            $config['max_size'] = '800'; 
            $this->upload->initialize($config); 
            $field_name ="display";
            if (!$this->upload->do_upload($field_name)){
             	$data['upload_error'] = $this->upload->display_errors(); 

            	$this->load->view('common/header', $data);
				$this->load->view('collections/create', $data);
				$this->load->view('common/footer');
			}

            $config['upload_path'] = './assets/uploads/slides';
            $config['allowed_types'] = 'jpg|png';               
          
            $config['max_size'] = '1200'; 
            $this->upload->initialize($config); 
              for($i = 1; $i < 6; $i++) {
        		/* Handle the file upload */
        		$upload = $this->upload->do_upload('slide'.$i);
        		/* File failed to upload - continue */
        		if($upload === FALSE) continue;
        		/* Get the data about the file */
			}
			
        
				$this->collection_model->set_collection();
				$this -> session -> set_flashdata('message', 'Your collection was created.');
			
    			redirect('collections');
    		}
		}
	}
	public function edit($slug){
		$data['collection_item'] = $this->collection_model->get_collection($slug);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('ckeditor');
		$this->load->library('upload');

		$data['title'] = 'Update collection';
		$data['upload_error'] = '';
		$slug = $slug;


		$this->form_validation->set_rules('title', 'Title', 'required');
			//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Basic", 	
				'height' 	=> 	'200px',	
			)
		);

	if (!$this->ion_auth->logged_in()){
			redirect('/login');
	}else{	
		if ($this->form_validation->run() === FALSE){
			$this->load->view('common/header', $data);
			$this->load->view('collections/edit');
			$this->load->view('common/footer');
		}else{
			$config['upload_path'] = './assets/uploads/display';
            $config['allowed_types'] = 'jpg|png';               
            $config['file_name'] = $slug;
            $config['max_size'] = '800'; 
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config); 
            $field_name ="display";
            if (!$this->upload->do_upload($field_name)){
             	$data['upload_error'] = $this->upload->display_errors(); 

            	$this->load->view('common/header', $data);
				$this->load->view('collections/edit', $data);
				$this->load->view('common/footer');
			}
			$this->collection_model->update_collection($slug);
			$this -> session -> set_flashdata('message', 'Your collection was updated.');
			
    		redirect('admin');
		}
	}
}
	public function deleteImage($slug){
		$path_to_file = 'assets/uploads/display/'.$slug.'.jpg';
		if(unlink($path_to_file)) {
     		echo 'deleted successfully';
     		redirect('collections/edit/'.$slug);
		}
		else{
     		echo 'errors occured';
		}		
	}
	public function delete($slug){

	if (!$this->ion_auth->logged_in())
		{
			redirect('/login');
	}else{	
		$this->load->database();
		$this->load->helper('url');
        $this->db->delete('collections', array('slug' => $slug));
        $this -> session -> set_flashdata('message', 'This collection was deleted.');
			
    	redirect('admin');
    }

	}
}