var chatID;
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyBwCJI7uJVnBlQMxHiRO7-B2kRLkAvnM3A",
    authDomain: "ortbook-f7262.firebaseapp.com",
    databaseURL: "https://ortbook-f7262.firebaseio.com",
    projectId: "ortbook-f7262",
    storageBucket: "ortbook-f7262.appspot.com",
    messagingSenderId: "118407025410"
  };
  firebase.initializeApp(config);


var userRef = firebase.database().ref('users');
var chatsRef = firebase.database().ref('users/'+userId+'/chats'); // all chats
var otherRef;
var messagesRef;
var numRef;
var messageOUTRef;
var messagesINRef;

 var activeChats = Array();
 var allFriends = Array();


$(document).keydown(function(event){
      if('Escape' == event.key){
          if(messagesRef != null){
              $('#N'+chatID).html("");
              messagesRef.off(); 
              numRef.off();
              otherRef.off();
              messageOUTRef.off();
              messagesINRef.off();
              messageOUTRef = null;
              messagesINRef = null;
              otherRef = null;
              numRef = null;
              messagesRef = null;
          } 
      };
});


function loadMessages(chatId,otherId){
    messagesRef = firebase.database().ref('chats/'+chatId+'/messages');
    chatID = chatId;
    $('#N'+chatId).html("");
    // load other id details
    getUserById(otherId);
    // load my details
    getUserById(userId);
    $('#chatBody').html("");
    messagesRef.on('child_added',function(snapshot){
        var message;
        if(snapshot.child('id').val() == userId){
            message = '<div class="message"><a href="profile.php?id='+userId+'"><img src="data:image/jpeg;base64,'+userProfilePicture+'" alt="Avatar"></a><p class="message-left">'+snapshot.child('text').val()+'</p></div>';
        }else{
            message = '<div class="message"><a href="profile.php?id='+otherId+'"><img src="data:image/jpeg;base64,'+otherProfilePicture+'" alt="Avatar" class="right" ></a><p class="message-right">'+snapshot.child('text').val()+'</p></div>';
        }
        $('#chatBody').append(message);
        // משווה את NUMS
        numRef = firebase.database().ref('chats/'+chatId+'/num');
        numRef.on('value',function(snapshot){
           firebase.database().ref('users/'+userId+'/chats/'+chatId).child('num').set(snapshot.val());  
        })
         
    });              
}



chatsRef.on('child_changed',function(snapshot){
    var key = '#N';
    key += snapshot.key;
    console.log(key);
    var userNum = snapshot.child('num').val();
    firebase.database().ref('chats/'+snapshot.key+'/num').on('value',function(snapshot){
        var result = snapshot.val()-userNum;
        if(result){
           
            $(key).html(result);
            
        }
    })
   
});


chatsRef.on('child_added',function(snapshot,i){
    var otherid = snapshot.child("id").val();
    var userNum = snapshot.child('num').val();
    var keyChat = snapshot.key;
    var key = '#N'+keyChat;
    //build the users list (save key)
    activeChats.push({'user_id':otherid});
    getChatFriendList(otherid,keyChat)

    var tempListener = firebase.database().ref('chats/'+snapshot.key+'/num');
    tempListener.on('value',function(snapshot){
        var result = snapshot.val()-userNum;
        if(result){
            $(key).html(result);
            tempListener.off();
        }
    });
    

});



var num;
function addMessage(chatId,text,otherId){
    messageOUTRef = firebase.database().ref('chats/'+chatId);
    messagesINRef = firebase.database().ref('chats/'+chatId+'/messages');
    messageOUTRef.on('child_added',function(snapshot){
        if(snapshot.key == "num"){
            num = snapshot.val(); // old num inside chat
            if(text != ""){
                    messagesINRef.child(num).set({ // inside massages

                    id:userId,
                    text:text

                });

                messageOUTRef.child('num').set(num+1); 
                // add random 
                var random = Math.floor(1000 + Math.random() * 9000);
                otherRef = firebase.database().ref('users/'+otherId+'/chats/'+chatId);
                otherRef.on('child_added',function(snapshot2){
                    if(snapshot2.key == "random"){
                        otherRef.child("random").set(random);
                    }
                });
            }
            
        }
    });
}

function initConversation(chatId,text,otherid){
    messageOUTRef = firebase.database().ref('chats/'+chatId);
    // me
    userRef.child(userId).child('chats').child(chatId).set({
        id:otherid,
        num:2
    })
    // other
    var random = Math.floor(1000 + Math.random() * 9000);
    userRef.child(otherid).child('chats').child(chatId).set({
        id:userId,
        num:1,
        random:random
    })
    
    
    messageOUTRef.child(userId).set(userId);
    messageOUTRef.child(otherid).set(otherid);
    messageOUTRef.child('messages').child(1).set({
        id:userId,
        text:text
    });
    
    messageOUTRef.child('num').set(2);
    
}

