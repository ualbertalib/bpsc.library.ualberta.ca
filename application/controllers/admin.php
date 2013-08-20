<?php
class Admin extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('collection_model');
		$this->load->model('exhibit_model');
		$this->load->library('session');
		$this->load->library('ion_auth');
		$this->load->helper('url');
	}
	public function index(){

		$data['collections'] = $this->collection_model->get_collection();
		$data['exhibits'] = $this->exhibit_model->get_exhibit();
		$data['title'] = "Admin";
	
		if (!$this->ion_auth->logged_in())
		{
			redirect('/login');
		}
		else{
			$this->load->view('common/header', $data);
			$this->load->view('admin/index', $data);
			$this->load->view('common/footer');
		}	
	}
}