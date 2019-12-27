<?php 
	  
include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');


if(Login::isLoggedIn()){

header("location:index.php");
die();

}


function test_input($data) {

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
$display_login = "block";

$display_login_otp = "none";


if(isset($_POST['submit_sign']))
{

  if(!empty($_POST['fname']) &&  !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password1']) && !empty($_POST['password2']) && $_POST['gender'] ){



$Fname=test_input($_POST['fname']);
$Lname=test_input($_POST['lname']);
$email=test_input($_POST['email']);
$password=test_input($_POST['password1']); //md5 for password security
$password2=test_input($_POST['password2']);
$gender=test_input($_POST['gender']);

		$OTP =  rand(111111,999999);

if(!DB::query('SELECT email  FROM signup WHERE email =:email',array(':email'=>$email)))
{
	if($password==$password2)
	{
/*
//email sending script
		$cstrong=True;
		$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));

		

		require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'blogsar@blogsar.com';   
$mail->Password = 'gswk273ihh@wk';                          // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('blogsar@blogsar.com', 'Blogsar');
$mail->addAddress(test_input($_POST['email']), test_input($_POST['fname']));     // Add a recipient
              // Name is optional
$mail->addReplyTo('blogsar@blogsar.com', 'Blogsar');


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'This is One Time Password for login into your Blogsar account ';
$mail->Body    = '<html>Enter this OTP '.$OTP.'</html>';
$mail->AltBody =  '<html>Enter this OTP '.$OTP.'</html>';

if(!$mail->send()) {
   die('<p style="position:relative;top:100px;z-index:999;color:red;font-size:20px">OTP could not be sent!</p>'
    );
} else {
 $display_login = "none";
  $display_login_otp = "block";

	

		DB::query('DELETE FROM email_auth_token WHERE email=:email',array(':email'=>$email));
		

		DB::query('INSERT INTO email_auth_token VALUES(\'\' ,:otp ,:email,:fname,:lname,:gender,:password)',array(':otp'=>$OTP,':email'=>$email,':fname'=>$Fname,':lname'=>$Lname,':gender'=>$gender,':password'=>password_hash($password , PASSWORD_BCRYPT)));





  echo'    <form action="signUp.php" method="post">
    <center><div class="col-md-4" style="display:'.$display_login_otp.';margin-left: 30%;position:relative;top:50px;">
                <label style="color:black">Enter OTP sent in your email adress !</label>
                <input type="text" name="enterd_otp"  class="form-control" placeholder="Enter OTP sent in your email adress" required  autocomplete="off"/>
                <input type="hidden" name="email" value="'.$email.'"/>

             
 <input type="submit"  name="submitOtp" id="otp" value="login" class="btn btn-primary px-4" style="margin-top: 20px">
                 
                  <p style="font-size:15px;color:red">An OTP has sent to your Email it can take few moments. Do not refresh or press back button, it will cause resending of OTP !</p>
              </div>
             </center>
             </form>
             
             ';

}

*/

 DB::query('INSERT INTO signup VALUES(\'\',:fname,:lname,:email,:password,:password2,:gender)',array(':fname'=>$Fname,':lname'=>$Lname,':email'=>$email,':password'=>password_hash($password , PASSWORD_BCRYPT),':password2'=>password_hash($password2 , PASSWORD_BCRYPT),':gender'=>$gender));
 
 

//email sending script
//sending welcome email to users
	require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'blogsar@blogsar.com';   
$mail->Password = 'gswk273ihh@wk';                          // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('blogsar@blogsar.com', 'Blogsar');
$mail->addAddress(test_input($_POST['email']), test_input($_POST['fname']));     // Add a recipient
              // Name is optional
$mail->addReplyTo('blogsar@blogsar.com', 'Blogsar');


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Thank You for joining Blogsar community';
$mail->Body    = '<html><p style="font-size:17px">Now set-up your profile and follow topics to improve your feed<br
>Write articles, monetise your publication and earn money<br>Be prepare for article writing contest starting from 30 april, show your writing skills and earn prizes.</p></html>';
$mail->AltBody =  'Now set-up your profile and follow topics to improve your feed<br
>Write articles, monetise your publication and earn money<br>Be prepare for article writing contest starting from 30 april, show your writing skills and earn prizes.';

if(!$mail->send()) {
   
} else {
    
    
}
//sending welcome email to users end

 $cstrong=True;
	
		$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
		$user_id=DB::query('SELECT id FROM signup WHERE email=:email' ,array(':email'=>$email))[0]['id'];
		DB::query('INSERT INTO token_cookie VALUES(\'\',:token,:user_id)',array(':token'=>sha1($token),'user_id'=>$user_id));
		setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);
		setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,TRUE);
		

		
 $current_authorName=DB::query('SELECT fname FROM signup WHERE id=:userid',array(':userid'=>$user_id))[0]['fname'];

         


    $fname=$current_authorName;
		$age=0;
		$stateName="Nothing to show..";
		$cityName="Nothing to show..";
		$proffession="Nothing to show..";
		$channelImage="postImage/default_image.png";
		$discription="Nothing to show..";
		$aboutAuthor="Nothing to show..";
		$image = "postImage/default_book.png";
	
		if(!DB::query('SELECT user_id FROM channelsetup WHERE user_id=:userid',array(':userid'=>$user_id)))
		 {

      $random_author_name = random::authorName($current_authorName);
$random_channel_name = random::channelName($current_authorName);

     
		DB::query('INSERT INTO channelsetup VALUES(\'\', :userid, :AuthorName,:ChannelName, :Age ,:StateName,:CityName,:Proffession,:channelImage,:discription,:aboutAuthor)',array(':userid'=>$user_id ,':AuthorName'=>$random_author_name,
		        ':ChannelName'=>$random_channel_name, ':Age' =>$age,':StateName'=>$stateName,':CityName'=>$cityName,':Proffession'=>$proffession,':channelImage'=>$channelImage,
		        ':discription'=>$discription,':aboutAuthor'=>$aboutAuthor));

		         
				
		

   


//inserting initial user details
if(!DB::query('SELECT user_id FROM user_details WHERE user_id=:userid',array(':userid'=>$user_id))){

DB::query('INSERT INTO user_details VALUES(\'\', :userid,0 ,"",0,0)',array(':userid'=>$user_id));  
			
		}


//inserting initial user details ends  

  if(!DB::query('SELECT userid FROM profileimage WHERE userid=:userid',array(':userid'=>$user_id))){

DB::query('INSERT INTO profileimage VALUES(\'\', :userid, :imageurl,:fname)',array(':userid'=>$user_id ,':imageurl'=> $channelImage,':fname'=>$fname)); 

        }

    if(!DB::query('SELECT userid FROM headerimages WHERE userid=:userid',array(':userid'=>$user_id))){

        DB::query('INSERT INTO headerimages VALUES(\'\', :imageurl,:userid,:fname)',array(':userid'=>$user_id ,':imageurl'=>$image,':fname'=>$fname)); 

        }

//inserting initial privacy rules
if(!DB::query('SELECT user_id FROM privacy_rules WHERE user_id=:userid',array(':userid'=>$user_id))){
    DB::query('INSERT INTO privacy_rules VALUES(\'\', :userid,"yes","yes","yes","yes","yes","yes","yes","yes")',array(':userid'=>$user_id));  
      
    }
    
    
         header("location:index.php");   
		}
 
 
 
 header("location:loginpage.php");
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

/*

if(isset($_POST['submitOtp'])){


$enterd_otp = $_POST['enterd_otp'];

$email = $_POST['email'];




if(DB::query('SELECT token FROM email_auth_token WHERE email = :email',array(':email'=>$email))[0]['token'] ==$enterd_otp){

 $Fname= DB::query('SELECT Fname FROM email_auth_token WHERE email = :email',array(':email'=>$email))[0]['Fname'];
$Lname=DB::query('SELECT Lname FROM email_auth_token WHERE email = :email',array(':email'=>$email))[0]['Lname'];
$email=DB::query('SELECT email FROM email_auth_token WHERE email = :email',array(':email'=>$email))[0]['email'];
$password=DB::query('SELECT password FROM email_auth_token WHERE email= :email',array(':email'=>$email))[0]['password'];
$password2=DB::query('SELECT password FROM email_auth_token WHERE email = :email',array(':email'=>$email))[0]['password'];

$gender=DB::query('SELECT gender FROM email_auth_token WHERE email=:email',array(':email'=>$email))[0]['gender'];

if(!DB::query('SELECT email  FROM signup WHERE email =:email',array(':email'=>$email))){


       DB::query('INSERT INTO signup VALUES(\'\',:fname,:lname,:email,:password,:password2,:gender)',array(':fname'=>$Fname,':lname'=>$Lname,':email'=>$email,':password'=>$password,':password2'=>$password2,':gender'=>$gender));

          DB::query('DELETE FROM email_auth_token WHERE email = :email',array(':email'=>$email));

header("location:loginpage.php");     

} else{
	die('<p style="position:relative;top:100px;left:45%;z-index:999;color:red;font-size:20px">This link has expired!</p>');
}

     	}else{

     	header("location:signUp.php");
     	}


    



}
*/

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Blogsar-SignUp</title>
		 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
	
<meta name="viewport" content="Blogsar is an article sharing website where anyone earn money by writing and sharing articles.">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!-- jQuery library -->
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho|Fredoka+One" rel="stylesheet">
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
<script>
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/signUp.php";
}


</script>

<script language=javascript>

if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
 location.replace("https://www.blogsar.com/mobile/signUp.php");
}

</script>
	</head>
	<body 

	background-size="cover"
	background-position="center center">

<div style="display:none">Blogsar is an article sharing social media website where users write and share their articles with the people who are eager to read something new something interesting.
So on Blogsar we are building the community of authors and readers to make the world a better place by spreading knowledge through articles.
Blogsar is a platform where anyone can make a huge impact on the internet through his articles.
Main vision of Blogsar to provide writers a way so that they can earn money through writing and sharing articles.
So what are you waiting for ?.
Do signup into Blogsar and be an Author.
Happy reading and writing.</div>
  <div class="w3-top"  >
	<body class="w3-theme-light-blue">
	

<!-- Navbar -->
<div class="w3-top"  >
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
 <span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 </div>
</div>

		<div class="container">
			<div class="row" >
				
				
				
				<div class="col-lg-6"  style="margin-left:;display:<?php echo $display_login?>" >
					<div id="ui">
						<h1 class="text-center" style="color:black">Sign Up</h1>
						<form class="form-group text-center" id="form" action="signUp.php" method="post">
						<div class="row">
							<div class="col-lg-6">
								<label style="color:black">First Name:</label>
								<input type="text" name="fname" id ="fname" class="form-control" placeholder="First name" required autocomplete="off" />
							</div>
							<div class="col-lg-6">
								<label style="color:black">Last Name:</label>
								<input type="text" name="lname" id= "lname" class="form-control" placeholder="Last name" required  autocomplete="off"/>
							</div>
						</div>
						<br>
						<label style="color:black">  Enter valid E-Mail Adress</label>
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
						<p style="font-size: 20px" >choose gender</p>
						<p style="font-family: baloo bhai;font-size: 20px;margin-left: 10px" ><input type="radio" value="Male" name="gender" required="" style="margin-left: 10px;margin-right: 10px">Male <input type="radio" value="Female" name="gender" required="" style="margin-left: 10px;margin-right: 10px"> Female<input type="radio" value="Others" name="gender" required="" style="margin-left: 10px;margin-right: 10px">others</p>
						
						
						<br>
						<input type="submit" name="submit_sign" value="submit" id="signup"  class="btn btn-primary btn-block btn-lg"/>
						<a href="community Guidelines.html" >By sigining up you agree the privacy and cookie policy !</a>
						<h4 ><a href="loginpage.php" style="color:black">Already a member? sign in..</a></h4>
						</form>	
					</div>
					
				</div>
			
				<!--intro of Blogsar-->
				<div class="col-lg-6" style="position: relative;top:80px;border:5px solid #00bfff;height:auto;right:-30px;" ><div style="position: relative;top: 0;border-bottom: 3px solid black"><center><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:0px">About Blogsar</h4></center>


</div>


<p style="font-size: 21px;font-family: Fredoka One">Blogsar is an article sharing social media website where users write and share their articles with the people who are eager to read something new something interesting.<br>
So on Blogsar we are building the community of authors and readers to make the world a better place by spreading knowledge through articles.<br>

Blogsar is a platform where anyone can make a huge impact on the internet through his articles.<br> Main vision of Blogsar is  to provide writers a way so that they can earn money through writing and sharing articles.<br>
So what are you waiting for ?.<br>
Do signup into Blogsar and be an Author.<br>
Happy reading and writing.

</p></div>
			</div>
			
		</div>

	<script>
	
//signup validations

  $(document).ready(function(){

var dem;
$("#email").keyup(function(){

  	var email  =  $("#email").val();

  var dataString = "email_verify=" + email;

 $.ajax({
      
   type:"POST",

   url:"ForHandligAjax.php",

   data:dataString,

   

   success:function(data){

console.log(data);

var x = data;
  if(x == 1){

dem = 1;
  		$("#email_alert").css("display","none");
  		

  }else if(x ==0)
  {
dem = 0;
  	$("#email_alert").css("display","block");

  }

   },
   error:function(data){
console.log(data);

   }


 });
});

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