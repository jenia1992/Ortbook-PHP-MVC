var WallIds = [];

function createPost(form) {
    $.ajax({
        url: '../controllers/post.controller.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form,                         
        type: 'post',
        success: function(data){}
     });
}

function Delete(postId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'Delete': 'Delete',
            'post_id': postId
        },
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
    });
}

function getPostById(postId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getPostById': 'DelgetPostByIdete',
            'post_id': postId
        },
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
    });
}

   function reloadPostById(postId){
            return $.ajax({
            url:'../controllers/post.controller.php',
            method:'POST',
            data:{'getPostById':'DelgetPostByIdete',
                  'post_id':postId
                  },
            dataType:'json'
            }).done(function(data){
                console.log(data);
               postReBuilder(data);
            }); 
        }

function editPost(postId, postBody, postImage, userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'editPost': 'editPost',
            'post_id': postId,
            'post_body': postBody,
            'post_image': postImage,
            'user_id': userId
        },
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
    });
}

function getAllUserPostsByUserId(userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getAllUserPostsByUserId': 'getAllUserPostsByUserId',
            'user_id': userId
        },
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
    });
}

function getRating(postId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getRating': 'getRating',
            'post_id': postId
        },
        dataType: 'json'
    }).done(function (data) {
        console.log(data);
    });
}

function like(postId, userId, ratingAction) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'like': 'like',
            'post_id': postId,
            'user_id': userId,
            'rating_action': ratingAction
        },
        dataType: 'json'
    }).done(function (data) {
    });
}

function unlike(postId, userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'unlike': 'unlike',
            'post_id': postId,
            'user_id': userId,
        },
        dataType: 'json'
    }).done(function (data) {
    });
}

function didlike(postId, userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'didlike': 'didlike',
            'post_id': postId,
            'user_id': userId,
        },
        dataType: 'json'
    }).done(function (data) {
    });
}

function getlike(postId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getlike': 'getlike',
            'post_id': postId,
        },
        dataType: 'json'
    }).done(function (data) {
    });
}


function onLike(postId, userId) {
   return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'didlike': 'didlike',
            'post_id': postId,
            'user_id': userId,
        }
    }).done(function (data) {
       reloadPostById(postId);
    });
}


function getWall(userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getWall': 'getWall',
            'user_id': userId,
        },
        dataType: 'json'
    }).done(function (data) {
        postBuilder(data);
    });
}

function getNewWall(userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getNewWall': 'getNewWall',
            'user_id': userId,
            'ids': WallIds[0]
        },
        dataType: 'json'
    }).done(function (data) {
        postBuilder(data);
        WallIds.shift();
    });
}

window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        getNewWall(userId)
    }
};





function getWallIds(userId) {
    return $.ajax({
        url: '../controllers/post.controller.php',
        method: 'POST',
        data: {
            'getWallIds': 'getWallIds',
            'user_id': userId,
        },
        dataType: 'json'
    }).done(function (data) {
        $.each(data,function(i){
            WallIds.push(data[i].post_id);
        })
        
        var i,j,temparray=[],chunk = 5;
        for (i=0,j=WallIds.length; i<j; i+=chunk) {
            temparray.push(WallIds.slice(i,i+chunk));
        }
        WallIds = temparray;
    });
}


function postBuilder(data){
        $.each(data, function(i){
               var post = '<div id="post'+data[i].post_id+'">'
                post += '<div class="row postHead ortBar centeringPost">';      
                     post += '<div class="col-2">';
                       post += '<i class="fas fa-ellipsis-h"></i>';
                   post += '</div>';
                 
                   post += '<div class="col-8 user">';
                      post += '<div class="row username">';
                      post += data[i].user_first_name;
                     post += ' </div>';
                    post += '  <div class="row date">';
                     post += data[i].post_date;
                    post += '  </div>';
                  post += ' </div>';           
                  post += ' <div class="col-2 d-flex justify-content-center">';
                  post += '<a href="profile.php?id='+data[i].user_id+'"><img src="data:image/jpeg;base64,'+data[i].user_profile_picture+'" class=" profile-img"></a>';
                 post += '  </div>';
              post += ' </div>';
              post += '  <div class="row ortBar">';
               post += '    <div class="col d-flex flex-row centeringPost"> ';
              post += '          <p class="mr-2" dir="auto">'+data[i].post_body+'</p>';
             post += '      </div>';
             post += '   </div>';
             post += '   <hr>';
            if(data[i].post_image){
                 post += '    <div class="row">';
                   post += '    <div class="flex-row centeringPost"> ';
                        post += '    <img class="img-fluid" src="data:image/jpeg;base64,'+data[i].post_image+'" alt="alt">';
                 post += '      </div>';
                 post += '   </div>';
                 post += '   <hr>';
            }
           
            
            
            
                   post += '    <div class="row ortBar">';
          if(data[i].comment_ammount!=='0')
               {
				post += '	<div class="col d-flex flex-row justify-content-center centeringPost"> ';
				post += '		<p class="mr-1 fontColor" >תגובות</p>	';
				post += '		<p class="mr-1 fontColor" >'+data[i].comment_ammount+'</p>		';	
				post += '	</div>';
               }
            
            if(data[i].likes){
                post += '		<div class="col d-flex flex-row justify-content-center centeringPost"> ';
				post += '		<p id="amountLikes'+data[i].post_id+'" class="mr-1 fontColor">'+data[i].likes+'</p>';
				post +=  '<i class="fa fa-thumbs-up ftSize  circle  centeringPost"></i>';
			     post += '		</div>';
            }
			
            
            
			post += '	</div>';
			post += '	<hr>';
            post += '    <div class="row ortBar">';
              post += '     <div class="col d-flex flex-row justify-content-center centeringPost" onclick="getComments('+data[i].post_id+','+data[i].likes+')">';
              post += '          <p class="mr-1 fontColor"style="cursor:pointer;">הגב</p>';
             post += '           <i class="far fa-comment-alt fontColor"style="cursor:pointer;"></i>';
             post += '       </div>';
              post += '       <div class="col d-flex flex-row justify-content-center centeringPost" onclick="onLike(' + data[i].post_id + ',' + userId + ')">';
             if(data[i].did_like==1)
                 {
        post += '           <p id="colorLike' + data[i].post_id + '" class="mr-1 fontColor" style="color:blue;cursor:pointer;">לייק</p>';
        post += '         <i id="backColorLike' + data[i].post_id + '" class="far fa-thumbs-up fontColor" style="color:blue;cursor:pointer;"></i>';
                 }
            else
                {
        post += ' <p id="colorLike' + data[i].post_id + '" class="mr-1 fontColor" style="cursor:pointer;"">לייק</p>';
        post += '  <i id="backColorLike' + data[i].post_id + '" class="far fa-thumbs-up fontColor" style="cursor:pointer;"></i>';  
                }
        post += '       </div>';
        post += '      </div>';
        post += '     <hr>';
        post += '     </div>';
         
            $('#wall').append(post);
        });
    }




function postReBuilder(data){
    $.each(data, function(i){
            var post = '<div id="post'+data[i].post_id+'">'
                post += '<div class="row postHead ortBar centeringPost">';      
                     post += '<div class="col-2">';
                       post += '<i class="fas fa-ellipsis-h"></i>';
                   post += '</div>';
                 
                   post += '<div class="col-8 user">';
                      post += '<div class="row username">';
                      post += data[i].user_first_name;
                     post += ' </div>';
                    post += '  <div class="row date">';
                     post += data[i].post_date;
                    post += '  </div>';
                  post += ' </div>';           
                  post += ' <div class="col-2 d-flex justify-content-center">';
                  post += '<a href="profile.php?id='+data[i].user_id+'"><img src="data:image/jpeg;base64,'+data[i].user_profile_picture+'" class=" profile-img"></a>';
                 post += '  </div>';
              post += ' </div>';
              post += '  <div class="row ortBar">';
               post += '    <div class="col d-flex flex-row centeringPost"> ';
              post += '          <p class="mr-2" dir="auto">'+data[i].post_body+'</p>';
             post += '      </div>';
             post += '   </div>';
             post += '   <hr>';
            if(data[i].post_image){
                 post += '    <div class="row">';
                   post += '    <div class="flex-row centeringPost"> ';
                        post += '    <img class="img-fluid" src="data:image/jpeg;base64,'+data[i].post_image+'" alt="alt">';
                 post += '      </div>';
                 post += '   </div>';
                 post += '   <hr>';
            }
           
            
            
            
                   post += '    <div class="row ortBar">';
          if(data[i].comment_ammount!=='0')
               {
				post += '	<div class="col d-flex flex-row justify-content-center centeringPost"> ';
				post += '		<p class="mr-1 fontColor" >תגובות</p>	';
				post += '		<p class="mr-1 fontColor" >'+data[i].comment_ammount+'</p>		';	
				post += '	</div>';
               }
            
            if(data[i].likes){
                post += '		<div class="col d-flex flex-row justify-content-center centeringPost"> ';
				post += '		<p id="amountLikes'+data[i].post_id+'" class="mr-1 fontColor">'+data[i].likes+'</p>';
				post +=  '<i class="fa fa-thumbs-up ftSize  circle  centeringPost"></i>';
			     post += '		</div>';
            }
			
            
            
			post += '	</div>';
			post += '	<hr>';
            post += '    <div class="row ortBar">';
              post += '     <div class="col d-flex flex-row justify-content-center centeringPost" onclick="getComments('+data[i].post_id+','+data[i].likes+')">';
              post += '          <p class="mr-1 fontColor"style="cursor:pointer;">הגב</p>';
             post += '           <i class="far fa-comment-alt fontColor"style="cursor:pointer;"></i>';
             post += '       </div>';
              post += '       <div class="col d-flex flex-row justify-content-center centeringPost" onclick="onLike(' + data[i].post_id + ',' + userId + ')">';
             if(data[i].did_like==1)
                 {
        post += '           <p id="colorLike' + data[i].post_id + '" class="mr-1 fontColor" style="color:blue;cursor:pointer;">לייק</p>';
        post += '         <i id="backColorLike' + data[i].post_id + '" class="far fa-thumbs-up fontColor" style="color:blue;cursor:pointer;"></i>';
                 }
            else
                {
        post += ' <p id="colorLike' + data[i].post_id + '" class="mr-1 fontColor" style="cursor:pointer;">לייק</p>';
        post += '  <i id="backColorLike' + data[i].post_id + '" class="far fa-thumbs-up fontColor" style="cursor:pointer;"></i>';  
                }
        post += '       </div>';
        post += '      </div>';
        post += '     <hr>';
        post += '     </div>';
         
            $('#post'+data[i].post_id).html(post);
        });
}
