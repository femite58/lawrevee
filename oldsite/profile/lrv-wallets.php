<style>
    .DisWallet{font-size: 20px;font-weight: 600;height: 30px;padding: 1px}
</style>
<div>
    <div class="widget-box">
        <div class="profileBG">

            <button class="btn btn-primary bigger-110" onclick="RechargeModal()">
                <i class="fa fa-check">&nbsp;</i>
                PIN RECHARGE
            </button>

            <div class="space-12"></div>
            <div class="row col-sm-offset-2">
                <div class="col-xs-12 col-sm-3 widget-container-col">
                    <div class="widget-box widget-color-dark light-border">

                        <div class="widget-body bgShape">
                            <div class="widget-main padding-6">
                                <div class="widget-header">
                                    <h6 class="widget-title smaller"> <b>e-WALLET</b> </h6>

                                    <div class="widget-toolbar">
                                        <span class="badge badge-grey">BG-Monitor</span>
                                    </div>
                                </div>
                                <div class="center DisWallet">
                                    <b>
                                        <?= $Currency.' '.number_format($MyWallet,2) ?>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3 widget-container-col">
                    <div class="widget-box widget-color-green2 light-border" id="widget-box-6">

                        <div class="widget-body bgShape">
                            <div class="widget-main padding-6">
                                <div class="widget-header">
                                    <h6 class="widget-title smaller"> <b>PENDING CREDIT(s)</b> </h6>

                                    <div class="widget-toolbar">
                                        <span class="badge badge-grey">BG-Monitor</span>
                                    </div>
                                </div>
                                <div class="center DisWallet">
                                    <b>&nbsp;
                                        <?= $Currency.' '.number_format(getAmtPend(),2) ?>
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-3 widget-container-col">
                    <div class="widget-box widget-color-green2 light-border" id="widget-box-6">

                        <div class="widget-body bgShape">
                            <div class="widget-main padding-6">
                                <div class="widget-header">
                                    <h6 class="widget-title smaller"> <b>DIGITAL WALLET</b> </h6>

                                    <div class="widget-toolbar">
                                        <span class="badge badge-grey">BG-Monitor</span>
                                    </div>
                                </div>
                                <div class="center DisWallet">
                                    <b>&nbsp;
                                        <?= $Currency.' '.number_format(0,2) ?>
                                    </b>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="box">
                <div class="" style="overflow: scroll; height: 400px">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thin-border-bottom">
                        <tr style="border-bottom: 3px solid #000032;width: 100%">
                            <th style="width: 13%">TRANSACTION ID</th>
                            <th style="width: 13%">TRANSACTION DATE</th>
                            <th>TRANSACTION STATUS</th>
                            <th style="width: 13%">AMOUNT</th>
                            <th style="width: 10%">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $LogQuery = "SELECT * FROM lrvmemmonitor WHERE MMFormNo = '$MPMemId' ORDER BY MMId DESC";
                        $PrepareLogs = $db->query($LogQuery);
                        while ($logs = mysqli_fetch_array($PrepareLogs)) {
                            $MMActPriv = $logs['MMActPriv'];
                            ?>
                            <tr style="font-size: 15px">
                                <td><?= $logs['MMTxnId'] ?></td>

                                <td><?= $logs['MMSysDate'] ?></td>

                                <td class="<?= getColorCode($MMActPriv) ?>"><?= $logs['MMDescription'] ?></td>

                                <td class="<?= getColorCode($MMActPriv) ?>">
                                    <?= $Currency.' '.number_format($logs['MMAmount'],2) ?>
                                </td>
                                <td>
                                    <?php
                                    switch ($MMActPriv) {
                                        case 'D':
                                            echo "<span class='label label-danger arrowed'>Debit</span>";
                                            break;
                                        case 'C':
                                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Credit</span>";
                                            break;
                                        case 'P':
                                            echo "<span class='label label-primary arrowed-in'>Waiting For Approval</span>";
                                            break;
                                        case 'A':
                                            echo "<span class='label label-success arrowed-in arrowed-in-right'>Approved</span>";
                                            break;
                                        case 'B':
                                            echo "<span class='label label-danger arrowed'>Rejected</span>";
                                            break;
                                        default:
                                            echo "Unknown";
                                    }
                                    ?>
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
