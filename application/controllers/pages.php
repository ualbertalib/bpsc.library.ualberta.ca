<?php

class Pages extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('exhibit_model');
	}
	public function view($page = 'home'){
		if ( ! file_exists('../application/views/pages/'.$page.'.php'))
	{
		// Whoops, we don't have a page for that!
		show_404();
	}

	$this->load->helper('url');
	$this->load->spark('ci-simplepie/1.0.1/');
	$this->cisimplepie->set_cache_location(APPPATH.'cache/rss');
	$this->cisimplepie->handle_content_type();
	$this->cisimplepie->set_cache_duration(100);
	$this->load->database();


	
	$data['title'] = ucfirst($page); // Capitalize the first letter
	
	if ($page == 'home'){
		$this->cisimplepie->set_feed_url('http://bpsclibrary.blogspot.ca/feeds/posts/default?alt=rss');
		$this->cisimplepie->init();
		$data['posts_rss'] = $this->cisimplepie->get_items();   

		$data['on_now'] = $this->exhibit_model->get_onnow();
		
		$this->load->view('common/homeheader', $data);
	}else{
		$this->cisimplepie->set_feed_url('http://bpsclibrary.blogspot.ca/feeds/pages/default?alt=rss');
		$this->cisimplepie->init();
		$data['about_rss'] = $this->cisimplepie->get_item(1);
		$data['visit_rss'] = $this->cisimplepie->get_item(2);
		$data['classes_rss'] = $this->cisimplepie->get_item(0);  
		$data['contact_rss'] = $this->cisimplepie->get_item(4);
		$data['slides_rss'] = $this->cisimplepie->get_item(0);

		
		$this->load->view('common/header', $data);
	}
		$this->load->view('pages/'.$page, $data);
		$this->load->view('common/footer', $data);
	}
}
