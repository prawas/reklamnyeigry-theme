<?php
/**
 * Kristinka functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Kristinka
 */

if ( ! function_exists( 'kristinka_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function kristinka_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Kristinka, use a find and replace
	 * to change 'kristinka' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'kristinka', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Cropping the images to different sizes to be used in the theme
	add_image_size( 'kristinka-featured', 702, 390, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'kristinka' ),
		'secondary' => esc_html__( 'Secondary', 'kristinka' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'kristinka_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-logo');
}
endif;
add_action( 'after_setup_theme', 'kristinka_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function kristinka_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'kristinka_content_width', 640 );
}
add_action( 'after_setup_theme', 'kristinka_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function kristinka_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'kristinka' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar One', 'kristinka' ),
		'id' 					=> 'kristinka_footer_sidebar_one',
		'description'   	=> __( 'Shows widgets at footer sidebar one.', 'kristinka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Two', 'kristinka' ),
		'id' 					=> 'kristinka_footer_sidebar_two',
		'description'   	=> __( 'Shows widgets at footer sidebar two.', 'kristinka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar three
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Three', 'kristinka' ),
		'id' 					=> 'kristinka_footer_sidebar_three',
		'description'   	=> __( 'Shows widgets at footer sidebar three.', 'kristinka' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'kristinka_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function kristinka_scripts() {
	wp_enqueue_style( 'kristinka-style', get_stylesheet_uri() );

	wp_enqueue_style( 'kristinka_google_fonts', '//fonts.googleapis.com/css?family=Open+Sans' );

	wp_enqueue_style( 'kristinka-fontawesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.5.0' );

	wp_enqueue_script( 'kristinka-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'kristinka-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_page_template( 'template-parts/homepage.php' ) && get_theme_mod('kristinka_home_slider', 0) == 1  && !is_paged()) {
		wp_register_script( 'kristinka-bxslider', get_template_directory_uri(). '/js/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );
		wp_enqueue_style( 'kristinka-slider-css', get_template_directory_uri(). '/layouts/jquery.bxslider.css');
		wp_enqueue_script( 'kristinka-slider', get_template_directory_uri(). '/js/kristinka-slider-setting.js', array( 'kristinka-bxslider' ), false, true );
   }
}
add_action( 'wp_enqueue_scripts', 'kristinka_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


        function kristinka_comment($comment, $args){
          $GLOBALS['comment'] = $comment; 

          ?>

          <div <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
            <section class='full_comment' >
            	<div class='full_comment_row' >
              		<div class="ava_in_tabl"  >
              	
                	 <?php echo get_avatar($comment, $size='50', '' ); ?>
                 	</div>
                       
               		<div class="comment_text" >
               			<div class="tabl_comment"><span class="comment-author"><?=get_comment_author_link() ?></span>
               			<?php if ($comment->comment_approved == '0') : ?>
                               <em><?php _e('Ваш комментарий ожидает проверки') ?></em>
              					<br>
             			<?php endif; ?>


                			<?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
              
             		 		<?php comment_text() ?>
             		 		  <div class="reply">

               				<?php comment_reply_link(array('reply_text' => "Ответить",
								'respond_id' => 'comment',
								'depth' => 5,
								'max_depth' => 10))?>
               				</div>
              			</div>
              		</div>
              </div>
            </section>
              
           </div>

          
           </div>

            
      <?php }
