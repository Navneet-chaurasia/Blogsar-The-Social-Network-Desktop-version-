<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');

$userid5="";
if(!Login::isLoggedIn()){

	header("location:loginpage.php");

}

	
if (Login::isLoggedIn()) {

        $userid5 = Login::isLoggedIn();
	  
     
} else {

      header("location:loginpage.php");

}
 

 if(isset($_POST['submit_contest'])){

  if(!empty($_POST['agree'])){

       if(!DB::query('SELECT user_id FROM contest WHERE user_id=:id',array(':id'=>$userid5))){
    $email  =  DB::query('SELECT email FROM signup WHERE id=:id',array(':id'=>$userid5))[0]['email'];

   DB::query('INSERT INTO contest VALUES (\'\' , :userid,:email)',array(':userid'=>$userid5,':email'=>$email));
   
   $email = DB::query('SELECT email FROM signup WHERE id=:id',array(':id'=>$userid5))[0]['email'];
   $fname = DB::query('SELECT fname FROM signup WHERE id=:id',array(':id'=>$userid5))[0]['fname'];
   
   
     //email sending script

     require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

//$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'blogsar.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'official@blogsar.com';                 // SMTP username
$mail->Password = 'H3110N@vn33t';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('official@blogsar.com', 'Blogsar');
$mail->addAddress($email);     // Add a recipient
              // Name is optional
$mail->addReplyTo('official@blogsar.com', 'Blogsar');


//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                    //Set email format to HTML

$mail->Subject = 'This is a Notification From Blogsar';
$mail->Body    = '<html><p style="font-size:15px">Congratulation '.$fname.', you have successfully registered in Article Writing contest on Blogsar.<br>
Now you can start writing articles on Blogsar, winners will be anounced on 30th may.
<br>
Happy writing, Team Blogsar</p></html>';
$mail->AltBody =  $emailInfo;

if(!$mail->send()) {
    
  
} else {
  


    }
 }

  }else{

    die("You have to agree our term and conditions in order to participate in this contest");
  }
 }

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-Monetisation</title>
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
<script>
     $(document).ready(function(){


    $("#privacy1").click(function(){
      $("#chatDiv2").hide()
          
         
     
         $("#chatDiv1").show();
    


    });


     $("#cookie1").click(function(){
      $("#chatDiv1").hide()
        
      $("#chatDiv2").show();

    });


$(document).ready(function(){

$("#check_monetise").click(function(){

$("#monetise_form").show();

});

$("#check_contest").click(function(){

$("#contest_form").show();

});

});

});
</script>

<style>

#asked:hover{
  background-color: grey;

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
/*
notification button and div css
*/
#notifications{

  width:450px;
  height:auto;
  top:30px;
  left:37%;

}


.data{
  max-width:400px;
  min-width:400px;
}

/*h3 {
        display:block;
        color:#333; 
        background:#FFF;
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
        border-bottom:solid 1px rgba(100, 100, 100, .30);
    }*/
   
/** edge broeser detection*/
	@supports (-ms-ime-align: auto) {
  .subsBtn2{
        margin-top:10px;
        margin-right:-10px;
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
  div.description,.title {
    width:63%;
  }
  
}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 1299px) {
  div.description,.title {
    width:57%;
  }
  #discussion{
    right:300px;
  }
}
@media screen and (max-width: 1150px) {
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
  #search{
    display:none;
    left:350px;
  top:40px;
    width:350px;
  }
  #search2{
    display:none;
    left:350px;
  top:40px;
    width:350px;
  }
  #search3{
    display:none;
    left:350px;
  top:40px;
    width:350px;
  }
   #searchChoice{
    display: none;
    left:350px;
    margin-top: 41px;
    width:250px;

  }

  #searchBtn{

    display: block;

  }
  #searchResult{
    display: none;
    left:350px;
  margin-top: 45px;
    
  }

   #searchResult2{
    display: none;
    left:350px;
  margin-top: 45px;
    
  }

   #searchResult3{
    display: none;
    left:350px;
  margin-top: 45px;
    
  }
  
  div.mainPostDiv{
  right:160px;
  }
  
}  
    
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}

</style>


<script type="text/javascript">


  $(document).ready(function(){


  
     $("#articleChoice").click(function(){
      $("#forAuthorSearch").hide();
      $("#forChannelSearch").hide();
       $("#forArticleSearch").css("display","block");
       $("#search").show();

       $("#search3").val("");
       $("#search2").val("");



          $("#articleChoice").css("background-color","white");
        $("#channelChoice").css("background-color","");
       $("#authorChoice").css("background-color","");
    
    });


     $("#channelChoice").click(function(){
    
      $("#forAuthorSearch").hide();
     $("#forChannelSearch").css("display","block");
       $("#forArticleSearch").hide();
       $("#search2").show();

        $("#search3").val("");
       $("#search").val("");

          $("#articleChoice").css("background-color","");
        $("#channelChoice").css("background-color","white");
       $("#authorChoice").css("background-color","");
    
    });
    


     $("#authorChoice").click(function(){
      $("#forAuthorSearch").css("display","block");
       $("#search3").show();
      $("#forChannelSearch").hide();
       $("#forArticleSearch").hide();

        $("#search").val("");
       $("#search2").val("");

    

          $("#articleChoice").css("background-color","");
        $("#channelChoice").css("background-color","");
       $("#authorChoice").css("background-color","white");
    
    });


    $("#search").click(function(){

        $("#searchResult").show();
             $("#searchChoice").show();

    });

    $("#search2").click(function(){

        $("#searchResult2").show();

  $("#searchChoice").show();
    });

    $("#search3").click(function(){

        $("#searchResult3").show();
  $("#searchChoice").show();
    });

    $("#page").click(function(){
   
      $("#searchChoice").hide();
      $("#searchResult").hide();
        $("#searchResult2").hide();
          $("#searchResult3").hide();
    
    });

$("#searchBtn").click(function(){
  $("#search").toggle();
   $("#searchChoice").hide();
    $("#searchResult").hide();

  
  });
$("#searchBtn2").click(function(){
  $("#search2").toggle();
    $("#searchChoice").hide();
     $("#searchResult2").hide();
  
  });
$("#searchBtn3").click(function(){
  $("#search3").toggle();
    $("#searchChoice").hide();
     $("#searchResult3").hide();
  
  });


var currentRequest = null; 
// for article search code
$(".sbox").keyup(function(){
  $(".autocomplete").html(" ");
  var val = $(this).val();

var dataString = "query="+val;

 currentRequest = $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
dataType:'json',
cache: false,
global:false,
//async:false,
 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },

success: function(data)
       {
       
    console.log(data);

          for(var i=0;i<data.length;i++){

      

 $(".autocomplete").html(
$(".autocomplete").html()+'<li class="list-group-item"  style="height:auto;"><a href="read.php?q='+data[i].id+'" style="color:black">'+data[i].title+'</a></li>'
  ); 
 
   
}

     },error:function(data){
      console.log(data);
      

     }
});

});

// for channel search code


$(".sbox2").keyup(function(){
  $(".autocomplete2").html(" ");
  var val = $(this).val();

var dataString = "query2="+val;

  currentRequest = $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
//async:false,
beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
 
success: function(data)
       {
          data = JSON.parse(data);

          for(var i=0;i<data.length;i++){

      

       
 $(".autocomplete2").html(
$(".autocomplete2").html()+'<li class="list-group-item "  style="height:auto;"><a href="otherProfile.php?q='+data[i].user_id+'" style="color:black">'+data[i].channelName+'</a></li>'
  );
     
}

     },error:function(data){
      console.log(data);

     }
});

});


// for author search code


$(".sbox3").keyup(function(){
  $(".autocomplete3").html(" ");
  var val = $(this).val();

var dataString = "query3="+val;

  currentRequest = $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
 global:false,
 //async:false,
 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
success: function(data)
       {
          data = JSON.parse(data);

          for(var i=0;i<data.length;i++){

      

       
 $(".autocomplete3").html(
$(".autocomplete3").html()+'<li class="list-group-item"  style="height:auto;"><a href="otherProfile.php?q='+data[i].user_id+'" style="color:black">'+data[i].authorName+'</a></li>'
  );

  

}

     },error:function(data){
      console.log(data);

     }
});

});





//notifications system script

var getnot = function (){

  
  var val=10;

  var dataString = "geTnoti="+val;
  $.ajax({
    type:"POST",
    url:"ForHandligAjax.php",
    cache:false,
      global:false,
    data:dataString,
    success:function(data){

      if(data==0){
        $("#noti_Counter").css("display","none");
      }else{
         $("#noti_Counter").css("display","block");
          $("#noti_Counter").html(data);
        }
 
    }
    });


}
setInterval(getnot, 50000); 
  var start1 = 20;
  var working1 = false; 

 var stop2 = 1;

    $("#noti_Button").click(function(){


start1 = 20;
working1 = false;
 stop2= 1;

          var reciever = 0;
 
             $(".Notifications").html("");

             
          var dataString = "getNotifications="+reciever;

         currentRequest= $.ajax({
            type:"POST",
            url:"ForHandligAjax.php",
            dataType:'json',
            data:dataString,
        
            //async:false,
             beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },

            success:function(data){
              console.log(data);

if(data.length == 0){

       $(".Notifications").html(
                    
                    $(".Notifications").html() + '<p style="font-size:15px;font-family:Merriweather;margin-left:40px">there is not any notification</p>')

}else{


              for(var i=0;i<data.length;i++){


         
             $(".Notifications").html(
                    
                    $(".Notifications").html() + ''+data[i]+''
                       
              )

              }
            }
            },
            error:function(data){
              console.log(data);
            }


          });
       

    });

    $("#noti_Button").click(function(){

 var val = 10;
 var dataString = "notif="+val;

 $.ajax({
        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString,
        cache:false,
      
        async:false,
        success:function(data){
          $("#noti_Counter").css("display","none");
    
        }

        });
        
     });





     $("#show_more_noti").click(function(e){

   
e.preventDefault(e);

if(working1==false && stop2>0){
   
   working1 = true;

var dataString = "getNotifications="+start1;

   currentRequest =  $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
  beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
success:function(data){
console.log(data);
stop2 = data.length;

if(stop2>0){



              for(var i=0;i<data.length;i++){
         
             $(".Notifications").html(
                    
                    $(".Notifications").html() + ''+data[i]+''
                       
              )
}
}else{

    $(".Notifications").html(
                    
                    $(".Notifications").html() + '<p style="font-family:Merriweather;font-size:15px;color:red">Notification End</p>'
                       
              )
}


start1+=20;

setTimeout(function(){
  working1 = false;
});


},
          error:function(data){

            console.log(data);

          }

    });

}


    });


// claear all notification
 $("#clear_notification").click(function(e){

e.preventDefault();

var val = 0;

var dataString = "clear_notification="+val;
 $(".Notifications").html("");

    $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,

success:function(data){
console.log(data);
   

},
error:function(data){

  console.log(data);


}

    });
    
    });
    //notification window toggle



$("#page").click(function(){
   $("#notifications").hide();
});
$("#noti_Button").click(function(){
     $("#notifications").toggle();

});
    

});

//notification script end


</script>
<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/monetise.php";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/monetise.php");
}
-->
</script>

</head>



<body>
	

<!-- Navbar -->
<div class="w3-top">
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">
<span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 

    <a href="index.php" id="home" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Home"  style="margin-left:24%"><i class="fa fa-home" style="font-size: 30px"></i></a>

  <a href="personal wall.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
  



 
 <div  style="position: relative;height:auto" >

  <button   id="noti_Button" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Updates" style="position: relative;"><i class="fas fa-bell " style="font-size: 30px">

    <img src="images/loading_notification_gif.gif" style="height:14px;width: 14px;position:absolute;z-index: 6446;top:20px;margin-left: -6px;display: none" id="loading_notification">

     <span id="noti_Counter" style="position: absolute;left:45px;top:6px;font-size: 12px;z-index:50px;color:white;background-color: red;padding: 2px;display: none"><b></b></span>
  </i>
 
  </button>


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;min-height: 50px;height:auto;overflow-y:auto;border-bottom: 1px solid black">

 <p style="margin-left: 5px;font-size: 13px;margin-bottom: 5px;position: relative;"><b>Notifications</b> <a href="#" style="position: absolute;right:5px" id="show_more_noti">Show more</a><a href="#" style="position: absolute;right:150px;color: red" id="clear_notification">Clear all</a></p>

<ul class="list-group Notifications" id="notify" style="margin-bottom: 0">

  </ul>


</div>
 </div>
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->

  <a href="postEditor.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>

     <!--search bar for article search-->
 <div id="forArticleSearch" style="display:block;">
     <form autocomplete="off" action="read.php">
     <button type="submit" id="searchBtn" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty()" title="Search"  ><i class="fa fa-search " style="font-size: 30px;" ></i></button>
     
     <input type="text" id="search" class="form-control  sbox"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search1.." name="q">
   
       <ul class="list-group autocomplete" id="searchResult" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow-x: auto;font-size: 15px" >

       </ul>
         
     </form>
     </div>
 <div id="searchChoice" style="width:30%;height:30px;background-color: lightgrey;position: absolute;top:44px;right:70px;min-width: 300px;display: none">



       <span class="btn" id="articleChoice" style="background-color: white;height: 100%;padding: 5px;font-family: Baloo Bhai;position: absolute;top:0;color:black"><b>Articles</b></span>
       
       <span class="btn" id="channelChoice" style="height: 100%;position: absolute;top:0;left:80px;padding: 5px;font-family: Baloo Bhai;color:black"><b>Channels</b></span>
       <span class="btn" id="authorChoice" style="height: 100%;position:absolute;top:0;left:160px;padding: 5px;font-family: Baloo Bhai;color:black"><b>Authors</b></span>
     </div>


<!--seach bar for channel seacrh-->
 <div id="forChannelSearch" style="display: none" >
     <form autocomplete="off" action="otherProfile.php">
     <button type="submit" id="searchBtn2" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty2()" title="Search2"><i class="fa fa-search " style="font-size: 30px;"></i></button>
     
     <input type="text" id="search2" class="form-control  sbox2"  style="width:30%;margin-top:10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search2.." name="q">
  
       <ul class="list-group autocomplete2" id="searchResult2" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow: auto" >
       </ul>
         
     </form>

     </div>


 <!--search bar for author search-->
 <div id="forAuthorSearch" style="display: none">
     <form autocomplete="off" action="otherProfile.php">
     <button type="submit" id="searchBtn3" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty3()" title="Search3"  ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search3" class="form-control  sbox3"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search3.." name="q">
  
       <ul class="list-group autocomplete3" id="searchResult3" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow: auto" >

       </ul>
         
     </form>

     </div>
 </div>
</div>



<div class="w3-container w3-content" style="max-width:1400px;margin-top:60px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-theme-light-grey w3-margin">
        <div class="w3-container" style="background-color:rgb(240, 240, 240)">
         <h2 class="w3-center" style="font-family:Comic Sans MS">Blogsar Monetisation</h2>
        </div>
      </div>
      
      
      <!-- Accordion -->
      <div class="w3-card w3-round w3-margin">
        <div class="w3-#" style="background-color:rgb(240, 240, 240)">
       
       <br>   
       <button style="width:100%" class=" btn btn-lg btn-primary" id="privacy1">Monetize</button><br>
       <br>
       <button style="width:100%" class=" btn btn-lg btn-primary" id="cookie1">Contest</button><br>  
       <br>  
        </div>
        <!-- copy right mark of Blogsar-->
       <p>Blogsar © 2019</p>      
      </div>

      

    </div>
<!--rules of contets div-->

<div id="chatDiv2" class="w3-col m7" style="display:none">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Rules of Contest</font></h2></center>
        <hr class="w3-clear">
        <p>
         

<h3 style="font-family:Comic Sans MS;margin-bottom:30px"><font color="black">Article writing contest will start from 30 april till 30 may. So take part and show your writing skill and win prizes.</font></h3>

        
          <div class="well" style="position: relative;width:100%;height:auto;top:-30px">

          
<h2 style="font-family:Comic Sans MS"><font color="blue">How to take part in Contest</font></h2>

<h4 style="font-family:Comic Sans MS">Participate in Running contest and Write articles in that much time.</h4>

<h4 style="font-family:Comic Sans MS">Write the best articles so that you can win.</h4>

<h4 style="font-family:Comic Sans MS">Write good Content so that people like and subscribe you.</h4>

<h4 style="font-family:Comic Sans MS">Don't copy the content from Blogsar's other authors or from other sites otherwise you will be disqaulified and you will be removed from Blogsar. And your channel will never get monetize in future.</h4>

<h4 style="font-family:Comic Sans MS">Try to write the best content according to your knowledge so that your channel become popular.</h4>

<h4 style="font-family:Comic Sans MS">Author can write and submit as much article as he/she want in running contest.</h4>

<h4 style="font-family:Comic Sans MS">The contest is open to all the authors.</h4>

<h4 style="font-family:Comic Sans MS">Users are ranked according to the most article submitted and according to their strength.</h4>

<h4 style="font-family:Comic Sans MS">The submissions will be judged at the end of the contest.</h4>

<br><br><br><br>
<button class="btn btn-danger btn-md" id="check_contest">Participate in contest</button>
      <div id="contest_form" style="display: none;position: relative;height:auto;width:100%;top:10px">
<p style="font-size: 16px;font-family:Merriweather;">This is a article writing contest currently running in Blogsar.</p> 
        <h2>Rules</h2>
        <ul style="font-size: 16px;font-family:Merriweather;">
          
          <li>Author will write article and publish . </li>
           <li>Top 3 articles that will earn highest <b>article strength</b> will be appeared on the trending page and will be declared as winner.  </li>
            <li>Authors of winner article will be notified via email.</li>
            <li>Authors can write as many articles as they want</li>

             <li>In case of any conflict final decision will be taken by the <b>Blogsar.</b></li>

        </ul>
        <?php

      if(DB::query('SELECT user_id FROM contest WHERE user_id=:id',array(':id'=>$userid5))){

        echo'<p style="font-size:16px;color:red;font-family:monospace">You have succesfully participated in contest ! happy writing</p>';
      }else{

        echo'<form action="monetise.php" method="post">
          <input type="checkbox" name="agree" value="agree" required ><p style="color:red;">You agree the term and condition of the contest.</p>
           <button type="submit" name="submit_contest" class="btn btn-danger btn-md" id="check_contest">Participate</button>
        </form>';
      }
        ?>
        
        

  
      </div>
</div>



</div>
      

</div>

    <div id="chatDiv1" class="w3-col m7" style="display:block;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Rules of Monetization</font></h2></center>
        <hr class="w3-clear">
        <p>
         



        
          <div class="well" style="position: relative;width:100%;height:auto;top:-30px">

           <p style="font-size: 17px;font-family:Merriweather">Main vision of Blogsar is to provide a platform where author can earn money through Articles .<br>

        <ul  style="font-size: 17px;font-family:Merriweather">
          <li>First Author has to complete his/her publication set-up the personal wall.</li>
            <li>Then write article on Article editor page and publish the Articles.</li>
           
            <li>Ads will be shown under articles and money earned on Articles will be provided to the Author after deducting some amount as commission.</li>
             <li>An auhtor could be eligible for monetize his publication after he  complete BMP criteria.
             <ul><li>Author must  have at least 500 subscribers. </li>
              <li>Author must have published at least 30 articles</li>
              <li><a target="_blank" href="help.html">Author strength</a> must be  above 7000</li></ul> </li>




        </ul>

           </p>
<h2>Blogsar monetization program (BMP) checklist</h2>

<p style="font-size: 17px;font-family:Comic Sans MS">Everyone can apply for BMP, but you do need to meet some of our guidelines. This checklist is meant to guide you through the application process.</p>

<ol style="font-size: 17px;font-family:Comic Sans MS">
  <li><strong>Make sure your publication follows our policies and guidelines</strong>. When you apply, you’ll go through a standard review process to see whether your channel meets our policies and guidelines. Only Publications that meet them will be accepted in the program. We also constantly check publications in the program to see whether they continue to meet our policies and guidelines.</li>
 
  <li><strong>Make sure you have at least 500 subscribers and 7000 <a target="_blank" href="help.html">Author Strength</a></strong>. When we assess publications for Blogsar Monetisation Program access, we need context. When you reach this threshold, it usually means that you have more content. The threshold helps us make a more informed decision about whether your publication meets our policies and guidelines.</li>
  <li><strong>Apply for BMP.</strong> You can apply for BMP anytime, but your Publication will only be reviewed once you meet our threshold. Follow these instructions:
    <ol>
      <li>Sign in to Blogsar.</li>
      <li>In Your personal wall click monetise button.</li>
      <li>Follow the on-screen steps.</li>
    </ol>
  </li>
  <li><strong>Get reviewed</strong>. When your channel meets the Blogsar Monetisation Program subscriber and <a target="_blank" href="help.html">Author Strength</a> threshold, it will automatically be put in a review queue. Our automated systems and human reviewers will then look at your publication’s content to see whether it follows all our guidelines.When you will be eligible for monetisation you will be informed via email.
    <ul>
      <li><strong>If you’re accepted into BMP</strong>: Congratulations! 
     
    </ul>
  </li>
</ol>

<div >
  <h2><a name="reviewprocess">Review process</a></h2>

  <p style="font-size: 17px;font-family:Comic Sans MS">Once you meet our subscriber and Author Strength thresholds, your application will be put in a queue. Our human reviewers will look at your publication as a whole to see whether it meets our Blogsar Monetisation Program policies.</p>

  <p style="font-size: 17px;font-family:Comic Sans MS">We’ll get back to you with a decision once your publication is reviewed.</p>

</div>

<button class="btn btn-primary btn-md" id="check_monetise">check your eligibility</button>
<div id="monetise_form" style="display: none;position: relative;height:auto;width:100%;top:10px">

<?php

$subscribers_count = DB::query('SELECT subscribers FROM user_details WHERE user_id =:id',array(':id'=>$userid5))[0]['subscribers'];
$noOfPosts = DB::query('SELECT noOfPosts FROM user_details WHERE user_id =:id',array(':id'=>$userid5))[0]['noOfPosts'];
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid5))[0]['authorRank'];

if($subscribers_count >=100 && $noOfPosts>=10 && $authorStrength >=1000){
  echo'
<p style="font-size: 17px;font-family:Merriweather;color:red">this section will be updated soon!</p>
 
  ';

}else{

  echo'
<p style="font-size: 17px;font-family:Merriweather;color:red">Sorry ! you are not eligible  For monetising your publication currently.<br>
keep writing we will notify you when you will be eligible.<br>Till than you can participate in article writing contest currently running and can win exciting prizes.</p>
 
  ';
}

?>
      
      </div>

      <br>
      <br><br><br>
      
    </div>


        
        
      </div>
      
    <!-- End Middle Column -->
    </div>









 
<script>
//discussion div js end


//for search button


function empty(){
    var x;
    x = document.getElementById("search").value;
    if (x == "") {
        
        return false;
    };
}
function empty2() {
    var x;
    x = document.getElementById("search2").value;
    if (x == "") {
        
         return false;
    };
}
function empty3() {
    var x;
    x = document.getElementById("search3").value;
    if (x == "") {
        
        return false;
    };
}

   </script>

</body>
</html>