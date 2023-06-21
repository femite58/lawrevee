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
                swal({
                    title: resp.header,
                    text: resp.body,
                    icon: resp.icon,
                    buttons: true,
                    dangerMode: true,
                })
                    .then((btnLogout) => {
                        if (btnLogout) {
                            activateOnlineMember(resp.user_id)
                        }
                        else {
                            swal("Member remain deactivated!");
                        }
                    });
                // setTimeout(function () {
                //         if (resp.id == 600){
                //             location.reload();
                //         }
                //     },
                //     2000);
            }
            else{
                swal({
                    icon: resp.icon,
                    title: resp.header,
                    text: resp.body,
                });
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