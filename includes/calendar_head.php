<?php
//custom function for weekday names
//use lowercase for css ID
function my_weekday($wdn){
		$my_weekday= array();
		$my_weekday[0] = 'sunday';
		$my_weekday[1] = 'monday';
		$my_weekday[2] = 'tuesday';
		$my_weekday[3] = 'wednesday';
		$my_weekday[4] = 'thursday';
		$my_weekday[5] = 'friday';
		$my_weekday[6] = 'saturday';
	return $my_weekday[$wdn];
	}
//regular expression replacement function for calendar table header
function my_calendar_head($day){
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts, $awk_options;
	
	$img_width = $awk_options['my_cal_img_width'];

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));
	// original $myweek from general-template.php get_calendar function
	// This output original weekday name string with locailzation
	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}
	// custom function for $myweek
	// This output weekday number instead of localized weekday name
	$mmweek = array();

	for ( $wkcount=0; $wkcount<=6; $wkcount++ ) {
		$mmweek[] = (($wkcount+$week_begins)%7);
	}
	$k=0;
	
	// first foreach for regular expression pattern to get original weekname
	foreach ( $myweek as $wd ) {
		$wd = esc_attr($wd);
		$patternkey[$k] = '/<th(.*)title="'.$wd.'">(.*)<\/th>/U';
		
		//second foreach for regular expression replacement with weekday number instead of localized weekday name
	foreach ( $mmweek as $wdn ) {
		//weekday number's name for use as css ID
		$wdn = my_weekday($wdn);
		//Capatilize weekday number's name for use in default localization gettext
		$cwdn = ucfirst($wdn);
		$replacement[$k] = '<th$1title="'.__($cwdn).'" id="'.$wdn.'"><img src="'.AWK_PLUGIN_URL.'/icons/'.$wdn.'.png" width="'.$img_width.'" height="auto" id="calendar_img" /></th>';
		$k++;
	}
	
}	
return preg_replace($patternkey, $replacement, $day);
}
function calendar_head(){
	?>
	<style type="text/css">
	#monday{}
	#tuesday{}
	#wednesday{}
	#thursday{}
	#friday{}
	#saturday{}
	#sunday{}
	#calendar_img{padding:0 !important;margin:0 !important;}
	</style>
	<?php
	}
add_action('wp_head','calendar_head');
add_filter('get_calendar','my_calendar_head');
add_filter('get_mm_calendar','my_calendar_head');
