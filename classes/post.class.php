<?php
session_start();
include_once("db.class.php");
include_once("users.class.php");
include_once("comment.class.php");

class Post{ 
	public $db;
	public $user;
	
	public function __construct(){
		$this->db=DB::getInstance();
		$this->user=new Users();
		$this->comment=new Comment();
	}
		
	public function createPost($_post_body,$_post_image,$_user_id){
		//if($_post_image!==null){
		//	$_post_image = file_get_contents($_post_image);
		//	$_post_image = base64_encode($_post_image);
		//}
		$params=array(
			':post_body'=>$_post_body,
			':post_image'=>$_post_image,
			':user_id'=>$_user_id
		);
		$query= "INSERT INTO `posts`( post_body,post_image,user_id) VALUES (:post_body,:post_image,:user_id)";
		$result=$this->db->paramsQuery($query,$params);
	}
	
    public function delete($post_id) {
          $params=array(
          ':post_id'=>$post_id
      );  
          $query="DELETE FROM `posts` WHERE post_id=:post_id";
          $this->db->paramsQuery($query,$params);     
    }
	
	public function getPostById($post_id){
		$params=array(
		':post_id'=>$post_id
		);
		$query="select * from `posts` where post_id=:post_id";
		$row=$this->db->paramsQuery($query,$params);
		for($i=0;$i<count($row);$i++){
			$userDetails = $this->user->getUserById($row[0]["user_id"]);
			$post[]=array(
				'user_id'=>$row[0]["user_id"],
				'post_id'=>$row[0]["post_id"],
				'post_body'=>$row[0]["post_body"],
				'post_image'=>base64_encode($row[0]["post_image"]),
				'post_date'=>$row[0]["post_date"],
				'user_first_name' => $userDetails[0]['user_first_name'],
				'user_last_name' => $userDetails[0]['user_last_name'],
				'user_profile_picture' => $userDetails[0]['user_profile_picture'],
				'likes' => $this->getlike($row[0]["post_id"]),
				'did_like'=>$this->didlike($row[0]["post_id"],$_SESSION['userId']),
				'comment_ammount'=>$this->comment->getCommentAmount($row[0]["post_id"])
			);
		}
		return  $post;    
	}
    
	public function editPost($post_id,$post_body,$post_image,$user_id){
		if($post_image!==null){
			$post_image = file_get_contents($post_image);
			$post_image = base64_encode($post_image);
		}
		$params=array(
			':post_id'=>$post_id,
			':post_body'=>$post_body,
			':post_image'=>$post_image,
			':user_id'=>$user_id
		);
		$query="UPDATE `posts` SET post_body=:post_body,user_id=:user_id,post_image=:post_image WHERE post_id=:post_id";
		$row=$this->db->paramsQuery($query,$params);
		if($row==null){
			return 1;
		}
		else{
			return 0;
		}
	}

	public function getAllUserPostsByUserId($user_id){
		$params=array(':user_id'=>$user_id);
		
		$query="select * from `posts` where user_id=:user_id ORDER BY `post_id` desc limit 10";  
		$row=$this->db->paramsQuery($query,$params);
		for($i=0;$i<count($row);$i++){
			$userDetails = $this->user->getUserById($row[$i]["user_id"]);
			$posts[]=array(
				'user_id'=>$row[$i]["user_id"],
				'user_first_name' => $userDetails[0]['user_first_name'],
				'user_last_name' => $userDetails[0]['user_last_name'],
				'user_profile_picture' => $userDetails[0]['user_profile_picture'],
				'post_id'=>$row[$i]["post_id"],
				'post_body'=>$row[$i]["post_body"],
				'post_image'=>base64_encode($row[$i]["post_image"]),
				'post_date'=>$row[$i]["post_date"],
				'likes' => $this->getlike($row[$i]["post_id"]),
				'did_like'=>$this->didlike($row[$i]["post_id"],$user_id),
				'comment_ammount'=>$this->comment->getCommentAmount($row[0]["post_id"])
			);
		}
		return $posts;
	}
    
	public function getRating($post_id){
		$params=array(
			':post_id'=>$post_id
		);
		$query="select count(post_id) as counter from `rating` where post_id=:post_id"; 
		$row=$this->db->paramsQuery($query,$params);
		return $row[0]['counter'];
	}
    
	public function like($post_id,$user_id,$rating_action){
		$params=array(
			':post_id'=>$post_id,
			':user_id'=>$user_id,
			':rating_action'=>$rating_action   
		);
		$query= "INSERT INTO `rating`(post_id,user_id,rating_action) VALUES (:post_id,:user_id,:rating_action)";
		$this->db->paramsQuery($query,$params);       
	}

	public function unlike($post_id,$user_id){
		$params=array(
			':post_id'=>$post_id,
			':user_id'=>$user_id
		);
		$query= "DELETE FROM `rating` WHERE post_id=:post_id and user_id=:user_id";
		$this->db->paramsQuery($query,$params);    
	}
	
	public function didlike($post_id,$user_id){
		$params=array(
			':post_id'=>$post_id, 
			':user_id'=>$user_id
		);		
		$query="select count(post_id) as counter from `rating` where post_id=:post_id and user_id=:user_id";
		$row=$this->db->paramsQuery($query,$params);
		if($row[0]['counter']){
			return 1;
		}
		else{
			return 2;
		}
	}

	public function getlike($post_id){
		$counter=0;
		$params=array(
			':post_id'=>$post_id,           
		);
		$query="select count(post_id) as counter from `rating` where post_id=:post_id ";
		$row=$this->db->paramsQuery($query,$params );

		if($row[0]['counter']){
			return $row[0]['counter'];
		}
		else{
			return 0;
		}  
	}
	
	public function getWall($user_id){
		$params = array(':userId' => $user_id,':friendshipStatues'=>2);
		$sql="SELECT DISTINCT * from `posts` where 
			`user_id` in (select `to_id` from `friendship` where (`ask_id`=:userId) and `friendship_status`=:friendshipStatues) or 
			`user_id` in (select `ask_id` from `friendship` where (`ask_id`=:userId) and `friendship_status`=:friendshipStatues) or
			`user_id` in (select `to_id` from `friendship` where (`to_id`=:userId) and `friendship_status`=:friendshipStatues) or
			`user_id` in (select `ask_id` from `friendship` where (`to_id`=:userId) and `friendship_status`=:friendshipStatues) order by `post_date` desc limit 10";
		
		$row=$this->db->paramsQuery($sql,$params);
		
		if(!$this->db->countRows){
			$posts = $this->getAllUserPostsByUserId($user_id);
		}
		else{
			for($i=0;$i<count($row);$i++){
				$userDetails = $this->user->getUserById($row[$i]["user_id"]);
				$posts[]=array(
					'user_id'=>$row[$i]["user_id"],
					'user_first_name' => $userDetails[0]['user_first_name'],
					'user_last_name' => $userDetails[0]['user_last_name'],
					'user_profile_picture' => $userDetails[0]['user_profile_picture'],
					'post_id'=>$row[$i]["post_id"],
					'post_body'=>$row[$i]["post_body"],
					'post_image'=>base64_encode($row[$i]["post_image"]),
					'post_date'=>$row[$i]["post_date"],
					'likes' => $this->getlike($row[$i]["post_id"]),
					'did_like'=>$this->didlike($row[$i]["post_id"],$user_id),
					'comment_ammount'=>$this->comment->getCommentAmount($row[$i]["post_id"])
				);
			}
		}
		return  $posts;    
	}
    
    public function getWallIds($user_id){
 
           $params = array(':userId' => $user_id,':friendshipStatues'=>2);
             $sql="SELECT DISTINCT * from `posts` where `post_date` > ((CURRENT_TIMESTAMP) - INTERVAL 2 DAY) and(
                   `user_id` in (select `to_id` from `friendship` where (`ask_id`=:userId) and `friendship_status`=:friendshipStatues) or 
                   `user_id` in (select `ask_id` from `friendship` where (`ask_id`=:userId) and `friendship_status`=:friendshipStatues) or
                   `user_id` in (select `to_id` from `friendship` where (`to_id`=:userId) and `friendship_status`=:friendshipStatues) or
                   `user_id` in (select `ask_id` from `friendship` where (`to_id`=:userId) and `friendship_status`=:friendshipStatues)) order by `post_date` desc";
                $row=$this->db->paramsQuery($sql,$params);
                    for($i=0;$i<count($row);$i++)
                    {
                        $postsId[]=array(
                            'post_id'=>$row[$i]["post_id"]
                        );
                    }  
                return  $postsId;    
            }
    
    
           public function getNewWall($user_id,$ids){
 
           $params = array(':userId' => $user_id,':friendshipStatues'=>2);
             $sql="SELECT DISTINCT * from `posts` where `post_id` = ";
           
               for($i=0;$i<count($ids);$i++){
                   if($i == 0){
                       $sql .= $ids[$i];
                   }else{
                       $sql .= " OR `post_id` = ".$ids[$i];
                   }
               }
               $sql .= " order by `post_date` desc";
               
                $row=$this->db->paramsQuery($sql,$params);
                if(!$this->db->countRows){
                    $posts = $this->getAllUserPostsByUserId($user_id);
                }else{
                    for($i=0;$i<count($row);$i++)
                    {
                        $userDetails = $this->user->getUserById($row[$i]["user_id"]);
                        $posts[]=array(
                            'user_id'=>$row[$i]["user_id"],
                            'user_first_name' => $userDetails[0]['user_first_name'],
                            'user_last_name' => $userDetails[0]['user_last_name'],
                            'user_profile_picture' => $userDetails[0]['user_profile_picture'],
                            'post_id'=>$row[$i]["post_id"],
                            'post_body'=>$row[$i]["post_body"],
                            'post_image'=>base64_encode($row[$i]["post_image"]),
                            'post_date'=>$row[$i]["post_date"],
                            'likes' => $this->getlike($row[$i]["post_id"]),
                            'did_like'=>$this->didlike($row[$i]["post_id"],$user_id),
                            'comment_ammount'=>$this->comment->getCommentAmount($row[$i]["post_id"])

                        );
                    }

                    }
                return  $posts;    
            }
	
	
	public function getMyWall($user_id){
		$params = array(':userId' => $user_id);
		$sql="SELECT * from `posts` where `user_id` = :userId  limit 10";
		$row=$this->db->paramsQuery($sql,$params);
		if(!$this->db->countRows){
			$posts = $this->getAllUserPostsByUserId($user_id);
		}
		else{
			for($i=0;$i<count($row);$i++){
				$userDetails = $this->user->getUserById($row[$i]["user_id"]);
				$posts[]=array(
					'user_id'=>$row[$i]["user_id"],
					'user_first_name' => $userDetails[0]['user_first_name'],
					'user_last_name' => $userDetails[0]['user_last_name'],
					'user_profile_picture' => $userDetails[0]['user_profile_picture'],
					'post_id'=>$row[$i]["post_id"],
					'post_body'=>$row[$i]["post_body"],
					'post_image'=>base64_encode($row[$i]["post_image"]),
					'post_date'=>$row[$i]["post_date"],
					'likes' => $this->getlike($row[$i]["post_id"]),
					'did_like'=>$this->didlike($row[$i]["post_id"],$user_id),
					'comment_ammount'=>$this->comment->getCommentAmount($row[$i]["post_id"])
				);
			}
		}
		return  $posts;    
	}
}
?>
