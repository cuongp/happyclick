<div id="widgetkit" class="wrap">

    <h2 class="title">FAQ System</h2>
    <p>Manage all your widgets right here. To display widgets, please visit the <a href="widgets.php">widgets settings</a> screen and apply the Widgetkit to a widget position of your theme.</p>



    <div class="dashboard">
        <div class="tabs-box">
            <ul class="nav">
                <?php
                $homepage='';
                if(empty($_GET['options']))
                    $homepage='active';
                if($_GET['options']=='list')
                    $service = 'active';
                
                ?>
                <li class="<?php echo $homepage.' '.$service ?>"><a href="?page=hcfaq&options=list">List Questions</a> </li>
                </ul>
            <ul id="tabs" class="content">
                <li><div id="content"></div>  
                <li>
                <?php
                    if($_GET['options']=='list')
                        FAQSystem::render('list');
                ?></li>
            </ul>

        </div>
    </div>

</div>