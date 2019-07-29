<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script>
            var userId = <?php echo $_SESSION['userId'] ?>;

        </script>
        <script src="https://www.gstatic.com/firebasejs/5.9.3/firebase.js"></script>
        <script src="../js/massenger.js"></script>
        <link rel="stylesheet" href="../css/style.index.css">
        <script src="../js/globals.js"></script>
        <script src="../js/post.js"></script>
        <script src="../js/users.js"></script>
        <script src="../js/comment.js"></script>
        <script src="../js/search.js"></script>
        <script src="../js/login.js"></script>
    </head>

    <body>
        <div class="window">
            <div class="contentRegular">
                <!-- wall -->
                <div class="container">

                    <!-- Search main header row -->
                    <div class="row ortBar" style="background-color:#4167b2">
                        <div class="col-2 d-flex   centering">
                            <i class="fas fa-camera  headeRiconStyle"></i>
                        </div>
                        <div class="col-8 d-flex justify-content-center centering">
                            <button data-toggle="modal" data-target="#searchModal" type="text" class=" inputStyle fontAwesome"><p>&#xF002; Search</p></button>
                        </div>

                        <div class="col-2 centering">
                            <i class="fab fa-facebook-messenger headeRiconStyle" data-toggle="modal" data-target="#masseges"></i>
                        </div>
                    </div>
                    <!-- /Search main header row -->


                    <!-- Icons row-->
                    <div class="row ortBar d-flex flex-row-reverse" id="icons">
                        <div class="col-2 centering">
                            <i class="fas fa-newspaper allIconStyle"></i>
                        </div>
                        <div class="col-2 centering">
                            <i class="fas fa-users allIconStyle "></i>
                        </div>
                        <div class="col-2 centering">
                            <i class="fab fa-youtube allIconStyle"></i>
                        </div>
                        <div class="col-2 centering">
                            <i class="fas fa-store allIconStyle"></i>
                        </div>
                        <!-- <div class="col-2 centering">
                            <i class=" far fa-bell allIconStyle"></i>
                        </div> -->
                        <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiii--->
                        <div  class="col-2 centering notification1">
                            <i 
								id="notfy"data-toggle="modal" 
								data-target="#notificationModal" 
								class=" far fa-bell allIconStyle" 
								style="cursor: pointer;"
							>
							</i>
                            <span class="badge1" ></span>
                        </div>
                        <!--iiiiiiiiiiiiiiiiiiiiiiiiiiiiiii--->
                        <div class="col-2 centering">
                            <i class="fas fa-align-justify allIconStyle" data-toggle="modal" data-target="#myModal">
                            </i>
                        </div>
                    </div>
                    <!-- /Icons row-->


                    <!-- What's on your mind row -->
                    <div class="row ortBar">
                        <div class="col-2 centering ">
                            <i class="fas fa-image allIconStyle"></i>
                        </div>
                        <div class="col-8 d-flex justify-content-center centeringInput">
                            <input 
								type="text" 
								class="inpuTcentering" 
								data-toggle="modal" 
								data-target="#exampleModal" 
								data-whatever="@getbootstrap" 
								placeholder="  What's on your mind?" 
								readonly
							>
                        </div>
                        <div class="col-2 centering " id="barProfile">
                            <i class="fas fa-user allIconStyle"></i>
                        </div>
                    </div>
                    <!-- /What's on your mind row -->

                    <!-- post -->
                    <div id="wall"></div>
                    <div id="commentsWall"></div>
                    <!-- post end -->

                    <!--modal-->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content">

                                <!-- Modal header -->
                                <div class="row ortBar" style="background-color:#4167b2">
                                    <div class="col-6">
                                        <div>
                                            <h5 class="modal-title " style="color:white">
                                                <div class="d-flex justify-content-around centering">
                                                    <div>
                                                        <i class="fas fa-arrow-left" data-dismiss="modal"></i>
                                                    </div>
                                                    <span><b>Create Post</b></span>
                                                </div>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-6 centering">
                                        <div>
                                            <input type="submit" id="sharePost" form="cratePostForm" value="share">
                                        </div>
                                    </div>
                                </div>
                                <!-- /Modal header -->

                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form id="cratePostForm" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-2 centeringProfileImgModal rounded img-fluid" id="modalProfilePic">
                                            </div>
                                            <span class="col-4 centering" id="modalPostName">-USER_NAME-</span>
                                        </div>
                                        <div class="row">
                                            <div class="form-group centering col-12">
                                                <input type="file" name="post_image" id="post_image" style="display:none">
                                                <textarea class="form-control fontAwesone textAreaPost" name="post_body" id="post_body" rows="6" cols="50" placeholder=" What's on your mind?"></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Modal Body -->

                                <!-- Modal footer -->
                                <div>
                                    <div class="row" id="up">
                                        <div class="col center">
                                            <button id="toggleBtn" type="button" class="btn btn-primary toggleUpBtn toggleBtnClick" aria-label="hidden" onclick="toggle"><i class="fas fa-chevron-up"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row" id="down">
                                        <div class="col center">
                                            <button id="toggleBtn" type="button" class="btn btn-primary toggleDownBtn toggleBtnClick" aria-label="hidden"><i class="fas fa-chevron-down"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="ortBar" style="padding: 15px"></div>

                                <!-- Toggle content -->
                                <div id="toggleContent">
                                    <div class="row ortBar" id="photoNvideo">
                                        <div class="col-11 offset-1 toggleCentering">
                                            <i class="fas fa-image toggleStyle allIconStyle">
                                                <span style="color:black"> Photo/Video</span>
                                            </i>
                                        </div>
                                    </div>

                                    <div class="row ortBar">
                                        <div class="col-11 offset-1 toggleCentering">
                                            <i class="fas fa-user-tag toggleStyle allIconStyle">
                                                <span style="color:black"> Tag Friends</span>
                                            </i>
                                        </div>
                                    </div>

                                    <div class="row ortBar">
                                        <div class="col-11 offset-1 toggleCentering">
                                            <i class="fas fa-smile-wink toggleStyle allIconStyle">
                                                <span style="color:black"> Feeling/Sicker/Sticer</span>
                                            </i>
                                        </div>
                                    </div>

                                    <div class="row ortBar">
                                        <div class="col-11 offset-1 toggleCentering">
                                            <i class="fas fa-map-marker toggleStyle allIconStyle">
                                                <span style="color:black"> Check In</span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="row ortBar">
                                        <div class="col-11 offset-1 toggleCentering">
                                            <i class="fas fa-list-alt  toggleStyle allIconStyle">
                                                <span style="color:black"> List</span>
                                            </i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Toggle content -->

                                <!-- /Modal footer -->

                            </div>
                        </div>
                    </div>
                    <!--/modal-->


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
                    <!-- iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->
                     <!-- modalNotification -->
                    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModallLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content">

                                <!-- Modal Body -->
                                <div id="notificationModalHeader" class="row ortBar" style="background-color:#4167b2">
                                    <div data-dismiss="modal" class="col-2 d-flex justify-content-center centering">
                                        <i class="fas fa-angle-left  headeRSearchiconStyle"></i>
                                    </div>
                                    <div class="col-10 d-flex justify-content-center centering">
                                      <b><p style="color:white;margin-right:50px;">Notification</p></b> 
                                    </div>
                                </div>
                                <div id="notificationModalBody" class="modal-body">

                                </div>
                                <div id="notificationModalFooter">

                                </div>
                                <!-- /Modal Body -->

                            </div>
                        </div>
                    </div>
                    <!-- /modalNotification -->
                    <!-- iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii-->

                    <!--***********  MODALLChatList***************-->

                    <div class="modal fade" id="masseges" tabindex="-1" role="dialog" aria-labelledby="commnetModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content modallChat ">

                                <div id="friendListHeader">
                                    <div class="row friendListHeaderContainer">
                                        <div class="col-12 friendListHeaderData">
                                            <p>ALL CHATS <span id="numFrinds"></span> </p>
                                        </div>
                                    </div>
                                </div>

                                <div id="friendList">
                                    <div id="friends"></div>
                                </div>

                                <div class="friendListFooterContainer" >
                                    <div class="row">
                                        <div class="friendListFooterData col-12 "  data-toggle="modal" data-target="#FriendsListChat" >Friends List</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--***********  /MODALLfriendList ***************-->
                    <div class="modal fade" id="FriendsListChat" tabindex="-1" role="dialog" aria-labelledby="commnetModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content modallChat ">

                                <div id="friendListHeader">
                                    <div class="row friendListHeaderContainer">
                                        <div class="col-12 friendListHeaderData">
                                            <p>ALL FREINDS <span id="numberOfFriends"></span> </p>
                                        </div>
                                    </div>
                                </div>

                                <div id="friendList">
                                    <div id="allFriends">
                                        <!--          all friends list                          -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!--modalchat-->
                    <div class="modal fade" id="chat" tabindex="-1" role="dialog" aria-labelledby="commnetModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full" role="document">
                            <div class="modal-content">
                                <!-- Modal Body -->

                                <div class="row ortBar headerChat">
                                    <div class="col-5">
                                        <div data-dismiss="modal" style="color:#00AAFF" class="d-flex centering">
                                            <div style="width:10px;"></div>
                                            <div>
                                                <i style="font-size:25px;" class="fas fa-angle-left"></i>
                                            </div>
                                            <div style="width:10px;"></div>
                                            <span style="font-size:20px;"><b>Home</b></span>
                                        </div>

                                    </div>
                                    <div class="col-7 centering">
                                        <div>
                                            <span id="chatUserName">{userName}</span>
                                        </div>
                                    </div>
                                </div>

                                <div id="chatBody" class="modal-body"></div>

                                <div id="footerchat">
                                    <div class="row chatBar">
                                        <div id="send" class="col-1 mt-1 ml-1 far fa-paper-plane " style="text-align:center centeringPost"><span id="commentPostId" style="display:none;"></span></div>
                                        <input id="chat_body" class="col-10 cmf " type="text" name="text" placeholder="Type a message..." style="border-radius: 15px; border-bottom: 2px solid gray;  border-right: 2px solid gray;background-color:rgba(247, 247, 247, 0.52) centeringPost" />
                                    </div>
                                    <hr>
                                </div>
                            </div>
                            <!-- /Modal Body -->
                        </div>
                    </div>
                    <!--/modalchat-->

                    <!--***********  MODALLLMENU ***************-->
                    <div class="modal postModal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-full " role="document">
                            <div class="modal-content">
                                <div style="height:60px;" class="modal-header">
                                    <div class=" row justify-content-around">
                                        <div id="modalUserImg" class="col-2"></div>
                                        <div id="modalUserName" class="col-9">

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-body">
                                    <ul class="text-center">
                                        <li>a</li>
                                        <li>b</li>
                                        <li>c</li>
                                        <button onclick="logOut()" name="doLogout" class="btn btn-danger">logOut</button>

                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                    <!--***********///  MODALLLMENU ***************-->
                </div>
            </div>
        </div>
    </body>
    <script>
        $("#toggleContent").hide();
        $("#down").hide();


        var toggle = false;
        $(document).ready(function() {
            getNumberOfFriends(userId)

            //getUserFriends(userId,0)
            $(".toggleBtnClick").click(function() {
                toggle = !toggle;
                if (toggle) {
                    $("#up").hide();
                    $("#down").show();
                    $("#toggleContent").show(300);
                } else {
                    $("#down").hide();
                    $("#up").show();
                    $("#toggleContent").hide(300);
                }
            });
  /*iiiiiiiiiiiiiiiiiiiiiiiiii*/
        
                    $.ajax({
                url: '../controllers/users.controller.php',
                method: 'POST',
                data: {'getNumberOfReq':'getNumberOfReq','user_id':userId}
            }).done(function(data){
            if(data>0)
             {
             $(".badge1").append(data)
             }
             else{
              $(".badge1").append("")            
               }      
             })
         
            
            $("#notfy").click(function(){
                var notify="";
                $("#notificationModalBody").html("")
              $.ajax({
                url: '../controllers/users.controller.php',
                method: 'POST',
                dataType: 'json',
                data: {'getNotifictions':'getNotifictions','user_id':userId}
            }).done(function(data){
                for(var i in data)
                    {
                     notify+='<div class="row">';    
                   notify+='<div class="col-3"><img src="data:image/jpeg;base64,'+data[i][0]['user_profile_picture']+'" alt="" height="42" width="42"></div>';
                   notify+='<div class="col-3"><p>'+data[i][0]['user_first_name']+' '+data[i][0]['user_last_name']+'</p></div>';

                    notify+='<div class="col-3"><p>friend request</p></div>';
                    notify+='<div class="col-1"><i id="acceptFriendReq'+data[i][0]['user_id']+'" onclick="acceptFriendReq('+data[i][0]['user_id']+')" class="fas fa-user-plus"></i></div>';
                     notify+='<div class="col-1"><i id="blockFriendReq'+data[i][0]['user_id']+'" onclick="blockFriendReq('+data[i][0]['user_id']+')" class="fas fa-user-slash"></i></div>';
                    notify+='</div>';
                    notify+='<br>';   

                    }
                    $("#notificationModalBody").append(notify)
                                  $(".badge1").html("")            

            })
            })
            
            
            
            /*iiiiiiiiiiiiiiiiiiiiiiiiii*/

            $.when(getUserById(userId)).done(function() {
                var img = '<a href="profile.php?id='+userId+'"><img class="profile-img" src="data:image/jpeg;base64,' + userProfilePicture + '" alt="alt"></a>';
                var img1 = '<a href="profile.php?id='+userId+'"><img style="height:35px; border-radius:50%;" src="data:image/jpeg;base64,' + userProfilePicture + '" alt="alt"></a>';
                $('#barProfile').html(img);
                $('#modalProfilePic').html(img);
                $('#modalPostName').html(userFirstName);
                $('#modalUserImg').html(img1);
                $('#modalUserName').append(userFirstName + " " + userLastName + "<br> view your profile")
                //getWall(userId);
                $.when(getWallIds(userId)).then(function(){
                    getNewWall(userId);
                });
            });

            $('#cratePostForm').submit(function(event){
                event.preventDefault();

                var file_data = $('#post_image').prop('files')[0]; 
                var form_data = new FormData();     
                var post_body = $('#post_body').val();
                form_data.append('post_image', file_data);
                form_data.append('post_body',post_body);
                form_data.append('createPost','hi');
                form_data.append('user_id',userId);      

                ///////////////////////////  
				$('#wall').html("");
				$.when(createPost(form_data)
				).then(function(){
					//getWall(userId);
                    $.when(getWallIds(userId)).then(function(){
                    getNewWall(userId);
                    });
				}).then (function(){
					window.location.href="index.php" 
				})
				////////////////////////
            });



            $("#photoNvideo").click(function() {
                $("#post_image").click();
            });


            $('.friendListFooterData').click(function(){
                $.ajax({
                    url:'../controllers/users.controller.php',
                    method:"POST",
                    data:{'user_id':userId,'getUserFriends':'getUserFriends','value':0},
                    dataType: 'json'
                }).done(function(data){
                    $.each(data,function(i){

                        if(data[i].user_id != userId){
                            var flag = 0;
                            $.each(activeChats,function(j){
                                if(activeChats[j].user_id == data[i].user_id){
                                    flag = 1;
                                }
                            });
                            if(flag == 0){
                                var key = makeid(4);
                                allFriends.push({'user_id':data[i].user_id,'chatId':key});
                                getChatFriendList(data[i].user_id,key)
                            }
                        }
                    });
                });
            });

        });

        function makeid(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            return result;
        }
        /*iiiiiiiiiiiiiiiiii*/
        function acceptFriendReq(req_id)
        {
            if( $("#acceptFriendReq"+req_id).css("color")=="rgb(0, 128, 0)")
                {
                     $.ajax({
                    url: '../controllers/users.controller.php',
                    method: 'POST',
                    data: {'reAcceptFriendReq':'reAcceptFriendReq','user_id':userId,'other_id':req_id}
                }).done(function(){
                 $("#acceptFriendReq"+req_id).css("color","rgb(33, 37, 41)");
                  
              })
                    
 
                }
            else
                {
              $.ajax({
                url: '../controllers/users.controller.php',
                method: 'POST',
                data: {'acceptFriendReq':'acceptFriendReq','user_id':userId,'other_id':req_id}
             }).done(function(){
                  $("#acceptFriendReq"+req_id).css("color","rgb(0, 128, 0)");
                  $("#blockFriendReq"+req_id).css("color","rgb(33, 37, 41)");
              })
                }
        }
        
         function blockFriendReq(req_id)
        {
            var temp= $( "#blockFriendReq"+req_id ).css( "color" );
            if( $("#blockFriendReq"+req_id).css("color")=="rgb(255, 0, 0)")
                {
                     $.ajax({
                    url: '../controllers/users.controller.php',
                    method: 'POST',
                    data: {'reBlockFriendReq':'reBlockFriendReq','user_id':userId,'other_id':req_id}
                }).done(function(){
                 $("#blockFriendReq"+req_id).css("color","rgb(33, 37, 41)");
                  
              })
                    
 
                }
            else
                {
              $.ajax({
                url: '../controllers/users.controller.php',
                method: 'POST',
                data: {'blockFriendReq':'blockFriendReq','user_id':userId,'other_id':req_id}
             }).done(function(){
                  $("#blockFriendReq"+req_id).css("color","rgb(255,0,0)");
                  $("#acceptFriendReq"+req_id).css("color","rgb(33, 37, 41)");

              })
                }
        }
        /*iiiiiiiiiiiiiiiiii*/

    </script>

</html>
