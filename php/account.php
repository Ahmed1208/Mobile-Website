<?php
require("edit.php");
?>

<?php


$email= $_SESSION['email'];
$id=$_SESSION['ID'];

echo 'WELCOME '; echo '</br></br>';
?>

<?php
     $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='lele';
     $connect= mysqli_connect($host,$user,$password,$database);
?>

<?php																				///COUNTING NO. OF PHONES ADD BY USER
$query1="SELECT COUNT(*) AS counting FROM mobile_info WHERE mobile_id = '$id' ";
$result1= mysqli_query( $connect , $query1 );
$counter =mysqli_fetch_assoc( $result1 );
echo 'NUMBER OF PHONES : ' . $counter['counting'];echo '</br></br>';
?>

<?php
function password_place()
{
echo'
<form action="" method="POST">
<input type="text" name="new_password" placeholder="Please enter new password"></br>
<input type="submit" name="submit_new_password" value="Change">
<input type="submit" value="cancel">
</form>
';
}
?>

<?php

if($counter['counting'] != '0' )
{																					////DISPLAY PERSONAL_INFORAMTION
$query2="SELECT * FROM personal_information WHERE PERSONAL_id = '$id' ";
$result2= mysqli_query($connect, $query2);
$row=mysqli_fetch_assoc($result2);
echo 'NAME :' . $row['first_name'] .' ' . $row['last_name'];echo '</br>';
echo 'PHONE : '. $row['phone'];echo '</br>';
echo '
<form action="" method="POST">
<input type="submit" name="editp" value="EDIT" >
</form>
';
}
if(isset($_POST['editp']))
{
	form_p();
	echo'
<form action="" method="POST">
<input type="submit" name="update_personal" value="update">
<input type="submit" value="cancel">
</form>
';
}
if(isset($_POST['update_personal']))
{
		if( !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone']) )
	{
		   $table_name="personal_information";
		   $id_name="personal_id";

			$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
			$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
			$row1 = mysqli_fetch_assoc( $result1 );

							display($connect , $table_name,$row1 , "old");
							update_p($connect);

			$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
			$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
			$row1 = mysqli_fetch_assoc( $result1 );
$_SESSION['maker']="USER";
display($connect , $table_name,$row1 ,"new");
header("location:account.php");
	}


	else
	{
		echo ' YOU HAVE TO ENTER ALL THE DATA </br>';
	}
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset ="utf-8">
<title> account page </title>
</head>
<body>

<div>
<?php
$query3="SELECT * FROM mobile_info WHERE mobile_id = '$id' ";
$result3= mysqli_query($connect, $query3);

for($i=1 ;$i<=$counter['counting']; $i++)
{
$row1=mysqli_fetch_assoc($result3);

$query_search="SELECT * FROM stolen_phones  WHERE stolen_imei LIKE '".$row1['imei']."' "; 			//SEARCH IF imei STORED IN TABLE stolen_phones
$result_search=mysqli_query( $connect , $query_search );											//SEARCH IF imei STORED IN TABLE stolen_phones
$row_search=mysqli_fetch_assoc($result_search);														//SEARCH IF imei STORED IN TABLE stolen_phones


																			///////DISPLAY MOBILE_INFO
echo 'imei :' . $row1['imei'] ;
if($row_search['stolen_imei'] != NULL) {
 echo' (STOLEN PHONE) WE ARE SORRY FOR THAT, AND WE WISH WE COULD HELP YOU';
 } echo '</br>';
echo 'PRIMARY PHONE ' . $row1['phone_primary_number'];echo '</br>';
echo 'TIME : '. $row1['mobile_time'];echo '</br>';
echo '</br>';
if($row_search['stolen_imei'] == NULL)
{
	echo'
	<form action="" method="POST">
	<input type="submit" name="edit'.$i.'" value="EDIT" >
	<input type="submit" name="stolen'.$i.'" value="stolen">
</form>
';
}


if(isset($_POST['edit1'])){$_SESSION['PRESS']= '1';}
else if(isset($_POST['edit2'])){$_SESSION['PRESS']= '2';}
else if(isset($_POST['edit3'])){$_SESSION['PRESS']= '3';}

if( isset($_POST['edit1']) || isset($_POST['edit2'])  ||  isset($_POST['edit3']))
{
if($_SESSION['PRESS'] == $i ){
	form_m();
		echo'
<form action="" method="POST">
<input type="submit" name="update_mobile" value="update">
<input type="submit" value="cancel">
</form>
';
}
}

if(isset($_POST['stolen1'])){$_SESSION['loop']= '1';}
else if(isset($_POST['stolen2'])){$_SESSION['loop']= '2';}
else if(isset($_POST['stolen3'])){$_SESSION['loop']= '3';}

if( isset($_POST['stolen1']) ||  isset($_POST['stolen2'])  ||  isset($_POST['stolen3']) )
{
	if($_SESSION['loop'] == $i)
	{
	echo'
	PLEASE CHOOSE TIME OF MISSING/STOLEN YOUR PHONE
		<form action="" method="POST">
		<input type="date" name="time"
        value="0000-00-00"
        min="2016-01-01" max="'.date("Y-m-d").'">
			<input type="submit" name="mark" value="mark as stolen">
			<input type="submit" value="cancel">
	</form>
	';
	}
}


	if(isset($_POST['mark']))
	{
	if($_SESSION['loop'] == $i )
	{
	$query_get1 = "SELECT * FROM mobile_info WHERE mobile_id = '".$id."'";
	$result_get1= mysqli_query ( $connect , $query_get1 );

for($yy=1;$yy<=$_SESSION['loop'];$yy++)
{

	$row_get1   = mysqli_fetch_assoc( $result_get1 );
}


    $query_add1 ="INSERT INTO stolen_phones (stolen_id , stolen_imei , stolen_time) VALUES ('".$row_get1['mobile_id']."'
																						  , '".$row_get1['imei']."'
																						  , '".$_POST['time']."')";

	$result_add1= mysqli_query( $connect , $query_add1 );
	if($result_add1)
	{
		header("location:account.php");
	}

	}
	}
 if(isset($_POST['update_mobile']) && $_SESSION['PRESS'] == $i )
{
		if( !empty($_POST['imei']) && !empty($_POST['phoneprimarynumber']) && $_FILES['image']['size'] != 0 )
	{


											 if($_SESSION['PRESS'] == '1')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
										$row1 = mysqli_fetch_assoc( $result1 );

										$_SESSION['time']=$row1['mobile_time'];

											}
											else if($_SESSION['PRESS'] == '2')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
										$row1 = mysqli_fetch_assoc( $result1 );
										$row1 = mysqli_fetch_assoc( $result1 );

										$_SESSION['time']=$row1['mobile_time'];
											}
											else if($_SESSION['PRESS'] == '3')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
										$row1 = mysqli_fetch_assoc( $result1 );
										$row1 = mysqli_fetch_assoc( $result1 );
										$row1 = mysqli_fetch_assoc( $result1 );

										$_SESSION['time']=$row1['mobile_time'];

											}

display($connect , $table_name,$row1,"old");

	update_m($connect );

	$table_name="mobile_info";
											$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$id."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR

										for($v=1;$v<=$counter['counting'];$v++)
										{
										$row1 = mysqli_fetch_assoc( $result1 );
										}

$_SESSION['maker']="USER";
display($connect , $table_name,$row1,"new");
header("location:account.php");
}
	else
	{
		echo ' YOU HAVE TO ENTER ALL THE DATA </br>';
	}
}

}
?>

</div>


<?php
if($counter['counting'] >=3)
{
	echo ' 3 PHONES IS MAX NUMBER CAN YOU ADD';echo '</br></br>';
}
else
{
	if($counter['counting'] >=1)
	{
echo '<a href="half_form_process.php?id='.$id.'">Mobile Form</a></br></br>';
    }
	else
	{
		echo '<a href="full_form_process.php?id='.$id.'">Mobile Form</a></br></br>';
	}
}
?>

<form action="" method="POST">
<input type="submit" name="change_password" value="Change Password">
</br>
<?php
if(isset($_POST['change_password']))
{
 password_place();
}
?>
<?php
if(isset($_POST['submit_new_password']))
{

if(empty($_POST['new_password']))
{
	password_place();
	echo 'PLEASE ENTER PASSWORD';
}
else
{
	$query_pass="UPDATE register_form SET first_password ='".$_POST['new_password']."' WHERE id ='$id' ";
	$result_pass=mysqli_query( $connect , $query_pass );
	if($result_pass){echo ' NEW PASSWORD SAVED';}
}
}
?>

</br></br></br>
<input type="submit" name="log_out" value="logout">
</form>


<?php
if(isset($_POST['log_out']))
{
$closing=mysqli_close($connect);
	if($closing){
		session_unset();
		session_destroy();
		header("location:sign_in.php");}
}
?>
</body>
</html>
