<!DOCTYPE html>

<html>
<head>
<meta charset ="utf-8">
<title> Register Form </title>

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
<h1> Register Form </h1>

<form action ="" method ="POST" >

	 Email:</br>
	<?php
	if(isset($_POST['submit']))
	 {
	 if(empty($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
	 {
		 echo'please enter email';
	 }
	 }
	 ?>
<input type ="text" name="email" placeholder ="Your email" ></br>
</br></br>
	 Password:</br>
	  <?php
	 if(isset($_POST['submit']))
	 {
	 if(empty($_POST['first_password']))
	 {
		 echo'please enter password';
	 }
	 }
	 ?>
<input type ="password" name="first_password" placeholder ="Enter Strong Password" ></br>
</br></br>
	 Confirm Password:</br>
	<?php
	 if(isset($_POST['submit']))
	 {
	 if(empty($_POST['check_password']) || ($_POST['first_password'] != $_POST['check_password']))
	 {
		echo'please enter re-enter password';
	 }
	}
	?>
<input type ="password" name="check_password" placeholder ="Repeat password" ></br>

</br></br>

<input type ="submit" name="submit" value="submit" ></br>
</form>

<a href ="sign_in.php"> ALREADY HAVE AN ACCOUNT</a>



</body>

</html>