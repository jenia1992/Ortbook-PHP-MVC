
function getUser(user_id){
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        data: {'getUser':'getUser','user_id':user_id},
        dataType: 'json'
    }).done(function(data){
        $.each(data, function(i){
            $('#user').append(data[i].user_first_name);
        });
    });
}

function getUserGallery(user_id,value){ // if 0 all pictures if other other
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        dataType: 'json',
        data: {'getUserGallery':'getUserGallery','user_id':user_id,'value':value},
    }).done(function(data){
        var img;
        $.each(data, function(i){
            img='<div class="col profile imgp">'
            img+='<div class="img-box">'
            img+='<img src="data:image/jpeg;base64,'+data[i].picture_file+'" width= "70px" height="70px"></div></div>';
            $(".listPhoto").append(img);

        });


    });
}

function getUserByEmail(email){
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        data: {'getUserByEmail':'getUserByEmail','email':email},
        dataType: 'json'
    }).done(function(data){
        $.each(data, function(i){
            $('#user').append(data[i].user_id);
        });
    }); 
}

function getUserById(user_id){
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        data: {'getUserById':'getUserById','user_id':user_id},
        dataType: 'json'
    }).done(function(data){
        $.each(data, function(i){
            if(userId == user_id){
                userFirstName = data[i].user_first_name;
                userLastName = data[i].user_last_name;
                userProfilePicture = data[i].user_profile_picture;
            }else{
                otherFirstName = data[i].user_first_name;
                otherLastName = data[i].user_last_name;
                otherProfilePicture = data[i].user_profile_picture;
            }


        });
    });
}


function getChatFriendList(otherid,keyChat){
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        data: {'getUserById':'getUserById','user_id':otherid},
        dataType: 'json'
    }).done(function(data){
        $("#allFriends").html("");
        $.each(data, function(i){
            var friends='<div id="'+keyChat+'" class="friendsRow row" data-toggle="modal" data-dismiss="modal" data-target="#chat"><div class="OtherPic col-4"><a href="profile.php?id='+otherid+'"><img style="width:40px;height:40px;border:0.075px solid black; border-radius:100%;"src="data:image/jpeg;base64,'+data[i].user_profile_picture+'"alt="alt"><div class="col-1"></a><span id="N'+keyChat+'"></span></div></div>';
            friends+="<div id="+otherid+" class='OtherUserName col-6'>"+data[i].user_first_name+" "+data[i].user_last_name+"</div></div>";
            // for none active users
            var found = false;
            for(var j = 0; j < allFriends.length; j++) {
                if (allFriends[j].user_id == otherid) {
                    found = true;
                    break;
                }
            }
            if(found){
                $("#allFriends").append(friends);
            }
            else{
                // for active chats
                $("#friends").append(friends); // puts in active
            }
            $(".friendsRow").on('click',function(){
                loadMessages(keyChat,otherid);
                var userName = $(this).children("div:last-child");
                $('#chatUserName').html(userName[0].innerHTML);
                $('#send').on('click',function(){
                    var text = $('#chat_body').val();
                    if(found){
                        // init and turn off the found
                        if(text != ""){
                            initConversation(keyChat,text,otherid);
                            found=false;   
                        }
                    }else{
                        addMessage(keyChat,text,otherid); 
                    }
                    $('#chat_body').val("");
                });
            });  

            // active commands

        });
    });

}

function getNumberOfFriends(user_id){
    return $.ajax({
        url: '../controllers/users.controller.php',
        method: 'POST',
        data: {'getNumberOfFriends':'getNumberOfFriends','user_id':user_id},
        dataType: 'json'
    }).done(function(data){
        $.each(data, function(i){
            var numOfFriends="<span style='font-size:11px'>( "+data[i].friends_count+" )</span";
            $('#numFrinds').html(numOfFriends);
            $('#numberOfFriends').html(numOfFriends);

        });
    });
}

function SetProfilePhoto(form) {
    $.ajax({
        url: '../controllers/users.controller.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form,                         
        type: 'post',
        success: function(){
		}
    });
}

function SetCoverPhoto(form) {
    $.ajax({
        url: '../controllers/users.controller.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form,                         
        type: 'post',
        success: function(){
		}
    });
}

