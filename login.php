
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="css/style.index.css">
        <link rel="stylesheet" href="css/style.login.css">
        <script src="js/login.js"></script>
        <title>Login</title>
    </head>
    <body>
        <div class="window">
            <div class="contentRegular">
                <div class="row">
                    <div class="col">
                        <center id="title">
                            <span><b>ortbook</b></span>
                        </center>
                    </div>
                </div>
                <div style=background-color:#F7F7F7;>
                   <form id="loginForm">
                   <span id="errors"></span>
                    <div class="row">
                        <div class="col">
                            <div style=padding:5px;></div>
                            <center>
                                <input type="text" id="email" placeholder="  Email" name="userEmail" required>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <center>
                                <input type="password" id="password" placeholder="  Password" name="userPassword" required>
                            </center>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div style=padding:5px;></div>
                            <center>
                                <input id="login" type="submit" class="btn btn-primary" name="doLoginWithPostData" value="login">
                            </center>
                        </div>
                    </div>
                    <div style=padding:5px;></div>
                    <div class="row">
                        <div class="col-4 offset-1" >
                            <h5></h5>
                        </div>
                        <div class="col-2">
                            <center>
                                <span id="orTitle"><b>Or</b></span>
                            </center>
                        </div>
                        <div class="col-4">
                            <h5></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <center>
                                <button id="register" type="button"  class="btn btn-success" onclick="location.replace('./register.php')"><b>Register</b></button>
                            </center>
                        </div>
                    </div>
                    <div style=padding:5px;></div>
                    <div class="row">
                        <div class="col">
                            <center>
                                <a href="#">Forgot password?</a>
                            </center>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        if(screen.width > 400){
            location.replace('./loginM.php')
        }
    </script>
</html>

