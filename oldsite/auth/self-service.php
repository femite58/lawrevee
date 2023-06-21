<?php
/*
include "lrv.init.php";

$Profile = $_SESSION['ProfileStatus'];
$Id = isset($_SESSION['IdStatus'])?$_SESSION['IdStatus']:0;


$UsrQuery = "SELECT * FROM lrvmemprofile WHERE MPMemId = '$Id'";
$runUsr = $db->query($UsrQuery) or $db->close();
$Usr = mysqli_fetch_array($runUsr);


*/?><!--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>#LRV Lawrevee - Real Estate Managers</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome-all.min.css">
    <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="stylesheet" href="css/local-ion-style.css">
    <link href="img/logo-vsmall.png" rel="icon">
    <style>
        .pending{
            text-align: center;
            font-weight: 600;
            color: red;
            font-size: 13px;
            background: lightgoldenrodyellow;
            padding: 5px;
            border-radius: 4px;
        }
        .MopChk{
            font-size: 20px;
            display: none;
        }
        sm{
            font-size: 15px !important;
        }
        gy{
            color: greenyellow !important;
        }
        yl{
            color: yellow !important;
        }
        rd{
            color: red !important;
        }
        button {
            border-bottom-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }

    </style>
</head>
<body>
<div id="tm-bg"></div>
<div>
    <div id="tm-wrap">
        <div class="container tm-site-header-container">

            <div class="wrapper">
                <img src="img/logo.png" alt="logo" style="width: 200px">
            </div>
            <hr>
            <?php
/*             if ($Profile == 'P') {
                */?>

                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4">
                        <ul>
                            <li><small><gy>Name</gy>: <?/*= getSpName($Usr['MPMemId']) */?></small></li>
                            <div style="padding: 3px"></div>
                            <li><small><gy>Package</gy>: <?/*= getRegPkgDesc($Usr['MPEntryPackage']) */?></small></li>
                        </ul>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4">
                        <ul>
                            <li><small><gy>Account Status</gy>: Pending</small></li>
                            <div style="padding: 3px"></div>
                            <li>
                                <small><gy>Referral Link</gy>:
                                    <u onclick="$('#xDsp').show(1000)">Click To Show</u>
                                </small>
                            </li>
                        </ul>
                    </div>
                </div>

                <p style='text-align: center;display: none' id="xDsp">
                    <small>
                        <a href="http://www.lawrevee.com/registration/index.php?bib=<?/*= $Usr['MPMemId'] */?>">
                            <u>www.lawrevee.com/registration/index.php?bib=<?/*= $Usr['MPMemId'] */?></u>
                        </a>
                    </small>
                </p>
                <hr>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4">
                        <div>
                            <div class="pInfoBg wrapper">
                                ACCOUNT ACTIVATION
                            </div>
                            <div style="padding: 10px"></div>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" onclick="RegMop('pT')" data-toggle="modal"
                                       data-target="#BankAcctNo">
                                        <small>I PAID CASH TO THE BANK</small> &nbsp;
                                        <i id="pT" class="fa fa-check text-white MopChk"></i>
                                    </a>
                                </li>
                                <div style="padding: 4px"></div>
                                <li>
                                    <a href="javascript:void(0)" onclick="RegMop('dC')" data-toggle="modal"
                                       data-target="#BankAcctNo">
                                        <small>I HAVE PAID THROUGH TRANSFER</small> &nbsp;
                                        <i id="dC" class="fa fa-check text-white MopChk"></i>
                                    </a>
                                </li>
                                <div style="padding: 4px"></div>
                                <li>
                                    <a href="javascript:void(0)" onclick="RegMop('vO')" data-toggle="modal"
                                       data-target="#modalOfficeAddr">
                                        <small>ACTIVATE NOW - ( <rd><?/*= getRegPkgAmt($Usr['MPEntryPackage']) */?></rd> )</small>
                                        &nbsp;
                                        <i id="vO" class="fa fa-check text-white MopChk"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-6 col-lg-6 col-md-col-xl-6 mb-md-0 mb-sm-4 mb-4">

                        <form method="post" autocomplete="off">

                            <input class="col-sm-12 form-group inputReg" name="xAmount"
                                   placeholder="Enter Amount Paid" type="number" required>

                            <input class="col-sm-12 form-group inputReg" name="xReference"
                                   placeholder="Enter Reference No.# On Receipt" type="text" required>

                            <select class="inputReg" name="xBank" style="font-size: 15px;height: 35px;width: 80%" required>
                                <option value="" selected disabled>Select Paid In Bank</option>
                                <?php
/*                                $TitleSQL = "SELECT * FROM lawrevee_admin.lrv_nig_com_bnks WHERE CBId IN(8,14)";
                                $ExeTitle = $db->query($TitleSQL);
                                while($TitlesRows = mysqli_fetch_assoc($ExeTitle)){
                                    */?>
                                    <option value="<?/*= $TitlesRows['CBId'] */?>"><?/*= $TitlesRows['CBNameDesc'] */?></option>
                                    <?php
/*                                }
                                */?>
                            </select>

                            <input class="col-sm-12 form-group inputReg" name="xPhone"
                                   placeholder="Contact Phone Number" required>

                            <input id="xSubmit" type="submit" name="xSubmit" style="display: none">

                        </form>

                    </div>
                </div>
                <hr>
                <div class="wrapper">
                    <div>
                        <br>
                        <a href="self-service.php?Logout"
                           class="btn btn-dark btn-sm SubmitReg">
                            <i class="fa fa-reply-all">&nbsp;</i>
                            Back
                        </a>
                        <button class="btn btn-primary SubmitReg"
                                onclick="$('#xSubmit').click()">
                            <i class="fa fa-check-circle">&nbsp;</i>
                            Activate Account
                        </button>
                    </div>
                </div>
                <?php
/*            }
            else if($Profile == 'D') {
                */?>
                <div class="row">
                    <div class="col-md-12 col-sm-12 wrapper">
                        <i><img src='img/so-sad.png' style='width: 80px' alt='Success'></i>
                    </div>
                    <div style="padding: 10px"></div>
                    <div class="col-md-12 col-sm-12 wrapper">
                        <sm id="yl">[
                            <rd>ERROR</rd>
                            : <gy>Account Not Active</gy>.! ]
                        </sm>
                    </div>
                    <div style="padding: 10px"></div>
                    <div class="form-control" style="text-align: center">
                        <p class="text-warning">
                            <small>
                                Sorry, we can not take you to your profile:
                            </small><br>
                            <sm>
                                <u>POSSIBLE REASONS</u>:
                                <br>

                                1. Payment for your account has not been confirmed.<br>
                                2. Your account might be temporary disabled by system.<br>

                            </sm>
                        </p>
                        <sm>
                            For More Info, Please Contact Admin : <br>[ <help><a href='tel:+2349083260920'>+234 (908)-326-0920</a></help> ]
                        </sm>
                        <br>
                        <hr>
                        <a href="self-service.php?Logout"
                           class="btn btn-primary btn-sm">Back</a>
                    </div>
                </div>
                <?php
/*            }
            else {
                header("Location: index.php");
            }
            */?>
        </div>
    </div>
</div>
<br>

<div class="modal fade" id="BankAcctNo" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background: rgba(132,162,179,0.85);padding: 0;margin: 0;border: 0;">
            <div class="modal-header">
                <h6 class="modal-title text-white">
                    <b>PAYMENT ACCOUNT</b><br>
                    <small>
                        <em>Pay to the account provided below..</em>
                    </small>
                </h6>
                <a href="#" data-dismiss="modal" class="fa fa-times pull-right text-dark clsLogin"></a>
            </div>
            <div class="modal-body">
                <p>
                    <small style="color: yellow;font-weight: 900">
                        <u>PAY OR TRANSFER TO:</u><br>
                    </small>
                </p>
                <table class="table-bordered AcctTbl" style="width: 100%">
                    <tr>
                        <td>Account Name:</td>
                        <td>Lawrevee Ventures LTD</td>
                    </tr>
                    <tr>
                        <td>Bank Name:</td>
                        <td>FCMB</td>
                    </tr>
                    <tr>
                        <td>Acct Number:</td>
                        <td>6753148018</td>
                    </tr>
                </table>
                <br>
                OR

                <table class="table-bordered AcctTbl" style="width: 100%">
                    <tr>
                        <td>Account Name:</td>
                        <td>Lawrevee Ventures LTD</td>
                    </tr>
                    <tr>
                        <td>Bank Name:</td>
                        <td>Sterling Bank</td>
                    </tr>
                    <tr>
                        <td>Acct Number:</td>
                        <td>0076677327</td>
                    </tr>
                </table>
                <br>
                <div>
                    <small style="color: yellow;font-size: x-small">
                        Note: Use your phone number for description*
                    </small>
                </div>
            </div>

        </div>
    </div>
</div>

<footer>
    <small id="copyright">&copy;Copyright <?/*= date('Y') */?>.  All rights reserved.</small>
</footer>

<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/wow/wow.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/vendor/superfish/superfish.min.js"></script>
<script src="assets/vendor/hoverIntent/hoverIntent.js"></script>
<script src="https://apps.elfsight.com/p/platform.js" defer></script>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="slick/slick.min.js"></script>
<script src="js/anime.min.js"></script>
<script src="js/main.js"></script>
<script src="js/custom-lrv.js"></script>

<script>

    function RegMop(MopVal) {

        if(MopVal === 'pT'){$('#pT').show();$('#dC').hide();$('#vO').hide();$('#pL').hide();}
        else if(MopVal === 'dC'){$('#pT').hide();$('#dC').show();$('#vO').hide();$('#pL').hide();}
        else if(MopVal === 'vO'){$('#pT').hide();$('#dC').hide();$('#vO').show();$('#pL').hide();}
        //document.getElementById('AmtPaid').value = <?/*//= getRegPkgAmt($Usr['MPEntryPackage']) */?>//;

    }

</script>

</body>
</html>-->