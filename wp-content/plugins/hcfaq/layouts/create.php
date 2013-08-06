<?php



if(!empty($_FILES['file'])){
if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );
$uploadedfile = $_FILES['file'];
$upload_overrides = array( 'test_form' => false );
$movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
if ( $movefile ) {
    
    
    $db = $GLOBALS['wpdb'];
 	$csvfile = file_get_contents($movefile['file']);
 	$lines = str_replace("\r", ";", $csvfile);
 	$lines = explode(';', $lines);
 	$import_serial = array();
 	if(!empty($lines)){
 		$serials = $db->get_results('select serial from '.$db->prefix.'cards');
 		$serialsData = array();
 		foreach ($serials as $key) {
 			$serialsData[]=$key->serial;
 		}
 		
 		foreach ($lines as $line) {
 			$array = array();
 			$csv = explode(',', $line);
 			$csv[0] = isset($csv[0]) ? str_replace('\n','',$csv[0]) : '';
 			$csv[1] = isset($csv[1]) ? md5($csv[1]) : '';
 			if(!in_array($csv[0], $serialsData)){
 				$array = array('serial'=>$csv[0],'code'=>$csv[1],'created_at'=>time());
 				$db->insert($db->prefix.'cards',$array);	
 			}else
 			{
 				echo "<div class='error' style='padding:5px'>Thẻ cào có serial {$csv[0]} đã có trong hệ thống</div>";
 			}
  		}
 	} 	 
    
} else {
    echo "Possible file upload attack!\n";
}
}else
{
	echo '<div class="error">Bạn chưa chọn file để import</div>';
}

?>


<form enctype="multipart/form-data" method="post">
    <label>Import File:</label>
    <input type="file" name="file"><br/>
    <input type="submit" class="button" value="Import" />
</form>