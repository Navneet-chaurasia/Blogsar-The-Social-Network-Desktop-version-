   <?php 
     
include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');





function test_input($data){
      
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;


               }

if(isset($_POST['set_admin_password_submit'])){

   if(!empty($_POST['set_admin_password_submit'])){

    $password = test_input($_POST['set_password']);
    $token =    test_input($_POST['token']);


$email = DB::query('SELECT email  FROM admin_reset_password_token WHERE token = :token',array(':token'=>$token))[0]['email'];
 DB::query('UPDATE admin_signup SET password =:password  WHERE email =:email' ,array(':email'=>$email,':password'=>password_hash($password , PASSWORD_BCRYPT)));

 DB::query('DELETE FROM admin_reset_password_token WHERE email = :email',array(':email'=>$email));


  header("location:admin_login.php");



   }else{
    die("source code altered");
   }

}



?>


<!DOCTYPE html>
<html>
   <head>
      <title>blogsar</title>
   
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
<?php
if(isset($_GET['q'])){

     if(!empty($_GET['q'])){

      $token = test_input($_GET['q']);

      if(DB::query('SELECT token FROM admin_reset_password_token WHERE token = :token',array(':token'=>$token))){

        //html code of form

        echo'
        <div class="w3-top">
   
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
 <span style="position: absolute;"><h4 id = "logo" style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px">Blogsar Admin</h4></span>
 </div>
</div>

      <div class="container">
         <div class="row" >
            
            
            
            <div class="col-lg-6"  style="margin-left: 25%" >
               <div id="ui">
                  <h1 class="text-center" style="color:blue;font-family:Merriweather;position: relative;top:-40px">Reset Admin Password</h1>

                  
                  <div class="row">
                     <div class="col-md-10">
                     
                    <form action="admin_reset_password.php" method="post">

 <input type="password" name="set_password" id ="setPassword" class="form-control" placeholder =" Enter your new password" required autocomplete = "off" style="margin:20px;" />
 <input type="hidden" name="token" value="'; echo $token .'"/> 

                     </div>

<input type="submit" name="set_admin_password_submit" value="submit" id="Password_submit"  class="btn btn-primary btn-block btn-md"/>

                    </form>
                  
                  </div>
        
            </form>


</div>
   </div>
      </div>
         </div>';

         

   

      }else{
          
         die('<p style="position:relative;top:100px;left:45%;z-index:999;color:red;font-size:20px">security token is not valid!</p>');
      }


     }else{

      die('<p style="position:relative;top:100px;left:45%;z-index:999;color:red;font-size:20px">Security token is not valid!</p>');
     }
}

?>

   <script>
 
   
</script>
      
      
   </body>
   
   
   
   
</html>