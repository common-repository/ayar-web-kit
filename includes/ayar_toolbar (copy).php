<?php
function a2zt_head(){
	global $awk_options;
		//@credit : http://www.wizzud.com/jqDock/
	?>
<style type='text/css'>
<?php 
$toolbar_position=$awk_options['toolbar_pos'];
if ($toolbar_position == 'middledock'){
?>
#description {border-top:10px solid #333333; padding:0;}
#descScroll {max-height:250px; overflow-x:hidden; overflow-y:auto;}
#descInner {padding:5px 0;}
/*position and hide the menu initially...*/
#page {position:relative; overflow:hidden;}
#menu {position:fixed; margin:0 38%;bottom:0; left:0; display:none;}
/*dock styling...*/
/*...centre the dock...*/
#menu div.jqDockWrap {margin:0 auto;}
/*...set the cursor...*/
#menu div.jqDock {cursor:pointer;}
/*label styling...*/
div.jqDockLabel {font-weight:bold; font-style:italic; white-space:nowrap; color:#ffffff; cursor:pointer;}
<?php 
}elseif ($toolbar_position == 'topright'){
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
</style>
<script language="javascript">
var ajaxObj="";
jQuery(document).ready(function(){
  $(document).mousemove(function(e){
 $('#x').val(e.pageX);
 $('#y').val(e.pageY);
  });
})
function getSelText()
{
	var txt = "";
    if (window.getSelection){  txt = window.getSelection();   }
   else if (document.getSelection){ txt = document.getSelection();  }
   else if (document.selection){ txt = document.selection.createRange().text; }
   else return;
if(txt==""){return;}
jQuery('#popup').css("top",(jQuery("#y").val()) + "px");
jQuery('#popup').css("left",(jQuery("#x").val()) + "px");

jQuery('#popup').fadeIn(300);
jQuery('#dic_content').html("loading....");

if(ajaxObj!=""){ajaxObj.abort(); }

ajaxObj=jQuery.ajax({
 type: "GET",
 url: "http://ayar.co/remote_search.php?word=" +txt,
 success: function(content){
jQuery('#dic_content').html(content);
}
});

}
</script>
<script type="text/javascript">
document.ondblclick = function(){
getSelText();
};
</script>
<script type="text/javascript">
function zg_setcookies(){
	document.cookie = 'font=zawgyi';  
	window.location.reload()
	}
function ay_setcookies(){
	document.cookie = 'font=ayar';  
	window.location.reload()
	}
</script>
<?php
}
add_action('wp_head', 'a2zt_head');
//add_action('admin_head', 'a2zt_head');
add_action('login_head', 'a2zt_head');
add_action('register_head', 'a2zt_head');

function a2zt_footer() {
		$awk_options = get_option( 'awk_options' );
?>
<!-- /*a2zt footer*/ -->
<?php 
$toolbar_position=$awk_options['toolbar_pos'];
if ($toolbar_position == 'middledock'){
?>
<div id='page'>
  <div id='menu'>
<a id="A" class="selected" href="javascript:" onclick="ay_setcookies();">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/1ayar.png" border="0" title="Ayar Font" alt="Ayar Myanmar Unicode Font" />
</a>
<a id="Z" href="javascript:" onclick="zg_setcookies();">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/1Zaw.png" border="0" title="Zawgyi Font" alt="Zawgyi Font" />
</a>
<a href="http://ayaronlineeditor.co.cc/" class="awk_fancybox" onclick="return false;">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/key.png" border="0" title="Online Editor" alt="Ayar Online Editor" />
</a>
<a href="http://ayaronline.co.cc/" class="awk_fancybox" onclick="return false;">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/conv.png" border="0" title="Online Converter" alt="Ayar Online Converter" />
</a>
<a href="http://ayar.co/" class="awk_fancybox" onclick="return false;">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/dic.png" border="0" title="Online Dictionary" alt="Ayar Online Dictionary" />
</a>
<a href="http://www.ayarunicodegroup.org/" target="_blank">
	<img src="<?php echo AWK_PLUGIN_URL;?>/icons/2ayar.png" border="0" title="Ayar Home" alt="Ayar Myanmar Unicode Group" />
</a>
	</div>
</div>

  <script type="text/javascript" src="<?php echo AWK_PLUGIN_URL;?>/js/jdock.min.js"></script>
  <script type="text/javascript">
	var $ = jQuery.noConflict();
jQuery(document).ready(function($){
  // set up the options to be used for jqDock...
  var dockOptions =
    { align: 'bottom' // horizontal menu, with expansion UP from a fixed BOTTOM edge
    //, labels: true  // add labels (defaults to 'tl')
    };
  // ...and apply...
 jQuery('#menu').jqDock(dockOptions);
jQuery(".awk_fancybox").fancybox({
				'width'			: '75%',
				'height'			: '95%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
});

			

  </script>

<?php 
}else{
?>
<div id='pageshare' title="Ayar-Plugin-ToolBar">
<div class='sbutton'><a id="A" class="selected" href="javascript:" onclick="ay_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayy.png" border="0" alt="Ayar Myanmar Unicode Font" /></a></div>
<div class='sbutton'><a id="Z" href="javascript:" onclick="zg_setcookies();"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/za.png" border="0" alt="Zawgyi Font" /></a></div>
<div class='sbutton'><a href="http://ayaronlineeditor.co.cc/" class="awk_fancybox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ke.png" border="0" alt="Ayar Online Editor" /></a></div>
<div class='sbutton'><a href="http://ayaronline.co.cc/" class="awk_fancybox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/co.png" border="0" alt="Ayar Online Converter" /></a></div>
<div class='sbutton'><a href="http://ayar.co/" class="awk_fancybox" onclick="return false;"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/dc.png" border="0" alt="Ayar Online Dictionary" /></a></div>
<div class='sbutton'><a href="http://www.ayarunicodegroup.org/" target="_blank"><img src="<?php echo AWK_PLUGIN_URL;?>/icons/ayl.jpg" border="0" alt="Ayar Myanmar Unicode Group" /></a></div>
</div> 
  <script type="text/javascript">
	var $ = jQuery.noConflict();
jQuery(document).ready(function($){
			$(".awk_fancybox").fancybox({
				'width'			: '75%',
				'height'			: '95%',
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
});


var ajaxObj="";
jQuery(document).ready(function($){
  $(document).mousemove(function(e){
jQuery('#x').val(e.pageX);
jQuery('#y').val(e.pageY);
  });
})
function getSelText()
{
	var txt = "";
    if (window.getSelection){  txt = window.getSelection();   }
   else if (document.getSelection){ txt = document.getSelection();  }
   else if (document.selection){ txt = document.selection.createRange().text; }
   else return;
if(txt==""){return;}
jQuery('#popup').css("top",(jQuery("#y").val()) + "px");
jQuery('#popup').css("left",(jQuery("#x").val()) + "px");

jQuery('#popup').fadeIn(300);
jQuery('#dic_content').html("loading....");

if(ajaxObj!=""){ajaxObj.abort(); }

ajaxObj=jQuery.ajax({
 type: "GET",
 url: "http://ayar.co/remote_search.php?word=" +txt,
 success: function(content){
jQuery('#dic_content').html(content);
}
});

}
</script>
<script type="text/javascript">
document.ondblclick = function(){
getSelText();
};
</script>
<?php } ?>
<div id="popup" style="border:1px solid #999999;background:#cccccc;-moz-border-radius: 5px;-webkit-border-radius:5px;padding:10px;width:300px;height:auto;display:none;position:absolute;">
<div id="dic_content"></div>
</div>
<input type="hidden" id="x"><input type="hidden" id="y">
<?php
}
//add fancybox
function add_fancybox(){
	if(!is_admin()){
	$fancybox = 'fancybox';
	$fbsrc = AWK_PLUGIN_URL.'/fancybox/jquery.fancybox-1.3.4.pack.js';
	$deps = array('jquery');
	wp_register_script($fancybox,$fbsrc,$deps,false,false);
	wp_enqueue_script($fancybox);
	$fbstyle = AWK_PLUGIN_URL.'/fancybox/jquery.fancybox-1.3.4.css';
	wp_register_style( $fancybox, $fbstyle, $depstyle, $ver, $media );
	wp_enqueue_style( $fancybox );
	//wp_enqueue_script('jquery');
	//wp_enqueue_script('thickbox',null,array('jquery'));
	//wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	}

}
add_action('init','add_fancybox');
add_action('wp_footer', 'a2zt_footer');
add_action('login_form', 'a2zt_footer');
add_action('register_form', 'a2zt_footer');
add_action('retrieve_password', 'a2zt_footer');
add_action('password_reset', 'a2zt_footer');
add_action('lostpassword_form', 'a2zt_footer');
//add_action('admin_footer', 'a2zt_footer');
add_action('init', 'get_font_cookies');


function get_font_cookies(){
	global $awk_options, $fonts_server, $fonts_server_url, $font_encoding;
	$font_encoding = $_COOKIE['font'];
	if ( $font_encoding == 'ayar') {
		
		}
	if ( $font_encoding == 'zawgyi') {
		if ($fonts_server == 'other'){	
			$fonts_server_url = $awk_options['other_server_url'].'css/';
		}elseif ($fonts_server == 'same_domain'){
			$fonts_server_url = AWK_PLUGIN_URL.'/includes/web-fonts.php';
		}elseif ($fonts_server == 'default'){
			$fonts_server_url = 'http://webfont.myanmapress.com/css/';
			}
		$zawgyi_embed = 'zawgyi_embed';
		$zawgyi_src = $fonts_server_url.'?font=zawgyi-one';
		$deps = false;
		$ver = false;
		$media = 'All';
		wp_register_style( $zawgyi_embed, $zawgyi_src, $deps, $ver, $media );
		wp_enqueue_style( $zawgyi_embed );
		add_action('wp', 'mobile_html_set_up_buffer', 10, 0);
		}
}
?>
