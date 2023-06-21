<div>
    <div class="widget-box profileBG">
        <button onclick="location.href='index.php?get=TreeView2&vTree=<?= $MPMemId ?>'"
                style="padding: 3px">
            RESET
        </button>
        <div class="row">
            <br>
            <div class="center">
                <small class="bolder red">BUILD YOUR NETWORK, POPULATE MEMBERS</small><br>
            </div>
            <div class="space-6"></div>
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-6">
                    <div>

                            <input id="memSearch" type="text">
                            <button onclick="positionSearch($('#memSearch').val())"
                                    style="padding: 6px;border: 1px solid skyblue">
                                <i class="glyphicon glyphicon-search">&nbsp;</i>
                            </button>

                        <div class="space-6"></div>

                        <div class="panel panel-body">
                            <div style="overflow: scroll; height: 300px">
                                <table class="table table-bordered table-striped table-hover">
                                    <tr style="border-bottom: 3px solid #000032;">
                                        <th>ID</th>
                                        <th><i class="glyphicon glyphicon-user">&nbsp;</i>Full Name</th>
                                        <th>Phone</th>
                                        <th>Target</th>
                                    </tr>
                                    <?php
                                    $i = 0;
                                    $extra = bCtrlOwner($db);
                                    $Query = "SELECT * FROM lrvmemprofile WHERE MPBib IN('$MPMemId','$extra') AND MPGroup = 'A' AND MPEntryPayCheck = 'Y'";
                                    $runQuery = $db->query($Query);
                                    while ($nDl = mysqli_fetch_array($runQuery)){
                                        $TarId = $nDl['MPMemId'];
                                        $i++;
                                        ?>
                                        <tr style="color: <?= $nDl['MPBib'] == $MPMemId?'':'blue' ?>">
                                            <td><?= $nDl['MPUserId'] ?></td>
                                            <td><?= getTitle($nDl['MPTitle']).' '.$nDl['MPFirstName'].' '.$nDl['MPLastName'] ?></td>
                                            <td><?= $nDl['MPPhone'] ?></td>
                                            <td class="center">
                                                <button onclick="slaveMember(<?= $TarId ?>)"
                                                        class="btn-sm" style="padding: 3px;border: 1px solid skyblue">
                                                    SET
                                                </button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <?= empty($i) ? "Nothing To Display" : "Total : $i Member(s)" ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 center">
                    <div>
										<span class="profile-picture iPhoto">
											<img class="img-responsive" alt="Profile Picture"
                                                 src="img/user_icon.png">
                                            <sm>Target</sm>
										</span>

                        <div class="space-4"></div>
                        <pn><?= getSpName(bCtrlOwner($db)) ?></pn>

                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
													<span id="b1Position" class="profile-picture iPhoto" onclick="setPosition('<?= b1Tree(bCtrlOwner($db)) ?>',1)">

													<img class="img-responsive" alt="Right" src="img/user_icon.png">
                                                        <sm>LEFT</sm>
												</span>
                            <div class="space-4"></div>
                            <pn><?= getSpName(b1Tree(bCtrlOwner($db))) ?></pn>
                        </div>
                        <div class="col-xs-6">
													<span id="b2Position" class="profile-picture iPhoto" onclick="setPosition('<?= b2Tree(bCtrlOwner($db))?>',2)">
													<img class="img-responsive" alt="Right" src="img/user_icon.png">
                                                        <sm>RIGHT</sm>
												</span>
                            <div class="space-4"></div>
                            <pn><?= getSpName(b2Tree(bCtrlOwner($db))) ?></pn>
                        </div>
                        <label for="bOwner"></label><input id="bOwner" value="<?= bCtrlOwner($db) ?>" style="display: none">
                        <label for="bSide"></label><input id="bSide" style="display: none">
                    </div>

                    <div class="space-16"></div>
                    <hr>
                    <small class="center">
                        LAWREVEEHOMES Multi-Level Marketing (MLM) Platform
                        <small>(v1.0)</small>
                    </small>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmActivateOnlineMember(value) {
        swal({
            title: "CONFIRM ACTIVATE ?",
            text: "Activating this member will deduct from your e-Wallet",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((btnLogout) => {
                if (btnLogout) {
                    activateOnlineMember(value)
                }
                else {
                    swal("Online Member Not Activated!");
                }
            });
    }

    function activateOnlineMember(value) {
        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                memToActivate: value,
            },
            type: 'json',
            success: function (resp) {
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
                if (resp.id == 100){
                    $('#removeAct'+value).fadeOut(2000, function(){
                        // $('#tblApprove').fadeIn().delay(2000);
                    });
                }
            }
        });
    }

    function setPosition(value1,value2) {

        var bOwner = $('#bOwner').val();

        if (bOwner == ''){
            swal({
                icon: "warning",
                title: "ERROR!",
                text: "Operation cancelled, please set target first.",
            });
        }
        else if (value1){
            swal({
                icon: "success",
                title: "LOADING..!",
                text: "Please wait, While we set this member as TARGET.",
            });
            setTimeout(function () {
                    location.href='index.php?get=TreeView2&vTree=' + value1;
                },
                2000);
        }
        else {
            if (value2 == 1){
                $('#b2Position').css({'border':''}).removeClass('icon-animated-vertical');
                $('#b1Position').css({'border':'3px solid red'}).addClass('icon-animated-vertical');
            }
            else if (value2 == 2){
                $('#b1Position').css({'border':''}).removeClass('icon-animated-vertical');
                $('#b2Position').css({'border':'3px solid red'}).addClass('icon-animated-vertical');
            }
            $('#bSide').val(value2);
            swal({
                icon: "success",
                title: "Position "+ value2 +" Selected",
                text: "Now select any member from the table to fix on this position.",
            });
        }
    }

    function slaveMember(bSlave) {
        //235
        var bSide = $('#bSide').val();
        var bOwner = $('#bOwner').val();

        if (bOwner == ''){
            swal({
                icon: "warning",
                title: "ERROR!",
                text: "Operation cancelled, please set target first.",
            });
        }
        else if (bSide == '') {
            swal({
                icon: "warning",
                title: "IGNORED!",
                text: "Select position first to fix this member (Left or Right).",
            });
            $('#b1Position').css({'border':'3px solid red'}).addClass('icon-animated-vertical');
            $('#b2Position').css({'border':'3px solid red'}).addClass('icon-animated-vertical');
        } else
        {
            $.ajax({
                url: '../profile/lrv.isset.php',
                method: 'POST',
                data: {
                    setLegsOwner: bOwner,
                    setLegsFrom: bSlave,
                    setLegTo: bSide
                },
                type: 'json',
                success: function (resp) {
                    swal({
                        icon: resp.icon,
                        title: resp.header,
                        text: resp.body,
                    });
                    setTimeout(function () {
                            if (resp.id == 100){
                                location.reload();
                            }
                        },
                        1500);
                }
            });

        }
    }

    function positionSearch(value){

        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                worldSearch: value,
            },
            type: 'json',
            success: function (resp) {
                if(resp.id == 600){
                    swal(resp.header,resp.body,resp.icon,{
                        buttons: true,
                        dangerMode: true,
                    });
                .then((btnLogout) => {
                        if (btnLogout) {
                            activateOnlineMember(resp.user_id)
                        }
                        else {
                            swal("Member remain in-active!");
                        }
                    });
                }
                else{
                    swal(resp.header,resp.body,resp.icon);
                }
                setTimeout(function () {
                        if (resp.id == 100){
                            location.href=resp.url;
                        }
                    },
                    1500);
            }
        });
    }
</script>
