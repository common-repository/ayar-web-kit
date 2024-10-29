<?php
//var_dump($popup_script);
//http://manchumahara.com/2010/03/22/using-wordpress-native-thickbox/
if ($popup_script == 'fancybox'){
//add fancybox
	function add_fancybox(){
		if(!is_admin()){
		$fbsrc = AWK_PLUGIN_URL.'/fancybox/jquery.fancybox-1.3.4.pack.js';
		$fbloadsrc = AWK_PLUGIN_URL.'/js/load_fancybox.js';
		$deps = array('jquery');
		wp_register_script('fancybox' ,$fbsrc,$deps,false,false);
		
		wp_register_script('load_fancybox' ,$fbloadsrc,$deps,false,false);
		wp_enqueue_script('fancybox');
		wp_enqueue_script('load_fancybox');
		$fbstyle = AWK_PLUGIN_URL.'/fancybox/jquery.fancybox-1.3.4.css';
		wp_register_style('fancybox', $fbstyle, false, false, false );
		wp_enqueue_style('fancybox');
		//wp_enqueue_script('jquery');
		//wp_enqueue_script('thickbox',null,array('jquery'));
		//wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
		}

	}
	add_action('wp_head','add_fancybox');	
}else if ($popup_script == 'colorbox'){
//add fancybox
	function add_colorbox(){
		if(!is_admin()){
		$cbsrc = AWK_PLUGIN_URL.'/js/jquery.colorbox-min.js';
		$loadcbsrc = AWK_PLUGIN_URL.'/js/load_colorbox.js';
		$deps = array('jquery');
		wp_register_script('colorbox' ,$cbsrc,$deps,false,false);
		wp_register_script('load_colorbox' ,$loadcbsrc,$deps,false,false);
		wp_enqueue_script('colorbox');
		wp_enqueue_script('load_colorbox');
		$cbstyle = AWK_PLUGIN_URL.'/styles/colorbox.css';
		wp_register_style( 'colorbox', $cbstyle, false, false, false );
		wp_enqueue_style( 'colorbox' );
		//wp_enqueue_script('jquery');
		//wp_enqueue_script('thickbox',null,array('jquery'));
		//wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
		}

	}
	add_action('wp_head','add_colorbox');
}else

{
	function add_tbscript(){
		if(!is_admin()){
		wp_enqueue_script('jquery',null,false,false,true);
		wp_enqueue_script('thickbox',null,array('jquery'),false,true);
		wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
		}
		
	}
	add_action('wp_head','add_tbscript');


}


function toolbar_html(){
	global $popup_script, $fonts_buttons, $online_editor_button, $online_conv_button, $online_dict_button, $ayar_home;
	if ( $popup_script == 'fancybox' ){ 
		//fancybox html
		?>
<div id='pageshare' title="Ayar-Plugin-ToolBar">
	<?php if ($fonts_buttons){ ?>
<div class='sbutton'><a id="A" class="selected" href="/?font=ayar" onclick="ay_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayy.png" border="0" alt="Ayar Myanmar Unicode Font" /></a></div>
<div class='sbutton'><a id="Z" href="/?font=zawgyi" onclick="zg_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/za.png" border="0" alt="Zawgyi Font" /></a></div>
<div class='sbutton'><a id="M" href="/?font=mm3" onclick="mm3_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/mm3n.png" border="0" alt="MM3 Font" /></a></div>
	<?php } if ($online_editor_button){ ?>
<div class='sbutton'><a class="fancybox" href="http://editor.ayar.co/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ke.png" border="0" alt="Ayar Online Editor" /></a></div>
	<?php } if ($online_conv_button){ ?>
<div class='sbutton'><a class="fancybox" href="http://mmblogpress.org/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/co.png" border="0" alt="Ayar Online Converter" /></a></div>
	<?php } if ($online_dict_button){ ?>
<div class='sbutton'><a class="fancybox" href="http://ayar.co/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/dc.png" border="0" alt="Ayar Online Dictionary" /></a></div>
	<?php } if ($ayar_home){ ?>
<div class='sbutton'><a href="http://www.ayarunicodegroup.org/" target="_blank"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayl.jpg" border="0" alt="Ayar Myanmar Unicode Group" /></a></div>
	<?php } ?></div> 

	<?php	}else if ( $popup_script == 'colorbox' ){ 
		//fancybox html
		?>
<div id='pageshare' title="Ayar-Plugin-ToolBar">
	<?php if ($fonts_buttons){ ?>
<div class='sbutton'><a id="A" class="selected" href="/?font=ayar" onclick="ay_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayy.png" border="0" alt="Ayar Myanmar Unicode Font" /></a></div>
<div class='sbutton'><a id="Z" href="/?font=zawgyi" onclick="zg_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/za.png" border="0" alt="Zawgyi Font" /></a></div>
<div class='sbutton'><a id="M" href="/?font=mm3" onclick="mm3_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/mm3n.png" border="0" alt="MM3 Font" /></a></div>
	<?php } if ($online_editor_button){ ?>
<div class='sbutton'><a class="colorbox" href="http://editor.ayar.co/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ke.png" border="0" alt="Ayar Online Editor" /></a></div>
	<?php } if ($online_conv_button){ ?>
<div class='sbutton'><a class="colorbox" href="http://mmblogpress.org/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/co.png" border="0" alt="Ayar Online Converter" /></a></div>
	<?php } if ($online_dict_button){ ?>
<div class='sbutton'><a class="colorbox" href="http://ayar.co/"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/dc.png" border="0" alt="Ayar Online Dictionary" /></a></div>
	<?php } if ($ayar_home){ ?>
<div class='sbutton'><a href="http://www.ayarunicodegroup.org/" target="_blank"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayl.jpg" border="0" alt="Ayar Myanmar Unicode Group" /></a></div>
	<?php } ?>
</div> 

	<?php	}else
	
	{ 
		//thickbox html
		?>
<div id='toolbar'>
<div id='pageshare' title="Ayar-Plugin-ToolBar">
	<?php if ($fonts_buttons){ ?>
<div class='sbutton'><a id="A" class="selected" href="?font=ayar" onclick="ay_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayy.png" border="0" alt="Ayar Myanmar Unicode Font" /></a></div>
<div class='sbutton'><a id="Z" href="?font=zawgyi" onclick="zg_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/za.png" border="0" alt="Zawgyi Font" /></a></div>
<div class='sbutton'><a id="M" href="?font=mm3" onclick="mm3_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/mm3n.png" border="0" alt="MM3 Font" /></a></div>
	<?php } if ($online_editor_button){ ?>
<div class='sbutton'><a href="http://editor.ayar.co/?KeepThis=true&width=700&height=500&TB_iframe=true" class="thickbox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ke.png" border="0" alt="Ayar Online Editor" /></a></div>
	<?php } if ($online_conv_button){ ?>
<div class='sbutton'><a href="http://mmblogpress.org/?KeepThis=true&width=700&height=500&TB_iframe=true" class="thickbox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/co.png" border="0" alt="Ayar Online Converter" /></a></div>
	<?php } if ($online_dict_button){ ?>
<div class='sbutton'><a href="http://ayar.co/?KeepThis=true&width=700&height=500&TB_iframe=true" class="thickbox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/dc.png" border="0" alt="Ayar Online Dictionary" /></a></div>
	<?php } if ($ayar_home){ ?>
<div class='sbutton'><a href="http://www.ayarunicodegroup.org/" target="_blank"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayl.jpg" border="0" alt="Ayar Myanmar Unicode Group" /></a></div>
	<?php } ?>
</div> 		
</div>		
	<?php	} 
	
	
 } ?>
