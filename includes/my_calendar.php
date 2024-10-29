<?php
function my_calendar_match($matches){
	$match = '<caption id="my_cal">'.$matches[1].'</caption>';
	$latin = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
	$burmese = array('​၀', '​၁', '​၂', '​၃', '​၄', '​၅', '​၆', '​၇', '​၈', '​၉');
	$calendar_caption = str_replace($latin, $burmese, $match);
	return $calendar_caption;
	}
//regular expression replacement function for calendar table header
function my_calendar_cap($calendar_caption){
	
	$calendar_caption = preg_replace_callback("/<caption>(.*)<\/caption>/U", 'my_calendar_match', $calendar_caption);
	return $calendar_caption;
}

function my_calendar_match_day($matches){
	$match2= $matches[2];
	$latin = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
	$burmese = array('​၀', '​၁', '​၂', '​၃', '​၄', '​၅', '​၆', '​၇', '​၈', '​၉');
	$days = str_replace($latin, $burmese, $match2);

	$match = '<td '.$matches[1].'>'.$days.'</'.$matches[3].'td>';
	return $match;
	}
//regular expression replacement function for calendar table header
function my_calendar_day($day){
	$day = preg_replace_callback("/<td(.*)>([0-9]*)<\/(.*)td>/U", 'my_calendar_match_day', $day);
	return $day;
}
function my_match_num($matches){
	$match2= $matches[2];
	$latin = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
	$burmese = array('​၀', '​၁', '​၂', '​၃', '​၄', '​၅', '​၆', '​၇', '​၈', '​၉');
	$numbers = str_replace($latin, $burmese, $match2);

	$match = '<'.$matches[1].'>'.$numbers.'</'.$matches[3].'>';
	return $match;
	}
//regular expression replacement function for calendar table header
function my_num($number){
	$number = preg_replace_callback("/<(.*)>([0-9]*)<\/(.*)>/U", 'my_match_num', $number);
	return $number;
}
//regular expression replacement function for calendar number localize to Burmese
function my_calendar($day){
$t=0;
$pattern[$t] = '/[<td(.*)>]0[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၀<';
$t++;
$pattern[$t] = '/[<td(.*)>]1[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁<';
$t++;
$pattern[$t] = '/[<td(.*)>]2[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂<';
$t++;
$pattern[$t] = '/[<td(.*)>]3[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၃<';
$t++;
$pattern[$t] = '/[<td(.*)>]4[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၄<';
$t++;
$pattern[$t] = '/[<td(.*)>]5[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၅<';
$t++;
$pattern[$t] = '/[<td(.*)>]6[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၆<';
$t++;
$pattern[$t] = '/[<td(.*)>]7[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၇<';
$t++;
$pattern[$t] = '/[<td(.*)>]8[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၈<';
$t++;
$pattern[$t] = '/[<td(.*)>]9[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၉<';
$t++;
$pattern[$t] = '/[<td(.*)>]10[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၀<';
$t++;
$pattern[$t] = '/[<td(.*)>]11[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၁<';
$t++;
$pattern[$t] = '/[<td(.*)>]12[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၂<';
$t++;
$pattern[$t] = '/[<td(.*)>]13[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၃<';
$t++;
$pattern[$t] = '/[<td(.*)>]14[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၄<';
$t++;
$pattern[$t] = '/[<td(.*)>]15[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၅<';
$t++;
$pattern[$t] = '/[<td(.*)>]16[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၆<';
$t++;
$pattern[$t] = '/[<td(.*)>]17[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၇<';
$t++;
$pattern[$t] = '/[<td(.*)>]18[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၈<';
$t++;
$pattern[$t] = '/[<td(.*)>]19[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၁၉<';
$t++;
$pattern[$t] = '/[<td(.*)>]20[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၀<';
$t++;
$pattern[$t] = '/[<td(.*)>]21[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၁<';
$t++;
$pattern[$t] = '/[<td(.*)>]22[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၂<';
$t++;
$pattern[$t] = '/[<td(.*)>]23[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၃<';
$t++;
$pattern[$t] = '/[<td(.*)>]24[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၄<';
$t++;
$pattern[$t] = '/[<td(.*)>]25[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၅<';
$t++;
$pattern[$t] = '/[<td(.*)>]26[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၆<';
$t++;
$pattern[$t] = '/[<td(.*)>]27[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၇<';
$t++;
$pattern[$t] = '/[<td(.*)>]28[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၈<';
$t++;
$pattern[$t] = '/[<td(.*)>]29[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၂၉<';
$t++;
$pattern[$t] = '/[<td(.*)>]30[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၃၀<';
$t++;
$pattern[$t] = '/[<td(.*)>]31[<\/(.*)td>]/U';
$replace[$t] = '<td$1>၃၁<';
$t++;

return preg_filter($pattern, $replace, $day);

}
if(!function_exists('latin_2_burmese')){
function latin_2_burmese($number) {
  $latin = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9'); 
  $burmese = array('​၀', '​၁', '​၂', '​၃', '​၄', '​၅', '​၆', '​၇', '​၈', '​၉');
  return str_replace($latin, $burmese, $number);
}
}
if (get_bloginfo('language') == 'my-MM' ){
foreach ( array('pre_date_i18n','number_format_i18n','date_i18n','mysql2date','date_format','the_date','the_date_xml','current_time','get_date_from_gmt','get_the_time','iso8601_to_datetime','forum_date_format','comments_number','date', 'wp_list_categories') as $filters ) {
	add_filter( $filters, 'latin_2_burmese',$number );
}

add_filter('get_calendar','my_calendar_cap');
add_filter('get_calendar','my_calendar_day');
//add_filter('get_calendar','my_calendar');
//add_filter('wp_archives','my_num');
}
