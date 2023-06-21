<?php
include("../connect.php");

$query = "SELECT * FROM imageuploads ";
		$result = mysqli_query($link,$query);
		 while($row = mysqli_fetch_assoc($result)){
		     $uid[] = $row['id'];
             $imagename[] = $row['imgname'];
         }
         if(!empty($imagename)){
         for($i=count($imagename)-1; $i>=0; $i-- ){
             echo "<img src='uploads/$imagename[$i]' height='50px' width='50px' class='col-sm-3' style='border:1px solid #eee;' onclick=\" insertImageUrl('$imagename[$i]')\"/>";
         }
		 }
?>