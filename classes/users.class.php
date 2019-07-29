<?php
include_once("db.class.php");

class Users{
    private $_db;
    private $_userId;
    private $_userFirstName;
    private $_userLastName;
    private $_userPassword;
    private $_userEmail;
    private $_userProfileImg;
    private $_userBirthDate;
    private $_userGender;
    private $_userFamilyStatus;
    private $_userStatus;
	private $_defaultImg;

    function __construct(){
        $this->_db = DB::getInstance();
		$this->_defaultImg = "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";
    }
	
    public function get_userId(){
        return $this->_userId;
    }

    public function get_userFirstName(){
        return $this->_userFirstName;
    }

    public function set_userFirstName($_userFirstName){
        $this->_userFirstName = $_userFirstName;
    }

    public function get_userLastName(){
        return $this->_userLastName;
    }

    public function set_userLastName($_userLastName){
        $this->_userLastName = $_userLastName;
    }

    public function get_userEmail(){
        return $this->_userEmail;
    }

    public function set_userEmail($_userEmail){
        $this->_userEmail = $_userEmail;
    }

    public function get_userProfileImg(){
        return $this->_userProfileImg;
    }

    public function set_userProfileImg($_userProfileImg){
        $this->_userProfileImg = $_userProfileImg;
    }

    public function get_userBirthDate(){
        return $this->_userBirthDate;
    }

    public function set_userBirthDate($_userBirthDate){
        $this->_userBirthDate = $_userBirthDate;
    }

    public function get_userGender(){
        return $this->_userGender;
    }

    public function set_userGender($_userGender){
        $this->_userGender = $_userGender;
    }

    public function get_userFamilyStatus(){
        return $this->_userFamilyStatus;
    }

    public function set_userFamilyStatus($_userFamilyStatus){
        $this->_userFamilyStatus = $_userFamilyStatus;
    }

    public function get_userStatus(){
        return $this->_userStatus;
    }

    public function set_userStatus($_userStatus){
        $this->_userStatus = $_userStatus;
    }

    public function setUser($_userFirstName,$_userLastName,$_userPassword,$_userEmail,$_userProfileImg,$_userBirthDate,$_userGender){
        if($_userProfileImg==null){
			$_userProfileImg=$this_defaultImg;
        }

        $this->_userFirstName=$_userFirstName;
        $this->_userLastName=$_userLastName;
        $this->_userPassword=$_userPassword;
        $this->_userEmail=$_userEmail;
        $this->_userProfileImg=$_userProfileImg;
        $this->_userBirthDate=$_userBirthDate;
        $this->_userGender=$_userGender;
        $params=array(":user_FirstName"=>$_userFirstName, 
                      ":user_LastName"=>$_userLastName,
                      ":user_Password"=>$_userPassword,
                      ":user_Email"=>$_userEmail,
                      ":user_ProfileImg"=>$_userProfileImg,
                      ":user_BirthDate"=>$_userBirthDate,
                      ":user_Gender"=>$_userGender);

        $sql="INSERT INTO `users`(`user_first_name`, `user_last_name`, `user_email`, `user_password`, `user_birthdate`, `user_profile_picture`, `user_gender`) VALUES (:user_FirstName,:user_LastName,:user_Email,:user_Password,:user_BirthDate,:user_ProfileImg,:user_Gender)";

        $this->_db->paramsQuery($sql,$params);
    }

    public function setUserProfileImg($user_id, $post_image){
		$params=array(
			':post_image'=>$post_image,
		);

		$query= "UPDATE `users` SET `user_profile_picture`=(:post_image) WHERE user_id = $user_id";
		$result=$this->_db->paramsQuery($query,$params);
    }

    public function setUserCoverImg($user_id, $post_image){
		$params=array(
			':post_image'=>$post_image,
			':user_id'=>$user_id
		);
		
		$query= "INSERT INTO `covers` (`user_id`, `cover_file`) VALUES (:user_id, :post_image)";
		$result=$this->_db->paramsQuery($query,$params);
    }

    //this function return all the properties of the user by ID.
    //RETURN SENSETIVE INFO AS PASSWORD SO USE WITH CAUTION(!!).
    public function getUser($user_id){
        $user=array();
        $params = array(":user_id" => $user_id);
        $sql="SELECT * FROM `users` WHERE user_id = :user_id";
        $this->_db->paramsQuery($sql,$params);
        foreach($this->_db->result as $Row){
            $flag = 0;
            if($Row['user_profile_picture']==null){
                $flag = 1; 
				$Row['user_profile_picture']=$this_defaultImg;
            }
			
            if(!$flag){
                $Row['user_profile_picture'] = base64_encode($Row['user_profile_picture']);
                $flag = 0;
            }
			
            $user[]=array(
                'user_id' => $Row['user_id'],     
                'user_first_name' => $Row['user_first_name'],
                'user_last_name' => $Row['user_last_name'],
                'user_password' => $Row['user_password'],  
                'user_birthdate'=> $Row['user_birthdate'],
                'user_profile_picture' => base64_encode($Row['user_profile_picture'])
            );
			
            $this->_userId=$Row['user_id'];
            $this->_userFirstName=$Row['user_first_name'];
            $this->_userLastName=$Row['user_last_name'];
            $this->_userPassword=$Row['user_password'];
            $this->_userBirthDate=$Row['user_birthdate'];
            $this->_userProfileImg=base64_encode($Row['user_profile_picture']);
        }
        return $user;
    }


    //this function get user by email and return id and password.
    public function getUserIdByEmail($email){
        $user=array();
        $params = array(":email" => $email);
        $sql = "SELECT user_id, user_password FROM `users` WHERE user_email = :email";
        $this->_db->paramsQuery($sql,$params);
        foreach($this->_db->result as $Row){ 
            $user[]=array(
                'user_id' => $Row['user_id'],     
                'user_password' => $Row['user_password']
            );

            $this->_userId=$Row['user_id'];
            $this->_userPassword=$Row['user_password'];
        }
        return $user;
    }

    //this function get user by id and return id and password.
    public function getUserById($user_id){
        $user=array();
        $params = array(":user_id" => $user_id);
        $sql = "SELECT user_id, user_first_name, user_last_name, user_profile_picture FROM `users` WHERE user_id = :user_id";

        $this->_db->paramsQuery($sql, $params);

        foreach($this->_db->result as $Row){
            $flag = 0;
            if($Row['user_profile_picture']==null){
                $flag = 1; $Row['user_profile_picture']="iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAASFBMVEX///+ysbCvrq2zsrH8/Py6ubj39/e4t7b4+Pi5uLf09PS9vLvw8O/CwcDc3Nvk5OPNzczGxcTX1tbr6urLysnb2trMzcvT0tLIMGh5AAAGuUlEQVR4nO2d65KjOAxG28YEApg7w/u/6QJJd4dLgjGWZHp1fkzV7Fal+MaybMmW/PXFMAzDMAzDMAzDMAzDMAzDMAzDMAzDMAzDMAzDMAzDMAzDbKCSpujq/kHd5UVzo/4khyRFXaVhFAVBIILHH1F0T3WZN4r62xyQ9ToKxDZBkLZFTP2FZ1BNH0kp3+ibGP63zi9qsCrJtfio7kdk9O+C5qqyOjSR9y2yLa41kCobzNNY36QxqK6kMavTY/oeGtviIraqcv3Oee5ojMqG+uNNaNqDBvpKmvs/jHlkLU9MpppQK/iMKs/oewyj15aaWXiY9TDW/lpqcT8vcNRYemqpKj/hYuYSq4xazBbqnI/xX6Lq3AkcJKb+SXQqcJCofZPY2W1jPkis/HI3hWN9I61PO/HG9QhOlP6si8kdQqAQNbWwb1QFI1BEBbW0B6oGsVHhj0MtQiCB4/7Nh6mYVI72apt4YKeqBtQnREi/KjZAfvSJLKkFqhLSRkeJ1M6mARY4+FNagcpBUL8HrbMp4AUKTbpipPACaXc24LNwoiUcRNDF/oeQLr+YuY3r39KTKYTdzvxAtwFXGkehCKh8TYNkpEL2RL6mh4oLVxCZ6Q0qtF9DZKYNxnL/QNIc1jjM4u8qpEme9mgChbhTTMQbzobmCcVERJyGRBOxwJuGREm3HG01HBVq/At+wDm2JQQ5txg6BTUnwHemtxZVocSPEWFT3WuF+MvF31eYYQWHT4Xdn1eIf1rKClkhK/z/KczRFf799fDv79qQd94ER8EKM00jRESQikKNgIUmuMaHm8VoCYr4/n4mCne5oMgmgt+keSUiOQZ2fvH5A5okqw94J3GJLEmqhRPEnSn+rnTifBWXKVS3MdDWfLLKhARtIuKnoZ5gmSldSSJMmcUKSXftC+lCDeXVvRxlW0NZAaUw4ouAtHSmQxjElPS6fgx7U3+CuPoJfibeiRvY3KCvshMkShdA1Fa+CkypBUJnFQMPOiyA5msk3QXoXxRgiCEpkohrYrgNOE16Zk0GZadB50OB5UgBY6dE2ZlNOhCBnlQBPwBYMiRhqcwW7k8TfSlV/8HxxX3pncCvxKlEDwUOEkt3HlXePRQ4hBnOamhk6qXAYXPjqH2E1H550Rcc9cJqfVoHlzTnA+Kg9mcn8yR5/SdXJ0+G5ayIK/bBXMfJN/ML58qhZjcSMk0/JeNiNMtg1rEyaW01BuksKZMN9iBlnxAGGCp72uT8qoQqKiunGvazzGijpx+XIV0n5aT+6ZMo+9lX3LoqODof035ukMWv06pomtMOI/XyfXLh4rP8kEY56JupUN1Ll0kZ1gR572EA5x+pF//QSdFGn3t5/wgQab1od50sMiNBhb7LadZTLeoXC9mtqfc7eksZtUW2sMJmdWwnI+Ss22aXxKBaunZ1a/pUvB1JOcir8qW8YQHaPA1B7YfZvvnkzYOwpitDOTHTNvxV11svJKwH8AlewPGhl658k/9TTd63Wqf3cOCe6qrsiu117la+n7xY/XeLj9tr2X7okR/fRj4s4TMXugFG/93dTqyDT7B8B0Alhd5xTAjNaWODMHfUeHwbooYldP8tBfCNqmGqYloBDv1wbLKyTD8dgvob83STDHRv/NjBMHxtaKRPACepDubT7kYiBzfbpod2sRHYsXBy+AQmiNKqy97H7INv6XV4OBCBkpgceHRkLrPq82bp5uOsqIexs8tdwUg8cSfhsYMJtG7LiUqHj/9o+4NDzO1eoIuctvzm/E+5l5i824pS4dqjAp5kWyLvTpd+uGbI9rhtvY9bxWWITN1lqNAasx3D3d1h24UQHleZDYQ+s5Y4cqj/vBXo6DZDTi3jEy5qTRq8+i0rTqduYrzmiHacnYoKs8jQirM3p3y3UXG2uenNt/32Fqdaf3rtR7+Rqf0gHk9bkGDf2QW1WvsM1k0zGuovN0VWlkO4l2L3CDtng/HugSusWmMq/5fCXwKbSmGc6klXWDRdiK+xUnxjkV0EuX4PyOEw6natIbQYRC+za584GgvHF1oLnxzcgKM2gXKDPPTmpYPHp/E5VIyJ2uXKFUdCYeRe3a440PMbueujKw6UfQPVE0JjHkSp/pJDeCASBqt6hcY4nQHcRACQyNBIr5KeWWNopngNrpxjaKY4T/7BYPak51U96YhRq1q09+IgMIoSM+qvPEVroPBKScQ1JmlF3D7drjHpFXK92PcVg4mYXHoIhdh/x/va01CIanciXnk1HNm/z3fN4PeX3eKoS53HbLHrapJrhvcv7N3mQ2q6CsiiA/9/0Yx6MU2/TVIAAAAASUVORK5CYII=";
            }
            if(!$flag){
                $Row['user_profile_picture'] = base64_encode($Row['user_profile_picture']);
                $flag = 0;
            }

            $user[]=array(
                'user_id' => $Row['user_id'],
                'user_first_name' => $Row['user_first_name'],
                'user_last_name' => $Row['user_last_name'],
                'user_profile_picture' => $Row['user_profile_picture']
            );
            $this->_userId=$Row['user_id'];
            $this->_userFirstName=$Row['user_first_name'];
            $this->_userLastName=$Row['user_last_name'];
            $this->_userProfileImg=base64_encode($Row['user_profile_picture']);

        }
        return $user;
    }

    //this function return the most recent images (by image id and image file) from user's gallery.
    //$value represent HOW MANY images you want to draw from the DB.
    //if $value set to 0, it will DRAW ALL user images from the DB.
    public function getUserGallery($user_id, $value){
        $gallery = array();
        $params = array(":user_id" => $user_id);
        if($value == 0){//if you want to request all the gallery data
            $sql = "SELECT * FROM `pictures` WHERE user_id = :user_id order by picture_date";
        }
        else{
            $sql = "SELECT * FROM `pictures` WHERE user_id = :user_id order by picture_date LIMIT ".$value;
        }
        $this->_db->paramsQuery($sql, $params);
		
        foreach($this->_db->result as $Row){
            $gallery[] = array(
                'picture_file'=>base64_encode($Row['picture_file']),
                'picture_id'=>$Row['picture_id']
			);
        }
        return $gallery;
    }
	
    public function getCoverById($user_id, $value){
        $cover = array();
        $params = array(":user_id" => $user_id);
        if($value == 0){//if you want to request all the gallery data
            $sql = "SELECT * FROM `covers` WHERE user_id = :user_id order by cover_date";
        }
        else{
            $sql = "SELECT * FROM `covers` WHERE user_id = :user_id order by cover_date DESC LIMIT ".$value;
        }
        $this->_db->paramsQuery($sql, $params);
        foreach($this->_db->result as $Row){
            $cover[] = array(
                'cover_file'=>base64_encode($Row['cover_file']),
                'cover_id'=>$Row['cover_id']
			);
        }
        return $cover;
    }
	
    //this function return the most recent friends (by id) from user's friendlist.
    //$value represent HOW MANY friends you want to draw from the DB.
    //if $value set to 0, it will DRAW ALL user friends from the DB.
    public function getUserFriends($user_id, $value){
        $friends = array();
        $params = array(":user_id" => $user_id ,":status" => 2);
        if($value==0){//if you want to request all the friendship data
            $sql="SELECT DISTINCT `user_id` AS friends from `users` WHERE 
                 `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` = :status)";
        }

        else{
            $sql="SELECT DISTINCT `user_id` AS friends from `users` WHERE 
            `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` = :status) or 
            `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` =:status) or 
            `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` =:status) or 
            `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` =:status) LIMIT ".$value;
        }
        $this->_db->paramsQuery($sql,$params);

        foreach($this->_db->result as $Row){
            $friends[] = array(
                'user_id' => $Row['friends']
            );
        }
        return $friends;
    }

    //counting the number of friends by id, return number.
    public function getNumberOfFriends($user_id){
        $count = array();
        $params = array(":user_id" => $user_id,":status"=>2);
        $sql="SELECT count(DISTINCT `user_id`) AS friends from `users` WHERE 
                 `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `to_id` FROM `friendship` WHERE (`to_id` = :user_id) and `friendship_status` = :status) or
                 `user_id` in (SELECT `ask_id` FROM `friendship` WHERE (`ask_id` = :user_id) and `friendship_status` = :status)";
        $this->_db->paramsQuery($sql, $params);
        foreach($this->_db->result as $Row){
            $count[] = array(
                'friends_count' => $Row['friends']-1
            );
        }

        return $count;
    }

    //this function need email and password of the requested user.
    //this function return true or false based on question if the email existing and then matching the password.
    public function isUserCredentialsCorrect($email, $password){
        $password = md5($password);
        $params = array(":email" => $email);
        $sql = "SELECT * from `users` WHERE `user_email` = :email";
        $this->_db->paramsQuery($sql, $params);
        foreach($this->_db->result as $Row){
            if($Row['user_password'] == $password){
                $this->_userId=$Row['user_id'];
                return true;
            }
            else{
                return false;
            }
        }
    }

    public function getUsersByName($userNameValue){
        $users;
        $params = array(":userName" => $userNameValue.'%');
        $sql = "SELECT * from `users` WHERE `user_first_name` LIKE :userName ";
        $this->_db->paramsQuery($sql, $params);
        foreach($this->_db->result as $Row){
            $users[] = array(
                $Row['user_id'],
                $Row['user_first_name'],
                $Row['user_last_name'],
            );   
        }
        return $users;
    }
	
    /*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/
    // sent an add friend request to the other user and get the pending status
    public function addFriend($user_id,$other_id){
        $params = array(":user_id" => $user_id,":other_id" =>$other_id,":status"=>1);
        $sql = "INSERT INTO `friendship`(`ask_id`, `to_id`, `friendship_status`)
        VALUES (:user_id,:other_id,:status )";
        $this->_db->paramsQuery($sql,$params);
    }
	
    // check if the user already friend of the user , for manging the adding icon 
    public function isFriend($user_id,$other_id){
		$params = array(":user_id" => $user_id,":other_id" =>$other_id);
		$sql="select count(*)  as num from `friendship` where (`to_id`=:user_id AND `ask_id`=:other_id)
		OR (`to_id`=:other_id AND `ask_id`=:user_id)";
		$row=$this->_db->paramsQuery($sql,$params);
		
		if( $row[0]['num'])
		{
			return 1;
		}
		else
		{
			return 0;
		}
    }
    // get number of req that in pending mode
	public function getNumberOfReq($user_id){
  
		$params = array(":user_id" => $user_id);
		$sql="select count(*)  as num from `friendship` where (`to_id`=:user_id AND `friendship_status`=1)";
		$row=$this->_db->paramsQuery($sql,$params);    
   
		if( $row[0]['num']){
			return $row[0]['num'];
		}
		else{
			return 0;
		}
    }
	
    public function getNotifictions($user_id){
         $req=array();
         $params = array(":user_id" => $user_id);
         $sql="select `ask_id`  from `friendship` where (`to_id`=:user_id AND `friendship_status`=1)  LIMIT 5";
         $row=$this->_db->paramsQuery($sql,$params); 
       
            for($i=0;$i<count($row);$i++)
            {
             $num=intval($row[$i]['ask_id']);
             $user=$this->getUserById($num);
             array_push($req, $user);
            }
        return  $req;
    }
    
    public function acceptFriendReq($user_id,$other_id){
        $params = array(":user_id" => $user_id,":other_id" =>$other_id,":status"=>2);
          $sql = "UPDATE `friendship` SET `friendship_status`=:status where (`to_id`=:user_id AND `ask_id`=:other_id)
            OR (`to_id`=:other_id AND `ask_id`=:user_id)";
          $this->_db->paramsQuery($sql,$params);
    }
    
    public function reAcceptFriendReq($user_id,$other_id){
        $params = array(":user_id" => $user_id,":other_id" =>$other_id,":status"=>1);
          $sql = "UPDATE `friendship` SET `friendship_status`=:status where (`to_id`=:user_id AND `ask_id`=:other_id)
            OR (`to_id`=:other_id AND `ask_id`=:user_id)";
          $this->_db->paramsQuery($sql,$params);
    }
	
    public function blockFriendReq($user_id,$other_id){
        
        $params = array(":user_id" => $user_id,":other_id" =>$other_id,":status"=>3);
          $sql = "UPDATE `friendship` SET `friendship_status`=:status where (`to_id`=:user_id AND `ask_id`=:other_id)
            OR (`to_id`=:other_id AND `ask_id`=:user_id)";
          $this->_db->paramsQuery($sql,$params);
    }
    public function reBlockFriendReq($user_id,$other_id){
        $params = array(":user_id" => $user_id,":other_id" =>$other_id,":status"=>1);
          $sql = "UPDATE `friendship` SET `friendship_status`=:status where (`to_id`=:user_id AND `ask_id`=:other_id)
            OR (`to_id`=:other_id AND `ask_id`=:user_id)";
          $this->_db->paramsQuery($sql,$params);
    }
   /*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/


}
?>