<?php

include('/home/s1m0m1lnqe21/public_html/ForHandligAjax.php');
$userid5="";
if(!Login::isLoggedIn()){
  header("location:loginpage.php");
 die();
}

	
if (Login::isLoggedIn()) {

        $userid5 = Login::isLoggedIn();
	  
     
} else {

        echo 'Not logged in';

}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Blogsar-discussion</title>
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

.menu:hover{
  color:blue;
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

.notif:hover{
      background-color: #ddd;
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


<script type="text/javascript">


  $(document).ready(function(){

 $(document).ajaxStart(function(){

      $("#loadingImage1").css("display","block");
  });


  $(document).ajaxComplete(function(){

      $("#loadingImage1").css("display","none");
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

  currentRequest=$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
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

  currentRequest =$.ajax({
type: "POST",
url: "ForHandligAjax.php",
data: dataString,
cache: false,
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
  var stop =  1;

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
           // async:false,
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




//script for feedbacks given by you
var val = 0;
var dataString = "myFeedbacks="+val;

$.ajax({
  
  type:"POST",
  url:"ForHandligAjax.php",
  data:dataString,
  cache:false,
  dataType:'json',
  success:function(data){
       console.log(data);
       if(data[0].length==0){

           $(".myFeedbacks").html(
            $(".myFeedbacks").html() + '<p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">You have not submitted any feedback!</p>'
            )
        }else{
    for(var i=0;i<data[0].length;i++){

$(".myFeedbacks").html(
       
   $(".myFeedbacks").html() + '<p style="font-family:Merriweather;font-size:16px"> <a href="otherProfile.php?q='+data[0][i].sender+'"> '+data[2][i].authorName+'</a> Replied on your feedback  on his article <a href="read.php?q='+data[0][i].post_id+'">'+data[3][i].title+'</a></p> <div class="well" style="width:auto;position:relative;background-color:'+data[1][i]+'"><h2 style="margin-top:-15px;font-size: 26px">feedback :</h2><p style="font-family:Mali;font-size:15px">'+data[0][i].feedback+'</p><br> <h2 style="margin-top:-15px;font-size: 16px">'+data[2][i].authorName+' says :</h2><p style="font-family:Mali;font-size:15px">'+data[0][i].reply+'</p><p style="position:absolute;bottom:-10px;right:20px;font-family:Baloo bhai;color:blue">'+data[4][i]+'</p></div>'

  )
    }
  }
  },
  error:function(data){

    console.log(data);
  }

});

// script for feedbacks secctipn

  var val = 0;
  var dataString = "feedbacks_data="+val;

  $.ajax({

    type:"POST",
    url:"ForHandligAjax.php",
    data:dataString,
    dataType:'json',
    cache:false,
    success:function(data){

      console.log(data);
      if(data[0].length==0){

           $(".feedback").html(
            $(".feedback").html() + '<p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">There is not any feedback  !</p>'
            )
        }else{

      for(var i= 0;i<data[0].length;i++){

        $(".feedback").html(

             $(".feedback").html() + '<div mainFeedbackDiv-id='+data[0][i].id+'  mainFeedback_Div-id='+data[0][i].sender+'><p style="font-family:Merriweather;font-size:17px"><a href="otherProfile.php?q='+data[0][i].sender+'">'+data[2][i].authorName+'</a> submitted a feedback on your article titled <a href="read.php?q='+data[0][i].post_id+'">'+data[3][i].title+'</a></p> <div class="well" style="width:auto;position:relative;background-color:'+data[1][i]+'"> <div class="dropdown dropleft" style="margin-right:auto;margin-top:-25px;float:right"> <i class="fas fa-ellipsis-v menu " class="btn btn-primary dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px;font-size:20px "></i> <div class="dropdown-menu" style="margin-right:50px;word-wrap:break-word"> <a class="dropdown-item" href="#"><h3 style="font-size:15px" snoozAuthor-id='+data[0][i].sender+'>block feedbacks </h3></a><a class="dropdown-item" deleteFeedback-id='+data[0][i].id+' style="display:block" href="#"><h3 style="font-size:15px;style="">Delete feedback</h3></a></div></div>  <h2 style="margin-top:-15px;font-size: 16px;color:purple">Feedback :</h2><p style="font-family:Mali;font-size:15px">'+data[0][i].feedback+'</p> <h2 style="margin-top:0px;font-size: 16px;color:purple">Your reply :</h2><p replyPara-id='+data[0][i].id+' style="font-family:Mali;font-size:15px;margin-bottom:0px">'+data[0][i].reply+'</p><br> <div class="form-group"> <textarea class="form-control" rows="5" writeReply-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px;display:none;font-family:Mali" maxlength="500" placeholder="Write your question" required  ></textarea></div> <label  class="btn btn-default btn-sm" label3='+data[0][i].id+' for="reply'+data[0][i].id+'" tabindex="0" title="Submit your question" style="font-size: 15px; float:right;margin-top:-10px">Reply</label><button id="reply'+data[0][i].id+'" reply-id ='+data[0][i].id+' name="uploadSubmit"  class="hidden" style="" ></button><p style="position:relative;bottom:-10px;left:0;font-family:Baloo bhai;color:blue">'+data[4][i]+'</p></div></div>'
          )


        // script for replying on any feeedback

  $('[reply-id]').click(function(){
 
 var id = $(this).attr('reply-id');

   

        $("[writeReply-id='"+id+"']").toggle();

     var reply = $("[writeReply-id='"+id+"']").val();
     if(reply){
           
  $("[replyPara-id='"+id+"']").html(reply);
      $("[label3='"+id+"']").html("Update reply");
       var dataString = "feedbacker="+id +"&reply="+reply;
      $.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

  

       }



        });
      }

    });


  // deleting any particular feedback on your article 

$('[deleteFeedback-id]').click(function(e){
 e.preventDefault();

       var id = $(this).attr('deleteFeedback-id');

   
       var dataString = "Dfeedbacker="+id;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

       $("[mainFeedbackDiv-id='"+id+"']").css("display","none");
     

       }
       });

  });


//block author to send feedbacls and delete all feedbacks given by hin

$('[snoozAuthor-id]').click(function(e){

 e.preventDefault();
var sender = $(this).attr('snoozAuthor-id');

    var confi = confirm("this author won't be able to send feedbacks anymore! ");
    if(confi==true){

      var blockedAuthor = sender
      var dataString = "blocked="+blockedAuthor;
      
 $.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

          $("[ mainFeedback_Div-id='"+sender+"']").hide();
      
       }



        });

    }

  });

      }
    }
    },
    error:function(data){

      console.log(data);
    }

  });

//script for askedByMe code

  var val = 0;

    var dataString = "askedByMe="+val;

    $.ajax({
      type:"POST",
      url:"ForHandligAjax.php",
      data:dataString,
      dataType:'json',
      cache:false,
      success:function(data){
        console.log(data);
if(data[0].length==0){

           $(".askedByMe").html(
            $(".askedByMe").html() + '<p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">You have not asked any question yet !</p>'
            )
        }else{
        for(var i=0;i<data[0].length;i++){
           
           $(".askedByMe").html(
                
                $(".askedByMe").html() + '   <div mainChatDiv-id='+data[0][i].id+'>'+data[2][i]+'<div class="well" style="width:auto;position:relative ; background-color:'+data[1][i]+'" ><h2 style="margin-top:-15px;font-size: 16px">Your question :</h2><p style="font-family:Mali;font-size:15px">'+data[0][i].question+'</p><br>'+data[3][i]+'<label  class="btn btn-danger btn-sm" label2-id='+data[0][i].id+' for="delChat'+data[0][i].id+'" tabindex="0" title="delete this question" style="font-size: 15px; float:right;margin-top:-40px">delete</label><button id="delChat'+data[0][i].id+'" name="uploadSubmit"  class="hidden" delChat-id='+data[0][i].id+' ></button>  <p style="position:absolute;bottom:-10px;right:20px;font-family:Baloo bhai;color:blue">'+data[4][i]+'</p></div> </div>'

            )



// script for deleting chats



// deleting chat


$('[delChat-id]').click(function(){

     var id = $(this).attr('delChat-id');

  
    var dataString = "replier="+id;
     
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

       $("[mainChatDiv-id='"+id+"']").hide();
       
     

       }
       });


 


  });

        }
      }
      }

    });






//script for askedToYou feature

    var val = 0;

    var dataString = "askedToYou="+val;

    $.ajax({
      type:"POST",
      url:"ForHandligAjax.php",
      data:dataString,
      dataType:'json',
      cache:false,
      success:function(data){
        console.log(data);
        if(data[0].length==0){

           $(".askedToYou").html(
            $(".askedToYou").html() + '<p style="font-size:25px;font-family:baloo bhai;position:absolute;top:100px;right:250px">There is not any question asked to you !</p>'
            )
        }
else{
        for(var i=0;i<data[0].length;i++){

          $(".askedToYou").html(

     $(".askedToYou").html() + ' <div mainData-id='+data[0][i].id+'  Main_Data-id='+data[0][i].sender+'> <p style="font-size:16px;font-family:Merriweather;margin-left:20px;"><a href="otherProfile.php?q='+data[0][i].sender+'">'+data[1][i].authorName+'</a> asked a question </p><p style="float:right"></p> <div class="well" style="width:auto;position:relative;background-color:'+data[3][i]+'"><div class="dropdown dropleft" style="margin-right:auto;margin-top:-25px;float:right;"><i class="fas fa-ellipsis-v " class=" dropdown-toggle" data-toggle="dropdown" id="set" style="margin-top:15px;font-size:20px "></i><div class="dropdown-menu" style="margin-right:50px;"><a href="#" class="dropdown-item" ><h3 style="font-size:15px" blockAuthor-id='+data[0][i].sender+'>block </h3></a><a href="#" class="dropdown-item" ><h3 style="font-size:15px" delete-id='+data[0][i].id+'>delete </h3></a></div></div><h2 style="margin-top:-15px;font-size: 16px;font-family:Baloo Bhai">Question: </h2> <p style="font-family: Mali;font-size:15px">'+data[0][i].question+'</p><br><h2 style="margin-top:-15px;font-size: 16px;font-family:Baloo Bhai">Your answer: </h2> <p answerPara-id='+data[0][i].id+' style="font-family: Mali;font-size:15px;margin-bottom:0px">'+data[0][i].answer+'</p><br>  <div class="form-group"><textarea class="form-control" rows="5" writeAnswer-id='+data[0][i].id+' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px;display:none;font-family:Mali" maxlength="500" placeholder="Write your question" required></textarea></div><label  class="btn btn-default" label1-id='+data[0][i].id+' for="answer'+data[0][i].id+'" tabindex="0" title="Submit your question" style="font-size: 15px; float:right;margin-top:-10px">'+data[2][i]+'</label><button id="answer'+data[0][i].id+'" answer-id='+data[0][i].id+' name="uploadSubmit"  class="hidden" style="" ></button> <p style="position:relative;bottom:-20px;left:0;font-family:Baloo bhai;color:blue">'+data[4][i]+'</p></div> </div>')



          //script of submiting answer

  $('[answer-id]').click(function(){
 
               var val = $(this).attr('answer-id');



     var answer = $("[writeAnswer-id='"+val+"']").val();


      $("[writeAnswer-id='"+val+"']").toggle();
     if(answer){
   
  $("[answerPara-id='"+val+"']").html(answer);
   $("[label1-id='"+val+"']").html("Update Answer");

       var dataString = "asker="+val + "&answer="+answer;
      $.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){
console.log(data);
          
      
       },error:function(){
        console.log(data);
       }



        });
      }

    });


  //for deleting any particular chat


$('[delete-id]').click(function(e){

  e.preventDefault();
var confir = confirm("This responce will be deleted !");
 if(confir==true){

var id = $(this).attr('delete-id');
     
       var dataString = "Asker="+id ;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

       $("[mainData-id='"+id+"']").css("display","none");
     

       }
       });


 }


  });



// blockauthor from chat script

$('[blockAuthor-id]').click(function(e){

  e.preventDefault();

      var b = confirm("He will not be able to send you messages!");

      if(b==true){

        var blocked = $(this).attr('blockAuthor-id');
       
       var dataString = "Blocked="+blocked;

       


$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){

    
       $("[Main_Data-id='"+blocked+"']").css("display","none");
      

       }
       });

      }

    });

        }
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
 

    <a href="index.php" id="home" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Home"  style="margin-left:24%"><i class="fa fa-home" style="font-size: 30px"></i></a>

  <a href="personal wall.php" id="PersonalWall" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none" title="Personal Wall"><i class="fa fa-user " style="font-size: 30px"></i></a>
  




  
 <div  style="position: relative;height:auto" >

  <button   id="noti_Button" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-none"  title="Updates" style="position: relative;"><i class="fas fa-bell " style="font-size: 30px">
     <span id="noti_Counter" style="position: absolute;left:45px;top:6px;font-size: 12px;z-index:50px;color:white;background-color: red;padding: 2px;display: none"><b></b></span>
  </i>
 
  </button>


<div id="notifications" class="w3-round w3-margin w3-card w3-white" style="position:fixed;left:35%;top:30px;color: black;font-size: 15px;background-color: white;display: none;max-height:600px;min-height: 50px;width:450px;height:auto;overflow-y:auto;border-bottom: 1px solid black">

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
  
       <ul class="list-group autocomplete2" id="searchResult2" style="color:black;position: absolute;top:75px;right:66px;width:30%;min-width: 300px;max-height: 500px;font-size: 15px;overflow: auto" >
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


 <!-- Middle Column -->
 <!--Main div that displays features-->
   <!--  start about column Div-->
     <div id="discussion" class="Discussion" style="display:block; margin-top:10px;position:relative;right:5%;min-width: 1100px">
     <div class="w3-col m7"  style=" margin-left:290px;margin-top:50px;width:65%;max-width:90%">

     <div class="middle-column" >

      <div class="w3-container w3-card w3-white w3-round w3-margin" id="mainDiscussion" style="height: auto;max-height:100%;max-width:100%"><br>

 <div style="height: auto;min-height:270px;word-wrap:break-word;position: relative;background-color:#e6e6ff">


<div id="asked1" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn1" class="btn"style="font-size: 20px;top:-45px;position:absolute;color: pink;background-color:#e6e6ff">Asked to Me</h2></div>
           


<div id="asked2"  style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn2" style="font-size: 20px;position:absolute;top:-45px;left:150px;color: pink;" class="btn">Feedbacks</h2></div>

<div id="asked3" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn3" style="font-size: 20px;position: absolute;top:-45px;left:300px;color: pink;" class="btn">My Feedbacks</h2></div>

<div id="asked4" style="position:absolute;top:-13px;width:60px;height:30px"><h2 id="askedbtn4" style="font-size: 20px;position: absolute;top:-45px;left:490px;color: pink;" class="btn">Asked by Me</h2></div>

<hr style="margin-top: 20px">


<div id="chatDiv1" style="display: block;">
  
     <div class="askedToYou">
       
     </div>
  </div>


  <div id="chatDiv2" style="display: none">

    <div class="feedback">
      
    </div>
  </div>


  <div id="chatDiv3" style="display: none">
 <button class="btn btn-danger btn-sm" style="float:right;margin-top:-20px" id="clean">Clean</button>
   <div class="myFeedbacks">
     
   </div>
    
  </div>



  <div id="chatDiv4" style="display: none">

   <div class="askedByMe">
     
   </div>
  </div>

    
<!--Loading progress bar for article loading-->
<img src="images/LoadingProgressBar.gif" id="loadingImage1" style="position: fixed;z-index: 9999;right:50%;display: none;top:150px">

<img src="images/LoadingProgressBar.gif" id="loadingImage2" style="position: fixed;z-index: 9999;display: none;right:50%;top:100px">
    

        </div>
        <!-- copy right mark of Blogsar-->
       <p>Blogsar © 2019</p>
</div>

           </div>
          

      </div>
</div>



   <script>





   $(document).ready(function(){

       $("#clean").click(function(){
        $(".myFeedbacks").css("display","none");

             

       var val=10;
       var dataString = "delall="+val;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){


     

       }
       });


 


 
        });

    });



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


    $("#askedbtn1").click(function(){

      var val=10;
       var dataString = "status="+val;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){


     

       }
       });


    });
     $("#askedbtn4").click(function(){

      var val=10;
       var dataString = "Statuses="+val;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){


     

       }
       });


    });

    $("#askedbtn2").click(function(){

      var val=10;
       var dataString = "seen1="+val;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){


     

       }
       });


    });


    $("#askedbtn3").click(function(){

      var val=10;
       var dataString = "seen2="+val;
$.ajax({
        
       type:"POST",
       url:"ForHandligAjax.php",
       cache:false,
       data:dataString,
       success:function(data){


     

       }
       });


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