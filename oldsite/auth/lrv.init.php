<?php

include "lrv.sync.php";

$pCodeQuery = $db->query("SELECT RPCode FROM lawrevee_admin.lrv_reg_pkgs WHERE RPActPriv = 'A'");
while ($k = mysqli_fetch_array($pCodeQuery)) {
    $pkgs[] = $k['RPCode'];
}

$bibQuery = $db->query("SELECT MPMemId FROM lrvmemprofile WHERE MPActPriv IN('Y','A','P')");
while ($k = mysqli_fetch_array($bibQuery)) {
    $bibs[] = $k['MPMemId'];
}

//$rand = (rand(1000,1000000000));

$ContRegPro = isset($_GET['p']) ? $_GET['p'] : 0;
$ContRegCont = isset($_GET['c']) ? $_GET['c'] : 0;

$Query = $db->query("SELECT * FROM lrvmemprofile WHERE MPRegProCode = '$ContRegPro'");
$getRegPro = mysqli_fetch_array($Query);
$MPEntryPackage = $getRegPro['MPEntryPackage'];

$RegAmtCode = isset($_GET['pkg']) ? $_GET['pkg'] : 0;
$RegSponsor = isset($_GET['bib']) ? $_GET['bib'] : 0;

function getSpName($value)
{
    global $db;
    $SQLFirst = "SELECT * FROM lrvmemprofile WHERE MPMemId = '$value'";
    $runFirst = $db->query($SQLFirst) or $db->close();
    $exeUpL = mysqli_fetch_array($runFirst);

    $getTitle = $exeUpL['MPTitle'];
    $MPFirstName = $exeUpL['MPFirstName'];
    $MPLastName = $exeUpL['MPLastName'];
    $MPActPriv = $exeUpL['MPActPriv'];

    $SpSQL = "SELECT MTDesc FROM lawrevee_lawrevee.lrvmemtitle WHERE MTId = '$getTitle'";
    $runSp = $db->query($SpSQL);
    $MPTitle = mysqli_fetch_array($runSp)[0];

    switch ($MPActPriv) {
        case "H":
        case "A":
        case "P":
        case "Y":
            return $MPTitle . " " . $MPFirstName . " " . $MPLastName;
            break;
        case "D":
            return "<red>Sponsor Account Temporary Disabled</red>";
            break;
        default:
            return "<yl>Automatic</yl>";
    }
}

function TreeNames($value)
{

    global $db;
    $SQLFirst = "SELECT * FROM lrvmemprofile WHERE MPMemId = '$value'";
    $runFirst = $db->query($SQLFirst) or $db->close();
    $exeUpL = mysqli_fetch_array($runFirst);

    $getTitle = $exeUpL['MPTitle'];
    $MPFirstName = $exeUpL['MPFirstName'];
    $MPLastName = $exeUpL['MPLastName'];
    $MPActPriv = $exeUpL['MPActPriv'];

    $SpSQL = "SELECT MTDesc FROM lawrevee_lawrevee.lrvmemtitle WHERE MTId = '$getTitle'";
    $runSp = $db->query($SpSQL);
    $MPTitle = mysqli_fetch_array($runSp)[0];

    switch ($MPActPriv) {
        case "H":
        case "A":
        case "P":
        case "Y":
            return $MPTitle . " <br> " . $MPFirstName . " <br> " . $MPLastName;
            break;
        case "D":
            return "<red>Account <br> Disabled</red>";
            break;
        default:
            return "<yl>Empty</yl>";
    }
}

function getRegPkgDesc($PkgRPDesc)
{

    global $db;
    $PkgValSQL = "SELECT RPDesc FROM lawrevee_admin.lrv_reg_pkgs WHERE RPActPriv = 'A' AND RPCode = '$PkgRPDesc'";
    $runSQL = $db->query($PkgValSQL);

    return $runSQL ? mysqli_fetch_array($runSQL)[0] : 'NO PACKAGE SELECTED';

}

function getRegPkgAmt($PkgRPAmt)
{

    global $db;
    $PkgAmtSQL = "SELECT RPAmt FROM lawrevee_admin.lrv_reg_pkgs WHERE RPActPriv = 'A' AND RPCode = '$PkgRPAmt'";
    $runAmtSQL = $db->query($PkgAmtSQL);
    $amtVal = mysqli_fetch_array($runAmtSQL)[0];

    return $amtVal ? $amtVal : "<b style='color: red'>Registration Error - #0000 -</b>";
}

function getPkgSelectOptions($PkgOptions)
{

    global $db;
    global $Currency;
    $PkgSQL = "SELECT * FROM lawrevee_admin.lrv_reg_pkgs WHERE RPActPriv = 'A'";
    $runSQL = mysqli_query($db, $PkgSQL);
    $status_name = '';

    while ($fetch = mysqli_fetch_array($runSQL)) {
        $RPCode = $fetch['RPCode'];

        $selected = $PkgOptions == $RPCode ? " selected " : "";
        $status_name .= "<option value='$RPCode' $selected>" . $fetch['RPDesc'] . ' - ' . $Currency . ' ' . number_format($fetch['RPAmt'], 2) . "</option>";

    }
    return $status_name;
}

function getTitleSelectOptions()
{

    global $db;
    $TitleSQL = "SELECT * FROM lrvmemtitle WHERE MTActPriv = 'A'";
    $ExeTitle = mysqli_query($db, $TitleSQL);
    $TRowsDesc = '';

    while ($TitlesRows = mysqli_fetch_assoc($ExeTitle)) {
        $TRows = $TitlesRows['MTId'];
        $TRowsDesc .= "<option value='$TRows' >" . $TitlesRows['MTDesc'] . "</option>";
    }
    return $TRowsDesc;
}

function getTrueOrFalse($valTab, $valCol, $valCheck, $valResult)
{

    global $db;
    $RegCheckSQL = "SELECT $valResult FROM $valTab WHERE $valCol = '$valCheck'";
    return mysqli_fetch_array(mysqli_query($db, $RegCheckSQL))[0];
}

$ContRegPro2 = getTrueOrFalse('lrvmemprofile', 'MPRegProCode', $ContRegPro, 'MPRegProCode');

$True1 = getTrueOrFalse('lrvmemprofile', 'MPMemId', $RegSponsor, 'MPMemId');

$SponsorActPriv = getTrueOrFalse('lrvmemprofile', 'MPMemId', $RegSponsor, 'MPActPriv');

function fromDB($Selected, $Table, $Compare1, $Compare2)
{

    global $db;
    $DataSQL = "SELECT $Selected FROM $Table WHERE $Compare1 = '$Compare2'";
    $runMemSQL = $db->query($DataSQL);

    return mysqli_fetch_array($runMemSQL)[0];
}

$RegFormNo = fromDB('MPMemId', 'lrvmemprofile', 'MPRegProCode', $ContRegPro2);

$Usr = "SELECT CMemId FROM lrvdownlinectrl WHERE CUserId = '$MPMemId' AND CGroup = 'V'";
$runUsr = $db->query($Usr);
$TreeUsr = mysqli_fetch_array($runUsr)[0];
//------------------------------
$TrQuery = "SELECT * FROM lrvmemprofile WHERE MPMemId = '$TreeUsr'";
$runTr = $db->query($TrQuery);
$proTr = mysqli_fetch_array($runTr);

function UpdateCol($Change)
{

    global $db;
    global $ContRegPro2;
    $DataSQL = "UPDATE lrvmemprofile SET $Change = '' WHERE MPRegProCode = '$ContRegPro2'";
    $runMemSQL = $db->query($DataSQL);

    return mysqli_fetch_array($runMemSQL)[0];
}

function UserIdExistAction($db, $ValueId)
{

    $UserIdSQL = "SELECT MPMemId FROM lrvmemprofile WHERE MPUserId = '$ValueId' AND MPUpdateChk = 'N'";
    $runUserId = mysqli_query($db, $UserIdSQL);
    return mysqli_fetch_array($runUserId)[0];

}

function getVal($UserId)
{
    global $db;
    $UsrQuery = "SELECT MPActPriv FROM lrvmemprofile WHERE MPUserId = '$UserId'";
    $runUsr = $db->query($UsrQuery) or $db->close();
    return mysqli_fetch_array($runUsr)[0];
}

function getBankOptions()
{

    global $db;
    $CBankSQL = "SELECT * FROM lawrevee_admin.lrv_nig_com_bnks WHERE CBActPriv = 'A'";
    $runCBank = $db->query($CBankSQL);
    $BankOptions = '';

    while ($fetch = mysqli_fetch_array($runCBank)) {
        $CbId = $fetch['CBId'];

        $BankOptions .= "<option value='$CbId'>" . $fetch['CBNameDesc'] . "</option>";
    }
    return $BankOptions;
}

function getBibCount()
{
    global $db;
    global $MPMemId;

    $UsrQuery = "SELECT count(MPMemId) FROM lrvmemprofile WHERE MPBib = '$MPMemId'";
    $runUsr = $db->query($UsrQuery);
    return mysqli_fetch_array($runUsr)[0];
}

function getAllCountries($DefaultValue)
{

    global $db;
    $CountrySQL = "SELECT * FROM lawrevee_admin.lrv_all_countries WHERE ActPriv = 'A'";
    $runCountry = $db->query($CountrySQL);
    $CountryOptions = '';

    while ($fetch = mysqli_fetch_array($runCountry)) {
        $CountryId = $fetch['ACode'];

        $selected = 'NGA' == $CountryId ? " selected " : "";
        $CountryOptions .= "<option value='$CountryId' $selected>" . $fetch['ACountries'] . "</option>";
    }
    return $CountryOptions;
}

function getTitle($value)
{

    global $db;
    $TitleQuery = "SELECT MTDesc FROM lrvmemtitle WHERE MTId = '$value'";
    $runTitle = $db->query($TitleQuery);// or $db->close();
    return mysqli_fetch_array($runTitle)[0];
}

function getColorCode($value)
{

    switch ($value) {
        case 'D':
        case 'B':
            return "red";
            break;
        case 'C':
        case 'A':
            return "green";
            break;
        case 'P':
            return "blue";
            break;
        default:
            return "Black";
    }

}

function getAmtPend()
{

    global $db;
    global $MPMemId;
    $AmtQuery = "SELECT SUM(MMAmount) FROM lrvmemmonitor WHERE MMFormNo = '$MPMemId' AND MMActPriv = 'P'";
    $runAmt = $db->query($AmtQuery);// or $db->close();
    return mysqli_fetch_array($runAmt)[0];
}

function getCountry($value)
{

    global $db;
    $CountryQuery = "SELECT ACountries FROM lawrevee_admin.lrv_all_countries WHERE ACode = '$value'";
    $runCountry = $db->query($CountryQuery);// or $db->close();
    return mysqli_fetch_array($runCountry)[0];
}

function getBank($value)
{

    global $db;
    $BankSQL = "SELECT CBNameDesc FROM lawrevee_admin.lrv_nig_com_bnks WHERE CBId = '$value'";
    $runBank = $db->query($BankSQL);

    return mysqli_fetch_array($runBank)[0];
}

function getLedgerBal()
{

    global $db;
    $LedgerSQL = "SELECT LALedgerBalance FROM lawrevee_admin.lrv_ledger_acct";
    $runLedger = $db->query($LedgerSQL);

    return mysqli_fetch_array($runLedger)[0];
}

function getPendAdminBal()
{

    global $db;
    ///global $MPMemId;
    $PendSQL = "SELECT SUM(MMAmount) FROM lrvmemmonitor WHERE MMActPriv = 'P'";
    $runPend = $db->query($PendSQL);

    return mysqli_fetch_array($runPend)[0];
}

function getSuperUser($value)
{

    global $db;
    $SuperSQL = "SELECT LAFormNo FROM lawrevee_admin.lrv_admin_users 
        WHERE LAFormNo = '$value' AND LAActPriv = 'A'";
    $runSuper = $db->query($SuperSQL);

    return mysqli_fetch_array($runSuper)[0];
}

function eWalletPlus($value)
{
    global $db;
    global $MPMemId;

    $PlusQuery = $db->query("UPDATE lrvmemprofile SET MPWalletBalance = MPWalletBalance + $value WHERE MPMemId = '$MPMemId'");
    if ($PlusQuery === TRUE) {
        return 100;
    }
}

function eWalletMinus($value)
{
    global $db;
    global $MPMemId;

    $MinusQuery = ("UPDATE lrvmemprofile SET MPWalletBalance = MPWalletBalance - $value WHERE MPMemId = '$MPMemId'");
    $CheckOut = "SELECT MPWalletBalance FROM lrvmemprofile WHERE MPMemId = '$MPMemId'";
    $runOut = $db->query($CheckOut);
    $MPWalletBalance = mysqli_fetch_array($runOut)[0];

    if ($db->query($MinusQuery) === TRUE && $MPWalletBalance > $value) {
        return 100;
    } else {
        return 404;
    }
}

function gLedgerPlus($value){
    global $db;
    $db->query("UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance + '$value'");
    return 100;
}

function gLedgerMinus($value){
    global $db;
    $MinusSQL = "UPDATE lawrevee_admin.lrv_ledger_acct SET LALedgerBalance = LALedgerBalance - '$value'";
    $db->query($MinusSQL);
    return 100;
}

function iRecharge($PinDesc){
    global $db;
    global $MPMemId;
    $SuperSQL = "UPDATE lawrevee_admin.lrv_recharge_pin SET PinActPriv = 'U', 
            PinRechargedBy = '$MPMemId', PinRgdDate = now() WHERE PinDesc = '$PinDesc'";
    $db->query($SuperSQL);
    return 100;
}

function getAllWalletBal(){
    global $db;
    $SuperSQL = "SELECT SUM(MPWalletBalance) FROM lrvmemprofile";
    $runSuper = $db->query($SuperSQL);
    return mysqli_fetch_array($runSuper)[0];
}

function b1Tree($value)
{
    global $db;

    $B1Query = "SELECT MPMemId FROM lrvmemprofile WHERE MPGroup = 'B1' AND MPSponsorId = '$value'";
    $runB1 = $db->query($B1Query);

    return mysqli_fetch_array($runB1)[0];
}

function b2Tree($value)
{
    global $db;

    $B2Query = "SELECT MPMemId FROM lrvmemprofile WHERE MPGroup = 'B2' AND MPSponsorId = '$value'";
    $runB2 = $db->query($B2Query);

    return mysqli_fetch_array($runB2)[0];
}

function bCtrlOwner($db){

    global $MPMemId;

    $bvQuery = "SELECT CMemId FROM lrvdownlinectrl WHERE CUserId = '$MPMemId' AND CGroup = 'B'";
    $bv = $db->query($bvQuery);
    return mysqli_fetch_array($bv)[0];
}
