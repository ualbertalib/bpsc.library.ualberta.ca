<?php

namespace App\Controllers;

class Fellowship extends BaseController
{
	  protected $helpers = ['url', 'form'];
	  
	
	public function index()
    {
		//$session = \Config\Services::session();
	
		
	  $data = [];
		//return view('fellowship/index', $data);

		return view('common/header', $data) . view('fellowship/index', $data) . view('common/footer');
		
		
    }
	

}
