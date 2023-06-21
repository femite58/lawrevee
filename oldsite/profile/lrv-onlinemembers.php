<div>
    <div class="widget-box profileBG">
        <div>
            <!-- PAGE CONTENT BEGINS -->

            <div class="row">
                <div class="col-xs-12">

                    <div class="table-header" style="background: darkred !important;">
                        Online members registered under you.
                    </div>

                    <div>
                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="center">
                                    <label class="pos-rel">
                                        <input type="checkbox" class="ace" />
                                        <span class="lbl"></span>
                                    </label>
                                </th>
                                <th>NAMES</th>
                                <th>USER ID</th>
                                <th class="hidden-480">PHONE</th>

                                <th>
                                    <i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
                                    DATE
                                </th>
                                <th class="hidden-480">STATUS</th>

                                <th>ACTION</th>
                            </tr>

                            </thead>
                            <tbody>

                            <?php
                            $Query = "SELECT * FROM lrvmemprofile WHERE MPBib = '$MPMemId' AND MPEntryPayCheck != 'Y'";
                            $runQuery = $db->query($Query);
                            while ($nDl = mysqli_fetch_array($runQuery)){
                                $TarId = $nDl['MPMemId'];
                                ?>
                                <tr id="removeAct<?= $TarId ?>">
                                    <td class="center">
                                        <label class="pos-rel">
                                            <input type="checkbox" class="ace" />
                                            <span class="lbl"></span>
                                        </label>
                                    </td>

                                    <td>
                                        <a href="#"><?= getTitle($nDl['MPTitle']).' '.$nDl['MPFirstName'].' '.$nDl['MPLastName'] ?></a>
                                    </td>
                                    <td><?= $nDl['MPUserId'] ?></td>
                                    <td class="hidden-480"><?= $nDl['MPPhone'] ?></td>
                                    <td><?= $nDl['MPDateTime'] ?></td>

                                    <td class="hidden-480">
                                        <span class="label label-sm label-warning">Not Activited</span>
                                    </td>

                                    <td>
                                        <div class="hidden-sm hidden-xs action-buttons">
                                            <a class="blue" href="#" onclick="confirmActivateOnlineMember(<?= $TarId ?>)">
                                                <i class="ace-icon fa fa-check-square bigger-130">&nbsp;</i>
                                                Activate
                                            </a>
                                        </div>
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
            <!-- PAGE CONTENT ENDS -->
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

    });

    function setPosition(value1,value2){

        $.ajax({
            url:'lrv.isset.php',
            method: 'POST',
            data: {
                setLegs: value1,
                Target: value2
            },
            type: 'json',
            success: function (resp) {

                $('#regStatMsg').html(resp.status);
                $('#DisplayBoard').modal('show');

                setTimeout(function () {
                        $('#DisplayBoard').modal('hide');
                        if (resp.id == 100) {
                            location.reload();
                        }
                    },
                    5000);
            }
        });
    }
</script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
<script src="assets/js/dataTables.buttons.min.js"></script>
<script src="assets/js/dataTables.select.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        //initiate dataTables plugin
        var myTable =
            $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    bAutoWidth: false,
                    "aoColumns": [
                        {"bSortable": false},
                        null, null, null, null, null,
                        {"bSortable": false}
                    ],
                    "aaSorting": [],

                    select: {
                        style: 'multi'
                    }
                });

        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
            defaultCopyAction(e, dt, button, config);
            $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });

        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {

            defaultColvisAction(e, dt, button, config);

            if ($('.dt-button-collection > .dropdown-menu').length == 0) {
                $('.dt-button-collection')
                    .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                    .find('a').attr('href', '#').wrap("<li />")
            }
            $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });

        setTimeout(function () {
            $($('.tableTools-container')).find('a.dt-button').each(function () {
                var div = $(this).find(' > div').first();
                if (div.length == 1)
                    div.tooltip({container: 'body', title: div.parent().text()});
                else
                    $(this).tooltip({container: 'body', title: $(this).text()});
            });
        }, 500);

        myTable.on('select', function (e, dt, type, index) {
            if (type === 'row') {
                $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
            }
        });
        myTable.on('deselect', function (e, dt, type, index) {
            if (type === 'row') {
                $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
            }
        });

        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);

        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $('#dynamic-table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    myTable.row(row).select();
                else
                    myTable.row(row).deselect();
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]', function () {
            var row = $(this).closest('tr').get(0);
            if (this.checked)
                myTable.row(row).deselect();
            else
                myTable.row(row).select();
        });

        $(document).on('click', '#dynamic-table .dropdown-toggle', function (e) {
            e.stopImmediatePropagation();
            e.stopPropagation();
            e.preventDefault();
        });

        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function () {
            var th_checked = this.checked;//checkbox inside "TH" table header

            $(this).closest('table').find('tbody > tr').each(function () {
                var row = this;
                if (th_checked)
                    $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
                else
                    $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
            });
        });

        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]', function () {
            var $row = $(this).closest('tr');
            if ($row.is('.detail-row '))
                return;
            if (this.checked)
                $row.addClass(active_class);
            else
                $row.removeClass(active_class);
        });

        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

        //tooltip placement on right or left
        function tooltip_placement(context, source) {
            var $source = $(source);
            var $parent = $source.closest('table')
            var off1 = $parent.offset();
            var w1 = $parent.width();

            var off2 = $source.offset();
            //var w2 = $source.width();

            if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                return 'right';
            return 'left';
        }

        $('.show-details-btn').on('click', function (e) {
            e.preventDefault();
            $(this).closest('tr').next().toggleClass('open');
            $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });

    })

</script>
<script>
    function confirmActivateOnlineMember(value) {
        swal("CONFIRM ACTIVATE ?","Activating this member will deduct from your e-Wallet","warning",{
            buttons: true,
            dangerMode: true,
        });
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
                swal(resp.header,resp.body,resp.icon)
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
            swal("ERROR!","Operation cancelled, please set target first.","warning");
        }
        else if (value1){
            swal("LOADING..!","Please wait, While we set this member as TARGET.","success");
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
            swal("Position "+ value2 +" Selected","Now select any member from the table to fix on this position.","success");
        }
    }

    function slaveMember(bSlave) {
        //235
        var bSide = $('#bSide').val();
        var bOwner = $('#bOwner').val();

        if (bOwner == ''){
            swal("ERROR!","Operation cancelled, please set target first.","warning");
        }
        else if (bSide == '') {
            swal("IGNORED!","Select position first to fix this member (Left or Right).","warning");
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
                    swal(resp.header,resp.body,resp.icon);
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
                            swal("Member remain deactivated!");
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