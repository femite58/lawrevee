<?php

include 'lrv.session.php';
include 'lrv.sync.php';
include 'lrv.online.php';

header("Content-Type: application/json");
$arr_ActPriv = array('A','H','Y');

$dbProcesses = new Database();

if (isset($_POST['qRegSubmit'])){

    $arrayInsert = array('qRegSponsor','qRegId','qRegFirst','qRegLast','qRegPhone','qRegPassword');
    $arrayCount = count($arrayInsert) - 1;

    foreach ($arrayInsert as $values){
        $qReg[] = $db->real_escape_string($_POST[$values]);

        if (empty($qReg[$arrayCount])){
            print_r($qReg[$arrayCount]);
        }
    }
    function validId($id){
        global $db;
        $id_Query = "SELECT MPMemId FROM lrvmemprofile WHERE MPUserId = '$id' LIMIT 1";
        $exe_id = $db->query($id_Query);
        return mysqli_fetch_array($exe_id)[0];
    }
    $validSprId = validId($qReg[0]);

    if (validId($qReg[1]) >= 1){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "User ID exist, try another one !",
            )
        ));
    }
    elseif (empty($qReg[2])){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "EMPTY!",
                "body" => "Please fill in first name",
            )
        ));
    }
    elseif (empty($qReg[3])){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "EMPTY!",
                "body" => "Please fill in last name.",
            )
        ));
    }
    elseif (strlen($qReg[4]) !== 13){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "INVALID!",
                "body" => "Follow format phone # (eg: 23480xxxxxxx)",
            )
        ));
    }
    elseif (empty($qReg[5])){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "Please enter a password to save your profile.",
            )
        ));
    }
    elseif (strlen($qReg[5]) < 6){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "warning",
                "header" => "INVALID!",
                "body" => "Password length must be 6 or above.",
            )
        ));
    }
    elseif ($qReg[0] && empty($validSprId)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Invalid Sponsor ID!",
            )
        ));
    }
    elseif (1 + 1 == 2){

        $dbProcesses->inserts('lrvmemprofile',array(
            'MPBib' => $validSprId?$validSprId:0,
            'MPUserId' => $qReg[1],
            'MPFirstName' => $qReg[2],
            'MPLastName' => $qReg[3],
            'MPActPriv' => 'P',
            'MPPhone' => $qReg[4],
            'MPGroup' => 'A',
            'MPUpdateChk' => 'N',
            'MPEntryPayCheck' => 'N',
            'MPPassword' => $qReg[5],
        ));
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "SUCCESS!",
                "body" => "Thank you.! Registration Successful",
            )
        ));
    }
    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Error encountered.! Please Contact Admin",
            )
        ));
    }
}

if(isset($_POST['btnSubmit'])){

    $MPAuthentication = $db->real_escape_string($_POST['Target']);
    $MPPassword = $db->real_escape_string($_POST['Key']);

    $userQuery = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$MPAuthentication' AND MPPassword = '$MPPassword'";
    $runQuery = $db->query($userQuery);
    $fetchQuery = mysqli_fetch_array($runQuery);

    $ActPriv = $fetchQuery['MPActPriv'];
    $UpdateChk = $fetchQuery['MPUpdateChk'];
    $Password = $fetchQuery['MPPassword'];

    if($UpdateChk == 'N'){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "UPDATE!",
                "body" => "Your profile needs update, please wait..!",
                "url" => "../profileupdate/",
            )
        ));
    }
    else if ($ActPriv == 'P') {
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Contact your sponsor, account not active.",
                "url" => "index.php",
            )
        ));
    }
    else if ($ActPriv == 'D') {
        die(json_encode(
            array(
                "id" => 500,
                "icon" => "ERROR",
                "header" => "DEACTIVATED!",
                "body" => "Account Temporary Deactivated.",
                "url" => "index.php",
            )
        ));
    }
    else if (in_array($ActPriv,$arr_ActPriv) && $Password == $_POST['Key']){

        $user = new User();
        if($user->login($db,$_POST['Target'], $_POST['Key'])) {

            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Login Successful ( Please Wait.. )",
                    "url" => "../profile/",
                )
            ));
        }
    }
    else {
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Invalid Username or Password.",
                "url" => "index.php",
            )
        ));
    }
}

if (isset($_POST['fetchSupervisor'])){

    $fetchSupervisor = $db->real_escape_string($_POST['fetchSupervisor']);
    $bibQuery = $db->query("SELECT * FROM lrvmemprofile WHERE MPUserId = '$fetchSupervisor'");
    $bib = mysqli_fetch_array($bibQuery);

    $tSql = $db->query("SELECT MTDesc FROM lrvmemtitle WHERE MTActPriv = 'A' AND MTId =".$bib['MPTitle']);
    $rTitle = mysqli_fetch_array($tSql)[0];

    $rNames = $rTitle.' '.$bib['MPFirstName'].' '.$bib['MPLastName'];
    die(json_encode(
        array(
            "vNames" => $rNames,
        )
    ));
}

if (isset($_POST['Mobile']) && isset($_POST['Email']) && isset($_POST['Message'])) {

    $Mobile = $db->real_escape_string($_POST['Mobile']);
    $Email = $db->real_escape_string($_POST['Email']);
    $Message = $db->real_escape_string($_POST['Message']);

    $confSql = $db->query("SELECT 1 FROM lrvmsgbox 
        WHERE MBMobileNo = '$Mobile' AND MBEmail = '$Email' AND MBMsg = '$Message'");
    $confSave = mysqli_fetch_array($confSql)[0];

    if (empty($Mobile) || empty($Email) || empty($Message)) {
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "Please fill all fields, Thanks !.",
            )
        ));
    }
    elseif ($confSave >= 1) {
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "This message has already been sent, Thanks !.",
            )
        ));
    }
    elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please enter a valid email address !.",
            )
        ));
    }
    elseif (is_numeric($Mobile) && strlen($Mobile) >= 11) {
        $MsgSQL = "INSERT INTO lrvmsgbox (MBMobileNo,MBEmail,MBMsg) VALUES('$Mobile','$Email','$Message')";
        $runMsg = $db->query($MsgSQL) or $db->close();
        if ($runMsg){
            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Thank you ! Message Sent Successfully.",
                )
            ));
        }
    }
    else{
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "Please enter a valid phone number, Thank you !.",
            )
        ));
    }
}