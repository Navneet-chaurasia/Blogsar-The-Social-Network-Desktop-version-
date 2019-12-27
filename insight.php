<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(Login::isLoggedIn()){
    
    $data = $_GET['q'];
    
  header("location:read.php?q=$data");
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

              header("location:loginpage.php");

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

   header("location:loginpage.php");
     }  



}

}else{

 header("location:loginpage.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $_GET['q']; ?></title>
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

    width:100%;
  }
	  
</style>

<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/mobile_insight.php?q=<?php  echo $_GET['q'];?>";
}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/mobile_insight.php?q=<?php  echo $_GET['q'];?>");
}
-->
</script>

<script type="text/javascript">





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
    var dataString = "readWithoutLoggedInArticles=" + val + "&data=" + data1; 
  
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
$(".PostMainDiv").html() + ' <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:2%;top:35px;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:-22px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px"><a  href="otherProfile.php?q='+data[0][i].user_id+'" style="color:black;position:relative">'+data[1][i].channelName+'</a></p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span><div class="dropdown dropleft" style="margin-left:auto;margin-top:-10px;float:right"> <i class="fas fa-ellipsis-v fa-2x" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px "></i> <div class="dropdown-menu" ><a class="dropdown-item"  href="#" ><h3 h1-id='+data[0][i].id+' style="font-size:15px" >Login</h3></a> </div></div></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authRank" style="margin-top:25px;margin-left:auto;float:left;">('+data[2][i]+' )</span><p  class="authRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p><hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div></div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"><div style="float:right;margin-top:-60px;margin-bottom:-260px ;font-family:Playfair Display SC;font-size:15px"><p>Published</p> '+data[3][i]+'</div> <div class="" style="margin-right:60px;position:relative;top:-80px;margin-bottom:-200px;max-width:100%"><a href="loginpage.php" type="button" class="btn btn-primary btn-sm"   data-id='+data[0][i].id+'  style="width:90px;font-family:Bree Serif;font-size:15px;">Like</a><span  style="font-family:Sanchez;font-size:13px"><p  data-id2='+data[0][i].id+'  style="margin-top:10px;margin-right:-10px;font-size:13px"> '+data[0][i].likes+'</p>  </span></div><div class="" style="position:relative;top:50px;max-width:100%;left:300px;margin-bottom:0" > <button  class="btn btn-primary btn-sm" style="width:90px;left:100px;font-family:Bree Serif;font-size:15px;">views</button> <span  style="font-family:Sanchez;font-size:13px"><p style="margin-bottom:-18px;margin-left:10px;font-size:13px">'+data[0][i].views+'</p></span></div><div class="" style="position:relative;top:15px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )

 
// for toggle articles
$('[read-id]').click(function(){
var buttonid =   $(this).attr('read-id');

 var x =  $("[read-id='"+buttonid+"']")[0];

    var x =  $("[myDiv-id='"+buttonid+"']")[0];
   var y =  $("[Div-id='"+buttonid+"']")[0];
     var z =  $("[read-id='"+buttonid+"']")[0];
    
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

     y.style.display="none";
     x.style.display="block";



//code to submit form.


   } 
 
});


//feedback area javascript


//feedback submiting

  //end of all scripts

}



},
error:function(data){
  console.log(data);

}
});






  });



</script>

</head>



<body>
	

<!-- Navbar -->
<div class="w3-top">
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">
 <span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 

    <a href="loginpage.php" id="home" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Home"  style="margin-left:35%"><i class="fa fa-home" style="font-size: 30px"></i></a>

  <a href="loginpage.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
  
    

  <a href="loginpage.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>


 


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

<div class="w3-col m3" style="position:fixed;width:30%;min-width: 350px;height:90%;margin-top: -340px;overflow-x: hidden;overflow-y: auto;top:390px;right:0px;margin-right: 10px ">

<!--will write here something-->
<p style="font-size: 21px;font-family: Fredoka One">Blogsar is an article sharing social media website where users write and share their articles with the people who are eager to read something new something interesting.<br>
So on Blogsar we are building the community of authors and readers to make the world a better place by spreading knowledge through articles.<br>
 Also Blogsar provides writers a way so that they can earn money through writing and sharing articles.<br>
Do signup into Blogsar and be an Author and write articles just like that you are reading now.<br>
<a href="signUp.php" class="btn btn-lg btn-info">Sign Up</a>


</p>
</div>

<!--will write here something-->

</div>
<!--suggetion code-->

<!---->
</div>
<!---->


   <script>


  
   	

   </script>

</body>
</html>