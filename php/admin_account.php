<?php
	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='lele';
     $connect = mysqli_connect($host,$user,$password,$database);
?>

<?php
$query="SELECT COUNT(*) AS counting FROM register_form ";
$result= mysqli_query( $connect , $query );
$counter=mysqli_fetch_assoc( $result );
$no_users=$counter['counting'];
?>

<?php
	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='admins';
     $connect2 = mysqli_connect($host,$user,$password,$database);

	 $queryy="SELECT *FROM admin_form WHERE id = '".$_GET['id']."'";
	 $resulty= mysqli_query( $connect2 , $queryy );
	 $rowy=mysqli_fetch_assoc( $resulty );
	 $degree=$rowy['degree'];
?>


<!DOCTYPE html>
<html>
<head></head>

<body>
<form action="" method="POST">
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
<h1>Welcome, Admin </h1>
</br></br></br></br>

<form action="" method="POST">
<input type="text" name="search_bar" placeholder="search by email">
<input type="submit" name="search" value="search">
</form>
</br></br>
<?php
if($degree == '1')
{
	echo'
<form action="" method="POST">
<input type="submit" name="display_users" value="display users">
</form>
</br></br>
';
}
?>

<?php

if( isset($_POST['display_users']) && ($degree == '1') )
{
				$query2="SELECT * FROM register_form";
				$result2= mysqli_query( $connect , $query2 );
				$row2= mysqli_fetch_assoc( $result2 );

				$query3="SELECT * FROM personal_information";
				$result3= mysqli_query( $connect , $query3 );
				$row3= mysqli_fetch_assoc( $result3 );

		for($i=0;$i<$no_users;$i++)
		{
			echo 'ID: ' . $row2['id'] .'</br>' ;
			echo 'EMAIL: ' . $row2['email'] .'</br>' ;
			echo 'PASSWORD: ' . $row2['first_password'] .'</br>' ;
			echo 'TIME OF REGISTERATION: ' . $row2['time'] .'</br>' ;

			echo 'NAME: ' . $row3['first_name'] . $row3['last_name'] . '</br>' ;
			echo 'PHONE: ' . $row3['phone'] .'</br>' ;

			    $query4="SELECT * FROM mobile_info";
				$result4= mysqli_query( $connect , $query4 );


	$query1="SELECT COUNT(*) AS counting FROM mobile_info WHERE mobile_id = '".$row2['id']."' ";
	$result1= mysqli_query( $connect , $query1 );
	$counter1=mysqli_fetch_assoc( $result1 );
	$no_mobiles=$counter1['counting'];


				for($x=0;$x<$no_mobiles;$x++)
				{
					$row4= mysqli_fetch_assoc( $result4 );

					echo 'imei: ' . $row4['imei'] .'</br>' ;
					echo 'PRIMARY_PHONE: ' . $row4['phone_primary_number'] .'</br>' ;
					echo 'TIME OF ADDING PHONE: ' . $row4['mobile_time'] .'</br>' ;
				}
		}

}
?>
<?php
if(isset($_POST['search']) &&( ($degree == '1') || ($degree == '2')  ))
{
	$querys1  = "SELECT * FROM register_form WHERE email LIKE '".$_POST['search_bar']."'";
	$results1 = mysqli_query( $connect , $querys1 );
	$rows1    = mysqli_fetch_assoc( $results1 );

  if( $rows1['email'] != NULL )
   {
	    $query1="SELECT COUNT(*) AS counting FROM mobile_info WHERE mobile_id = '".$rows1['id']."' ";
		$result1= mysqli_query( $connect , $query1 );
		$counter1=mysqli_fetch_assoc( $result1 );
		$no_mobiles=$counter1['counting'];

	$querys2  = "SELECT * FROM personal_information WHERE personal_id = '".$rows1['id']."'";
	$results2 = mysqli_query( $connect , $querys2 );
	$rows2   = mysqli_fetch_assoc( $results2 );

	$querys3  = "SELECT * FROM mobile_info WHERE mobile_id = '".$rows1['id']."'";
	$results3 = mysqli_query( $connect , $querys3 );
	$rows3   = mysqli_fetch_assoc( $results3 );

	$querys4  = "SELECT * FROM mobile_image WHERE image_id = '".$rows1['id']."'";
	$results4 = mysqli_query( $connect , $querys4 );
	$rows4 = mysqli_fetch_array( $results4 );

	        echo 'ID: ' . $rows1['id'] .'</br>' ;
			echo 'EMAIL: ' . $rows1['email'] .'</br>' ;
			echo 'PASSWORD: ' . $rows1['first_password'] .'</br>' ;
			echo 'TIME OF REGISTERATION: ' . $rows1['time'] .'</br>' ;

			echo 'NAME: ' . $rows2['first_name'] . $rows2['last_name'] . '</br>' ;
			echo 'PHONE: ' . $rows2['phone'] .'</br>' ;

			for($y=0;$y<$no_mobiles;$y++)
			{
			echo 'imei: ' . $rows3['imei'] .'</br>' ;
			echo 'PRIMARY_PHONE: ' . $rows3['phone_primary_number'] .'</br>' ;
			echo 'TIME OF ADDING PHONE: ' . $rows3['mobile_time'] .'</br>' ;
			echo ' <img src="data:image/jpeg;base64,'.base64_encode($rows4['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';
			}
   }

}

?>

</body>

</html>