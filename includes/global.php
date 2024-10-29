<?php

$browser = new Browser();
$fonts_embed_settings = (awk_option('fonts_embeded') ? 'yes':'');
$ayar_toolbar = (awk_option('ayar_toolbar') ? 'yes':'');
$toolbar_position=awk_option('toolbar_pos');
$converter= (awk_option('converter') ? 'yes':'');
$rss = (awk_option('rss_enable') ? 'yes':'');
$mobile = (awk_option('mobile_enable') ? 'yes':'');
$fonts_server = awk_option('fonts_server_url');
$template_sect = (awk_option('template') ? 'yes':'');
$locale_sect = (awk_option('localization') ? 'yes':'');
$my_calendar = (awk_option('my_calendar') ? 'yes':'');
$my_calendar_head = (awk_option('my_calendar_head') ? 'yes':'');
$my_calendar_widget = (awk_option('my_calendar_widget') ? 'yes':'');
$written_font = awk_option('written_font');
$reader_font = awk_option('reader_font');
$detect_lang = (awk_option('detect_lang') ? 'yes':'');
$popup_script = awk_option('popup_script');
$fonts_buttons = awk_option('fonts_button');
$online_editor_button = awk_option('editor_button');
$online_conv_button = awk_option('conv_button');
$online_dict_button = awk_option('dict_button');
$ayar_home = awk_option('ayar_button');
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$wp_is_mobile = wp_is_mobile();
$font_encoding = get_font_encoding();
	//var_dump($font_encoding);
function get_font_encoding(){
	global $reader_font, $font_encoding;
if(isset($_GET['font'])){
	$font_encoding = $_GET['font'];
	//setcookie('font',$font_encoding, time() +300);	
	} elseif (isset($_COOKIE['font'])) {
	$font_encoding = $_COOKIE['font'];	
	}else {
	$font_encoding = $reader_font;		
	}
	return $font_encoding;
}
/*	if(isset($_COOKIE['font'])){
	$font_encoding = $_COOKIE['font'];
	//var_dump($font_encoding);
	} elseif(isset($_GET['font'])){
	$font_encoding = $_GET['font'];
	var_dump($font_encoding);
	//setcookie('font',$font_encoding);	
	}elseif ($reader_font != ''){
	$font_encoding = $reader_font;
	} else {
	$font_encoding = 'zawgyi';	
	}

*/
