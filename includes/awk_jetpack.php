<?php
function awk_jetpack(){
	global $written_font, $reader_font, $wp_is_mobile;
	if ( ! is_admin() ) {	
		if ($wp_is_mobile){
			if ($written_font == 'ayar'){
				ayar_zawgyi();
				}
			if ($written_font == 'mm3'){
				mm3_zawgyi();
				}
		}
	}
}
add_filter('jetpack_open_graph_output','awk_jetpack');
?>
