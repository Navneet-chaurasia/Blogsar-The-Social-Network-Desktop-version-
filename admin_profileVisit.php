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
      
  

			$followerid = Login::isLoggedIn();
			$userid2="";
	$subsVal = "";
  $subsColor="";
			$data="";
			$fname1="";
			$lname1="";
		
		  $email1="";
		  $gender1="";
			$channelName1="";
			$authorName1="";
			$discription1="";
			$dateOfBirth1="";
			$city1="";
			$state1="";
			$proffession1="";
			$aboutAuthor1="";
			$channelImage1="";
			$imageurl1="";
			$subscriber1="";

					if(!empty($_GET['q']))
					{
            if(is_numeric($_GET['q'])){


			
						if(DB::query('SELECT id FROM signup WHERE id=:userid', array(':userid'=>$_GET['q'])))
						{
              $userid2 = $_GET['q'];
             

               author::strength($userid2);

            }
            else{
              die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">channel not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="homeTemplate.php">Go back..</a></div>');
            }
          }else if(DB::query('SELECT channelName FROM channelsetup WHERE channelName LIKE :name', array(':name'=>'%'.$_GET['q'].'%'))){
            $userid2 = DB::query('SELECT user_id FROM channelsetup WHERE channelName LIKE :name',array(':name'=>'%'.$_GET['q'].'%'))[0]['user_id'];
             author::strength($userid2);
           

            
          }
          else{
            die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">channel not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="homeTemplate.php">Go back..</a></div>');
          }
							
							 $subscriber1 = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
 $authRank= DB::query('SELECT authorRank FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['authorRank'];
				
				
			$username=DB::query('SELECT channelsetup.*,signup.fname,signup.lname,signup.email,signup.gender,profileimage.imageUrl FROM `channelsetup` ,profileimage,signup WHERE 
			channelsetup.user_id=:userid
			     AND profileimage.userid=:userid
			 AND signup.id=:userid
			',array(':userid'=>$userid2));
			
			
			foreach ($username as $data) {
				$email1=$data['email'];
				$gender1=$data['gender'];
				$dateOfBirth1=$data['age'];
				$fname1=$data['fname'];
				$lname1=$data['lname'];
				
				$channelName1=$data['channelName'];
				$authorName1=$data['authorName'];
				$discription1=$data['discription'];
				$city1=$data['cityName'];
				$state1=$data['stateName'];
				$proffession1=$data['proffession'];
				$aboutAuthor1=$data['aboutAuthor'];
				$channelImage1=$data['channelImage'];
				$imageurl1=$data['imageUrl'];
				
				
			}
     
          }else{
            die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">channel not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="homeTemplate.php">Go back..</a></div>');
          }
         
			?>
			<?php



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-<?php echo $authorName1?></title>
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
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

</script>

<style>


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

.data{
  max-width: 400px;
  max-height: 400px;
}


h3 {
        display:block;
        color:#333; 
        background:#FFF;
       
        font-size:13px;    
        padding:8px;
        margin:0;
      
    }
#set:hover{
  color:grey;
}
/* for edge support */
@supports (-ms-ime-align: auto) {
  .subsBtn2{
position: relative;
top:30px;
  }

  .authorRank{
position: relative;
top:23px;
  }

}

/* If the screen size is 601px wide or more, set the font-size of <div> to 80px */

@media screen and (min-width: 1300px) {
  div.profileDiv{

  display:block;

  }


  #hideMenu{

    display: none;

  }

  div.description {

    width:63%;

  }

}

/* If the screen size is 600px wide or less, set the font-size of <div> to 30px */
@media screen and (max-width: 1299px) {

div.profileDiv{

  display:block;

  }
 
  div.midNav{
    left:10%;
  }

  #hideMenu{
    display: none;
  }
  div.description {
    width:57%;
  }
}
@media screen and (max-width: 1150px) {
 
  #hideMenu{
    display: none;
  }
  div.description {
    width:47%;
  }
   
}

@media screen and (max-width: 1000px) {
  
  

 

div.aboutColumn{

  right:150px;

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
 
	
}

/* A CIRCLE LIKE BUTTON IN THE TOP MENU. */
    
        
   
        
    

/*header image css*/
#myImg {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
    

}



/* The Modal (background) */
.modal2{
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
.modal-content{
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

#hideMenu:hover{
  color:blue;
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


.notif:hover{
      background-color: #ddd;
     }

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
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

html,body {font-family: "Open Sans", sans-serif}




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

   var stop = 1;
  var start = 5;
  var working = false; 
 $(window).scroll(function(){

    if($(this).scrollTop()>= $("body").height()-$(document).height()){



if(working==false && stop>0){
   
   working = true; 

   var userid = <?php echo $userid2 ?>;

var f = -1;
    var dataString = "adminOtherProfileVisit=" + start + "&userid="+userid; 
  
 $.ajax({

type: "POST",

url: "forhandlingAjaxAdmin.php",

data: dataString,

cache: false,
dataType:'json',
global:false,

success: function(data)

       { 
    
 console.log(data);

   stop = data[0].length;

for(var i=0;i<data[0].length;i++){
 f++;



 $(".PostMainDiv").html(
$(".PostMainDiv").html() + '  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:22%;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:10px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:400px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px">'+data[1][i].channelName+'</p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authorRank" style="margin-top:25px;margin-left:auto;float:left;">('+data[2][i]+' )</span><p class="authorRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p><hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div></div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:20px;margin-bottom:10px"> <div class="" style="position:relative;top:0px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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
       
     y.style.display="none";
     x.style.display="block";



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

//code for initial 5 articles

 $(document).ajaxStart(function(){

      $("#loadingImage1").css("display","block");
  });


  $(document).ajaxComplete(function(){

      $("#loadingImage1").css("display","none");
  });

var val = 0;
var f = -1;
 var userid = <?php echo $userid2?>;
    var dataString = "adminOtherProfileVisit=" + val + "&userid="+userid; 
  
 $.ajax({

type: "POST",

url: "forhandlingAjaxAdmin.php",

data: dataString,

cache: false,
dataType:'json',

success: function(data)

       { 
    

   

for(var i=0;i<data[0].length;i++){
 f++;



 $(".PostMainDiv").html(
$(".PostMainDiv").html() + '  <div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:22%;min-width:700px;position:relative;display:block"> <div class="w3-col m7" style="margin-bottom:10px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:400px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px">'+data[1][i].channelName+'</p> <img src="'+data[1][i].channelImage+'" class="img-thumbnail" style="height:58px;width:70px;border:1px;"> </div> <span  style="margin-left:-30%;margin-right:10%;float:right;margin-top:-8px">strength : '+data[0][i].postRank+'</span></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h4 style="margin-bottom:-50px ; font-family:Bree Serif;font-size:20px "> written by : '
+data[1][i].authorName+' </h4><span  class="authorRank" style="margin-top:25px;margin-left:auto;float:left;">('+data[2][i]+' )</span><p class="authorRank" style="margin-top:25px;margin-left:auto;float:left;color:red">'+data[1][i].proffession+'</p><hr style="margin-top:70px"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div></div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide" ><b><h1 style="font-family:Merriweather;font-size:22px">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;position:relative;top:20px"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:20px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:20px;margin-bottom:10px"> <div class="" style="position:relative;top:0px;max-width:100%;left:135px;margin-bottom:0"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


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
       
     y.style.display="none";
     x.style.display="block";



   } 
 
});


  //end of all scripts

}



},
error:function(data){


}
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
setInterval(getUsers, 90000); 

//






  });

</script>

</head>
<body class="w3-theme-light-blue">

<!-- Navbar -->
<div class="w3-top"  >
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px">
<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px">blogsar Admin</h4></span>
  <span style="position: absolute;margin-left: 30px;margin-top: 10px" ><i id="hideMenu" class="fas fa-bars " class="btn btn-info" style="font-size: 30px"  ></i></span>

    <a href="admin_home_page.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:40%"><i class="fa fa-home" style="font-size: 30px"></i></a>

  <a href="admin_profile.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user" style="font-size: 30px"></i></a>
 



 

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
 



<!-- header image-->

<div class="hero-image" id="headerImage" style="width:80%;top:51px;height:25vw;margin: 0;position:relative;left:18%;margin-bottom: -15px">
	<!-- Trigger the Modal -->
	<?php $url= DB::query('SELECT imageUrl FROM headerimages WHERE userid=:userid',array(':userid'=>$userid2));
	$image="";
	
	 ?>
<img class="img-thumbnail"  id="myImg" src="<?php foreach ($url as $imageurl) {
		$image=$imageurl['imageUrl'];} echo $image ; ?>" 
		style="object-fit:cover;height:100%;width:100%">

<!-- The Modal -->
<div id="myModal" class="modal2">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img01">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
  <div class="image-text">
   
  </div>
<!-- header image div end-->
<!-- middle navbar -->
<div class= "midNav" style="margin-bottom:-50px;position:absolute;margin-top:-36px">
 <div class="btn-group-sm" style="margin-left:5px">
  <button type="button" class="btn btn-info" style="width:90px" onclick="about()"><p style="width:100%;margin:auto;font-family: Source Code Pro;font-size: 15px">About</p></button>


  
</div>
</div>

</div>


<!-- Page Container -->
<div class="w3-container w3-content" id="page" style="max-width:1400px;margin-top:80px;margin-left: 20px;position:relative; ;" >    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
  <div class="profileDiv" id="profile" style="position: absolute;top:0;height:96%;word-wrap:break-word">

   <div class="w3-col-m3" style="position:fixed;top:420px; margin-left:-29px;margin-top: -340px;height:96%;word-wrap:break-word">
      <!-- Profile -->
     
<!-- The Modal -->

      <center><div class="w3-card w3-round w3-white" style="margin-top:-28px;position: absolute;height:96%;overflow: auto;overflow-x: hidden;word-wrap:break-word;width:230px">
        <div class="w3-container">
          <div style="width: 200px;height: auto;word-wrap: break-word">
       <h2 style="color:blue; font-family:Baloo Bhai;margin-top:10px ;margin-bottom:-10px;font-size: 22px"><?php echo $channelName1 ;?></h2>
     </div>
         <!-- other profile image code-->
         <?php 
	
	
	$url= DB::query('SELECT channelImage FROM channelsetup WHERE user_id=:userid',array(':userid'=>$userid2));
	$image="";
	
	 ?><div> 
         <img  src="<?php foreach ($url as $imageurl) {
		$image=$imageurl['channelImage'];  } echo $image ; ?>" class="img-thumbnail" style="height:130px;width:150px;margin-bottom:-30px;margin-left:10px;margin-top:30px"  alt="Nothing To show" />
      	</div>
 
<p id="subs" style="margin-top: 50px;margin-bottom: -30px;font-size:17px"> <?php echo $subscriber1 ?></p>

        <hr style="margin-top:50px">
        <div style="margin-top:30px">
    
       	<span style="margin-right: 100px"> <p  class="w3-button  w3-left w3-hover-none" style="margin-top: -60px;margin-left:-20px;font-size:20px;font-family: roboto;text-align:left">
       	<h4 style="margin-left:0px;;margin-top: -20px;font-family: Sawarabi Mincho;font-size:20px"><?php echo $authorName1?></h4>
       	</span>
       	<hr>
       
       	 	
       	<br> <span style="margin-right: 100px"> <p  class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:18px;font-family:roboto;text-align:left"><b>Author Rank</b></p>
       	<h4 style="margin-left:0px;;margin-bottom: -0px;font-family: Sawarabi Mincho;font-size:18px"><?php echo $authRank?></h4>
       	</span>
     <hr>
       	<br><center><span style="margin-right: 100px"> <p  class="w3-button  w3-left w3-hover-none" style="margin-top: -40px;margin-bottom:0px;margin-left:-20px;font-size:18px;font-family:roboto;text-align:left"><b>BIO</b></p>
       	<h4 style="margin-left:0px;;margin-bottom: -0px;font-family:Shadows Into Light ;font-size:20px"><?php echo $aboutAuthor1?></h4>
       	</span>
     </center>
     
    
        </div>
        </div>
      </div>
     </div>
       </div>
    <!-- End Left Column -->
 <!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:40%;display: none">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:40%">
<!--Loading progress bar for article loading  ends-->

  
   <!--base for articles appearing-->
 <div class="PostMainDiv" id="mainPostDiv">

        </div>
         <!--base for articles appearing ends--> 
     
      <!--  start about column Div-->
     <div id="aboutColumn" class="aboutColumn" style="display:none; margin-top:10px;position:relative">
     <div class="w3-col m7"  style=" margin-left:290px;margin-bottom:10px;width:65%;max-width:90%">

     <div class="middle-column" >

      <div class="w3-container w3-card w3-white w3-round w3-margin"  style="height: auto;max-height:100%;max-width:100%"><br>

 <div style="height: auto;min-height:270px;word-wrap:break-word">
<div class="" style="width:30%;height:50px"><h2 style="margin-top:-15px;color: pink">Profile</h2></div>
      

 <div class="well" style="width:auto;position:relative"><h2 style="margin-top:-15px;font-size: 20px">Name :</h2><p style="font-family: monospace;font-size:20px"><?php echo $fname1." ".$lname1 ?></p></div>';
        
     

  <div class="well" style="width:40%;height:300px"><img class="img-thumbnail" src="<?php echo $imageurl1?>" style="margin-left:0px;height:250px;width:100%"></div>

    <div class="well" style="width:57%;height:300px;word-wrap:break-word;margin-left:43%;margin-top:-320px;overflow:auto"><h2 style="margin-top:-15px;font-size: 20px">BIO : </h2>
    <p style="font-size: 20px;font-family:Shadows Into Light"> <?php echo $aboutAuthor1?></p></div>
    
     <div class="well" style="width:auto;height:100px"><h2 style="margin-top:-15px;font-size: 20px">contact:</h2>
      <p style="font-family: monospace;font-size:20px"><?php  echo $email1 ?></p></div>';

    
     <div class="well" style="width:49%;height:100px"><h2 style="margin-top:-15px;font-size: 20px">State: </h2><p style="font-family:monospace;font-size:20px"><?php echo $state1?></p></div>
     <div class="well" style="width:49%;height:100px;margin-left:51%;margin-top:-122px"><h2 style="margin-top:-15px;font-size: 20px">City :</h2><p style="font-family: monospace;font-size: 20px"><?php echo $city1?></p></div>
     <div class="well" style="width:40%;height:100px"><h2 style="margin-top:-15px;font-size: 20px">gender:</h2> <p style="font-family: monospace;font-size: 20px"> <?php echo $gender1?></p></div>
      <div class="well" style="width:58%;height:100px;margin-left:42%;margin-top:-120px"><h2 style="margin-top:-15px;font-size: 20px">Proffession : </h2><p style="font-family: monospace;font-size: 20px"><?php echo $proffession1?></p></div>


    <div class="well" style="width:40%;height:100px"><h2 style="margin-top:-15px;font-size: 20px">Date Of Birth</h2> <p style="font-family: monospace;font-size: 20px"><?php echo $dateOfBirth1 ?></p></div>

        <div class="well" style="width:57%;margin-left:43%;margin-top:-120px;height:100px"><h2 style="margin-top:-15px;font-size: 20px">Author Name: </h2><p style="font-family: monospace;font-size: 20px"><?php echo $authorName1 ?></p></div>
    

 <div class="well" style="width:auto;margin-top:0;height:100px"><h2 style="margin-top:-15px;font-size: 20px">Author Name: </h2><p style="font-family: monospace;font-size: 20px"><?php  echo $authorName1 ?></p></div>';

     
      <div class="well" style="width:auto;height:100px"><h2 style="margin-top:-15px;font-size: 20px">Channel  Name:</h2> <p style="font-family: monospace;font-size: 20px"><?php echo $channelName1?></p></div>
     <div class="well" style="width:auto;height:auto;word-wrap:break-word;overflow:auto"><h2 style="margin-top:-15px;font-size: 20px">Channel  Description: </h2>
      <p style="font-family:monospace;font-size: 20px"><?php echo $discription1?></p></div>

        </div>
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

//ask a ouestion ajax code
$(document).ready(function(){



});
//end of ask a question code


//notifications js ends



// code for hide menu


$(document).ready(function(){
$("#hideMenu").click(function(){
 
 $("#profile").css("position","absolute");
  $("#profile").css("z-index","10");
  $("#profile").css("min-width","30px");

          $("#profile").toggle();




});

});


// about column javascript

function about()
{
	var x=document.getElementById("mainPostDiv");
	var y =document.getElementById("aboutColumn");
	var i;
	if( y.style.display=="none"){

    	x.style.display="none";
  
y.style.display="block";
	}
	 else if( y.style.display=="block")
    {

    	y.style.display="none";
      x.style.display="block";
    	
   

    }

}





function stats(){

  window.location.href = "otherStats.php?q=<?php echo $userid2 ?>";

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
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
// header image javasript end
// Accordion

function myFunction() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) {  
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function myFunction() {
    var x = document.getElementById("Demo");
    if (x.className.indexOf("w3-show") == -1) {  
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else { 
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className = 
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else { 
        x.className = x.className.replace(" w3-show", "");
    }
}

$(function(){
$('#myModal16').modal({
   show:true,
   backdrop:'static'
});
 //now on button click
  $('#myModal16').modal('show');
});
</script>

</body>
</html> 




			