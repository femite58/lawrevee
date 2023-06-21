<div>

    <div class="widget-box">
        <div class="profileBG">
            <div class="step-pane active" data-step="1">
                <h6 class="lighter block bolder">Register A New Member Under You</h6>

                <form method="post" class="form-horizontal" id="sample-form">

                    <div class="form-group">
                        <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Title / Gender / Package</label>

                        <div class="col-xs-12 col-sm-2">
																	<span class="block input-icon input-icon-right">
																		<select class="form-control" id="RegTitle" required>
                                                                    <?= getTitleSelectOptions(1) ?>
                                                                </select>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<select class="form-control" id="RegPkg">
                                                                          <?= getPkgSelectOptions(894396) ?>
                                                                        </select>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-1">
																	<span class="block input-icon input-icon-right">
																		<select class="form-control" id="RegGender">
                                                                            <option>Male</option>
                                                                            <option>Female</option>
                                                                        </select>
																	</span>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Names Section</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="RegFName" class="width-100"
                                                                               placeholder="first name" required>
																		<i class="ace-icon fa fa-user"></i>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="RegLName" class="width-100"
                                                                               placeholder="last name" required>
																		<i class="ace-icon fa fa-user"></i>
																	</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputError" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">Create User Id / Country</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="RegUserId" class="width-100"
                                                                               placeholder="username" required>
																		<i class="ace-icon fa fa-times-circle"></i>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
<select class="form-control" id="RegCountry">
                                                                          <?= getAllCountries('NGA') ?>
                                                                        </select>

																	</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Email / Phone</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="email" id="RegEmail" class="width-100"
                                                                               placeholder="email">
																		<i class="ace-icon fa fa-check-circle"></i>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="number" id="RegPhone" class="width-100"
                                                                               placeholder="phone #" required>
																		<i class="ace-icon fa fa-check-circle"></i>
																	</span>
                        </div>
                    </div>

                    <div class="form-group has-error">
                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Password Section</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="password" id="RegPassword1" class="width-100"
                                                                               placeholder="Password" required>
																		<i class="ace-icon fa fa-info-circle"></i>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="password" id="RegPassword2" class="width-100"
                                                                               placeholder="Confirm Password" required>
																		<i class="ace-icon fa fa-info-circle"></i>
																	</span>
                        </div>
                    </div>

                    <!--                    END OF CONTACT PROFILE                           -->

                    <div class="form-group">
                        <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">Address Line #</label>

                        <div class="col-xs-12 col-sm-5">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="RegAddress" class="width-100" />
																		<i class="ace-icon fa fa-home"></i>
																	</span>
                        </div>
                        <div class="help-block col-xs-12 col-sm-reset inline"> Home Address ! </div>
                    </div>

                    <div class="form-group">
                        <label for="inputSuccess" class="col-xs-12 col-sm-3 control-label no-padding-right">Next Of Kin</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="text" id="RegNOKName" class="width-100" placeholder="name">
																		<i class="ace-icon fa fa-check-circle"></i>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="number" id="RegNOKPhone" class="width-100" placeholder="phone">
																		<i class="ace-icon fa fa-check-circle"></i>
																	</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputInfo" class="col-xs-12 col-sm-3 control-label no-padding-right">Banking Section</label>

                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">

                                                                        <select class="form-control" id="RegBankName">
                                                                    <option value="" selected disabled> -- Select Bank -- </option>
                                                                        <?= getBankOptions() ?>
                                                                </select>
																	</span>
                        </div>
                        &nbsp;
                        <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="number" id="RegAcctNo" class="width-100" placeholder="bank account #">
																		<i class="ace-icon fa fa-info-circle"></i>
																	</span>
                        </div>
                    </div>

                    <hr>
                    <div class="center">
                        <button class="btn btn-primary" id="RegSubmit">
                            <i class="glyphicon glyphicon-send">&nbsp;</i>
                            REGISTER MEMBER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="space-20"></div>

<script type="text/javascript">

    $(document).ready(function () {
        const Form = $("form");
        Form.submit(function (event) {
            event.preventDefault();

            $.ajax({
                url: 'lrv.isset.php',
                method: 'POST',
                data: {
                    regTitle: $("#RegTitle").val(),
                    regPkg: $("#RegPkg").val(),
                    regGender: $("#RegGender").val(),
                    regFirstName: $("#RegFName").val(),
                    regLastName: $("#RegLName").val(),
                    regUserId: $("#RegUserId").val(),
                    regCountry: $("#RegCountry").val(),
                    regEmail: $("#RegEmail").val(),
                    regPhone: $("#RegPhone").val(),
                    regPassword1: $("#RegPassword1").val(),
                    regPassword2: $("#RegPassword2").val(),
                    regAddress: $("#RegAddress").val(),
                    regNOKName: $("#RegNOKName").val(),
                    regNOKPhone: $("#RegNOKPhone").val(),
                    regBank: $("#RegBankName").val(),
                    regAcctNo: $("#RegAcctNo").val(),
                    regSubmit: $("#RegSubmit").val()
                },
                dataType: 'json',
                success: function (resp) {
                    swal({
                        icon: resp.icon,
                        title: resp.header,
                        text: resp.body,
                    });
                    if (resp.id == 100){
                        $( "#wDshBoard" ).load(window.location.href + " #wDshBoard" );
                        Form.trigger("reset")
                    }
                }
            });
        });
    });

</script>