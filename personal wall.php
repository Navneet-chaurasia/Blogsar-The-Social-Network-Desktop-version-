
<?php 

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
		
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}		$username="";
		$fname="";
		$lname="";
		$email="";
		$gender="";
			$channelName="";
			$authorName="";
			$discription="";
			$dateOfBirth="";
			$city="";
			$state="";
			$proffession="";
			$aboutAuthor="";
			$channelImage="";
			
			if(Login::isLoggedIn()){
				$userid=Login::isLoggedIn();
				
			$username=DB::query('SELECT * FROM `channelsetup` , signup WHERE 
			signup.id=:userid
			AND channelsetup.user_id=:userid
			',array(':userid'=>$userid));
			foreach ($username as $data) {
				$fname=$data['fname'];
				$lname=$data['lname'];
				$email=$data['email'];
				$gender=$data['gender'];
				$dateOfBirth=$data['age'];
				$channelName=$data['channelName'];
				$authorName=$data['authorName'];
				$discription=$data['discription'];
				$city=$data['cityName'];
				$state=$data['stateName'];
				$proffession=$data['proffession'];
				$aboutAuthor=$data['aboutAuthor'];
				$channelImage=$data['channelImage'];
				
			}
			}

      author::strength($userid);
      $Subscriber = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid))[0]['subscribers'];
      $authorRank = DB::query('SELECT authorRank FROM user_details WHERE user_id=:userid',array(':userid'=>$userid))[0]['authorRank'];
       $noOfPosts = DB::query('SELECT noOfPosts FROM user_details WHERE user_id=:userid',array(':userid'=>$userid))[0]['noOfPosts'];
				?>
			
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<title>Blogsar-personal wall</title>
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

/* mid-Nav css
 * 
 */
 
 img{
    max-width:700px;
}

 #hideMenu:hover{
  color:blue;
 }
#set:hover{
  color: grey;
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

#myImg {
   font-size:50px;
   line-height:1.3em;
   color:sky-blue;
   text-align:center;
}

h1,h2,h3,h4,h5,h6{
	font-family: 'Open Sans', sans-serif;
}
.data{
  max-width:400px;
  max-height:400px;
}

/*for edge browser support*/
@supports (-ms-ime-align: auto) {




  .authorRank{
        position: relative;
        top:23px;
  }
  
}
.notif:hover{
      background-color: #ddd;
     }

/* for firefox */
@-moz-document url-prefix() {
 #subsBtn {
    margin-left:5000px;
    
  }
  #logo{
    margin-left: 500px;
  }
 
  	h1 {
  -ms-overflow-style: -ms-autohiding-scrollbar;
overflow-y: -moz-hidden-unscrollable;
  }
}

/* css for input file button*/
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	
}

@media screen and (min-width: 993px) {
  div.midNav{
    margin-left:500px;
  }
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
  div.hero-image{
   
  left:10%;
  }
  div.midNav{
    left:10%;
  }
}




/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 1299px) {
   div.hero-image{
   
  left:12%;
  }
   div.midNav{
    left:12%;
  }
  div.profileDiv{
  display:block;
  }
  #hideMenu{
    display:none;
  }
  div.description,.title {
    width:57%;
  }

  div.channelName{
 margin-top:20px;
  }
  .proimg{
  	margin-top:-75px;
  }
 
}
@media screen and (max-width: 1150px) {

  div.hero-image{
   
  left:15%;
  }
  div.midNav{
    left:15%;
  }

  #hideMenu{
    display: none;
  }
  div.description,.title {
    width:47%;
  }
  
  .channelName{
  margin-top: 20px;
  }
  
    div.mainPostDiv{
  display:none;
  }
   div.proimg{
  	margin-top:100px;
  }
  div.midNav{
  	
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
  
  
  #hideMenu{
    display: block;
  }
	div.profileDiv{
  display:none;
  }
  div.mainPostDiv{
  right:160px;
  }

  div.hero-image{
   
  left:8%;
  }
  div.midNav{
    left:20%;
  }
	
}


/* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
    
   



/*header image css*/
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}
/* The Modal (background) */
.modal1 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close1 {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close1:hover,
.close1:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
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
    background-clip: content-box;
       /* THIS IS IMPORTANT */
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

body, html {
    height: 100%;
}

/* The hero image */
.hero-image {
    /* The image used */
    

    /* Set a specific height */
    height:200px;
margin-top: 51px;
margin-left:340px;
    /* Position and center the image to scale nicely on all screens */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    position:relative;
}

/* Place text in the middle of the image */
.hero-text {
    text-align: center;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: blue;
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


  /*
notification button and div css
*/
#notifications{

  width:450px;
  height:auto;
  top:30px;
  left:37%;

}

 

textarea#styled {
	width: 550px;
	height:auto;
	min-height:40px;
	
	border: 3px solid #cccccc;
	padding: 5px;
	font-family: Tahoma, sans-serif;
	background-image: url();
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





.img-circle {
    border-radius: 50%;
}

.middle-column{
	margin-top:-30px;
}
.left-column{
	margin-top:-10px;
	
}


</style>
<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/personal wall.php";
}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/personal wall .php");
}
-->
</script>

<script type="text/javascript">


var start =5;
  var working = false; 
  var stop = 1;
 $(window).scroll(function(){
 
 if($(this).scrollTop()+2200>= $("body").height()+$(document).height()){



if(working==false && stop >0){
   
   working = true; 

var f = -1;
    var dataString = "myProfile=" + start; 
  
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
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"> <button class="button" report-id='+data[0][i].id+' value="Nudity" >Nudity</button> <button class="button"  report-id='+data[0][i].id+' value="Promoting drugs" >Promoting drugs</button>  <button class="button"  report-id='+data[0][i].id+' value="promoting terrorism" >promoting terrorism</button>  <button class="button"  report-id='+data[0][i].id+' value="promoting sucide" >promoting sucide</button>  <button class="button"  report-id='+data[0][i].id+' value="Harrasment" >Harrasment</button> <button class="button"  report-id='+data[0][i].id+' value="Inappropriate" >Inappropriate</button> <button class="button"  report-id='+data[0][i].id+' value="fake news" >fake news</button> <button class="button"  report-id='+data[0][i].id+' vlaue="violence">violence</button><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport'+f+'" submitReport-id='+data[0][i].id+' writer='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"><button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:22%;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:10px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[13][i]+data[11][i]+data[14][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authorRank" style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p class="authorRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[15][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px;font-size:13px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px;font-size:13px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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
var f = -1;
    var dataString = "myProfile=" + val; 
  
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
$(".PostMainDiv").html() + '<div id="reportArticle'+data[0][i].id +'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"> <p style="font-size: 20px;margin-top: -10px">Report this article</p> </div><div class="modal-body"> <button class="button" report-id='+data[0][i].id+' value="Nudity" >Nudity</button> <button class="button"  report-id='+data[0][i].id+' value="Promoting drugs" >Promoting drugs</button>  <button class="button"  report-id='+data[0][i].id+' value="promoting terrorism" >promoting terrorism</button>  <button class="button"  report-id='+data[0][i].id+' value="promoting sucide" >promoting sucide</button>  <button class="button"  report-id='+data[0][i].id+' value="Harrasment" >Harrasment</button> <button class="button"  report-id='+data[0][i].id+' value="Inappropriate" >Inappropriate</button> <button class="button"  report-id='+data[0][i].id+' value="fake news" >fake news</button> <button class="button"  report-id='+data[0][i].id+' vlaue="violence">violence</button><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" report_info-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 200px" maxlength="950" placeholder="give us some detail.." required ></textarea></div><label  class="btn btn-default"   for= "submitReport'+f+'" tabindex="0" title="Submit your report" style="font-size: 15px">Submit</label><button id="submitReport'+f+'" submitReport-id='+data[0][i].id+' writer='+data[0][i].user_id+' name="uploadSubmit" data-dismiss="modal" class="hidden" ></button></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div>  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:22%;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:10px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"><i class="fas fa-ellipsis-v fa-2x dropdown-toggle " class="" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  save-id='+data[0][i].id+' href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >'+data[8][i]+'</h3></a>'+data[13][i]+data[11][i]+data[14][i]+' </div></div><i class="fas fa-comment-slash" style="font-size:20px;float:right;color:black;display:'+data[6][i]+'"  mute-id='+data[0][i].id+'></i></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span class="authorRank"  style="margin-top:25px;margin-left:auto;float:left;">('+data[9][i]+' )</span><p class="authorRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p>'+data[10][i]+'<hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div>'+data[12][i]+'</div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[15][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><input type="button" class="btn btn-primary btn-sm" value="'+data[2][i]+'"  data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;background-color:'+data[3][i]+'"><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px;font-size:13px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;background-color:'+data[5][i]+'" myView-id='+data[0][i].id+'>'+data[4][i]+'</button> <span  style="font-family:Sanchez;font-size:13px"><p Views-id='+data[0][i].id+'  style="margin-bottom:-18px;margin-left:10px;font-size:13px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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
global:false,
dataType:'json',
async:false,
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

  currentRequest  = $.ajax({
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
$(".autocomplete2").html()+'<li class="list-group-item data"  style="height:auto;"><a href="otherProfile.php?q='+data[i].channelName+'" style="color:black">'+data[i].channelName+'</a></li>'
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

          currentRequest=$.ajax({
            type:"POST",
            url:"ForHandligAjax.php",
            dataType:'json',
            data:dataString,
            cache:false,
           // async:false,
           beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
            //global:false,
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



  var start1 = 20;
  var working1 = false; 
  var stop = 1;



    $("#show_more_noti").click(function(e){
e.preventDefault();

if(working1==false  && stop>0){
   
   working1 = true;

var dataString = "getNotifications="+start1;

   currentRequest= $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
//global:false,
 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
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

    //clear notitfication
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
<body class="w3-theme-light-blue">
	
<!-- Navbar -->
<div class="w3-top"  >
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
<span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
  <span style="position: absolute;margin-left: 30px;margin-top: 10px" ><i id="hideMenu" class="fas fa-bars " class="btn btn-info" style="font-size: 30px"  ></i></span>

    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:24%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="personal wall.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
 


  
    
 <div  style="position: relative;height:auto" >

  <button   id="noti_Button" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Updates" style="position: relative;"><i class="fas fa-bell " style="font-size: 30px">
     <span id="noti_Counter" style="position: absolute;left:45px;top:6px;font-size: 12px;z-index:50px;color:white;background-color: red;padding: 2px;display: none"><b></b></span>
  </i>
 
  </button>


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;min-height: 50px;height:auto;overflow-y:auto;border-bottom: 1px solid black">

 <p style="margin-left: 5px;font-size: 13px;margin-bottom: 5px;"><b>Notifications</b> <a href="#" style="position: absolute;right:5px" id="show_more_noti">Show more</a><a href="#" style="position: absolute;right:150px;color: red" id="clear_notification">Clear all</a></p>

<ul class="list-group Notifications" id="notify" style="margin-bottom: 0">

  </ul>


</div>
 </div>
 
  <a href="postEditor.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>

   
 <div id="forArticleSearch" style="display: block;">
     <form autocomplete="off" action="read.php">
     <button type="submit" id="searchBtn" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty()" title="Search" ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search" class="form-control  sbox"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search.." name="q">

 <ul class="list-group autocomplete" id="searchResult" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height:500px;overflow: auto;font-size: 15px" >

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


<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">
      <a href="privacy_rules.php" class="w3-bar-item w3-button" style="font-size: 17px">Privacy</a>
     
      <form action="logout.php" method="post">
      <input type="submit" name="confirm" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           <a href="block_list.php" class="w3-bar-item w3-button" style="font-size: 17px;color:red">blocked</a>
                <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#changePassword" style="font-size: 17px">change password</a>
                    <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#give_feedback" style="font-size: 17px">give feedback</a>
                        <a  class="w3-bar-item w3-button" href="reportHistory.php" style="font-size: 17px">Report history</a>
                     <a  class="w3-bar-item w3-button" data-toggle="modal" data-target="#about_myProfile" style="font-size: 17px">about this page</a>
    </div>
<button class="w3-button w3-padding-large  w3-hover-none" title="Settings" ><i class="fa fa-cog" style="font-size: 30px"></i></button>
  </div>
  
 </div>
</div>
<!--modal window for describing my Profile page-->
<div id="about_myProfile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">About Personal Wall</p>

      </div>
       <div class="modal-body">
  
<p style="font-size: 16px;font-family: Roboto">This page is called <b>Personal wall</b> before doing any stuff in blogsar you need to set-up your publication.<br><b>Steps</b>
  <ul style="font-size: 16px;font-family: Roboto">
  <li>upload a header image </li>
  <li>click to set-up button 
<ul style="font-size: 16px;font-family: Roboto"><li>
  write your author name this name will be show as a writer in all your article.
</li>
<li>
  write your publication name this name will be show as a publication house of all your article.</li>
<li>
  write your publication name this name will be show as a publication house of all your article.</li>
<li>Enter your D.O.B.</li>
<li> Enter your city and state</li>
<li> Write your proffession carefully it will be shown in your article and will affect your popularity.</li>
<li>Upload a title image of your channle , it should not be big in size.</li>
<li>Enter a brief description about your publication that describe your channle best. </li>
<li>Enter a brief description about you . It will be shown , when visitors will visit your channle </li>


</ul>
  </li>
  <li>Click about button
<ul style="font-size: 16px;font-family: Roboto">
  <li>It has all your information ,all this information will be shown to visitors when they will visit your channle but you can control that which information you want to show to your visitor in <a href="privacy_rules.php">privacy page</a></li>
   <li>You can also upload a image in about section(should be small in size)</li>

</ul>
  </li>
  <li>by clicking monetise button you can monetise your publication <a href="monetise_channel.php">check</a></li>
   <li>In stats button you can view all of statics about your articles and your publication. </li>
     <li>at Left side  there is a horizontal bar and called <b>profile bar</b> It contains all information such as your title image , your author name , number of subscribers , author strength and about your publication </li>
     

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
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">Change password</p>

      </div>
       <div class="modal-body">
  
        <div class="form-group">
  <label for="oldPass" style="float:bottom;position: relative;font-size: 18px">Old password</label>
  <input class="form-control" rows="5" id="oldPass" name="ask" style="margin-top:10px;resize: vertical;"  placeholder="Enter old password" />
</div>
<div class="form-group">
  <label for="newPass" style="float:bottom;position: relative;font-size: 18px">New password</label>
  <input class="form-control" rows="5" id="newPass" name="ask" style="margin-top:10px;resize: vertical;"  placeholder="Enter new password" />
</div>
<div class="form-group">
  <label for="confirmPass" style="float:bottom;position: relative;font-size: 18px">Confirm password</label>
  <input class="form-control" rows="5" id="confirmPass" name="ask" style="margin-top:10px;resize: vertical;"  placeholder="Confirm password" />
</div>

  <label  class="btn btn-default"  for="change" tabindex="0" title="Change password" style="">change</label>

<button id="change" name="uploadSubmit" data-dismiss="modal" class="hidden" ></button>

       </div>

      <div class="modal-footer">
          <p style="color:red;font-size: 15px">if you have forgotten your password then logout and click forgott password button and reset your password !</p>
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>

    <!-- modal window for giving feedback about website-->


  </div>
</div>  

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
  <!-- code for changing password-->          
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
  }else{
    alert("error");
  }
}else{
  alert("enter all fields")
}

    });


 
 // code for giving feedbacks


  $("#submit_").click(function(){

  var feedback = $("#web_feedback").val();
var giver = <?php  echo $userid ?>;

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


<!-- header image-->

<div class="hero-image" id="header" style="width:80%;left:18%;height:45%;top: 52px;margin:0;position: relative;margin-bottom:48px; ">
	<!-- Trigger the Modal -->
	<?php $url= DB::query('SELECT headerimages.imageUrl  FROM headerimages  WHERE 
	headerimages.userid = :userid
	 ',array(':userid'=>$userid));
	
	$image="";
	
	 ?>
<img id="myImg"  src="<?php foreach ($url as $imageurl) {
		$image=$imageurl['imageUrl'];
	 } echo $image ; ?>" class="img-thumbnail"  style="width:100%;height:100%;object-fit:cover" alt="Set your header image,  it's necessary :)"  >

<!-- The Modal -->
<div id="myModal" class="modal1">

  <!-- The Close Button -->
  <span class="close1">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
  <div class="image-text">
  </div>
  <div class="headerImage" style="margin-top: 295px">
    

<div style="margin-top:-480px;margin-right:10px">
    <input type="file" name="fileToUpload" id="fileToUpload" class="inputfile" onchange="readURL4(this);" accept="image/*">
    <label for="fileToUpload" class="btn btn-success btn-sm" style="position:absolute;right:7px">Choose image</label>
    </div>
</div>
</div>

<!-- header image div end-->
<div class= "midNav" style="margin-bottom: -68px;position:relative;margin-top:-39px;margin-left:-14%">
 <div class="btn-group-sm"  style="margin-left:26%">
  
 
  <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" style="width:150px"><p style="width:100%;margin:auto;font-family: Source Code Pro;font-size:15px">Set-Up Your profile</p></button>

<!-- Modal -->

<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title" style="font-family: lobster;font-size: 30px">Set-up your Publication..</h4>
      </div>
      <div class="modal-body">
      <form action="acountSetUp.php" method="post" enctype="multipart/form-data" id="setup">
  <div class="form-group">
    <label for="author" style="font-size: 25px">Set your Author Name</label>
    <input type="text" class="form-control" name= "authorName" id="author" maxlength="50" autocomplete="off" width="50%" value="<?php echo $authorName?>" placeholder="Write your Author-name" required>
    <p id="warning1" style="color:red;font-size: 13px;margin-left: 20px;font-family: monospace;"></p>
  </div>
  <div class="form-group">
    <label for="channel" style="font-size: 25px"> Publication Name</label>
    <input type="text" class="form-control" name= "channelName" id="channel" maxlength="50" autocomplete="off" width="50%" value=" <?php echo $channelName?>" placeholder="Write your Channel-name" required>
    <p id="warning2" style="color:red;font-size: 13px;margin-left: 20px;font-family: monospace;"></p>

  </div>
  <div class="form-group">
    <label for="age" style="font-size: 25px">Date Of Birth</label>
    <input type="date" class="form-control" name= "Age" id="age" maxlength="15" autocomplete="off" width="50%" value="<?php echo $dateOfBirth?>" placeholder="Enter your DOB as 2017-08-25" required="true">
  </div>
  <div class="form-group">
  	<div class="form-group">
    <label for="state" style="font-size: 25px">Your State</label>
    <input type="text" class="form-control" name= "stateName" id="state" maxlength="15" autocomplete="off" value="<?php echo $state?>" width="50%" placeholder="Write your Home-state name" required="true">
  </div>
  <div class="form-group">
    <label for="city" style="font-size: 25px"> City</label>
    <input type="text" class="form-control" name= "cityName" id="city" maxlength="20" autocomplete="off" width="50%" value="<?php echo $city?>" placeholder="Write your City Name" required="true">
  </div>
    <div class="form-group">
    <label for="city" style="font-size: 25px">Proffession</label>
    <input type="text" class="form-control" name= "proffession" id="city" maxlength="50" autocomplete="off" width="50%" value="<?php echo $proffession?>" placeholder="Write your proffession" required="true">
  </div>
  
  	<label for="fileToUpload6" style="font-size: 25px">Title Image Of Your Publication</label>
  <input type='file' name="fileToUpload"  id="fileToUpload6" class="inputfile" onchange="readURL3(this); "accept="image/*"/>
  <label for="fileToUpload6"  class="btn btn-primary">Choose image</label>
  <span style="color:red;font-size: 13px;float: right;display: none" id="imgAlert">Please choose an image ! </span>
<center><img id="blah3"  src=" <?php echo $channelImage?>" class="img-thumbnail"  style="height:50%;width:50%" alt="Set an image,  it's necessary :)"></center>
</div>
       <div class="form-group">
  <label for="comment" style="float:bottom;position: relative;font-size: 25px">Publication Description</label>
  <textarea class="form-control" rows="5" id="comment" name="description" style="margin-top:10px; resize:vertical;min-height:50px"
   maxlength="300" placeholder="Write brief description of your Channel" > <?php echo $discription?></textarea>
</div>
 <div class="form-group">
  <label for="about" style="float:bottom;position: relative;font-size: 25px">About Yourself</label>
  <textarea class="form-control" rows="5" id="about" name="aboutAuthor" style="margin-top:10px; resize:vertical;min-height:50px" maxlength="500"  placeholder="Write brief description about yourself" ><?php echo $aboutAuthor?></textarea>
</div>


  
  <label  class="btn btn-default"  for="submit-form" tabindex="0" title="Save the changes" style="font-size: 20px">Save</label>

<button type="submit"  id="submit-form" name="uploadSubmit" class="hidden" value="post"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>

  </div>
</div>
</form>


  <button type="button" class="btn btn-info" style="width:90px" onclick="about()"><p style="width:100%;margin:auto;font-family: Source Code Pro;font-size: 15px">About</p></button>
      <?php
  $subscribers_count = DB::query('SELECT subscribers FROM user_details WHERE user_id =:id',array(':id'=>$userid))[0]['subscribers'];
$noOfPosts = DB::query('SELECT noOfPosts FROM user_details WHERE user_id =:id',array(':id'=>$userid))[0]['noOfPosts'];
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
 echo'
  <button type="button" data-toggle="modal" data-target="#myModal3"  class="btn btn-info" style="width:90px"><p style="width:100%;margin:auto;font-family: Source Code Pro;font-size:15px" ><a ';if($subscribers_count>=100 && $noOfPosts >=10 && $authorStrength >=1000){echo'href="monetise_channel.php"';}echo' style="color:white">Monetise</a></button>

  <button type="button" class="btn btn-info" style="width:90px"><p style="width:100%;margin:auto;font-family: Source Code Pro;font-size: 15px" onclick="stats()"><a href="stats.php" style="color:white">Stats</a></p></button>
  
</div>
</div>
</div>


    <!--monetisation  modal window -->
    
';
     
  echo'

  <div id="myModal3" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content monetise window-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: lobster;font-size: 20px;color:black">monetisation</h4>
      </div>
      <div class="modal-body">
     <p style="color:black">Sorry you can not monitise your articles currently.<a href="monetise.php">know why</a> 
     <br>
     But soon you will be able to monetise your article. <br>Till than enjoy sharing articles.<br></p>
    <p style="font-size:17px;color:red"> Till than participate on the contest currently running in blogsar<a href="monetise.php">know more</a></p>
 
      </div>
         <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 15px">Close</button>
      </div>
      
    </div>
  </div>
</div>';
 

  ?>
   <!--monetisation modal window end-->
    
    
<!-- Navbar on small screens -->

<!-- Page Container -->
<div class="w3-container w3-content" id="page" style="max-width:1400px;margin-top:80px;margin-left: 20px;position: relative;" >    
  <!-- The Grid -->
  <div class="w3-row" >
    <!-- Left Column -->
    
    <div class="profileDiv" id ="profile" style="position:absolute;top:0;height:96%">

    <div class="w3-col m3" style="position:fixed;width:230px;min-width:200px;left:10px;height:96%;top:420px;margin-top :-340px">
      <!-- Profile -->
      <center><div id="profile" class="w3-card w3-round w3-white" id="a" style="margin-top: -26px;overflow: auto;overflow-x: hidden;word-wrap: break-word;position: absolute;height: 96%">
        <div class="w3-container">
        	    <!-- code for uploading profile iamge-->
        	    
        	    	
      <div style="width: 200px;height: auto;word-wrap: break-word">
         <h2 class="channelName" style="color:blue; font-family:Baloo Bhai;margin-top:10px;margin-bottom: 0px ;font-size: 20px"><?php echo $channelName ;?></h2>
         </div>
         
         	
         <img src="<?php echo $channelImage ; ?>" class="img-thumbnail"   style="height:70%;margin-top:25px; width:80%;margin:0;padding: 0;object-fit: cover;" alt="set Your Image" />
  
     
	
          
         <!-- -*+++  -->
        
         <hr>
         <div style="margin-top:40px">
         	
     
       	<div style="margin-right: 100px;height: auto;word-wrap: break-word;margin-top:-36px;width: 200px;margin-right: 0"> 
       	<h4 style="margin-left:0px;;margin-bottom:0;font-family: Sawarabi Mincho;font-size:16px"><?php echo $authorName;?></h4>
       	</div>
       	<hr>
       
       	 	<br> <span style="margin-right: 150px"> <p  class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:16px;font-family:roboto;color:black"><a href="stats.php"> Subscribers</a></p>
       	<h4 style="margin-right:80px;margin-bottom: 0px;margin-top:-10px;font-family: Sawarabi Mincho;font-size:16px"><?php echo $Subscriber ?></h4>
       	</span>
     
       	<hr>
<br><span style="margin-right: 100px"> <p class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:16px;font-family:roboto;text-align:left"><b>Author Strength</b></p>
       	<h4 style="margin-left:0px;margin-bottom: -0px;font-family: Sawarabi Mincho;font-size:16px"><?php echo $authorRank ?></h4>
       	</span>


        <hr>
<br><span style="margin-right: 100px"> <p class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:16px;font-family:roboto;text-align:left"><b>Published Articles</b></p>
        <h4 style="margin-left:0px;margin-bottom: -0px;font-family: Sawarabi Mincho;font-size:16px"><?php echo $noOfPosts ?></h4>
        </span>


     
       
     
        <hr>
        <br> <span style="margin-right: 100px"> <p  class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:16px;font-family:roboto;text-align:left"><b>Channel Intro..</b></p>
       	<h4 style="margin-left:0px;;margin-bottom: -0px;font-family: Sawarabi Mincho;font-size:16px"><?php echo $discription?></h4>
       	</span>
     
      
        </div>
      
      
      </div>
   
     
  
      <!-- copy right mark of Blogsar
       <p style="position: absolute;bottom: -50px;left:40px">Blogsar © 2019</p>
      Accordion -->
     </div>

    </div>

    <!-- End Left Column -->
    </div>
    <!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:40%;display: none">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:40%">
<!--Loading progress bar for article loading  ends-->
       <!--base for articles appearing-->
 <div class="PostMainDiv" style="margin-top: 12px" id="mainPostDiv">


        </div>
         <!--base for articles appearing ends--> 
     
     
     <!-- php code for about column start-->
    
     
     <!-- php code for about column ends-->
     
     <!--  start about column Div-->
     <?php $url5= DB::query('SELECT imageUrl  FROM profileimage WHERE 
	userid = :userid
	 ',array(':userid'=>$userid))[0]['imageUrl'];?>
     <div id="aboutColumn" style="display:none; margin-top:10px;width:110%;">
     <div class="w3-col m7"  style=" margin-left:20%;margin-bottom:10px;min-width: 600px;">

     <div class="middle-column" style="position: relative;" >

      <div class="w3-container w3-card w3-white w3-round w3-margin"  style="height:auto;max-width:100%"><br>

 <div style="word-wrap:break-word">
<div  style="width:30%;height:50px"><h2 style="margin-top:-15px;font-size: 20px;color:pink;">Profile</h2></div>

      <div class="well" style="width:100%;position: relative;"><h2 style="margin-top:-15px;font-size: 20px">Name :</h2><p style="font-family: monospace;font-size: 20px"> <?php echo $fname." ".$lname?></p></div>

      <div class="well" style="width:100%;position:relative;"><h2 style="margin-top:-15px;font-size: 20px">Author Name: </h2><p style="font-family: monospace;font-size: 20px"><?php echo $authorName?></p></div>

  <div class="well" style="width:45%;height:auto;min-height: 300px;position: relative;">

  	      <form  method="post" enctype="multipart/form-data">
  	<label for="fileToUpload2" style="font-size:20px;margin-top: -10px">Profile Photo</label>
  <input type="file" name="fileToUpload2" id="fileToUpload2" class="inputfile" onchange="readURL1(this);" required accept="image/*"/>

<center><img id="blah2"  src=" <?php echo $url5?>" class="img-thumbnail"  style="height:200px;width:300px" alt="Set an image,  it's necessary :)"></center>
  <label for="fileToUpload2" class="btn btn-primary" style="margin-top: 4px">Choose image</label>
   
  </form>
</div>
</div>
    <div class="well" style="width:48%;position: relative;height:300px;word-wrap:break-word;left:52%;top:-320px;overflow:auto"><h2 style="margin-top:-15px;font-size: 20px">BIO : </h2>
    	<p style="font-size: 20px;font-family:Shadows Into Light"> <?php echo $aboutAuthor?></p></div>

        <div class="well" style="width:100%;position: relative;top:-320px"><h2 style="margin-top:-15px;font-size: 20px">Channel Name:</h2> <p style="font-family:monospace;font-size: 20px"> <?php echo $channelName?></p></div>
<div class="well" style="width:48%;position:relative;top:-320px"><h2 style="margin-top:-15px;font-size: 20px"> Date Of Birth</h2> <p style="font-family: monospace;font-size:17px"><?php echo $dateOfBirth?></p></div>
    

     <div class="well" style="width:48%;position: relative;top:-435px;left:52%"><h2 style="margin-top:-15px;font-size: 20px">State: </h2><p style="font-family: monospace;font-size: 20px"><?php echo $state?></p></div>

     <div class="well" style="width:48%;position: relative;top:-440px"><h2 style="margin-top:-15px;font-size: 20px">City :</h2><p style="font-family: Cantata One;font-size: 20px"> <?php echo $city?></p></div>

     <div class="well" style="width:48%;position: relative;top:-554px;left:52%"><h2 style="margin-top:-15px;font-size: 20px">Gender:</h2> <p style="font-family: monospace;font-size: 20px"><?php echo $gender?></p></div>

      <div class="well" style="width:100%;position: relative;top:-550px"><h2 style="margin-top:-15px;font-size: 20px">Proffession : </h2><p style="font-family: monospace;font-size: 20px"><?php echo $proffession?></p></div>
      
  
      <div class="well" style="width:100%;position: relative;top:-550px;word-wrap: break-word;"><h2 style="margin-top:-15px;font-size: 20px">Contact :</h2> <p style="font-family: monospace;font-size: 20px"> <?php echo $email?></p></div>

     <div class="well" style="width:100%;top:-550px;margin-bottom:-500px;height:auto;word-wrap:break-word;overflow:auto;position:relative;"><h2 style="margin-top:-15px;font-size: 20px">Channel  Description: </h2> 
     	<p style="font-family: monospace;font-size: 17px"> <?php echo $discription ?></p></div>

        </div>
</div>
           </div>

      </div>



<!-- End of the about column Div-->

    <!-- Right Column -->
  <!--end grid-->  
  </div>
<!-- End Page Container -->
</div>



<!-- Footer -->

 


<script> 

 


//notifications js ends



// hide menu code

$(document).ready(function(){

// setting up channel name and author name
$("#author").keyup(function(){
  
          var val = $(this).val();
          var dataString = "set_auth="+val;

 $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
 global:false,
 dataType:'json',
success: function(data)
       {
          
          console.log(data);

          $("#warning1").html(data);

          if(data[0] == "Author Name is not available"){

          $("#setup").attr("onsubmit","return false");

                         }else{

                          $("#setup").attr("onsubmit","return true");
                         }


     },error:function(data){
      console.log(data);

     }
});



});



// setting up channel name and author name
$("#channel").keyup(function(){
  
          var val = $(this).val();
          var dataString = "set_channel="+val;

 $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
 global:false,
 dataType:'json',
success: function(data)
       {
          
          console.log(data);

          $("#warning2").html(data);


          
          if(data[0] == "Published Name is not available"){

          $("#setup").attr("onsubmit","return false");

                         }else{

                          $("#setup").attr("onsubmit","return true");
                         }


     },error:function(data){
      console.log(data);

     }
});



});


   //for alerting that profile image is not selected in setup section
   $("#submit-form").click(function(){



            var val = $("#fileToUpload6").val();

            if(val){

            }else{

              $("#imgAlert").css("display","block");
            }

   });

$("#hideMenu").click(function(){
 
 $("#profile").css("position","absolute");
  $("#profile").css("z-index","10");
   $("#profile").css("margin-left","-33px");




          $("#profile").toggle();




});

});

// hide menu code end

// channel image validation code start

$(document).ready(function(){
 $(document).on('change', '#fileToUpload6', function(){
  var name = document.getElementById("fileToUpload6").files[0].name;
  
  var ext = name.split('.').pop().toLowerCase();
   var oFReader = new FileReader();

  oFReader.readAsDataURL(document.getElementById("fileToUpload6").files[0]);
  var f = document.getElementById("fileToUpload6").files[0];
  var fsize = f.size||f.fileSize;

  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {

   alert("Invalid Image File");
   return false;
  }
  else if(fsize > 2000000)
  
  {
  alert("Image File Size is very big");
  return false;
}
else{
  return true;
}
  
   
 });
});

// channnel image validation code end

// for profile image uploading code using ajax

$(document).ready(function(){
 $(document).on('change', '#fileToUpload2', function(){
  var name = document.getElementById("fileToUpload2").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  else
  
  {var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("fileToUpload2").files[0]);
  var f = document.getElementById("fileToUpload2").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 20000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
  
	
 form_data.append("fileToUpload2", document.getElementById('fileToUpload2').files[0]);
   $.ajax({
    url: "profileImage.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
       
    success:function(data)
    {
  alert(data);
    }
   });
  }
  }
 });
});


// ajax code for uploading header imAage 


$(document).ready(function(){
 $(document).on('change', '#fileToUpload', function(){
  var name = document.getElementById("fileToUpload").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
   return false;
  }
  else
  
  {var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("fileToUpload").files[0]);
  var f = document.getElementById("fileToUpload").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 40000000)
  {
   alert("Image File Size is very big");


  }
  else
  {
  


	
 form_data.append("fileToUpload", document.getElementById('fileToUpload').files[0]);
   $.ajax({
    url: "headerImageUpload.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
       
    success:function(data)
    {
  alert("Header Image Updated succesfully :)");
    }
   });
  }
  }
 });
});





        $(document).ready(function() { 
            $("#fileToUpload3").click(function(){
            	$("#form").ajaxForm().submit();
            });
        }); 

//for displaying about button
function about()
{
	var x=document.getElementById("mainPostDiv");
	var y =document.getElementById("aboutColumn");
	var i;
	if(y.style.display=="none"){
		
    
    	x.style.display="none";
    	
   

y.style.display="block";
	}
	 else if( y.style.display=="block")
    {
    	y.style.display="none";

    	x.style.display="block";
    }

}



// image preview in SET-UP modal window
// image preview of profile image
	function readURL3(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah3')
        .attr('src', e.target.result)
        .width(400)
        .height(400);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
function readURL1(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah2')
        .attr('src', e.target.result)
        .width(200)
        .height(200);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
// image preview of headerImage


function readURL4(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#myImg')
        .attr('src', e.target.result)
        
    };
    reader.readAsDataURL(input.files[0]);
  }
}
// image preview end of header image




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
//header image javasript
// Get the modal
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById('myImg');
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close1")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
// header image javasript end



function stats(){

  window.location.href = "stats.php";

}

</script>

</body>

</html> 			