
function createComment(comment_body,post_id){
	return $.ajax({
		url:'../controllers/comment.controller.php',
		method:'POST',
		data:{
			'createComment':'createComment',
			'comment_body':comment_body,
			'post_id':post_id,
			'user_id':userId
		},
		dataType:'json'
	}).done(function(){
			loadComments(post_id);
	});
}
	
function getComments(post_id,likes){
	$.when(commentHeaderBuilder(post_id,likes)).then(loadComments(post_id));
}

function insertComment(){
	var commentData=$("#comment_body").val();
	$("#comment_body").val("");
	if(commentData){
		var postId=$("#commentPostId").html();
		console.log(postId);
		createComment(commentData,postId);
		//commentBody();
		reloadComments(postId);
	}
}

function loadComments(post_id){
    return $.ajax({
            url:'../controllers/comment.controller.php',
            method:'POST',
            data:{
				'getComments':'getComments',
				'post_id':post_id
            },
            dataType:'json'
        }).done(function(data){
            commentBody(data);  
            commentFooterBuilder(post_id);
        }).fail(function(){
        commentFooterBuilder(post_id);
    });
}

function reloadComments(post_id){
	return $.ajax({
		url:'../controllers/comment.controller.php',
		method:'POST',
		data:{
			'getComments':'getComments',
			'post_id':post_id
		},
		dataType:'json'
	}).done(function(data){
		commentBody(data);
		reloadPostById(post_id)
	})
}




function commentHeaderBuilder(post_id,likes){
	var headerComment=' <div class="row" style="border-bottom: 0.5px solid #a7a7a7;">';
		headerComment+= '<div class="col-8  centeringPost">';
		headerComment+= '<i class="fa fa-thumbs-up" style="font-size:20px;color:#3b5998"></i>';
		headerComment+='</div>';
		headerComment+= '<div class=" col-1  h5 centeringPost">';
		headerComment+=  '<i class="ml-3  fas fa-angle-left "></i>';
		headerComment+=  '</div>';
		headerComment+=  '<div class="col-1   centeringPost">';
		if(likes > 0){
			headerComment+=   '<p class="mr-1  fontComment font-weight-bold h5">'+likes+'</p>';
		}
		else{
			headerComment+=   '<p class="mr-1  fontComment font-weight-bold h5"></p>';
		}		
		headerComment+=  '</div>';
		headerComment+=  '<div class="col-1    centeringPost">';
		headerComment+=     '<i class="fa fa-thumbs-up ftSize  circle  centeringPost"></i>';
		headerComment+=   '</div>';
		headerComment+= '</div>';
		
	$('#HeaderComment').html(headerComment);
}

function commentBody(data){
	var commentBody = "";
	$.each(data, function(i){
		commentBody+= '<div class="row" id="comment'+data[i].comment_id+'" >';
		commentBody+=  '<div class="col-1 centeringPost">';
		commentBody+=    '<a href="profile.php?id='+data[i].user_id+'"><img src="data:image/jpeg;base64,'+data[i].user_profile_picture+'" class=" profile-img">';
		commentBody+=    '</a></div>';
		commentBody+='<div class="pl-4 col  centeringPost style="border-bottom: 0.5px solid #a7a7a7;">';
		commentBody+=   '<p class="maxComment"><span style="font-weight: bold;">'+data[i].user_first_name+'</span><br>'+data[i].comment_body+'</p>';
		commentBody+=  '</div>';
		commentBody+=  '</div>';
		commentBody+= '</div>';
		commentBody+= '<hr>';      
	});
	
	$('#commentBody').html(commentBody);
}
 
function commentFooterBuilder(post_id){
	var footerComment='<div class="row commentBar">';
		footerComment+= '<div id="send" onclick="insertComment()" class="col-2 mt-1 ml-1 far fa-paper-plane " style="text-align:center centeringPost"><span id="commentPostId" style="display:none;">'+post_id+'</span></div>';
		footerComment+= '<input id="comment_body" class="col-7 cmf " type="text" name="text" placeholder="comment" style="border-radius: 15px; border-bottom: 2px solid gray;  border-right: 2px solid gray;background-color:rgba(247, 247, 247, 0.52) centeringPost"/>';
		footerComment+= '<div class="col-1 mt-1 fas fa-camera" style="text-align:center centeringPost"></div>';
		footerComment+= '<div class="col-1 mt-1 far fa-smile" style="text-align:center centeringPost"></div>'; 
		footerComment+= '</div>';
		footerComment+= '<hr>';

	$('#commentModal').modal('toggle');
	$('#commentModal').modal('show');
	$('#footerComment').html(footerComment);
} 

