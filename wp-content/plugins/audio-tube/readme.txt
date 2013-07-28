=== Audio Tube ===
Contributors: brasofilo
Donate link: http://brasofilo.com/mtt
Tags: audio player, youtube, audio, flash, mp3, music, minimalist
Requires at least: 3.0
Tested up to: 3.6-beta1
Stable tag: 1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

YouTube audio player with a shortcode.

== Description ==

Hides the video area and show only the controls. 
Easy setup page with examples of the shortcode usage.

Check the [screenshots](http://wordpress.org/extend/plugins/audio-tube/screenshots/).

= Shortcode options =

* **id**   -> Required! YouTube video ID
* **bar**  -> Progress bar (yes or no, default = yes)
* **time** -> Timer (yes or no, default = yes)
* **tiny** -> Minimal player, not compatible with Progress Bar (yes or no, default = no)
* **size** -> Extended sizes (small, medium or large, default = small)
* **invisible** -> Hidden player (yes or no, default = no)
* **auto** -> Autoplay (yes or no, default = no)
* **loop** -> Loop (yes or no, default = no)
* **theme** -> Player color, will override plugin options (dark or light, default = dark)
* **start** -> Start time in seconds


= Acknowledgments = 

Based on Navarr Barnier's PHP script [YouTube Audio Player](http://tech.navarr.me/code/youtube-audio-player).

== Installation ==

Extract the zip file and upload the contents to the wp-content/plugins/ directory of your WordPress installation, and then activate the plugin from plugins page. 

= Uninstall =
If you delete the plugin, the entry will be deleted automatically via `unsinstall.php`.

== Frequently Asked Questions ==

= Configuration =
Go to `Tools -> AudioTube` to adjust the plugin options

= Usage =
Use the shortcode `[audiotube id="PWJmwi1qJdQ"]` to play a video as an audio file. Use only the video id grabbed from the URL, i.e., "http://www.youtube.com/watch?v=**PWJmwi1qJdQ**?hl=en". Start after "?v=" and ends before "?hl=en".

= Do I need this plugin? =
No. You can just copy/paste the inc/shortcode.php into your functions.php, following the instructions in this file.


== Screenshots ==

1. Settings page.

== Other Notes ==

Released under GPL, you can use it free of charge on your personal or commercial blog.

Plugin waveform image by [freeimages.co.uk](http://www.freeimages.co.uk/galleries/sports/music/slides/audio_waveform.htm)

== Changelog ==

= 1.2 =

* New feature: start time. Props to [edsilva7](http://wordpress.org/support/topic/specific-starting-time) 

= 1.1 =

* Fixed embed code not displaying in some sites. 

= 1.0 =

* Removed support for YouTube with privacy enabled. The domain www.youtube-nocookie.com used for that disappeared since some days and seems that it's not coming back :( 

= 0.7 =

* Previous update was missing the bug correction ( sorry:( )

= 0.6 =

* Bug correction: (again) works with the new YouTube embed code

= 0.5 =

* Bug correction: works with the new YouTube embed code

= 0.4 =

* checked against WordPress 3.4-beta3

* portuguese and spanish localization

= 0.3 =

* looks that SVN and plugin are now friends

= 0.2 =

* First public version

