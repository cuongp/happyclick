<div id="widgetkit" class="wrap">

    <h2 class="title">Card System</h2>
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
                if($_GET['options']=='create')
                    $error = 'active';
                if($_GET['options']=='history')
                    $complaint = 'active';
                if($_GET['options']=='statistics')
                    $statistics = 'active';
                if($_GET['options']=='cardtype')
                    $cardtype = 'active';
                if($_GET['options']=='subscription')
                    $subscription = 'active';
                ?>
                <li class="<?php echo $homepage.' '.$service ?>"><a href="?page=hccard&options=list">List Cards</a> </li>
                <li class="<?php echo $error ?>" ><a href="?page=hccard&options=create">Import Cards</a> </li>
               
                <li class="<?php echo $complaint ?>"><a href="?page=hccard&options=history">History </a> </li>
                <li class="<?php echo $statistics ?>" ><a href="?page=hccard&options=statistics">Statistics</a> </li>
                <li class="<?php echo $subscription ?>" ><a href="?page=hccard&options=subscription">Subscription</a> </li>
            </ul>
            <ul id="tabs" class="content">
                <li><div id="content"></div>

                    
                <li>
                <?php
                    if($_GET['options']=='list')
                        CardSystem::render('list');
                    if($_GET['options']=='create')
                        CardSystem::render('create');
                    if($_GET['options']=='history')
                        CardSystem::render('history');
                    if($_GET['options']=='statistics')
                        CardSystem::render('statistics');
                    if($_GET['options']=='cardtype')
                        CardSystem::render('cardtype/list');
                    if($_GET['options']=='subscription')
                        CardSystem::render('sub');
                     if($_GET['options']=='viewuser')
                        CardSystem::render('viewuser');


                ?></li>
            </ul>

        </div>
    </div>

</div>