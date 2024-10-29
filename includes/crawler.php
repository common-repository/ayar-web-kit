<?php

function crawler_converter(){
	global $crawler, $written_font, $reader_font;
	if ($crawler){	
		if ($crawler == "facebookexternalhit" ) {
		  //it's probably Facebook's bot
			if ($written_font == 'ayar'){
				ayar_zawgyi();
				}
			if ($written_font == 'mm3'){
				mm3_zawgyi();
				}
				remove_action('init', 'awk_font_family');
			
			} else {
				
			if ($written_font == 'ayar'){
				ayar_mm3();
				}
			if ($written_font == 'zawgyi'){
				zawgyi_mm3();
				}
				remove_action('init', 'awk_font_family');
			}
	}

}

if ( ! is_admin() ) {

	add_action('init', 'crawler_converter');

}
