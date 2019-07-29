$(document).ready(function(){
    $.when(getUserById(otherId)
	).then(function(){
		loadProfile();
	});
	
    getMyWall(otherId);
	
	var myButton = document.getElementById("getProfilePhoto");
	if (otherId === userId){
		myButton.style.display = "block";	
	}
	else{
		myButton.style.display = "none";			
		return $.ajax({
			url: '../controllers/users.controller.php',
			method: 'POST',
			data: {
				'isFriend':'isFriend',
				'user_id':userId,
				'other_id':otherId
			}
		}).done(function(data){
			if(data === 1){
				$(".addFriend").css("display", "none");
			}
			else{
				$(".addFriend").css("display", "block");
			}            
		})
	}
});

function loadProfile(){
    var firstName;
    var lastName;
    var profilePicture;
	
    if(userId == otherId){
        firstName = userFirstName;
        lastName = userLastName;
        profilePicture = userProfilePicture;
    }
	else{
        firstName = otherFirstName;
        lastName = otherLastName;
        profilePicture = otherProfilePicture;
    }

    var img = '<img src="data:image/jpeg;base64,'+profilePicture+'">';
    $('.avatar').html(img);
	
    var title = '<b>'+firstName+' '+lastName+'</b>';
    $('.title').html(title);
    getUserCover(otherId,1);
    getUserGallery(otherId,6); // the gallary variable is loaded
	
	getUserFriends(otherId,6);
}


function backToIndex(){
    window.location.replace("index.php");
}

function getUserCover(user_id,value){ // if 0 all pictures if other other
        return $.ajax({
            url: '../controllers/users.controller.php',
            method: 'POST',
            dataType: 'json',
            data: {'getCoverById':'getCoverById','user_id':user_id,'value':value}
        }).done(function(data){
            var img;
                img='<div class="col img-responsive"><img src="data:image/jpeg;base64,'+data[0].cover_file+'" style="height: 190px;align-self: center;"></div>';
                $(".cardheader").append(img);
        });
    }

function getMyWall(userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getMyWall': 'getMyWall',
            'user_id': userId,
        },
        dataType: 'json'
    }).done(function (data) {
        postBuilder(data);
    });
}
