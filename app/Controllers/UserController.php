<?php

namespace App\Controllers;
use CodeIgniter\Shield\Entities\User;


class UserController extends BaseController
{
	  protected $helpers = ['url', 'form'];
	  
	  protected $data;
	  protected $session;
	  
	public function __construct(){
				
		
	}
	
  public function index(){
	
		$data['message']='';
		$data['code']='';
		$data['min_password_length']='';
		$data['new_password']='';
		
		$session = \Config\Services::session();
		//print_r($session);
		
		$user = auth()->user();
		echo "<hr>";
		//print_r($user);
	
	


		return view('common/header') . view('auth/reset_password', $data) . view('common/footer'); 
	}

	// the code is partially taken from here: https://codeigniter4.github.io/shield/quickstart/ 
	
	
  /**
  *   The reset password was a quick job. User just needs to be logged in to reset the password.   See the routes.php file for the URL
  */
  public function resetPassword(){
	
		$session = \Config\Services::session();
		
		if($this->request->getPost('new_password') == $this->request->getPost('confirm')){
		
			$users = model('UserModel');
			$user = auth()->user();
			$user->fill([			
				'password' => $this->request->getPost('new_password')
			]);
			
			$users->save($user);
			// echo "password reset";
			$session->setFlashData('message',"Your password has been saved");
			return redirect()->to('/admin/user/resetpassword');
		}else{
			$session->setFlashData('message',"Your password does not match or is not valid");
			return redirect()->to('/admin/user/resetpassword');
		
		}
	  
			  
	}
	
	
	/**
	*  jhennig: Note that I didn't create a view for this. Not really worth the effort at this point since there are so few users
	*/
   public function createUser(){
	   
	   
			$newUser = [
				'username' => 'Bob', 
				'email'    => 'bob@bob.com', 
				'password' => 'secret', 
			];
			
			
		

			$users = model('UserModel');
			$userIdentity = model('UserIdentityModel');
			
			// check if the username or email already exist;
			
			$usernameCount = $users->where(['username'=>$newUser['username']])->countAllResults();
			$emailCount = $userIdentity->where(['secret'=>$newUser['email']])->countAllResults();
			
			
			if( $emailCount>0 || $usernameCount > 0){
				echo "The username " . $newUser['username'] . " or email " . $newUser['email'] . " already exists. The new user has not been created";
			
			}else{
			
				$user = new User($newUser);
				$users->save($user);

				// To get the complete user object with ID, we need to get from the database
				$user = $users->findById($users->getInsertID());

				// Add to default group
				//$users->addToDefaultGroup($user);
				$user->addGroup('admin');
				
				echo "User ID " . $user->id . " has been created. Username = " . $user->username;
			}
	}	
	
	
	/**
	*  jhennig: Note that I didn't bother creating a view for this since it would be rarely used. Just use the route, hard code the user to delete and run it.
	* for more info: https://codeigniter4.github.io/shield/quickstart/#deleting-users
	*/
	public function deleteUser(){
		
		$deleted='';
		$userId = 3;
		
		
		$users = model('UserModel');
		$user  = $users->findById($userId);
		if( ! isset($user->id)){
			echo "User ID: " . $userId . " was not found in the database. Perhaps it was already deleted.";
			exit();
		}
		
		//print_r($user->id);
		
		// For the second parameter in delete function. If true that means use a hard delete. False (default) means a soft delete.
		$deleted = $users->delete($user->id, true);
		
		echo "User ID: {$userId} has been deleted";
		
		
		
		
	}

}
