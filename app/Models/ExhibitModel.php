<?php

namespace App\Models;

use CodeIgniter\Model;

class ExhibitModel extends Model
{
	protected $table = 'exhibits';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useAutoIncrement = true;
	protected $allowedFields = array('title' , 'slug', 'exhibitor' , 'external_url', 'exhibit_type', 'subjects',
				'short_description', 'on_now', 'on_now_details', 'on_now_dates', 'essay', 'exhibit_year', 'caption0',
				'caption1', 'caption2', 'caption3', 'caption4', 'caption5', 'caption6');
				
	protected $db;
	
	protected $helpers = ['url', 'form'];
	  
	public function __construct()
    {
        parent::__construct();
        // $this->db = \Config\Database::connect();
        
    }

    /**
     * Called during initialization. Appends
     * our custom field to the module's model.
     */
    protected function initialize()
    {		
        
    }
	
	public function get_onnow(){
		
			$data = $this->where(['on_now'=>1])->findAll();
			
			return $data;
	}
	
	public function get_exhibit($slug = FALSE){
		if($slug === FALSE){		
			$query = $this->orderBy('exhibit_year','desc')->orderBy('title','asc')->findAll();			
			return $query;
		}
		
		$query = $this->where('slug', $slug)->first(); 
		
		
		return $query;
	}
	
	
	/**
	* reset what's currently On Now to 0
	*/
	public function set_onnow_exhibit($request){
		// $this->load->helper('url');
		
		$onNow = $request->getVar('on_now');
		
		
		if($onNow==1){
			$exhibit = $this->where('on_now',1)->first();
			$data = ['on_now'=>0];
			
			if(isset($exhibit['id']) && ! is_null($exhibit['id'])){
			return $this->update($exhibit['id'], $data);
			}
			
		}else{
			return true;
		}
	}
	
	/**
	*   Insert into exhibit table
	*/
	public function set_exhibit($request){
		//$this->load->helper('url');

		//$slug = strtolower(url_title($this->input->post('title'), 'dash', TRUE));
		$slug = strtolower(url_title($request->getPost('title'), '-', TRUE));


		$data = array(
			'title' => $request->getPost('title'),
			'slug' => $slug,
			'exhibitor' => $request->getPost('exhibitor'),
			'external_url' => $request->getPost('external_url'),
			'exhibit_type'  => $request->getPost('exhibit_type'),
			'subjects'  => $request->getPost('subjects'),
			'short_description' => $request->getPost('short_description'),
			'on_now' => ($request->getPost('on_now') ?? 0),
			'on_now_details' => $request->getPost('on_now_details'),
			'on_now_dates' => $request->getPost('on_now_dates'),
			'essay' => $request->getPost('essay'),
			'exhibit_year' => $request->getPost('exhibit_year'),
			'caption0' => $request->getPost('caption0'),
			'caption1' => $request->getPost('caption1'),
			'caption2' => $request->getPost('caption2'),
			'caption3' => $request->getPost('caption3'),
			'caption4' => $request->getPost('caption4'),
			'caption5' => $request->getPost('caption5'),
			'caption6' => $request->getPost('caption6')
			);
		
		// if insert is successful
		$this->insert($data, false);
		$insertId = $this->getInsertID();
		return $insertId;
		
	}
	
	
	public function updateExhibit($request, $slug){
	

			$data = array(
			'title' => $request->getPost('title'),
			'slug' => $slug,
			'exhibitor' => $request->getPost('exhibitor'),
			'external_url' => $request->getPost('external_url'),
			'exhibit_type'  => $request->getPost('exhibit_type'),
			'subjects'  => $request->getPost('subjects'),
			'short_description' => $request->getPost('short_description'),
			'on_now' => $request->getPost('on_now'),
			'on_now_details' => $request->getPost('on_now_details'),
			'on_now_dates' => $request->getPost('on_now_dates'),
			'essay' => $request->getPost('essay'),
			'exhibit_year' => $request->getPost('exhibit_year'),
			'caption0' => $request->getPost('caption0'),
			'caption1' => $request->getPost('caption1'),
			'caption2' => $request->getPost('caption2'),
			'caption3' => $request->getPost('caption3'),
			'caption4' => $request->getPost('caption4'),
			'caption5' => $request->getPost('caption5'),
			'caption6' => $request->getPost('caption6')
			);
		$query = $this->where('slug', $slug)->first();
		
	
		return $this->update($query['id'], $data);
	}
	
}