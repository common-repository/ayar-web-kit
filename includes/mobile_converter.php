<?php
function zawgyifont(){ 
	global $wp_is_mobile;
	//var_dump($wp_is_mobile);
	if ( ! is_admin() ) {	
				if ($wp_is_mobile){
	?>
<!-- This is css font embedding for mobile browsers start-->
<style type="text/css">
@font-face {
font-family:'Zawgyi-One';
src: url('http://webfont.myanmapress.com/fonts/zawgyi-one.ttf') format('truetype');
}
*{font-family:zawgyi-one, Zawgyi-One !important};
</style>
<!-- This is css font embedding for mobile browsers ends-->
<?php
		}
	}
}
function mobile_converter(){
	global $written_font, $reader_font, $wp_is_mobile;
		//var_dump($wp_is_mobile);
	//$wp_is_mobile = wp_is_mobile();
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

add_action("wp_head","zawgyifont");
add_action("init", "mobile_converter");

