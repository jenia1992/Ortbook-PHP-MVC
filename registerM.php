
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>register</title>
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
        <link rel="stylesheet" href="css/style.registerM.css">
        <link rel="stylesheet" href="css/style.index.css">
    </head>
    <body>

        <div class="window">
            <div class="contentRegular" style=background-color:#F7F7F7;>
                <div class="row">
                    <div class="col">
                        <center id="title">
                            <p><b>Join us</b></p>
                        </center>

                    </div>

                </div>
                <div id="regStatus">                
                    <div class="alert alert-primary" role="alert">
                        WOHOO! Your register ended with succes! redirecting in 3 seconds....
                    </div>
                </div>

                <div style="text-align:center;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                </div>
                <div style=background-color:#F7F7F7;>
                    <form id="regForm">

                        <!-- One "tab" for each step in the form: -->
                        <div class="tab"> <center> <h5><b>what is your name?</b></h5>

                            <p class="subTitle">Insert the name that you known for in real life.</p>
                            </center>
                            <div id="container">
                                <div class="row">
                                    <div class="col-5 offset-1"><b>First Name</b></div>
                                    <div class="col-6"><b>Last Name</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-5 offset-1 "><input id="firstName"></div>
                                    <div class="col-6"><input id="lastName"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab"><center> <h5><b>What is your Birthday?</b></h5>
                            <p class="subTitle">Select your birthday and you can always make it private later.</p></center>
                            <div id="container">
                                <div class="row">
                                    <div class="col-6 offset-3"><b>Birthday</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-12 offset-3"> <input id="birthday" type="date" min="1979-12-31" max="2001-12-31"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab"><center> <h5><b>Enter your Email</b></h5>
                            <p class="subTitle">Enter the Email to reach you.You can hide it from your profile later.</p></center>

                            <div id="container">
                                <div class="row">
                                    <div class="col-11 offset-1"><b>Email</b></div>
                                </div>
                                <div class="row">
                                    <div class="col-11 offset-1"><input id="email" style="width: 90%;"type="email" ></div>
                                </div>
                            </div>
                        </div>


                        <div class="tab"><center> <h5><b>What is your gender?</b></h5>
                            <p class="subTitle">Choose your gender.</p></center>
                            <div class="container">
                                <div class="row gender">

                                    <div class="col-6">
                                        <span><i class="fas fa-male"></i>    Male</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="gender" value="male">
                                    </div>
                                </div>

                                <div class="row gender">
                                    <div class="col-6">
                                        <span><i class="fas fa-female"></i>    Female</span>
                                    </div>
                                    <div class="col-6" >
                                        <input type="radio" name="gender" value="Female">
                                    </div>
                                </div>

                                <div class="row gender">
                                    <div class="col-6 ">
                                        <span><i class="fas fa-question"></i>    Other</span>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" name="gender" value="Other" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab"><center> <h5><b>Select a password</b></h5>
                            <p class="subTitle">Create a password with at least 6 characters. It should be so that others can not guess it.</p></center>
                            <div id="container">
                                <div class="row">
                                    <div class="col-11 offset-1"><b>Password</b></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-11 offset-1"><input id="password" style="width: 90%;" type="Password" ></div>
                            </div>
                        </div>

                        <div style=padding:10px;></div>
                        <center>
                            <div>
                                <div id="btn">
                                    <button type="button" class="btn btn-primary" id="nextBtn" onclick="nextPrev(1)"style=width:50%;>>Next</button>
                                    <div style=padding:5px;></div>

                                    <button type="button" class="btn btn-primary" id="prevBtn" onclick="nextPrev(-1)" style=width:50%;>Previous</button>
                                </div>
                            </div>
                        </center>
                        <div style=padding:5px;></div>
                        <div class="row" >
                            <div id="haveAccount" class="col-11 offset-1"> <a href="login.php">Already have an account?</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        $( "#regStatus" ).hide();
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } 
			else {
                document.getElementById("prevBtn").style.display = "inline";
            }
			
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Register";
            } 
			else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)  
        }

        function nextPrev(n) {

            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
                 if (currentTab >= x.length) {
                //...the form gets submitted:
                var firstName = $( "#firstName" ).val();
                var lastName = $( "#lastName" ).val();
                var birthday = $( "#birthday" ).val();
                var password = $( "#password" ).val();
                var email = $( "#email" ).val();
                var gender = document.querySelector('input[name="gender"]:checked').value
                console.log(firstName,lastName,birthday,gender,password);
                $( "#haveAccount" ).hide();
                $( "#btn" ).hide();
                $( "#regStatus" ).show();
                $.ajax({
                    url:'index.php',
                    method:'POST',
                    data: {"userFirstName": firstName,"userLastName": lastName,"userBirthDate": birthday,"userPassword": password,"userGender": gender,"userEmail":email,"doRegister": "doRegister"}
                });
                setTimeout(function(){location.replace('./login.php')}, 3000);
            }
            // Otherwise, display the correct tab:
            if(!(currentTab >= x.length)){
                showTab(currentTab);
            }
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false:
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
        }
    </script>
</html>
