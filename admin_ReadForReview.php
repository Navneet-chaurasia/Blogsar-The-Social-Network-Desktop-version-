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
  if(!empty($_GET['q'])){

  $data = test_input($_GET['q']);

 if(DB::query('SELECT id FROM post WHERE id=:postid', array(':postid'=>$_GET['q'])))

            {

       

            }
            else{
              die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">Article not found</p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="admin_home_page.php">Go back..</a></div>');
            }

          }else{

  die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">Article not found </p>
  <p style="font-size:20px">Try another word in search</p>
  <a href="admin_home_page.php">Go back..</a></div>');
}
  
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
<title>Blogsar-Admin Home</title>
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


img{
    max-width:700px;
}

#hideMenu:hover{
  color:blue;
}

#set:hover{
  color: grey;
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

 $(document).ready(function(){

  $(document).ajaxStart(function(){

      $("#loadingImage1").css("display","block");
  });


  $(document).ajaxComplete(function(){

      $("#loadingImage1").css("display","none");
  });

//code for initial 5 articles
var val = <?php echo $data?>;
var f = -1;
    var dataString = "admin_ReadForReview=" + val ;
  
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

$(".PostMainDiv").html() + '<div class="mainPostDiv" mainDiv-id='+data[0][i].id+'  style="display:block; margin-left:23%;min-width:700px;position:relative;"> <div class="w3-col m7" style="margin-bottom:10px;margin-top:5px;width:850px;max-width:100%"><div class="middle-column"> <div class="w3-container w3-card w3-white w3-round w3-margin" style="height: auto;max-height:100%;max-width:850px"><br><div class="panel panel-primary" style="height:60px;width:103%;margin-top:-16px;margin-bottom:-0px;margin-left:-13px" ><div class="panel-heading" style="height:60px;width:100%"><div style="width:700px;height:56px;margin-bottom:-40px;margin-top:5px;margin-left:-14px;position:absolute"><p  style="margin-bottom:-50px;margin-left:100px;font-family:Acme;font-size:25px">Article For Review </p> </div></div></div>     <div style="height: auto;min-height:270px;word-wrap:break-word"> <div myDiv-id='+data[0][i].id+' style="display:none"><h2 style="font-family:Merriweather;font-size:24px">'+data[0][i].title+'</h2> <hr><div style="font-family:Merriweather;font-size:16px">'+data[0][i].body+'</div></div><div Div-id='+data[0][i].id+' style="display:block"><div class="title" id="title" style="margin-left:300px;word-wrap:break-word;height:40px;overflow:hide;position:relative" ><b><h1 style="font-family:Merriweather;font-size:22px;position:relative">'+data[0][i].title+'</h1></b></div><hr style="width:600px;float:right;margin-right:0px;top:20px;position:relative"><div class="description" style="margin-left:300px;word-wrap:break-word;height:200px;overflow:auto;margin-bottom:-60px;position:relative;top:10px"><p style="font-size:16px;font-family:Merriweather">'+data[0][i].description+'</p></div><div  class="w3-right" style="width:340px;margin-top:-237px;height:320px;margin-right:600px;position:absolute"><img src ="'+data[0][i].titleImage+'"  class="img-thumbnail"  style="height:320px;width:270px;position:absolute;margin-left:-10px" alt="title image"></div> </div> </div> <hr style="margin-top:82px"> <div style="margin-top:100px"> <div class="" style="position:relative;top:-90px;max-width:100%;left:135px;margin-bottom:-70px"><button class="btn btn-primary btn-sm" read-id='+data[0][i].id+' style="width:90px;font-family:Bree Serif;font-size:15px;margin-left:15px">Read</button></div>' )


/

 
// for read buuton on article
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


      
 
 $("html,body").animate({ scrollTop: "-="+currentHeight },0); 



    }

   else if (y.style.display=="block" && x.style.display=="none"){
   z.innerHTML = "Reading";
        z.style.backgroundColor="#787878";
       
     y.style.display="none";
     x.style.display="block";

   } 
 
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


<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px"><img src="images/blogsar_logo_black.png" style="width:20px;height:22px">logsar Admin</h4></span>
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
<a href="admin_manageContest" class="btn btn-info btn-lg btn-danger" id="contest" style="width:90%;margin-bottom:2px;font-size: 20px" title="participate in contest">Contest</a>

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