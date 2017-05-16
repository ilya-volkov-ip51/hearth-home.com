<?php
	$errorCode=0;
	session_start();
	if (array_key_exists("user", $_SESSION)) {
		$currlogin=$_SESSION['user'];
	}
	include "key.ini";
	mysql_select_db('hearth_db') or die("Could not select database!");
	mysql_set_charset("utf8");
	if(isset($_POST['add']))
	{
		$username=strip_tags(trim($_POST['username']));
		$login=strip_tags(trim($_POST['login']));
		$res=mysql_query("SELECT login FROM users WHERE login='$login'");
		$password=strip_tags(trim($_POST['password']));
		$password1=strip_tags(trim($_POST['password1']));
		$email=strip_tags(trim($_POST['email']));
		if(empty($username)||empty($login)||empty($password)||empty($password1)||empty($email)) $errorCode=2;
		else if($password!=$password1) {$errorCode=3; $password=NULL; $password1=NULL;}
		else if(!preg_match("/^.{3,30}$/",$username)) {$errorCode=4; $username=NULL;}
		else if (!preg_match("/^[0-9a-zA-Z_.-]+@[a-zA-Z_]+?\.[a-zA-Z]+$/",$email)) {$errorCode=5; $email=NULL;}
		else if(!preg_match("/^.{8,30}$/",$password)) {$errorCode=6; $password=NULL; $password1=NULL;}
		else if(!preg_match("/^[a-zA-Z_.-]{6,30}$/",$login)) {$errorCode=7; $login=NULL;}
		else if(mysql_num_rows($res)!=0) {$errorCode=8; $login=NULL;}
		else {
				mysql_query(" INSERT INTO users(login,password,email,username) VALUES ('$login','$password','$email','$username')");
				$errorCode=1;
				$_SESSION['user'] = $login;
				$currlogin=$_SESSION['user'];
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
    <title>H&H Registration</title>
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
                            <a href="login.php">LOGIN</a>
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
                <h2>Registration</h2>
                <form  method="post" action="registration.php" id="registration">
                    <div><input class="login" type="text" maxlength="30" placeholder="Enter your login..." name="login" value="<?php if(isset($login) && $errorCode!=1) echo $login; ?>"/>
                    <label class="textAlert"></label></div>
					<div><input class="username" type="text" maxlength="30" placeholder="Enter your username..." name="username" value="<?php if(isset($username) && $errorCode!=1) echo $username; ?>"/>
                    <label class="textAlert"></label></div>
                    <div><input class="password" type="password" maxlengh="30" placeholder="Enter your password..." name="password" value="<?php if(isset($password) && $errorCode!=1) echo $password; ?>"/>
                    <label class="textAlert"></label></div>
                    <div><input class="confirm" type="password" maxlengh="30" placeholder="Repeat your password..." name="password1" value="<?php if(isset($password1) && $errorCode!=1) echo $password1; ?>"/>
                    <label class="textAlert"></label></div>
                    <div><input class="email" type="text" maxlength="40" placeholder="Enter your e-mail..." name="email" value="<?php if(isset($email) && $errorCode!=1) echo $email; ?>"/>
                    <label class="textAlert"></label></div>
                    <button type="submit" name="add">REGISTER >></button>
                </form>
				<?php switch($errorCode) {
						case 1: echo '<p class="response">Registration successful!</p>'; break;
						case 2: echo '<p class="response">Some fields are empty!</p>'; break;
						case 3: echo '<p class="response">Passwords aren`t equal!</p>'; break;
						case 4: echo '<p class="response">Wrong username!</p>'; break;
						case 5: echo '<p class="response">Wrong email!</p>'; break;
						case 6: echo '<p class="response">Wrong password!</p>'; break;
						case 7: echo '<p class="response">Wrong login!</p>'; break;
						case 8: echo '<p class="response">This login already exsists!</p>'; break;
					}?>
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