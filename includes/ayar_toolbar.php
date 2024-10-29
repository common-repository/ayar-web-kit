<?php
function a2zt_head(){
	global $awk_options,$toolbar_position;
		//@credit : http://www.wizzud.com/jqDock/
	?>
<style type='text/css'>
<?php 

if ($toolbar_position == 'topright'){
?>
#pageshare {position:fixed; top:5%; right:10px; float:left; border: 1px solid black; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#eff3fa;padding:0 0 2px 0;z-index:999;}  
<?php 
}elseif ($toolbar_position == 'topleft'){
?>
#pageshare {position:fixed; top:5%; left:10px; float:left; border: 1px solid black; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#eff3fa;padding:0 0 2px 0;z-index:999;}  
<?php 
}elseif ($toolbar_position == 'bottomright'){
?>
#pageshare {position:fixed; bottom:5%; right:10px; float:left; border: 1px solid black; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#eff3fa;padding:0 0 2px 0;z-index:999;}  
<?php 
}elseif ($toolbar_position == 'bottomleft'){
?> 
#pageshare {position:fixed; bottom:5%; left:10px; float:left; border: 1px solid black; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#eff3fa;padding:0 0 2px 0;z-index:999;}  
<?php }else{ ?> 
#pageshare {position:fixed; bottom:5%; right:10px; float:left; border: 1px solid black; border-radius:5px;-moz-border-radius:5px;-webkit-border-radius:5px;background-color:#eff3fa;padding:0 0 2px 0;z-index:999;}  
<?php } ?>
#pageshare .sbutton {float:left;clear:both;margin:5px 5px 0 5px;}  
#fancybox-wrap{z-index:1000000;position:fixed;}
</style>

<?php
}
function font_cookies_js(){
	
if (! wp_is_mobile()){
	
wp_enqueue_script( 'webkitfooterscript', AWK_PLUGIN_URL . '/js/awk_footer_script.js', array('jquery'), '1.0', true );
	?>
	


<?php
		}
	}

add_action('wp_footer', 'font_cookies_js');	

add_action('wp_head', 'a2zt_head');
//add_action('admin_head', 'a2zt_head');
add_action('login_head', 'a2zt_head');
add_action('register_head', 'a2zt_head');

function a2zt_footer() {
	global $toolbar_position;
?>
<!-- /*a2zt footer*/ -->
<?php 	
	toolbar_html(); //print toolbarhtml
?>


<div id="popup" style="border:1px solid #999999;background:#cccccc;-moz-border-radius: 5px;-webkit-border-radius:5px;padding:10px;width:300px;height:auto;display:none;position:absolute;">
<div id="dic_content"></div>
</div>
<input type="hidden" id="x"><input type="hidden" id="y">
<?php
}

function add_toolbar(){
	global $detect_lang, $lang;
if (! wp_is_mobile()) {
	if ( $detect_lang == 'yes'){
		if (get_bloginfo('language') == 'my-MM' ){

			add_action('wp_footer', 'a2zt_footer');
			add_action('login_form', 'a2zt_footer');
			add_action('register_form', 'a2zt_footer');
			add_action('retrieve_password', 'a2zt_footer');
			add_action('password_reset', 'a2zt_footer');
			add_action('lostpassword_form', 'a2zt_footer');
			//add_action('admin_footer', 'a2zt_footer');
			//add_action('init', 'set_font_cookies');
		} elseif ( isset($_GET['lang']) ){
				$detected_lang = $_GET['lang'];
			//	var_dump($detected_lang);
				if ($detected_lang == 'my') {

					add_action('wp_footer', 'a2zt_footer');
					add_action('login_form', 'a2zt_footer');
					add_action('register_form', 'a2zt_footer');
					add_action('retrieve_password', 'a2zt_footer');
					add_action('password_reset', 'a2zt_footer');
					add_action('lostpassword_form', 'a2zt_footer');
					}		
		} else {
		
		}
	} else {

	add_action('wp_footer', 'a2zt_footer');
	add_action('login_form', 'a2zt_footer');
	add_action('register_form', 'a2zt_footer');
	add_action('retrieve_password', 'a2zt_footer');
	add_action('password_reset', 'a2zt_footer');
	add_action('lostpassword_form', 'a2zt_footer');
	//add_action('admin_footer', 'a2zt_footer');
	//add_action('init', 'set_font_cookies');

	}
}
}
add_action( 'init', 'add_toolbar');
add_action('init', 'get_font_cookies');
function set_font_cookies(){
	global $font_encoding;
	setcookie('font',$font_encoding, time() +300);	
	}

function get_font_cookies(){
	global $crawler, $written_font, $reader_font, $fonts_server, $fonts_server_url, $font_encoding;
	//var_dump($crawler);
//if ($crawler){
//	if ($written_font == 'ayar'){
	//	ayar_mm3();
//		}
//	if ($written_font == 'zawgyi'){
//		zawgyi_mm3();
//		}
	//if (($reader_font == $written_font ) && ($reader_font == 'mm3')){
		
	//	}
//	} else {
//	var_dump($font_encoding);
	if ( $written_font != '' ){		
		if ( $written_font != $font_encoding){
			$function = $written_font."_".$font_encoding;
			$function();
		} 
	}
	if ( $font_encoding == 'zawgyi') {
		if ($fonts_server == 'other'){	
			$fonts_server_url = awk_option('other_server_url');
		}elseif ($fonts_server == 'same_domain'){
			$fonts_server_url = AWK_PLUGIN_URL.'/includes/web-fonts.php';
		}elseif ($fonts_server == 'default'){
			$fonts_server_url = 'http://webfonts.ayar.co/base64css/';
			}
		$zawgyi_embed = 'zawgyi_embed';
		$zawgyi_src = $fonts_server_url.'?font=zawgyi-one';
		$deps = false;
		$ver = false;
		$media = 'All';
		wp_register_style( $zawgyi_embed, $zawgyi_src, $deps, $ver, $media );
		wp_enqueue_style( $zawgyi_embed );
		function zg_dequeue(){

		wp_dequeue_style('awk_fonts_family');
		
		}
		add_action('wp_print_styles','zg_dequeue',999);
		function zawgyi_font(){

			echo <<<ZWG
			<style type="text/css">
			*{font-family:zawgyi-one, Zawgyi-One !important};
			</style>

ZWG;
			}		
		add_action('wp_head','zawgyi_font');
		}
	if ( $font_encoding == 'mm3') {
		if ($fonts_server == 'other'){	
			$fonts_server_url = awk_option('other_server_url');
		}elseif ($fonts_server == 'same_domain'){
			$fonts_server_url = AWK_PLUGIN_URL.'/includes/web-fonts.php';
		}elseif ($fonts_server == 'default'){
			$fonts_server_url = 'http://webfonts.ayar.co/base64css/';
			}
		$mm3_embed = 'mm3_embed';
		$mm3_src = $fonts_server_url.'?font=padauk';
		$deps = false;
		$ver = false;
		$media = 'All';
		wp_register_style( $mm3_embed, $mm3_src, $deps, $ver, $media );
		wp_enqueue_style( $mm3_embed );
		function destyle_mm3(){
		wp_dequeue_style('awk_fonts_family');
		}
		if ($written_font != 'mm3') {
		add_action('wp_print_styles','destyle_mm3');
		}
		function mm3_font(){

			echo <<<MM3
			<style type="text/css">
			*{font-family:Tharlon, Myanmar3, Tharlon, Padauk !important};
			</style>

MM3;
			}		
		add_action('wp_head','mm3_font');
		}
	//function add_awk_rewrite_ep(){

		//}
	//}
}
?>
