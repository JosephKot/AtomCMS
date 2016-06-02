<?php

include('../config/connection.php');

$ds = DIRECTORY_SEPARATOR;  //1
$id = $_GET['id'];
 
$storeFolder = '../uploads';   //2
 
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$newname = time();
$random = rand(100,999);
$name = $newname.$random.'.'.$ext;

// Add the query for deleting a file before the update query
$q = "SELECT avatar FROM users WHERE id = $id"; //select the avatar image associated with the current user
$r = mysqli_query($dbc, $q); //store the result of the query in a variable
$old = mysqli_fetch_assoc($r);//store the result on a variable

$q = "UPDATE users SET avatar = '$name' WHERE id = $id";
$r = mysqli_query($dbc, $q);

echo $q.'<br>';
echo mysqli_error($dbc);
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $name;  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
	
	$deleteFile = $targetPath.$old['avatar'];
	
		if($old['avatar'] != '') { // check if it's not empty - it is not
			
			if(!is_dir($deleteFile)) { //check if it's not a directory - it is not
			
				unlink($deleteFile); //it is a file, so go ahead and delete it	
			
			}
		
		}
     
}
?> 
