<?php
//
//
//// 172800 48hrs ahead
//$runnerTimer = time();
//$databaseTimer = 1616916368 + 172800;
//
//
//
//$calcQuery = "SELECT COUNT(MPMemId) FROM lrvmemprofile WHERE MPBib = '$MPMemId'";
//$calcExe = $db->query($calcQuery);
//$calcGet = mysqli_fetch_assoc($calcExe);
//
//$db->query("UPDATE lrvmemprofile SET MPDigitalWallet = MPDigitalWallet + 1000 WHERE MPMemId = '$MPMemId'");
//
//
////foreach ($calcGet['MPActTime'] as $MPActTimer){
////
////    if ($MPActTimer <= $runnerTimer){
////        $db->query("UPDATE lrvmemprofile SET MPDigitalWallet = MPDigitalWallet + 1000 WHERE MPMemId = '$MPMemId'");
////    }
////}