<?php
class FAQSystem{
    public function __construct() {

    }
    public static function render($filename,$ext='php'){
        include( $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/hcfaq/layouts/'.$filename.'.'.$ext);
    }

    public static function addFile($type,$file){
        $f = explode(':',$file);
        $path = $f[0];
        $filename = plugins_url($path.'/'.$f[1]);
        if($type=='js'){
            echo '<script type="text/javascript" src="'.$filename.'"></script>';
        }elseif($type=='css')
        {
            echo '<link rel="stylesheet" href="'.$filename.'" type="text/css"  />';
        }
    }
}