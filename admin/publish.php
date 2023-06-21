<?php
include("../functions.php");
include("../connect.php");
if(isset($_COOKIE["uid"]) ){
	$uid = $_COOKIE["uid"]; 
$eml = $_COOKIE["eml"]; 
}

$pid = $_REQUEST["pid"];
$action = sanitizeInput($_REQUEST["action"]);
$result ="";

if($action=="publish"){
$result = publish($pid);
}else if($action=="unpublish"){
$result = unpublish($pid);
}

echo $result;
?>

