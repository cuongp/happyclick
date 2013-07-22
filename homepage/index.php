
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <title>Happy Click - Thăng tiến mỗi ngày</title>
        <link rel="shortcut icon" href="favicon.ico" />
        <link rel="stylesheet" href="css/jbclock.css" type="text/css" media="all" />
        <script type="text/javascript" src="http://www.jbmarket.net/demos/countdown/demo1/js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="js/jbclock.js"></script>
                <script type="text/javascript">
            $(document).ready(function(){
                JBCountDown({
                    secondsColor : "#ffdc50",
                    secondsGlow  : "none",
                    
                    minutesColor : "#9cdb7d",
                    minutesGlow  : "none",
                    
                    hoursColor   : "#378cff",
                    hoursGlow    : "none",
                    
                    daysColor    : "#ff6565",
                    daysGlow     : "none",
                    <?php $today = date("d F Y") ?>
                    startDate   : "<?php echo strtotime($today) ?>",
                    endDate     : "<?php echo strtotime("01 August 2013"); ?>",
                    now         : "<?php echo strtotime("now"); ?>"
                });
            });
        </script>
        <style>
            body{
                background: url(homepage.jpg) 50% 0 no-repeat;
                height: 2250px;
            }
            .clock{}
            .clock .val {
                color: #555;
            }
            .clock .topLayer {
                background: none;
            }
            .clock .bgLayer{
                background: none;
            }
        </style>
    </head>
    <body>
        
        <div class="wrapper">
        <h4>Chính thức khai trương vào ngày 01/08/2013</h4>
        <div class="clock" style="margin: 0;">
            <!-- Days -->
            <div class="clock_days">
                <div class="bgLayer">
                     
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_days">Ngày</p>
                    </div>
                </div>
            </div>
            <!-- Days -->
            <!-- Hours -->
            <div class="clock_hours">
                <div class="bgLayer">
                     
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_hours">Giờ</p>
                    </div>
                </div>
            </div>
            <!-- Hours -->
            <!-- Minutes -->
            <div class="clock_minutes">
                <div class="bgLayer">
                     
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_minutes">Phút</p>
                    </div>
                </div>
            </div>
            <!-- Minutes -->
            <!-- Seconds -->
            <div class="clock_seconds">
                <div class="bgLayer">
                     
                    <div class="text">
                        <p class="val">0</p>
                        <p class="type_seconds">Giây</p>
                    </div>
                </div>
            </div>
            <!-- Seconds -->
        </div>
        </div><!--/wrapper-->
    </body>
</html>