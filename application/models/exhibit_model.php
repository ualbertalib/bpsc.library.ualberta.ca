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
	public function get_onnow(){
			$query = $this->db->get_where('exhibits', array('on_now' => 1));
			return $query->result_array();
	}
	public function set_exhibit(){
		$this->load->helper('url');

		$slug = strtolower(url_title($this->input->post('title'), 'dash', TRUE));

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'exhibitor' => $this->input->post('exhibitor'),
			'external_url' => $this->input->post('external_url'),
			'exhibit_type'  => $this->input->post('exhibit_type'),
			'short_description' => $this->input->post('short_description'),
			'on_now' => $this->input->post('on_now'),
			'on_now_details' => $this->input->post('on_now_details'),
			'on_now_dates' => $this->input->post('on_now_dates'),
			'essay' => $this->input->post('essay'),
			'caption1' => $this->input->post('caption1'),
			'caption2' => $this->input->post('caption2'),
			'caption3' => $this->input->post('caption3'),
			'caption4' => $this->input->post('caption4'),
			'caption5' => $this->input->post('caption5'),
			'caption6' => $this->input->post('caption6')
			);
		return $this->db->insert('exhibits', $data);
	}
	public function update_exhibit($slug){
		$this->load->helper('url');

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'exhibitor' => $this->input->post('exhibitor'),
			'exhibit_type'  => $this->input->post('exhibit_type'),
			'external_url' => $this->input->post('external_url'),
			'short_description' => $this->input->post('short_description'),
			'on_now' => $this->input->post('on_now'),
			'on_now_details' => $this->input->post('on_now_details'),
			'on_now_dates' => $this->input->post('on_now_dates'),
			'essay' => $this->input->post('essay'),
			'caption1' => $this->input->post('caption1'),
			'caption2' => $this->input->post('caption2'),
			'caption3' => $this->input->post('caption3'),
			'caption4' => $this->input->post('caption4'),
			'caption5' => $this->input->post('caption5'),
			'caption6' => $this->input->post('caption6')
			);
		$this->db->where('slug', $slug);
		return $this->db->update('exhibits', $data);
	}
	public function set_onnow_exhibit(){
		$this->load->helper('url');
		
		if($this->input->post('on_now')==1){
			$this->db->where('on_now', 1);
			$this->db->set('on_now', 0);
			return $this->db->update('exhibits');
		}else{
			return true;
		}
	}
}