<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// generate css for layout
$css[] = sprintf('.wrapper { max-width: %dpx; }', $this['config']->get('template_width'));

// generate css for 3-column-layout
$sidebar_a       = '';
$sidebar_b       = '';
$maininner_width = 100;
$sidebar_a_width = intval($this['config']->get('sidebar-a_width'));
$sidebar_b_width = intval($this['config']->get('sidebar-b_width'));
$sidebar_trial_width = intval($this['config']->get('sidebar-trial_width'));

$sidebar_classes = "";
$rtl             = $this['config']->get('direction') == 'rtl';
$body_config	 = array();

// set widths
if ($this['modules']->count('sidebar-a')) {
	$sidebar_a = $this['config']->get('sidebar-a'); 
	$maininner_width -= $sidebar_a_width;
	
	$css[] = sprintf('#sidebar-a { width: %d%%; }', $sidebar_a_width);
}
if ($this['modules']->count('sidebar-b')) {
	$sidebar_b = $this['config']->get('sidebar-b'); 
	$maininner_width -= $sidebar_b_width;
	$css[] = sprintf('#sidebar-b { width: %d%%; }', $sidebar_b_width);
}

if ($this['modules']->count('sidebar-trial')) {
	$sidebar_trial = $this['config']->get('sidebar-trial'); 
	$maininner_width =100 - $sidebar_trial_width;

	$css[] = sprintf('#sidebar-trial { width: %d%%; }', $sidebar_trial_width);
}
$css[] = sprintf('#maininner { width: %d%%; }', $maininner_width);

// all sidebars right
if (($sidebar_a == 'right' || !$sidebar_a) && ($sidebar_b == 'right' || !$sidebar_b)) {
	$sidebar_classes .= ($sidebar_a) ? 'sidebar-a-right ' : '';
	$sidebar_classes .= ($sidebar_b) ? 'sidebar-b-right ' : '';

// all sidebars left
} elseif (($sidebar_a == 'left' || !$sidebar_a) && ($sidebar_b == 'left' || !$sidebar_b)) {
	$sidebar_classes .= ($sidebar_a) ? 'sidebar-a-left ' : '';
	$sidebar_classes .= ($sidebar_b) ? 'sidebar-b-left ' : '';
	$css[] = sprintf('#maininner { float: %s; }', $rtl ? 'left' : 'right');

// sidebar-a left and sidebar-b right
} elseif ($sidebar_a == 'left') {
	$sidebar_classes .= 'sidebar-a-left sidebar-b-right ';
	$css[] = '#maininner, #sidebar-a { position: relative; }';
	$css[] = sprintf('#maininner { %s: %d%%; }', $rtl ? 'right' : 'left', $sidebar_a_width);
	$css[] = sprintf('#sidebar-a { %s: -%d%%; }', $rtl ? 'right' : 'left', $maininner_width);

// sidebar-b left and sidebar-a right
} elseif ($sidebar_b == 'left') {
	$sidebar_classes .= 'sidebar-a-right sidebar-b-left ';
	$css[] = '#maininner, #sidebar-a, #sidebar-b { position: relative; }';
	$css[] = sprintf('#maininner, #sidebar-a { %s: %d%%; }', $rtl ? 'right' : 'left', $sidebar_b_width);
	$css[] = sprintf('#sidebar-b { %s: -%d%%; }', $rtl ? 'right' : 'left', $maininner_width + $sidebar_a_width);
}

// number of sidebars
if ($sidebar_a && $sidebar_b) {
	$sidebar_classes .= 'sidebars-2 ';
} elseif ($sidebar_a || $sidebar_b) {
	$sidebar_classes .= 'sidebars-1 ';
}

// generate css for dropdown menu
foreach (array(1 => '.dropdown', 2 => '.columns2', 3 => '.columns3', 4 => '.columns4') as $i => $class) {
	$css[] = sprintf('#menu %s { width: %dpx; }', $class, $i * intval($this['config']->get('menu_width')));
}

// load css
$this['asset']->addFile('css', 'css:base.css');
$this['asset']->addFile('css', 'css:layout.css');
$this['asset']->addFile('css', 'css:menus.css');
$this['asset']->addString('css', implode("\n", $css));
$this['asset']->addFile('css', 'css:modules.css');
$this['asset']->addFile('css', 'css:tools.css');
$this['asset']->addFile('css', 'css:system.css');
$this['asset']->addFile('css', 'css:extensions.css');
$this['asset']->addFile('css', 'css:custom.css');
if (($color = $this['config']->get('color1')) && $this['path']->path("css:/color1/$color.css")) { $this['asset']->addFile('css', "css:/color1/$color.css"); }
if (($color = $this['config']->get('color2')) && $this['path']->path("css:/color2/$color.css")) { $this['asset']->addFile('css', "css:/color2/$color.css"); }
if (($font = $this['config']->get('font1')) && $this['path']->path("css:/font1/$font.css")) { $this['asset']->addFile('css', "css:/font1/$font.css"); }
if (($font = $this['config']->get('font2')) && $this['path']->path("css:/font2/$font.css")) { $this['asset']->addFile('css', "css:/font2/$font.css"); }
if (($font = $this['config']->get('font3')) && $this['path']->path("css:/font3/$font.css")) { $this['asset']->addFile('css', "css:/font3/$font.css"); }
$this['asset']->addFile('css', 'css:style.css');
if ($this['config']->get('direction') == 'rtl') $this['asset']->addFile('css', 'css:rtl.css');
$this['asset']->addFile('css', 'css:responsive.css');
$this['asset']->addFile('css', 'css:print.css');
$this['asset']->addFile('css', 'template:fonts/8/8.css');
$this['asset']->addFile('css', 'template:fonts/11/11.css');
$this['asset']->addFile('css', 'template:fonts/12/12.css');
$this['asset']->addFile('css', 'template:fonts/13/13.css');
//include tamnd js scripts
$this['asset']->addFile('css', 'css:fancy/jquery.fancybox.css');
//$this['asset']->addFile('css', 'css:wowslider/style.css');
$this['asset']->addFile('css', 'css:tnd/style.css');

// load fonts
$http  = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$fonts = array(
	'droidsans' => 'template:fonts/droidsans.css',
	'opensans' => 'template:fonts/opensans.css',
	'yanonekaffeesatz' => 'template:fonts/yanonekaffeesatz.css',
	'mavenpro' => 'template:fonts/mavenpro.css',
	'myriad1' => 'template:fonts/1/1.css',
	'myriad2' => 'template:fonts/2/2.css',
	'myriad3' => 'template:fonts/3/3.css',
	'myriad4' => 'template:fonts/4/4.css',
	'myriad5' => 'template:fonts/5/5.css',
	'myriad6' => 'template:fonts/6/6.css',
	'myriad7' => 'template:fonts/7/7.css',
	'myriad8' => 'template:fonts/8/8.css',
	'myriad9' => 'template:fonts/9/9.css',
'myriad10' => 'template:fonts/10/10.css',
'myriad13' => 'template:fonts/13/13.css',

	'kreon' => 'template:fonts/kreon.css'
	);

foreach (array_unique(array($this['config']->get('font1'), $this['config']->get('font2'), $this['config']->get('font3'))) as $font) {
	if (isset($fonts[$font])) {
		$this['asset']->addFile('css', $fonts[$font]);
	}
}

// set body css classes
$body_classes  = $sidebar_classes.' ';
$body_classes .= $this['system']->isBlog() ? 'isblog ' : 'noblog ';
$body_classes .= $this['config']->get('page_class');

$this['config']->set('body_classes', $body_classes);

// add social buttons
$body_config['twitter'] = (int) $this['config']->get('twitter', 0);
$body_config['plusone'] = (int) $this['config']->get('plusone', 0);
$body_config['facebook'] = (int) $this['config']->get('facebook', 0);

$this['config']->set('body_config', json_encode($body_config));

// add javascripts
$this['asset']->addFile('js', 'js:warp.js');
$this['asset']->addFile('js', 'js:responsive.js');
$this['asset']->addFile('js', 'js:accordionmenu.js');
$this['asset']->addFile('js', 'js:dropdownmenu.js');
$this['asset']->addFile('js', 'js:template.js');
//include tamnd js scripts
$this['asset']->addFile('js', 'js:fancy/jquery.fancybox.pack.js');
//$this['asset']->addFile('js', 'js:wowslider/jquery.js');
//$this['asset']->addFile('js', 'js:wowslider/wowslider.js');
//$this['asset']->addFile('js', 'js:wowslider/script.js');
$this['asset']->addFile('js', 'js:tnd/scripts.js');
$this['asset']->addFile('js', 'js:tnd/scripts_vu.js');
$this['asset']->addFile('js', 'js:tnd/jquery.jcarousel.min.js');

// internet explorer
if ($this['useragent']->browser() == 'msie') {

	// add conditional comments
	$head[] = sprintf('<!--[if lte IE 8]><script src="%s"></script><![endif]-->', $this['path']->url('js:html5.js'));
	$head[] = sprintf('<!--[if IE 8]><link rel="stylesheet" href="%s" /><![endif]-->', $this['path']->url('css:ie8.css'));

}

// add $head
if (isset($head)) {
	$this['template']->set('head', implode("\n", $head));
}

function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}