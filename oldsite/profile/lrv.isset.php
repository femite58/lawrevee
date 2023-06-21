<?php

include "lrv.config.php";

header("Content-Type: application/json");

$dbProcesses = new Database();

$transactionId = 'TXN'.rand(0000000000,9999999999);

$baseTime = time() + 86400;



if (isset($_POST['CredId']) && isset($_POST['CredAmt'])){

    $CredId = $db->real_escape_string($_POST['CredId']);
    $CredAmt = $db->real_escape_string($_POST['CredAmt']);

    $CrSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$CredId'";
    $runCr = $db->query($CrSQL);
    $Cr = mysqli_fetch_array($runCr);
    $CrForm = $Cr['MPMemId'];

    if ($MPActPriv !== 'H'){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please follow the due process to credit Wallet.",
            )
        ));
    }

    else if (empty($CredAmt)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please specify amount to send.",
            )
        ));
    }

    else if (is_numeric($CredAmt)){
        if ($CredAmt < 100){
            die(json_encode(
                array(
                    "id" => 300,
                    "icon" => "error",
                    "header" => "ERROR!",
                    "body" => "Amount entered is too low for this transaction.",
                )
            ));
        }
        else if ($CredAmt > getLedgerBal()){
            die(json_encode(
                array(
                    "id" => 200,
                    "icon" => "warning",
                    "header" => "IGNORED!",
                    "body" => "Insufficient Ledger Balance",
                )
            ));
        }
        else {
            $db->query("INSERT INTO lrvmemmonitor(MMTxnId,MMFormNo,MMDescription,MMActPriv,MMAmount)
            VALUES('$transactionId',$CrForm,'Credit Alert - Process to credit your Wallet has been initiated !','P',$CredAmt)");
            $db->query("UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance - $CredAmt");
            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Successfully Sent, Waiting For Authorization",
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
                "body" => "Please enter a numeric value",
            )
        ));
    }
}

if (isset($_POST['WalId']) && isset($_POST['WalAmt'])){

    $WalId = $db->real_escape_string($_POST['WalId']);
    $WalAmt = $db->real_escape_string($_POST['WalAmt']);

    $WalSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$WalId'";
    $runWal = $db->query($WalSQL);
    $Wal = mysqli_fetch_array($runWal);
    $WalForm = $Wal['MPMemId'];
    $WalTitle = getTitle($Wal['MPTitle']);
    $WalFirst = $Wal['MPFirstName'];
    $WalLast = $Wal['MPLastName'];

    if (empty($WalAmt)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please specified amount.",
            )
        ));
    }
    else if ($WalForm == $MPMemId){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "You can't credit yourself from your own wallet.",
            )
        ));
    }
    else if (is_numeric($WalAmt)){
        if ($WalAmt < 100){
            die(json_encode(
                array(
                    "id" => 200,
                    "icon" => "warning",
                    "header" => "ERROR!",
                    "body" => "Amount specified is too low.",
                )
            ));
        }
        else if ($WalAmt > $MyWallet){
            die(json_encode(
                array(
                    "id" => 300,
                    "icon" => "error",
                    "header" => "ERROR!",
                    "body" => "Insufficient Balance, Check your Wallet balance.",
                )
            ));
        }
        else if (empty($WalForm)){
            die(json_encode(
                array(
                    "id" => 300,
                    "icon" => "error",
                    "header" => "ERROR!",
                    "body" => "User ID does not exist.",
                )
            ));
        }
        else {

            $dbProcesses->inserts('lrvmemmonitor',array(
                'MMTxnId' => $transactionId,
                'MMFormNo' => $WalForm,
                'MMDescription' => "Credit Alert - Your Wallet has been credited by $MPTitle $MPFirstName $MPLastName",
                'MMActPriv' => 'C',
                'MMAmount' => $WalAmt,
            ));
            $dbProcesses->inserts('lrvmemmonitor',array(
                'MMTxnId' => $transactionId,
                'MMFormNo' => $MPMemId,
                'MMDescription' => "Debit Alert - You transferred credit to $WalTitle $WalFirst $WalLast",
                'MMActPriv' => 'D',
                'MMAmount' => $WalAmt,
            ));

            $db->query("UPDATE lrvmemprofile SET MPWalletBalance = MPWalletBalance - $WalAmt WHERE MPMemId = '$MPMemId'");
            $db->query("UPDATE lrvmemprofile SET MPWalletBalance = MPWalletBalance + $WalAmt WHERE MPMemId = '$WalForm'");

            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Credit Sent Successfully.",
                )
            ));
        }
    }
    else{
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please enter a numeric value.",
            )
        ));
    }
}

if (isset($_POST['regSubmit'])){

    $regTitle = $db->real_escape_string($_POST['regTitle']);
    $regPkg = $db->real_escape_string($_POST['regPkg']);
    $regGender = $db->real_escape_string($_POST['regGender']);
    $regFirstName = $db->real_escape_string($_POST['regFirstName']);
    $regLastName = $db->real_escape_string($_POST['regLastName']);
    $regUserId = $db->real_escape_string($_POST['regUserId']);
    $regCountry = $db->real_escape_string($_POST['regCountry']);
    $regEmail = $db->real_escape_string($_POST['regEmail']);
    $regPhone = $db->real_escape_string($_POST['regPhone']);
    $regPassword1 = $db->real_escape_string($_POST['regPassword1']);
    $regPassword2 = $db->real_escape_string($_POST['regPassword2']);
    $regAddress = $db->real_escape_string($_POST['regAddress']);
    $regNOKName = $db->real_escape_string($_POST['regNOKName']);
    $regNOKPhone = $db->real_escape_string($_POST['regNOKPhone']);
    $regBank = $db->real_escape_string($_POST['regBank']);
    $regAcctNo = $db->real_escape_string($_POST['regAcctNo']);
    $iUserId = getTrueOrFalse('lrvmemprofile','MPUserId',$regUserId,'MPUserId');
    $RegAmt = getRegPkgAmt($regPkg);
    $vTitle = getTitle($regTitle);

    if ($RegAmt > $MyWallet){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "e-WALLET!",
                "body" => "e-Wallet balance is too low for this transaction.",
            )
        ));
    }
    else if (!in_array($regPkg,$pkgs)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "FATAL ERROR : Registration Error.",
            )
        ));
    }
    else if (empty($regFirstName)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please enter your first name.",
            )
        ));
    }
    else if (strtoupper($regUserId) == strtoupper($iUserId)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "warning",
                "header" => "EXIST!",
                "body" => "User ID provided already exist",
            )
        ));
    }
    else if (!empty($regEmail) && !filter_var($regEmail, FILTER_VALIDATE_EMAIL)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "FORMAT",
                "body" => "Email entered is not in the right format",
            )
        ));
    }
    else if (!empty($regPhone) && strlen($regPhone) !== 13){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "FORMAT",
                "body" => "Invalid phone number eg: 23480xxxxxxx",
            )
        ));
    }
    else if ($regPassword1 !== $regPassword2){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Confirm password did not match",
            )
        ));
    }
    else if (strlen($regPassword1) < 6){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Password must be 6 characters or above",
            )
        ));
    }
    else if (!empty($regNOKPhone) && strlen($regNOKPhone) !== 13){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "FORMAT!",
                "body" => "Next of kin phone number eg: 23480xxxxxxx",
            )
        ));
    }
    else if (!empty($regAcctNo) && strlen($regAcctNo) !== 10){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "Bank account number is not valid",
            )
        ));
    }
    else if (eWalletMinus($RegAmt) == TRUE && gLedgerPlus(10000) == TRUE){

        if ($RegAmt > 10000){
            $remBal = $RegAmt - 10000;
        }else{
            $remBal = 0;
        }
        $dbProcesses->inserts('lrvmemprofile',array(

            'MPTitle' => $regTitle,
            'MPFirstName' => $regFirstName,
            'MPLastName' => $regLastName,
            'MPUserId' => $regUserId,
            'MPPassword' => $regPassword2,
            'MPPhone' => $regPhone,
            'MPEmail' => $regEmail,
            'MPEntryPackage' => $regPkg,
            'MPActPriv' => 'Y',
            'MPBib' => $MPMemId,
            'MPWalletBalance' => $remBal,
            'MPGroup' => 'A',
            'MPGender' => $regGender,
            'MPEntryPayCheck' => 'Y',
            'MPActTime' => $baseTime,
            'MPCountry' => $regCountry,
            'MPBankName' => $regBank,
            'MPAccountNo' => $regAcctNo,
            'MPAddress' => $regAddress,
            'MPNextOfKinName' => $regNOKName,
            'MPNextOfKinPhone' => $regNOKPhone,
            'MPRegProCode' => 'C'

        ));
        $dbProcesses->inserts('lrvmemmonitor',array(

            'MMTxnId' => $transactionId,
            'MMFormNo' => $MPMemId,
            'MMDescription' => 'Debit Alert - Registration deduction for '.$vTitle.' '.$regFirstName.' ( User ID: '.$regUserId.' )',
            'MMActPriv' => 'D',
            'MMAmount' => $RegAmt,

        ));
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "SUCCESS",
                "body" => "Member Registration Successful",
            )
        ));
    }
    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Registration Error : Fail to open stream",
            )
        ));
    }
}

if (isset($_POST['getMember'])){

    $getMember = $db->real_escape_string($_POST['getMember']);

    $SearchSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$getMember'";
    $runSearch = $db->query($SearchSQL);
    $Sval = mysqli_fetch_array($runSearch);

    $f_name = getTitle($Sval['MPTitle']).' '.$Sval['MPFirstName'].' '.$Sval['MPLastName'];
    $phone_no = !empty($Sval['MPPhone'] ) ? $Sval['MPPhone'] : 'No phone number';

    if ($Sval['MPActPriv'] == 'D'){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Member with User ID [ $getMember ] is temporary disabled.",
            )
        ));
    }
    else if (empty($getMember)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please enter a value in the search box.",
            )
        ));
    }

    else if (!empty($Sval['MPUserId'])){
        die(json_encode(
            array(
                "id" => 100,
                "f_name" => $f_name,
                "phone_no" => $phone_no,
            )
        ));
    }

    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Invalid User ID selected.",
            )
        ));
    }
}

if (isset($_POST['apprTransaction'])){

    $ApprTxn = $db->real_escape_string($_POST['apprTransaction']);

    $ApprSQL = "SELECT * FROM lrvmemmonitor WHERE MMId = '$ApprTxn'";
    $runAppr = $db->query($ApprSQL);
    $Aprv = mysqli_fetch_array($runAppr);

    $AprForm = $Aprv['MMFormNo'];
    $AprAmt = $Aprv['MMAmount'];

    $up1 = $db->query("UPDATE lrvmemmonitor SET MMActPriv = 'A', 
        MMDescription = 'Credit Alert - Your wallet has been credited and approved. Thanks !' WHERE MMId = '$ApprTxn'");
    $up2 = $db->query("UPDATE lrvmemprofile SET MPWalletBalance = MPWalletBalance + '$AprAmt' WHERE MPMemId = '$AprForm'");

    if ($up1 && $up2){
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "SUCCESS!",
                "body" => "Approved Successfully.",
            )
        ));
    }

}

if (isset($_POST['rejTransaction'])){

    $RejTxn = $db->real_escape_string($_POST['rejTransaction']);

    $RejSQL = "SELECT MMAmount FROM lrvmemmonitor WHERE MMId = '$RejTxn'";
    $runRej = $db->query($RejSQL);
    $RejAmt = mysqli_fetch_array($runRej)[0];


    if (is_numeric($RejTxn)){

        $db->query("UPDATE lrvmemmonitor SET MMActPriv = 'B',
        MMDescription = 'Credit Alert - Operation cancelled by the admin. Thanks !' WHERE MMId = '$RejTxn'");
        $db->query("UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance + '$RejAmt'");

        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "DENIED!",
                "body" => "Transaction process has been denied.",
            )
        ));
    }
}

//if (isset($_POST['pinDiscarded'])){
//
//    $RejTxn = $db->real_escape_string($_POST['pinDiscarded']);
//
//    $RejSQL = "SELECT * FROM lrvmemmonitor WHERE MMId = '$RejTxn'";
//    $runRej = $db->query($RejSQL);
//    $Rej = mysqli_fetch_array($runRej);
//
//    $RejAmt = $Rej['MMAmount'];
//
//    $rej1 = $db->query("UPDATE lrvmemmonitor SET MMActPriv = 'B',
//        MMDescription = 'Credit Alert - This transaction has been rejected by the Admin !' WHERE MMId = '$RejTxn'");
//    $rej2 = $db->query("UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance + '$RejAmt'");
//
//    if ($rej1 && $rej2){
//        die(json_encode(
//            array(
//                "id" => 100,
//                "icon" => "success",
//                "header" => "STOPPED!",
//                "body" => "Funds has been send to GL Master",
//            )
//        ));
//    }
//
//}

if (isset($_POST['pinBlockQuery'])){

    $pinBlockQuery = $db->real_escape_string($_POST['pinBlockQuery']);

    $PinSQL = "SELECT PinAmount FROM lawrevee_admin.lrv_recharge_pin WHERE PinId = '$pinBlockQuery'";
    $runPin = $db->query($PinSQL);
    $PinAmt = mysqli_fetch_array($runPin)[0];

    if (is_numeric($pinBlockQuery)){
        $db->query("UPDATE lawrevee_admin.lrv_recharge_pin SET PinActPriv = 'B' WHERE PinId = '$pinBlockQuery'");
        $db->query("UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance + '$PinAmt'");
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "STOPPED!",
                "body" => "Funds has been send to GL Master",
            )
        ));
    }

}

if (isset($_POST['SearchMemId'])){

    $SearchMemId = $db->real_escape_string($_POST['SearchMemId']);

    $PinSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$SearchMemId'";
    $runPin = $db->query($PinSQL);
    $Pin = mysqli_fetch_array($runPin);
    $PinForm = $Pin['MPMemId'];
    $PinNames = getTitle($Pin['MPTitle']).' '.$Pin['MPFirstName'].' '.$Pin['MPLastName'];

    if (!empty($SearchMemId)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "Ignored : Nothing to search.",
            )
        ));
    }
    else if (!empty($Pin['MPMemId']) && strlen($SearchMemId) > 3){
        die(json_encode(
            array(
                "id" => 100,
                "member" => $PinForm,
                "feedback_name" => $PinNames,
                "feedback_icon" => "fa fa-check",
            )
        ));
    }
    else if (empty($Pin['MPMemId']) && strlen($SearchMemId) > 3){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "User ID does not exist",
            )
        ));
    }
}

if (isset($_POST['PinSubmit'])){

    $PinDesc = $db->real_escape_string($_POST['PinDesc']);
    $PinActPriv = $db->real_escape_string($_POST['PinActPriv']);
    $PinTo = $db->real_escape_string($_POST['PinTo']);
    $PinAmt = $db->real_escape_string($_POST['PinAmt']);
    $PinSubmit = $db->real_escape_string($_POST['PinSubmit']);

    if (empty($PinAmt) || $PinAmt < 100){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Please specify amount / Not lesser than 100 !",
            )
        ));
    }
    else if (getSuperUser($MPMemId) !== $MPMemId){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "You are not a super user !",
            )
        ));
    }
    else if (getSuperUser($MPMemId) == $MPMemId){
        if (gLedgerMinus($PinAmt) == 100){
            $dbProcesses->inserts('lawrevee_admin.lrv_recharge_pin',array(

                'PinDesc' => $PinDesc,
                'PinActPriv' => $PinActPriv,
                'PinRechargedBy' => $PinTo,
                'PinCreatedBy' => $PinSubmit,
                'PinAmount' => $PinAmt
            ));
            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "PIN Created Successfully !",
                )
            ));
        }
    }
}

if (isset($_POST['PinVal'])){

    $OfficePin = $db->real_escape_string($_POST['PinVal']);

    $PinSQL = "SELECT * FROM lawrevee_admin.lrv_recharge_pin WHERE PinDesc = '$OfficePin' ORDER BY PinCrtDate DESC LIMIT 1";
    $runPin = $db->query($PinSQL);
    $Pin = mysqli_fetch_array($runPin);
    $PinVal = $Pin['PinDesc'];
    $PinAmt = $Pin['PinAmount'];
    $fPinAmt = $Currency.' '.number_format($Pin['PinAmount'],2);

    if (empty($PinVal)){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Invalid PIN, try again.",
            )
        ));
    }
    else if ($Pin['PinActPriv'] == 'U' && $Pin['PinRechargedBy'] == $MPMemId){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "USED!",
                "body" => "PIN has been used by you.",
            )
        ));
    }
    else if ($Pin['PinActPriv'] == 'U' && $Pin['PinRechargedBy'] !== $MPMemId){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "USED!",
                "body" => "PIN has already been used by another member.",
            )
        ));
    }
    else if ($Pin['PinActPriv'] == 'B'){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "The pin entered has expired, please contact admin.",
            )
        ));
    }
    else if ($Pin['PinActPriv'] == 'I' && $Pin['PinRechargedBy'] == $MPMemId){

        if (eWalletPlus($PinAmt) == TRUE && iRecharge($PinVal) == TRUE){
            $dbProcesses->inserts('lrvmemmonitor',array(

                'MMTxnId' => $transactionId,
                'MMFormNo' => $MPMemId,
                'MMDescription' => 'Credit Alert - You have successfully recharge through PIN',
                'MMActPriv' => 'C',
                'MMAmount' => $PinAmt
            ));
            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Your recharge of $fPinAmt is successful.",
                )
            ));
        }
    }
    else if ($Pin['PinActPriv'] == 'I' && $Pin['PinRechargedBy'] !== $MPMemId){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "ERROR!",
                "body" => "This is a special PIN number.",
            )
        ));
    }
    else if ($Pin['PinActPriv'] == 'A' || empty($Pin['PinActPriv'])){

        if (eWalletPlus($PinAmt) == 100 && iRecharge($PinVal) == 100){
            $dbProcesses->inserts('lrvmemmonitor',array(

                'MMTxnId' => $transactionId,
                'MMFormNo' => $MPMemId,
                'MMDescription' => 'Credit Alert - You have successfully recharge through PIN',
                'MMActPriv' => 'C',
                'MMAmount' => $PinAmt
            ));
            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Your recharge of $fPinAmt is successful.",
                )
            ));
        }
    }
}

if (isset($_POST['setLegsOwner']) && isset($_POST['setLegsFrom']) && isset($_POST['setLegTo'])){

    $bOwner = $db->real_escape_string($_POST['setLegsOwner']); // This is the owner of the process
    $bSlave = $db->real_escape_string($_POST['setLegsFrom']); // This is coming from the table
    $bSide = $db->real_escape_string($_POST['setLegTo']); // This has value of 1 or 2
    $side = 'B'.$bSide;

    $PositionSQL = "SELECT COUNT(MPMemId) FROM lrvmemprofile WHERE MPSponsorId = '$bOwner' AND MPGroup = '$side'";
    $runPosition = $db->query($PositionSQL);
    $Position = mysqli_fetch_array($runPosition)[0];

    if($Position){
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Position selected is not empty.",
            )
        ));
    }
    elseif (empty($Position) && is_numeric($bOwner) && is_numeric($bSlave) && is_numeric($bSide)){
        $db->query("UPDATE lrvmemprofile SET MPSponsorId = '$bOwner', MPGroup = '$side' WHERE MPMemId = '$bSlave'");
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "SUCCESS!",
                "body" => "Position $bSide Successfully Added.",
            )
        ));
    }
    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Failed to open stream, contact Admin.",
            )
        ));
    }
}

if (isset($_POST['memToActivate'])){

    $memToActivate = $db->real_escape_string($_POST['memToActivate']);
    $regFullName = getSpName($memToActivate);

    if (is_numeric($memToActivate) && $MyWallet > 10000){
        if (eWalletMinus(10000) == TRUE && gLedgerPlus(10000) == TRUE){
            $dbProcesses->updates('lrvmemprofile',array(

                'MPGroup' => 'A',
                'MPActPriv' => 'Y',
                'MPBib' => $MPMemId,
                'MPEntryPayCheck' => 'Y',
                'MPActTime' => $baseTime,
                'MPRegProCode' => 'C',

            ),array(
                'MPMemId =' => $memToActivate,
            ));

            $dbProcesses->inserts('lrvmemmonitor',array(

                'MMTxnId' => $transactionId,
                'MMFormNo' => $MPMemId,
                'MMDescription' => 'Debit - Account activation for '.$regFullName,
                'MMActPriv' => 'D',
                'MMAmount' => 10000,

            ));

            die(json_encode(
                array(
                    "id" => 100,
                    "icon" => "success",
                    "header" => "SUCCESS!",
                    "body" => "Member activated successfully.",
                )
            ));
        }
    }
    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Ignored : Insufficient e-Wallet Balance.",
            )
        ));
    }
}

if (isset($_POST['worldSearch'])){

    $worldSearch = $db->real_escape_string($_POST['worldSearch']);

    $SearchSQL = "SELECT * FROM lrvmemprofile WHERE MPUserId = '$worldSearch'";
    $exeSearch = $db->query($SearchSQL);
    $Search = mysqli_fetch_array($exeSearch);

    if (empty($worldSearch)){
        die(json_encode(
            array(
                "id" => 200,
                "icon" => "warning",
                "header" => "EMPTY!",
                "body" => "Nothing in the search box.",
            )
        ));
    }
    elseif ($Search['MPBib'] == $MPMemId && $Search['MPEntryPayCheck'] == 'Y'){
        die(json_encode(
            array(
                "id" => 100,
                "icon" => "success",
                "header" => "SUCCESS!",
                "body" => "Please wait, While we prepare this ID.",
                "url" => "index.php?get=TreeView2&vTree=".$Search['MPMemId']
            )
        ));
    }
    elseif (empty($Search['MPBib']) && $Search['MPEntryPayCheck'] !== 'Y' && $Search['MPActPriv'] == 'P'){
        die(json_encode(
            array(
                "id" => 600,
                "icon" => "warning",
                "header" => "CONFIRM ?",
                "body" => "This member is not active and payment is not yet confirmed, Would you like to activate the ID and probably placed under your network.? This action will deduct a Business Package amount from your e-Wallet",
                "user_id" => $Search['MPMemId']
            )
        ));
    }
    else{
        die(json_encode(
            array(
                "id" => 300,
                "icon" => "error",
                "header" => "ERROR!",
                "body" => "Member can not be mounted in the target box",
            )
        ));
    }
}

