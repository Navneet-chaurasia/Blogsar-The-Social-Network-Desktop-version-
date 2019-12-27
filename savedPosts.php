<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}
$followedTopics="";

$banner="";

$postid="";
	$posts="";
$date="";
$postid="";	
$like="";
$userid5="";
$channel="";
$authorname="";
$postRank="";
$channelimage="";

$url2="";
$url="";
$title="";

$description="";
	
if (Login::isLoggedIn()) {
        $userid5 = Login::isLoggedIn();
	  
     
} else {
        echo 'Not logged in';
}


$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank FROM post,savedposts
WHERE  post.id=savedposts.post_id
AND savedposts.user_id=:userid
ORDER BY post.views DESC',array(':userid'=>$userid5));




if(!DB::query('SELECT post_id FROM savedposts WHERE user_id=:userid',array(':userid'=>$userid5))){
	$banner = "block";
}else{
	$banner = "none";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-saved artical</title>
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">
<<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho|Fredoka+One" rel="stylesheet">


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<style>


img{
    max-width:700px;
}


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

  .notif:hover{
      background-color: #ddd;
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
  max-height:400px;
}

h3 {
        display:block;
        color:#333; 
        background:#FFF;
        font-weight:bold;
        font-size:13px;    
        padding:8px;
        margin:0;
       
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
    #delp2:hover{
    	color:red;
    }

#set:hover{
  color: grey;
}
/** edge broeser detection*/
	@supports (-ms-ime-align: auto) {
  .subsBtn2{
       position: relative;
       top:30px;
         }

         .authRank{
          position: relative;
          top:23px;
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
	div.profileDiv{
  display:none;
  }
  div.mainPostDiv{
  right:120px;
  }
	 

   table{

    width:200px;

   }

    
 
</style>

<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/savedPosts.php";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/savedPosts.php");
}
-->
</script>


<script >
  

 var start = 10;
  var working = false;
  var stop = 1; 
 $(window).scroll(function(){

    if($(this).scrollTop() + 1 >= $(document).height() - $(window).height()){



if(working==false && stop>0){
   
   working = true; 

var f = -1;
    var dataString = "savedArticles=" + start; 
  
 $.ajax({

type: "POST",

url: "ForHandligAjax.php",

data: dataString,

cache: false,
dataType:'json',

success: function(data)

       { 
    
 console.log(data);
   
stop = data[0].length;
for(var i=0;i<data[0].length;i++){
 f++;



 $(".PostMainDiv").html(
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"><input type="radio" value="Nudity"  name="report" report-id='+data[0][i].id+' id="nudity'+data[0][i].id+'"><label class="button" for= "nudity'+data[0][i].id+'">Nudity</label><input type="radio" value="Promoting drugs"  name="report" report-id='+data[0][i].id+'  id="drugs'+data[0][i].id+'" ><label class="button"  for="drugs'+data[0][i].id+'">Promoting drugs</label><input type="radio" value="Promoting Terrorism"  name="report" report-id='+data[0][i].id+'  id="terrorism'+data[0][i].id+'" ><label class="button" for="terrorism'+data[0][i].id+'">promoting terrorism</label><input type="radio" value="promoting sucide"  name="report" report-id='+data[0][i].id+'  id="sucide'+data[0][i].id+'" ><label class="button" for="sucide'+data[0][i].id+'"  >promoting sucide</label> <input type="radio" value="Harrasment"  name="report" report-id='+data[0][i].id+'  id="Harrasment'+data[0][i].id+'" > <label class="button" for="Harrasment'+data[0][i].id+'" >Harrasment</label>  <input type="radio" value="Inappropriate"  name="report" report-id='+data[0][i].id+'  id="Inappropriate'+data[0][i].id+'" ><label class="button" for="Inappropriate'+data[0][i].id+'"  >Inappropriate</label>  <input type="radio" value="fake news"  name="report" report-id='+data[0][i].id+'  id="fake news'+data[0][i].id+'" ><label class="button" for="fake news'+data[0][i].id+'">fake news</label>   <input type="radio" value="violence"  name="report" report-id='+data[0][i].id+'  id="violence'+data[0][i].id+'" ><label class="button" for="violence'+data[0][i].id+'">violence</label><input type="radio" value="other"  name="report" report-id='+data[0][i].id+'  id="other'+data[0][i].id+'" ><label class="button" for="other'+data[0][i].id+'">other</label><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport'+f+'" submitReport-id='+data[0][i].id+' writer='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:19%;min-width:700px;position:relative;display:'+data[15][i]+'"> <div class="w3-col m7" style="margin-bottom:-22px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[13][i]+data[11][i]+data[14][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span class="authRank"   style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p class="authRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+data[16][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[16][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


//jquery for all behaviours of article's buttons
$('[data-id]').click(function(){
var buttonid =   $(this).attr('data-id');
var val= $(this).attr('data-id');
 
var dataString = "liking=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {

      $("[data-id2='"+buttonid+"']").html( r[0]);
      $("[data-id='"+buttonid+"']").val( r[1]);
       $("[data-id='"+buttonid+"']").css("background-color",r[2]);

console.log(r);

       }

       });

})
  
 
// for toggle articles
$('[read-id]').click(function(){
var buttonid =   $(this).attr('read-id');

 var x =  $("[read-id='"+buttonid+"']")[0];

    var x =  $("[myDiv-id='"+buttonid+"']")[0];
   var y =  $("[Div-id='"+buttonid+"']")[0];
     var z =  $("[read-id='"+buttonid+"']")[0];
     var a =  $("[myView-id='"+buttonid+"']")[0];
  if(y.style.display == "none" && x.style.display == "block")
   {z.innerHTML = "Read";
        z.style.backgroundColor="#428BCA";
       x.style.display="none";var buttonid =   $(this).attr('read-id');
    y.style.display="block";
var  currentHeight = $("[myDiv-id='"+buttonid+"']").outerHeight();

 
 $("html, body").animate({ scrollTop: "-="+currentHeight },0); 



    }

   else if (y.style.display=="block" && x.style.display=="none"){
   z.innerHTML = "Reading";
        z.style.backgroundColor="#787878";
        a.style.backgroundColor="#787878";
        a.innerHTML="viewed";
     y.style.display="none";
     x.style.display="block";


   
var val =buttonid;   
var dataString = "read=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {
        console.log(r);  
   $("[Views-id='"+buttonid+"']").html(r[0]);


     }
});
return false;

   } 
 
});



$('[subsBtn-id]').click(function(){
var user_id =   $(this).attr('subsBtn-id');
var val= user_id
 
var dataString = "subscribing=" + val;

//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {
console.log(r);
 
      $("[subsBtn-id='"+user_id+"']").html( r[1]);
       $("[subsBtn-id='"+user_id+"']").css("background-color",r[2]);

       }

       });

});



 // code for saving posts
$('[save-id]').click(function(e){
  e.preventDefault();

var buttonid =   $(this).attr('save-id');
var val =buttonid;   
var dataString = "save=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
dataType:'json',
success: function(r)
       {
        console.log(r);  
  $("[h1-id='"+buttonid+"']").html(r[0]);

     }
});
return false;
 });


//snooz or unsnooz feedback in articles

$('[snoozFeedback-id]').click(function(e){
var buttonid =   $(this).attr('snoozFeedback-id');
var val= buttonid;
  e.preventDefault();
var dataString = "snoozing=" + val;

//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {
console.log(r);
 
      $("[snooz-id='"+buttonid+"']").html( r[0]);
       $("[mute-id='"+buttonid+"']").css("display",r[1]);

       }

       });

});



//feedback area javascript

$('[feedback-id]').click(function(){
var buttonid =   $(this).attr('feedback-id');
$("[mainFeedbackDiv-id='"+buttonid+"']").toggle();

})

//feedback submiting

$('[submitFeedback-id]').click(function(){
  var buttonid =   $(this).attr('submitFeedback-id');
  var reciever =    $(this).attr('writer-id');
  $("[mainFeedbackDiv-id='"+buttonid+"']").hide();
 

  var feedback = $("[writeFeedback-id='"+buttonid+"']").val();

  var postid = buttonid;
if(feedback){
   $("[feedbackNoti-id='"+buttonid+"']").css("display","block");
var dataString = "Reciever="+reciever + "&feedback="+feedback + "&postid="+postid;
  $.ajax({
      
      type:"POST",
      url:"ForHandligAjax.php",
      cache:false,
      global:false,
      data:dataString,
      dataType:'json',
      success:function(r){
        console.log(r);
 $("[writeFeedback-id='"+buttonid+"']").val(" ");
        
      }

    });
  }

  });


  // ajax code for deleting posts

    $('[delete-id]').click(function(e){
      e.preventDefault();
     var val =confirm("do you want to delete");
     if(val==true){
        var val2 =   $(this).attr('delete-id');
      var dataString = "delete="+val2;
      $.ajax({
        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString,
        cache:false,
        global:false,
        success:function(data){
          $("[mainDiv-id='"+val2+"']").css("display","none");
          
        }

        });
        return false;
     }else{
      return false;
     }

      });




 // notintrstd code

 $('[notintrstd-id]').click(function(e){


      e.preventDefault();
     var val =confirm("This article will not show you again!");
     if(val==true){
      var val2 =   $(this).attr('notintrstd-id');
      var dataString = "notIntrstd="+val2;
      $.ajax({

        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString,
        cache:false,
        global:false,
        success:function(r){

          $("[mainDiv-id='"+val2+"']").css("display",r);
             
        }

        });
        return false;
       
     }

      });




//report an atricle
  $('[report-id]').click(function(){


               $(this).css("background-color","grey");

        var e = $(this).val();

$('[submitReport-id]').click(function(){
var postid = $(this).attr('submitReport-id');
var authorID =$(this).attr('writer');
var report_info = $("[report_info-id='"+postid+"']").val();




var dataString1 =  "reportt=" + e +  "&postId=" + postid + "&authorId=" + authorID + "&report_info="+ report_info;

$.ajax({
  type:"POST",
  url:"ForHandligAjax.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[report_info-id='"+postid+"']").val(" ");
    $("[report-id='"+postid+"']").css("background-color","#ddd");
  }
  });


  var val2 = postid;
      var dataString2 = "notIntrstd="+val2;
      $.ajax({
        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString2,
        cache:false,
        global:false,
        success:function(data){
          $("[mainDiv-id='"+postid+"']").css("display","none");
          
          
        }

        });

 });

        });

  //end of all scripts

}

start+=10;
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
  //de for initial 5 articles
var val = 0;
var f = -1;
    var dataString = "savedArticles=" + val; 
  
 $.ajax({

type: "POST",

url: "ForHandligAjax.php",

data: dataString,

cache: false,
dataType:'json',

success: function(data)

       { 
    
 console.log(data);
   

for(var i=0;i<data[0].length;i++){
 f++;



 $(".PostMainDiv").html(
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"> <input type="radio" value="Nudity"  name="report" report-id='+data[0][i].id+' id="nudity'+data[0][i].id+'"><label class="button" for= "nudity'+data[0][i].id+'">Nudity</label><input type="radio" value="Promoting drugs"  name="report" report-id='+data[0][i].id+'  id="drugs'+data[0][i].id+'" ><label class="button"  for="drugs'+data[0][i].id+'">Promoting drugs</label><input type="radio" value="Promoting Terrorism"  name="report" report-id='+data[0][i].id+'  id="terrorism'+data[0][i].id+'" ><label class="button" for="terrorism'+data[0][i].id+'">promoting terrorism</label><input type="radio" value="promoting sucide"  name="report" report-id='+data[0][i].id+'  id="sucide'+data[0][i].id+'" ><label class="button" for="sucide'+data[0][i].id+'"  >promoting sucide</label> <input type="radio" value="Harrasment"  name="report" report-id='+data[0][i].id+'  id="Harrasment'+data[0][i].id+'" > <label class="button" for="Harrasment'+data[0][i].id+'" >Harrasment</label>  <input type="radio" value="Inappropriate"  name="report" report-id='+data[0][i].id+'  id="Inappropriate'+data[0][i].id+'" ><label class="button" for="Inappropriate'+data[0][i].id+'"  >Inappropriate</label>  <input type="radio" value="fake news"  name="report" report-id='+data[0][i].id+'  id="fake news'+data[0][i].id+'" ><label class="button" for="fake news'+data[0][i].id+'">fake news</label>   <input type="radio" value="violence"  name="report" report-id='+data[0][i].id+'  id="violence'+data[0][i].id+'" ><label class="button" for="violence'+data[0][i].id+'">violence</label><input type="radio" value="other"  name="report" report-id='+data[0][i].id+'  id="other'+data[0][i].id+'" ><label class="button" for="other'+data[0][i].id+'">other</label><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport'+f+'" submitReport-id='+data[0][i].id+' writer='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:19%;min-width:700px;position:relative;top:32px;display:'+data[14][i]+'"> <div class="w3-col m7" style="margin-bottom:-23px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[13][i]+data[11][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span class="authRank"  style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p class="authRank"  style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+data[15][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[16][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


//jquery for all behaviours of article's buttons
$('[data-id]').click(function(){
var buttonid =   $(this).attr('data-id');
var val= $(this).attr('data-id');
 
var dataString = "liking=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {

      $("[data-id2='"+buttonid+"']").html( r[0]);
      $("[data-id='"+buttonid+"']").val( r[1]);
       $("[data-id='"+buttonid+"']").css("background-color",r[2]);

console.log(r);

       }

       });

})
  
 
// for toggle articles
$('[read-id]').click(function(){
var buttonid =   $(this).attr('read-id');

 var x =  $("[read-id='"+buttonid+"']")[0];

    var x =  $("[myDiv-id='"+buttonid+"']")[0];
   var y =  $("[Div-id='"+buttonid+"']")[0];
     var z =  $("[read-id='"+buttonid+"']")[0];
     var a =  $("[myView-id='"+buttonid+"']")[0];
  if(y.style.display == "none" && x.style.display == "block")
   {z.innerHTML = "Read";
        z.style.backgroundColor="#428BCA";
       x.style.display="none";var buttonid =   $(this).attr('read-id');
    y.style.display="block";
var  currentHeight = $("[myDiv-id='"+buttonid+"']").outerHeight();

 
 $("html, body").animate({ scrollTop: "-="+currentHeight },0); 



    }

   else if (y.style.display=="block" && x.style.display=="none"){
   z.innerHTML = "Reading";
        z.style.backgroundColor="#787878";
        a.style.backgroundColor="#787878";
        a.innerHTML="viewed";
     y.style.display="none";
     x.style.display="block";


   
var val =buttonid;   
var dataString = "read=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
dataType:'json',
async:false,
success: function(r)
       {
        console.log(r);  
   $("[Views-id='"+buttonid+"']").html(r[0]);


     }
});
return false;

   } 
 
});



$('[subsBtn-id]').click(function(){
var user_id =   $(this).attr('subsBtn-id');
var val= user_id
 
var dataString = "subscribing=" + val;

//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
dataType:'json',
async:false,
success: function(r)
       {
console.log(r);
 
      $("[subsBtn-id='"+user_id+"']").html( r[1]);
       $("[subsBtn-id='"+user_id+"']").css("background-color",r[2]);

       }

       });

});



 // code for saving posts
$('[save-id]').click(function(e){
  e.preventDefault();

var buttonid =   $(this).attr('save-id');
var val =buttonid;   
var dataString = "save=" + val;
//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
dataType:'json',
success: function(r)
       {
        console.log(r);  
  $("[h1-id='"+buttonid+"']").html(r[0]);

     }
});
return false;
 });


//snooz or unsnooz feedback in articles

$('[snoozFeedback-id]').click(function(e){
var buttonid =   $(this).attr('snoozFeedback-id');
var val= buttonid;
  e.preventDefault();
var dataString = "snoozing=" + val;

//code to submit form.
$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
dataType:'json',
async:false,
global:false,
success: function(r)
       {
console.log(r);
 
      $("[snooz-id='"+buttonid+"']").html( r[0]);
       $("[mute-id='"+buttonid+"']").css("display",r[1]);

       }

       });

});



//feedback area javascript

$('[feedback-id]').click(function(){
var buttonid =   $(this).attr('feedback-id');
$("[mainFeedbackDiv-id='"+buttonid+"']").toggle();

})

//feedback submiting

$('[submitFeedback-id]').click(function(){
  var buttonid =   $(this).attr('submitFeedback-id');
  var reciever =    $(this).attr('writer-id');
  $("[mainFeedbackDiv-id='"+buttonid+"']").hide();
 

  var feedback = $("[writeFeedback-id='"+buttonid+"']").val();

  var postid = buttonid;
if(feedback){
   $("[feedbackNoti-id='"+buttonid+"']").css("display","block");
var dataString = "Reciever="+reciever + "&feedback="+feedback + "&postid="+postid;
  $.ajax({
      
      type:"POST",
      url:"ForHandligAjax.php",
      cache:false,
      global:false,
      data:dataString,
      dataType:'json',
      success:function(r){
        console.log(r);
 $("[writeFeedback-id='"+buttonid+"']").val(" ");
        
      }

    });
  }

  });


  // ajax code for deleting posts

    $('[delete-id]').click(function(e){
      e.preventDefault();
     var val =confirm("do you want to delete");
     if(val==true){
        var val2 =   $(this).attr('delete-id');
      var dataString = "delete="+val2;
      $.ajax({
        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString,
        cache:false,
        global:false,
        success:function(data){
          $("[mainDiv-id='"+val2+"']").css("display","none");
          
        }

        });
        return false;
     }else{
      return false;
     }

      });




 // notintrstd code

 $('[notintrstd-id]').click(function(e){


      e.preventDefault();
     var val =confirm("This article will not show you again!");
     if(val==true){
      var val2 =   $(this).attr('notintrstd-id');
      var dataString = "notIntrstd="+val2;
      $.ajax({

        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString,
        cache:false,
        global:false,
        success:function(r){

          $("[mainDiv-id='"+val2+"']").css("display",r);
             
        }

        });
        return false;
       
     }

      });




//report an atricle
  $('[report-id]').click(function(){


               $(this).css("background-color","grey");

        var e = $(this).val();

$('[submitReport-id]').click(function(){
var postid = $(this).attr('submitReport-id');
var authorID =$(this).attr('writer');
var report_info = $("[report_info-id='"+postid+"']").val();




var dataString1 =  "reportt=" + e +  "&postId=" + postid + "&authorId=" + authorID + "&report_info="+ report_info;

$.ajax({
  type:"POST",
  url:"ForHandligAjax.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[report_info-id='"+postid+"']").val(" ");
    $("[report-id='"+postid+"']").css("background-color","#ddd");
  }
  });


  var val2 = postid;
      var dataString2 = "notIntrstd="+val2;
      $.ajax({
        type:"POST",
        url:"ForHandligAjax.php",
        data:dataString2,
        cache:false,
        global:false,
        success:function(data){
          $("[mainDiv-id='"+postid+"']").css("display","none");
          
          
        }

        });

 });

        });

  //end of all scripts

}

},
error:function(data){
  console.log(data);

}
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
  stop =1;
          var reciever = 0;
 
             $(".Notifications").html("");
             
          var dataString = "getNotifications="+reciever;

          $.ajax({
            type:"POST",
            url:"ForHandligAjax.php",
            dataType:'json',
            data:dataString,
            cache:false,
            async:false,
             global:false,
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

    $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
async:false,
global:false,
success:function(data){
console.log(data);
stop = data.length;

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

  <a href="personal wall.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
  




    
 <div  style="position: relative;height:auto" >

  <button   id="noti_Button" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Updates" style="position: relative;"><i class="fas fa-bell " style="font-size: 30px">
     <span id="noti_Counter" style="position: absolute;left:45px;top:6px;font-size: 12px;z-index:50px;color:white;background-color: red;padding: 2px;display: none"><b></b></span>
  </i>
 
  </button>


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;left:35%;top:30px;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;min-height: 50px;height:auto;overflow-y:auto;border-bottom: 1px solid black;">

 <p style="margin-left: 5px;font-size: 13px;margin-bottom: 5px;"><b>Notifications</b> <a href="#" style="position: absolute;right:5px" id="show_more_noti">Show more</a><a href="#" style="position: absolute;right:150px;color: red" id="clear_notification">Clear all</a></p>

<ul class="list-group Notifications" id="notify" style="margin-bottom: 0">

  </ul>


</div>
 </div>
 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               


  <a href="postEditor.html" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>
         
 <a style="color: white" href="#"> <span style="float: right;margin-right: 40px;margin-top:10px"><i  class="fas fa-trash-alt" style="font-size: 30px" title="Remove saved posts" id="delp2"></i></span> </a> 
  

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
<center><div id="banner" class="well" style="width:400px;display:<?php echo $banner?>;margin-top: 100px"><h2>You have not saved any article yet :)</h2></div></center>
<center><div id="banner2" class="well" style="width:400px;display:none;margin-top: 100px"><h2>Saved posts have been removed</h2></div></center>

 <!-- Middle Column -->
<!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:40%;display: none;top:100px">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:40%;top:100px">
<!--Loading progress bar for article loading  ends-->
 <!--base for articles appearing-->
 <div class="PostMainDiv">


        </div>
         <!--base for articles appearing ends--> 

   <script>





   	/*
   	Remove saved posts using ajax code
   	*/
   	$(document).ready(function(){
     $("#delp2").click(function(e){
e.preventDefault();
var val ="data";
var dataString="empty="+val;
      $.ajax({
      	type :"POST",
      	url:"ForHandligAjax.php",
      	data:dataString,
cache: false,
global:false,
success: function(data)
       {
          

	var x=document.getElementsByClassName("mainPostDiv");
	var y =document.getElementById("banner2");
	var i;
	if( y.style.display=="none"){
		for (i = 0; i < x.length; i++) {
    
    	x[i].style.display="none";
    	
   
}
y.style.display="block";
	}
	



     }

      });
      return false;

     });

   	});

   </script>

</body>
</html>