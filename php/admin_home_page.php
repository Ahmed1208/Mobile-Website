<?php
require("edit.php");
?>

<?php
     $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='lele';
     $connect= mysqli_connect($host,$user,$password,$database);

?>

<?php
	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='admins';
     $connecta1= mysqli_connect($host,$user,$password,$database);
?>

<?php
$query1="SELECT COUNT(*) AS counting FROM register_form ";  		// number of users in register_form
$result1= mysqli_query($connect, $query1);
$counter =mysqli_fetch_assoc($result1);
?>

<?php
$querya1="SELECT COUNT(*) AS counting FROM admin_form ";
$resulta1= mysqli_query( $connecta1 , $querya1 );
$countera1=mysqli_fetch_assoc( $resulta1 );
$no_admins=$countera1['counting'];
?>



<?php
function display_all_users($connect,$counter)
{
	$query2="SELECT * FROM register_form";
$result2=mysqli_query( $connect , $query2 );

$query3="SELECT * FROM personal_information";
$result3=mysqli_query( $connect , $query3 );

$query4="SELECT * FROM mobile_info";
$result4=mysqli_query( $connect , $query4 );

  for($i=0;$i<$counter['counting'];$i++)
   {
	$display2=mysqli_fetch_assoc($result2);
	$queryx1="SELECT COUNT(*) AS countings FROM mobile_info WHERE mobile_id = '".$display2['id']."' ";
	$resultx1= mysqli_query($connect, $queryx1);
	$counterx1 =mysqli_fetch_assoc($resultx1);

	echo 'ID: ' .$display2['id'] .'</br>';
	echo 'EMAIL: ' .$display2['email'] .'</br>';
    echo 'PASSWORD: ' .$display2['first_password'].'</br>' ;
	echo 'TIME OF REGISTERATION: ' .$display2['time'].'</br>' ;

	$display3=mysqli_fetch_assoc($result3);
	echo 'NAME: ' .$display3['first_name'].' '.$display3['last_name'].'</br>' ;
    echo 'PHONE: ' .$display3['phone'] .'</br>';

	for($x=0;$x<$counterx1['countings'];$x++)
	{
		$display4=mysqli_fetch_assoc($result4);
		echo 'imei: ' . $display4['imei'].'</br>';
		echo 'phone primary number: ' .$display4['phone_primary_number'].'</br>';
		echo 'TIME OF ADDING PHONE: ' .$display4['mobile_time'].'</br>';
	}
	echo '</br></br>';
   }
}
?>

<?php
function display_user_by_search($connect,$selector,$edit)
{

 $result1s= mysqli_query($connect,$selector);
	 $output1s= mysqli_fetch_assoc($result1s);
     $_SESSION['ID']=$output1s['id'];
	echo 'ID: ' .$output1s['id'] .'</br>';
	echo 'EMAIL: ' .$output1s['email'] .'</br>';
    echo 'PASSWORD: ' .$output1s['first_password'].'</br>' ;
	echo 'TIME OF REGISTERATION: ' .$output1s['time'].'</br>' ;
																					//PERSONAL DATA
	 $query2s= "SELECT * FROM personal_information WHERE personal_id LIKE '".$output1s['id']."' ";
	 $result2s= mysqli_query($connect,$query2s);
	 $output2s= mysqli_fetch_assoc($result2s);
	echo 'NAME: ' .$output2s['first_name'].' '.$output2s['last_name'].'</br>' ;
    echo 'PHONE: ' .$output2s['phone'] .'</br>';
																//EDIT PERSONAL
	echo '
	<form action="" method="POST">
	<input type="submit" name="editp" value="EDIT" ></br></br>
	</form>
	';
           if($edit == "editp")
		   {
				form_p();
				echo'
				<form action="" method="POST">
				<input type="submit" name="update_personal" value="update">
				<input type="submit" name="cancel" value="cancel"></br></br>
				</form>
				';
		   }
																				//MOBILE DATA
		$queryxs1="SELECT COUNT(*) AS countings FROM mobile_info WHERE mobile_id = '".$output1s['id']."' ";
		$resultxs1= mysqli_query($connect, $queryxs1);
		$counterxs1 =mysqli_fetch_assoc($resultxs1);
		$_SESSION['no_of_phones']=$counterxs1['countings'];                        //$_SESSION['no_of_phones'] for a user
		$query3s="SELECT * FROM mobile_info";
		$result3s=mysqli_query( $connect , $query3s);

				$queryi="SELECT *FROM mobile_image WHERE image_id = '".$output1s['id']."'";
				$resulti= mysqli_query($connect, $queryi);

		$query_read="SELECT * FROM mobile_info WHERE mobile_id = '".$_SESSION['ID']."'";    	// for marking CHECKED
        $result_read=mysqli_query( $connect , $query_read );

	for($x=1;$x<=$counterxs1['countings'];$x++)
	{
		$display3s=mysqli_fetch_assoc($result3s);
		$row = mysqli_fetch_array($resulti);
		echo 'imei: ' . $display3s['imei'].'</br>';
		echo 'phone primary number: ' .$display3s['phone_primary_number'].'</br>';
		echo 'TIME OF ADDING PHONE: ' .$display3s['mobile_time'].'</br>';
		echo ' <img src="data:image/jpeg;base64,'.base64_encode($row['image'] ).'" height="200" width="200" class="img-thumnail" /></br>';

																//EDIT MOBILE
		echo'
		<form action="" method="POST">
		<input type="submit" name="edit'.$x.'" value="EDIT" ></br></br>
		</form>
		';
			if($edit == $x)
			{
			form_m();
			echo'
			<form action="" method="POST">
			<input type="submit" name="update_mobile" value="update">
			<input type="submit"  name="cancel" value="cancel"></br></br>
			</form>
			';
			}



						$row_read=mysqli_fetch_assoc( $result_read );

						if( $row_read['check_m'] != 'checked' )
						{
							echo'
							<form action="" method="POST">
							<input type="submit" name="check_button'.$x.'" value="checked">
							</form>
							';
						}
						else
						{
						echo 'ALREADY CHECKED by :'.$row_read['the_checker'];
						echo'</br></br>';
						}


	}
		if($edit != "editz")
		{
		echo'
		<form action="" method="POST">                 <! HNA 27NA BN5LY ZORAR "DELETE ACCOUNT" YZHAT FE 7ALT 2N 2L ADMIN 3AML SERACH FAKT 3LA 2L ACCOUNT DA , W M4 HAYZHAR 2L ZORAR FE 2Y 7ALA TANYA 5ALS
														  2L BY7SAL 2NY LMA BY3ML SEARCH BY3ML 2L ZORAR W Y5ROG BARA 2L LOOP !>
		<input type="submit" name="delete" value="DELETE ACCOUNT">
		</form>
		';
		}



}
?>

<?php
function display_all_admins($connecta1,$no_admins)
{
	$querya2="SELECT * FROM admin_form";
	$resulta2= mysqli_query( $connecta1 , $querya2 );


	for($z=0;$z<$no_admins;$z++)
	{
		$rowa2= mysqli_fetch_assoc( $resulta2 );

		echo 'ID: ' . $rowa2['id'] .'</br>' ;
		echo 'NAME: ' . $rowa2['name'] .'</br>' ;
		echo 'EMAIL: ' . $rowa2['email'] .'</br>' ;
		echo 'PASSWORD: ' . $rowa2['password'] .'</br>' ;
		echo 'DEGREE: ' . $rowa2['degree'] .'</br>' ;
		echo 'TIME OF ADDITION: ' . $rowa2['time'] .'</br>' ;
        echo'</br></br>';
	}
}
?>

<?php

function display_stolen($connect)
{

$query_counter="SELECT COUNT(*) FROM stolen_phones";
$result_counter=mysqli_query( $connect , $query_counter );
$row_counter=mysqli_fetch_assoc($result_counter);
$no_of_stolen_phones=$row_counter['COUNT(*)'];

$query_display_stolen="SELECT * FROM stolen_phones ";
$result_display_stolen=mysqli_query( $connect , $query_display_stolen );

for($xs=0;$xs<$no_of_stolen_phones;$xs++)
{
	$row_display_stolen=mysqli_fetch_assoc($result_display_stolen);

$query_display_email="SELECT * FROM register_form WHERE id = '".$row_display_stolen['stolen_id']."' ";
$result_display_email=mysqli_query( $connect , $query_display_email );
$row_display_email=mysqli_fetch_assoc($result_display_email);

echo 'NUMBER OF STOLEN PHONES: '.$no_of_stolen_phones.'</br></br>';

echo 'ID: ' .$row_display_stolen['stolen_id'].'</br>';
echo 'EMAIL: ' .$row_display_email['email'].'</br>';
echo 'IMEI: ' .$row_display_stolen['stolen_imei'].'</br>';
echo 'TIME OF STOLEN: ' .$row_display_stolen['stolen_time'].'</br>';
}


}

?>

<!DOCTYPE html>
<html>
<head><meta charset ="utf-8">
<title> Admin </title> </head>

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
<h4>WELCOME, "MASTER" Admin</h4>

<form action="" method="POST">
<input type="text" name="search_bar" placeholder="Search Users Here" >

<select name="searcher">
<option value="email"> email</option>
<option value="id"> id</option>
</select>

<input type="submit" name="search" value="search">
</form>
</br> </br>

<a href="admin_form.php" > MAKE AN ADMIN </a>
</br></br>

<form action="" method="POST">
<input type="submit" name="display_all_users" value="display users">
</form>
<div>

<form action="" method="POST">
<input type="submit" name="display_stolen" value="display stolen phones">
</form>

<form action="" method="POST">
<input type="submit" name="admins" value="Display Admins">
</form>

<?php
if(isset($_POST['display_all_users']))												/// DISPLAY ALL Users
{
	display_all_users($connect,$counter);
}
 else if(isset($_POST['search']) && !empty($_POST['search_bar']))        			/////////DISPALY BY SEARCH
{
	if($_POST['searcher'] == 'email')
	{
       $selector= "SELECT * FROM register_form WHERE email LIKE '".$_POST['search_bar']."' ";
	}
	else
	{
	   $selector= "SELECT * FROM register_form WHERE id LIKE '".$_POST['search_bar']."' ";

	}
        $edit="edit";
	display_user_by_search($connect,$selector,$edit);
}
else if( isset($_POST['admins']) )
{
	 display_all_admins($connecta1,$no_admins);
}


?>


</div>


<?php
	if(isset($_POST['editp']))
	{
		$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
		$edit="editp";
		display_user_by_search($connect,$selector,$edit);
	}

if(isset($_POST['edit1'])){$_SESSION['PRESS']= '1'; $edit="1";}
if(isset($_POST['edit2'])){$_SESSION['PRESS']= '2'; $edit="2";}
if(isset($_POST['edit3'])){$_SESSION['PRESS']= '3'; $edit="3";}

if( isset($_POST['edit1']) || isset($_POST['edit2'])  ||  isset($_POST['edit3']))
{
  $selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
  display_user_by_search($connect,$selector,$edit);
}

?>


<?php
if(isset($_POST['update_personal']))
{
		if( !empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['phone']) )
	{
		   $table_name="personal_information";
		   $id_name="personal_id";

			$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
			$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
			$row1 = mysqli_fetch_assoc( $result1 );

							display($connect , $table_name,$row1,"old");
							update_p($connect);

			$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
			$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
			$row1 = mysqli_fetch_assoc( $result1 );
$_SESSION['maker']="MASTER ADMIN";
							display($connect , $table_name,$row1,"new");
	}
	else
	{
		echo ' YOU HAVE TO ENTER ALL THE DATA </br></br></br>';
		$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
		$edit="editp";
		display_user_by_search($connect,$selector,$edit);

	}
}
?>

<?php
if(isset($_POST['update_mobile']) )
{
		if( !empty($_POST['imei']) && !empty($_POST['phoneprimarynumber']) && $_FILES['image']['size'] != 0 )
	{


											 if($_SESSION['PRESS'] == '1')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
										$row1 = mysqli_fetch_assoc( $result1 );

										$_SESSION['time']=$row1['mobile_time'];

											}
											else if($_SESSION['PRESS'] == '2')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR
										$row1 = mysqli_fetch_assoc( $result1 );
										$row1 = mysqli_fetch_assoc( $result1 );

										$_SESSION['time']=$row1['mobile_time'];
											}
											else if($_SESSION['PRESS'] == '3')
											{
												$table_name="mobile_info";
												$id_name="mobile_id";

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
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

										$query1="SELECT * FROM `".$table_name."` WHERE `".$id_name."` ='".$_SESSION['ID']."'";
										$result1= mysqli_query( $connect , $query1 );                // ROW WE ARE LOOKING FOR

										for($v=1;$v<=$_SESSION['no_of_phones'];$v++)
										{
										$row1 = mysqli_fetch_assoc( $result1 );
										}

$_SESSION['maker']="MASTER ADMIN";
			display($connect , $table_name,$row1,"new");

}
	else
	{
		echo ' YOU HAVE TO ENTER ALL THE DATA </br></br></br>';

		$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
		display_user_by_search($connect,$selector,$_SESSION['PRESS']);
	}
}
?>

<?php
if(isset($_POST['cancel']))
{
	$edit="edit";
	$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
	display_user_by_search($connect,$selector,$edit);
}
?>

</body>
</html>

<?php
if( isset($_POST['check_button1']) ){$mobile_no='1';}
else if( isset($_POST['check_button2']) ){$mobile_no='2';}
else if( isset($_POST['check_button3']) ){$mobile_no='3';}


if( isset($_POST['check_button1'])  ||  isset($_POST['check_button2'])  ||  isset($_POST['check_button3']))
{
	$query_read_x1="SELECT * FROM mobile_info WHERE mobile_id = '".$_SESSION['ID']."'";
    $result_read_x1=mysqli_query( $connect , $query_read_x1 );

	for($z=1;$z<=$mobile_no;$z++)
	{
		$row_read_x1 = mysqli_fetch_assoc( $result_read_x1 );
	}
	$imei_checking = $row_read_x1['imei'];

	mark_checked($connect,$imei_checking);

	$edit="nothing";
	$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
	display_user_by_search($connect,$selector,$edit);

}
?>

<?php
function mark_checked($connect,$imei_checking)
{
	$query_check="UPDATE mobile_info SET check_m ='checked' , the_checker='MASTER_ADMIN' WHERE imei = '".$imei_checking."' ";
	$result_check = mysqli_query( $connect , $query_check );
}
?>

<?php                                                ///// B3D KDA 2L CODE BYFDAL Y3ML LOOPS KTEER L7D MATDOS 3LA "DELETE ACCOUNT"  ////
if(isset($_POST['delete']))                          ////  (DA 2ZA KONT 3AMLT SEARCH) L2NO M4 BY5O4 GWA "IF()" TANY 5ALS            ////
{                                                    /////  LW DOST 3LA "DELETE ACCOUNT" , SA3THA 2L ZORAR HAT4AL W YZHAR ZORAR "YES"
													/////   BARDO BYFDAL Y3ML LOOP L7D M TDOS 3LA "YES"
													/////    LW DOST HAYMSA7 2L DATA MN 2L DATA BASE W Y5TFY BARDO 2L ZORAR


$edit="editz";
$selector= "SELECT * FROM register_form WHERE id LIKE '".$_SESSION['ID']."' ";
display_user_by_search($connect,$selector,$edit);

	echo'ARE U SURE :
<form action="" method="POST">
    <input type="submit" name="yess" value="yes">
	<input type="submit" name="cancel" value="cancel">
	</form>
	';
}
?>

<?php
	if(isset($_POST['yess']))
	{
	$query1d="DELETE FROM register_form 	   	   WHERE id='".$_SESSION['ID']."'";
	$query2d="DELETE FROM personal_information     WHERE personal_id='".$_SESSION['ID']."'";
	$query3d="DELETE FROM mobile_info          	   WHERE mobile_id='".$_SESSION['ID']."'";
	$query4d="DELETE FROM mobile_image        	   WHERE image_id='".$_SESSION['ID']."'";

	$result1d=mysqli_query( $connect , $query1d );
	$result2d=mysqli_query( $connect , $query2d );
	$result3d=mysqli_query( $connect , $query3d );
	$result4d=mysqli_query( $connect , $query4d );
	echo 'Data Cleared';
	}
?>

<?php
if(isset($_POST['display_stolen']))
{
display_stolen($connect);
}
?>