<?php

namespace App\Controllers;
use \App\Models\ExhibitModel;

class Exhibits extends BaseController
{ 
	  protected $helpers = ['url', 'form','func_helper'];
	  protected $exhibitModel;
	  protected $data;
	public function __construct(){
	
		$this->exhibitModel = new ExhibitModel();
		$this->data['ex_subjects_array'] = array('current', 'online', 'past');
		
		$view = \Config\Services::renderer();		
		$view->setData(['ex_subjects_array'=>$this->data['ex_subjects_array']]);
	}
	
    public function index()
    {
		//$session = \Config\Services::session();
	
		
		$data['exhibits'] = $this->exhibitModel->get_exhibit();
		$data['on_now'] = $this->exhibitModel->get_onnow();
		
		

		return view('common/header', $data) . view('exhibits/index', $data) . view('common/footer');
		
		
    }
	
	
	public function past()
    {
		//$session = \Config\Services::session();
		$exhibitModel = new \App\Models\ExhibitModel();		
		$data['exhibits'] = $exhibitModel->get_exhibit();

		return view('common/header', $data) . view('exhibits/past', $data) . view('common/footer');
		
    }
	
	
	public function view($slug){
		//$exhibitModel = new ExhibitModel();
		
		$data['exhibit_item'] = $this->exhibitModel->get_exhibit($slug);
		
		if (empty($data['exhibit_item'])){
			throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
		}

		$data['title'] = $data['exhibit_item']['title'];
		$data['exhibit_item']['subjects'] = explode(',', $data['exhibit_item']['subjects']);

		return view('common/header', $data) . view('exhibits/view', $data) . view('common/footer');
	}
	
	
	
	
	public function create(){
		
		/*$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('upload');
		$this->load->helper('ckeditor');
		*/
		helper('ckeditor_helper');

		
		$data['ex_subjects_array']=$this->data['ex_subjects_array'];


		//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	
				'height' 	=> 	'200px',	
			)
		);

		return view('common/header', $data) . view('exhibits/create', $data) . view('common/footer');
	}
	
	
	public function store(){
	
		//$overwriteFile - This is creating a new exhibition so there shouldn't already be an image file that exists, if there is then don't overwrite as there is probably a duplicate exhibit or collection that should be resolved first
		 $overwriteFile = false; 
		
		$validation = \Config\Services::validation();
		$validationRules = ['title'=>"required", "short_description"=>'max_length[80]', "on_now_details"=>'max_length[80]'];
		$validation->setRules($validationRules);
		
		
		
		//check that the form validation passes
		if (! $this->validate($validationRules)) {
		
				return redirect()->back()->withInput();
			
			/*$this->load->view('common/header', $data);
			$this->load->view('exhibits/create');
			$this->load->view('common/footer');*/
		}else{
					$cleantitle = strtolower(url_title($this->request->getVar('title')));
					
					$files = $this->request->getFiles();
					
					//print_r($files['exdisplay']->getName());
					
					
					if($files['exdisplay']->isValid() && $files['exdisplay']->getName() != ''){
						
						$validationRule ['exdisplay'] = [ 'label' => 'Display File',
							'rules' => [                    
							'is_image[exdisplay]',
							'mime_in[exdisplay,image/jpg,image/jpeg,image/png]',
							'max_size[exdisplay,800]',
							'max_dims[exdisplay,130,160]',
						]];
						
					}
					if($files['on_now_display']->isValid() && $files['on_now_display']->getName() != ''){				
						$validationRule ['on_now_display'] = [ 'label' => 'On Now File',
							'rules' => [                    
							'is_image[on_now_display]',
							'mime_in[on_now_display,image/jpg,image/jpeg,image/png]',
							'max_size[on_now_display,800]',
							'max_dims[on_now_display,270,192]',
						]];				
					}
					
					
					if($this->request->getVar('exhibit_type') == 1){
						// loop through the slide uploaded file fields
							for($i = 1; $i < 6; $i++) {
								$slide = 'slide'.$i;
								if( isset($files[$slide]) && $files[$slide]->isValid() && $files[$slide]->getName() != ''){				
									$validationRule[$slide] = [ 'label' => $slide . " File",
										'rules' => [                    
										"is_image[{$slide}]",
										"mime_in[{$slide},image/jpg,image/jpeg,image/png]",
										"max_size[{$slide},800]",
										"max_dims[{$slide},570,570]",
									]];				
								}				
							}				
					}
					
					
					// If not set then that means there are no files to upload
					if( isset($validationRule)){
						if (! $this->validate($validationRule)) {
							$data = ['errors' => $this->validator->getErrors()];
						
						
							return redirect()->back()->withInput();
							
							return view('common/header', $data) . view('exhibits/create',  $data) . view('common/footer');
							
							
						}else{
							$this->upload($validationRule, $cleantitle, $overwriteFile);
						}
						
					}
					

					$this->exhibitModel->set_onnow_exhibit($this->request);
					$id = $this->exhibitModel->set_exhibit($this->request);
					$session = \Config\Services::session();
					$session->setFlashdata('message', 'Your exhibit was created.');

					return redirect()->to('/admin');
					//redirect('exhibits');
			}
	}
	
	private function upload($validationRules, $cleantitle, $overwriteFile){
		
		
			 $images = $this->request->getFiles();
			
			foreach($images as $key => $img){
			
				$fileName = $cleantitle . "." . $img->guessExtension();
				if ($img->isValid() && ! $img->hasMoved()) {
					
					if(substr($key,0,5) == 'slide' ){
						$filepath = './assets/uploads/slides/' ;
						//$fileName = $img->getName();
					}elseif($key == 'exdisplay' || $key == 'display'){
						$filepath = './assets/uploads/display/';
					}else{
						$filepath = './assets/uploads/onnow/';
					}
					
					
					$img->move($filepath,$fileName, $overwriteFile);
					
				}
				
			}
			
					
			return true;
		}
		
		

	
	
	
	public function update($slug){
		
		$validation = \Config\Services::validation();
		
		$data['exhibit_item'] = $this->exhibitModel->get_exhibit($slug);
		
		
		$validationRules['title']=['label'=>'Title', 'rules'=>['required']];
		
		$validationRule ['on_now_display'] = [ 'label' => 'On Now File',
							'rules' => [                    
							'is_image[on_now_display]',
							'mime_in[on_now_display,image/jpg,image/jpeg,image/png]',
							'max_size[on_now_display,800]',
							'max_dims[on_now_display,270,192]',
						]];		
		
		$validationRules['display'] = [ 'label' => 'Display File',
							'rules' => [                    
							'is_image[display]',
							'mime_in[display,image/jpg,image/jpeg,image/png]',
							'max_size[display,800]',
							'max_dims[display,130,160]',
						]];
						
		
		
		
		$validationRules['short_description'] = ["rules"=>'max_length[80]', 'label'=>'Short Description'];
		$validationRules['on_now_details'] = ['rules'=>'max_length[80]', 'label'=>'On Now Details'];
		
		
		$validation->setRules($validationRules);
		
		if (! $this->validate($validationRules)) {
		
			$data['errors'] =  $this->validator->getErrors();
			//return view('common/header',$data) . view('exhibits/edit',$data) .  view('common/footer',$data);
			return redirect()->back()->withInput();
            
        }	
		else{
			
				
				$files = $this->request->getFiles();
				
				foreach($files as $key => $file)
				{
					if($file->isValid()){
						
						if($key == 'on_now_display'){
							$filepath = './assets/uploads/display';
							$overwrite = true;
							$fileName = $slug . "." . $file->guessExtension();
						}elseif($key == 'display'){
							$filepath = './assets/uploads/display';
							$overwrite = true;
							$fileName = $slug . "." . $file->guessExtension();
						}else{ 
							// This section is for slides/
							
							$imagePosition = str_replace('slide','',$key);
							$i = $imagePosition;
							
							$validationRules['slide' . $i] = [ 'label' => 'Slide Image',
								'rules' => [                    
								"is_image[slide{$i}]",
								"mime_in[slide{$i},image/jpg,image/jpeg,image/png]",
								"max_size[slide{$i},800]",
								"max_dims[slide{$i},570,570]",
							]];		
							$validation->setRules($validationRules);
		
							if(! is_numeric($imagePosition))
							{
								$this->session->setFlashdata('message', 'There is a problem with the file input element names. Please inform the administrator');	
								return redirect()->back()->withInput();
							}
							$filepath = './assets/uploads/slides';
							$overwrite = true;
							
							$fileName = $slug . $imagePosition . "." . $file->guessExtension();
							
						
						}
						if (! $this->validate($validationRules)) {
		
							$data['errors'] =  $this->validator->getErrors();
							//return view('common/header',$data) . view('exhibits/edit',$data) .  view('common/footer',$data);
							return redirect()->back()->withInput();
						
						}	
						
						$file->move($filepath, $fileName, $overwrite);
						
						if( ! $file->hasMoved())
						{
							$this->session->setFlashdata('message', 'The Exhibit could not upload some or all of the files.');									
							return redirect()->back()->withInput();
						}
						
					}
				}
				
				
					$this->exhibitModel->set_onnow_exhibit($this->request);
					$id = $this->exhibitModel->updateExhibit($this->request, $slug);
					$session = \Config\Services::session();
					$session->setFlashdata('message', 'Your exhibit was updated.');

					
					return redirect()->to("admin/exhibits/edit/" . $slug);
					
				/*	
					if($files['display']->isValid() && $files['display']->getName() != ''){
						
						
						
					}
					
					
					if($files['on_now_display']->isValid() && $files['on_now_display']->getName() != ''){				
						$validationRule ['on_now_display'] = [ 'label' => 'On Now File',
							'rules' => [                    
							'is_image[on_now_display]',
							'mime_in[on_now_display,image/jpg,image/jpeg,image/png]',
							'max_size[on_now_display,800]',
							'max_dims[on_now_display,270,192]',
						]];				
					}
					
					
					if($this->request->getVar('exhibit_type') == 1){
						// loop through the slide uploaded file fields
							for($i = 1; $i < 6; $i++) {
								$slide = 'slide'.$i;
								if( isset($files[$slide]) && $files[$slide]->isValid() && $files[$slide]->getName() != ''){				
									$validationRule[$slide] = [ 'label' => $slide . " File",
										'rules' => [                    
										"is_image[{$slide}]",
										"mime_in[{$slide},image/jpg,image/jpeg,image/png]",
										"max_size[{$slide},800]",
										"max_dims[{$slide},570,570]",
									]];				
								}				
							}				
					}
					
									
					if( isset($validationRule)){
						if (! $this->validate($validationRule)) {
						
							$data = ['errors' => $this->validator->getErrors()];
						
							return redirect()->back()->withInput();
							
							//return view('common/header', $data) . view('exhibits/edit',  $data) . view('common/footer');
							
							
						}else{
							
							
							$overwriteFile = true;
							$this->upload($validationRule, $slug, $overwriteFile);
							
						}
						
					}*/

			}
		
	}
	
	
	public function edit($slug){
		
		// load the ckeditor helper which get's used in the view exhibits/edit.php 
		helper('ckeditor_helper');
		
		$data['ex_subjects_array'] = $this->data['ex_subjects_array'];
		$data['exhibit_item'] = $this->exhibitModel->get_exhibit($slug);
		$data['errors'] = [];
		
		//$this->load->helper('form');
		//$this->load->library('form_validation');
		//$this->load->helper('url');
		//$this->load->helper('ckeditor');
		//$this->load->library('upload');

		$data['title'] = 'Update Link to an Online Exhibit';
		$data['upload_error'] = '';

		
		//add the ckeditor for the essay form element
		$data['ckeditor'] = array(
			'id' 	=> 	'essay',
			'path'	=>	'./assets/js/ckeditor',
			'config' => array(
				'toolbar' 	=> 	"Full", 	
				'height' 	=> 	'200px',	
			)
		);


		return view('common/header',$data) . view('exhibits/edit',$data) .  view('common/footer',$data);
		
	}
	
	
	public function deleteImage($slug){
	
		$session = \Config\Services::session();
		$path_to_file = './assets/uploads/display/'.$slug.'.jpg';
		if(unlink($path_to_file)) {
     		
			$session->setFlashdata('message', 'This exhibit display image was deleted.');
			
     		return redirect()->to('/admin/exhibits/edit/'.$slug);
		}
		else{
     		echo 'errors occured unable to delete display image';
		}		
	}
	
	public function deleteSlideImage($slug, $image){
		
			$session = \Config\Services::session();
		
	
		$path_to_file = './assets/uploads/slides/'.$image.'.jpg';
		if(unlink($path_to_file)) {
     		$session->setFlashdata('message', 'This exhibit slide was deleted.');
     		return redirect()->to('/admin/exhibits/edit/'.$slug);
			
		}
		else{
     		echo 'errors occured unable to delete slide image';
		}		
	}

	public function deleteExhibit($slug){
	
      	$db = \Config\Database::connect();
		
		// this should only ever return 1 record so can use the getRow() 
		$sql = "Select id from exhibits where slug = ?";
		$query = $db->query($sql, [$slug]);		
		$row = $query->getRow();

		$sql = "delete from exhibits where id = ?";
		$query = $db->query($sql, [$row->id]);		
		$session = \Config\Services::session();
		$session->setFlashdata('message', 'This exhibit was deleted.');
	
    	return redirect()->to('admin');
	
	}

}
