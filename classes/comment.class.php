<?php
include_once("db.class.php");
include_once("users.class.php");

class Comment{   
	public $db;
	public $user;
	
	public function __construct(){
		$this->db=DB::getInstance();
		$this->user=new Users();
	}
	
	//function insert a comment into database
	public function createComment($comment_body,$post_id,$user_id){
		$params=array(
			':comment_body'=>$comment_body,
			':post_id'=>$post_id,
			':user_id'=>$user_id
		);      
		$query= "INSERT INTO `comments`( comment_body,post_id,user_id) VALUES (:comment_body,:post_id,:user_id)";
		$result=$this->db->paramsQuery($query,$params);
	}
	
	//function return comments of specific post
	public function getComments($post_id){
		$params=array(
			':post_id'=>$post_id
		);
		$query="select * from `comments` where post_id=:post_id";
		$row=$this->db->paramsQuery($query,$params);
		for($i=0;$i<count($row);$i++){
			$userDetails = $this->user->getUserById($row[$i]["user_id"]);
			$comments[]=array(
				'comment_id '=>$row[$i]["comment_id"],
				'comment_body'=>$row[$i]["comment_body"],
				'user_profile_picture' => $userDetails[0]['user_profile_picture'],
				'user_first_name' => $userDetails[0]['user_first_name'],
				'post_id'=>$row[0]["post_id"],
				'user_id'=>$row[$i]["user_id"],
				'comment_create_time '=>$row[0]["comment_create_time"]
			);
		}
		return $comments;   
	}
	
	public function getCommentAmount($post_id){
		$params=array(
			':post_id'=>$post_id
		);
		$query="select  count(*) as counter from `comments` where post_id=:post_id";
		$row=$this->db->paramsQuery($query,$params);
		if($row[0]['counter']==null){
			return 0;
		}
		return $row[0]['counter'];
	}
}
?>
