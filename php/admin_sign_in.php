<!DOCTYPE html>
<html>

<head></head>

<body>

<?php

if( isset($_POST['logan']) && !empty($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) && (!empty($_POST['password'])) )
{

	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='admins';
     $connect = mysqli_connect($host,$user,$password,$database);

	 $query="SELECT * FROM `admin_form` WHERE email LIKE '".$_POST['email']."'";
	 $result= mysqli_query( $connect , $query );
	 $check = mysqli_fetch_assoc($result);

		if( $check['email'] == NULL)
		{
			header("location:admin_sign_in.php");
		}
		else
		{
			if( ($check['password'] == $_POST['password']) &&  ($check['email'] == $_POST['email']))
			{
				$um=$check['degree'];
				header("location:admin_account.php"."?id=".$um."");
			}
		}
}
?>


<h1> Admin Sign in </h1>

<form action="" method="POST">

Email:
<?php
if(isset($_POST['logan']))
{
	if( empty($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) )
	{
		echo '---->please enter email';
	}
}
?>
<input type="text" name="email" placeholder="Enter Email" >
</br></br></br>

Password:
<?php
if(isset($_POST['logan']))
{
	if(empty($_POST['password']))
	{
		echo '----->please enter email';
	}
}
?>
<input type="password" name="password" placeholder="password" >
</br></br></br>

<input type="submit" name="logan" value="log in" >
</form>

</br></br></br></br></br>
<a href="sign_in.php" > BACK TO USER SIGN IN</a>


</body>
</html>