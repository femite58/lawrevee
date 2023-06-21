<?php
include '../auth/lrv.sync.php';

session_start();
$MemUpgId = $_SESSION['MemUpgId'];
$MemUpgEmail = isset($_SESSION['MemUpgEmail'])?$_SESSION['MemUpgEmail']:0;

if(empty($MemUpgId)){
    header("Location: ../");
}

function getBankOptions($CBOptCode){

    global $db;
    $CBankSQL = "SELECT * FROM lawrevee_admin.lrv_nig_com_bnks WHERE CBActPriv = 'A'";
    $runCBank = $db->query($CBankSQL);
    $BankOptions = '';

    while($fetch = mysqli_fetch_array($runCBank)){
        $CBId = $fetch['CBId'];

        $selected = $CBOptCode == $CBId ? "selected" : "";
        $BankOptions.="<option value='$CBId' $selected>".$fetch['CBNameDesc']."</option>";
    }
    return $BankOptions;
}

function UpdateDB($TabId,$CTabCol,$TabVal){
    global $db;
    $InsertSQL = "UPDATE lrvmemprofile SET $CTabCol = '$TabVal' WHERE MPMemId = $TabId";
    $runSQL = $db->query($InsertSQL);
}

function oDB($MemVal){
    global $db;
    global $MemUpgId;
    $MemSQL = "SELECT $MemVal FROM lrvmemprofile WHERE MPMemId = '$MemUpgId'";
    $runMemSQL = $db->query($MemSQL);

    return mysqli_fetch_array($runMemSQL)[0];
}

if(isset($_POST['TabId']) && isset($_POST['TabCol']) && isset($_POST['TabVal'])){

    $TabId = $db->real_escape_string($_POST['TabId']);
    $TabCol = $db->real_escape_string($_POST['TabCol']);
    $TabVal = $db->real_escape_string($_POST['TabVal']);

    if($TabId == $MemUpgId){
        UpdateDB($TabId,$TabCol,$TabVal);
    }
}

if(isset($_POST['formConfirm'])){
    $_POST['userIdConfirm'];
    $emailConfirm = $_POST['emailConfirm'];

    if(oDB('MPEmail') == $emailConfirm){
        $MemUpgEmail = $emailConfirm;
    }else{
        //header("Location: index.php");
        $_SESSION['DisplayError'] = "<em class='red' style='border: 5px solid lightgoldenrodyellow'>Email not valid</em>";
        $DisplayError = $_SESSION['DisplayError'];

    }
}

function getTitleSelectOptions($xTit){

    global $db;
    $TitleSQL = "SELECT * FROM lrvmemtitle WHERE MTActPriv = 'A'";
    $ExeTitle = mysqli_query($db,$TitleSQL);
    $TRowsDesc = '';

    while($TitlesRows = mysqli_fetch_assoc($ExeTitle)){
        $TRows = $TitlesRows['MTId'];
        $xTitle = $xTit == $TRows ? "selected" : "";
        $TRowsDesc.="<option value='$TRows' $xTitle>".$TitlesRows['MTDesc']."</option>";
    }
    return $TRowsDesc;
}

if(isset($_GET['Logout'])){
    session_start();
    session_destroy();

    $MemUpgId = '';
    header("Location:../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />

    <title>#LRV Lawrevee - Real Estate Managers</title>

    <meta name="description" content="and Validation" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/css/select2.min.css" />
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
    <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <script src="assets/js/ace-extra.min.js"></script>

    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>

    <style>
        .bodyLi{
            color: darkgreen !important;
            background: whitesmoke !important;
        }
        .outView{
            display: none !important;
        }
    </style>

</head>

<body onload="iEmailCheck()" class="no-skin">
<div id="navbar" class="navbar navbar-default ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">


        <div class="navbar-header pull-left">
            <a href="index.php" class="navbar-brand">
                <strong>
                    LAWREVEE HOME
                </strong>
            </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">
                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <span class="user-info" style="padding-right: 15px">
									<small>Welcome,</small>
                            <?/*= oDB('MPFirstName') */?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-user"></i>
                                Update Form
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="index.php?Logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="#">Home</a>
                    </li>
                    <li class="active">Profile Update</li>
                </ul><!-- /.breadcrumb -->

                <div class="nav-search" id="nav-search">
                    <form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
                    </form>
                </div><!-- /.nav-search -->
            </div>

            <div class="page-content">


                <div class="page-header">
                    <h1 class="center">
                        <img src="../img/logo.png" style="width: 200px">
                    </h1>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">

                        <div class="widget-box widget-color-blue2">
                            <div class="widget-header widget-header-blue widget-header-flat">
                                <h4 class="widget-title lighter">Members Profile Update</h4>
                            </div>

                            <div class="widget-body bodyLi">
                                <div class="widget-main">
                                    <div id="fuelux-wizard-container">
                                        <?php
/*                                        if (empty($MemUpgEmail)) {
                                        */?>
                                        <div class="step-content pos-rel">
                                            <div class="active">
                                                <h6 class="lighter block red">
                                                    <strong>
                                                        Please enter the email address associated with the username
                                                        below, to confirm your identity.
                                                    </strong>
                                                </h6>
                                                <div class="space-12"></div>
                                                <div
                                                    class="center"><?/*= isset($DisplayError) ? $DisplayError : '' */?></div>
                                                <div class="space-12"></div>
                                                <form class="form-horizontal" method="post" autocomplete="off">
                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                               for="email">Your User Name:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="text" name="userIdConfirm"
                                                                       class="col-xs-12 col-sm-6"
                                                                       value="<?/*= oDB('MPUserId') */?>" readonly/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                               for="email">Email Address:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="email" name="emailConfirm"
                                                                       onkeyup="EmailCtrl(this.value)"
                                                                       class="col-xs-12 col-sm-6" required/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br/>
                                                    <div class="wizard-actions center" id="formCtrl"
                                                         style="display: none">
                                                        <button class="btn btn-success" type="submit"
                                                                name="formConfirm">
                                                            SUBMIT EMAIL
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div
                                    <?php
/*                                    }
                                    else {
                                        */?>
                                        <div class="step-content pos-rel">
                                            <div class="active">
                                                <h6 class="lighter block grey">
                                                    <strong>Enter the following information, Your profile needs
                                                        update.</strong>
                                                </h6>

                                                <form class="form-horizontal" id="validation-form" method="post"
                                                      autocomplete="off">
                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="email">Email Address:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="email" value="<?/*= oDB('MPEmail') */?>"
                                                                       id="email" class="col-xs-12 col-sm-6"
                                                                       disabled/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="password">Password:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="password" name="password" id="password"
                                                                       class="col-xs-12 col-sm-4"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="password2">Confirm Password:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="password" id="password2"
                                                                       class="col-xs-12 col-sm-4"
                                                                       onblur="iDB('MPPassword',this.value)"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="hr hr-dotted"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name">Select Title:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <select class="col-xs-6 col-sm-3"
                                                                        onblur="iDB('MPTitle',this.value)" required>
                                                                    <?/*= getTitleSelectOptions(oDB('MPTitle')) */?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name">First Name:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="text" value="<?/*= oDB('MPFirstName') */?>"
                                                                       class="col-xs-12 col-sm-5"
                                                                       onblur="iDB('MPFirstName',this.value)"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name2">Last Name:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="text" value="<?/*= oDB('MPLastName') */?>"
                                                                       class="col-xs-12 col-sm-5"
                                                                       onblur="iDB('MPLastName',this.value)"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="phone">Phone Number:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="input-group">
																		<span class="input-group-addon">
																			<i class="ace-icon fa fa-phone"></i> +234
																		</span>
                                                                <input type="tel" value="<?/*= oDB('MPPhone') */?>"
                                                                       id="phone"
                                                                       onblur="iDB('MPPhone',this.value)"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="platform">Your Bank</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <select class="col-xs-12 col-sm-4 input-group"
                                                                        id="platform"
                                                                        onchange="iDB('MPBankName',this.value)">
                                                                    <option style="text-align: center !important;">
                                                                        -- Select Bank --
                                                                    </option>
                                                                    <?/*= getBankOptions(oDB('MPBankName')) */?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name2">Account Number:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="number"
                                                                       value="<?/*= oDB('MPAccountNo') */?>"
                                                                       class="col-xs-12 col-sm-3"
                                                                       onblur="iDB('MPAccountNo',this.value)"/>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right">Gender</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div>
                                                                <label class="line-height-1 blue">
                                                                    <input name="gender" value="Male" type="radio"
                                                                           class="ace"
                                                                           onblur="iDB('MPGender',this.value)"
                                                                           <?/*= oDB('MPGender') == 'Male' ? 'checked' : '' */?>/>
                                                                    <span class="lbl"> Male</span>
                                                                </label>
                                                            </div>

                                                            <div>
                                                                <label class="line-height-1 blue">
                                                                    <input name="gender" value="Female" type="radio"
                                                                           class="ace"
                                                                           onblur="iDB('MPGender',this.value)"
                                                                           <?/*= oDB('MPGender') == 'Female' ? 'checked' : '' */?>/>
                                                                    <span class="lbl"> Female</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="hr hr-dotted"></div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right">Information
                                                            Response</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="ace"
                                                                           id="SpoUsrIdChk" name="SpoUsrIdChk"
                                                                           <?/*= oDB('MPSponsorId') == 'Unknown' ? 'checked' : '' */?>/>
                                                                    <span class="lbl"> I don't know my sponsor User Id</span>
                                                                </label>
                                                            </div>

                                                            <div>
                                                                <label>
                                                                    <input type="checkbox" class="ace"
                                                                           id="SpoEmailChk" name="SpoEmailChk"
                                                                           <?/*= oDB('MPSponsorEmail') == 'Unknown' ? 'checked' : '' */?>/>
                                                                    <span class="lbl"> I don't know my sponsor Email Address</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name">Sponsor User Id:</label>

                                                        <div class="col-xs-12 col-sm-9">

                                                            <div class="clearfix">
                                                                <input type="text" class="col-xs-12 col-sm-5"
                                                                       id="SpoUsrId"
                                                                       onblur="iDB('MPSponsorId',this.value)"
                                                                       value="<?/*= oDB('MPSponsorId') */?>"
                                                                       <?/*= oDB('MPSponsorId') == 'Unknown' ? 'disabled' : '' */?>/>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="name2">Sponsor Email:</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <input type="email" class="col-xs-12 col-sm-5"
                                                                       id="SpoEmail"
                                                                       onblur="iDB('MPSponsorEmail',this.value)"
                                                                       value="<?/*= oDB('MPSponsorEmail') */?>"
                                                                       <?/*= oDB('MPSponsorEmail') == 'Unknown' ? 'disabled' : '' */?>/>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="hr hr-dotted"></div>

                                                    <div class="space-2"></div>

                                                    <div class="form-group">
                                                        <label
                                                            class="control-label col-xs-12 col-sm-3 no-padding-right"
                                                            for="comment">Comment / Complaint</label>

                                                        <div class="col-xs-12 col-sm-9">
                                                            <div class="clearfix">
                                                                <textarea class="input-xlarge"
                                                                          onblur="iDB('MPComment',this.value)"
                                                                          id="comment"><?/*= oDB('MPComment') */?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="space-8"></div>

                                                    <div class="form-group">
                                                        <div class="col-xs-12 col-sm-4 col-sm-offset-3">
                                                            <label>
                                                                <input id="agree" type="checkbox" class="ace"
                                                                       onclick="iDB('MPUpdateChk','Y')"
                                                                       <?/*= oDB('MPUpdateChk') == 'Y' ? 'checked' : '' */?>/>
                                                                <span class="lbl"> I accept the policy</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
/*                                    }
                                    */?>
                                </div>
                                <hr />
                                <div class="wizard-actions center <?/*= empty($MemUpgEmail)?'hide':'' */?>">
                                    <a href="javascript:void(0)" id="MPUpdateChk" class="btn btn-success btn-next"
                                       data-last="SUCCESS" style="display: none">
                                        SUBMIT
                                        <i class="ace-icon fa fa-cloud-upload icon-on-right"></i>
                                    </a>
                                </div>
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->
<?php
/*$_SESSION['DisplayError'] = '';
*/?>
<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
					<span class="bigger-120">
							<span class="blue bolder">Lawrevee</span>
						Homes &copy; <?/*= date('Y') */?>
					</span>

            &nbsp; &nbsp;
            <span class="action-buttons">
							<a href="#">
							<i class="ace-icon fa fa-twitter light-blue bigger-150"></i>
						</a>

						<a href="#">
							<i class="ace-icon fa fa-facebook text-primary bigger-150"></i>
						</a>
					</span>
        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div>
<script src="assets/js/jquery-2.1.4.min.js"></script>

<script src="assets/js/jquery-1.11.3.min.js"></script>

<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="assets/js/bootstrap.min.js"></script>

<!-- page specific plugin scripts -->
<script src="assets/js/wizard.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/jquery-additional-methods.min.js"></script>
<script src="assets/js/bootbox.js"></script>
<script src="assets/js/jquery.maskedinput.min.js"></script>
<script src="assets/js/select2.min.js"></script>

<!-- ace scripts -->
<script src="assets/js/ace-elements.min.js"></script>
<script src="assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {

        $('[data-rel=tooltip]').tooltip();

        $('.select2').css('width','200px').select2({allowClear:true})
            .on('change', function(){
                $(this).closest('form').validate().element($(this));
            });


        var $validation = false;
        $('#fuelux-wizard-container')
            .ace_wizard({
                //step: 2 //optional argument. wizard will jump to step "2" at first
                //buttons: '.wizard-actions:eq(0)'
            })
            .on('actionclicked.fu.wizard' , function(e, info){
                if(info.step === 1 && $validation) {
                    if(!$('#validation-form').valid()) e.preventDefault();
                }
            })
            //.on('changed.fu.wizard', function() {
            //})
            .on('finished.fu.wizard', function(e) {
                bootbox.dialog({
                    message: "Thank you! Your information was successfully saved!",
                    buttons: {
                        "success" : {
                            "label" : "OK",
                            "className" : "btn-sm btn-primary exitUpt",
                            callback: function(){
                                location.href='index.php?Logout';
                            }
                        }
                    }
                });
            }).on('stepclick.fu.wizard', function(e){
            window.reload();
        });

        $('#skip-validation').removeAttr('checked').on('click', function(){
            $validation = this.checked;
            if(this.checked) {
                $('#sample-form').hide();
                $('#validation-form').removeClass('hide');
            }
            else {
                $('#validation-form').addClass('hide');
                $('#sample-form').show();
            }
        });

        $.mask.definitions['~']='[+-]';
        $('#phone').mask('(999) 999-9999');

        jQuery.validator.addMethod("phone", function (value, element) {
            return this.optional(element) || /([0-9]{10})|(\([0-9]{3}\)\s+[0-9]{3}\-[0-9]{4})/.test(value);
        }, "Enter a valid phone number by dropping the first zero.");

        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email:true
                },
                password: {
                    required: true,
                    minlength: 5
                },
                password2: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    phone: 'required'
                },
                url: {
                    required: true,
                    url: true
                },
                comment: {
                    required: true
                },
                state: {
                    required: true
                },
                platform: {
                    required: true
                },
                subscription: {
                    required: true
                },
                gender: {
                    required: true,
                },
                agree: {
                    required: true,
                }
            },

            messages: {
                email: {
                    required: "Please provide a valid email.",
                    email: "Please provide a valid email."
                },
                password: {
                    required: "Please specify a password.",
                    minlength: "Please specify a secure password."
                },
                state: "Please choose state",
                subscription: "Please choose at least one option",
                gender: "Please choose gender",
                agree: "Please accept our policy"
            },


            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },

            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },

            errorPlacement: function (error, element) {
                if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if(element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if(element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else error.insertAfter(element.parent());
            },

            submitHandler: function (form) {
            },
            invalidHandler: function (form) {
            }
        });

        $('#modal-wizard-container').ace_wizard();
        $('#modal-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');

        $(document).one('ajaxloadstart.page', function(e) {
            //in ajax mode, remove remaining elements before leaving page
            $('[class*=select2]').remove();
        });
    });
</script>
<script>

    $(function (){
        $("#SpoUsrIdChk").on("click",function () {
            setTimeout(()=>{
                var vck = ($("input[type=checkbox][name=SpoUsrIdChk]:checked").val());
                let TabCol= 'MPSponsorId', TabVal= '';

                if($('[name=SpoUsrIdChk]').is(':checked')){
                    //alert('is checked');
                    $('#SpoUsrId').prop('disabled',true);
                    document.getElementById('SpoUsrId').value = 'Sponsor User Id Unknown';
                    TabVal= 'Unknown';
                }
                else{
                    //alert('is not checked');
                    $('#SpoUsrId').prop('disabled',false);
                    document.getElementById('SpoUsrId').value = '';
                    window.reload();
                }
                iDB(TabCol,TabVal);
            },500)
        })
    });

    $(function (){
        $("#SpoEmailChk").on("click",function () {
            setTimeout(()=>{
                var vck = ($("input[type=checkbox][name=SpoEmailChk]:checked").val());
                let TabCol= 'MPSponsorEmail', TabVal= '';

                if($('[name=SpoEmailChk]').is(':checked')){
                    //alert('is checked');
                    $('#SpoEmail').prop('disabled',true);
                    document.getElementById('SpoEmail').value = 'Sponsor Email Unknown';
                    TabVal= 'Unknown';
                }
                else{
                    //alert('is not checked');
                    $('#SpoEmail').prop('disabled',false);
                    document.getElementById('SpoEmail').value = '';
                    window.reload();
                }
                iDB(TabCol,TabVal);
            },500);
        })
    });

    function iDB(TabCol,TabVal) {
        var TabId = <?/*= $MemUpgId */?>;
        $.ajax({
            url: 'index.php',
            method: 'POST',
            data: {
                TabId: TabId, TabCol: TabCol, TabVal: TabVal
            },
            success: function (data) {
                document.getElementById(TabCol).click();
                document.getElementById(TabCol).style.display = 'inline';

                //location.href='index.php?url=ManageReport'
                //alert("Inserted Successfully");
            },
        });
    }

    function EmailCtrl(valData) {
        if(valData.length >= 5){
            document.getElementById('formCtrl').style.display = 'block';
        }else{
            document.getElementById('formCtrl').style.display = 'none';
        }
    }

    function iEmailCheck() {

        //alert('page reloaded');
        let vGBi = document.getElementById('SpoUsrId').value;
        let vGBe = document.getElementById('SpoEmail').value;

        if(vGBi === 'Unknown'){
            //$('#SpoUsrId').prop('disabled',true);
            document.getElementById('SpoUsrId').prop('disabled',true);
        }
        if(vGBe === 'Unknown'){
            //$('#SpoEmail').prop('disabled',true);
            document.getElementById('SpoEmail').prop('disabled',true);
        }
    }

</script>
</body>
</html>
-->