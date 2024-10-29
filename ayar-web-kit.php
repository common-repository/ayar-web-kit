<?php
/**
 * @package Ayar Web Kit
 */
/*
Plugin Name: Ayar Web Kit
Plugin URI: http://webfont.myanmapress.com
Description: webfont embedding plugins for wordpress.
Version: 1.0
Author: Sithu Thwin
Author URI: http://www.thwin.net/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/
if(defined('AWK_VERSION')) return;
define('AWK_VERSION', '1.0');
define('AWK_PLUGIN_PATH', dirname(__FILE__));
define('AWK_PLUGIN_FOLDER', basename(AWK_PLUGIN_PATH));

if(defined('WP_ADMIN') && defined('FORCE_SSL_ADMIN') && FORCE_SSL_ADMIN){
    define('AWK_PLUGIN_URL', WP_CONTENT_URL . '/plugins/' . basename(dirname(__FILE__)) );
}else{
    define('AWK_PLUGIN_URL', WP_CONTENT_URL . '/plugins/' . basename(dirname(__FILE__)) );
}

/*Language loader*/
if (function_exists('load_plugin_textdomain')) {
        load_plugin_textdomain( 'AWK', false, AWK_PLUGIN_FOLDER . '/languages');
}

//include plugin options class
include (AWK_PLUGIN_PATH.'/includes/class-awk-options.php');

//include browser detect class
include (AWK_PLUGIN_PATH.'/includes/Browser.php');

//include global variable
include (AWK_PLUGIN_PATH.'/includes/global.php');

//include converter global script
require_once(AWK_PLUGIN_PATH.'/includes/global_converter.php');

//include crawler detect class
include (AWK_PLUGIN_PATH.'/includes/crawler-class.php');


//include converter section
if ($converter == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/converter_class.php');
include (AWK_PLUGIN_PATH.'/includes/crawler.php');
include (AWK_PLUGIN_PATH.'/includes/zwsp-class.php');
include (AWK_PLUGIN_PATH.'/includes/zwsp_by_default.php');
		if ($rss == 'yes'){
		include (AWK_PLUGIN_PATH.'/includes/rss_converter.php');
		}

		if ($mobile == 'yes'){
		include (AWK_PLUGIN_PATH.'/includes/mobile_converter.php');
		}
}

//include font embedding section
if ($fonts_embed_settings == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/fonts-embed.php');
}

//include toolbar section
if ($ayar_toolbar == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/ayar_toolbar.php');
include (AWK_PLUGIN_PATH.'/includes/popup-scripts.php');
}

//include template section cleander options
if ($template_sect == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/font_family.php');
	if ($my_calendar_head == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/calendar_head.php');
	}
	if ($my_calendar_widget == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/calendar_widget.php');
	}
}

//include burmese locale section
if ($locale_sect == 'yes'){
	if ($my_calendar == 'yes'){
include (AWK_PLUGIN_PATH.'/includes/my_calendar.php');
	}
}
function makeplugins_add_json_endpoint() {
    add_rewrite_endpoint( 'json', EP_PERMALINK | EP_PAGES );
}
add_action( 'init', 'makeplugins_add_json_endpoint' );
if (function_exists('jetpack_og_tags')) {
   include (AWK_PLUGIN_PATH.'/includes/awk_jetpack.php');
  }
