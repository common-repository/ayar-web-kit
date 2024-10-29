
<?php

/**
 * Master theme class
 * 
 * @package Bolts
 * @since 1.0
 */
class AWK_Options {
	
	private $sections;
	private $checkboxes;
	private $settings;
	public $options_name;
	public $options_group;
	public $options_page;
	
	/**
	 * Construct
	 *
	 * @since 1.0
	 */
	public function __construct($options_group= "default", $options_name = "default", $options_page = "default") {
		
		// This will keep track of the checkbox options for the validate_settings function.

		$this->checkboxes = array();
		$this->settings = array();
		$this->get_settings();
		$this->options_name = $options_name;
		$this->options_group = $options_group;
		$this->options_page = $options_page;
		
		$this->sections['general']      = __( 'General Settings' );
		$this->sections['appearance']   = __( 'Appearance' );
		$this->sections['reset']        = __( 'Reset to Defaults' );
		$this->sections['about']        = __( 'About' );
		
		add_action( 'admin_menu', array( &$this, 'add_pages' ) );
		add_action( 'admin_init', array( &$this, 'register_settings' ) );
		//var_dump($this->options_name);
		if ( ! get_option($this->options_name ) )
			$this->initialize_settings();
		
	}
	
	/**
	 * Add options page
	 *
	 * @since 1.0
	 */
	public function add_pages() {
			$this->page_title = "Ayar Web Kit";
			$this->menu_title = "AyarWebKit";
			$this->capability = "manage_options";
			$this->menu_slug = "ayarwebkit";
			$function = array( &$this, 'display_page' );
			$this->icon_url = AWK_PLUGIN_URL."/icons/webfont.png";
			$this->position = null;
			$this->admin_page = $admin_page = add_menu_page( $this->page_title, $this->menu_title, $this->capability, $this->menu_slug, $function, $this->icon_url, $this->position );		

	//	add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
		add_action("load-$admin_page", array(&$this, 'admin_load')); //run after loading admin option page -- call styles and scripts -- print help tab and sidebar		

	//	add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
		
	}
	
	/**
	 * Create settings field
	 *
	 * @since 1.0
	 */
	public function create_setting( $args = array() ) {
		
		$defaults = array(
			'id'      => 'default_field',
			'title'   => __( 'Default Field' ),
			'desc'    => __( 'This is a default description.' ),
			'std'     => '',
			'type'    => 'text',
			'section' => 'general',
			'choices' => array(),
			'class'   => ''
		);
			
		extract( wp_parse_args( $args, $defaults ) );
		//print_r($args);
		$field_args = array(
			'type'      => $type,
			'id'        => $id,
			'desc'      => $desc,
			'std'       => $std,
			'choices'   => $choices,
			'label_for' => $id,
			'class'     => $class
		);
		//print_r($field_args);
		
		if ( $type == 'checkbox' )
			$this->checkboxes[] = $id;
		//var_dump($this->options_page);
		//var_dump($section);
		add_settings_field( $id, $title, array( $this, 'display_setting' ), $this->options_page, $section, $field_args );
	}
	
	/**
	 * Display options page
	 *
	 * @since 1.0
	 */
	public function display_page() {
		
	echo '<style type="text/css">
		#icon-awk-settings{';
echo '			background: transparent url('; 
echo $this->icon_url; 
echo ') no-repeat;';
echo '			}
		</style>';			
		echo '<div class="wrap">';
		screen_icon('awk-settings'); 
		echo '<h2>' . __( 'Ayar Web Kit' ) . '</h2>';
	
		if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true )
			echo '<div class="updated fade"><p>' . __( 'Theme options updated.' ) . '</p></div>';
		
		echo '<form action="options.php" method="post">';
	
		settings_fields($this->options_group );
		echo '<div class="ui-tabs">
			<ul class="ui-tabs-nav">';
		
		foreach ( $this->sections as $section_slug => $section )
			echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
		
		echo '</ul>';
		do_settings_sections($this->options_page );
		
		echo '</div>
		<p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . __( 'Save Changes' ) . '" /></p>
		
	</form>';
	
	echo '<script type="text/javascript">
		jQuery(document).ready(function($) {
			var sections = [];';
			
			foreach ( $this->sections as $section_slug => $section )
				echo "sections['$section'] = '$section_slug';";
			
			echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
			wrapped.each(function() {
				$(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
			});
			$(".ui-tabs-panel").each(function(index) {
				$(this).attr("id", sections[$(this).children("h3").text()]);
				if (index > 0)
					$(this).addClass("ui-tabs-hide");
			});
			$(".ui-tabs").tabs({
				fx: { opacity: "toggle", duration: "fast" }
			});
			
			$("input[type=text], textarea").each(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "")
					$(this).css("color", "#999");
			});
			
			$("input[type=text], textarea").focus(function() {
				if ($(this).val() == $(this).attr("placeholder") || $(this).val() == "") {
					$(this).val("");
					$(this).css("color", "#000");
				}
			}).blur(function() {
				if ($(this).val() == "" || $(this).val() == $(this).attr("placeholder")) {
					$(this).val($(this).attr("placeholder"));
					$(this).css("color", "#999");
				}
			});
			
			$(".wrap h3, .wrap table").show();
			
			// This will make the "warning" checkbox class really stand out when checked.
			// I use it here for the Reset checkbox.
			$(".warning").change(function() {
				if ($(this).is(":checked"))
					$(this).parent().css("background", "#c00").css("color", "#fff").css("fontWeight", "bold");
				else
					$(this).parent().css("background", "none").css("color", "inherit").css("fontWeight", "normal");
			});
			
			// Browser compatibility
			if ($.browser.mozilla) 
			         $("form").attr("autocomplete", "off");
		});
	</script>
</div>';
	}
	
	/**
	 * Description for section
	 *
	 * @since 1.0
	 */
	public function display_section() {
		// code
	}
	
	/**
	 * Description for About section
	 *
	 * @since 1.0
	 */
	public function display_about_section() {
		
		// This displays on the "About" tab. Echo regular HTML here, like so:
		// echo '<p>Copyright 2011 me@example.com</p>';
		
	}
	
	/**
	 * HTML output for text field
	 *
	 * @since 1.0
	 */
	public function display_setting( $args = array() ) {
		
		extract( $args );
	//	var_dump($this->options_name);
		$options = get_option($this->options_name );
	//	var_dump($options);
		
		if ( ! isset( $options[$id] ) && $type != 'checkbox' )
			$options[$id] = $std;
		elseif ( ! isset( $options[$id] ) )
			$options[$id] = 0;
		
		$field_class = '';
		if ( $class != '' )
			$field_class = ' ' . $class;
		
		switch ( $type ) {
			
			case 'heading':
				echo '</td></tr><tr valign="top"><td colspan="2"><h4>' . $desc . '</h4>';
				break;
			
			case 'checkbox':
				
				echo '<input class="checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="'.$this->options_name.'['.$id.']" value="1" ' . checked( $options[$id], 1, false ) . ' /> <label for="' . $id . '">' . $desc . '</label>';
				
				break;
			
			case 'select':
				echo '<select class="select' . $field_class . '" name="'.$this->options_name.'['.$id.']">';
				
				foreach ( $choices as $value => $label )
					echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
				
				echo '</select>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'radio':
				$i = 0;
				foreach ( $choices as $value => $label ) {
					echo '<input class="radio' . $field_class . '" type="radio" name="'.$this->options_name.'['.$id.']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label>';
					if ( $i < count( $options ) - 1 )
						echo '<br />';
					$i++;
				}
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'textarea':
				echo '<textarea class="' . $field_class . '" id="' . $id . '" name="'.$this->options_name.'['.$id.']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'password':
				echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="'.$this->options_name.'['.$id.']" value="' . esc_attr( $options[$id] ) . '" />';
				
				if ( $desc != '' )
					echo '<br /><span class="description">' . $desc . '</span>';
				
				break;
			
			case 'text':
			default:
		 		echo '<input class="regular-text' . $field_class . '" type="text" id="' . $id . '" name="'.$this->options_name.'['.$id.']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
		 		
		 		if ( $desc != '' )
		 			echo '<br /><span class="description">' . $desc . '</span>';
		 		
		 		break;
		 	
		}
		
	}
	
	/**
	 * Settings and defaults
	 * 
	 * @since 1.0
	 */
	 /**
	 public function get_settings(){
		 // This function can extends in child class
		 }
		 */
	public function get_settings() {
		
		/* General Settings
		===========================================*/
		
		$this->settings['example_text'] = array(
			'title'   => __( 'Example Text Input' ),
			'desc'    => __( 'This is a description for the text input.' ),
			'std'     => 'Default value',
			'type'    => 'text',
			'section' => 'general'
		);
		
		$this->settings['example_textarea'] = array(
			'title'   => __( 'Example Textarea Input' ),
			'desc'    => __( 'This is a description for the textarea input.' ),
			'std'     => 'Default value',
			'type'    => 'textarea',
			'section' => 'general'
		);
		
		$this->settings['example_checkbox'] = array(
			'section' => 'general',
			'title'   => __( 'Example Checkbox' ),
			'desc'    => __( 'This is a description for the checkbox.' ),
			'type'    => 'checkbox',
			'std'     => 1 // Set to 1 to be checked by default, 0 to be unchecked by default.
		);
		
		$this->settings['example_heading'] = array(
			'section' => 'general',
			'title'   => '', // Not used for headings.
			'desc'    => 'Example Heading',
			'type'    => 'heading'
		);
		
		$this->settings['example_radio'] = array(
			'section' => 'general',
			'title'   => __( 'Example Radio' ),
			'desc'    => __( 'This is a description for the radio buttons.' ),
			'type'    => 'radio',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Choice 1',
				'choice2' => 'Choice 2',
				'choice3' => 'Choice 3'
			)
		);
		
		$this->settings['example_select'] = array(
			'section' => 'general',
			'title'   => __( 'Example Select' ),
			'desc'    => __( 'This is a description for the drop-down.' ),
			'type'    => 'select',
			'std'     => '',
			'choices' => array(
				'choice1' => 'Other Choice 1',
				'choice2' => 'Other Choice 2',
				'choice3' => 'Other Choice 3'
			)
		);
		
		/* Appearance
		===========================================*/
		
		$this->settings['header_logo'] = array(
			'section' => 'appearance',
			'title'   => __( 'Header Logo' ),
			'desc'    => __( 'Enter the URL to your logo for the theme header.' ),
			'type'    => 'text',
			'std'     => ''
		);
		
		$this->settings['favicon'] = array(
			'section' => 'appearance',
			'title'   => __( 'Favicon' ),
			'desc'    => __( 'Enter the URL to your custom favicon. It should be 16x16 pixels in size.' ),
			'type'    => 'text',
			'std'     => ''
		);
		
		$this->settings['custom_css'] = array(
			'title'   => __( 'Custom Styles' ),
			'desc'    => __( 'Enter any custom CSS here to apply it to your theme.' ),
			'std'     => '',
			'type'    => 'textarea',
			'section' => 'appearance',
			'class'   => 'code'
		);
				
		/* Reset
		===========================================*/
		
		$this->settings['reset_theme'] = array(
			'section' => 'reset',
			'title'   => __( 'Reset theme' ),
			'type'    => 'checkbox',
			'std'     => 0,
			'class'   => 'warning', // Custom class for CSS
			'desc'    => __( 'Check this box and click "Save Changes" below to reset theme options to their defaults.' )
		);
		
	}
	
	/**
	 * Initialize settings to their default values
	 * 
	 * @since 1.0
	 */
	public function initialize_settings() {
		
		$default_settings = array();
		foreach ( $this->settings as $id => $setting ) {
			if ( $setting['type'] != 'heading' )
				$default_settings[$id] = $setting['std'];
		}
		
		update_option($this->options_name, $default_settings );
		
	}
	
	/**
	* Register settings
	*
	* @since 1.0
	*/
	public function register_settings() {
	
		register_setting($this->options_group, $this->options_name, array ( &$this, 'validate_settings' ) );
		
		foreach ( $this->sections as $slug => $title ) {
			if ( $slug == 'about' )
				add_settings_section( $slug, $title, array( &$this, 'display_about_section' ), $this->options_page );
			else
				add_settings_section( $slug, $title, array( &$this, 'display_section' ), $this->options_page );
		}
		
		$this->get_settings();
		//print_r($this->settings);
		foreach ( $this->settings as $id => $setting ) {
			$setting['id'] = $id;
			//print_r($setting);
			$this->create_setting( $setting );
		}
		
	}
	
	/**
	* jQuery Tabs
	*
	* @since 1.0
	*/
	public function scripts() {
		
		wp_print_scripts( 'jquery-ui-tabs' );
		
	}
	
	/**
	* Styling for the theme options page
	*
	* @since 1.0
	*/
	public function admin_load() {
		get_current_screen()->add_help_tab( array(
			'id'      => 'overview',
			'title'   => __('Overview'),
			'content' =>
				'<p>' . __( 'You can customize the look of your site without touching any of your theme&#8217;s code by using a custom background. Your background can be an image or a color.' ) . '</p>' .
				'<p>' . __( 'To use a background image, simply upload it or choose an image that has already been uploaded to your Media Library by clicking the &#8220;Choose Image&#8221; button. You can display a single instance of your image, or tile it to fill the screen. You can have your background fixed in place, so your site content moves on top of it, or you can have it scroll with your site.' ) . '</p>' .
				'<p>' . __( 'You can also choose a background color by clicking the Select Color button and either typing in a legitimate HTML hex value, e.g. &#8220;#ff0000&#8221; for red, or by choosing a color using the color picker.' ) . '</p>' .
				'<p>' . __( 'Don&#8217;t forget to click on the Save Changes button when you are finished.' ) . '</p>'
		) );

		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __( 'For more information:' ) . '</strong></p>' .
			'<p>' . __( '<a href="http://codex.wordpress.org/Appearance_Background_Screen" target="_blank">Documentation on Custom Background</a>' ) . '</p>' .
			'<p>' . __( '<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>' ) . '</p>'
		);

		wp_enqueue_media();		
		wp_enqueue_script('jquery-ui-tabs');
		wp_register_style( 'awk-admin', AWK_PLUGIN_URL . '/styles/awk-options.css' );
		wp_enqueue_style( 'awk-admin' );
		//wp_enqueue_style( 'thickbox' );
		$this->icon_url = AWK_PLUGIN_URL."/icons/webfont-35.png";
		
	}
	
	/**
	* Validate settings
	*
	* @since 1.0
	*/
	public function validate_settings( $input ) {
		
		if ( ! isset( $input['reset_theme'] ) ) {
			$options = get_option($this->options_name );
			
			foreach ( $this->checkboxes as $id ) {
				if ( isset( $options[$id] ) && ! isset( $input[$id] ) )
					unset( $options[$id] );
			}
			
			return $input;
		}
		return false;
		
	}
	
}
$options_group = "awk_options_group";
$options_name = "awk_options";
$options_page = "ayarwebkit";
$awk_options = new AWK_Options($options_group,$options_name,$options_page);

$options = $awk_options->options_name;

function awk_option( $option ) {
	global $options;
	$db_options = get_option($options);
	if ( isset( $db_options[$option] ) )
		return $db_options[$option];
	else
		return false;
}
?>
