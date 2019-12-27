<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(!Login::isLoggedIn()){
   $data = $_GET['q'];
    
  header("location:insight.php?q=$data");
 die();
}
$followedTopics="";
$followingposts = "";
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
	  
     
} 

$searchData = "";

if(!empty($_GET['q'])){

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
  




$searchData  = $_GET['q'];

if(is_numeric($_GET['q'])){


      
            if(DB::query('SELECT id FROM post WHERE id=:postid', array(':postid'=>$_GET['q'])))
            {
              

$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 
 post.id = :postid 
 '
  ,array(':postid'=>$_GET['q'])); 

$post_id_search = $_GET['q'];



            }
            else{
              die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">Article not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="index.php">Go back..</a></div>');
            }
          }
else{

  if(DB::query('SELECT post.title , post.description , post.Topics ,post.keywords FROM post WHERE title LIKE :body
  OR description LIKE :body OR post.Topics LIKE :body
  OR post.keywords LIKE :body
  ',array(':body'=>'%'.$searchData.'%'))){

$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 
 post.title LIKE :body

 OR post.Topics LIKE :body
 OR post.description LIKE :body

   OR post.keywords LIKE :body
 ORDER BY post.postRank DESC
  '
  ,array(':body'=>'%'.$searchData.'%'));




$a = "\"";
$b = "\"";

$post_id_search = $a.$_GET['q'].$b;




}else{
die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">Article not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="index.php">Go back..</a></div>');
     }  



}

}else{

  die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">page not found</p>
  
  <a href="index.php">Go back..</a></div>');
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-read</title>
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-indigo.css">
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
/*header image css end*/
/* SCROLLBAR */
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



.data{
  max-width: 400px;
  max-height: 400px;
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
  #profile{
    display:block;
  }
 
}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 1299px) {
  #profile{
    display:none;
  }
  

  div.mainPostDiv{
    
  left:10vw;

  }
  div.description,.title {
    width:57%;
  }
  
}
@media screen and (max-width: 1150px) {
  div.description,.title {
    width:47%;
  }
  
 

.blue{
	display:none;
}


@media screen and (max-width: 1030px) {

  div.profileDiv{
  display:none;
  }
  
  div.mainPostDiv{
  right:-130px;
  }

  }
@media screen and (max-width: 1000px) {
    #searchChoice{
    display: none;
    left:350px;
    margin-top: 41px;
    width:250px;

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
  #search{
    display:none;
    left:350px;
  top:40px;
    width:350px;
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
  }


  table{

    width:1%;
  }
	  
</style>


<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/read.php?q=<?php echo $_GET['q']?>";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/read.php?q=<?php echo $_GET['q']?>");
}
-->
</script>

<script type="text/javascript">

var stop = 1;
  var start = 5;
  var working = false; 
 $(window).scroll(function(){

    if($(this).scrollTop() + 1 >= $(document).height() - $(window).height()){



if(working==false && stop>0){
   
   working = true; 
   var data1;

var f = -1;

var data1 = <?php echo $post_id_search?>;

    var dataString = "readArticles=" + start + "&data="+data1; 
  
  
  
  
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
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"><input type="radio" value="Nudity"  name="report" report-id='+data[0][i].id+' id="nudity'+data[0][i].id+'"><label class="button" for= "nudity'+data[0][i].id+'">Nudity</label><input type="radio" value="Promoting drugs"  name="report" report-id='+data[0][i].id+'  id="drugs'+data[0][i].id+'" ><label class="button"  for="drugs'+data[0][i].id+'">Promoting drugs</label><input type="radio" value="Promoting Terrorism"  name="report" report-id='+data[0][i].id+'  id="terrorism'+data[0][i].id+'" ><label class="button" for="terrorism'+data[0][i].id+'">promoting terrorism</label><input type="radio" value="promoting sucide"  name="report" report-id='+data[0][i].id+'  id="sucide'+data[0][i].id+'" ><label class="button" for="sucide'+data[0][i].id+'"  >promoting sucide</label> <input type="radio" value="Harrasment"  name="report" report-id='+data[0][i].id+'  id="Harrasment'+data[0][i].id+'" > <label class="button" for="Harrasment'+data[0][i].id+'" >Harrasment</label>  <input type="radio" value="Inappropriate"  name="report" report-id='+data[0][i].id+'  id="Inappropriate'+data[0][i].id+'" ><label class="button" for="Inappropriate'+data[0][i].id+'"  >Inappropriate</label>  <input type="radio" value="fake news"  name="report" report-id='+data[0][i].id+'  id="fake news'+data[0][i].id+'" ><label class="button" for="fake news'+data[0][i].id+'">fake news</label>   <input type="radio" value="violence"  name="report" report-id='+data[0][i].id+'  id="violence'+data[0][i].id+'" ><label class="button" for="violence'+data[0][i].id+'">violence</label><input type="radio" value="other"  name="report" report-id='+data[0][i].id+'  id="other'+data[0][i].id+'" ><label class="button" for="other'+data[0][i].id+'">other</label><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id2='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport2'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport2'+f+'" submitReport-id2='+data[0][i].id+' writer2='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style=" margin-left:2%;min-width:700px;top:30px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:-22px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[11][i]+data[13][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authRank"  style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p class="authRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+data[14][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[15][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px;font-size:13px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px;font-size:13px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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

          
             
        }

        });
        return false;
       
     }

      });




//report an atricle
$('[submitReport-id2]').click(function(){

     var val = $("input[name='report']:checked").val();

        if(val){

     var postid = $(this).attr('submitReport-id2');
var authorID =$(this).attr('writer2');

var report_info = $("[report_info-id2='"+postid+"']").val();



var dataString1 =  "reportt=" + val +  "&postId=" + postid + "&authorId=" + authorID + "&report_info="+ report_info;

$.ajax({
  type:"POST",
  url:"ForHandligAjax.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[report_info-id2='"+postid+"']").val(" ");
    
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
         alert("This article will not show you on your feed");
          
          
        }

        });


}else{
  alert("chhose one of reason");
}


 });


  //end of all scripts

}

start+=5;
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
var data1;
var f = -1;
var data1 = <?php echo $post_id_search ?>;
    var dataString = "readArticles=" + val + "&data=" + data1; 
  
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
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"> <input type="radio" value="Nudity"  name="report" report-id='+data[0][i].id+' id="nudity'+data[0][i].id+'"><label class="button" for= "nudity'+data[0][i].id+'">Nudity</label><input type="radio" value="Promoting drugs"  name="report" report-id='+data[0][i].id+'  id="drugs'+data[0][i].id+'" ><label class="button"  for="drugs'+data[0][i].id+'">Promoting drugs</label><input type="radio" value="Promoting Terrorism"  name="report" report-id='+data[0][i].id+'  id="terrorism'+data[0][i].id+'" ><label class="button" for="terrorism'+data[0][i].id+'">promoting terrorism</label><input type="radio" value="promoting sucide"  name="report" report-id='+data[0][i].id+'  id="sucide'+data[0][i].id+'" ><label class="button" for="sucide'+data[0][i].id+'"  >promoting sucide</label> <input type="radio" value="Harrasment"  name="report" report-id='+data[0][i].id+'  id="Harrasment'+data[0][i].id+'" > <label class="button" for="Harrasment'+data[0][i].id+'" >Harrasment</label>  <input type="radio" value="Inappropriate"  name="report" report-id='+data[0][i].id+'  id="Inappropriate'+data[0][i].id+'" ><label class="button" for="Inappropriate'+data[0][i].id+'"  >Inappropriate</label>  <input type="radio" value="fake news"  name="report" report-id='+data[0][i].id+'  id="fake news'+data[0][i].id+'" ><label class="button" for="fake news'+data[0][i].id+'">fake news</label>   <input type="radio" value="violence"  name="report" report-id='+data[0][i].id+'  id="violence'+data[0][i].id+'" ><label class="button" for="violence'+data[0][i].id+'">violence</label><input type="radio" value="other"  name="report" report-id='+data[0][i].id+'  id="other'+data[0][i].id+'" ><label class="button" for="other'+data[0][i].id+'">other</label><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport'+f+'" submitReport-id='+data[0][i].id+' writer='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:2%;top:35px;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:-22px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[11][i]+data[13][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authRank" style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p  class="authRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+data[14][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[15][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px;font-size:13px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px;font-size:13px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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

          
             
        }

        });
        return false;
       
     }

      });




//report an atricle
$('[submitReport-id]').click(function(){

     var val = $("input[name='report']:checked").val();

        if(val){

     var postid = $(this).attr('submitReport-id');
var authorID =$(this).attr('writer');

var report_info = $("[report_info-id='"+postid+"']").val();



var dataString1 =  "reportt=" + val +  "&postId=" + postid + "&authorId=" + authorID + "&report_info="+ report_info;

$.ajax({
  type:"POST",
  url:"ForHandligAjax.php",
  cache:false,
  global:false,
  data:dataString1,
  success:function(data){


     $("[report_info-id2='"+postid+"']").val(" ");
    
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
         alert("This article will not show you on news feed");
          
          
        }

        });


}else{
  alert("chhose one of reason");
}


 });

  //end of all scripts

}

start+=5;
setTimeout(function(){
  working = false;
})

},
error:function(data){
  console.log(data);

}
});



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
 
  var val = $(this).val();
 $(".autocomplete").html("");
var dataString = "query="+val;

 currentRequest =  $.ajax({
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

      console.log(data);

 $(".autocomplete").html(
$(".autocomplete").html()+'<li class="list-group-item "  style="height:auto;"><a href="read.php?q='+data[i].title+'" style="color:black;word-wrap:break-word">'+data[i].title+'</a></li>'
  ); 
 
   
}

     },error:function(data){
      console.log(data);

     }
});

});

// for channel search code


$(".sbox2").keyup(function(){
  $(".autocomplete2").html("");
  var val = $(this).val();

var dataString = "query2="+val;

currentRequest =  $.ajax({
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
$(".autocomplete2").html()+'<li class="list-group-item "  style="height:auto;"><a href="otherProfile.php?q='+data[i].channelName+'" style="color:black">'+data[i].channelName+'</a></li>'
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

 currentRequest= $.ajax({
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
$(".autocomplete3").html()+'<li class="list-group-item"  style="height:auto;"><a href="otherProfile.php?q='+data[i].channelName+'" style="color:black">'+data[i].authorName+'</a></li>'
  );

  

}

     },error:function(data){
      console.log(data);

     }
});

});

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
  
    

  <a href="postEditor.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>


 
 <div id="forArticleSearch" style="display: block;">
     <form autocomplete="off" action="read.php">
     <button type="submit" id="searchBtn" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty()" title="Search" ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search" class="form-control  sbox"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search.." name="q">
   


       <ul class="list-group autocomplete" id="searchResult" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;word-wrap :break-word;max-height:500px;overflow: auto;font-size: 15px" >

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
  
       <ul class="list-group autocomplete2" id="searchResult2" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow: auto;font-size: 15px" >
       </ul>
         
     </form>

     </div>


 <!--search bar for author search-->
 <div id="forAuthorSearch" style="display: none">
     <form autocomplete="off" action="otherProfile.php">
     <button type="submit" id="searchBtn3" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty3()" title="Search3"  ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search3" class="form-control  sbox3"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search3.." name="q">
  
       <ul class="list-group autocomplete3" id="searchResult3" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow: auto;font-size: 15px" >

       </ul>
         
     </form>

     </div>

 </div>
</div>

<!--suggetion code place -->





<!--suggetion code end-->



 <!-- Middle Column -->
 <div id="page">


    <!--base for articles appearing-->
 <div class="PostMainDiv">

  <!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:50%;display: none;top:100px">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:50%;top:100px">
        </div>
         <!--base for articles appearing ends--> 
   
   <div class="profileDiv" id="profile" >

    <div class="w3-col m3" style="position:fixed;width:35%;min-width: 350px;height:90%;margin-top: -340px;overflow-x: hidden;overflow-y: auto;top:390px;right:-30px;margin-right: 10px ">
 <?php
 foreach ($followingposts as $pos){

 $keywords = $pos['keywords'];
    $postid=$pos['id'];
    $topic = $pos['Topics'];

    $keyword_data = explode(" ", $keywords);

//code for keyword feature

   

   $keyword_index1 = rand(0,(count($keyword_data)-1));



    $Dataaa = DB::query('SELECT title , user_id , titleImage , postRank , id , Topics FROM

     post WHERE  keywords LIKE :keywords OR Topics = :topics
   

    AND NOT id = :id ORDER BY postRank DESC 

    LIMIT 15 

       ' ,array(':id'=>$postid,':keywords'=>'%'.$keyword_data[$keyword_index1].'%' ,':topics'=>$topic));
  
   foreach($Dataaa as $da){ 

    $authorId = $da['user_id'];
    $imageTitle = $da['titleImage'];
    $titleMain = $da['title'];
    $postStrength = $da['postRank'];
    $postId=$da['id'];
$titleMain2 = substr($titleMain ,0 ,80);

 $suggetion_data = DB::query('SELECT authorName,channelName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$authorId));
 $autorname13 = "";
 $channelname13="";

 foreach ($suggetion_data as $Data31) {

   $authorname13 = $Data31['authorName'];
   $channelname13 = $Data31['channelName'];
  
 }

echo'

<a href="read.php?q=';echo $postId.'">
   <div class="w3-card w3-round w3-white" style="margin-bottom: -10px;height:130px;width:90%;overflow:hidden;margin-left: 10px;">

      <img class="img-thumbnail" src="';echo $imageTitle.'"  style="float:left;height:130px;width:110px">

  <div style="float:left;width:73%;overflow:hidden;margin-left: 110px;margin-top: -130px"><p style="font-size: 15px;font-family:Merriweather;" title="';echo $titleMain.'">';echo $titleMain2.'..</p></div>
<hr style="margin-top: 60px">
    <div style="float: left;width:73%;overflow: hidden;margin-left: 110px;margin-top: -70px;height:auto">
      <div style="width:150%;height:20px;overflow-y: hidden;">
        <p style="font-size: 15px;float:left;margin-top: 0px;font-family:Merriweather;color: grey">
 ';echo $channelname13.'
        </p>
</div>
        <div style="width:150%;height:25px;overflow-y: hidden;">
        <p style="font-size: 14px;float:left;margin-top: 7px;font-family:Merriweather;color: grey">
      ';echo $authorname13.'
        </p>
</div>

        <div style="width:150%;height:25px;overflow-y: hidden;">
      <p style="font-size: 13px;float:left;margin-top: 4px;font-family:Merriweather;color: grey">
        <center>strength:';echo $postStrength.'</center>
        </p>
</div>
       
      </div>
     
      
          <br>
</div>
<br>';

   }
 
}

    



?>
</div>
</div>
<!--suggetion code-->

<!---->
</div>
<!---->


   <script>


     //for search button
//search button
function empty() {
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