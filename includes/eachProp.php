<?php
$images = explode(',', $prop['images']);
?>
<div class="eachProp" href="">
    <div class="imgCont">
        <div class="innerCont">
            <span class="status">Available Now</span>
            <div class="slideCont">
                <div class="carouselParent">
                    <div class="flexCont">
                        <?php foreach ($images as $i => $img) { ?>
                            <a class="carouselItem" href="<?= $baseUrl ?>propertydetails.php?l=<?= $prop['id'] ?>">
                                <img src="<?= $baseUrl . 'img/' . $img ?>" alt="<?= $prop['name'] ?>">
                            </a>
                        <?php } ?>
                    </div>
                    <div class="carouselIndicators">
                        <?php foreach ($images as $i => $img) { ?>
                            <div class="indicatorItem <?php echo ($i == 0 ? 'cusActive' : ''); ?>"></div>
                        <?php } ?>
                    </div>
                    <a href="javascript:void(0)" class="carouselCtrlPrev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="javascript:void(0)" class="carouselCtrlNext">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <a class="txtPart" href="<?= $baseUrl ?>propertydetails.php?l=<?= $prop['id'] ?>">
        <h5>N<?= truncAmnt(floatval($prop['price']), true) ?></h5>
        <p><?= $prop['name'] ?> - <?= $prop['neighborhood'] ?></p>
        <div class="locSize">
            <div class="location">
                <svg width="15" height="19" viewBox="0 0 15 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.19238 18.9253C5.92932 17.848 4.75857 16.6669 3.69238 15.3943C2.09238 13.4833 0.192384 10.6373 0.192384 7.92534C0.190966 5.09289 1.89663 2.53873 4.51345 1.45474C7.13027 0.370748 10.1424 0.970584 12.1444 2.97434C13.4608 4.28495 14.1983 6.06773 14.1924 7.92534C14.1924 10.6373 12.2924 13.4833 10.6924 15.3943C9.6262 16.6669 8.45545 17.848 7.19238 18.9253ZM7.19238 4.92534C6.12059 4.92534 5.13021 5.49714 4.59431 6.42534C4.05841 7.35355 4.05841 8.49714 4.59431 9.42534C5.13021 10.3535 6.12059 10.9253 7.19238 10.9253C8.84924 10.9253 10.1924 9.5822 10.1924 7.92534C10.1924 6.26849 8.84924 4.92534 7.19238 4.92534Z" fill="#FCA001" />
                </svg>
                <span title="<?= $prop['location'] ?>"><?= $prop['location'] ?></span>
            </div>
            <div class="size">
                <svg width="21" height="18" viewBox="0 0 21 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="6.66772" y="3.9646" width="13.3356" height="13.3356" fill="#333341" />
                    <rect y="0.550293" width="13.3356" height="13.3356" fill="#FCA001" />
                </svg>
                <?php preg_match('/\d+/', $prop['size'], $match); ?>
                <span><?= $match[0] ?>
                    <span>SQM</span>
                    <span>m<sup>2</sup></span>
                </span>
            </div>
        </div>
    </a>
</div>