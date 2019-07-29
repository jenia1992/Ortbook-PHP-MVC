<?php

include_once("../classes/comment.class.php");

$comment=new Comment();

if(isset($_POST['createComment'])){
    $comment_body=$_POST['comment_body'];
    $post_id=$_POST['post_id'];
    $user_id=$_POST['user_id'];
    $comment->createComment($comment_body,$post_id,$user_id);
}

if(isset($_POST['getComments'])){
    $post_id=$_POST['post_id'];
    $Comment=$comment->getComments($post_id);
    echo json_encode($Comment,JSON_FORCE_OBJECT);
}
?>