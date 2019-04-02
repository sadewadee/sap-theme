<?php

class reedwanThemePanel {
	var $theme_name;
	
	public function __construct($theme_name = 'Theme Options')
	{
		$this->theme_name = $theme_name;
		$this->default_options();
		
		add_action('init', array($this, 'init'));
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('wp_ajax_reedwan_upload', array($this, 'upload'));
		add_action('wp_ajax_reedwan_save_fields', array($this, 'save_fields'));
		add_action('wp_ajax_reedwan_reset_fields', array($this, 'reset_fields'));
	}
	public function init()
	{	
		register_nav_menu('mainenu', __('Main Navigation', 'DF')); 
	}
	
	public function admin_menu()
	{
		$object = add_object_page('Theme Options', 'Options Panel', 'manage_options', 'reedwan_panel', array($this, 'options_panel'), get_template_directory_uri() . '/panel/images/themeoptions-icon.png');
		
		add_action('admin_print_styles-'.$object, array($this, 'admin_scripts'));
	}
	
	public function admin_scripts()
	{
		wp_enqueue_style($this->theme_name, get_template_directory_uri().'/panel/style.css', '', '1');
		
		wp_enqueue_script('jquery');
		wp_enqueue_script('ajaxupload', get_template_directory_uri().'/panel/js/ajaxupload.js');
		wp_enqueue_script('color-picker', get_template_directory_uri().'/panel/js/colorpicker.js');
	}
	
	public function options_panel()
	{
		$options = new reedwanThemePanelOptions ;
	}
	public function upload()
	{
		$clickedID = $_POST['data'];
		$filename = $_FILES[$clickedID];
       	$filename['name'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', $filename['name']); 
		
		$override['test_form'] = false;
		$override['action'] = 'wp_handle_upload';    
		$uploaded_file = wp_handle_upload($filename,$override);
		
		$upload_tracking[] = $clickedID;
		update_option($clickedID, $uploaded_file['url']);
		
		if(!empty($uploaded_file['error'])) {
			echo 'Upload Error: ' . $uploaded_file['error'];
		}	
		else {
			echo $uploaded_file['url'];
		}
		
		die();
	}
	public function default_options()
	{
		add_option('reedwan_homepage_style', 'blog_style3');
		add_option('reedwan_sidebar_position', 'right');
		add_option('reedwan_footer_text', 'Copyright &copy; 2013 - Koran Renon.');
		add_option('reedwan_page_style', 'sidebar');
		add_option('reedwan_show_top_container', 'On');
		add_option('reedwan_show_date_time', 'On');
		add_option('reedwan_show_social_header', 'On');
		add_option('reedwan_show_search_form', 'Off');
		add_option('reedwan_single_navigation', 'On');
		add_option('reedwan_twitter', 'On');
		add_option('reedwan_header_height', '70');
		add_option('reedwan_facebook', 'On');
		add_option('reedwan_author', 'On');
		add_option('reedwan_tags', 'On');
		add_option('reedwan_categories', 'On');
		add_option('reedwan_related', 'On');
		add_option('reedwan_featured_slider', 'On');
		add_option('reedwan_slider_num_item', '5');
		add_option('reedwan_slider_effect', 'random');
		add_option('reedwan_slider_stye', 'smallStyle');
		add_option('reedwan_slider_speed', '3000');
		add_option('reedwan_slider_caption', '0.9');
		add_option('reedwan_spotlight_title', 'Spotlight');
		add_option('reedwan_spotlight_num_item', '15');
		add_option('reedwan_spotlight_title_bg', 'BA0D16');
		add_option('reedwan_heading_font', 'Patua One');
		add_option('reedwan_navigation_font', 'Patua One');
		add_option('reedwan_general_font', 'Arial');
		add_option('reedwan_color', 'BA0D16');
		add_option('reedwan_color_top_bg', '272625');
		add_option('reedwan_bg_color', '000000');
		add_option('reedwan_img_position', 'center center');
		add_option('reedwan_pattern', 'none');
		add_option('reedwan_style_color', 'light');
		add_option('reedwan_adds_toggle', 'Off');
	}
	
	public function save_fields()
	{
		unset($_POST['action']);
		foreach($_POST as $key => $value) {
			update_option($key, stripslashes($value));
		}
		die();
	}

	public function reset_fields()
	{
		update_option('reedwan_homepage_style', 'blog_style3');
		update_option('reedwan_sidebar_position', 'right');
		update_option('reedwan_footer_text', 'Copyright &copy; 2017 - DF.');
		update_option('reedwan_logo', '');
		update_option('reedwan_footer_logo', '');
		update_option('reedwan_analytics', '');
		update_option('reedwan_favicon', '');
		update_option('reedwan_show_top_container', 'On');
		update_option('reedwan_show_date_time', 'On');
		update_option('reedwan_show_social_header', 'On');
		update_option('reedwan_show_search_header', 'Off');
		update_option('reedwan_header_height', '70');
		update_option('reedwan_feedburner', '');
		update_option('reedwan_twitter_id', '');
		update_option('reedwan_facebook_id', '');
		update_option('reedwan_google_id', '');
		update_option('reedwan_googleplus_id', '');
		update_option('reedwan_youtube_id', '');
		update_option('reedwan_flickr_id', '');
		update_option('reedwan_linkedin_id', '');
		update_option('reedwan_deviantart_id', '');
		update_option('reedwan_page_style', 'sidebar');
		update_option('reedwan_single_navigation', 'On');
		update_option('reedwan_twitter', 'On');
		update_option('reedwan_facebook', 'On');
		update_option('reedwan_digg', 'Off');
		update_option('reedwan_stumbleupon', 'Off');
		update_option('reedwan_reddit', 'Off');
		update_option('reedwan_tumblr', 'Off');
		update_option('reedwan_email', 'Off');
		update_option('reedwan_author', 'On');
		update_option('reedwan_tags', 'On');
		update_option('reedwan_categories', 'On');
		update_option('reedwan_related', 'On');
		update_option('reedwan_featured_slider', 'On');
		update_option('reedwan_featured_tags', '');
		update_option('reedwan_slider_num_item', '5');
		update_option('reedwan_slider_effect', 'random');
		update_option('reedwan_slider_stye', 'smallStyle');
		update_option('reedwan_slider_speed', '3000');
		update_option('reedwan_slider_caption', '0.9');
		update_option('reedwan_show_spotlight', 'Off');
		update_option('reedwan_spotlight_title_bg', 'BA0D16');
		update_option('reedwan_spotlight_title', 'Spotlight');
		update_option('reedwan_spotlight_tags', '');
		update_option('reedwan_spotlight_num_item', '15');
		update_option('reedwan_heading_font', 'Patua One');
		update_option('reedwan_navigation_font', 'Patua One');
		update_option('reedwan_general_font', 'Arial');
		update_option('reedwan_color', 'BA0D16');
		update_option('reedwan_color_top_bg', '272625');
		update_option('reedwan_bg_color', '000000');
		update_option('reedwan_bg_image', '');
		update_option('reedwan_img_position', 'center center');
		update_option('reedwan_style_color', 'light');
		update_option('reedwan_pattern', 'none');
		update_option('reedwan_404_Title', '');
		update_option('reedwan_404_Text', '');
		update_option('reedwan_404_Image', '');
		update_option('reedwan_adds_title', '');
		update_option('reedwan_adds_text', '');
		update_option('reedwan_adds_url', '');
		update_option('reedwan_adds_image', '');
		update_option('reedwan_adds_toggle', 'Off');
		die();
	}
	
	
}

$reedwan = new reedwanThemePanel('KRenon Theme');
