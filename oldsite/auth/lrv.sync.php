<?php

$db_host = "localhost";
$db_user = "lawrevee_sync";
$db_pass = "L@wrevee123$";
$db_name = "lawrevee_lawrevee";

//$db_host = "localhost";
//$db_user = "olive";
//$db_pass = "Tensys123$";
//$db_name = "lawrevee_lawrevee";

$db = new mysqli($db_host, $db_user, $db_pass, $db_name) or die("Connect failed: %s\n" . $db->error);