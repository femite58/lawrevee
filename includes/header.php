<?php
include("connect.php");
function getDec($div, $minDec, $maxDec)
{
    $pnts = explode('.', strval($div));
    return count($pnts) > 1 ? ((strlen($pnts[1]) <= $maxDec) ? strlen($pnts[1]) : $maxDec) : $minDec;
}
function truncAmnt($num, $full = false, $dec = 0, $maxDec = 2)
{
    if ($full) {
        if ($num < 1000 * 1000 * 1000 && $num >= 1000 * 1000) {
            $div = $num / (1000 * 1000);
            $actDec = getDec($div, $dec, $maxDec);
            return number_format($div, $actDec) . ' million';
        }
        if ($num < 1000 * 1000 * 1000 * 1000 && $num >= 1000 * 1000 * 1000) {
            $div = $num / (1000 * 1000 * 1000);
            $actDec = getDec($div, $dec, $maxDec);
            return number_format($div, $actDec) . ' billion';
        }
        $div = $num / (1000 * 1000 * 1000 * 1000);
        $actDec = getDec($div, $dec, $maxDec);
        return number_format($div, $actDec) . ' trillion';
    } else {
        if ($num < 1000) {
            return number_format($num, $dec);
        }
        if ($num < 1000 * 1000 && $num >= 1000) {
            $div = $num / 1000;
            $actDec = getDec($div, $dec, $maxDec);
            return number_format($div, $actDec) . 'k';
        }
        if ($num < 1000 * 1000 * 1000 && $num >= 1000 * 1000) {
            $div = $num / (1000 * 1000);
            $actDec = getDec($div, $dec, $maxDec);
            return number_format($div, $actDec) . 'm';
        }
        if ($num < 1000 * 1000 * 1000 * 1000 && $num >= 1000 * 1000 * 1000) {
            $div = $num / (1000 * 1000 * 1000);
            $actDec = getDec($div, $dec, $maxDec);
            return number_format($div, $actDec) . 'b';
        }
        $div = $num / (1000 * 1000 * 1000 * 1000);
        $actDec = getDec($div, $dec, $maxDec);
        return number_format($div, $actDec) . 't';
    }
}

// $queryRes = mysqli_query($link, 'SELECT * FROM lands WHERE ')

$baseUrl = 'http://localhost/lawreevee/';
$assets = $baseUrl . "assets/";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle . ' | Lawreevee' ?></title>
    <link rel="shortcut icon" href="<?= $assets ?>images/logo.png">
    <link rel="stylesheet" href="<?= $assets ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $assets ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= $assets ?>css/style.css">
</head>

<body>
   
    <header class="<?php echo ($isHome ? 'home' : ''); ?>">
        <div class="bodyCont">
            <nav>
                <a href="<?= $baseUrl ?>" class="logoCont">
                    <img src="<?= $assets ?>images/logo.png" alt="Lawreevee">
                </a>
                <div class="menuCont d-flex justify-content-end flex-grow-1">
                    <ul class="centeredMenu">
                        <li><a href="<?= $baseUrl ?>about.php">About Us</a></li>
                        <li><a href="<?= $baseUrl ?>services.php">Services</a></li>
                        <li><a href="<?= $baseUrl ?>lands.php">Projects</a></li>
                        <li><a href="<?= $baseUrl ?>contactus.php" class="white">Contact Us</a></li>
                        <li><a href="<?= $baseUrl ?>blog.php" class="white">Blog</a></li>
                        <li>
                            <a href="javascript:void(0)" class="white dropClick">
                                <span>Library</span>
                                <i class="fa fa-angle-down"></i>
                            </a>
                            <div class="subMenu">
                                <a href="<?= $baseUrl ?>photolibrary.php">Photos</a>
                                <a href="<?= $baseUrl ?>videolibrary.php">Videos</a>
                            </div>
                        </li>
                    </ul>
                    <a href="<?= $baseUrl ?>lands.php" class="primBtn">Get Started</a>
                    <div class="toggleMenu">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <script>
        const toggle = document.querySelector('header .toggleMenu');
        const centeredMenu = document.querySelector('header .centeredMenu');
        const dropClick = document.querySelector('header .dropClick');
        toggle.onclick = () => {
            toggle.classList.toggle('dropShow');
            centeredMenu.classList.toggle('dropShow');
        }
        dropClick.onclick = () => {
            if (window.innerWidth <= 850) {
                const submenu = dropClick.nextElementSibling;
                const subitems = [...submenu.children];
                if (getComputedStyle(submenu).height == '0px') {
                    let totalH = 0;
                    subitems.forEach(e => {
                        totalH += e.clientHeight;
                    });
                    submenu.style.height = `${totalH}px`;
                    dropClick.classList.add('submenuDrop');
                } else {
                    submenu.style.height = '';
                    dropClick.classList.remove('submenuDrop');
                }
            }
        }
        const header = document.querySelector('header');
        window.onscroll = () => {
            let targetPos = window.innerWidth <= 850 ? 70 : 100;
            if (document.scrollingElement.scrollTop > targetPos) {
                header.classList.add('stick');
            } else {
                header.classList.remove('stick');
            }
        }
    </script>