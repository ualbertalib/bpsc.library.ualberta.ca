<?php
class Exhibits extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('exhibit_model');
		$this->load->library('session');
		$this->load->helper('url');

		$this->data['ex_subjects_array'] = array('english-literature', 'american-literature', 'canadian-literature','history-of-the-book','small-presses','art-books','canadian-history','education', 'biological-science','law','religious-studies','native-studies');
		$this->data['ex_types_array'] = array('books', 'journals', 'newspapers', 'letters', 'diaries','manuscripts','reports', 'oversized folio', 'photographs', 'slides', 'video', 'audio', 'maps', 'paintings','artbooks', 'ephemra','artifcats', 'pamphlets');
		$this->load->vars($this->data);
	}
	public function index(){
		$data['exhibits'] = $this->exhibit_model->get_exhibit();
		$data['title'] = "Our exhibits";

		$this->load->view('common/header', $data);
		$this->load->view('exhibits/index', $data);
		$this->load->view('common/footer');
	}
	public function view($slug){
		$data['exhibit_item'] = $this->exhibit_model->get_exhibit($slug);
		if (empty($data['exhibit_item'])){
			show_404();
		}

		$data['title'] = $data['exhibit_item']['title'];
		$data['exhibit_item']['subjects'] = explode(',', $data['exhibit_item']['subjects']);

		$this->load->view('common/header', $data);
		$this->load->view('exhibits/view', $data);
		$this->load->view('common/footer');
	}
	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper('ckeditor');


		$data['upload_error'] =  '';

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('external_url', 'External Url', 'required');
		$this->form_validation->set_rules('short_description', 'Short Description', 'max_length[80]');
		$this->form_validation->set_rules('on_now_details', 'Short Description', 'max_length[160]');

		//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	
				'height' 	=> 	'200px',	
			)
		);

		//check that the form validation passes
		if ($this->form_validation->run() === FALSE){
			$this->load->view('common/header', $data);
			$this->load->view('exhibits/create');
			$this->load->view('common/footer');
		}else{
			$cleantitle = strtolower(url_title($this->input->post('title')));

			$config['upload_path'] = './assets/uploads/display';
            $config['allowed_types'] = 'jpg|png';               
            $config['file_name'] = $cleantitle;
            $config['max_size'] = '800'; 
            $this->upload->initialize($config); 
            $field_name ="exdisplay";
            if (!$this->upload->do_upload($field_name)){
             	$data['upload_error'] = $this->upload->display_errors(); 

            	$this->load->view('common/header', $data);
				$this->load->view('exhibits/create', $data);
				$this->load->view('common/footer');
			}else{
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
				$this->load->view('exhibits/create', $data);
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
				$this->exhibit_model->set_onnow_exhibit();
				$this->exhibit_model->set_exhibit();
				$this -> session -> set_flashdata('message', 'Your exhibit was created.');

    			redirect('exhibits');
    		}
		}
	}
	public function edit($slug){
		$data['exhibit_item'] = $this->exhibit_model->get_exhibit($slug);
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');

		$data['title'] = 'Update Link to an Online Exhibit';
		$slug = $slug;

		$this->form_validation->set_rules('title', 'Title', 'required');


		if ($this->form_validation->run() === FALSE){
			$this->load->view('common/header', $data);
			$this->load->view('exhibits/edit');
			$this->load->view('common/footer');
		}
		else{
			$this->exhibit_model->set_onnow_exhibit();
			$this->exhibit_model->update_exhibit($id);
			$this -> session -> set_flashdata('message', 'Your exhibit was updated.');

    		redirect('admin');
		}
	}
	public function delete($slug){
		$this->load->database();
		$this->load->helper('url');
        $this->db->delete('exhibits', array('slug' => $slug));
        $this -> session -> set_flashdata('message', 'This exhibit was deleted.');

    	redirect('admin');

	}
}