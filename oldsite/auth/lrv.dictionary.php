<?php
include "lrv.sync.php";

$user = new User();

$Profile = $user->isLogged() ? $user->UsrProfile() : array();

$MPMemId = $Profile['MPMemId'];

//------------Form Number Definition

function myTitle($db,$TitleCode){

    $TitleSQL = $db->query("SELECT MTDesc FROM lrvmemtitle WHERE MTActPriv = 'A' AND MTId = '$TitleCode'");
    return mysqli_fetch_array($TitleSQL)[0];
}

$MPTitle = myTitle($db,$Profile['MPTitle']);
$MPFirstName = $Profile['MPFirstName'];
$MPLastName = $Profile['MPLastName'];
$MPUserId = $Profile['MPUserId'];
$MPPhone = $Profile['MPPhone'];
$MPEmail = $Profile['MPEmail'];
$MPAccountNo = $Profile['MPAccountNo'];
$MPBib = $Profile['MPBib'];
$MyFullName = $MPTitle.' '.$MPFirstName.' '.$MPLastName;

//------------------------------ Variable Definition Start

$ActPrivSQL = "SELECT MPActPriv FROM lrvmemprofile WHERE MPMemId = '$MPMemId'";
$MPActPriv = mysqli_fetch_array($db->query($ActPrivSQL))[0];

//---------------------------------------- Wallet Declaration

$WalletSQL = "SELECT MPWalletBalance FROM lrvmemprofile WHERE MPMemId = '$MPMemId'";
$MyWallet = mysqli_fetch_array($db->query($WalletSQL))[0];
