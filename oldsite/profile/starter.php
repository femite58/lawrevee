<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>#LRV Lawrevee - Real Estate Managers</title>

    <!-- Global stylesheets -->
    <link href="mlmcss/styles.css" rel="stylesheet" type="text/css">
    <link href="mlmcss/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="mlmcss/core.min.css" rel="stylesheet" type="text/css">
    <link href="mlmcss/components.min.css" rel="stylesheet" type="text/css">
    <link href="mlmcss/colors.min.css" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="mlmjs/pace.min.js"></script>
    <script type="text/javascript" src="mlmjs/jquery.min.js"></script>
    <script type="text/javascript" src="mlmjs/bootstrap.min.js"></script>
    <script type="text/javascript" src="mlmjs/blockui.min.js"></script>

    <!-- loader-->
    <script type="text/javascript" src="mlmjs/jquery.loading.block.js"></script>
    <script type="text/javascript" src="mlmjs/loader.function.js"></script>

    <!-- validation-->
    <script type="text/javascript" src="mlmjs/validate.min.js"></script>
    <script type="text/javascript" src="mlmjs/additional-methods.min.js"></script>
    <script type="text/javascript" src="mlmjs/client-validation.js"></script>

    <!---Date picker table list start from here---->
    <script type="text/javascript" src="mlmjs/jgrowl.min.js"></script>
    <script type="text/javascript" src="mlmjs/moment.min.js"></script>
    <script type="text/javascript" src="mlmjs/daterangepicker.js"></script>
    <script type="text/javascript" src="mlmjs/anytime.min.js"></script>
    <script type="text/javascript" src="mlmjs/picker.js"></script>
    <script type="text/javascript" src="mlmjs/picker.date.js"></script>
    <script type="text/javascript" src="mlmjs/picker.time.js"></script>
    <script type="text/javascript" src="mlmjs/legacy.js"></script>
    <script type="text/javascript" src="mlmjs/picker_date.js"></script>
    <script type="text/javascript" src="mlmjs/datatables.min.js"></script>
    <script type="text/javascript" src="mlmjs/datatables_responsive.js"></script>

    <!-- Theme JS files -->
    <script type="text/javascript" src="mlmjs/interactions.min.js"></script>
    <script type="text/javascript" src="mlmjs/js/datatables.min.js"></script>
    <script type="text/javascript" src="mlmjs/js/select2.min.js"></script>

    <!-- ckeditor start -->
    <script type="text/javascript" src="mlmjs/js/ckeditor.js"></script>
    <!-- ckeditor end -->

    <script type="text/javascript" src="mlmjs/js/fileinput.min.js"></script>
    <script type="text/javascript" src="mlmjs/js/app.js"></script>
    <script type="text/javascript" src="mlmjs/js/datatables_data_sources.js"></script>
    <script type="text/javascript" src="mlmjs/js/uploader_bootstrap.js"></script>
    <script type="text/javascript" src="mlmjs/js/form_select2.js"></script>

    <script type="text/javascript" src="mlmjs/js/spectrum.js"></script>
    <script type="text/javascript" src="mlmjs/js/picker_color.js"></script>
    <script src="mlmjs/js/pusher.min.js"></script>
    <link href="img/logo-vsmall.png" rel="icon">

    <style>
        .select-border-color {
            border: 1px #ddd;
        }
        .border-warning {
            border-color: #ddd;
        }
        .wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .tree{

        }
    </style>
</head>
<body>
<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="http://globalmlm.org/lawrevee/user/">
            User Panel
            <ul class="nav navbar-nav visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
                <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
                <li><a href="http://globalmlm.org/lawrevee/user/auth/logout"><i class="icon-switch2"></i> Logout</a></li>
            </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">

        <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
        <ul class="nav navbar-nav navbar-right">

            <li class="dropdown dropdown-user">
                <a class="dropdown-toggle" data-toggle="dropdown">
                    <img src="http://globalmlm.org/lawrevee/images/" alt="">
                    <span> Niffeur</span>
                    <i class="caret"></i>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="http://globalmlm.org/lawrevee/user/account/viewProfile"><i class="icon-user-plus"></i> My profile</a></li>
                    <li class="divider"></li>
                    <li><a target="_blank" href="http://globalmlm.org/lawrevee/join-us"><i class="icon-user-plus"></i> Register Member</a></li>
                    <li class="divider"></li>
                    <li><a href="http://globalmlm.org/lawrevee/user/auth/logout"><i class="icon-switch2"></i> Logout</a></li>

                </ul>
            </li>
        </ul>
    </div>
</div>
<div class="page-container">

    <div class="page-content">
        <link href="mlmcss/css/styles.css" rel="stylesheet" type="text/css">
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i>
                            <span class="text-semibold">
                                My Genealogy Management
                            </span>
                            - Starter Stage Tree
                        </h4>
                    </div>
                    <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                </div>

                <div class="breadcrumb-line">
                    <ul class="breadcrumb">
                        <li>
                            <a href="javascript:void(0)">
                                <i class="icon-home2 position-left"></i>
                                Home
                            </a>
                        </li>
                        <li class="active">My Genealogy Management</li>
                        <li class="active">Starter Stage Tree</li>
                    </ul>
                </div>
            </div>

            <div class="content">
                <div class="row">
                    <div class="col-md-12">

                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h5 class="panel-title">Starter Stage Tree</h5>
                                <div class="heading-elements">
                                    <ul class="icons-list">
                                        <li><a data-action="collapse"></a></li>
                                        <li><a data-action="reload"></a></li>
                                        <li><a data-action="close"></a></li>
                                    </ul>
                                </div>
                                <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
                            </div>

                            <div class="panel-body">
                                <div class="row">
                                    <tr>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-light"
                                                data-popup="popover"
                                                title="User Name (User Id SCN123456)"
                                                data-trigger="hover"
                                                data-html="true"
                                                data-content="User Name : Name <br>
                                                User Id : 123456 <br> D.O.J : 14-01-2019 <br>
                                                Left Count : 1 <br>
                                                Right Count : 2 <br>
                                                Current Stage : Ruby">
                                                Overall Status
                                                <i class="icon-play3 ml-2"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 wrapper">
                                        <div class="tree">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <p><img src="img/user1.png" style="width: 70px"></p>
                                                        <p>LVR2840795</p>
                                                        <p>Jennifer</p>
                                                    </a>
                                                    <ul>
                                                        <li>
                                                            <a href="#">
                                                                <p><img src="img/user1.png" style="width: 70px"></p>
                                                                <p>Puno</p>
                                                                <p>LVR6938115</p>
                                                            </a>
                                                            <ul>
                                                                <li>
                                                                    <a href="#">
                                                                        <p><img src="img/user1.png" style="width: 70px"></p>
                                                                        <p>Springdollar</p>
                                                                        <p>LVR5876375</p>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <p><img src="img/user1.png" style="width: 70px"></p>
                                                                        <p>Gloria</p>
                                                                        <p>LVR53308854</p>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <p><img src="img/user1.png" style="width: 70px"></p>
                                                                <p>Blessed</p>
                                                                <p>LVR9439695</p>
                                                            </a>
                                                            <ul>
                                                                <li>
                                                                    <a href="#">
                                                                        <p> <img src="img/user1.png" style="width: 70px"></p>
                                                                        <p>Greatness</p>
                                                                        <p>LVR9175875</p>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <p><img src="img/user1.png" style="width: 70px"></p>
                                                                        <p>Jovigiant</p>
                                                                        <p>LVR6524775</p>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="footer text-muted">
                        &copy; 2020.
                        <a href="javascript:void(0)">
                            Lawrevee. All right reserved
                        </a> Developed by
                        <a href="javascript:void(0)">
                            OutputSystems
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function(){
            });
        </script>

    </div>

</div>
</body>
</html>
