<!DOCTYPE html>
<html>
<head>
<title>Admin Form</title>
</head>

<body>

<?php
if( isset($_POST['submit'])  && !empty($_POST['name']) && !empty($_POST['password'])  && !empty($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
{




	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='admins';
     $connect= mysqli_connect($host,$user,$password,$database);

	 $query1="INSERT INTO `admin_form` (name , email, password, degree) VALUES ('".$_POST['name']."' , '".$_POST['email']."' ,'".$_POST['password']."' ,'".$_POST['degree']."' )";
	 $result1= mysqli_query( $connect , $query1 );
	 if($result1)
	 {
		 echo ' <h3> ADMIN WAS ADDED </h3> </br>';



		 echo'
		 </br>
		 <form action="" method="POST">
		 <input type="submit" name="add_new_admin" value="ADD NEW Admin">
		 </form>
		 </br>
		 ';



	 }
	 else
	 {
		 echo 'Already Have An Account';
	 }





}
else
{



echo'
<h1> Admin Registration </h1>
<form action="" method="POST">

Admin Name:';


if( isset($_POST['submit']))
{
if( empty($_POST['name']))
{
	echo '---->please enter name';
}}
echo'
<input type="text" name="name" placeholder="Enter Full Name">
</br></br>

Email: ';

if( isset($_POST['submit']))
{
if(empty($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
{
	echo '---->please enter email';
}}
echo'
<input type="text"  name="email" placeholder="Enter Email">
</br></br>

Password:';

if( isset($_POST['submit']))
{
if( empty($_POST['password']))
{
	echo '---->please enter password';
}}
echo'
<input type="password" name="password" placeholder="Enter strong password">
</br></br>

<input type="text" name="degree" placeholder="Degree of Admin">
</br></br>

<input type="submit" name="submit" value="Make Admin">

</form>';
}
?>

<?php
if(isset($_POST['add_new_admin']))
{
	$_POST['SUBMIT']= NULL;
}

?>
</br></br></br>
<a href="admin_home_page.php"> BACK TO MASTER HOMEPAGE </a>
</body>
</html>