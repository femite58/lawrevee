<style>.btn-app{width: 300px !important;height: 80px !important;}</style>
<?php
if ($MPActPriv == 'H'){
    ?>
    <div>
        <div class="widget-box profileBG row">

            <p class="bolder bigger-110 red">
                Transfer from here debits the General Ledger
            </p>
            <div class="space-16"></div>
            <div class="col-md-4 col-md-offset-4">

                <div class="row">
                    <div id="rowAll">
                        <div class="col-xs-12 col-sm-6">
                            <div class="widget-box" id="widget-box-5">
                                <div class="widget-header">
                                    <h5 class="widget-title bolder">GL BALANCE</h5>

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
                                            <?= $Currency.' '.number_format(getLedgerBal(),2) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="widget-box" id="widget-box-5">
                                <div class="widget-header">
                                    <h5 class="widget-title bolder">PENDING DEBIT(s)</h5>

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
                                            <?= $Currency.' '.number_format(getPendAdminBal(),2) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-16"></div>

                <div class="row" id="rowId">

                    <div class="col-sm-9 col-xs-9">
                        <input class="form-control" id="SearchId" placeholder="Enter User ID" required>
                    </div>

                    <div class="col-sm-3 col-xs-3">
                        <button class="form-control btn btn-inverse"
                                type="button" onclick="runSearch()">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>

                </div>

                <div class="space-12"></div>

                <div id="rowContent" style="display: none">
                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <input class="form-control" id="CredName" readonly required>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <input class="form-control" id="CredPhone" readonly required>
                        </div>
                    </div>

                    <div class="space-6"></div>

                    <div class="row">
                        <div class="col-sm-12 col-xs-12">
                            <input class="form-control" id="CredAmt" placeholder="Enter Amount" required>
                        </div>
                    </div>

                    <div class="space-12"></div>

                    <div class="center">
                        <button class="btn btn-success" onclick="CredSubmit()">
                            <i class="fa fa-check">&nbsp;</i>
                            Send
                        </button>
                        &nbsp;
                        <button class="btn btn-danger" type="button"
                                onclick="location.href='index.php?get=Account'">
                            <i class="fa fa-remove">&nbsp;</i>
                            Cancel
                        </button>
                    </div>

                </div>

            </div>
        </div>
        <br>
    </div>
    <?php
}
?>
<br>
<script type="text/javascript">

    function runSearch(){

        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                getMember: $("#SearchId").val()
            },
            type: 'json',
            success: function (resp) {
                if(resp.id == 100){

                    $('#rowContent').show();
                    $('#CredName').val(resp.f_name);
                    $('#CredPhone').val(resp.phone_no);
                }
                else{
                    swal({
                        icon: resp.icon,
                        title: resp.header,
                        text: resp.body,
                    });
                }
            }
        });
    }

    function CredSubmit() {

        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                CredId: $("#SearchId").val(),
                CredAmt: $("#CredAmt").val()
            },
            type: 'json',
            success: function (resp) {

                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100) {
                    $( "#rowAll" ).load(window.location.href + " #rowAll" );
                }
            }
        });
    }

</script>
