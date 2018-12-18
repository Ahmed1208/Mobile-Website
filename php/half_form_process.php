<?php
echo 'FORM OF ADDING  A PHONE';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title> Half Form </title>
</head>

<body>



<?php

if(isset($_POST['save']))
{

	if((!empty($_POST['imeis'])) && (!empty($_POST['phoneprimarynumber'])) && ($_FILES['image']['size'] != 0 ))
		 {

			 $host='localhost';
             $user='root';
             $password='';															/*this is for connection with database*/
             $database='lele';

             $connect= mysqli_connect($host,$user,$password,$database);

if($connect){echo'connected to database safe';}



$getno=$_GET['id'];


$imei = $_POST['imeis'];
$primary_phone = $_POST['phoneprimarynumber'];


$query3="INSERT INTO `mobile_info` (`mobile_id`,`imei`,`phone_primary_number`) VALUES ('".$getno."','".$imei."' ,'".$primary_phone."')";

$result3=mysqli_query($connect, $query3);

$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
      $query = "INSERT INTO `mobile_image`(image_id,image) VALUES ('".$getno."','$file')";
	  $result1 = mysqli_query($connect, $query);

	  if($result1 && $result3){
		  echo' leh bs kda';
		  header("location:account.php");
		  }


		 }


}
?>


<form  action=""  enctype="multipart/form-data"  method="POST">



<h3> MOBILE INFORMATION</h3>

<?php

if( isset($_POST['save'])){
	if(empty($_POST['imeis'])){
		echo 'please enter phone imei-->';
	}
}
?>
imei Number :
<input type="number" name="imeis" placeholder ="enter imei" ></br></br>
<?php

if( isset($_POST['save'])){
	if($_FILES['image']['size'] != 0 ){
		echo 'please enter evidence image--> ';
	}
}
?>
please upload image of imei on phone's box:
<input type="file" name="image" ></br></br>
<?php

if( isset($_POST['save'])){
	if(empty($_POST['phoneprimarynumber'])){
		echo 'please enter phone number-->';
	}
}
?>
Phone Primary Number:
<input type="number" name="phoneprimarynumber" placeholder ="enter phone primary number for security" ></br></br>


<input type="submit" name="save" value="save" >

<input type="submit" name="cancel" value="cancel">
</form>

</form>

</body>
</html>

<?php
if(isset($_POST['cancel']))
{
	header("location:account.php");
}
?>