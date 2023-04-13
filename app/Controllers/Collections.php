<?php

namespace App\Controllers;

class Collections extends BaseController
{
	  protected $helpers = ['url', 'form','ckeditor_helper'];
	  
	  protected $data;
	  protected $session;
	  
	public function __construct(){
				
		$this->data['subjects_array'] = array('english-literature', 'american-literature', 'canadian-literature','history-of-the-book','small-presses','art-books','canadian-history','education', 'biological-science','law','religious-studies','native-studies');
		$this->data['types_array'] = array('16th-century', '17th-century', '18th-century', '19th-century', '20th-century','21st-century','art-work', 'artists-books', 'books', 'correspondence', 'ephemera', 'fine-press-books', 'incunables', 'limited-edition-books','manuscripts', 'newspapers','photographs', 'postcards', 'specialty-bindings');
		
		$this->session = \Config\Services::session();
		$view = \Config\Services::renderer();
		$view->setData(['types_array'=>$this->data['types_array']]);
		$view->setData(['subjects_array'=>$this->data['subjects_array']]);
		$view->setData(['session']);
	}
	
  public function index(){
		//$data['collections'] = $this->collection_model->get_collection();
		
		$collectionModel = new \App\Models\CollectionModel();
		$data['collections'] = $collectionModel->get_collection();
		
		$data['title'] = "Our Collections";
	
		return view('common/header', $data) . view('collections/index', $data) . view('common/footer');
	}
	
	public function search(){
		$data['query'] = $this->request->getVar('query');
		
		$collectionModel = new \App\Models\CollectionModel();
		$data['collections'] = $collectionModel->get_search($data['query']);
	
		
		return view('common/header', $data) .	view('collections/index', $data) .	view('common/footer');
	}
	
	
	
	
	public function create(){
		
		/*$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper('ckeditor');*/

		$data['title'] = 'Create a collection';
		$data['upload_error'] =  '';

		

		//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	
				'height' 	=> 	'200px',	
			)
		);
		
		return 	view('common/header', $data) . view('collections/create') . view('common/footer');

	}
	
	
	public function edit($slug){
	
		$collectionModel = new \App\Models\CollectionModel();
		$data['collection_item'] = $collectionModel->get_collection($slug);
		

		$data['title'] = 'Update collection';
		$data['upload_error'] = '';
	
		
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Basic", 	
				'height' 	=> 	'200px',	
			)
		);
	
		return view('common/header', $data) . view('collections/edit', $data) . view('common/footer');
	}
	
	public function update($slug){
		$validation = \Config\Services::validation();
		$validationRules['title']=['label'=>'Title', 'rules'=>['required']];
		$validationRule['display'] = [ 'label' => 'Display Image',
							'rules' => [                    
							'is_image[display]',
							'mime_in[display,image/jpg,image/jpeg,image/png]',
							'max_size[display,800]',
							'max_dims[display,130,160]',
						]];
		for($i=1; $i<=6; $i++){				
			$validationRule['slide' . $i] = [ 'label' => 'Display Image',
							'rules' => [                    
							"is_image[slide{$i}]",
							"mime_in[slide{$i},image/jpg,image/jpeg,image/png]",
							"max_size[slide{$i},800]",
							"max_dims[slide{$i},570,570]",
						]];		
		}				
		$validation->setRules($validationRules);
	
		if (! $this->validate($validationRules)) {
		
				return redirect()->back()->withInput();
			
		}else{
			/* $config['upload_path'] = './assets/uploads/display';
            $config['allowed_types'] = 'jpg|png';               
            $config['file_name'] = $slug;
            $config['max_size'] = '800'; 
            $config['overwrite'] = TRUE;
            $this->upload->initialize($config); 
            $field_name ="display"; */
						
			$files = $this->request->getFiles();
			$count = 0;
			foreach($files as $key => $file){
			
				if($file->isValid()){
					if($key == 'display'){
						$filepath = './assets/uploads/display';
						$overwrite = true;
						
						
					}else{
						// this section is for slides. Note that in the original code slides weren't allowed to be overwritten so I kept the same functionality.
						// however the original also didn't allow new slides to be added. This version allows that. Thus I added the $count variable to the 'else' side of the if statement.
						$filepath = './assets/uploads/slides';
						$overwrite = false;
						$count = $count + 1;
					}
					$fileName = $slug . $count . "." . $file->guessExtension();
					$file->move($filepath, $fileName, $overwrite);
					
					if( ! $file->hasMoved()){
						$this->session->setFlashdata('message', 'The collection could not upload some or all of the files.');			
						
					}
					
				}
			}
			
			$collectionModel = new \App\Models\CollectionModel();
			$collectionModel->update_collection($slug, $this->request);
			$this->session->setFlashdata('message', 'Your collection was updated.');
			
    			return redirect()->to('/admin');
		}
	
	}


    
	public function store() {
	
		$validation = \Config\Services::validation();
		$validationRules = ['title' => ['label'=>'Title', 'rules'=>'required'],
		'short_description'=>['label'=>'Short Description', 'rules'=>'max_length[80]']];
		$validationRule['display'] = [ 'label' => 'Display Image',
							'rules' => [                    
							'is_image[display]',
							'mime_in[display,image/jpg,image/jpeg]',
							'max_size[display,800]',
							'max_dims[display,130,160]',
						]];
		for($i=1; $i<=6; $i++){				
			$validationRule['slide' . $i] = [ 'label' => 'Display Image',
							'rules' => [                    
							"is_image[slide{$i}]",
							"mime_in[slide{$i},image/jpg,image/jpeg]",
							"max_size[slide{$i},800]",
							"max_dims[slide{$i},570,570]",
						]];		
		}				
		$validation->setRules($validationRules);
		
	
		
		//check that the form validation passes
		if (! $this->validate($validationRules)) {
		
				return redirect()->back()->withInput();
			
		}
		else{
			$cleantitle = strtolower(url_title($this->request->getPost('title')));

			/*$config['upload_path'] = './assets/uploads/display';
            $config['allowed_types'] = 'jpg|png';               
            $config['file_name'] = $cleantitle;
            $config['max_size'] = '800'; 
            $this->upload->initialize($config); */
			
			$files = $this->request->getFiles();
			
			foreach($files as $key => $file){
			
				if($file->isValid()){
					if($key == 'display'){
						$filepath = './assets/uploads/display';
					}else{
						$filepath = './assets/uploads/slides';
					}
					$file->move($filepath,$cleantitle);
					
					if( ! $file->hasMoved()){
						$this->session->setFlashdata('message', 'The collection could not upload some or all of the files.');			
						
					}
					
				}
			}
			
           
			
				$collectionModel = new \App\Models\CollectionModel();
				$collectionModel->set_collection($this->request);
				$this->session->setFlashdata('message', 'Your collection was created.');
			
    			
				return redirect()->to('/admin');
    	}
		
	}
	
	
	
	
	public function deleteCollection($slug){ 

		
		$db = \Config\Database::connect();
		
		// this should only ever return 1 record so can use the getRow() 
		$sql = "Select id from collections where slug = ?";
		$query = $db->query($sql, [$slug]);		
		$row = $query->getRow();

		$sql = "delete from collections where id = ?";
		$query = $db->query($sql, [$row->id]);		
		$session = \Config\Services::session();
		$session->setFlashdata('message', 'This collection was deleted.');
	
    	return redirect()->to('admin');
		

	}

	public function deleteSlideImage($slug, $image){
	
		$path_to_file = 'assets/uploads/slides/'.$image.'.jpg';
		if(unlink($path_to_file)) {
			$session = \Config\Services::session();
     		$session->setFlashdata('message', 'Delete was successful.'); 
     		
			return redirect()->to('/admin/collections/edit/'.$slug);
		} 
		else{ 
     		echo 'errors occured';
		}	
	}
	
	public function deleteImage($slug){
	
		$path_to_file = 'assets/uploads/display/'.$slug.'.jpg';
		if(unlink($path_to_file)) {
			$session = \Config\Services::session();
     		$session->setFlashdata('message', 'Delete was successful.'); 
			return redirect()->to('/admin/collections/edit/'.$slug);
		}
		else{
     		echo 'errors occured';
		}	
		
	}
	

}
