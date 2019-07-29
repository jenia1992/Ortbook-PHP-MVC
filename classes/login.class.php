<?php 

require_once 'users.class.php';

class Login {

    public $user;
    public $errors;
    public $messages;

    public function __construct(){
        session_start();
        
        $this->user = new Users();
        $this->errors = array();
        $this->messages = array();

    }

    public function doLoginWithPostData(){
        if(empty($_POST['userEmail'])){
            $this->errors[] = 'Email field was empty';
        } elseif(empty($_POST['userPassword'])){
            $this->errors[] = 'Password field was empty';
        } else {
            if($this->user->isUserCredentialsCorrect($_POST['userEmail'],$_POST['userPassword'])){
                $temp_user = $this->user->getUserIdByEmail($_POST['userEmail']);
                $_SESSION['userEmail'] = $_POST['userEmail'];
                $_SESSION['userId'] = $temp_user[0]['user_id'];
                $this->messages[] = 'login successfuly';
            } else {
                $this->errors[] = 'Incorrect email or password';
            }
        }
    }
    
    public function doLogout(){
        $_SESSION = array();
        session_destroy();
        $this->messages[] = 'You have been logged out';
    }
    
    public function doRegister(){
        //$image= addslashes($_FILES['userProfilePicture']['tmp_name']);
        //$image= file_get_contents($image);
        //$_POST['userProfilePicture'] = $image;
        //$_POST['userBirthDate'] = $_POST["yyyy"].'-'.$_POST["mm"].'-'.$_POST["dd"];
        $this->user->setUser($_POST["userFirstName"],$_POST["userLastName"],md5($_POST["userPassword"]),$_POST["userEmail"],null,$_POST["userBirthDate"],$_POST["userGender"]);
        $this->messages[] = 'You have been registered';
    }
    
    public function isUserLoggedIn(){
        if(isset($_SESSION['userId'])){
            return true;
        } else {
            return false;
        }
    }

}





?>