<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>#LIN - LAWREVEE INVESTMENT NETWORK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicons -->
    <link href="../img/lin-logo.jpeg" rel="icon">
    <link href="../img/lin-logo.jpeg" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Montserrat:300,400,500,700" rel="stylesheet">

    <!-- Bootstrap CSS File -->
    <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Libraries CSS Files -->
    <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../lib/animate/animate.min.css" rel="stylesheet">
    <link href="../lib/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <link href="../css/style.css" rel="stylesheet">
<style>
    #about {
        min-height: 95vh !important;
    }
</style>
</head>

<body>

<header id="header" style="background: #000000E6 !important;">
    <div class="container-fluid">

        <nav id="nav-menu-container">
            <ul class="nav-menu" style="color: black !important;">
                <li><a href="../">Home</a></li>
                <li><a href="../about">About Us</a></li>
                <li class="menu-has-children menu-active"><a href="index.php">Services</a>
                    <ul>
                        <li><a href="index.php?url=Asset-And-Wealth-Management">Asset And Wealth Management</a></li>
                        <li><a href="index.php?url=Investment-Banking">Investment Banking</a></li>
                        <li><a href="index.php?url=Project-Funding">Project Funding</a></li>
                        <li><a href="index.php?url=Portfolio-Management">Portfolio Management</a></li>
                        <li><a href="index.php?url=Private-Equity-And-Debt-Investment">Private Equity And Debt Investment</a></li>
                        <li><a href="index.php?url=Financial-Consulting-Services">Financial Consulting Services</a></li>
                    </ul>
                </li>
                <li><a href="../team">Team</a></li>
                <li><a href="../contact">Contact Us</a></li>
                <li class="aL"><a href="../auth">Client Portal Login</a></li>
            </ul>
        </nav>
    </div>
</header>

<section id="about" class="section-bg wow fadeInUp">
    <div class="container">

        <div id="logo" class="justify">
            <h2><img src="../img/LIN-logo-removebg.png" alt="logo" style="width: 200px;padding-top: 50px"></h2>
        </div>
        <hr>
        <div class="section-header">
            <h3 class="parentBanner">Services</h3>
        </div>
        <br>
        <?php

        include 'pagination.php';

        if ($InfoServices == 'Investment-Banking' ||
            $InfoServices == 'Portfolio-Management' ||
            $InfoServices == 'Financial-Consulting-Services' ||
            $InfoServices == 1) {
            ?>
            <section id="featured-services">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-2 box">
                            <i class="ion-ios-briefcase-outline"></i>
                            <h4 class="title"><a href="index.php?url=Asset-And-Wealth-Management">Asset And Wealth Management</a></h4>
                            <hr>
                            <p class="description">As a private equity management and portfolio company,
                                we provide Asset and Wealth Management <br><a href="index.php?url=Asset-And-Wealth-Management"><more>Read More...</more></a></p>
                        </div>

                        <div class="col-lg-2 box box-bg">
                            <i class="ion-ios-box-outline"></i>
                            <h4 class="title"><a href="index.php?url=Investment-Banking">Investment Banking</a></h4>
                            <hr>
                            <p class="description">LIN is a leading solutions-driven Corporate and Investment Bank
                                that offers our clients innovative <br><a href="index.php?url=Investment-Banking"><more>Read More...</more></a></p>
                        </div>

                        <div class="col-lg-2 box">
                            <i class="ion-ios-home-outline"></i>
                            <h4 class="title"><a href="index.php?url=Project-Funding">Project Funding</a></h4>
                            <hr>
                            <p class="description">LIN focuses on fundraising and financing of approved
                                socio-economic projects, such as infrastructure, <br><a href="index.php?url=Project-Funding"><more>Read More...</more></a></p>
                        </div>

                        <div class="col-lg-2 box" style="background: darkred">
                            <i class="ion-ios-bookmarks-outline"></i>
                            <h4 class="title"><a href="index.php?url=Portfolio-Management">Portfolio Management</a></h4>
                            <hr>
                            <p class="description">LIN uses a highly focused approach to investing
                                and a hands-on operating philosophy in an effort <br><a href="index.php?url=Portfolio-Management"><more>Read More...</more></a></p>
                        </div>

                        <div class="col-lg-2 box">
                            <i class="ion-ios-stopwatch-outline"></i>
                            <h4 class="title"><a href="index.php?url=Private-Equity-And-Debt-Investment">Private Equity And Debt Investment</a></h4>
                            <hr>
                            <p class="description">LIN Private Equity Funds focus primarily on
                                control-oriented investments in cash flow generating <br><a href="index.php?url=Private-Equity-And-Debt-Investment"><more>Read More...</more></a></p>
                        </div>

                        <div class="col-lg-2 box" style="background: darkgreen">
                            <i class="ion-ios-list-outline"></i>
                            <h4 class="title"><a href="index.php?url=Financial-Consulting-Services">Financial Consulting Services</a></h4>
                            <hr>
                            <p class="description">LIN offers a full range of financial consultancy
                                services with specialization in asset and wealth <br><a href="index.php?url=Financial-Consulting-Services"><more>Read More...</more></a></p>
                        </div>

                    </div>
                </div>
            </section>
        <?php }
        ?>
    </div>
</section>

<footer id="footer">
    <div class="container">
        <div class="copyright">
            <small>&copy; Copyright 2021 <strong>&nbsp; L I N </strong></small>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<script src="../lib/jquery/jquery.min.js"></script>
<script src="../lib/jquery/jquery-migrate.min.js"></script>
<script src="../lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../lib/easing/easing.min.js"></script>
<script src="../lib/superfish/hoverIntent.js"></script>
<script src="../lib/superfish/superfish.min.js"></script>
<script src="../lib/wow/wow.min.js"></script>
<script src="../lib/waypoints/waypoints.min.js"></script>
<script src="../lib/counterup/counterup.min.js"></script>
<script src="../lib/owlcarousel/owl.carousel.min.js"></script>
<script src="../lib/isotope/isotope.pkgd.min.js"></script>
<script src="../lib/lightbox/js/lightbox.min.js"></script>
<script src="../lib/touchSwipe/jquery.touchSwipe.min.js"></script>

<script src="../contactform/contactform.js"></script>

<script src="../js/main.js"></script>

</body>
</html>
