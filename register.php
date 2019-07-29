
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Sign Up</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <link rel="stylesheet" href="css/style.index.css">
    <link rel="stylesheet" href="css/style.register.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="window">
        <div class="contentRegular">
			<form action='index.php' method='post'>
				<h1>Sign Up</h1>
				<p class="bold">it's free and always will be.</p>
				<input type="text" placeholder="  First name" name="userFirstName" required>
				<input  type="text"placeholder="  Surname" name="userLastName" required>
				<br>
				<br>
				<input type="email" class="inp"placeholder="  Email or mobile number" name="userEmail" required>
				<br>
			   
				<br>
				<input type="password" class="inp"placeholder="  New password" name="userPassword" required>
				<br>
				<br>
				<p class="bold">Birthday</p>
				<input id="date" type='date' name="userBirthDate"><a id="fontSize"> Why do i need to provide my date of birth?</a>
				<br>
				<br>
				 <input type="radio"  value="female" name="userGender" required> Female <input  id="male" type="radio" name="userGender" value="male"> Male
				<br>
				<br>
				<p id="small">By clicking Sign Up.you agree to our<a> Terms </a>and that you have</p>
				<p id="small">read our <a> Data Policy </a>.include our <a> Cookie User. </a> </p>
				<button type="submit" id="green" name="doRegister"> Sign Up</button>
			</form>
        </div>
    </div>
</body>
<script>
	if(screen.width > 400){
		location.replace('./registerM.php')
	}
</script>
</html>

