<?php
	/*
	 * Name				: 	Myanmar Traditional Date Converter
	 * Date				:	14.07.2009
	 * Original Author	: 	Ko Wanna Ko (C#)
	 * Ported Author	: 	Ei Maung (PHP)
	 *
	 * License			: 	Can use, modify or re-distribute in any conditions without any restriction
	 *          			(a.k.a) Open To Da-La-Haw Lycense... :P
	 *
	 * Usage :
	 *		$mydate = get_mmdate(14, 7, 2009);
	 *		echo $mydate['full_date'];
	 */

	function get_mmdate($day, $month, $year, $wa=0)
    {
        //Get full day before making any changes to params
        $mr['m_fullday'] = get_mmday($day, $month, $year);

		$smon = array('တန်ခူး', 'ကဆုန်', 'နယုန်', 'ဝါဆို', 'ဝါေခါင်', 'ေတာ်သလင်း', 'သီတင်းကွျတ်', 'တန်ေဆာင်မုန်း', 'နတ်ေတာ်', 'ြပာသို', 'တပို့တွဲ', 'တေပါင်း', 'တန်ခူး', 'ကဆုန်', 'နယုန်' );
        $dmon = array('တန်ခူး', 'ကဆုန်', 'နယုန်', 'ပ-ဝါဆို', 'ဒု-ဝါဆို', 'ဝါေခါင်', 'ေတာ်သလင်း', 'သီတင်းကွျတ်', 'တန်ေဆာင်မုန်း', 'နတ်ေတာ်', 'ြပာသို', 'တပို့တွဲ', 'တေပါင်း', 'တန်ခူး', 'ကဆုန်');
		//$smon = array('taku', 'kason', 'nayon', 'wazo', 'wagaung', 'tawthalin', 'thadingyut', 'tazaungmone', 'natdaw', 'pyatho', 'tapotwe', 'tabaung', 'takhu', 'kason', 'nayon' );
		//$dmon = array('taku', 'kason', 'nayon', 'f-wazo', 's-wazo', 'wagaung', 'tawthalin', 'thadingyut', 'tazaungmone', 'natdaw', 'pyatho', 'tapotwe', 'tabaung', 'takhu', 'kason');
		$cyear = array(0,30,61,91,122,153,183,214,244,275,306,334);
        $sm_year = array(-1,28,58,87,117,146,176,205,235,264,294,323,353,382,411,441);
        $dm_year = array(-1,28,58,87,117,147,176,206,235,265,294,324,354,383,412,442);
        $ddm_year = array(-1,28,58,88,118,148,177,207,236,266,295,325,355,384,413,443);
        $s = array(29,30,29,30,29,30,29,30,29,30,29,30);
        $d = array(29,30,29,30,30,29,30,29,30,29,30,29,30);
        $dd = array(29,30,30,30,30,29,30,29,30,29,30,29,30);

        $tot = total_days($day, $month, $year, 0, 0);

        $tyear = $year;
        if(($tyear % 4 == 0) && ($tyear % 100 != 0) || ($tyear % 400 == 0)) $cyear[11]=335;

        $month -= 4;
        if($month < 0) {
	        $month += 12;
	        $year <= 0 ? $year++ : $year--;
        }

        if($year == 0) $year =- 1;

        $tyear = $year;
        if($tyear <= -1) $year++;

        $my = $year + 3101;

        $atartday = floor(($my * 365.2587565));
        $odays = $my * 11.06483;

        $overdays = floor($odays % 30.0);
        $firstday = $atartday - $overdays;
        $marthday = floor(total_days(31, 3, $tyear, 0, 0));
        $zy = floor(($marthday - $firstday));

        $total = $zy + $cyear[$month] + $day;

        $mo = $month;

        $mmy = $wa;

        if($wa == 0){
	        $total -= $sm_year[$month];
	        if($total > $s[$month]) {
		        $total -= $s[$month];
		        $month++;
		        if($month > 12) $month -= 12;
		        $mo = $month;
	        }
            $mday = $s[$month] - 15;

        } else if($wa == 1) {
	        $total -= $dm_year[$month];
	        if($total > $d[$month]) {
		        $total -= $d[$month];
		        $month++;
		        if($month > 12)$month -= 12;
		        $mo = $month;
	        }
            $mday = $d[$month] - 15;
        } else {
	        $total -= $ddm_year[$month];
	        if($total > $dd[$month]) {
		        $total -= $dd[$month];
		        $month++;
		        if($month > 12) $month -= 12;
		        $mo = $month;
	        }
            $mday = $dd[$month] - 15;
        }
        $mmm = $mo;

        if(sun_transist($year, $tot) == 1)
	        $resy = $year - 638;
        else if(sun_transist($year, $tot) == 0)
	        $resy = $year - 639;

        $resd = $total;
        if($resd <= 0) {
	        $mo--;
	        if($mo < 0)$mo += 12;
	        if($wa == 0) $resd += $s[$mo];
	        else if($wa == 1) $resd += $d[$mo];
	        else $resd += $dd[$mo];
        }
	if($resd == 30) {
	        $resd = 15;
	        $namehm = 'ကွယ်';
        } else if($resd > 15) {
	        $resd -= 15;
	        $namehm = 'ြပည့်ေကျာ်';
        } else if($resd == 15) {
	        $resd = $resd;
	        $namehm = 'ြပည့်';
        } else {
	        $resd = $resd;
	        $namehm = 'ဆန်း';
        }
        if($resd > 15) {
	        $resd -= 15;
	        $nameclass = "oldmoon";
        } else if($resd == 15) {
	        $resd = $resd;
	        $nameclass = "fullmoon";
        } else {
	        $resd = $resd;
	        $nameclass = "newmoon";
        }


        $yres = $resy;

        if($wa == 0)
	        $namemo = $smon[$mo];
        else
	        $namemo = $dmon[$mo];


        if($yres < 639)
        $resy += 3739;

        $mr['m_mon'] = $mo;
        $mr['h_month'] = $namehm;
        $mr['m_day'] = convert_num($resd);
        $mr['m_month'] = $namemo;
        $mr['m_year'] = convert_num($resy);
        $mr['type_year'] = $mmy;
        $mr['atart_day'] = $atartday;
        $mr['first_day'] = $firstday;
        $mr['o_days'] = $odays;
		$mr['over_days'] = $overdays;
		$mr['marth_day'] = $marthday;
		$mr['ch_month'] = $nameclass;

		//Full Date String
		$mr['full_date'] = "ျမန္မာသကၠရာဇ္ "
						 . $mr['m_year'] . " ခုႏွစ္၊ "
						 . $mr['m_month'] . $mr['h_month'] . " "
						 . $mr['m_day'] . "ရက္ "
						 . "(" . $mr['m_fullday'] . "ေန႕)။";

        return  $mr;
    }

	function sun_transist($year, $total)
    {
        $tinkan = total_days(31, 12, ($year - 1), 0, 0);
        $kali = $year + 3101;
        $c = ($kali - ($tinkan / 365.2587565)) * 365.2587565;
        $c += $tinkan;
        if ($total < $c)
            $nyear = 0;
        else if ($total >= $c)
            $nyear = 1;

        return $nyear;
    }

	function jul_day($year, $month, $day, $hour, $greg_flag)
    {
        $u = $year;
        if ($month < 3) $u -= 1;

        $u0 = $u + 4712.0;
        $u1 = $month + 1.0;
        if ($u1 < 4) $u1 += 12.0;

        $jd = floor($u0 * 365.25) + floor(30.6 * $u1 + 0.000001) + $day + $hour / 24.0 - 63.5;

		if ($greg_flag == 1)
        {
            $u2 = floor(abs($u) / 100) - floor(abs($u) / 400);
            if ($u < 0.0) $u2 = -$u2;
            $jd = $jd - $u2 + 2;
            if (($u < 0.0) && ($u / 100 == floor($u / 100)) && ($u / 400 != floor($u / 400)))
                $jd -= 1;
        }

        return $jd;
    }

	function total_days($day, $month, $year, $hour=0, $min=0)
    {
        $h1 = $hour;
        $m1 = $min;

        $tim = ($h1 + ($m1 / 60));

        $dj = jul_day($year, $month, $day, $tim, 1);
        $dj -= 2415019.5;
        $tjd = $dj;
        $tot = $dj + 1826554;

        return $tot;
    }

    function total_jdays($day, $month, $year, $hour=0, $min=0)
	{
		$h1 = $hour;
		$m1 = $min;

		$tim = ($h1 + ($m1 / 60));

		$dj = jul_day($year, $month, $day, $tim, 1);
		$dj -= 2415019.5;
		$tjd = $dj;
		return $tjd;
	}

	function get_mmday($day, $month, $year)
	{
		$days = array("တနဂင်္ေနွ","တနလင်္ာ","အဂင်္ါ","ဗုဒ္ဓဟူး","ြကာသာပေတး","ေသာြကာ","စေန");
		$tjd1 = total_jdays($day, $month, $year);

		$jjd = ($tjd1 - 0.5) + 2415020;
		$b = floor((($jjd + 1.5) / 7)) * 7;

		$i = $jjd + 1.5 - $b;

		if ($i >= 7) $i -= 7;
		return $days[$i];
	}

    //Convert Numbers to Myanmar Numbers (added by Ei Maung)
    function convert_num($num) {
    	$mm_nums = array("၀", "၁", "၂", "၃", "၄", "၅", "၆", "၇", "၈", "၉");

    	$len = strlen($num);
    	for($i=0; $i<$len; $i++) {
    		$n = substr($num, $i, 1);
    		$result .= $mm_nums[$n];
    	}
    	return $result;
    }
function get_mm_calendar($initial = true, $echo = true) {
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$cache = array();
	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_mm_calendar', 'calendar' ) ) {
		if ( is_array($cache) && isset( $cache[ $key ] ) ) {
			if ( $echo ) {
				echo apply_filters( 'get_mm_calendar',  $cache[$key] );
				return;
			} else {
				return apply_filters( 'get_mm_calendar',  $cache[$key] );
			}
		}
	}

	if ( !is_array($cache) )
		$cache = array();

	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' LIMIT 1");
		if ( !$gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_mm_calendar', $cache, 'calendar' );
			return;
		}
	}

	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));

	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(substr($m, 0, 4));
		if ( strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}

	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);

	$last_day = date('t', $unixmonth);
	$burmese_date = get_mmdate(false , $thismonth, $thisyear);
	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type = 'post' AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf($calendar_caption, $burmese_date['m_month'], $burmese_date['m_year']) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}

	foreach ( $myweek as $wd ) {
		$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		$wd = esc_attr($wd);
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$burmese_pre = get_mmdate(false , $previous->month, $previous->year);
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $burmese_pre['m_month'], $burmese_pre['m_year'])) . '">&laquo; ' . $burmese_pre['m_month']. '</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next ) {
		$burmese_next = get_mmdate(false , $next->month, $next->year);
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s'), $burmese_next['m_month'], $burmese_next['m_year'])) . '">' . $burmese_next['m_month'] . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00'
		AND post_type = 'post' AND post_status = 'publish'
		AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59'", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	} else {
		$daywithpost = array();
	}

	if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';

	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "
		."WHERE post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' "
		."AND post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' "
		."AND post_type = 'post' AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

				$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );

				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}


	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';

	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;
	$mm_day = $day-1;
	$burmese_day = get_mmdate($mm_day , $thismonth, $thisyear);
	$mmday = $burmese_day['m_day'];
	if ($mmday == "၁၅"){
		$mmday = $burmese_day['h_month'];
		}
		if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';

		if ( in_array($day, $daywithpost) ) // any posts today?
				$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$mmday</a>";
		else
			$calendar_output .= $mmday;
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}

	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_mm_calendar', $cache, 'calendar' );

	if ( $echo )
		echo apply_filters( 'get_mm_calendar',  $calendar_output );
	else
		return apply_filters( 'get_mm_calendar',  $calendar_output );

}
function awk_calendar_widget_init() {

    // Check to see required Widget API functions are defined...
    if ( !function_exists('register_sidebar_widget') || !function_exists('register_widget_control') )
        return; // ...and if not, exit gracefully from the script.

    // This function prints the sidebar widget--the cool stuff!
    function awk_calendar_widget($args) {

        // $args is an array of strings which help your widget
        // conform to the active theme: before_widget, before_title,
        // after_widget, and after_title are the array keys.
        extract($args);

        // Collect our widget's options, or define their defaults.
        $options = get_option('awk_calendar_widget');
        $title = empty($options['title']) ? 'Burmese Calendar' : $options['title'];

         // It's important to use the $before_widget, $before_title,
         // $after_title and $after_widget variables in your output.
        echo $before_widget;
        echo $before_title . $title . $after_title;
        get_mm_calendar();
        echo $after_widget;
    }

    // This is the function that outputs the form to let users edit
    // the widget's title and so on. It's an optional feature, but
    // we'll use it because we can!
    function awk_calendar_widget_control() {

        // Collect our widget's options.
        $options = get_option('awk_calendar_widget');

        // This is for handing the control form submission.
        if ( $_POST['mywidget-submit'] ) {
            // Clean up control form submission options
            $newoptions['title'] = strip_tags(stripslashes($_POST['mywidget-title']));
        }

        // If original widget options do not match control form
        // submission options, update them.
        if ( $options != $newoptions ) {
            $options = $newoptions;
            update_option('awk_calendar_widget', $options);
        }

        // Format options as valid HTML. Hey, why not.
        $title = htmlspecialchars($options['title'], ENT_QUOTES);

// The HTML below is the control form for editing options.
?>
        <div>
        <label for="mywidget-title" style="line-height:35px;display:block;">Widget title: <input type="text" id="mywidget-title" name="mywidget-title" value="<?php echo $title; ?>" /></label>
        <input type="hidden" name="mywidget-submit" id="mywidget-submit" value="1" />
        </div>
    <?php
    // end of awk_calendar_widget_control()
    }

    // This registers the widget. About time.
    register_sidebar_widget('Burmese Calendar', 'awk_calendar_widget');

    // This registers the (optional!) widget control form.
    register_widget_control('Burmese Calendar', 'awk_calendar_widget_control');
}

// Delays plugin execution until Dynamic Sidebar has loaded first.
add_action('plugins_loaded', 'awk_calendar_widget_init');

