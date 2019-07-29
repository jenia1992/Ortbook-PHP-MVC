<?php

include '../classes/users.class.php';

$user = new Users();

if(isset($_POST['getUser'])){
    $id = $_POST['user_id'];
    $User = $user->getUser($id);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getUserByEmail'])){
    $email = $_POST['email'];
    $User = $user->getUserByEmail($email);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getUserById'])){
    $user_id = $_POST['user_id'];
    $User = $user->getUserById($user_id);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getUserGallery'])){
    $user_id = $_POST['user_id'];
    $value=$_POST['value'];
    $User = $user->getUserGallery($user_id,$value);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getCoverById'])){     
    $user_id = $_POST['user_id'];
    $value=$_POST['value'];
    $User = $user->getCoverById($user_id,$value);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getNumberOfFriends'])){
    $user_id = $_POST['user_id'];
    $User = $user->getNumberOfFriends($user_id);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getUserFriends'])){
    $user_id = $_POST['user_id'];
    $value=$_POST['value'];
    $User = $user->getUserFriends($user_id,$value);
    echo json_encode($User, JSON_FORCE_OBJECT);
}

if(isset($_POST['getUsersByName'])){
    $userName = $_POST['userParamsValue'];
    $User = $user->getUsersByName($userName);
    echo json_encode($User, JSON_FORCE_OBJECT);	
}

if(isset($_POST['SetProfilePhoto'])){
    $user_id=$_POST['user_id'];
	$post_image = addslashes($_FILES['post_image']['tmp_name']);
	$post_image = file_get_contents($post_image);
	$user->setUserProfileImg($user_id, $post_image);
}

if(isset($_POST['SetCoverPhoto'])){
    $user_id=$_POST['user_id'];
	$post_image = addslashes($_FILES['post_image']['tmp_name']);
	$post_image = file_get_contents($post_image);
	$user->setUserCoverImg($user_id, $post_image);
}
/*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/
if(isset($_POST['addFriend'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $user->addFriend( $user_id,$other_id);
   
}
if(isset($_POST['isFriend'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $isFriend=$user->isFriend( $user_id,$other_id);

    echo $isFriend;
}
if(isset($_POST['getNumberOfReq'])){
    $user_id = $_POST['user_id'];
    $numReq=$user->getNumberOfReq($user_id);
    echo $numReq;
   
}
 if(isset($_POST['getNotifictions'])){
    $user_id = $_POST['user_id'];
    $notifications=$user->getNotifictions($user_id);
    echo json_encode($notifications, JSON_FORCE_OBJECT);
   
}  
 if(isset($_POST['acceptFriendReq'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $user->acceptFriendReq($user_id,$other_id);
   
} 
 if(isset($_POST['reAcceptFriendReq'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $user->reAcceptFriendReq($user_id,$other_id);
   
} 
 if(isset($_POST['blockFriendReq'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $user->blockFriendReq($user_id,$other_id);
   
} 
 if(isset($_POST['reBlockFriendReq'])){
    $user_id = $_POST['user_id'];
    $other_id = $_POST['other_id'];
    $user->reBlockFriendReq($user_id,$other_id);
   
}
/*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/


?>