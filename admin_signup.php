	<?php 
	  
include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');


if(!adminLogin::isAdminLoggedIn()){

							header("location:admin_login.php");
							die();

                  }	

         $adminId = adminLogin::isAdminLoggedIn();

        if($adminId != 1){


         	header("location:admin_home_page.php");
							die();
         }

function test_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}



if(isset($_POST['submit_sign']))
{

if(!empty($_POST['adminName']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) ){



$AdminName=test_input($_POST['adminName']);
$email=test_input($_POST['email']);
$password=test_input($_POST['password1']); //md5 for password security
$password2=test_input($_POST['password2']);




if(!DB::query('SELECT email  FROM admin_signup WHERE email =:email',array(':email'=>$email)))
{

	//check password are same or not
	if($password==$password2)
	{

		$image="postImage/default_image.png";

		DB::query('INSERT INTO admin_signup VALUES(\'\' ,:name,:password,:email,:profileImage)',array(':email'=>$email,':name'=>$AdminName,':password'=>password_hash($password , PASSWORD_BCRYPT),':profileImage'=>$image));

		header("location:admin_login.php");


	}else{
	echo '<p style="position:relative;top:395px;left:43%;z-index:999;color:red">password are not same</p>';
	
   
            
	        }
}else
	{echo '<p style="position:relative;top:310px;left:45%;z-index:999;color:red">user already exists</p>';


	}
}else{
	die("you alterd source code");
}
}



?>


<!DOCTYPE html>
<html>
	<head>
		<title>Blogsar-admin sign up</title>
		 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
	
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- jQuery library -->
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho" rel="stylesheet">
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
<style type="text/css">

	#ui{
		background-color:white;
		padding:30px;
		margin-top:50px;
		border-radius: 10px;
		opacity:1;


		
	}
	
	#ui label,h1,h4{
		color:#fff;
		
	}
	
</style>		
	</head>
	<body 

	background-size="cover"
	background-position="center center">

	<body class="w3-theme-light-blue">
	

<!-- Navbar -->
<div class="w3-top"  >
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
 <span style="position:relative;"><h4 id = "logo" style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:35%">Blogsar Administration</h4></span>
 </div>
</div>

		<div class="container">
			<div class="row" >
				
				
				
				<div class="col-lg-6"  style="margin-left: 25%" >
					<div id="ui">
						<h1 class="text-center" style="color:blue;top:-20px;position: relative;">Admin Sign Up</h1>
						<form class="form-group text-center" id="form" action="admin_signup.php" method="post">
						<div class="row">
							
							<div class="col-lg-12">
								<label style="color:black">Enter Your Name:</label>
								<input type="text" name="adminName" id= "admin_name" class="form-control" placeholder="Enter your name as an Administration" required  autocomplete="off"/>
							</div>
						</div>
						<br>
						<label style="color:black"> E-Mail</label>
						<input type="email" name="email" id="email" class ="form-control" placeholder="xyz@email.com" required  autocomplete="off"/>
						<p style="color:red ;display:none;margin-top: 20px " id="email_alert">This email is already registered!</p>
						<br>
			
						<div class="row">
							<div class="col-lg-6">
								<label style="color:black">Set Password:</label>
								<input type="password" name="password1"  id="password1" class="form-control" placeholder="Enter Password" required  autocomplete="off"/>
							</div>
							
					
							<div class="col-lg-6">
								
								<label style="color:black">Confirm Password:</label>
								<input type="password" name="password2" id="password2" class="form-control" placeholder="Re-type password" required  autocomplete="off"/>
							</div>
							<p style="color:red ;display:none;margin-top: 20px " id="password_alert">password are not same!</p>
						</div>
						
						
						
						<br>
						<input type="submit" name="submit_sign" value="submit" id="signup"  class="btn btn-primary btn-block btn-lg"/>
						<a href="privacy_cookie.html" >By sigining up you agree the privacy and cookie policy !</a>
						<h4 ><a href="admin_login.php" style="color:black">Already a member? sign in..</a></h4>
						</form>	
					</div>
					
				</div>
			
				
			</div>
			
		</div>

	<script>
	
//signup validations

  $(document).ready(function(){



      $("#signup").click(function(){


var password1 = $("#password1").val();
var password2 = $("#password2").val();

  if(password1 == password2){
  	return true;
  
  }else{

  	$("#password_alert").css("display","block");
  	return false;
  }

if(dem==1){
	return true;
}else{

}

 


             

      });

  })
	
</script>
		
		
	</body>
	
	
	
	
</html>