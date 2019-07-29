
<?php
include './classes/login.class.php';

$login = new Login();

if(isset($_POST['doLoginWithPostData'])){
    $login->doLoginWithPostData();
    echo json_encode($login);
    die();
}
else if(isset($_POST['doRegister'])){
    $login->doRegister();
}
else if(isset($_POST['doLogout'])){
    $login->doLogout();
}
else{
    echo "noting";
}


$res=$login->isUserLoggedIn();
if($res){
    header('Location:./views/index.php');
}
else{
    header('Location:./login.php');
}
?>
