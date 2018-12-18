<?php
	 session_start();
?>
<?php
function display($connect , $table_name , $row1 ,$data_place)
{
	$querycount1="SELECT COUNT(*) AS counting FROM information_schema.columns WHERE table_schema = 'lele' AND table_name= '".$table_name."' ";
$resultcount1= mysqli_query( $connect , $querycount1 );
$rowc1=mysqli_fetch_assoc( $resultcount1 );
$no_of_personal_columns= $rowc1['counting'];                        // NUMBER OF COLUMNS


$query2="SELECT column_name FROM information_schema.columns WHERE table_schema = 'lele' AND table_name = '".$table_name."'";
$result2=mysqli_query( $connect , $query2 );                   // COLUMNS NAME

for($i=0;$i<$no_of_personal_columns;$i++)
{
	$row2=mysqli_fetch_assoc( $result2 ) ;

	$column_name =$row2['column_name'] . ' :';
	$data_inside_column = $row1[$row2['column_name']];

	 $host='localhost';
     $user='root';
     $password='';											/*this is for connection with database*/
     $database='admins';
     $connecta1= mysqli_connect($host,$user,$password,$database);

	if($data_place == 'old')
	{
		$query_send="INSERT INTO `old_new_data` (old_data ) VALUES ('".$column_name.$data_inside_column."') ";
		$result_send= mysqli_query( $connecta1 , $query_send );

		$query_get="SELECT id FROM old_new_data ORDER BY id DESC LIMIT 1";
		$result_get = mysqli_query( $connecta1 , $query_get );
		$row_get=mysqli_fetch_assoc($result_get);
		$_SESSION['x']=$row_get['id'];

	}

	else if($data_place== 'new')
	{


		$x=$_SESSION['x']-5;

		$x=$x+$i;

		$query_send="UPDATE old_new_data SET new_data = '".$column_name.$data_inside_column."' , maker ='".$_SESSION['maker']."'  WHERE id = '".$x."' ";
		$result_send = mysqli_query( $connecta1 , $query_send );

	  //  echo $row2['column_name'] . ' :';
		//echo $row1[$row2['column_name']];
		//echo '</br>';
}
}
}
?>

<?php
function form_p(){
echo'
<form action="" method="POST">
<input type="text" name="first_name" placeholder="First Name" ></br>
<input type="text" name="last_name" placeholder="Last Name" ></br>
<input type="number" name="phone" placeholder="Phone" ></br>
';
}
?>

<?php
	function form_m(){
echo'
<form action="" enctype="multipart/form-data" method="POST">
<input type="number" name="imei" placeholder ="enter imei" ></br>
<input type="number" name="phoneprimarynumber" placeholder ="enter phone primary number for security" ></br>
<input type="file" name="image" ></br>
';
}
?>

<?php
function update_p($connect){

$queryUA="UPDATE personal_information SET first_name ='".$_POST['first_name']."' , last_name ='".$_POST['last_name']."' , phone ='".$_POST['phone']."'
 WHERE personal_id = '".$_SESSION['ID']."'";
$resUA =mysqli_query( $connect , $queryUA ) ;
	}

?>

<?php
function update_m($connect)
{
$queryU1="UPDATE mobile_info SET imei ='".$_POST['imei']."' , phone_primary_number ='".$_POST['phoneprimarynumber']."' , check_m ='NOO' , the_checker='xx'
WHERE mobile_id = '".$_SESSION['ID']."' AND mobile_time = '".$_SESSION['time']."'";
$resU1 =mysqli_query( $connect , $queryU1 ) ;

$file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
$queryU3="UPDATE mobile_image SET image ='$file' WHERE image_id = '".$_SESSION['ID']."' AND image_time = '".$_SESSION['time']."'";
$resU3 =mysqli_query( $connect , $queryU3 ) ;
}
?>





