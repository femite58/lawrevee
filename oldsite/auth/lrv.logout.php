<?php

include "lrv.session.php";
include "lrv.dictionary.php";


if(isset($_GET['Logout'])){
    (new User)->logout();
}

unset($MPMemId);
session_unset();
session_destroy();


header("Location: ../auth/index.php");