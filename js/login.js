function logOut(){
     $.ajax({
            url:'../index.php',
            method:'POST',
            data:{'doLogout':'doLogout'},
        }).done(function(data){
            console.log(data);
            window.location.replace("../index.php"); 
        });
}


$(document).ready(function() {
      $("#loginForm").submit(function(event){
            event.preventDefault();
            var formData = $(this).serializeArray();
            var submitBTN = $('#login');
            formData.push({ name: submitBTN[0].name, value: submitBTN[0].value });
            $.ajax({
                url:'index.php',
                method: 'POST',
                data: formData,
                dataType: "json"
            }).done(function(object){
                $.each(object.messages, function() {
                    if(this == "login successfuly"){
                        window.location.replace("index.php");
                    }
                });
                $('#errors').html(""); // clear errors box
                $.each(object.errors, function() {
                    $('#errors').append(this);
                });
            })
      });
});
