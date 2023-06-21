<style>
    .DisWallet{font-size: 20px;font-weight: 600;height: 30px;padding: 1px}
</style>
<div>
    <div class="widget-box">
        <div class="profileBG">
            <h3>Manage Transactions</h3>
            <div class="panel panel-body" style="padding-bottom: 0">
                <div class="row" style="overflow: scroll; height: 400px">
                    <table class="table table-bordered table-striped" id="tblApprove">
                        <thead class="thin-border-bottom">
                        <tr style="border-bottom: 3px solid #000032;;width: 100%">
                            <th style="width: 13%">TRANSACTION ID</th>
                            <th style="width: 13%">TRANSACTION DATE</th>
                            <th>STATUS DESCRIPTION</th>
                            <th style="width: 8%">AMOUNT</th>
                            <th class="center" style="width: 8%">APPROVE</th>
                            <th class="center" style="width: 8%">REJECT</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $LogQuery = "SELECT * FROM lrvmemmonitor WHERE MMActPriv = 'P' ORDER BY MMId DESC";
                        $PrepareLogs = $db->query($LogQuery);
                        while ($logs = mysqli_fetch_array($PrepareLogs)) {
                            $MMId = $logs['MMId'];
                            $MMActPriv = $logs['MMActPriv'];
                            $MMFormNo = $logs['MMFormNo'];
                            ?>
                            <tr id="remove<?= $MMId ?>">
                                <td><?= $logs['MMTxnId'] ?></td>

                                <td><?= $logs['MMSysDate'] ?></td>

                                <td>
                                    Request to credit wallet for
                                    <b class="blue"> <?= getSpName($logs['MMFormNo']) ?> </b>
                                    has been initiated. Seeking for your approval
                                </td>

                                <td class="green">
                                    <?= $Currency.' '.number_format($logs['MMAmount'],2) ?>
                                </td>
                                <td class="center">
                                    <button class="bolder green center" onclick="ApproveRejectTransaction(<?= $MMId ?>,'APPROVE')">
                                        <i class="fa fa-check">&nbsp;</i>
                                        Approve
                                    </button>
                                </td>
                                <td class="center">
                                    <button class="bolder red center" onclick="ApproveRejectTransaction(<?= $MMId ?>,'DENY')">
                                        <i class="fa fa-close">&nbsp;</i>
                                        Reject
                                    </button>
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

    function ApproveRejectTransaction(value,switcher) {

        swal({
            title: switcher,
            text: "Any action taken, can never be undone.",
            buttons: true,
            dangerMode: true,
        })
            .then((btnSwitch) => {
                if (btnSwitch) {
                    if (switcher === 'APPROVE') {
                        approveTransaction(value)
                    }else if (switcher === 'DENY'){
                        rejectTransaction(value)
                    }
                }
                else {
                    swal("Untouched!");
                }
            });
    }

    function approveTransaction(value) {
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                apprTransaction: value
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100){
                    //$('#tblApprove').delay(800).load('#tblApprove');
                    $('#remove'+value).fadeOut(2000, function(){
                        // $('#tblApprove').fadeIn().delay(2000);
                    });
                }
            }
        });
    }

    function rejectTransaction(value){
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                rejTransaction: value
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100){
                    //$('#tblApprove').delay(800).load('#tblApprove');
                    $('#remove'+value).fadeOut(2000, function(){
                        // $('#tblApprove').fadeIn().delay(2000);
                    });
                }
            }
        });
    }

</script>