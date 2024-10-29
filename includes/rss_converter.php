<?php

function rss_converter($content){
	global $post, $written_font, $reader_font, $is_feed, $converter, $zwsp;
	$is_feed = is_feed();
	if ( ! is_admin() ) {	
		if ($is_feed){
			if ($written_font == 'ayar'){

					$content = $converter->ayar_zg($content);

					$content = $zwsp->zwsp_zawgyi($content);

					return $content;
				}
			if ($written_font == 'mm3'){

					$content = $converter->uni_zg($content);

					$content = $zwsp->zwsp_zawgyi($content);

					return $content;
				}
				remove_action('init', 'awk_font_family');
		}
	}
}


add_filter("the_title_rss", "rss_converter");
add_filter("wp_title_rss", "rss_converter");
add_filter("bloginfo_rss", "rss_converter");
add_filter("the_excerpt_rss", "rss_converter");
add_filter("the_content_feed", "rss_converter");
add_filter("comment_text_rss", "rss_converter");
add_filter("comment_text", "rss_converter");
