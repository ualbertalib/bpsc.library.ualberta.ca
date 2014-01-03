<?php
class Exhibit_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}
	public function get_exhibit($slug = FALSE){
		if($slug === FALSE){
			$query = $this->db->get('exhibits');
			return $query->result_array();
		}
		$query = $this->db->get_where('exhibits', array('slug' => $slug));
		return $query->row_array();
	}
	public function set_exhibit(){
		$this->load->helper('url');

		$slug = strtolower(url_title($this->input->post('title'), 'dash', TRUE));

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'exhibitor' => $this->input->post('exhibitor'),
			'external_url' => $this->input->post('external_url'),
			'exhibit_type' => $this->input->post('exhibit_type'),
			'subjects' => $this->input->post('subjects'),
			'short_description' => $this->input->post('short_description'),
			'essay' => $this->input->post('essay')
			);
		return $this->db->insert('exhibits', $data);
	}
	public function update_exhibit($slug){
		$this->load->helper('url');

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'exhibitor' => $this->input->post('exhibitor'),
			'exhibitor' => $this->input->post('exhibitor'),
			'external_url' => $this->input->post('external_url'),
			'exhibit_type' => $this->input->post('exhibit_type'),
			'subjects' => $this->input->post('subjects'),
			'short_description' => $this->input->post('short_description'),
			'essay' => $this->input->post('essay')
			);
		$this->db->where('slug', $slug);
		return $this->db->update('exhibits', $data);
	}
}
