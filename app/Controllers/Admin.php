<?php

namespace App\Controllers;
use \App\Models\CollectionModel;
use \App\Models\ExhibitModel;

class Admin extends BaseController
{
	protected $helpers = ['url', 'form'];
	
	
	
	public function index(){
		
		$collectionModel = new CollectionModel();
		$exhibitModel = new ExhibitModel();
		
		$data['collections'] = $collectionModel->get_collection();
		$data['exhibits'] = $exhibitModel->get_exhibit();
		$data['title'] = "Admin";
		

		$session = \Config\Services::session();
		$data['session'] = $session;

	
	
		return view('common/header', $data) . view('admin/index', $data) . view('common/footer');
	
	}
}
