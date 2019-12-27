<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
$userid5="";
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}
        $logged_user = Login::isLoggedIn();
	 if(!empty($_GET['q']))
          { 
if(isset($_GET['q'])){



            if(DB::query('SELECT id FROM signup WHERE id=:userid', array(':userid'=>$_GET['q'])))
            {
             $userid5 = $_GET['q'];

              if($userid5 == $logged_user){

                header("location:personal wall.php");

                die();

              }else{
 $userid5 = $_GET['q'];

              }
             


}else{

  die('<div style=";position:relative;top:150px;margin-left:500px;">
  <p style="font-size:30px">channel not found</p>
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
<title>Blogsar</title>
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
  
    }
   

   .notif:hover{
      background-color: #ddd;
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

  #home{

    margin-left: 300px;
  }
  div.description,.title {
    width:47%;
  }
}
.blue{
	display:none;
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
  #discussion{
    left:-250px;
  }
	
}
    
    
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}

</style>
</style>

<script type="text/javascript">
<!--
if (screen.width <= 699) {
document.location = "https://www.blogsar.com/mobile/otherStats.php?q=<?php echo $userid5?>";

}

//-->
</script>

<script language=javascript>
<!--
if ((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
   location.replace("https://www.blogsar.com/mobile/otherStats.php?q=<?php  echo $userid5?>");
}
-->
</script>


<script type="text/javascript">

   var start = 10;
  var working = false; 
  
 $(window).scroll(function(){

    if($(this).scrollTop() + 10 >= $(document).height() - $(window).height()){



if(working==false){
   
   working = true; 

var userid = <?php echo $userid5 ?>;
//ajax code for displaying subscribers list
       var dataString = "subscribers_list=" + start + "&userid="+userid;
      $.ajax({

           type:"POST",
           url:"ForHandligAjax.php",
           data:dataString,
           cache:false,
           async:false,
           global:false,
           dataType:'json',

           success:function(data){
             
          console.log(data);

          for(var i=0;i<data[0].length;i++){



            $(".subscribers").html(

                  $(".subscribers").html()+ '<div class="well" style="width:auto;position:relative;height:100px;margin-top:-15px"><img class="img-thumbnail" src='+data[0][i].channelImage+'  style="position:absolute;height:99px;width:120px;top:0;left:0" alt="channel image"><p style="font-family:Mali;font-size:18px;position:absolute;left:130px"> <b>'+data[0][i].authorName+'<b></p><p style="position:absolute;top:0;right:0;color:blue">Author Strength : '+data[3][i].authorRank+'</p><p style="font-family:Mali;font-size:17px;color:grey;position:absolute;left:130px;top:50px">'+data[0][i].channelName+'</p><br></div>'

              )

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




      // code for displaying subscribed channel lists
var userid = <?php echo $userid5 ?>;
//ajax code for displaying subscribers list
       var dataString = "subscribed_list=" + start + "&userid="+userid;
      $.ajax({

           type:"POST",
           url:"ForHandligAjax.php",
           data:dataString,
           cache:false,
          // async:false,
          global:false,
           dataType:'json',

           success:function(data){
             
          console.log(data);

          for(var i=0;i<data[0].length;i++){

            $(".subscribed").html(
                $(".subscribed").html()+ '<div class="well" style="width:auto;position:relative;height:100px;margin-top:-15px"><img class="img-thumbnail" src='+data[0][i].channelImage+'  style="position:absolute;height:99px;width:120px;top:0;left:0" alt="channel image"><p style="font-family:Mali;font-size:18px;position:absolute;left:130px"> <b>'+data[0][i].authorName+'<b></p><p style="position:absolute;top:0;right:0;color:blue">Author Strength : '+data[3][i].authorRank+'</p><p style="font-family:Mali;font-size:17px;color:grey;position:absolute;left:130px;top:50px">'+data[0][i].channelName+'</p><br> </div>'
              )

            
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
  
  
//code for displaying liked articles
    var userid = <?php echo $userid5; ?>;
      var dataString = "liked_articles=" + userid;

      $.ajax({

                    type:"POST",
                    url:"ForHandligAjax.php",
                    data:dataString,
                    dataType:'json',
                    cache:false,
                    global:false,
                    success:function(data){
                      console.log(data);

                        for(var i=0;i<data[0].length;i++){

            $(".myLiked").html(
                $(".myLiked").html()+ '<a href="read.php?q='+data[0][i].id+'"><div class="well" style="width:auto;position:relative;height:80px;margin-top:-15px"><img class="img-thumbnail" src='+data[0][i].titleImage+'  style="position:absolute;height:79px;width:90px;top:0;left:0" alt="title image"><p style="font-family:Merriweather;font-size:15px;position:absolute;left:110px;top:0"> '+data[0][i].title+'</p><p style="font-family:Mali;font-size:18px;position:absolute;left:110px;top:25px"> <b>written by </b>: '+data[2][i]+'</p><p style="font-family:Mali;font-size:18px;position:absolute;left:110px;top:50px;color:grey"> '+data[1][i]+'</p><p style="font-family:Merriweather;font-size:15px;position:relative;float:right;top:37px;z-index:">likes : '+data[0][i].likes+'</p><p style="font-family:Merriweather;font-size:15px;position:relative;right:0;top:36px;z-index:;float:right;margin-right:20px">views : '+data[0][i].views+'</p><p style="font-family:Merriweather;font-size:15px;position:relative;right:0;top:36px;z-index:;float:right;margin-right:20px">strength : '+data[0][i].postRank+'</p><br> </div></a>'
              )}
                    },
                    error:function(data){

                      console.log(data);
                    }

      });



    // code for displaying subscribers
var userid = <?php echo $userid5 ?>;
    var val = 0;
    var dataString = "subscribers_list=" + val + "&userid="+userid;
      $.ajax({

           type:"POST",
           url:"ForHandligAjax.php",
           data:dataString,
           cache:false,
           //async:false,
           global:false,
           dataType:'json',

           success:function(data){
             
          console.log(data);

          for(var i=0;i<data[0].length;i++){

            $(".subscribers").html(
                  $(".subscribers").html()+ '<div class="well" style="width:auto;position:relative;height:100px;margin-top:-15px"><img class="img-thumbnail" src='+data[0][i].channelImage+'  style="position:absolute;height:99px;width:120px;top:0;left:0" alt="channel Image" ><p style="font-family:Mali;font-size:18px;position:absolute;left:130px"> <b>'+data[0][i].authorName+'<b></p><p style="position:absolute;top:0;right:0;color:blue">Author Strength : '+data[3][i].authorRank+'</p><p style="font-family:Mali;font-size:17px;color:grey;position:absolute;left:130px;top:50px">'+data[0][i].channelName+'</p><br </div>'
              )

           
          }

           },
           error:function(data){
            console.log(data);
           }

      });





      // code for displaying subscribed channels lists
       var val = 0;
       var userid = <?php echo $userid5 ?>;
    var dataString = "subscribed_list=" + val + "&userid="+userid;
      $.ajax({

           type:"POST",
           url:"ForHandligAjax.php",
           data:dataString,
           cache:false,
           //async:false,
           dataType:'json',
global:false,
           success:function(data){
             
          console.log(data);

          for(var i=0;i<data[0].length;i++){

            $(".subscribed").html(
                 $(".subscribed").html()+ '<div class="well" style="width:auto;position:relative;height:100px;margin-top:-15px"><img class="img-thumbnail" src='+data[0][i].channelImage+'  style="position:absolute;height:99px;width:120px;top:0;left:0" alt="titleImage"><p style="font-family:Mali;font-size:18px;position:absolute;left:130px"> <b>'+data[0][i].authorName+'<b></p><p style="position:absolute;top:0;right:0;color:blue">Author Strength : '+data[3][i].authorRank+'</p><p style="font-family:Mali;font-size:17px;color:grey;position:absolute;left:130px;top:50px">'+data[0][i].channelName+'</p><br> </div>'
              )

            
          }

           },
           error:function(data){
            console.log(data);
           }

      });




      //ajax script for getting article stats

          var userid = <?php echo $userid5?>;

          var dataString = "articleStats="+userid;
          $.ajax({

            type:"POST",
            url: "ForHandligAjax.php",
            data:dataString,
            dataType:'json',
            cache:false,
            
            success:function(data){

        console.log(data);

        for(var i =0;i<data[0].length;i++){

      $(".articleStats").html(

  $(".articleStats").html() + ' <div class="well" style="width:auto;position:relative;height:auto"><img class="img-thumbnail" src='+data[0][i].titleImage+'  style="position:absolute;height:70px;width:70px;top:0;left:0" alt="titleImage"><hr style="position:relative;top:30px"><p style="font-family:Mali;font-size:20px;position:absolute;left:100px;top:8px"> <b>'+data[0][i].title+'<b></p><p style="position:relative;top:10px;right:0;font-size:18px;font-family:Mali;color:green">Article Strength : '+data[0][i].postRank+'</p><p style="font-family:Mali;font-size:18px;color:green;position:relative;left:40%;top:-25px">Topic : '+data[0][i].Topics+'</p><p style="font-family:Mali;font-size:18px;color:green;position:relative;left:70%;top:-60px">published : '+data[2][i]+'</p><hr style="position:relative;top:-70px"><br><p style="position:relative;font-size:18px;font-family:mali;top:-100px">Total likes : '+data[0][i].likes+'</p><label class="btn btn-sm btn-primary" label_likes='+data[0][i].id+' for="likeStats'+data[0][i].id+'" tabindex="0"  style=";color:white;position:relative;top:-100px;left:250px;top:-137px">show</label><button likeStats-id='+data[0][i].id+' id="likeStats'+data[0][i].id+'"  name="uploadSubmit"  class="hidden" style="" ></button><div style="position:relative;height:35px;width:70%;background-color:grey;top:-130px;border-radius:5px;display:none" id="like_bar'+data[0][i].id+'" ><p style="color:white;position:relative;left:10px;top:-5px" class="btn" id="showMoreLiker'+data[0][i].id+'" show_more_like='+data[0][i].id+'>show 20 more</p></div><div class="well" likeStatDiv-id='+data[0][i].id+' style="position:relative;background-color:white;display:none;width:70%;top:-135px;max-height:500px;overflow:auto"><ul class="list-group likeStat_div'+data[0][i].id+'" likeStat_div-id= '+data[0][i].id+'style="color:black;position: relative;width:100%;top:-30px;" ></ul> </div><hr style="position:relative;top:-140px"><p style="position:relative;font-size:18px;font-family:mali;top:-130px">Total feedbacks : '+data[1][i]+'</p><label class="btn btn-sm btn-primary" label_feedbacks='+data[0][i].id+' for="feedbackStats'+data[0][i].id+'" tabindex="0"  style=";color:white;position:relative;top:-100px;left:250px;top:-167px">show</label><button feedbackStats-id='+data[0][i].id+' id="feedbackStats'+data[0][i].id+'"  name="uploadSubmit"  class="hidden" style="" ></button><div style="position:relative;height:35px;width:70%;display:none;background-color:grey;top:-155px;border-radius:5px;" id="feedback_bar'+data[0][i].id+'" ><p style="color:white;position:relative;left:10px;top:-5px" class="btn" id="showMorefeedbacker'+data[0][i].id+'" show_more_feedback='+data[0][i].id+'>show 20 more</p></div><div class="well" feedbackStatDiv-id='+data[0][i].id+' style="position:relative;background-color:white;display:none;width:70%;top:-160px;max-height:500px;overflow:auto"><ul class="list-group feedbackStat_div'+data[0][i].id+'" feedbackStat_div-id= '+data[0][i].id+'style="color:black;position: relative;width:100%;top:-30px;" ></ul> </div><hr style="position:relative;top:-160px"><p style="position:relative;font-size:18px;font-family:mali;top:-160px">Total views : '+data[0][i].views+'</p><label class="btn btn-sm btn-primary" label_views='+data[0][i].id+' for="viewsStats'+data[0][i].id+'" tabindex="0"  style=";color:white;position:relative;left:250px;top:-197px">show</label><button viewsStats-id='+data[0][i].id+' id="viewsStats'+data[0][i].id+'"  name="uploadSubmit"  class="hidden" style="" ></button><div style="position:relative;height:35px;width:70%;display:none;background-color:grey;top:-175px;border-radius:5px;" id="views_bar'+data[0][i].id+'" ><p style="color:white;position:relative;left:10px;top:-5px" class="btn" id="showMoreviewer'+data[0][i].id+'" show_more_views='+data[0][i].id+'>show 20 more</p></div><div class="well" viewsStatDiv-id='+data[0][i].id+' style="position:relative;background-color:white;display:none;width:70%;top:-180px;max-height:500px;overflow:auto"><ul class="list-group viewsStat_div'+data[0][i].id+'" viewsStat_div-id= '+data[0][i].id+'style="color:black;position: relative;width:100%;top:-30px;"></ul> </div><hr style="position:relative;top:-190px;"><p style="position:relative;font-size:18px;font-family:mali;top:-180px">Money earned on this article :0 rs. </p><label class="btn btn-sm btn-primary" label_money='+data[0][i].id+' for="moneyStats'+data[0][i].id+'" tabindex="0"  style=";color:white;position:relative;left:300px;top:-217px">show</label><button moneyStats-id='+data[0][i].id+' id="moneyStats'+data[0][i].id+'"  name="uploadSubmit"  class="hidden" style="" ></button><hr style="position:relative;top:-210px"><p style="font-family:Mali;font-size:19px;position:relative;top:-220px">Keywords : '+data[0][i].keywords+'</p><hr style="position:relative;top:-200px;margin-bottom:-240px"></div>'
        )



         // script for geting likes stats

         $('[likeStats-id]').click(function(){
           
        var postid = $(this).attr('likeStats-id');

           $(".likeStat_div"+postid+"").html(" "); 

               var val = 0;

          var dataString = "likeStats=" + postid + "&limit=" + val;

         currentRequest= $.ajax({
                type:"POST",
                url:"ForHandligAjax.php",
                data:dataString,
                dataType:'json',
                cache:false,
                //async:false,
                 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
                success:function(data){
          console.log(data);
$("[likeStatDiv-id='"+postid+"']").toggle();
       $("#like_bar"+postid+"").toggle();       
          for(var i =0;i<data[0].length;i++){
                
                $(".likeStat_div"+postid+"").html(

                           $(".likeStat_div"+postid+"").html() + '<li class="list-group-item likesStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
                  )

          }

                },
                error:function(data){

console.log(data);
                }


          });


         });


           var start1 = 20;
  var working1 = false; 


    $('[show_more_like]').click(function(){
 
 var postid = $(this).attr('show_more_like');

if(working1==false){
   
   working1 = true;

var dataString = "likeStats="+postid + "&limit=" + start1;

   currentRequest= $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
      beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
success:function(data){
console.log(data);

              for(var i=0;i<data[0].length;i++){
         
           $(".likeStat_div"+postid+"").html(

                           $(".likeStat_div"+postid+"").html() + '<li class="list-group-item likesStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
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
          

             // script for geting feedbacks stats

         $('[feedbackStats-id]').click(function(){
        

         
        var postid = $(this).attr('feedbackStats-id');
           $(".feedbackStat_div"+postid+"").html(" ");     
               var val = 0;

          var dataString = "feedbackStats=" + postid + "&limit=" + val;

        currentRequest=  $.ajax({
                type:"POST",
                url:"ForHandligAjax.php",
                data:dataString,
                dataType:'json',
                cache:false,
               // async:false,
                beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
                success:function(data){
          console.log(data);
$("[feedbackStatDiv-id='"+postid+"']").toggle();
       $("#feedback_bar"+postid+"").toggle();       
          for(var i =0;i<data[0].length;i++){
                
                $(".feedbackStat_div"+postid+"").html(

                           $(".feedbackStat_div"+postid+"").html() + '<li class="list-group-item feedbackStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
                  )

          }

                },
                error:function(data){

console.log(data);
                }


          });


         });


           var start1 = 20;
  var working1 = false; 


    $('[show_more_feedback]').click(function(){
 
 var postid = $(this).attr('show_more_feedback');

if(working1==false){
   
   working1 = true;

var dataString = "feedbackStats="+postid + "&limit=" + start1;

  currentRequest=  $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
      beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
success:function(data){
console.log(data);

              for(var i=0;i<data[0].length;i++){
         
           $(".feedbackStat_div"+postid+"").html(

                           $(".feedbackStat_div"+postid+"").html() + '<li class="list-group-item likesStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
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
        


// script for geting views stats

         $('[viewsStats-id]').click(function(){
        
 
        var postid = $(this).attr('viewsStats-id');

        
           $(".viewsStat_div"+postid+"").html(" ");     
               var val = 0;

          var dataString = "viewsStats=" + postid + "&limit=" + val;

         currentRequest= $.ajax({
                type:"POST",
                url:"ForHandligAjax.php",
                data:dataString,
                dataType:'json',
                cache:false,
                //async:false,
                 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
                
                success:function(data){
          console.log(data);
$("[viewsStatDiv-id='"+postid+"']").toggle();
       $("#views_bar"+postid+"").toggle();       
          for(var i =0;i<data[0].length;i++){
                
                $(".viewsStat_div"+postid+"").html(

                           $(".viewsStat_div"+postid+"").html() + '<li class="list-group-item viewsStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
                  )

          }

                },
                error:function(data){

console.log(data);
                }


          });


         });


           var start1 = 20;
  var working1 = false; 


    $('[show_more_views]').click(function(){
 
 var postid = $(this).attr('show_more_views');

if(working1==false){
   
   working1 = true;

var dataString = "viewsStats="+postid + "&limit=" + start1;

currentRequest =$.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
 beforeSend : function()    {           
        if(currentRequest != null) {
            currentRequest.abort();
        }
    },
success:function(data){
console.log(data);

              for(var i=0;i<data[0].length;i++){
         
           $(".viewsStat_div"+postid+"").html(

                           $(".viewsStat_div"+postid+"").html() + '<li class="list-group-item viewsStating"  style="height:auto;width:106%;position:relative;left:-15px;top:-17px;font-family:Merriweather;"><img src="'+data[2][i]+'" class="img-thumbnail" style="width:50px;height:50px;position:relative;left:-15px;margin:0;padding:0;bottom:-10px;margin-top:-20px"><a style="position:absolute;top:0;left:60px;font-size:14px" href="otherProfile.php?q='+data[3][i]+'">'+data[0][i]+'</a><a style="position:absolute;top:20px;left:60px;color:grey;font-size:13px" href="otherProfile.php?q='+data[3][i]+'">'+data[1][i]+'</a><p style="position:absolute;top:30px;right:0;font-family:Merriweather;font-size:13px">Author strength : '+data[4][i]+'</p></li>'
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
         //end of scripts



        }

            },
            error:function(data){

console.log(data);

            }
          });

      //ajax script for getting article stats ends


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

      $("#discussion").click(function(){
   
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

 currentRequest= $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
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

  currentRequest=$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
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

 currentRequest= $.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
global:false,
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

         currentRequest= $.ajax({
            type:"POST",
            url:"ForHandligAjax.php",
            dataType:'json',
            data:dataString,
            cache:false,
            //async:false,
            beforeSend : function()    {           
        if(currentRequest != null) {
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

   currentRequest= $.ajax({
type:"POST",
url:"ForHandligAjax.php",
data:dataString,
dataType:'json',
cache:false,
//async:false,
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
//async:false,
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


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;left:35%;top:27px;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;min-height: 50px;height:auto;overflow-y:auto;border-bottom: 1px solid black;width:30%;min-width: 300px">

 <p style="margin-left: 5px;font-size: 13px;margin-bottom: 5px;"><b>Notifications</b> <a href="#" style="position: absolute;right:5px" id="show_more_noti">Show more</a><a href="#" style="position: absolute;right:150px;color: red" id="clear_notification">Clear all</a></p>

<ul class="list-group Notifications" id="notify" style="margin-bottom: 0">

  </ul>


</div>
 </div>
 
 <!--THE NOTIFICAIONS DROPDOWN BOX.-->

  <a href="postEditor.php" id ="writePost" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Write a Post"><i class="fa fa-pencil-square-o " aria-hidden="true" style="font-size: 30px"></i></a>
 

   
 <div id="forArticleSearch" style="display: block;">
     <form autocomplete="off" action="read.php">
     <button type="submit" id="searchBtn" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none w3-right" onclick="return empty()" title="Search" ><i class="fa fa-search " style="font-size: 30px" ></i></button>
     
     <input type="text" id="search" class="form-control  sbox"  style="width:30%;margin-top: 10px;position:absolute;right:70px;float:right;color: #333333;min-width: 300px" placeholder="Search.." name="q">
   


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




 </div>
</div>


 <!-- Middle Column -->
 <!--Main div that displays features-->
   <!--  start about column Div-->
     <div id="discussion" class="Discussion" style="display:block; margin-top:10px;position:relative;right:5%;min-width: 1100px">
     <div class="w3-col m7" id="page" style=" margin-left:290px;margin-top:50px;width:65%;max-width:90%">

     <div class="middle-column" >

      <div class="w3-container w3-card w3-white w3-round w3-margin" id="mainDiscussion" style="height: auto;max-height:100%;max-width:100%"><br>

 <div style="height: auto;min-height:270px;word-wrap:break-word;position: relative;background-color:#e6e6ff">


     <div id="asked1" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn1" class="btn"style="font-size: 20px;top:-45px;position:absolute;color: pink;background-color:#e6e6ff">Article stats</h2></div>
           


<div id="asked2"  style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn2" style="font-size: 20px;position:absolute;top:-45px;left:150px;color: pink;" class="btn">Subscribers</h2></div>

<div id="asked3" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn3" style="font-size: 20px;position: absolute;top:-45px;left:300px;color: pink;" class="btn">Subscribed</h2></div>

<div id="asked4" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn4" style="font-size: 20px;position: absolute;top:-45px;left:450px;color: pink;" class="btn">Liked Articles</h2></div>



<hr style="margin-top: 20px">

<?php


  
if(DB::query('SELECT article_stats FROM privacy_rules WHERE user_id=:id',array(':id'=>$userid5))[0]['article_stats'] == "yes"){
echo'
<div id="chatDiv1" style="display: block;">
  <!--code has to be written here for statics of articles-->
     
<div class="articleStats">
  
</div>

  </div>';


}else{
echo'<div id="chatDiv1" style="display: block;">

<p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">Author did not allow to see  article stats !</p>
</div>';

}





if(DB::query('SELECT my_subscribers FROM privacy_rules WHERE user_id=:id',array(':id'=>$userid5))[0]['my_subscribers'] == "yes"){
echo'
  <div id="chatDiv2" style="display: none">
<!--div for displaying subscribers list-->

<div class="subscribers">
  
</div>
    
  </div>';
}else{
  echo'
    <div id="chatDiv2" style="display: none">

    <p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">Author did not allow to see his see  subscribers list !</p>
    </div>';
}



if(DB::query('SELECT i_subscribed FROM privacy_rules WHERE user_id=:id',array(':id'=>$userid5))[0]['i_subscribed'] == "yes"){
  echo'
<!--div for displaying subscribed list-->
  <div id="chatDiv3" style="display: none">

   <!--div for displaying subscribed list-->
<div class="subscribed">
  
</div>

    
  </div>';
}else{

  echo'
    <div id="chatDiv3" style="display: none">

    <p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">Author did not allow to see  subscribing list !</p>
    </div>';
}



if(DB::query('SELECT myLiked FROM privacy_rules WHERE user_id=:id',array(':id'=>$userid5))[0]['myLiked'] == "yes"){
  echo'
<!--div for displaying subscribed list-->
  <div id="chatDiv4" style="display: none">

   <!--div for displaying subscribed list-->
<div class="myLiked">
  
</div>

    
  </div>';
}else{

  echo'
    <div id="chatDiv4" style="display: none">

    <p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">Author did not allow to see Liked Articles !</p>
    </div>';
}

  ?>
     <!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:30%;display:none;top:160px">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:50%;top:100px">
  
        </div>
        <!-- copy right mark of Blogsar-->
       <p >Blogsar © 2019</p>

</div>

           </div>

      </div>
       
</div>



   <script>






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

//discussion div js
   $(document).ready(function(){


    $("#asked1").click(function(){
      $("#chatDiv2").hide()
          $("#askedbtn2").css("background-color","");
        $("#askedbtn1").css("background-color","#e6e6ff");
       $("#askedbtn3").css("background-color","");
        $("#askedbtn4").css("background-color","");
      

$("#chatDiv4").hide()

$("#chatDiv3").hide()
     
      $("#chatDiv1").show();

    });



       $("#asked2").click(function(){
      $("#chatDiv3").hide();
$("#chatDiv1").hide();
      $("#chatDiv2").show();

$("#chatDiv4").hide()

        $("#askedbtn2").css("background-color","#e6e6ff");
        $("#askedbtn1").css("background-color","");
       $("#askedbtn3").css("background-color","");
         $("#askedbtn4").css("background-color","");

    });

          $("#asked3").click(function(){
      $("#chatDiv2").hide();
$("#chatDiv1").hide();
$("#chatDiv4").hide();
      $("#chatDiv3").show();
       $("#askedbtn2").css("background-color","");
        $("#askedbtn1").css("background-color","");
          $("#askedbtn4").css("background-color","");
       $("#askedbtn3").css("background-color","#e6e6ff");

    });


    $("#asked4").click(function(){
      $("#chatDiv2").hide();
$("#chatDiv1").hide();
$("#chatDiv3").hide();
      $("#chatDiv4").show();
       $("#askedbtn2").css("background-color","");
        $("#askedbtn1").css("background-color","");
          $("#askedbtn3").css("background-color","");
       $("#askedbtn4").css("background-color","#e6e6ff");

    });


   });


//discussion div js end



   </script>

</body>
</html>