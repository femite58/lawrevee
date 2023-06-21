
function InsertTask(TaskDesc,TaskId,LastAction){
    //alert('just to check');
    var errLn = TaskDesc.length;

    if (errLn > 1 && errLn < 10) {
        document.getElementById(TaskId).style.color = 'red';
        document.getElementById('LowCount'+TaskId).innerHTML = 'not less than 10 characters';
    }

    else if (errLn == 1 || errLn > 15) {
        document.getElementById(TaskId).style.color = '';
        document.getElementById('LowCount'+TaskId).innerHTML = '';
        location.reload();
    }

    if (LastAction < 2 && errLn > 10) {
        document.getElementById('CheckContinue').style.display = 'inline';

    } else {
        document.getElementById('CheckContinue').style.display = 'none';
    }

    $.ajax({
        url:'src.online.php',
        method: 'POST',
        data: {
            TaskDesc:TaskDesc, TaskId:TaskId
        },
    });
}

function InsertStatus(StatusDesc,StatusId){
    $.ajax({
        url:'src.online.php',
        method: 'POST',
        data: {
            StatusDesc:StatusDesc, StatusId:StatusId
        },
        success:function (data) {
            location.href='index.php?url=ManageReport'
        },
    });
}

function InsertAssBy(AssByDesc,AssById){
    $.ajax({
        url:'src.online.php',
        method: 'POST',
        data: {
            AssByDesc:AssByDesc, AssById:AssById
        },
        success:function (data) {
            location.href='index.php?url=ManageReport'
        },
    });
}