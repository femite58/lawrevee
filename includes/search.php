<?php
include('functions/searchParam.php');
$setLoc = $_GET['location'] ?? 'All Locations';
$setMinP = $_GET['minPrice'] ?? 0;
$setMaxP = $_GET['maxPrice'] ?? $maxPrice / 2;
$setMinSz = $_GET['minSize'] ?? $size[0];
$setMaxSz = $_GET['maxSize'] ?? $size[count($size) - 1];
?>
<div class="searchFilter">
    <div class="eachFiltPar">
        <div class="eachFilt">
            <div class="filtTitle">Location</div>
            <div class="cusDropdown">
                <a href="javascript:void(0)" class="clickable">
                    <span><?= $setLoc ?></span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <div class="dropped">
                    <div class="dropItem" data-var="locField" data-val="" title="All Locations">All Locations</div>
                    <?php foreach ($locations as $loc) { ?>
                        <div class="dropItem" data-var="locField" data-val="<?= $loc ?>" title="<?= $loc ?>"><?= $loc ?></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="eachFilt">
            <div class="filtTitle">Price [ N<span class="minP"><?= number_format($setMinP) ?></span> - N<span class="maxP"><?= number_format($setMaxP) ?></span> ]</div>
            <div class="rangeCont">
                <!-- <input type="range" name="" min id=""> -->
                <div class="cusRange">
                    <div class="minBg" style="width: <?= $setMinP * 100 / $maxPrice ?>%;"></div>
                    <div class="minCtr" style="left: <?= $setMinP * 100 / $maxPrice ?>%;">
                        <div class="numShow"><span><?= number_format($setMinP) ?></span></div>
                    </div>
                    <div class="maxBg" style="width: <?= $setMaxP * 100 / $maxPrice ?>%;"></div>
                    <div class="maxCtr" style="left: <?= $setMaxP * 100 / $maxPrice ?>%;">
                        <div class="numShow"><span><?= number_format($setMaxP) ?></span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="eachFiltPar">
        <div class="eachFilt sizeCont">
            <div class="eachSize">
                <div class="filtTitle">Min Size</div>
                <div class="cusDropdown">
                    <a href="javascript:void(0)" class="clickable">
                        <span><?= $setMinSz == '--Select--' ? $setMinSz : $setMinSz . ' m<sup>2</sup>' ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropped">
                        <?php foreach ($size as $sz) { ?>
                            <div class="dropItem" data-var="szMin" data-val="<?= $sz ?>"><?= $sz ?> m<sup>2</sup></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="eachSize">
                <div class="filtTitle">Max Size</div>
                <div class="cusDropdown">
                    <a href="javascript:void(0)" class="clickable">
                        <span><?= $setMaxSz == '--Select--' ? $setMaxSz : $setMaxSz . ' m<sup>2</sup>' ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <div class="dropped">
                        <?php foreach ($size as $sz) { ?>
                            <div class="dropItem" data-var="szMax" data-val="<?= $sz ?>"><?= $sz ?> m<sup>2</sup></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <a href="javascript:void(0)" class="primBtn">
            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17.3206 15.8718C15.9472 14.4874 14.5729 13.1039 13.194 11.725C13.0795 11.6096 13.0411 11.5364 13.1436 11.3762C14.0995 9.8874 14.441 8.26496 14.1609 6.51616C13.6298 3.19802 10.7347 0.734135 7.22792 0.737797C7.05762 0.752447 6.74173 0.768012 6.42951 0.81013C2.41002 1.34759 -0.286425 5.28467 0.661223 9.22909C1.77185 13.8538 7.10523 15.9917 11.1073 13.4125C11.2621 13.3127 11.3399 13.3319 11.4571 13.4546C11.7894 13.8034 12.1355 14.1385 12.4761 14.4791C13.5035 15.5065 14.5317 16.5328 15.5571 17.562C15.8675 17.8724 16.2319 18.0298 16.6696 17.9502C17.1521 17.8632 17.4845 17.5739 17.6356 17.1097C17.7894 16.64 17.6667 16.2197 17.3206 15.8718ZM7.35427 12.8942C4.43442 12.886 2.10787 10.51 2.1152 7.54438C2.12252 4.70968 4.50583 2.37489 7.38632 2.38039C10.2833 2.38496 12.6391 4.75363 12.6291 7.65059C12.619 10.5466 10.2485 12.9025 7.35427 12.8942Z" fill="white" />
            </svg>
            <span>Search</span>
        </a>
    </div>
</div>
<script>
    let locField = <?= json_encode($setLoc == 'All Locations' ? '' : $setLoc) ?>;
    let priceMin = <?= json_encode($setMinP) ?>;
    let priceMax = <?= json_encode($setMaxP) ?>;
    let szMin = <?= json_encode($setMinSz == '--Select--' ? '' : $setMinSz) ?>;
    let szMax = <?= json_encode($setMaxSz == '--Select--' ? '' : $setMaxSz) ?>;
    let minP = document.querySelector('.filtTitle .minP');
    let maxP = document.querySelector('.filtTitle .maxP');
    let originalMax = <?= $maxPrice ?>;
    const dropItems = document.querySelectorAll('.searchFilter .dropItem');
    dropItems.forEach(d => {
        d.onclick = () => {
            let dataVar = d.getAttribute('data-var');
            let dataVal = d.getAttribute('data-val');
            d.parentElement.previousElementSibling.firstElementChild.innerHTML = d.innerHTML;
            d.parentElement.previousElementSibling.firstElementChild.title = dataVal;
            eval(`${dataVar} = "${dataVal}"`);
        }
    });
    const ctrls = document.querySelectorAll('.cusRange [class$="Ctr"]');
    ctrls.forEach(c => {
        if (c.classList.contains('minCtr')) {
            c.onmousedown = minCtr;
            c.ontouchstart = minCtr;
        } else {
            c.onmousedown = maxCtr;
            c.ontouchstart = maxCtr;
        }
    });
    const searchBtn = document.querySelector('.eachFiltPar .primBtn');
    searchBtn.onclick = () => {
        location.href = `<?= $baseUrl ?>search.php?${locField ? `location=${locField}&` : ''}minPrice=${priceMin}&maxPrice=${priceMax}&minSize=${szMin || <?= json_encode($size[0]) ?>}&maxSize=${szMax || <?= json_encode($size[count($size) - 1]) ?>}`;
    }
    let initPos;
    let initXPos;
    let curW;
    let parW;
    let ctr = 1;
    let ctrW;
    let nextW;
    let draggingEl;

    function numberFormat(num, dec = 0) {
        let count = 0;
        let numStr = num.toFixed(dec);
        let intP = numStr.split('.')[0];
        let treated = '';
        for (let i = intP.length - 1; i > -1; i--) {
            if (count == 3) {
                treated = ',' + treated;
                count = 0;
            }
            treated = intP[i] + treated;
            count++;
        }
        return `${treated}${dec ? `.${numStr.split('.')[1]}`:''}`;
    }

    function minCtr(e) {
        dragStart(e, 0, +getComputedStyle(e.target.nextElementSibling).width.replace('px', ''));
    }

    function drag(e) {
        parW = +getComputedStyle(draggingEl.parentElement).width.replace('px', '');
        let curX = e.type == 'mousemove' ? e.x : e.touches[0].clientX;
        let diff = curX - initXPos;
        initXPos = curX;
        initPos += diff;
        if (ctr) {
            if (initPos >= parW) {
                initPos = parW;
            } else if (initPos <= ctrW) {
                initPos = ctrW;
            }
            priceMax = +(initPos * originalMax / parW).toFixed(0);
            draggingEl.firstElementChild.firstElementChild.innerHTML = numberFormat(priceMax);
            maxP.innerHTML = numberFormat(priceMax);
        } else {
            if (initPos <= 0) {
                initPos = 0;
            } else if (initPos >= nextW - ctrW) {
                initPos = nextW - ctrW;
            }
            priceMin = +(initPos * originalMax / parW).toFixed(0);
            draggingEl.firstElementChild.firstElementChild.innerHTML = numberFormat(priceMin);
            minP.innerHTML = numberFormat(priceMin);
        }
        draggingEl.style.left = `${initPos}px`;
        draggingEl.previousElementSibling.style.width = `${initPos}px`;
    }

    function dragEnd(e) {
        document.onmousemove = null;
        document.ontouchmove = null;
        document.onmouseup = null;
        document.ontouchend = null;
        draggingEl.classList.remove('dragging');
    }

    function dragStart(e, dir, nW) {
        if (e.type != 'touchstart') {
            e.preventDefault();
        }
        draggingEl = e.target;
        initXPos = e.type == 'mousedown' ? e.x : e.touches[0].clientX;
        initPos = +getComputedStyle(draggingEl).left.replace('px', '');
        curW = +getComputedStyle(draggingEl.previousElementSibling).width.replace('px', '');
        parW = +getComputedStyle(draggingEl.parentElement).width.replace('px', '');
        ctrW = +getComputedStyle(draggingEl).width.replace('px', '');
        draggingEl.classList.add('dragging');
        ctr = dir;
        nextW = nW;
        document.onmousemove = drag;
        document.ontouchmove = drag;
        document.onmouseup = dragEnd;
        document.ontouchend = dragEnd;
    }

    function maxCtr(e) {
        dragStart(e, 1, null);
    }
</script>