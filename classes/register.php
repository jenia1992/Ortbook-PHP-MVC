<?php
require_once 'core/init.php';

if(Input::exists()){
	if(Token::check(Input::get('token'))){
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max'=> 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6,
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));
		if($validation->passed()){
			//register user
			try{
				$user->create(array(
					'user_first_name' => Input::get('username'),
					'user_password' => Hash::make(Input::get('password')),
					'user_birthdate' => date('Y-m-d'),
				));
				Session::flash('home', 'You have been registered and can now log in!');
				Redirect::to('index.php');
			}
			catch(Exception $e){
				die($e->getMessage());
			}
		}
		else{
			foreach($validation->errors() as $error){
				echo $error, '<br>';
			}
		}
	}
}
?>

<form action="" method="post">
	<div class="field">
		<label for="username">User name</label> 
		<input type="text" name="username" id="username" 
		value="<?php echo escape(Input::get('username')); ?>" 
		autocomplete="off">
	</div>
	
	<div class="field">
		<label for="password">Password</label>
		<input type="password" name="password" id="password"> 
	</div> 
	
	<div class="field">
		<label for="password_again">Enter your password again</label>
		<input type="password" name="password_again" id="password_again">  
	</div> 
	
	<div class="field">
		<label for="name">Your name</label>
		<input type="text" name="name" 
		value="<?php echo escape(Input::get('name')); ?>" 
		id="name">  
	</div> 
	
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register">
</form>

