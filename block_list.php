<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
$userid5="";
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}

	
if (Login::isLoggedIn()) {
        $userid5 = Login::isLoggedIn();
	  
     
} else {
        
}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-block list</title>
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


.data{
  max-width:400px;
  min-width:400px;
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

  #search{
    display:none;
    left:350px;
  top:40px;
    width:350px;
  }
  #searchResult{
    
    left:350px;
  margin-top: 38px;
    
  }
  #discussion{
    left:-230px;
  }
	
}
    
    
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}

</style>
<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/block_list.php";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/block_list.php");
}
-->
</script>

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

 currentRequest =  $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
dataType:'json',
cache: false,
global:false,
  beforeSend : function()    {           
        if(currentRequest  != null) {
            currentRequest.abort();
        }
    },
       
success: function(data)
       {
       
    console.log(data);

          for(var i=0;i<data.length;i++){

      

 $(".autocomplete").html(
$(".autocomplete").html()+'<li class="list-group-item data"  style="height:auto;"><a href="read.php?q='+data[i].title+'" style="color:black">'+data[i].title+'</a></li>'
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
beforeSend : function()    {           
        if(currentRequest  != null) {
            currentRequest.abort();
        }
    },
 
success: function(data)
       {
          data = JSON.parse(data);

          for(var i=0;i<data.length;i++){

      

       
 $(".autocomplete2").html(
$(".autocomplete2").html()+'<li class="list-group-item data"  style="height:auto;"><a href="otherProfile.php?q='+data[i].user_id+'" style="color:black">'+data[i].channelName+'</a></li>'
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

 currentRequest =  $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
 global:false,
 beforeSend : function()    {           
        if(currentRequest  != null) {
            currentRequest.abort();
        }
    },
 
success: function(data)
       {
          data = JSON.parse(data);

          for(var i=0;i<data.length;i++){

      

       
 $(".autocomplete3").html(
$(".autocomplete3").html()+'<li class="list-group-item data"  style="height:auto;"><a href="otherProfile.php?q='+data[i].channelName+'" style="color:black">'+data[i].authorName+'</a></li>'
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
  var stop = 1;

    $("#noti_Button").click(function(){
 start1 = 20;
   working1 = false; 
   stop = 1;

          var reciever = 0;
 
             $(".Notifications").html("");
             
          var dataString = "getNotifications="+reciever;

         currentRequest =  $.ajax({
            type:"POST",
            url:"ForHandligAjax.php",
            dataType:'json',
            data:dataString,
            cache:false,
              global:false,
           beforeSend : function()    {           
        if(currentRequest  != null) {
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
        global:false,
        success:function(data){
          $("#noti_Counter").css("display","none");
    
        }

        });
        return false;

     });



 

    $("#show_more_noti").click(function(e){
e.preventDefault();

if(working1==false && stop>0){
   
   working1 = true;

var dataString = "getNotifications="+start1;

  currentRequest =   $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
   beforeSend : function()    {           
        if(currentRequest  != null) {
            currentRequest.abort();
        }
    },
success:function(data){
console.log(data);

stop  = data.length;

if(stop>0){


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
async:false,
success:function(data){
console.log(data);
   

},
error:function(data){

  console.log(data);


}

    });
    
    });

    //notification window toggle

$("#noti_Button").click(function(){
 
  $("#notifications").toggle();
});

$("#page").click(function(){
   $("#notifications").hide();
});
$("#noti_Button").click(function(){
  return false;});
    


//notification script end





  });

</script>


</head>



<body>
	

<!-- Navbar -->
<div class="w3-top">
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">
 
<span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 

    <a href="index.php" id="home" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Home"  style="margin-left:24%"><i class="fa fa-home" style="font-size: 30px"></i></a>

  <a href="Personal Wall.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
  

 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
 

  <a href="postEditor.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>


  <div  style="position: relative;height:auto" >

  <button   id="noti_Button" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Updates" style="position: relative;"><i class="fas fa-bell " style="font-size: 30px">
     <span id="noti_Counter" style="position: absolute;left:45px;top:6px;font-size: 12px;z-index:50px;color:white;background-color: red;padding: 2px;display: none"><b></b></span>
  </i>
 
  </button>


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;width:450px;min-height: 50px;height:auto;overflow-y:auto;border-bottom: 1px solid black;left:47%;top:35px">

 <p style="margin-left: 5px;font-size: 13px;margin-bottom: 5px;"><b>Notifications</b> <a href="#" style="position: absolute;right:5px" id="show_more_noti">Show more</a><a href="#" style="position: absolute;right:150px;color: red" id="clear_notification">Clear all</a></p>

<ul class="list-group Notifications" id="notify" style="margin-bottom: 0">

  </ul>


</div>
 </div>
  
 <!--search bar for article search-->
 <div id="forArticleSearch" style="display:block;">
     <form autocomplete="off" action="read.php">
     <button type="submit" id="searchBtn" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty()" title="Search"  ><i class="fa fa-search " style="font-size: 30px;" ></i></button>
     
     <input type="text" id="search" class="form-control  sbox"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search1.." name="q">
   
       <ul class="list-group autocomplete" id="searchResult" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height: 500px;overflow: auto;font-size: 15px" >

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
  
       <ul class="list-group autocomplete2" id="searchResult2" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height: 500px;overflow: auto;font-size: 15px" >
       </ul>
         
     </form>

     </div>


 <!--search bar for author search-->
 <div id="forAuthorSearch" style="display: none">
     <form autocomplete="off" action="otherProfile.php">
     <button type="submit" id="searchBtn3" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty3()" title="Search3"  ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search3" class="form-control  sbox3"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search3.." name="q">
  
       <ul class="list-group autocomplete3" id="searchResult3" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height: 500px;overflow: auto;font-size: 15px" >

       </ul>
         
     </form>

     </div>
     
     <div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">
      <a href="privacy_rules.php" class="w3-bar-item w3-button" style="font-size: 17px">Privacy</a>
      
      <form action="logout.php" method="post">
      <input type="submit" name="confirm" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           <a href="block_list.php" class="w3-bar-item w3-button" style="font-size: 17px;color:red">blocked</a>
               
                <a  class="w3-bar-item w3-button" href="reportHistory.php" style="font-size: 17px">Report history</a>
                   
                      
    </div>
<button class="w3-button w3-padding-large  w3-hover-none" title="Settings" ><i class="fa fa-cog" style="font-size: 30px"></i></button>
  </div>
 </div>
</div>

 <!-- Middle Column -->
 <!--Main div that displays features-->
   <!--  start about column Div-->
     <div id="discussion" class="Discussion" style="display:block; margin-top:-10px;position:relative;right:5%;min-width: 1100px">
     <div class="w3-col m7"  style=" margin-left:290px;margin-top:50px;width:65%;max-width:90%">

     <div class="middle-column" >

      <div class="w3-container w3-card w3-white w3-round w3-margin" id="mainDiscussion" style="height: auto;max-height:100%;max-width:100%"><br>

 <div style="height: auto;min-height:270px;word-wrap:break-word;position: relative;background-color:#e6e6ff">


     <div id="asked1" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn1" style="font-size: 25px;top:-45px;position:absolute;font-family:Baloo Bhai">Blocked </h2></div>
           

<hr style="margin-top: 20px">


<div id="chatDiv1" style="display: block;">
  <?php

  
  $f  = 0;
   $chat_block = DB::query('SELECT * FROM block_chat WHERE blocker = :blocker

ORDER BY id DESC

    ',array(':blocker'=>$userid5));
  
   foreach ($chat_block as $blocked){
$f++;
                        

    $Blocked = $blocked['blocked'];

    $blockedName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :userid',array(':userid'=>$Blocked))[0]['authorName'];
     $blockedImage = DB::query('SELECT channelImage FROM channelsetup WHERE user_id = :userid',array(':userid'=>$Blocked))[0]['channelImage'];
    echo'

    <div id="';echo "mainData".$f.'" class="';echo "MainData".$Blocked.'">

     <div class="well" style="width:auto;position:relative">
<h1 style="font-family:Merriweather;font-size:18px;margin-left:150px;margin-top:0px"><a href="otherProfile.php?q=';echo $Blocked.'">';echo $blockedName.'</a></h1>
<img src="';echo $blockedImage.'" class="img-thumbnail" style="width:100px;height:100px;margin-top:-40px;margin-bottom:-15px">

 
 <label  class="btn btn-default" id="';echo "label1".$f.'" for="';echo "unblockQuestion".$f.'" tabindex="0" title="unblock questions" style="font-size: 15px; float:right;margin-top:25px">unblock questions</label>

<button id="';echo "unblockQuestion".$f.'" name="uploadSubmit"  class="hidden"></button>';

if(DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocker = :blocker AND blocked_author=:blocked',array(':blocker'=>$userid5,':blocked'=>$Blocked)))
        {
        
          echo'   
          <label  class="btn btn-default" id="';echo "label2".$f.'" for="';echo "unblockFeedbacks".$f.'" tabindex="0" title="unblock feedbacks" style="font-size: 15px; float:right;margin-top:25px">unblock feedbacks</label>

<button id="';echo "unblockFeedbacks".$f.'" name="uploadSubmit"  class="hidden"></button>

<script>
$(document).ready(function(){
  $("';echo "#unblockFeedbacks".$f.'").click(function(){

        var unblockFeedbacks =';echo $Blocked.';
       
       var dataString = "unblockFeedbacks="+unblockFeedbacks;
    
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){
$("';echo "#label2".$f.'").html("unblocked");
       }
       });

      

    });
});

</script>

';   
           

   }
echo'

 
     </div>

     </div>

<script>

$(document).ready(function(){
$("';echo "#unblockQuestion".$f.'").click(function(){

 var blocked =';echo $Blocked.';
   
       var dataString = "unblockQuestion="+blocked;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

       $("';echo "#label1".$f.'").html("unblocked");
   

       }
       });




  });

  });

</script>

     ';

 
} 




  $f1  = 0;
   $feedback_block = DB::query('SELECT * FROM blocked_author_feedback WHERE blocker = :blocker

ORDER BY id DESC

    ',array(':blocker'=>$userid5));
  
   foreach ($feedback_block as $blocked){
$f1++;
                        

    $Blocked2 = $blocked['blocked_author'];

    $BlockedName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :userid',array(':userid'=>$Blocked2))[0]['authorName'];
     $BlockedImage = DB::query('SELECT channelImage FROM channelsetup WHERE user_id = :userid',array(':userid'=>$Blocked2))[0]['channelImage'];
     if(!DB::query('SELECT blocked FROM block_chat WHERE blocked = :blocked AND blocker = :blocker ',array(':blocked'=>$Blocked2,':blocker'=>$userid5))){
    echo'

    <div id="';echo "mainData".$f1.'" class="';echo "MainData".$Blocked2.'">

     <div class="well" style="width:auto;position:relative">
<h1 style="font-family:Merriweather;font-size:18px;margin-left:150px;margin-top:0px"><a href="otherProfile.php?q=';echo $Blocked2.'">';echo $BlockedName.'</a></h1>
<img src="';echo $BlockedImage.'" style="width:100px;height:100px;margin-top:-40px;margin-bottom:-15px">

 
 <label  class="btn btn-default" id="';echo "label3".$f1.'" for="';echo "unblockFeedbacks".$f1.'" tabindex="0" title="unblock feedbacks" style="font-size: 15px; float:right;margin-top:25px">unblock feedbacks</label>

<button id="';echo "unblockFeedbacks".$f1.'" name="uploadSubmit"  class="hidden"></button>

     </div>
     </div>

<script>
$(document).ready(function(){


  $("';echo "#unblockFeedbacks".$f1.'").click(function(){
 
  
  
var blocked =';echo $Blocked2.';
       
       var dataString = "unblockFeedbacks="+blocked;
      $.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){
  
        $("';echo "#label3".$f1.'").html("unblocked");
      
       }

        });
      

    });

  });

</script>

     ';

 }
} 





  ?>
     
  </div>

    

        </div>
         <!-- copy right mark of Blogsar-->
       <p>Blogsar © 2019</p>
</div>
           </div>

      </div>
</div>

   <script>


//discussion div js
 
    
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

//discussion div js end

//Notification js




   </script>

</body>
</html>