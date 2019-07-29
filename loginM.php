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
        <link rel="stylesheet" href="css/style.loginM.css">
        <script src="js/login.js"></script>
        <title>Login</title>
    </head>
    <body>
        <div class="window" >
            <div class="contentRegular text-center">
                <div id="errors"></div>

                <!-- Wall -->  
                <div class="mainBox">

                    <!-- Login logo -->
                    <div class="row">
                        <div class="col">
                            <h1>ortbook</h1>
                        </div>
                    </div><!-- //Login logo -->

                    <!-- Inputs -->
                    <div class="row">
                        <div class="col">
                            <form id="loginForm">
                               <h4 id="errors"></h4>
                                <input 
                                       id="email"
                                       type="email" placeholder="Example@gmail.com"
                                       name="userEmail"
                                       required  >
                                <input 
                                       id="password"
                                       type="password"
                                       placeholder="Password"
                                       name="userPassword"
                                       required    >
                                <input 
                                       id="login"
                                       value="Log In"
                                       type="submit" 
                                       class="btn"
                                       name="doLoginWithPostData">
                            </form>
                            <a 
                               style="color:#f7f7f7;" 
                               href="#">Forgot Password?
                            </a>
                        </div>
                    </div><!-- //Inputs -->

                    <!-- Footer -->
                    <div class="row mt-5">
                        <div class="col pt-5 mt-5">
                            <a 
                               style="color:#f7f7f7;"
                               href="./register.php">Sign Up For Ortbook</a>
                        </div>
                    </div><!-- //Footer -->

                </div><!-- //Wall --> 


            </div><!--//contentRegular -->
        </div><!-- //window -->


    </body>
        <script>
            window.history.pushState('ortbook', 'Title', 'login.php');
    </script>
</html>




