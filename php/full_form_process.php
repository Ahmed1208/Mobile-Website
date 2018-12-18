<?php
echo 'FORM OF ADDING  A PHONE';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title> Full Form </title>
 </head>

<body>



<?php

if(isset($_POST['save']))
{

	if( (!empty($_POST['firstname'])) && (!empty($_POST['lastname'])) && (!empty($_POST['phones'])) && (!empty($_POST['imeis'])) && (!empty($_POST['phoneprimarynumber'])) && ($_FILES['image']['size'] != 0)  )
		 {

			 $host='localhost';
             $user='root';
             $password='';											/*this is for connection with database*/
             $database='lele';
             $connect= mysqli_connect($host,$user,$password,$database);

if($connect){echo'connected to database safe';}

$getno=$_GET['id'];
$first_name =  $_POST["firstname"];
$last_name = $_POST['lastname'];
$phone =  $_POST['phones'];
$imei = $_POST['imeis'];
$primary_phone = $_POST['phoneprimarynumber'];


$query2="INSERT INTO `personal_information`(`personal_id`,`first_name`, `last_name`,`phone`) VALUES ('".$getno."','".$first_name."' , '".$last_name."', '".$phone."')";
$result2=mysqli_query($connect, $query2);

$query3="INSERT INTO `mobile_info` (`mobile_id`,`imei`,`phone_primary_number`) VALUES ('".$getno."','".$imei."' ,'".$primary_phone."')";

$result3=mysqli_query($connect, $query3);

$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $query = "INSERT INTO `mobile_image`(image_id,image) VALUES ('".$getno."','$file')";
	  $resalto=mysqli_query($connect, $query);

	  	 if($resalto && $result2 && $result3){
			 echo'2l moo';
			 header("location:account.php");}
		 else{echo 'laaaaaaaaaaa2';}


		 }


}
?>




<h3> PERSONAL INFORMATION</h3>


<form  action=""  enctype="multipart/form-data"  method="POST">

<?php /*<input type="number" name="getter" placeholder="GET Number" >  */  ?>

<?php

if( isset($_POST['save'])){
	if(empty($_POST['firstname'])){
		echo 'please enter first name';
	}
}
?>
First Name:
<input type="text" name="firstname" placeholder ="first name" ></br></br>
<?php

if( isset($_POST['save'])){
	if(empty($_POST['lastname'])){
		echo 'please enter last name';
	}
}
?>
Last Name:
<input type="text" name="lastname" placeholder ="last name" ></br></br>
<?php

if( isset($_POST['save'])){
	if(empty($_POST['phones'])){
		echo 'please enter your phone for more secure';
	}
}
?>
Phone Number (for security):
<input type="number" name="phones" placeholder ="enter phone number for security" ></br></br>


<h3> MOBILE INFORMATION</h3>

<?php

if( isset($_POST['save'])){
	if(empty($_POST['imeis'])){
		echo 'please enter phone imei';
	}
}
?>
imei Number :
<input type="number" name="imeis" placeholder ="enter imei" ></br></br>
<?php

if( isset($_POST['save'])){
	if($_FILES['image']['size'] != 0 ){
		echo 'please enter evidence image ';
	}
}
?>
please upload image of imei on phone's box:
<input type="file" name="image" ></br></br>
<?php

if( isset($_POST['save'])){
	if(empty($_POST['phoneprimarynumber'])){
		echo 'please enter phone number';
	}
}
?>
Phone Primary Number:
<input type="number" name="phoneprimarynumber" placeholder ="enter phone primary number for security" ></br></br>


<input type="submit" name="save" value="save" >

<input type="submit" name="cancel" value="cancel">

</form>

</body>
</html>

<?php
if(isset($_POST['cancel']))
{
	header("location:account.php");
}
?>
