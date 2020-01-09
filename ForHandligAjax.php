  <?php


date_default_timezone_set('Asia/Kolkata');
       $time = date("Y-m-d H:i:s");
       
       
       //showing articles for not loggedIn users
       // for read without being loggedin script

if(isset($_POST['readWithoutLoggedInArticles']))
							{
									

$limit = $_POST['readWithoutLoggedInArticles'];


$f = 0;
$readArticles="";
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();

$viewValArr=array();

$mArr = array();

$authorStrengthArr=array();

  $statusArr = array();

  $searchData = $_POST['data'];

  if(is_numeric($_POST['data'])){

$readArticles = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,

post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 

 post.id = :postid
 LIMIT 10 OFFSET '.$limit.'',array(':postid'=>$_POST['data'])); 
  }
  	else{
$readArticles = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 
 post.title LIKE :body

 OR post.Topics LIKE :body
 OR post.description LIKE :body

   OR post.keywords LIKE :body
 ORDER BY post.postRank DESC
 LIMIT 5 OFFSET '.$limit.'
  '
  ,array(':body'=>'%'.$searchData.'%')); 
  	}




						

foreach ($readArticles as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];


$likeValue="";

$viewVal="";


  $status =  current::Time($posted_at);
  $dem22 =   array($status);
  $statusArr = array_merge($statusArr,$dem22);


author::strength($userid);
article::strength($id);

//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	

$AuthData = array_merge($AuthData,$authorData);


   


//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);

}







$Data = [ $readArticles, $AuthData, $authorStrengthArr, $statusArr];

echo json_encode($Data);

}


//actually working like code

if(isset($_POST['liking']))
					{

						if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}						
						$userid = Login::isLoggedIn();
                        
						  $like="";
						$id=$_POST['liking'];
						$reciever = DB::query('SELECT user_id FROM post WHERE id=:id',array(':id'=>$id))[0]['user_id'];

						if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',array(':postid'=>$id,':userid'=>$userid))){

							
							DB::query('UPDATE post SET likes =likes+1 WHERE id =:postid' ,array(':postid'=>$id));
							if($reciever!=$userid){
 
							DB::query('INSERT INTO notifications VALUES (\'\',:sender,:reciever,:imp_id,1,:time,"NO")',array(':sender'=>$userid,':time'=>$time,':reciever'=>$reciever,':imp_id'=>$id));

						}

						DB::query('INSERT INTO post_likes VALUES(\'\',:postid,:userid)',array(':postid'=>$id,':userid'=>$userid));
						$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
						$likeStat = "Liked";
						$likeCol = "#787878";
						$likeArr = array($like);
						$likeStatArr =  array($likeStat);
						$likeColArr =  array($likeCol);
						$Data = [$likeArr,$likeStatArr,$likeColArr];

						echo json_encode($Data);

						
					
					}
						else {
								if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$reciever = DB::query('SELECT user_id FROM post WHERE id=:id',array(':id'=>$id))[0]['user_id'];
if($reciever!=$userid){
	DB::query('DELETE FROM notifications WHERE sender_id=:sender AND imp_id=:imp_id AND notification = 1',array(':sender'=>$userid,':imp_id'=>$id));

						}
							DB::query('UPDATE post SET likes =likes-1 WHERE id =:postid' ,array(':postid'=>$id));
							DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid',array(':postid'=>$id,':userid'=>$userid));
							$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
						$likeStat = "Like";
						$likeCol = "#428BCA";
						$likeArr = array($like);
						$likeStatArr =  array($likeStat);
						$likeColArr =  array($likeCol);
							$Data = [$likeArr,$likeStatArr,$likeColArr];
						echo json_encode($Data);
					
						}


		}

//this like code is no longer in use
  if(isset($_POST['like']))
					{
						  $like="";
						$id=$_POST['like'];

						if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',array(':postid'=>$id,':userid'=>$userid))){
							DB::query('UPDATE post SET likes =likes+1 WHERE id =:postid' ,array(':postid'=>$id));
						DB::query('INSERT INTO post_likes VALUES(\'\',:postid,:userid)',array(':postid'=>$id,':userid'=>$userid));
						$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
						echo $like ;

						
					
					}
						else {
							$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
							echo $like;

					
						}
		}
			
  else if(isset($_POST['unlike']))
					{
						  $like="";
						$id=$_POST['unlike'];
						if(DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',array(':postid'=>$id,':userid'=>$userid))){
							DB::query('UPDATE post SET likes =likes-1 WHERE id =:postid' ,array(':postid'=>$id));
						DB::query('DELETE FROM post_likes WHERE post_id=:postid AND user_id=:userid',array(':postid'=>$id,':userid'=>$userid));
						$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
						echo  $like;
					
					}
						else {
							$like = DB::query('SELECT likes FROM post WHERE id=:postid',array(':postid'=>$id))[0]['likes'];
							echo $like;
					
						}
		}


/**
 * 
 * this code of subscribing author is currently using
 */

	if(isset($_POST['subscribing']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$userid2 =$_POST['subscribing'];
								
								$followerid= Login::isLoggedIn();
						if($userid2!=$followerid){
								if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid2,':followerid'=>$followerid))){

      DB::query('INSERT INTO notifications VALUES (\'\' , :sender,:reciever,:imp_id,2,:time,"NO")',array(':sender'=>$followerid,':time'=>$time,':reciever'=>$userid2,':imp_id'=>$userid2));

DB::query('INSERT INTO followers VALUES (\'\' , :userid,:followerid)',array(':userid'=>$userid2,':followerid'=>$followerid));

DB::query('UPDATE user_details SET subscribers = subscribers+1 WHERE user_id=:userid' ,array(':userid'=>$userid2));

$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];


                        $subsStat = "Subscribed";
						$subCol = "#996633";;
						$dem10 = array($subs);
						$subStatArr =  array($subsStat);
						$subColArr =  array($subCol);

						$Data = [$dem10,$subStatArr,$subColArr];

echo json_encode($Data);		
								}
								
						else {

								if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								DB::query('DELETE FROM notifications  WHERE sender_id=:sender AND reciever_id=:reciever AND notification = 2',array(':reciever'=>$userid2,':sender'=>$followerid));

								//delteing notifications that this author published article

								DB::query('DELETE FROM notifications  WHERE sender_id=:sender AND reciever_id=:reciever AND notification = 7',array(':reciever'=>$followerid,':sender'=>$userid2));

				DB::query('DELETE FROM followers  WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid2,':followerid'=>$followerid));
									DB::query('UPDATE user_details SET subscribers =subscribers-1 WHERE user_id=:userid' ,array(':userid'=>$userid2));
$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
                 
                        $subsStat = "Subscribe";
						$subCol = "#ff0066";;
						$dem10 = array($subs);
						$subStatArr =  array($subsStat);
						$subColArr =  array($subCol);

						$Data = [$dem10,$subStatArr,$subColArr];

echo json_encode($Data);
                 		}
								

							}

else {
	echo "Can not Follow";
}
							}






// this code of subscribe is not in use

	if(isset($_POST['subs']))
							{
								$userid2 =$_POST['subs'];
								
								$followerid= Login::isLoggedIn();
						if($userid2!=$followerid){
								if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid2,':followerid'=>$followerid))){
DB::query('INSERT INTO followers VALUES (\'\' , :userid,:followerid)',array(':userid'=>$userid2,':followerid'=>$followerid));
	DB::query('UPDATE user_details SET subscribers = subscribers+1 WHERE user_id=:userid' ,array(':userid'=>$userid2));

$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
echo $subs;

									
								}
								
						else {
							$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
echo $subs;
					
						}
								

							}

else {
	echo "Can not Follow";
}
							}

	else if(isset($_POST['unsubs']))
							{
								$userid2 =$_POST['unsubs'];
							
								$followerid= Login::isLoggedIn();
						if($userid2!=$followerid){
								if(DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND  follower_id=:followerid',array(':userid'=>$userid2,':followerid'=>$followerid))){
									DB::query('DELETE FROM followers  WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid2,':followerid'=>$followerid));
									DB::query('UPDATE user_details SET subscribers =subscribers-1 WHERE user_id=:userid' ,array(':userid'=>$userid2));
$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
                   echo $subs;
								}
								else{
									$subs = DB::query('SELECT subscribers FROM user_details WHERE user_id=:userid',array(':userid'=>$userid2))[0]['subscribers'];
echo $subs;
								}
							
							}
							else{
								echo "Can not unfollow";
							}
							}
							/**
							code for views of a post

							*/

								if(isset($_POST['read']))
							{
								$postid3 =$_POST['read'];
								
								$userid4= Login::isLoggedIn();
						
if(!DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid4,':postid'=>$postid3))){
DB::query('INSERT INTO viewdposts VALUES (\'\' , :userid,:postid)',array(':userid'=>$userid4,':postid'=>$postid3));
	DB::query('UPDATE post SET views = views+1 WHERE id=:postid' ,array(':postid'=>$postid3));

$views = DB::query('SELECT views FROM post WHERE id=:postid',array(':postid'=>$postid3))[0]['views'];
$dem = array($views);

echo json_encode($dem);

							}		
								
						else		
						 {
							$views = DB::query('SELECT views FROM post WHERE id=:postid',array(':postid'=>$postid3))[0]['views'];
$dem = array($views);

echo json_encode($dem);
							
						}
						}	



						/*
						Ajax code for saving posts
						*/
							if(isset($_POST['save']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$postid4 =$_POST['save'];
								
								$userid6= Login::isLoggedIn();
if(DB::query('SELECT id FROM post WHERE  id=:postid',array(':postid'=>$postid4)))
{						
if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid6,':postid'=>$postid4)))
{
						


DB::query('INSERT INTO savedposts VALUES (\'\' , :userid,:postid)',array(':userid'=>$userid6,':postid'=>$postid4));
	
	$dem11 = array("Saved");

echo json_encode($dem11);

							
					}		
								
						else		
						 {
								$dem11 = array("Saved");

echo json_encode($dem11);
							
						}
					}else		
						 {
								$dem11 = array("Can't save");

echo json_encode($dem11);
							
						}

						}

/*
  sending feedbacks about website
*/

if(isset($_POST['web_feedback'])){

		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	



	$giver = $_POST['giver'];
	$feedback = $_POST['web_feedback'];

	DB::query('INSERT INTO website_feedback VALUES(\'\' , :giver,:feedback,0,"NO")',array(':giver'=>$giver,':feedback'=>$feedback));

	
}


/*
  sending feedbacks about website ends
*/
						/*
						ajax code for removing saved posts
						*/

						if(isset($_POST['empty']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								
								
								$userid6= Login::isLoggedIn();
						
if(DB::query('SELECT post_id FROM savedposts WHERE user_id=:userid',array(':userid'=>$userid6))){
DB::query('DELETE FROM savedposts WHERE user_id=:userid',array('userid'=>$userid6));
	

echo "Deleted";

							}		
								
						else		
						 {
							echo "There is no posts to delete";
							
						}
						}




						/*
						ajax code for deleting posts
						*/
						if(isset($_POST['delete']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$postid7 = $_POST['delete'];

	$publishDateOfPost = DB::query('SELECT posted_at FROM post WHERE id = :id',array(':id'=>$postid7))[0]['posted_at'];
								
								$userid6= Login::isLoggedIn();


		
DB::query('DELETE FROM post WHERE id=:postid ',array(':postid'=>$postid7));

// delete feedbacks given on this post
DB::query('DELETE FROM postfeedback WHERE post_id=:id',array(':id'=>$postid7));

//deleting all notifications that someone submitted a feedback on your article
DB::query('DELETE FROM notifications WHERE reciever_id = :reciever AND imp_id = :imp_id AND notification = 5 ',array(':reciever'=>$userid6,':imp_id'=>$postid7));
// submitted all notifications that you replied on someones article
DB::query('DELETE FROM notifications WHERE sender_id = :sender AND imp_id = :imp_id AND notification = 6 ',array(':sender'=>$userid6,':imp_id'=>$postid7));

//deleting notifications that somebody liked your articles
DB::query('DELETE FROM notifications WHERE reciever_id = :reciever AND imp_id = :imp_id AND notification = 1 ',array(':reciever'=>$userid6,':imp_id'=>$postid7));

//update noOfPost in userdetails minus 1

DB::query('UPDATE user_details SET noOfPosts  =  noOfPosts-1 WHERE user_id = :id',array(':id'=>$userid6));

//deleteing article id from post_likes

DB::query('DELETE FROM post_likes WHERE post_id = :id',array(':id'=>$postid7));

//deleteing article id from viewd posts

DB::query('DELETE FROM viewdposts WHERE viewd_post = :id',array(':id'=>$postid7));

//deleting notification that author published nwe articles

DB::query('DELETE FROM notifications WHERE notification = 7 AND imp_id= :impid AND sender_id = :sender',array(':impid'=>$postid7,':sender'=>$userid6));
	



echo "Deleted";

							}	




						/*ajax code for Search box queries for searching articles
  */


   if(!empty($_POST['query']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

		function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$query_arr = array();
                         	$query = test_input($_POST['query']);
                
if(DB::query('SELECT title FROM post WHERE title LIKE :title',array(':title'=>'%'.$_POST['query'].'%'))){
					
$Data = DB::query('SELECT title,id FROM post WHERE title LIKE :title LIMIT 9',array(':title'=>'%'.$_POST['query'].'%'));



}else{
	$Data = "";
}
												
   

   echo json_encode($Data);
													
												}

 





						



/*ajax code for Search box queries for searching channels

						*/

						if(!empty(isset($_POST['query2'])))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

		function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

                         	$query2 = test_input($_POST['query2']);
                

					if(!empty($query2)){

								$searchData = explode(" ", $query2);

					$whereclause = " ";

					$paramArray = array(':query'=>'%'.$_POST['query2'].'%');

						for($i=0;$i<count($searchData);$i++){

						        if($i%40==0){

						 $whereclause.="OR channelsetup.channelName LIKE :p$i";
						  $paramArray[":p$i"] = $searchData[$i];


						$Data = DB::query('SELECT channelsetup.channelName,channelsetup.user_id FROM channelsetup  WHERE
  channelsetup.channelName LIKE :query 
 '.$whereclause.' LIMIT 10',$paramArray);
													echo json_encode($Data);

												}

													
												}

						}


}




/*
ajax code for Search box queries for searching auhtors

						*/

						if(!empty(isset($_POST['query3'])))
							{


									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

		function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

                         	$query = test_input($_POST['query3']);
                
if(DB::query('SELECT authorName FROM channelsetup WHERE authorName LIKE :authorName',array(':authorName'=>'%'.$_POST['query3'].'%'))){
					
$Data = DB::query('SELECT * FROM channelsetup WHERE authorName LIKE :authorName LIMIT 10',array(':authorName'=>'%'.$_POST['query3'].'%'));
}else{
	$Data = "";
}
												
   

   echo json_encode($Data);
													


}







                               	/*code for notIntrstd posts.
                               	*/
						if(isset($_POST['notIntrstd']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$postid8 = $_POST['notIntrstd'];

								$userid6= Login::isLoggedIn();
								if(!DB::query('SELECT userid FROM notintrsd WHERE userid=:userid AND postid=:id',array(':userid'=>$userid6,':id'=>$postid8))){

DB::query('INSERT INTO notintrsd VALUES(\'\',:userid,:postid)',array(':postid'=>$postid8,':userid'=>$userid6));

echo "none";
}else{
	echo "none";
}
							}	


// code for notification are seen or not

						if(isset($_POST['notif']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$userid100 = Login::isLoggedIn();
								
   DB::query('UPDATE notifications SET status = "YES" WHERE reciever_id=:userid' ,array(':userid'=>$userid100));

   echo "dnke";

							}	




// for notifications being mark all as read

						if(isset($_POST['clear_notification']))
							{
								
								if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$userid = Login::isLoggedIn();

   DB::query('DELETE FROM  notifications WHERE  reciever_id = :userid' ,array(':userid'=>$userid));


							}	


// getting notification count

						if(isset($_POST['geTnoti']))
							{
		
		 $s1 = "NO";
  $s2 = "YES";
  $userid15 = Login::isLoggedIn();
$Status = DB::query('SELECT status FROM notifications WHERE reciever_id =:userid AND status=:s',array(':userid'=>$userid15,':s'=>$s1));
echo count($Status);

							}	



/*
for asking a question */
           if(isset($_POST['reciever']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

	function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	
								$reciever =$_POST['reciever'];
								$question=test_input($_POST['question']);
								
$question_snippet = substr($question,0,50);
								$userid6= Login::isLoggedIn();

$a="Not answered yet.";

if(!DB::query('SELECT  blocked FROM block_chat WHERE blocked=:blocked AND blocker=:blocker',array(':blocked'=>$userid6,':blocker'=>$reciever))){
DB::query('INSERT INTO asktoauthor VALUES(\'\',:sender,:reciever,:question,:answer,:time,"NO","NO")',array(':sender'=>$userid6,':time'=>$time,':reciever'=>$reciever,':question'=>$question,':answer'=>$a));

DB::query('INSERT INTO notifications VALUES(\'\',:sender,:reciever,:imp_id,3,:time,"NO")',array(':sender'=>$userid6,':reciever'=>$reciever,':imp_id'=>$question_snippet,':time'=>$time));

echo "success";
}

							}	
/*
for answering a question */
           if(isset($_POST['asker']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$id =$_POST['asker'];
								
				
								$answer = $_POST['answer'];


$question = DB::query('SELECT question FROM asktoauthor WHERE id=:id',array(':id'=>$id))[0]['question'];
$asker = DB::query('SELECT sender FROM asktoauthor WHERE id=:id',array(':id'=>$id))[0]['sender'];
								$userid6= Login::isLoggedIn();


								$question_snippet = substr($question,0,50);


DB::query('UPDATE  asktoauthor SET answer = :answer , status1 = "YES" ,status2="NO", asked_at=:time WHERE id=:question_id',array(':time'=>$time,':question_id'=>$id,':answer'=>$answer));




if(!DB::query('SELECT id FROM  notifications WHERE sender_id = :sender AND reciever_id = :reciever  AND notification = 4 AND imp_id = :imp_id ' ,array(':sender'=>$userid6,':reciever'=>$asker,':imp_id'=>$question_snippet))){

DB::query('INSERT INTO notifications VALUES(\'\',:sender,:reciever,:imp_id,4,:time,"NO")',array(':sender'=>$userid6,':time'=>$time,':reciever'=>$asker,':imp_id'=>$question_snippet));
}else{

	DB::query('UPDATE notifications SET get_at =:time , status= "NO"  WHERE sender_id = :sender AND reciever_id = :reciever AND imp_id =:imp_id',array(':time'=>$time,':sender'=>$userid6,':reciever'=>$asker,':imp_id'=>$question_snippet));

}
echo "success";

							}


//for updating seen staus for chat feature of replier side
if(isset($_POST['status']))
                     {
                     		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								$userid6= Login::isLoggedIn();

DB::query('UPDATE  asktoauthor SET  status1 = "YES"  WHERE reciever=:answerer',array(':answerer'=>$userid6));

echo "success";

                              }	

// for updating seen stautus in chat feature for sender side
if(isset($_POST['Statuses']))
                     {
                     		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								$userid6= Login::isLoggedIn();

DB::query('UPDATE  asktoauthor SET  status2 = "YES"  WHERE sender=:sender',array(':sender'=>$userid6));

echo "success";

							}


/*
for deleting a question asked to you */
           if(isset($_POST['Asker']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$id =$_POST['Asker'];



$question = DB::query('SELECT question FROM asktoauthor WHERE id=:id',array(':id'=>$id))[0]['question'];

$asker = DB::query('SELECT sender FROM asktoauthor WHERE id=:id',array(':id'=>$id))[0]['sender'];

								

								

								$userid6= Login::isLoggedIn();

								$question_snippet = substr($question,0,50);

DB::query('DELETE FROM  asktoauthor  WHERE id=:id',array(':id'=>$id));

//deleting a notification from asked to you section type3
DB::query('DELETE FROM  notifications  WHERE sender_id=:asker AND imp_id=:question AND reciever_id=:answerer AND notification = 3',array(':asker'=>$asker,':answerer'=>$userid6,':question'=>$question_snippet));
DB::query('DELETE FROM  notifications  WHERE sender_id=:asker AND imp_id=:question AND reciever_id=:answerer AND notification = 4',array(':asker'=>$userid6,':answerer'=>$asker,':question'=>$question_snippet));




echo "success";

							}	



						
/*
for submiting a feedback */
           if(isset($_POST['Reciever']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


	function test_input($data) {

  $data = trim($data);

  $data = stripslashes($data);

  $data = htmlspecialchars($data);
  
  return $data;

}
	
									$reciever =$_POST['Reciever'];
								$feedback = test_input($_POST['feedback']);
								$postid = $_POST['postid'];

								$userid6= Login::isLoggedIn();

$r="Not answered yet.";
$f="got new feedbacks.";
if(DB::query('SELECT snooz FROM post WHERE snooz="NO" AND id=:postid AND user_id=:userid',array(':postid'=>$postid,':userid'=>$reciever))){

if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid6,':blocker'=>$reciever)))
	if(!DB::query('SELECT sender FROM postfeedback WHERE sender =:sender AND reciever=:reciever AND post_id=:id',array(':sender'=>$userid6,':reciever'=>$reciever,':id'=>$postid))){

{

DB::query('INSERT INTO postfeedback VALUES(\'\',:sender,:reciever,:postid,:feedback,:reply,"NO","NO",:time)',array(':sender'=>$userid6,':time'=>$time,':reciever'=>$reciever,':postid'=>$postid,':feedback'=>$feedback,':reply'=>$r));


// inserting notification of feedback giving
DB::query('INSERT INTO notifications VALUES(\'\',:sender,:reciever,:imp_id,5,:time,"NO")',array(':sender'=>$userid6,':time'=>$time,':reciever'=>$reciever,':imp_id'=>$postid));


echo "success";
}
						}	
}
					}	




/*
for answering a feedback */
           if(isset($_POST['feedbacker']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


                     $id = $_POST['feedbacker'];
								
							
								$reply = $_POST['reply'];

                $postid30 = DB::query('SELECT post_id FROM postfeedback WHERE id= :id',array(':id'=>$id))[0]['id'];
	$feedbacker = DB::query('SELECT sender FROM postfeedback WHERE id = :id',array(':id'=>$id))[0]['sender'];		

								$userid6= Login::isLoggedIn();



DB::query('UPDATE  postfeedback SET reply = :reply ,time_at= :time,seen1="YES",seen2="NO" WHERE id=:id',array(':id'=>$id,':reply'=>$reply,':time'=>$time));

// inserting notification of feedback answer giving
if(!DB::query('SELECT id FROM notifications WHERE sender_id = :sender AND reciever_id = :reciever AND imp_id = :imp_id AND notification = 6',array(':sender'=>$userid6,':reciever'=>$feedbacker,':imp_id'=>$postid30 ))){

DB::query('INSERT INTO notifications VALUES(\'\',:sender,:reciever,:imp_id,6,:time,"NO")',array(':sender'=>$userid6,':reciever'=>$feedbacker,':imp_id'=>$postid30,':time'=>$time));

}else{

	DB::query('UPDATE notifications SET get_at = :time , status = "NO" WHERE sender_id = :sender AND reciever_id = :reciever AND imp_id = :imp_id',array(':time'=>$time,':sender'=>$userid6,':reciever'=>$feedbacker,':imp_id'=>$postid30));

}
echo "success";



							}	

							

//for updating seen status for feedback feature of replier side
if(isset($_POST['seen1']))
                     {

	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$userid6 = Login::isLoggedIn();

DB::query('UPDATE  postfeedback SET  seen1 = "YES"  WHERE reciever=:answerer',array(':answerer'=>$userid6));

echo "success";

							}	

// for updating seen stautus in chat feature for sender side
if(isset($_POST['seen2']))
                     {

								$userid6= Login::isLoggedIn();

DB::query('UPDATE  postfeedback SET  seen2 = "YES"  WHERE sender=:sender',array(':sender'=>$userid6));

echo "success";

							}



/*
for blocking an author to give feedback*/
           if(isset($_POST['blocked']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$blockedAuthor =$_POST['blocked'];
								
								$userid6= Login::isLoggedIn();

				DB::query('INSERT INTO blocked_author_feedback VALUES(\'\',:blockedAuthor,:blocker)',array(':blockedAuthor'=>$blockedAuthor,':blocker'=>$userid6));

DB::query('DELETE FROM  postfeedback  WHERE sender=:blockedAuthor AND reciever=:blocker', array(':blockedAuthor'=>$blockedAuthor,':blocker'=>$userid6));

DB::query('DELETE FROM  notifications WHERE sender_id=:sender AND reciever_id=:reciever AND notification=6', array(':reciever'=>$blockedAuthor,':sender'=>$userid6));

DB::query('DELETE FROM  notifications  WHERE sender_id=:sender AND reciever_id=:reciever AND notification = 5', array(':sender'=>$blockedAuthor,':reciever'=>$userid6));



echo "success";

							}		





/*
for  blocking chats from an author*/
           if(isset($_POST['Blocked']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$blocked =$_POST['Blocked'];
								
								$userid6= Login::isLoggedIn();

				DB::query('INSERT INTO block_chat VALUES(\'\',:blocked,:blocker)',array(':blocked'=>$blocked,':blocker'=>$userid6));

DB::query('DELETE FROM  asktoauthor  WHERE sender=:blocked AND reciever=:blocker', array(':blocked'=>$blocked,':blocker'=>$userid6));

DB::query('DELETE FROM  notifications  WHERE sender_id=:blocked AND reciever_id=:blocker AND notification = 3', array(':blocked'=>$blocked,':blocker'=>$userid6));


DB::query('DELETE FROM  notifications  WHERE sender_id=:blocker AND reciever_id=:blocked AND notification = 4', array(':blocked'=>$blocked,':blocker'=>$userid6));

echo "success";

							}	




							/*
							snooz feedbacks for a particular post ajx code*/



							if(isset($_POST['snoozing'])){

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
								$userid6= Login::isLoggedIn();

                               $snoozPost = $_POST['snoozing'];
                               if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO"',array(':postid'=>$snoozPost,':userid'=>$userid6))){

                                  $s="YES";
                                  DB::query('UPDATE post SET snooz =:s WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6,':s'=>$s));
                                  $snoozValArr = array("feedbacks are snoozed");
                                  $snoozDispArr = array("block");
                                  $Data = [$snoozValArr,$snoozDispArr];
                                  echo json_encode($Data);
                                  

                               }else{
                               	 $s= "NO";
                             
                               if(DB::query('SELECT id FROM post WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6))){

                                  
                                  DB::query('UPDATE post SET snooz =:s WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6,':s'=>$s));
                                  $snoozValArr = array("snooz feedbacks");
                                  $snoozDispArr = array("none");
                                  $Data = [$snoozValArr,$snoozDispArr];
                                  echo json_encode($Data);

                               }
                               }

							}




							if(isset($_POST['snooz'])){

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$s="YES";
								$userid6= Login::isLoggedIn();

                               $snoozPost = $_POST['snooz'];
                               if(DB::query('SELECT id FROM post WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6))){

                                  
                                  DB::query('UPDATE post SET snooz =:s WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6,':s'=>$s));
                                  echo "feedbacks are snoozed";

                               }

							}	


								/*
							unsnooz feedbacks for a particular post ajx code*/

							if(isset($_POST['unsnooz'])){
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								$userid6= Login::isLoggedIn();
                              $s= "NO";
                               $snoozPost = $_POST['unsnooz'];
                               if(DB::query('SELECT id FROM post WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6))){

                                  
                                  DB::query('UPDATE post SET snooz =:s WHERE id=:postid AND user_id=:userid',array(':postid'=>$snoozPost,':userid'=>$userid6,':s'=>$s));
                                  echo "snooz feedbacks";

                               }

							}	



							/*
deleting feedback gived on your posts 
							*/



           if(isset($_POST['Dfeedbacker']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								$id = $_POST['Dfeedbacker'];
								

								$feedbacker = DB::query('SELECT sender FROM postfeedback WHERE id = :id',array(':id'=>$id))[0]['sender'];
								

							
								
								$postid =  DB::query('SELECT post_id FROM postfeedback WHERE id = :id',array(':id'=>$id))[0]['post_id'];

									$userid6= Login::isLoggedIn();

DB::query('DELETE FROM  postfeedback  WHERE id = :id',array(':id'=>$id));

// delete notifications that you have feedbacks on your articles

DB::query('DELETE FROM  notifications  WHERE sender_id=:sender AND reciever_id=:reciever AND notification = 5 AND imp_id = :id', array(':sender'=>$feedbacker,':reciever'=>$userid6,':id'=>$postid));

// delete notifications that author replied on your feedbacks 

DB::query('DELETE FROM  notifications  WHERE sender_id=:sender AND reciever_id=:reciever AND notification = 6 AND imp_id = :id', array(':sender'=>$userid6,':reciever'=>$feedbacker,':id'=>$postid));

echo "success";

							}	



		/*
		for cleaning all feedbacks given by you*/					
           if(isset($_POST['delall']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								
								$userid6= Login::isLoggedIn();

DB::query('DELETE FROM  postfeedback  WHERE sender=:feedbacker',array(':feedbacker'=>$userid6));

// delete notifications that you have feedbacks on your articles

DB::query('DELETE FROM  notifications  WHERE sender_id=:sender  AND notification = 5', array(':sender'=>$userid6));

// delete notifications that author replied on your feedbacks 

DB::query('DELETE FROM  notifications  WHERE reciever_id=:reciever AND notification = 6', array(':reciever'=>$userid6));

echo "success";

							}	




/*
deleting a particular chat asked by you
							*/



           if(isset($_POST['replier']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


								 $id = $_POST['replier'];

								 $replier = DB::query('SELECT reciever FROM asktoauthor WHERE id= :id',array(':id'=>$id))[0]['reciever'];

								
								$question=DB::query('SELECT question FROM asktoauthor WHERE id = :id',array(':id'=>$id))[0]['question'];


								$question_snippet = substr($question,0,50);
							
								$userid6= Login::isLoggedIn();

DB::query('DELETE FROM  asktoauthor  WHERE id = :id',array(':id'=>$id));

DB::query('DELETE FROM  notifications  WHERE sender_id=:asker AND imp_id=:question AND reciever_id = :reciever AND notification = 3',array(':reciever'=>$replier,':question'=>$question_snippet,':asker'=>$userid6));

DB::query('DELETE FROM  notifications  WHERE sender_id=:sender AND imp_id=:answer AND reciever_id=:reciever AND notification = 4',array(':sender'=>$replier,':reciever'=>$userid6,':answer'=>$question_snippet));


echo "success";

							}	




			// unblock feedbacks				
           if(isset($_POST['unblockFeedbacks']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$blocked =$_POST['unblockFeedbacks'];
							$userid6= Login::isLoggedIn();

DB::query('DELETE FROM  blocked_author_feedback  WHERE blocked_author=:blocked AND blocker = :blocker',array(':blocker'=>$userid6,':blocked'=>$blocked));

echo "success";

							}	

								// unblock questions				
           if(isset($_POST['unblockQuestion']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$blocked =$_POST['unblockQuestion'];
							$userid6= Login::isLoggedIn();

DB::query('DELETE FROM  block_chat  WHERE blocked=:blocked AND blocker = :blocker',array(':blocker'=>$userid6,':blocked'=>$blocked));

echo "success";

							}


							//for changing password
							if(isset($_POST['oldPass'])){

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

								$oldPass = $_POST['oldPass'];
								$newPass = $_POST['newPass'];
                                $userid6 = Login::isLoggedIn();

								if(password_verify($oldPass, DB::query('SELECT password FROM signup WHERE id=:userid ',array(':userid'=>$userid6))[0]['password'])){

DB::query('UPDATE signup SET password = :password , password2 = :password WHERE id=:userid',array(':password'=>password_hash($newPass,PASSWORD_BCRYPT),':password'=>password_hash($newPass,PASSWORD_BCRYPT),':userid'=>$userid6));
echo "password has changed";
								}
                                 else{
                                 	echo "incorrect password";
                                 }
							}

// ajax code for reporting any particular article
							if(isset($_POST['reportt']))

							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
					

								$postid10 = $_POST['postId'];
                                $userid6 = Login::isLoggedIn();
								$reportedAuthor = $_POST['authorId'];
								$report = $_POST['reportt'];
								$report_info = $_POST['report_info'];

								$status = "Review is pending !";

if(DB::query('SELECT id FROM post WHERE user_id=:userid AND id=:postid',array(':userid'=>$reportedAuthor,':postid'=>$postid10))){
 								if(!DB::query('SELECT post_id FROM reportarticle WHERE reporter_id = :reporter AND post_id = :postid',array(':reporter'=>$userid6,':postid'=>$postid10)))
{

		$title = DB::query('SELECT title FROM post WHERE id = :id',array(':id'=>$postid10))[0]['title'];

DB::query('INSERT INTO reportarticle VALUES(\'\',:postid,:authorid,:reporterId,:report,:report_info,:title,:status)',array(':postid'=>$postid10,':authorid'=>$reportedAuthor,':report'=>$report,':reporterId'=>$userid6,':report_info'=>$report_info,':title'=>$title,':status'=>$status));
  DB::query('UPDATE post SET totalReports = totalReports +1 WHERE id=:postid ',array(':postid'=>$postid10));

echo "Successfully reported this article";

}else{
echo "You have already report this article"	;						
}
}else{
	echo "can't report this article"	;
}
}	





//ajax code for getting articles in home feds

if(isset($_POST['demonstration']))
							{

	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
$limit = $_POST['demonstration'];

$f = 0;

$userid5 = Login::isLoggedIn();

$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();
$reportArr =array();
  $intrstdArr =array();
  $suggetionStatArr=array();
  $statusArr  =  array();
$followingposts="";


 if(DB::query('SELECT follwingTopics FROM user_details WHERE user_id=:id',array(':id'=>$userid5))[0]['follwingTopics'] == ""){
 
$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,

	post.title,

post.description,post.Topics,post.views,post.postRank,post.keywords FROM  post WHERE post.Topics = "intro"  LIMIT 1
 OFFSET '.$limit.' ',array()); 

 }else{

$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,

	post.title,

post.description,post.Topics,post.views,post.postRank,user_details.follwingTopics,post.keywords FROM  post 

INNER JOIN user_details ON 

 user_details.follwingTopics LIKE  concat("%",post.Topics,"%")


 WHERE  user_details.user_id = :userid 

 ORDER BY post.posted_at DESC
 LIMIT 5
 OFFSET '.$limit.'',array(':userid'=>$userid5));

}

						

foreach ($followingposts as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];


$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";


  // for getting publishing date
  $status =  current::Time($posted_at);

  $dem22 = array($status);

  $statusArr = array_merge($statusArr,$dem22);


//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
	$authorStrength = author::strength($userid);
$dem8 = array($authorStrength);

$authorStrengthArr = array_merge($authorStrengthArr,$dem8);


//calculating article strength
				article::strength($id);

//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:" class="subsBtn2">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){
      if(!DB::query('SELECT sender FROM postfeedback WHERE sender =:sender AND reciever=:reciever AND post_id=:id',array(':sender'=>$userid5,':reciever'=>$userid,':id'=>$id))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:20%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:22%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

}else{
	$giveFeedback="";
}
        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);

$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for report permission only to the user
	if($userid==$userid5){
		

		$report = "";
	}else{
	

$report = '<a class="dropdown-item" data-toggle="modal" data-target="#reportArticle'.$id.'"  href="#"  style="display:block"><h3 style="font-size:15px">Report</h3></a><a class="dropdown-item" notIntrstd-id='.$id.' href="#"  ><h3 style="font-size:15px">Not intrested</h3></a>';
	}

$dem16 = array($report);


	$reportArr = array_merge($reportArr,$dem16);


	// for hiding notintrsted articles
	if(DB::query('SELECT postid FROM notintrsd WHERE postid=:postid AND userid=:userid',array(':userid'=>$userid5,':postid'=>$id))){
    $intrstd = "none";
  }
  else{
    $intrstd="block";
  }

  $dem17 = array($intrstd);
  $intrstdArr = array_merge($intrstdArr,$dem17);


//code for keyword feature

  $keyword_data = explode(" " ,$keywords);
  $keyword_index1 = rand(0,(count($keyword_data)-1));
  $keyword1 = $keyword_data[$keyword_index1];
 if(DB::query('SELECT id FROM post WHERE keywords LIKE :keyword 
 	AND Topics = :topics
 	 ',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics))){
 $suggetion = DB::query('SELECT id FROM post WHERE keywords LIKE :keyword AND Topics = :topics 
',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics));
 $suggetion_index = rand(0,(count($suggetion)-1));
 $suggetion_id =$suggetion[$suggetion_index];

 $suggetion_title = DB::query('SELECT title FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]))[0]['title'];
 $userid12 = "";
 $postrank = "";
 $suggetion_author_id = DB::query('SELECT user_id,postRank FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]));
foreach ($suggetion_author_id as $Data2) {

  $userid12 = $Data2['user_id'];
  $postrank = $Data2['postRank'];

}

 $suggetion_data = DB::query('SELECT authorName,channelName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$userid12));
 $autorname11 = "";
 $channelname11="";
  foreach ($suggetion_data as $Data3) {

   $authorname11 = $Data3['authorName'];
   $channelname11 = $Data3['channelName'];
  
 }


 if($suggetion_id[0] != $id){
	$suggetionFeature = '<hr style="margin-top:50px"> <u><h2 style="font-size:20px;font-family:Baloo Bhai;color:red;margin-top:-10px">You might also like </h2></u> <a href="read.php?q='.$suggetion_id[0].'"><div  class="img-thumbnail" style="width:100%;position:relative;height:auto;background-color:#e0ebeb;font-size:15px;margin-bottom:-60px"><p style="float:right;margin-right:10px"><b>'.$postrank.'</b></p><p style="font-family:Merriweather;margin-left:10px;color:#3333ff"><b>'.$channelname11.'</b> <hr style="margin-top:-8px"> <p style="font-size:16px;font-family:Merriweather;color:blue;margin-top:-8px;margin-left:10px">'.$suggetion_title.'  </p> <hr style="margin-top:-10px"> <p style="margin-top:-8px;margin-left:10px;font-size:15px"><b>written by :</b>'.$authorname11.' </p> </div> </a>';
}else{
	$suggetionFeature="";
}


$dem17 = array($suggetionFeature);
$suggetionStatArr = array_merge($suggetionStatArr,$dem17);

}




}


$Data = [$followingposts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr,$reportArr,$intrstdArr,$suggetionStatArr ,$statusArr];

echo json_encode($Data);
}




//ajax code for getting articles in home feds

if(isset($_POST['trending']))
							{

									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$limit = $_POST['trending'];
$f = 0;
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();

$reportArr =array();
  $intrstdArr =array();
 $statusArr = array();

$checkpoint = 10;
$trendingPosts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank FROM post
WHERE  post.postRank > :checkpoint

ORDER BY post.postRank DESC
 LIMIT 10
 OFFSET '.$limit.'',array(':checkpoint'=>$checkpoint));


foreach ($trendingPosts as $key) {

	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];



$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";

  $status =  current::Time($posted_at);
  $dem22 = array($status);
  $statusArr = array_merge($statusArr,$dem22);

author::strength($userid);
article::strength($id);
//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}


$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){

	$sub = '<button  type="button" subsBtn-id='.$userid.' class="subs'.$userid.' subsBtn2" style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:">'.$subsVal.'</button>';

}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){
              if(!DB::query('SELECT sender FROM postfeedback WHERE sender =:sender AND reciever=:reciever AND post_id=:id',array(':sender'=>$userid5,':reciever'=>$userid,':id'=>$id))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:20%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:22%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

       }else{
           $giveFeedback="";
       }
       }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	


}






$Data = [$trendingPosts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr ,$statusArr];

echo json_encode($Data);


}









//ajax code for getting articles in subscription feds

if(isset($_POST['subscription']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$limit = $_POST['subscription'];


$f = 0;
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();
$reportArr =array();
  $intrstdArr =array();
  $suggetionStatArr=array();
$statusArr = array();
      
$subscribedPosts = DB::query('SELECT post.id,post.body,post.title,post.titleImage,post.posted_at,post.likes,post.views,post.Topics,post.snooz , post.postRank , post.keywords,post.description , followers.user_id, followers.follower_id  FROM  post 
INNER JOIN followers ON 

 followers.user_id = post.user_id

 WHERE  followers.follower_id = :userid 

 ORDER BY post.posted_at DESC
 LIMIT 20 OFFSET '.$limit.'',array(':userid'=>$userid5));



						

foreach ($subscribedPosts as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];


$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";

  $status =  current::Time($posted_at);
  $dem22 = array($status);
  $statusArr = array_merge($statusArr,$dem22);


//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:"class="subsBtn2">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:23%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:22%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for delete permission only to the user
	if($userid==$userid5){
		

		$report = "";
	}else{
		

$report = '<a class="dropdown-item" data-toggle="modal" data-target="#reportArticle'.$id.'"  href="#"  style="display:block"><h3 style="font-size:15px">Report</h3></a><a class="dropdown-item" notIntrstd-id='.$id.' href="#"  ><h3 style="font-size:15px">Not intrested</h3></a>';
	}

$dem16 = array($report);
	

	$reportArr = array_merge($reportArr,$dem16);


	// for hiding notintrsted articles
	if(DB::query('SELECT postid FROM notintrsd WHERE postid=:postid AND userid=:userid',array(':userid'=>$userid5,':postid'=>$id))){
    $intrstd = "none";
  }
  else{
    $intrstd="block";
  }

  $dem17 = array($intrstd);
  $intrstdArr = array_merge($intrstdArr,$dem17);


//code for keyword feature

  $keyword_data = explode(" " ,$keywords);
  $keyword_index1 = rand(0,(count($keyword_data)-1));
  $keyword1 = $keyword_data[$keyword_index1];
 if(DB::query('SELECT id FROM post WHERE keywords LIKE :keyword 
 	AND Topics = :topics
 	 ',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics))){
 $suggetion = DB::query('SELECT id FROM post WHERE keywords LIKE :keyword AND Topics = :topics 
',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics));
 $suggetion_index = rand(0,(count($suggetion)-1));
 $suggetion_id =$suggetion[$suggetion_index];

 $suggetion_title = DB::query('SELECT title FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]))[0]['title'];
 $userid12 = "";
 $postrank = "";
 $suggetion_author_id = DB::query('SELECT user_id,postRank FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]));
foreach ($suggetion_author_id as $Data2) {

  $userid12 = $Data2['user_id'];
  $postrank = $Data2['postRank'];

}

 $suggetion_data = DB::query('SELECT authorName,channelName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$userid12));
 $autorname11 = "";
 $channelname11="";
  foreach ($suggetion_data as $Data3) {

   $authorname11 = $Data3['authorName'];
   $channelname11 = $Data3['channelName'];
  
 }


 if($suggetion_id[0] != $id){
	$suggetionFeature = '<hr style="margin-top:50px"> <u><h2 style="font-size:20px;font-family:Baloo Bhai;color:red;margin-top:-10px">You might also like </h2></u> <a href="read.php?q='.$suggetion_id[0].'"><div  class="img-thumbnail" style="width:100%;position:relative;height:auto;background-color:#e0ebeb;font-size:15px;margin-bottom:-60px"><p style="float:right;margin-right:10px"><b>'.$postrank.'</b></p><p style="font-family:Merriweather;margin-left:10px;color:#3333ff"><b>'.$channelname11.'</b> <hr style="margin-top:-8px"> <p style="font-size:16px;font-family:Merriweather;color:blue;margin-top:-8px;margin-left:10px">'.$suggetion_title.'  </p> <hr style="margin-top:-10px"> <p style="margin-top:-8px;margin-left:10px;font-size:15px"><b>written by :</b>'.$authorname11.' </p> </div> </a>';
}else{
	$suggetionFeature="";
}


$dem17 = array($suggetionFeature);
$suggetionStatArr = array_merge($suggetionStatArr,$dem17);

}




}


$Data = [$subscribedPosts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr,$reportArr,$intrstdArr,$suggetionStatArr,$statusArr ];

echo json_encode($Data);
}






//ajax code for getting articles in myProfile feeds

if(isset($_POST['myProfile']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$limit = $_POST['myProfile'];



$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();
$reportArr =array();

$statusArr = array();


$myProfilePosts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,post.description,post.Topics,post.views,post.postRank,post.keywords FROM post
 WHERE post.user_id=:userid
 ORDER BY post.posted_at DESC
 LIMIT 5 OFFSET '.$limit.'',array(':userid'=>$userid5));



						

foreach ($myProfilePosts as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];

	


$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";
 $m="";
$snoozVal="";

    

  $status =  current::Time($posted_at);
  $dem22 = array($status);
  $statusArr = array_merge($statusArr,$dem22);


author::strength($userid);
article::strength($id);
//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:20%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:22%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for delete permission only to the user
	if($userid==$userid5){
		$delete = '<a class="dropdown-item" delete-id='.$id.' href="#" ><h3 style="font-size:15px;style="">Delete</h3></a>';

		$report = "";
	}else{
		$delete="";

$report = '<a class="dropdown-item" data-toggle="modal" data-target="#reportArticle'.$id.'" href="#"  style="display:block"><h3 style="font-size:15px">Report</h3></a><a class="dropdown-item" notIntrstd-id='.$id.' href="#"  ><h3 style="font-size:15px">Not intrested</h3></a>';
	}

$dem16 = array($report);
	$dem15 = array($delete);
	$deleteArr = array_merge($deleteArr,$dem15);

	$reportArr = array_merge($reportArr,$dem16);


}


$Data = [$myProfilePosts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr,$deleteArr , $reportArr,$statusArr];

echo json_encode($Data);
}






//ajax code for getting articles in myProfile feeds

if(isset($_POST['otherProfile']))
							{

	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
$limit = $_POST['otherProfile'];
$userid2 = $_POST['userid'];

$f = 0;
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();
$reportArr =array();
 
 $statusArr = array();
  

$otherProfilePosts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
  post.description,post.Topics,post.views,post.postRank,post.keywords
 FROM post 
 WHERE post.user_id=:userid

  ORDER BY posted_at DESC
  LIMIT 5 OFFSET '.$limit.' ',array(':userid'=>$userid2));



						

foreach ($otherProfilePosts as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];
	


$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";


  $status =  current::Time($posted_at);
  $dem22 = array($status);
  $statusArr = array_merge($statusArr,$dem22);


author::strength($userid);
article::strength($id);
//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" class = "subs'.$userid.'  subsBtn2" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:20%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:22%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for delete permission only to the user
	if($userid==$userid5){
		

		$report = "";
	}else{
	

$report = '<a class="dropdown-item" data-toggle="modal" data-target="#reportArticle'.$id.'"  href="#"  style="display:block"><h3 style="font-size:15px">Report</h3></a><a class="dropdown-item" notIntrstd-id='.$id.' href="#"  ><h3 style="font-size:15px">Not intrested</h3></a>';
	}

$dem16 = array($report);
	

	$reportArr = array_merge($reportArr,$dem16);




}


$Data = [$otherProfilePosts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$snoozBtnArr,$giveFeedbackArr,$reportArr,$statusArr];

echo json_encode($Data);
}







//ajax code for getting articles in home feds

if(isset($_POST['readArticles']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

                                }	

$limit = $_POST['readArticles'];


$f = 0;
$readArticles="";
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();
$reportArr =array();
  $intrstdArr =array();
  $suggetionStatArr=array();

  $statusArr = array();

  $searchData = $_POST['data'];

  if(is_numeric($_POST['data'])){

$readArticles = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,

post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 

 post.id = :postid
 LIMIT 10 OFFSET '.$limit.'',array(':postid'=>$_POST['data'])); 
  }
  	else{
$readArticles = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank,post.keywords FROM post WHERE 
 post.title LIKE :body

 OR post.Topics LIKE :body
 OR post.description LIKE :body

   OR post.keywords LIKE :body
 ORDER BY post.postRank DESC
 LIMIT 5 OFFSET '.$limit.'
  '
  ,array(':body'=>'%'.$searchData.'%')); 
  	}




						

foreach ($readArticles as $key) {



	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];


$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";


  $status =  current::Time($posted_at);
  $dem22 =   array($status);
  $statusArr = array_merge($statusArr,$dem22);


author::strength($userid);
article::strength($id);
//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:" class="subsBtn2">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:50%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:50%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for delete permission only to the user
	if($userid==$userid5){
		

		$report = "";
	}else{
		
$report = '<a class="dropdown-item" data-toggle="modal" data-target="#reportArticle'.$id.'"  href="#"  style="display:block"><h3 style="font-size:15px">Report</h3></a><a class="dropdown-item" notIntrstd-id='.$id.' href="#"  ><h3 style="font-size:15px">Not intrested</h3></a>';
	}

$dem16 = array($report);
	
	

	$reportArr = array_merge($reportArr,$dem16);


	// for hiding notintrsted articles
	if(DB::query('SELECT postid FROM notintrsd WHERE postid=:postid AND userid=:userid',array(':userid'=>$userid5,':postid'=>$id))){
    $intrstd = "none";
  }
  else{
    $intrstd="block";
  }

  $dem17 = array($intrstd);
  $intrstdArr = array_merge($intrstdArr,$dem17);


//code for keyword feature

  $keyword_data = explode(" " ,$keywords);
  $keyword_index1 = rand(0,(count($keyword_data)-1));
  $keyword1 = $keyword_data[$keyword_index1];
 if(DB::query('SELECT id FROM post WHERE keywords LIKE :keyword 
 	AND Topics = :topics
 	 ',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics))){
 $suggetion = DB::query('SELECT id FROM post WHERE keywords LIKE :keyword AND Topics = :topics 
',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics));
 $suggetion_index = rand(0,(count($suggetion)-1));
 $suggetion_id =$suggetion[$suggetion_index];

 $suggetion_title = DB::query('SELECT title FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]))[0]['title'];
 $userid12 = "";
 $postrank = "";
 $suggetion_author_id = DB::query('SELECT user_id,postRank FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]));
foreach ($suggetion_author_id as $Data2) {

  $userid12 = $Data2['user_id'];
  $postrank = $Data2['postRank'];

}

 $suggetion_data = DB::query('SELECT authorName,channelName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$userid12));
 $autorname11 = "";
 $channelname11="";
  foreach ($suggetion_data as $Data3) {

   $authorname11 = $Data3['authorName'];
   $channelname11 = $Data3['channelName'];
  
 }


 if($suggetion_id[0] != $id){
	$suggetionFeature = '<hr style="margin-top:50px"> <u><h2 style="font-size:20px;font-family:Baloo Bhai;color:red;margin-top:-10px">You might also like </h2></u> <a href="read.php?q='.$suggetion_id[0].'"><div  class="img-thumbnail" style="width:100%;position:relative;height:auto;background-color:#e0ebeb;font-size:15px;margin-bottom:-60px"><p style="float:right;margin-right:10px"><b>'.$postrank.'</b></p><p style="font-family:Merriweather;margin-left:10px;color:#3333ff"><b>'.$channelname11.'</b> <hr style="margin-top:-8px"> <p style="font-size:16px;font-family:Merriweather;color:blue;margin-top:-8px;margin-left:10px">'.$suggetion_title.'  </p> <hr style="margin-top:-10px"> <p style="margin-top:-8px;margin-left:10px;font-size:15px"><b>written by :</b>'.$authorname11.' </p> </div> </a>';
}else{
	$suggetionFeature="";
}


$dem17 = array($suggetionFeature);
$suggetionStatArr = array_merge($suggetionStatArr,$dem17);

}




}


$Data = [$readArticles,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr,$reportArr,$suggetionStatArr,$statusArr ];

echo json_encode($Data);
}





// for displaying subscribers list
if(isset($_POST['subscribers_list'])){
		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$userid5 = $_POST['userid'];
$subsColArr = array();
$AuthorStrengthArr = array();
$subsValArr = array();
	$limit = $_POST['subscribers_list'];

	$subscribers = DB::query('SELECT channelsetup.authorName,channelsetup.channelName,channelsetup.user_id,channelsetup.channelImage FROM channelsetup
	INNER JOIN followers ON 

 followers.follower_id = channelsetup.user_id

 WHERE  followers.user_id = :userid

 LIMIT 10 OFFSET '.$limit.'',array(':userid'=>$userid5));

	foreach ($subscribers as $key) {
		$userid = $key['user_id'];

		author::strength($userid);

		//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

				$AuthorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :userid',array(':userid'=>$userid));
				$AuthorStrengthArr = array_merge($AuthorStrengthArr,$AuthorStrength);
								$dem9 = array($subsVal);
$subsValArr = array_merge($subsValArr,$dem9);
	$dem10 = array($subsColor);
$subsColArr = array_merge($subsColArr,$dem10);
	}

$Data = [$subscribers,$subsValArr,$subsColArr,$AuthorStrengthArr];
	echo json_encode($Data);
}




// for displaying subscribed list
if(isset($_POST['subscribed_list'])){
		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$userid5 = $_POST['userid'];
$subsColArr = array();
$AuthorStrengthArr = array();
$subsValArr = array();
	$limit = $_POST['subscribed_list'];

	$subscribers = DB::query('SELECT channelsetup.authorName,channelsetup.channelName,channelsetup.user_id ,channelsetup.channelImage FROM channelsetup
	INNER JOIN followers ON 

 followers.user_id = channelsetup.user_id

 WHERE  followers.follower_id = :userid

 LIMIT 10 OFFSET '.$limit.'',array(':userid'=>$userid5));

	foreach ($subscribers as $key) {
		$userid = $key['user_id'];
		//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

				$AuthorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :userid',array(':userid'=>$userid));
				$AuthorStrengthArr = array_merge($AuthorStrengthArr,$AuthorStrength);
								$dem9 = array($subsVal);
$subsValArr = array_merge($subsValArr,$dem9);
	$dem10 = array($subsColor);
$subsColArr = array_merge($subsColArr,$dem10);
	}

$Data = [$subscribers,$subsValArr,$subsColArr,$AuthorStrengthArr];
	echo json_encode($Data);
}






// showig saved articles

//ajax code for getting articles in home feds

if(isset($_POST['savedArticles']))
							{
									if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

$limit = $_POST['savedArticles'];


$f = 0;
$userid5 = Login::isLoggedIn();
$AuthData=array();
$likesVal=array();
$likesCol = array();
$viewValArr=array();
$viewColorArr=array();
$mArr = array();
$snoozValArr=array();
$saveValArr=array();
$authorStrengthArr=array();
$subBtnArr = array();
$snoozBtnArr=array();
$giveFeedbackArr =array();
$deleteArr=array();

  $intrstdArr =array();
  $suggetionStatArr=array();
  $statusArr = array();


    
$followingposts = DB::query('SELECT post.id, post.body, post.likes, post.posted_at,post.user_id,post.titleImage ,post.title,
post.description,post.Topics,post.views,post.postRank,post.keywords FROM post,savedposts
WHERE  post.id=savedposts.post_id
AND savedposts.user_id=:userid
ORDER BY post.views DESC
LIMIT 10 OFFSET '.$limit.'',array(':userid'=>$userid5));



						

foreach ($followingposts as $key) {
		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

	$userid = $key['user_id'];
	$body = $key['body'];
	$id = $key['id'];
	$likes = $key['likes'];
	$posted_at = $key['posted_at'];
	$titleImage= $key['titleImage'];
	$title = $key['title'];
	$description = $key['description'];
	$Topics = $key['Topics'];
	$views = $key['views'];
	$postRank = $key['postRank'];
	$keywords = $key['keywords'];

$likeValue="";
$likeColor="";
$viewVal="";
$viewColor="";
$saveVal="";

    $m="";
$snoozVal="";


  $status =  current::Time($posted_at);
  $dem22 = array($status);
  $statusArr = array_merge($statusArr,$dem22);


author::strength($userid);
article::strength($id);
//for getting author data
	$authorData = DB::query('SELECT channelsetup.authorName, channelsetup.channelName, channelsetup.channelImage,channelsetup.proffession
 FROM channelsetup
WHERE channelsetup.user_id = :userid ',array(':userid'=>$userid));
	
// for getting liking stat
if(!DB::query('SELECT user_id FROM post_likes WHERE post_id=:postid AND user_id=:userid',
						array(':postid'=>$id,':userid'=>$userid5))){
							
							$likeValue ="Like";
							 $likeColor = "none";
						}
						else {
							$likeValue ="Liked";
						 $likeColor = "#787878";
						}
						$dem1 = array($likeValue);
						$dem2 = array($likeColor);

$likesVal = array_merge($likesVal,$dem1);
$likesCol = array_merge($likesCol,$dem2);
$AuthData = array_merge($AuthData,$authorData);

// for getting viewd stat
if(DB::query('SELECT viewd_post FROM viewdposts WHERE viewd_post=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id)))
  {
    $viewVal = "viewed";
    $viewColor ="#787878";

  }
  else{
     $viewVal = "views";
    $viewColor ="none";
  }
  $dem3 = array($viewVal);
  $dem4 = array($viewColor);

  $viewColorArr = array_merge($viewColorArr,$dem3);
    $viewValArr = array_merge($viewValArr,$dem4);

    //snooze status

if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){


  $snoozVal = "snooz feedbacks";
  $m="none";
}else{
 $snoozVal = "feedbacks are snoozed";
 $m="block";
}
$dem5 = array($snoozVal);
$dem6 = array($m);

  $mArr = array_merge($mArr,$dem6);
    $snoozValArr = array_merge($snoozValArr,$dem5);


    // save or not saved status

if(!DB::query('SELECT post_id FROM savedposts WHERE post_id=:postid AND user_id=:userid',array(':userid'=>$userid5,':postid'=>$id))){
  $saveVal = "Save article";
}else{
   $saveVal = "Saved";
}

$dem7 = array($saveVal);

$saveValArr = array_merge($saveValArr,$dem7);

//getting author rank
$authorStrength = DB::query('SELECT authorRank FROM user_details WHERE user_id = :id',array(':id'=>$userid))[0]['authorRank'];
$dem8 = array($authorStrength);
$authorStrengthArr = array_merge($authorStrengthArr,$dem8);
//for subscribe buttin appearance
		$subsVal="";
		$subsColor="";			
		if(!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid',array(':userid'=>$userid,':followerid'=>$userid5))){
				$subsVal = "Subscribe";
			$subsColor="#ff0066";
			}else
				{
					$subsVal ="Subscribed";
					$subsColor="#996633";
					
				}

if($userid!=$userid5){
	$sub = '<button  type="button" subsBtn-id='.$userid.' style="width:20%;margin-top:0px;float:right;background-color:'.$subsColor.' ;height:35px;font-size:20px;border:none;border-radius:8px;font-family:Bree Serif;color:white;display:" class="subsBtn2">'.$subsVal.'</button>';
}
else{
	$sub = "";
}

$dem9 = array($sub);
$subBtnArr = array_merge($subBtnArr,$dem9);


if($userid==$userid5){
	$snooz = '<a class="dropdown-item" href="#" snoozFeedback-id='.$id.' style="display:block"><h3 style="font-size:15px" snooz-id='.$id.'>'.$snoozVal.'</h3></a>';
}else{
	$snooz = "";
}

$dem12 = array($snooz);
$snoozBtnArr = array_merge($snoozBtnArr,$dem12);


//allowing or not alllowing feedbacks
	if($userid!=$userid5){
        if(DB::query('SELECT snooz FROM post WHERE id=:postid AND user_id=:userid AND snooz="NO" ',array(':postid'=>$id,':userid'=>$userid))){
        if(!DB::query('SELECT blocked_author FROM blocked_author_feedback WHERE blocked_author =:blocked AND blocker=:blocker',array(':blocked'=>$userid5,':blocker'=>$userid))){

        	$giveFeedback = ' <p class="btn" Feedback-id='.$id.' style="font-family:Merriweather;font-size:19px;position:absolute;right:35%;color:red"><u>Give feedback to the author</u></p><br><p feedbackNoti-id='.$id.' style="display:none;position:absolute;right:35%;margin-top:10px">Feedback has been submitted </p> <div mainFeedbackDiv-id='.$id.' style="display:none"><div class="form-group"><label style="bottom:-15px;position: relative;font-family: lobster;font-size: 20px">Write your feedback</label><textarea class="form-control" rows="5" writeFeedback-id='.$id.' name="ask" style="margin-top:10px;resize: vertical;min-height: 50px;max-height: 300px" maxlength="500" placeholder="Write your feedback" required ></textarea></div><label  class="btn btn-default"  for="submitFeedback'.$id.'" tabindex="0" title="Submit your feedback" style="font-size: 15px">Submit</label><button id="submitFeedback'.$id.'" submitFeedback-id='.$id.' writer-id='.$userid.' name="uploadSubmit" data-dismiss="modal" class="hidden"></button></div>';

        }else{
        	$giveFeedback="";
        }
    }else
    {
    	$giveFeedback="";

    }
}else{
	$giveFeedback="";



}

$dem13 = array($giveFeedback);
$giveFeedbackArr = array_merge($giveFeedbackArr,$dem13);


	//for delete permission only to the user
	if($userid==$userid5){
		$delete = '<a class="dropdown-item" delete-id='.$id.' href="#" ><h3 style="font-size:15px;style="">Delete</h3></a>';

		
	}else{
		$delete="";


	}


	$dem15 = array($delete);
	$deleteArr = array_merge($deleteArr,$dem15);



	// for hiding notintrsted articles
	if(DB::query('SELECT postid FROM notintrsd WHERE postid=:postid AND userid=:userid',array(':userid'=>$userid5,':postid'=>$id))){
    $intrstd = "none";
  }
  else{
    $intrstd="block";
  }

  $dem17 = array($intrstd);
  $intrstdArr = array_merge($intrstdArr,$dem17);


//code for keyword feature

  $keyword_data = explode(" " ,$keywords);
  $keyword_index1 = rand(0,(count($keyword_data)-1));
  $keyword1 = $keyword_data[$keyword_index1];
 if(DB::query('SELECT id FROM post WHERE keywords LIKE :keyword 
 	AND Topics = :topics
 	 ',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics))){
 $suggetion = DB::query('SELECT id FROM post WHERE keywords LIKE :keyword AND Topics = :topics 
',array(':keyword'=>'%'.$keyword1.'%',':topics'=>$Topics));
 $suggetion_index = rand(0,(count($suggetion)-1));
 $suggetion_id =$suggetion[$suggetion_index];

 $suggetion_title = DB::query('SELECT title FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]))[0]['title'];
 $userid12 = "";
 $postrank = "";
 $suggetion_author_id = DB::query('SELECT user_id,postRank FROM post WHERE id = :postid',array(':postid'=>$suggetion_id[0]));
foreach ($suggetion_author_id as $Data2) {

  $userid12 = $Data2['user_id'];
  $postrank = $Data2['postRank'];

}

 $suggetion_data = DB::query('SELECT authorName,channelName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$userid12));
 $autorname11 = "";
 $channelname11="";
  foreach ($suggetion_data as $Data3) {

   $authorname11 = $Data3['authorName'];
   $channelname11 = $Data3['channelName'];
  
 }


 if($suggetion_id[0] != $id){
	$suggetionFeature = '<hr style="margin-top:50px"> <u><h2 style="font-size:20px;font-family:Baloo Bhai;color:red;margin-top:-10px">You might also like </h2></u> <a href="read.php?q='.$suggetion_id[0].'"><div  class="img-thumbnail" style="width:100%;position:relative;height:auto;background-color:#e0ebeb;font-size:15px;margin-bottom:-60px"><p style="float:right;margin-right:10px"><b>'.$postrank.'</b></p><p style="font-family:Merriweather;margin-left:10px;color:#3333ff"><b>'.$channelname11.'</b> <hr style="margin-top:-8px"> <p style="font-size:16px;font-family:Merriweather;color:blue;margin-top:-8px;margin-left:10px">'.$suggetion_title.'  </p> <hr style="margin-top:-10px"> <p style="margin-top:-8px;margin-left:10px;font-size:15px"><b>written by :</b>'.$authorname11.' </p> </div> </a>';
}else{
	$suggetionFeature="";
}


$dem17 = array($suggetionFeature);
$suggetionStatArr = array_merge($suggetionStatArr,$dem17);

}




}


$Data = [$followingposts,$AuthData,$likesVal,$likesCol,$viewColorArr,$viewValArr,$mArr,$snoozValArr,$saveValArr,$authorStrengthArr,$subBtnArr,$snoozBtnArr,$giveFeedbackArr,$deleteArr,$intrstdArr,$suggetionStatArr ,$statusArr];

echo json_encode($Data);
}





//code for getting notifications

if(isset($_POST['getNotifications'])){
		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
$message="";

	$limit = $_POST['getNotifications'];

	$notification_reciever = Login::isLoggedIn();

     $notifications = DB::query('SELECT * FROM notifications WHERE reciever_id=:reciever

     	ORDER BY get_at DESC
     	
     LIMIT 20 OFFSET '.$limit.'	',array(':reciever'=>$notification_reciever));

     $notifArr = array();

     foreach ($notifications as $key){

 	$sender_id = $key['sender_id'];
 	$type = $key['notification'];
 	$imp_id=$key['imp_id'];
 	$status = $key['status'];
 	$t = $key['get_at'];

$c = "";
if($status=="NO"){
	$c = "#e6f9ff";
}else{
	$c = "";
}

 $status = current::Time($t);
 
     	if($type==1){
if(DB::query('SELECT id FROM post WHERE id = :id',array(':id'=>$imp_id))){

 $sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];
       $articleTitle = DB::query('SELECT title FROM post WHERE id=:id',array(':id'=>$imp_id))[0]['title'];

      $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> Liked your article <a href="read.php?q='.$imp_id.'"><b>'.$articleTitle.'</b></a></p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
}
     	}else if($type==2){

 $sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];

  $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> Subscribed your publication. </p>
  <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
     	}else if($type==3){



$sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];

 $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> asked to you : <a href="discussion.php" style="font-family:Merriweather;font-size:14px;color:red">'.$imp_id.' ...</a> </p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';

}else if($type==4){

$sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];

$message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> replied on your question : <a href="discussion.php" style="font-family:Merriweather;font-size:14px;color:red">'.$imp_id.' ...</a> </p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';

}
else if($type==5){

	if(DB::query('SELECT id FROM post WHERE id = :id',array(':id'=>$imp_id))){
$sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];
$articleTitle = DB::query('SELECT title FROM post WHERE id = :imp_id',array(':imp_id'=>$imp_id))[0]['title'];
$message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> gave a feedback on your article :  <a href="discussion.php" style="font-family:Baloo Bhai;font-size:14px;">' .$articleTitle. '</a> </p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';

}
}else if($type==6){

if(DB::query('SELECT id FROM post WHERE id = :id',array(':id'=>$imp_id))){

$sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['authorName'];
$articleTitle = DB::query('SELECT title FROM post WHERE id = :imp_id',array(':imp_id'=>$imp_id))[0]['title'];
$message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_name.'</b></a> replied on your feedback on article <a href="discussion.php" style="font-family:Baloo Bhai;font-size:14px;">' .$articleTitle. '</a> </p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
       
}
}else if($type==7){


if(DB::query('SELECT id FROM post WHERE id = :id',array(':id'=>$imp_id))){


        $sender_channel_name = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$sender_id))[0]['channelName'];
        $articleTitle = DB::query('SELECT title FROM post WHERE user_id = :id AND id = :imp_id',array(':id'=>$sender_id,':imp_id'=>$imp_id))[0]['title'];

                $articleId = DB::query('SELECT id FROM post WHERE user_id = :id AND id = :imp_id',array(':id'=>$sender_id,':imp_id'=>$imp_id))[0]['id'];

        $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word;" >
 <p> <a href="otherProfile.php?q='.$sender_id.'"><b>'.$sender_channel_name.'</b></a> Published an article <a href="read.php?q='.$articleId.'" style="font-family:Baloo Bhai;font-size:14px;">' .$articleTitle. '</a> </p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
}

}else if($type==8){

    if(DB::query('SELECT id FROM post WHERE id = :id',array(':id'=>$sender_id))){

  $articleTitle = DB::query('SELECT title FROM post WHERE  id = :reciever',array(':reciever'=>$sender_id))[0]['title'];

                
// here senderId  row has article id
        $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word;" >
 <p style="color:red">This is a notification from blogsar regarding your article : <a href="read.php?q='.$sender_id.'" style="font-family:Baloo Bhai;font-size:14px;">' .$articleTitle. '</a> </p><p style="margin-top:-10px">'.$imp_id.'</p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
}

}else if($type==9){

        
if(DB::query('SELECT id FROM removearticle WHERE article_id = :id',array(':id'=>$sender_id))){
  $articleTitle = DB::query('SELECT title FROM removearticle WHERE  article_id = :reciever',array(':reciever'=>$sender_id))[0]['title'];


                
// here senderId  row has article id
        $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word;" >
 <p style="color:red">This is a notification from blogsar regarding your article : <a href="read.php?q='.$sender_id.'" style="font-family:Baloo Bhai;font-size:14px;">' .$articleTitle. '</a> </p><p style="margin-top:-10px">'.$imp_id.'</p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';
}

}else if($type==10){

 

                
// here senderId  row has article id
        $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word;" >
 <p style="color:red">This is a notification from blogsar regarding your feedback :  </p><p style="margin-top:-10px">'.$imp_id.'</p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';


}else if($type==11){

 

                
// here senderId  row has article id
        $message = '<ul class="list-group-item notif"  style="margin: 0;padding: 0;padding-left: 5px;font-family:Sanchez;background-color:'.$c.';font-size:15px;word-wrap:break-word;" >
 <p style="color:red">This is a Thanks from blogsar regarding your feedback :  </p><p style="margin-top:-10px">'.$imp_id.'</p>
 <p style="float:right;font-size:12px;margin-top:-16px;margin-bottom:0;color:grey">'.$status.'</p>
</ul>';


}
    
          $dem = array($message);
          $notifArr = array_merge($notifArr,$dem);
     	
     	
     }

  echo json_encode($notifArr);

}






//discussion  page ajax script
     

     //code for askedToYou section
if(isset($_POST['askedToYou'])){
     //code for askedToYou section
		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

	       function test_input($data) {

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;

}

$userid5 = Login::isLoggedIn();

$askerArr = array();
$colorArr = array();
$pArr     = array();
$statusArr = array();
   $askedToYou = DB::query('SELECT * FROM asktoauthor WHERE reciever = :reciever

ORDER BY asked_at DESC ,id DESC

    ',array(':reciever'=>$userid5));
  
   foreach ($askedToYou as $a){
 
    $sender = $a['sender'];
    $question =test_input($a['question']);
    $answer = test_input($a['answer']);
    $asked_at = $a['asked_at'];


       $status = current::Time($asked_at);
       $dem12 = array($status);

       $statusArr = array_merge($statusArr,$dem12);

$status = $a['status1'];
$color="";
if($status=="NO"){
  $color = "#d9e5f2";
}else{
	  $color = "";
}
   
    if($answer=="Not answered yet."){
      $p="Answer";
    }
    else{
       $p="Update Answer";
    }

    $asker = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :userid',array(':userid'=>$sender));


    $askerArr = array_merge($askerArr,$asker);

    $dem = array($color);
    $colorArr = array_merge($colorArr,$dem);

    $dem2 = array($p);

    $pArr = array_merge($pArr,$dem2);
   
}
	

	$data = [$askedToYou,$askerArr,$pArr,$colorArr,$statusArr];

	echo json_encode($data);

}





// ajax code for getting chats in askedByMe section

  if(isset($_POST['askedByMe'])){
  		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

// ajax code for getting chats in askedByMe section
  	$userid5 = Login::isLoggedIn();


$colorArr = array();
$authorNameArr = array();
$bannerArr = array();
$bannerArr2 = array();
$statusArr = array();
          $askedByMe = DB::query('SELECT * FROM asktoauthor WHERE sender =:userid2

            ORDER BY asked_at DESC',array(':userid2'=>$userid5));

          foreach ($askedByMe as $A) {
         
       
       $replier = $A['reciever'];
       $answer = $A['answer'];
      $asked_at = $A['asked_at'];

      $status = current::Time($asked_at);

      $dem12 = array($status);
      $statusArr = array_merge($statusArr,$dem12);
       
       $status = $A['status2'];

       $authorName1 = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$replier))[0]['authorName'];

       if($answer != "Not answered yet"){

       	$banner = '<p style="font-family:Merriweather;font-size:15px"><a href="otherProfile.php?q='.$replier.'"> '.$authorName1 .'</a> Replied on your qestion</p>';
       }else{

       	$banner = ' <p style="font-family:Merriweather;font-size:15px"> <a href="otherProfile.php?q='.$replier.'"> '.$authorName1 .'</a> have not replied yet.</p>';
       }

$dem5 = array($banner);

$bannerArr = array_merge($bannerArr,$dem5);


 if($answer != "Not answered yet")
 	{
 		$banner2 = '<h2 style="margin-top:-15px;font-size: 16px">He says :</h2><p style="font-family:Mali;font-size:17px">'.$answer.'</p><br>';
 	}else{

 		$banner2  =  "";
 	}

 	$dem6 = array($banner2);

 	$bannerArr2 = array_merge($bannerArr2,$dem6);

$color="";
if($status == "NO"){

  $color = "#d9e5f2";

}else{

  $color = "";
}

  $dem = array($color);
$colorArr = array_merge($colorArr,$dem);


  }


  $data = [$askedByMe,$colorArr,$bannerArr,$bannerArr2,$statusArr];

  echo json_encode($data);

}




//ajax code for getting feedbacks data given on your articles

if(isset($_POST['feedbacks_data']))
{

	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
//ajax code for getting feedbacks data given on your articles

$userid5 = Login::isLoggedIn();

$colorArr = array();
$sender_nameArr = array();
$articleTitleArr  = array();
$statusArr = array();
  $feedbacks  = DB::query('SELECT * FROM postfeedback WHERE reciever = :reciever

ORDER BY post_id DESC 
    ',array(':reciever'=>$userid5));


foreach ($feedbacks as $d) {


  $sender = $d['sender'];
  $postid=$d['post_id'];

  $seen = $d['seen1'];

   $asked_at = $d['time_at'];

      $status = current::Time($asked_at);

      $dem12 = array($status);
      $statusArr = array_merge($statusArr,$dem12);

     if(DB::query('SELECT id FROM post WHERE id=:id',array(':id'=>$postid))){

$color="";
if($seen=="NO"){
  $color = "#d9e5f2";


}else{

	$color = "";
}
 $dem = array($color);
$colorArr = array_merge($colorArr,$dem);

$sender_name = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$sender));

$sender_nameArr = array_merge($sender_nameArr,$sender_name);

  $post_title = DB::query('SELECT title FROM post WHERE id = :postid',array(':postid'=>$postid));

  $articleTitleArr = array_merge($articleTitleArr,$post_title);

}

}
	$data = [$feedbacks,$colorArr,$sender_nameArr,$articleTitleArr,$statusArr];

	echo json_encode($data);
	}	



	// ajax code for geeting feedbacks given by you

	if(isset($_POST['myFeedbacks'])){
			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

// ajax code for geeting feedbacks given by you


$userid5 = Login::isLoggedIn();
$colorArr  = array();
$authorNameArr = array();
$articleTitleArr = array();
$statusArr = array();
		          $yourFeedbacks = DB::query('SELECT * FROM postfeedback WHERE sender=:userid
ORDER BY time_at DESC
            ',array(':userid'=>$userid5));

          foreach ($yourFeedbacks as $y) {
       
       $authorId = $y['reciever'];
       $articleId = $y['post_id'];
       $feedback = $y['feedback'];
       $reply = $y['reply'];
       $seen = $y['seen2'];

if(DB::query('SELECT id FROM post WHERE id=:id',array(':id'=>$articleId))){
   $asked_at = $y['time_at'];

      $status = current::Time($asked_at);

      $dem12 = array($status);
      $statusArr = array_merge($statusArr,$dem12);


$color="";
if($seen=="NO"){

  $color = "#d9e5f2";

}else{

	$color="";

}

  $dem = array($color);
  $colorArr = array_merge($colorArr,$dem);


$authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:userid',array(':userid'=>$authorId));
       $articleTitle = DB::query('SELECT title FROM post WHERE id=:postid',array(':postid'=>$articleId));


      $authorNameArr = array_merge($authorNameArr,$authorName);

    $articleTitleArr = array_merge($articleTitleArr,$articleTitle);

	}	

}
	$data = [$yourFeedbacks,$colorArr,$authorNameArr,$articleTitleArr,$statusArr];
	  echo json_encode($data);	

	}	



// setting up author name and channel name uniqly
	if(isset($_POST['set_auth'])){

	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
  $val = $_POST['set_auth'];

$userid = Login::isLoggedIn();
$current_auth = DB::query('SELECT authorName FROM channelsetup WHERE user_id=:id',array(':id'=>$userid))[0]['authorName'];


      if( DB::query('SELECT authorName FROM channelsetup WHERE authorName LIKE :val',array(':val'=>$val))  &&  DB::query('SELECT authorName FROM channelsetup WHERE authorName LIKE :val',array(':val'=>$val))[0]['authorName'] != $current_auth){
         
         $banner  =  "Author Name is not available";
      }else{
      	    $banner  =  "Author Name is available.";
      }
    $bannerArr = array($banner);

    echo json_encode($bannerArr);

	}

	//setiing up chanel name unique
if(isset($_POST['set_channel'])){

		if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

  $val = $_POST['set_channel'];

  $userid = Login::isLoggedIn();

$current_channel = DB::query('SELECT channelName FROM channelsetup WHERE user_id=:id',array(':id'=>$userid))[0]['channelName'];
      
      if( DB::query('SELECT channelName FROM channelsetup WHERE channelName LIKE :val',array(':val'=>$val)) && DB::query('SELECT channelName FROM channelsetup WHERE channelName LIKE :val',array(':val'=>$val))[0]['channelName'] != $current_channel){
         
         $banner  =  "Published Name is not available";
      }else{
      	    $banner  =  "publication Name is available.";
      }
    $bannerArr = array($banner);

    echo json_encode($bannerArr);

	}


	//getting stats about articles
	if(isset($_POST['articleStats'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

       $feedbacks_countArr = array();
       $statusArr = array();

      $userid = $_POST['articleStats'];

      $articles = DB::query('SELECT * FROM post WHERE user_id = :userid',array(':userid'=>$userid));

      foreach($articles as $a){
              

              $article_id = $a['id'];
              $published_at = $a['posted_at'];

              $status = current::Time($published_at);

              $dem2 = array($status);

              $statusArr = array_merge($statusArr,$dem2);

    $feedbacks = DB::query('SELECT feedback FROM postfeedback WHERE post_id=:id',array(':id'=> $article_id));

          $feedbacks_count = count($feedbacks);

          $dem = array($feedbacks_count);

          $feedbacks_countArr = array_merge($feedbacks_countArr,$dem);

      }


      $data = [$articles,  $feedbacks_countArr ,$statusArr];

      echo json_encode($data);


	}



	if(isset($_POST['likeStats'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	
           
           $postid = $_POST['likeStats'];

           $limit = $_POST['limit'];

           $authorNameArr = array();
           $channelNameArr= array();
          $channelImageArr= array();
           $useridArr     = array();
       $authorStrengthArr = array();

           $liker = DB::query('SELECT user_id FROM post_likes WHERE post_id = :id
           	 LIMIT 20 OFFSET '.$limit.'',array(':id'=>$postid));

           foreach ($liker as $l) {

           	$userid = $l['user_id'];
$authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['authorName'];
$channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelName'];
$channelImage = DB::query('SELECT channelImage FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelImage'];
            
           $authorStrength  =  author::strength($userid);

           $dem6 = array($authorStrength);

           $authorStrengthArr = array_merge($authorStrengthArr,$dem6);

           	

           	
           	$dem = array($authorName);
           	$dem2 = array($channelName);
           	$dem3 = array($channelImage);
$dem5 = array($userid);
           	$authorNameArr = array_merge($authorNameArr,$dem);

           	$channelNameArr = array_merge($channelNameArr,$dem2);

           	$channelImageArr = array_merge($channelImageArr,$dem3);

           	 $useridArr = array_merge($useridArr,$dem5);
           }

           $data = [$authorNameArr,$channelNameArr,$channelImageArr,$useridArr,$authorStrengthArr];

           echo json_encode($data);


	}


//getting feedback stats

	if(isset($_POST['feedbackStats'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

           
           $postid = $_POST['feedbackStats'];

           $limit = $_POST['limit'];

           $authorNameArr = array();
           $channelNameArr= array();
          $channelImageArr= array();
           $useridArr     = array();
       $authorStrengthArr = array();

           $feedbacker = DB::query('SELECT sender FROM postfeedback WHERE post_id = :id
           	 LIMIT 20 OFFSET '.$limit.'',array(':id'=>$postid));

           foreach ($feedbacker as $l) {

           	$userid = $l['sender'];
 	$authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['authorName'];
           	$channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelName'];
           	$channelImage = DB::query('SELECT channelImage FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelImage'];
            
           $authorStrength  =  author::strength($userid);

           $dem6 = array($authorStrength);

           $authorStrengthArr = array_merge($authorStrengthArr,$dem6);

           	

           	
           	$dem = array($authorName);
           	$dem2 = array($channelName);
           	$dem3 = array($channelImage);
$dem5 = array($userid);
           	$authorNameArr = array_merge($authorNameArr,$dem);

           	$channelNameArr = array_merge($channelNameArr,$dem2);

           	$channelImageArr = array_merge($channelImageArr,$dem3);

           	 $useridArr = array_merge($useridArr,$dem5);
           }

           $data = [$authorNameArr,$channelNameArr,$channelImageArr,$useridArr,$authorStrengthArr];

           echo json_encode($data);


	}



//getting views stats

	if(isset($_POST['viewsStats'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	

           
           $postid = $_POST['viewsStats'];

           $limit = $_POST['limit'];

           $authorNameArr = array();
           $channelNameArr= array();
          $channelImageArr= array();
           $useridArr     = array();
       $authorStrengthArr = array();

           $viewer = DB::query('SELECT user_id FROM viewdposts WHERE viewd_post = :id
           	 LIMIT 20 OFFSET '.$limit.'',array(':id'=>$postid));

           foreach ($viewer as $l) {

           	$userid = $l['user_id'];

 	$authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['authorName'];
           	$channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelName'];
           	$channelImage = DB::query('SELECT channelImage FROM channelsetup WHERE user_id = :id',array(':id'=>$userid))[0]['channelImage'];
            
           $authorStrength  =  author::strength($userid);

           $dem6 = array($authorStrength);

           $authorStrengthArr = array_merge($authorStrengthArr,$dem6);

           	

           	
           	$dem = array($authorName);
           	$dem2 = array($channelName);
           	$dem3 = array($channelImage);
$dem5 = array($userid);
           	$authorNameArr = array_merge($authorNameArr,$dem);

           	$channelNameArr = array_merge($channelNameArr,$dem2);

           	$channelImageArr = array_merge($channelImageArr,$dem3);

           	 $useridArr = array_merge($useridArr,$dem5);
           }

           $data = [$authorNameArr,$channelNameArr,$channelImageArr,$useridArr,$authorStrengthArr];

           echo json_encode($data);


	}



//email verify for signup process
	if(isset($_POST['email_verify'])){
	if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	



		$email = $_POST['email_verify'];

		if(DB::query('SELECT email FROM signup WHERE email=:email',array(':email'=>$email))){

			echo 0;
		}else{
echo 1;
		}
	}


	//for creating unique title for each article

	if(isset($_POST['article_title'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

}	


              $val = $_POST['article_title'];

              if(DB::query('SELECT title FROM post WHERE title = :title',array(':title'=>$val))){

            $banner = "This title is not available";

              }else{
                  $banner = "This title is available";

              }

            
             echo $banner; 


	}


//giving liked articles in mystats page
	if(isset($_POST['liked_articles'])){

			if(!Login::isLoggedIn()){

							header("location:loginpage.php");
							die();

                          }	


            $userid = $_POST['liked_articles'];

            $article_data_arr = array();
            $channelNameArr = array();
            $authorNameArr = array();



     $liked_articles = DB::query('SELECT post_id FROM post_likes WHERE user_id = :id ',array(':id'=>$userid));

            foreach($liked_articles as $l){

                   $post_id = $l['post_id'];

   if(DB::query('SELECT id FROM post WHERE id=:id',array(':id'=>$post_id))){
                   $article_data = DB::query('SELECT id,title , titleImage , posted_at ,  likes , views , postRank FROM post WHERE id = :id',array(':id'=>$post_id));

         $article_writer = DB::query('SELECT user_id FROM post WHERE id = :id',array(':id'=>$post_id))[0]['user_id'];

                   $authorName = DB::query('SELECT authorName FROM channelsetup WHERE user_id = :id',array(':id'=>$article_writer))[0]['authorName'];

                    $channelName = DB::query('SELECT channelName FROM channelsetup WHERE user_id = :id',array(':id'=>$article_writer))[0]['channelName'];
                          
                  
                  $dem = array($authorName);
                  $dem2 = array($channelName);

                          $channelNameArr =  array_merge($channelNameArr , $dem);
                          $authorNameArr = array_merge($authorNameArr , $dem2);


                   $article_data_arr = array_merge($article_data_arr,$article_data);
               }

            }

            $data = [$article_data_arr , $authorNameArr , $channelNameArr];



            echo json_encode($data);


	}
