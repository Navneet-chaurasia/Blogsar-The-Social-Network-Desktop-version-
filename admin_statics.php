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

<!DOCTYPE html>
<html>
<title>Admin blogsar statistics</title>
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
  $(document).ready(function(){
  $("#runningc").click(function(){
    $("#createcontest").hide();
    $("#sendemail").hide();
    $("#runningcontest").show();
     $("#authorStatistics").hide();
       $("#Participants").click(function(){
         $("#arti").hide();
         $("#win").hide();
         $("#Parti").show();
    });
    $("#Articles").click(function(){
         $("#win").hide();
         $("#Parti").hide();
         $("#arti").show();
    });
    $("#Winners").click(function(){
         $("#arti").hide();
         
         $("#Parti").hide();
         $("#win").show();
    });

    });
  

  $("#contest").click(function(){
    $("#runningcontest").hide();
    $("#sendemail").hide();
    $("#createcontest").show();
  });

    $("#authorStat").click(function(){
    $("#runningcontest").hide();
    $("#sendemail").hide();
    $("#createcontest").hide();
    $("#authorStatistics").show();
  });

   $("#Email").click(function(){

     $("#runningcontest").hide();
     $("#createcontest").hide();
     $("#sendemail").show();
      $("#authorStatistics").hide();
   });

  });
</script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
img {
    width: 100%;
    height: auto;
}
input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-top: 6px;
  margin-bottom: 16px;
  resize: vertical;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>

<body style="background-color: lightgray">

<!-- Navbar -->
<!-- Navbar -->
<div class="w3-top"  >
  
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">


<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px"><img src="images/blogsar_logo_black.png" style="width:20px;height:22px">logsar Stats</h4></span>
<span style="position: absolute;right:20px"><h4 id = "totlaUsers" style="font-family:Baloo Bhai;color:blue;font-size: 20px;">users : <?php echo $usersCount;?></h4></span>

    <a href="admin_home_page.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:30%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="admin_profile.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>


  
         
  
 


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
<div class="w3-container w3-content" style="max-width:1400px;margin-top:60px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-theme-light-grey w3-margin">
        <div class="w3-container" style="background-color:rgb(240, 240, 240)">
         <h2 class="w3-center" style="font-family:Comic Sans MS">Blogsar Statics</h2>
        </div>
      </div>
      
      
      <!-- Accordion -->
      <div class="w3-card w3-round w3-margin">
        <div class="w3-#" style="background-color:rgb(240, 240, 240)">
       <ul> 
       <br>   
       <li> <button class="btn btn-md btn-primary" id="contest">Total stats of blogsar</button></li><br>
       <li><button class="btn btn-md btn-primary"  id="runningc">Monthly Report</button></li><br>
       <li><button class="btn btn-md btn-primary"  id="Email">Statics of Articles</button></li><br>
        <li><button class="btn btn-md btn-primary"  id="authorStat">Statics of Authors</button></li><br>
      </ul>      
         
        </div>      
      </div>

      

    </div>
    <div id="createcontest" class="w3-col m7" style="display:block;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">All Stats of blogsar </font></h2></center>
        <hr class="w3-clear">
        <p style="font-size: 17px;font-family:Comic Sans MS ">1).  Total <?php echo $usersCount?> registered users in blogsar. </p>
        <?php 
  //getting total article
$totalArticle = DB::query('SELECT id FROM post',array());
$totalArticleCounts = count($totalArticle);


//getting total female authors
  $totalFemaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Female"',array());
$totalFemaleAuthorsCount = count( $totalFemaleAuthors);

//getting total male authors
$totalMaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Male"',array());
$totalMaleAuthorsCount = count( $totalMaleAuthors);
      echo'
  <p style="font-size: 17px;font-family:Comic Sans MS ">3).  Total '; echo $totalArticleCounts .' Articles are currently being read in blogsar. </p>
  <p style="font-size: 17px;font-family:Comic Sans MS ">3).  Total '; echo $totalFemaleAuthorsCount .' Total Female users are registered in blogsar. </p>
  <p style="font-size: 17px;font-family:Comic Sans MS ">4).  Total '; echo $totalMaleAuthorsCount.' Male Users are registered in blogsar. </p>';

         ?>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>




    <div id="sendemail" class="w3-col m7" style="display:none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Articles Statics</font></h2></center>
        <hr class="w3-clear">
         <?php 
  //getting total article
$totalArticle = DB::query('SELECT id FROM post',array());
$totalArticleCounts = count($totalArticle);

//getting total likes
$totalSumOfLikes = 0;
$totalLikes = DB::query('SELECT likes FROM post' ,array());
        foreach ($totalLikes as $data) {

         $d1 =  $data['likes'];
         $totalSumOfLikes = $totalSumOfLikes+$d1;

        }

        //getting total Views

$totalSumOfViews = 0;
$totalViews = DB::query('SELECT views FROM post' ,array());

        foreach ($totalViews as $data) {
           
         $d1 =  $data['views'];
        $totalSumOfViews = $totalSumOfViews + $d1;
                 
        }

//getting total female authors
  $totalFemaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Female"',array());
$totalFemaleAuthorsCount = count( $totalFemaleAuthors);

//getting total male authors
$totalMaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Male"',array());
$totalMaleAuthorsCount = count( $totalMaleAuthors);
      echo'
  
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue">3).  Total '; echo$totalArticleCounts.' Articles are currently being read in blogsar. </p>
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue">3).  Total '; echo  $totalSumOfLikes .' Likes in Articles in blogsar. </p>
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue">3).  Total '; echo  $totalSumOfViews.' Views in Articles in blogsar. </p> <hr><p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Top 5 Articles having higest Article Strength.</p><hr>';

//Article having highest article strength
$articleHighStrength = DB::query('SELECT id,title,postRank FROM post ORDER BY postRank DESC LIMIT 5',array());

  foreach ($articleHighStrength as $key) {

    $id = $key['id'];
    $postRank = $key['postRank'];
    $title = $key['title'];

    echo'<p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_ReadForReview.php?q='.$id.'" target="_blank">'.$title .'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$postRank.'</p><hr>';
   
  }
  echo'<p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Top 5 Articles having higest Views Strength.</p><hr>';


//Article having highest Views
$articleHighStrength = DB::query('SELECT id,title,views FROM post ORDER BY views DESC LIMIT 5',array());

  foreach ($articleHighStrength as $key) {

    $id = $key['id'];
    $views = $key['views'];
    $title = $key['title'];

    echo'<p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_ReadForReview.php?q='.$id.'" target="_blank">'.$title .'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$views.'</p><hr>';
   
  }

  echo'<p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Top 5 Articles having higest Likes Strength.</p><hr>';

  //Article having highest likes
$articleHighStrength = DB::query('SELECT id,title,likes FROM post ORDER BY likes DESC LIMIT 5',array());

  foreach ($articleHighStrength as $key) {

    $id = $key['id'];
    $likes = $key['likes'];
    $title = $key['title'];

    echo'<p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_ReadForReview.php?q='.$id.'" target="_blank">'.$title .'</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$likes.'</p><hr>';
   
  }

         ?>
        
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>


<!--author stats div-->
<div id="authorStatistics" class="w3-col m7" style="display:none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Author Statistics</font></h2></center>
        <hr class="w3-clear">
         <?php 

 //author having highest author rank
$authorHighAuthorRank = DB::query('SELECT user_id FROM user_details ORDER BY authorRank DESC LIMIT 1',array())[0]['user_id'];
$publicationHighAuthorRank = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$authorHighAuthorRank))[0]['channelName'];

//author having highest subscribers

$authorHighSubscribers = DB::query('SELECT user_id FROM user_details ORDER BY subscribers DESC LIMIT 1',array())[0]['user_id'];
$publicationHighSubscribers = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$authorHighSubscribers))[0]['channelName'];

//author having highest articles published
$authorHighNoArticles = DB::query('SELECT user_id FROM user_details ORDER BY noOfPosts DESC LIMIT 1',array())[0]['user_id'];
$publicationHighNoArticles = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$authorHighNoArticles))[0]['channelName'];


  //getting total article
$totalArticle = DB::query('SELECT id FROM post',array());
$totalArticleCounts = count($totalArticle);

//getting total likes
$totalSumOfLikes = 0;
$totalLikes = DB::query('SELECT likes FROM post' ,array());
        foreach ($totalLikes as $data) {

         $d1 =  $data['likes'];
         $totalSumOfLikes = $totalSumOfLikes+$d1;

        }

        //getting total Views

$totalSumOfViews = 0;
$totalViews = DB::query('SELECT views FROM post' ,array());

        foreach ($totalViews as $data) {
           
         $d1 =  $data['views'];
        $totalSumOfViews = $totalSumOfViews + $d1;
                 
        }

//getting total female authors
  $totalFemaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Female"',array());
$totalFemaleAuthorsCount = count( $totalFemaleAuthors);

//getting total male authors
$totalMaleAuthors = DB::query('SELECT id FROM signup WHERE gender="Male"',array());
$totalMaleAuthorsCount = count( $totalMaleAuthors);
      echo'
  <p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Publication with highest Author Strength.</p>
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_profileVisit.php?q='.$authorHighAuthorRank.'" target="_blank">'.$publicationHighAuthorRank.'</a></p>
  <p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Publication with highest Subscribers.</p>
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_profileVisit.php?q='.$authorHighSubscribers.'" target="_blank">'.$publicationHighSubscribers .'</a></p>
    <p style="font-size: 23px;font-family:Comic Sans MS ;color:black">Publication with highest Articles.</p>
  <p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_profileVisit.php?q='.$authorHighNoArticles.'" target="_blank">'.$publicationHighNoArticles .'</a><p style="font-size: 23px;font-family:Comic Sans MS ;color:black">All authors registered in blogsar.</p></p>
  ';   ?>

  <?php

$allAuthors = DB::query('SELECT id FROM signup',array());

    foreach ($allAuthors as $k) {
      $id = $k['id'];

      $authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$id))[0]['authorName'];

      $authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id=:id',array(':id'=>$id))[0]['authorRank'];

      echo'<p style="font-size: 20px;font-family:Comic Sans MS ;color:blue;margin-left:20px"><a href="admin_profileVisit.php?q='.$id.'" target="_blank">'.$authorName .'</a>&nbsp;&nbsp;&nbsp;&nbsp;'.$authorStrength.'</p><hr>';

    }

  ?>
        
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>


    <div id="runningcontest" class="w3-col m7" style="display: none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Monthly Report </font></h2></center>
        <hr class="w3-clear">
       <center><button style="margin-left:-60px" id="Participants">Number of Signed up</button>
       <button style="margin-left: 30px" id="Articles">Numbers of Articles Shared</button>
       <button style="margin-left: 40px" id="Winners">Graphical Statics</button></center>
       <hr>
        <p>
         
<div  id="Parti" style="display:block;">
<div>
 <p>1. author_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>2. author_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>3. author_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>4. author_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>5. author_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>

</div>

  <div  id="arti" style="display:none;">
<div>
 <p>1. artical_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>2. artical_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>3. artical_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>4. artical_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>5. artical_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
</div>

<div  id="win" style="display:none;">
<div>
 <p>1. Winner_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>2. Winner_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>3. Winner_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>4. Winner_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
<div >
 <p>5. Winner_name &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;author_strength&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;subscribers </p>
</div>
</div>
        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            <div class="w3-half">
             
            </div>
            <div class="w3-half">
          </div>
        </div>
        
      </div>
      
    <!-- End Middle Column -->
    </div>

    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>


</body>
</html> 
