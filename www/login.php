<?php
	$errorCode=0;
	session_start();
	if (array_key_exists("user", $_SESSION)) {
		$currlogin=$_SESSION['user'];
	}
	include "key.ini";
	mysql_select_db('hearth_db') or die("Could not select database!");
	mysql_set_charset("utf8");
	if(isset($_POST['in']))
	{
		$oldlogin=strip_tags(trim($_POST['oldlogin']));
		$oldpassword=strip_tags(trim($_POST['oldpassword']));
		if(empty($oldlogin)||empty($oldpassword)) $errorCode=2; else
		{
			$res=mysql_query("SELECT * FROM users WHERE login='$oldlogin'");
			$row=mysql_fetch_array($res);
			echo '<p>'.$res.'</p>';
			if(!isset($row['password'])) {$errorCode=3; $oldlogin=NULL; $oldpassword=NULL;} else
			if($row['password']!=$oldpassword) {$errorCode=4; $oldpassword=NULL;} else
			{
				$_SESSION['user'] = $oldlogin;
				$errorCode=1;
			}
		}
	}
	mysql_close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>H&H LogIn</title>
    <link rel="shortcut icon" href="img/home.ico" />
    <link href="styles/bootstrap.css" rel="stylesheet">
    <link href="styles/bootstrap-theme.css" rel="stylesheet">
    <link href="styles/bodyStyle.css" rel="stylesheet">
    <link href="styles/headerStyle.css" rel="stylesheet">
    <link href="styles/footerStyle.css" rel="stylesheet">
    <link href="styles/loginStyle.css" rel="stylesheet">
</head>
<body>
    <div class="top-block   ">
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
                        <a href="index.html"><img src="img/logo.png" alt="logo" id="logo" /></a>
                    </div>
                    <div class="col-lg-3 col-lg-offset-7 col-md-4 col-md-offset-6 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
						<div id="login">
						<?php 
							if($errorCode==1) echo '<a href="user.php">'.$oldlogin.'</a>';
							else if(isset($currlogin)) echo '<a href="user.php">'.$currlogin.'</a>';
							else echo '<a href="login.php">LOGIN</a>';
						?>     
                        </div>
                        <div id="registry">
                            <a href="registration.php">REGISTRATION</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <div class="bodySmall">
        <div class="container">
            <div class="col-lg-6 col-lg-offset-3 col-lg-6 col-lg-offset-3">
                <h2>Login</h2>
                <form method="post" action="login.php">
                    <div><input class="login" type="text"  maxlength="30" placeholder="Enter your login..." name="oldlogin" value="<?php if(isset($oldlogin) && $errorCode!=1) echo $oldlogin; ?>"/>
                    <label class="textAlert"></label></div>
                    <div><input class="password" type="password"  maxlengh="30" placeholder="Enter your password..."  name="oldpassword" value="<?php if(isset($oldpassword) && $errorCode!=1) echo $oldpassword; ?>"/>
                    <label class="textAlert"></label></div>
                    <button type="submit" name="in">ENTER >></button>
                    <img src="img/city.png" />
                </form>
				<?php switch($errorCode) {
						case 2: echo '<p class="response">Some fields are empty!</p>'; break;
						case 3: echo '<p class="response">This username doesnt exist!</p>'; break;
						case 4: echo '<p class="response">Wrong password!</p>'; break;
					}?>
            </div>
            </div>
        </div>
    </div>
    <footer class="hidden-md hidden-sm" style="position: fixed">
        <div class="container">
            <p>	&copy; Copyright 2017 <span>Hearth&Home.</span> All rights reserved.</p>
            <div class="links">
                <a href="http://facebook.com"><img src="img/Facebook.png" /></a>
                <a href="http://dribble.com"><img src="img/Dribble.png" /></a>
                <a href="http://twitter.com"><img src="img/Twitter.png" /></a>
                <a href="http://google.com"><img src="img/Google.png" /></a>
            </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="scripts/bootstrap.js"></script>
    <script src="scripts/validation.js"></script>
</body>
</html>