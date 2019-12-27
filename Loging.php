<?php
class Login{
	public static function isLoggedIn()
				
				{
					if(isset($_COOKIE['SNID']))
					{
						if(DB::query('SELECT user_id FROM token_cookie WHERE token=:token',array(':token'=>sha1($_COOKIE['SNID']))))
						{
							$user_id=DB::query('SELECT user_id FROM token_cookie WHERE token=:token',array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
							if(isset($_COOKIE['SNID_']))
							{
								return $user_id;	
							}else
								{
									$cstrong=True;
									$token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
										DB::query('INSERT INTO token_cookie VALUES(\'\',:token,:user_id)',array(':token'=>sha1($token),'user_id'=>$user_id));
										DB::query('DELETE FROM token_cookie WHERE token=:token',array(':token'=>sha1($_COOKIE['SNID'])));
										setcookie("SNID",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);
		                                  setcookie("SNID_",'1',time()+60*60*24*3,'/',NULL,NULL,TRUE);
										  return $user_id;
								}
						
						}
					}
					return false;
				}
}

//calculating loging state of administratives
class adminLogin{
  public static function isAdminLoggedIn()
        
        {
          if(isset($_COOKIE['ALID']))
          {
            if(DB::query('SELECT admin_id FROM admin_login_cookie_token WHERE token=:token',array(':token'=>sha1($_COOKIE['ALID']))))
            {
              $user_id=DB::query('SELECT admin_id FROM admin_login_cookie_token WHERE token=:token',array(':token'=>sha1($_COOKIE['ALID'])))[0]['admin_id'];
              if(isset($_COOKIE['ALID_']))
              {
                return $user_id;  
              }else
                {
                  $cstrong=True;
                  $token=bin2hex(openssl_random_pseudo_bytes(64,$cstrong));
                    DB::query('INSERT INTO admin_login_cookie_token VALUES(\'\',:token,:user_id)',array(':token'=>sha1($token),'user_id'=>$user_id));
                    DB::query('DELETE FROM admin_login_cookie_token WHERE token=:token',array(':token'=>sha1($_COOKIE['ALID'])));
                    setcookie("ALID",$token,time()+60*60*24*7,'/',NULL,NULL,TRUE);
                                      setcookie("ALID_",'1',time()+60*60*24*3,'/',NULL,NULL,TRUE);
                      return $user_id;
                }
            
            }
          }
          return false;
        }
}
// code for counting author rank
class author{

	public static function strength($user_id){

        $noOfPosts = DB::query('SELECT noOfPosts FROM user_details WHERE user_id = :id',array(':id'=>$user_id))[0]['noOfPosts'];
$totalSumOfLikes=0;
$totalSumOfViews = 0;
$authorStrength = 0;

        $totalLikes = DB::query('SELECT likes FROM post WHERE user_id = :id',array(':id'=>$user_id));

        foreach ($totalLikes as $data) {
           
         $d1 =  $data['likes'];
         $totalSumOfLikes = $totalSumOfLikes+$d1;
                 
        }

        $totalviews = DB::query('SELECT views FROM post WHERE user_id = :id',array(':id'=>$user_id));

        foreach ($totalviews as $data2) {
           
         $d2  =  $data2['views'];
         $totalSumOfViews = $totalSumOfViews + $d2;
                 
        }

        $subscribers = DB::query('SELECT subscribers FROM user_details WHERE user_id = :id',array(':id'=>$user_id))[0]['subscribers'];



       $authorStrength = ($totalSumOfViews)  +  ($totalSumOfLikes) + ($noOfPosts*10) +  ($subscribers*2);

   DB::query('UPDATE user_details SET authorRank = :authorStrength WHERE user_id =:id' ,array(':id'=>$user_id,':authorStrength'=>$authorStrength));

   return $authorStrength;


	}


}



// code for calculating article strength

class article{

	public static function strength($article_id){

          $likes = DB::query('SELECT likes FROM post WHERE id = :id',array(':id'=>$article_id))[0]['likes'];

          $views = DB::query('SELECT views FROM post WHERE id = :id',array(':id'=>$article_id))[0]['views'];

          $feedbacks = DB::query('SELECT feedback FROM postfeedback WHERE post_id=:id',array(':id'=> $article_id));

          $feedbacks_count = count($feedbacks);

          $articleStrength = ($likes*2) + ($views*3) + ($feedbacks_count*5);

          DB::query('UPDATE post SET postRank = :articleStrength WHERE id=:id',array(':id'=>$article_id,':articleStrength'=>$articleStrength))[0]['postRank'];

	}
}



  class current{

  	public static function Time($t){
             date_default_timezone_set('Asia/Kolkata');

             $year2 = substr($t,0,4);
             $month2 = substr($t,5,2);
             $day2 = substr($t,8,2);

             $hour2 = substr($t,11,2);
             $minute2 = substr($t,14,2);
             $second2 = substr($t,17,2);

             $year1 = date("Y");
               $month1 = date("m");
                 $day1 = date("d");
                   $hour1 = date("H");
                     $minute1 = date("i");
                       $second1 = date("s");

$status = "";

if($year2==$year1 && $month2==$month1 && $day2==$day1 && $hour2==$hour1 && ($minute2==$minute1 || (($second1-$second2) < 60 && ( $minute1-$minute2)==1))){

  	$status = " just now";

  }
  else if($year2==$year1 && $month2==$month1 && $day2==$day1 && $hour2==$hour1 ){

             $diff = $minute1-$minute2;
          $status = $diff." minute ago";

  }else if($year2==$year1 && $month2==$month1 && $day2==$day1 && ($hour1-$hour2)==1 && $minute2>$minute1 ){


  $diff = (60-$minute2)+$minute1;
          $status = $diff." minute ago"; 

  }

  else if($year2==$year1 && $month2==$month1 && $day2==$day1 ){

 $diff = $hour1-$hour2;
          $status = $diff." hour ago";

  }else if($year2==$year1 && $month2==$month1 && ($day1-$day2)==1 && $hour2>$hour1 ){


  $diff = (24-$hour2)+$hour1;
          $status = $diff." hour ago"; 

  }else if($year2==$year1 && $month2==$month1 ){

          $diff = $day1-$day2;
          $status = $diff." day ago";

  }else if($year2==$year1 &&($month1-$month2)==1 && $day2>$day1){


  $diff = (30-$day2)+$day1;
          $status = $diff." day ago"; 

  }else if($year2==$year1 ){


          $diff = $month1-$month2;
          $status = $diff." months ago";


  }else if( ($year1-$year2)==1 && $month2>$month1){

 $diff = (12-$month2)+$month1;
          $status = $diff." month ago";
  }

  else{


          $diff = $year1-$year2;
          $status = $diff." years ago";
  }



return $status;


  	}

  }




class random{

  public static function authorName($rand){

      $random_number1 = rand(1,6);

 $random_words = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');


         $authorName = $rand.'@'.'Author';


         for($i=0;$i<$random_number1;$i++){

         $random_number2 = rand(0,25);

         $random_number3 = rand(1,10);

         if ( $random_number3 < 5 ){

          $random_letter = $random_words[$random_number2];

                $authorName = $authorName.$random_letter.rand(0,9);

         }else{

 $random_letter = $random_words[$random_number2];
             $authorName = $authorName.rand(0,9).$random_letter;
         }


         }

         if(DB::query('SELECT authorName FROM channelsetup WHERE authorName = :name',array(':name'=>$authorName))){

          random::authorName($rand);
         }else{


         return $authorName;

       }

  }




  public static function channelName($rand){

      $random_number1 = rand(1,6);

 $random_words = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');


         $authorName = $rand.'@'.'Channel';


         for($i=0;$i<$random_number1;$i++){

         $random_number2 = rand(0,25);

         $random_number3 = rand(1,10);

         if ( $random_number3 < 5 ){

          $random_letter = $random_words[$random_number2];

                $authorName = $authorName.$random_letter.rand(0,9);

         }else{

 $random_letter = $random_words[$random_number2];
             $authorName = $authorName.rand(0,9).$random_letter;
         }


         }
          if(DB::query('SELECT authorName FROM channelsetup WHERE authorName = :name',array(':name'=>$authorName))){

          random::authorName($rand);
         }else{


         return $authorName;

       }

  }
}
?>