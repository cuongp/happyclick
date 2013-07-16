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
                ?>
                <li class="<?php echo $homepage.' '.$service ?>"><a href="?page=tickets&options=service">Our Services</a> </li>
                <li class="<?php echo $error ?>" ><a href="?page=tickets&options=error">Errors</a> </li>
                <li class="<?php echo $complaint ?>"><a href="?page=tickets&options=complaint">Complaints</a> </li>
                <li class="<?php echo $statistics ?>" ><a href="?page=tickets&options=statistics">Statistics</a> </li>
            </ul>
            <ul id="tabs" class="content"><li>
                <?php
                    if($_GET['task'] == 'edit_service'){
                        CiaTicketSystem::render('service/form');
                    }
                    if($_GET['task'] == 'edit_error'){
                        CiaTicketSystem::render('error/form');
                    }
                    if($_GET['task'] == 'edit_complaint'){
                        CiaTicketSystem::render('complaint/form');
                    }
                    if($_GET['task'] == 'answer_complaint'){
                        CiaTicketSystem::render('complaint/form_answer');
                    }

                ?></li>
            </ul>

        </div>
    </div>

</div>