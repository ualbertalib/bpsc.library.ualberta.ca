<?php
class Collection_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function get_collection($slug = FALSE){
		if($slug === FALSE){
			$query = $this->db->get('collections');
			return $query->result_array();
		}
		$query = $this->db->get_where('collections', array('slug' => $slug));
		return $query->row_array();
	}
	public function set_collection(){
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'collector' => $this->input->post('collector'),
			'external_url' => $this->input->post('external_url'),
			'catalogue_id' => $this->input->post('catalogue_id'),
			'collection_type' => $this->input->post('collection_type'),
			'subjects' => $this->input->post('subjects'),
			'short_description' => $this->input->post('short_description'),
			'essay' => $this->input->post('essay')
			);
		return $this->db->insert('collections', $data);
	}
	public function update_collection($slug){
		$this->load->helper('url');

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'collector' => $this->input->post('collector'),
			'external_url' => $this->input->post('external_url'),
			'catalogue_id' => $this->input->post('catalogue_id'),
			'collection_type' => $this->input->post('collection_type'),
			'subjects' => $this->input->post('subjects'),
			'short_description' => $this->input->post('short_description'),
			'essay' => $this->input->post('essay')
			);
		$this->db->where('slug', $slug);
		return $this->db->update('collections', $data);
	}
}