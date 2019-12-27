<?php

include('/home/s1m0m1lnqe21/public_html/database.php'); 

include('/home/s1m0m1lnqe21/public_html/Loging.php');
include('/home/s1m0m1lnqe21/public_html/PHP Mailer/PHPMailer-5.2-stable/class.phpmailer.php'); 
include('/home/s1m0m1lnqe21/public_html/PHP Mailer/PHPMailer-5.2-stable/class.smtp.php'); 

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

$user_id = "";
$fname = "Name";
if(isset($_POST['login']))
{
	$email=test_input($_POST['email']);
	$password=test_input($_POST['password']);
	
	
   if(DB::query('SELECT email FROM signup WHERE email=:email',array(':email'=>$email)))
		{
if(password_verify($password , DB::query('SELECT password FROM signup WHERE email=:email',array(':email'=>$email))[0]['password']))
			
		{
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
		}else{
		       header("location:index.php");  
		}

// inserting iniatiting privacy rules ends

    DB::query('DELETE FROM reset_password_token WHERE email = :email',array(':email'=>$email));


                                                 
		
		}
		else {

			echo '<h5 style="color:red;position:relative;top:490px;left:25%">incorrect password</h5>';
		}
	
		}else
			{
				echo '<h5 style="color:red;position:relative;top:470px;left:25%">user not registered..</h5>';
			}
		
	
	
}

//code for resetting forgotten password
if(isset($_POST['reset_password_submit'])){
  if(empty($_POST['reset_password_submit'])){

  $reset_password_email = test_input($_POST['email_verify']);
$cstrong=True;
  
    $token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
  if(DB::query('SELECT email FROM signup WHERE email = :email',array(':email'=>$reset_password_email))){

    if(!DB::query('SELECT email FROM reset_password_token WHERE email = :email',array(':email'=>$reset_password_email))){

     

      require 'PHPMailerAutoload.php';
         

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.live.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'blogsar@blogsar.com';                 // SMTP username
$mail->Password = 'gswk273ihh@wk';                           // SMTP password
$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('blogsar@blogsar.com', 'Blogsar');
$mail->addAddress(test_input($_POST['email_verify']));     // Add a recipient
              // Name is optional
$mail->addReplyTo('blogsar@blogsar.com', 'Blogsar');


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Email verification link  for making account in blogify';
$mail->Body    = '<html>Click on this link to reset your password <a href="https://www.blogsar.com/forgott_password.php?q='.$token.'"> reset password!</a></html>';
$mail->AltBody = '<html>Click on this link to reset your password<a href="https://www.blogsar.com/forgott_password.php.php?q='.$token.'"> reset password!</a></html>';

if(!$mail->send()) {
    echo '<p style="position:relative;top:100px;z-index:999;color:red;font-size:20px">verification link could not be sent!</p>';
    echo 'Mailer Error:'. $mail->ErrorInfo;
} else {
   DB::query('INSERT INTO reset_password_token VALUES(\'\' ,:email,:token)',array(':email'=>$reset_password_email,':token'=>$token));

    die('<p style="position:relative;top:100px;z-index:999;color:red;font-size:20px">A link has sent to your email please click that link to reset your password !</p>');
}

    }else{
      die("security token has already been sent");
    }


  }else{
    die("this email is not registered !");
  }
    

  }else{
    die("you altered source code");
  }
}
?>
<!DOCTYPE>
<html lang="en">
<head>
    <meta charset="utf-8">
   
   
    <title>Blogsar-Login into Blogsar to join the community of authors where anyone can earn money through writing article.</title>
     <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
    <meta name="viewport" content="Login into Blogsar to join the community of authors where anyone can earn money through writing article. So hurry up!">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="https://netdna.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" rel="stylesheet">
    <!--pretty important-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- Latest compiled and minified CSS -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho|Fredoka+One" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css">
    <style type="text/css">
    	body{
    margin-top:20px;
    background:#eee;
}
.container {
    margin-right: auto;
    margin-left: auto;
    padding-right: 15px;
    padding-left: 15px;
    width: 100%;
}

@media (min-width: 576px) {
    .container {
        max-width: 540px;
    }
}

@media (min-width: 768px) {
    .container {
        max-width: 720px;
    }
}

@media (min-width: 992px) {
    .container {
        max-width: 960px;
    }
}

@media (min-width: 1200px) {
    .container {
        max-width: 1140px;
    }
}



.card-columns .card {
    margin-bottom: 0.75rem;
}

@media (min-width: 576px) {
    .card-columns {
        column-count: 3;
        column-gap: 1.25rem;
    }
    .card-columns .card {
        display: inline-block;
        width: 100%;
    }
}
.text-muted {
    color: #9faecb !important;
}

p {
    margin-top: 0;
    margin-bottom: 1rem;
}
.mb-3 {
    margin-bottom: 1rem !important;
}

.input-group {
    position: relative;
    display: flex;
    width: 100%;
}

    </style>
    <script>
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/loginpage.php";
}


</script>

<script language=javascript>

if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
 location.replace("https://www.blogsar.com/mobile/signUp.php");
}

</script>
</head>
<body>
    <div style="display:none">Blogsar is an article sharing social media website where users write and share their articles with the people who are eager to read something new something interesting.
So on Blogsar we are building the community of authors and readers to make the world a better place by spreading knowledge through articles.
Blogsar is a platform where anyone can make a huge impact on the internet through his articles.
Main vision of Blogsar to provide writers a way so that they can earn money through writing and sharing articles.
So what are you waiting for ?.
Do signup into Blogsar and be an Author.
Happy reading and writing.</div>
  <div class="w3-top"  >
  
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
 <span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 </div>
</div>

<br>
<br>
<br>
<br>
<br>
<br>
   <form action="loginpage.php" method='post'>
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group mb-0">
          <div class="card p-4">
            <div class="card-body">
              <h1 >Login</h1>
              <p class="text-muted">Sign In to your account</p>
              <div class="input-group mb-3">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" required="">
              </div>
              <div class="input-group mb-4">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required="">
              </div>
              <div class="row">
                <div class="col-6">
                  <input type="submit" name="login" id="login" value="login" class="btn btn-primary px-4"/>
                </div>
                <div class="col-6 text-right">
       <a data-toggle="modal" data-target="#resetPassword"  class="btn btn-danger ">Forgot password?</a>
                </div>
                </form>
              </div>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
            <div class="card-body text-center">
              <div>
                <h2>Sign up</h2>
                <p>Don't have account yet!</p>
                <button type="button" class="btn mt-3"><a href="signUp.php" style="font-family: monospace;">Sign up now!</a></button>
              </div>
            </div>
          </div>
        </div>
       <div id="resetPassword" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px;font-family: Merriweather">Reset password</p>

      </div>
       <div class="modal-body">
  <form action="loginpage.php" method="post">

<div class="form-group">
<input type="email" class="form-control" rows="5" id="" name="email_verify" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px"  placeholder="Enter your email" required >
</div>

  <label  class="btn btn-default"  for="submit_" tabindex="0" title="Submit" style="">submit</label>

<button id="submit_" type="submit" name="reset_password_submit"  class="hidden" ></button>

</form>
       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>
  </div>
</div>         
      </div>
    </div>
  </div>


<!--modal window for reset password-->
    


</body>
</html>


	
	
