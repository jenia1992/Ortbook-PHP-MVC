<?php

include_once("../classes/post.class.php");

$post=new Post();

if(isset($_POST['createPost'])){
    echo $_POST['form'];
    echo "first";
    $post_body=$_POST['post_body'];
    
    if($_FILES['post_image']['tmp_name'] == ""){
        $_POST['post_image'] = null;
    }else{
        $post_image = addslashes($_FILES['post_image']['tmp_name']);
        $post_image = file_get_contents($post_image);
    }
    
    $user_id=$_POST['user_id'];
    echo "before";
    $post->createPost($post_body,$post_image,$user_id);
    echo "after";
}

if(isset($_POST['Delete'])){
    $postId=$_POST['post_id'];
    $post->delete($postId);
}

if(isset($_POST['getPostById'])){
    $postId=$_POST['post_id'];
    $Post=$post->getPostById($postId);
    echo json_encode($Post,JSON_FORCE_OBJECT);
}

if(isset($_POST['editPost'])){
    $postId=$_POST['post_id'];
    $postBody=$_POST['post_body'];
    $postImage=$_POST['post_image'];
    $userId=$_POST['user_id'];
    echo $post->editPost($postId,$postBody,$postImage,$userId);  
}

if(isset($_POST['getAllUserPostsByUserId'])){
    $postId=$_POST['user_id'];
    $Post=$post->getAllUserPostsByUserId($postId); 
    echo json_encode($Post,JSON_FORCE_OBJECT);
}

if(isset($_POST['getRating'])){
    $postId=$_POST['post_id'];
    echo $post->getRating($postId); 
    
}

if(isset($_POST['didlike'])){
	$postId=$_POST['post_id'];
	$userId=$_POST['user_id'];
	echo $didLike=$post->didlike($postId,$userId);
	if($didLike==2){
		$post->like($postId,$userId,"like");
	}
	else{
		$post->unlike($postId,$userId);
	}
}

if(isset($_POST['getlike'])){
    $postId=$_POST['post_id'];
    echo $post->getlike($postId); 
}


if(isset($_POST['getWall'])){
    $user_id=$_POST['user_id'];
    $Post=$post->getWall($user_id);
    echo json_encode($Post,JSON_FORCE_OBJECT);
}

if(isset($_POST['getWallIds'])){
    $user_id=$_POST['user_id'];
    $Post=$post->getWallIds($user_id);
    echo json_encode($Post,JSON_FORCE_OBJECT);
}

if(isset($_POST['getNewWall'])){
    $user_id=$_POST['user_id'];
    $ids=$_POST['ids'];
    $Post=$post->getNewWall($user_id,$ids);
    echo json_encode($Post,JSON_FORCE_OBJECT);
}

if(isset($_POST['getMyWall'])){
    $user_id=$_POST['user_id'];
    $Post=$post->getMyWall($user_id);
    echo json_encode($Post,JSON_FORCE_OBJECT);
}
?>