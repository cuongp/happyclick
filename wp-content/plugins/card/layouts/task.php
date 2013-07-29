<?php
if($_GET['task'] == 'edit_carttype'){
    $data = $_POST;
    if($data['service_id']==""){
        $rs = CiaServices::insert(array('service_name'=>$data['service_name'],'parent_id'=>0,'valid'=>$data['valid']));
    }else if($data['service_id']>0){
        $rs = CiaServices::update(array('service_id'=>$data['service_id'],'service_name'=>$data['service_name'],'parent_id'=>0,'valid'=>$data['valid']),array('service_id'=>$data['service_id']));
    }
}
?>
<div id="widgetkit" class="wrap">

    <h2 class="title">Support Ticket</h2>
    <p>Manage all your widgets right here. To display widgets, please visit the <a href="widgets.php">widgets settings</a> screen and apply the Widgetkit to a widget position of your theme.</p>
    <div class="dashboard">
        <div class="tabs-box">
            <ul class="nav">
                <?php
                $homepage='';
                if(empty($_GET['options']) && empty($_GET['task']))
                    $homepage='active';
                if($_GET['options']=='service' || $_GET['task'] =='edit_service')
                    $service = 'active';
                if($_GET['options']=='error' || $_GET['task'] =='edit_error')
                    $error = 'active';
                if($_GET['options']=='complaint' || $_GET['task'] =='edit_complaint')
                    $complaint = 'active';
                if($_GET['options']=='statistics')
                    $statistics = 'active';
                if($_GET['options']=='subscription')
                    $subscription = 'active';
                ?>
                <li class="<?php echo $homepage.' '.$service ?>"><a href="?page=hccard&options=service">Our Services</a> </li>
                <li class="<?php echo $error ?>" ><a href="?page=hccard&options=error">Errors</a> </li>
                <li class="<?php echo $complaint ?>"><a href="?page=hccard&options=complaint">Complaints</a> </li>
                <li class="<?php echo $statistics ?>" ><a href="?page=hccard&options=statistics">Statistics</a> </li>
                <li class="<?php echo $subscription ?>" ><a href="?page=hccard&options=subscription">Subscription</a> </li>
            </ul>
            <ul id="tabs" class="content"><li>
                <?php
                    if($_GET['options']=='list')
                        CardSystem::render('list');
                    if($_GET['options']=='create')
                        CardSystem::render('create');
                    if($_GET['options']=='history')
                        CardSystem::render('history');
                    if($_GET['options']=='statistics')
                        CardSystem::render('statistics');
                    if($_GET['options']=='subscription')
                        CardSystem::render('sub');
                    if($_GET['options']=='cardtype')
                        CardSystem::render('cardtype/list');


                ?></li>
            </ul>

        </div>
    </div>

</div>