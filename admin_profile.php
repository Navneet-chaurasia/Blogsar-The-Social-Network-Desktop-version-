
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
      //getting profile image of admin
$profileImage = DB::query('SELECT profileImage FROM  `admin_signup` WHERE id=:userid',array(':userid'=>$userid5))[0]['profileImage'];

//total number of article reviewed
$reviewedArticles = DB::query('SELECT admin_id FROM reviewedarticles WHERE admin_id = :id',array(':id'=>$userid5));

$reviewedArticlesCount= count($reviewedArticles);

//total number of removed articles
$removedArticles = DB::query('SELECT admin_id FROM removearticle WHERE admin_id = :id',array(':id'=>$userid5));

$removedArticlesCount= count($removedArticles);

//getting email
$email=DB::query('SELECT email FROM  `admin_signup` WHERE id=:userid',array(':userid'=>$userid5))[0]['email'];
  

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-Admin Profile</title>
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
<script>
  $(document).ready(function(){

 $("#yourStatsButton").click(function(){

    $("#yourStats").show();
  $("#adminsData").hide();
  $("#yourRemovedArticles").hide();

 })

 $("#adminsDataButton").click(function(){

    $("#yourStats").hide();
  $("#adminsData").show();
   $("#yourRemovedArticles").hide();

 })

  $("#yourRemovedArticlesButton").click(function(){

    $("#yourStats").hide();
  $("#adminsData").hide();

   $("#yourRemovedArticles").show();

 })


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
</head>
<body style="background-color: lightgray">

<!-- Navbar -->
<!-- Navbar -->
<div class="w3-top"  >
  
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:45px;max-height: 100%">


<span style="position: absolute;"><h4 style="font-family: Ruslan Display;color: black;font-size: 25px;margin-left:65px"><img src="images/blogsar_logo_black.png" style="width:20px;height:22px">logsar Admin</h4></span>
<span style="position: absolute;right:20px"><h4 id = "totlaUsers" style="font-family:Baloo Bhai;color:blue;font-size: 20px;">users : <?php echo $usersCount;?></h4></span>
    <a href="admin_home_page.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:30%"><i class="fa fa-home " style="font-size: 30px"></i></a>

  <a href="admin_profile.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>


  
 
 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->
               
 
         
  
 


<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">
      <a href="privacy_rules.php" class="w3-bar-item w3-button" style="font-size: 17px">Privacy</a>
      
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
<!--Page Container-->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:60px">    
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-theme-light-grey w3-margin">
        <div class="w3-container" style="background-color:rgb(240, 240, 240)">
         <h2 class="w3-center" style="font-family:Comic Sans MS">Admin-<?php echo $username?></h2>
        </div>
      </div>
      
      
      <!-- Accordion -->
      <div class="w3-card w3-round w3-margin">
        <div class="w3-#" style="background-color:rgb(240, 240, 240)">
       <ul style="font-family: Comic Sans MS;font-size: 17px"> 
        
          
    
<input type="file" name="fileToUpload2" id="fileToUpload2" class="hidden inputfile" onchange="readURL2(this);"  accept="image/*"/>

<img id="blah2"  src=" <?php echo $profileImage?>" class="img-thumbnail"  style="height:250px;width:250px;margin-top:10px;margin-left: -15px" alt="Set an image,  it's necessary :)">
  <label for="fileToUpload2" class="btn btn-primary" style="margin-top: 4px">Choose image</label>

    <hr>
       <li>Admin id : <?php echo $userid5 ?></li><br>
       <li><?php echo $email?></li><br>
       <li>Working Sector : Management</li><br>
      </ul>      
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           
         </div>
          </div>
        </div>      
      </div>

      

    </div>
    <!--Your Stats display div-->
    <div id="yourStats" class="w3-col m7" style="display:block;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Your stats</font></h2></center>
        <hr class="w3-clear">
        <p>
         


        </p>
          <div class="w3-row-padding" style="margin:0 -16px">
            
           <p style="font-family: Comic Sans MS;font-size: 19px;margin-left:50px;padding:10px">You have reviewed &nbsp; <?php echo $reviewedArticlesCount ?> &nbsp;  Articles.</p>
<hr>
           <p style="font-family: Comic Sans MS;font-size: 19px;margin-left:50px;padding:10px">You have deleted &nbsp; <?php echo $removedArticlesCount ?> &nbsp;  Articles.</p>
        </div>



        
      </div>
      
    <!-- End Middle Column -->
    </div>


<!--div for showing removed articles-->
 <!--Your Stats display div-->
    <div id="yourRemovedArticles" class="w3-col m7" style="display:none;">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Removed Articles By You</font></h2></center>
        <hr class="w3-clear">
        <p>
         


        </p>
          <div class="w3-row-padding" style="margin:0 -16px">

            <?php
           
  $yourRemovedArticles= DB::query('SELECT title ,article_id FROM removearticle WHERE admin_id=:id',array(':id'=>$userid5));
         $f = 0;
         foreach ($yourRemovedArticles as $key) {
           $f++;
$title = $key['title'];
$article_id = $key['article_id'];

echo'<p style="font-family: Comic Sans MS;font-size: 19px;margin-left:10px;;padding:10px">'.$f.'). <a href="admin_read.php?q='.$article_id.'" target="_blank">'.$title.'</a>&nbsp;&nbsp;&nbsp;<button id=restoreArticle'.$article_id.'
" class="btn btn-sm btn-info">restore</button></p>

<script>
//Restoring Articles script
$(document).ready(function(){

$("#restoreArticle'.$article_id.'").click(function(){

var articleId ='; echo $article_id.'

var dataString = "restoreArticle="+articleId;
var x = confirm("Do you really want to restore this article");
if(x == true){
 
  

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString,
  success:function(data){


    alert(data);
    
  }
  });

}

});
});</script>
';
         }
            ?>
         
        </div>



        
      </div>
      
    <!-- End Middle Column -->
    </div>


<!--Admin data of others display div-->
    <div id="adminsData" class="w3-col m7" style="display:none">
      <div class="w3-container w3-card w3-round w3-margin" style ="background-color:white">
        <center><h2 style="font-family:Comic Sans MS"><font color="blue">Admins</font></h2></center>
        <hr class="w3-clear">
        <p>
         


        </p>
          <div class="w3-row-padding" style="margin:0 -16px">

            <?php  

            $totalAdmins = DB::query('SELECT * FROM admin_signup',array());
$f = 0;
            foreach ($totalAdmins as $key) {
            $f++;
            $adminName = $key['Name'];
            
            $id = $key['id'];
$loginStatus = "";
          if(DB::query('SELECT admin_id FROM admin_login_cookie_token WHERE admin_id = :id',array(':id'=>$id))){

            $loginStatus = "Logged In";
          }else{

            $loginStatus = "Logged out";
          }

          //total number of article reviewed
$reviewedArticles = DB::query('SELECT admin_id FROM reviewedarticles WHERE admin_id = :id',array(':id'=>$id));

$reviewedArticle= count($reviewedArticles);

//total number of removed articles
$removedArticles = DB::query('SELECT admin_id FROM removearticle WHERE admin_id = :id',array(':id'=>$id));

$deletedArticle= count($removedArticles);

            
            
echo '
<div id="stats'.$id.'" class="modal fade" role="dialog"><div class="modal-dialog modal-md"> <div class="modal-content"> <div class="modal-header"><p style="font-size: 20px;margin-top: -10px">Statistics About this Article</p> </div><div class="modal-body"><p style="font-family:Merriweather;font-family:15px">Admin has reviewed '.$reviewedArticle.' articles</p><p style="font-family:Merriweather;font-family:15px">Admin has deleted '.$deletedArticle.' articles</p></div><div class="modal-footer"> <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button></div></div></div></div><p style="font-family: Comic Sans MS;font-size: 19px;margin-left:1s0px;padding:10px">'.$f.').'.$adminName.'&nbsp; &nbsp;&nbsp; &nbsp;'.$loginStatus.'&nbsp; &nbsp;&nbsp; &nbsp;<button data-toggle="modal"  class="btn btn-md btn-info" data-target="#stats'.$id.'">stats</button>';if($userid5 == 1 && $id !=1){echo '<script>
//Deleteing admin
$(document).ready(function(){

$("#delete'.$id.'").click(function(){

var adminId ='; echo $id.'
var dataString = "removeAdmin="+adminId;
var x = confirm("Do you really want to remove this admin");
if(x==true){
 
  

$.ajax({
  type:"POST",
  url:"forhandlingAjaxAdmin.php",
  cache:false,
  global:false,
  data:dataString,
  success:function(data){


    alert(data);
    
  }
  });

}

});
});

</script>&nbsp; &nbsp;&nbsp; &nbsp;<button class="btn btn-md btn-danger"  id="delete'.$id.'">Remove Admin</button>';}'</p>';


         }
?>
        </div>



        
      </div>

    </div>



<!--right side buttons div-->
    <div class="w3-col m2">
      
      
      
      <!-- Accordion -->
      <div class="w3-card w3-round w3-margin" style="position: absolute;right: 0;width:15%">
        <div class="w3-#" style="background-color:rgb(240, 240, 240)">
       <ul style="font-family: Comic Sans MS;font-size: 17px"> 
        
<button id = "yourStatsButton" class="  btn-primary btn-lg" style="width:100%;position: relative;right:25px;margin:10px">Your Stats</button>
     <button id = "adminsDataButton" class="  btn-primary btn-lg" style="width:100%;position: relative;right:25px;margin:10px">Admins</button> 
    <button  id = "yourRemovedArticlesButton" class="  btn-primary btn-lg" style="width:100%;position: relative;right:25px;margin:10px">Removed Articles</button> 
       <button class="  btn-primary btn-lg" style="width:100%;position: relative;right:25px;margin:10px">Admins</button> 
      <button class="  btn-primary btn-lg" style="width:100%;position: relative;right:25px;margin:10px">Admins</button>  

      </ul>      
          <div id="Demo3" class="w3-hide w3-container">
         <div class="w3-row-padding">
         <br>
           
         </div>
          </div>
        </div>      
      </div>

      


    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<script>
  //admin image uploading code
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
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
  
  
 form_data.append("fileToUpload2", document.getElementById('fileToUpload2').files[0]);
   $.ajax({
    url: "forhandlingAjaxAdmin.php",
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


  })


 //admin photo priview
    function readURL2(input){
    
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah2')
        .attr("src", e.target.result)
        .width(200)
        .height(200);
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
</body>
</html> 
