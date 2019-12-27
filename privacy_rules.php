<?php
include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(!Login::isLoggedIn()){
	header("location:loginpage.php");
  die();
}

if (Login::isLoggedIn()) {
        $userid5 = Login::isLoggedIn();
	  
     
} else {
        
        header("location:loginpage.php");
}

if(isset($_POST['privacy_changes']))
{

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  $name_privacy=test_input($_POST['name']);

     $contact_privacy=test_input($_POST['contact']);
        $dob_privacy=test_input($_POST['dob']);
          $stats_privacy=test_input($_POST['stats']);
            $subscribers_privacy=test_input($_POST['subscribers']);
              $ask_privacy=test_input($_POST['ask']);
                $subscribed_privacy=test_input($_POST['subscribed']);
                $liked_by_me=test_input($_POST['liked_article']);

            if(DB::query('SELECT user_id FROM privacy_rules WHERE user_id=:userid',array(':userid'=>$userid5))){

    DB::query('UPDATE  privacy_rules SET article_stats = :article_stats,asking=:asking,name=:name,dob=:dob,contact=:contact,my_subscribers=:my_subscribers,i_subscribed=:i_subscribed ,myLiked =:myLiked WHERE user_id=:userid' ,array(':userid'=>$userid5,':article_stats'=>$stats_privacy,':asking'=>$ask_privacy,':name'=>$name_privacy,':dob'=>$dob_privacy,':contact'=>$contact_privacy,':my_subscribers'=>$subscribers_privacy,':i_subscribed'=>$subscribed_privacy,':myLiked'=>$liked_by_me));  
      
    }

  }
   
$name_check="";
$contact_check="";
$dob_check="";
$stats_check="";
$subscribers_check="";
$subscribed_privacy="";
$ask_check="";
$liked_check = "";

    $privacy_check =   DB::query('SELECT * FROM privacy_rules WHERE user_id=:userid',array(':userid'=>$userid5));

      foreach ($privacy_check as $p) {
        
        $name_check = $p['name'];
         $contact_check = $p['contact'];
          $dob_check = $p['dob'];
           $stats_check = $p['article_stats'];
            $subscribers_check = $p['my_subscribers'];
             $subscribed_check = $p['i_subscribed'];
              $ask_check = $p['asking'];
              $liked_check =$p['myLiked'];
      }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-privacy rules</title>
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<!--very important style sheet ends-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho|Fredoka+One" rel="stylesheet">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<style>

.button {
  background-color: #ddd;
  border: none;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
}
.button:hover{
  opacity: 0.7;
}


/** edge broeser detection*/
	@supports (-ms-ime-align: auto) {
  .subsBtn2{
        margin-top:30px;
        margin-right:-10px;
  }
  .authRank{

display: none;

  }
  html {
  -ms-overflow-style: -ms-autohiding-scrollbar;
}
}

/* for firefox */
@document url("https://example.com") { 
  .subsBtn2 {
     margin-right:-150px;
  }
}

@media screen and (min-width: 1300px) {
   div#mainDiscussion{
   
    right:150px;
  }
  div.profileDiv{
  display:block;
  }
 
  #hideMenu{
    display: none;
  }
  div.description,.title {
    width:63%;
  }
}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 1299px) {

   div#mainDiscussion{
  
    right:200px;
  }
  div.profileDiv{
  display:block;
  }
  
  #hideMenu{
    display: none;
  }
  div.description,.title {
    width:57%;
  }
}
@media screen and (max-width: 1150px) {
  div.profileDiv{
  display:block;
  }
  
  #hideMenu{
    display: none;
  }
  div.description,.title {
    width:47%;
  }

  div#mainDiscussion{

    right:150px;
  }
}
.blue{
	display:none;
}
@media screen and (max-width: 1000px) {

  
  #hideMenu{
    display: block;
  }
	div.profileDiv{
  display:none;
  }
  
  
 
    
  }
  

/* Dropdown Button */
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
}
/* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

/* Change color of dropdown links on hover */
    
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {display: block;}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {background-color: #3e8e41;}
     
     .notif:hover{
      background-color: #ddd;
     }

    h3 {
        display:block;
        color:#333; 
        background:#FFF;
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
        border-bottom:solid 1px rgba(100, 100, 100, .30);
    }
 
    


/*::-webkit-scrollbar { 
    display: none; }
    /* Let's get this party started */
::-webkit-scrollbar {
    width: 5px;
}

/*Track*/
::-webkit-scrollbar-track {
    background: rgb(0,0,0);
    border: 4px solid transparent;
    background-clip: content-box;   /* THIS IS IMPORTANT */
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: rgb(25,25,25);
    
}

  
    
    .verticalLine {
  border-right: 1.5px solid grey;
  width: 300px;
  height: 280px
}

html {
  -ms-overflow-style: -ms-autohiding-scrollbar;
}
.block{
    margin-left:1000px;
    margin-top:64px;
  position:fixed;
    width: 100%;
    height:auto;
    
  }  

textarea#styled {
	width: 550px;
	height:auto;
	min-height:40px;
	
	border: 3px solid #cccccc;
	padding: 5px;
	font-family: Tahoma, sans-serif;
	background-image: url(bg.gif);
	background-position: bottom right;
	background-repeat: no-repeat;
	resize: vertical;
}
    #answerform{
      width: 100%;
       min-height: 250px;
        max-height: 600px;
        overflow-y:auto;
    }
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}



.img-circle {
    border-radius: 50%;
}

.middle-column{
	margin-top:-30px;
}
.left-column{
	margin-top:-10px;
	
}
/**
progress bar css like youtube :)
*/


</style>

<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/privacy_rules.php";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/privacy_rules.php");
}
-->
</script>


</head>
<body class="w3-theme-light-blue" data-gr-c-s-loaded="true">


<!-- Navbar -->
<div class="w3-top"  >
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">


<span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>


    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Home"  style="margin-left:24%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="personal wall.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>


 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               
              
  <a href="postEditor.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " style="font-size: 30px" aria-hidden="true"></i></a>
         
  



<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">
      <a href="#" class="w3-bar-item w3-button" style="font-size: 17px">Privacy</a>
     
      <form action="logout.php" method="post">
      <input type="submit" name="confirm" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           <a href="block_list.php" class="w3-bar-item w3-button" style="font-size: 17px">blocked</a>
                <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#changePassword" style="font-size: 17px">change password</a>
                    <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#give_feedback" style="font-size: 17px">give feedback</a>
                       <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#about_privacyPage" style="font-size: 17px">about this page</a>
    </div>
<button class="w3-button w3-padding-large  w3-hover-none" title="Settings" ><i class="fa fa-cog" style="font-size: 30px"></i></button>
  </div>

 </div>
</div>
<!--modal window for describing home page-->
<div id="about_privacyPage" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">About Privacy Page</p>

      </div>
       <div class="modal-body">
  
<p style="font-size: 16px;font-family: Roboto">This page is called <b>Privacy page</b>You can set privacy on your data.<br><b></b>
  <ul style="font-size: 16px;font-family: Roboto">
  <li>Following features are present in <b>Privacy page</b>

<ul style="font-size: 16px;font-family: Roboto">
  <li>
You can set that your Name will be visible or not in your about section.
<p style="font-size: 16px;font-family: Roboto;color:red">Your author name and publication name will always be visible to everyone</p>
</li>
<li>
 You can set that your contact (your email adress) will be visible or not in your about section.</li>
 <li>You can set that your DOB will be visible or not in your about section. </li>
 <li>You can allow or disallow asking questions to you.If you disallow than people can't ask question to you.</li>
 <li>You can set that your subscribers list (people who subscribed you) will be visible to other's. If you disallow than people can't see your subscribers in stats page.</li>
 <li>You can set that your subscribing list (people whom you subscribe) will be visible to other's. If you disallow than people can't see your subscribing list in stats page.<li>
 <li> You can set that your liked articles (articles liked by you) will be visible to other's. If you disallow than people can't see your liked artciles in  stats page.</li>

</ul>
  </li>
 
    <li>click save button to save your changes. </li>

</ul>
</p>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>
  </div>
</div> 
   
   <!--mpdal window for ask a question-->
    <div id="changePassword" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">Change password</p>

      </div>
       <div class="modal-body">
  
        <div class="form-group">
  <label for="oldPass" style="float:bottom;position: relative;font-size: 18px">Old password</label>
  <input class="form-control" rows="5" id="oldPass" name="ask" style="margin-top:10px;resize: vertical;  placeholder="Enter old password" />
</div>
<div class="form-group">
  <label for="newPass" style="float:bottom;position: relative;font-size: 18px">New password</label>
  <input class="form-control" rows="5" id="newPass" name="ask" style="margin-top:10px;resize: vertical;  placeholder="Enter new password" />
</div>
<div class="form-group">
  <label for="confirmPass" style="float:bottom;position: relative;font-size: 18px">Confirm password</label>
  <input class="form-control" rows="5" id="confirmPass" name="ask" style="margin-top:10px;resize: vertical;  placeholder="Confirm password" />
</div>

  <label  class="btn btn-default"  for="change" tabindex="0" title="Change password" style="">change</label>

<button id="change" name="uploadSubmit" data-dismiss="modal" class="hidden" ></button>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>
  </div>
</div>            
  <!-- code for changing password--> 



   <!--modal window for sending feedbacks about website-->
    <div id="give_feedback" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">Give feedback</p>

      </div>
       <div class="modal-body">
  
<div class="form-group">
<textarea class="form-control" rows="5" id="web_feedback" name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="5000" placeholder="give feedback about website" required ></textarea>
</div>

  <label  class="btn btn-default"  for="submit_" tabindex="0" title="Submit" style="">submit</label>

<button id="submit_" name="uploadSubmit" data-dismiss="modal" class="hidden" ></button>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>
  </div>
</div>         
<script>
  
$(document).ready(function(){
 
 $("#change").click(function(){

  var x = $("#newPass").val();
  var y = $("#confirmPass").val();

  var old = $("#oldPass").val();

if(x&&y){

  if(x == y){
    
if(old){
    

    var dataString = "oldPass="+old + "&newPass="+x;
    $.ajax({
      type:"POST",
      url:"ForHandligAjax.php",
      data:dataString,
      cache:false,
        global:false,
      success:function(data){
if(data=="incorrect password"){
  alert(data);
}else{
  

   $("#newPass").val(" ");
   $("#confirmPass").val(" ");

   $("#oldPass").val(" ");
   alert(data);

}
      }
    });
  }
  }
}

    });


 // code for giving feedbacks


  $("#submit_").click(function(){

  var feedback = $("#web_feedback").val();
var giver = <?php  echo $userid5 ?>;

if(feedback){

    var dataString = "web_feedback="+feedback + "&giver=" + giver;
    $.ajax({
      type:"POST",
      url:"ForHandligAjax.php",
      data:dataString,
      cache:false,
        global:false,
      success:function(data){

         $("#web_feedback").val("");

      }
    });
  
}

    }); 
});

</script>
  <!-- code for changing password end-->  

<!-- Navbar on small screens -->

<!-- Page Container -->
   
  <!-- The Grid -->
 
 

      <div class="w3-container w3-card w3-white w3-round w3-margin" id="mainDiscussion" style="height: auto;max-width:100%;top:50px;width:60%;min-width: 600px;position: absolute;left:20%">

 <div style="height: auto;position: relative;">

<span id="banner" style="position:absolute;width: 100%;height:30px;background-color:lightgrey">

  <p style="font-family: baloo bhai;font-size: 22px;margin-left: 20px">Privacy Rules</p>

</span>

<form action="privacy_rules.php" method="post">
<div class="well" style="position: relative;width: 100%;height: auto;top:35px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">My name will be visible for everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="name" value="yes" required <?php if($name_check=="yes"){echo "checked"; }?> > No <input type="radio" name="name" value="no" required  <?php if($name_check=="no"){echo "checked"; }?> ></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:22px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">My contact will be visible for everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="contact" value="yes" required <?php if($contact_check=="yes"){echo "checked"; }?>> No <input type="radio" name="contact" value="no" required <?php if($contact_check=="no"){echo "checked"; }?>></p>
</div>


<div class="well" style="position: relative;width: 100%;height: auto;top:8px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">My D.O.B. will be visible for everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="dob" value="yes" required <?php if($dob_check=="yes"){echo "checked"; }?>> No <input type="radio" name="dob" value="no" required <?php if($dob_check=="no"){echo "checked"; }?>></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:-5px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">Allow everyone to ask questions</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="ask" value="yes" required <?php if($ask_check=="yes"){echo "checked"; }?>> No <input type="radio" name="ask" value="no" required <?php if($ask_check=="no"){echo "checked"; }?>></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:-18px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">Show my subscribers to everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="subscribers" value="yes" required <?php if($subscribers_check=="yes"){echo "checked"; }?>> No <input type="radio" name="subscribers" value="no" required <?php if($subscribers_check=="no"){echo "checked"; }?>></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:-30px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">Show my subscribing to everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="subscribed" value="yes" required <?php if($subscribed_check=="yes"){echo "checked"; }?>> No <input type="radio" name="subscribed" value="no" required <?php if($subscribed_check=="no"){echo "checked"; }?>></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:-42px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">Show my article stats to everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="stats" value="yes" required <?php if($stats_check=="yes"){echo "checked"; }?>> No <input type="radio" name="stats" value="no" required <?php if($stats_check=="no"){echo "checked"; }?>></p>
</div>

<div class="well" style="position: relative;width: 100%;height: auto;top:-42px">
  
<p style="font-size:18px;font-family: baloo bhai;color: blue">Show liked articles by me to everyone</p>
<p style="font-size: 15px;font-family: baloo bhai">Yes <input type="radio" name="liked_article" value="yes" required <?php if($liked_check=="yes"){echo "checked"; }?>> No <input type="radio" name="liked_article" value="no" required <?php if($liked_check=="no"){echo "checked"; }?>></p>
</div>

<label  class="btn btn-md btn-primary"  for="save_privacy" style="position: relative;right:0;top:-50px;margin-bottom: -20px">save changes</label>
<button class="hidden" id="save_privacy" type="submit" name="privacy_changes"></button>


</form>

</div>
     
        
                  
   
     
     
    
   <!--maind div of privacy rules starts-->

<!-- copy right mark of Blogsar-->
       <p >Blogsar © 2019</p>
   <!--maind div of privacy rules ends-->
  </div>
<!-- End Page Container -->
</div>



<!-- Footer -->

 

<script>
//for seach button features inhancing and making able to search large variety of data.


//for search button
</script>

</body>
</html> 