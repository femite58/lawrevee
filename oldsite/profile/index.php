<?php

include "lrv.config.php";

if(isset($_GET['get']) && isset($_GET['vTree'])){

    $get = $db->real_escape_string($_GET['get']);
    $vTree = $db->real_escape_string($_GET['vTree']);
    $ctrl = $get == 'TreeView1' ? 'V' : 'B';

    if (is_numeric($vTree)){
        $db->query("DELETE FROM lrvdownlinectrl WHERE CUserId = '$MPMemId' AND CGroup = '$ctrl'");
        $db->query("INSERT INTO lrvdownlinectrl (CUserId,CMemId,CGroup) VALUES ('$MPMemId','$vTree','$ctrl')");
    }
    header("Location: index.php?get=".$get);
}
$Date = date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta charset="utf-8">

    <title><?= $PageTitle ?></title>

    <meta name="description" content="3 styles with inline editable feature">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/jquery-ui.custom.min.css">
    <link rel="stylesheet" href="assets/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-editable.min.css">

    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css">
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style">

    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet">

    <!-- I added the 2 below -->
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="assets/css/ui.jqgrid.min.css" />

    <link rel="stylesheet" href="assets/css/ace-skins.min.css">
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css">

    <link href="assets/css/ionicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/ace-ie.min.css">

    <script src="assets/js/ace-extra.min.js"></script>
    <script src="assets/js/lrv-custom.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <link rel="shortcut icon" href="img/logo-vsmall.png">

    <style>
        .menu-icon.fa{
            font-size: 30px !important;
            color: #000032 !important;
        }
        .WelcomeInfo{
            padding-top: 20px;
            padding-left: 15px;
            color: #8b6360;
        }
        #navbar, #navbar-container {
            background: #000032 !important;
        }
        .liBorder {
            border-radius: 15px !important;
            padding: 10px !important;
        }
        .listStop        {
            border-bottom-right-radius: 15px !important;
            border-bottom-left-radius: 15px !important;
        }
        .liBg {
            background: #000032 !important;
            color: whitesmoke !important;
        }
        .menu-icon {
            background: whitesmoke !important;
            border-radius: 15px;
            padding: 2px;
        }
        sm {
            font-weight: 600;
            font-size: 10px !important;
        }
        pn {
            font-weight: 900;
            text-decoration: underline;
            color: #204d74;
        }
        rd {
            color: red;
        }
        gr {
            color: green;
        }
        button {
            border-bottom-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
        }
        input[type=checkbox]
        {
            /* Double-sized Checkboxes */
            -ms-transform: scale(2); /* IE */
            -moz-transform: scale(2); /* FF */
            -webkit-transform: scale(2); /* Safari and Chrome */
            -o-transform: scale(2); /* Opera */
            transform: scale(2);
            padding: 10px;
        }
        .boxLabel
        {
            /* Checkbox text */
            font-size: 110%;
            display: inline;
        }
        .modal.fade {
            padding-top: 20%;
        }
        .infobox-content {
            font-weight: 900;
        }
        .dashPhoto {
            border-radius: 20px !important;
            object-fit: contain;
            width: 80px;
            background: #f1f6ff;
        }
        .iPhoto {
            border-radius: 20px !important;
            object-fit: contain;
            width: 100px;
            background: #f1f6ff;
        }
        .iTree1 {
            border-radius: 20px !important;
            object-fit: contain;
            width: 60px;
            background: #f1f6ff;
        }
        input, .control-label, select, option, #RegSubmit, .boxLabel {
            font-family: 'Microsoft New Tai Lue', sans-serif !important;
        }
        #regStatMsg {
            font-weight: 600;
            font-family: 'Microsoft New Tai Lue', sans-serif !important;
            font-size: 15px !important;
        }
        body {
            font-family: 'Microsoft New Tai Lue', sans-serif !important;
        }
        .wltTAmt {
            font-weight: 400;
            font-size: 20px;
            color: <?= $MyWallet < 10000 ? 'red':'darkblue'?>;
        }
        .wltFmt {
            padding: 5px !important;
            background: #e0f5ff !important;
            border-radius: 5px;
        }
        #lowBal {
            font-size: 12px;
        }
        .bgShape {
            border-bottom-left-radius: 15px !important;
            border-top-right-radius: 15px !important;
        }
        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .green {
            color: green !important;
        }
        .TMem {
            font-size: medium !important;
            font-weight: 600 !important;
            /*text-decoration: underline;*/
        }
        .menu-text {
            font-weight: 600 !important;
        }
        .iBox.infobox {
            height: 60px !important;
            background: #f1f6ff !important;
            margin: 5px !important;
            border-bottom-left-radius: 20px !important;
            border-top-right-radius: 20px !important;
        }
        .profileBG{
            background: #e0f5ff !important;
            padding: 3px !important;
        }
    </style>

</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">

        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">
                <small>LAWREVEE HOMES</small>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <li class="light-blue dropdown-modal" style="width: 100% !important">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle white"
                       style="background: #5f0000 !important;">
                        <big>
                            Welcome,
                            <?= ucwords($MyFullName) ?>
                        </big>
                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a href="index.php?get=Profile">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li>
                            <a href="javascript:void(0)" onclick="confirmLogout(<?= $MPMemId ?>)">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div id="sidebar" class="sidebar responsive ace-save-state">
        <script type="text/javascript">
            try{ace.settings.loadState('sidebar')}catch(e){}
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts" style="background: #000032 !important;">

            <img src="../img/logo-vsmall.png" alt="logo"
                 style="width: 75%;padding: 20px 0;background: #000032;height: 150px">

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div>

        <ul class="nav nav-list" style="background: #000032 !important;">

            <li class="liBorder">
                <a class="liBg" href="index.php?get=Dashboard">
                    <span class="menu-text"> DASHBOARD </span>
                </a>
            </li>

            <li class="liBorder">
                <a class="liBg" href="index.php?get=Profile">
                    <span class="menu-text"> PROFILE </span>
                    <i class="badge badge-danger"></i>
                </a>
            </li>

            <li class="liBorder">
                <a class="liBg" href="index.php?get=Registration">
                    <span class="menu-text"> REGISTRATION </span>
                </a>
            </li>

            <li class="liBorder">
                <a class="dropdown-toggle liBg" href="javascript:void(0)">
                    <span class="menu-text"> TRANSACTIONS </span>
                    <ul class="submenu">
                        <li class="">
                            <a href="index.php?get=Wallets">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> WALLETS </span>
                            </a>
                        </li>

                        <li class="">
                            <a href="index.php?get=TransCredit">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> MEM TRANSFER </span>
                            </a>
                        </li>

                        <?php
                        if ($MPActPriv == 'H') {
                            ?>
                            <li>
                                <a href="index.php?get=Account">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <span class="menu-text"> GL TRANSFER </span>
                                </a>
                            </li>
                            <?php
                        }
                        if ($MPActPriv == 'A') {
                            ?>
                            <li>
                                <a href="index.php?get=Authorize">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <span class="menu-text"> AUTHORIZE </span>
                                </a>
                            </li>
                            <?php
                        }
                        if ($MPActPriv == 'A') {
                            ?>
                            <li>
                                <a href="index.php?get=CreatePin">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <span class="menu-text"> CREATE PIN </span>
                                </a>
                            </li>
                            <?php
                        }
                        ?>

                        <li>
                            <a href="index.php?get=CashOut">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> CASH OUT </span>
                            </a>
                        </li>

                    </ul>
                </a>
            </li>

            <li class="liBorder">
                <a class="dropdown-toggle liBg" href="javascript:void(0)" id="ckck">
                    <span class="menu-text"> DOWN LINERS </span>
                    <span class="badge badge-info"><?= getBibCount() ? getBibCount():'' ?></span>
                    <ul class="submenu">

                        <li class="">
                            <a href="index.php?get=TreeView1">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> DOWN LINES INFORMATION </span>
                            </a>
                        </li>

                        <li class="">
                            <a href="index.php?get=TreeView2">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> MANAGE YOUR NETWORK </span>
                            </a>
                        </li>

                        <li>
                            <a href="index.php?get=OnlineMembers">
                                <i class="menu-icon fa fa-caret-right"></i>
                                <span class="menu-text"> ONLINE MEMBERS </span>
                            </a>
                        </li>

                    </ul>
                </a>
            </li>

            <li class="liBorder">
                <a class="liBg" href="javascript:void(0)"
                   onclick="confirmLogout(<?= $MPMemId ?>)">
                    <span class="menu-text">SIGN OUT</span>
                </a>
            </li>
            <li class="listStop"></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">

                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                    </li>
                </ul>

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
						<span class="input-icon">
							<b>Last Logon : <?= date('l jS  F Y', strtotime($Date)) ?></b>
						</span>
                    </form>
                </div>
            </div>

            <div class="page-content">
                <div class="row">
                    <h1>
                        <b id="wDshBoard" class="wltTAmt">
                           <span class="widget-box wltFmt">
                               <?= $Currency.' '. number_format($MyWallet,2) ?>
                           </span>
                        </b>
                    </h1>
                </div>

               <div class="row">
                   <?php
                   include "lrv.pagination.php";
                   ?>
               </div>

            </div>
        </div>

        <div class="footer">
            <div class="footer-inner">
                <div class="">
					<span class="smaller-90">
						<span class="blue bolder">Lawrevee</span>Homes &copy; <?= date('Y') ?>
					</span>
                </div>
            </div>
        </div>

        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
</div>
<script src="assets/js/jquery-2.1.4.min.js"></script>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/excanvas.min.js"></script>

<script src="assets/js/jquery-ui.custom.min.js"></script>
<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="assets/js/jquery.gritter.min.js"></script>
<script src="assets/js/bootbox.js"></script>
<script src="assets/js/jquery.easypiechart.min.js"></script>
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.hotkeys.index.min.js"></script>
<script src="assets/js/bootstrap-wysiwyg.min.js"></script>
<script src="assets/js/select2.min.js"></script>
<script src="assets/js/spinbox.min.js"></script>
<script src="assets/js/bootstrap-editable.min.js"></script>
<script src="assets/js/ace-editable.min.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<!-- the 3 below from here -->
<script src="assets/js/jquery.jqGrid.min.js"></script>
<script src="assets/js/grid.locale-en.js"></script>
<script src="../js/customTreeJs.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>
<script src="assets/js/ClickToCopy.min.js"></script>
<script src="assets/js/profile-pic.min.js"></script>
<script src="assets/js/jquery-table.min.js"></script>

<!-- my custom Js starts -->
<script>
    function confirmLogout(value){
        swal({
            title: "LOGOUT ?",
            text: "Click on Ok button to logout.",
            buttons: true,
            dangerMode: true,
        })
            .then((btnLogout) => {
                if (btnLogout) {
                    location.href='../auth/lrv.logout.php?Logout='+value;
                }
                else {
                    swal("Profile Still Active!");
                }
            });
    }

    $(function() {
        $('#RegUserId').on('keypress', function(e) {
            if (e.which === 32){
                console.log('Space Detected');
                return false;
            }
        });
    });

    $('.easy-pie-chart.percentage').each(function(){
        $(this).easyPieChart({
            barColor: $(this).data('color'),
            trackColor: '#EEEEEE',
            scaleColor: false,
            lineCap: 'butt',
            lineWidth: 12,
            animate: ace.vars['old_ie'] ? false : 1000,
            size:100
        }).css('color', $(this).data('color'));
    });
    
    function RechargeModal() {
        swal("Enter Recharge PIN:", {
            content: "input",
        })
            .then((value) => {
                RechargeWithPin(value)
            });
    }

    function RechargeWithPin(value) {
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                PinVal: value
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100){
                    location.reload();
                }
            }
        });
    }

    jQuery(function($) {
        $('#loading-btn').on(ace.click_event, function () {
            var btn = $(this);
            btn.button('loading')
            setTimeout(function () {
                btn.button('reset')
            }, 2000)
        });

        $('#id-button-borders').attr('checked' , 'checked').on('click', function(){
            $('#default-buttons .btn').toggleClass('no-border');
        });
    })
</script>

</body>
</html>
