<?php

require_once "lrv.sync.php";
require_once "lrv.offline.php";

$rSpr = isset($_GET['bib']) ? $_GET['bib'] : '';

$bibQuery = $db->query("SELECT * FROM lrvmemprofile WHERE MPUserId = '$rSpr'");
$bib = mysqli_fetch_array($bibQuery);

function rTitle($db,$value){
    $sql = $db->query("SELECT MTDesc FROM lrvmemtitle WHERE MTActPriv = 'A' AND MTId = '$value'");
    return mysqli_fetch_array($sql)[0];
}
$rNames = rTitle($db,$bib['MPTitle']).' '.$bib['MPFirstName'].' '.$bib['MPLastName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=yes" />
    <title><?= $PageTitle ?></title>

    <!-- fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/app/ico/apple-touch-icon-144-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/app/ico/apple-touch-icon-114-precomposed.html">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/app/ico/apple-touch-icon-72-precomposed.html">
    <link rel="apple-touch-icon-precomposed" href="assets/app/ico/apple-touch-icon-57-precomposed.html">
    <link href="../img/logo-vsmall.png" rel="icon">
    <link href="../img/logo-vsmall.png" rel="apple-touch-icon">

    <!-- theme fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300italic,300,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- theme bootstrap stylesheets -->
    <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet" />

    <!-- theme dependencies stylesheets -->
    <link href="assets/app/css/dependencies.css" rel="stylesheet" />

    <!-- theme app main.css (this import of all custom css, you can use requirejs for optimizeCss or grunt to optimize them all) -->
    <link href="assets/app/css/syrena-admin.css" rel="stylesheet" />
    <script src="js/sweetalert.min.js"></script>

    <style>
        body{
            font-family: 'Microsoft New Tai Lue', sans-serif !important;
            overflow: hidden; /* just for Sign page */
            background-color: #000;
        }

        /*input {*/
        /*    border-bottom-left-radius: 10px !important;*/
        /*    border-top-right-radius: 10px !important;*/
        /*    height: 40px !important;*/
        /*}*/
        /*.btn-lg.btn-block{*/
        /*    height: 50px !important;*/
        /*}*/
    </style>
</head>

<body>

<section id="wrapper" class="container">
    <section id="signin" class="sign-wrapper signin transition-layout">
        <div class="row">
            <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                <div style="padding: 20px"></div>
                <div class="sign-brand">
                    <div class="sign-brand-logo">
                        <img src="img/logo.png" alt="Logo" style="width: 200px">
                    </div>
                </div><!-- /sign-brand -->
                <div class="sign-container">

                    <div class="sign-container">
                        <form role="form" class="form-login" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" id="request" placeholder="User ID" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="req_pss" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="button" class="btn btn-lg btn-primary btn-block"
                                       value="SIGN IN" onclick="loggerCredentials('btnSubmit')">
                            </div>
                            <div class="form-group">
                                <input id="rememberme" name="rememberme" type="checkbox">
                                <label class="icheck-label" for="rememberme">Login As Admin</label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="sign-footer">
                <button href="#signup" data-toggle="transition-layout" class="btn btn-link text-inverse">Quick Registration</button>
                <a href="#recover" data-toggle="transition-layout" class="btn btn-link text-inverse">Forgot Password</a>
            </div><!-- /sign-footer -->
    </section><!-- /signin -->

    <section id="signup" class="sign-wrapper signup transition-layout">
        <div class="row">
            <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                <div class="sign-brand">
                    <div class="sign-brand-logo">
                        <img src="img/logo.png" alt="Logo" style="width: 200px">
                    </div>
                </div><!-- /sign-brand -->

                <div class="sign-container">
                    <form role="form" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="qRegSponsor" onkeyup="ckSponsor(this.value)"
                                   value="<?= $rSpr && $bib['MPMemId'] ? $rSpr : '' ?>"
                                   placeholder="Sponsor ID" <?= $rSpr && $bib['MPMemId'] ? 'readonly' : '' ?>>
                            <i style="display: <?= $rSpr && $bib['MPMemId'] ? '' : 'hide' ?>" id="vNames">
                                <?= $rSpr && $bib['MPMemId'] ? $rNames : '' ?>
                            </i>
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="qRegId" placeholder="User ID">
                            <small id="qRegId2"></small>
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="qRegFirst" placeholder="First Name" >
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="qRegLast" placeholder="Last Name" >
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="number" class="form-control" id="qRegPhone" placeholder="Phone Number" >
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="password" class="form-control" id="qRegPassword" placeholder="Create Password" >
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="button" onclick="quickRegistration(this.value)"
                                   class="btn btn-success btn-lg btn-block" value="Sign Up" >
                        </div><!-- /form-group -->
                    </form>
                </div><!-- /sign-container -->
            </div><!-- /col -->
        </div><!-- /row -->

        <div class="sign-footer">
            <a href="#signin" data-toggle="transition-layout" class="btn btn-link text-inverse">Already have an account</a>
        </div><!-- /sign-footer -->
    </section><!-- /signup -->

    <section id="recover" class="sign-wrapper recover transition-layout">
        <div class="row">
            <div class="col-md-offset-4 col-sm-offset-0 col-xs-offset-0 col-md-4 col-sm-12 col-xs-12">
                <div class="sign-brand">
                    <div class="sign-brand-logo">
                        <img src="img/logo.png" alt="Logo" style="width: 200px">
                    </div>
                </div><!-- /sign-brand -->
                <div class="sign-container">
                    <form role="form" action="#">
                        <div class="form-group">
                            <input type="email" class="form-control input-lg" name="recover-email" placeholder="Email" >
                            <small class="help-block text-inverse">Enter your email address and we will send you a link to reset your password</small>
                        </div><!-- /form-group -->
                        <div class="form-group">
                            <input type="submit" class="btn btn-lg btn-success btn-block" value="Send reset link" >
                        </div><!-- /form-group -->
                    </form>
                </div><!-- /sign-container -->
            </div><!-- /col -->
        </div><!-- /row -->

        <div class="sign-footer">
            <a href="#signin" data-toggle="transition-layout" class="btn btn-link text-inverse">Sign In</a>
            <a href="#signup" data-toggle="transition-layout" class="btn btn-link text-inverse">Quick Registration</a>
        </div><!-- /sign-footer -->
    </section><!-- /recover -->
</section><!-- /wrapper -->

<!-- jQuery, theme required for theme -->
<script src="assets/jquery/jquery.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

<!-- theme dependencies -->
<script src="assets/isotope/jquery.isotope.min.js"></script>
<script src="assets/verge/verge.min.js"></script>
<script src="assets/moment/moment.min.js"></script>
<script src="assets/morris/raphael-2.1.0.min.js"></script>
<script src="assets/google-code-prettify/prettify.js"></script>

<!-- other dependencies -->
<script src="assets/jquery-icheck/jquery.icheck.min.js"></script>
<script src="../profile/assets/js/sweetalert.min.js"></script>

<!-- theme app main.js -->
<script src="assets/app/js/main.js"></script>

<script>

    $(window).load(function() {
        var bibCheck = <?= !empty($rSpr) && !empty($bib['MPMemId']) ? $bib['MPMemId'] : 0 ?>;
        //console.log(bibCheck);
        setTimeout(function(){
                if (bibCheck){
                    swal('MEMBER LINK','Please click on quick registration below to start!','success')
                }
            },
            2000);
    });

    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='../../../../www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-71722129-1');ga('send','pageview');


    function loggerCredentials(btnSubmit) {
        $.ajax({
            url:'lrv.prepare.php',
            method: 'POST',
            data: {
                btnSubmit: btnSubmit,
                Target: $('#request').val(),
                Key: $('#req_pss').val()
            },
            type: 'json',
            success: function (resp) {
                swal(resp.header, resp.body, resp.icon);
                setTimeout(function () {
                        if (resp.id == 100){
                            location.href=resp.url;
                        }else if (resp.id == 200){
                            location.href=resp.url;
                        }
                    },
                    1500);
            }
        });
    }

    function quickRegistration(qRegSubmit){

        $.ajax({
            url: 'lrv.prepare.php',
            method: 'POST',
            data: {
                qRegSubmit: qRegSubmit, qRegSponsor: $("#qRegSponsor").val(), qRegId: $("#qRegId").val(),
                qRegFirst: $("#qRegFirst").val(), qRegLast: $("#qRegLast").val(),
                qRegPhone: $("#qRegPhone").val(), qRegPassword: $("#qRegPassword").val(),
            },
            dataType: 'json',
            success: function (resp) {
                swal(resp.header, resp.body, resp.icon);
            }
        });
    }

    function ckSponsor(value){
        if (value.length > 3){
            $.ajax({
                url: 'lrv.prepare.php',
                method: 'POST',
                data: {
                    fetchSupervisor: value,
                },
                dataType: 'json',
                success: function (resp) {
                    $('#vNames').html(resp.vNames).css({'display':'inline'});
                }
            });
        }
    }

    $(function() {
        'use strict';
        $('.iCheck').iCheck({
            checkboxClass: 'icheckbox_flat',
            radioClass: 'iradio_flat',
        });
    })

</script>
</body>

</html>