<div>
    <div class="widget-box">
        <div class="profileBG">
            <h3>PIN Management</h3>
            <hr>
            <p>
                <button class="btn btn-primary disappear"
                        onclick="pinCtrl()">
                    CREATE PIN
                </button>
            </p>

            <div class="step-content pos-rel appear" style="display: none">
                <div class="step-pane active">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-sm-offset-4 widget-container-col" id="widget-container-col-5">
                            <div class="widget-box" id="widget-box-5">
                                <div class="widget-header">
                                    <h5 class="widget-title bolder">GENERAL LEDGER BALANCE</h5>

                                    <div class="widget-toolbar">
									<span class="label label-success">
									100%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
                                    </div>
                                </div>

                                <div class="widget-body">
                                    <div class="widget-main padding-6">
                                        <div class="alert alert-danger bolder bigger-150 center">
                                            <?= $Currency.' '.number_format(getLedgerBal(),2) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="lighter block bolder">Create A New Recharge Pin From General Ledger</h6>

                    <form method="post" class="form-horizontal" id="sample-form">

                        <div class="form-group has-success">
                            <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">SYSTEM GENERATED PIN</label>

                            <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input class="form-control center pinSec" id="PinDesc"
                                                                               value="<?= rand() ?>">
																	</span>
                            </div>
                            &nbsp;
                            <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<select id="PinActPriv" class="form-control" onchange="vCategory(this.value)" required>
                                                                    <option value="" selected disabled> -- SELECT GROUP -- </option>
                                                                    <option value="I">INDIVIDUAL</option>
                                                                    <option value="A">ALL</option>
                                                                </select>
																	</span>
                            </div>

                        </div>

                        <div class="form-group has-success">
                            <label for="inputWarning" class="col-xs-12 col-sm-3 control-label no-padding-right">PIN OWNER</label>

                            <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="text" onblur="SearchMemId(this.value)" id="PinUsrId" class="width-100"
                                                                               placeholder="Enter User ID" disabled required>
																		<i id="feed_icon" class="ace-icon"></i>
																	</span>
                            </div>
                            &nbsp;
                            <div class="col-xs-12 col-sm-3">
																	<span class="block input-icon input-icon-right">
																		<input type="number" id="PinAmt" class="width-100"
                                                                               placeholder="Enter PIN Amount" required>
																		<span class="ace-icon"><?= $Currency ?></span>
																	</span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <input id="PinTo" style="display: none">

            <div class="center appear" style="display: none">
                <button class="btn btn-primary bigger-120" onclick="pinSubmit(<?= $MPMemId ?>)">
                    <i class="fa fa-send">&nbsp;</i>
                    Create PIN
                </button>
            </div>

            <div class="panel panel-body disappear" style="padding-bottom: 0">
                <div class="row" style="overflow: scroll; height: 400px">
                    <table class="table table-bordered">
                        <thead class="thin-border-bottom">
                        <tr style="border-bottom: 3px solid #000032;;width: 100%">
                            <th class="center" style="width: 10%">RECHARGE PIN</th>
                            <th style="width: 13%">CREATED DATE</th>
                            <th style="width: 13%">CREATED BY</th>
                            <th style="width: 15%">RECHARGE DATE</th>
                            <th style="width: 13%">CREATED FOR</th>
                            <th style="width: 13%">RECHARGE AMOUNT</th>
                            <th style="width: 8%">PIN STATUS</th>
                            <th style="width: 8%">ACTION</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $PinQuery = "SELECT * FROM lawrevee_admin.lrv_recharge_pin WHERE PinActPriv IN('A','B','I','U','') ORDER BY PinCrtDate DESC";
                        $PreparePin = $db->query($PinQuery);
                        while ($TPin = mysqli_fetch_array($PreparePin)) {
                            $PinId = $TPin['PinId'];
                            ?>
                            <tr id="discard<?= $PinId ?>" class="<?= $TPin['PinActPriv'] == 'B'?'red':'' ?>">

                                <td class="center"><?= $TPin['PinDesc'] ?></td>

                                <td><?= $TPin['PinCrtDate'] ?></td>

                                <td><?= getSpName($TPin['PinCreatedBy']) ?></td>

                                <td><?= $TPin['PinRgdDate'] ?></td>

                                <td>
                                    <?php
                                    if (!empty($TPin['PinRechargedBy'])){
                                        echo getSpName($TPin['PinRechargedBy']);
                                    }else{
                                        echo "All Member";
                                    }
                                    ?>
                                </td>

                                <td><?= $Currency.' '.number_format($TPin['PinAmount'],2) ?></td>

                                <td class="center">
                                    <?php
                                    switch ($TPin['PinActPriv']) {
                                        case 'U':
                                            echo "<span class='label label-primary arrowed-in'>Pin Used</span>";
                                            break;
                                        case 'A':
                                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Any Member Recharge</span>";
                                            break;
                                        case 'B':
                                            echo "<span class='label label-danger arrowed'>Pin Has Been Blocked</span>";
                                            break;
                                        default:
                                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Pin Active</span>"; // Mostly it's = 'I';
                                    }
                                    ?>
                                </td>

                                <td class="center">
                                    <?php
                                    $pinArray = array('A','I','');
                                    if (in_array($TPin['PinActPriv'],$pinArray)){
                                    ?>
                                    <button class="center" onclick="stopDiscardPin(<?= $PinId ?>)">
                                        <i class="fa fa-check">&nbsp;</i>
                                        Take Action
                                    </button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function pinCtrl() {
        $(".disappear").hide();
        $(".appear").show();
    }

    function vCategory(value) {
        if (value == 'A'){
            $('#PinUsrId').attr('disabled',true);
            $('#PinUsrId').val('SELECTED FOR ALL MEMBERS');
        }else{
            $('#PinUsrId').attr('disabled',false);
            $('#PinUsrId').attr('placeholder','ENTER USER ID');
        }
    }

    function SearchMemId(value) {

        $('#feed_icon').removeClass();
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                SearchMemId: value
            },
            type: 'json',
            success: function (resp) {
                if (resp.id == 100) {
                    $('#PinUsrId').val(resp.feedback_name);
                    $('#PinTo').val(resp.member);
                    $('#feed_icon').addClass(resp.feedback_icon);
                }
                else {
                    $('#PinTo').val('NULL');
                    swal({
                        icon: resp.icon,
                        title: resp.header,
                        text: resp.body,
                    });
                }
            }
        });
    }

    function pinSubmit(PinSubmit) {
        //alert($("#PinDesc").val()+' '+ $("#PinActPriv").val()+' '+ $("#PinTo").val()+' ' $("#PinAmt").val()+' '+ PinSubmit);
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                PinDesc: $("#PinDesc").val(),
                PinActPriv: $("#PinActPriv").val(),
                PinTo: $("#PinTo").val(),
                PinAmt: $("#PinAmt").val(),
                PinSubmit: PinSubmit
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100) {
                    setTimeout(function () {
                            location.reload();
                        },
                        3000);
                }
            }
        });
    }

    function stopDiscardPin(value) {
        swal({
            title: "DISCARD PIN ?",
            text: "Action taken can never be undone.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((btnApprove) => {
                if (btnApprove) {
                    pinDiscard(value)
                    //location.href='lrv.isset.php?RejTxn='+value;
                }
                else {
                    swal("The PIN is still safe !");
                }
            });
    }

    function pinDiscard(value) {
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                pinBlockQuery: value
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100){
                    $('#discard'+value).fadeOut(2000, function(){
                        //$('#discard'+value).fadeIn().delay(2000);
                    });
                }
            }
        });
    }

</script>
