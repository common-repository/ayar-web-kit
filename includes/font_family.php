<?php
function awk_head_meta(){
	global $awk_options;
	$meta_tag = ($awk_options['meta_tag'] ? 'yes':'');
	if ($meta_tag == 'yes') {
	/*This meta tag header is a must use to avoid unexpected output with utf8_encode and htmlentities in browser*/
	?>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<?php
		}
	}
add_action('wp_head','awk_head_meta');
if (!$wp_is_mobile){
	//var_dump($wp_is_mobile); false
	//echo "this is not mobile";
function awk_font_family($html){
	global $browser, $post, $aff_handle;

	$important = (awk_option('add_important') ? '!important':'');

//	require_once AWK_PLUGIN_PATH.'/styles/css_to_inline_styles.php';
	$css = "";
	$filename = "";

		$css_selectors = awk_option('css_selectors');
		$selectors_array = explode('|',$css_selectors);
		foreach ($selectors_array as $selector){
		$selector_font = awk_option($selector);
		if ($selector_font != 'none'){
		$css .= $selector."{font-family:'".$selector_font."' ".$important.";}";	
		$filename .= $selector.$selector_font.$important;		
		}	
			}
		//echo $filename;
		$uploads = wp_upload_dir(); // Array of key => value pairs
		$uploads_dir = $uploads['basedir'];
		//echo "upload dir =".$uploads_dir;
		$uploads_url = $uploads['baseurl'];
		//$upload_dir = wp_mkdir_p('awk_css');
		$md5_filename = md5($filename.$important);
		$css_file = $uploads_dir."/".$md5_filename."-awk.css";
		
		$aff_handle = 'awk_fonts_family';
		$src = $uploads_url."/".$md5_filename."-awk.css";
		$deps = false;
		$ver = false;
		$media = false;
		wp_register_style( $aff_handle, $src, $deps, $ver, $media );
		if (file_exists($css_file)) { 
		wp_enqueue_style( $aff_handle ); 
		} else {
		$fh = fopen($css_file, 'w') or die("can't open file ".$css_file);
		fwrite($fh, $css);
		fclose($fh);
		wp_enqueue_style( $aff_handle ); 
		}
		//$cssToInlineStyles = new CSSToInlineStyles();

		//$html = $cssToInlineStyles->setHTML($html);
		
		// grab the processed HTML
		//$css = $cssToInlineStyles->setCSS($css);
		//
		
		//$html = $cssToInlineStyles->convert();
		//$html = trim($html);
		//$html =	htmlspecialchars_decode($html);
		//$html =	html_entity_decode($html, ENT_QUOTES, "UTF-8");
		//$html = utf8_decode($html);
			
		//$info = sprintf(
		//		"<!-- \nPage : %s\nHTML size : %d KB\n Generated by AyarWebKit Plugin-->",
		//		$_SERVER['REQUEST_URI'],
		//		strlen($html)/1024
		//	);

		//return $html.$info;
}


//function font_family_buffer(){
//	global $post;
	//@credits http://w-shadow.com/blog/2010/05/20/how-to-filter-the-whole-page-in-wordpress/
    //Don't filter Dashboard pages
//    if ( is_admin() || is_feed() ){
//        return;
//    }
//    //Start buffering. Note that we don't need to
    //explicitly close the buffer - WP will do that
    //for use in the "shutdown" hook.
//    ob_start('awk_font_family');
//}

//add_action('wp', 'font_family_buffer', 10, 0);
if (!is_admin()){
add_action( 'init', 'awk_font_family');
}
}