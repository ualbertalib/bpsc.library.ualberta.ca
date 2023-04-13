<?php

namespace App\Controllers;

class Pages extends BaseController
{
	  protected $helpers = ['url', 'form'];
	  
	
	
    public function view($page = 'home')
    {

		$data['title'] = ucfirst($page); // Capitalize the first letter
		
		// Get News
		
		if($page == 'home'){
				$xml = simplexml_load_string(file_get_contents('http://bpsclibrarynews.blogspot.com/feeds/posts/default?alt=rss'));
				$json = json_encode($xml);
				$array =  json_decode($json,TRUE);
				$data['rss_news'] = array_slice($array['channel']['item'], 0, 6);
				
				
				//Get exhibit
				$exhibitModel = new \App\Models\ExhibitModel();
				$data['on_now'] = $exhibitModel->get_onnow();
				
				// Get Posts
				/* // Get posts is no longer used on the home page
				$xml = simplexml_load_string(file_get_contents('http://bpsclibrary.blogspot.ca/feeds/posts/default?alt=rss'));
				$json = json_encode($xml);
				$rss = json_decode($json,TRUE);		
				$data['posts_rss'] = $rss['channel']['item'];
				*/
				
				//print_r($data['posts_rss']);
			
			return view('common/homeheader') . view('pages/'.$page, $data) . view('common/footer');
		}else{
		
		
		
			
			return view('common/header') . view('pages/'.$page, $data) . view('common/footer');
		
		}
		
		
		
		
      //  return view('welcome_message');
    }
}
