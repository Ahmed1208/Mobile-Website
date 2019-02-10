<!DOCTYPE html>

<html>
<head>
<meta charset ="utf-8">
<title> Sign-in </title>

<link rel="stylesheet" href="..\css\sign_in.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
  <meta name="theme-color" content="#333334">
  <meta name="msapplication-navbutton-color" content="#333334">
  <meta name="apple-mobile-web-app-status-bar-style" content="#333334">
</head>

<body>
<?php

if(isset($_POST['login']))
{

	session_start();
 $_SESSION['email'] = $_POST['email'];
 $_SESSION['password'] = $_POST['first_password'];
  echo '<a href="account.php"> </a>';

$emails = $_POST['email'];
$passwords= $_POST['password'];

	$host='localhost';
	$user='root';
	$password='';
	$database='lele';
	$connect= mysqli_connect($host,$user,$password,$database);
if($connect){echo 'database connected';}

$query="SELECT * FROM register_form WHERE email LIKE '".$emails."'";
$result=mysqli_query($connect, $query);

$search= mysqli_fetch_assoc($result);

if($search['email'] == null) {header("location:sign_in.php");
}


if(($search['email'] != null)  && ($search['first_password'] == $passwords))
{
	$_SESSION['ID']=$search['id'];
	mysqli_close($connect);
	header("location:account.php"."?id=".$_SESSION['ID']."");
	}
else{header("location:sign_in.php");}

}


?>


		<div class="container">
			<p class="title"> Sign In </p>

			<form action ="" method ="POST" >
				<input type ="text" name="email" placeholder ="E-mail" >
				<input type ="password" name="password" placeholder ="Password" >
				<input type ="submit" name="login" value="Log In" >
				<a href="register_form.php" >don't have an Account?</a>

							<?php
							if( isset($_POST['login']) && ($_POST['email'] == 'admin') && ($_POST['password'] == '1') )
							{
								header("location:admin_home_page.php");
							}
							else if( isset($_POST['login']) && ($_POST['email'] == 'admin') && ($_POST['password'] == 'admin'))
							{
								header("location:admin_sign_in.php");
	    					}
							?>
		</div>

</body>

</html>

