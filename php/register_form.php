<!DOCTYPE html>

<html>
<head>
<meta charset ="utf-8">
<title> Register Form </title>
<link rel="stylesheet" href="..\css\register_form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <meta name="theme-color" content="#333334">
    <meta name="msapplication-navbutton-color" content="#333334">
    <meta name="apple-mobile-web-app-status-bar-style" content="#333334">
</head>

<body>
<?php
if(isset($_POST['submit'])){
if( !empty($_POST['email']) && !empty($_POST['first_password']) && !empty($_POST['check_password']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && ($_POST['first_password'] == $_POST['check_password'])  )
	{




	$host='localhost';
	$user='root';
	$password='';											/*this is for connection with database*/
	$database='lele';
	$connect= mysqli_connect($host,$user,$password,$database);

	$email = $_POST['email'];
    $password= $_POST['first_password'];

	$query="INSERT INTO `register_form` (`email`, `first_password`) VALUES ('".$email."' , '".$password."')";
    $result=mysqli_query($connect, $query);
	if($result){
		echo'comoleted';
		header("location:sign_in.php");}
		else{echo 'already an account';}
	}
}
	?>
	<div class="container">
<p class="title"> Register Form </p>

<form action ="" method ="POST">

<input type ="text" name="email" autocomplete="off" placeholder ="E-mail" >

	<?php
	if(isset($_POST['submit']))
	 {
	 if(empty($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
	 {
		 echo'<p class="warning" id="php-email-warning">please enter valid E-mail</p>';
	 }
	 }
	 ?>
	 <p class="cssWarning" id="email-warning">test</p>

<input type ="password" name="first_password" placeholder ="Password" >
	 
	 <?php
	 if(isset($_POST['submit']))
	 {
	 if(empty($_POST['first_password']))
	 {
		 echo'<p class="warning">please enter Password</p>';
	 }
	 }
	 ?>
	 <p class="cssWarning" id="password1-warning">asd</p>

<input type ="password" name="check_password" placeholder ="Confirm password" >

<?php
	 if(isset($_POST['submit']))
	 {
	 if(empty($_POST['check_password']))
	 {
		echo'<p class="warning">please Re-enter Password</p>';
	 }else if(($_POST['first_password'] != $_POST['check_password'])){
		echo"<p class='warning'>Password don't match</p>";
	 }
	}
	?>
    <p class="cssWarning" id="password2-warning">asasg</p>

<input type ="submit" name="submit" value="Create an Account" >
</form>

<a href ="sign_in.php">already have an Account?</a>

<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="../js/register_form.js"></script>

</body>
</html>