<?php
	include("../functions.php");
if(isset($_FILES['file']['tmp_name'])) {
	
 if(@getimagesize($_FILES['file']['tmp_name'])){

   $name = $_FILES['file']['name'];
 $target_dir = "uploads/";
 $target_file = $target_dir . basename($_FILES['file']["name"]);

 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Valid file extensions
 $extensions_arr = array("jpg","jpeg","png","gif");

 // Check extension
 if( in_array($imageFileType,$extensions_arr) ){
 
 $temp = explode(".", $_FILES['file']["name"]);
$newfilename = round(microtime(true)) .'.' . end($temp);
  
  // Upload file
  move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$newfilename);

 
	$cimg = $newfilename;
	imageUpload($cimg);
	echo 0;
 }
	}
}
	


?>