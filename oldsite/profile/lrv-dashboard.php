<style>.infobox{height: 80px !important;width: 300px !important;}</style>
<div>
    <div class="widget-box profileBG">
        <div>
            <div id="user-profile-1" class="user-profile row">
                <div class="col-xs-12 col-md-5 center">
                    <br>
                    <div>
										<span class="profile-picture dashPhoto" style="border-radius: 20px !important;">
											<img class="img-responsive" alt="Profile Picture"
                                                 src="img/user_icon.png">
                                            <sm>YOU</sm>
										</span>

                        <div class="space-4"></div>
                        <pn><?= $MyFullName ?></pn>

                    </div>

                    <div class="space-6"></div>

                    <div class="hr hr12 dotted"></div>

                    <div class="col-xs-12">
                        <div class="col-xs-6">
													<span class="profile-picture dashPhoto" style="border-radius: 20px !important;">
													<img class="img-responsive" alt="Right" src="img/user_icon.png">
                                                        <sm>LEFT</sm>
												</span><br>
                            <div class="space-4"></div>
                            <pn><?= getSpName(b1Tree($MPMemId)) ?></pn>
                        </div>
                        <div class="col-xs-6">
													<span class="profile-picture dashPhoto" style="border-radius: 20px !important;">
													<img class="img-responsive" alt="Right" src="img/user_icon.png">
                                                        <sm>RIGHT</sm>
												</span><br>
                            <div class="space-4"></div>
                            <pn><?= getSpName(b2Tree($MPMemId)) ?></pn>
                        </div>
                    </div>

                    <div class="hr hr16 dotted"></div>
                    <div style="padding: 80px !important;"></div>

                    <b class="center">
                        <a id="copyTarget">https://lawrevee.com/auth/index.php?bib=<?= $MPUserId ?></a>
                        -- <a href="javascript:void(0)" id="copyButton"><rd>Click To Copy Invitation Link</rd></a>
                    </b>
                    <div class="space-12"></div>
                </div>

                <br>
                <div class="space-12"></div>

                <div class="infobox-container" style="padding: 3px !important;">

                    <div class="infobox infobox-blue2 iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Direct Sale Bonus</div>
                        </div>

                        <div class="stat stat-success">10%</div>
                    </div>

                    <div class="infobox infobox-black iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Generational Bonus</div>

                        </div>
                        <div class="stat stat-success">10%</div>
                    </div>

                    <div class="infobox infobox-green iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Referral Bonus</div>
                        </div>
                        <div class="stat stat-success">10%</div>
                    </div>

                    <div class="infobox infobox-red iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Placement Bonus</div>
                        </div>
                        <div class="stat stat-success">10%</div>
                    </div>

                    <div class="infobox infobox-purple2 iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Level Bonus</div>
                        </div>
                        <div class="stat stat-success">10%</div>
                    </div>

                    <div class="infobox infobox-green2 iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Matrix Bonus</div>
                        </div>
                        <div class="stat stat-important">4%</div>
                    </div>

                    <div class="infobox infobox-pink iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>

                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Non Cash Incentives</div>
                        </div>
                        <div class="stat stat-important">4%</div>
                    </div>

                    <div class="infobox infobox-blue3 iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">Life Time Earning</div>
                        </div>
                        <div class="stat stat-important">100%</div>
                    </div>

                    <div class="infobox infobox-orange iBox">
                        <div class="infobox-icon">
                            <i class="ace-icon fa fa-shopping-cart"></i>
                        </div>
                        <div class="infobox-data">
                            <span class="infobox-data-number">0</span>
                            <div class="infobox-content">UniLevel</div>
                        </div>
                        <div class="stat stat-important">100%</div>
                    </div>

                    <div class="space-6"></div>
                </div>

            </div>
        </div>

        <div class="">
            <?php

            $Months = array('','January','February','March','April','May','June','July','August','September','October','November','December');
            $Performance = array(0,58,20,43,23,76,12,53,15,81,44,66,56);

            $vLength = count($Months) - 1;
            ?>

            <script>
                window.onload = function () {

                    var chart = new CanvasJS.Chart("chartContainer", {
                        theme: "light1", // "light1","light2", "dark1", "dark2"
                        animationEnabled: false, // change to true
                        title:{
                            text: "Monthly Performance"
                        },
                        data: [
                            {   // Change type to "bar", "area", "spline", "pie", "column" etc.
                                type: "spline",
                                dataPoints: [
                                    <?php
                                    for($i = 1; $i <= $vLength; $i++){
                                    ?>
                                    { label: "<?= $Months[$i] ?>",  y: <?= $Performance[$i] ?>  },
                                    <?php
                                    }
                                    ?>
                                ]
                            }
                        ]
                    })
                    chart.render();
                }
            </script>

            <div id="chartContainer" style="height: 250px; width: 100%;"></div>
        </div>
    </div>
    <div class="space-12"></div>
</div>