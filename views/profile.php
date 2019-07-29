<?php
	session_start();
	if(!isset($_GET['id'])){
		die();
	}
?>

<!-- backToIndex -->

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		<link rel="stylesheet" href="../css/style.index.css">
        <link rel="stylesheet" href="../css/style.profile.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		
        <script src="../js/globals.js"></script>
        <script src="../js/post.js"></script>
        <script src="../js/users.js"></script>
        <script src="../js/comment.js"></script>
        <script src="../js/search.js"></script>
        <script src="../js/profile.js"></script>
        <script>
            var userId = <?php echo $_SESSION['userId']; ?>; // my id
            var otherId = <?php echo $_GET['id']; ?>; // other id
        </script>
		
        <title>Profile</title>
    </head>
    <body>
        <div class="window">
            <div class="contentRegular">

                <!-- Porfile header -->
                <div class="row ortBar" style="background-color:#4167b2 ">
                    <div class="col-2">
                        <div class="d-flex justify-content-around left">
                            <i class="fas fa-arrow-left arrow" onclick="backToIndex()"></i>
                        </div>
                    </div>
					<!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
					<div class="col-8 d-flex justify-content-center centering">
						<button data-toggle="modal" data-target="#searchModal" type="text" class=" inputStyle fontAwesome"><p>&#xF002; Search</p></button>
					</div>
					<div class=" col-2 d-flex">
						<i  class="addFriend  fas fa-user-plus" style="font-size:20px;margin-top:10px;color:white;cursor: pointer; display:none;"></i>
					</div>
					<!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
                </div> 
				<!-- /Porfile header -->
				
                <div class="profile">
                    <div>
                        <div class="card hovercard">
                            <div class="cardheader row">
                            </div>
                            <div class="avatar">
                                <!-- here will be the picture of the profile -->
                            </div>
                            <div class="info">
                                <div class="title">
                                    <!-- here will be the name of the profile -->
                                </div>
                            </div>
							
							<!-- setPhotos -->
                            <div class="bottom col" id = "getProfilePhoto">
                                <div class="row" >
                                    <button 
										class="btn2 btn-primary btn-sm row" 								
										type="button" 
										data-toggle="modal" 
										data-target="#SetProfilePhoto"												
									>
										<i class="fas fa-portrait"></i>                                        
                                    </button>

                                    <button 
										class="btn2 btn-warning btn-sm"  
										type="button" 
										data-toggle="modal" 
										data-target="#SetCoverPhoto"												
									>
                                        <i class="fas fa-image"></i>
                                    </button> 
                                </div>
                                <div class="text row ">
                                    <!-- <div >Profile Photo</div>
                                    <div>Cover Photo</div> -->
                                    <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
                                    <div class="col-4" style="position:absalute;right:2%;"> Profile Photo </div>
                                    <div class="col-4" style="position:absalute;left:3%;"> Cover Photo </div>
                                    <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
                               </div>  
                            </div>
							<!-- setPhotos -->
							
                            <!-------------------------------PHOTOS--------------------------------------------->
                            <div class=" photos">
                                <div class="container">
                                    <div class="row">
                                        <h6 class="description col">Photos</h6>
                                        
                                    </div>
                                    <div class="listPhoto row">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <button 
												onclick="getAllPic()" 
												type="button" 
												class="btn btn-secondary btn-block" 
												data-toggle="modal" 
												data-target="#ALLPICModal"
											>
												All Photos
											</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<!-------------------------------PHOTOS--------------------------------------------->
							
                            <!-------------------------------Friends--------------------------------------------->
                            <div class="friends">
                                <div class="container">
                                    <div class="row">
                                        <h6 class="description col">Friends</h6>
                                    </div>
                                    <div class="friendsList row">
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">											
											<button 
												onclick="getAllFriends()" 
												type="button" 
												class="btn btn-secondary btn-block" 
												data-toggle="modal" 
												data-target="#AllFriendsModal"												
											>
												All Friends
											</button>
                                        </div>
                                    </div>
                                </div> <!-- container -->
                            </div> <!-- friends -->
							<!-------------------------------Friends--------------------------------------------->
							
                        </div> <!-- card hovercard -->
                    </div> <!-- no name -->
                </div>  <!-- profile -->
                <div id="wall">
				</div>
            </div>  <!-- contentRegular -->
        </div> <!-- window -->
		
        <!-- ALLPICMODAL --> 
        <div class="modal fade" id="ALLPICModal" role="dialog"  >
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div id="HeaderALLPIC">
                        <div class="row ortBar" style="background-color:#4167b2 ">
                            <div class="col-12">
                                <div>
                                    <div style="margin-left: 15px;">
										<i data-dismiss="modal" class="fas fa-arrow-left arrow " ></i>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bodyALLPIC" class="modal-body">
                        <div class="imgRow"> 
                        </div>
                    </div>
                </div>
            </div>
        </div>		
        <!-- /ALLPICMODAL -->
		
        <!-- AllFriendsModal -->       
        <div class="modal fade" id="AllFriendsModal"  role="dialog"  >
            <div class="modal-dialog modal-full" role="document">
                <div class="modal-content">
                    <div id="HeaderALLFriends">
                        <div class="row ortBar" style="background-color:#4167b2 ">
                            <div class="col-12">
                                <div>
                                    <div style="margin-left: 15px;">
										<i data-dismiss="modal" class="fas fa-arrow-left arrow " ></i>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="bodyAllFriends" class="modal-body">
                        <div class="friendsRow"> 
                        </div>
                   </div>
                </div>
            </div>
        </div>		
        <!-- /AllFriendsModal -->
      <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
          <!--modalComment-->
                    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commnetModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content">

                                <!-- Modal Body -->
                                <div id="HeaderComment">
                                </div>
                                <div id="commentBody" class="modal-body"></div>
                                <div id="footerComment"></div>
                                <!-- /Modal Body -->

                            </div>
                        </div>
                    </div>
                    <!--/modalComment-->
                        <!-- modalSearch -->
                    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content">

                                <!-- Modal Body -->
                                <div id="searchHeader" class="row ortBar" style="background-color:#4167b2">
                                    <div data-dismiss="modal" class="col-1 d-flex justify-content-center centering">
                                        <i class="fas fa-angle-left  headeRSearchiconStyle"></i>
                                    </div>
                                    <div class="col-11 d-flex justify-content-center centering">
                                        <input id="searchInputInModal"  onkeyup="searchUserResults(event)" type="text" class="inputStyle fontAwesome" placeholder="&#xF002; Search">
                                    </div>
                                </div>
                                <div id="searchBody" class="modal-body">

                                </div>
                                <div id="searchFooter">

                                </div>
                                <!-- /Modal Body -->

                            </div>
                        </div>
                    </div>
                    <!-- /modalSearch -->
         <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
		
		<!-- SetProfilePhoto modal-->
		<div class="modal fade" id="SetProfilePhoto" role="dialog" >
			<div class="modal-dialog modal-full" role="document">
				<div class="modal-content">
                    <div id="HeaderGetProfilePhoto">
                        <div class="row ortBar" style="background-color:#4167b2 ">
                            <div class="col-12">
                                <div>
                                    <div style="margin-left: 15px;">
										<i data-dismiss="modal" class="fas fa-arrow-left arrow " >  Set Profile Photo  </i>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- Modal Body -->
					<div class="modal-body">
						<form id="profilePhoto" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group centering col-12">
									<input type="file" name="profilePhotoImag" id="profilePhotoImag" >
									<input type="submit" value="Submit" >									
								</div>
							</div>
						</form>
					</div>
					<!-- /Modal Body -->				
				</div>
			</div>
		</div>
		<!--/SetProfilePhoto modal-->

		<!-- SetCoverPhoto modal-->
		<div class="modal fade" id="SetCoverPhoto" role="dialog" >
			<div class="modal-dialog modal-full" role="document">
				<div class="modal-content">
                    <div id="HeaderGetCoverPhoto">
                        <div class="row ortBar" style="background-color:#4167b2 ">
                            <div class="col-12">
                                <div>
                                    <div style="margin-left: 15px;">
										<i data-dismiss="modal" class="fas fa-arrow-left arrow " >  Set Cover Photo  </i>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
					<!-- Modal Body -->
					<div class="modal-body">
						<form id="coverPhoto" method="post" enctype="multipart/form-data">
							<div class="row">
								<div class="form-group centering col-12">
									<input type="file" name="coverPhotoImag" id="coverPhotoImag" >
									<input type="submit" value="Submit" >									
								</div>
							</div>
						</form>
					</div>
					<!-- /Modal Body -->				
				</div>
			</div>
		</div>
		<!--/SetCoverPhoto modal-->

	
	</body>
</html>
<script>
    function getAllPic(){
        getAllUserGallery(otherId,0);
    }

	$('#SetProfilePhoto').submit(function(event){
		event.preventDefault();
		var file_data  = $('#profilePhotoImag').prop('files')[0]; 
		var form_data = new FormData();     
		form_data.append('SetProfilePhoto','SetProfilePhoto');
		form_data.append('post_image', file_data);
		form_data.append('user_id',userId);
		$.when(SetProfilePhoto(form_data)
		).then(function(){
			window.location.href="index.php";
		});
	});

	$('#SetCoverPhoto').submit(function(event){
		event.preventDefault();
		var file_data  = $('#coverPhotoImag').prop('files')[0]; 
		var form_data = new FormData();     
			form_data.append('SetCoverPhoto','SetCoverPhoto');
			form_data.append('post_image', file_data);
			form_data.append('user_id',userId);
		$.when(SetCoverPhoto(form_data)
		).then(function(){
			window.location.href="index.php";
		});
	});

    function getAllUserGallery(user_id,value){ // if 0 all pictures if other other
        $(".imgRow").html("");

        return $.ajax({
            url: '../controllers/users.controller.php',
            method: 'POST',
            dataType: 'json',
            data: {'getUserGallery':'getUserGallery','user_id':user_id,'value':value},
        }).done(function(data){
            var img;
            $.each(data, function(i){
                img='<div class="column col"><img src="data:image/jpeg;base64,'+
					data[i].picture_file+
					'" style="width:100%"></div>';
                $(".imgRow").append(img);
            });
        });
    }
	
	/***********  All Friends   *************/
    function getAllFriends(){
		getAllUserFriends(otherId,0);
    }
	
    function getUserFriends(user_id,value){ // if 0 all pictures if other other
		$(".friendsList").html("");
		
        return $.ajax({
            url: '../controllers/users.controller.php',
            method: 'POST',
            dataType: 'json',
            data: {'getUserFriends':'getUserFriends','user_id':user_id,'value':value}
        }).done(function(data){
            var img;			
			$.each(data, function(i){
				var myUserID = data[i].user_id;

				$.when(getUserById(myUserID)).done(function(myData) {
					if (otherId != myUserID){
						img ='<div class="column col"><img src="data:image/jpeg;base64,' +
							myData[0].user_profile_picture + 
							'" style="width:40%"><br><p>'+
							myData[0].user_first_name +
							"  "+
							myData[0].user_last_name +
							'</p></div>';
						$(".friendsList").append(img);
					}
				});				
            });
        });
    }
	
    function getAllUserFriends(user_id,value){ // if 0 all pictures if other other
		$(".friendsRow").html("");
		
        return $.ajax({
            url: '../controllers/users.controller.php',
            method: 'POST',
            dataType: 'json',
            data: {'getUserFriends':'getUserFriends','user_id':user_id,'value':value}
        }).done(function(data){
            var img1;
			$.each(data, function(i){
				var myUserID = data[i].user_id;
				
				$.when(getUserById(myUserID)).done(function(myData1) {
					if (otherId != myUserID){
						img1 ='<div class="column"><img src="data:image/jpeg;base64,' +
							myData1[0].user_profile_picture + 
							'" style="width:40%"><br><p>'+
							myData1[0].user_first_name +
							"  "+
							myData1[0].user_last_name +
							'</p></div>';
						$(".friendsRow").append(img1);
					}
				});				
            });
        });
    }
	/***********  All Friends   *************/
    /*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/
    
	$(".addFriend").click(function() {
		return $.ajax({
			url: '../controllers/users.controller.php',
			method: 'POST',
			data: {'addFriend':'addFriend','user_id':userId,'other_id':otherId}
		}).done(function(data){
			$(".addFriend").css("display", "none");
		})
	})
    
    /*iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii*/


</script>








