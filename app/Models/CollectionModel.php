<?php

namespace App\Models;

use CodeIgniter\Model;

class CollectionModel extends Model
{
	
	protected $helpers = ['url', 'form'];
	
	protected $table = 'collections';
	protected $primaryKey = 'id';
	protected $returnType = 'array';
	protected $useAutoIncrement = true;
	
			
	protected $allowedFields = array('title' , 'slug', 'collector' , 'external_url', 'catalogue_id', 'collection_type',	'subjects', 'short_description', 'on_now_dates', 'essay','caption0', 'caption1', 'caption2', 'caption3', 'caption4', 'caption5', 'caption6');
				
	

	public function __construct()
    {
        parent::__construct();
        
    }

	public function get_collection($slug = FALSE){
		if($slug === FALSE){
			$result = $this->orderBy("title", "acs")->findAll();			
			return $result;
		}
		$result = $this->where(array('slug' => $slug))->first();
		
		
		return $result;
	}
	
	
	public function get_search($match) {
  		
		$db = db_connect();
		$builder = $db->table('collections');
		$builder->like('title', $match);
		$builder->orLike('essay', $match);
		$builder->orLike('collection_type', $match);

		
		//$sql = $builder->getCompiledSelect();

		$result = $builder->get()->getResultArray();
		
		/*$this->db->like('title',$match);
  		$this->db->or_like('essay',$match);
  		$this->db->or_like('collection_type',$match);
  		$query = $this->db->get('collections');*/
  		return $result;
	}
	
	public function set_collection($request){
	
		$slug = strtolower(url_title($request->getPost('title'), '-'));

		$data = array(
			'title' => $request->getPost('title'),
			'slug' => $slug,
			'collector' => $request->getPost('collector'),
			'external_url' => $request->getPost('external_url'),
			'catalogue_id' => $request->getPost('catalogue_id'),
			'collection_type' => $request->getPost('collection_type'),
			'subjects' => $request->getPost('subjects'),
			'short_description' => $request->getPost('short_description'),
			'essay' => $request->getPost('essay'),
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


	public function update_collection($slug, $request){
		
		$data = array(
			'title' => $request->getPost('title'),
			'slug' => $slug,
			'collector' => $request->getPost('collector'),
			'external_url' => $request->getPost('external_url'),
			'catalogue_id' => $request->getPost('catalogue_id'),
			'collection_type' => $request->getPost('collection_type'),
			'subjects' => $request->getPost('subjects'),
			'short_description' => $request->getPost('short_description'),
			'essay' => $request->getPost('essay'),
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