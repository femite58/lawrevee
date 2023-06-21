<?php
if (!empty($_GET['get'])) {
    $Pagination = array(

        'Dashboard',
        'Profile',
        'Registration',
        'Wallets',
        'TransCredit',
        'CashOut',
        'TreeView1',
        'TreeView2',
        'OnlineMembers',
    );

    if ($MPActPriv == 'H'){
        array_push($Pagination,'Account');
    } else if ($MPActPriv == 'A'){
        array_push($Pagination,'Authorize','CreatePin');
    }

    $Page = $_GET['get'];
    if(in_array($Page,$Pagination)){
        $Page = strtolower($Page);
        include 'lrv-'.$Page.'.php';
    }
    else {
        ?>+
        <div class="panel panel-primary">
            <div class="row" style="padding: 10%;">
                <div class="col-sm-5 col-sm-offset-3">
                    <div class="alert alert-danger">
                        <p style='font-size: 20px;font-weight: 900;font-family: cursive;color: red;text-align: center;'>
                            You Are Lost !<br>Please Get Back Home Before Mama Calls..</p>
                    </div>
                    <div class="center">
                        <button class="btn btn-sm btn-danger"
                                onclick="location.href='index.php?get=Dashboard'">
                            GO HOME
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
else {
    include 'lrv-dashboard.php';
}