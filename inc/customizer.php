<?php
/**
 * Kristinka Theme Customizer.
 *
 * @package Kristinka
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function kristinka_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Theme important links started
	class MATATA_Important_Links extends WP_Customize_Control {
		public $type = "kristinka-important-links";
		public function render_content() {
		//Add Theme Documentation, Support Forum, Demo Link
			$important_links = array(
				'support' => array(
					'link' => esc_url('https://wordpress.org/support/theme/kristinka'),
					'text' => __('Support', 'kristinka')
					),
				'demo' => array(
					'link' => esc_url('https://wp-themes.com/kristinka/'),
					'text' => __('View Demo', 'kristinka')
					),
				'rating' => array(
					'link' => esc_url('https://wordpress.org/support/view/theme-reviews/kristinka'),
					'text' => __('Rate This Theme', 'kristinka')
					)
				);
			foreach ($important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
			}
		}
	}

	$wp_customize->add_section('kristinka_important_links', array(
		'priority' => 5,
		'title' => __('Kristinka Important Links', 'kristinka')
	));

	$wp_customize->add_setting('kristinka_important_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_links_sanitize'
	));

	$wp_customize->add_control(new MATATA_Important_Links($wp_customize, 'important_links', array(
		'label' => __('Important Links', 'kristinka'),
		'section' => 'kristinka_important_links',
		'settings' => 'kristinka_important_links'
	)));
	// Theme Important Links Ended

	// Start of the Kristinka Main Options
	$wp_customize->add_panel('kristinka_main_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => __('Panel to update kristinka theme options', 'kristinka'),
		'priority' => 10,
		'title' => __('Kristinka Options', 'kristinka')
	));

	// home slider enable/disable
	$wp_customize->add_section('kristinka_home_slider_section', array(
		'title' => __('Home Slider', 'kristinka'),
		'panel' => 'kristinka_main_options',
		'priority' => 25
	));

	$wp_customize->add_setting('kristinka_home_slider', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_checkbox_sanitize'
	));

	$wp_customize->add_control('kristinka_home_slider', array(
		'type' => 'checkbox',
		'label' => __('Check to enable Home Slider. In order to see the slider you need to create a new page and assign it the "Homepage with Slider" template. Then set the page as front page.', 'kristinka'),
		'section' => 'kristinka_home_slider_section',
		'settings' => 'kristinka_home_slider'
	));

	// home slider options
	$categories = get_categories();
	$cats = array('default' => '');
	foreach($categories as $category){
		$cats[$category->slug] = $category->name;
	}
    $wp_customize->add_setting('kristinka_slide_categories', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kristinka_sanitize_slidecat'
    ));
    $wp_customize->add_control('kristinka_slide_categories', array(
        'label' => __('Slider Category', 'kristinka'),
        'section' => 'kristinka_home_slider_section',
        'type'    => 'select',
        'description' => __('Select a category for the featured post slider', 'kristinka'),
        'choices'    => $cats
    ));

    $wp_customize->add_setting('kristinka_slide_number', array(
        'default' => 3,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'kristinka_sanitize_number'
    ));
    $wp_customize->add_control('kristinka_slide_number', array(
        'label' => __('Number of slide items', 'kristinka'),
        'section' => 'kristinka_home_slider_section',
        'description' => __('Enter the number of slide items', 'kristinka'),
        'type' => 'text'
    ));

	// primary color
	$wp_customize->add_section('kristinka_primary_color_setting', array(
		'panel' => 'kristinka_main_options',
		'priority' => 5,
		'title' => __('Primary Color', 'kristinka')
	));

	$wp_customize->add_setting('kristinka_primary_color', array(
		'default' => '#249ccc',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_color_option_hex_sanitize',
		'sanitize_js_callback' => 'kristinka_color_escaping_option_sanitize'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'kristinka_primary_color', array(
		'label' => __('Choose a color to match your site', 'kristinka'),
		'section' => 'kristinka_primary_color_setting',
		'settings' => 'kristinka_primary_color'
	)));

	// blog post style
	$wp_customize->add_section('kristinka_post_style_setting', array(
		'priority' => 10,
		'title' => __('Blog Post Style', 'kristinka'),
		'panel' => 'kristinka_main_options'
	));

	$wp_customize->add_setting('kristinka_post_style', array(
		'default' => 'kristinka-magazine',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_show_radio_saniztize'
	));

	$wp_customize->add_control('kristinka_post_style', array(
		'type' => 'radio',
		'label' => __('Choose if you want to use magazine or normal blog post style.', 'kristinka'),
		'section' => 'kristinka_post_style_setting',
		'choices' => array(
			'kristinka-blog' => __('Blog', 'kristinka'),
			'kristinka-magazine' => __('Magazine', 'kristinka')
			)
	));

	// default layout setting
	$wp_customize->add_section('kristinka_default_layout_setting', array(
		'priority' => 20,
		'title' => __('Default Layout', 'kristinka'),
		'panel'=> 'kristinka_main_options'
		));

	$wp_customize->add_setting('kristinka_default_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_layout_sanitize'
	));

	$wp_customize->add_control('kristinka_default_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout. This layout will be reflected in whole site archives, categories, search page etc.', 'kristinka'),
		'section' => 'kristinka_default_layout_setting',
		'settings' => 'kristinka_default_layout',
		'choices' => array(
			'right_sidebar' => __('Right Sidebar', 'kristinka'),
			'left_sidebar' => __('Left Sidebar', 'kristinka'),
			'no_sidebar_full_width' => __('No Sidebar Full Width', 'kristinka'),
			'no_sidebar_content_centered' => __('No Sidebar Content Centered', 'kristinka')
			)
	));

	// Custom CSS
	$wp_customize->add_section('kristinka_custom_css_setting', array(
		'priority' => 30,
		'title' => __('Custom CSS', 'kristinka'),
		'panel'=> 'kristinka_main_options'
		));

	$wp_customize->add_setting('kristinka_custom_css', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_textarea'
	));

	$wp_customize->add_control('kristinka_custom_css', array(
		'type' => 'textarea',
		'label' => __('Your Custom CSS', 'kristinka'),
		'section' => 'kristinka_custom_css_setting',
		'settings' => 'kristinka_custom_css'
	));

	// Social Options
	$wp_customize->add_section('kristinka_social_link_activate_settings', array(
		'title' => __('Social Links Area', 'kristinka'),
		'panel' => 'kristinka_main_options'
	));

	$wp_customize->add_setting('kristinka_social_link_activate', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'kristinka_checkbox_sanitize'
	));

	$wp_customize->add_control('kristinka_social_link_activate', array(
		'type' => 'checkbox',
		'label' => __('Check to activate social links area', 'kristinka'),
		'section' => 'kristinka_social_link_activate_settings',
		'settings' => 'kristinka_social_link_activate'
	));

	$kristinka_social_links = array(
		'kristinka_social_facebook' => array(
			'id' => 'kristinka_social_facebook',
			'title' => __('Facebook', 'kristinka'),
			'default' => ''
			),
		'kristinka_social_twitter' => array(
			'id' => 'kristinka_social_twitter',
			'title' => __('Twitter', 'kristinka'),
			'default' => ''
			),
		'kristinka_social_googleplus' => array(
			'id' => 'kristinka_social_googleplus',
			'title' => __('Google-Plus', 'kristinka'),
			'default' => ''
			),
		'kristinka_social_instagram' => array(
			'id' => 'kristinka_social_instagram',
			'title' => __('Instagram', 'kristinka'),
			'default' => ''
			),
		'kristinka_social_pinterest' => array(
			'id' => 'kristinka_social_pinterest',
			'title' => __('Pinterest', 'kristinka'),
			'default' => ''
			),
		'kristinka_social_youtube' => array(
			'id' => 'kristinka_social_youtube',
			'title' => __('YouTube', 'kristinka'),
			'default' => ''
			),
		);

	$i = 20;

	foreach($kristinka_social_links as $kristinka_social_link) {

		$wp_customize->add_setting($kristinka_social_link['id'], array(
			'default' => $kristinka_social_link['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($kristinka_social_link['id'], array(
			'label' => $kristinka_social_link['title'],
			'section'=> 'kristinka_social_link_activate_settings',
			'settings'=> $kristinka_social_link['id'],
			'priority' => $i
		));

		$wp_customize->add_setting($kristinka_social_link['id'].'_checkbox', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'kristinka_checkbox_sanitize'
		));

		$wp_customize->add_control($kristinka_social_link['id'].'_checkbox', array(
			'type' => 'checkbox',
			'label' => __('Check to show in new tab', 'kristinka'),
			'section'=> 'kristinka_social_link_activate_settings',
			'settings'=> $kristinka_social_link['id'].'_checkbox',
			'priority' => $i
		));

		$i++;

	}

	function kristinka_show_radio_saniztize($input) {
		$valid_keys = array(
			'kristinka-blog' => __('Default', 'kristinka'),
			'kristinka-magazine' => __('Magazine', 'kristinka'),
			);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function kristinka_checkbox_sanitize($input) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function kristinka_color_option_hex_sanitize($color) {
		if ($unhashed = sanitize_hex_color_no_hash($color))
			return '#' . $unhashed;

		return $color;
	}

	function kristinka_color_escaping_option_sanitize($input) {
		$input = esc_attr($input);
		return $input;
	}

	function kristinka_layout_sanitize($input) {
		$valid_keys = array(
			'right_sidebar' => __('Right Sidebar', 'kristinka'),
			'left_sidebar' => __('Left Sidebar', 'kristinka'),
			'no_sidebar_full_width' => __('No Sidebar Full Width', 'kristinka'),
			'no_sidebar_content_centered' => __('No Sidebar Content Centered', 'kristinka')
			);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function kristinka_links_sanitize() {
		return false;
	}

	// Sanitize textarea 
	function sanitize_textarea( $text ) {
		return esc_textarea( $text );
	}

	function kristinka_sanitize_number($input) {
	    if ( isset( $input ) && is_numeric( $input ) ) {
	        return $input;
	    }
    }

    function kristinka_sanitize_slidecat( $input ) {
    	$valid_keys = array(
    		'default' => '',
    		);
    	$categories = get_categories();
    	foreach($categories as $category){
    		$valid_keys[$category->slug] = $category->name;
    	}
	    if ( array_key_exists( $input, $valid_keys ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

}
add_action( 'customize_register', 'kristinka_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function kristinka_customize_preview_js() {
	wp_enqueue_script( 'kristinka_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'kristinka_customize_preview_js' );
