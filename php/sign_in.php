<!DOCTYPE html>

<html>
<head>
<meta charset ="utf-8">
<title> Sign-in </title>


</head></head>

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

if($search['email'] == null) {header("location:sign_in.php");}


if(($search['email'] != null)  && ($search['first_password'] == $passwords))
{
	$_SESSION['ID']=$search['id'];
	mysqli_close($connect);
	header("location:account.php"."?id=".$_SESSION['ID']."");
	}
else{header("location:sign_in.php");}

}


?>


							<h1> Sign in </h1>

							<form action ="" method ="POST" >

							 Email:
							<input type ="text" name="email" placeholder ="Your email" ></br>      <! text="email" may not work with safari >
</br></br>
						 Password:
							<input type ="password" name="password" placeholder ="Enter Strong Password" ></br>
</br></br>


							</br>
							</br>
							<input type ="submit" name="login" value="LOG IN" ></br></br></br>
							<a href="register_form.php" >MAKE AN ACCOUNT</a>

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

</body>

</html>

