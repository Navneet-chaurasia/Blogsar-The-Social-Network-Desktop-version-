<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}

?>

<?php


$topics="";
	
	// seperate code for uploading images as well


$url="";

// Allowed origins to upload images


// Images upload path
$imageFolder = "titleImage/";
$postFolder = "post/";

reset($_FILES);
$temp = current($_FILES);
if(is_uploaded_file($temp['tmp_name'])){
    
    
  
    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $imageFolder . $temp['name'];
    move_uploaded_file($temp['tmp_name'], $filetowrite);
	$url=$filetowrite = $imageFolder . $temp['name'];
 
   
} 
	
		function test_input($data){

  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;

}
	
	
$userid=Login::isLoggedIn();
if(isset($_POST['uploadSubmit']))

{

	$editor=$_POST['editor'];
	$title=test_input($_POST['title']);
	$keywords=test_input($_POST['keywords']);
	$description=test_input($_POST['description']);

if(!empty($_POST['topic']) && !empty($_POST['editor']) && !empty($_POST['title']) && !empty($_POST['keywords']) && 
    !empty($_POST['description'])) {

		foreach($_POST['topic'] as $selected) {

$topics.=$selected." ";

}

	$loggedInUserId=Login::isLoggedIn();
	 date_default_timezone_set('Asia/Kolkata');
       $time = date("Y-m-d H:i:s");
       $time2 = date("Y-m-d H:i");

DB::query('INSERT INTO post VALUES (\'\',:editor, :title,:des,:topics,:keywords,:imageurl,:time,:userid,0,0,0,"NO","NO",0)',array(':editor'=>$editor,':title'=>$title,':des'=>$description,':imageurl'=>$url,
	':userid'=>$userid, ':topics'=>$topics,':keywords'=>$keywords,':time'=>$time));

 
      
     
if( DB::query('SELECT id FROM post WHERE user_id = :userid AND posted_at LIKE :t',array(':userid'=>$loggedInUserId,':t'=>'%'.$time.'%'))){
       DB::query('UPDATE user_details set noOfPosts = noOfPosts + 1 WHERE user_id = :userid',array(':userid'=>$loggedInUserId));
       
  $current_id = DB::query('SELECT id FROM post WHERE user_id = :userid AND posted_at LIKE :t',array(':userid'=>$loggedInUserId,':t'=>'%'.$time.'%'))[0]['id'];
       // insert notifications that author has published a new article

 $followers =   DB::query('SELECT follower_id FROM followers WHERE user_id = :id',array(':id'=>$userid));

       foreach ($followers as $key) {

        $follower = $key['follower_id'];


DB::query('INSERT INTO notifications VALUES(\'\',:sender,:reciever,:imp_id,7,:time,"NO")',array(':sender'=>$userid,':reciever'=>$follower,':imp_id'=>$current_id,':time'=>$time));


       }
       
}
      
   header("location:personal wall.php");
 }else{
   die("DO not alter the source code !");
   return false;

 }
 
}
?>


<!DOCTYPE html>
<html>
    <head>
    	<title>Blogsar-editor</title>
       <link rel="shortcut icon"  type="image/x-icon" href="images/favicon (1).ico" />
    	<!-- Tinymce js src file-->
    	 <script src="tinymce\js\tinymce\tinymce.min.js"></script> 	
    	  <script src="tinymce\js\tinymce\jquery.tinymce.min.js"></script> 	
    	 <!-- image upload script-->
    	 <meta charset="UTF-8">
    	 <!-- w3-school stylesheet links-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">




<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link class="jsbin" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans|Old+Standard+TT|Playfair+Display|Sanchez|Merriweather|Playfair+Display+SC|Lobster|
Metamorphous|Roboto|Bree+Serif|Acme|Raleway|Baloo+Bhai|Arvo|Kosugi|Ruslan+Display|Shadows+Into+Light|Anton|Sawarabi+Mincho|Fredoka+One" rel="stylesheet">

<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-light-blue.css">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script
  src="https://code.jquery.com/jquery-1.8.0.js"
  integrity="sha256-00Fh8tkPAe+EmVaHFpD+HovxWk7b97qwqVi7nLvjdgs="
  crossorigin="anonymous"></script>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
	// image preview
	function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e){
      $('#blah')
        .attr('src', e.target.result)
        .width(270)
        .height(310);
    };

    reader.readAsDataURL(input.files[0]);

  }
}
</script>
<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/postEditor.php";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/postEditor.php");
}
-->
</script>
<style>
.inputfile{

	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	
}

#description{
		background:skyblue;
		width:auto;
		height:10px;
		float:right;
		margin-top:-530px;
		margin-right:60px;
	}
</style>
</head>
 <body class="w3-theme-light-blue"> 
<script>
tinymce.init({
	selector: 'textarea',// change this value according to your HTML
  selector: '#ckeditor',
 
 width:"75%",
 height : "900px",
 
  statusbar: true,
   theme: "modern",
   skin: 'lightgray',
    mode : "specific_textareas",
    object_resizing : ":not(table)",
    'object_resizing' : false,
      image_dimensions: false,
      resize:false,
      table_responsive_width: true,

      
     
        editor_selector : "my_tinymce",
  content_style: ".mce-content-body {font-size:20px;font-family:Merriweather;}.mce-content-body img{max-width:750px;}",
   plugins: [
      'advlist autolink lists link  charmap print  hr image',
      
      
      
      'searchreplace wordcount  autosave textcolor colorpicker',
      'insertdatetime   contextmenu directionality ',
      'emoticons  paste  textpattern  ,autoresize',
   
      'advlist'
    ],
    image_class_list: [
    {title: 'Responsive', value: 'tinyImg'}
],
    // auto save..
    autosave_ask_before_unload: false,
    autosave_prefix: "tinymce-autosave-{path}{query}-{id}-",
    autosave_restore_when_empty: true,
    // auto resizing..
   autoresize_min_height: 470,
   autoresize_max_height: 470,
   
   
    

   
 toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link ',
    toolbar2: 'forecolor emoticons| restoredraft|forecolor backcolor',

 images_upload_url: 'postImageupload.php',
 
  images_upload_credentials: false,
 automatic_uploads:false,
  images_upload_handler: function (blobInfo, success, failure) {
  var xhr, formData;

  xhr = new XMLHttpRequest();
  xhr.withCredentials = false;
  xhr.open('POST', 'postImageupload.php');

  xhr.onload = function() {
    var json;

    if (xhr.status < 200 || xhr.status >= 300) {
    failure('HTTP Error: ' + xhr.status);
    return;
    }

    json = JSON.parse(xhr.responseText);

    if (!json || typeof json.location != 'string') {
    failure('Invalid JSON: ' + xhr.responseText);
    return;
    }

    success(json.location);
  };

  formData = new FormData();
  formData.append('file', blobInfo.blob(), blobInfo.filename());

  xhr.send(formData);
  },
 
   /*  
    image_advtab: false,
  // enable title field in the Image dialog
  image_title: false, 
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // add custom filepicker only to Image dialog
  file_picker_types: 'image',
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {

      var file = this.files[0];
      var reader = new FileReader();
      reader.readAsDataURL(file);
      //new code added for prevent large images to be eneter
  var fsize = file.size||file.fileSize;

 
    if(fsize > 1000000) 
  {

  alert("Image File Size is very big");
  return false;
}else{

reader.onload = function(e){

  var img = new Image();


img.src = e.target.result;

var width ;
var height;
img.onload = function(){

   height  = this.height;
   width = this.width;

if(height >700 || width>700){

  alert("image is very big");
  return false;
}else{

        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        
        cb(blobInfo.blobUri(), { title: file.name });

    }
    }};
        }
      
      reader.readAsDataURL(file);
    };
    
    input.click();
  }
*/

        
});

        

</script>
  	
  	<!-- main page div start-->
   	<div class="w3-top"  style="position:relative;margin-top: 0px">
	<!--- 2nd main div-->
	
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large" style="height:50px">
<span style="position: absolute;"><h4 style="font-family:Fredoka One;color:black;font-size: 25px;margin-left:65px">Blogsar</h4></span>
 	 

    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Home"  style="margin-left:25%"><i class="fa fa-home fa-2x"></i></a>
    

  <a href="personal wall.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user fa-2x"></i></a>
  
  <a href="postEditor.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>


<div class="w3-dropdown-hover w3-hide-small">
  
   <div class="w3-dropdown-content w3-card-4 w3-bar-block" style="width:180px;margin-top: 45px">
      <a href="privacy_rules.php" class="w3-bar-item w3-button" style="font-size: 17px">Privacy</a>
     
      <form action="logout.php" method="post">
      <input type="submit" name="confirm" value="Logout" class="w3-bar-item w3-button" style="font-size: 17px">
      </form>
           <a href="block_list.php" class="w3-bar-item w3-button" style="font-size: 17px">blocked</a>
               
                <a  class="w3-bar-item w3-button" style="font-size: 17px;color: blue" data-toggle="modal" data-target="#about_postEditor">about this page</a>

                        </div>
<button class="w3-button w3-padding-large  w3-hover-none" title="Settings" ><i class="fa fa-cog fa-2x" ></i></button>
  </div>


  </div>
  
 </div>
 <!-- modal window-->

  
<!--modal window for describing home page-->
<div id="about_postEditor" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
 <p style="font-size: 20px;margin-top: -10px">About Article Editor</p>

      </div>
       <div class="modal-body">
  
<p style="font-size: 16px;font-family: Roboto">This page is called <b>Article Editor. </b> You will write your article here.<br><b></b>
  <ul style="font-size: 16px;font-family: Roboto">
  <li>In editor you will write your article .

<ul style="font-size: 16px;font-family: Roboto">
  <li>
 Article should be at least 200  characters long.
</li>
<li>
 You can add links and different formatting on your article.
<li>
You can not insert image directly from your computer but you can copy and paste image from other sites.
</ul>
  </li>
 
<li>At top right corner there is <b>add description</b> button.
<ul style="font-size: 16px;font-family: Roboto">
  <li>By clicking <b>add description</b> button a modal window will open where you will fill description about your article.</li>
  <li>First you will write title of your article</li>
  <li>upload a title image , it will be shown in your article as a title image and can affect your article's performance so choose it wisely.</li>
  <li>write a brief description about article . this description will be shown in front of your article so write description carefully.</li>
  <li>Enter keywords related to your article.These keywords will boost your article'a performance.</li>
  <li>Choose a right topic for your article that is best describing for your article.</li>
    <li>At the end publish your article.</li>




</ul>
  </li>
     

</ul>
</p>

       </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>
  </div>
</div> 
  

<form action="postEditor.php" method="post" enctype="multipart/form-data" id="pub_article">
<p class="btn " data-toggle="modal" data-target="#myModal1" style="float:right;position:relative;top:-40px;z-index: 5646;font-family: baloo bhai;font-size: 25px;color:black" id="decription">Publish</p>

<!-- Modal -->
<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="font-family: lobster;font-size: 30px">Article Description</h4>
      </div>
      <div class="modal-body">
      
  <div class="form-group">
    <label for="title" style="font-family: lobster;font-size: 30px">Title</label>
    <input type="text" class="form-control" name= "title" id="text" maxlength="90" required autocomplete="off">

    <p style="color:red" id="warningtitle"></p>
  </div>
  <div class="form-group">
  	<label for = "iamge" style="font-family: lobster;font-size: 30px">Title Image</label>
  	 
  <input type='file' name="fileToUpload" id="fileToUpload" class="inputfile" onchange="readURL(this);" required accept="image/*"/>
  <label for="fileToUpload" class="btn btn-primary">Choose image</label>
<center><img id="blah" class="img-thumbnail"  alt="Set an Image, it's necessary :)"/ style=""></center>
</div>
       <div class="form-group">
  <label for="comment" style="float:bottom;position: relative;font-family: lobster;font-size: 30px">Description</label>
  <textarea class="form-control" rows="5" id="comment" name="description" style="margin-top:10px;resize: vertical;min-height: 50px" maxlength="1500" placeholder="Put your post's short description" required></textarea>
</div>
<div class="form-group">

 <label for="keywords" style="float:bottom;position: relative;font-family: lobster;font-size: 30px">Keywords</label>
  <textarea class="form-control" rows="5" id="keywords" name="keywords" style="margin-top:10px;resize: vertical;height: 50px;min-height: 50px;max-height: 80px;" maxlength="100" placeholder="Enter keyword seperated by spaces" required></textarea>
</div>
<div class="form-group">
 
<div class="btn-group">
<p style="color: red;display: none" id="topic_warning">choose topic</p>
<button  class="btn btn-primary btn-md dropdown-togg"  data-toggle="dropdown" style="float: right">Topics</button>
            
                <ul class="dropdown-menu" style="padding: 10px ; width:300px" id="myDiv">
                    <li><p style="float: right;"><input type="radio" value="science" style="margin: 10px;" name="topic[]" required>Science</p></li>
                    <li><p style="float: right;"><input type="radio" value="entrepreneurship" style="margin: 10px;" name="topic[]" required>Entrepreneurship</p></li>
                    <li><p style="float: right;"><input type="radio" value="education" style="margin: 10px;"name="topic[]" required>Education</p></li>
                    <li><p style="float: right;"><input type="radio" value="history" style="margin: 10px;" name="topic[]" required>History</p></li>
                    <li><p style="float: right;"><input type="radio" value="buisness" style="margin: 10px;" name="topic[]" required>Buisness</p></li>
                    <li><p style="float: right;"><input type="radio" value="travellblog" style="margin: 10px;"name="topic[]" required>travell blog</p></li>
                    <li><p style="float: right;"><input type="radio" value="stories" style="margin: 10px;" name="topic[]" required>Stories</p></li>
                    <li><p style="float: right;"><input type="radio" value="breakingnews" style="margin: 10px;" name="topic[]" required>Breaking News</p></li>
                    <li><p style="float: right;"><input type="radio" value="technology" style="margin: 10px;"name="topic[]" required>Technology</p></li>
                       <li><p style="float: right;"><input type="radio" value="films" style="margin: 10px;"name="topic[]" required>Films</p></li>

                       <li><p style="float: right;"><input type="radio" value="poems" style="margin: 10px;"name="topic[]" required>Poems</p></li>
                        <li><p style="float: right;"><input type="radio" value="motivation" style="margin: 10px;"name="topic[]" required>motivation</p></li>
                         <li><p style="float: right;"><input type="radio" value="sports" style="margin: 10px;"name="topic[]" required>Sports</p></li>
                          <li><p style="float: right;"><input type="radio" value="bollywood" style="margin: 10px;"name="topic[]" required>Bollywood</p></li>
                           <li><p style="float: right;"><input type="radio" value="entertainment" style="margin: 10px;"name="topic[]" required>Entertainment</p></li>
                            <li><p style="float: right;"><input type="radio" value="interestingfacts" style="margin: 10px;"name="topic[]" required>Interesting facts</p></li>
                             <li><p style="float: right;"><input type="radio" value="literature" style="margin: 10px;"name="topic[]" required>Literature</p></li>
                              <li><p style="float: right;"><input type="radio" value="coding" style="margin: 10px;"name="topic[]" required>coding</p></li>
                               <li><p style="float: right;"><input type="radio" value="art" style="margin: 10px;"name="topic[]" required>Art</p></li>
                                <li><p style="float: right;"><input type="radio" value="comics" style="margin: 10px;"name="topic[]" required>Comics</p></li>
               
                </ul>


            </div>

</div>


  
  <label class="btn btn-default"  for="submit-form" tabindex="0" title="submit post" style="font-family: lobster;font-size: 20px;float:right;margin-top:-50px">Publish</label>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" style="font-family: lobster;font-size: 20px">Close</button>
      </div>
    </div>

  </div>
</div>

   	<!-- form submitting-->  
   	
<div  style="margin-left: 20%;"> <textarea name="editor" id="ckeditor" class="w3-right"/></textarea> </div> 
<input type="submit"  id="submit-form" name="uploadSubmit" class="hidden" value="post" onclick="return validate();">
      </form>
    
    <script>
    	// title image validation


$(function() {

$('#chkveg').multiselect({

includeSelectAllOption: true

});

$('#btnget').click(function() {

alert($('#chkveg').val());

})

});
    	
    	
    	
   
    
    function getStats(ckeditor) {
    var body = tinymce.get(ckeditor).getBody(), text = tinymce.trim(body.innerText || body.textContent);

    return {
        chars: text.length,
        words: text.split(/[\w\u2019\'-]+/).length
    };
} 

$(document).ready(function(){

$('#submit-form').click(function() {
$("#topic_warning").css("display","block");

})


  $("#text").keyup(function(){

          var val = $(this).val();

          var dataString = "article_title=" + val;

          $.ajax({
                  type:"POST",
             url:"ForHandligAjax.php" ,
             data:dataString,
             cache:false,

             success:function(data){

console.log(data);

   if(data == "This title is not available"){
        
$("#pub_article").attr("onsubmit" , "return false");

   }else{

$("#pub_article").attr("onsubmit" , "return true");

   }

$("#warningtitle").html(data);
             }  ,
             error:function(data){


              console.log(data);
             }

          });

  });
	
 $("#topic").on('keyup', function() {
    var words = this.value.match(/\S+/g).length;
   
    });	
});
 
 function validate() {
 	
  var name = document.getElementById("fileToUpload").files[0].name;

  var ext = name.split('.').pop().toLowerCase();
  var f = document.getElementById("fileToUpload").files[0];
  var fsize = f.size||f.fileSize;
  

        if ((tinymce.EditorManager.get('ckeditor').getContent()) == '') {
            alert('You Can Not Enter Empty Post Body.');
            return false;
        }
         else if (getStats('ckeditor').chars < 15) {
            alert("You need to enter atleast 15 characters or more in your post :).");
            return false;
        }
        else if(jQuery.inArray(ext, ['gif','png','jpg','JPEG']) == -1){ 
        	alert("Invalid title image type");
        	return false;
        	
        }
        else if(fsize > 20000000){
        	alert("title Image is very big");
        	return false;
        }
        
else{

     return true;

	}

        // Check if the user has entered less than 1 words
        
        // Submit the form
       
    }



    </script>
    

        </body>


    
</html>





