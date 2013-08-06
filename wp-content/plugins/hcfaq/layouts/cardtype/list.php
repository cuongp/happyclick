<?php
if(!isset($_GET['p']))
    $page = 1;
else
    $page = $_GET['p'];

$params['show'] = 15;
$params['start'] = ($page-1)*$params['show'];
$cardtypes = CardType::getAll($params);
?>
<table class='list' id="service">
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Valid</th>
        <th class="actions"></th>
    </tr>
    </thead>
    <tbody>
    <?php

    if(!empty($cardtypes)):
        foreach($cardtypes as $s):
            ?>
        <tr id="<?php echo $s->id ?>-card-type">
            <td>
                <a href=""><?php echo $s->id; ?></a>
            </td>
            <td>
                <?php
                    echo $s->name;
                ?>
            </td>
            <td><?php echo $s->valid==1?'Yes':'No'; ?></td>
            <td>
                <a class="action edit" href="/wp-admin/admin.php?page=hccard&options=carttype&task=edit_carttype&id=<?php echo $s->id?>">View</a>
            </td>
        </tr>
            <?php
        endforeach;
    endif;
    ?>

    </tbody>
</table>
