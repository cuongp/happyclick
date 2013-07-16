<?php
/*
Plugin Name: VM Backups
Plugin URI: http://blog.vinmatrix.com
Description: VM Backups
Version: 1.0
Author: Vinmatrix
Author URI: http://blog.vinmatrix.com
*/

define( 'VMBKUPPLN_URL', plugins_url('/', __FILE__) );
define( 'VMBKUPPLN_DIR', dirname(__FILE__) );
define( 'VMBKUPPLN_VERSION', '1.0' );
define( 'VMBKUPPLN_OPTIONS', 'vm-backups' );
define( 'VMBKUPPLN_Name', 'VM Backups' );
define( 'VMBKUPPLN_PRIFIX', 'vm_bkp_' );

add_action('admin_menu','vm_backups_admin_menu');
add_action('admin_menu','vm_backups_mgr_admin_menu');

function vm_bkp_is_zip_enable(){
    $extensions = get_loaded_extensions();
    if(in_array('zip',$extensions)){
        
    }else{
       echo '<strong style="color:red">Please Enable extension=php_zip.dll to create zip files</strong>';
  
    }

}

function vm_backups_admin_menu() {
	$opt_title_name = 'vm-backups';
	$opt_title_val = str_replace("\\","",(get_option( $opt_title_name )));
	
	if ($opt_title_val==""){
		$opt_title_val = VMBKUPPLN_Name;
		}
}
function vm_backups_mgr_admin_menu() {
	
	if (function_exists('add_options_page')) {
		add_options_page(__(VMBKUPPLN_Name),__(VMBKUPPLN_Name),10,basename(__FILE__),'vm_backups');
	}
}

function vm_backups(){
   require_once('run-backup.php');
}
/* backup the db OR just a table */
function vm_backup($backdetails)
{
    
	global $wpdb;
    $defaultdir = $backdetails['vm_bkp_path'];
    $upload_dir = wp_upload_dir();
    $defaultdir = ($defaultdir=='')?$upload_dir['basedir']:$defaultdir;
    $attachments = array();
    
    $plndir = WP_PLUGIN_DIR;
    
    $themedir = get_theme_root();
    $themedir.='/'.get_option('stylesheet').'/';
    
    if(isset($backdetails['vm_bkp_db'])&& $backdetails['vm_bkp_db']=='on'){
    $host = DB_HOST;
    $user = DB_USER;
    $pass = DB_PASSWORD;
    $name = DB_NAME;
    $tables = '*';
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);

	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
    	
    	 
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			while($row = mysql_fetch_row($result))
			{
				$return.= 'INSERT INTO '.$table.' VALUES(';
				for($j=0; $j<$num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j<($num_fields-1)) { $return.= ','; }
				}
				$return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}

	//save file
    try{
    $filepath = $defaultdir.'/'; 
    $file = 'db-backup-'.time().'.sql';   
   
    $handle = fopen($filepath.$file,'w+');
	fwrite($handle,$return);
    $attachments[] = createzip($filepath,$file,$defaultdir);
    
    	 }catch(Exception $e){
        echo $e->getMessage();
    }
	fclose($handle);
    }
    if(isset($backdetails['vm_bkp_plugins'])&& $backdetails['vm_bkp_plugins']=='on'){
    $attachments[] = createfolderzip($plndir,$defaultdir,'plugins');
    }
    if(isset($backdetails['vm_bkp_theme'])&& $backdetails['vm_bkp_theme']=='on'){
    $attachments[] = createfolderzip($themedir,$defaultdir,'theme');        
     }
    if(isset($backdetails['vm_bkp_sendmail'])&& $backdetails['vm_bkp_sendmail']=='on'){
        $vm_bkp_email = $backdetails['vm_bkp_email'];
        $vm_bkp_email = ($vm_bkp_email=='')?get_option('admin_email'):$vm_bkp_email;
        
    vm_bkp_sendmail($attachments,$vm_bkp_email);        
     
     
     }
    
   
}
function vm_bkp_sendmail($attachments,$vm_bkp_email){
  
for($i=0;$i<count($attachments);$i++)   { 
$fromAddr = get_option('admin_email'); // the address to show in From field.
$recipientAddr = $vm_bkp_email;
$subjectStr = get_option('blogname').' Site Backup';

$mailBodyText = <<<END1234
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Backups</title>
</head>
<body>
<p>Please find the attachments for the backups..
</body>
</html>
END1234;

$filePath = $attachments[$i];
$fileName = basename($filePath);
$fileType = 'zip/zip';

$mineBoundaryStr='otecuncocehccj8234acnoc231';

$headers= <<<EEEEEEEEEEEEEE
From: $fromAddr
MIME-Version: 1.0
Content-Type: multipart/mixed; boundary="$mineBoundaryStr"

EEEEEEEEEEEEEE;

$mailBodyEncodedText = <<<TTTTTTTTTTTTTTTTT
This is a multi-part message in MIME format.

--{$mineBoundaryStr}
Content-Type: text/html; charset=UTF-8
Content-Transfer-Encoding: quoted-printable

$mailBodyText

TTTTTTTTTTTTTTTTT;

$file = fopen($filePath,'rb'); 
$data = fread($file,filesize($filePath)); 
fclose($file);
$data = chunk_split(base64_encode($data));

// file attachment part
$mailBodyEncodedText .= <<<FFFFFFFFFFFFFFFFFFFFF
--$mineBoundaryStr
Content-Type: $fileType;
 name=$fileName
Content-Disposition: attachment;
 filename="$fileName"
Content-Transfer-Encoding: base64

$data

--$mineBoundaryStr--

FFFFFFFFFFFFFFFFFFFFF;

if (
mail( $recipientAddr , $subjectStr , $mailBodyEncodedText, $headers )
) {
  echo "<p>Mail has been sent with attachment ($fileName) !</p>";
} else {
  echo '<p>Mail sending failed with attachment ($fileName) !</p>';
}
 sleep(5);  
 } 
}
function createzip($filepath,$file,$defaultdir){
    $zip = new ZipArchive();
    $archive_file_name = $defaultdir.'/'.'db-backup-'.time().'.zip';
    
		if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
    	exit("cannot open <$archive_file_name>\n");
	}
	echo '<br/><strong>Backup has been taken at below location</strong><br/>'.$archive_file_name;    
    $zip->addFile($filepath.$file,$file);
	$zip->close();
    return $archive_file_name;
}

function createfolderzip($themedir,$defaultdir,$bkpstring){
    $zip = new ZipArchive();
    $archive_file_name = $defaultdir.'/'.$bkpstring.'-backup-'.time().'.zip';
		if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
    	exit("cannot open <$archive_file_name>\n");
	}
   $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($themedir));
   foreach ($iterator as $key=>$value) {
    $zip->addFile(realpath($key), $key) or die ("ERROR: Could not add file: $key");
   }
 $zip->close();
 echo '<br/><strong>Backup has been taken at below location</strong><br/>'.$archive_file_name;    
   
 return $archive_file_name;
 }

    