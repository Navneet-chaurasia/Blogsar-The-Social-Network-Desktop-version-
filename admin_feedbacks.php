<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');

if(!adminLogin::isAdminLoggedIn()){

      header("location:admin_login.php");  
      die();

}

$userid5 ="";
  
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-Admin Read</title>
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



<style>

.button:hover{
  opacity: 0.7;
}
#hideMenu:hover{
  color:blue;
}

#set:hover{
  color: grey;
}

/** edge broeser detection**/


/* for firefox */
@document url("https://example.com") { 
  .subsBtn2 {
     margin-right:-150px;
  }
}
@media screen and (min-width: 1300px) {


}
@media screen and (min-width: 1300px) {

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
 
  
  div.mainPostDiv{
  right:160px;
  }
  
}
.data{
  max-height: 400px;
  max-width: 400px;
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

.tinyImg{
  max-width: 90%;
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
        /*border-bottom:solid 1px rgba(100, 100, 100, .30);*/
    }
 
/*::-webkit-scrollbar { 
    display: none; }
    /* Let's get this party started */
::-webkit-scrollbar {
    width: 5px;
}

/* Track */
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
  
  var start = 20;
  var working = false;
var stop = 1;
 $(window).scroll(function(){

    if($(this).scrollTop() +70 >= $("body").height() - $(window).height()){


if(working==false && stop>0){

  
   
   working = true; 

var f = -1;
    var dataString = "getBlogsarFeedbakcs=" + start; 
  
 $.ajax({

type: "POST",

url: "forhandlingAjaxAdmin.php",

data: dataString,

cache: false,
dataType:'json',


success: function(data)
                        { 
   

    stop = data[0].length;



 var f = -1;

for(var i=0;i<data[0].length;i++){
 f++;


 $(".PostMainDiv").html(

$(".PostMainDiv").html() + '<div id="notification'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Send Notification About This Article</p></div><div class="modal-body"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write Message</label><textarea class="form-control" rows="5" notificationInfo-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="200" placeholder="Write your message.." required ></textarea></div><label  class="btn btn-default"   for= "sendNotification'+data[0][i].id +'" tabindex="0" title="Send Notification" style="font-size: 15px">Send</label><button id="sendNotification'+data[0][i].id +'" sendNotification-id='+data[0][i].id+' author='+data[0][i].giver_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"><button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div><div id="email'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Send Email About This Article</p></div><div class="modal-body"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write Email</label><textarea class="form-control" rows="5" emailInfo-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="200" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "sendEmail'+data[0][i].id +'" tabindex="0" title="Send Email" style="font-size: 15px">Send</label><button id="sendEmail'+data[0][i].id +'" sendEmail-id='+data[0][i].id+' writer='+data[0][i].giver_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:23%;min-width:700px;position:relative;"> <div class="w3-col m7" style="margin-bottom:10px;margin-top:5px;width:700px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:20px;font-family:Acme;font-size:20px"><a href="#" style="color:black;position:relative">'+data[1][i]+' Gave feedback</a></p></div><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" >'+data[2][i]+data[3][i]+' </div></div></div></div>  <div Div-id='+data[0][i].id+' style="display:block"><div class="description" style="margin-left:0;word-wrap:break-word;margin-bottom:-60px;position:relative;top:15px;margin-bottom:80px;width:100%"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].feedback+'</p><hr></div> </div> </div>  <div style="margin-top:100px"> <div class="" style="margin-left:40px;position:relative;top:-150px;margin-bottom:-200px;max-width:100%"><button type="button" class="btn btn-primary btn-sm" feedbackReview-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[4][i]+'">'+data[5][i]+'</button></div><div class="" style="margin-bottom:-90px;position:relative;top:15px;max-width:100%;left:160px;"> <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;" author-id='+data[0][i].giver_id+' sendThanks-id='+data[0][i].id+'>Thanks</button> </div>' )


//button script for reviewing articles
$('[feedbackReview-id]').click(function(){
var buttonid =   $(this).attr('feedbackReview-id');
var val= $(this).attr('feedbackReview-id');
 
var dataString = "feedbackReviewed=" + val + "&feedback_id="+buttonid;

    
//code to submit form.
$.ajax({
type: "POST",
url: "forhandlingAjaxAdmin.php",
data: dataString,
cache: false,
dataType:'json',
async:false,


success: function(r)
       {

      $("[feedbackReview-id='"+buttonid+"']").html("Reviewed");
     
       $("[feedbackReview-id='"+buttonid+"']").css("background-color",r[1]);

console.log(r);

       }

       });

})



//send email report to the author
$('[sendEmail-id]').click(function(){


     var postid = $(this).attr('sendEmail-id');
var authorID =$(this).attr('writer');

var email_info = $("[emailInfo-id='"+postid+"']").val();

  if(email_info){

  
var dataString1 =  "sendEmailForFeedback=" + authorID + "&email_info="+ email_info + "&feedback_id="+postid;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[emailInfo-id='"+postid+"']").val(" ");
     alert(data);
    
  },error:function(data){

    console.log(data);
  }
  });

}else{

  alert("Email Body is empty");
}
});
 //sending notification in blogsar regarding this article


//send email notification on blogsar to the author
$('[sendNotification-id]').click(function(){
  

     var postid = $(this).attr('sendNotification-id');

var authorID =$(this).attr('author');

var notification_info = $("[notificationInfo-id='"+postid+"']").val();

  if(notification_info){

  
var dataString1 =  "sendNotificationForFeedback=" + authorID + "&notification_info="+ notification_info+"&feedback_id="+postid;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){

     $("[notificationInfo-id='"+postid+"']").val(" ");
     alert(data);
    
  }
  });

}else{

  alert("Notification Body is empty");
}

 });


//send email notification on blogsar to the author
$('[sendThanks-id]').click(function(){
  

     var feedback_id = $(this).attr('sendThanks-id');
var authorId = $(this).attr('author-id');

var dataString1 =  "sendThanks=" + authorId + "&feedback_id="+feedback_id ;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){

    alert(data);
    
  },
  error:function(data){

   alert(data);
  }
  });


 });



}

start+=20;
setTimeout(function(){
  working = false;
});

},
error:function(data){
  console.log(data);

}
});

 }

}

   });



 $(document).ready(function(){



  $(document).ajaxStart(function(){

      $("#loadingImage1").css("display","block");
  });


  $(document).ajaxComplete(function(){

      $("#loadingImage1").css("display","none");
  });

//code for initial 5 articles
var val = 0;
var f = -1;
    var dataString = "getBlogsarFeedbakcs=" + val ;
  
 $.ajax({

type: "POST",

url: "forhandlingAjaxAdmin.php",

data: dataString,

cache: false,
dataType:'json',


success: function(data)

       { 
    
 console.log(data);


for(var i=0;i<data[0].length;i++){
 f++;


 $(".PostMainDiv").html(

$(".PostMainDiv").html() + '<div id="notification'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Send Notification About This Article</p></div><div class="modal-body"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write Message</label><textarea class="form-control" rows="5" notificationInfo-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="200" placeholder="Write your message.." required ></textarea></div><label  class="btn btn-default"   for= "sendNotification'+data[0][i].id +'" tabindex="0" title="Send Notification" style="font-size: 15px">Send</label><button id="sendNotification'+data[0][i].id +'" sendNotification-id='+data[0][i].id+' author='+data[0][i].giver_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"><button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div><div id="email'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Send Email About This Article</p></div><div class="modal-body"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write Email</label><textarea class="form-control" rows="5" emailInfo-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="200" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "sendEmail'+data[0][i].id +'" tabindex="0" title="Send Email" style="font-size: 15px">Send</label><button id="sendEmail'+data[0][i].id +'" sendEmail-id='+data[0][i].id+' writer='+data[0][i].giver_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:23%;min-width:700px;position:relative;"> <div class="w3-col m7" style="margin-bottom:10px;margin-top:5px;width:700px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:20px;font-family:Acme;font-size:20px"><a href="#" style="color:black;position:relative">'+data[1][i]+' Gave feedback</a></p></div><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" >'+data[2][i]+data[3][i]+' </div></div></div></div>  <div Div-id='+data[0][i].id+' style="display:block"><div class="description" style="margin-left:0;word-wrap:break-word;margin-bottom:-60px;position:relative;top:15px;margin-bottom:80px;width:100%"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].feedback+'</p><hr></div> </div> </div>  <div style="margin-top:100px"> <div class="" style="margin-left:40px;position:relative;top:-150px;margin-bottom:-200px;max-width:100%"><button type="button" class="btn btn-primary btn-sm" feedbackReview-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[4][i]+'">'+data[5][i]+'</button></div><div class="" style="margin-bottom:-90px;position:relative;top:15px;max-width:100%;left:160px;"> <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;" author-id='+data[0][i].giver_id+' sendThanks-id='+data[0][i].id+'>Thanks</button> </div>' )


//button script for reviewing articles
$('[feedbackReview-id]').click(function(){
var buttonid =   $(this).attr('feedbackReview-id');
var val= $(this).attr('feedbackReview-id');
 
var dataString = "feedbackReviewed=" + val + "&feedback_id="+buttonid;

    
//code to submit form.
$.ajax({
type: "POST",
url: "forhandlingAjaxAdmin.php",
data: dataString,
cache: false,
dataType:'json',
async:false,


success: function(r)
       {

      $("[feedbackReview-id='"+buttonid+"']").html("Reviewed");
     
       $("[feedbackReview-id='"+buttonid+"']").css("background-color",r[1]);



       }

       });

})


 



//send email report to the author
$('[sendEmail-id]').click(function(){


     var postid = $(this).attr('sendEmail-id');
var authorID =$(this).attr('writer');

var email_info = $("[emailInfo-id='"+postid+"']").val();

  if(email_info){

  
var dataString1 =  "sendEmailForFeedback=" + authorID + "&email_info="+ email_info + "&feedback_id="+postid;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[emailInfo-id='"+postid+"']").val(" ");
     alert(data);
    
  },error:function(data){

    console.log(data);
  }
  });

}else{

  alert("Email Body is empty");
}
});
 //sending notification in blogsar regarding this article


//send email notification on blogsar to the author
$('[sendNotification-id]').click(function(){
  

     var postid = $(this).attr('sendNotification-id');

var authorID =$(this).attr('author');

var notification_info = $("[notificationInfo-id='"+postid+"']").val();

  if(notification_info){

  
var dataString1 =  "sendNotificationForFeedback=" + authorID + "&notification_info="+ notification_info+"&feedback_id="+postid;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){

     $("[notificationInfo-id='"+postid+"']").val(" ");
     alert(data);
    
  }
  });

}else{

  alert("Notification Body is empty");
}

 });


//send email notification on blogsar to the author
$('[sendThanks-id]').click(function(){
  

     var feedback_id = $(this).attr('sendThanks-id');
var authorId = $(this).attr('author-id');

var dataString1 =  "sendThanks=" + authorId + "&feedback_id="+feedback_id ;

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){

    alert(data);
    
  },
  error:function(data){

   alert(data);
  }
  });


 });



}
  //end of all scripts


},
error:function(data){
  console.log(data);

}
});


//detect screen size using javascript to prevent openning website in smaller size//

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
setInterval(getUsers, 90000); 


//notification script end

  });

</script>
</head>
<body class="w3-theme-light-blue" data-gr-c-s-loaded="true">


<!-- Navbar -->
<div class="w3-top"  >
  
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">


<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px"><img src="images/blogsar_logo_black.png" style="width:20px;height:22px">logsar Feedbacks</h4></span>
<span style="position: absolute;right:20px"><h4 id = "totlaUsers" style="font-family:Baloo Bhai;color:blue;font-size: 20px;">users : <?php echo $usersCount;?></h4></span>

  <span style="position: absolute;margin-left: 30px;margin-top: 10px" ><i id="hideMenu" class="fas fa-bars " class="btn btn-info" style="font-size: 30px" ></i></span>
    <a href="admin_home_page.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:30%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="admin_profile.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>


  
 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               
 
         
  
 


<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">

      
      <form action="admin_home_page.php" method="post">
      <input type="submit" name="adminLogout" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           
              <?php
              if($userid5 == 1){
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
<div id="page" class="w3-container w3-content" style="max-width:1400px;margin-top:70px;margin-left: 20px;position: relative;" >    
  <!-- The Grid -->
  <div class="w3-row" >
    <!-- Left Column -->
    <div class="left-column" >
      <div class="profileDiv" id="profile" >
    <div class="w3-col m3" style="position:fixed ;width:17%;min-width: 200px;height:96%;word-wrap: break-word">
      <!-- Profile -->
    
      <center><div class="w3-card w3-round w3-white" style="margin-top: -9px;overflow: auto;overflow-x: hidden;position: absolute;height: 96%;word-wrap: break-word;">
        <div class="w3-container" >
          <div style="height:auto;width:200px;word-wrap: break-word">
            <!--Admin Name-->
<p style="color:blue; font-family:Baloo Bhai;margin-top:10px ;font-size: 22px;margin-bottom:0px"><?php echo $username; ?></p>
</div>
<div  style="position: relative;top:100px">
<a href="admin_feedbacks.php" class="btn btn-info btn-lg" id="feedbacks" style="width:90%;margin-bottom:2px;font-size: 20px">Feeadback</a>

<a href="admin_reportArticles.php" class="btn btn-info btn-lg" id="report" style="width:90%;margin-bottom:2px;font-size: 20px;">Reports</a>

<a href="admin_statics.php" class="btn btn-info btn-lg" id="statistics" style="width:90%;margin-bottom:2px;font-size: 20px">Statistics</a>
<a href="admin_manageContest.php" class="btn btn-info btn-lg btn-danger" id="contest" style="width:90%;margin-bottom:2px;font-size: 20px" title="participate in contest">Contest</a>

   <a href="#" class="btn btn-info btn-lg" id="monetising" style="width:90%;margin-bottom:2px;font-size: 20px">Monetising</a>
     <a href="#" class="btn btn-info btn-lg" id="trendings" style="width:90%;margin-bottom:2px;font-size: 20px">Trendings</a>
       <a href="community Guidelines.html" target="_blank" style="width:90%;margin-bottom:2px;font-size: 15px;color:red">Privacy,cookie,about blogsar</a> <a href="help.html" target="_blank" style="width:90%;margin-bottom:2px;font-size: 15px;color:red">help</a>
          </div>     
</div>
  
        </div>
      </div>
           
      <!-- Alert Box -->
     
   </div>
  </div>
    <!-- End Left Column -->
   


   <!--base for articles appearing-->
 <div class="PostMainDiv">

<!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:40%;display: none">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:40%">

<img src="images/LoadingProgressBar.gif" id="loadingImage3" style="position: fixed;z-index: 9999;display: none;right:40%">
<!--Loading progress bar for article loading  ends-->

        </div>
         <!--base for articles appearing ends--> 
     
    
  
  </div>
<!-- End Page Container -->
</div>



<!-- Footer -->

 

<script>







//notifications js ends


$(document).ready(function(){



$("#hideMenu").click(function(){
 
 $("#profile").css("position","absolute");
  $("#profile").css("z-index","10");
   $("#profile").css("margin-left","-33px");

     $("#trendings").css("margin-left","-30px");
       $("#monetising").css("margin-left","-30px");
         $("#report").css("margin-left","-30px");
          $("#contest").css("margin-left","-30px");
          $("#feedbacks").css("margin-left","-30px");
$("#statistics").css("margin-left","-30px");
          $("#profile").toggle();

});

});

</script>

</body>
</html> 