<?php
function awk_fonts_embed(){
	//global $awk_options, $embeded_fonts;
	$option_fonts=array('ayar','ayar_takhu','ayar_kasone','ayar_nayon','ayar_wazo','ayar_wagaung','ayar_tawthalin','ayar_thadingyut','ayar_tazaungmone','ayar_natdaw','ayar_pyatho','ayar_tapotwe','ayar_tabaung','ayar_typewriter','ayar_juno','ayar_thawka','myanmar3','zawgyi','padauk','parabaik','masterpiece','yunghkio','mymyanmar');
	$embeded_fonts = '';
	foreach ($option_fonts as $option_font){
	$embeded_font = (awk_option($option_font) ? $option_font:'');
	if ($embeded_font != '') {
		$embeded_fonts .= $embeded_font.',';
		}
	}

	$embeded_fonts .= 'zawgyi';


		//$awk_options = get_option( 'awk_options' );
		$fonts_server = awk_option('fonts_server_url');
		if ($fonts_server == 'other'){	
			$fonts_server_url = awk_option('other_server_url');
		}elseif ($fonts_server == 'same_domain'){
			$fonts_server_url = AWK_PLUGIN_URL.'/includes/web-fonts.php';
		}elseif ($fonts_server == 'default'){
			$fonts_server_url = 'http://webfonts.ayar.co/base64css/';
		} else {
			$fonts_server_url = 'http://webfonts.ayar.co/base64css/';
		}

		$handle = 'awk_fonts_embed';
		$src = $fonts_server_url.'?font='.$embeded_fonts;
		$deps = false;
		$ver = false;
		$media = false;
		wp_register_style( $handle, $src, $deps, $ver, $media );
		$mobile = (awk_option('mobile_enable') ? 'yes':'');
if ($mobile != 'yes'){
 wp_enqueue_style( $handle );  }
 elseif (! wp_is_mobile() && $mobile == 'yes'){  
	 wp_enqueue_style( $handle );  
 }
 else { 
	 return; }

}
function add_fontembed(){
	global $detect_lang, $lang;
if (! wp_is_mobile()) {
	if ( $detect_lang == 'yes'){
		if (get_bloginfo('language') == 'my-MM' ){

			add_action('wp_head','awk_fonts_embed');
			//add_action('admin_footer', 'a2zt_footer');
			//add_action('init', 'set_font_cookies');
		} elseif ( isset($_GET['lang']) ){
				$detected_lang = $_GET['lang'];
			//	var_dump($detected_lang);
				if ($detected_lang == 'my') {

					add_action('wp_head','awk_fonts_embed');
					}		
		} else {
			return;
		}
	} else {

	add_action('wp_head','awk_fonts_embed');
	}
}
}
add_action( 'init', 'add_fontembed');

?>
