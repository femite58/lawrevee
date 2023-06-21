<style>.btn-app{width: 300px !important;height: 80px !important;}.wdrAgent{display: none}</style>
<div>
<div class="widget-box profileBG">
    <div class="">

        <p class="red">
            Cashing out from your earnings, and Incentives. This process debits your Digital Wallet
        </p>
        <div class="space-16"></div>
        <div class="row">

            <div class="">

                <div class="col-md-4 col-md-offset-4">

                    <div class="">
                        <div class="widget-box" id="widget-box-5">
                            <div class="widget-header">
                                <h5 class="widget-title bolder">DIGITAL WALLET</h5>

                                <div class="widget-toolbar">
									<span class="label label-success">
									100%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-6">
                                    <div class="alert alert-info bolder bigger-150 center">
                                        <?= $Currency.' '.number_format(0,2) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="">
                        <div class="widget-box" id="widget-box-5">
                            <div class="widget-header">
                                <h5 class="widget-title bolder">TOTAL CASH OUT</h5>

                                <div class="widget-toolbar">
									<span class="label label-success">
									100%
									<i class="ace-icon fa fa-arrow-up"></i>
								</span>
                                </div>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main padding-6">
                                    <div class="alert alert-info bolder bigger-150 center">
                                        <?= $Currency.' '.number_format(0,2) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-12"></div>

                    <div>


                                <input class="form-control" value="<?= $MPFirstName.' '.$MPLastName ?>" readonly required>



                        <div class="space-8"></div>



                                <input value="<?= empty($MPAccountNo)?'Account Number Empty':$MPAccountNo ?>"
                                       class="form-control" readonly required>



                        <div class="space-8"></div>


                            <div class="">
                                <input onkeyup="withDrawFund(this.value)" class="form-control" placeholder="Enter Amount" required>
                            </div>

                        <i class="red" id="showStat"></i>

                        <div class="space-16"></div>

                        <div class="center">
                            <a class="bigger-120 green bolder wdrAgent"
                               onclick="($('.wdrAgent').hide() && $('#ConfirmSubmit').show())">
                                <i class="fa fa-check">&nbsp;</i>
                                Are you sure you want to withdraw the amount ?
                            </a>
                            <button class="wdrAgent" onclick="($('.wdrAgent').hide() && $('#ConfirmSubmit').show())">Yes</button>
                            <button class="wdrAgent" onclick="location.reload()">No</button>
                            <button class="btn btn-success bolder" id="ConfirmSubmit" style="display: none"
                                    onclick="SubmitFund(<?= $MPMemId ?>)">
                                <i class="fa fa-check">&nbsp;</i>
                                Withdraw Fund
                            </button>
                        </div>

                    </div>
                </div>



            </div>

        </div>
    </div>
    <br>
</div>

</div>

<br>
<script type="text/javascript">

    function withDrawFund(value) {

        if (value == '' || value < 1000){
            $('#showStat').html('');
            $('.wdrAgent').hide();
        }
        else if (value >= 1000){
            $('.wdrAgent').show();
            $('#showStat').html('');
            $('#ConfirmSubmit').hide();
        }
        else if (value < 1000) {
            $('#showStat').html('Please enter an amount greater than 1000 to withdraw');
        }
        else{
            $('#showStat').html('Amount entered is not understood, please enter a number');
            $('.wdrAgent').hide();
            $('#ConfirmSubmit').hide();
        }
    }

    function SubmitFund(value){
        swal({
            icon: "warning",
            title: "ERROR!",
            text: "Ignored, Funds can not be withdraw at this time",
        });
    }

</script>
