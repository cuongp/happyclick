<?php
vm_bkp_is_zip_enable();
if(isset($_POST) && $_POST['submit']=='Save'){
    update_option(VMBKUPPLN_OPTIONS,$_POST);
}
$vm_bkp_options = get_option(VMBKUPPLN_OPTIONS);
$vmbkppath = $vm_bkp_options[VMBKUPPLN_PRIFIX.'path'];
$vmbkpplugins = ($vm_bkp_options[VMBKUPPLN_PRIFIX.'plugins']=='on')?'checked':'';
$vmbkpdb = ($vm_bkp_options[VMBKUPPLN_PRIFIX.'db']=='on')?'checked':'';
$vmbkptheme = ($vm_bkp_options[VMBKUPPLN_PRIFIX.'theme']=='on')?'checked':'';
$vmbkpsendmail = ($vm_bkp_options[VMBKUPPLN_PRIFIX.'sendmail']=='on')?'checked':'';
$vmbkpemail = $vm_bkp_options[VMBKUPPLN_PRIFIX.'email'];
if(isset($_POST) && $_POST['submit']=='Take BackUp'){
    $vm_bkp_options = get_option(VMBKUPPLN_OPTIONS);
    if($vm_bkp_options!=''){
         vm_backup($_POST);
    }else{
        echo 'Please select the options and Save';
    }
   
}

?>
<div>
<h2>VM Backup Options</h2>
<form action="" method="POST" onsubmit="showProcess();">
<table>
<tr><td>
Backup Path:</td><td><input type="text" name="<?php echo VMBKUPPLN_PRIFIX;?>path" value="<?php echo $vmbkppath;?>"/> // Default backup files locates in wp-content/uploads/</td>
</tr><tr><td>
Plugins:</td><td><input type="checkbox" name="<?php echo VMBKUPPLN_PRIFIX;?>plugins" <?php echo $vmbkpplugins;?>/></td>
</tr>
<tr><td>
Total DB:</td><td><input type="checkbox" name="<?php echo VMBKUPPLN_PRIFIX;?>db" <?php echo $vmbkpdb;?>/></td>
</tr>
<tr><td>
Current Theme: </td><td><input type="checkbox" name="<?php echo VMBKUPPLN_PRIFIX;?>theme" <?php echo $vmbkptheme;?>/></td>
</tr>
<tr><td>
Send Mail: </td><td><input type="checkbox" name="<?php echo VMBKUPPLN_PRIFIX;?>sendmail" <?php echo $vmbkpsendmail;?>/></td>
</tr>
<tr><td>
Email ID to Send: </td><td><input type="text"  name="<?php echo VMBKUPPLN_PRIFIX;?>email" value="<?php echo $vmbkpemail;?>"/> // if this is empty Mails will sent to admin email..</td>
</tr>
 <tr><td colspan="2">
<input type="submit" name="submit" value="Save"/></td>
</tr>
 <tr><td colspan="2">
<input type="submit" name="submit" value="Take BackUp"/></td>
</tr>
</table>
</form>
</div>
<div id="progress"></div>
<script>
function showProcess(){
    document.getElementById('progress').innerHTML = '<strong style="color:green;">This will take several minutes please be patient...</strong>';
    
}
</script>