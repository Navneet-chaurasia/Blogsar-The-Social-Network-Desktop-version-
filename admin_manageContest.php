<?php
  
include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(!adminLogin::isAdminLoggedIn()){

      header("location:admin_login.php");  
      die();

}
 //sanatisation function
    function test_input($data){

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}

$userid5 ="";
$data = "";

  
if (adminLogin::isAdminLoggedIn()) {
        $userid5 = adminLogin::isAdminLoggedIn();

        if (isset($_POST['adminLogout'])){
       
                if (isset($_COOKIE['ALID'])) {
                        DB::query('DELETE FROM admin_login_cookie_token WHERE token=:token', array(':token'=>sha1($_COOKIE['ALID'])));
                }
                setcookie('ALID', '1', time()-3600);
                setcookie('ALID_', '1', time()-3600);
        header("location:admin_login.php");
        
}
    
     
} else {
  header("location:admin_login.php");
 die();
}

//getting total users
$users = DB::query('SELECT id FROM signup',array());

$usersCount = count($users);

//getting name of admin
$username=DB::query('SELECT Name FROM  `admin_signup` WHERE id=:userid',array(':userid'=>$userid5))[0]['Name'];
      
  

?>
<!DOCTYPE html>
<html>
<title>Blogsar Manage Contests</title>
<link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--very important style sheet-->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--very important style sheet ends-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho" rel="stylesheet">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script>
  $(document).ready(function(){
  $("#runningc").click(function(){
    $("#createcontest").hide();
    $("#sendemail").hide();
    $("#runningcontest").show();
     $("#sendBulkemail").hide();
       $("#Participants").click(function(){
         $("#arti").hide();
         $("#win").hide();
         $("#Parti").show();
    });
    $("#Articles").click(function(){
         $("#win").hide();
         $("#Parti").hide();
         $("#arti").show();
    });
    $("#Winners").click(function(){
         $("#arti").hide();
         
         $("#Parti").hide();
         $("#win").show();
    });

    });
  

  $("#contest").click(function(){
    $("#runningcontest").hide();
    $("#sendemail").hide();
    $("#createcontest").show();
     $("#sendBulkemail").hide();
  });

   $("#Email").click(function(){

     $("#runningcontest").hide();
     $("#createcontest").hide();
     $("#sendemail").show();
      $("#sendBulkemail").hide();
   });

 $("#BulkEmail").click(function(){

     $("#runningcontest").hide();
     $("#createcontest").hide();
     $("#sendemail").hide();
      $("#sendBulkemail").show();
   });


//getting total user registered in blogsar
var getUsers = function(){
var val = 0;
    var dataString = "getUsers="+val;
$.ajax({
    type:"POST",
    url:"forhandlingAjaxAdmin.php",
    cache:false,
    global:false,
    data:dataString,
    success:function(data1){

      $("#totlaUsers").html("users : "+data1);
 
    }
    });

}
setInterval(getUsers, 90000)

  });
</script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
img {
    width: 100%;
    height: auto;
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<body style="background-color: lightgray">
<!-- Navbar -->
<div class="w3-top"  >
  
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">


<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px"><img src="images/blogsar_logo_black.png" style="width:20px;height:22px">logsar Admin</h4></span>
<span style="position: absolute;right:20px"><h4 id = "totlaUsers" style="font-family:Baloo Bhai;color:blue;font-size: 20px;">users : <?php echo $usersCount;?></h4></span>

    <a href="admin_home_page.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:30%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="admin_profile.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>



 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               
 
         
  
 


<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">

      
      <form action="admin_home_page.php" method="post">
      <input type="submit" name="adminLogout" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           
              <?php
              if($userid5 == 3){
                echo'
                <a  class="w3-bar-item w3-button" href="admin_signup.php" style="font-size: 17px">Create new admin account</a>';
              }
                    ?>
                    
                     
    </div>
<button class="w3-button w3-padding-large  w3-hover-none" title="Settings" ><i class="fa fa-cog" style="font-size: 30px"></i></button>
  </div>

 </div>
</div>

<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:60px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-theme-light-grey w3-margin">
        <div class="w3-container" style="background-color:rgb(240, 240, 240)">
         <h2 class="w3-center" style="font-family:Comic Sans MS">Contest</h2>
        </div>
      </div>
      
      
      <!-- Accordion -->
      <div class="w3-card w3-round w3-margin">
        <div class="w3-#" style="background-color:rgb(240, 240, 240)">
     
       <br>   
       <button class="btn btn-primary" style="width:100%;margin-bottom: 10px" id="contest">Create Contest</button>
      <button class="btn btn-primary" style="width:100%;margin-bottom: 10px" id="runningc">Running Contests</button>
     <button class="btn btn-primary" style="width:100%;margin-bottom: 10px" id="Email">Send Email</button>
        <button class="btn btn-primary" style="width:100%;margin-bottom: 10px" id="BulkEmail">Send Bulk email Email</button>
       
         
        </div>      
      </div>

      

    </div>
    <div id="createcontest" class="w3-col m7" style="display:block;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Create Contest Form</font></h2></center>
        <hr class="w3-clear">
        <p>
         

<div >
  <form action="/action_page.php">
    <label for="fname">Contest Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your name..">

    <label for="lname">Running Time and Date</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

    <label for="subject">Details about Contest</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <label for="subject">Prizes Distribution Details</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <label for="subject">Rules and Regulations</label>
    <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

    <input type="submit" value="Submit">
  </form>
</div>
        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>




    <div id="sendemail" class="w3-col m7" style="display:none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Send Email</font></h2></center>
        <hr class="w3-clear">
        <p>
         

<div >

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required autocomplete="off" id="getEmail" >

    <label for="subject">Compose Email Content</label><br>
<textarea  name="subject" placeholder="Write something.." style="height:200px" required id="getEmailInfo"></textarea>

    <button class="btn btn-info btn-md"  id="sendEmail">send</button>

</div>
        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>



<!--div for sending bulk emails-->
 <div id="sendBulkemail" class="w3-col m7" style="display:none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Send Bulk Emails</font></h2></center>
        <hr class="w3-clear">
        <p>
         

<div >
<div class="well" style="width:100%;height:auto">
    Hii, you have not published articles on Blogsar for a long time.Your followers are waiting for your articles.<br>
    Publish articles on Blogsar.
    <br>
    Enjoy writitng..
</div>

    <button class="btn btn-info btn-md"  id="sendEmailPublishArticle">send</button>

</div>
        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>






    <div id="runningcontest" class="w3-col m7" style="display: none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Running Contest </font></h2></center>
        <hr class="w3-clear">
       <center><button class="btn btn-info" style="margin-left:-60px;width:100px" id="Participants">Participants</button>
       <button class="btn btn-info"  style="margin-left: 30px;width:100px" id="Articles">Articles</button>
       <button class="btn btn-info"  style="margin-left: 40px;width:100px" id="Winners">Winners</button></center>
       <hr>
        <p>
         
<div  id="Parti" style="display:block;">

  <?php  

  $contestParticipant = DB::query('SELECT * FROM contest',array());

$f = 0;
     foreach ( $contestParticipant as $key) {
      $f++;
      $id = $key['user_id'];

 $channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id = :id',array(':id'=>$id))[0]['channelName'];

 $authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$id))[0]['authorRank'];



echo '<div>
 <p>'.$f.'). <a target="_blank" href="admin_profileVisit.php?q='.$id.'">'.$channelName.'</a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$authorStrength.'</p>
</div>';
     }

  ?>
  


</div>

  <div  id="arti" style="display:none;">
 <?php  

  $contestParticipantArticle = DB::query('SELECT post.title,post.id,post.postRank FROM  post,contest WHERE 
    post.user_id = contest.user_id ',array());

$f = 0;
     foreach (  $contestParticipantArticle as $key) {
      $f++;
      $id = $key['id'];
      $articleStrength = $key['postRank'];
      $title = $key['title'];



echo '<div>
 <p>'.$f.'). <a target="_blank" href="admin_ReadForReview.php?q='.$id.'">'.$title.'</a> &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$articleStrength.' </p>
</div>';
     }

  ?>
  
</div>

<div  id="win" style="display:none;">
 <?php  

  $winnerArticle = DB::query('SELECT post.title,post.id,post.postRank,post.user_id FROM post ,contest WHERE

   post.user_id = contest.user_id

   ORDER BY post.postRank DESC LIMIT 10
    ',array());

$f = 0;
     foreach (  $winnerArticle as  $key) {
      $f++;
      $id = $key['id'];
      $articleStrength = $key['postRank'];
      $title = $key['title'];
$authorId = $key['user_id'];
  $channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$authorId))[0]['channelName'];

  $email = DB::query('SELECT email FROM signup WHERE id=:id',array(':id'=>$authorId))[0]['email'];


echo '<div class="well" style="width:100%;height:auto">
 <p>'.$f.'). <a target="_blank" href="admin_ReadForReview.php?q='.$id.'">'.$title.'</a></p>
 
 <p>Channel Name : <a target="_blank" href="admin_profileVisit.php?q='.$authorId.'">'.$channelName.'</a></p>
 Email : '.$email.'
</div>';
     }

  ?>
  
</div>
        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>

    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>
<script>
  //javascript code for sending emails
$(document).ready(function(){

   $("#sendEmail").click(function(){

          var email = $("#getEmail").val();
          var emailInfo = $("#getEmailInfo").val();

          if(email && emailInfo){

            var dataString = "sendEmailRandomly="+email + "&emailInfo="+emailInfo;

            $.ajax({
         

         type:"POST",
         url:"forhandlingAjaxAdmin.php",
         cache:false,
         data:dataString,
         async:false,
         success:function(data){
 $("#getEmail").val("");
      $("#getEmailInfo").val("");

          alert(data);



         },
         error:function(data){

    console.log(data);

         }





            });


          }else{


            alert("please fill all field");
          }


   })
   
   
      $("#sendEmailPublishArticle").click(function(){

          
var val = 0;
         
alert("you want to send bulk emails");
            var dataString = "sendEmailPublishArticle="+val;

            $.ajax({
         

         type:"POST",
         url:"forhandlingAjaxAdmin.php",
         cache:false,
         data:dataString,
         async:false,
         success:function(data){


          alert(data);



         },
         error:function(data){

    console.log(data);

         }





            });


         


   })


})


</script>

</body>
</html> 
