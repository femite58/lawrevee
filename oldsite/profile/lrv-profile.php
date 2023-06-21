<style>
    input, .width-100 {
        border-bottom-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
    }
    .profile-info-value {color: #000032}
</style>

<div>
    <div class="widget-box">
        <div class="profileBG">
            <div class="row col-sm-offset-2">
                <div class="col-md-2 col-xs-12">
                    <div class="widget-box" id="widget-box-5">
                        <div class="widget-header">
                            <h5 class="widget-title bolder">LEVEL</h5>

                            <div class="widget-toolbar">
									<span class="label label-success">
									100%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main padding-6">
                                <div class="alert alert-success bolder bigger-150 center">
                                    <?= 'BRONZE' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
			<span class="profile-picture">
				<img id="avatar" class="editable img-responsive" alt="Profile Photo"
                     src="img/user_icon.png" style="width: 160px !important">
			</span>
                </div>
                <div class="col-sm-6">
                    <div class="profile-user-info profile-user-info-striped">

                        <div class="profile-info-row">
                            <div class="profile-info-name"> User ID </div>

                            <div class="profile-info-value">
                                <span class="bigger-110"><?= strtolower($Profile['MPUserId']) ?></></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Title </div>

                            <div class="profile-info-value">
                                <b> <?= getTitle($Profile['MPTitle']) ?> </b>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> First Name </div>

                            <div class="profile-info-value">
                                <b><?= strtoupper($Profile['MPFirstName']) ?></b>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Last Name </div>

                            <div class="profile-info-value">
                                <b><?= strtoupper($Profile['MPLastName']) ?></b>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Phone No.# </div>

                            <div class="profile-info-value">
                                <span><?= $Profile['MPPhone'] ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Email </div>

                            <div class="profile-info-value">
                                <span><?= $Profile['MPEmail'] ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Bank Details </div>

                            <div class="profile-info-value">
                    <span>
                        <?= getBank($Profile['MPBankName']) ? getBank($Profile['MPBankName']) : 'Empty' ?>
                    </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Acct No.# </div>

                            <div class="profile-info-value">
                                <span><?= $Profile['MPAccountNo']?$Profile['MPAccountNo']:'No added number' ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Address </div>

                            <div class="profile-info-value">
                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                <span><?= $Profile['MPAddress'] ? $Profile['MPAddress']:'No Address Added' ?></span>

                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Sponsor </div>

                            <div class="profile-info-value">
                                <b><?= ucwords(getSpName($Profile['MPBib'])) ?></b>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Sponsor No.#</div>

                            <div class="profile-info-value">
                    <span>
                        <?php
                        if (empty(fromDB('MPPhone','lrvmemprofile',
                            'MPMemId',$Profile['MPBib']))) {
                            echo "Your sponsor added no number";
                        }else {
                            $ssh = $Profile['MPBib'];
                            echo "Your sponsor phone number is : ".
                                fromDB('MPPhone','lrvmemprofile','MPMemId',$ssh);
                        }
                        ?>
                    </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Package </div>

                            <div class="profile-info-value">
                    <span><?= getRegPkgDesc($Profile['MPEntryPackage']) ?> &nbsp;
                        <?= $Currency.' '.number_format(getRegPkgAmt($Profile['MPEntryPackage']),2) ?></span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Privilege </div>

                            <div class="profile-info-value">
                    <span class="red">
                        <?php
                        if ($Profile['MPActPriv'] == 'Y'){
                            echo "<b>NO PRIVILEGE ADDED</b>";
                        } else if ($Profile['MPActPriv'] == 'A' && getSuperUser($MPMemId) == $MPMemId){
                            echo "<b>ADMIN PRIVILEGE / SUPER MEMBER</b>";
                        } else if ($Profile['MPActPriv'] == 'A'){
                            echo "<b>ADMIN PRIVILEGE</b>";
                        } else if ($Profile['MPActPriv'] == 'H'){
                            echo "<b>SYSTEM PRIVILEGE</b>";
                        }
                        ?>
                    </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Country </div>

                            <div class="profile-info-value">
                    <span class="editable">
                        <?= $Profile['MPCountry'] ? $Profile['MPCountry'] : 'Not Available' ?>
                        <?= getCountry($Profile['MPCountry']) ?>
                    </span>
                            </div>
                        </div>

                        <div class="profile-info-row">
                            <div class="profile-info-name"> Invite Link </div>

                            <div class="profile-info-value">
                                <span> https://lawrevee.com/registration/index.php?bib=<?= $MPMemId ?> </span>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>


    </div>

</div>

<div class="space-16"></div>
<div class="hr hr12 dotted"></div>
<div class="space-16"></div>

<br>

