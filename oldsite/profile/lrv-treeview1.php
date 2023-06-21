<style>.tPhoto{width: 50px !important;}</style>
<div>
    <link href="mlmcss/css/styles.css" rel="stylesheet" type="text/css">

    <div>
        <div class="panel panel-body panel-info profileBG">
            <button onclick="location.href='index.php?get=TreeView1&vTree=<?= $MPMemId ?>'"
                    style="padding: 3px">
                RESET
             </button>
            <div class="header center blue">
                <b>VIEW MEMBERS PROFILE INFORMATION UNDER YOU</b>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="profile-user-info profile-user-info-striped" style="background: ghostwhite">

                    <div class="profile-info-row">
                        <div class="profile-info-name"> User ID </div>

                        <div class="profile-info-value">
                            <span><?= strtolower($proTr['MPUserId']) ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Title </div>

                        <div class="profile-info-value">
                            <?= getTitle($proTr['MPTitle']) ?>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> First Name </div>

                        <div class="profile-info-value">
                            <?= strtoupper($proTr['MPFirstName']) ?>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Last Name </div>

                        <div class="profile-info-value">
                            <?= strtoupper($proTr['MPLastName']) ?>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Phone No # </div>

                        <div class="profile-info-value">
                            <span><?= $proTr['MPPhone'] ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Email </div>

                        <div class="profile-info-value">
                            <span><?= $proTr['MPEmail'] ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Bank Details </div>

                        <div class="profile-info-value">
                    <span>
                        <?= getBank($proTr['MPBankName']) ? getBank($proTr['MPBankName']) : 'Bank Name Not Added' ?>
                    </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Acct No.# </div>

                        <div class="profile-info-value">
                            <span><?= $proTr['MPAccountNo']?$proTr['MPAccountNo']:'No added number' ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Address </div>

                        <div class="profile-info-value">
                            <i class="fa fa-map-marker light-orange bigger-110"></i>
                            <span><?= $proTr['MPAddress'] ? $proTr['MPAddress']:'No Address Added' ?></span>

                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Sponsor </div>

                        <div class="profile-info-value">
                            <b><?= ucwords(getSpName($proTr['MPSponsorId'])) ?></b>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Sponsor No.#</div>

                        <div class="profile-info-value">
                    <span>
                        <?php
                        if (empty(fromDB('MPPhone','lrvmemprofile',
                            'MPMemId',$proTr['MPBib']))) {
                            echo "Your sponsor added no number";
                        }else {
                            $ssh = $proTr['MPBib'];
                            echo "Your sponsor phone number is : ".
                                fromDB('MPPhone','lrvmemprofile','MPMemId',$ssh);
                        }
                        ?>
                    </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Package </div>

                        <div class="profile-info-value">
                    <span><?= getRegPkgDesc($proTr['MPEntryPackage']) ?> &nbsp;
                        <?= $Currency.' '.number_format(getRegPkgAmt($proTr['MPEntryPackage']),2) ?></span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Privilege </div>

                        <div class="profile-info-value">
                    <span class="red">
                        <?php
                        if ($proTr['MPActPriv'] == 'Y'){
                            echo "<b>NO PRIVILEGE ADDED</b>";
                        } else if ($proTr['MPActPriv'] == 'A' && getSuperUser($MPMemId) == $MPMemId){
                            echo "<b>ADMIN PRIVILEGE / SUPER MEMBER</b>";
                        } else if ($proTr['MPActPriv'] == 'A'){
                            echo "<b>ADMIN PRIVILEGE</b>";
                        } else if ($proTr['MPActPriv'] == 'H'){
                            echo "<b>SYSTEM PRIVILEGE</b>";
                        }
                        ?>
                    </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Country </div>

                        <div class="profile-info-value">
                    <span>
                        <?= $proTr['MPCountry'] ? $proTr['MPCountry'] : 'Country Not Added' ?>
                        <?= getCountry($proTr['MPCountry']) ?>
                    </span>
                        </div>
                    </div>

                    <div class="profile-info-row">
                        <div class="profile-info-name"> Invite Link </div>

                        <div class="profile-info-value">
                            <span> https://lawrevee.com/registration/index.php?bib=<?= $TreeUsr ?> </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <div class="tree">
                    <ul>
                        <li>
                            <a href="javascript:void(0)">
                                <p><img src="img/user_icon.png" class="tPhoto"></p>
                                <p class="TreeSide"><?= getSpName($TreeUsr) ?></p>
                            </a>
                            <ul>
                                <li>
                                    <a href="index.php?get=TreeView1&vTree=<?= b1Tree($TreeUsr) ?>">
                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                        <p class="TreeSide"><?= getSpName(b1Tree($TreeUsr)) ?></p>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b1Tree($TreeUsr)) ?>">
                                                <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                <p class="TreeSide"><?= TreeNames(b1Tree(b1Tree($TreeUsr))) ?></p>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b1Tree(b1Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b1Tree(b1Tree(b1Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b1Tree(b1Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b2Tree(b1Tree(b1Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b1Tree($TreeUsr)) ?>">
                                                <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                <p class="TreeSide"><?= TreeNames(b2Tree(b1Tree($TreeUsr))) ?></p>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b2Tree(b1Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b1Tree(b2Tree(b1Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b2Tree(b1Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b2Tree(b2Tree(b1Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="index.php?get=TreeView1&vTree=<?= b2Tree($TreeUsr) ?>">
                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                        <p class="TreeSide"><?= getSpName(b2Tree($TreeUsr)) ?></p>
                                    </a>
                                    <ul>
                                        <li>
                                            <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b2Tree($TreeUsr)) ?>">
                                                <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                <p class="TreeSide"><?= TreeNames(b1Tree(b2Tree($TreeUsr))) ?></p>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b1Tree(b2Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b1Tree(b1Tree(b2Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b1Tree(b2Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b2Tree(b1Tree(b2Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b2Tree($TreeUsr)) ?>">
                                                <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                <p class="TreeSide"><?= TreeNames(b2Tree(b2Tree($TreeUsr))) ?></p>
                                            </a>
                                            <ul>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b1Tree(b2Tree(b2Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b1Tree(b2Tree(b2Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="index.php?get=TreeView1&vTree=<?= b2Tree(b2Tree(b2Tree($TreeUsr))) ?>">
                                                        <p><img src="img/user_icon.png" class="tPhoto"></p>
                                                        <p class="TreeSide"><?= TreeNames(b2Tree(b2Tree(b2Tree($TreeUsr)))) ?></p>
                                                    </a>
                                                </li>
                                            </ul>
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

    <script>
        $(document).ready(function(){

        });
    </script>

</div>