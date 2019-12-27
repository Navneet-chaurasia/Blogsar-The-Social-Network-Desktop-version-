<?php
include ('/home/s1m0m1lnqe21/public_html/database.php');
include ('/home/s1m0m1lnqe21/public_html/Loging.php');

if (!Login::isLoggedIn()) {
        header("location:loginpage.php");
}

if (isset($_POST['confirm'])){
       
                if (isset($_COOKIE['SNID'])) {
                        DB::query('DELETE FROM token_cookie WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
                }
                setcookie('SNID', '1', time()-3600);
                setcookie('SNID_', '1', time()-3600);
				header("location:loginpage.php");
        
}

	
	

		?>

